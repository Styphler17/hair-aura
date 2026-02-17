<?php
$items = $items ?? [];
$folderStats = $folderStats ?? [];
$filters = $filters ?? ['search' => '', 'folder' => '', 'mime' => 'images', 'sort' => 'newest'];

$resolveMediaUrl = static function (array $item): string {
    $path = trim((string) ($item['file_path'] ?? ''));
    if ($path === '') {
        return asset('/img/product-placeholder.webp');
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
    <form id="bulkActionForm" method="post" action="<?= url('/admin/media/bulk-delete') ?>">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAllItems">
                <label class="form-check-label" for="selectAllItems">Select All</label>
            </div>
        </div>
        <div class="media-gallery-grid">
            <?php foreach ($items as $item): ?>
                <?php
                $url = $resolveMediaUrl($item);
                $relativePath = (string) ($item['file_path'] ?? '');
                $sizeKb = ((int) ($item['size_bytes'] ?? 0)) > 0 ? round(((int) $item['size_bytes']) / 1024, 1) : 0;
                $itemId = (int) ($item['id'] ?? 0);
                ?>
                <article class="media-card position-relative">
                    <div class="position-absolute top-0 start-0 m-2" style="z-index: 5;">
                        <input class="form-check-input item-checkbox shadow-sm" type="checkbox" name="ids[]" value="<?= $itemId ?>" style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                    </div>
                    <div class="media-preview">
                        <?php if ($isImage($item)): ?>
                            <img src="<?= htmlspecialchars($url) ?>" alt="<?= htmlspecialchars((string) ($item['alt_text'] ?? $item['file_name'] ?? 'Media')) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
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
                            <?php if ($isImage($item)): ?>
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary js-open-image-modal" 
                                        data-url="<?= htmlspecialchars($url) ?>"
                                        data-name="<?= htmlspecialchars((string) ($item['file_name'] ?? '')) ?>"
                                        data-meta="<?= $sizeKb ?> KB • <?= htmlspecialchars((string) ($item['folder'] ?? 'media')) ?>">
                                    Open
                                </button>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($url) ?>" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">Open</a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="renameMedia(<?= $itemId ?>, '<?= htmlspecialchars(addslashes((string)($item['file_name'] ?? ''))) ?>')">Rename</button>
                            <button type="button" 
                                    class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteItemModal" 
                                    data-id="<?= $itemId ?>"
                                    data-title="<?= htmlspecialchars((string)($item['file_name'] ?? '')) ?>">
                                Delete
                            </button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </form>
<?php endif; ?>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 d-none" style="z-index: 1050;">
    <div class="card shadow-lg border-0 bg-dark text-white px-4 py-3">
        <div class="d-flex align-items-center gap-4">
            <div><span id="selectedCount">0</span> items selected</div>
            <div class="vr"></div>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                <i class="fas fa-trash-alt me-2"></i>Delete Selected
            </button>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Bulk Delete Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Delete <span id="bulkDeleteCount">0</span> files?</h4>
                <p class="text-muted">This action will delete the selected files from the disk and database. This cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4" id="confirmBulkDelete">Yes, Delete All</button>
            </div>
        </div>
    </div>
</div>

<!-- Single Delete Confirmation Modal -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Delete Media File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                    <h4 class="fw-bold">Are you sure?</h4>
                    <p class="text-muted">You are about to delete the following file:</p>
                    <div class="p-3 bg-light rounded text-start italic border-start border-danger border-4 mx-3">
                        <span id="itemToDeleteTitle" class="fw-semibold"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">No, Cancel</button>
                <form id="deleteItemForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4">Yes, Delete It</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg bg-transparent">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                <img id="previewImageSource" src="" class="img-fluid rounded shadow w-100" style="max-height: 90vh; object-fit: contain;">
                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-75 text-white rounded-bottom">
                    <div id="previewImageName" class="fw-bold fs-5"></div>
                    <div id="previewImageMeta" class="small text-white-50"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function renameMedia(id, currentName) {
    const newName = prompt('New filename (keep extension):', currentName);
    if (newName && newName !== currentName) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= url('/admin/media/rename') ?>';
        const csrf = document.createElement('input');
        csrf.type = 'hidden'; csrf.name = 'csrf_token'; csrf.value = '<?= \App\Core\Auth::csrfToken() ?>'; form.appendChild(csrf);
        const idInput = document.createElement('input');
        idInput.type = 'hidden'; idInput.name = 'id'; idInput.value = id; form.appendChild(idInput);
        const nameInput = document.createElement('input');
        nameInput.type = 'hidden'; nameInput.name = 'new_name'; nameInput.value = newName; form.appendChild(nameInput);
        document.body.appendChild(form);
        form.submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Single Delete Modal
    const deleteModal = document.getElementById('deleteItemModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const form = document.getElementById('deleteItemForm');
            const titleSpan = document.getElementById('itemToDeleteTitle');
            form.action = '<?= url('/admin/media/delete/') ?>' + id;
            titleSpan.textContent = title;
        });
    }

    // Multi-select Logic
    const selectAll = document.getElementById('selectAllItems');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const bulkBar = document.getElementById('bulkActionsBar');
    const selectedCountSpan = document.getElementById('selectedCount');
    const bulkDeleteCountSpan = document.getElementById('bulkDeleteCount');
    const bulkForm = document.getElementById('bulkActionForm');
    const confirmBulk = document.getElementById('confirmBulkDelete');

    function updateBulkBar() {
        const checked = document.querySelectorAll('.item-checkbox:checked').length;
        if (checked > 0) {
            bulkBar.classList.remove('d-none');
            selectedCountSpan.textContent = checked;
            bulkDeleteCountSpan.textContent = checked;
        } else {
            bulkBar.classList.add('d-none');
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateBulkBar();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            const allChecked = Array.from(checkboxes).every(c => c.checked);
            if (selectAll) selectAll.checked = allChecked;
            updateBulkBar();
        });
    });

    if (confirmBulk) {
        confirmBulk.addEventListener('click', function() {
            bulkForm.submit();
        });
    }

    // Image Preview Logic
    const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    const previewImg = document.getElementById('previewImageSource');
    const previewName = document.getElementById('previewImageName');
    const previewMeta = document.getElementById('previewImageMeta');

    document.querySelectorAll('.js-open-image-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            const name = this.dataset.name;
            const meta = this.dataset.meta;

            previewImg.src = url;
            previewName.textContent = name;
            previewMeta.textContent = meta;
            imagePreviewModal.show();
        });
    });

    // Copy path logic
    document.querySelectorAll('.js-copy-media-path').forEach(btn => {
        btn.addEventListener('click', function() {
            const path = this.dataset.copy;
            navigator.clipboard.writeText(path).then(() => {
                const originalText = this.innerText;
                this.innerText = 'Copied!';
                this.classList.replace('btn-outline-secondary', 'btn-success');
                setTimeout(() => {
                    this.innerText = originalText;
                    this.classList.replace('btn-success', 'btn-outline-secondary');
                }, 1500);
            });
        });
    });
});
</script>
