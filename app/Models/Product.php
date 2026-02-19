<?php
/**
 * Hair Aura - Product Model
 * 
 * @package HairAura\Models
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Models;

use App\Core\Database;

class Product extends Model
{
    protected static string $table = 'products';
    protected static string $primaryKey = 'id';
    
    protected static array $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'cost_price',
        'sku',
        'stock_quantity',
        'stock_status',
        'category_id',
        'brand',
        'hair_type',
        'texture',
        'length_inches',
        'weight_grams',
        'cap_size',
        'lace_type',
        'density',
        'color',
        'featured',
        'bestseller',
        'new_arrival',
        'rating_avg',
        'review_count',
        'virtual_try_on',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
     * Find product by slug
     * 
     * @param string $slug
     * @return static|null
     */
    public static function findBySlug(string $slug): ?static
    {
        return static::findBy('slug', $slug);
    }
    
    /**
     * Find product by SKU
     * 
     * @param string $sku
     * @return static|null
     */
    public static function findBySku(string $sku): ?static
    {
        return static::findBy('sku', $sku);
    }
    
    /**
     * Get current price (sale or regular)
     * 
     * @return float
     */
    public function getCurrentPrice(): float
    {
        if ($this->sale_price && $this->sale_price > 0 && $this->sale_price < $this->price) {
            return (float) $this->sale_price;
        }
        return (float) $this->price;
    }
    
    /**
     * Check if product is on sale
     * 
     * @return bool
     */
    public function isOnSale(): bool
    {
        return $this->sale_price && $this->sale_price > 0 && $this->sale_price < $this->price;
    }
    
    /**
     * Get discount percentage
     * 
     * @return int
     */
    public function getDiscountPercent(): int
    {
        if (!$this->isOnSale()) {
            return 0;
        }
        return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
    }
    
    /**
     * Check if in stock
     * 
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->stock_status === 'in_stock' && $this->stock_quantity > 0;
    }
    
    /**
     * Get stock status label
     * 
     * @return string
     */
    public function getStockLabel(): string
    {
        return match($this->stock_status) {
            'in_stock' => $this->stock_quantity > 10 ? 'In Stock' : 'Low Stock',
            'out_of_stock' => 'Out of Stock',
            'backorder' => 'Available on Backorder',
            default => 'Unknown'
        };
    }
    
    /**
     * Get primary image
     * 
     * @return string
     */
    public function getPrimaryImage(): string
    {
        $db = Database::getInstance();
        
        $image = $db->fetchOne(
            "SELECT image_path FROM product_images 
             WHERE product_id = :product_id AND is_primary = 1 
             LIMIT 1",
            ['product_id' => $this->id]
        );
        
        if ($image) {
            $path = $image['image_path'];
            if (str_starts_with($path, 'uploads/') || str_starts_with($path, 'img/')) {
                return '/' . ltrim($path, '/');
            }
            return '/uploads/products/' . $path;
        }
        
        return '/img/product-placeholder.webp';
    }
    
    /**
     * Get all images
     * 
     * @return array
     */
    public function getImages(): array
    {
        $db = Database::getInstance();

        try {
            return $db->fetchAll(
                "SELECT * FROM product_images 
                 WHERE product_id = :product_id 
                 ORDER BY is_primary DESC, sort_order ASC",
                ['product_id' => $this->id]
            );
        } catch (\Throwable $e) {
            if (str_contains($e->getMessage(), 'sort_order')) {
                return $db->fetchAll(
                    "SELECT * FROM product_images 
                     WHERE product_id = :product_id 
                     ORDER BY is_primary DESC, id ASC",
                    ['product_id' => $this->id]
                );
            }

            throw $e;
        }
    }
    
    /**
     * Get category
     * 
     * @return array|null
     */
    public function getCategory(): ?array
    {
        $db = Database::getInstance();
        
        return $db->fetchOne(
            "SELECT * FROM categories WHERE id = :id LIMIT 1",
            ['id' => $this->category_id]
        );
    }
    
    /**
     * Get variants
     * 
     * @return array
     */
    public function getVariants(): array
    {
        $db = Database::getInstance();

        try {
            return $db->fetchAll(
                "SELECT * FROM product_variants 
                 WHERE product_id = :product_id AND is_active = 1 
                 ORDER BY sort_order ASC, id ASC",
                ['product_id' => $this->id]
            );
        } catch (\Throwable $e) {
            // Compatibility fallback for databases that do not have product_variants.sort_order.
            if (str_contains($e->getMessage(), 'sort_order')) {
                return $db->fetchAll(
                    "SELECT * FROM product_variants 
                     WHERE product_id = :product_id AND is_active = 1 
                     ORDER BY id ASC",
                    ['product_id' => $this->id]
                );
            }

            throw $e;
        }
    }
    
    /**
     * Get reviews
     * 
     * @param bool $approvedOnly
     * @param int $limit
     * @return array
     */
    public function getReviews(bool $approvedOnly = true, int $limit = 10): array
    {
        $db = Database::getInstance();
        
        $sql = "SELECT r.*, u.first_name, u.last_name 
                FROM reviews r 
                LEFT JOIN users u ON r.user_id = u.id 
                WHERE r.product_id = :product_id";
        
        if ($approvedOnly) {
            $sql .= " AND r.is_approved = 1";
        }
        
        $sql .= " ORDER BY r.created_at DESC LIMIT :limit";
        
        return $db->fetchAll($sql, ['product_id' => $this->id, 'limit' => $limit]);
    }
    
    /**
     * Get related products
     * 
     * @param int $limit
     * @return array
     */
    public function getRelated(int $limit = 4): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT p.*, 
                (SELECT image_path FROM product_images 
                 WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as primary_image
             FROM products p 
             WHERE p.category_id = :category_id 
                AND p.id != :product_id 
                AND p.is_active = 1 
             ORDER BY p.bestseller DESC, p.rating_avg DESC 
             LIMIT :limit",
            [
                'category_id' => $this->category_id,
                'product_id' => $this->id,
                'limit' => $limit
            ]
        );
    }
    
    /**
     * Decrease stock
     * 
     * @param int $quantity
     * @return bool
     */
    public function decreaseStock(int $quantity): bool
    {
        if ($this->stock_quantity < $quantity) {
            return false;
        }
        
        $newStock = $this->stock_quantity - $quantity;
        
        $this->update([
            'stock_quantity' => $newStock,
            'stock_status' => $newStock > 0 ? 'in_stock' : 'out_of_stock'
        ]);
        
        return true;
    }
    
    /**
     * Increase stock
     * 
     * @param int $quantity
     * @return bool
     */
    public function increaseStock(int $quantity): bool
    {
        $newStock = $this->stock_quantity + $quantity;
        
        $this->update([
            'stock_quantity' => $newStock,
            'stock_status' => 'in_stock'
        ]);
        
        return true;
    }
    
    /**
     * Update rating
     */
    public function updateRating(): void
    {
        $db = Database::getInstance();
        
        $result = $db->fetchOne(
            "SELECT AVG(rating) as avg_rating, COUNT(*) as count 
             FROM reviews 
             WHERE product_id = :product_id AND is_approved = 1",
            ['product_id' => $this->id]
        );
        
        $this->update([
            'rating_avg' => $result['avg_rating'] ?? 0,
            'review_count' => $result['count'] ?? 0
        ]);
    }
    
    /**
     * Get featured products
     * 
     * @param int $limit
     * @return array
     */
    public static function getFeatured(int $limit = 8): array
    {
        $db = Database::getInstance();
        
        $where = "p.featured = 1 AND p.is_active = 1";
        if ($db->hasColumn('products', 'deleted_at')) {
            $where .= " AND p.deleted_at IS NULL";
        }

        return $db->fetchAll(
            "SELECT p.*, 
                (SELECT image_path FROM product_images 
                 WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as primary_image,
                c.name as category_name
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id
             WHERE {$where}
             ORDER BY p.created_at DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
    
    /**
     * Get bestsellers
     * 
     * @param int $limit
     * @return array
     */
    public static function getBestsellers(int $limit = 8): array
    {
        $db = Database::getInstance();
        
        $where = "p.bestseller = 1 AND p.is_active = 1";
        if ($db->hasColumn('products', 'deleted_at')) {
            $where .= " AND p.deleted_at IS NULL";
        }

        return $db->fetchAll(
            "SELECT p.*, 
                (SELECT image_path FROM product_images 
                 WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as primary_image,
                c.name as category_name
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id
             WHERE {$where}
             ORDER BY p.rating_avg DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
    
    /**
     * Get new arrivals
     * 
     * @param int $limit
     * @return array
     */
    public static function getNewArrivals(int $limit = 8): array
    {
        $db = Database::getInstance();
        
        $where = "p.new_arrival = 1 AND p.is_active = 1";
        if ($db->hasColumn('products', 'deleted_at')) {
            $where .= " AND p.deleted_at IS NULL";
        }

        return $db->fetchAll(
            "SELECT p.*, 
                (SELECT image_path FROM product_images 
                 WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as primary_image,
                c.name as category_name
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id
             WHERE {$where}
             ORDER BY p.created_at DESC 
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
    
    /**
     * Search products
     * 
     * @param string $query
     * @param array $filters
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public static function search(string $query, array $filters = [], int $page = 1, int $perPage = 12): array
    {
        $db = Database::getInstance();
        
        $select = "SELECT p.*, 
                    (SELECT image_path FROM product_images 
                     WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as primary_image,
                    c.name as category_name,
                    c.slug as category_slug";
        
        $from = "FROM products p 
                 LEFT JOIN categories c ON p.category_id = c.id";
        
        $where = "WHERE p.is_active = 1";
        if ($db->hasColumn('products', 'deleted_at')) {
            $where .= " AND p.deleted_at IS NULL";
        }
        
        $params = [];
        
        // Search query
        if (!empty($query)) {
            $where .= " AND (p.name LIKE :q1 OR p.description LIKE :q2 OR p.meta_keywords LIKE :q3)";
            $params['q1'] = "%{$query}%";
            $params['q2'] = "%{$query}%";
            $params['q3'] = "%{$query}%";
        }
        
        // Category filter
        if (!empty($filters['category'])) {
            $where .= " AND (c.slug = :category OR c.id = :category_id)";
            $params['category'] = $filters['category'];
            $params['category_id'] = is_numeric($filters['category']) ? $filters['category'] : 0;
        }
        
        // Price range
        if (!empty($filters['min_price'])) {
            $where .= " AND p.price >= :min_price";
            $params['min_price'] = $filters['min_price'];
        }
        if (!empty($filters['max_price'])) {
            $where .= " AND p.price <= :max_price";
            $params['max_price'] = $filters['max_price'];
        }
        
        // Hair type
        if (!empty($filters['hair_type'])) {
            $where .= " AND p.hair_type = :hair_type";
            $params['hair_type'] = $filters['hair_type'];
        }
        
        // Color
        if (!empty($filters['color'])) {
            $where .= " AND p.color = :color";
            $params['color'] = $filters['color'];
        }
        
        // Length
        if (!empty($filters['length'])) {
            $where .= " AND p.length_inches = :length";
            $params['length'] = $filters['length'];
        }
        
        // Texture
        if (!empty($filters['texture'])) {
            $where .= " AND p.texture = :texture";
            $params['texture'] = $filters['texture'];
        }
        
        // Sorting
        $orderBy = match($filters['sort'] ?? 'newest') {
            'price_low' => "ORDER BY p.price ASC",
            'price_high' => "ORDER BY p.price DESC",
            'name' => "ORDER BY p.name ASC",
            'rating' => "ORDER BY p.rating_avg DESC",
            default => "ORDER BY p.created_at DESC"
        };
        
        // Pagination
        $offset = ($page - 1) * $perPage;
        
        // Build Data Query
        $sql = "{$select} {$from} {$where} {$orderBy} LIMIT {$perPage} OFFSET {$offset}";
        $items = $db->fetchAll($sql, $params);
        
        // Build Count Query
        $countSql = "SELECT COUNT(*) {$from} {$where}";
        $total = (int) $db->fetchColumn($countSql, $params);
        
        return [
            'data' => $items,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $perPage > 0 ? (int) ceil($total / $perPage) : 1,
            'has_more' => $perPage > 0 && $page < ceil($total / $perPage)
        ];
    }
    
    /**
     * Get products by category
     * 
     * @param int|string $category
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public static function byCategory($category, int $page = 1, int $perPage = 12): array
    {
        $filters = ['category' => $category];
        return static::search('', $filters, $page, $perPage);
    }
    
    /**
     * Get available filters for category
     * 
     * @param int $categoryId
     * @return array
     */
    public static function getFilters(int $categoryId): array
    {
        $db = Database::getInstance();
        
        $colors = $db->fetchAll(
            "SELECT DISTINCT color FROM products 
             WHERE category_id = :category_id AND color IS NOT NULL ORDER BY color",
            ['category_id' => $categoryId]
        );
        
        $lengths = $db->fetchAll(
            "SELECT DISTINCT length_inches FROM products 
             WHERE category_id = :category_id AND length_inches IS NOT NULL ORDER BY length_inches",
            ['category_id' => $categoryId]
        );
        
        $textures = $db->fetchAll(
            "SELECT DISTINCT texture FROM products 
             WHERE category_id = :category_id AND texture IS NOT NULL ORDER BY texture",
            ['category_id' => $categoryId]
        );
        
        $priceRange = $db->fetchOne(
            "SELECT MIN(price) as min_price, MAX(price) as max_price 
             FROM products WHERE category_id = :category_id",
            ['category_id' => $categoryId]
        );
        
        return [
            'colors' => array_column($colors, 'color'),
            'lengths' => array_column($lengths, 'length_inches'),
            'textures' => array_column($textures, 'texture'),
            'price_range' => $priceRange
        ];
    }
}
