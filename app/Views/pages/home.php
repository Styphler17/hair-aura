<!-- Hero Redesign -->
<?php \App\Core\View::partial('hero', [
    'slides' => $siteSettings['hero_slides'] ?? []
]); ?>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="fas fa-shipping-fast"></i>
                    <h4>Free Shipping</h4>
                    <p>On orders over GH₵ 3000</p>
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
            $path = ltrim(str_replace('\\', '/', $path), '/');
            if (str_starts_with($path, 'uploads/') || str_starts_with($path, 'img/')) {
                return asset('/' . $path);
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

                $image = ltrim(str_replace('\\', '/', $image), '/');
                // If it starts with 'uploads/' or 'img/', assumes it's from root
                if (str_starts_with($image, 'uploads/') || str_starts_with($image, 'img/')) {
                    return asset('/' . $image);
                }

                // Otherwise, treat as relative to categories folder
                return asset('/uploads/categories/' . $image);
            }

            if ($slug !== '') {
                return asset('/img/categories/' . $slug . '.webp');
            }

            return asset('/img/product-placeholder.webp');
        };
        ?>

        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
                <?php 
                    // Render the reusable category card partial
                    \App\Core\View::partial('category_card', [
                        'category' => $category, 
                        'resolveCategoryImage' => $resolveCategoryImage
                    ]); 
                ?>
            <?php endforeach; ?>
        </div> <!-- end row -->
        <div class="text-center mt-5">
            <a href="/shop" class="btn btn-outline-primary btn-lg">View All Categories</a>
        </div>
    </div> <!-- end container -->
</section>

<!-- Featured Products -->
<section id="featured-products" class="products-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Handpicked for you</p>
        </div>
        
        <div class="row">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <?php \App\Core\View::partial('product_card', ['product' => $product, 'resolveProductImage' => $resolveProductImage]); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <?php \App\Core\View::partial('button', [
                'text' => 'View All Products',
                'url' => '/shop',
                'type' => 'outline-primary',
                'size' => 'lg'
            ]); ?>
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
                    <?php \App\Core\View::partial('button', [
                        'text' => 'View All Bestsellers',
                        'url' => '/shop?sort=rating',
                        'type' => 'primary',
                        'class' => 'mt-3'
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="swiper bestseller-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($bestsellers as $product): ?>
                        <div class="swiper-slide">
                            <?php \App\Core\View::partial('product_card', ['product' => $product, 'resolveProductImage' => $resolveProductImage]); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
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
                    <?php \App\Core\View::partial('button', [
                        'text' => 'View All FAQs',
                        'url' => '/faq',
                        'type' => 'outline-primary',
                        'class' => 'mt-3'
                    ]); ?>
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
                    <?php \App\Core\View::partial('button', [
                        'text' => 'Shop Now',
                        'url' => '/shop',
                        'type' => 'outline-light',
                        'size' => 'lg'
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>
