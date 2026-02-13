<?php
/**
 * Hair Aura - Cart Controller
 * 
 * Handles shopping cart operations
 * 
 * @package HairAura\Controllers
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Core\Auth;

class CartController extends Controller
{
    /**
     * View cart
     */
    public function index(): void
    {
        $cartItems = $this->cart->getItems();
        $summary = $this->cart->getSummary();
        
        // Validate stock
        $stockErrors = $this->cart->validate();
        
        $seo = [
            'title' => 'Shopping Cart | Hair Aura',
            'description' => 'Review your selected wigs and hair extensions before checkout.',
            'canonical' => '/cart'
        ];
        
        $this->render('pages/cart', [
            'cartItems' => $cartItems,
            'summary' => $summary,
            'stockErrors' => $stockErrors,
            'seo' => $seo
        ]);
    }
    
    /**
     * Add item to cart (AJAX)
     */
    public function add(): void
    {
        if (!$this->validateCsrf()) {
            $this->json(['success' => false, 'message' => 'Invalid request']);
        }
        
        $productId = (int) $this->post('product_id');
        $quantity = (int) ($this->post('quantity') ?? 1);
        $variantId = $this->post('variant_id') ? (int) $this->post('variant_id') : null;
        
        if ($quantity < 1) {
            $quantity = 1;
        }
        
        $product = Product::find($productId);
        
        if (!$product) {
            $this->json(['success' => false, 'message' => 'Product not found']);
        }
        
        if (!$product->isInStock()) {
            $this->json(['success' => false, 'message' => 'Product is out of stock']);
        }
        
        // Check if enough stock
        $currentQty = 0;
        $existingItem = $this->cart->get($productId, $variantId);
        if ($existingItem) {
            $currentQty = $existingItem['quantity'];
        }
        
        if (($currentQty + $quantity) > $product->stock_quantity) {
            $this->json([
                'success' => false, 
                'message' => 'Only ' . $product->stock_quantity . ' items available'
            ]);
        }
        
        $success = $this->cart->add($productId, $quantity, $variantId);
        
        if ($success) {
            $summary = $this->cart->getSummary();
            
            $this->json([
                'success' => true,
                'message' => 'Added to cart!',
                'cart_count' => $summary['item_count'],
                'cart_total' => number_format($summary['total'], 2)
            ]);
        } else {
            $this->json(['success' => false, 'message' => 'Could not add to cart']);
        }
    }
    
    /**
     * Update cart item quantity (AJAX)
     */
    public function update(): void
    {
        if (!$this->validateCsrf()) {
            $this->json(['success' => false, 'message' => 'Invalid request']);
        }
        
        $productId = (int) $this->post('product_id');
        $quantity = (int) $this->post('quantity');
        $variantId = $this->post('variant_id') ? (int) $this->post('variant_id') : null;
        
        if ($quantity < 1) {
            $this->cart->remove($productId, $variantId);
        } else {
            $product = Product::find($productId);
            
            if (!$product) {
                $this->json(['success' => false, 'message' => 'Product not found']);
            }
            
            if ($quantity > $product->stock_quantity) {
                $this->json([
                    'success' => false, 
                    'message' => 'Only ' . $product->stock_quantity . ' items available'
                ]);
            }
            
            $this->cart->update($productId, $quantity, $variantId);
        }
        
        $cartItems = $this->cart->getItems();
        $summary = $this->cart->getSummary();
        
        // Find updated item
        $itemSubtotal = 0;
        foreach ($cartItems as $item) {
            if ($item['product_id'] == $productId && $item['variant_id'] == $variantId) {
                $itemSubtotal = $item['subtotal'];
                break;
            }
        }
        
        $this->json([
            'success' => true,
            'cart_count' => $summary['item_count'],
            'cart_subtotal' => number_format($summary['subtotal'], 2),
            'cart_shipping' => number_format($summary['shipping'], 2),
            'cart_total' => number_format($summary['total'], 2),
            'item_subtotal' => number_format($itemSubtotal, 2)
        ]);
    }
    
    /**
     * Remove item from cart (AJAX)
     */
    public function remove(): void
    {
        if (!$this->validateCsrf()) {
            $this->json(['success' => false, 'message' => 'Invalid request']);
        }
        
        $productId = (int) $this->post('product_id');
        $variantId = $this->post('variant_id') ? (int) $this->post('variant_id') : null;
        
        $this->cart->remove($productId, $variantId);
        
        $summary = $this->cart->getSummary();
        
        $this->json([
            'success' => true,
            'message' => 'Item removed',
            'cart_count' => $summary['item_count'],
            'cart_subtotal' => number_format($summary['subtotal'], 2),
            'cart_shipping' => number_format($summary['shipping'], 2),
            'cart_total' => number_format($summary['total'], 2)
        ]);
    }
    
    /**
     * Clear cart
     */
    public function clear(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/cart');
        }
        
        $this->cart->clear();
        
        $this->flash('success', 'Cart cleared');
        $this->redirect('/cart');
    }
    
    /**
     * Get mini cart (AJAX)
     */
    public function miniCart(): void
    {
        if (!$this->isAjax()) {
            $this->redirect('/cart');
        }
        
        $cartItems = $this->cart->getItems();
        $summary = $this->cart->getSummary();
        
        $items = array_map(function($item) {
            return [
                'id' => $item['product_id'],
                'name' => $item['name'],
                'image' => $item['image'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
                'slug' => $item['product']->slug
            ];
        }, array_slice($cartItems, 0, 3));
        
        $this->json([
            'items' => $items,
            'count' => $summary['item_count'],
            'subtotal' => number_format($summary['subtotal'], 2),
            'total' => number_format($summary['total'], 2),
            'has_more' => count($cartItems) > 3
        ]);
    }
    
    /**
     * Checkout page
     */
    public function checkout(): void
    {
        // Require login for checkout
        if (!$this->isLoggedIn) {
            $_SESSION['redirect_after_login'] = '/checkout';
            $this->flash('info', 'Please login to continue with checkout');
            $this->redirect('/login');
        }
        
        // Check if cart is empty
        if ($this->cart->isEmpty()) {
            $this->flash('error', 'Your cart is empty');
            $this->redirect('/shop');
        }
        
        // Validate stock
        $stockErrors = $this->cart->validate();
        if (!empty($stockErrors)) {
            $this->flash('error', 'Some items in your cart are no longer available');
            $this->redirect('/cart');
        }
        
        $cartItems = $this->cart->getItems();
        $summary = $this->cart->getSummary();
        
        // Get user addresses
        $addresses = $this->user->getAddresses();
        $defaultAddress = $this->user->getDefaultAddress();
        
        $seo = [
            'title' => 'Checkout | Hair Aura',
            'description' => 'Complete your purchase of premium wigs and hair extensions.',
            'canonical' => '/checkout'
        ];
        
        $this->render('pages/checkout', [
            'cartItems' => $cartItems,
            'summary' => $summary,
            'addresses' => $addresses,
            'defaultAddress' => $defaultAddress,
            'seo' => $seo
        ]);
    }
    
    /**
     * Process checkout
     */
    public function processCheckout(): void
    {
        $this->requireAuth();
        
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/checkout');
        }
        
        // Check cart
        if ($this->cart->isEmpty()) {
            $this->flash('error', 'Your cart is empty');
            $this->redirect('/shop');
        }
        
        // Validate stock
        $stockErrors = $this->cart->validate();
        if (!empty($stockErrors)) {
            $this->flash('error', 'Some items are no longer available');
            $this->redirect('/cart');
        }
        
        $data = $this->post();
        
        // Validate shipping info
        $errors = $this->validate($data, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'address' => 'required|min:5',
            'city' => 'required',
            'payment_method' => 'required'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $this->redirect('/checkout');
        }

        $allowedPaymentMethods = ['momo', 'cash', 'stripe', 'paypal'];
        if (!in_array($data['payment_method'], $allowedPaymentMethods, true)) {
            $this->flash('error', 'Invalid payment method selected');
            $this->redirect('/checkout');
        }
        
        // Prepare cart data
        $summary = $this->cart->getSummary();
        $cartItems = $this->cart->getItems();
        
        $cartData = [
            'items' => array_map(function($item) {
                return [
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'],
                    'name' => $item['name'],
                    'sku' => $item['product']->sku,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal']
                ];
            }, $cartItems),
            'subtotal' => $summary['subtotal'],
            'shipping' => $summary['shipping'],
            'tax' => $summary['tax'],
            'total' => $summary['total']
        ];
        
        // Prepare shipping data
        $shippingData = [
            'user_id' => $this->user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'] ?? '',
            'country' => $data['country'] ?? 'Ghana',
            'postal_code' => $data['postal_code'] ?? '',
            'notes' => $data['notes'] ?? null
        ];
        
        // Prepare payment data
        $paymentData = [
            'method' => $data['payment_method'],
            'currency' => 'GHS'
        ];
        
        try {
            // Create order
            $order = Order::createFromCart($cartData, $shippingData, $paymentData);

            // Persist shipping address for easier repeat checkout.
            if ($this->user) {
                $this->user->saveAddressFromCheckout([
                    'first_name' => $shippingData['first_name'],
                    'last_name' => $shippingData['last_name'],
                    'phone' => $shippingData['phone'],
                    'address' => $shippingData['address'],
                    'city' => $shippingData['city'],
                    'state' => $shippingData['state'],
                    'country' => $shippingData['country'],
                    'postal_code' => $shippingData['postal_code'] ?? ''
                ]);
            }
            
            // Clear cart
            $this->cart->clear();
            
            // Redirect to payment
            if ($data['payment_method'] === 'momo') {
                $this->flash(
                    'info',
                    'MoMo selected. Send ' . money((float) $order->total) . ' to +233508007873 and use order #' . $order->order_number . ' as reference.'
                );
                $this->redirect('/account/orders/' . $order->order_number);
            } elseif ($data['payment_method'] === 'stripe') {
                $this->redirect('/checkout/stripe/' . $order->order_number);
            } elseif ($data['payment_method'] === 'paypal') {
                $this->redirect('/checkout/paypal/' . $order->order_number);
            } else {
                // Cash on delivery or bank transfer
                $this->flash('success', 'Order placed successfully! Order #' . $order->order_number);
                $this->redirect('/account/orders/' . $order->order_number);
            }
            
        } catch (\Exception $e) {
            error_log("Checkout error: " . $e->getMessage());
            $this->flash('error', 'An error occurred while processing your order. Please try again.');
            $this->redirect('/checkout');
        }
    }
    
    /**
     * Stripe checkout
     */
    public function stripeCheckout(string $orderNumber): void
    {
        $order = Order::findByOrderNumber($orderNumber);
        
        if (!$order || $order->user_id !== $this->user?->id) {
            $this->flash('error', 'Order not found');
            $this->redirect('/account/orders');
        }
        
        // TODO: Implement Stripe integration
        // This is a stub for the Stripe checkout flow
        
        $this->flash('info', 'Stripe payment integration coming soon. Order #' . $orderNumber);
        $this->redirect('/account/orders/' . $orderNumber);
    }
    
    /**
     * PayPal checkout
     */
    public function paypalCheckout(string $orderNumber): void
    {
        $order = Order::findByOrderNumber($orderNumber);
        
        if (!$order || $order->user_id !== $this->user?->id) {
            $this->flash('error', 'Order not found');
            $this->redirect('/account/orders');
        }
        
        // TODO: Implement PayPal integration
        // This is a stub for the PayPal checkout flow
        
        $this->flash('info', 'PayPal payment integration coming soon. Order #' . $orderNumber);
        $this->redirect('/account/orders/' . $orderNumber);
    }
    
    /**
     * Checkout success
     */
    public function success(): void
    {
        $this->render('pages/checkout-success', [
            'seo' => [
                'title' => 'Order Confirmed | Hair Aura',
                'description' => 'Thank you for your order!'
            ]
        ]);
    }
    
    /**
     * Checkout cancel
     */
    public function cancel(): void
    {
        $this->flash('error', 'Payment was cancelled');
        $this->redirect('/checkout');
    }
    
    /**
     * Apply coupon
     */
    public function applyCoupon(): void
    {
        if (!$this->validateCsrf()) {
            $this->json(['success' => false, 'message' => 'Invalid request']);
        }
        
        $code = strtoupper(trim($this->post('code', '')));
        
        if (empty($code)) {
            $this->json(['success' => false, 'message' => 'Please enter a coupon code']);
        }
        
        $db = \App\Core\Database::getInstance();
        
        $coupon = $db->fetchOne(
            "SELECT * FROM coupons WHERE code = :code AND is_active = 1 
             AND (expires_at IS NULL OR expires_at > NOW())
             AND (usage_limit IS NULL OR usage_count < usage_limit)
             LIMIT 1",
            ['code' => $code]
        );
        
        if (!$coupon) {
            $this->json(['success' => false, 'message' => 'Invalid or expired coupon code']);
        }
        
        $summary = $this->cart->getSummary();
        
        // Check minimum order
        if ($coupon['min_order_amount'] && $summary['subtotal'] < $coupon['min_order_amount']) {
            $this->json([
                'success' => false, 
                'message' => 'Minimum order amount of GH₵' . number_format((float) $coupon['min_order_amount'], 2) . ' required'
            ]);
        }
        
        // Calculate discount
        $discount = 0;
        if ($coupon['discount_type'] === 'percentage') {
            $discount = $summary['subtotal'] * ($coupon['discount_value'] / 100);
        } else {
            $discount = $coupon['discount_value'];
        }
        
        // Apply max discount
        if ($coupon['max_discount'] && $discount > $coupon['max_discount']) {
            $discount = $coupon['max_discount'];
        }
        
        // Store coupon in session
        $_SESSION['applied_coupon'] = [
            'code' => $code,
            'discount' => $discount,
            'type' => $coupon['discount_type'],
            'value' => $coupon['discount_value']
        ];
        
        $newTotal = $summary['total'] - $discount;
        
        $this->json([
            'success' => true,
            'message' => 'Coupon applied!',
            'discount' => number_format($discount, 2),
            'new_total' => number_format($newTotal, 2)
        ]);
    }
    
    /**
     * Remove coupon
     */
    public function removeCoupon(): void
    {
        unset($_SESSION['applied_coupon']);
        
        $summary = $this->cart->getSummary();
        
        $this->json([
            'success' => true,
            'new_total' => number_format($summary['total'], 2)
        ]);
    }
}
