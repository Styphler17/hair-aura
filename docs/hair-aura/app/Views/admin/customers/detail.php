<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Customer: <?= htmlspecialchars($customer->getFullName()) ?></h2>
    <a href="<?= url('/admin/customers') ?>" class="btn btn-outline-secondary">Back to Customers</a>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Profile</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="<?= asset($customer->getAvatarUrl()) ?>" alt="<?= htmlspecialchars($customer->getFullName()) ?>" style="width:56px;height:56px;border-radius:50%;object-fit:cover;">
                    <div>
                        <div class="fw-semibold"><?= htmlspecialchars($customer->getFullName()) ?></div>
                        <div class="small text-muted"><?= htmlspecialchars((string) $customer->role) ?></div>
                    </div>
                </div>
                <div class="small text-muted">Email</div>
                <div class="mb-2"><?= htmlspecialchars((string) $customer->email) ?></div>
                <div class="small text-muted">Phone</div>
                <div class="mb-2"><?= htmlspecialchars((string) $customer->phone) ?></div>
                <div class="small text-muted">Member Since</div>
                <div><?= !empty($customer->created_at) ? htmlspecialchars(date('Y-m-d', strtotime((string) $customer->created_at))) : '-' ?></div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Stats</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Total Orders</span>
                    <strong><?= (int) $customer->getOrderCount() ?></strong>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span>Total Spent</span>
                    <strong><?= money((float) $customer->getTotalSpent()) ?></strong>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span>Wishlist Items</span>
                    <strong><?= count($customer->getWishlist()) ?></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Recent Orders</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><strong>#<?= htmlspecialchars($order['order_number'] ?? '') ?></strong></td>
                                        <td><?= htmlspecialchars(ucfirst((string) ($order['status'] ?? 'pending'))) ?></td>
                                        <td><?= htmlspecialchars(ucfirst((string) ($order['payment_status'] ?? 'pending'))) ?></td>
                                        <td><?= money((float) ($order['total'] ?? 0)) ?></td>
                                        <td><?= !empty($order['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($order['created_at']))) : '-' ?></td>
                                        <td class="text-end">
                                            <a href="<?= url('/admin/orders/' . (int) $order['id']) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No orders found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Addresses</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($addresses)): ?>
                    <div class="row g-2">
                        <?php foreach ($addresses as $address): ?>
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <div class="fw-semibold mb-1">
                                        <?= htmlspecialchars(($address['type'] ?? 'Address')) ?>
                                        <?php if (!empty($address['is_default'])): ?>
                                            <span class="badge bg-primary ms-1">Default</span>
                                        <?php endif; ?>
                                    </div>
                                    <div><?= htmlspecialchars((string) ($address['first_name'] ?? '')) ?> <?= htmlspecialchars((string) ($address['last_name'] ?? '')) ?></div>
                                    <div><?= htmlspecialchars((string) ($address['address_line1'] ?? '')) ?></div>
                                    <?php if (!empty($address['address_line2'])): ?>
                                        <div><?= htmlspecialchars((string) $address['address_line2']) ?></div>
                                    <?php endif; ?>
                                    <div><?= htmlspecialchars((string) ($address['city'] ?? '')) ?>, <?= htmlspecialchars((string) ($address['state'] ?? '')) ?></div>
                                    <div><?= htmlspecialchars((string) ($address['country'] ?? 'Ghana')) ?></div>
                                    <div class="small text-muted mt-1"><?= htmlspecialchars((string) ($address['phone'] ?? '')) ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0">No saved addresses.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
