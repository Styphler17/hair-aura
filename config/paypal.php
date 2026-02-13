<?php
/**
 * Hair Aura - PayPal Payment Configuration
 * 
 * @package HairAura\Config
 */

return [
    // API Credentials
    'client_id' => $_ENV['PAYPAL_CLIENT_ID'] ?? 'your_paypal_client_id',
    'client_secret' => $_ENV['PAYPAL_CLIENT_SECRET'] ?? 'your_paypal_client_secret',
    
    // Environment
    'mode' => $_ENV['PAYPAL_MODE'] ?? 'sandbox', // 'sandbox' or 'live'
    
    // API Endpoints
    'endpoints' => [
        'sandbox' => 'https://api-m.sandbox.paypal.com',
        'live' => 'https://api-m.paypal.com'
    ],
    
    // Settings
    'currency' => 'GHS',
    'brand_name' => 'Hair Aura',
    'landing_page' => 'BILLING', // 'LOGIN' or 'BILLING'
    'shipping_preference' => 'SET_PROVIDED_ADDRESS',
    'user_action' => 'PAY_NOW',
    
    // Return URLs
    'return_url' => '/checkout/paypal/success',
    'cancel_url' => '/checkout/paypal/cancel',
    
    // Webhook
    'webhook_id' => $_ENV['PAYPAL_WEBHOOK_ID'] ?? ''
];
