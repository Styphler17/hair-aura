<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Trash Management</h2>
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#emptyTrashModal">
        <i class="fas fa-trash-restore me-2"></i>Empty Trash
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-3">
        <ul class="nav nav-pills card-header-pills" id="trashTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">
                    Products <span class="badge border border-white ms-1"><?= count($products) ?></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="blogs-tab" data-bs-toggle="tab" data-bs-target="#blogs" type="button" role="tab">
                    Blog Posts <span class="badge bg-secondary ms-1"><?= count($blogs) ?></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab">
                    Media <span class="badge bg-secondary ms-1"><?= count($media) ?></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button" role="tab">
                    Notes <span class="badge bg-secondary ms-1"><?= count($notes) ?></span>
                </button>
            </li>
        </ul>
    </div>
    <div class="card-body p-0">
        <div class="tab-content" id="trashTabsContent">
            <!-- Products Tab -->
            <div class="tab-pane fade show active" id="products" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table-mobile">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Deleted At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $p): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold" data-label="Product"><?= htmlspecialchars($p['name']) ?></td>
                                        <td data-label="SKU"><?= htmlspecialchars($p['sku'] ?? '-') ?></td>
                                        <td data-label="Price"><?= money($p['price']) ?></td>
                                        <td data-label="Deleted At"><?= date('M d, Y H:i', strtotime($p['deleted_at'])) ?></td>
                                        <td class="text-end pe-4" data-label="Actions">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-success btn-restore" data-type="product" data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>">
                                                    <i class="fas fa-undo me-1"></i>Restore
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-perm" data-type="product" data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>">
                                                    <i class="fas fa-times me-1"></i>Delete Permanently
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No trashed products.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Blogs Tab -->
            <div class="tab-pane fade" id="blogs" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table-mobile">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Post Title</th>
                                <th>Category</th>
                                <th>Deleted At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($blogs)): ?>
                                <?php foreach ($blogs as $b): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold" data-label="Title"><?= htmlspecialchars($b['title']) ?></td>
                                        <td data-label="Category"><span class="badge bg-light text-dark"><?= htmlspecialchars($b['category']) ?></span></td>
                                        <td data-label="Deleted At"><?= date('M d, Y H:i', strtotime($b['deleted_at'])) ?></td>
                                        <td class="text-end pe-4" data-label="Actions">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-success btn-restore" data-type="blog" data-id="<?= $b['id'] ?>" data-name="<?= htmlspecialchars($b['title']) ?>">
                                                    <i class="fas fa-undo me-1"></i>Restore
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-perm" data-type="blog" data-id="<?= $b['id'] ?>" data-name="<?= htmlspecialchars($b['title']) ?>">
                                                    <i class="fas fa-times me-1"></i>Delete Permanently
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">No trashed blog posts.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Media Tab -->
            <div class="tab-pane fade" id="media" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table-mobile">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">File</th>
                                <th>Path</th>
                                <th>Folder</th>
                                <th>Deleted At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($media)): ?>
                                <?php foreach ($media as $m): ?>
                                    <tr>
                                        <td class="ps-4 d-flex align-items-center gap-3" data-label="File">
                                            <?php if (str_starts_with($m['file_path'], 'uploads/products/') || str_contains($m['file_path'], 'product')): ?>
                                                <img src="<?= asset('/' . $m['file_path']) ?>" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-file text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <span class="fw-bold text-truncate" style="max-width: 200px;"><?= htmlspecialchars($m['file_name']) ?></span>
                                        </td>
                                        <td class="small text-muted text-truncate" style="max-width: 250px;" data-label="Path"><?= htmlspecialchars($m['file_path']) ?></td>
                                        <td data-label="Folder"><span class="badge text-white bg-primary"><?= htmlspecialchars($m['folder']) ?></span></td>
                                        <td data-label="Deleted At"><?= date('M d, Y H:i', strtotime($m['deleted_at'])) ?></td>
                                        <td class="text-end pe-4" data-label="Actions">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-success btn-restore" data-type="media" data-id="<?= $m['id'] ?>" data-name="<?= htmlspecialchars($m['file_name']) ?>">
                                                    <i class="fas fa-undo me-1"></i>Restore
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-perm" data-type="media" data-id="<?= $m['id'] ?>" data-name="<?= htmlspecialchars($m['file_name']) ?>">
                                                    <i class="fas fa-times me-1"></i>Delete Permanently
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No trashed media files.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notes Tab -->
            <div class="tab-pane fade" id="notes" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table-mobile">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Note Title</th>
                                <th>Last Updated</th>
                                <th>Deleted At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($notes)): ?>
                                <?php foreach ($notes as $n): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold" data-label="Title"><?= htmlspecialchars((string) ($n['title'] ?? 'Untitled')) ?></td>
                                        <td data-label="Updated"><?= date('M d, Y H:i', strtotime($n['updated_at'] ?? $n['deleted_at'])) ?></td>
                                        <td data-label="Deleted At"><?= date('M d, Y H:i', strtotime($n['deleted_at'])) ?></td>
                                        <td class="text-end pe-4" data-label="Actions">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-success btn-restore" data-type="note" data-id="<?= $n['id'] ?>" data-name="<?= htmlspecialchars((string) ($n['title'] ?? 'Untitled')) ?>">
                                                    <i class="fas fa-undo me-1"></i>Restore
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-perm" data-type="note" data-id="<?= $n['id'] ?>" data-name="<?= htmlspecialchars((string) ($n['title'] ?? 'Untitled')) ?>">
                                                    <i class="fas fa-times me-1"></i>Delete Permanently
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">No trashed notes.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 p-3 bg-light rounded text-muted small">
    <i class="fas fa-info-circle me-2 text-primary"></i>Items in the trash will be automatically cleared after 30 days. You can also manually delete them permanently or empty the entire trash.
</div>

<!-- Empty Trash Modal -->
<div class="modal fade" id="emptyTrashModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-danger">Empty Trash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-trash-alt text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Wipe everything?</h4>
                <p>This will permanently delete all items currently in the trash. This action <strong>cannot be undone</strong>.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <form action="<?= url('/admin/trash/empty') ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4">Yes, Empty Trash</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Restore Item Modal -->
<div class="modal fade" id="restoreItemModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-success">Restore Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-undo-alt text-success fa-4x mb-3"></i>
                <h4 class="fw-bold">Restore "<span id="restoreItemName"></span>"?</h4>
                <p class="text-muted">This will move the item back to its original location. It will be visible to customers again.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <form id="restoreForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-success px-4">Restore Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Permanent Delete Modal -->
<div class="modal fade" id="permDeleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-danger">Permanent Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Delete "<span id="permItemName"></span>"?</h4>
                <p class="text-muted">This item will be removed forever from the database and disk. You cannot undo this.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <form id="permDeleteForm" action="" method="post">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4">Delete Forever</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Restore logic
    const restoreModal = new bootstrap.Modal(document.getElementById('restoreItemModal'));
    document.querySelectorAll('.btn-restore').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('restoreItemName').textContent = name;
            document.getElementById('restoreForm').action = `<?= url('/admin/trash/restore/') ?>${type}/${id}`;
            restoreModal.show();
        });
    });

    // Permanent delete logic
    const permModal = new bootstrap.Modal(document.getElementById('permDeleteModal'));
    document.querySelectorAll('.btn-delete-perm').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('permItemName').textContent = name;
            document.getElementById('permDeleteForm').action = `<?= url('/admin/trash/delete-permanent/') ?>${type}/${id}`;
            permModal.show();
        });
    });
});
</script>
