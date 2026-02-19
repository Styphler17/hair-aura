<?php
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
require_once APP_PATH . '/Core/Autoloader.php';
echo "Autoloaded\n";
if (file_exists(BASE_PATH . '/.env')) {
    echo "Env exists\n";
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}
echo "DB Host: " . getenv('DB_HOST') . "\n";
use App\Core\Database;
try {
    $db = Database::getInstance();
    echo "DB Connected\n";
    $categories = $db->fetchAll("SELECT id, name FROM categories");
    print_r($categories);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
