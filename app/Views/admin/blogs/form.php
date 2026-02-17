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
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title'] ?? '') ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($post['slug'] ?? '') ?>" placeholder="auto-generated">
        </div>

        <div class="col-md-6">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($post['category'] ?? 'General') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Tags (comma separated)</label>
            <input type="text" name="tags" class="form-control" value="<?= htmlspecialchars($post['tags'] ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label">Excerpt</label>
            <textarea name="excerpt" class="form-control" rows="2"><?= htmlspecialchars($post['excerpt'] ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="10" required><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label">Featured Image</label>
            
            <?php if (!empty($post['featured_image'])): ?>
            <div class="mb-3">
                <div class="position-relative d-inline-block">
                    <img src="<?= asset(str_starts_with($post['featured_image'], 'http') ? $post['featured_image'] : '/uploads/blog/' . $post['featured_image']) ?>" 
                         alt="Current Featured Image" 
                         class="img-thumbnail" 
                         style="max-height: 200px;"
                         onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                    <div class="form-text mt-1">Current: <?= htmlspecialchars($post['featured_image']) ?></div>
                </div>
            </div>
            <?php endif; ?>
            
            <input type="hidden" name="featured_image" value="<?= htmlspecialchars($post['featured_image'] ?? '') ?>">
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Upload New Image</label>
                    <input type="file" name="featured_image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                </div>
                
                <div class="col-12">
                    <label class="form-label">Or Pick From Media Library</label>
                    <div class="border rounded p-3 bg-white">
                        <div class="d-flex justify-content-between mb-2">
                            <input type="text" class="form-control w-auto" placeholder="Search library..." onkeyup="filterMediaCheckboxes(this)">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.querySelectorAll('input[name=library_image]').forEach(el => el.checked = false)">Clear Selection</button>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 media-checkbox-container" style="max-height: 300px; overflow-y: auto;">
                            <?php foreach ($mediaImages as $media): ?>
                                <?php 
                                    $mPath = $media['file_path'] ?? '';
                                    $mName = $media['file_name'] ?? 'image';
                                    $mId = $media['id'] ?? uniqid();
                                ?>
                                <div class="media-checkbox-option position-relative" style="width: 100px; height: 100px;" data-name="<?= htmlspecialchars($mName) ?>">
                                    <input type="radio" name="library_image" value="<?= htmlspecialchars($mPath) ?>" id="media_<?= $mId ?>" class="btn-check">
                                    <label class="btn btn-outline-light p-0 w-100 h-100 overflow-hidden border shadow-sm d-flex align-items-center justify-content-center" for="media_<?= $mId ?>">
                                        <img src="<?= asset($mPath) ?>" alt="<?= htmlspecialchars($mName) ?>" 
                                             class="w-100 h-100" style="object-fit: cover;"
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
                    <div class="form-text">Selecting a library image will override the current featured image. Uploading a new file overrides both.</div>
                </div>
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

        <div class="col-md-6">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($post['meta_title'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Meta Description</label>
            <input type="text" name="meta_description" class="form-control" value="<?= htmlspecialchars($post['meta_description'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Published At</label>
            <input type="datetime-local" name="published_at" class="form-control" value="<?= htmlspecialchars($publishedAtValue) ?>">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" <?= !empty($post['is_published']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_published">Published</label>
            </div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Post</button>
            <a href="<?= url('/admin/blogs') ?>" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>
