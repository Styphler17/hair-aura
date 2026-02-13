<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="mb-4"><?= htmlspecialchars($aboutContent['title'] ?? 'About Hair Aura') ?></h1>
                <?php foreach (preg_split('/\R{2,}/', (string) ($aboutContent['content'] ?? '')) as $paragraph): ?>
                    <?php if (trim($paragraph) !== ''): ?>
                        <p class="mb-3"><?= nl2br(htmlspecialchars(trim($paragraph))) ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a class="btn btn-primary" href="<?= url((string) ($aboutContent['button_url'] ?? '/shop')) ?>">
                    <?= htmlspecialchars($aboutContent['button_text'] ?? 'Shop Collection') ?>
                </a>
            </div>
        </div>
    </div>
</section>
