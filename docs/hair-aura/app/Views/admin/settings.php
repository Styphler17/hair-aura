<h2 class="mb-3">Site Settings</h2>

<form method="post" action="<?= url('/admin/settings') ?>" class="card">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

        <div class="col-md-6">
            <label class="form-label">Site Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($settings['name'] ?? 'Hair Aura') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Tagline</label>
            <input type="text" name="tagline" class="form-control" value="<?= htmlspecialchars($settings['tagline'] ?? '') ?>" required>
        </div>

        <div class="col-12">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="3"><?= htmlspecialchars($settings['meta_description'] ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label">Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" value="<?= htmlspecialchars($settings['meta_keywords'] ?? '') ?>">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save Site Settings</button>
        </div>
    </div>
</form>