<?php
/**
 * Reusable Product Card Partial
 * 
 * @var array $product The product data
 * @var callable $resolveProductImage Function to resolve product image path
 */

$productUrl = "/product/" . htmlspecialchars($product['slug']);
$productName = htmlspecialchars($product['name']);
$imageSrc = $resolveProductImage($product['primary_image'] ?? '');
$placeholder = asset('/img/product-placeholder.webp');
$categoryName = htmlspecialchars($product['category_name'] ?? 'Wigs');

// Calculate sale discount if applicable
$hasSale = !empty($product['sale_price']) && $product['sale_price'] < $product['price'];
$discount = $hasSale ? round((($product['price'] - $product['sale_price']) / $product['price']) * 100) : 0;
?>

<article class="product-card" data-product-id="<?= $product['id'] ?>">
    <figure class="product-image">
        <a href="<?= $productUrl ?>" aria-label="View <?= $productName ?>">
            <img src="<?= $imageSrc ?>" 
                 alt="<?= $productName ?>" 
                 loading="lazy"
                 onerror="this.onerror=null;this.src='<?= $placeholder ?>';">
        </a>
        
        <?php if ($hasSale): ?>
            <span class="product-badge sale">-<?= $discount ?>%</span>
        <?php elseif (!empty($product['new_arrival'])): ?>
            <span class="product-badge new">New</span>
        <?php endif; ?>
        
        <div class="product-actions">
            <button class="btn btn-wishlist <?= ($product['in_wishlist'] ?? false) ? 'active' : '' ?>" 
                    data-product-id="<?= $product['id'] ?>" 
                    aria-label="Add to wishlist">
                <i class="<?= ($product['in_wishlist'] ?? false) ? 'fas' : 'far' ?> fa-heart"></i>
            </button>
            <button class="btn btn-quickview" 
                    data-product-id="<?= $product['id'] ?>" 
                    aria-label="Quick view">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </figure>
    
    <div class="product-info">
        <header>
            <span class="product-category"><?= $categoryName ?></span>
            <h3 class="product-title">
                <a href="<?= $productUrl ?>"><?= $productName ?></a>
            </h3>
        </header>
        
        <?php if (isset($product['rating_avg'])): ?>
        <div class="product-rating" aria-label="Rating: <?= $product['rating_avg'] ?> out of 5">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="fas fa-star<?= $i > $product['rating_avg'] ? '-empty' : '' ?>" aria-hidden="true"></i>
            <?php endfor; ?>
            <span>(<?= $product['review_count'] ?? 0 ?>)</span>
        </div>
        <?php endif; ?>
        
        <div class="product-price">
            <?php if ($hasSale): ?>
                <span class="old-price"><?= money($product['price']) ?></span>
                <span class="current-price"><?= money($product['sale_price']) ?></span>
            <?php else: ?>
                <span class="current-price"><?= money($product['price']) ?></span>
            <?php endif; ?>
        </div>
        
        <footer class="product-card-footer">
            <button class="btn btn-primary btn-add-cart" data-product-id="<?= $product['id'] ?>">
                <i class="fas fa-shopping-bag"></i> Add to Cart
            </button>
        </footer>
    </div>
</article>
