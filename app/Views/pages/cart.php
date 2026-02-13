<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Shopping Cart</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Cart Section -->
<section class="cart-section py-5">
    <div class="container">
        <?php if (!empty($stockErrors)): ?>
        <div class="alert alert-warning">
            <h5><i class="fas fa-exclamation-triangle"></i> Stock Issues</h5>
            <ul class="mb-0">
                <?php foreach ($stockErrors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <?php if (empty($cartItems)): ?>
        <!-- Empty Cart -->
        <div class="empty-cart text-center py-5">
            <i class="fas fa-shopping-bag fa-5x text-muted mb-4"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
            <a href="/shop" class="btn btn-primary btn-lg mt-3">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>
        <?php else: ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-items">
                    <div class="cart-header">
                        <div class="row">
                            <div class="col-6">Product</div>
                            <div class="col-2 text-center">Price</div>
                            <div class="col-2 text-center">Quantity</div>
                            <div class="col-2 text-end">Total</div>
                        </div>
                    </div>
                    
                    <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item" data-product-id="<?= $item['product_id'] ?>" data-variant-id="<?= $item['variant_id'] ?? '' ?>">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="product-info">
                                    <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-image">
                                    <div class="product-details">
                                        <h4><a href="/product/<?= $item['product']->slug ?>"><?= htmlspecialchars($item['name']) ?></a></h4>
                                        <?php if ($item['variant_id']): ?>
                                        <span class="variant">Variant: <?= htmlspecialchars($item['variant_name'] ?? '') ?></span>
                                        <?php endif; ?>
                                        <button class="btn btn-remove" onclick="removeFromCart(<?= $item['product_id'] ?>, <?= $item['variant_id'] ?? 'null' ?>)">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <span class="price"><?= money($item['price']) ?></span>
                            </div>
                            <div class="col-2 text-center">
                                <div class="quantity-selector">
                                    <button type="button" class="btn btn-minus" onclick="updateQuantity(<?= $item['product_id'] ?>, <?= ($item['quantity'] - 1) ?>, <?= $item['variant_id'] ?? 'null' ?>)">-</button>
                                    <input type="number" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock'] ?>" class="form-control" readonly>
                                    <button type="button" class="btn btn-plus" onclick="updateQuantity(<?= $item['product_id'] ?>, <?= ($item['quantity'] + 1) ?>, <?= $item['variant_id'] ?? 'null' ?>)">+</button>
                                </div>
                            </div>
                            <div class="col-2 text-end">
                                <span class="subtotal"><?= money($item['subtotal']) ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="cart-actions mt-4">
                    <a href="/shop" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                    <form action="/cart/clear" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to clear your cart?')">
                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    
                    <!-- Coupon -->
                    <div class="coupon-section">
                        <form id="couponForm" class="input-group">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                            <input type="text" name="code" class="form-control" placeholder="Enter coupon code">
                            <button type="submit" class="btn btn-outline-primary">Apply</button>
                        </form>
                        <div id="couponMessage"></div>
                    </div>
                    
                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="cartSubtotal"><?= money($summary['subtotal']) ?></span>
                        </div>
                        
                        <?php if (isset($_SESSION['applied_coupon'])): ?>
                        <div class="summary-row discount">
                            <span>Discount (<?= $_SESSION['applied_coupon']['code'] ?>)</span>
                            <span>-<?= money($_SESSION['applied_coupon']['discount']) ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span id="cartShipping">
                                <?php if ($summary['shipping'] == 0): ?>
                                <span class="text-success">Free</span>
                                <?php else: ?>
                                <?= money($summary['shipping']) ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <?php if ($summary['tax'] > 0): ?>
                        <div class="summary-row">
                            <span>Tax</span>
                            <span><?= money($summary['tax']) ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="cartTotal"><?= money($summary['total']) ?></span>
                        </div>
                    </div>
                    
                    <a href="/checkout" class="btn btn-primary btn-lg btn-checkout">
                        Proceed to Checkout <i class="fas fa-arrow-right"></i>
                    </a>
                    
                    <div class="payment-info">
                        <p><i class="fas fa-lock"></i> Secure checkout</p>
                        <div class="payment-icons">
                            <span class="momo-badge" title="Mobile Money">MoMo</span>
                            <i class="fab fa-cc-visa" title="Visa"></i>
                            <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                            <i class="fab fa-cc-paypal" title="PayPal"></i>
                            <i class="fab fa-cc-amex" title="American Express"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Need Help -->
                <div class="need-help mt-4">
                    <h5>Need Help?</h5>
                    <p><i class="fas fa-phone"></i> <a href="tel:+233508007873">+233508007873</a></p>
                    <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/233508007873" target="_blank" rel="noopener">WhatsApp us</a></p>
                    <p><i class="fas fa-envelope"></i> support@hair-aura.debesties.com</p>
                    <a href="/faq" class="btn btn-outline-secondary btn-sm">View FAQ</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
function updateQuantity(productId, quantity, variantId) {
    if (quantity < 1) return;
    
    const formData = new FormData();
    formData.append('csrf_token', '<?= \App\Core\Auth::csrfToken() ?>');
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    if (variantId) formData.append('variant_id', variantId);
    
    fetch('/cart/update', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    });
}

function removeFromCart(productId, variantId) {
    if (!confirm('Remove this item from cart?')) return;
    
    const formData = new FormData();
    formData.append('csrf_token', '<?= \App\Core\Auth::csrfToken() ?>');
    formData.append('product_id', productId);
    if (variantId) formData.append('variant_id', variantId);
    
    fetch('/cart/remove', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

// Coupon form
document.getElementById('couponForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/cart/coupon', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const msgDiv = document.getElementById('couponMessage');
        if (data.success) {
            msgDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            setTimeout(() => location.reload(), 500);
        } else {
            msgDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    });
});
</script>
