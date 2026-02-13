<?php
/**
 * Hair Aura - Application Configuration
 * 
 * @package HairAura\Config
 */

return [
    // Application
    'name' => 'Hair Aura',
    'tagline' => 'Unlock Your Aura with Perfect Wigs',
    'url' => $_ENV['APP_URL'] ?? 'https://hair-aura.debesties.com',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => ($_ENV['APP_DEBUG'] ?? 'false') === 'true',
    'timezone' => 'Africa/Accra',
    'locale' => 'en',
    
    // Contact
    'contact_email' => 'hello@hair-aura.debesties.com',
    'support_email' => 'support@hair-aura.debesties.com',
    'phone' => '+233 20 123 4567',
    'whatsapp' => '+233 20 123 4567',
    
    // Address
    'address' => [
        'street' => '123 Fashion Street',
        'city' => 'Accra',
        'region' => 'Greater Accra',
        'country' => 'Ghana',
        'postal' => '00233'
    ],
    
    // Social Media
    'social' => [
        'instagram' => 'https://instagram.com/hairaura',
        'facebook' => 'https://facebook.com/hairaura',
        'twitter' => 'https://twitter.com/hairaura',
        'tiktok' => 'https://tiktok.com/@hairaura',
        'youtube' => 'https://youtube.com/hairaura'
    ],
    
    // Business
    'currency' => 'GHS',
    'currency_symbol' => 'GH₵',
    'tax_rate' => 0,
    'free_shipping_threshold' => 100,
    'shipping_cost' => 15,
    
    // Features
    'features' => [
        'reviews' => true,
        'wishlist' => true,
        'compare' => true,
        'virtual_try_on' => true,
        'stock_alerts' => true,
        'newsletter' => true
    ],
    
    // Pagination
    'per_page' => 12,
    'admin_per_page' => 25,
    
    // Images
    'image_sizes' => [
        'thumbnail' => [150, 150],
        'small' => [300, 300],
        'medium' => [600, 600],
        'large' => [1200, 1200]
    ],
    
    // Security
    'session_lifetime' => 120, // minutes
    'password_min_length' => 8,
    'max_login_attempts' => 5,
    'lockout_duration' => 30, // minutes
];
