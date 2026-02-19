<?php
define('BASE_PATH', 'e:/hair-aura');
define('APP_PATH', BASE_PATH . '/app');
require_once APP_PATH . '/Core/Autoloader.php';
$log = "DEBUG START\n";
if (file_exists(BASE_PATH . '/.env')) {
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value, '"\' '));
        }
    }
}
$log .= "DB: " . getenv('DB_DATABASE') . "\n";
try {
    $db = App\Core\Database::getInstance();
    $cats = $db->fetchAll("SELECT id, name, slug, meta_title FROM categories");
    foreach($cats as $c) {
        $log .= "ID {$c['id']}: {$c['name']} (Slug: {$c['slug']}) | Meta: " . ($c['meta_title'] ?? 'NONE') . "\n";
    }
} catch (Exception $e) {
    $log .= "ERR: " . $e->getMessage() . "\n";
}
file_put_contents(BASE_PATH . '/db_status.txt', $log);
echo "CHECK_COMPLETED";
