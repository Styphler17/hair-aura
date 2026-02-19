<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

require_once APP_PATH . '/Core/Autoloader.php';

if (file_exists(BASE_PATH . '/.env')) {
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, '"\' ');
            $_ENV[$key] = $value;
            putenv($key . '=' . $value);
        }
    }
}

try {
    $db = App\Core\Database::getInstance();
    $categories = $db->fetchAll("SELECT id, name, slug FROM categories ORDER BY id ASC");
    $output = "ID_MAPPING_START\n";
    foreach ($categories as $cat) {
        $output .= "ID: {$cat['id']} | Name: {$cat['name']} | Slug: {$cat['slug']}\n";
    }
    $output .= "ID_MAPPING_END\n";
    file_put_contents(BASE_PATH . '/category_ids.txt', $output);
    echo "Success\n";
} catch (\Exception $e) {
    file_put_contents(BASE_PATH . '/category_ids.txt', "Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage() . "\n";
}
