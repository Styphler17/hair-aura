<?php
$address = $defaultAddress ?? [];
$old = $_SESSION['old_input'] ?? [];
$firstNameValue = $old['first_name'] ?? ($address['first_name'] ?? ($user->first_name ?? ''));
$lastNameValue = $old['last_name'] ?? ($address['last_name'] ?? ($user->last_name ?? ''));
$emailValue = $old['email'] ?? ($user->email ?? '');
$phoneValue = $old['phone'] ?? ($address['phone'] ?? ($user->phone ?? ''));
$addressValue = $old['address'] ?? ($address['address_line1'] ?? '');
$cityValue = $old['city'] ?? ($address['city'] ?? '');
$stateValue = $old['state'] ?? ($address['state'] ?? '');
$countryValue = $old['country'] ?? ($address['country'] ?? 'Ghana');
$postalValue = $old['postal_code'] ?? ($address['postal_code'] ?? '');
$paymentValue = $old['payment_method'] ?? 'momo';
unset($_SESSION['old_input']);
?>

<section class="py-5">
    <div class="container">
        <h1 class="mb-4">Checkout</h1>
        <div class="row g-4">
            <div class="col-lg-7">
                <form method="post" action="<?= url('/checkout') ?>" class="row g-3">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars((string) $firstNameValue) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars((string) $lastNameValue) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars((string) $emailValue) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars((string) $phoneValue) ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?= htmlspecialchars((string) $addressValue) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars((string) $cityValue) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Region (Ghana)</label>
                        <select name="state" class="form-select" required>
                            <option value="">Select Region</option>
                            <?php 
                            $regions = [
                                'Ahafo', 'Ashanti', 'Bono', 'Bono East', 'Central', 'Eastern', 
                                'Greater Accra', 'North East', 'Northern', 'Oti', 'Savannah', 
                                'Upper East', 'Upper West', 'Volta', 'Western', 'Western North'
                            ];
                            foreach ($regions as $region): ?>
                                <option value="<?= $region ?>" <?= $stateValue === $region ? 'selected' : '' ?>><?= $region ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" value="<?= htmlspecialchars((string) $countryValue) ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Postal Code / Digital Address</label>
                        <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars((string) $postalValue) ?>" placeholder="e.g. GA-123-4567">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Payment Method</label>
                        <div class="payment-methods-grid">
                            <div class="form-check payment-option">
                                <input class="form-check-input" type="radio" name="payment_method" id="payMomo" value="momo" <?= $paymentValue === 'momo' ? 'selected' : '' ?>>
                                <label class="form-check-label w-100" for="payMomo">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Mobile Money (MoMo)</span>
                                        <span class="momo-badge">MTN/Vodafone/AirtelTigo</span>
                                    </div>
                                    <small class="text-muted d-block mt-1">Pay via your mobile wallet. <strong>Line: +233508007873</strong></small>
                                </label>
                            </div>
                            <div class="form-check payment-option mt-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="payCash" value="cash" <?= $paymentValue === 'cash' ? 'selected' : '' ?>>
                                <label class="form-check-label w-100" for="payCash">
                                    <span>Cash on Delivery</span>
                                    <small class="text-muted d-block mt-1">Pay when you receive your order.</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                            <i class="fas fa-check-circle me-2"></i> Confirm & Place Order
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Order Summary</h4>
                        <?php if (!empty($cartItems)): ?>
                            <div class="checkout-items mb-4">
                                <?php foreach ($cartItems as $item): ?>
                                <div class="checkout-summary-item">
                                    <img src="<?= !empty($item['image']) ? $item['image'] : asset('/img/product-placeholder.webp') ?>" 
                                         alt="<?= htmlspecialchars((string) $item['name']) ?>" 
                                         class="item-img"
                                         onerror="this.src='<?= asset('/img/product-placeholder.webp') ?>'">
                                    <div class="item-info">
                                        <span class="item-name"><?= htmlspecialchars((string) ($item['name'] ?? 'Product')) ?></span>
                                        <div class="item-meta">
                                            Qty: <?= (int) ($item['quantity'] ?? 1) ?>
                                            <?php if (!empty($item['variant_name'])): ?>
                                                • <?= htmlspecialchars($item['variant_name']) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item-price text-end">
                                        <?= money((float) ($item['subtotal'] ?? 0)) ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="summary-totals">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span><?= money((float) ($summary['subtotal'] ?? 0)) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping</span>
                                <span><?= $summary['shipping'] > 0 ? money((float) $summary['shipping']) : '<span class="text-success">Free</span>' ?></span>
                            </div>
                            <?php if (($summary['tax'] ?? 0) > 0): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tax</span>
                                <span><?= money((float) $summary['tax']) ?></span>
                            </div>
                            <?php endif; ?>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <h4 class="mb-0">Total</h4>
                                <h4 class="mb-0 text-primary"><?= money((float) ($summary['total'] ?? 0)) ?></h4>
                            </div>
                        </div>

                        <div class="bg-light p-3 rounded mt-4">
                            <small class="text-muted"><i class="fas fa-shield-alt me-1"></i> Your personal data will be used to process your order and support your experience throughout this website.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
