<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error | Hair Aura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            color: #dc3545;
            line-height: 1;
        }
        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .error-text {
            color: #6c757d;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="container">
            <div class="error-code">500</div>
            <h1 class="error-title">Server Error</h1>
            <p class="error-text">
                Something went wrong on our end. Please try again later.
            </p>
            <div class="error-actions">
                <a href="<?= url('/') ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-home"></i> Go Home
                </a>
                <a href="javascript:location.reload()" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-refresh"></i> Try Again
                </a>
            </div>
        </div>
    </div>
</body>
</html>
