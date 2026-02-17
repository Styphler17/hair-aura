<!DOCTYPE html>
<html lang="en" data-app-base="<?= htmlspecialchars(rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/')) ?>">
<head>
    <?php
    $theme = (array) ($themeVars ?? []);
    $themePrimary = htmlspecialchars((string) ($theme['primary'] ?? '#D4A574'));
    $themePrimaryDark = htmlspecialchars((string) ($theme['primary_dark'] ?? '#B8935F'));
    $themeSecondary = htmlspecialchars((string) ($theme['secondary'] ?? '#2C2C2C'));
    $themeGold = htmlspecialchars((string) ($theme['gold'] ?? '#D4AF37'));
    $adminCssVersion = is_file(BASE_PATH . '/public/css/admin.css') ? (string) filemtime(BASE_PATH . '/public/css/admin.css') : (string) time();
    $passwordCssVersion = is_file(BASE_PATH . '/public/css/password-toggle.css') ? (string) filemtime(BASE_PATH . '/public/css/password-toggle.css') : (string) time();
    $adminJsVersion = is_file(BASE_PATH . '/public/js/admin.js') ? (string) filemtime(BASE_PATH . '/public/js/admin.js') : (string) time();
    $passwordJsVersion = is_file(BASE_PATH . '/public/js/password-toggle.js') ? (string) filemtime(BASE_PATH . '/public/js/password-toggle.js') : (string) time();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Hair Aura</title>
    <link rel="icon" type="image/x-icon" href="<?= asset('/favicon.ico') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset('/favicon.svg') ?>">
    <link rel="apple-touch-icon" href="<?= asset('/apple-touch-icon.png') ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= asset('/css/admin.css') ?>?v=<?= htmlspecialchars($adminCssVersion) ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/admin.css') ?>?v=<?= htmlspecialchars($adminCssVersion) ?>';">
    <link rel="stylesheet" href="<?= asset('/css/password-toggle.css') ?>?v=<?= htmlspecialchars($passwordCssVersion) ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/password-toggle.css') ?>?v=<?= htmlspecialchars($passwordCssVersion) ?>';">
    <style>
        :root {
            --primary: <?= $themePrimary ?>;
            --primary-dark: <?= $themePrimaryDark ?>;
            --secondary: <?= $themeSecondary ?>;
            --gold: <?= $themeGold ?>;
        }
    </style>
</head>
<body>
    <?php $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''; ?>
    <?php $avatarAsset = ($user ?? null) ? asset($user->getAvatarUrl()) : asset('/img/default-avatar.svg'); ?>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="sidebar-header">
                <a href="<?= url('/admin') ?>" class="sidebar-brand">
                    <img src="<?= asset($siteSettings['logo'] ?? '/img/logo.webp') ?>" alt="<?= htmlspecialchars($siteSettings['name'] ?? 'Hair Aura') ?>" class="brand-logo-img">
                </a>
            </div>
            
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="<?= url('/admin') ?>" class="nav-link <?= preg_match('#/admin/?$#', $requestUri) ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/orders') ?>" class="nav-link <?= str_contains($requestUri, '/admin/orders') ? 'active' : '' ?>">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/products') ?>" class="nav-link <?= str_contains($requestUri, '/admin/products') ? 'active' : '' ?>">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/categories') ?>" class="nav-link <?= str_contains($requestUri, '/admin/categories') ? 'active' : '' ?>">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/blogs') ?>" class="nav-link <?= str_contains($requestUri, '/admin/blogs') ? 'active' : '' ?>">
                        <i class="fas fa-blog"></i>
                        <span>Blogs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/reviews') ?>" class="nav-link <?= str_contains($requestUri, '/admin/reviews') ? 'active' : '' ?>">
                        <i class="fas fa-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/users') ?>" class="nav-link <?= str_contains($requestUri, '/admin/users') ? 'active' : '' ?>">
                        <i class="fas fa-user-cog"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/customers') ?>" class="nav-link <?= str_contains($requestUri, '/admin/customers') ? 'active' : '' ?>">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/notes') ?>" class="nav-link <?= str_contains($requestUri, '/admin/notes') ? 'active' : '' ?>">
                        <i class="fas fa-note-sticky"></i>
                        <span>Notes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/media') ?>" class="nav-link <?= str_contains($requestUri, '/admin/media') ? 'active' : '' ?>">
                        <i class="fas fa-photo-film"></i>
                        <span>Media Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/contact-messages') ?>" class="nav-link <?= str_contains($requestUri, '/admin/contact-messages') ? 'active' : '' ?>">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>Contact Messages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/contact-info') ?>" class="nav-link <?= str_contains($requestUri, '/admin/contact-info') ? 'active' : '' ?>">
                        <i class="fas fa-address-book"></i>
                        <span>Contact Info</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/about-page') ?>" class="nav-link <?= str_contains($requestUri, '/admin/about-page') ? 'active' : '' ?>">
                        <i class="fas fa-circle-info"></i>
                        <span>About Page</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/settings') ?>" class="nav-link <?= str_contains($requestUri, '/admin/settings') ? 'active' : '' ?>">
                        <i class="fas fa-gear"></i>
                        <span>Site Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/admin/profile') ?>" class="nav-link <?= str_contains($requestUri, '/admin/profile') ? 'active' : '' ?>">
                        <i class="fas fa-user-shield"></i>
                        <span>Admin Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/') ?>" target="_blank" class="nav-link">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Store</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="admin-sidebar-overlay" id="adminSidebarOverlay"></div>
        
        <!-- Main Content -->
        <div class="admin-main">
            <!-- Top Navbar -->
            <nav class="admin-navbar">
                <div class="topbar-start">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="topbar-context">
                        <div class="topbar-title">Admin Console</div>
                        <div class="topbar-subtitle">Hair Aura Operations</div>
                    </div>
                </div>

                <form action="<?= url('/admin/search') ?>" method="get" class="admin-top-search search-form">
                    <input type="text" name="q" class="form-control" placeholder="Search products, orders, users, blogs..." value="<?= htmlspecialchars((string) ($_GET['q'] ?? '')) ?>">
                    <button type="submit" class="btn" aria-label="Search"><i class="fas fa-search"></i></button>
                </form>
                
                <div class="navbar-right">
                    <a href="<?= url('/admin/profile') ?>" class="navbar-user">
                        <img src="<?= $avatarAsset ?>" alt="<?= htmlspecialchars($user?->getFullName() ?? 'Admin') ?>" class="navbar-avatar">
                        <span class="navbar-user-name"><?= htmlspecialchars($user?->getFullName() ?? 'Admin') ?></span>
                    </a>
                    <a href="<?= url('/logout') ?>" class="navbar-logout" aria-label="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>
            
            <!-- Page Content -->
            <div class="admin-content">
                <!-- Flash Messages -->
                <?php if (isset($_SESSION['flash'])): ?>
                <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flash']); endif; ?>
                
                <?php if (isset($content)) echo $content; ?>
            </div>
        </div>
    </div>

    <button type="button" class="back-to-top admin-back-to-top" id="adminBackToTopBtn" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin JS -->
    <script src="<?= asset('/js/admin.js') ?>?v=<?= htmlspecialchars($adminJsVersion) ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/admin.js') ?>?v=<?= htmlspecialchars($adminJsVersion) ?>';"></script>
    <script src="<?= asset('/js/password-toggle.js') ?>?v=<?= htmlspecialchars($passwordJsVersion) ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/password-toggle.js') ?>?v=<?= htmlspecialchars($passwordJsVersion) ?>';"></script>
</body>
</html>
