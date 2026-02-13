<!DOCTYPE html>
<html lang="en" data-app-base="<?= htmlspecialchars(rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/')) ?>">
<head>
    <?php
    $configuredBaseUrl = rtrim((string) ($_ENV['APP_URL'] ?? ''), '/');
    $requestHost = (string) ($_SERVER['HTTP_HOST'] ?? '');
    $requestScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $runtimeBaseUrl = $requestHost !== '' ? ($requestScheme . '://' . $requestHost . rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/')) : '';
    $siteBaseUrl = $configuredBaseUrl !== '' ? $configuredBaseUrl : rtrim($runtimeBaseUrl, '/');
    $publicRoot = __DIR__ . '/../../../public';

    $resolvePublicAsset = static function (array $candidates) use ($publicRoot): string {
        foreach ($candidates as $candidate) {
            $path = '/' . ltrim((string) $candidate, '/');
            if (is_file($publicRoot . $path)) {
                return $path;
            }
        }

        return '/' . ltrim((string) ($candidates[0] ?? '/img/logo.png'), '/');
    };

    $canonicalRaw = (string) ($seo['canonical'] ?? '/');
    $canonicalUrl = preg_match('#^https?://#i', $canonicalRaw)
        ? $canonicalRaw
        : $siteBaseUrl . '/' . ltrim($canonicalRaw, '/');

    $faviconIco = $resolvePublicAsset(['/img/favicon.ico', '/favicon.ico']);
    $faviconSvg = $resolvePublicAsset(['/img/favicon.svg', '/favicon.svg']);
    $faviconPng96 = $resolvePublicAsset(['/img/favicon-96x96.png', '/favicon-96x96.png']);
    $appleTouchIcon = $resolvePublicAsset(['/img/apple-touch-icon.png', '/apple-touch-icon.png']);
    $webManifest = $resolvePublicAsset(['/img/site.webmanifest', '/site.webmanifest']);
    $defaultOgImage = $resolvePublicAsset(['/img/og-image.png', '/img/og-image.jpg', '/img/logo.jpg', '/img/logo.png', '/img/hero-1.jpg']);

    $ogImageRaw = (string) ($seo['og_image'] ?? $defaultOgImage);
    $ogImageUrl = preg_match('#^https?://#i', $ogImageRaw)
        ? $ogImageRaw
        : $siteBaseUrl . '/' . ltrim($ogImageRaw, '/');

    $ogType = (string) ($seo['og_type'] ?? 'website');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Meta Tags -->
    <title><?= htmlspecialchars($seo['title'] ?? 'Hair Aura | Premium Wigs & Hair Extensions Ghana') ?></title>
    <meta name="description" content="<?= htmlspecialchars($seo['description'] ?? 'Shop premium human hair wigs, lace fronts, synthetic wigs & hair extensions in Ghana. Unlock your aura with perfect wigs.') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($seo['keywords'] ?? 'wigs Ghana, human hair wigs, lace front wigs, synthetic wigs, hair extensions') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($seo['title'] ?? 'Hair Aura') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($seo['description'] ?? 'Premium Wigs & Hair Extensions Ghana') ?>">
    <meta property="og:type" content="<?= htmlspecialchars($ogType) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImageUrl) ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($seo['title'] ?? 'Hair Aura') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($seo['description'] ?? 'Premium Wigs & Hair Extensions Ghana') ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImageUrl) ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= asset($faviconIco) ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset($faviconSvg) ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= asset($faviconPng96) ?>">
    <link rel="apple-touch-icon" href="<?= asset($appleTouchIcon) ?>">
    <link rel="manifest" href="<?= asset($webManifest) ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= asset('/css/style.css') ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/style.css') ?>';">
    <link rel="stylesheet" href="<?= asset('/css/password-toggle.css') ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/password-toggle.css') ?>';">
    
    <!-- Product Schema (if available) -->
    <?php if (isset($productSchema)): ?>
    <script type="application/ld+json">
        <?= json_encode($productSchema, JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <?php include __DIR__ . '/../partials/header.php'; ?>
    
    <!-- Flash Messages -->
    <?php if (isset($_SESSION['flash'])): ?>
    <div class="flash-messages">
        <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['flash']['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['flash']); endif; ?>
    
    <!-- Main Content -->
    <main>
        <?php if (isset($content)) echo $content; ?>
    </main>
    
    <!-- Footer -->
    <?php include __DIR__ . '/../partials/footer.php'; ?>

    <button type="button" class="back-to-top" id="backToTopBtn" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?= asset('/js/main.js') ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/main.js') ?>';"></script>
    <script src="<?= asset('/js/password-toggle.js') ?>" onerror="this.onerror=null;this.src='<?= url('/public/js/password-toggle.js') ?>';"></script>
</body>
</html>
