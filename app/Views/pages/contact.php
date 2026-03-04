<section class="py-5">
    <div class="container">
        <?php
        $contactEmail = (string) ($contactInfo['email'] ?? 'support@hair-aura.debesties.com');
        $contactPhone = (string) ($contactInfo['phone'] ?? '+233508007873');
        $contactWhatsapp = (string) ($contactInfo['whatsapp'] ?? '+233508007873');
        $contactLocation = (string) ($contactInfo['location'] ?? 'Accra, Ghana');
        $contactHours = (string) ($contactInfo['business_hours'] ?? '');
        $waDigits = preg_replace('/\D+/', '', $contactWhatsapp);
        ?>
        <div class="row g-4">
            <div class="col-lg-5">
                <h1 class="mb-3">Contact Us</h1>
                <p class="text-muted mb-4">
                    Send us a message and our team will get back to you as soon as possible.
                </p>
                <address class="contact-address-info fs-6">
                    <ul class="list-unstyled contact-info-list">
                        <li class="mb-4 d-flex align-items-start gap-3">
                            <span class="contact-icon-wrap"><i class="fas fa-envelope"></i></span>
                            <div>
                                <strong class="d-block mb-1">Email</strong>
                                <a href="mailto:<?= htmlspecialchars($contactEmail) ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($contactEmail) ?></a>
                            </div>
                        </li>
                        <li class="mb-4 d-flex align-items-start gap-3">
                            <span class="contact-icon-wrap"><i class="fas fa-phone"></i></span>
                            <div>
                                <strong class="d-block mb-1">Phone</strong>
                                <a href="tel:<?= htmlspecialchars($contactPhone) ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($contactPhone) ?></a>
                            </div>
                        </li>
                        <li class="mb-4 d-flex align-items-start gap-3">
                            <span class="contact-icon-wrap"><i class="fab fa-whatsapp"></i></span>
                            <div>
                                <strong class="d-block mb-1">WhatsApp</strong>
                                <a href="https://wa.me/<?= htmlspecialchars($waDigits) ?>" target="_blank" rel="noopener" class="text-decoration-none text-dark"><?= htmlspecialchars($contactWhatsapp) ?></a>
                            </div>
                        </li>
                        <li class="mb-4 d-flex align-items-start gap-3">
                            <span class="contact-icon-wrap"><i class="fas fa-location-dot"></i></span>
                            <div>
                                <strong class="d-block mb-1">Location</strong>
                                <span class="text-dark"><?= htmlspecialchars($contactLocation) ?></span>
                            </div>
                        </li>
                        <?php if ($contactHours !== ''): ?>
                        <li class="mb-4 d-flex align-items-start gap-3">
                            <span class="contact-icon-wrap"><i class="fas fa-clock"></i></span>
                            <div>
                                <strong class="d-block mb-1">Business Hours</strong>
                                <span class="text-dark"><?= htmlspecialchars($contactHours) ?></span>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </address>

            </div>
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="post" action="<?= url('/contact') ?>">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="contact-name" class="form-label">Name</label>
                                    <input type="text" id="contact-name" name="name" class="form-control" required autocomplete="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact-email" class="form-label">Email</label>
                                    <input type="email" id="contact-email" name="email" class="form-control" required autocomplete="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact-phone" class="form-label">Phone</label>
                                    <input type="text" id="contact-phone" name="phone" class="form-control" autocomplete="tel">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact-subject" class="form-label">Subject</label>
                                    <input type="text" id="contact-subject" name="subject" class="form-control" required autocomplete="off">
                                </div>
                                <div class="col-12">
                                    <label for="contact-message" class="form-label">Message</label>
                                    <textarea id="contact-message" name="message" class="form-control" rows="5" required autocomplete="off"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($faqs)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Frequently Asked Questions</h2>
                    <p class="text-muted">Quick answers to common inquiries</p>
                </div>
                
                <div class="accordion accordion-flush" id="contactFaqAccordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq<?= $index ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                            </button>
                        </h2>
                        <div id="contactFaq<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body text-muted">
                                <?= htmlspecialchars($faq['answer']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center mt-4">
                    <a href="<?= url('/faq') ?>" class="btn btn-outline-primary">View All Questions</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
#contactFaqAccordion .accordion-button:not(.collapsed) {
    background-color: rgba(212, 165, 116, 0.05);
    color: var(--primary);
}
#contactFaqAccordion .accordion-button:focus {
    box-shadow: none;
}
#contactFaqAccordion .accordion-item {
    border: 1px solid #eee !important;
    background: #fff;
}

/* ── Contact Icon Badges ─────────────────────────── */
.contact-icon-wrap {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f5e6d0, #edd9b8);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #9a6120;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(212,165,116,0.25);
}
.contact-info-list li strong {
    color: #2c2c2c;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.contact-info-list a:hover {
    color: #D4A574 !important;
}
</style>

<?php endif; ?>
