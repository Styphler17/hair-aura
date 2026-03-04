<?php
/**
 * Reusable Product Card Partial
 * 
 * @var array $product The product data
 * @var callable $resolveProductImage Function to resolve product image path
 */

$productUrl = url("/product/" . $product['slug']);
$productName = htmlspecialchars($product['name']);
$imageSrc = $resolveProductImage($product['primary_image'] ?? '');
$placeholder = asset('/img/product-placeholder.webp');
$categoryName = htmlspecialchars($product['category_name'] ?? 'Wigs');

// Calculate sale discount if applicable
$hasSale = !empty($product['sale_price']) && $product['sale_price'] < $product['price'];
$discount = $hasSale ? round((($product['price'] - $product['sale_price']) / $product['price']) * 100) : 0;
?>

<article class="product-card premium-card" data-product-id="<?= $product['id'] ?>">
    <div class="card-inner">
        <figure class="product-image-wrapper">
            <a href="<?= $productUrl ?>" class="image-link" aria-label="View <?= $productName ?>">
                <div class="image-overlay"></div>
                <img src="<?= $imageSrc ?>" 
                     alt="<?= $productName ?>" 
                     class="main-image"
                     loading="lazy"
                     onerror="this.onerror=null;this.src='<?= $placeholder ?>';">
                <?php if ($hasSale): ?>
                    <div class="discount-pill">
                        <span class="pill-label">Save</span>
                        <span class="pill-value"><?= $discount ?>%</span>
                    </div>
                <?php endif; ?>
            </a>
            
            <div class="quick-actions">
                <button class="action-btn wishlist-btn <?= ($product['in_wishlist'] ?? false) ? 'active' : '' ?>" 
                        data-product-id="<?= $product['id'] ?>" 
                        title="Add to Wishlist">
                    <i class="<?= ($product['in_wishlist'] ?? false) ? 'fas' : 'far' ?> fa-heart"></i>
                </button>
                <button class="action-btn quickview-btn" 
                        data-product-id="<?= $product['id'] ?>" 
                        title="Quick View">
                    <i class="fas fa-expand-alt"></i>
                </button>
            </div>
        </figure>
        
        <div class="product-details">
            <div class="detail-header">
                <span class="category-tag"><?= $categoryName ?></span>
                <?php if (!empty($product['color'])): ?>
                    <div class="color-indicator" title="Color: <?= htmlspecialchars($product['color']) ?>">
                        <span class="color-dot" style="background: <?= strtolower($product['color']) === 'jet black' || strtolower($product['color']) === 'natural black (1b)' ? '#0a0a0a' : (str_contains(strtolower($product['color']), 'blonde') ? '#e9d2a0' : '#222') ?>"></span>
                    </div>
                <?php endif; ?>
            </div>
            
            <h3 class="product-name">
                <a href="<?= $productUrl ?>"><?= $productName ?></a>
            </h3>

            <div class="product-rating mb-1">
                <div class="stars">
                    <?php 
                    $ratingAvg = (float) ($product['rating_avg'] ?? 0);
                    $reviewCount = (int) ($product['review_count'] ?? 0);
                    if ($reviewCount > 0):
                        echo \App\Models\Review::getStarRating($ratingAvg);
                    ?>
                        <span class="rating-count">(<?= $reviewCount ?>)</span>
                    <?php else: ?>
                        <span class="no-rating text-muted small">No reviews yet</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="price-wrapper">
                <?php if ($hasSale): ?>
                    <span class="price-original"><?= money($product['price']) ?></span>
                    <span class="price-sale"><?= money($product['sale_price']) ?></span>
                <?php else: ?>
                    <span class="price-regular"><?= money($product['price']) ?></span>
                <?php endif; ?>
            </div>

            <div class="card-footer-actions">
                <button class="btn btn-premium-add btn-add-cart" data-product-id="<?= $product['id'] ?>">
                    <span class="btn-text">Add to Cart</span>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</article>
