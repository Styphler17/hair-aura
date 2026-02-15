<?php
/**
 * Hair Aura - Product Controller
 * 
 * Handles product browsing, search, and details
 * 
 * @package HairAura\Controllers
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Core\Database;

class ProductController extends Controller
{
    /**
     * Shop page - product listing
     */
    public function shop(?string $categorySlug = null): void
    {
        $page = (int) ($this->get('page') ?? 1);
        $perPage = 12;
        
        // Build filters
        $filters = [
            'sort' => $this->get('sort', 'newest'),
            'min_price' => $this->get('min_price') ?: null,
            'max_price' => $this->get('max_price') ?: null,
            'hair_type' => $this->get('hair_type') ?: null,
            'color' => $this->get('color') ?: null,
            'length' => $this->get('length') ?: null,
            'texture' => $this->get('texture') ?: null
        ];
        
        // Get products
        if ($categorySlug) {
            $filters['category'] = $categorySlug;
            
            // Get category info
            $db = Database::getInstance();
            $category = $db->fetchOne(
                "SELECT * FROM categories WHERE slug = :slug AND is_active = 1",
                ['slug' => $categorySlug]
            );
            
            if (!$category) {
                $this->flash('error', 'Category not found');
                $this->redirect('/shop');
            }
            
            // Get available filters for this category
            $availableFilters = Product::getFilters($category['id']);
        } else {
            $category = null;
            $availableFilters = [];
        }
        
        // Search products
        $query = $this->get('q', '');
        $result = Product::search($query, $filters, $page, $perPage);
        
        $products = $result['data'];
        $pagination = [
            'current_page' => $result['current_page'],
            'last_page' => $result['last_page'],
            'total' => $result['total'],
            'has_more' => $result['has_more']
        ];
        
        // Get all categories for sidebar
        $db = Database::getInstance();
        $categories = $db->fetchAll(
            "SELECT c.*, COUNT(p.id) as product_count 
             FROM categories c 
             LEFT JOIN products p ON c.id = p.category_id AND p.is_active = 1
             WHERE c.is_active = 1
             GROUP BY c.id
             ORDER BY c.sort_order"
        );
        
        // SEO
        if ($category) {
            $seo = [
                'title' => $category['meta_title'] ?: $category['name'] . ' | Hair Aura Shop',
                'description' => $category['meta_description'] ?: 'Shop ' . $category['name'] . ' at Hair Aura. Premium quality wigs and hair extensions in Ghana.',
                'keywords' => $category['name'] . ', wigs Ghana, hair extensions',
                'canonical' => '/shop/' . $category['slug']
            ];
        } else {
            $seo = [
                'title' => 'Shop Premium Wigs & Hair Extensions | Hair Aura',
                'description' => 'Browse our collection of premium human hair wigs, lace fronts, synthetic wigs & hair extensions. Find your perfect style at Hair Aura.',
                'keywords' => 'shop wigs, buy wigs Ghana, hair extensions shop, lace front wigs',
                'canonical' => '/shop'
            ];
        }
        
        $this->render('pages/shop', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
            'pagination' => $pagination,
            'filters' => $filters,
            'availableFilters' => $availableFilters,
            'query' => $query,
            'seo' => $seo
        ]);
    }
    
    /**
     * Product detail page
     */
    public function detail(string $slug): void
    {
        $product = Product::findBySlug($slug);
        
        if (!$product || !$product->is_active) {
            $this->flash('error', 'Product not found');
            $this->redirect('/shop');
        }

        $productId = (int) ($product->id ?? 0);
        if ($productId <= 0) {
            $this->flash('error', 'Product not found');
            $this->redirect('/shop');
        }
        
        // Get product images
        $images = $product->getImages();
        
        // Get variants
        $variants = $product->getVariants();
        
        // Get reviews
        $reviews = $product->getReviews(true, 10);
        $ratingDistribution = Review::getRatingDistribution($productId);
        
        // Get related products
        $relatedProducts = $product->getRelated(4);
        
        // Get category
        $category = $product->getCategory();
        
        // Check if in wishlist
        $inWishlist = false;
        if ($this->isLoggedIn) {
            $userId = (int) ($this->user->id ?? 0);
            if ($userId > 0) {
                $inWishlist = $this->user->hasInWishlist($productId);
            }
        }
        
        // Check if user can review
        $canReview = false;
        if ($this->isLoggedIn) {
            $userId = (int) ($this->user->id ?? 0);
            if ($userId > 0) {
                $canReview = Review::canReview($userId, $productId);
            }
        }
        
        // SEO
        $seo = [
            'title' => $product->meta_title ?: $product->name . ' | Hair Aura',
            'description' => $product->meta_description ?: substr(strip_tags($product->short_description ?: $product->description), 0, 160),
            'keywords' => $product->meta_keywords ?: $product->name . ', ' . ($category['name'] ?? 'wigs') . ', Ghana',
            'canonical' => '/product/' . $product->slug,
            'og_image' => $product->getPrimaryImage(),
            'og_type' => 'product'
        ];
        
        // Product schema
        $productSchema = $this->generateProductSchema($product, $reviews);
        
        $this->render('pages/product', [
            'product' => $product,
            'images' => $images,
            'variants' => $variants,
            'reviews' => $reviews,
            'ratingDistribution' => $ratingDistribution,
            'relatedProducts' => $relatedProducts,
            'category' => $category,
            'inWishlist' => $inWishlist,
            'canReview' => $canReview,
            'shareUrl' => $this->absoluteUrl('/product/' . $product->slug),
            'seo' => $seo,
            'productSchema' => $productSchema
        ]);
    }
    
    /**
     * Quick view (AJAX)
     */
    public function quickView(int $id): void
    {
        if (!$this->isAjax()) {
            $this->redirect('/shop');
        }
        
        $product = Product::find($id);
        
        if (!$product) {
            $this->json(['error' => 'Product not found'], 404);
        }
        
        $this->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $product->getCurrentPrice(),
            'original_price' => $product->price,
            'on_sale' => $product->isOnSale(),
            'discount' => $product->getDiscountPercent(),
            'image' => $product->getPrimaryImage(),
            'stock' => $product->stock_quantity,
            'in_stock' => $product->isInStock(),
            'description' => $product->short_description,
            'rating' => $product->rating_avg,
            'review_count' => $product->review_count
        ]);
    }
    
    /**
     * Search products (AJAX)
     */
    public function search(): void
    {
        $query = $this->get('q', '');
        $limit = min((int) $this->get('limit', 8), 20);
        
        if (strlen($query) < 2) {
            $this->json(['products' => [], 'suggestions' => []]);
        }
        
        $result = Product::search($query, [], 1, $limit);
        
        $products = array_map(function($p) {
            return [
                'id' => $p['id'],
                'name' => $p['name'],
                'slug' => $p['slug'],
                'price' => $p['sale_price'] ?: $p['price'],
                'image' => $p['primary_image'] ? '/uploads/products/' . $p['primary_image'] : '/img/product-placeholder.png',
                'category' => $p['category_name']
            ];
        }, $result['data']);
        
        // Get search suggestions
        $db = Database::getInstance();
        $suggestions = $db->fetchAll(
            "SELECT DISTINCT name FROM products 
             WHERE name LIKE :query AND is_active = 1 
             LIMIT 5",
            ['query' => "%{$query}%"]
        );
        
        $this->json([
            'products' => $products,
            'suggestions' => array_column($suggestions, 'name'),
            'total' => $result['total']
        ]);
    }
    
    /**
     * Add review
     */
    public function addReview(int $productId): void
    {
        $this->requireAuth();
        $userId = (int) ($this->user->id ?? 0);
        if ($userId <= 0) {
            $this->flash('error', 'Please login to continue');
            $this->redirect('/login');
        }
        
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/product/' . $this->post('slug'));
        }
        
        // Check if user can review
        if (!Review::canReview($userId, $productId)) {
            $this->flash('error', 'You can only review products you have purchased');
            $this->redirect('/product/' . $this->post('slug'));
        }
        
        $data = $this->post();
        
        $errors = $this->validate($data, [
            'rating' => 'required|integer|min_value:1',
            'comment' => 'required|min:10'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $this->redirect('/product/' . $data['slug'] . '#reviews');
        }
        
        // Create review
        Review::createReview([
            'product_id' => $productId,
            'user_id' => $userId,
            'rating' => (int) $data['rating'],
            'title' => $data['title'] ?? null,
            'comment' => $data['comment']
        ]);
        
        $this->flash('success', 'Thank you for your review! It will be published after approval.');
        $this->redirect('/product/' . $data['slug'] . '#reviews');
    }
    
    /**
     * Stock alert signup
     */
    public function stockAlert(): void
    {
        if (!$this->validateCsrf()) {
            $this->json(['success' => false, 'message' => 'Invalid request']);
        }
        
        $productId = (int) $this->post('product_id');
        $email = $this->post('email');
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'message' => 'Please enter a valid email address']);
        }
        
        $db = Database::getInstance();
        
        try {
            $db->insert('stock_alerts', [
                'product_id' => $productId,
                'email' => $email,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            $this->json(['success' => true, 'message' => 'We will notify you when this item is back in stock!']);
        } catch (\Exception $e) {
            $this->json(['success' => false, 'message' => 'You are already on the notification list']);
        }
    }
    
    /**
     * Generate JSON-LD product schema
     */
    private function generateProductSchema(Product $product, array $reviews): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'image' => $product->getPrimaryImage(),
            'description' => strip_tags($product->short_description ?: $product->description),
            'sku' => $product->sku,
            'brand' => [
                '@type' => 'Brand',
                'name' => $product->brand ?: 'Hair Aura'
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => '/product/' . $product->slug,
                'priceCurrency' => 'GHS',
                'price' => $product->getCurrentPrice(),
                'availability' => $product->isInStock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'itemCondition' => 'https://schema.org/NewCondition'
            ]
        ];
        
        // Add aggregate rating
        if ($product->review_count > 0) {
            $schema['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => $product->rating_avg,
                'reviewCount' => $product->review_count
            ];
        }
        
        // Add reviews
        if (!empty($reviews)) {
            $schema['review'] = array_map(function($review) {
                return [
                    '@type' => 'Review',
                    'reviewRating' => [
                        '@type' => 'Rating',
                        'ratingValue' => $review['rating']
                    ],
                    'author' => [
                        '@type' => 'Person',
                        'name' => $review['first_name'] . ' ' . substr($review['last_name'], 0, 1) . '.'
                    ],
                    'reviewBody' => $review['comment'],
                    'datePublished' => $review['created_at']
                ];
            }, array_slice($reviews, 0, 5));
        }
        
        return $schema;
    }
}
