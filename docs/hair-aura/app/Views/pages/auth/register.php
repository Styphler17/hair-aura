<section class="py-4">
    <h2 class="mb-3">Create Account</h2>
    <form method="post" action="<?= url('/register') ?>" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="+233xxxxxxxxx" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>
        <div class="col-12 form-check">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" required>
            <label for="terms" class="form-check-label">I agree to the terms.</label>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
    <p class="mt-3 mb-0">
        Already have an account? <a href="<?= url('/login') ?>">Login</a>
    </p>
</section>
