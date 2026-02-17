<?php
$categories = $categories ?? [];
$relatedPosts = $relatedPosts ?? [];

$resolveBlogImage = function(?string $rawImage): string {
    if (empty($rawImage)) {
        return asset('/img/product-placeholder.webp');
    }

    $image = trim((string) $rawImage);
    if ($image === '') {
        return asset('/img/product-placeholder.webp');
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

$featuredImagePath = $resolveBlogImage($post['featured_image'] ?? null);
?>

<section class="blog-detail-page py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <a href="<?= url('/blog') ?>" class="btn btn-link px-0 mb-3">&larr; Back to Blog</a>
                <h1 class="mb-2"><?= htmlspecialchars($post['title']) ?></h1>
                <div class="text-muted small mb-4">
                    <?= htmlspecialchars($post['category'] ?? 'General') ?> •
                    <?= date('M d, Y', strtotime($post['published_at'] ?: $post['created_at'])) ?>
                    <?php if (!empty($post['first_name'])): ?>
                        • By <?= htmlspecialchars(trim(($post['first_name'] ?? '') . ' ' . ($post['last_name'] ?? ''))) ?>
                    <?php endif; ?>
                </div>

                <figure class="mb-4">
                    <img src="<?= htmlspecialchars($featuredImagePath) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="img-fluid rounded blog-detail-image" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                </figure>

                <article class="blog-content mb-5">
                    <?= $post['content'] ?>
                </article>

                <?php if (!empty($relatedPosts)): ?>
                <section class="related-posts">
                    <h3 class="mb-3">Related Posts</h3>
                    <div class="row g-3">
                        <?php foreach ($relatedPosts as $related): ?>
                        <?php $relatedImage = $resolveBlogImage($related['featured_image'] ?? null); ?>
                        <div class="col-md-6">
                            <article class="card border-0 shadow-sm h-100">
                                <a href="<?= url('/blog/' . $related['slug']) ?>">
                                    <img src="<?= htmlspecialchars($relatedImage) ?>" class="card-img-top blog-related-image" alt="<?= htmlspecialchars($related['title']) ?>" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted mb-2">
                                        <?= htmlspecialchars($related['category'] ?? 'General') ?> •
                                        <?= date('M d, Y', strtotime($related['published_at'] ?: $related['created_at'])) ?>
                                    </div>
                                    <h6 class="mb-2"><?= htmlspecialchars($related['title']) ?></h6>
                                    <a href="<?= url('/blog/' . $related['slug']) ?>" class="btn btn-sm btn-outline-primary">Read Post</a>
                                </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
            </div>

            <aside class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Post Categories</h5>
                        <ul class="blog-category-list list-unstyled mb-0">
                            <li>
                                <a href="<?= url('/blog') ?>">All Categories</a>
                            </li>
                            <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="<?= url('/blog?category=' . urlencode($category['category'])) ?>" class="<?= ($post['category'] ?? '') === $category['category'] ? 'active' : '' ?>">
                                    <?= htmlspecialchars($category['category']) ?>
                                    <span><?= (int) $category['post_count'] ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
