<?php
/**
 * Hair Aura - Mail Configuration
 * 
 * @package HairAura\Config
 */

return [
    // Default Mailer
    'default' => $_ENV['MAIL_MAILER'] ?? 'smtp',
    
    // SMTP Configuration
    'smtp' => [
        'host' => $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com',
        'port' => $_ENV['MAIL_PORT'] ?? 587,
        'encryption' => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',
        'username' => $_ENV['MAIL_USERNAME'] ?? '',
        'password' => $_ENV['MAIL_PASSWORD'] ?? '',
        'auth' => true,
        'timeout' => 30
    ],
    
    // Sendmail
    'sendmail' => [
        'path' => '/usr/sbin/sendmail -bs'
    ],
    
    // From Address
    'from' => [
        'address' => $_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@hair-aura.debesties.com',
        'name' => $_ENV['MAIL_FROM_NAME'] ?? 'Hair Aura'
    ],
    
    // Reply To
    'reply_to' => [
        'address' => 'support@hair-aura.debesties.com',
        'name' => 'Hair Aura Support'
    ],
    
    // Templates
    'templates' => [
        'order_confirmation' => 'emails/order-confirmation',
        'order_shipped' => 'emails/order-shipped',
        'password_reset' => 'emails/password-reset',
        'welcome' => 'emails/welcome',
        'newsletter' => 'emails/newsletter'
    ]
];
