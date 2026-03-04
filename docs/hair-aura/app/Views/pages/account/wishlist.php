<section class="py-5">
    <div class="container">
        <h1 class="mb-4">My Wishlist</h1>
        <input type="hidden" id="wishlistCsrfToken" value="<?= \App\Core\Auth::csrfToken() ?>">

        <?php if (!empty($wishlist)): ?>
            <div class="row g-3" id="wishlistGrid">
                <?php foreach ($wishlist as $item): ?>
                    <?php
                    $slug = (string) ($item['slug'] ?? $item->slug ?? '');
                    $productName = (string) ($item['name'] ?? $item->name ?? 'Wishlist Item');
                    $productPrice = (float) ($item['sale_price'] ?? $item->sale_price ?? $item['price'] ?? $item->price ?? 0);
                    $productId = (int) ($item['id'] ?? $item->id ?? 0);
                    $imagePath = (string) ($item['primary_image'] ?? '');
                    if ($imagePath !== '') {
                        if (str_starts_with($imagePath, 'uploads/') || str_starts_with($imagePath, 'img/')) {
                            $image = asset('/' . ltrim($imagePath, '/'));
                        } else {
                            $image = asset('/uploads/products/' . ltrim($imagePath, '/'));
                        }
                    } else {
                        $image = asset('/img/product-placeholder.webp');
                    }
                    ?>
                    <div class="col-md-6 col-lg-4 wishlist-item" data-product-id="<?= $productId ?>">
                        <div class="card h-100 shadow-sm">
                            <a href="<?= $slug !== '' ? url('/product/' . $slug) : '#' ?>">
                                <img src="<?= htmlspecialchars($image) ?>" class="card-img-top" alt="<?= htmlspecialchars($productName) ?>" style="height:240px;object-fit:cover;" onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($productName) ?></h5>
                                <p class="small text-muted mb-2"><?= htmlspecialchars((string) ($item['category_name'] ?? 'Wigs')) ?></p>
                                <p class="mb-3 fw-semibold"><?= money($productPrice) ?></p>
                                <div class="d-flex gap-2">
                                    <?php if ($slug !== ''): ?>
                                        <a href="<?= url('/product/' . $slug) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-wishlist" data-product-id="<?= $productId ?>">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="wishlistEmptyMessage" class="alert alert-info mt-3 d-none">Your wishlist is empty.</div>
        <?php else: ?>
            <p class="alert alert-info mb-0">Your wishlist is empty.</p>
        <?php endif; ?>
    </div>
</section>
