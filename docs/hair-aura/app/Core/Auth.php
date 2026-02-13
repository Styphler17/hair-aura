<?php
/**
 * Hair Aura - Authentication Class
 * 
 * Handles user authentication, session management, and authorization
 * Secure password handling with bcrypt
 * 
 * @package HairAura\Core
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Core;

use App\Models\User;
use Exception;

class Auth
{
    /** @var User|null Current authenticated user */
    private static ?User $user = null;
    
    /** @var bool Authentication checked flag */
    private static bool $checked = false;
    
    /**
     * Initialize authentication session
     */
    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            // Secure session configuration
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
            ini_set('session.cookie_samesite', 'Lax');
            ini_set('session.use_strict_mode', 1);
            ini_set('session.gc_maxlifetime', 3600); // 1 hour
            
            session_start();
            
            // Regenerate session ID periodically
            if (!isset($_SESSION['created'])) {
                $_SESSION['created'] = time();
            } else if (time() - $_SESSION['created'] > 1800) {
                session_regenerate_id(true);
                $_SESSION['created'] = time();
            }
        }
        
        // Load user from session
        if (!self::$checked && isset($_SESSION['user_id'])) {
            self::$user = User::find($_SESSION['user_id']);
            self::$checked = true;
        }
    }
    
    /**
     * Attempt to log in user by email (legacy/default path).
     *
     * @param string $email User email
     * @param string $password User password
     * @param bool $remember Remember login
     * @return bool Success status
     */
    public static function attempt(string $email, string $password, bool $remember = false): bool
    {
        return self::attemptByEmail($email, $password, $remember);
    }

    /**
     * Attempt to log in user by email.
     *
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @param string|null $requiredRole
     * @return bool
     */
    public static function attemptByEmail(
        string $email,
        string $password,
        bool $remember = false,
        ?string $requiredRole = null
    ): bool {
        $email = trim(strtolower($email));
        $user = User::findByEmail($email);
        return self::attemptForUser($user, $password, $remember, $requiredRole);
    }

    /**
     * Attempt to log in user by phone number.
     *
     * @param string $phone
     * @param string $password
     * @param bool $remember
     * @param string|null $requiredRole
     * @return bool
     */
    public static function attemptByPhone(
        string $phone,
        string $password,
        bool $remember = false,
        ?string $requiredRole = null
    ): bool {
        $normalizedPhone = User::normalizePhone($phone);
        if ($normalizedPhone === '') {
            return false;
        }

        $user = User::findByPhone($normalizedPhone);
        return self::attemptForUser($user, $password, $remember, $requiredRole);
    }

    /**
     * Validate credentials and perform login for a concrete user record.
     *
     * @param User|null $user
     * @param string $password
     * @param bool $remember
     * @param string|null $requiredRole
     * @return bool
     */
    private static function attemptForUser(
        ?User $user,
        string $password,
        bool $remember = false,
        ?string $requiredRole = null
    ): bool {
        if (!$user) {
            return false;
        }

        if (!$user->is_active) {
            return false;
        }

        if ((int) ($user->id ?? 0) <= 0) {
            return false;
        }

        if ($requiredRole !== null && $user->role !== $requiredRole) {
            return false;
        }

        $passwordIsValid = password_verify($password, (string) $user->password_hash);

        // Backward compatibility for legacy seed data that used a shared placeholder hash.
        // If the known seeded credentials are used, allow login and upgrade to a fresh hash.
        if (!$passwordIsValid) {
            $legacySeedHash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
            $expectedSeedPassword = $user->isAdmin() ? 'Admin@123' : 'Customer@123';

            if (hash_equals($legacySeedHash, (string) $user->password_hash) && hash_equals($expectedSeedPassword, $password)) {
                $passwordIsValid = true;
            }
        }

        if (!$passwordIsValid) {
            return false;
        }

        // Rehash if necessary
        if (!password_verify($password, (string) $user->password_hash) || password_needs_rehash((string) $user->password_hash, PASSWORD_BCRYPT)) {
            $user->update(['password_hash' => password_hash($password, PASSWORD_BCRYPT)]);
        }

        self::login($user, $remember);
        return true;
    }
    
    /**
     * Log in a user
     * 
     * @param User $user User model
     * @param bool $remember Remember login
     */
    public static function login(User $user, bool $remember = false): void
    {
        self::init();
        
        $_SESSION['user_id'] = $user->id;
        $_SESSION['login_time'] = time();
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? null;
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? null;
        
        self::$user = $user;
        
        // Update last login
        $user->update(['last_login' => date('Y-m-d H:i:s')]);
        
        // Set remember me cookie
        if ($remember) {
            self::setRememberToken($user);
        }
        
        // Log activity
        self::logActivity('login', $user->id);
    }
    
    /**
     * Log out current user
     */
    public static function logout(): void
    {
        self::init();
        
        // Log activity
        if (self::$user) {
            self::logActivity('logout', self::$user->id);
        }
        
        // Clear remember token
        if (isset($_COOKIE['remember'])) {
            setcookie('remember', '', [
                'expires' => time() - 3600,
                'path' => '/',
                'httponly' => true,
                'secure' => isset($_SERVER['HTTPS']),
                'samesite' => 'Lax'
            ]);
        }
        
        // Clear session
        $_SESSION = [];
        session_destroy();
        
        self::$user = null;
        self::$checked = false;
    }
    
    /**
     * Check if user is logged in
     * 
     * @return bool
     */
    public static function check(): bool
    {
        self::init();
        
        // Check session
        if (isset($_SESSION['user_id'])) {
            // Validate session
            if (self::validateSession()) {
                return true;
            }
            self::logout();
        }
        
        // Check remember token
        if (isset($_COOKIE['remember'])) {
            return self::loginFromRememberToken();
        }
        
        return false;
    }
    
    /**
     * Validate current session
     * 
     * @return bool
     */
    private static function validateSession(): bool
    {
        // Check session age
        if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 3600)) {
            return false;
        }
        
        // Validate IP (optional security)
        if (isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== ($_SERVER['REMOTE_ADDR'] ?? null)) {
            // Could indicate session hijacking
            // return false; // Uncomment for strict IP validation
        }
        
        // Validate user agent (optional security)
        if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? null)) {
            // return false; // Uncomment for strict validation
        }
        
        return true;
    }
    
    /**
     * Set remember me token
     * 
     * @param User $user
     */
    private static function setRememberToken(User $user): void
    {
        $token = bin2hex(random_bytes(32));
        $hash = hash('sha256', $token);

        try {
            // Store hash in database
            $user->update([
                'remember_token' => $hash,
                'remember_expires' => date('Y-m-d H:i:s', strtotime('+30 days'))
            ]);

            // Set cookie with token
            setcookie('remember', $token, [
                'expires' => time() + (30 * 24 * 60 * 60),
                'path' => '/',
                'httponly' => true,
                'secure' => isset($_SERVER['HTTPS']),
                'samesite' => 'Lax'
            ]);
        } catch (\Throwable $e) {
            // If remember-token columns are missing, continue login without persistent cookie.
            error_log('Remember-token disabled: ' . $e->getMessage());
        }
    }
    
    /**
     * Login from remember token
     * 
     * @return bool
     */
    private static function loginFromRememberToken(): bool
    {
        $token = $_COOKIE['remember'];
        $hash = hash('sha256', $token);
        
        $user = User::findByRememberToken($hash);
        
        if ($user && $user->is_active) {
            // Check token expiry
            if ($user->remember_expires && strtotime($user->remember_expires) > time()) {
                self::login($user, true);
                return true;
            }
        }
        
        // Invalid token, clear cookie
        setcookie('remember', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'secure' => isset($_SERVER['HTTPS']),
            'samesite' => 'Lax'
        ]);
        
        return false;
    }
    
    /**
     * Get current authenticated user
     * 
     * @return User|null
     */
    public static function user(): ?User
    {
        self::init();
        return self::$user;
    }
    
    /**
     * Get current user ID
     * 
     * @return int|null
     */
    public static function id(): ?int
    {
        $id = self::$user?->id;
        if ($id === null) {
            return null;
        }

        return (int) $id;
    }
    
    /**
     * Check if user has role
     * 
     * @param string|array $roles Role(s) to check
     * @return bool
     */
    public static function hasRole($roles): bool
    {
        if (!self::$user) {
            return false;
        }
        
        $roles = (array) $roles;
        return in_array(self::$user->role, $roles);
    }
    
    /**
     * Check if user is admin
     * 
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return self::hasRole('admin');
    }
    
    /**
     * Require authentication
     * 
     * @param string $redirect URL to redirect if not authenticated
     * @throws Exception If not authenticated
     */
    public static function requireAuth(string $redirect = '/login'): void
    {
        if (!self::check()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: ' . self::withBasePath($redirect));
            exit;
        }
    }
    
    /**
     * Require admin role
     * 
     * @throws Exception If not admin
     */
    public static function requireAdmin(): void
    {
        self::requireAuth('/admin/login');
        
        if (!self::isAdmin()) {
            throw new Exception('Admin access required', 403);
        }
    }
    
    /**
     * Require guest (not logged in)
     * 
     * @param string $redirect URL to redirect if logged in
     */
    public static function requireGuest(string $redirect = '/'): void
    {
        if (self::check()) {
            header('Location: ' . self::withBasePath($redirect));
            exit;
        }
    }

    /**
     * Resolve URL against app base path for subdirectory installs.
     */
    private static function withBasePath(string $url): string
    {
        $trimmed = trim($url);
        if ($trimmed === '') {
            return '/';
        }

        if (preg_match('#^(?:[a-z][a-z0-9+.-]*:)?//#i', $trimmed)) {
            return $trimmed;
        }

        $basePath = rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/');
        if ($basePath === '') {
            return str_starts_with($trimmed, '/') ? $trimmed : '/' . ltrim($trimmed, '/');
        }

        if ($trimmed === $basePath || str_starts_with($trimmed, $basePath . '/')) {
            return $trimmed;
        }

        if (str_starts_with($trimmed, '/')) {
            return $basePath . $trimmed;
        }

        return $basePath . '/' . ltrim($trimmed, '/');
    }
    
    /**
     * Hash password
     * 
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
    
    /**
     * Verify password
     * 
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
    
    /**
     * Generate CSRF token
     * 
     * @return string
     */
    public static function csrfToken(): string
    {
        self::init();
        
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Validate CSRF token
     * 
     * @param string $token
     * @return bool
     */
    public static function validateCsrf(string $token): bool
    {
        self::init();
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Log activity
     * 
     * @param string $action
     * @param int|null $userId
     */
    private static function logActivity(string $action, ?int $userId = null): void
    {
        try {
            $db = Database::getInstance();
            $db->insert('activity_logs', [
                'user_id' => $userId,
                'action' => $action,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            // Silently fail - don't break auth for logging issues
            error_log("Failed to log activity: " . $e->getMessage());
        }
    }
}
