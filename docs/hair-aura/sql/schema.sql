-- Hair Aura E-Commerce Database Schema
-- Premium Wigs & Hair Extensions for Ghana/Africa Market
-- Created for debesties.com subdomain

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Create database
CREATE DATABASE IF NOT EXISTS hair_aura CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hair_aura;

-- ============================================
-- USERS TABLE
-- ============================================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `avatar` VARCHAR(255) DEFAULT NULL,
    `role` ENUM('customer', 'admin') DEFAULT 'customer',
    `is_active` TINYINT(1) DEFAULT 1,
    `email_verified` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `last_login` DATETIME DEFAULT NULL,
    `remember_token` VARCHAR(255) DEFAULT NULL,
    `remember_expires` DATETIME DEFAULT NULL,
    INDEX `idx_email` (`email`),
    INDEX `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- USER ADDRESSES TABLE
-- ============================================
DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE `user_addresses` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `label` VARCHAR(60) DEFAULT NULL,
    `first_name` VARCHAR(100) DEFAULT NULL,
    `last_name` VARCHAR(100) DEFAULT NULL,
    `phone` VARCHAR(30) DEFAULT NULL,
    `address_line1` VARCHAR(255) NOT NULL,
    `address_line2` VARCHAR(255) DEFAULT NULL,
    `city` VARCHAR(100) NOT NULL,
    `state` VARCHAR(100) DEFAULT NULL,
    `country` VARCHAR(100) NOT NULL DEFAULT 'Ghana',
    `postal_code` VARCHAR(20) DEFAULT NULL,
    `is_default` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX `idx_user_address_user` (`user_id`),
    INDEX `idx_user_address_default` (`user_id`, `is_default`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- CATEGORIES TABLE
-- ============================================
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT,
    `image` VARCHAR(255) DEFAULT NULL,
    `parent_id` INT UNSIGNED DEFAULT NULL,
    `sort_order` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `meta_title` VARCHAR(60) DEFAULT NULL,
    `meta_description` VARCHAR(160) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL,
    INDEX `idx_slug` (`slug`),
    INDEX `idx_parent` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- MEDIA LIBRARY TABLE
-- ============================================
DROP TABLE IF EXISTS `media_library`;
CREATE TABLE `media_library` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `file_name` VARCHAR(255) NOT NULL,
    `original_name` VARCHAR(255) DEFAULT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `folder` VARCHAR(80) NOT NULL DEFAULT 'media',
    `mime_type` VARCHAR(120) DEFAULT NULL,
    `extension` VARCHAR(20) DEFAULT NULL,
    `size_bytes` BIGINT UNSIGNED NOT NULL DEFAULT 0,
    `alt_text` VARCHAR(255) DEFAULT NULL,
    `tags` VARCHAR(255) DEFAULT NULL,
    `created_by` INT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_media_path` (`file_path`),
    INDEX `idx_media_folder` (`folder`),
    INDEX `idx_media_mime` (`mime_type`),
    INDEX `idx_media_created` (`created_at`),
    FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- PRODUCTS TABLE
