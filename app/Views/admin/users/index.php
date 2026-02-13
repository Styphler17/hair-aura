<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Users</h2>
    <a href="<?= url('/admin/users/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</a>
</div>

<form method="get" action="<?= url('/admin/users') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-7">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Name, email, phone">
        </div>
        <div class="col-md-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="">All Roles</option>
                <option value="admin" <?= (($roleFilter ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="customer" <?= (($roleFilter ?? '') === 'customer') ? 'selected' : '' ?>>Customer</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
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
                                <td data-label="Name"><?= htmlspecialchars(trim(($account['first_name'] ?? '') . ' ' . ($account['last_name'] ?? ''))) ?></td>
                                <td data-label="Email"><?= htmlspecialchars($account['email'] ?? '') ?></td>
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
                                    <a href="<?= url('/admin/users/edit/' . (int) $account['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <?php if (!empty($account['is_active'])): ?>
                                        <form method="post" action="<?= url('/admin/users/delete/' . (int) $account['id']) ?>" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Deactivate</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (($pagination['last_page'] ?? 1) > 1): ?>
<nav class="mt-3">
    <ul class="pagination">
        <?php for ($p = 1; $p <= (int) $pagination['last_page']; $p++): ?>
            <li class="page-item <?= ((int) ($pagination['current_page'] ?? 1) === $p) ? 'active' : '' ?>">
                <a class="page-link" href="<?= url('/admin/users?page=' . $p . '&search=' . urlencode((string) ($search ?? '')) . '&role=' . urlencode((string) ($roleFilter ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
