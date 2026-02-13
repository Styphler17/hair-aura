<?php
$items = $items ?? [];
$folderStats = $folderStats ?? [];
$filters = $filters ?? ['search' => '', 'folder' => '', 'mime' => 'images', 'sort' => 'newest'];

$resolveMediaUrl = static function (array $item): string {
    $path = trim((string) ($item['file_path'] ?? ''));
    if ($path === '') {
        return asset('/img/product-placeholder.png');
    }

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    return asset('/' . ltrim($path, '/'));
};

$isImage = static function (array $item): bool {
    $mime = strtolower((string) ($item['mime_type'] ?? ''));
    return str_starts_with($mime, 'image/');
};
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Media Library</h2>
    <form method="post" action="<?= url('/admin/media/sync') ?>">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <button type="submit" class="btn btn-outline-primary">Sync From DB Upload Paths</button>
    </form>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Upload Media</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?= url('/admin/media/upload') ?>" enctype="multipart/form-data" class="row g-2">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="col-lg-5">
                <label class="form-label">Files</label>
                <input type="file" name="media_files[]" class="form-control" multiple required>
            </div>
            <div class="col-lg-2">
                <label class="form-label">Folder</label>
                <select name="folder" class="form-select">
                    <option value="media">media</option>
                    <option value="products">products</option>
                    <option value="blog">blog</option>
                    <option value="categories">categories</option>
                    <option value="avatars">avatars</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label class="form-label">Alt text</label>
                <input type="text" name="alt_text" class="form-control" placeholder="Optional">
            </div>
            <div class="col-lg-2">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" placeholder="comma,tags">
            </div>
            <div class="col-lg-1 d-grid">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>

<form method="get" action="<?= url('/admin/media') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-lg-4">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars((string) ($filters['search'] ?? '')) ?>" placeholder="File name, path, tags">
        </div>
        <div class="col-lg-2">
            <label class="form-label">Folder</label>
            <select name="folder" class="form-select">
                <option value="">All</option>
                <?php foreach ($folderStats as $stat): ?>
                    <?php $folder = (string) ($stat['folder'] ?? 'media'); ?>
                    <option value="<?= htmlspecialchars($folder) ?>" <?= (($filters['folder'] ?? '') === $folder) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($folder) ?> (<?= (int) ($stat['total'] ?? 0) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Type</label>
            <select name="mime" class="form-select">
                <option value="images" <?= (($filters['mime'] ?? 'images') === 'images') ? 'selected' : '' ?>>Images</option>
                <option value="video" <?= (($filters['mime'] ?? '') === 'video') ? 'selected' : '' ?>>Video</option>
                <option value="documents" <?= (($filters['mime'] ?? '') === 'documents') ? 'selected' : '' ?>>Documents</option>
                <option value="all" <?= (($filters['mime'] ?? '') === 'all') ? 'selected' : '' ?>>All</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Sort</label>
            <select name="sort" class="form-select">
                <option value="newest" <?= (($filters['sort'] ?? 'newest') === 'newest') ? 'selected' : '' ?>>Newest</option>
                <option value="oldest" <?= (($filters['sort'] ?? '') === 'oldest') ? 'selected' : '' ?>>Oldest</option>
                <option value="name_asc" <?= (($filters['sort'] ?? '') === 'name_asc') ? 'selected' : '' ?>>Name A-Z</option>
                <option value="name_desc" <?= (($filters['sort'] ?? '') === 'name_desc') ? 'selected' : '' ?>>Name Z-A</option>
                <option value="size_desc" <?= (($filters['sort'] ?? '') === 'size_desc') ? 'selected' : '' ?>>Size High-Low</option>
                <option value="size_asc" <?= (($filters['sort'] ?? '') === 'size_asc') ? 'selected' : '' ?>>Size Low-High</option>
            </select>
        </div>
        <div class="col-lg-2 d-grid">
            <button class="btn btn-outline-primary">Apply</button>
        </div>
    </div>
</form>

<?php if (empty($items)): ?>
    <div class="alert alert-info mb-0">No media files found for the selected filter.</div>
<?php else: ?>
    <div class="media-gallery-grid">
        <?php foreach ($items as $item): ?>
            <?php
            $url = $resolveMediaUrl($item);
            $relativePath = (string) ($item['file_path'] ?? '');
            $sizeKb = ((int) ($item['size_bytes'] ?? 0)) > 0 ? round(((int) $item['size_bytes']) / 1024, 1) : 0;
            ?>
            <article class="media-card">
                <div class="media-preview">
                    <?php if ($isImage($item)): ?>
                        <img src="<?= htmlspecialchars($url) ?>" alt="<?= htmlspecialchars((string) ($item['alt_text'] ?? $item['file_name'] ?? 'Media')) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                    <?php else: ?>
                        <div class="media-icon-wrap">
                            <i class="fas fa-file"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="media-meta">
                    <div class="media-name" title="<?= htmlspecialchars((string) ($item['file_name'] ?? '')) ?>">
                        <?= htmlspecialchars((string) ($item['file_name'] ?? '')) ?>
                    </div>
                    <div class="media-sub"><?= htmlspecialchars((string) ($item['folder'] ?? 'media')) ?> • <?= $sizeKb ?> KB</div>
                    <div class="media-path" title="<?= htmlspecialchars($relativePath) ?>"><?= htmlspecialchars($relativePath) ?></div>
                    <div class="media-actions">
                        <button type="button" class="btn btn-sm btn-outline-secondary js-copy-media-path" data-copy="<?= htmlspecialchars($relativePath) ?>">Copy Path</button>
                        <a href="<?= htmlspecialchars($url) ?>" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">Open</a>
                        <form method="post" action="<?= url('/admin/media/delete/' . (int) ($item['id'] ?? 0)) ?>" class="d-inline">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
