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

// Image resolution is now handled by the global resolve_blog_image() helper in public/index.php
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
                                <label for="blog-search" class="form-label small text-muted">Search</label>
                                <input type="text" id="blog-search" name="q" class="form-control" placeholder="Search posts..." value="<?= htmlspecialchars($searchQuery) ?>" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="blog-category" class="form-label small text-muted">Category</label>
                                <select id="blog-category" name="category" class="form-select">
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
                            <?php $imagePath = resolve_blog_image($post['featured_image'] ?? null); ?>
                            <div class="col-sm-6 col-md-4">
                                <article class="card h-100 shadow-sm border-0 blog-card">
                                    <a href="<?= url('/blog/' . $post['slug']) ?>">
                                        <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top blog-card-image" alt="<?= htmlspecialchars($post['title']) ?>" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
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
                    <?php $currentPage = (int) ($pagination['current_page'] ?? 1); ?>
                    <?php $lastPage = (int) ($pagination['last_page'] ?? 1); ?>
                    <nav class="mt-5 d-flex justify-content-center" aria-label="Blog pagination">
                        <ul class="blog-pagination">
                            <li>
                                <a class="blog-page-btn <?= $currentPage <= 1 ? 'disabled' : '' ?>"
                                   href="<?= $currentPage > 1 ? htmlspecialchars($buildBlogUrl($currentPage - 1, $selectedCategory, $searchQuery)) : '#' ?>"
                                   aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $lastPage; $i++): ?>
                            <li>
                                <a class="blog-page-btn <?= $i === $currentPage ? 'active' : '' ?>"
                                   href="<?= htmlspecialchars($buildBlogUrl($i, $selectedCategory, $searchQuery)) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                            <?php endfor; ?>
                            <li>
                                <a class="blog-page-btn <?= $currentPage >= $lastPage ? 'disabled' : '' ?>"
                                   href="<?= $currentPage < $lastPage ? htmlspecialchars($buildBlogUrl($currentPage + 1, $selectedCategory, $searchQuery)) : '#' ?>"
                                   aria-label="Next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
// Clean up empty URL parameters on blog filter submit
document.querySelector('.blog-filter-form')?.addEventListener('submit', function(e) {
    const inputs = this.querySelectorAll('input, select');
    inputs.forEach(input => {
        if (!input.value || input.value.trim() === '') {
            input.disabled = true; // Disable empty inputs so they aren't sent in the GET request
        }
    });
});
</script>

<style>
/* ── Blog Pagination ─────────────────────────────── */
.blog-pagination {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.blog-page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 14px;
    border-radius: 50px;
    border: 1.5px solid #e0c89a;
    color: #8B6914;
    background: #fff;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}
.blog-page-btn:hover:not(.disabled):not(.active) {
    background: #fdf3e3;
    border-color: #D4A574;
    color: #6b4f10;
    transform: translateY(-1px);
}
.blog-page-btn.active {
    background: #D4A574;
    border-color: #D4A574;
    color: #fff;
    font-weight: 700;
    box-shadow: 0 3px 10px rgba(212,165,116,0.4);
}
.blog-page-btn.disabled {
    opacity: 0.4;
    pointer-events: none;
}
</style>

