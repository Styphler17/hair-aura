<?php
$selectedCategory = $selectedCategory ?? '';
$searchQuery = $searchQuery ?? '';
$pagination = $pagination ?? ['current_page' => 1, 'last_page' => 1, 'total' => count($posts ?? [])];
$categories = $categories ?? [];

$buildBlogUrl = function(int $page = 1, ?string $category = null, ?string $query = null): string {
    $params = [];
    if ($page > 1) {
        $params['page'] = $page;
    }
    if (!empty($category)) {
        $params['category'] = $category;
    }
    if (!empty($query)) {
        $params['q'] = $query;
    }

    $base = url('/blog');
    return empty($params) ? $base : $base . '?' . http_build_query($params);
};

$resolveBlogImage = function(array $post): string {
    if (empty($post['featured_image'])) {
        return asset('/img/product-placeholder.png');
    }

    $image = trim((string) $post['featured_image']);
    if ($image === '') {
        return asset('/img/product-placeholder.png');
    }

    if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
        return $image;
    }

    if (str_starts_with($image, '/')) {
        return $image;
    }

    // If explicit path from root (e.g. uploads/ or img/)
    if (str_starts_with($image, 'uploads/') || str_starts_with($image, 'img/')) {
        return asset('/' . ltrim($image, '/'));
    }

    // Otherwise, treat as relative to blog uploads folder (supporting ../)
    return asset('/uploads/blog/' . ltrim($image, '/'));
};
?>

<section class="blog-page py-5">
    <div class="container">
        <div class="blog-page-heading d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="mb-2">Hair Aura Blog</h1>
                <p class="text-muted mb-0">Wig care tips, styling guides, trends, and practical beauty advice in Ghana.</p>
            </div>
            <a href="<?= url('/shop') ?>" class="btn btn-outline-primary">Shop Products</a>
        </div>

        <div class="row g-4">
            <aside class="col-lg-3">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Filter Posts</h5>
                        <form method="get" action="<?= url('/blog') ?>" class="search-form blog-filter-form" data-live-search="blog">
                            <div class="mb-3">
                                <label class="form-label small text-muted">Search</label>
                                <input type="text" name="q" class="form-control" placeholder="Search posts..." value="<?= htmlspecialchars($searchQuery) ?>" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small text-muted">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['category']) ?>" <?= $selectedCategory === $category['category'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['category']) ?> (<?= (int) $category['post_count'] ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3">Categories</h5>
                        <ul class="blog-category-list list-unstyled mb-0">
                            <li>
                                <a href="<?= htmlspecialchars($buildBlogUrl(1, null, $searchQuery)) ?>" class="<?= $selectedCategory === '' ? 'active' : '' ?>">
                                    All Categories
                                    <span><?= array_sum(array_map(static fn($row) => (int) $row['post_count'], $categories)) ?></span>
                                </a>
                            </li>
                            <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="<?= htmlspecialchars($buildBlogUrl(1, $category['category'], $searchQuery)) ?>" class="<?= $selectedCategory === $category['category'] ? 'active' : '' ?>">
                                    <?= htmlspecialchars($category['category']) ?>
                                    <span><?= (int) $category['post_count'] ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0 text-muted">Showing <?= count($posts) ?> of <?= (int) ($pagination['total'] ?? 0) ?> posts</p>
                </div>

                <?php if (empty($posts)): ?>
                    <div class="alert alert-info mb-0">No blog posts found. Try adjusting your filters.</div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($posts as $post): ?>
                            <?php $imagePath = $resolveBlogImage($post); ?>
                            <div class="col-md-6">
                                <article class="card h-100 shadow-sm border-0 blog-card">
                                    <a href="<?= url('/blog/' . $post['slug']) ?>">
                                        <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top blog-card-image" alt="<?= htmlspecialchars($post['title']) ?>" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                                    </a>
                                    <div class="card-body d-flex flex-column">
                                        <div class="small text-muted mb-2">
                                            <?= htmlspecialchars($post['category'] ?? 'General') ?> •
                                            <?= date('M d, Y', strtotime($post['published_at'] ?: $post['created_at'])) ?>
                                        </div>
                                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                                        <p class="card-text text-muted flex-grow-1">
                                            <?= htmlspecialchars($post['excerpt'] ?: substr(strip_tags($post['content'] ?? ''), 0, 130) . '...') ?>
                                        </p>
                                        <a href="<?= url('/blog/' . $post['slug']) ?>" class="btn btn-primary mt-2">Read More</a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (($pagination['last_page'] ?? 1) > 1): ?>
                    <nav class="mt-4" aria-label="Blog pagination">
                        <ul class="pagination justify-content-center">
                            <?php $currentPage = (int) ($pagination['current_page'] ?? 1); ?>
                            <?php $lastPage = (int) ($pagination['last_page'] ?? 1); ?>

                            <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= htmlspecialchars($buildBlogUrl(max(1, $currentPage - 1), $selectedCategory, $searchQuery)) ?>">Previous</a>
                            </li>

                            <?php for ($i = 1; $i <= $lastPage; $i++): ?>
                            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="<?= htmlspecialchars($buildBlogUrl($i, $selectedCategory, $searchQuery)) ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>

                            <li class="page-item <?= $currentPage >= $lastPage ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= htmlspecialchars($buildBlogUrl(min($lastPage, $currentPage + 1), $selectedCategory, $searchQuery)) ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
