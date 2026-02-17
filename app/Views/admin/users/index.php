<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Users</h2>
    <a href="<?= url('/admin/users/add') ?>" class="btn btn-primary transition"><i class="fas fa-plus me-1"></i> Add User</a>
</div>

<form method="get" action="<?= url('/admin/users') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-7">
            <label class="form-label text-primary fw-bold"><i class="fas fa-search me-1"></i> Search</label>
            <input type="text" name="search" class="form-control hover-shadow transition" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Name, phone, or email">
        </div>
        <div class="col-md-3">
            <label class="form-label text-success fw-bold"><i class="fas fa-user-tag me-1"></i> Role</label>
            <select name="role" class="form-select hover-shadow transition">
                <option value="">All Roles</option>
                <option value="admin" <?= (($roleFilter ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="customer" <?= (($roleFilter ?? '') === 'customer') ? 'selected' : '' ?>>Customer</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary transition">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <form id="bulkUserForm" method="post" action="<?= url('/admin/users/bulk-deactivate') ?>">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="table-responsive">
                <table class="table table-hover mb-0 admin-table-mobile">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllUsers">
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $account): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input user-checkbox" type="checkbox" name="ids[]" value="<?= (int) $account['id'] ?>" <?= ((int)$account['id'] === (int)(\App\Core\Auth::user()->id)) ? 'disabled' : '' ?>>
                                        </div>
                                    </td>
                                    <td data-label="Name"><?= htmlspecialchars(trim(($account['first_name'] ?? '') . ' ' . ($account['last_name'] ?? ''))) ?></td>
                                    <td data-label="Email"><?= htmlspecialchars((string) (($account['email'] ?? '') !== '' ? $account['email'] : '-')) ?></td>
                                    <td data-label="Phone"><?= htmlspecialchars($account['phone'] ?? '') ?></td>
                                    <td data-label="Role"><span class="badge bg-<?= ($account['role'] ?? '') === 'admin' ? 'dark' : 'secondary' ?>"><?= htmlspecialchars(ucfirst($account['role'] ?? 'customer')) ?></span></td>
                                    <td data-label="Status">
                                        <?php if (!empty($account['is_active'])): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Actions" class="text-end">
                                        <a href="<?= url('/admin/users/edit/' . (int) $account['id']) ?>" class="btn btn-sm btn-outline-primary transition">Edit</a>
                                        <?php if (!empty($account['is_active']) && (int)$account['id'] !== (int)(\App\Core\Auth::user()->id)): ?>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger btn-deactivate transition"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deactivateUserModal"
                                                    data-id="<?= (int) $account['id'] ?>"
                                                    data-name="<?= htmlspecialchars(trim(($account['first_name'] ?? '') . ' ' . ($account['last_name'] ?? ''))) ?>">
                                                Deactivate
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No users found.</td>
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
                <a class="page-link transition" href="<?= url('/admin/users?page=' . $p . '&search=' . urlencode((string) ($search ?? '')) . '&role=' . urlencode((string) ($roleFilter ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 d-none" style="z-index: 1050;">
    <div class="card shadow-lg border-0 bg-dark text-white px-4 py-3">
        <div class="d-flex align-items-center gap-4">
            <div><span id="selectedCount">0</span> users selected</div>
            <div class="vr"></div>
            <button type="button" class="btn btn-danger btn-sm transition" data-bs-toggle="modal" data-bs-target="#bulkDeactivateModal">
                <i class="fas fa-user-slash me-2"></i>Deactivate Selected
            </button>
        </div>
    </div>
</div>

<!-- Single Deactivate Modal -->
<div class="modal fade" id="deactivateUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Deactivate User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-user-times text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Deactivate <span id="userNameToDeactivate" class="text-primary px-2 bg-light rounded"></span>?</h4>
                <p class="text-muted">This user will no longer be able to access the system. You can reactivate them later by editing their profile.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4 transition" data-bs-dismiss="modal">Cancel</button>
                <form id="deactivateUserForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4 transition">Yes, Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Deactivate Modal -->
<div class="modal fade" id="bulkDeactivateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Bulk Deactivate Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-users-slash text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Deactivate <span id="bulkDeactivateCount">0</span> Users?</h4>
                <p class="text-muted">All selected users will be deactivated. Your own account is automatically excluded from this operation.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4 transition" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4 transition" id="confirmBulkDeactivate">Confirm Deactivation</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Single Deactivation
    const deactivateModal = document.getElementById('deactivateUserModal');
    if (deactivateModal) {
        deactivateModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const form = document.getElementById('deactivateUserForm');
            const nameSpan = document.getElementById('userNameToDeactivate');
            
            form.action = '<?= url('/admin/users/delete/') ?>' + userId;
            nameSpan.textContent = userName;
        });
    }

    // Multi-select Logic
    const selectAll = document.getElementById('selectAllUsers');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    const bulkBar = document.getElementById('bulkActionsBar');
    const selectedCount = document.getElementById('selectedCount');
    const bulkDeactivateCount = document.getElementById('bulkDeactivateCount');
    const bulkForm = document.getElementById('bulkUserForm');
    const confirmBulk = document.getElementById('confirmBulkDeactivate');

    function updateBulkBar() {
        const checked = document.querySelectorAll('.user-checkbox:checked').length;
        if (checked > 0) {
            bulkBar.classList.remove('d-none');
            selectedCount.textContent = checked;
            bulkDeactivateCount.textContent = checked;
        } else {
            bulkBar.classList.add('d-none');
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                if (!cb.disabled) cb.checked = selectAll.checked;
            });
            updateBulkBar();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            const allChecked = Array.from(checkboxes).filter(c => !c.disabled).every(c => c.checked);
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
