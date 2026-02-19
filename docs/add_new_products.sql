-- NEW PRODUCTS SEEDER FOR HAIR AURA
-- Date: 2026-02-19
-- Environment: MAMP / MySQL

-- Use the specific database
-- USE `u509059322_hairaura2025`;

START TRANSACTION;

-- 1. LUXURY VIETNAMESE BONE STRAIGHT (Cat ID 1)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `texture`, `stock_quantity`, `is_active`, `new_arrival`, `rating_avg`, `review_count`) 
VALUES ('Luxury Vietnamese Bone Straight', 'luxury-vietnamese-bone-straight', 'Experience the pinnacle of luxury with our Vietnamese Bone Straight hair. Sourced from single donors, this hair is naturally sleek, incredibly soft, and maintains its straightness even after washing.', 'Super double drawn, 100% human hair, Grade 12A.', 1200.00, 'VBS-LUX-001', 1, 'human_hair', 'Straight', 50, 1, 1, 4.9, 42);
SET @vbs_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@vbs_id, 'Bone-straight.jpeg', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@vbs_id, 'Size', '12 Inch', 'VBS-LUX-001-12', 0.00, 15, 1),
(@vbs_id, 'Size', '14 Inch', 'VBS-LUX-001-14', 100.00, 15, 2),
(@vbs_id, 'Size', '16 Inch', 'VBS-LUX-001-16', 200.00, 15, 3),
(@vbs_id, 'Size', '18 Inch', 'VBS-LUX-001-18', 300.00, 15, 4),
(@vbs_id, 'Size', '20 Inch', 'VBS-LUX-001-20', 450.00, 10, 5),
(@vbs_id, 'Size', '22 Inch', 'VBS-LUX-001-22', 600.00, 10, 6);

-- 2. OCEAN DEEP WAVE FRONTAL WIG (Cat ID 21)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `texture`, `stock_quantity`, `is_active`, `new_arrival`, `rating_avg`, `review_count`) 
VALUES ('Ocean Deep Wave Frontal Wig', 'ocean-deep-wave-frontal-wig', 'Our Ocean Deep Wave collection offers intense definition and a natural luster. This 13x4 frontal wig provides a seamless hairline.', '13x4 HD Lace Frontal, 200% Density.', 1500.00, 'ODW-FW-002', 21, 'human_hair', 'Deep Wave', 30, 1, 1, 4.8, 35);
SET @odw_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@odw_id, 'Body-wave.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@odw_id, 'Size', '20 Inch', 'ODW-FW-20', 0.00, 10, 1),
(@odw_id, 'Size', '22 Inch', 'ODW-FW-22', 150.00, 10, 2),
(@odw_id, 'Size', '24 Inch', 'ODW-FW-24', 300.00, 10, 3),
(@odw_id, 'Size', '26 Inch', 'ODW-FW-26', 450.00, 5, 4);

-- 3. GLUELESS PIXIE CURL WIG (Cat ID 20)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `texture`, `stock_quantity`, `is_active`, `new_arrival`, `rating_avg`, `review_count`) 
VALUES ('Glueless Pixie Curl Wig', 'glueless-pixie-curl-wig', 'Effortless style in minutes! Featuring a glueless cap construction with adjustable straps.', 'Beginner friendly, glueless install, soft curls.', 650.00, 'GPC-WIG-003', 20, 'human_hair', 'Curly', 40, 1, 1, 4.7, 56);
SET @pixie_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@pixie_id, 'Pixie-curls-hair.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@pixie_id, 'Size', '8 Inch', 'GPC-08', 0.00, 20, 1),
(@pixie_id, 'Size', '10 Inch', 'GPC-10', 80.00, 20, 2),
(@pixie_id, 'Size', '12 Inch', 'GPC-12', 150.00, 15, 3);

-- 4. RAW CAMBODIAN NATURAL WAVE (Cat ID 23)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `texture`, `stock_quantity`, `is_active`, `featured`, `rating_avg`) 
VALUES ('Raw Cambodian Natural Wave', 'raw-cambodian-natural-wave', 'Pure, unprocessed hair directly from Cambodia. Each bundle is unique.', '100% Raw unprocessed hair, single donor.', 850.00, 'RCNW-004', 23, 'human_hair', 'Wavy', 25, 1, 1, 5.0);
SET @raw_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@raw_id, 'Rawdonor.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@raw_id, 'Size', '18 Inch', 'RAW-18', 0.00, 10, 1),
(@raw_id, 'Size', '22 Inch', 'RAW-22', 250.00, 8, 2),
(@raw_id, 'Size', '26 Inch', 'RAW-26', 500.00, 5, 3);

