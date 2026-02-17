<?php
$resolveCategoryImage = static function (?string $image): string {
    $name = trim((string) $image);
    if ($name === '') {
        return asset('/img/product-placeholder.webp');
    }

    if (str_starts_with($name, 'http://') || str_starts_with($name, 'https://')) {
        return $name;
    }

    // If it starts with 'uploads/' or 'img/', assumes it's from root
    if (str_starts_with($name, 'uploads/') || str_starts_with($name, 'img/')) {
        return asset('/' . ltrim($name, '/'));
    }

    // Otherwise, treat as relative to categories folder (even if it has ..)
    return asset('/uploads/categories/' . $name);
};
$mediaImages = $mediaImages ?? [];
?>

<h2 class="mb-3">Categories</h2>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Add Category</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?= url('/admin/categories/save') ?>" enctype="multipart/form-data" class="row g-2">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="col-md-4">
                <label class="form-label text-primary fw-bold"><i class="fas fa-tag me-1"></i> Name</label>
                <input type="text" name="name" class="form-control hover-shadow transition" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-primary fw-bold"><i class="fas fa-link me-1"></i> Slug</label>
                <input type="text" name="slug" class="form-control hover-shadow transition" required>
            </div>
            <div class="col-md-2">
                <label class="form-label text-success fw-bold"><i class="fas fa-sort-numeric-down me-1"></i> Sort Order</label>
                <input type="number" name="sort_order" class="form-control hover-shadow transition" value="0">
            </div>
            <div class="col-md-3">
                <label class="form-label text-secondary fw-bold"><i class="fas fa-search me-1"></i> Meta Title</label>
                <input type="text" name="meta_title" class="form-control hover-shadow transition">
            </div>
            <div class="col-md-6">
                <label class="form-label text-warning fw-bold"><i class="fas fa-upload me-1"></i> Upload Category Image</label>
                <input type="file" name="image_file" class="form-control hover-shadow transition" accept=".jpg,.jpeg,.png,.webp">
            </div>
            <?php
                // Setup for partial
                $inputName = 'library_image';
                $isMultiple = false;
                $currentValue = '';
                $label = 'Or Pick From Media Library';
                include __DIR__ . '/../partials/media_library_selector.php';
            ?>
            <div class="col-12">
                <label class="form-label text-info fw-bold"><i class="fas fa-align-left me-1"></i> Description</label>
                <textarea name="description" class="form-control hover-shadow transition" rows="2"></textarea>
            </div>
            <div class="col-12 d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="newCategoryActive" value="1" checked>
                    <label class="form-check-label" for="newCategoryActive">Active</label>
                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <form id="bulkActionForm" method="post" action="<?= url('/admin/categories/bulk-delete') ?>">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="table-responsive">
                <table class="table table-hover mb-0 admin-table-mobile">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllItems">
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <?php $catId = (int) ($category['id'] ?? 0); ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="<?= $catId ?>">
                                        </div>
                                    </td>
                                    <td data-label="Name">
                                        <strong><?= htmlspecialchars((string) ($category['name'] ?? '')) ?></strong>
                                        <?php if (!empty($category['description'])): ?>
                                            <div class="small text-muted"><?= htmlspecialchars(strlen((string) $category['description']) > 80 ? substr((string) $category['description'], 0, 77) . '...' : (string) $category['description']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Image">
                                        <img
                                            src="<?= htmlspecialchars($resolveCategoryImage((string) ($category['image'] ?? ''))) ?>"
                                            alt="<?= htmlspecialchars((string) ($category['name'] ?? 'Category')) ?>"
                                            class="category-thumb"
                                            onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';"
                                        >
                                    </td>
                                    <td data-label="Slug"><?= htmlspecialchars((string) ($category['slug'] ?? '')) ?></td>
                                    <td data-label="Products"><?= (int) ($category['product_count'] ?? 0) ?></td>
                                    <td data-label="Sort"><?= (int) ($category['sort_order'] ?? 0) ?></td>
                                    <td data-label="Status">
                                        <?php if (!empty($category['is_active'])): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Action" class="text-end">
                                        <div class="d-flex justify-content-end gap-1">
                                            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editCategory<?= $catId ?>">Edit</button>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteItemModal" 
                                                    data-id="<?= $catId ?>"
                                                    data-title="<?= htmlspecialchars((string)($category['name'] ?? '')) ?>"
                                                    data-products="<?= (int)($category['product_count'] ?? 0) ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="collapse" id="editCategory<?= $catId ?>">
                                    <td colspan="8">
                                        <form method="post" action="<?= url('/admin/categories/save') ?>" enctype="multipart/form-data" class="row g-2">
                                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                            <input type="hidden" name="id" value="<?= $catId ?>">
                                            <div class="col-md-3">
                                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars((string) ($category['name'] ?? '')) ?>" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars((string) ($category['slug'] ?? '')) ?>" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="sort_order" class="form-control" value="<?= (int) ($category['sort_order'] ?? 0) ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars((string) ($category['meta_title'] ?? '')) ?>" placeholder="Meta title">
                                            </div>
                                            <div class="col-md-2 d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_active" id="active<?= $catId ?>" value="1" <?= !empty($category['is_active']) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="active<?= $catId ?>">Active</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label text-warning fw-bold text-start d-block"><i class="fas fa-upload me-1"></i> Upload New Image</label>
                                                <input type="file" name="image_file" class="form-control hover-shadow transition" accept=".jpg,.jpeg,.png,.webp">
                                            </div>
                                            <div class="col-md-8">
                                                <?php
                                                    // Setup for partial
                                                    $inputName = 'library_image';
                                                    $isMultiple = false;
                                                    $currentValue = $category['image'] ?? '';
                                                    $label = 'Or Pick From Media Library';
                                                    include __DIR__ . '/../partials/media_library_selector.php';
                                                ?>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage<?= $catId ?>" value="1">
                                                    <label class="form-check-label text-danger fw-bold" for="removeImage<?= $catId ?>">Remove image</label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center">
                                                <img
                                                    src="<?= htmlspecialchars($resolveCategoryImage((string) ($category['image'] ?? ''))) ?>"
                                                    alt="<?= htmlspecialchars((string) ($category['name'] ?? 'Category')) ?>"
                                                    class="category-thumb"
                                                    onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';"
                                                >
                                            </div>
                                            <div class="col-12">
                                                <textarea name="description" class="form-control" rows="2" placeholder="Description"><?= htmlspecialchars((string) ($category['description'] ?? '')) ?></textarea>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="meta_description" class="form-control" value="<?= htmlspecialchars((string) ($category['meta_description'] ?? '')) ?>" placeholder="Meta description">
                                            </div>
                                            <div class="col-md-2 d-grid">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No categories found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

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
                <h5 class="modal-title fw-bold text-danger">Bulk Delete Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Delete <span id="bulkDeleteCount">0</span> categories?</h4>
                <p class="text-muted">This will permanently delete the selected categories. Note: Categories containing products cannot be deleted in bulk for safety.</p>
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
        <div class="modal-content text-dark">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                    <h4 class="fw-bold">Are you sure?</h4>
                    <p class="text-muted">You are about to delete the following category:</p>
                    <div class="p-3 bg-light rounded text-start italic border-start border-danger border-4">
                        <span id="itemToDeleteTitle" class="fw-semibold"></span>
                    </div>
                </div>
                <div id="categoryWarning" class="alert alert-warning mt-3 d-none">
                    <i class="fas fa-exclamation-triangle me-2"></i> This category contains <span id="categoryProductCount"></span> product(s). You must move or delete them before deleting this category.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">No, Cancel</button>
                <form id="deleteItemForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4" id="confirmSingleDelete">Yes, Delete It</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Single Delete Modal
    const deleteModal = document.getElementById('deleteItemModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const products = parseInt(button.getAttribute('data-products') || '0');
            const form = document.getElementById('deleteItemForm');
            const titleSpan = document.getElementById('itemToDeleteTitle');
            const warning = document.getElementById('categoryWarning');
            const prodCountSpan = document.getElementById('categoryProductCount');
            const confirmBtn = document.getElementById('confirmSingleDelete');
            
            form.action = '<?= url('/admin/categories/delete/') ?>' + id;
            titleSpan.textContent = title;
            prodCountSpan.textContent = products;
            
            if (products > 0) {
                warning.classList.remove('d-none');
                confirmBtn.disabled = true;
            } else {
                warning.classList.add('d-none');
                confirmBtn.disabled = false;
            }
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
});
</script>


