<h2 class="mb-3">About Page Content</h2>

<form method="post" action="<?= url('/admin/about-page') ?>" class="card">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

        <div class="col-12">
            <label class="form-label">Heading</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($about['title'] ?? '') ?>" required>
        </div>

        <div class="col-12">
            <label class="form-label">Body Content</label>
            <textarea name="content" class="form-control" rows="10" required><?= htmlspecialchars($about['content'] ?? '') ?></textarea>
            <small class="text-muted">Use blank lines to create paragraph breaks.</small>
        </div>

        <div class="col-md-6">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" value="<?= htmlspecialchars($about['button_text'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Button URL</label>
            <input type="text" name="button_url" class="form-control" value="<?= htmlspecialchars($about['button_url'] ?? '/shop') ?>" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save About Content</button>
        </div>
    </div>
</form>