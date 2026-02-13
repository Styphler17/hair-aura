<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Orders</h2>
</div>

<form method="get" action="<?= url('/admin/orders') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <?php foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'] as $statusOption): ?>
                    <option value="<?= $statusOption ?>" <?= (($statusFilter ?? '') === $statusOption) ? 'selected' : '' ?>>
                        <?= ucfirst($statusOption) ?>
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
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <?php
                            $status = (string) ($order['status'] ?? 'pending');
                            $statusClass = match ($status) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                'refunded' => 'secondary',
                                default => 'dark'
                            };
                            $paymentStatus = (string) ($order['payment_status'] ?? 'pending');
                            $paymentClass = match ($paymentStatus) {
                                'paid' => 'success',
                                'pending' => 'warning',
                                'failed' => 'danger',
                                'refunded' => 'secondary',
                                default => 'dark'
                            };
                            ?>
                            <tr>
                                <td data-label="Order">
                                    <strong>#<?= htmlspecialchars($order['order_number'] ?? '') ?></strong>
                                    <div class="small text-muted"><?= htmlspecialchars($order['payment_method'] ?? 'momo') ?></div>
                                </td>
                                <td data-label="Customer">
                                    <?php if (!empty($order['first_name']) || !empty($order['last_name'])): ?>
                                        <?= htmlspecialchars(trim(($order['first_name'] ?? '') . ' ' . ($order['last_name'] ?? ''))) ?>
                                    <?php else: ?>
                                        Guest Customer
                                    <?php endif; ?>
                                    <div class="small text-muted"><?= htmlspecialchars($order['user_email'] ?? ($order['guest_email'] ?? '')) ?></div>
                                </td>
                                <td data-label="Payment">
                                    <span class="badge bg-<?= $paymentClass ?>"><?= ucfirst($paymentStatus) ?></span>
                                </td>
                                <td data-label="Total"><strong><?= money((float) ($order['total'] ?? 0)) ?></strong></td>
                                <td data-label="Status">
                                    <span class="badge bg-<?= $statusClass ?>"><?= ucfirst($status) ?></span>
                                </td>
                                <td data-label="Date"><?= !empty($order['created_at']) ? htmlspecialchars(date('Y-m-d H:i', strtotime($order['created_at']))) : '-' ?></td>
                                <td data-label="Action" class="text-end">
                                    <a href="<?= url('/admin/orders/' . (int) $order['id']) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No orders found.</td>
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
                <a class="page-link" href="<?= url('/admin/orders?page=' . $p . '&status=' . urlencode((string) ($statusFilter ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
