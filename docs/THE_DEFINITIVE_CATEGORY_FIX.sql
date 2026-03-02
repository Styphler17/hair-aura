-- THE DEFINITIVE CATEGORY & SEO FIX (UPDATED WITH MEDIA SYNC)
-- This script re-indexes IDs to 1-7, updates content, and syncs images to media library.
-- IMPORTANT: Run this entire block at once.

SET SESSION FOREIGN_KEY_CHECKS = 0;

-- 1. RE-INDEX CATEGORY IDs AND UPDATE CONTENT (Full Relative Paths for Media Sync)

-- Category 1: Bone-straight
UPDATE `categories` SET 
    `name` = 'Bone-straight',
    `slug` = 'bone-straight-hair',
    `description` = 'Premium 100% human hair bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.',
    `image` = 'uploads/categories/Bone-straight.webp',
    `meta_title` = 'Luxury Bone Straight Hair',
    `meta_description` = 'Indulge in the ultimate sleekness with our premium bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.'
WHERE `id` = 1;

-- Category 2: Body wave
UPDATE `categories` SET 
    `id` = 2,
    `name` = 'Body wave',
    `description` = '100% human hair body wave. Enhance your natural beauty with our voluminous, bouncy waves.',
    `image` = 'uploads/categories/Body-wave.webp',
    `meta_title` = 'Bouncy Body Wave Units',
    `meta_description` = 'Enhance your natural beauty with our voluminous body wave hair. Soft, bouncy waves that maintain their pattern and luster.'
WHERE `id` = 18;

-- Category 3: Pixie cut
UPDATE `categories` SET 
    `id` = 3,
    `name` = 'Pixie cut',
    `description` = 'Chic and effortless tapered pixie cut wigs for a bold, sophisticated aesthetic.',
    `image` = 'uploads/categories/Pixie-cut.webp',
    `meta_title` = 'Chic Pixie Cut Wigs',
    `meta_description` = 'Effortless elegance in a short style. Our tapered pixie cut wigs offer a bold, sophisticated look that\'s easy to maintain.'
WHERE `id` = 19;

-- Category 4: Pixie curls
UPDATE `categories` SET 
    `id` = 4,
    `name` = 'Pixie curls',
    `description` = 'Bouncy and short curly units with high-definition texture.',
    `image` = 'uploads/categories/Pixie-curls.webp',
    `meta_title` = 'Bouncy Pixie Curls',
    `meta_description` = 'Playful and chic short curly units. Manageable, high-definition curls that add texture and personality to your style.'
WHERE `id` = 20;

-- Category 5: Deep wave
UPDATE `categories` SET 
    `id` = 5,
    `name` = 'Deep wave',
    `description` = 'Intense wave pattern delivering maximum volume and defined curls.',
    `image` = 'uploads/categories/Deep-wave.webp',
    `meta_title` = 'Defined Deep Wave Hair',
    `meta_description` = 'Dive into deep texture with our premium deep wave wigs. Intense wave patterns that deliver maximum volume and a stunning ocean-kissed look.'
WHERE `id` = 21;

-- Category 6: Raw hair
UPDATE `categories` SET 
    `id` = 6,
    `name` = 'Raw hair',
    `description` = 'Unprocessed single donor hair offering unmatched longevity and styling versatility.',
    `image` = 'uploads/categories/Raw-hair.webp',
    `meta_title` = 'Premium Raw Donor Hair',
    `meta_description` = 'The pinnacle of hair quality. Unprocessed, single-donor raw hair that offers unmatched longevity, strength, and styling versatility.'
WHERE `id` = 23;

-- Category 7: Blunt cut
UPDATE `categories` SET 
    `id` = 7,
    `name` = 'Blunt cut',
    `description` = 'Sharp, leveled bob styles for a clean, modern, and timeless look.',
    `image` = 'uploads/categories/Blunt-cut.webp',
    `meta_title` = 'Modern Blunt Cut Bobs',
    `meta_description` = 'Sharp, edgy, and timeless. Our blunt cut bob wigs are perfectly leveled for a clean, modern aesthetic that turns heads.'
WHERE `id` = 24;


-- 2. UPDATE PRODUCT REFERENCES
UPDATE `products` SET `category_id` = 2 WHERE `category_id` = 18;
UPDATE `products` SET `category_id` = 3 WHERE `category_id` = 19;
UPDATE `products` SET `category_id` = 4 WHERE `category_id` = 20;
UPDATE `products` SET `category_id` = 5 WHERE `category_id` = 21;
UPDATE `products` SET `category_id` = 6 WHERE `category_id` = 23;
UPDATE `products` SET `category_id` = 7 WHERE `category_id` = 24;


-- 3. SYNC TO MEDIA LIBRARY
-- Removing old potential conflicts first (only if they are in 'categories' folder)
DELETE FROM `media_library` WHERE `folder` = 'categories';

INSERT INTO `media_library` (`file_name`, `original_name`, `file_path`, `folder`, `mime_type`, `extension`, `size_bytes`, `created_at`) 
VALUES 
('Bone-straight.webp', 'Bone-straight.webp', 'uploads/categories/Bone-straight.webp', 'categories', 'image/webp', 'webp', 552245, NOW()),
('Body-wave.webp', 'Body-wave.webp', 'uploads/categories/Body-wave.webp', 'categories', 'image/webp', 'webp', 563942, NOW()),
('Pixie-cut.webp', 'Pixie-cut.webp', 'uploads/categories/Pixie-cut.webp', 'categories', 'image/webp', 'webp', 557350, NOW()),
('Pixie-curls.webp', 'Pixie-curls.webp', 'uploads/categories/Pixie-curls.webp', 'categories', 'image/webp', 'webp', 534015, NOW()),
('Deep-wave.webp', 'Deep-wave.webp', 'uploads/categories/Deep-wave.webp', 'categories', 'image/webp', 'webp', 663050, NOW()),
('Raw-hair.webp', 'Raw-hair.webp', 'uploads/categories/Raw-hair.webp', 'categories', 'image/webp', 'webp', 615095, NOW()),
('Blunt-cut.webp', 'Blunt-cut.webp', 'uploads/categories/Blunt-cut.webp', 'categories', 'image/webp', 'webp', 563309, NOW());


-- 4. UPDATE AUTO_INCREMENT
ALTER TABLE `categories` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

SET SESSION FOREIGN_KEY_CHECKS = 1;
