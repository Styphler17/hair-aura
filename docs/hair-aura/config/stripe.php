<?php
/**
 * Hair Aura - Stripe Payment Configuration
 * 
 * @package HairAura\Config
 */

return [
    // API Keys
    'publishable_key' => $_ENV['STRIPE_PUBLISHABLE_KEY'] ?? 'pk_test_your_publishable_key',
    'secret_key' => $_ENV['STRIPE_SECRET_KEY'] ?? 'sk_test_your_secret_key',
    'webhook_secret' => $_ENV['STRIPE_WEBHOOK_SECRET'] ?? 'whsec_your_webhook_secret',
    
    // Settings
    'currency' => 'ghs',
    'mode' => $_ENV['STRIPE_MODE'] ?? 'test', // 'test' or 'live'
    
    // Payment Methods
    'payment_methods' => [
        'card',
        'mobile_money' // For African markets
    ],
    
    // Checkout Settings
    'checkout' => [
        'success_url' => '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => '/checkout/cancel',
        'allow_promotion_codes' => true,
        'collect_shipping_address' => true,
        'collect_phone_number' => true
    ],
    
    // Webhook Events
    'webhook_events' => [
        'checkout.session.completed',
        'checkout.session.async_payment_succeeded',
        'checkout.session.async_payment_failed',
        'payment_intent.succeeded',
        'payment_intent.payment_failed',
        'charge.refunded',
        'charge.dispute.created'
    ]
];