-- 5. SHARP BLUNT CUT BOB (Cat ID 24)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `texture`, `stock_quantity`, `is_active`, `bestseller`) 
VALUES ('Sharp Blunt Cut Bob - #1B', 'sharp-blunt-cut-bob-1b', 'A timeless classic. Our Blunt Cut Bob features precision-leveled ends.', '4x4 Closure wig, pre-plucked hairline.', 580.00, 'BCB-005', 24, 'human_hair', 'Straight', 20, 1, 1);
SET @bob_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@bob_id, '10-straight-hair.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@bob_id, 'Size', '10 Inch', 'BOB-10', 0.00, 10, 1),
(@bob_id, 'Size', '12 Inch', 'BOB-12', 60.00, 10, 2);

-- 6. HONEY BLONDE STRAIGHT WIG (Cat ID 1)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `color`, `stock_quantity`, `is_active`) 
VALUES ('Honey Blonde Straight Wig', 'honey-blonde-straight-wig', 'Turn heads with our pre-colored Honey Blonde Straight wig. Perfectly toned.', 'Color #27, 13x4 Frontal, HD Lace.', 1850.00, 'HBS-006', 1, 'human_hair', 'Honey Blonde', 15, 1);
SET @blonde_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@blonde_id, 'Straight-hair.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@blonde_id, 'Size', '22 Inch', 'BLONDE-22', 0.00, 5, 1),
(@blonde_id, 'Size', '26 Inch', 'BLONDE-26', 300.00, 5, 2);

-- 7. KINKY STRAIGHT 13x4 FRONTAL (Cat ID 18)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `texture`, `stock_quantity`) 
VALUES ('Kinky Straight 13x4 Frontal', 'kinky-straight-frontal', 'The perfect blend for natural hair. Mimics blown-out natural hair.', 'Natural texture, 180% density.', 1150.00, 'KS-007', 18, 'human_hair', 'Kinky Straight', 25);
SET @kinky_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@kinky_id, 'Long-straight-hair.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@kinky_id, 'Size', '18 Inch', 'KS-18', 0.00, 10, 1),
(@kinky_id, 'Size', '22 Inch', 'KS-22', 180.00, 10, 2);

-- 8. TAPERED CUT PIXIE WIG (Cat ID 19)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `hair_type`, `stock_quantity`) 
VALUES ('Tapered Cut Pixie Wig', 'tapered-cut-pixie', 'Chic and sophisticated. Highlighting your facial features.', 'Tapered back and sides.', 480.00, 'TCP-008', 19, 'human_hair', 50);
SET @taper_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@taper_id, 'Frontalpixie-hair.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@taper_id, 'Size', 'Standard', 'TCP-STD', 0.00, 50, 1);

-- 9. BURGUNDY DEEP WAVE WIG (Cat ID 21)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `color`, `stock_quantity`) 
VALUES ('Burgundy Deep Wave Wig', 'burgundy-deep-wave', 'Add a pop of color with our stunning Burgundy Deep Wave wig.', 'Color #99J, Deep Wave, 13x4 Frontal.', 1450.00, 'BDW-009', 21, 'Burgundy', 12);
SET @burg_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@burg_id, 'Brownbodywave.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@burg_id, 'Size', '20 Inch', 'BURG-20', 0.00, 6, 1),
(@burg_id, 'Size', '24 Inch', 'BURG-24', 250.00, 6, 2);

-- 10. DOUBLE DRAWN BODY WAVE (Cat ID 18)
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sku`, `category_id`, `texture`, `stock_quantity`) 
VALUES ('Double Drawn Body Wave', 'double-drawn-body-wave', 'Full from top to bottom. Maximum thickness and volume.', 'Super double drawn, thick ends.', 950.00, 'DDBW-010', 18, 'Body Wave', 20);
SET @ddbw_id = LAST_INSERT_ID();

INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES (@ddbw_id, 'Bouncy-hair.webp', 1, 1);

INSERT INTO `product_variants` (`product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `sort_order`) VALUES 
(@ddbw_id, 'Size', '18 Inch', 'DDBW-18', 0.00, 10, 1),
(@ddbw_id, 'Size', '22 Inch', 'DDBW-22', 150.00, 10, 2),
(@ddbw_id, 'Size', '26 Inch', 'DDBW-26', 350.00, 5, 3);

COMMIT;
