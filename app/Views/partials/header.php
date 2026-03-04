<?php
$site = (array) ($siteSettings ?? []);
$contactPhone = (string) ($site['phone'] ?? '+233508007873');
$contactWhatsapp = (string) ($site['whatsapp'] ?? '+233508007873');
$contactEmail = (string) ($site['email'] ?? 'support@example.com');
$contactWhatsappDigits = preg_replace('/\D+/', '', $contactWhatsapp);
?>
<!-- Announcement Banner -->
<aside class="announcement-banner">
    <div class="banner-content">
        <div class="banner-text">
            <span>Payment on delivery within Accra</span>
            <span class="d-none d-md-inline">•</span>
            <span>Free delivery on orders over <?= money((float) ($site['free_shipping_threshold'] ?? 3000)) ?></span>
            <span class="d-none d-md-inline">•</span>
            <span>Payment on delivery within Accra</span>
            <span class="d-none d-md-inline">•</span>
            <span>Free delivery on orders over <?= money((float) ($site['free_shipping_threshold'] ?? 3000)) ?></span>
        </div>
    </div>
</aside>

<!-- Top Bar -->
<section class="top-bar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="top-bar-text">
                    <i class="fas fa-phone"></i>
                    <a href="tel:<?= htmlspecialchars($contactPhone) ?>"><?= htmlspecialchars($contactPhone) ?></a>
                    <span class="divider">|</span>
                    <i class="fab fa-whatsapp"></i>
                    <a href="https://wa.me/<?= htmlspecialchars($contactWhatsappDigits) ?>" target="_blank" rel="noopener">WhatsApp</a>
                    <span class="divider">|</span>
                    <i class="fas fa-envelope"></i> <?= htmlspecialchars($contactEmail) ?>
                </span>
            </div>
            <div class="col-md-6 text-end">
                <span class="top-bar-text">
                    <i class="fas fa-truck"></i> Free delivery on orders over <?= money((float) ($site['free_shipping_threshold'] ?? 3000)) ?>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= url('/') ?>">
                <img src="<?= asset($site['logo'] ?? 'uploads/logos/logo.webp') ?>" alt="<?= htmlspecialchars($site['name'] ?? 'Hair Aura') ?>" class="brand-logo-img">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

<?php 
$currPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$isHome = $currPath === '/' || $currPath === '' || str_ends_with($currPath, '/public/') || str_ends_with($currPath, '/index.php');
$isShop = str_contains($currPath, '/shop') || str_contains($currPath, '/product');
$isAbout = str_contains($currPath, '/about');
$isBlog = str_contains($currPath, '/blog');
$isContact = str_contains($currPath, '/contact');
?>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $isHome ? 'active' : '' ?>" href="<?= url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= $isShop ? 'active' : '' ?>" href="<?= url('/shop') ?>" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop
                        </a>
                        <div class="dropdown-menu shop-dropdown-menu" aria-labelledby="shopDropdown">
                            <div class="shop-dropdown-header">
                                <a href="<?= url('/shop') ?>" class="shop-dropdown-all">
                                    <span class="shop-dropdown-all-icon"><i class="fas fa-store"></i></span>
                                    <span>
                                        <strong>All Products</strong>
                                        <small>Browse our full collection</small>
                                    </span>
                                    <i class="fas fa-arrow-right shop-dropdown-arrow"></i>
                                </a>
                            </div>
                            <div class="shop-dropdown-divider"></div>
                            <div class="shop-dropdown-grid">
                                <a href="<?= url('/shop') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-crown"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Wig Collection</strong>
                                        <small>Browse all units</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/raw-hair') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-gem"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Premium Raw Hair</strong>
                                        <small>Single donor quality</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/bone-straight-hair') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-crown"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Bone-straight</strong>
                                        <small>Luxury sleek finish</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/body-wave-hair') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-star"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Body wave</strong>
                                        <small>Bouncy &amp; voluminous</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/pixie-cut') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-magic"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Pixie cut</strong>
                                        <small>Bold &amp; sophisticated</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/pixie-curls') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-scissors"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Pixie curls</strong>
                                        <small>Playful &amp; textured</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/deep-wave') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-water"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Deep wave</strong>
                                        <small>Intense defined curls</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/raw-hair') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-gem"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Raw hair</strong>
                                        <small>Unprocessed single donor</small>
                                    </span>
                                </a>
                                <a href="<?= url('/shop/blunt-cut') ?>" class="shop-dropdown-item">
                                    <span class="shop-dropdown-icon"><i class="fas fa-cut"></i></span>
                                    <span class="shop-dropdown-text">
                                        <strong>Blunt cut</strong>
                                        <small>Sharp &amp; timeless bobs</small>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $isAbout ? 'active' : '' ?>" href="<?= url('/about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $isBlog ? 'active' : '' ?>" href="<?= url('/blog') ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $isContact ? 'active' : '' ?>" href="<?= url('/contact') ?>">Contact</a>
                    </li>
                </ul>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Search -->
                    <div class="header-search">
                        <form action="<?= url('/shop') ?>" method="get" class="search-form" data-live-search="products">
                            <input type="text" name="q" class="form-control" placeholder="Search..." autocomplete="off">
                            <button type="submit" class="btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- User -->
                    <?php if ($isLoggedIn ?? false): ?>
                        <?php $userAvatar = asset($user->getAvatarUrl()); ?>
                        <div class="header-user dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" id="userDropdown" aria-expanded="false">
                                <img src="<?= $userAvatar ?>" alt="<?= htmlspecialchars($user->getFullName()) ?>" class="header-avatar">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">
                                <div class="user-dropdown-header">
                                    <div class="user-dropdown-info">
                                        <img src="<?= $userAvatar ?>" alt="" class="user-dropdown-avatar">
                                        <div class="user-dropdown-meta">
                                            <strong><?= htmlspecialchars($user->getFullName()) ?></strong>
                                            <small><?= htmlspecialchars($user->email) ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= url('/account') ?>">
                                    <i class="fas fa-user-circle me-2"></i> My Account
                                </a>
                                <a class="dropdown-item" href="<?= url('/account/orders') ?>">
                                    <i class="fas fa-box me-2"></i> My Orders
                                </a>
                                <a class="dropdown-item" href="<?= url('/account/wishlist') ?>">
                                    <i class="fas fa-heart me-2"></i> Wishlist
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout-item" href="<?= url('/logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= url('/login') ?>" class="header-user">
                            <i class="fas fa-user"></i>
                        </a>
                    <?php endif; ?>

                    <!-- Wishlist -->
                    <a href="<?= url('/account/wishlist') ?>" class="header-wishlist">
                        <i class="fas fa-heart"></i>
                    </a>

                    <!-- Cart -->
                    <a href="<?= url('/cart') ?>" class="header-cart">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-count" id="cartCount"><?= $cartCount ?? 0 ?></span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
