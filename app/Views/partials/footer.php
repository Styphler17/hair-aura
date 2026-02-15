<!-- Footer -->
<footer class="main-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Brand Column -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-brand">
                        <a href="<?= url('/') ?>" class="footer-logo">
                            <img src="<?= asset('/img/logo.png') ?>" alt="Hair Aura" class="brand-logo-img">
                        </a>
                        <p class="footer-tagline">Unlock Your Aura with Perfect Wigs</p>
                        <p class="footer-about">
                            Ghana's premier destination for premium wigs and hair extensions.
                            We offer the finest human hair, lace fronts, and synthetic wigs
                            to help you express your unique style.
                        </p>
                        <div class="footer-social">
                            <a href="https://instagram.com/hairaura" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://tiktok.com/@hairaura" target="_blank"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="<?= url('/') ?>">Home</a></li>
                        <li><a href="<?= url('/shop') ?>">Shop All</a></li>
                        <li><a href="<?= url('/about') ?>">About Us</a></li>
                        <li><a href="<?= url('/blog') ?>">Blog</a></li>
                        <li><a href="<?= url('/contact') ?>">Contact</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-title">Customer Service</h5>
                    <ul class="footer-links">
                        <li><a href="<?= url('/faq') ?>">FAQ</a></li>
                        <li><a href="<?= url('/shipping') ?>">Shipping Info</a></li>
                        <li><a href="<?= url('/returns') ?>">Order Support Policy</a></li>
                        <li><a href="<?= url('/size-guide') ?>">Size Guide</a></li>
                        <li><a href="<?= url('/care-guide') ?>">Wig Care Guide</a></li>
                        <li><a href="<?= url('/track-order') ?>">Track Order</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-title">Categories</h5>
                    <ul class="footer-links">
                        <li><a href="<?= url('/shop/human-hair-wigs') ?>">Human Hair Wigs</a></li>
                        <li><a href="<?= url('/shop/lace-front-wigs') ?>">Lace Front Wigs</a></li>
                        <li><a href="<?= url('/shop/synthetic-wigs') ?>">Synthetic Wigs</a></li>
                        <li><a href="<?= url('/shop/hair-extensions') ?>">Hair Extensions</a></li>
                        <li><a href="<?= url('/shop/hair-accessories') ?>">Accessories</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Newsletter</h5>
                    <p class="footer-text">Subscribe for exclusive offers and updates!</p>
                    <form class="footer-newsletter" id="newsletterForm">
                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Your email" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    <div id="newsletterMessage"></div>

                    <?php
                    $site = (array) ($siteSettings ?? []);
                    $footerPhone = (string) ($site['phone'] ?? '+233508007873');
                    $footerWhatsapp = (string) ($site['whatsapp'] ?? '+233508007873');
                    $footerEmail = (string) ($site['email'] ?? 'support@example.com');
                    $footerLocation = (string) ($site['location'] ?? 'Accra, Ghana');
                    $footerWhatsappDigits = preg_replace('/\D+/', '', $footerWhatsapp);
                    ?>
                    <div class="footer-contact mt-4">
                        <p><i class="fas fa-phone"></i> <a href="tel:<?= htmlspecialchars($footerPhone) ?>"><?= htmlspecialchars($footerPhone) ?></a></p>
                        <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/<?= htmlspecialchars($footerWhatsappDigits) ?>" target="_blank" rel="noopener">Chat on WhatsApp</a></p>
                        <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($footerEmail) ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($footerLocation) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; <?= date('Y') ?> Hair Aura. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <ul class="footer-bottom-links">
                        <li><a href="<?= url('/privacy') ?>">Privacy Policy</a></li>
                        <li><a href="<?= url('/terms') ?>">Terms of Service</a></li>
                        <li><a href="<?= url('/sitemap.xml') ?>">Sitemap</a></li>
                    </ul>
                    <div class="payment-methods">
                        <span class="momo-badge" title="Mobile Money">MoMo</span>
                        <i class="fab fa-cc-visa" title="Visa"></i>
                        <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                        <i class="fab fa-cc-paypal" title="PayPal"></i>
                        <i class="fab fa-cc-amex" title="American Express"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="quickViewContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Cart Sidebar -->
<div class="offcanvas offcanvas-end" id="cartSidebar" tabindex="-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body" id="cartSidebarContent">
        <!-- Content loaded via AJAX -->
    </div>
</div>
