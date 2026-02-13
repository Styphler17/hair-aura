<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Products</h2>
    <a href="<?= url('/admin/products/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
</div>

<form method="get" action="<?= url('/admin/products') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-7">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Name or SKU">
        </div>
        <div class="col-md-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach (($categories ?? []) as $category): ?>
                    <option value="<?= (int) $category['id'] ?>" <?= ((string) ($categoryFilter ?? '') === (string) $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
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
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td data-label="Product">
                                    <strong><?= htmlspecialchars($product['name']) ?></strong>
                                    <div class="small text-muted"><?= htmlspecialchars($product['sku'] ?? '') ?></div>
                                </td>
                                <td data-label="Category"><?= htmlspecialchars($product['category_name'] ?? '-') ?></td>
                                <td data-label="Price">
                                    <?php if (!empty($product['sale_price'])): ?>
                                        <span class="text-decoration-line-through text-muted small me-1"><?= money((float) $product['price']) ?></span>
                                        <span><?= money((float) $product['sale_price']) ?></span>
                                    <?php else: ?>
                                        <?= money((float) $product['price']) ?>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Stock"><?= (int) ($product['stock_quantity'] ?? 0) ?></td>
                                <td data-label="Status">
                                    <?php if (!empty($product['is_active'])): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Actions" class="text-end">
                                    <a href="<?= url('/admin/products/edit/' . (int) $product['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="post" action="<?= url('/admin/products/delete/' . (int) $product['id']) ?>" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No products found.</td>
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
                <a class="page-link" href="<?= url('/admin/products?page=' . $p . '&search=' . urlencode((string) ($search ?? '')) . '&category=' . urlencode((string) ($categoryFilter ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
