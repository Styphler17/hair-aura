<?php
$site = (array) ($siteSettings ?? []);
$supportPhone = (string) ($site['phone'] ?? '+233508007873');
$supportWhatsapp = (string) ($site['whatsapp'] ?? '+233508007873');
$supportEmail = (string) ($site['email'] ?? 'support@example.com');
$supportLocation = (string) ($site['location'] ?? 'Accra, Ghana');
$supportWhatsappDigits = preg_replace('/\D+/', '', $supportWhatsapp);
?>
<footer class="site-footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Branding & About -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-4">
                    <img src="<?= asset($site['logo'] ?? '/img/logo.webp') ?>" alt="<?= htmlspecialchars($site['name'] ?? 'Hair Aura') ?>" class="footer-logo mb-3" style="max-height: 50px;">
                    <p class="footer-description text-muted small mb-3">
                        Hair Aura is Ghana's premier destination for luxury human hair wigs and extensions. Based in the heart of Accra, we specialize in 100% authentic Vietnamese and Cambodian hair. Our mission is to provide every woman with the confidence she deserves through premium, long-lasting hair units tailored for the modern African woman.
                    </p>
                    <p class="footer-tagline fw-bold" style="color: var(--primary); font-size: 0.85rem;">Unlock Your Aura with Perfect Wigs.</p>
                </div>
                <div class="social-links d-flex gap-3">
                    <?php 
                    $socialLinks = $site['social'] ?? [];
                    $platforms = [
                        'instagram' => ['icon' => 'fab fa-instagram', 'title' => 'Instagram'],
                        'facebook' => ['icon' => 'fab fa-facebook-f', 'title' => 'Facebook'],
                        'whatsapp' => ['icon' => 'fab fa-whatsapp', 'title' => 'WhatsApp'],
                        'tiktok' => ['icon' => 'fab fa-tiktok', 'title' => 'TikTok'],
                        'twitter' => ['icon' => 'fab fa-x-twitter', 'title' => 'Twitter'],
                        'youtube' => ['icon' => 'fab fa-youtube', 'title' => 'YouTube'],
                    ];

                    foreach ($platforms as $key => $p):
                        $link = $socialLinks[$key] ?? null;
                        if (!$link || empty($link['enabled']) || empty($link['url'])) continue;
                        
                        $href = $link['url'];
                        if ($key === 'whatsapp') {
                            $digits = preg_replace('/\D+/', '', $href);
                            $href = "https://wa.me/" . $digits;
                        }
                    ?>
                        <a href="<?= htmlspecialchars($href) ?>" target="_blank" rel="noopener" class="social-link" title="<?= $p['title'] ?>">
                            <i class="<?= $p['icon'] ?>"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="footer-title text-uppercase mb-4">Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= url('/') ?>" class="footer-link">Home</a></li>
                    <li><a href="<?= url('/shop') ?>" class="footer-link">Shop All</a></li>
                    <li><a href="<?= url('/blog') ?>" class="footer-link">Blog</a></li>
                    <li><a href="<?= url('/about') ?>" class="footer-link">About Us</a></li>
                    <li><a href="<?= url('/faq') ?>" class="footer-link">FAQ</a></li>
                </ul>
            </div>

            <!-- Shop Categories -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="footer-title text-uppercase mb-4">Categories</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= url('/shop/human-hair-wigs') ?>" class="footer-link">Human Hair Wigs</a></li>
                    <li><a href="<?= url('/shop/lace-front-wigs') ?>" class="footer-link">Lace Front Wigs</a></li>
                    <li><a href="<?= url('/shop/synthetic-wigs') ?>" class="footer-link">Synthetic Wigs</a></li>
                    <li><a href="<?= url('/shop/hair-extensions') ?>" class="footer-link">Hair Extensions</a></li>
                    <li><a href="<?= url('/shop/hair-accessories') ?>" class="footer-link">Accessories</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title text-uppercase mb-4">Contact Us</h5>
                <ul class="list-unstyled contact-info">
                    <li class="mb-3 d-flex gap-3 align-items-start">
                        <i class="fas fa-location-dot mt-1 theme-icon"></i>
                        <span><?= htmlspecialchars($supportLocation) ?></span>
                    </li>
                    <li class="mb-3 d-flex gap-3 align-items-center">
                        <i class="fas fa-phone theme-icon"></i>
                        <a href="tel:<?= htmlspecialchars($supportPhone) ?>" class="footer-link"><?= htmlspecialchars($supportPhone) ?></a>
                    </li>
                    <li class="mb-3 d-flex gap-3 align-items-center">
                        <i class="fab fa-whatsapp theme-icon"></i>
                        <a href="https://wa.me/<?= htmlspecialchars($supportWhatsappDigits) ?>" target="_blank" rel="noopener" class="footer-link">WhatsApp Chat</a>
                    </li>
                    <li class="mb-3 d-flex gap-3 align-items-center">
                        <i class="fas fa-envelope theme-icon"></i>
                        <a href="mailto:<?= htmlspecialchars($supportEmail) ?>" class="footer-link"><?= htmlspecialchars($supportEmail) ?></a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="footer-divider border-secondary mb-4">

        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <p class="copyright mb-0 text-muted">&copy; <?= date('Y') ?> <strong>Hair Aura</strong>. All Rights Reserved. Designed by <a href="https://debesties.com" target="_blank" class="text-white text-decoration-none">Debesties</a></p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="payment-methods d-flex gap-3 justify-content-md-end align-items-center">
                    <span class="momo-badge bg-white text-dark rounded px-2 py-0 border fw-bold small" title="Mobile Money">MoMo Only</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.site-footer {
    font-family: 'Poppins', sans-serif;
    color: #f8f9fa;
}
.footer-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 1px;
}
.footer-link {
    color: #adb5bd;
    text-decoration: none;
    transition: color 0.3s ease, padding-left 0.3s ease;
}
.footer-link:hover {
    color: var(--primary, #D4A574);
    padding-left: 5px;
}
.social-link {
    width: 35px;
    height: 35px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
    text-decoration: none;
}
.social-link:hover {
    background: var(--primary, #D4A574);
    color: white;
    transform: translateY(-3px);
}
.footer-divider {
    opacity: 0.2;
}
.payment-methods i {
    opacity: 0.7;
    transition: opacity 0.3s;
}
.payment-methods i:hover {
    opacity: 1;
}
.momo-badge {
    height: 20px;
    display: inline-flex;
    align-items: center;
    font-size: 0.7rem;
}
.contact-info .fas, .contact-info .fab {
    font-size: 1.1rem;
}
.theme-icon {
    color: var(--primary, #D4A574) !important;
}
.footer-description {
    line-height: 1.6;
    color: #adb5bd !important;
}
</style>
