<div class="auth-heading">
    <div class="auth-admin-badge">
        <i class="fas fa-shield-halved me-2"></i>Admin Portal
    </div>
    <h1 class="auth-title">Admin Sign In</h1>
    <p class="auth-subtitle">Secure access to Hair Aura HQ</p>
</div>

<form method="post" action="<?= url('/admin/login') ?>" class="auth-form" id="adminLoginForm" novalidate>
    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

    <div class="auth-field">
        <label for="admin-email" class="auth-label">Admin Email</label>
        <div class="auth-input-wrap">
            <i class="fas fa-envelope auth-input-icon"></i>
            <input
                type="email"
                id="admin-email"
                name="email"
                class="auth-input"
                placeholder="admin@hairaura.com"
                required
                autocomplete="email"
            >
        </div>
    </div>

    <div class="auth-field">
        <label for="admin-password" class="auth-label">Password</label>
        <div class="auth-input-wrap">
            <i class="fas fa-lock auth-input-icon"></i>
            <input
                type="password"
                id="admin-password"
                name="password"
                class="auth-input"
                placeholder="Enter your password"
                required
                autocomplete="current-password"
            >
        </div>
    </div>

    <button type="submit" class="auth-btn-primary auth-btn-admin">
        <i class="fas fa-right-to-bracket me-2"></i>
        <span>Access Dashboard</span>
    </button>
</form>

<div class="auth-create-account">
    <p><a href="<?= url('/') ?>" class="auth-link"><i class="fas fa-store me-1"></i> Back to Hair Aura Store</a></p>
</div>
