<section class="py-5">
    <div class="container">
        <h1 class="mb-4">My Addresses</h1>
        <?php if (!empty($addresses)): ?>
            <div class="row g-3">
                <?php foreach ($addresses as $address): ?>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <p class="mb-1"><?= htmlspecialchars($address['address_line_1'] ?? $address['address'] ?? '') ?></p>
                                <p class="mb-1"><?= htmlspecialchars($address['city'] ?? '') ?><?= !empty($address['state']) ? ', ' . htmlspecialchars($address['state']) : '' ?></p>
                                <p class="mb-0"><?= htmlspecialchars($address['country'] ?? '') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No saved addresses yet.</p>
        <?php endif; ?>
    </div>
</section>
