<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
require_once APP_PATH . '/Core/Autoloader.php';

// Load .env
if (file_exists(BASE_PATH . '/.env')) {
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value, '"\' '));
        }
    }
}

echo "Database: " . getenv('DB_DATABASE') . "\n";
echo "Host: " . getenv('DB_HOST') . "\n";

try {
    $db = App\Core\Database::getInstance();
    $categories = $db->fetchAll("SELECT id, name, meta_title FROM categories");
    echo "Count: " . count($categories) . "\n";
    foreach ($categories as $cat) {
        echo "ID: {$cat['id']} | Name: {$cat['name']} | SEO Title: " . ($cat['meta_title'] ?? 'EMPTY') . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
