<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Admin Search</h2>
</div>

<form method="get" action="<?= url('/admin/search') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-10">
            <label class="form-label">Search Products, Orders, Users, and Blog Posts</label>
            <input type="text" name="q" class="form-control" value="<?= htmlspecialchars((string) ($query ?? '')) ?>" placeholder="Type at least 2 characters" autofocus>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<?php if (!empty($query) && strlen((string) $query) >= 2): ?>
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header"><h5 class="mb-0">Products</h5></div>
                <div class="card-body">
                    <?php if (!empty($results['products'])): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($results['products'] as $product): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold"><?= htmlspecialchars((string) ($product['name'] ?? '')) ?></div>
                                            <div class="small text-muted"><?= htmlspecialchars((string) ($product['sku'] ?? '')) ?></div>
                                        </div>
                                        <a href="<?= url('/admin/products/edit/' . (int) $product['id']) ?>" class="btn btn-sm btn-outline-primary">Open</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No matching products.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header"><h5 class="mb-0">Orders</h5></div>
                <div class="card-body">
                    <?php if (!empty($results['orders'])): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($results['orders'] as $order): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold">#<?= htmlspecialchars((string) ($order['order_number'] ?? '')) ?></div>
                                            <div class="small text-muted"><?= htmlspecialchars((string) ($order['status'] ?? 'pending')) ?> • <?= money((float) ($order['total'] ?? 0)) ?></div>
                                        </div>
                                        <a href="<?= url('/admin/orders/' . (int) $order['id']) ?>" class="btn btn-sm btn-outline-primary">Open</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No matching orders.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header"><h5 class="mb-0">Users</h5></div>
                <div class="card-body">
                    <?php if (!empty($results['users'])): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($results['users'] as $account): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold"><?= htmlspecialchars(trim((string) (($account['first_name'] ?? '') . ' ' . ($account['last_name'] ?? '')))) ?></div>
                                            <div class="small text-muted"><?= htmlspecialchars((string) (($account['email'] ?? '') !== '' ? $account['email'] : ($account['phone'] ?? '-'))) ?></div>
                                        </div>
                                        <a href="<?= url('/admin/users/edit/' . (int) $account['id']) ?>" class="btn btn-sm btn-outline-primary">Open</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No matching users.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header"><h5 class="mb-0">Blog Posts</h5></div>
                <div class="card-body">
                    <?php if (!empty($results['posts'])): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($results['posts'] as $post): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold"><?= htmlspecialchars((string) ($post['title'] ?? '')) ?></div>
                                            <div class="small text-muted"><?= htmlspecialchars((string) ($post['category'] ?? 'General')) ?></div>
                                        </div>
                                        <a href="<?= url('/admin/blogs/edit/' . (int) $post['id']) ?>" class="btn btn-sm btn-outline-primary">Open</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No matching posts.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php elseif (!empty($query)): ?>
    <div class="alert alert-info">Type at least 2 characters to search.</div>
<?php endif; ?>
