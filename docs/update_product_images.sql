-- SQL Update Script for Hair Aura Product Images
-- This script updates image references from .jpeg to .webp to match the new high-quality assets.

START TRANSACTION;

-- Update Blog Posts
UPDATE `blog_posts` 
SET `featured_image` = 'uploads/products/Bone-straight.webp' 
WHERE `featured_image` = 'uploads/products/Bone-straight.jpeg';

-- Update Categories
UPDATE `categories` 
SET `image` = 'Bone-straight.webp' 
WHERE `image` = 'Bone-straight.jpeg';

-- Update Media Library
UPDATE `media_library` 
SET `file_name` = 'Bone-straight.webp', 
    `file_path` = 'uploads/products/Bone-straight.webp',
    `mime_type` = 'image/webp',
    `extension` = 'webp'
WHERE `id` = 74 AND `file_name` = 'Bone-straight.jpeg';

-- Update Product Images
UPDATE `product_images` 
SET `image_path` = 'uploads/products/Bone-straight.webp' 
WHERE `image_path` = 'uploads/products/Bone-straight.jpeg';

UPDATE `product_images` 
SET `image_path` = 'Bone-straight.webp' 
WHERE `image_path` = 'Bone-straight.jpeg';

COMMIT;
