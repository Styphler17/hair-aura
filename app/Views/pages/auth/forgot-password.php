<div class="auth-heading">
    <h1 class="auth-title">Forgot Password?</h1>
    <p class="auth-subtitle">Enter your email and we'll send you a reset link.</p>
</div>

<form method="post" action="<?= url('/forgot-password') ?>" class="auth-form" id="forgotForm" novalidate>
    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

    <div class="auth-field">
        <label for="forgot-email" class="auth-label">Email Address</label>
        <div class="auth-input-wrap">
            <i class="fas fa-envelope auth-input-icon"></i>
            <input
                type="email"
                id="forgot-email"
                name="email"
                class="auth-input"
                placeholder="you@example.com"
                required
                autocomplete="email"
            >
        </div>
    </div>

    <button type="submit" class="auth-btn-primary">
        <i class="fas fa-paper-plane me-2"></i>
        <span>Send Reset Link</span>
    </button>
</form>

<div class="auth-create-account">
    <p>Remembered it? <a href="<?= url('/login') ?>" class="auth-link">Sign In</a></p>
</div>
