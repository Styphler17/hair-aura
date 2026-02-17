<h2 class="mb-3">Site Settings</h2>

<form method="post" action="<?= url('/admin/settings') ?>" class="card" enctype="multipart/form-data">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

        <div class="col-12 mb-3">
            <label class="form-label">Site Logo</label>
            
            <div class="mb-3">
                <div class="d-flex align-items-center gap-3 p-3 border rounded bg-light">
                    <img src="<?= asset($settings['logo'] ?? '/img/logo.webp') ?>" alt="Current Logo" style="height: 60px;">
                    <div>
                        <div class="fw-bold">Current Logo</div>
                        <code class="text-muted"><?= htmlspecialchars($settings['logo'] ?? '/img/logo.webp') ?></code>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Upload New Logo</label>
                    <input type="file" name="logo" class="form-control" accept=".png,.jpg,.jpeg,.webp">
                    <div class="form-text">Uploading a file will replace <code>/img/logo.webp</code> and set it as active.</div>
                </div>

                <div class="col-12">
                    <label class="form-label">Or Pick From Media Library</label>
                    <div class="border rounded p-3 bg-white">
                        <div class="d-flex justify-content-between mb-2">
                            <input type="text" class="form-control w-auto" placeholder="Search library..." onkeyup="filterMediaCheckboxes(this)">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.querySelectorAll('input[name=library_logo]').forEach(el => el.checked = false)">Clear Selection</button>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 media-checkbox-container" style="max-height: 300px; overflow-y: auto;">
                            <?php foreach (($mediaImages ?? []) as $media): ?>
                                <?php 
                                    $mPath = $media['file_path'] ?? '';
                                    if (str_starts_with($mPath, 'uploads/')) {
                                        $mPath = '/' . $mPath;
                                    } elseif (!str_starts_with($mPath, '/')) {
                                        $mPath = '/' . $mPath;
                                    }
                                    
                                    $mName = $media['file_name'] ?? 'image';
                                    $mId = $media['id'] ?? uniqid();
                                    $isSelected = ($settings['logo'] ?? '') === $mPath;
                                ?>
                                <div class="media-checkbox-option position-relative" style="width: 100px; height: 100px;" data-name="<?= htmlspecialchars($mName) ?>">
                                    <input type="radio" name="library_logo" value="<?= htmlspecialchars($mPath) ?>" id="media_<?= $mId ?>" class="btn-check" <?= $isSelected ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-light p-0 w-100 h-100 overflow-hidden border shadow-sm d-flex align-items-center justify-content-center" for="media_<?= $mId ?>">
                                        <img src="<?= asset($mPath) ?>" alt="<?= htmlspecialchars($mName) ?>" 
                                             class="w-100 h-100" style="object-fit: contain; padding: 4px;"
                                             title="<?= htmlspecialchars($mName) ?>"
                                             onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                                    </label>
                                    <div class="position-absolute top-0 end-0 p-1">
                                        <i class="fas fa-check-circle text-primary bg-white rounded-circle check-icon" style="opacity: 0; transition: opacity 0.2s;"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-text">Selecting a library image sets it as the active logo path.</div>
                </div>
            </div>
            
            <style>
                .btn-check:checked + label {
                    border-color: var(--bs-primary, #0d6efd) !important;
                    border-width: 3px !important;
                }
                .btn-check:checked ~ div .check-icon {
                    opacity: 1 !important;
                }
                .media-checkbox-option label:hover {
                    border-color: #adb5bd !important;
                }
            </style>
            
            <script>
            function filterMediaCheckboxes(input) {
                const filter = input.value.toLowerCase();
                const container = input.closest('.border').querySelector('.media-checkbox-container'); 
                const items = container.querySelectorAll('.media-checkbox-option[data-name]');
                items.forEach(item => {
                    const name = item.getAttribute('data-name').toLowerCase();
                    if (name.includes(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
            </script>
        </div>

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
