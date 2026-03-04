<?php
$isEdit = !empty($post);
$title = $isEdit ? 'Edit Blog Post' : 'Add Blog Post';
$mediaImages = $mediaImages ?? [];
$publishedAtValue = '';
if (!empty($post['published_at'])) {
    $publishedAtValue = date('Y-m-d\TH:i', strtotime($post['published_at']));
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0"><?= $title ?></h2>
    <a href="<?= url('/admin/blogs') ?>" class="btn btn-outline-secondary">Back to Posts</a>
</div>

<form method="post" action="<?= url('/admin/blogs/save') ?>" enctype="multipart/form-data" class="card">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <input type="hidden" name="id" value="<?= (int) ($post['id'] ?? 0) ?>">

        <div class="col-md-8">
            <label class="form-label text-primary fw-bold"><i class="fas fa-heading me-1"></i> Title</label>
            <input type="text" name="title" class="form-control hover-shadow transition" value="<?= htmlspecialchars($post['title'] ?? '') ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label text-primary fw-bold"><i class="fas fa-link me-1"></i> Slug</label>
            <input type="text" name="slug" class="form-control hover-shadow transition" value="<?= htmlspecialchars($post['slug'] ?? '') ?>" placeholder="auto-generated">
        </div>

        <div class="col-md-6">
            <label class="form-label text-success fw-bold"><i class="fas fa-folder me-1"></i> Category</label>
            <input type="text" name="category" class="form-control hover-shadow transition" value="<?= htmlspecialchars($post['category'] ?? 'General') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label text-success fw-bold"><i class="fas fa-tags me-1"></i> Tags (comma separated)</label>
            <input type="text" name="tags" class="form-control hover-shadow transition" value="<?= htmlspecialchars($post['tags'] ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label text-info fw-bold"><i class="fas fa-quote-left me-1"></i> Excerpt</label>
            <textarea name="excerpt" class="form-control hover-shadow transition" rows="2"><?= htmlspecialchars($post['excerpt'] ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label text-info fw-bold"><i class="fas fa-align-left me-1"></i> Content</label>
            <textarea name="content" class="form-control hover-shadow transition" rows="10" required><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label text-warning fw-bold"><i class="fas fa-image me-1"></i> Featured Image</label>
            
            <?php if (!empty($post['featured_image'])): ?>
            <div class="mb-3">
                <div class="position-relative d-inline-block">
                    <?php
                    $featImg = (string) ($post['featured_image'] ?? '');
                    if (str_starts_with($featImg, 'http')) {
                        $featImgPath = $featImg;
                    } elseif (str_starts_with($featImg, 'uploads/') || str_starts_with($featImg, 'img/')) {
                        $featImgPath = asset('/' . ltrim($featImg, '/'));
                    } else {
                        $featImgPath = asset('/uploads/blog/' . $featImg);
                    }
                    ?>
                    <img src="<?= $featImgPath ?>" 
                         alt="Current Featured Image" 
                         class="img-thumbnail transition zoom-on-hover" 
                         style="max-height: 200px;"
                         onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp'); ?>';">
                    <div class="form-text mt-1">Current: <?= htmlspecialchars($featImg) ?></div>
                </div>
            </div>
            <?php endif; ?>
            
            <input type="hidden" name="featured_image" value="<?= htmlspecialchars($post['featured_image'] ?? '') ?>">
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-warning"><i class="fas fa-upload me-1"></i> Upload New Image</label>
                    <input type="file" name="featured_image_file" class="form-control hover-shadow transition" accept=".jpg,.jpeg,.png,.webp">
                </div>
                
                <?php
                    // Setup for partial
                    $inputName = 'library_image';
                    $isMultiple = false;
                    $currentValue = $post['featured_image'] ?? '';
                    $label = 'Or Pick From Media Library';
                    include __DIR__ . '/../partials/media_library_selector.php';
                ?>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label text-secondary fw-bold"><i class="fas fa-search me-1"></i> Meta Title</label>
            <input type="text" name="meta_title" class="form-control hover-shadow transition" value="<?= htmlspecialchars($post['meta_title'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label text-secondary fw-bold"><i class="fas fa-info-circle me-1"></i> Meta Description</label>
            <input type="text" name="meta_description" class="form-control hover-shadow transition" value="<?= htmlspecialchars($post['meta_description'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label text-dark fw-bold"><i class="fas fa-calendar-alt me-1"></i> Published At</label>
            <input type="datetime-local" name="published_at" class="form-control hover-shadow transition" value="<?= htmlspecialchars($publishedAtValue) ?>">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" <?= !empty($post['is_published']) ? 'checked' : '' ?>>
                <label class="form-check-label text-dark fw-bold" for="is_published">Published</label>
            </div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Post</button>
            <a href="<?= url('/admin/blogs') ?>" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>
