<div class="admin-dashboard">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-sack-dollar"></i>
            </div>
            <div class="stat-info">
                <h3><?= money((float) ($stats['today_revenue'] ?? 0)) ?></h3>
                <p>Today Revenue</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-cart-shopping"></i>
            </div>
            <div class="stat-info">
                <h3><?= (int) ($stats['today_orders'] ?? 0) ?></h3>
                <p>Today Orders</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-calendar-days"></i>
            </div>
            <div class="stat-info">
                <h3><?= money((float) ($stats['month_revenue'] ?? 0)) ?></h3>
                <p>Month Revenue</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-info">
                <h3><?= (int) ($stats['pending_orders'] ?? 0) ?></h3>
                <p>Pending Orders</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-line"></i> Sales (Last 30 Days)</h5>
                    <a href="<?= url('/admin/orders') ?>" class="btn btn-sm btn-primary">View Orders</a>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-clock"></i> Recent Orders</h5>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($recentOrders)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($recentOrders as $order): ?>
                                <?php
                                $orderStatus = (string) ($order['status'] ?? 'pending');
                                $orderStatusClass = match ($orderStatus) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                                ?>
                                <a href="<?= url('/admin/orders/' . (int) $order['id']) ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>#<?= htmlspecialchars((string) ($order['order_number'] ?? '')) ?></strong>
                                            <p class="mb-0 text-muted small"><?= htmlspecialchars(trim((string) (($order['first_name'] ?? 'Guest') . ' ' . ($order['last_name'] ?? '')))) ?></p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-<?= $orderStatusClass ?>"><?= ucfirst($orderStatus) ?></span>
                                            <p class="mb-0 text-muted small"><?= money((float) ($order['total'] ?? 0)) ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4 mb-0">No orders yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-box-open"></i> Low Stock Products</h5>
                    <a href="<?= url('/admin/products') ?>" class="btn btn-sm btn-outline-primary">Manage</a>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($lowStock)): ?>
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Stock</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($lowStock, 0, 8) as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars((string) ($product['name'] ?? '')) ?></td>
                                        <td>
                                            <span class="badge bg-<?= ((int) ($product['stock_quantity'] ?? 0) <= 2) ? 'danger' : 'warning' ?>">
                                                <?= (int) ($product['stock_quantity'] ?? 0) ?> left
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= url('/admin/products/edit/' . (int) $product['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted text-center py-4 mb-0">All products are stocked.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-star"></i> Pending Reviews</h5>
                    <a href="<?= url('/admin/reviews?status=pending') ?>" class="btn btn-sm btn-outline-primary">Moderate</a>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($pendingReviews)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach (array_slice($pendingReviews, 0, 6) as $review): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <div class="fw-semibold"><?= htmlspecialchars((string) ($review['product_name'] ?? '')) ?></div>
                                            <div class="text-warning small">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="<?= $i <= (int) ($review['rating'] ?? 0) ? 'fas' : 'far' ?> fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="small text-muted"><?= htmlspecialchars(strlen((string) ($review['comment'] ?? '')) > 70 ? substr((string) ($review['comment'] ?? ''), 0, 67) . '...' : (string) ($review['comment'] ?? '')) ?></div>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <form action="<?= url('/admin/reviews/' . (int) $review['id'] . '/approve') ?>" method="post">
                                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-check"></i></button>
                                            </form>
                                            <form action="<?= url('/admin/reviews/' . (int) $review['id'] . '/reject') ?>" method="post">
                                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4 mb-0">No pending reviews.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script id="salesChartData" type="application/json"><?= json_encode($salesData ?? [], JSON_UNESCAPED_UNICODE) ?></script>
