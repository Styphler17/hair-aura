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
                <ul class="list-unstyled">
                    <li class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($contactEmail) ?></li>
                    <li class="mb-2"><strong>Phone:</strong> <a href="tel:<?= htmlspecialchars($contactPhone) ?>"><?= htmlspecialchars($contactPhone) ?></a></li>
                    <li class="mb-2"><strong>WhatsApp:</strong> <a href="https://wa.me/<?= htmlspecialchars($waDigits) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($contactWhatsapp) ?></a></li>
                    <li class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($contactLocation) ?></li>
                    <?php if ($contactHours !== ''): ?>
                        <li class="mb-2"><strong>Business Hours:</strong> <?= htmlspecialchars($contactHours) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="post" action="<?= url('/contact') ?>">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="5" required></textarea>
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
</style>
<?php endif; ?>
