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
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control" value="<?= htmlspecialchars((string) $stateValue) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" value="<?= htmlspecialchars((string) $countryValue) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars((string) $postalValue) ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="momo" <?= $paymentValue === 'momo' ? 'selected' : '' ?>>Mobile Money (MoMo) - Recommended</option>
                            <option value="cash" <?= $paymentValue === 'cash' ? 'selected' : '' ?>>Cash on Delivery</option>
                            <option value="stripe" <?= $paymentValue === 'stripe' ? 'selected' : '' ?>>Card (Stripe)</option>
                            <option value="paypal" <?= $paymentValue === 'paypal' ? 'selected' : '' ?>>PayPal</option>
                        </select>
                        <small class="text-muted d-block mt-2">
                            Primary MoMo line: +233508007873
                        </small>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5>Order Summary</h5>
                        <?php if (!empty($cartItems)): ?>
                            <ul class="list-group list-group-flush mb-3">
                                <?php foreach ($cartItems as $item): ?>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span><?= htmlspecialchars((string) ($item['name'] ?? 'Product')) ?> x <?= (int) ($item['quantity'] ?? 1) ?></span>
                                    <strong><?= money((float) ($item['subtotal'] ?? 0)) ?></strong>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <p class="mb-1">Subtotal: <?= money((float) ($summary['subtotal'] ?? 0)) ?></p>
                        <p class="mb-1">Shipping: <?= money((float) ($summary['shipping'] ?? 0)) ?></p>
                        <p class="mb-3">Tax: <?= money((float) ($summary['tax'] ?? 0)) ?></p>
                        <h5>Total: <?= money((float) ($summary['total'] ?? 0)) ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
