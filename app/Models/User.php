<?php
/**
 * Hair Aura - User Model
 * 
 * @package HairAura\Models
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Models;

use App\Core\Database;

class User extends Model
{
    protected static string $table = 'users';
    protected static string $primaryKey = 'id';
    
    protected static array $fillable = [
        'email',
        'password_hash',
        'first_name',
        'last_name',
        'phone',
        'avatar',
        'role',
        'is_active',
        'email_verified',
        'last_login',
        'remember_token',
        'remember_expires',
        'created_at',
        'updated_at'
    ];
    
    protected static array $hidden = [
        'password_hash',
        'remember_token'
    ];
    
    /**
     * Find user by email
     * 
     * @param string $email
     * @return static|null
     */
    public static function findByEmail(string $email): ?static
    {
        return static::findBy('email', $email);
    }

    /**
     * Find user by phone number.
     *
     * @param string $phone
     * @return static|null
     */
    public static function findByPhone(string $phone): ?static
    {
        $normalizedPhone = static::normalizePhone($phone);
        if ($normalizedPhone === '') {
            return null;
        }

        $db = Database::getInstance();

        $result = $db->fetchOne(
            "SELECT * FROM users WHERE phone = :phone LIMIT 1",
            ['phone' => $normalizedPhone]
        );

        if (!$result) {
            $digits = preg_replace('/\D+/', '', $normalizedPhone);
            $result = $db->fetchOne(
                "SELECT * FROM users
                 WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '') = :digits
                 LIMIT 1",
                ['digits' => $digits]
            );
        }

        if (!$result) {
            return null;
        }

        $instance = new static($result);
        $instance->exists = true;
        return $instance;
    }

    /**
     * Normalize Ghana phone numbers to +233XXXXXXXXX.
     *
     * @param string $phone
     * @return string
     */
    public static function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', trim($phone));
        if ($digits === '') {
            return '';
        }

        if (str_starts_with($digits, '233') && strlen($digits) === 12) {
            return '+' . $digits;
        }

        if (str_starts_with($digits, '0') && strlen($digits) === 10) {
            return '+233' . substr($digits, 1);
        }

        if (strlen($digits) === 9) {
            return '+233' . $digits;
        }

        if (str_starts_with($phone, '+') && strlen($digits) >= 10) {
            return '+' . $digits;
        }

        return '+' . $digits;
    }
    
    /**
     * Find user by remember token
     * 
     * @param string $token
     * @return static|null
     */
    public static function findByRememberToken(string $token): ?static
    {
        $db = Database::getInstance();

        try {
            $result = $db->fetchOne(
                "SELECT * FROM users WHERE remember_token = :token LIMIT 1",
                ['token' => $token]
            );
        } catch (\Throwable $e) {
            // Compatibility fallback for databases that do not include remember_token columns.
            return null;
        }
        
        if (!$result) {
            return null;
        }
        
        $instance = new static($result);
        $instance->exists = true;
        return $instance;
    }
    
    /**
     * Get full name
     * 
     * @return string
     */
    public function getFullName(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
    
    /**
     * Get initials
     * 
     * @return string
     */
    public function getInitials(): string
    {
        $first = strtoupper(substr($this->first_name ?? '', 0, 1));
        $last = strtoupper(substr($this->last_name ?? '', 0, 1));
        return $first . $last;
    }
    
    /**
     * Check if user is admin
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    /**
     * Check if user is customer
     * 
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
    
    /**
     * Check if account is active
     * 
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }
    
    /**
     * Get avatar URL
     * 
     * @return string
     */
    public function getAvatarUrl(): string
    {
        if ($this->avatar) {
            return '/uploads/avatars/' . $this->avatar;
        }
        return '/img/default-avatar.svg';
    }
    
    /**
     * Get orders
     * 
     * @param int $limit
     * @return array
     */
    public function getOrders(int $limit = 10): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC LIMIT :limit",
            ['user_id' => $this->id, 'limit' => $limit]
        );
    }
    
    /**
     * Get order count
     * 
     * @return int
     */
    public function getOrderCount(): int
    {
        $db = Database::getInstance();
        
        return (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM orders WHERE user_id = :user_id",
            ['user_id' => $this->id]
        );
    }
    
    /**
     * Get total spent
     * 
     * @return float
     */
    public function getTotalSpent(): float
    {
        $db = Database::getInstance();
        
        return (float) $db->fetchColumn(
            "SELECT COALESCE(SUM(total), 0) FROM orders WHERE user_id = :user_id AND payment_status = 'paid'",
            ['user_id' => $this->id]
        );
    }
    
    /**
     * Get wishlist items
     * 
     * @return array
     */
    public function getWishlist(): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT p.*, w.created_at as added_at,
                (SELECT image_path FROM product_images WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as primary_image,
                c.name as category_name
             FROM wishlists w 
             JOIN products p ON w.product_id = p.id 
             LEFT JOIN categories c ON c.id = p.category_id
             WHERE w.user_id = :user_id 
             ORDER BY w.created_at DESC",
            ['user_id' => $this->id]
        );
    }
    
    /**
     * Add to wishlist
     * 
     * @param int $productId
     * @return bool
     */
    public function addToWishlist(int $productId): bool
    {
        $db = Database::getInstance();
        
        try {
            $db->insert('wishlists', [
                'user_id' => $this->id,
                'product_id' => $productId
            ]);
            return true;
        } catch (\Exception $e) {
            // Already in wishlist
            return false;
        }
    }
    
    /**
     * Remove from wishlist
     * 
     * @param int $productId
     * @return bool
     */
    public function removeFromWishlist(int $productId): bool
    {
        $db = Database::getInstance();
        
        $db->delete(
            'wishlists',
            'user_id = :user_id AND product_id = :product_id',
            ['user_id' => $this->id, 'product_id' => $productId]
        );
        
        return true;
    }
    
    /**
     * Check if product is in wishlist
     * 
     * @param int $productId
     * @return bool
     */
    public function hasInWishlist(int $productId): bool
    {
        $db = Database::getInstance();
        
        $count = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM wishlists WHERE user_id = :user_id AND product_id = :product_id",
            ['user_id' => $this->id, 'product_id' => $productId]
        );
        
        return $count > 0;
    }
    
    /**
     * Get addresses
     * 
     * @return array
     */
    public function getAddresses(): array
    {
        $db = Database::getInstance();
        $this->ensureUserAddressesTable($db);

        try {
            return $db->fetchAll(
                "SELECT * FROM user_addresses WHERE user_id = :user_id ORDER BY is_default DESC, updated_at DESC, created_at DESC",
                ['user_id' => $this->id]
            );
        } catch (\Throwable $e) {
            return [];
        }
    }
    
    /**
     * Get default address
     * 
     * @return array|null
     */
    public function getDefaultAddress(): ?array
    {
        $db = Database::getInstance();
        $this->ensureUserAddressesTable($db);

        try {
            return $db->fetchOne(
                "SELECT * FROM user_addresses WHERE user_id = :user_id AND is_default = 1 LIMIT 1",
                ['user_id' => $this->id]
            );
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Save checkout address for the current user.
     *
     * @param array $data
     * @return bool
     */
    public function saveAddressFromCheckout(array $data): bool
    {
        $db = Database::getInstance();
        $this->ensureUserAddressesTable($db);

        $hasAddresses = false;
        try {
            $hasAddresses = (int) $db->fetchColumn(
                "SELECT COUNT(*) FROM user_addresses WHERE user_id = :user_id",
                ['user_id' => $this->id]
            ) > 0;
        } catch (\Throwable $e) {
            $hasAddresses = false;
        }

        $address = [
            'user_id' => (int) $this->id,
            'label' => 'Shipping',
            'first_name' => trim((string) ($data['first_name'] ?? $this->first_name)),
            'last_name' => trim((string) ($data['last_name'] ?? $this->last_name)),
            'phone' => static::normalizePhone((string) ($data['phone'] ?? $this->phone ?? '')),
            'address_line1' => trim((string) ($data['address'] ?? '')),
            'address_line2' => trim((string) ($data['address_line2'] ?? '')),
            'city' => trim((string) ($data['city'] ?? '')),
            'state' => trim((string) ($data['state'] ?? '')),
            'country' => trim((string) ($data['country'] ?? 'Ghana')),
            'postal_code' => trim((string) ($data['postal_code'] ?? '')),
            'is_default' => $hasAddresses ? 0 : 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Do not save blank address rows.
        if ($address['address_line1'] === '' || $address['city'] === '') {
            return false;
        }

        try {
            $db->insert('user_addresses', $address);
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Ensure user_addresses table exists.
     */
    private function ensureUserAddressesTable(Database $db): void
    {
        try {
            $db->query(
                "CREATE TABLE IF NOT EXISTS user_addresses (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    user_id INT UNSIGNED NOT NULL,
                    label VARCHAR(60) DEFAULT NULL,
                    first_name VARCHAR(100) DEFAULT NULL,
                    last_name VARCHAR(100) DEFAULT NULL,
                    phone VARCHAR(30) DEFAULT NULL,
                    address_line1 VARCHAR(255) NOT NULL,
                    address_line2 VARCHAR(255) DEFAULT NULL,
                    city VARCHAR(100) NOT NULL,
                    state VARCHAR(100) DEFAULT NULL,
                    country VARCHAR(100) NOT NULL DEFAULT 'Ghana',
                    postal_code VARCHAR(20) DEFAULT NULL,
                    is_default TINYINT(1) NOT NULL DEFAULT 0,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    INDEX idx_user_addresses_user (user_id),
                    INDEX idx_user_addresses_default (user_id, is_default),
                    CONSTRAINT fk_user_addresses_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
            );
        } catch (\Throwable $e) {
            // Keep runtime resilient on restricted hosting DB users.
        }
    }
    
    /**
     * Create new user
     * 
     * @param array $data
     * @return static
     */
    public static function register(array $data): static
    {
        $user = new static();
        $user->email = $data['email'];
        $user->password_hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->phone = isset($data['phone']) ? static::normalizePhone((string) $data['phone']) : null;
        $user->role = 'customer';
        $user->is_active = 1;
        $user->save();
        
        return $user;
    }
    
    /**
     * Search users
     * 
     * @param string $query
     * @param int $limit
     * @return array
     */
    public static function search(string $query, int $limit = 20): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT * FROM users 
             WHERE first_name LIKE :query 
                OR last_name LIKE :query 
                OR email LIKE :query 
             ORDER BY created_at DESC 
             LIMIT :limit",
            ['query' => "%{$query}%", 'limit' => $limit]
        );
    }
    
    /**
     * Get recent customers
     * 
     * @param int $limit
     * @return array
     */
    public static function getRecentCustomers(int $limit = 10): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT * FROM users 
             WHERE role = 'customer' 
             ORDER BY created_at DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
}
