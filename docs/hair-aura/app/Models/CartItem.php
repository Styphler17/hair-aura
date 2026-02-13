<?php
/**
 * Hair Aura - Cart Item Model
 * 
 * @package HairAura\Models
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Models;

use App\Core\Database;

class CartItem extends Model
{
    protected static string $table = 'cart_items';
    protected static string $primaryKey = 'id';
    
    protected static array $fillable = [
        'user_id',
        'product_id',
        'variant_id',
        'quantity',
        'created_at',
        'updated_at'
    ];
    
    /**
     * Get cart items by user
     * 
     * @param int $userId
     * @return array
     */
    public static function getByUser(int $userId): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT * FROM cart_items WHERE user_id = :user_id ORDER BY created_at DESC",
            ['user_id' => $userId]
        );
    }
    
    /**
     * Get cart item with product details
     * 
     * @param int $userId
     * @param int $productId
     * @param int|null $variantId
     * @return array|null
     */
    public static function getWithProduct(int $userId, int $productId, ?int $variantId = null): ?array
    {
        $db = Database::getInstance();
        
        $sql = "SELECT ci.*, p.name, p.slug, p.price, p.sale_price, p.stock_quantity, p.stock_status,
                    (SELECT image_path FROM product_images 
                     WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as product_image
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                WHERE ci.user_id = :user_id AND ci.product_id = :product_id";
        
        $params = [
            'user_id' => $userId,
            'product_id' => $productId
        ];
        
        if ($variantId) {
            $sql .= " AND ci.variant_id = :variant_id";
            $params['variant_id'] = $variantId;
        } else {
            $sql .= " AND ci.variant_id IS NULL";
        }
        
        return $db->fetchOne($sql, $params);
    }
    
    /**
     * Get full cart with products for user
     * 
     * @param int $userId
     * @return array
     */
    public static function getFullCart(int $userId): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT ci.*, p.name, p.slug, p.price, p.sale_price, p.stock_quantity, p.stock_status,
                    p.sku, p.weight_grams,
                    (SELECT image_path FROM product_images 
                     WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as product_image,
                    pv.variant_name, pv.variant_value, pv.price_adjustment as variant_price
             FROM cart_items ci
             JOIN products p ON ci.product_id = p.id
             LEFT JOIN product_variants pv ON ci.variant_id = pv.id
             WHERE ci.user_id = :user_id
             ORDER BY ci.created_at DESC",
            ['user_id' => $userId]
        );
    }
    
    /**
     * Add or update cart item
     * 
     * @param int $userId
     * @param int $productId
     * @param int $quantity
     * @param int|null $variantId
     * @return bool
     */
    public static function addOrUpdate(int $userId, int $productId, int $quantity, ?int $variantId = null): bool
    {
        $db = Database::getInstance();
        
        // Check if item already exists
        $existing = $db->fetchOne(
            "SELECT id, quantity FROM cart_items 
             WHERE user_id = :user_id AND product_id = :product_id AND variant_id ". ($variantId ? '= :variant_id' : 'IS NULL'),
            array_filter([
                'user_id' => $userId,
                'product_id' => $productId,
                'variant_id' => $variantId
            ])
        );
        
        if ($existing) {
            // Update quantity
            $newQuantity = $existing['quantity'] + $quantity;
            $db->update(
                'cart_items',
                ['quantity' => $newQuantity, 'updated_at' => date('Y-m-d H:i:s')],
                'id = :id',
                ['id' => $existing['id']]
            );
        } else {
            // Insert new item
            $db->insert('cart_items', [
                'user_id' => $userId,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        return true;
    }
    
    /**
     * Update quantity
     * 
     * @param int $itemId
     * @param int $quantity
     * @return bool
     */
    public static function updateQuantity(int $itemId, int $quantity): bool
    {
        $db = Database::getInstance();
        
        if ($quantity <= 0) {
            return $db->delete('cart_items', 'id = :id', ['id' => $itemId]) > 0;
        }
        
        $db->update(
            'cart_items',
            ['quantity' => $quantity, 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $itemId]
        );
        
        return true;
    }
    
    /**
     * Remove item from cart
     * 
     * @param int $itemId
     * @return bool
     */
    public static function remove(int $itemId): bool
    {
        $db = Database::getInstance();
        
        return $db->delete('cart_items', 'id = :id', ['id' => $itemId]) > 0;
    }
    
    /**
     * Clear user cart
     * 
     * @param int $userId
     * @return bool
     */
    public static function clearByUser(int $userId): bool
    {
        $db = Database::getInstance();
        
        $db->delete('cart_items', 'user_id = :user_id', ['user_id' => $userId]);
        
        return true;
    }
    
    /**
     * Get cart count for user
     * 
     * @param int $userId
     * @return int
     */
    public static function getCount(int $userId): int
    {
        $db = Database::getInstance();
        
        return (int) $db->fetchColumn(
            "SELECT COALESCE(SUM(quantity), 0) FROM cart_items WHERE user_id = :user_id",
            ['user_id' => $userId]
        );
    }
    
    /**
     * Get cart total for user
     * 
     * @param int $userId
     * @return float
     */
    public static function getTotal(int $userId): float
    {
        $db = Database::getInstance();
        
        return (float) $db->fetchColumn(
            "SELECT COALESCE(SUM(ci.quantity * COALESCE(p.sale_price, p.price)), 0) 
             FROM cart_items ci
             JOIN products p ON ci.product_id = p.id
             WHERE ci.user_id = :user_id",
            ['user_id' => $userId]
        );
    }
    
    /**
     * Validate cart stock
     * 
     * @param int $userId
     * @return array Array of errors, empty if valid
     */
    public static function validateStock(int $userId): array
    {
        $db = Database::getInstance();
        
        $items = $db->fetchAll(
            "SELECT ci.*, p.name, p.stock_quantity, p.stock_status
             FROM cart_items ci
             JOIN products p ON ci.product_id = p.id
             WHERE ci.user_id = :user_id",
            ['user_id' => $userId]
        );
        
        $errors = [];
        
        foreach ($items as $item) {
            if ($item['stock_status'] !== 'in_stock') {
                $errors[] = "{$item['name']} is out of stock";
            } elseif ($item['quantity'] > $item['stock_quantity']) {
                $errors[] = "Only {$item['stock_quantity']} of {$item['name']} available";
            }
        }
        
        return $errors;
    }
    
    /**
     * Move cart to order items
     * 
     * @param int $userId
     * @param int $orderId
     * @return bool
     */
    public static function moveToOrder(int $userId, int $orderId): bool
    {
        $db = Database::getInstance();
        
        $items = self::getFullCart($userId);
        
        foreach ($items as $item) {
            $price = $item['sale_price'] ?: $item['price'];
            if ($item['variant_price']) {
                $price += $item['variant_price'];
            }
            
            $db->insert('order_items', [
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'product_name' => $item['name'],
                'variant_name' => $item['variant_name'] ? $item['variant_name'] . ': ' . $item['variant_value'] : null,
                'sku' => $item['sku'],
                'quantity' => $item['quantity'],
                'unit_price' => $price,
                'total_price' => $price * $item['quantity'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        // Clear cart
        self::clearByUser($userId);
        
        return true;
    }
}
