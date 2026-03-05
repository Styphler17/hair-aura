<?php
// Since CLI might lack PDO, let's use a web-accessible script to dump the data
// We'll write to a temp file that we can read via CLI or just output it
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../config/config.php';

use App\Core\Database;

$db = Database::getInstance();
$blogs = $db->fetchAll("SELECT id, title, featured_image FROM blog_posts");

$missing = [];
$base = __DIR__ . '/public/';

foreach ($blogs as $blog) {
    if (empty($blog['featured_image'])) {
        $missing[] = $blog;
        continue;
    }
    
    $img = ltrim($blog['featured_image'], '/');
    if (!file_exists($base . $img)) {
        $missing[] = $blog;
    }
}

echo "MISSING_START\n";
echo json_encode($missing);
echo "\nMISSING_END\n";
