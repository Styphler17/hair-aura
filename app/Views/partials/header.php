<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="top-bar-text">
                    <i class="fas fa-phone"></i>
                    <a href="tel:+233508007873">+233508007873</a>
                    <span class="divider">|</span>
                    <i class="fab fa-whatsapp"></i>
                    <a href="https://wa.me/233508007873" target="_blank" rel="noopener">WhatsApp</a>
                    <span class="divider">|</span>
                    <i class="fas fa-envelope"></i> hello@hair-aura.debesties.com
                </span>
            </div>
            <div class="col-md-6 text-end">
                <span class="top-bar-text">
                    <i class="fas fa-truck"></i> Free shipping on orders over GH₵1200
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= url('/') ?>">
                <img src="<?= asset('/img/logo.png') ?>" alt="Hair Aura" class="brand-logo-img">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= url('/shop') ?>" data-bs-toggle="dropdown">
                            Shop
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= url('/shop') ?>">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= url('/shop/human-hair-wigs') ?>">Human Hair Wigs</a></li>
                            <li><a class="dropdown-item" href="<?= url('/shop/lace-front-wigs') ?>">Lace Front Wigs</a></li>
                            <li><a class="dropdown-item" href="<?= url('/shop/synthetic-wigs') ?>">Synthetic Wigs</a></li>
                            <li><a class="dropdown-item" href="<?= url('/shop/hair-extensions') ?>">Hair Extensions</a></li>
                            <li><a class="dropdown-item" href="<?= url('/shop/hair-toppers') ?>">Hair Toppers</a></li>
                            <li><a class="dropdown-item" href="<?= url('/shop/hair-accessories') ?>">Accessories</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/blog') ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/contact') ?>">Contact</a>
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
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="<?= $userAvatar ?>" alt="<?= htmlspecialchars($user->getFullName()) ?>" class="header-avatar">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= url('/account') ?>">My Account</a></li>
                                <li><a class="dropdown-item" href="<?= url('/account/orders') ?>">My Orders</a></li>
                                <li><a class="dropdown-item" href="<?= url('/account/wishlist') ?>">Wishlist</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= url('/logout') ?>">Logout</a></li>
                            </ul>
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
