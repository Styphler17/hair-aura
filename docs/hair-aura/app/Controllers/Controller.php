<?php
/**
 * Hair Aura - Base Controller
 * 
 * @package HairAura\Controllers
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Core\View;
use App\Core\Auth;
use App\Core\CartSession;
use App\Models\User;

abstract class Controller
{
    /** @var CartSession Cart instance */
    protected CartSession $cart;

    /** @var User|null Authenticated user instance */
    protected ?User $user = null;

    /** @var bool Whether current request is authenticated */
    protected bool $isLoggedIn = false;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isLoggedIn = Auth::check();
        $this->user = $this->isLoggedIn ? Auth::user() : null;

        $this->cart = new CartSession();
        
        // Share common data with all views
        $siteSettings = $this->loadSiteSettings();
        View::share([
            'cartCount' => $this->cart->count(),
            'cartSummary' => $this->cart->getSummary(),
            'user' => $this->user,
            'isLoggedIn' => $this->isLoggedIn,
            'isAdmin' => Auth::isAdmin(),
            'siteSettings' => $siteSettings,
            'themeVars' => $this->resolveThemeVars($siteSettings)
        ]);
    }
    
    /**
     * Render view
     * 
     * @param string $view
     * @param array $data
     * @param string|null $layout
     * @return string
     */
    protected function view(string $view, array $data = [], ?string $layout = null): string
    {
        $resolvedLayout = $this->resolveLayout($view, $layout);
        return View::render($view, $data, $resolvedLayout);
    }
    
    /**
     * Render and output view
     * 
     * @param string $view
     * @param array $data
     * @param string|null $layout
     */
    protected function render(string $view, array $data = [], ?string $layout = null): void
    {
        echo $this->view($view, $data, $layout);
    }

    /**
     * Resolve the layout to use for a given view.
     *
     * If a layout is explicitly provided, it is used.
     * Otherwise, infer by view namespace.
     */
    protected function resolveLayout(string $view, ?string $layout): ?string
    {
        if ($layout !== null) {
            return $layout;
        }

        if (str_starts_with($view, 'admin/')) {
            return 'layouts/admin';
        }

        if (str_starts_with($view, 'pages/auth/')) {
            return 'layouts/auth';
        }

        return 'layouts/main';
    }
    
    /**
     * Return JSON response
     * 
     * @param mixed $data
     * @param int $statusCode
     */
    protected function json($data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /**
     * Redirect to URL
     * 
     * @param string $url
     * @param int $code
     */
    protected function redirect(string $url, int $code = 302): void
    {
        http_response_code($code);
        header('Location: ' . $this->resolveRedirectUrl($url));
        exit;
    }

    /**
     * Resolve redirect URL against app base path for subdirectory installs.
     */
    private function resolveRedirectUrl(string $url): string
    {
        $trimmed = trim($url);
        if ($trimmed === '') {
            return '/';
        }

        // Absolute URL or protocol-relative URL.
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
     * Set flash message
     * 
     * @param string $type
     * @param string $message
     */
    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    /**
     * Get and clear flash message
     * 
     * @return array|null
     */
    protected function getFlash(): ?array
    {
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $flash;
    }
    
    /**
     * Validate request data
     * 
     * @param array $data
     * @param array $rules
     * @return array Errors array, empty if valid
     */
    protected function validate(array $data, array $rules): array
    {
        $errors = [];
        
        foreach ($rules as $field => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);
            $value = $data[$field] ?? null;
            
            foreach ($rulesArray as $rule) {
                $ruleParts = explode(':', $rule);
                $ruleName = $ruleParts[0];
                $ruleParam = $ruleParts[1] ?? null;
                
                switch ($ruleName) {
                    case 'required':
                        if (empty($value)) {
                            $errors[$field][] = ucfirst($field) . ' is required';
                        }
                        break;
                        
                    case 'email':
                        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = 'Please enter a valid email address';
                        }
                        break;
                        
                    case 'min':
                        if (!empty($value) && strlen($value) < (int) $ruleParam) {
                            $errors[$field][] = ucfirst($field) . " must be at least {$ruleParam} characters";
                        }
                        break;
                        
                    case 'max':
                        if (!empty($value) && strlen($value) > (int) $ruleParam) {
                            $errors[$field][] = ucfirst($field) . " must not exceed {$ruleParam} characters";
                        }
                        break;
                        
                    case 'numeric':
                        if (!empty($value) && !is_numeric($value)) {
                            $errors[$field][] = ucfirst($field) . ' must be a number';
                        }
                        break;
                        
                    case 'integer':
                        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_INT)) {
                            $errors[$field][] = ucfirst($field) . ' must be a whole number';
                        }
                        break;
                        
                    case 'min_value':
                        if (!empty($value) && $value < (int) $ruleParam) {
                            $errors[$field][] = ucfirst($field) . " must be at least {$ruleParam}";
                        }
                        break;
                        
                    case 'match':
                        if ($value !== ($data[$ruleParam] ?? null)) {
                            $errors[$field][] = ucfirst($field) . " must match {$ruleParam}";
                        }
                        break;
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * Check if request is AJAX
     * 
     * @return bool
     */
    protected function isAjax(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
    
    /**
     * Check if request is POST
     * 
     * @return bool
     */
    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    /**
     * Check if request is GET
     * 
     * @return bool
     */
    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
    
    /**
     * Get request data
     * 
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    protected function input(?string $key = null, $default = null)
    {
        $data = array_merge($_GET, $_POST);
        
        if ($key === null) {
            return $data;
        }
        
        return $data[$key] ?? $default;
    }
    
    /**
     * Get POST data
     * 
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    protected function post(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_POST;
        }
        
        return $_POST[$key] ?? $default;
    }
    
    /**
     * Get GET data
     * 
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    protected function get(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_GET;
        }
        
        return $_GET[$key] ?? $default;
    }
    
    /**
     * Get file upload
     * 
     * @param string $key
     * @return array|null
     */
    protected function file(string $key): ?array
    {
        return $_FILES[$key] ?? null;
    }
    
    /**
     * Require authentication
     * 
     * @param string $redirect
     */
    protected function requireAuth(string $redirect = '/login'): void
    {
        $this->isLoggedIn = Auth::check();
        $this->user = $this->isLoggedIn ? Auth::user() : null;

        if (!$this->isLoggedIn || !$this->user) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            $this->redirect($redirect);
        }
    }
    
    /**
     * Require admin role
     */
    protected function requireAdmin(): void
    {
        $this->requireAuth('/admin/login');
        
        if (!Auth::isAdmin()) {
            $this->flash('error', 'Admin access required');
            $this->redirect('/');
        }
    }
    
    /**
     * Generate CSRF token field
     * 
     * @return string
     */
    protected function csrfField(): string
    {
        $token = Auth::csrfToken();
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
    
    /**
     * Validate CSRF token
     * 
     * @return bool
     */
    protected function validateCsrf(): bool
    {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        return Auth::validateCsrf($token);
    }

    /**
     * Build absolute URL using APP_URL or runtime host fallback.
     */
    protected function absoluteUrl(string $path = '/'): string
    {
        $baseUrl = $this->siteBaseUrl();
        $normalizedPath = '/' . ltrim($path, '/');
        return rtrim($baseUrl, '/') . $normalizedPath;
    }

    /**
     * Resolve site base URL.
     */
    protected function siteBaseUrl(): string
    {
        $configured = rtrim((string) ($_ENV['APP_URL'] ?? ''), '/');
        if ($configured !== '') {
            return $configured;
        }

        $host = (string) ($_SERVER['HTTP_HOST'] ?? '');
        if ($host === '') {
            return '';
        }

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $basePath = rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/');
        return $scheme . '://' . $host . $basePath;
    }

    /**
     * Load site settings block from config/site-content.php.
     */
    private function loadSiteSettings(): array
    {
        $defaults = [
            'name' => 'Hair Aura',
            'tagline' => 'Unlock Your Aura with Perfect Wigs',
            'meta_description' => 'Premium wigs and hair extensions in Ghana.',
            'meta_keywords' => 'wigs Ghana, hair extensions, lace fronts',
            'email' => 'support@example.com',
            'phone' => '+233508007873',
            'whatsapp' => '+233508007873',
            'location' => 'Accra, Ghana',
            'theme_primary' => '#D4A574',
            'theme_primary_dark' => '#B8935F',
            'theme_secondary' => '#2C2C2C',
            'theme_gold' => '#D4AF37'
        ];

        $path = __DIR__ . '/../../config/site-content.php';
        if (!is_file($path)) {
            return $defaults;
        }

        $data = require $path;
        if (!is_array($data)) {
            return $defaults;
        }

        return array_merge(
            $defaults,
            (array) ($data['contact'] ?? []),
            (array) ($data['site'] ?? [])
        );
    }

    /**
     * Resolve theme CSS variables with strict #RRGGBB values.
     */
    private function resolveThemeVars(array $siteSettings): array
    {
        return [
            'primary' => $this->normalizeHexColor((string) ($siteSettings['theme_primary'] ?? ''), '#D4A574'),
            'primary_dark' => $this->normalizeHexColor((string) ($siteSettings['theme_primary_dark'] ?? ''), '#B8935F'),
            'secondary' => $this->normalizeHexColor((string) ($siteSettings['theme_secondary'] ?? ''), '#2C2C2C'),
            'gold' => $this->normalizeHexColor((string) ($siteSettings['theme_gold'] ?? ''), '#D4AF37')
        ];
    }

    /**
     * Normalize color input to strict #RRGGBB.
     */
    private function normalizeHexColor(string $value, string $fallback): string
    {
        $trimmed = trim($value);
        if ($trimmed === '') {
            return strtoupper($fallback);
        }

        if ($trimmed[0] !== '#') {
            $trimmed = '#' . $trimmed;
        }

        if (!preg_match('/^#[0-9a-fA-F]{6}$/', $trimmed)) {
            return strtoupper($fallback);
        }

        return strtoupper($trimmed);
    }
}
