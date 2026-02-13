<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="mb-4">Frequently Asked Questions</h1>
                <?php if (!empty($faqs)): ?>
                    <div class="accordion" id="faqAccordion">
                        <?php foreach ($faqs as $index => $item): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading<?= $index ?>">
                                    <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $index ?>">
                                        <?= htmlspecialchars($item['question']) ?>
                                    </button>
                                </h2>
                                <div id="faqCollapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <?= htmlspecialchars($item['answer']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No FAQs available yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
