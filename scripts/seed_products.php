<?php
/**
 * Product Seeder
 * Run: php scripts/seed_products.php
 */

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require_once APP_PATH . '/Core/Autoloader.php';

// Load environment variables
if (file_exists(BASE_PATH . '/.env')) {
    $lines = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, " \t\n\r\0\x0B\"");
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

use App\Core\Database;

try {
    file_put_contents(BASE_PATH . '/seeder.log', "Seeding started at " . date('Y-m-d H:i:s') . "\n");
    $db = Database::getInstance();
    $db->beginTransaction();

    $products = [
        [
            'name' => 'Luxury Vietnamese Bone Straight',
            'slug' => 'luxury-vietnamese-bone-straight',
            'category_id' => 1,
            'price' => 1200.00,
            'description' => 'Experience the pinnacle of luxury with our Vietnamese Bone Straight hair. Sourced from single donors, this hair is naturally sleek, incredibly soft, and maintains its straightness even after washing. Perfect for a sophisticated, high-end look.',
            'short_description' => 'Super double drawn, 100% human hair, Grade 12A.',
            'sku' => 'VBS-LUX-001',
            'image' => 'Bone-straight.jpeg',
            'variants' => ['10"', '12"', '14"', '16"', '18"', '20"', '22"', '24"', '26"', '28"', '30"'],
            'price_step' => 80.00
        ],
        [
            'name' => 'Ocean Deep Wave Frontal Wig',
            'slug' => 'ocean-deep-wave-frontal-wig',
            'category_id' => 21,
            'price' => 1500.00,
            'description' => 'Our Ocean Deep Wave collection offers intense definition and a natural luster. This 13x4 frontal wig provides a seamless hairline and versatile parting options. The waves are bouncy, voluminous, and easy to maintain.',
            'short_description' => '13x4 HD Lace Frontal, 200% Density.',
            'sku' => 'ODW-FW-002',
            'image' => 'Body-wave.webp',
            'variants' => ['18"', '20"', '22"', '24"', '26"'],
            'price_step' => 100.00
        ],
        [
            'name' => 'Glueless Pixie Curl Wig',
            'slug' => 'glueless-pixie-curl-wig',
            'category_id' => 20,
            'price' => 650.00,
            'description' => 'Effortless style in minutes! This pixie curl wig is designed for the modern woman on the go. Featuring a glueless cap construction with adjustable straps, it offers a secure fit without the need for adhesive.',
            'short_description' => 'Beginner friendly, glueless install, soft curls.',
            'sku' => 'GPC-WIG-003',
            'image' => 'Pixie-curls-hair.webp',
            'variants' => ['8"', '10"', '12"'],
            'price_step' => 50.00
        ],
        [
            'name' => 'Raw Cambodian Natural Wave',
            'slug' => 'raw-cambodian-natural-wave',
            'category_id' => 23,
            'price' => 850.00,
            'description' => 'Pure, unprocessed hair directly from Cambodia. Each bundle is unique, featuring a natural wave pattern that can be straightened or curled. Known for its strength and longevity, this hair can last over 3 years with proper care.',
            'short_description' => '100% Raw unprocessed hair, single donor.',
            'sku' => 'RCNW-BUN-004',
            'image' => 'Rawdonor.webp',
            'variants' => ['12"', '14"', '16"', '18"', '20"', '22"', '24"', '26"', '28"', '30"'],
            'price_step' => 70.00
        ],
        [
            'name' => 'Sharp Blunt Cut Bob - #1B',
            'slug' => 'sharp-blunt-cut-bob-1b',
            'category_id' => 24,
            'price' => 580.00,
            'description' => 'A timeless classic. Our Blunt Cut Bob features precision-leveled ends for a sharp, modern silhouette. Made with premium human hair that remains sleek and manageable.',
            'short_description' => '4x4 Closure wig, pre-plucked hairline.',
            'sku' => 'BCB-BLK-005',
            'image' => '10-straight-hair.webp',
            'variants' => ['10"', '12"', '14"'],
            'price_step' => 40.00
        ],
        [
            'name' => 'Honey Blonde Straight Wig',
            'slug' => 'honey-blonde-straight-wig',
            'category_id' => 1,
            'price' => 1850.00,
            'description' => 'Turn heads with our pre-colored Honey Blonde Straight wig. Perfectly toned for a warm, sun-kissed look. The hair is silky smooth and maintains its vibrant color after multiple washes.',
            'short_description' => 'Color #27/613 mix, 13x4 Frontal, HD Lace.',
            'sku' => 'HBS-WIG-006',
            'image' => 'Straight-hair.webp',
            'variants' => ['20"', '22"', '24"', '26"'],
            'price_step' => 120.00
        ],
        [
            'name' => 'Kinky Straight 13x4 Frontal',
            'slug' => 'kinky-straight-13x4-frontal',
            'category_id' => 18,
            'price' => 1150.00,
            'description' => 'The perfect blend for natural hair. Our Kinky Straight texture mimics blown-out natural hair, offering incredible volume and a realistic look. Can be flat-ironed bone straight or left in its voluminous state.',
            'short_description' => 'Natural texture, 180% density, mimics 4C hair.',
            'sku' => 'KS-FR-007',
            'image' => 'Long-straight-hair.webp',
            'variants' => ['16"', '18"', '20"', '22"', '24"'],
            'price_step' => 90.00
        ],
        [
            'name' => 'Tapered Cut Pixie Wig',
            'slug' => 'tapered-cut-pixie-wig',
            'category_id' => 19,
            'price' => 480.00,
            'description' => 'Chic and sophisticated. This tapered pixie cut offers a short, clean look that highlights your facial features. It\'s lightweight, breathable, and ready to wear straight out of the box.',
            'short_description' => 'Tapered back and sides, breathable cap.',
            'sku' => 'TCP-WIG-008',
            'image' => 'Frontalpixie-hair.webp',
            'variants' => ['Standard'],
            'price_step' => 0
        ],
        [
            'name' => 'Burgundy Deep Wave Wig',
            'slug' => 'burgundy-deep-wave-wig',
            'category_id' => 21,
            'price' => 1450.00,
            'description' => 'Add a pop of color with our stunning Burgundy Deep Wave wig. The deep, rich wine color is perfect for any season. The wave pattern is tight and stays defined even after wetting.',
            'short_description' => 'Color #99J, Deep Wave, 13x6 Frontal.',
            'sku' => 'BDW-WIG-009',
            'image' => 'Brownbodywave.webp',
            'variants' => ['20"', '22"', '24"', '26"'],
            'price_step' => 110.00
        ],
        [
            'name' => 'Double Drawn Body Wave',
            'slug' => 'double-drawn-body-wave',
            'category_id' => 18,
            'price' => 1250.00,
            'description' => 'Full from top to bottom. Our Super Double Drawn Body Wave bundles ensure maximum thickness and volume. The hair is soft, bouncy, and possesses a beautiful natural luster.',
            'short_description' => 'Super double drawn bundles, thick ends.',
            'sku' => 'DDBW-BUN-010',
            'image' => 'Bouncy-hair.webp',
            'variants' => ['18"', '20"', '22"', '24"', '26"', '28"', '30"'],
            'price_step' => 95.00
        ]
    ];

    foreach ($products as $p) {
        file_put_contents(BASE_PATH . '/seeder.log', "Seeding: " . $p['name'] . "\n", FILE_APPEND);
        // Insert product
        $productId = $db->insert('products', [
            'name' => $p['name'],
            'slug' => $p['slug'],
            'description' => $p['description'],
            'short_description' => $p['short_description'],
            'price' => $p['price'],
            'sku' => $p['sku'],
            'category_id' => $p['category_id'],
            'hair_type' => 'human_hair',
            'stock_quantity' => 50,
            'is_active' => 1,
            'featured' => rand(0, 1),
            'new_arrival' => 1,
            'rating_avg' => 4.5,
            'review_count' => rand(5, 50)
        ]);

        // Insert primary image
        $db->insert('product_images', [
            'product_id' => $productId,
            'image_path' => $p['image'],
            'is_primary' => 1,
            'sort_order' => 1
        ]);

        // Insert variants
        foreach ($p['variants'] as $index => $val) {
            $db->insert('product_variants', [
                'product_id' => $productId,
                'variant_name' => 'Size',
                'variant_value' => $val,
                'sku' => $p['sku'] . '-' . str_replace('"', '', $val),
                'price_adjustment' => $index * $p['price_step'],
                'stock_quantity' => rand(5, 15),
                'sort_order' => $index + 1
            ]);
        }

        echo "Seeded: " . $p['name'] . "\n";
    }

    $db->commit();
    echo "Successfully seeded 10 products with variants.\n";

} catch (\Throwable $e) {
    file_put_contents(BASE_PATH . '/seeder.log', "Error: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n", FILE_APPEND);
    if (isset($db) && $db->inTransaction()) {
        $db->rollback();
    }
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
