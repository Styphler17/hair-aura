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

        <div class="col-md-3">
            <label class="form-label">Primary Color</label>
            <input type="color" name="theme_primary_picker" class="form-control form-control-color mb-2" value="<?= htmlspecialchars($settings['theme_primary'] ?? '#D4A574') ?>" oninput="this.nextElementSibling.value=this.value.toUpperCase()">
            <input type="text" name="theme_primary" class="form-control" value="<?= htmlspecialchars($settings['theme_primary'] ?? '#D4A574') ?>" pattern="^#[0-9A-Fa-f]{6}$" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Primary Dark</label>
            <input type="color" name="theme_primary_dark_picker" class="form-control form-control-color mb-2" value="<?= htmlspecialchars($settings['theme_primary_dark'] ?? '#B8935F') ?>" oninput="this.nextElementSibling.value=this.value.toUpperCase()">
            <input type="text" name="theme_primary_dark" class="form-control" value="<?= htmlspecialchars($settings['theme_primary_dark'] ?? '#B8935F') ?>" pattern="^#[0-9A-Fa-f]{6}$" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Secondary Color</label>
            <input type="color" name="theme_secondary_picker" class="form-control form-control-color mb-2" value="<?= htmlspecialchars($settings['theme_secondary'] ?? '#2C2C2C') ?>" oninput="this.nextElementSibling.value=this.value.toUpperCase()">
            <input type="text" name="theme_secondary" class="form-control" value="<?= htmlspecialchars($settings['theme_secondary'] ?? '#2C2C2C') ?>" pattern="^#[0-9A-Fa-f]{6}$" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Gold Color</label>
            <input type="color" name="theme_gold_picker" class="form-control form-control-color mb-2" value="<?= htmlspecialchars($settings['theme_gold'] ?? '#D4AF37') ?>" oninput="this.nextElementSibling.value=this.value.toUpperCase()">
            <input type="text" name="theme_gold" class="form-control" value="<?= htmlspecialchars($settings['theme_gold'] ?? '#D4AF37') ?>" pattern="^#[0-9A-Fa-f]{6}$" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save Site Settings</button>
        </div>
    </div>
</form>
