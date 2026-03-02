-- SQL Script to Re-index Category IDs to 1-7
-- This script updates both the categories and products tables to maintain relationships.
-- IMPORTANT: Run this entire block together in your SQL runner.

-- Disable foreign key checks for this session
SET SESSION FOREIGN_KEY_CHECKS = 0;

-- 1. Update Categories table IDs FIRST
UPDATE `categories` SET `id` = 2 WHERE `id` = 18;
UPDATE `categories` SET `id` = 3 WHERE `id` = 19;
UPDATE `categories` SET `id` = 4 WHERE `id` = 20;
UPDATE `categories` SET `id` = 5 WHERE `id` = 21;
UPDATE `categories` SET `id` = 6 WHERE `id` = 23;
UPDATE `categories` SET `id` = 7 WHERE `id` = 24;

-- 2. Update Products table references
UPDATE `products` SET `category_id` = 2 WHERE `category_id` = 18;
UPDATE `products` SET `category_id` = 3 WHERE `category_id` = 19;
UPDATE `products` SET `category_id` = 4 WHERE `category_id` = 20;
UPDATE `products` SET `category_id` = 5 WHERE `category_id` = 21;
UPDATE `products` SET `category_id` = 6 WHERE `category_id` = 23;
UPDATE `products` SET `category_id` = 7 WHERE `category_id` = 24;

-- 3. Update any parent_id self-references
UPDATE `categories` SET `parent_id` = 2 WHERE `parent_id` = 18;
UPDATE `categories` SET `parent_id` = 3 WHERE `parent_id` = 19;
UPDATE `categories` SET `parent_id` = 4 WHERE `parent_id` = 20;
UPDATE `categories` SET `parent_id` = 5 WHERE `parent_id` = 21;
UPDATE `categories` SET `parent_id` = 6 WHERE `parent_id` = 23;
UPDATE `categories` SET `parent_id` = 7 WHERE `parent_id` = 24;

-- Re-enable foreign key checks
SET SESSION FOREIGN_KEY_CHECKS = 1;
