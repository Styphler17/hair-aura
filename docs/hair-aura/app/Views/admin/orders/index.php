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
                                    <a href="<?= url('/admin/orders/' . (int) $order['id']) ?>" class="btn btn-sm btn-outline-primary" title="View Order"><i class="fas fa-eye"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1" onclick="confirmDelete(<?= $order['id'] ?>, '<?= htmlspecialchars($order['order_number']) ?>')" title="Delete Order"><i class="fas fa-trash-alt"></i></button>
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

<!-- Delete Order Modal -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-0 text-center">
                <div class="mb-3 text-danger" style="font-size: 4rem; opacity: 0.8;">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h4 class="mb-2 fw-bold text-danger">Delete Order?</h4>
                <p class="text-muted mb-4">
                    Are you sure you want to permanently delete order <strong id="deleteOrderNumberText" class="text-dark"></strong>? 
                    <br><span class="small text-danger fw-bold">This action cannot be undone.</span>
                </p>
                
                <form id="deleteOrderForm" action="" method="post">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light px-4 border" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Delete Permanently</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, orderNumber) {
    const modalEl = document.getElementById('deleteOrderModal');
    // Check if bootstrap is defined, otherwise fallback or error gracefully
    if (typeof bootstrap !== 'undefined') {
        const modal = new bootstrap.Modal(modalEl);
        const form = document.getElementById('deleteOrderForm');
        const numberText = document.getElementById('deleteOrderNumberText');
        
        form.action = "<?= url('/admin/orders/delete/') ?>" + id;
        if (numberText) numberText.textContent = '#' + orderNumber;
        
        modal.show();
    } else {
        if (confirm('Are you sure you want to delete order #' + orderNumber + '?')) {
            const form = document.getElementById('deleteOrderForm');
            form.action = "<?= url('/admin/orders/delete/') ?>" + id;
            form.submit();
        }
    }
}
</script>
