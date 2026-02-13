<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Reviews</h2>
</div>

<form method="get" action="<?= url('/admin/reviews') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="pending" <?= (($status ?? 'pending') === 'pending') ? 'selected' : '' ?>>Pending</option>
                <option value="approved" <?= (($status ?? 'pending') === 'approved') ? 'selected' : '' ?>>Approved</option>
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
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <tr>
                                <td data-label="Product">
                                    <a href="<?= url('/product/' . htmlspecialchars((string) ($review['product_slug'] ?? ''))) ?>" target="_blank">
                                        <?= htmlspecialchars((string) ($review['product_name'] ?? 'Product')) ?>
                                    </a>
                                </td>
                                <td data-label="Customer"><?= htmlspecialchars(trim((string) (($review['first_name'] ?? 'Guest') . ' ' . ($review['last_name'] ?? '')))) ?></td>
                                <td data-label="Rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="<?= $i <= (int) ($review['rating'] ?? 0) ? 'fas' : 'far' ?> fa-star text-warning"></i>
                                    <?php endfor; ?>
                                </td>
                                <td data-label="Comment">
                                    <?php $comment = (string) ($review['comment'] ?? ''); ?>
                                    <?= htmlspecialchars(strlen($comment) > 90 ? substr($comment, 0, 87) . '...' : $comment) ?>
                                </td>
                                <td data-label="Date"><?= !empty($review['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($review['created_at']))) : '-' ?></td>
                                <td data-label="Action" class="text-end">
                                    <?php if (($status ?? 'pending') === 'pending'): ?>
                                        <form method="post" action="<?= url('/admin/reviews/' . (int) $review['id'] . '/approve') ?>" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-success">Approve</button>
                                        </form>
                                        <form method="post" action="<?= url('/admin/reviews/' . (int) $review['id'] . '/reject') ?>" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                        </form>
                                    <?php else: ?>
                                        <form method="post" action="<?= url('/admin/reviews/' . (int) $review['id'] . '/reject') ?>" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Remove</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No reviews found.</td>
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
                <a class="page-link" href="<?= url('/admin/reviews?page=' . $p . '&status=' . urlencode((string) ($status ?? 'pending'))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
