<section class="py-4">
    <h2 class="mb-3">Forgot Password</h2>
    <p class="text-muted">Enter your email and we will send reset instructions.</p>
    <form method="post" action="<?= url('/forgot-password') ?>" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <div class="col-12">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Send Reset Link</button>
        </div>
    </form>
</section>
