<section class="py-5">
    <div class="container">
        <h1 class="mb-3">Order Details</h1>
        <?php if (isset($order)): ?>
            <p><strong>Order:</strong> <?= htmlspecialchars($order->order_number ?? $order['order_number'] ?? '-') ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($order->status ?? $order['status'] ?? '-') ?></p>
            <p><strong>Payment:</strong> <?= htmlspecialchars($order->payment_status ?? $order['payment_status'] ?? '-') ?></p>
            <p><strong>Total:</strong> <?= money((float) ($order->total ?? $order['total'] ?? 0)) ?></p>
        <?php endif; ?>

        <?php if (!empty($items)): ?>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead><tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Line Total</th></tr></thead>
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
                            <td>
                                <?php if ($itemSlug !== ''): ?>
                                    <a href="<?= url('/product/' . $itemSlug) ?>"><?= htmlspecialchars($itemName) ?></a>
                                <?php else: ?>
                                    <?= htmlspecialchars($itemName) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $itemQty ?></td>
                            <td><?= money($itemUnitPrice) ?></td>
                            <td><?= money($itemLineTotal) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>
