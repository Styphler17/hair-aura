<section class="py-5">
    <div class="container">
        <h1 class="mb-4">My Orders</h1>
        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead><tr><th>Order</th><th>Date</th><th>Status</th><th>Total</th></tr></thead>
                    <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>
                                <a href="<?= url('/account/orders/' . htmlspecialchars($order['order_number'] ?? $order->order_number ?? '')) ?>">
                                    <?= htmlspecialchars($order['order_number'] ?? $order->order_number ?? '-') ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($order['created_at'] ?? $order->created_at ?? '-') ?></td>
                            <td><?= htmlspecialchars($order['status'] ?? $order->status ?? '-') ?></td>
                            <td><?= money((float) ($order['total'] ?? $order->total ?? 0)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No orders found yet.</p>
        <?php endif; ?>
    </div>
</section>
