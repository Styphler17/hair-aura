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
        <?php
        $site = (array) ($siteSettings ?? []);
        $supportPhone = (string) ($site['phone'] ?? '+233508007873');
        $supportWhatsapp = (string) ($site['whatsapp'] ?? '+233508007873');
        $supportEmail = (string) ($site['email'] ?? 'support@example.com');
        $supportWhatsappDigits = preg_replace('/\D+/', '', $supportWhatsapp);
        ?>
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
                    
                    <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item-modern mb-4" data-product-id="<?= $item['product_id'] ?>" data-variant-id="<?= $item['variant_id'] ?? '' ?>">
                        <div class="cart-item-body">
                            <!-- Left: Image & Qty -->
                            <div class="cart-item-left">
                                <div class="cart-image-container">
                                    <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-fluid rounded">
                                </div>
                                <div class="cart-qty-pill-wrapper">
                                    <div class="cart-qty-pill">
                                        <?php if ($item['quantity'] > 1): ?>
                                            <button type="button" class="qty-btn" onclick="updateQuantity(<?= $item['product_id'] ?>, <?= ($item['quantity'] - 1) ?>, <?= $item['variant_id'] ?? 'null' ?>)">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="qty-btn remove-trigger" onclick="removeFromCart(<?= $item['product_id'] ?>, <?= $item['variant_id'] ?? 'null' ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                        <span class="qty-value"><?= $item['quantity'] ?></span>
                                        <button type="button" class="qty-btn" onclick="updateQuantity(<?= $item['product_id'] ?>, <?= ($item['quantity'] + 1) ?>, <?= $item['variant_id'] ?? 'null' ?>)" <?= $item['quantity'] >= $item['stock'] ? 'disabled' : '' ?>>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Middle: Product Info -->
                            <div class="cart-item-center">
                                <h4 class="cart-item-title">
                                    <a href="/product/<?= $item['product']->slug ?>"><?= htmlspecialchars($item['name']) ?></a>
                                </h4>
                                <div class="cart-item-meta">
                                    <div class="cart-item-price fw-bold mb-1">
                                        <?= money($item['price']) ?>
                                    </div>
                                    <p class="mb-1 small text-muted">Ships from <span class="text-dark fw-medium">Hair Aura</span></p>
                                    <p class="mb-1 small text-muted">Sold by <span class="text-dark fw-medium">Hair Aura</span></p>
                                    
                                    <?php if ($item['variant_id']): ?>
                                        <p class="mb-1 small">
                                            <span class="text-muted">Size:</span> 
                                            <span class="fw-medium"><?= htmlspecialchars($item['variant_name'] ?? '') ?></span>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <div class="stock-badge in-stock small mt-2">
                                        <i class="fas fa-check-circle"></i> In Stock
                                    </div>
                                </div>
                                <div class="cart-item-actions d-md-none mt-3">
                                    <button class="btn btn-link btn-sm text-danger p-0 text-decoration-none" onclick="removeFromCart(<?= $item['product_id'] ?>, <?= $item['variant_id'] ?? 'null' ?>)">
                                        <i class="fas fa-trash-alt me-1"></i> Remove
                                    </button>
                                </div>
                            </div>

                            <!-- Right: Total (Desktop) -->
                            <div class="cart-item-right d-none d-md-flex">
                                <div class="text-end">
                                    <span class="d-block small text-muted mb-1">Item Total</span>
                                    <div class="fw-bold fs-5"><?= money($item['subtotal']) ?></div>
                                    <button class="btn btn-link btn-sm text-muted p-0 mt-3 text-decoration-none hover-danger" onclick="removeFromCart(<?= $item['product_id'] ?>, <?= $item['variant_id'] ?? 'null' ?>)">
                                        Remove
                                    </button>
                                </div>
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
                <div class="cart-summary-modern p-4 rounded shadow-sm bg-white">
                    <h3 class="fs-5 fw-bold mb-4">Order Summary</h3>
                    
                    <div class="summary-details">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal (<?= count($cartItems) ?> items)</span>
                            <span class="fw-medium"><?= money($summary['subtotal']) ?></span>
                        </div>
                        
                        <?php if (isset($_SESSION['applied_coupon'])): ?>
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Discount (<?= $_SESSION['applied_coupon']['code'] ?>)</span>
                            <span>-<?= money($_SESSION['applied_coupon']['discount']) ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span class="text-success fw-medium">
                                <?php if ($summary['shipping'] == 0): ?>
                                Free
                                <?php else: ?>
                                <?= money($summary['shipping']) ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5 fw-bold">Order Total</span>
                            <span class="fs-4 fw-bold text-dark"><?= money($summary['total']) ?></span>
                        </div>
                    </div>
                    
                    <a href="/checkout" class="btn btn-primary btn-lg w-100 rounded-pill mb-3 py-2 fw-bold">
                        Proceed to Checkout
                    </a>
                    
                    <!-- Coupon -->
                    <div class="coupon-section mb-4">
                        <form id="couponForm" class="input-group input-group-sm">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                            <input type="text" name="code" class="form-control" placeholder="Coupon code">
                            <button type="submit" class="btn btn-outline-secondary">Apply</button>
                        </form>
                        <div id="couponMessage" class="mt-2 small"></div>
                    </div>

                    <div class="payment-trust text-center">
                        <p class="small text-muted mb-3"><i class="fas fa-lock me-1"></i> Secure Transaction</p>
                        <div class="d-flex justify-content-center align-items-center gap-3 fs-3 text-muted">
                            <span class="momo-badge fw-bold border rounded px-1" style="font-size: 0.8rem; color: #333; height: 1.5rem; display: flex; align-items: center;">MoMo Only</span>
                        </div>
                    </div>
                </div>
                
                <!-- Need Help -->
                <div class="need-help mt-4">
                    <h5>Need Help?</h5>
                    <p><i class="fas fa-phone"></i> <a href="tel:<?= htmlspecialchars($supportPhone) ?>"><?= htmlspecialchars($supportPhone) ?></a></p>
                    <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/<?= htmlspecialchars($supportWhatsappDigits) ?>" target="_blank" rel="noopener">WhatsApp us</a></p>
                    <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($supportEmail) ?></p>
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
