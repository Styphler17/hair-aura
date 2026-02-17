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

                <?php
                    // Setup for partial
                    $inputName = 'library_logo';
                    $isMultiple = false;
                    $currentValue = $settings['logo'] ?? '';
                    $label = 'Or Pick From Media Library';
                    include __DIR__ . '/partials/media_library_selector.php';
                ?>
            </div>
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

        <div class="col-12 mt-4">
            <h4>Hero Slider Control</h4>
            <p class="text-muted">Manage the 3 slides on the homepage hero section.</p>
            <div class="row g-4">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <?php $slide = $settings['hero_slides'][$i] ?? []; ?>
                    <div class="col-lg-4">
                        <div class="card bg-light border-0">
                            <div class="card-header bg-dark text-white p-2 text-center h6 mb-0">Slide <?= $i + 1 ?></div>
                            <div class="card-body p-3">
                                <div class="mb-3">
                                    <label class="form-label font-monospace small">Title</label>
                                    <input type="text" name="hero_slides[<?= $i ?>][title]" class="form-control form-control-sm" value="<?= htmlspecialchars($slide['title'] ?? '') ?>" placeholder="Main headline">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label font-monospace small">Subtitle</label>
                                    <textarea name="hero_slides[<?= $i ?>][subtitle]" class="form-control form-control-sm" rows="2" placeholder="Sub headline"><?= htmlspecialchars($slide['subtitle'] ?? '') ?></textarea>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-7">
                                        <label class="form-label font-monospace small">Button Text</label>
                                        <input type="text" name="hero_slides[<?= $i ?>][button_text]" class="form-control form-control-sm" value="<?= htmlspecialchars($slide['button_text'] ?? '') ?>" placeholder="e.g. Shop Now">
                                    </div>
                                    <div class="col-5">
                                        <label class="form-label font-monospace small">Link</label>
                                        <input type="text" name="hero_slides[<?= $i ?>][button_link]" class="form-control form-control-sm" value="<?= htmlspecialchars($slide['button_link'] ?? '') ?>" placeholder="/shop">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label font-monospace small mb-1">Slide Image</label>
                                    <?php
                                        // Reuse partial for slide image
                                        $inputName = "hero_slides[$i][image]";
                                        $isMultiple = false;
                                        $currentValue = $slide['image'] ?? '';
                                        $label = ''; // Hide label to save space
                                        include __DIR__ . '/partials/media_library_selector.php';
                                    ?>
                                </div>
                                <div class="mt-2 text-center">
                                    <img src="<?= asset($slide['image'] ?? '/img/hero-1.webp') ?>" class="img-thumbnail" style="height: 60px; object-fit: cover;" onerror="this.src='/img/product-placeholder.webp'">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mt-4">
                <h4>Virtual Try-On</h4>
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img src="<?= asset($settings['virtual_tryon_image'] ?? '/img/product-placeholder.webp') ?>" class="img-thumbnail" style="height: 120px;" onerror="this.src='/img/product-placeholder.webp'">
                        </div>
                        <?php
                            // Setup for partial
                            $inputName = 'virtual_tryon_image';
                            $isMultiple = false;
                            $currentValue = $settings['virtual_tryon_image'] ?? '';
                            $label = 'Select Try-On Illustration';
                            include __DIR__ . '/partials/media_library_selector.php';
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <h4>Instagram Feed</h4>
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <p class="small text-muted mb-2">Select up to 6 images to display in the Instagram feed.</p>
                        <div class="d-flex gap-2 mb-3 overflow-auto pb-2">
                            <?php foreach (($settings['instagram_images'] ?? []) as $img): ?>
                                <img src="<?= asset($img) ?>" class="img-thumbnail" style="height: 50px; width: 50px; object-fit: cover;">
                            <?php endforeach; ?>
                        </div>
                        <?php
                            // Setup for partial
                            $inputName = 'instagram_images';
                            $isMultiple = true;
                            $currentValue = implode(',', (array) ($settings['instagram_images'] ?? []));
                            $label = 'Pick Instagram Images';
                            include __DIR__ . '/partials/media_library_selector.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary btn-lg w-100">Save Site Settings</button>
        </div>
    </div>
</form>
