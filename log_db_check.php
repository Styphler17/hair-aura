<?php
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
require_once APP_PATH . '/Core/Autoloader.php';
$log = "Script started\n";
try {
    $db = App\Core\Database::getInstance();
    $log .= "DB Connected\n";
    $categories = $db->fetchAll("SELECT id, name FROM categories");
    $log .= "Categories found: " . count($categories) . "\n";
    foreach ($categories as $cat) {
        $log .= "ID: {$cat['id']}, Name: {$cat['name']}\n";
    }
} catch (\Exception $e) {
    $log .= "Error: " . $e->getMessage() . "\n";
}
file_put_contents('db_check_result.txt', $log);
echo "Done\n";
