<?php
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

require_once APP_PATH . '/Core/Autoloader.php';

if (file_exists(BASE_PATH . '/.env')) {
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

use App\Core\Database;

try {
    $db = Database::getInstance();
    $categories = $db->fetchAll("SELECT id, name, slug FROM categories");
    echo "CATEGORIES_START\n";
    echo json_encode($categories, JSON_PRETTY_PRINT);
    echo "\nCATEGORIES_END\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
