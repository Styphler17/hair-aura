<?php
$theme = (array) ($themeVars ?? []);
$themePrimary     = htmlspecialchars((string) ($theme['primary']      ?? '#D4A574'));
$themePrimaryDark = htmlspecialchars((string) ($theme['primary_dark'] ?? '#B8935F'));
$themeSecondary   = htmlspecialchars((string) ($theme['secondary']    ?? '#2C2C2C'));
$themeGold        = htmlspecialchars((string) ($theme['gold']         ?? '#D4AF37'));

$authCssVersion      = is_file(BASE_PATH . '/public/css/auth.css')           ? (string) filemtime(BASE_PATH . '/public/css/auth.css')           : (string) time();
$passwordCssVersion  = is_file(BASE_PATH . '/public/css/password-toggle.css')? (string) filemtime(BASE_PATH . '/public/css/password-toggle.css'): (string) time();
$authJsVersion       = is_file(BASE_PATH . '/public/js/auth.js')             ? (string) filemtime(BASE_PATH . '/public/js/auth.js')             : (string) time();
$passwordJsVersion   = is_file(BASE_PATH . '/public/js/password-toggle.js')  ? (string) filemtime(BASE_PATH . '/public/js/password-toggle.js')  : (string) time();

// Detect if this is an admin route so we use the correct side-panel image
$isAdminAuth = str_contains($_SERVER['REQUEST_URI'] ?? '', '/admin/');

// Side-panel image: use the product wig image for admin, lifestyle photo for customer
$sidePanelImage    = $isAdminAuth
    ? asset('/uploads/logos/login-right-backend-image.png')
    : asset('/uploads/logos/login-right-frontend-image.png');
$sidePanelTagline  = $isAdminAuth ? 'Manage Your Hair Empire' : 'Your Hair, Your Aura';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= \App\Core\Auth::csrfToken() ?>">
    <title><?= htmlspecialchars($seo['title'] ?? 'Sign In | Hair Aura') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= asset('/favicon.ico') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset('/favicon.svg') ?>">
    <link rel="apple-touch-icon" href="<?= asset('/apple-touch-icon.png') ?>">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <!-- Auth CSS -->
    <link rel="stylesheet" href="<?= asset('/css/auth.css') ?>?v=<?= htmlspecialchars($authCssVersion) ?>">
    <link rel="stylesheet" href="<?= asset('/css/password-toggle.css') ?>?v=<?= htmlspecialchars($passwordCssVersion) ?>">
    <style>
        :root {
            --primary:      <?= $themePrimary ?>;
            --primary-dark: <?= $themePrimaryDark ?>;
            --secondary:    <?= $themeSecondary ?>;
            --gold:         <?= $themeGold ?>;
        }
    </style>
</head>
<body class="auth-page">

<div class="auth-split-wrapper">

    <!-- ============ LEFT — Form Panel ============ -->
    <div class="auth-form-panel">
        <div class="auth-form-inner">

            <!-- Logo -->
            <a href="<?= url('/') ?>" class="auth-brand-link">
                <img src="<?= asset($siteSettings['logo'] ?? 'uploads/logos/logo.webp') ?>"
                     alt="<?= htmlspecialchars($siteSettings['name'] ?? 'Hair Aura') ?>"
                     class="auth-brand-logo">
            </a>

            <!-- Flash Messages -->
            <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show mt-3" role="alert">
                <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['flash']); endif; ?>

            <!-- Page Content (form injected here) -->
            <div class="auth-content-area">
                <?php if (isset($content)) echo $content; ?>
            </div>

            <!-- Footer -->
            <div class="auth-panel-footer">
                <a href="<?= url('/') ?>" class="auth-back-link">
                    <i class="fas fa-arrow-left me-2"></i>Back to Store
                </a>
            </div>
        </div>
    </div>

    <!-- ============ RIGHT — Brand Image Panel ============ -->
    <div class="auth-image-panel" style="background-image: url('<?= $sidePanelImage ?>');" aria-hidden="true">
        <div class="auth-image-overlay">
            <div class="auth-image-branding">
                <div class="auth-image-logo-text">Hair Aura</div>
                <p class="auth-image-tagline"><?= htmlspecialchars($sidePanelTagline) ?></p>
                <div class="auth-image-badge">
                    <i class="fas fa-star me-1"></i> Premium Hair — Ghana's Finest
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= asset('/js/auth.js') ?>?v=<?= htmlspecialchars($authJsVersion) ?>"></script>
<script src="<?= asset('/js/password-toggle.js') ?>?v=<?= htmlspecialchars($passwordJsVersion) ?>"></script>
</body>
</html>
