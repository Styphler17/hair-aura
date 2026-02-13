<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">Track Order</h1>
                <form method="get" action="<?= url('/track-order') ?>" class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Order Number</label>
                        <input type="text" name="order" class="form-control" value="<?= htmlspecialchars($orderNumber ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email ?? '') ?>" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Track</button>
                    </div>
                </form>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <?php if (!empty($order)): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Order <?= htmlspecialchars($order->order_number ?? $order['order_number'] ?? '') ?></h5>
                            <p class="mb-1"><strong>Status:</strong> <?= htmlspecialchars($order->status ?? $order['status'] ?? '-') ?></p>
                            <p class="mb-1"><strong>Payment:</strong> <?= htmlspecialchars($order->payment_status ?? $order['payment_status'] ?? '-') ?></p>
                            <p class="mb-0"><strong>Total:</strong> <?= money((float) ($order->total ?? $order['total'] ?? 0)) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
