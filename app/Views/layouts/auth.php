<!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="stylesheet" href="<?= asset('/css/auth.css') ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/auth.css') ?>';">
    <link rel="stylesheet" href="<?= asset('/css/password-toggle.css') ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/password-toggle.css') ?>';">
</head>
<body class="auth-page">
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
    <script src="<?= asset('/js/password-toggle.js') ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/password-toggle.js') ?>';"></script>
</body>
</html>
