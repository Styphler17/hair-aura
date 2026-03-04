<div class="auth-heading">
    <h1 class="auth-title">Welcome Back</h1>
    <p class="auth-subtitle">Sign in to your Hair Aura account</p>
</div>

<form method="post" action="<?= url('/login') ?>" class="auth-form" id="loginForm" novalidate>
    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

    <div class="auth-field">
        <label for="login-phone" class="auth-label">Phone Number</label>
        <div class="auth-input-wrap">
            <i class="fas fa-phone auth-input-icon"></i>
            <input
                type="tel"
                id="login-phone"
                name="phone"
                class="auth-input"
                placeholder="+233 XX XXX XXXX"
                value="<?= htmlspecialchars($_SESSION['old_input']['phone'] ?? '') ?>"
                required
                autocomplete="tel"
            >
        </div>
    </div>

    <div class="auth-field">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="login-password" class="auth-label mb-0">Password</label>
            <a href="<?= url('/forgot-password') ?>" class="auth-forgot-link">Forgot Password?</a>
        </div>
        <div class="auth-input-wrap">
            <i class="fas fa-lock auth-input-icon"></i>
            <input
                type="password"
                id="login-password"
                name="password"
                class="auth-input"
                placeholder="Enter your password"
                required
                autocomplete="current-password"
            >
        </div>
    </div>

    <div class="auth-remember">
        <input type="checkbox" class="auth-checkbox" id="remember" name="remember" value="1">
        <label for="remember" class="auth-checkbox-label">Keep me signed in</label>
    </div>

    <button type="submit" class="auth-btn-primary">
        <span>Sign In</span>
        <i class="fas fa-arrow-right ms-2"></i>
    </button>
</form>

<div class="auth-create-account">
    <p>Don't have an account? <a href="<?= url('/register') ?>" class="auth-link">Create one free</a></p>
</div>
