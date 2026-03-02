<?php
/**
 * Semantic Hero Component
 * 
 * @var array $slides Array of slide data (image, title, subtitle, button_text, button_link)
 * @var string $id Unique ID for the hero section
 * @var string $class Additional classes
 */

$slides = $slides ?? [];
$id = $id ?? 'mainHero';
$extraClass = $class ?? '';
?>

<section id="<?= $id ?>" class="hero-component <?= $extraClass ?>">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide): ?>
            <div class="swiper-slide hero-slide">
                <div class="hero-bg-wrapper">
                    <img src="<?= asset($slide['image'] ?? '/img/hero-1.png') ?>" alt="<?= htmlspecialchars($slide['title'] ?? '') ?>" class="hero-bg-img">
                    <div class="hero-gradient-overlay"></div>
                </div>
                
                <div class="container h-100">
                    <div class="hero-inner h-100 d-flex align-items-center">
                        <article class="hero-content-clean">
                            <span class="hero-label">Luxurious Quality</span>
                            <h2 class="hero-display-title"><?= htmlspecialchars($slide['title'] ?? '') ?></h2>
                            <p class="hero-description"><?= htmlspecialchars($slide['subtitle'] ?? '') ?></p>
                            
                            <div class="hero-actions mt-4">
                                <a href="<?= $slide['button_link'] ?? '/shop' ?>" class="btn-explore">
                                    <span class="explore-line"></span>
                                    Explore more
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Slide Dots -->
        <div class="hero-pagination swiper-pagination"></div>

        <!-- Scroll Down Anchor -->
        <a href="#featured-products" class="hero-scroll-anchor" aria-label="Scroll to featured products">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
            <i class="fas fa-chevron-down mt-2"></i>
        </a>
    </div>
</section>
