-- ==========================================================
-- Fix: Insert missing primary images for 3 products
-- Database: u509059322_hairaura2025
-- Products: Body wave Special (3), Luxe Natural Curls (21),
--           Classic Silky Straight (23)
-- ==========================================================

-- Body wave Special (product_id = 3)
INSERT INTO `product_images` (`product_id`, `image_path`, `alt_text`, `is_primary`, `sort_order`)
VALUES (3, 'Body-wave.webp', 'Body wave Special', 1, 1);

-- Luxe Natural Curls (product_id = 21)
INSERT INTO `product_images` (`product_id`, `image_path`, `alt_text`, `is_primary`, `sort_order`)
VALUES (21, 'Pixie-curls-hair.webp', 'Luxe Natural Curls', 1, 1);

-- Classic Silky Straight (product_id = 23)
INSERT INTO `product_images` (`product_id`, `image_path`, `alt_text`, `is_primary`, `sort_order`)
VALUES (23, 'Straight-hair.webp', 'Classic Silky Straight', 1, 1);

-- Verify the fix worked
SELECT pi.product_id, p.name, pi.image_path, pi.is_primary
FROM product_images pi
JOIN products p ON p.id = pi.product_id
WHERE pi.product_id IN (3, 21, 23)
ORDER BY pi.product_id;

