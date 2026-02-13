<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | Hair Aura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('/css/style.css') ?>" onerror="this.onerror=null;this.href='<?= url('/public/css/style.css') ?>';">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }
        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .error-text {
            color: var(--gray-600);
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="container">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="error-text">
                Sorry, the page you're looking for doesn't exist or has been moved.
            </p>
            <div class="error-actions">
                <a href="<?= url('/') ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-home"></i> Go Home
                </a>
                <a href="<?= url('/shop') ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-shopping-bag"></i> Browse Products
                </a>
            </div>
        </div>
    </div>
</body>
</html>
