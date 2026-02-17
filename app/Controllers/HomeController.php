<?php
/**
 * Hair Aura - Home Controller
 * 
 * Handles homepage and static pages
 * 
 * @package HairAura\Controllers
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Core\Database;

class HomeController extends Controller
{
    /**
     * Homepage
     */
    public function index(): void
    {
        // Get featured products
        $featuredProducts = Product::getFeatured(8);
        
        // Get bestsellers
        $bestsellers = Product::getBestsellers(4);
        
        // Get new arrivals
        $newArrivals = Product::getNewArrivals(4);
        
        // Get categories
        $db = Database::getInstance();
        $categories = $db->fetchAll(
            "SELECT * FROM categories WHERE is_active = 1 ORDER BY sort_order LIMIT 6"
        );
        
        // Get testimonials
        $testimonials = $db->fetchAll(
            "SELECT * FROM testimonials WHERE is_active = 1 AND is_featured = 1 ORDER BY sort_order LIMIT 6"
        );
        
        // SEO data
        $seo = [
            'title' => 'Hair Aura | Premium Wigs & Hair Extensions Ghana',
            'description' => 'Shop premium human hair wigs, lace fronts, synthetic wigs & hair extensions in Ghana. Unlock your aura with perfect wigs. Free delivery in Accra.',
            'keywords' => 'wigs Ghana, human hair wigs, lace front wigs, synthetic wigs, hair extensions, Brazilian hair, Peruvian hair',
            'canonical' => '/',
            'og_image' => '/img/og-image.webp'
        ];
        
        $this->render('pages/home', [
            'featuredProducts' => $featuredProducts,
            'bestsellers' => $bestsellers,
            'newArrivals' => $newArrivals,
            'categories' => $categories,
            'testimonials' => $testimonials,
            'seo' => $seo
        ]);
    }
    
    /**
     * About page
     */
    public function about(): void
    {
        $siteContent = $this->loadSiteContent();

        $seo = [
            'title' => ($siteContent['site']['name'] ?? 'Hair Aura') . ' | About',
            'description' => 'Learn about Hair Aura - Ghana\'s premier destination for premium wigs and hair extensions. Our story, mission, and commitment to quality.',
            'keywords' => 'about hair aura, wig store Ghana, hair company',
            'canonical' => '/about'
        ];
        
        $this->render('pages/about', [
            'seo' => $seo,
            'aboutContent' => $siteContent['about']
        ]);
    }

    /**
     * Blog listing page
     */
    public function blog(): void
    {
        $db = Database::getInstance();
        $posts = [];
        $categories = [];
        $page = max(1, (int) $this->get('page', 1));
        $perPage = 12;
        $selectedCategory = trim((string) $this->get('category', ''));
        $searchQuery = trim((string) $this->get('q', ''));
        $total = 0;
        $lastPage = 1;

        try {
            $conditions = ['bp.is_published = 1'];
            $params = [];

            if ($selectedCategory !== '') {
                $conditions[] = 'bp.category = :category';
                $params['category'] = $selectedCategory;
            }

            if ($searchQuery !== '') {
                $conditions[] = '(bp.title LIKE :query OR bp.excerpt LIKE :query OR bp.content LIKE :query)';
                $params['query'] = '%' . $searchQuery . '%';
            }

            $whereSql = implode(' AND ', $conditions);

            $total = (int) $db->fetchColumn(
                "SELECT COUNT(*) FROM blog_posts bp WHERE {$whereSql}",
                $params
            );

            $lastPage = max(1, (int) ceil($total / $perPage));
            if ($page > $lastPage) {
                $page = $lastPage;
            }

            $offset = ($page - 1) * $perPage;

            $posts = $db->fetchAll(
                "SELECT bp.id, bp.title, bp.slug, bp.excerpt, bp.content, bp.featured_image,
                        COALESCE(bp.category, 'General') as category,
                        bp.published_at, bp.created_at, u.first_name, u.last_name
                 FROM blog_posts bp
                 LEFT JOIN users u ON bp.author_id = u.id
                 WHERE {$whereSql}
                 ORDER BY COALESCE(bp.published_at, bp.created_at) DESC
                 LIMIT {$perPage} OFFSET {$offset}",
                $params
            );

            $categories = $db->fetchAll(
                "SELECT COALESCE(category, 'General') as category, COUNT(*) as post_count
                 FROM blog_posts
                 WHERE is_published = 1
                 GROUP BY category
                 ORDER BY category ASC"
            );
        } catch (\Throwable $e) {
            // Keep page available even if blog table is not yet migrated.
            $posts = [];
            $categories = [];
            $total = 0;
            $lastPage = 1;
        }

        $seo = [
            'title' => 'Hair Aura Blog | Wig Tips, Styling & Care',
            'description' => 'Read Hair Aura blog posts on wig care, styling, hair trends, and beauty tips for customers in Ghana.',
            'keywords' => 'hair aura blog, wig care tips, hairstyle trends ghana',
            'canonical' => '/blog'
        ];

        $this->render('pages/blog', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $searchQuery,
            'pagination' => [
                'current_page' => $page,
                'last_page' => $lastPage,
                'total' => $total,
                'per_page' => $perPage
            ],
            'seo' => $seo
        ]);
    }

    /**
     * Blog detail page
     */
    public function blogDetail(string $slug): void
    {
        $db = Database::getInstance();
        $post = null;
        $categories = [];
        $relatedPosts = [];

        try {
            $post = $db->fetchOne(
                "SELECT bp.*, u.first_name, u.last_name
                 FROM blog_posts bp
                 LEFT JOIN users u ON bp.author_id = u.id
                 WHERE bp.slug = :slug AND bp.is_published = 1
                 LIMIT 1",
                ['slug' => $slug]
            );
        } catch (\Throwable $e) {
            $post = null;
        }

        if (!$post) {
            throw new \Exception('Page not found', 404);
        }

        try {
            $db->query(
                "UPDATE blog_posts SET view_count = view_count + 1 WHERE id = :id",
                ['id' => $post['id']]
            );
        } catch (\Throwable $e) {
            // Non-critical; continue rendering even if this fails.
        }

        try {
            $categories = $db->fetchAll(
                "SELECT COALESCE(category, 'General') as category, COUNT(*) as post_count
                 FROM blog_posts
                 WHERE is_published = 1
                 GROUP BY category
                 ORDER BY category ASC"
            );

            $relatedPosts = $db->fetchAll(
                "SELECT id, title, slug, excerpt, featured_image, category, published_at, created_at
                 FROM blog_posts
                 WHERE is_published = 1
                   AND id != :id
                   AND category = :category
                 ORDER BY COALESCE(published_at, created_at) DESC
                 LIMIT 4",
                [
                    'id' => $post['id'],
                    'category' => $post['category'] ?? 'General'
                ]
            );
        } catch (\Throwable $e) {
            $categories = [];
            $relatedPosts = [];
        }

        $ogImage = '/img/og-image.png';
        $featuredImage = trim((string) ($post['featured_image'] ?? ''));
        if ($featuredImage !== '') {
            if (preg_match('#^https?://#i', $featuredImage)) {
                $ogImage = $featuredImage;
            } elseif (str_starts_with($featuredImage, '/')) {
                $ogImage = $featuredImage;
            } elseif (str_contains($featuredImage, '/')) {
                $ogImage = '/uploads/' . ltrim($featuredImage, '/');
            } else {
                $ogImage = '/uploads/blog/' . ltrim($featuredImage, '/');
            }
        }

        $seo = [
            'title' => $post['meta_title'] ?: ($post['title'] . ' | Hair Aura Blog'),
            'description' => $post['meta_description'] ?: substr(strip_tags($post['excerpt'] ?: $post['content']), 0, 160),
            'canonical' => '/blog/' . $post['slug'],
            'og_image' => $ogImage,
            'og_type' => 'article'
        ];

        $this->render('pages/blog-detail', [
            'post' => $post,
            'categories' => $categories,
            'relatedPosts' => $relatedPosts,
            'seo' => $seo
        ]);
    }

    /**
     * Blog live search (AJAX)
     */
    public function blogSearch(): void
    {
        $query = trim((string) $this->get('q', ''));
        $limit = min((int) $this->get('limit', 8), 20);

        if (strlen($query) < 2) {
            $this->json(['posts' => [], 'total' => 0]);
        }

        $db = Database::getInstance();
        $posts = [];

        try {
            $posts = $db->fetchAll(
                "SELECT id, title, slug, COALESCE(category, 'General') as category, published_at, created_at
                 FROM blog_posts
                 WHERE is_published = 1
                   AND (title LIKE :query OR excerpt LIKE :query OR content LIKE :query)
                 ORDER BY COALESCE(published_at, created_at) DESC
                 LIMIT {$limit}",
                ['query' => '%' . $query . '%']
            );
        } catch (\Throwable $e) {
            $posts = [];
        }

        $this->json([
            'posts' => $posts,
            'total' => count($posts)
        ]);
    }
    
    /**
     * Contact page
     */
    public function contact(): void
    {
        $siteContent = $this->loadSiteContent();

        $seo = [
            'title' => 'Contact Hair Aura | Get in Touch',
            'description' => 'Contact Hair Aura for inquiries about our premium wigs and hair extensions. We\'re here to help you find your perfect look.',
            'keywords' => 'contact hair aura, wig store contact, customer support',
            'canonical' => '/contact'
        ];
        
        $this->render('pages/contact', [
            'seo' => $seo,
            'contactInfo' => $siteContent['contact']
        ]);
    }
    
    /**
     * Process contact form
     */
    public function submitContact(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/contact');
        }
        
        $data = $this->post();
        
        $errors = $this->validate($data, [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $this->redirect('/contact');
        }
        
        // Save contact message
        $db = Database::getInstance();
        try {
            $this->ensureContactMessagesTable($db);
            $db->insert('contact_messages', [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'subject' => $data['subject'],
                'message' => $data['message'],
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (\Throwable $e) {
            error_log('Contact message storage skipped: ' . $e->getMessage());
        }
        
        // TODO: Send email notification
        
        $this->flash('success', 'Thank you for your message! We will get back to you soon.');
        $this->redirect('/contact');
    }
    
    /**
     * FAQ page
     */
    public function faq(): void
    {
        $seo = [
            'title' => 'FAQ | Hair Aura Wig Store',
            'description' => 'Frequently asked questions about Hair Aura wigs, shipping, returns, and care instructions.',
            'keywords' => 'wig FAQ, hair care questions, shipping info',
            'canonical' => '/faq'
        ];
        
        $faqs = [
            [
                'question' => 'How do I choose the right wig size?',
                'answer' => 'Measure your head circumference from hairline to nape and ear to ear. Most wigs come in average size (22-22.5 inches) with adjustable straps for a secure fit.'
            ],
            [
                'question' => 'What is the difference between lace front and full lace wigs?',
                'answer' => 'Lace front wigs have lace only at the front hairline, while full lace wigs have lace covering the entire cap, allowing for more versatile styling including high ponytails.'
            ],
            [
                'question' => 'How long do human hair wigs last?',
                'answer' => 'With proper care, our premium human hair wigs can last 1-2 years or more. Synthetic wigs typically last 4-6 months with regular wear.'
            ],
            [
                'question' => 'Can I dye or style my wig?',
                'answer' => 'Yes! Our human hair wigs can be dyed, bleached, curled, and straightened just like natural hair. Always use heat protectant and professional products.'
            ],
            [
                'question' => 'How long does shipping take?',
                'answer' => 'We offer same-day delivery in Accra and 1-3 day delivery to other regions in Ghana.'
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'We do not accept returns or exchanges. If there is any order issue, contact our support team with your order number for assistance.'
            ]
        ];
        
        $this->render('pages/faq', [
            'faqs' => $faqs,
            'seo' => $seo
        ]);
    }
    
    /**
     * Shipping info page
     */
    public function shipping(): void
    {
        $seo = [
            'title' => 'Shipping Information | Hair Aura',
            'description' => 'Learn about Hair Aura shipping options, delivery times, and tracking information within Ghana.',
            'keywords' => 'shipping Ghana, wig delivery, hair extensions shipping',
            'canonical' => '/shipping'
        ];
        
        $this->render('pages/shipping', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Returns page
     */
    public function returns(): void
    {
        $seo = [
            'title' => 'Order Support Policy | Hair Aura',
            'description' => 'Hair Aura does not accept returns or exchanges. Contact our support team for any order-related issues.',
            'keywords' => 'order support policy, no returns, customer support',
            'canonical' => '/returns'
        ];
        
        $this->render('pages/returns', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Wig care guide
     */
    public function careGuide(): void
    {
        $seo = [
            'title' => 'Wig Care Guide | Hair Aura',
            'description' => 'Learn how to properly care for your human hair and synthetic wigs. Washing, styling, and maintenance tips from Hair Aura experts.',
            'keywords' => 'wig care, hair care tips, wash wig, style wig',
            'canonical' => '/care-guide'
        ];
        
        $this->render('pages/care-guide', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Size guide
     */
    public function sizeGuide(): void
    {
        $seo = [
            'title' => 'Wig Size Guide | Hair Aura',
            'description' => 'Find your perfect wig fit with our comprehensive size guide. Learn how to measure your head for the best fit.',
            'keywords' => 'wig size, cap size, measure head for wig',
            'canonical' => '/size-guide'
        ];
        
        $this->render('pages/size-guide', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Privacy policy
     */
    public function privacy(): void
    {
        $seo = [
            'title' => 'Privacy Policy | Hair Aura',
            'description' => 'Hair Aura privacy policy - how we collect, use, and protect your personal information.',
            'canonical' => '/privacy'
        ];
        
        $this->render('pages/privacy', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Terms of service
     */
    public function terms(): void
    {
        $seo = [
            'title' => 'Terms of Service | Hair Aura',
            'description' => 'Hair Aura terms of service and conditions of use.',
            'canonical' => '/terms'
        ];
        
        $this->render('pages/terms', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Sitemap
     */
    public function sitemap(): void
    {
        header('Content-Type: application/xml');
        
        $db = Database::getInstance();
        
        // Get all products
        $products = $db->fetchAll("SELECT slug, updated_at FROM products WHERE is_active = 1");
        
        // Get all categories
        $categories = $db->fetchAll("SELECT slug, updated_at FROM categories WHERE is_active = 1");
        
        // Get all blog posts
        $posts = $db->fetchAll("SELECT slug, updated_at FROM blog_posts WHERE is_published = 1");
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Static pages
        $staticPages = ['', 'about', 'contact', 'faq', 'shipping', 'returns', 'shop', 'blog'];
        foreach ($staticPages as $page) {
            $xml .= $this->sitemapUrl(($page ? '/' . $page : '/'), '1.0', 'daily');
        }
        
        // Products
        foreach ($products as $product) {
            $xml .= $this->sitemapUrl('/product/' . $product['slug'], '0.8', 'weekly', $product['updated_at']);
        }
        
        // Categories
        foreach ($categories as $category) {
            $xml .= $this->sitemapUrl('/shop/' . $category['slug'], '0.7', 'weekly', $category['updated_at']);
        }
        
        // Blog posts
        foreach ($posts as $post) {
            $xml .= $this->sitemapUrl('/blog/' . $post['slug'], '0.6', 'monthly', $post['updated_at']);
        }
        
        $xml .= '</urlset>';
        
        echo $xml;
        exit;
    }
    
    /**
     * Generate sitemap URL entry
     */
    private function sitemapUrl(string $loc, string $priority, string $changefreq, ?string $lastmod = null): string
    {
        $url = $this->absoluteUrl($loc);
        $xml = "  <url>\n";
        $xml .= "    <loc>{$url}</loc>\n";
        if ($lastmod) {
            $xml .= "    <lastmod>" . date('Y-m-d', strtotime($lastmod)) . "</lastmod>\n";
        }
        $xml .= "    <changefreq>{$changefreq}</changefreq>\n";
        $xml .= "    <priority>{$priority}</priority>\n";
        $xml .= "  </url>\n";
        return $xml;
    }
    
    /**
     * Robots.txt
     */
    public function robots(): void
    {
        header('Content-Type: text/plain');
        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /admin/\n";
        echo "Disallow: /cart/\n";
        echo "Disallow: /checkout/\n";
        echo "Disallow: /account/\n";
        echo "Sitemap: " . $this->absoluteUrl('/sitemap.xml') . "\n";
        exit;
    }
    
    /**
     * Newsletter signup
     */
    public function newsletter(): void
    {
        if (!$this->validateCsrf()) {
            $this->json(['success' => false, 'message' => 'Invalid request']);
        }
        
        $email = $this->post('email');
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'message' => 'Please enter a valid email address']);
        }
        
        $db = Database::getInstance();
        
        try {
            $db->insert('newsletter_subscribers', [
                'email' => $email,
                'subscribed_at' => date('Y-m-d H:i:s')
            ]);
            
            $this->json(['success' => true, 'message' => 'Thank you for subscribing!']);
        } catch (\Exception $e) {
            // Email already subscribed
            $this->json(['success' => true, 'message' => 'You are already subscribed!']);
        }
    }

    /**
     * Load editable site content configuration.
     *
     * @return array
     */
    private function loadSiteContent(): array
    {
        $defaults = [
            'about' => [
                'title' => 'About Hair Aura',
                'content' => "Hair Aura is a premium wig and hair extensions brand focused on quality, confidence, and everyday beauty.\n\nWe source high-quality products and provide practical support so you can find styles that fit your look and lifestyle.\n\nOur mission is simple: make premium hair accessible, reliable, and elegant.",
                'button_text' => 'Shop Collection',
                'button_url' => '/shop'
            ],
            'contact' => [
                'email' => 'support@hair-aura.debesties.com',
                'phone' => '+233508007873',
                'whatsapp' => '+233508007873',
                'location' => 'Accra, Ghana',
                'business_hours' => 'Mon - Sat, 8:00 AM - 6:00 PM'
            ],
            'site' => [
                'name' => 'Hair Aura',
                'tagline' => 'Unlock Your Aura with Perfect Wigs',
                'meta_description' => 'Premium wigs and hair extensions in Ghana.',
                'meta_keywords' => 'wigs Ghana, hair extensions, lace fronts',
                'theme_primary' => '#D4A574',
                'theme_primary_dark' => '#B8935F',
                'theme_secondary' => '#2C2C2C',
                'theme_gold' => '#D4AF37'
            ]
        ];

        $path = __DIR__ . '/../../config/site-content.php';
        if (!file_exists($path)) {
            return $defaults;
        }

        $data = require $path;
        if (!is_array($data)) {
            return $defaults;
        }

        return [
            'about' => array_merge($defaults['about'], (array) ($data['about'] ?? [])),
            'contact' => array_merge($defaults['contact'], (array) ($data['contact'] ?? [])),
            'site' => array_merge($defaults['site'], (array) ($data['site'] ?? []))
        ];
    }

    /**
     * Create contact_messages table if missing.
     */
    private function ensureContactMessagesTable(Database $db): void
    {
        $db->query(
            "CREATE TABLE IF NOT EXISTS contact_messages (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(120) NOT NULL,
                email VARCHAR(190) NOT NULL,
                phone VARCHAR(30) DEFAULT NULL,
                subject VARCHAR(190) NOT NULL,
                message TEXT NOT NULL,
                is_read TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_contact_created_at (created_at),
                INDEX idx_contact_is_read (is_read)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
    }
}
