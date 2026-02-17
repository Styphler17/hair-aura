<?php
/**
 * Hair Aura - Admin Controller
 * 
 * Handles admin dashboard and management functions
 * 
 * @package HairAura\Controllers
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use App\Core\Database;
use App\Core\Auth;

class AdminController extends Controller
{
    /**
     * Constructor - ensure admin access
     */
    public function __construct()
    {
        parent::__construct();

        $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
        if (str_ends_with($currentPath, '/admin/login')) {
            return;
        }

        $this->requireAdmin();
    }
    
    /**
     * Admin dashboard
     */
    public function dashboard(): void
    {
        // Get statistics
        $stats = Order::getDashboardStats();
        
        // Get recent orders
        $recentOrders = Order::getRecent(10);
        
        // Get recent customers
        $recentCustomers = User::getRecentCustomers(5);
        
        // Get pending reviews
        $pendingReviews = Review::getPending(5);
        
        // Get low stock products
        $db = Database::getInstance();
        $lowStock = $db->fetchAll(
            "SELECT p.*, c.name as category_name 
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id
             WHERE p.stock_quantity <= 5 AND p.is_active = 1
             ORDER BY p.stock_quantity ASC
             LIMIT 10"
        );
        
        // Get sales chart data (last 30 days)
        $salesData = $db->fetchAll(
            "SELECT DATE(created_at) as date, COUNT(*) as orders, SUM(total) as revenue
             FROM orders
             WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
             AND payment_status = 'paid'
             GROUP BY DATE(created_at)
             ORDER BY date"
        );
        
        $this->render('admin/dashboard', [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'recentCustomers' => $recentCustomers,
            'pendingReviews' => $pendingReviews,
            'lowStock' => $lowStock,
            'salesData' => $salesData
        ], 'layouts/admin');
    }
    
    // ==================== PRODUCTS ====================
    
    /**
     * Products list
     */
    public function products(): void
    {
        $page = (int) ($this->get('page') ?? 1);
        $search = $this->get('search', '');
        $category = $this->get('category', '');
        
        $db = Database::getInstance();
        
        $where = "WHERE 1=1";
        $params = [];
        
        if ($search) {
            $where .= " AND (p.name LIKE :search OR p.sku LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if ($category) {
            $where .= " AND p.category_id = :category";
            $params['category'] = $category;
        }
        
        $perPage = 25;
        $offset = ($page - 1) * $perPage;
        
        $products = $db->fetchAll(
            "SELECT p.*, c.name as category_name,
                (SELECT image_path FROM product_images WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as image
             FROM products p
             LEFT JOIN categories c ON p.category_id = c.id
             {$where}
             ORDER BY p.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}",
            $params
        );
        
        $total = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM products p {$where}",
            $params
        );
        
        $categories = $db->fetchAll("SELECT id, name FROM categories WHERE is_active = 1 ORDER BY name");
        
        $this->render('admin/products/index', [
            'products' => $products,
            'categories' => $categories,
            'pagination' => [
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'total' => $total
            ],
            'search' => $search,
            'categoryFilter' => $category
        ], 'layouts/admin');
    }
    
    /**
     * Add product page
     */
    public function addProduct(): void
    {
        $db = Database::getInstance();
        $categories = $db->fetchAll("SELECT * FROM categories WHERE is_active = 1 ORDER BY name");
        
        $this->render('admin/products/form', [
            'categories' => $categories,
            'product' => null,
            'mediaImages' => $this->getMediaImageOptions($db)
        ], 'layouts/admin');
    }
    
    /**
     * Edit product page
     */
    public function editProduct(int $id): void
    {
        $product = Product::find($id);
        
        if (!$product) {
            $this->flash('error', 'Product not found');
            $this->redirect('/admin/products');
        }
        
        $db = Database::getInstance();
        $categories = $db->fetchAll("SELECT * FROM categories WHERE is_active = 1 ORDER BY name");
        $images = $product->getImages();
        $variants = $product->getVariants();
        
        $this->render('admin/products/form', [
            'categories' => $categories,
            'product' => $product,
            'images' => $images,
            'variants' => $variants,
            'mediaImages' => $this->getMediaImageOptions($db)
        ], 'layouts/admin');
    }
    
    /**
     * Save product
     */
    public function saveProduct(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/products');
        }
        
        $data = $this->post();
        $id = $data['id'] ?? null;
        
        // Validation
        $errors = $this->validate($data, [
            'name' => 'required|min:3',
            'slug' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'stock_quantity' => 'required|integer'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $this->redirect($id ? "/admin/products/edit/{$id}" : '/admin/products/add');
        }
        
        $productData = [
            'name' => $data['name'],
            'slug' => !empty($data['slug']) ? $data['slug'] : strtolower(trim((string) preg_replace('/[^a-z0-9]+/i', '-', (string) $data['name']), '-')),
            'description' => $data['description'] ?? '',
            'short_description' => $data['short_description'] ?? '',
            'price' => $data['price'],
            'sale_price' => $data['sale_price'] ?: null,
            'sku' => $data['sku'] ?? '',
            'stock_quantity' => $data['stock_quantity'],
            'stock_status' => $data['stock_status'] ?? 'in_stock',
            'category_id' => $data['category_id'],
            'brand' => $data['brand'] ?? null,
            'hair_type' => $data['hair_type'] ?? null,
            'texture' => $data['texture'] ?? null,
            'length_inches' => $data['length_inches'] ?: null,
            'weight_grams' => $data['weight_grams'] ?: null,
            'cap_size' => $data['cap_size'] ?? null,
            'lace_type' => $data['lace_type'] ?? null,
            'density' => $data['density'] ?? null,
            'color' => $data['color'] ?? null,
            'featured' => isset($data['featured']) ? 1 : 0,
            'bestseller' => isset($data['bestseller']) ? 1 : 0,
            'new_arrival' => isset($data['new_arrival']) ? 1 : 0,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'is_active' => isset($data['is_active']) ? 1 : 0
        ];
        
        if ($id) {
            $product = Product::find($id);
            if (!$product) {
                $this->flash('error', 'Product not found');
                $this->redirect('/admin/products');
            }
            $product->update($productData);
            $this->flash('success', 'Product updated successfully');
        } else {
            $product = Product::create($productData);
            if (!$product || (int) ($product->id ?? 0) <= 0) {
                $this->flash('error', 'Unable to create product');
                $this->redirect('/admin/products');
            }
            $this->flash('success', 'Product created successfully');
        }
        
        // Handle image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $this->uploadProductImages((int) $product->id);
        }

        $libraryImages = array_filter((array) ($data['library_images'] ?? []));
        if (!empty($libraryImages)) {
            $this->attachLibraryImagesToProduct((int) $product->id, $libraryImages);
        }
        
        $this->redirect('/admin/products/edit/' . (int) $product->id);
    }
    
    public function deleteProductImage(int $imageId): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/products');
        }

        $db = Database::getInstance();
        $image = $db->fetchOne("SELECT * FROM product_images WHERE id = :id LIMIT 1", ['id' => $imageId]);

        if ($image) {
            $productId = $image['product_id'];
            $db->delete('product_images', 'id = :id', ['id' => $imageId]);
            
            // If primary image was deleted, promote another one
            if ($image['is_primary']) {
                $nextImage = $db->fetchOne(
                    "SELECT id FROM product_images WHERE product_id = :product_id ORDER BY sort_order ASC LIMIT 1",
                    ['product_id' => $productId]
                );
                if ($nextImage) {
                    $db->update('product_images', ['is_primary' => 1], 'id = :id', ['id' => $nextImage['id']]);
                }
            }

            $this->flash('success', 'Image removed');
            $this->redirect('/admin/products/edit/' . $productId);
        }

        $this->redirect('/admin/products');
    }

    /**
     * Delete product
     */
    public function deleteProduct(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/products');
        }
        
        $product = Product::find($id);
        
        if ($product) {
            $product->update(['is_active' => 0]);
            $this->flash('success', 'Product deleted successfully');
        }
        
        $this->redirect('/admin/products');
    }
    
    /**
     * Upload product images
     */
    private function uploadProductImages(int $productId): void
    {
        $files = $_FILES['images'];
        if (!isset($files['name'][0])) {
            return;
        }

        $count = count($files['name']);
        
        for ($i = 0; $i < $count; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            // Construct single file array for ImageManager
            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            ];

            // Use ImageManager to upload and convert
            // Prefix filename to ensure uniqueness
            $filename = \App\Core\ImageManager::upload($file, 'uploads/products/', null);

            if ($filename) {
                // Determine sort order
                $db = Database::getInstance();
                $sort = (int) $db->fetchColumn(
                    "SELECT COALESCE(MAX(sort_order), -1) + 1 FROM product_images WHERE product_id = :pid", 
                    ['pid' => $productId]
                );

                // Determine if primary (first image uploaded for this product?)
                $hasPrimary = (int) $db->fetchColumn(
                    "SELECT COUNT(*) FROM product_images WHERE product_id = :pid AND is_primary = 1",
                    ['pid' => $productId]
                );

                $db->insert('product_images', [
                    'product_id' => $productId,
                    'image_path' => $filename, // Now a .webp file usually
                    'alt_text' => pathinfo($files['name'][$i], PATHINFO_FILENAME),
                    'is_primary' => ($hasPrimary === 0 && $i === 0) ? 1 : 0,
                    'sort_order' => $sort
                ]);
            }
        }
    }

    private function attachLibraryImagesToProduct(int $productId, array $libraryPaths): void
    {
        $db = Database::getInstance();
        $sortOrder = 0;

        try {
            $sortOrder = (int) $db->fetchColumn(
                "SELECT COALESCE(MAX(sort_order), 0) FROM product_images WHERE product_id = :product_id",
                ['product_id' => $productId]
            );
        } catch (\Throwable $e) {
            $sortOrder = 0;
        }

        $hasAnyImage = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM product_images WHERE product_id = :product_id",
            ['product_id' => $productId]
        ) > 0;

        foreach ($libraryPaths as $rawPath) {
            $resolvedFilename = $this->resolveMediaPathToFolder((string) $rawPath, 'products');
            if ($resolvedFilename === null || $resolvedFilename === '') {
                continue;
            }

            $alreadyExists = (int) $db->fetchColumn(
                "SELECT COUNT(*) FROM product_images WHERE product_id = :product_id AND image_path = :image_path",
                [
                    'product_id' => $productId,
                    'image_path' => $resolvedFilename
                ]
            ) > 0;
            if ($alreadyExists) {
                continue;
            }

            $sortOrder++;
            $isPrimary = $hasAnyImage ? 0 : 1;
            $payload = [
                'product_id' => $productId,
                'image_path' => $resolvedFilename,
                'alt_text' => pathinfo($resolvedFilename, PATHINFO_FILENAME),
                'is_primary' => $isPrimary,
                'sort_order' => $sortOrder
            ];

            try {
                $db->insert('product_images', $payload);
            } catch (\Throwable $e) {
                unset($payload['sort_order']);
                $db->insert('product_images', $payload);
            }

            $hasAnyImage = true;
        }
    }

    private function resolveMediaPathToFolder(string $rawPath, string $targetFolder): ?string
    {
        $value = trim($rawPath);
        if ($value === '' || preg_match('#^https?://#i', $value)) {
            return null;
        }

        $clean = ltrim(str_replace('\\', '/', $value), '/');
        $publicRoot = __DIR__ . '/../../public/';
        
        // 1. If file exists at exact path (e.g. 'uploads/media/file.webp'), link to it relatively
        if (is_file($publicRoot . $clean)) {
            $folder = trim($targetFolder, '/\\'); // e.g. 'products'
            $targetPrefix = 'uploads/' . $folder . '/'; // e.g. 'uploads/products/'
            
            // If strictly inside target folder, return basename
            if (str_starts_with($clean, $targetPrefix)) {
                return substr($clean, strlen($targetPrefix));
            }
            
            // Calculate relative path from target folder
            // From 'uploads/products/' to root is '../../'
            if (str_starts_with($clean, 'uploads/')) {
                // e.g. 'uploads/media/foo.webp' -> '../media/foo.webp'
                return '../' . substr($clean, 8); 
            }
            
            return '../../' . $clean;
        }

        // 2. Fallback: Copy logic (for legacy inputs or bare filenames)
        $basename = basename($clean);
        if ($basename === '') {
            return null;
        }

        $folder = trim($targetFolder, '/\\');
        $targetDir = $publicRoot . 'uploads/' . $folder . '/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $sourceCandidates = [
            $publicRoot . $clean,
            $publicRoot . 'uploads/' . $clean,
            $publicRoot . 'uploads/' . $basename,
            $publicRoot . 'uploads/' . $folder . '/' . $basename
        ];

        $sourcePath = null;
        foreach ($sourceCandidates as $candidate) {
            if (is_file($candidate)) {
                $sourcePath = $candidate;
                break;
            }
        }

        $targetPath = $targetDir . $basename;
        if (!is_file($targetPath)) {
            if ($sourcePath === null || !@copy($sourcePath, $targetPath)) {
                return null; // File not found anywhere
            }
        }

        return $basename;
    }

    private function getMediaImageOptions(Database $db, int $limit = 300): array
    {
        if (!$this->tableExists($db, 'media_library')) {
            return [];
        }

        try {
            return $db->fetchAll(
                "SELECT id, file_name, file_path, folder, mime_type, created_at
                 FROM media_library
                 WHERE mime_type LIKE 'image/%'
                 ORDER BY created_at DESC
                 LIMIT {$limit}"
            );
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function tableExists(Database $db, string $table): bool
    {
        try {
            $count = (int) $db->fetchColumn(
                'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table',
                ['table' => $table]
            );
            return $count > 0;
        } catch (\Throwable $e) {
            return false;
        }
    }
    
    // ==================== ORDERS ====================
    
    /**
     * Orders list
     */
    public function orders(): void
    {
        $page = (int) ($this->get('page') ?? 1);
        $status = $this->get('status', '');
        
        if ($status) {
            $result = Order::byStatus($status, $page, 25);
        } else {
            $db = Database::getInstance();
            $offset = ($page - 1) * 25;
            
            $items = $db->fetchAll(
                "SELECT o.*, u.first_name, u.last_name, u.email as user_email
                 FROM orders o
                 LEFT JOIN users u ON o.user_id = u.id
                 ORDER BY o.created_at DESC
                 LIMIT 25 OFFSET {$offset}"
            );
            
            $total = (int) $db->fetchColumn("SELECT COUNT(*) FROM orders");
            
            $result = [
                'data' => $items,
                'current_page' => $page,
                'last_page' => (int) ceil($total / 25),
                'total' => $total
            ];
        }
        
        $this->render('admin/orders/index', [
            'orders' => $result['data'],
            'pagination' => $result,
            'statusFilter' => $status
        ], 'layouts/admin');
    }
    
    /**
     * Order detail
     */
    public function orderDetail(int $id): void
    {
        $order = Order::find($id);
        
        if (!$order) {
            $this->flash('error', 'Order not found');
            $this->redirect('/admin/orders');
        }
        
        $items = $order->getItems();
        $user = $order->getUser();
        
        $this->render('admin/orders/detail', [
            'order' => $order,
            'items' => $items,
            'user' => $user
        ], 'layouts/admin');
    }
    
    /**
     * Update order status
     */
    public function updateOrderStatus(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/orders');
        }
        
        $order = Order::find($id);
        
        if (!$order) {
            $this->flash('error', 'Order not found');
            $this->redirect('/admin/orders');
        }
        
        $status = $this->post('status');
        $trackingNumber = $this->post('tracking_number');
        
        if ($trackingNumber) {
            $order->addTracking($trackingNumber);
        } else {
            $order->updateStatus($status);
        }
        
        $this->flash('success', 'Order updated successfully');
        $this->redirect('/admin/orders/' . $id);
    }
    
    // ==================== CUSTOMERS ====================
    
    /**
     * Customers list
     */
    public function customers(): void
    {
        $page = (int) ($this->get('page') ?? 1);
        $search = $this->get('search', '');
        
        $db = Database::getInstance();
        
        $where = "WHERE role = 'customer'";
        $params = [];
        
        if ($search) {
            $where .= " AND (first_name LIKE :search OR last_name LIKE :search OR email LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        $perPage = 25;
        $offset = ($page - 1) * $perPage;
        
        $customers = $db->fetchAll(
            "SELECT u.*, 
                (SELECT COUNT(*) FROM orders WHERE user_id = u.id) as order_count,
                (SELECT COALESCE(SUM(total), 0) FROM orders WHERE user_id = u.id AND payment_status = 'paid') as total_spent
             FROM users u
             {$where}
             ORDER BY u.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}",
            $params
        );
        
        $total = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM users u {$where}",
            $params
        );
        
        $this->render('admin/customers/index', [
            'customers' => $customers,
            'pagination' => [
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'total' => $total
            ],
            'search' => $search
        ], 'layouts/admin');
    }
    
    /**
     * Customer detail
     */
    public function customerDetail(int $id): void
    {
        $customer = User::find($id);
        
        if (!$customer || $customer->role !== 'customer') {
            $this->flash('error', 'Customer not found');
            $this->redirect('/admin/customers');
        }
        
        $orders = $customer->getOrders(10);
        $addresses = $customer->getAddresses();
        
        $this->render('admin/customers/detail', [
            'customer' => $customer,
            'orders' => $orders,
            'addresses' => $addresses
        ], 'layouts/admin');
    }
    
    // ==================== REVIEWS ====================
    
    /**
     * Reviews list
     */
    public function reviews(): void
    {
        $page = (int) ($this->get('page') ?? 1);
        $status = $this->get('status', 'pending');
        
        $db = Database::getInstance();
        
        $where = $status === 'pending' ? "WHERE r.is_approved = 0" : "WHERE r.is_approved = 1";
        
        $perPage = 25;
        $offset = ($page - 1) * $perPage;
        
        $reviews = $db->fetchAll(
            "SELECT r.*, p.name as product_name, p.slug as product_slug,
                u.first_name, u.last_name
             FROM reviews r
             JOIN products p ON r.product_id = p.id
             LEFT JOIN users u ON r.user_id = u.id
             {$where}
             ORDER BY r.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}"
        );
        
        $total = (int) $db->fetchColumn(
            "SELECT COUNT(*) FROM reviews r {$where}"
        );
        
        $this->render('admin/reviews/index', [
            'reviews' => $reviews,
            'pagination' => [
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'total' => $total
            ],
            'status' => $status
        ], 'layouts/admin');
    }
    
    /**
     * Approve review
     */
    public function approveReview(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/reviews');
        }
        
        $review = Review::find($id);
        
        if ($review) {
            $review->approve();
            $this->flash('success', 'Review approved');
        }
        
        $this->redirect('/admin/reviews');
    }
    
    /**
     * Reject review
     */
    public function rejectReview(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/reviews');
        }
        
        $review = Review::find($id);
        
        if ($review) {
            $review->reject();
            $this->flash('success', 'Review rejected');
        }
        
        $this->redirect('/admin/reviews');
    }
    
    // ==================== CATEGORIES ====================
    
    /**
     * Categories list
     */
    public function categories(): void
    {
        $db = Database::getInstance();
        
        $categories = $db->fetchAll(
            "SELECT c.*, COUNT(p.id) as product_count
             FROM categories c
             LEFT JOIN products p ON c.id = p.category_id AND p.is_active = 1
             GROUP BY c.id
             ORDER BY c.sort_order"
        );
        
        $this->render('admin/categories/index', [
            'categories' => $categories,
            'mediaImages' => $this->getMediaImageOptions($db, 400)
        ], 'layouts/admin');
    }
    
    /**
     * Save category
     */
    public function saveCategory(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/categories');
        }
        
        $data = $this->post();
        $id = $data['id'] ?? null;
        $db = Database::getInstance();

        $currentCategory = null;
        if (!empty($id)) {
            $currentCategory = $db->fetchOne(
                'SELECT id, image FROM categories WHERE id = :id LIMIT 1',
                ['id' => (int) $id]
            );

            if (!$currentCategory) {
                $this->flash('error', 'Category not found');
                $this->redirect('/admin/categories');
            }
        }

        $currentImage = (string) ($currentCategory['image'] ?? '');
        $uploadedImage = $this->uploadCategoryImage('image_file');
        $removeImage = !empty($data['remove_image']);
        $libraryImage = trim((string) ($data['library_image'] ?? ''));
        $nextImage = $currentImage;

        if ($uploadedImage !== null) {
            $nextImage = $uploadedImage;
            if ($currentImage !== '') {
                $this->deleteCategoryImageFile($currentImage);
            }
        } elseif ($removeImage && $currentImage !== '') {
            $this->deleteCategoryImageFile($currentImage);
            $nextImage = '';
        } elseif ($libraryImage !== '') {
            $resolvedImage = $this->resolveMediaPathToFolder($libraryImage, 'categories');
            if ($resolvedImage !== null) {
                $nextImage = $resolvedImage;
                if ($currentImage !== '' && $currentImage !== $nextImage) {
                    $this->deleteCategoryImageFile($currentImage);
                }
            }
        }
        
        $categoryData = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? '',
            'image' => $nextImage !== '' ? $nextImage : null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => isset($data['is_active']) ? 1 : 0,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null
        ];
        
        if ($id) {
            $db->update('categories', $categoryData, 'id = :id', ['id' => $id]);
            $this->flash('success', 'Category updated');
        } else {
            $db->insert('categories', $categoryData);
            $this->flash('success', 'Category created');
        }
        
        $this->redirect('/admin/categories');
    }

    private function uploadCategoryImage(string $inputName): ?string
    {
        if (!isset($_FILES[$inputName])) {
            return null;
        }

        $file = $_FILES[$inputName];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Use ImageManager to upload and convert
        // Prefix with 'cat_'
        return \App\Core\ImageManager::upload($file, 'uploads/categories/', 'cat_');
    }

    private function deleteCategoryImageFile(string $image): void
    {
        $imageName = basename($image);
        if ($imageName === '') {
            return;
        }

        $uploadDir = __DIR__ . '/../../public/uploads/categories/';
        $path = $uploadDir . $imageName;
        if (is_file($path)) {
            @unlink($path);
        }
    }
    
    // ==================== SETTINGS ====================
    
    /**
     * Settings page
     */
    public function settings(): void
    {
        $this->render('admin/settings', [
            'config' => require __DIR__ . '/../../config/app.php'
        ], 'layouts/admin');
    }
    
    /**
     * Admin login
     */
    public function login(): void
    {
        if (Auth::check() && Auth::isAdmin()) {
            $this->redirect('/admin');
        }
        
        $this->render('admin/login', [], 'layouts/auth');
    }
    
    /**
     * Process admin login
     */
    public function doLogin(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/login');
        }
        
        $email = $this->post('email');
        $password = $this->post('password');
        
        if (Auth::attemptByEmail((string) $email, (string) $password, false, 'admin')) {
            $this->flash('success', 'Welcome to admin panel');
            $this->redirect('/admin');
        } else {
            $this->flash('error', 'Invalid credentials');
            $this->redirect('/admin/login');
        }
    }
}
