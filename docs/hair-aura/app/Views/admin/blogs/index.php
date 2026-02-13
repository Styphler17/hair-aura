<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Blog Posts</h2>
    <a href="<?= url('/admin/blogs/add') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Post
    </a>
</div>

<form method="get" action="<?= url('/admin/blogs') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-6">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Title or content">
        </div>
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach (($categories ?? []) as $item): ?>
                    <?php $category = (string) ($item['category'] ?? 'General'); ?>
                    <option value="<?= htmlspecialchars($category) ?>" <?= (($categoryFilter ?? '') === $category) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category) ?>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td data-label="Title">
                                    <strong><?= htmlspecialchars($post['title']) ?></strong>
                                    <div class="small text-muted">/blog/<?= htmlspecialchars($post['slug']) ?></div>
                                </td>
                                <td data-label="Category"><?= htmlspecialchars($post['category'] ?? 'General') ?></td>
                                <td data-label="Status">
                                    <?php if (!empty($post['is_published'])): ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Published"><?= !empty($post['published_at']) ? htmlspecialchars(date('Y-m-d', strtotime($post['published_at']))) : '-' ?></td>
                                <td data-label="Actions" class="text-end">
                                    <a href="<?= url('/admin/blogs/edit/' . (int) $post['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="post" action="<?= url('/admin/blogs/delete/' . (int) $post['id']) ?>" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No blog posts found.</td>
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
                <a class="page-link" href="<?= url('/admin/blogs?page=' . $p . '&search=' . urlencode((string) ($search ?? '')) . '&category=' . urlencode((string) ($categoryFilter ?? ''))) ?>"><?= $p ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
