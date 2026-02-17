<section class="py-5" id="orderPrintArea">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <h1 class="mb-0">Order Details</h1>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-outline-primary">
                    <i class="fas fa-download me-2"></i> Download Summary
                </button>
                <a href="<?= url('/account/orders') ?>" class="btn btn-outline-secondary">Back to Orders</a>
            </div>
        </div>

        <?php if (isset($order)): ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Order Number</label>
                            <span class="fs-5 fw-bold text-primary">#<?= htmlspecialchars($order->order_number ?? '-') ?></span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Status</label>
                            <?php 
                                $status = strtolower($order->status ?? 'pending');
                                $statusClass = 'status-' . $status;
                            ?>
                            <span class="status-badge <?= $statusClass ?>"><?= ucfirst($status) ?></span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Payment Method</label>
                            <span class="fw-semibold text-capitalize"><?= htmlspecialchars($order->payment_method ?? '-') ?></span>
                            <?php if (($order->payment_status ?? '') === 'paid'): ?>
                                <span class="badge bg-success ms-1">Paid</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark ms-1">Pending Payment</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Date Placed</label>
                            <span><?= date('F j, Y', strtotime($order->created_at ?? 'now')) ?></span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Shipping Address</label>
                            <address class="mb-0 small text-muted">
                                <?= htmlspecialchars(($order->shipping_first_name ?? $order->first_name ?? '') . ' ' . ($order->shipping_last_name ?? $order->last_name ?? '')) ?><br>
                                <?= htmlspecialchars($order->shipping_address ?? $order->address ?? '') ?><br>
                                <?= htmlspecialchars($order->shipping_city ?? $order->city ?? '') ?>, <?= htmlspecialchars($order->shipping_state ?? $order->state ?? '') ?><br>
                                Ghana
                            </address>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Total Amount</label>
                            <span class="fs-5 fw-bold"><?= money((float) ($order->total ?? 0)) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <h4 class="mb-3">Order Items</h4>
        <?php if (!empty($items)): ?>
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th class="text-center">Rate</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <?php
                            $itemName = (string) ($item['product_name'] ?? $item->product_name ?? $item['name'] ?? '-');
                            $itemQty = (int) ($item['quantity'] ?? $item->quantity ?? 0);
                            $itemUnitPrice = (float) ($item['unit_price'] ?? $item->unit_price ?? $item['price'] ?? $item->price ?? 0);
                            $itemLineTotal = (float) ($item['total_price'] ?? $item->total_price ?? ($itemQty * $itemUnitPrice));
                            $itemSlug = (string) ($item['slug'] ?? $item->slug ?? '');
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="fw-semibold">
                                            <?php if ($itemSlug !== ''): ?>
                                                <a href="<?= url('/product/' . $itemSlug) ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($itemName) ?></a>
                                            <?php else: ?>
                                                <?= htmlspecialchars($itemName) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-muted"><?= money($itemUnitPrice) ?></td>
                                <td class="text-center fw-bold"><?= $itemQty ?></td>
                                <td class="text-end pe-4 fw-bold text-primary"><?= money($itemLineTotal) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="text-end text-muted ps-4">Subtotal</td>
                                <td class="text-end pe-4"><?= money((float) ($order->subtotal ?? ($order->total - ($order->shipping_cost ?? 0)))) ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end text-muted ps-4">Shipping</td>
                                <td class="text-end pe-4 text-success"><?= ($order->shipping_cost ?? 0) > 0 ? money((float)$order->shipping_cost) : 'Free' ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold ps-4 fs-5">Total Paid</td>
                                <td class="text-end pe-4 fw-bold fs-5 text-primary"><?= money((float) ($order->total ?? 0)) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
@media print {
    .no-print { display: none !important; }
    .site-footer, .main-header, .top-bar, .breadcrumb, .btn { display: none !important; }
    body { background: white !important; }
    .card { border: 1px solid #eee !important; box-shadow: none !important; }
    .status-badge { border: 1px solid #ccc !important; -webkit-print-color-adjust: exact; }
    .text-primary { color: #D4A574 !important; }
}
</style>
