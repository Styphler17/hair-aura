<!-- FAQ Section -->
<section class="faq-hero py-5 bg-light">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Frequently Asked Questions</h1>
        <p class="lead text-muted">Everything you need to know about our premium wigs in Ghana.</p>
    </div>
</section>

<section class="faq-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $index ?>">
                                <?= htmlspecialchars($faq['question']) ?>
                            </button>
                        </h2>
                        <div id="faq<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                <?= htmlspecialchars($faq['answer']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5 p-4 bg-light rounded text-center">
                    <h4 class="fw-bold">Still have questions?</h4>
                    <p class="mb-4">Can't find the answer you're looking for? Reach out to our friendly team in Accra.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="<?= url('/contact') ?>" class="btn btn-primary">Contact Us</a>
                        <a href="https://wa.me/233508007873" target="_blank" class="btn btn-success">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.faq-hero {
    background: linear-gradient(rgba(212, 165, 116, 0.05), rgba(212, 165, 116, 0.1));
}
.accordion-button:not(.collapsed) {
    background-color: rgba(212, 165, 116, 0.1);
    color: var(--primary);
}
.accordion-button:focus {
    box-shadow: none;
    border-color: var(--primary);
}
.accordion-item {
    overflow: hidden;
}
</style>
