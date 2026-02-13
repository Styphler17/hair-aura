<?php
/**
 * Hair Aura - Review Model
 * 
 * @package HairAura\Models
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Models;

use App\Core\Database;

class Review extends Model
{
    protected static string $table = 'reviews';
    protected static string $primaryKey = 'id';
    
    protected static array $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'rating',
        'title',
        'comment',
        'is_verified_purchase',
        'is_approved',
        'helpful_count',
        'created_at',
        'updated_at'
    ];
    
    /**
     * Get reviews by product
     * 
     * @param int $productId
     * @param bool $approvedOnly
     * @param int $limit
     * @return array
     */
    public static function getByProduct(int $productId, bool $approvedOnly = true, int $limit = 10): array
    {
        $db = Database::getInstance();
        
        $sql = "SELECT r.*, u.first_name, u.last_name, u.avatar
                FROM reviews r
                LEFT JOIN users u ON r.user_id = u.id
                WHERE r.product_id = :product_id";
        
        if ($approvedOnly) {
            $sql .= " AND r.is_approved = 1";
        }
        
        $sql .= " ORDER BY r.created_at DESC LIMIT :limit";
        
        return $db->fetchAll($sql, ['product_id' => $productId, 'limit' => $limit]);
    }
    
    /**
     * Get reviews by user
     * 
     * @param int $userId
     * @param int $limit
     * @return array
     */
    public static function getByUser(int $userId, int $limit = 10): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT r.*, p.name as product_name, p.slug as product_slug,
                (SELECT image_path FROM product_images 
                 WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as product_image
             FROM reviews r
             JOIN products p ON r.product_id = p.id
             WHERE r.user_id = :user_id
             ORDER BY r.created_at DESC
             LIMIT :limit",
            ['user_id' => $userId, 'limit' => $limit]
        );
    }
    
    /**
     * Get pending reviews (for admin)
     * 
     * @param int $limit
     * @return array
     */
    public static function getPending(int $limit = 20): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT r.*, p.name as product_name, u.first_name, u.last_name
             FROM reviews r
             JOIN products p ON r.product_id = p.id
             LEFT JOIN users u ON r.user_id = u.id
             WHERE r.is_approved = 0
             ORDER BY r.created_at DESC
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
    
    /**
     * Get rating distribution for product
     * 
     * @param int $productId
     * @return array
     */
    public static function getRatingDistribution(int $productId): array
    {
        $db = Database::getInstance();
        
        $results = $db->fetchAll(
            "SELECT rating, COUNT(*) as count
             FROM reviews
             WHERE product_id = :product_id AND is_approved = 1
             GROUP BY rating
             ORDER BY rating DESC",
            ['product_id' => $productId]
        );
        
        $distribution = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        $total = 0;
        
        foreach ($results as $row) {
            $distribution[$row['rating']] = (int) $row['count'];
            $total += $row['count'];
        }
        
        // Calculate percentages
        foreach ($distribution as $rating => $count) {
            $distribution[$rating] = [
                'count' => $count,
                'percentage' => $total > 0 ? round(($count / $total) * 100, 1) : 0
            ];
        }
        
        return $distribution;
    }
    
    /**
     * Get average rating for product
     * 
     * @param int $productId
     * @return float
     */
    public static function getAverageRating(int $productId): float
    {
        $db = Database::getInstance();
        
        return (float) $db->fetchColumn(
            "SELECT COALESCE(AVG(rating), 0) FROM reviews 
             WHERE product_id = :product_id AND is_approved = 1",
            ['product_id' => $productId]
        );
    }
    
    /**
     * Get review count for product
     * 
     * @param int $productId
     * @return int
     */
    public static function getReviewCount(int $productId): int
    {
        $db = Database::getInstance();
        
        return (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM reviews 
             WHERE product_id = :product_id AND is_approved = 1",
            ['product_id' => $productId]
        );
    }
    
    /**
     * Check if user can review product
     * 
     * @param int $userId
     * @param int $productId
     * @return bool
     */
    public static function canReview(int $userId, int $productId): bool
    {
        $db = Database::getInstance();
        
        // Check if user has already reviewed
        $existing = $db->fetchOne(
            "SELECT id FROM reviews WHERE user_id = :user_id AND product_id = :product_id LIMIT 1",
            ['user_id' => $userId, 'product_id' => $productId]
        );
        
        if ($existing) {
            return false;
        }
        
        // Check if user has purchased the product
        $purchased = $db->fetchOne(
            "SELECT oi.id, o.id as order_id
             FROM order_items oi
             JOIN orders o ON oi.order_id = o.id
             WHERE o.user_id = :user_id 
             AND oi.product_id = :product_id
             AND o.status IN ('delivered', 'shipped')
             LIMIT 1",
            ['user_id' => $userId, 'product_id' => $productId]
        );
        
        return $purchased !== null;
    }
    
    /**
     * Check if user has purchased product
     * 
     * @param int $userId
     * @param int $productId
     * @return array|null
     */
    public static function getPurchaseInfo(int $userId, int $productId): ?array
    {
        $db = Database::getInstance();
        
        return $db->fetchOne(
            "SELECT oi.id, o.id as order_id, o.created_at as purchase_date
             FROM order_items oi
             JOIN orders o ON oi.order_id = o.id
             WHERE o.user_id = :user_id 
             AND oi.product_id = :product_id
             AND o.status IN ('delivered', 'shipped')
             ORDER BY o.created_at DESC
             LIMIT 1",
            ['user_id' => $userId, 'product_id' => $productId]
        );
    }
    
    /**
     * Create review
     * 
     * @param array $data
     * @return static
     */
    public static function createReview(array $data): static
    {
        $db = Database::getInstance();
        
        // Check if verified purchase
        $purchaseInfo = self::getPurchaseInfo($data['user_id'], $data['product_id']);
        $isVerified = $purchaseInfo !== null;
        
        $reviewData = [
            'product_id' => $data['product_id'],
            'user_id' => $data['user_id'],
            'order_id' => $purchaseInfo['order_id'] ?? null,
            'rating' => $data['rating'],
            'title' => $data['title'] ?? null,
            'comment' => $data['comment'],
            'is_verified_purchase' => $isVerified ? 1 : 0,
            'is_approved' => 0, // Requires admin approval
            'helpful_count' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        return self::create($reviewData);
    }
    
    /**
     * Approve review
     * 
     * @return bool
     */
    public function approve(): bool
    {
        $result = $this->update(['is_approved' => 1]);
        
        // Update product rating
        $product = Product::find($this->product_id);
        if ($product) {
            $product->updateRating();
        }
        
        return $result;
    }
    
    /**
     * Reject review
     * 
     * @return bool
     */
    public function reject(): bool
    {
        return $this->delete();
    }
    
    /**
     * Mark as helpful
     * 
     * @return bool
     */
    public function markHelpful(): bool
    {
        $db = Database::getInstance();
        
        $db->query(
            "UPDATE reviews SET helpful_count = helpful_count + 1 WHERE id = :id",
            ['id' => $this->id]
        );
        
        return true;
    }
    
    /**
     * Get recent reviews
     * 
     * @param int $limit
     * @return array
     */
    public static function getRecent(int $limit = 10): array
    {
        $db = Database::getInstance();
        
        return $db->fetchAll(
            "SELECT r.*, p.name as product_name, p.slug as product_slug,
                u.first_name, u.last_name
             FROM reviews r
             JOIN products p ON r.product_id = p.id
             LEFT JOIN users u ON r.user_id = u.id
             WHERE r.is_approved = 1
             ORDER BY r.created_at DESC
             LIMIT :limit",
            ['limit' => $limit]
        );
    }
    
    /**
     * Get review statistics
     * 
     * @return array
     */
    public static function getStats(): array
    {
        $db = Database::getInstance();
        
        $total = (int) $db->fetchColumn("SELECT COUNT(*) FROM reviews");
        $pending = (int) $db->fetchColumn("SELECT COUNT(*) FROM reviews WHERE is_approved = 0");
        $approved = (int) $db->fetchColumn("SELECT COUNT(*) FROM reviews WHERE is_approved = 1");
        $average = (float) $db->fetchColumn("SELECT COALESCE(AVG(rating), 0) FROM reviews WHERE is_approved = 1");
        
        return [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'average_rating' => round($average, 1)
        ];
    }
    
    /**
     * Get star rating HTML
     * 
     * @param float $rating
     * @return string
     */
    public static function getStarRating(float $rating): string
    {
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        
        $html = '';
        
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<i class="fas fa-star text-warning"></i>';
        }
        
        if ($halfStar) {
            $html .= '<i class="fas fa-star-half-alt text-warning"></i>';
        }
        
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="far fa-star text-warning"></i>';
        }
        
        return $html;
    }
}
