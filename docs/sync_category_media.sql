-- CATEGORY MEDIA SYNC ONLY
-- Use this if you have already re-indexed IDs but images aren't showing in Media Library.
-- IMPORTANT: Run this entire block at once.

SET SESSION FOREIGN_KEY_CHECKS = 0;

-- 1. Update Category table to use full relative paths
UPDATE categories SET image = 'uploads/categories/Bone-straight.webp' WHERE id = 1;
UPDATE categories SET image = 'uploads/categories/Body-wave.webp' WHERE id = 2;
UPDATE categories SET image = 'uploads/categories/Pixie-cut.webp' WHERE id = 3;
UPDATE categories SET image = 'uploads/categories/Pixie-curls.webp' WHERE id = 4;
UPDATE categories SET image = 'uploads/categories/Deep-wave.webp' WHERE id = 5;
UPDATE categories SET image = 'uploads/categories/Raw-hair.webp' WHERE id = 6;
UPDATE categories SET image = 'uploads/categories/Blunt-cut.webp' WHERE id = 7;

-- 2. Sync to Media Library table
-- Removing old potential conflicts first
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

SET SESSION FOREIGN_KEY_CHECKS = 1;
