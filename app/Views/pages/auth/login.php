<section class="py-4">
    <h2 class="mb-3">Login</h2>
    <form method="post" action="<?= url('/login') ?>" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <div class="col-12">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="phone" class="form-control" placeholder="+233xxxxxxxxx" value="<?= htmlspecialchars($_SESSION['old_input']['phone'] ?? '') ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-12 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
            <label for="remember" class="form-check-label">Remember me</label>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="<?= url('/forgot-password') ?>" class="btn btn-outline-secondary">Forgot Password</a>
        </div>
    </form>
    <p class="mt-3 mb-0">
        No account? <a href="<?= url('/register') ?>">Create one</a>
    </p>
    <p class="mt-2 mb-0 small text-muted">
        Admin? Use <a href="<?= url('/admin/login') ?>">admin email login</a>.
    </p>
</section>