-- ============================================
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT NOT NULL,
    `short_description` VARCHAR(500) DEFAULT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `sale_price` DECIMAL(10,2) DEFAULT NULL,
    `cost_price` DECIMAL(10,2) DEFAULT NULL,
    `sku` VARCHAR(100) NOT NULL UNIQUE,
    `stock_quantity` INT UNSIGNED DEFAULT 0,
    `stock_status` ENUM('in_stock', 'out_of_stock', 'backorder') DEFAULT 'in_stock',
    `category_id` INT UNSIGNED NOT NULL,
    `brand` VARCHAR(100) DEFAULT NULL,
    `hair_type` ENUM('human_hair', 'synthetic', 'blend') DEFAULT 'human_hair',
    `texture` VARCHAR(50) DEFAULT NULL,
    `length_inches` INT UNSIGNED DEFAULT NULL,
    `weight_grams` INT UNSIGNED DEFAULT NULL,
    `cap_size` VARCHAR(20) DEFAULT NULL,
    `lace_type` VARCHAR(50) DEFAULT NULL,
    `density` VARCHAR(20) DEFAULT NULL,
    `color` VARCHAR(50) DEFAULT NULL,
    `featured` TINYINT(1) DEFAULT 0,
    `bestseller` TINYINT(1) DEFAULT 0,
    `new_arrival` TINYINT(1) DEFAULT 0,
    `rating_avg` DECIMAL(2,1) DEFAULT 0.0,
    `review_count` INT UNSIGNED DEFAULT 0,
    `virtual_try_on` TINYINT(1) DEFAULT 0,
    `meta_title` VARCHAR(60) DEFAULT NULL,
    `meta_description` VARCHAR(160) DEFAULT NULL,
    `meta_keywords` VARCHAR(255) DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT,
    INDEX `idx_slug` (`slug`),
    INDEX `idx_category` (`category_id`),
    INDEX `idx_price` (`price`),
    INDEX `idx_featured` (`featured`),
    INDEX `idx_bestseller` (`bestseller`),
    INDEX `idx_active` (`is_active`),
    INDEX `idx_hair_type` (`hair_type`),
    FULLTEXT INDEX `idx_search` (`name`, `description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- PRODUCT IMAGES TABLE
-- ============================================
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT UNSIGNED NOT NULL,
    `image_path` VARCHAR(255) NOT NULL,
    `alt_text` VARCHAR(255) DEFAULT NULL,
    `is_primary` TINYINT(1) DEFAULT 0,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    INDEX `idx_product` (`product_id`),
    INDEX `idx_primary` (`is_primary`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- PRODUCT VARIANTS TABLE (Colors, Sizes)
-- ============================================
DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT UNSIGNED NOT NULL,
    `variant_name` VARCHAR(100) NOT NULL,
    `variant_value` VARCHAR(100) NOT NULL,
    `sku` VARCHAR(100) NOT NULL,
    `price_adjustment` DECIMAL(10,2) DEFAULT 0.00,
    `stock_quantity` INT UNSIGNED DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_variant_sku` (`sku`),
    INDEX `idx_product_variant` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- CART ITEMS TABLE (For logged-in users)
-- ============================================
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `product_id` INT UNSIGNED NOT NULL,
    `variant_id` INT UNSIGNED DEFAULT NULL,
    `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`variant_id`) REFERENCES `product_variants`(`id`) ON DELETE SET NULL,
    UNIQUE KEY `unique_cart_item` (`user_id`, `product_id`, `variant_id`),
    INDEX `idx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- WISHLIST TABLE
-- ============================================
DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `product_id` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_wishlist` (`user_id`, `product_id`),
    INDEX `idx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- ORDERS TABLE
-- ============================================
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_number` VARCHAR(50) NOT NULL UNIQUE,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `guest_email` VARCHAR(255) DEFAULT NULL,
    `guest_phone` VARCHAR(20) DEFAULT NULL,
    `status` ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded') DEFAULT 'pending',
    `payment_status` ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    `payment_method` VARCHAR(50) DEFAULT NULL,
    `payment_reference` VARCHAR(255) DEFAULT NULL,
    `subtotal` DECIMAL(10,2) NOT NULL,
    `shipping_cost` DECIMAL(10,2) DEFAULT 0.00,
    `tax_amount` DECIMAL(10,2) DEFAULT 0.00,
    `discount_amount` DECIMAL(10,2) DEFAULT 0.00,
    `total` DECIMAL(10,2) NOT NULL,
    `currency` VARCHAR(3) DEFAULT 'GHS',
    `shipping_first_name` VARCHAR(100) DEFAULT NULL,
    `shipping_last_name` VARCHAR(100) DEFAULT NULL,
    `shipping_address` TEXT DEFAULT NULL,
    `shipping_city` VARCHAR(100) DEFAULT NULL,
    `shipping_state` VARCHAR(100) DEFAULT NULL,
    `shipping_country` VARCHAR(100) DEFAULT 'Ghana',
    `shipping_postal_code` VARCHAR(20) DEFAULT NULL,
    `shipping_phone` VARCHAR(20) DEFAULT NULL,
    `billing_same_as_shipping` TINYINT(1) DEFAULT 1,
    `notes` TEXT DEFAULT NULL,
    `tracking_number` VARCHAR(100) DEFAULT NULL,
    `shipped_at` DATETIME DEFAULT NULL,
    `delivered_at` DATETIME DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_order_number` (`order_number`),
    INDEX `idx_user` (`user_id`),
    INDEX `idx_status` (`status`),
    INDEX `idx_payment_status` (`payment_status`),
    INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- ORDER ITEMS TABLE
-- ============================================
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT UNSIGNED NOT NULL,
    `product_id` INT UNSIGNED NOT NULL,
    `variant_id` INT UNSIGNED DEFAULT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `variant_name` VARCHAR(255) DEFAULT NULL,
    `sku` VARCHAR(100) NOT NULL,
    `quantity` INT UNSIGNED NOT NULL,
    `unit_price` DECIMAL(10,2) NOT NULL,
    `total_price` DECIMAL(10,2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT,
    INDEX `idx_order` (`order_id`),
    INDEX `idx_product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- REVIEWS TABLE
-- ============================================
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `order_id` INT UNSIGNED DEFAULT NULL,
    `rating` TINYINT UNSIGNED NOT NULL CHECK (`rating` BETWEEN 1 AND 5),
    `title` VARCHAR(255) DEFAULT NULL,
    `comment` TEXT NOT NULL,
    `is_verified_purchase` TINYINT(1) DEFAULT 0,
    `is_approved` TINYINT(1) DEFAULT 0,
    `helpful_count` INT UNSIGNED DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE SET NULL,
    INDEX `idx_product` (`product_id`),
    INDEX `idx_user` (`user_id`),
    INDEX `idx_approved` (`is_approved`),
    INDEX `idx_rating` (`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TESTIMONIALS TABLE (Homepage)
-- ============================================
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `customer_name` VARCHAR(100) NOT NULL,
    `customer_location` VARCHAR(100) DEFAULT NULL,
    `customer_avatar` VARCHAR(255) DEFAULT NULL,
    `rating` TINYINT UNSIGNED DEFAULT 5,
    `title` VARCHAR(255) DEFAULT NULL,
    `content` TEXT NOT NULL,
    `is_featured` TINYINT(1) DEFAULT 0,
    `sort_order` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_featured` (`is_featured`),
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- BLOG POSTS TABLE
-- ============================================
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `excerpt` TEXT DEFAULT NULL,
    `content` LONGTEXT NOT NULL,
    `featured_image` VARCHAR(255) DEFAULT NULL,
    `author_id` INT UNSIGNED NOT NULL,
    `category` VARCHAR(100) DEFAULT 'General',
    `tags` VARCHAR(255) DEFAULT NULL,
    `meta_title` VARCHAR(60) DEFAULT NULL,
    `meta_description` VARCHAR(160) DEFAULT NULL,
    `view_count` INT UNSIGNED DEFAULT 0,
    `is_published` TINYINT(1) DEFAULT 0,
    `published_at` DATETIME DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT,
    INDEX `idx_slug` (`slug`),
    INDEX `idx_published` (`is_published`),
    INDEX `idx_category` (`category`),
    FULLTEXT INDEX `idx_search` (`title`, `content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- NEWSLETTER SUBSCRIBERS TABLE
-- ============================================
DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE `newsletter_subscribers` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `first_name` VARCHAR(100) DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `subscribed_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `unsubscribed_at` DATETIME DEFAULT NULL,
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- STOCK ALERTS TABLE
-- ============================================
DROP TABLE IF EXISTS `stock_alerts`;
CREATE TABLE `stock_alerts` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT UNSIGNED NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `is_notified` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `notified_at` DATETIME DEFAULT NULL,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    INDEX `idx_product` (`product_id`),
    INDEX `idx_notified` (`is_notified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- COUPONS TABLE
-- ============================================
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `description` VARCHAR(255) DEFAULT NULL,
    `discount_type` ENUM('percentage', 'fixed') NOT NULL,
    `discount_value` DECIMAL(10,2) NOT NULL,
    `min_order_amount` DECIMAL(10,2) DEFAULT NULL,
    `max_discount` DECIMAL(10,2) DEFAULT NULL,
    `usage_limit` INT UNSIGNED DEFAULT NULL,
    `usage_count` INT UNSIGNED DEFAULT 0,
    `starts_at` DATETIME DEFAULT NULL,
    `expires_at` DATETIME DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_code` (`code`),
    INDEX `idx_active` (`is_active`),
    INDEX `idx_expires` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- CONTACT MESSAGES TABLE
-- ============================================
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(120) NOT NULL,
    `email` VARCHAR(190) NOT NULL,
    `phone` VARCHAR(30) DEFAULT NULL,
    `subject` VARCHAR(190) NOT NULL,
    `message` TEXT NOT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_created_at` (`created_at`),
    INDEX `idx_is_read` (`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- NOTES TABLE (Admin Draft Notes)
-- ============================================
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `admin_id` INT UNSIGNED NOT NULL,
    `title` VARCHAR(190) NOT NULL,
    `content` TEXT NOT NULL,
    `is_pinned` TINYINT(1) DEFAULT 0,
    `is_archived` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT NULL,
    FOREIGN KEY (`admin_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX `idx_admin` (`admin_id`),
    INDEX `idx_archived` (`is_archived`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- ACTIVITY LOG TABLE (Admin)
-- ============================================
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `action` VARCHAR(100) NOT NULL,
    `entity_type` VARCHAR(50) DEFAULT NULL,
    `entity_id` INT UNSIGNED DEFAULT NULL,
    `details` TEXT DEFAULT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `user_agent` TEXT DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_user` (`user_id`),
    INDEX `idx_action` (`action`),
    INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
