<?php
/**
 * Hair Aura - Order Model
 * 
 * @package HairAura\Models
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Models;

use App\Core\Database;
use Exception;

class Order extends Model
{
    protected static string $table = 'orders';
    protected static string $primaryKey = 'id';
    
    protected static array $fillable = [
        'order_number',
        'user_id',
        'guest_email',
        'guest_phone',
        'status',
        'payment_status',
        'payment_method',
        'payment_reference',
        'subtotal',
        'shipping_cost',
        'tax_amount',
        'discount_amount',
        'total',
        'currency',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_postal_code',
        'shipping_phone',
        'billing_same_as_shipping',
        'notes',
        'tracking_number',
        'shipped_at',
        'delivered_at',
        'created_at',
        'updated_at'
    ];
    
    /**
     * Order status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';
    
    /**
     * Payment status constants
     */
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_FAILED = 'failed';
    const PAYMENT_REFUNDED = 'refunded';
    
    /**
     * Find order by order number
     * 
     * @param string $orderNumber
     * @return static|null
     */
    public static function findByOrderNumber(string $orderNumber): ?static
    {
        return static::findBy('order_number', $orderNumber);
    }
    
    /**
     * Get order items
     * 
     * @return array
     */
    public function getItems(): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT oi.*, p.slug, 
                (SELECT image_path FROM product_images 
                 WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as product_image
             FROM order_items oi 
             JOIN products p ON oi.product_id = p.id 
             WHERE oi.order_id = :order_id",
            ['order_id' => $this->id]
        );
    }
    
    /**
     * Get user
     * 
     * @return User|null
     */
    public function getUser(): ?User
    {
        if (!$this->user_id) {
            return null;
        }
        return User::find($this->user_id);
    }
    
    /**
     * Get status label
     * 
     * @return string
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_REFUNDED => 'Refunded',
            default => 'Unknown'
        };
    }
    
    /**
     * Get status badge class
     * 
     * @return string
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_SHIPPED => 'primary',
            self::STATUS_DELIVERED => 'success',
            self::STATUS_CANCELLED => 'danger',
            self::STATUS_REFUNDED => 'secondary',
            default => 'light'
        };
    }
    
    /**
     * Get payment status label
     * 
     * @return string
     */
    public function getPaymentStatusLabel(): string
    {
        return match($this->payment_status) {
            self::PAYMENT_PENDING => 'Pending',
            self::PAYMENT_PAID => 'Paid',
            self::PAYMENT_FAILED => 'Failed',
            self::PAYMENT_REFUNDED => 'Refunded',
            default => 'Unknown'
        };
    }
    
    /**
     * Check if order can be cancelled
     * 
     * @return bool
     */
    public function canCancel(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }
    
    /**
     * Check if order can be refunded
     * 
     * @return bool
     */
    public function canRefund(): bool
    {
        return $this->payment_status === self::PAYMENT_PAID && 
               in_array($this->status, [self::STATUS_SHIPPED, self::STATUS_DELIVERED]);
    }
    
    /**
     * Update status
     * 
     * @param string $status
     * @return bool
     */
    public function updateStatus(string $status): bool
    {
        $data = ['status' => $status];
        
        if ($status === self::STATUS_SHIPPED && !$this->shipped_at) {
            $data['shipped_at'] = date('Y-m-d H:i:s');
        }
        
        if ($status === self::STATUS_DELIVERED && !$this->delivered_at) {
            $data['delivered_at'] = date('Y-m-d H:i:s');
        }
        
        return $this->update($data);
    }
    
    /**
     * Update payment status
     * 
     * @param string $status
     * @param string|null $reference
     * @return bool
     */
    public function updatePaymentStatus(string $status, ?string $reference = null): bool
    {
        $data = ['payment_status' => $status];
        
        if ($reference) {
            $data['payment_reference'] = $reference;
        }
        
        return $this->update($data);
    }
    
    /**
     * Add tracking number
     * 
     * @param string $trackingNumber
     * @return bool
     */
    public function addTracking(string $trackingNumber): bool
    {
        return $this->update([
            'tracking_number' => $trackingNumber,
            'status' => self::STATUS_SHIPPED,
            'shipped_at' => date('Y-m-d H:i:s')
        ]);
    }
    
    /**
     * Get shipping address as array
     * 
     * @return array
     */
    public function getShippingAddress(): array
    {
        return [
            'first_name' => $this->shipping_first_name,
            'last_name' => $this->shipping_last_name,
            'address' => $this->shipping_address,
            'city' => $this->shipping_city,
            'state' => $this->shipping_state,
            'country' => $this->shipping_country,
            'postal_code' => $this->shipping_postal_code,
            'phone' => $this->shipping_phone
        ];
    }
    
    /**
     * Get formatted shipping address
     * 
     * @return string
     */
    public function getFormattedAddress(): string
    {
        $parts = [
            $this->shipping_first_name . ' ' . $this->shipping_last_name,
            $this->shipping_address,
            $this->shipping_city . ', ' . $this->shipping_state,
            $this->shipping_country . ' ' . $this->shipping_postal_code
        ];
        
        return implode("\n", array_filter($parts));
    }
    
    /**
     * Generate unique order number
     * 
     * @return string
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'HA';
        $date = date('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        
        return "{$prefix}-{$date}-{$random}";
    }
    
    /**
     * Create order from cart
     * 
     * @param array $cartData
     * @param array $shippingData
     * @param array $paymentData
     * @return static
     * @throws Exception
     */
    public static function createFromCart(array $cartData, array $shippingData, array $paymentData): static
    {
        $db = Database::getInstance();
        
        try {
            $db->beginTransaction();
            
            // Create order
            $orderData = [
                'order_number' => self::generateOrderNumber(),
                'user_id' => $shippingData['user_id'] ?? null,
                'guest_email' => $shippingData['email'] ?? null,
                'guest_phone' => $shippingData['phone'] ?? null,
                'status' => self::STATUS_PENDING,
                'payment_status' => self::PAYMENT_PENDING,
                'payment_method' => $paymentData['method'] ?? null,
                'subtotal' => $cartData['subtotal'],
                'shipping_cost' => $cartData['shipping'],
                'tax_amount' => $cartData['tax'],
                'discount_amount' => $cartData['discount'] ?? 0,
                'total' => $cartData['total'],
                'currency' => $paymentData['currency'] ?? 'GHS',
                'shipping_first_name' => $shippingData['first_name'],
                'shipping_last_name' => $shippingData['last_name'],
                'shipping_address' => $shippingData['address'],
                'shipping_city' => $shippingData['city'],
                'shipping_state' => $shippingData['state'],
                'shipping_country' => $shippingData['country'] ?? 'Ghana',
                'shipping_postal_code' => $shippingData['postal_code'] ?? null,
                'shipping_phone' => $shippingData['phone'],
                'billing_same_as_shipping' => $shippingData['billing_same'] ?? 1,
                'notes' => $shippingData['notes'] ?? null,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $order = self::create($orderData);
            
            // Add order items
            foreach ($cartData['items'] as $item) {
                $db->insert('order_items', [
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'] ?? null,
                    'product_name' => $item['name'],
                    'variant_name' => $item['variant_name'] ?? null,
                    'sku' => $item['sku'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['subtotal'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                
                // Decrease stock
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->decreaseStock($item['quantity']);
                }
            }
            
            $db->commit();
            
            return $order;
            
        } catch (Exception $e) {
            $db->rollback();
            throw $e;
        }
    }
    
    /**
     * Get orders by user
     * 
     * @param int $userId
     * @param int $limit
     * @return array
     */
    public static function getByUser(int $userId, int $limit = 10): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT * FROM orders 
             WHERE user_id = :user_id 
             ORDER BY created_at DESC 
             LIMIT :limit",
            ['user_id' => $userId, 'limit' => $limit]
        );
    }
    
    /**
     * Get recent orders
     * 
     * @param int $limit
     * @return array
     */
    public static function getRecent(int $limit = 10): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT o.*, u.first_name, u.last_name, u.email as user_email
             FROM orders o 
             LEFT JOIN users u ON o.user_id = u.id 
             ORDER BY o.created_at DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
    
    /**
     * Get orders by status
     * 
     * @param string $status
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public static function byStatus(string $status, int $page = 1, int $perPage = 25): array
    {
        $db = Database::getInstance();
        
        $offset = ($page - 1) * $perPage;
        
        $items = $db->fetchAll(
            "SELECT o.*, u.first_name, u.last_name 
             FROM orders o 
             LEFT JOIN users u ON o.user_id = u.id 
             WHERE o.status = :status 
             ORDER BY o.created_at DESC 
             LIMIT :limit OFFSET :offset",
            ['status' => $status, 'limit' => $perPage, 'offset' => $offset]
        );
        
        $total = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM orders WHERE status = :status",
            ['status' => $status]
        );
        
        return [
            'data' => $items,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => (int) ceil($total / $perPage)
        ];
    }
    
    /**
     * Get sales statistics
     * 
     * @param string $period (day, week, month, year)
     * @return array
     */
    public static function getSalesStats(string $period = 'month'): array
    {
        $db = Database::getInstance();
        
        $format = match($period) {
            'day' => '%Y-%m-%d',
            'week' => '%Y-%u',
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m'
        };
        
        return $db->fetchAll(
            "SELECT 
                DATE_FORMAT(created_at, :format) as period,
                COUNT(*) as order_count,
                SUM(total) as total_sales,
                AVG(total) as average_order
             FROM orders 
             WHERE payment_status = 'paid'
             GROUP BY period
             ORDER BY period DESC
             LIMIT 12",
            ['format' => $format]
        );
    }
    
    /**
     * Get dashboard statistics
     * 
     * @return array
     */
    public static function getDashboardStats(): array
    {
        $db = Database::getInstance();
        
        // Today's orders
        $today = $db->fetchOne(
            "SELECT COUNT(*) as count, COALESCE(SUM(total), 0) as total 
             FROM orders 
             WHERE DATE(created_at) = CURDATE()"
        );
        
        // This month
        $month = $db->fetchOne(
            "SELECT COUNT(*) as count, COALESCE(SUM(total), 0) as total 
             FROM orders 
             WHERE MONTH(created_at) = MONTH(CURDATE()) 
             AND YEAR(created_at) = YEAR(CURDATE())"
        );
        
        // Pending orders
        $pending = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM orders WHERE status = 'pending'"
        );
        
        // Total orders
        $total = (int) $db->fetchColumn("SELECT COUNT(*) FROM orders");
        
        // Total revenue
        $revenue = (float) $db->fetchColumn(
            "SELECT COALESCE(SUM(total), 0) FROM orders WHERE payment_status = 'paid'"
        );
        
        return [
            'today_orders' => (int) $today['count'],
            'today_revenue' => (float) $today['total'],
            'month_orders' => (int) $month['count'],
            'month_revenue' => (float) $month['total'],
            'pending_orders' => $pending,
            'total_orders' => $total,
            'total_revenue' => $revenue
        ];
    }
}
