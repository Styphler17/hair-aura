<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Customers</h2>
</div>

<form method="get" action="<?= url('/admin/customers') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-8">
            <label class="form-label text-primary fw-bold"><i class="fas fa-search me-1"></i> Search</label>
            <input type="text" name="search" class="form-control hover-shadow transition" value="<?= htmlspecialchars((string) ($search ?? '')) ?>" placeholder="Name, phone, or email">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary transition">Find</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <form id="bulkActionForm" method="post" action="<?= url('/admin/customers/bulk-delete') ?>">
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
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Orders</th>
                            <th>Total Spent</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customers)): ?>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="<?= (int) $customer['id'] ?>">
                                        </div>
                                    </td>
                                    <td data-label="Customer">
                                        <strong><?= htmlspecialchars(trim((string) (($customer['first_name'] ?? '') . ' ' . ($customer['last_name'] ?? '')))) ?></strong>
                                        <div class="small text-muted"><?= htmlspecialchars((string) (($customer['email'] ?? '') !== '' ? $customer['email'] : '-')) ?></div>
                                    </td>
                                    <td data-label="Phone"><?= htmlspecialchars((string) ($customer['phone'] ?? '-')) ?></td>
                                    <td data-label="Orders"><?= (int) ($customer['order_count'] ?? 0) ?></td>
                                    <td data-label="Total Spent"><strong><?= money((float) ($customer['total_spent'] ?? 0)) ?></strong></td>
                                    <td data-label="Joined"><?= !empty($customer['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($customer['created_at']))) : '-' ?></td>
                                    <td data-label="Status">
                                        <?php if (!empty($customer['is_banned'])): ?>
                                            <span class="badge bg-danger">Banned</span>
                                        <?php elseif (!empty($customer['is_active'])): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Action" class="text-end">
                                        <a href="<?= url('/admin/customers/' . (int) $customer['id']) ?>" class="btn btn-sm btn-outline-primary transition">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No customers found.</td>
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
        <?php for ($p = 1; $p <= (int) $pagination['last_page']; $p++): ?>
            <li class="page-item <?= ((int) ($pagination['current_page'] ?? 1) === $p) ? 'active' : '' ?>">
                <a class="page-link transition" href="<?= url('/admin/customers?page=' . $p . '&search=' . urlencode((string) ($search ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 d-none" style="z-index: 1050;">
    <div class="card shadow-lg border-0 bg-dark text-white px-4 py-3">
        <div class="d-flex align-items-center gap-4">
            <div><span id="selectedCount">0</span> customers selected</div>
            <div class="vr"></div>
            <button type="button" class="btn btn-danger btn-sm transition" id="btnBulkBan">
                <i class="fas fa-ban me-1"></i>Ban
            </button>
            <button type="button" class="btn btn-success btn-sm transition" id="btnBulkUnban">
                <i class="fas fa-check-circle me-1"></i>Unban
            </button>
            <button type="button" class="btn btn-outline-light btn-sm transition" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                <i class="fas fa-user-slash me-1"></i>Deactivate
            </button>
        </div>
    </div>
</div>

<!-- Bulk Deactivate Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Bulk Deactivate Customers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-user-slash text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Deactivate <span id="bulkDeleteCount">0</span> Customers?</h4>
                <p class="text-muted">Selected customers will no longer be able to log in. Their order history will remain preserved.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4" id="confirmBulkDelete">Yes, Deactivate All</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAllItems');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const bulkBar = document.getElementById('bulkActionsBar');
    const selectedCountSpan = document.getElementById('selectedCount');
    const bulkDeleteCountSpan = document.getElementById('bulkDeleteCount');
    const bulkForm = document.getElementById('bulkActionForm');
    
    const confirmBulkDelete = document.getElementById('confirmBulkDelete');
    const btnBulkBan = document.getElementById('btnBulkBan');
    const btnBulkUnban = document.getElementById('btnBulkUnban');

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
            bulkForm.action = '<?= url('/admin/customers/bulk-delete') ?>';
            bulkForm.submit();
        });
    }

    if (btnBulkBan) {
        btnBulkBan.addEventListener('click', function() {
            bulkForm.action = '<?= url('/admin/customers/bulk-ban') ?>';
            bulkForm.submit();
        });
    }

    if (btnBulkUnban) {
        btnBulkUnban.addEventListener('click', function() {
            bulkForm.action = '<?= url('/admin/customers/bulk-unban') ?>';
            bulkForm.submit();
        });
    }
});
</script>
