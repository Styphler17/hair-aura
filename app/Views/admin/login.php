<section class="py-4">
    <h2 class="mb-3">Admin Login</h2>
    <form method="post" action="<?= url('/admin/login') ?>" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <div class="col-12">
            <label class="form-label">Admin Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</section>
