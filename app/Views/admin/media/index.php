

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 fw-bold"><i class="fas fa-photo-film me-2 text-primary"></i>Media Library</h2>
    <div class="d-flex gap-2">
        <form method="post" action="<?= url('/admin/media/sync') ?>" class="d-inline">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <button type="submit" class="btn btn-outline-secondary transition" title="Sync with filesystem">
                <i class="fas fa-sync-alt me-1"></i> Sync
            </button>
        </form>
        <button class="btn btn-primary shadow-sm transition" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
            <i class="fas fa-cloud-upload-alt me-1"></i> Upload
        </button>
    </div>
</div>

<!-- Filters Bar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="get" action="<?= url('/admin/media') ?>" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted">Folder</label>
                <select name="folder" class="form-select border-0 bg-light" onchange="this.form.submit()">
                    <option value="">All Folders</option>
                    <?php if (!empty($folderStats)): ?>
                        <?php foreach ($folderStats as $stat): ?>
                            <option value="<?= htmlspecialchars($stat['folder']) ?>" <?= ($filters['folder'] === $stat['folder']) ? 'selected' : '' ?>>
                                <?= ucfirst(htmlspecialchars($stat['folder'])) ?> (<?= (int)$stat['total'] ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted">File Type</label>
                <select name="mime" class="form-select border-0 bg-light" onchange="this.form.submit()">
                    <option value="images" <?= ($filters['mime'] === 'images') ? 'selected' : '' ?>>Images</option>
                    <option value="video" <?= ($filters['mime'] === 'video') ? 'selected' : '' ?>>Video</option>
                    <option value="documents" <?= ($filters['mime'] === 'documents') ? 'selected' : '' ?>>Documents</option>
                    <option value="all" <?= ($filters['mime'] === 'all') ? 'selected' : '' ?>>All Files</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted">Search</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-light"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-light" placeholder="File name, alt text..." value="<?= htmlspecialchars($filters['search']) ?>">
                </div>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-dark transition">Apply</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <form id="bulkActionForm" method="post" action="<?= url('/admin/media/bulk-delete') ?>">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="selectAllItems">
                    <label class="form-check-label small fw-bold text-secondary" for="selectAllItems">Select All</label>
                </div>
                <div class="text-muted small">
                    Showing <?= count($items) ?> files
                </div>
            </div>

            <div class="media-gallery-grid p-3">
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <?php 
                        $isImage = str_starts_with($item['mime_type'], 'image/'); 
                        $url = asset($item['file_path']);
                        ?>
                        <div class="media-card-wrapper position-relative" data-id="<?= (int)$item['id'] ?>">
                            <div class="media-card h-100 shadow-sm border rounded overflow-hidden transition-all bg-white">
                                <div class="media-card-preview position-relative bg-light d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1;">
                                    <div class="position-absolute top-0 start-0 p-2" style="z-index: 5;">
                                        <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="<?= (int)$item['id'] ?>">
                                    </div>
                                    
                                    <?php if ($isImage): ?>
                                        <img src="<?= $url ?>" alt="<?= htmlspecialchars($item['alt_text'] ?? '') ?>" class="img-fluid w-100 h-100 object-fit-cover cursor-pointer js-open-image-modal" 
                                             data-url="<?= $url ?>" data-name="<?= htmlspecialchars($item['file_name']) ?>" 
                                             data-meta="<?= ucfirst($item['folder']) ?> &bull; <?= size_format($item['size_bytes']) ?>">
                                    <?php else: ?>
                                        <div class="text-center">
                                            <i class="fas fa-file-alt fa-3x text-secondary opacity-50"></i>
                                            <div class="small mt-2 text-muted"><?= strtoupper(pathinfo($item['file_name'], PATHINFO_EXTENSION)) ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="media-card-actions position-absolute bottom-0 start-0 w-100 p-2 bg-dark bg-opacity-75 d-flex justify-content-center gap-2 transition opacity-0">
                                        <button type="button" class="btn btn-sm btn-light p-1" onclick="renameMedia(<?= $item['id'] ?>, '<?= htmlspecialchars($item['file_name']) ?>')" title="Rename"><i class="fas fa-edit fa-fw"></i></button>
                                        <button type="button" class="btn btn-sm btn-primary p-1 js-copy-media-path" data-copy="<?= $item['file_path'] ?>" title="Copy Path"><i class="fas fa-link fa-fw"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger p-1" data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-id="<?= $item['id'] ?>" data-title="<?= htmlspecialchars($item['file_name']) ?>" title="Delete"><i class="fas fa-trash fa-fw"></i></button>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="small fw-bold text-truncate" title="<?= htmlspecialchars($item['file_name']) ?>"><?= htmlspecialchars($item['file_name']) ?></div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <span class="badge bg-light text-dark border p-1" style="font-size: 0.65rem;"><?= size_format($item['size_bytes']) ?></span>
                                        <span class="text-muted" style="font-size: 0.65rem;"><?= date('M d, Y', strtotime($item['created_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 py-5 text-center text-muted">
                        <i class="fas fa-photo-film fa-3x mb-3 opacity-25"></i>
                        <p>No media files found in this collection.</p>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">Upload your first file</button>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 d-none" style="z-index: 1050;">
    <div class="card shadow-lg border-0 bg-dark text-white px-4 py-3">
        <div class="d-flex align-items-center gap-4">
            <div><span id="selectedCount" class="fw-bold text-warning">0</span> files selected</div>
            <div class="vr"></div>
            <button type="button" class="btn btn-danger btn-sm px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                <i class="fas fa-trash-alt me-2"></i>Delete Selected
            </button>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadMediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white border-0">
                <h5 class="modal-title fw-bold"><i class="fas fa-cloud-upload-alt me-2"></i>Upload to Media Library</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('/admin/media/upload') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-primary">Destination Folder</label>
                        <div class="row g-2">
                             <?php foreach (['media', 'products', 'categories', 'blog', 'avatars'] as $folder): ?>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <input type="radio" class="btn-check" name="folder" id="f_<?= $folder ?>" value="<?= $folder ?>" <?= $folder === 'media' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-secondary w-100 text-capitalize py-2" for="f_<?= $folder ?>">
                                        <?= $folder ?>
                                    </label>
                                </div>
                             <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="mb-4 text-center">
                        <div class="upload-drop-zone p-5 border-2 border-dashed rounded bg-light hover-shadow transition cursor-pointer" id="dropZone">
                            <i class="fas fa-images fa-4x text-muted mb-3"></i>
                            <h5 class="fw-bold">Drag and drop files here</h5>
                            <p class="text-muted small">or click to browse from your device</p>
                            <input type="file" name="media_files[]" id="fileInput" class="d-none" multiple accept="image/*,video/*,application/pdf">
                            <button type="button" class="btn btn-sm btn-outline-primary px-4 mt-2" onclick="document.getElementById('fileInput').click()">Browse Files</button>
                        </div>
                        <div id="fileListPreview" class="mt-3 text-start small text-muted"></div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Default Alt Text</label>
                                <input type="text" name="alt_text" class="form-control" placeholder="Optional SEO alt text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tags (comma separated)</label>
                            <input type="text" name="tags" class="form-control" placeholder="e.g. hair, premium, wig">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">Start Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
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
            form.action = '<?= url("/admin/media/delete/") ?>' + id;
            titleSpan.textContent = title;
        });
    }

    // Multi-select Logic
    const selectAll = document.getElementById('selectAllItems');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const bulkBar = document.getElementById('bulkActionsBar');
    const selectedCountSpan = document.getElementById('selectedCount');
    const bulkDeleteCountSpan = document.getElementById('bulkDeleteCount');

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

    // Image Preview Logic
    const previewImg = document.getElementById('previewImageSource');
    const previewName = document.getElementById('previewImageName');
    const previewMeta = document.getElementById('previewImageMeta');
    const imagePreviewModalObj = new bootstrap.Modal(document.getElementById('imagePreviewModal'));

    document.querySelectorAll('.js-open-image-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            previewImg.src = this.dataset.url;
            previewName.textContent = this.dataset.name;
            previewMeta.innerHTML = this.dataset.meta;
            imagePreviewModalObj.show();
        });
    });

    // Dropzone logic
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('fileListPreview');

    if (dropZone) {
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-primary');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-primary');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-primary');
            fileInput.files = e.dataTransfer.files;
            updateFilePreview();
        });

        fileInput.addEventListener('change', updateFilePreview);

        function updateFilePreview() {
            const files = fileInput.files;
            if (files.length > 0) {
                let html = '<strong>Selected files:</strong><ul>';
                for (let i = 0; i < files.length; i++) {
                    html += `<li>${files[i].name} (${size_format(files[i].size)})</li>`;
                }
                html += '</ul>';
                filePreview.innerHTML = html;
            }
        }
    }

    function size_format(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>


