<?php
/**
 * Hair Aura - Public Entry Point
 * 
 * This is the main entry point for the application.
 * All requests are routed through this file.
 * 
 * @package HairAura
 * @author Hair Aura Team
 * @version 1.0.0
 */

// Define base path
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', BASE_PATH . '/config');
define('VIEWS_PATH', APP_PATH . '/Views');

// Let PHP built-in server serve real static files (css/js/img/uploads) directly.
if (PHP_SAPI === 'cli-server') {
    $uriPath = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
    $publicFile = __DIR__ . $uriPath;
    if ($uriPath !== '/' && is_file($publicFile)) {
        return false;
    }
}

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Load autoloader
require_once APP_PATH . '/Core/Autoloader.php';

// Load environment variables
if (file_exists(BASE_PATH . '/.env')) {
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// Start session
session_start();

// Ensure required upload directories exist across environments/deploys.
$uploadDirs = [
    BASE_PATH . '/public/uploads',
    BASE_PATH . '/public/uploads/products',
    BASE_PATH . '/public/uploads/avatars',
    BASE_PATH . '/public/uploads/blog',
    BASE_PATH . '/public/uploads/categories',
    BASE_PATH . '/public/uploads/media'
];
foreach ($uploadDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Resolve base URLs for route and asset helpers
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$phpSelf = str_replace('\\', '/', $_SERVER['PHP_SELF'] ?? '');

// Prefer a filesystem-based base path; this is more reliable in subfolder installs.
$docRootReal = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$publicReal = realpath(__DIR__);
$publicFromDocRoot = '';
$scriptDir = '';

if ($docRootReal && $publicReal) {
    $docRootNorm = str_replace('\\', '/', $docRootReal);
    $publicNorm = str_replace('\\', '/', $publicReal);

    if (strpos($publicNorm, $docRootNorm) === 0) {
        $suffix = trim(substr($publicNorm, strlen($docRootNorm)), '/');
        $publicFromDocRoot = $suffix === '' ? '' : '/' . $suffix;
    }
}

// Derive script directory from SCRIPT_FILENAME first to avoid PHP built-in server
// edge-cases where PHP_SELF equals the request path (e.g. /login).
$scriptFilenameReal = realpath($_SERVER['SCRIPT_FILENAME'] ?? '');
if ($docRootReal && $scriptFilenameReal) {
    $docRootNorm = str_replace('\\', '/', $docRootReal);
    $scriptDirNorm = str_replace('\\', '/', dirname($scriptFilenameReal));
    if (strpos($scriptDirNorm, $docRootNorm) === 0) {
        $suffix = trim(substr($scriptDirNorm, strlen($docRootNorm)), '/');
        $scriptDir = $suffix === '' ? '' : '/' . $suffix;
    }
}

if ($scriptDir === '') {
    $scriptDir = rtrim(str_replace('/index.php', '', ($scriptName ?: $phpSelf)), '/');
}

$cleanBaseDir = rtrim((string) preg_replace('#/public$#', '', $scriptDir), '/');

// Fallback static asset serving for environments where rewrite forwards
// /css, /js, /img, /uploads, /assets to index.php.
$assetPrefixes = [];
if ($scriptDir !== '') {
    $assetPrefixes[] = $scriptDir;
}
if ($cleanBaseDir !== '') {
    $assetPrefixes[] = rtrim($cleanBaseDir, '/') . '/public';
    $assetPrefixes[] = $cleanBaseDir;
}
$assetPrefixes[] = '/public';
$assetPrefixes = array_values(array_unique(array_filter($assetPrefixes)));

$assetCandidates = [$requestPath];
foreach ($assetPrefixes as $prefix) {
    $prefix = rtrim($prefix, '/');
    if ($prefix !== '' && str_starts_with($requestPath, $prefix . '/')) {
        $assetCandidates[] = substr($requestPath, strlen($prefix));
    }
}

foreach ($assetCandidates as $candidate) {
    $candidatePath = '/' . ltrim((string) $candidate, '/');
    if (!preg_match('#^/(css|js|img|uploads|assets)/#', $candidatePath)) {
        continue;
    }

    $fullAssetPath = __DIR__ . $candidatePath;
    if (!is_file($fullAssetPath)) {
        continue;
    }

    if (!headers_sent()) {
        $mimeType = function_exists('mime_content_type') ? mime_content_type($fullAssetPath) : '';
        if (is_string($mimeType) && $mimeType !== '') {
            header('Content-Type: ' . $mimeType);
        }
    }

    readfile($fullAssetPath);
    exit;
}

// Use /public for assets when the app is not served directly from public/
$GLOBALS['app_asset_url'] = $publicFromDocRoot !== '' ? $publicFromDocRoot : $scriptDir;

// Use clean base for routes when /public is hidden by rewrite rules
$routeFromDocRoot = rtrim((string) preg_replace('#/public$#', '', $publicFromDocRoot), '/');

if ($routeFromDocRoot !== '') {
    $GLOBALS['app_base_url'] = $routeFromDocRoot;
} elseif ($scriptDir !== '' && strpos($requestPath, $scriptDir) === 0) {
    $GLOBALS['app_base_url'] = $scriptDir;
} else {
    $GLOBALS['app_base_url'] = $cleanBaseDir;
}

if (!function_exists('asset')) {
    function asset(string $path = ''): string
    {
        $base = rtrim($GLOBALS['app_asset_url'] ?? '', '/');
        $cleanPath = ltrim($path, '/');

        if ($base === '') {
            return '/' . $cleanPath;
        }

        return $base . '/' . $cleanPath;
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string
    {
        $base = rtrim($GLOBALS['app_base_url'] ?? '', '/');
        $cleanPath = ltrim($path, '/');

        if ($base === '') {
            return '/' . $cleanPath;
        }

        return $base . '/' . $cleanPath;
    }
}

if (!function_exists('money')) {
    function money($amount): string
    {
        return 'GH₵' . number_format((float) $amount, 2);
    }
}

// Initialize Auth
\App\Core\Auth::init();

// Create router
$router = new \App\Core\Router();

// ==================== PUBLIC ROUTES ====================

// Home
$router->get('/', ['HomeController', 'index']);

// Static Pages
$router->get('/about', ['HomeController', 'about']);
$router->get('/blog', ['HomeController', 'blog']);
$router->get('/blog/search', ['HomeController', 'blogSearch']);
$router->get('/blog/{slug}', ['HomeController', 'blogDetail']);
$router->get('/contact', ['HomeController', 'contact']);
$router->post('/contact', ['HomeController', 'submitContact']);
$router->get('/faq', ['HomeController', 'faq']);
$router->get('/shipping', ['HomeController', 'shipping']);
$router->get('/returns', ['HomeController', 'returns']);
$router->get('/care-guide', ['HomeController', 'careGuide']);
$router->get('/size-guide', ['HomeController', 'sizeGuide']);
$router->get('/privacy', ['HomeController', 'privacy']);
$router->get('/terms', ['HomeController', 'terms']);
$router->get('/sitemap.xml', ['HomeController', 'sitemap']);
$router->get('/robots.txt', ['HomeController', 'robots']);

// Newsletter
$router->post('/newsletter', ['HomeController', 'newsletter']);

// Shop
$router->get('/shop', ['ProductController', 'shop']);
$router->get('/shop/{categorySlug}', ['ProductController', 'shop']);

// Product
$router->get('/product/{slug}', ['ProductController', 'detail']);
$router->get('/product/quick-view/{id:\d+}', ['ProductController', 'quickView']);
$router->post('/product/{id:\d+}/review', ['ProductController', 'addReview']);
$router->post('/product/stock-alert', ['ProductController', 'stockAlert']);

// Search
$router->get('/search', ['ProductController', 'search']);

// Cart
$router->get('/cart', ['CartController', 'index']);
$router->post('/cart/add', ['CartController', 'add']);
$router->post('/cart/update', ['CartController', 'update']);
$router->post('/cart/remove', ['CartController', 'remove']);
$router->post('/cart/clear', ['CartController', 'clear']);
$router->get('/cart/mini', ['CartController', 'miniCart']);
$router->post('/cart/coupon', ['CartController', 'applyCoupon']);
$router->post('/cart/coupon/remove', ['CartController', 'removeCoupon']);

// Checkout
$router->get('/checkout', ['CartController', 'checkout']);
$router->post('/checkout', ['CartController', 'processCheckout']);
$router->get('/checkout/stripe/{orderNumber}', ['CartController', 'stripeCheckout']);
$router->get('/checkout/paypal/{orderNumber}', ['CartController', 'paypalCheckout']);
$router->get('/checkout/success', ['CartController', 'success']);
$router->get('/checkout/cancel', ['CartController', 'cancel']);

// Authentication
$router->get('/login', ['UserController', 'login']);
$router->post('/login', ['UserController', 'doLogin']);
$router->get('/register', ['UserController', 'register']);
$router->post('/register', ['UserController', 'doRegister']);
$router->get('/logout', ['UserController', 'logout']);
$router->get('/forgot-password', ['UserController', 'forgotPassword']);
$router->post('/forgot-password', ['UserController', 'doForgotPassword']);

// Account (requires auth)
$router->get('/account', ['UserController', 'account']);
$router->get('/account/orders', ['UserController', 'orders']);
$router->get('/account/orders/{orderNumber}', ['UserController', 'orderDetail']);
$router->get('/account/wishlist', ['UserController', 'wishlist']);
$router->post('/account/wishlist/add', ['UserController', 'addToWishlist']);
$router->post('/account/wishlist/remove', ['UserController', 'removeFromWishlist']);
$router->get('/account/profile', ['UserController', 'profile']);
$router->post('/account/profile', ['UserController', 'updateProfile']);
$router->post('/account/password', ['UserController', 'changePassword']);
$router->get('/account/addresses', ['UserController', 'addresses']);

// Order Tracking
$router->get('/track-order', ['UserController', 'trackOrder']);

// ==================== ADMIN ROUTES ====================

// Admin Login
$router->get('/admin/login', ['AdminController', 'login']);
$router->post('/admin/login', ['AdminController', 'doLogin']);

// Admin Dashboard (requires admin)
$router->group('/admin', function($router) {
    $router->get('', ['AdminController', 'dashboard']);
    
    // Products
    $router->get('/products', ['AdminController', 'products']);
    $router->get('/products/add', ['AdminController', 'addProduct']);
    $router->get('/products/edit/{id:\d+}', ['AdminController', 'editProduct']);
    $router->post('/products/save', ['AdminController', 'saveProduct']);
    $router->post('/products/delete/{id:\d+}', ['AdminController', 'deleteProduct']);
    
    // Orders
    $router->get('/orders', ['AdminController', 'orders']);
    $router->get('/orders/{id:\d+}', ['AdminController', 'orderDetail']);
    $router->post('/orders/{id:\d+}/status', ['AdminController', 'updateOrderStatus']);
    
    // Customers
    $router->get('/customers', ['AdminController', 'customers']);
    $router->get('/customers/{id:\d+}', ['AdminController', 'customerDetail']);
    
    // Reviews
    $router->get('/reviews', ['AdminController', 'reviews']);
    $router->post('/reviews/{id:\d+}/approve', ['AdminController', 'approveReview']);
    $router->post('/reviews/{id:\d+}/reject', ['AdminController', 'rejectReview']);
    
    // Categories
    $router->get('/categories', ['AdminController', 'categories']);
    $router->post('/categories/save', ['AdminController', 'saveCategory']);

    // Blog CRUD
    $router->get('/blogs', ['AdminManagementController', 'blogs']);
    $router->get('/blogs/add', ['AdminManagementController', 'addBlog']);
    $router->get('/blogs/edit/{id:\d+}', ['AdminManagementController', 'editBlog']);
    $router->post('/blogs/save', ['AdminManagementController', 'saveBlog']);
    $router->post('/blogs/delete/{id:\d+}', ['AdminManagementController', 'deleteBlog']);

    // User CRUD
    $router->get('/users', ['AdminManagementController', 'users']);
    $router->get('/users/add', ['AdminManagementController', 'addUser']);
    $router->get('/users/edit/{id:\d+}', ['AdminManagementController', 'editUser']);
    $router->post('/users/save', ['AdminManagementController', 'saveUser']);
    $router->post('/users/delete/{id:\d+}', ['AdminManagementController', 'deleteUser']);

    // Content / Site Management
    $router->get('/about-page', ['AdminManagementController', 'aboutPage']);
    $router->post('/about-page', ['AdminManagementController', 'saveAboutPage']);
    $router->get('/contact-info', ['AdminManagementController', 'contactInfo']);
    $router->post('/contact-info', ['AdminManagementController', 'saveContactInfo']);
    $router->get('/contact-messages', ['AdminManagementController', 'contactMessages']);
    $router->post('/contact-messages/delete/{id:\d+}', ['AdminManagementController', 'deleteContactMessage']);
    $router->get('/notes', ['AdminManagementController', 'notes']);
    $router->post('/notes/save', ['AdminManagementController', 'saveNote']);
    $router->post('/notes/delete/{id:\d+}', ['AdminManagementController', 'deleteNote']);
    $router->get('/media', ['AdminManagementController', 'mediaLibrary']);
    $router->post('/media/upload', ['AdminManagementController', 'uploadMedia']);
    $router->post('/media/delete/{id:\d+}', ['AdminManagementController', 'deleteMedia']);
    $router->post('/media/sync', ['AdminManagementController', 'syncMedia']);
    $router->get('/search', ['AdminManagementController', 'search']);
    $router->get('/settings', ['AdminManagementController', 'settings']);
    $router->post('/settings', ['AdminManagementController', 'saveSettings']);

    // Admin profile settings
    $router->get('/profile', ['AdminManagementController', 'profile']);
    $router->post('/profile', ['AdminManagementController', 'saveProfile']);
    $router->post('/profile/password', ['AdminManagementController', 'saveProfilePassword']);
});

// ==================== ERROR HANDLING ====================

// 404 Handler
set_exception_handler(function($e) {
    $rawCode = $e->getCode();
    $code = is_int($rawCode) ? $rawCode : (is_numeric($rawCode) ? (int) $rawCode : 500);
    $code = ($code >= 400 && $code < 600) ? $code : 500;
    http_response_code($code);
    
    if ($code === 404) {
        include VIEWS_PATH . '/errors/404.php';
    } else {
        // Log error
        error_log($e->getMessage());
        error_log($e->getTraceAsString());
        
        if ($_ENV['APP_DEBUG'] ?? false) {
            echo '<h1>Error ' . $code . '</h1>';
            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
        } else {
            include VIEWS_PATH . '/errors/500.php';
        }
    }
    exit;
});

// ==================== DISPATCH REQUEST ====================

try {
    // Get request URI and method
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    
    // Remove query string from URI
    if (($pos = strpos($uri, '?')) !== false) {
        $uri = substr($uri, 0, $pos);
    }

    // Strip app base path for route matching when installed in a subdirectory.
    $basePath = rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/');
    if ($basePath !== '') {
        if ($uri === $basePath) {
            $uri = '/';
        } elseif (str_starts_with($uri, $basePath . '/')) {
            $uri = substr($uri, strlen($basePath));
        }
    }
    
    // Dispatch the request
    $router->dispatch($uri, $method);
    
} catch (Exception $e) {
    throw $e;
}
