<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $theme = (array) ($themeVars ?? []);
    $themePrimary = htmlspecialchars((string) ($theme['primary'] ?? '#D4A574'));
    $themePrimaryDark = htmlspecialchars((string) ($theme['primary_dark'] ?? '#B8935F'));
    $themeSecondary = htmlspecialchars((string) ($theme['secondary'] ?? '#2C2C2C'));
    $themeGold = htmlspecialchars((string) ($theme['gold'] ?? '#D4AF37'));
    $authCssVersion = is_file(BASE_PATH . '/public/css/auth.css') ? (string) filemtime(BASE_PATH . '/public/css/auth.css') : (string) time();
    $passwordCssVersion = is_file(BASE_PATH . '/public/css/password-toggle.css') ? (string) filemtime(BASE_PATH . '/public/css/password-toggle.css') : (string) time();
    $authJsVersion = is_file(BASE_PATH . '/public/js/auth.js') ? (string) filemtime(BASE_PATH . '/public/js/auth.js') : (string) time();
    $passwordJsVersion = is_file(BASE_PATH . '/public/js/password-toggle.js') ? (string) filemtime(BASE_PATH . '/public/js/password-toggle.js') : (string) time();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seo['title'] ?? 'Authentication | Hair Aura') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= asset('/favicon.ico') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset('/favicon.svg') ?>">
    <link rel="apple-touch-icon" href="<?= asset('/apple-touch-icon.png') ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Auth CSS -->
    <link rel="stylesheet" href="<?= asset('/css/auth.css') ?>?v=<?= htmlspecialchars($authCssVersion) ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/auth.css') ?>?v=<?= htmlspecialchars($authCssVersion) ?>';">
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
<body class="auth-page">
    <div class="bg-blobs" aria-hidden="true"></div>
    <div class="gold-line" aria-hidden="true"></div>
    <div class="auth-wrapper">
        <div class="auth-container">
            <!-- Logo -->
            <div class="auth-logo">
                <a href="<?= url('/') ?>">
                    <img src="<?= asset('/img/logo.png') ?>" alt="Hair Aura" class="brand-logo-img">
                </a>
                <p class="auth-tagline">Unlock Your Aura with Perfect Wigs</p>
            </div>
            
            <!-- Flash Messages -->
            <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['flash']); endif; ?>
            
            <!-- Content -->
            <?php if (isset($content)) echo $content; ?>
            
            <!-- Back to Store -->
            <div class="auth-footer">
                <a href="<?= url('/') ?>" class="btn btn-outline-secondary auth-home-btn">
                    <i class="fas fa-house"></i> Return to Homepage
                </a>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('/js/auth.js') ?>?v=<?= htmlspecialchars($authJsVersion) ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/auth.js') ?>?v=<?= htmlspecialchars($authJsVersion) ?>';"></script>
    <script src="<?= asset('/js/password-toggle.js') ?>?v=<?= htmlspecialchars($passwordJsVersion) ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/password-toggle.js') ?>?v=<?= htmlspecialchars($passwordJsVersion) ?>';"></script>
</body>
</html>
