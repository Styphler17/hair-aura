<?php
$shareUrl = (string) ($shareUrl ?? '');
if ($shareUrl === '') {
    $configuredBaseUrl = rtrim((string) ($_ENV['APP_URL'] ?? ''), '/');
    $requestHost = (string) ($_SERVER['HTTP_HOST'] ?? '');
    $requestScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $runtimeBaseUrl = $requestHost !== '' ? ($requestScheme . '://' . $requestHost . rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/')) : '';
    $siteBaseUrl = $configuredBaseUrl !== '' ? $configuredBaseUrl : rtrim($runtimeBaseUrl, '/');
    $shareUrl = $siteBaseUrl . '/product/' . ltrim((string) ($product->slug ?? ''), '/');
}

$resolveProductImage = function($path) {
    if (!$path) return asset('/img/product-placeholder.webp');
    if (str_starts_with($path, 'uploads/') || str_starts_with($path, 'img/')) {
        return asset('/' . ltrim($path, '/'));
    }
    return asset('/uploads/products/' . $path);
};

// Split price for Amazon styling
$priceParts = explode('.', number_format((float)$product->getCurrentPrice(), 2, '.', ''));
$priceInt = $priceParts[0];
$priceDec = $priceParts[1] ?? '00';
?>

<div class="amazon-product-layout py-3">
    <div class="container-fluid px-lg-5">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="amazon-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/shop">Shop</a></li>
                <?php if ($category): ?>
                <li class="breadcrumb-item"><a href="/shop/<?= htmlspecialchars($category['slug']) ?>"><?= htmlspecialchars($category['name']) ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active"><?= htmlspecialchars($product->name) ?></li>
            </ol>
        </nav>

        <div class="row gx-lg-5">
            <!-- Column 1: Images -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="product-image-grid">
                    <!-- Vertical Thumbnails -->
                    <div class="vertical-thumbs d-none d-md-flex">
                        <?php foreach ($images as $index => $image): ?>
                            <?php $imgUrl = $resolveProductImage($image['image_path']); ?>
                            <div class="vertical-thumb <?= $image['is_primary'] ? 'active' : '' ?>" data-image="<?= $imgUrl ?>">
                                <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($product->name) ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Main Image -->
                    <div class="main-image-display border rounded p-2">
                        <img src="<?= $product->getPrimaryImage() ?>" id="mainImage" alt="<?= htmlspecialchars($product->name) ?>" class="img-fluid">
                        <?php if ($product->isOnSale()): ?>
                            <span class="badge bg-danger position-absolute top-0 end-0 m-3 p-2 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">-<?= $product->getDiscountPercent() ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Horizontal Thumbnails for Mobile -->
                <div class="d-md-none mt-3">
                    <div class="d-flex gap-2 overflow-auto pb-2">
                        <?php foreach ($images as $image): ?>
                            <?php $imgUrl = $resolveProductImage($image['image_path']); ?>
                            <div class="vertical-thumb <?= $image['is_primary'] ? 'active' : '' ?>" data-image="<?= $imgUrl ?>" style="width: 60px; height: 60px; flex-shrink: 0;">
                                <img src="<?= $imgUrl ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Column 2: Details -->
            <div class="col-lg-4 amazon-info-col">
                <h1 class="mb-1"><?= htmlspecialchars($product->name) ?></h1>
                <a href="/shop/<?= htmlspecialchars($category['slug'] ?? 'all') ?>" class="amazon-brand-link mb-2 d-inline-block">Visit the <?= htmlspecialchars($product->brand ?: 'Hair Aura') ?> Store</a>
                
                <div class="amazon-rating">
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="<?= $i <= round($product->rating_avg) ? 'fas' : 'far' ?> fa-star"></i>
                        <?php endfor; ?>
                        <i class="fas fa-chevron-down ms-1" style="font-size: 0.6rem; color: #565959;"></i>
                    </div>
                    <a href="#reviews" class="rating-text"><?= $product->review_count ?> ratings</a>
                </div>

                <div class="amazon-divider"></div>

                <div class="amazon-price-row">
                    <span class="price-symbol">GH₵</span>
                    <span class="price-large" id="displayPriceInt"><?= $priceInt ?></span>
                    <span class="price-decimal" id="displayPriceDec"><?= $priceDec ?></span>
                    <?php if ($product->isOnSale()): ?>
                        <span class="old-price">List: <span class="text-decoration-line-through"><?= money($product->price) ?></span></span>
                    <?php endif; ?>
                </div>

                <!-- Variants -->
                <?php if (!empty($variants)): ?>
                <div class="amazon-variant-section">
                    <label>Size: <span id="selectedOptionName" class="fw-normal"><?= htmlspecialchars($variants[0]['variant_value']) ?></span></label>
                    <div class="amazon-variant-switches">
                        <?php foreach ($variants as $index => $variant): ?>
                            <?php 
                                $vFinal = $product->sale_price ? ($product->sale_price + $variant['price_adjustment']) : ($product->price + $variant['price_adjustment']);
                                $vParts = explode('.', number_format((float)$vFinal, 2, '.', ''));
                            ?>
                            <div class="amazon-swatch <?= $index === 0 ? 'active' : '' ?>" 
                                 data-id="<?= $variant['id'] ?>"
                                 data-price-int="<?= $vParts[0] ?>"
                                 data-price-dec="<?= $vParts[1] ?>"
                                 data-stock="<?= $variant['stock_quantity'] ?>"
                                 data-value="<?= htmlspecialchars($variant['variant_value']) ?>">
                                <span class="swatch-label"><?= htmlspecialchars($variant['variant_value']) ?></span>
                                <span class="swatch-price">GH₵<?= number_format($vFinal, 2) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="amazon-divider"></div>

                <h6 class="fw-bold mb-3">About this item</h6>
                <ul class="amazon-bullet-points">
                    <?php 
                        $bullets = array_filter(explode("\n", strip_tags($product->short_description ?: $product->description)));
                        foreach (array_slice($bullets, 0, 5) as $bullet): 
                    ?>
                        <li><?= htmlspecialchars(trim($bullet)) ?></li>
                    <?php endforeach; ?>
                </ul>

                <!-- Characteristics Table -->
                <table class="table table-sm border-0 amazon-meta-table mb-4">
                    <tbody>
                        <?php if($product->hair_type): ?>
                        <tr><td class="fw-bold">Hair Type</td><td><?= ucwords(str_replace('_', ' ', $product->hair_type)) ?></td></tr>
                        <?php endif; ?>
                        <?php if($product->texture): ?>
                        <tr><td class="fw-bold">Texture</td><td><?= ucwords(str_replace('_', ' ', $product->texture)) ?></td></tr>
                        <?php endif; ?>
                        <?php if($product->color): ?>
                        <tr><td class="fw-bold">Color</td><td><?= htmlspecialchars($product->color) ?></td></tr>
                        <?php endif; ?>
                        <?php if($product->brand): ?>
                        <tr><td class="fw-bold">Brand</td><td><?= htmlspecialchars($product->brand) ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Column 3: Buy Box -->
            <div class="col-lg-3">
                <div class="amazon-buy-box shadow-sm">
                    <span class="price-symbol">GH₵</span>
                    <span class="price-large" id="buyBoxPriceInt"><?= $priceInt ?></span>
                    <span class="price-decimal" id="buyBoxPriceDec"><?= $priceDec ?></span>
                    
                    <div class="amazon-delivery-info mt-2">
                        FREE delivery <strong>Tomorrow</strong>. Order within <span class="text-success fw-bold">4 hrs 12 mins.</span>
                    </div>

                    <div class="amazon-stock-status <?= $product->isInStock() ? 'in-stock' : 'out-of-stock' ?>" id="buyBoxStock">
                        <?= $product->isInStock() ? 'In Stock' : 'Out of Stock' ?>
                    </div>

                    <form id="amazonAddToCartForm">
                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <input type="hidden" name="variant_id" id="buyBoxVariantId" value="<?= !empty($variants) ? $variants[0]['id'] : '' ?>">
                        
                        <label class="small fw-bold mb-1">Quantity:</label>
                        <select name="quantity" class="amazon-qty-select mb-3" id="qtySelect">
                            <?php for($i=1; $i <= min(10, $product->stock_quantity); $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>

                        <button type="submit" class="btn btn-amazon-cart" <?= !$product->isInStock() ? 'disabled' : '' ?>>
                            Add to Cart
                        </button>
                        <button type="button" class="btn btn-amazon-buy" onclick="document.getElementById('amazonAddToCartForm').submit();" <?= !$product->isInStock() ? 'disabled' : '' ?>>
                            Buy Now
                        </button>
                    </form>

                    <div class="amazon-secure-transaction mt-2">
                        <i class="fas fa-lock text-muted"></i>
                        <span>Secure transaction</span>
                    </div>

                    <table class="amazon-meta-table mt-3">
                        <tr><td>Ships from</td><td><strong>Hair Aura</strong></td></tr>
                        <tr><td>Sold by</td><td><strong>Hair Aura Official</strong></td></tr>
                        <tr><td>Returns</td><td class="text-danger">No returns accepted</td></tr>
                        <tr><td>Payment</td><td>Payment on delivery within Accra</td></tr>
                    </table>

                    <div class="amazon-divider"></div>

                    <button class="btn btn-outline-secondary btn-sm w-100 btn-wishlist <?= $inWishlist ? 'active' : '' ?>" data-product-id="<?= $product->id ?>">
                        <i class="<?= $inWishlist ? 'fas' : 'far' ?> fa-heart me-2"></i>
                        Add to Wish List
                    </button>
                </div>
            </div>
        </div>

        <!-- Description & Reviews Full Width -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="amazon-divider mb-4"></div>
                <h4 class="fw-bold mb-4">Product Description</h4>
                <div class="px-3" style="font-size: 0.95rem; line-height: 1.6;">
                    <?= $product->description ?>
                </div>

                <div class="amazon-divider my-5"></div>
                
                <div class="row" id="reviews">
                    <div class="col-lg-4">
                        <h4 class="fw-bold mb-3">Customer reviews</h4>
                        <div class="d-flex align-items-center mb-1">
                            <div class="stars me-2 text-warning" style="font-size: 1.2rem;">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <i class="<?= $i <= round($product->rating_avg) ? 'fas' : 'far' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="fw-bold fs-5"><?= number_format($product->rating_avg, 1) ?> out of 5</span>
                        </div>
                        <div class="text-muted small mb-4"><?= $product->review_count ?> global ratings</div>

                        <!-- Rating Bars -->
                        <?php foreach (array_reverse($ratingDistribution, true) as $star => $data): ?>
                        <div class="d-flex align-items-center mb-2" style="font-size: 0.88rem;">
                            <a href="#" class="text-primary text-decoration-none me-2" style="width: 50px;"><?= $star ?> star</a>
                            <div class="progress flex-grow-1" style="height: 20px; background: #f0f2f2; border: 1px solid #ddd; border-radius: 4px;">
                                <div class="progress-bar bg-warning" style="width: <?= $data['percentage'] ?>"></div>
                            </div>
                            <span class="ms-3 text-primary" style="width: 40px; text-align: right;"><?= $data['percentage'] ?></span>
                        </div>
                        <?php endforeach; ?>
                        
                        <div class="amazon-divider my-4"></div>
                        <h5 class="fw-bold">Review this product</h5>
                        <p class="small">Share your thoughts with other customers</p>
                        <?php if ($canReview): ?>
                            <button class="btn btn-outline-secondary w-100 rounded-pill py-1" data-bs-toggle="collapse" data-bs-target="#reviewForm">Write a customer review</button>
                            <div class="collapse mt-3" id="reviewForm">
                                <form action="/product/<?= $product->id ?>/review" method="post" class="bg-light p-3 rounded shadow-sm">
                                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                    <input type="hidden" name="slug" value="<?= $product->slug ?>">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Overall rating</label>
                                        <div class="text-warning fs-4 rating-selector" style="cursor: pointer;">
                                            <input type="hidden" name="rating" id="formRating" value="5">
                                            <i class="fas fa-star" data-val="1"></i>
                                            <i class="fas fa-star" data-val="2"></i>
                                            <i class="fas fa-star" data-val="3"></i>
                                            <i class="fas fa-star" data-val="4"></i>
                                            <i class="fas fa-star" data-val="5"></i>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Add a headline</label>
                                        <input type="text" name="title" class="form-control form-control-sm" placeholder="What's most important to know?">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Add a written review</label>
                                        <textarea name="comment" class="form-control form-control-sm" rows="4" placeholder="What did you like or dislike? What did you use this product for?"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-amazon-buy btn-sm rounded-pill w-100">Submit</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <button class="btn btn-outline-secondary w-100 rounded-pill py-1 disabled">Sign in to review</button>
                        <?php endif; ?>
                    </div>

                    <!-- Reviews List -->
                    <div class="col-lg-8">
                        <h4 class="fw-bold ps-lg-5 mb-4">Top reviews from Ghana</h4>
                        <div class="ps-lg-5">
                            <?php if (empty($reviews)): ?>
                                <p class="text-muted">No reviews yet. Be the first to share your experience!</p>
                            <?php else: ?>
                                <?php foreach ($reviews as $rev): ?>
                                <div class="amazon-review mb-5">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 34px; height: 34px; background: #ccc !important;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <span class="small fw-bold"><?= htmlspecialchars($rev['first_name'] . ' ' . substr($rev['last_name'], 0, 1) . '.') ?></span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="text-warning small me-2">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <i class="<?= $i <= $rev['rating'] ? 'fas' : 'far' ?> fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="small fw-bold pt-1"><?= htmlspecialchars($rev['title'] ?: 'Verified Purchase') ?></span>
                                    </div>
                                    <p class="text-muted mb-2" style="font-size: 0.82rem;">Reviewed in Ghana on <?= date('d F Y', strtotime($rev['created_at'])) ?></p>
                                    <?php if ($rev['is_verified_purchase']): ?>
                                        <div class="text-danger small fw-bold mb-2" style="font-size: 0.75rem; color: #c45500 !important;">Verified Purchase</div>
                                    <?php endif; ?>
                                    <div class="review-text" style="font-size: 0.88rem;">
                                        <?= nl2br(htmlspecialchars($rev['comment'])) ?>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-secondary px-3 py-0 rounded" style="font-size: 0.75rem;">Helpful</button>
                                        <span class="mx-2 text-muted" style="font-size: 0.75rem;">|</span>
                                        <span class="text-muted" style="font-size: 0.75rem; cursor: pointer;">Report</span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail logic
    const mainImage = document.getElementById('mainImage');
    const thumbs = document.querySelectorAll('[data-image]');
    thumbs.forEach(t => {
        t.addEventListener('mouseenter', function() {
            thumbs.forEach(x => x.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.dataset.image;
        });
        t.addEventListener('click', function() {
            mainImage.src = this.dataset.image;
        });
    });

    // Variant logic
    const switches = document.querySelectorAll('.amazon-swatch');
    const priceInts = document.querySelectorAll('#displayPriceInt, #buyBoxPriceInt');
    const priceDecs = document.querySelectorAll('#displayPriceDec, #buyBoxPriceDec');
    const qtySelect = document.getElementById('qtySelect');
    const stockStatus = document.getElementById('buyBoxStock');
    const variantIdInput = document.getElementById('buyBoxVariantId');
    const optionNameLabel = document.getElementById('selectedOptionName');

    switches.forEach(s => {
        s.addEventListener('click', function() {
            switches.forEach(x => x.classList.remove('active'));
            this.classList.add('active');

            // Update UI
            priceInts.forEach(el => el.textContent = this.dataset.priceInt);
            priceDecs.forEach(el => el.textContent = this.dataset.priceDec);
            optionNameLabel.textContent = this.dataset.value;
            variantIdInput.value = this.dataset.id;

            // Update Qty dropdown
            const stock = parseInt(this.dataset.stock);
            qtySelect.innerHTML = '';
            for(let i=1; i <= Math.min(10, stock); i++) {
                qtySelect.innerHTML += `<option value="${i}">${i}</option>`;
            }

            if(stock > 0) {
                stockStatus.textContent = 'In Stock';
                stockStatus.className = 'amazon-stock-status in-stock';
                document.querySelectorAll('.btn-amazon-cart, .btn-amazon-buy').forEach(b => b.disabled = false);
            } else {
                stockStatus.textContent = 'Out of Stock';
                stockStatus.className = 'amazon-stock-status out-of-stock';
                document.querySelectorAll('.btn-amazon-cart, .btn-amazon-buy').forEach(b => b.disabled = true);
            }
        });
    });

    // Rating form logic
    const starInput = document.getElementById('formRating');
    const starIcons = document.querySelectorAll('.rating-selector i');
    starIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const val = this.dataset.val;
            starInput.value = val;
            starIcons.forEach(s => {
                if(s.dataset.val <= val) {
                    s.className = 'fas fa-star';
                } else {
                    s.className = 'far fa-star';
                }
            });
        });
    });

    // Add to cart form
    const addForm = document.getElementById('amazonAddToCartForm');
    if(addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('.btn-amazon-cart');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Adding...';
            btn.disabled = true;

            const formData = new FormData(this);
            fetch('/cart/add', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    // Update header cart count if possible
                    const cartCount = document.querySelector('.cart-count');
                    if(cartCount) cartCount.textContent = data.cart_count;
                    
                    btn.innerHTML = '<i class="fas fa-check me-2"></i>Added!';
                    btn.className = 'btn btn-success btn-amazon-cart';
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.className = 'btn btn-amazon-cart';
                        btn.disabled = false;
                    }, 2000);
                } else {
                    alert(data.message || 'Error adding to cart');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            })
            .catch(() => {
                alert('Connection error');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        });
    }

    // Wishlist Logic
    const wishlistBtns = document.querySelectorAll('.btn-wishlist');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const isActive = this.classList.contains('active');
            const url = isActive ? '/account/wishlist/remove' : '/account/wishlist/add';
            
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('csrf_token', '<?= \App\Core\Auth::csrfToken() ?>');

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.className = 'fas fa-heart me-2';
                        this.innerHTML = '<i class="fas fa-heart me-2"></i>In Wish List';
                    } else {
                        icon.className = 'far fa-heart me-2';
                        this.innerHTML = '<i class="far fa-heart me-2"></i>Add to Wish List';
                    }
                } else if (data.redirect) {
                    window.location.href = data.redirect;
                }
            });
        });
    });
});
</script>
