<?php
/**
 * Reusable Virtual Try-On CTA Partial
 */
?>

<section class="virtual-tryon-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <article class="tryon-content">
                    <header>
                        <span class="section-badge">New Feature</span>
                        <h2 class="section-title">Virtual Try-On</h2>
                    </header>
                    <p class="section-text">
                        See how different wigs look on you before you buy! 
                        Upload your photo and try on our collection virtually.
                    </p>
                    <ul class="tryon-features">
                        <li><i class="fas fa-check"></i> Try unlimited styles</li>
                        <li><i class="fas fa-check"></i> See colors that match your skin tone</li>
                        <li><i class="fas fa-check"></i> Share with friends for opinions</li>
                    </ul>
                    <div class="tryon-cta">
                        <a href="/virtual-try-on" class="btn btn-primary btn-lg">
                            <i class="fas fa-camera"></i> Try Now
                        </a>
                    </div>
                </article>
            </div>
            <div class="col-lg-6">
                <figure class="tryon-image">
                    <img src="<?= asset('/img/virtual-tryon.png') ?>" 
                         alt="Luxury Virtual Hair Try-On Demonstration" 
                         loading="lazy"
                         class="img-fluid rounded-4 shadow-lg">
                </figure>
            </div>
        </div>
    </div>
</section>
