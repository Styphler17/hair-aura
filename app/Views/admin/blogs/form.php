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

        <div class="col-md-6">
            <label class="form-label">Featured Image (filename)</label>
            <input type="text" name="featured_image" class="form-control" value="<?= htmlspecialchars($post['featured_image'] ?? '') ?>" placeholder="image.jpg">
        </div>
        <div class="col-md-6">
            <label class="form-label">Upload Featured Image</label>
            <input type="file" name="featured_image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        </div>
        <div class="col-md-12">
            <label class="form-label">Or Pick From Media Library</label>
            <select name="library_image" class="form-select">
                <option value="">Choose image from library</option>
                <?php foreach ($mediaImages as $media): ?>
                    <option value="<?= htmlspecialchars((string) ($media['file_path'] ?? '')) ?>">
                        <?= htmlspecialchars((string) ($media['file_name'] ?? 'image')) ?> (<?= htmlspecialchars((string) ($media['folder'] ?? 'media')) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="form-text">Need more files? Open <a href="<?= url('/admin/media') ?>" target="_blank" rel="noopener">Media Library</a>.</div>
        </div>

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
