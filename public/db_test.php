<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: text/plain');

echo "Database Connection Tester\n";
echo "==========================\n\n";

$tests = [
    'User Credential (lowercase/localhost)' => [
        'host' => 'localhost',
        'username' => 'u509059322_hairaura2025',
        'password' => 'hairAura@2025',
        'dbname' => 'u509059322_hairaura2025'
    ],
    'Original (Mixed Case/localhost)' => [
        'host' => 'localhost',
        'username' => 'u509059322_HairAura2025',
        'password' => 'HairAura@2025',
        'dbname' => 'u509059322_hairaura2025'
    ],
    'User Credential (lowercase/127.0.0.1)' => [
        'host' => '127.0.0.1',
        'username' => 'u509059322_hairaura2025',
        'password' => 'hairAura@2025',
        'dbname' => 'u509059322_hairaura2025'
    ],
    'Original (Mixed Case/127.0.0.1)' => [
        'host' => '127.0.0.1',
        'username' => 'u509059322_HairAura2025',
        'password' => 'HairAura@2025',
        'dbname' => 'u509059322_hairaura2025'
    ]
];

foreach ($tests as $name => $config) {
    echo "Testing: $name\n";
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        ]);
        echo "RESULT: SUCCESS! Connected successfully.\n";
        echo "----------------------------------------\n";
        // If success, output the working config to use
        echo "\n!!! WORKING CONFIGURATION FOUND !!!\n";
        print_r($config);
        exit; // Stop on first success
    } catch (PDOException $e) {
        echo "RESULT: FAILED. Error: " . $e->getMessage() . "\n";
        echo "----------------------------------------\n";
    }
}

echo "\nAll connection attempts failed. Please verify credentials in your hosting panel.\n";
