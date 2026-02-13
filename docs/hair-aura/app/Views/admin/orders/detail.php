<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Order #<?= htmlspecialchars((string) ($order->order_number ?? '')) ?></h2>
    <a href="<?= url('/admin/orders') ?>" class="btn btn-outline-secondary">Back to Orders</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td>
                                            <strong><?= htmlspecialchars($item['product_name'] ?? '') ?></strong>
                                            <?php if (!empty($item['variant_name'])): ?>
                                                <div class="small text-muted"><?= htmlspecialchars($item['variant_name']) ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($item['sku'] ?? '') ?></td>
                                        <td><?= (int) ($item['quantity'] ?? 0) ?></td>
                                        <td><?= money((float) ($item['unit_price'] ?? 0)) ?></td>
                                        <td><strong><?= money((float) ($item['total_price'] ?? 0)) ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No order items found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Update Order</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?= url('/admin/orders/' . (int) ($order->id ?? 0) . '/status') ?>" class="row g-2">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <?php foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'] as $statusOption): ?>
                                <option value="<?= $statusOption ?>" <?= ((string) ($order->status ?? '') === $statusOption) ? 'selected' : '' ?>>
                                    <?= ucfirst($statusOption) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tracking Number</label>
                        <input type="text" name="tracking_number" class="form-control" placeholder="Optional" value="<?= htmlspecialchars((string) ($order->tracking_number ?? '')) ?>">
                    </div>
                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Customer</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($user)): ?>
                    <div class="fw-semibold"><?= htmlspecialchars($user->getFullName()) ?></div>
                    <div class="small text-muted"><?= htmlspecialchars((string) $user->email) ?></div>
                    <div class="small text-muted"><?= htmlspecialchars((string) $user->phone) ?></div>
                    <a href="<?= url('/admin/customers/' . (int) $user->id) ?>" class="btn btn-sm btn-outline-primary mt-2">View Customer</a>
                <?php else: ?>
                    <div class="fw-semibold">
                        <?= htmlspecialchars(trim((string) (($order->shipping_first_name ?? '') . ' ' . ($order->shipping_last_name ?? '')))) ?>
                    </div>
                    <div class="small text-muted"><?= htmlspecialchars((string) ($order->guest_email ?? '')) ?></div>
                    <div class="small text-muted"><?= htmlspecialchars((string) ($order->guest_phone ?? '')) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between"><span>Subtotal</span><strong><?= money((float) ($order->subtotal ?? 0)) ?></strong></div>
                <div class="d-flex justify-content-between"><span>Shipping</span><strong><?= money((float) ($order->shipping_cost ?? 0)) ?></strong></div>
                <div class="d-flex justify-content-between"><span>Tax</span><strong><?= money((float) ($order->tax_amount ?? 0)) ?></strong></div>
                <div class="d-flex justify-content-between"><span>Discount</span><strong>-<?= money((float) ($order->discount_amount ?? 0)) ?></strong></div>
                <hr>
                <div class="d-flex justify-content-between"><span>Total</span><strong><?= money((float) ($order->total ?? 0)) ?></strong></div>
                <hr>
                <div class="small text-muted">Payment: <?= htmlspecialchars((string) ($order->payment_method ?? 'momo')) ?> (<?= htmlspecialchars((string) ($order->payment_status ?? 'pending')) ?>)</div>
                <?php if (!empty($order->notes)): ?>
                    <div class="small mt-2"><strong>Notes:</strong> <?= nl2br(htmlspecialchars((string) $order->notes)) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
