<div class="auth-heading">
    <h1 class="auth-title">Create Account</h1>
    <p class="auth-subtitle">Join Hair Aura and unlock exclusive styles</p>
</div>

<form method="post" action="<?= url('/register') ?>" class="auth-form" id="registerForm" novalidate>
    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="auth-field">
            <label for="reg-first-name" class="auth-label">First Name</label>
            <div class="auth-input-wrap">
                <i class="fas fa-user auth-input-icon"></i>
                <input type="text" id="reg-first-name" name="first_name" class="auth-input" placeholder="First name" required autocomplete="given-name">
            </div>
        </div>
        <div class="auth-field">
            <label for="reg-last-name" class="auth-label">Last Name</label>
            <div class="auth-input-wrap">
                <i class="fas fa-user auth-input-icon"></i>
                <input type="text" id="reg-last-name" name="last_name" class="auth-input" placeholder="Last name" required autocomplete="family-name">
            </div>
        </div>
    </div>

    <div class="auth-field">
        <label for="reg-phone" class="auth-label">Phone Number</label>
        <div class="auth-input-wrap">
            <i class="fas fa-phone auth-input-icon"></i>
            <input type="tel" id="reg-phone" name="phone" class="auth-input" placeholder="+233 XX XXX XXXX" required autocomplete="tel">
        </div>
    </div>

    <div class="auth-field">
        <label for="reg-password" class="auth-label">Password</label>
        <div class="auth-input-wrap">
            <i class="fas fa-lock auth-input-icon"></i>
            <input type="password" id="reg-password" name="password" class="auth-input" placeholder="Create a strong password" required autocomplete="new-password">
        </div>
    </div>

    <div class="auth-field">
        <label for="reg-confirm" class="auth-label">Confirm Password</label>
        <div class="auth-input-wrap">
            <i class="fas fa-lock auth-input-icon"></i>
            <input type="password" id="reg-confirm" name="password_confirm" class="auth-input" placeholder="Repeat your password" required autocomplete="new-password">
        </div>
    </div>

    <div class="auth-remember">
        <input type="checkbox" class="auth-checkbox" id="terms" name="terms" value="1" required>
        <label for="terms" class="auth-checkbox-label">I agree to the <a href="<?= url('/terms') ?>" class="auth-link" target="_blank">Terms &amp; Conditions</a></label>
    </div>

    <button type="submit" class="auth-btn-primary">
        <span>Create My Account</span>
        <i class="fas fa-arrow-right ms-2"></i>
    </button>
</form>

<div class="auth-create-account">
    <p>Already have an account? <a href="<?= url('/login') ?>" class="auth-link">Sign In</a></p>
</div>
