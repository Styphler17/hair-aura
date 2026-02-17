<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Blog Posts</h2>
    <a href="<?= url('/admin/blogs/add') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Post
    </a>
</div>

<form method="get" action="<?= url('/admin/blogs') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-6">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Title or content">
        </div>
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach (($categories ?? []) as $item): ?>
                    <?php $category = (string) ($item['category'] ?? 'General'); ?>
                    <option value="<?= htmlspecialchars($category) ?>" <?= (($categoryFilter ?? '') === $category) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category) ?>
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
        <form id="bulkActionForm" method="post" action="<?= url('/admin/blogs/bulk-delete') ?>">
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Published</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($posts)): ?>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="<?= (int) $post['id'] ?>">
                                        </div>
                                    </td>
                                    <td data-label="Image">
                                        <img src="<?= $post['featured_image'] ? asset($post['featured_image']) : asset('/img/product-placeholder.webp') ?>" 
                                             alt="<?= htmlspecialchars($post['title']) ?>" 
                                             class="rounded" 
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                                    </td>
                                    <td data-label="Title">
                                        <strong><?= htmlspecialchars($post['title']) ?></strong>
                                        <div class="small text-muted">/blog/<?= htmlspecialchars($post['slug']) ?></div>
                                    </td>
                                    <td data-label="Category"><?= htmlspecialchars($post['category'] ?? 'General') ?></td>
                                    <td data-label="Status">
                                        <?php if (!empty($post['is_published'])): ?>
                                            <span class="badge bg-success">Published</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Published"><?= !empty($post['published_at']) ? htmlspecialchars(date('Y-m-d', strtotime($post['published_at']))) : '-' ?></td>
                                    <td data-label="Actions" class="text-end">
                                        <a href="<?= url('/admin/blogs/edit/' . (int) $post['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteItemModal" 
                                                data-id="<?= (int) $post['id'] ?>"
                                                data-title="<?= htmlspecialchars($post['title']) ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No blog posts found.</td>
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
                <a class="page-link" href="<?= url('/admin/blogs?page=' . $p . '&search=' . urlencode((string) ($search ?? '')) . '&category=' . urlencode((string) ($categoryFilter ?? ''))) ?>"><?= $p ?></a>
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
            <button type="button" class="btn btn-success btn-sm" id="btnBulkPublish">
                <i class="fas fa-check-circle me-1"></i>Publish
            </button>
            <button type="button" class="btn btn-warning btn-sm" id="btnBulkUnpublish">
                <i class="fas fa-edit me-1"></i>Draft
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                <i class="fas fa-trash-alt me-1"></i>Delete
            </button>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Bulk Delete Blog Posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Delete <span id="bulkDeleteCount">0</span> Posts?</h4>
                <p class="text-muted">This action will permanently remove all selected blog posts. This cannot be undone.</p>
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
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Delete Blog Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                    <h4 class="fw-bold">Are you sure?</h4>
                    <p class="text-muted">You are about to delete the following blog post:</p>
                    <div class="p-3 bg-light rounded text-start italic border-start border-danger border-4">
                        <span id="itemToDeleteTitle" class="fw-semibold"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">No, Cancel</button>
                <form id="deleteItemForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4">Yes, Delete It</button>
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
            const form = document.getElementById('deleteItemForm');
            const titleSpan = document.getElementById('itemToDeleteTitle');
            form.action = '<?= url('/admin/blogs/delete/') ?>' + id;
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
    
    const confirmBulkDelete = document.getElementById('confirmBulkDelete');
    const btnBulkPublish = document.getElementById('btnBulkPublish');
    const btnBulkUnpublish = document.getElementById('btnBulkUnpublish');

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

    if (confirmBulkDelete) {
        confirmBulkDelete.addEventListener('click', function() {
            bulkForm.action = '<?= url('/admin/blogs/bulk-delete') ?>';
            bulkForm.submit();
        });
    }

    if (btnBulkPublish) {
        btnBulkPublish.addEventListener('click', function() {
            bulkForm.action = '<?= url('/admin/blogs/bulk-publish') ?>';
            bulkForm.submit();
        });
    }

    if (btnBulkUnpublish) {
        btnBulkUnpublish.addEventListener('click', function() {
            bulkForm.action = '<?= url('/admin/blogs/bulk-unpublish') ?>';
            bulkForm.submit();
        });
    }
});
</script>
