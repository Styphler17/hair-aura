<?php
/**
 * Hair Aura - Cart Session Manager
 * 
 * Handles shopping cart functionality using sessions
 * Supports both guest and logged-in users
 * 
 * @package HairAura\Core
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Core;

use App\Models\Product;
use App\Models\CartItem;

class CartSession
{
    /** @var string Session key for cart */
    private const CART_KEY = 'shopping_cart';
    
    /** @var array Cart items cache */
    private array $items = [];
    
    /** @var bool Whether cart has been loaded */
    private bool $loaded = false;
    
    /**
     * Initialize cart session
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->load();
    }
    
    /**
     * Load cart from session or database
     */
    private function load(): void
    {
        if ($this->loaded) {
            return;
        }
        
        $userId = Auth::id();
        
        if ($userId) {
            // Load from database for logged-in users
            $this->loadFromDatabase($userId);
        } else {
            // Load from session for guests
            $this->items = $_SESSION[self::CART_KEY] ?? [];
        }
        
        $this->loaded = true;
    }
    
    /**
     * Load cart items from database
     * 
     * @param int $userId
     */
    private function loadFromDatabase(int $userId): void
    {
        $items = CartItem::getByUser($userId);
        $this->items = [];
        
        foreach ($items as $item) {
            $key = $this->getItemKey($item['product_id'], $item['variant_id']);
            $this->items[$key] = [
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'added_at' => $item['created_at']
            ];
        }
    }
    
    /**
     * Save cart to session or database
     */
    public function save(): void
    {
        $userId = Auth::id();
        
        if ($userId) {
            // Save to database
            $this->saveToDatabase($userId);
        } else {
            // Save to session
            $_SESSION[self::CART_KEY] = $this->items;
        }
    }
    
    /**
     * Save cart items to database
     * 
     * @param int $userId
     */
    private function saveToDatabase(int $userId): void
    {
        // Clear existing items
        CartItem::clearByUser($userId);
        
        // Insert current items
        foreach ($this->items as $item) {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'] ?: null,
                'quantity' => $item['quantity']
            ]);
        }
    }
    
    /**
     * Add item to cart
     * 
     * @param int $productId Product ID
     * @param int $quantity Quantity to add
     * @param int|null $variantId Variant ID (optional)
     * @return bool Success status
     */
    public function add(int $productId, int $quantity = 1, ?int $variantId = null): bool
    {
        // Validate product exists and is in stock
        $product = Product::find($productId);
        
        if (!$product || !$product->isInStock()) {
            return false;
        }
        
        // Check available stock
        $availableStock = $product->stock_quantity;
        $key = $this->getItemKey($productId, $variantId);
        
        // Check if item already in cart
        $currentQty = $this->items[$key]['quantity'] ?? 0;
        $newQty = $currentQty + $quantity;
        
        if ($newQty > $availableStock) {
            return false;
        }
        
        // Add/update item
        $this->items[$key] = [
            'product_id' => $productId,
            'variant_id' => $variantId,
            'quantity' => $newQty,
            'added_at' => date('Y-m-d H:i:s')
        ];
        
        $this->save();
        return true;
    }
    
    /**
     * Update item quantity
     * 
     * @param int $productId Product ID
     * @param int $quantity New quantity
     * @param int|null $variantId Variant ID
     * @return bool Success status
     */
    public function update(int $productId, int $quantity, ?int $variantId = null): bool
    {
        if ($quantity < 1) {
            return $this->remove($productId, $variantId);
        }
        
        $key = $this->getItemKey($productId, $variantId);
        
        if (!isset($this->items[$key])) {
            return false;
        }
        
        // Check stock
        $product = Product::find($productId);
        if (!$product || $quantity > $product->stock_quantity) {
            return false;
        }
        
        $this->items[$key]['quantity'] = $quantity;
        $this->save();
        
        return true;
    }
    
    /**
     * Remove item from cart
     * 
     * @param int $productId Product ID
     * @param int|null $variantId Variant ID
     * @return bool Success status
     */
    public function remove(int $productId, ?int $variantId = null): bool
    {
        $key = $this->getItemKey($productId, $variantId);
        
        if (!isset($this->items[$key])) {
            return false;
        }
        
        unset($this->items[$key]);
        $this->save();
        
        return true;
    }
    
    /**
     * Get cart item
     * 
     * @param int $productId Product ID
     * @param int|null $variantId Variant ID
     * @return array|null
     */
    public function get(int $productId, ?int $variantId = null): ?array
    {
        $key = $this->getItemKey($productId, $variantId);
        return $this->items[$key] ?? null;
    }
    
    /**
     * Get all cart items with product details
     * 
     * @return array
     */
    public function getItems(): array
    {
        $items = [];
        
        foreach ($this->items as $key => $item) {
            $product = Product::find($item['product_id']);
            
            if (!$product) {
                continue;
            }
            
            $price = $product->getCurrentPrice();
            $quantity = $item['quantity'];
            
            $items[] = [
                'key' => $key,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'product' => $product,
                'name' => $product->name,
                'image' => $product->getPrimaryImage(),
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $price * $quantity,
                'stock' => $product->stock_quantity,
                'added_at' => $item['added_at']
            ];
        }
        
        return $items;
    }
    
    /**
     * Get cart summary
     * 
     * @return array
     */
    public function getSummary(): array
    {
        $items = $this->getItems();
        $subtotal = 0;
        $itemCount = 0;
        
        foreach ($items as $item) {
            $subtotal += $item['subtotal'];
            $itemCount += $item['quantity'];
        }
        
        // Calculate shipping (simplified)
        $shipping = $subtotal > 100 ? 0 : 15;
        
        // Calculate tax (simplified - could be based on location)
        $tax = $subtotal * 0.0; // No tax for Ghana in this example
        
        return [
            'item_count' => $itemCount,
            'unique_items' => count($items),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $subtotal + $shipping + $tax
        ];
    }
    
    /**
     * Get item count
     * 
     * @return int Total items in cart
     */
    public function count(): int
    {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
    
    /**
     * Check if cart is empty
     * 
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }
    
    /**
     * Clear cart
     */
    public function clear(): void
    {
        $this->items = [];
        $this->save();
    }
    
    /**
     * Merge guest cart with user cart on login
     * 
     * @param int $userId
     */
    public function mergeWithUser(int $userId): void
    {
        $guestItems = $this->items;
        
        // Load user's existing cart
        $this->loadFromDatabase($userId);
        
        // Merge guest items
        foreach ($guestItems as $key => $item) {
            if (isset($this->items[$key])) {
                // Update quantity
                $this->items[$key]['quantity'] += $item['quantity'];
            } else {
                // Add new item
                $this->items[$key] = $item;
            }
        }
        
        // Save merged cart
        $this->saveToDatabase($userId);
        
        // Clear session cart
        unset($_SESSION[self::CART_KEY]);
    }
    
    /**
     * Validate cart (check stock availability)
     * 
     * @return array Validation results
     */
    public function validate(): array
    {
        $errors = [];
        
        foreach ($this->items as $key => $item) {
            $product = Product::find($item['product_id']);
            
            if (!$product) {
                $errors[] = "Product no longer available";
                $this->remove($item['product_id'], $item['variant_id']);
                continue;
            }
            
            if (!$product->isInStock()) {
                $errors[] = "{$product->name} is out of stock";
            } elseif ($item['quantity'] > $product->stock_quantity) {
                $errors[] = "Only {$product->stock_quantity} of {$product->name} available";
                $this->update($item['product_id'], $product->stock_quantity, $item['variant_id']);
            }
        }
        
        return $errors;
    }
    
    /**
     * Generate unique key for cart item
     * 
     * @param int $productId
     * @param int|null $variantId
     * @return string
     */
    private function getItemKey(int $productId, ?int $variantId): string
    {
        return $variantId ? "{$productId}:{$variantId}" : (string) $productId;
    }
    
    /**
     * Parse item key into product and variant IDs
     * 
     * @param string $key
     * @return array
     */
    public static function parseItemKey(string $key): array
    {
        $parts = explode(':', $key);
        return [
            'product_id' => (int) $parts[0],
            'variant_id' => isset($parts[1]) ? (int) $parts[1] : null
        ];
    }
}
