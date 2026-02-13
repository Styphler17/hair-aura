<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Customers</h2>
</div>

<form method="get" action="<?= url('/admin/customers') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-8">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars((string) ($search ?? '')) ?>" placeholder="Name, phone, or email">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary">Find</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
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
                                <td data-label="Customer">
                                    <strong><?= htmlspecialchars(trim((string) (($customer['first_name'] ?? '') . ' ' . ($customer['last_name'] ?? '')))) ?></strong>
                                    <div class="small text-muted"><?= htmlspecialchars((string) ($customer['email'] ?? '')) ?></div>
                                </td>
                                <td data-label="Phone"><?= htmlspecialchars((string) ($customer['phone'] ?? '-')) ?></td>
                                <td data-label="Orders"><?= (int) ($customer['order_count'] ?? 0) ?></td>
                                <td data-label="Total Spent"><strong><?= money((float) ($customer['total_spent'] ?? 0)) ?></strong></td>
                                <td data-label="Joined"><?= !empty($customer['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($customer['created_at']))) : '-' ?></td>
                                <td data-label="Status">
                                    <?php if (!empty($customer['is_active'])): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Action" class="text-end">
                                    <a href="<?= url('/admin/customers/' . (int) $customer['id']) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No customers found.</td>
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
                <a class="page-link" href="<?= url('/admin/customers?page=' . $p . '&search=' . urlencode((string) ($search ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
