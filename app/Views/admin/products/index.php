<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Products</h2>
    <a href="<?= url('/admin/products/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
</div>

<form method="get" action="<?= url('/admin/products') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-7">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Name or SKU">
        </div>
        <div class="col-md-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach (($categories ?? []) as $category): ?>
                    <option value="<?= (int) $category['id'] ?>" <?= ((string) ($categoryFilter ?? '') === (string) $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <form id="bulkActionForm" method="post" action="<?= url('/admin/products/bulk-delete') ?>">
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
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="<?= (int) $product['id'] ?>">
                                        </div>
                                    </td>
                                    <td data-label="Product">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-thumb">
                                                <?php 
                                                    $img = $product['image'] ?? '';
                                                    $imgPath = asset('/img/product-placeholder.webp');
                                                    if ($img) {
                                                        if (str_starts_with($img, 'uploads/') || str_starts_with($img, 'img/')) {
                                                            $imgPath = asset('/' . ltrim($img, '/'));
                                                        } else {
                                                            $imgPath = asset('/uploads/products/' . $img);
                                                        }
                                                    }
                                                ?>
                                                <img src="<?= $imgPath ?>" alt="" class="rounded border" style="width: 45px; height: 45px; object-fit: cover;" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?= htmlspecialchars($product['name']) ?></div>
                                                <div class="small text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;"><?= htmlspecialchars($product['sku'] ?? 'NO-SKU') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Category"><?= htmlspecialchars($product['category_name'] ?? '-') ?></td>
                                    <td data-label="Price">
                                        <?php if (!empty($product['sale_price'])): ?>
                                            <span class="text-decoration-line-through text-muted small me-1"><?= money((float) $product['price']) ?></span>
                                            <span><?= money((float) $product['sale_price']) ?></span>
                                        <?php else: ?>
                                            <?= money((float) $product['price']) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Stock"><?= (int) ($product['stock_quantity'] ?? 0) ?></td>
                                    <td data-label="Status">
                                        <?php if (!empty($product['is_active'])): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Actions" class="text-end">
                                        <div class="btn-group">
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-secondary btn-preview-product" 
                                                    data-id="<?= (int) $product['id'] ?>"
                                                    title="Quick Preview">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="<?= url('/admin/products/edit/' . (int) $product['id']) ?>" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit Product">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteItemModal" 
                                                    data-id="<?= (int) $product['id'] ?>"
                                                    data-title="<?= htmlspecialchars($product['name']) ?>"
                                                    title="Delete Product">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<?php if (($pagination['last_page'] ?? 1) > 1): ?>
<nav class="mt-3">
    <ul class="pagination">
        <?php for ($p = 1; $p <= (int) ($pagination['last_page'] ?? 1); $p++): ?>
            <li class="page-item <?= ((int) ($pagination['current_page'] ?? 1) === $p) ? 'active' : '' ?>">
                <a class="page-link" href="<?= url('/admin/products?page=' . $p . '&search=' . urlencode((string) ($search ?? '')) . '&category=' . urlencode((string) ($categoryFilter ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
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
                <h5 class="modal-title fw-bold text-danger">Bulk Delete Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Delete <span id="bulkDeleteCount">0</span> products?</h4>
                <p class="text-muted">This will deactivate the selected products. This action can be undone by editing each product, but bulk activation is not currently available.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4" id="confirmBulkDelete">Yes, Deactivate All</button>
            </div>
        </div>
    </div>
</div>

<!-- Single Delete Confirmation Modal -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                    <h4 class="fw-bold">Are you sure?</h4>
                    <p class="text-muted">You are about to delete (deactivate) the following product:</p>
                    <div class="p-3 bg-light rounded text-start italic border-start border-danger border-4 mx-3">
                        <span id="itemToDeleteTitle" class="fw-semibold"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">No, Cancel</button>
                <form id="deleteItemForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4 shadow-sm">Yes, Delete It</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Product Preview Modal -->
<div class="modal fade" id="productPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Product Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="previewModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Fetching product details...</p>
                </div>
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
            const form = document.getElementById('deleteItemForm');
            const titleSpan = document.getElementById('itemToDeleteTitle');
            form.action = '<?= url('/admin/products/delete/') ?>' + id;
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

    // Product Preview Logic
    const previewModal = new bootstrap.Modal(document.getElementById('productPreviewModal'));
    const previewBody = document.getElementById('previewModalBody');

    document.querySelectorAll('.btn-preview-product').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            previewModal.show();
            
            // Show loading
            previewBody.innerHTML = `
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Fetching product details...</p>
                </div>
            `;

            fetch('<?= url('/product/quick-view/') ?>' + id, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                const imgPath = data.image ? (data.image.startsWith('http') ? data.image : '<?= asset('') ?>' + data.image.replace(/^\//, '')) : '<?= asset('/img/product-placeholder.webp') ?>';
                
                previewBody.innerHTML = `
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="rounded overflow-hidden shadow-sm">
                                <img src="${imgPath}" class="img-fluid w-100 h-100 object-fit-cover" style="min-height: 300px;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h3 class="fw-bold mb-0">${data.name}</h3>
                                <span class="badge ${data.in_stock ? 'bg-success' : 'bg-danger'}">${data.in_stock ? 'In Stock' : 'Out of Stock'}</span>
                            </div>
                            <div class="text-muted mb-3 small text-uppercase fw-bold">${data.slug}</div>
                            
                            <div class="fs-4 fw-bold text-primary mb-3">
                                ${data.on_sale ? `
                                    <span class="text-decoration-line-through text-muted fs-6 me-2">GH₵${parseFloat(data.original_price).toFixed(2)}</span>
                                    <span>GH₵${parseFloat(data.price).toFixed(2)}</span>
                                ` : `GH₵${parseFloat(data.price).toFixed(2)}`}
                            </div>
                            
                            <div class="mb-4">
                                <label class="small text-muted fw-bold text-uppercase mb-1 d-block">Description</label>
                                <p class="text-secondary">${data.description || 'No description available for this product.'}</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-2 border rounded bg-light">
                                        <div class="small text-muted">Stock Quantity</div>
                                        <div class="fw-bold">${data.stock}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 border rounded bg-light">
                                        <div class="small text-muted">Rating</div>
                                        <div class="fw-bold">${data.rating} / 5 (${data.review_count} reviews)</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-3 border-top d-flex gap-2">
                                <a href="<?= url('/admin/products/edit/') ?>${data.id}" class="btn btn-primary px-4">
                                    <i class="fas fa-edit me-2"></i>Edit Product
                                </a>
                                <a href="<?= url('/product/') ?>${data.slug}" target="_blank" class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-external-link-alt me-2"></i>View on Site
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(err => {
                previewBody.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Could not load product details. Please try again.
                    </div>
                `;
            });
        });
    });
});
</script>
