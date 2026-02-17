<!-- Hero Section -->
<section class="hero-section">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <?php foreach (($siteSettings['hero_slides'] ?? []) as $slide): ?>
            <div class="swiper-slide hero-slide" style="background-image: url('<?= asset($slide['image'] ?? '/img/hero-1.webp') ?>');">
                <div class="hero-overlay"></div>
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title"><?= htmlspecialchars($slide['title'] ?? '') ?></h1>
                        <p class="hero-text"><?= htmlspecialchars($slide['subtitle'] ?? '') ?></p>
                        <div class="hero-buttons">
                            <a href="<?= $slide['button_link'] ?? '/shop' ?>" class="btn btn-primary btn-lg"><?= htmlspecialchars($slide['button_text'] ?? 'Shop Now') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <div class="swiper-pagination hero-pagination"></div>
        
        <!-- Navigation -->
        <div class="swiper-button-prev hero-prev"></div>
        <div class="swiper-button-next hero-next"></div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="fas fa-shipping-fast"></i>
                    <h4>Free Shipping</h4>
                    <p>On orders over GH₵1200</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="fas fa-undo"></i>
                    <h4>Order Support</h4>
                    <p>No returns. Fast support help.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Secure Payment</h4>
                    <p>100% secure checkout</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="fas fa-headset"></i>
                    <h4>24/7 Support</h4>
                    <p>Dedicated support team</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section py-5">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Shop by Category</h2>
            <p class="section-subtitle">Find your perfect style</p>
        </div>
        
        <?php
        $resolveProductImage = function($path) {
            if (!$path) return asset('/img/product-placeholder.webp');
            if (str_starts_with($path, 'uploads/') || str_starts_with($path, 'img/')) {
                return asset('/' . ltrim($path, '/'));
            }
            return asset('/uploads/products/' . $path);
        };
        ?>
        <?php
        $resolveCategoryImage = static function (array $category): string {
            $image = trim((string) ($category['image'] ?? ''));
            $slug = trim((string) ($category['slug'] ?? ''));

            if ($image !== '') {
                if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                    return $image;
                }

                // If it starts with 'uploads/' or 'img/', assumes it's from root
                if (str_starts_with($image, 'uploads/') || str_starts_with($image, 'img/')) {
                    return asset('/' . ltrim($image, '/'));
                }

                // Otherwise, treat as relative to categories folder (even if it has ..)
                return asset('/uploads/categories/' . $image);
            }

            if ($slug !== '') {
                return asset('/img/categories/' . $slug . '.webp');
            }

            return asset('/img/product-placeholder.webp');
        };
        ?>

        <div class="row">
            <?php foreach ($categories as $category): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="/shop/<?= htmlspecialchars($category['slug']) ?>" class="category-card">
                    <div class="category-image">
                        <img src="<?= htmlspecialchars($resolveCategoryImage((array) $category)) ?>" 
                             alt="<?= htmlspecialchars($category['name']) ?>" 
                             loading="lazy"
                             onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="category-content">
                        <h3><?= htmlspecialchars($category['name']) ?></h3>
                        <p><?= htmlspecialchars($category['description'] ?? 'Shop Now') ?></p>
                        <span class="btn btn-outline-light">Explore</span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="products-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Handpicked for you</p>
        </div>
        
        <div class="row">
            <?php foreach ($featuredProducts as $product): ?>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-card" data-product-id="<?= $product['id'] ?>">
                    <div class="product-image">
                        <a href="/product/<?= htmlspecialchars($product['slug']) ?>">
                            <img src="<?= $resolveProductImage($product['primary_image'] ?? '') ?>" 
                                 alt="<?= htmlspecialchars($product['name']) ?>" 
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                        </a>
                        
                        <?php if ($product['sale_price'] && $product['sale_price'] < $product['price']): ?>
                        <span class="product-badge sale">-<?= round((($product['price'] - $product['sale_price']) / $product['price']) * 100) ?>%</span>
                        <?php elseif ($product['new_arrival']): ?>
                        <span class="product-badge new">New</span>
                        <?php endif; ?>
                        
                        <div class="product-actions">
                            <button class="btn btn-wishlist <?= ($product['in_wishlist'] ?? false) ? 'active' : '' ?>" data-product-id="<?= $product['id'] ?>">
                                <i class="<?= ($product['in_wishlist'] ?? false) ? 'fas' : 'far' ?> fa-heart"></i>
                            </button>
                            <button class="btn btn-quickview" data-product-id="<?= $product['id'] ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <span class="product-category"><?= htmlspecialchars($product['category_name'] ?? 'Wigs') ?></span>
                        <h3 class="product-title">
                            <a href="/product/<?= htmlspecialchars($product['slug']) ?>">
                                <?= htmlspecialchars($product['name']) ?>
                            </a>
                        </h3>
                        <div class="product-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?= $i > ($product['rating_avg'] ?? 0) ? '-empty' : '' ?>"></i>
                            <?php endfor; ?>
                            <span>(<?= $product['review_count'] ?? 0 ?>)</span>
                        </div>
                        <div class="product-price">
                            <?php if ($product['sale_price'] && $product['sale_price'] < $product['price']): ?>
                                <span class="old-price"><?= money($product['price']) ?></span>
                                <span class="current-price"><?= money($product['sale_price']) ?></span>
                            <?php else: ?>
                                <span class="current-price"><?= money($product['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <button class="btn btn-primary btn-add-cart" data-product-id="<?= $product['id'] ?>">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/shop" class="btn btn-outline-primary btn-lg">View All Products</a>
        </div>
    </div>
</section>

<!-- Bestsellers Section -->
<section class="bestsellers-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="section-header">
                    <h2 class="section-title">Bestsellers</h2>
                    <p class="section-subtitle">Our most popular wigs loved by customers</p>
                    <a href="/shop?sort=rating" class="btn btn-primary mt-3">View All Bestsellers</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="swiper bestseller-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($bestsellers as $product): ?>
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="/product/<?= htmlspecialchars($product['slug']) ?>">
                                        <img src="<?= $resolveProductImage($product['primary_image'] ?? '') ?>" 
                                             alt="<?= htmlspecialchars($product['name']) ?>" 
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp') ?>';">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="/product/<?= htmlspecialchars($product['slug']) ?>">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h3>
                                    <div class="product-price">
                                        <span class="current-price"><?= money($product['sale_price'] ?: $product['price']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Virtual Try-On CTA -->
<section class="virtual-tryon-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="tryon-content">
                    <span class="section-badge">New Feature</span>
                    <h2 class="section-title">Virtual Try-On</h2>
                    <p class="section-text">
                        See how different wigs look on you before you buy! 
                        Upload your photo and try on our collection virtually.
                    </p>
                    <ul class="tryon-features">
                        <li><i class="fas fa-check"></i> Try unlimited styles</li>
                        <li><i class="fas fa-check"></i> See colors that match your skin tone</li>
                        <li><i class="fas fa-check"></i> Share with friends for opinions</li>
                    </ul>
                    <a href="/virtual-try-on" class="btn btn-primary btn-lg">
                        <i class="fas fa-camera"></i> Try Now
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tryon-image">
                    <img src="<?= asset($siteSettings['virtual_tryon_image'] ?? '/img/product-placeholder.webp') ?>" alt="Virtual Try-On" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Real reviews from real customers</p>
        </div>
        
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?= $i > $testimonial['rating'] ? '-empty' : '' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text">"<?= htmlspecialchars($testimonial['content']) ?>"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <?= strtoupper(substr($testimonial['customer_name'], 0, 1)) ?>
                            </div>
                            <div class="author-info">
                                <h4><?= htmlspecialchars($testimonial['customer_name']) ?></h4>
                                <span><?= htmlspecialchars($testimonial['customer_location'] ?? 'Ghana') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<?php if (!empty($faqs)): ?>
<section class="home-faq-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-header">
                    <h2 class="section-title">Common Questions</h2>
                    <p class="section-subtitle">Everything you need to know about our premium wigs in Ghana.</p>
                    <a href="<?= url('/faq') ?>" class="btn btn-outline-primary mt-3">View All FAQs</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="homeFaqAccordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#homeFaq<?= $index ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                            </button>
                        </h2>
                        <div id="homeFaq<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                            <div class="accordion-body text-muted">
                                <?= htmlspecialchars($faq['answer']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.home-faq-section {
    background: #fff;
}
.home-faq-section .accordion-button:not(.collapsed) {
    background-color: rgba(212, 165, 116, 0.05);
    color: var(--primary);
}
.home-faq-section .accordion-button:focus {
    box-shadow: none;
}
.home-faq-section .accordion-item {
    border: 1px solid #eee !important;
}
</style>
<?php endif; ?>

<?php 
$instagramImages = (array) ($siteSettings['instagram_images'] ?? []);
if (empty($instagramImages)) {
    // Fallback to local files if settings is empty
    $instagramDir = __DIR__ . '/../../../public/img/instagram';
    if (is_dir($instagramDir)) {
        $matches = glob($instagramDir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
        if (is_array($matches)) {
            sort($matches);
            $instagramImages = array_map(fn($f) => '/img/instagram/' . basename($f), array_slice($matches, 0, 6));
        }
    }
}
?>
<?php if (!empty($instagramImages)): ?>
<!-- Instagram Feed -->
<section class="instagram-section py-5">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Follow Us on Instagram</h2>
            <p class="section-subtitle">@hairaura</p>
        </div>
        
        <div class="row g-2">
            <?php foreach ($instagramImages as $img): ?>
                <div class="col-4 col-md-2">
                    <a href="https://instagram.com/hairaura" target="_blank" rel="noopener" class="instagram-item">
                        <img src="<?= asset($img) ?>" alt="Instagram" loading="lazy">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="cta-box">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2>Ready to Transform Your Look?</h2>
                    <p>Join thousands of satisfied customers and find your perfect wig today!</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="/shop" class="btn btn-light btn-lg">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
