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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Categories</h2>
    <button type="button" class="btn btn-theme" data-bs-toggle="collapse" data-bs-target="#addCategoryForm">
        <i class="fas fa-plus me-1"></i> Add New Category
    </button>
</div>

<div class="collapse mb-4" id="addCategoryForm">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i>Create New Category</h5>
        </div>
        <div class="card-body p-4">
            <form method="post" action="<?= url('/admin/categories/save') ?>" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-uppercase text-muted">Category Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Brazilian Hair" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-uppercase text-muted">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="brazilian-hair" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold small text-uppercase text-muted">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-uppercase text-muted">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" placeholder="SEO Title">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold small text-uppercase text-muted">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control" placeholder="Brief SEO description">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-uppercase text-muted">Category Image</label>
                    <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                </div>
                <div class="col-md-6">
                    <?php
                        // Setup for partial
                        $inputName = 'library_image';
                        $isMultiple = false;
                        $currentValue = '';
                        $label = 'Or Pick From Media Library';
                        include __DIR__ . '/../partials/media_library_selector.php';
                    ?>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold small text-uppercase text-muted">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-between pt-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="newCategoryActive" value="1" checked>
                        <label class="form-check-label fw-bold" for="newCategoryActive">Active & Visible</label>
                    </div>
                    <div>
                        <button type="button" class="btn btn-light me-2" data-bs-toggle="collapse" data-bs-target="#addCategoryForm">Cancel</button>
                        <button type="submit" class="btn btn-theme px-4">Save Category</button>
                    </div>
                </div>
            </form>
        </div>
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
                                    <td data-label="Sort">
                                        <div class="input-group input-group-sm" style="width: 80px;">
                                            <input type="number" name="sort[<?= $catId ?>]" class="form-control text-center category-order-input" value="<?= (int) ($category['sort_order'] ?? 0) ?>">
                                        </div>
                                    </td>
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
                                    <td colspan="8" class="bg-light p-4">
                                        <div class="card border-0 shadow-sm mx-auto" style="max-width: 900px;">
                                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-edit me-2"></i>Edit Category: <?= htmlspecialchars($category['name']) ?></h6>
                                                <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#editCategory<?= $catId ?>"></button>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="<?= url('/admin/categories/save') ?>" enctype="multipart/form-data" class="row g-3">
                                                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                                    <input type="hidden" name="id" value="<?= $catId ?>">
                                                    
                                                    <div class="col-md-6">
                                                        <label class="form-label small fw-bold text-muted">Category Name</label>
                                                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars((string) ($category['name'] ?? '')) ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small fw-bold text-muted">Slug</label>
                                                        <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars((string) ($category['slug'] ?? '')) ?>" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-bold text-muted">Sort Order</label>
                                                        <input type="number" name="sort_order" class="form-control" value="<?= (int) ($category['sort_order'] ?? 0) ?>">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label small fw-bold text-muted">Meta Title</label>
                                                        <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars((string) ($category['meta_title'] ?? '')) ?>" placeholder="SEO Title">
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label class="form-label small fw-bold text-muted">Description</label>
                                                        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars((string) ($category['description'] ?? '')) ?></textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label small fw-bold text-muted">Meta Description</label>
                                                        <input type="text" name="meta_description" class="form-control" value="<?= htmlspecialchars((string) ($category['meta_description'] ?? '')) ?>">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-end gap-3 h-100 pb-2">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" name="is_active" id="active<?= $catId ?>" value="1" <?= !empty($category['is_active']) ? 'checked' : '' ?>>
                                                                <label class="form-check-label fw-bold" for="active<?= $catId ?>">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 border-top pt-3 mt-3">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold text-muted">Change Image</label>
                                                                <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                    // Setup for partial
                                                                    $inputName = 'library_image';
                                                                    $isMultiple = false;
                                                                    $currentValue = $category['image'] ?? '';
                                                                    $label = 'Or Pick From Library';
                                                                    include __DIR__ . '/../partials/media_library_selector.php';
                                                                ?>
                                                            </div>
                                                            <div class="col-md-12 d-flex align-items-center gap-4 bg-light p-3 rounded">
                                                                <div class="current-img-preview">
                                                                    <p class="small fw-bold text-muted mb-1">Current Image:</p>
                                                                    <img src="<?= htmlspecialchars($resolveCategoryImage((string) ($category['image'] ?? ''))) ?>" 
                                                                         class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;"
                                                                         onerror="this.src='<?= asset('/img/product-placeholder.webp') ?>'">
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage<?= $catId ?>" value="1">
                                                                    <label class="form-check-label text-danger fw-bold" for="removeImage<?= $catId ?>">
                                                                        <i class="fas fa-trash-alt me-1"></i> Remove Current Image
                                                                    </label>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <button type="button" class="btn btn-light me-2" data-bs-toggle="collapse" data-bs-target="#editCategory<?= $catId ?>">Cancel</button>
                                                                    <button type="submit" class="btn btn-theme px-4">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
    <div class="card-footer bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                <i class="fas fa-info-circle me-1"></i> Edit the numbers in the <strong>Sort</strong> column and click <strong>Save Orders</strong> to manually rearrange.
            </div>
            <button type="button" class="btn btn-theme" id="saveOrderBtn">
                <i class="fas fa-sort-amount-down me-1"></i> Save Category Orders
            </button>
        </div>
    </div>
</div>

<form id="orderUpdateForm" method="post" action="<?= url('/admin/categories/update-order') ?>">
    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
    <div id="orderInputsHidden"></div>
</form>

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

    // Manual Sort Logic
    const saveOrderBtn = document.getElementById('saveOrderBtn');
    const orderUpdateForm = document.getElementById('orderUpdateForm');
    const orderInputsHidden = document.getElementById('orderInputsHidden');

    if (saveOrderBtn) {
        saveOrderBtn.addEventListener('click', function() {
            const inputs = document.querySelectorAll('.category-order-input');
            orderInputsHidden.innerHTML = '';
            
            inputs.forEach(input => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = input.name;
                hiddenInput.value = input.value;
                orderInputsHidden.appendChild(hiddenInput);
            });
            
            orderUpdateForm.submit();
        });
    }
});
</script>


