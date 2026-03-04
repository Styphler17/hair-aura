<?php
/**
 * Reusable Category Card Partial
 * 
 * @var array $category The category data (id, name, slug, description, image, bg_color)
 * @var callable $resolveCategoryImage Function to resolve category image path
 * @var string $assetHelper Helper to generate asset URLs
 */

$imageName = $category['image'] ?? '';
$imagePathForColor = str_starts_with($imageName, 'uploads/') ? $imageName : 'uploads/categories/' . $imageName;
$bgColor = \App\Core\ImageManager::getDominantColor($imagePathForColor, '#FDFBFA');
$categoryUrl = url("/shop/" . $category['slug']);
$categoryName = htmlspecialchars($category['name']);
$categoryDesc = htmlspecialchars($category['description'] ?? 'Shop Now');
$imageSrc = htmlspecialchars($resolveCategoryImage((array) $category));
$placeholder = asset('/img/product-placeholder.webp');
?>

<article class="col-lg-6 col-md-6 mb-4">
    <div class="category-card-new">
        <a href="<?= $categoryUrl ?>" class="category-card-link" aria-label="Shop <?= $categoryName ?>">
            <div class="category-card-inner">
                <div class="category-card-info">
                    <div class="category-card-text">
                        <h3 class="category-card-title"><?= $categoryName ?></h3>
                        <p class="category-card-subtitle"><?= $categoryDesc ?></p>
                    </div>
                    <div class="category-card-action">
                        <span class="shop-now-text">Shop Now</span>
                        <div class="arrow-circle">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <figure class="category-card-media" style="--card-bg: <?= $bgColor ?>; background-color: var(--card-bg);">
                    <img src="<?= $imageSrc ?>" 
                         alt="<?= $categoryName ?>" 
                         loading="lazy"
                         onerror="this.onerror=null;this.src='<?= $placeholder ?>';">
                </figure>
            </div>
        </a>
    </div>
</article>
