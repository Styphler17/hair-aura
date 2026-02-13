-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 11, 2026 at 09:31 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u509059322_hairaura2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) DEFAULT 'General',
  `tags` varchar(255) DEFAULT NULL,
  `meta_title` varchar(60) DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `view_count` int(10) UNSIGNED DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `category`, `tags`, `meta_title`, `meta_description`, `view_count`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'How to Care for Your Human Hair Wig', 'how-to-care-human-hair-wig', 'Learn the essential tips for maintaining your human hair wig to ensure it lasts for years.', '<h2>Proper Care Makes All the Difference</h2>\r\n<p>Investing in a quality human hair wig is just the first step. Proper care and maintenance are essential to ensure your wig stays beautiful and lasts for years to come.</p>\r\n\r\n<h3>Washing Your Wig</h3>\r\n<p>Wash your human hair wig every 7-10 wears, or when product buildup becomes noticeable:</p>\r\n<ul>\r\n<li>Use sulfate-free shampoo and conditioner</li>\r\n<li>Detangle gently before washing</li>\r\n<li>Wash in cool water, never hot</li>\r\n<li>Pat dry with a towel - never rub</li>\r\n<li>Air dry on a wig stand</li>\r\n</ul>\r\n\r\n<h3>Styling Tips</h3>\r\n<p>Human hair wigs can be styled just like your natural hair:</p>\r\n<ul>\r\n<li>Always use heat protectant before styling</li>\r\n<li>Keep heat tools below 180°C</li>\r\n<li>Deep condition monthly</li>\r\n<li>Store on a wig stand when not in use</li>\r\n</ul>\r\n\r\n<h3>Nighttime Care</h3>\r\n<p>Never sleep in your wig! Remove it before bed and store properly to maintain its shape and prevent tangling.</p>\r\n\r\n<p>Follow these tips and your Hair Aura wig will maintain its beauty for years!</p>', NULL, 1, 'Wig Care', 'wig care, human hair, maintenance, washing', 'How to Care for Human Hair Wig Ghana | Hair Aura', 'Learn essential tips for caring for your human hair wig. Washing, styling, and maintenance guide from Hair Aura.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(2, 'Choosing the Right Wig for Your Face Shape', 'choosing-wig-face-shape', 'Find the perfect wig style that complements your unique face shape.', '<h2>The Perfect Wig for Every Face</h2>\r\n<p>Not all wigs suit every face shape. Understanding your face shape is key to choosing a wig that enhances your natural beauty.</p>\r\n\r\n<h3>Oval Face Shape</h3>\r\n<p>Lucky you! Oval faces can pull off almost any wig style. Try:</p>\r\n<ul>\r\n<li>Long layers</li>\r\n<li>Bob cuts</li>\r\n<li>Curly or straight styles</li>\r\n</ul>\r\n\r\n<h3>Round Face Shape</h3>\r\n<p>Create the illusion of length with:</p>\r\n<ul>\r\n<li>Long, layered wigs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Height at the crown</li>\r\n<li>Avoid chin-length bobs</li>\r\n</ul>\r\n\r\n<h3>Square Face Shape</h3>\r\n<p>Soften angular features with:</p>\r\n<ul>\r\n<li>Wavy or curly textures</li>\r\n<li>Side parts</li>\r\n<li>Layers around the face</li>\r\n<li>Avoid blunt cuts</li>\r\n</ul>\r\n\r\n<h3>Heart Face Shape</h3>\r\n<p>Balance a wider forehead with:</p>\r\n<ul>\r\n<li>Chin-length bobs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Volume at the jawline</li>\r\n</ul>\r\n\r\n<p>Visit Hair Aura to find your perfect wig match!</p>', NULL, 1, 'Wig Guide', 'face shape, wig selection, styling tips', 'Choose Wig for Face Shape Ghana | Hair Aura Guide', 'Find the perfect wig for your face shape. Expert guide from Hair Aura on selecting flattering wig styles.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(3, 'Lace Front vs Full Lace Wigs: What\'s the Difference?', 'lace-front-vs-full-lace', 'Understanding the differences between lace front and full lace wigs to make the right choice.', '<h2>Lace Front vs Full Lace: The Breakdown</h2>\r\n<p>When shopping for wigs, you\'ll often see \"lace front\" and \"full lace\" options. But what\'s the difference, and which is right for you?</p>\r\n\r\n<h3>Lace Front Wigs</h3>\r\n<p>Lace front wigs have lace only at the front hairline:</p>\r\n<ul>\r\n<li>More affordable</li>\r\n<li>Natural-looking hairline</li>\r\n<li>Cannot be parted everywhere</li>\r\n<li>Less styling versatility</li>\r\n<li>More durable construction</li>\r\n</ul>\r\n\r\n<h3>Full Lace Wigs</h3>\r\n<p>Full lace wigs have lace covering the entire cap:</p>\r\n<ul>\r\n<li>Can be parted anywhere</li>\r\n<li>Can be worn in high ponytails</li>\r\n<li>More breathable</li>\r\n<li>Higher price point</li>\r\n<li>Requires more careful handling</li>\r\n</ul>\r\n\r\n<h3>Which Should You Choose?</h3>\r\n<p>Choose lace front if you:</p>\r\n<ul>\r\n<li>Want a natural look on a budget</li>\r\n<li>Don\'t need high ponytail styles</li>\r\n<li>Want a more durable option</li>\r\n</ul>\r\n\r\n<p>Choose full lace if you:</p>\r\n<ul>\r\n<li>Want maximum styling versatility</li>\r\n<li>Wear high ponytails or updos</li>\r\n<li>Prioritize breathability</li>\r\n</ul>\r\n\r\n<p>Hair Aura offers both options to suit your needs and budget!</p>', NULL, 1, 'Wig Education', 'lace front, full lace, wig types, comparison', 'Lace Front vs Full Lace Wigs Ghana | Hair Aura', 'Understand the difference between lace front and full lace wigs. Expert comparison from Hair Aura.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(4, '5 Trending Wig Styles for 2024', 'trending-wig-styles-2024', 'Discover the hottest wig trends taking Ghana and Africa by storm this year.', '<h2>2024 Wig Trends You Need to Know</h2>\r\n<p>The wig industry is constantly evolving, and 2024 brings exciting new trends. Here are the top 5 styles dominating the Ghana and African markets:</p>\r\n\r\n<h3>1. The Wet Look</h3>\r\n<p>Water wave and deep wave wigs styled to look wet are everywhere. This sleek, glossy look is perfect for both casual and formal occasions.</p>\r\n\r\n<h3>2. Bold Colors</h3>\r\n<p>From honey blonde to burgundy to fashion colors, bold is beautiful. More women are experimenting with colored wigs to express their personality.</p>\r\n\r\n<h3>3. The Modern Bob</h3>\r\n<p>The classic bob gets an update with blunt cuts, asymmetrical lines, and textured ends. It\'s chic, professional, and low maintenance.</p>\r\n\r\n<h3>4. Kinky Textures</h3>\r\n<p>Embracing natural textures is a major trend. Kinky straight and Afro-textured wigs that blend with natural hair are in high demand.</p>\r\n\r\n<h3>5. HD Lace Everything</h3>\r\n<p>HD lace wigs that melt into any skin tone are becoming the standard. The undetectable finish is a game-changer.</p>\r\n\r\n<p>Shop all these trending styles at Hair Aura and stay ahead of the fashion curve!</p>', NULL, 1, 'Trends', 'wig trends 2024, fashion, styles, Ghana', 'Trending Wig Styles 2024 Ghana | Hair Aura', 'Discover 2024\'s hottest wig trends in Ghana. Water waves, bold colors, modern bobs and more at Hair Aura.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(5, 'How to Secure Your Lace Front Wig', 'secure-lace-front-wig', 'Expert tips for keeping your lace front wig secure and comfortable all day long.', '<h2>Keep Your Wig Secure All Day</h2>\r\n<p>Nothing is more frustrating than a shifting wig. Here are professional tips to keep your lace front wig secure:</p>\r\n\r\n<h3>Preparation is Key</h3>\r\n<ul>\r\n<li>Start with clean, dry skin</li>\r\n<li>Use alcohol to remove oils from hairline</li>\r\n<li>Protect your edges with a wig grip</li>\r\n</ul>\r\n\r\n<h3>Application Techniques</h3>\r\n<ul>\r\n<li>Use quality adhesive or wig tape</li>\r\n<li>Apply thin, even layers of glue</li>\r\n<li>Wait for adhesive to get tacky before applying</li>\r\n<li>Press lace firmly into place</li>\r\n<li>Tie down with a scarf for 10-15 minutes</li>\r\n</ul>\r\n\r\n<h3>Maintenance Throughout the Day</h3>\r\n<ul>\r\n<li>Avoid excessive sweating when possible</li>\r\n<li>Carry blotting papers for oily skin</li>\r\n<li>Keep a small emergency kit with extra tape</li>\r\n</ul>\r\n\r\n<h3>Removal</h3>\r\n<p>Always use proper adhesive remover and be gentle with your edges. Never rip the wig off!</p>\r\n\r\n<p>Shop wig adhesives and accessories at Hair Aura for the best hold.</p>', NULL, 1, 'Wig Tips', 'lace front, wig security, adhesive, application', 'Secure Lace Front Wig Ghana | Hair Aura Tips', 'Learn how to secure your lace front wig. Professional application tips from Hair Aura.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `meta_title` varchar(60) DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `parent_id`, `sort_order`, `is_active`, `meta_title`, `meta_description`, `created_at`) VALUES
(1, 'Human Hair Wigs', 'human-hair-wigs', 'Premium 100% human hair wigs for natural look and feel. Available in various textures, lengths, and styles.', 'category-human-hair.jpg', NULL, 1, 1, 'Buy Human Hair Wigs Ghana | Premium Quality', 'Shop authentic human hair wigs in Ghana. Brazilian, Peruvian, and Indian hair. Free delivery in Accra.', '2026-02-11 20:33:35'),
(2, 'Lace Front Wigs', 'lace-front-wigs', 'Beautiful lace front wigs with natural hairline. HD lace, transparent lace options available.', 'category-lace-front.jpg', NULL, 2, 1, 'Lace Front Wigs Ghana | Natural Hairline', 'Get natural-looking lace front wigs in Ghana. HD lace, 13x4 and 13x6 lace fronts.', '2026-02-11 20:33:35'),
(3, 'Synthetic Wigs', 'synthetic-wigs', 'Affordable synthetic wigs in trendy styles. Heat-resistant fibers, easy maintenance.', 'category-synthetic.jpg', NULL, 3, 1, 'Synthetic Wigs Ghana | Affordable Styles', 'Shop affordable synthetic wigs in Ghana. Heat-resistant, trendy styles, budget-friendly.', '2026-02-11 20:33:35'),
(4, 'Hair Extensions', 'hair-extensions', 'Premium hair extensions - weaves, bundles, clip-ins. 100% virgin human hair.', 'category-extensions.jpg', NULL, 4, 1, 'Hair Extensions Ghana | Virgin Hair Bundles', 'Buy virgin hair extensions in Ghana. Brazilian, Peruvian bundles. Wholesale available.', '2026-02-11 20:33:35'),
(5, 'Hair Toppers', 'hair-toppers', 'Hair toppers and closures for added volume. Perfect for thinning hair solutions.', 'category-toppers.jpg', NULL, 5, 1, 'Hair Toppers Ghana | Volume Solutions', 'Hair toppers for volume and coverage. Closures, frontals, and crown toppers.', '2026-02-11 20:33:35'),
(6, 'Hair Accessories', 'hair-accessories', 'Wig care products, caps, adhesives, and styling tools.', 'category-accessories.jpg', NULL, 6, 1, 'Wig Accessories Ghana | Care Products', 'Wig care products, adhesives, caps, and styling tools. Everything for wig maintenance.', '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT NULL,
  `max_discount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(10) UNSIGNED DEFAULT NULL,
  `usage_count` int(10) UNSIGNED DEFAULT 0,
  `starts_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `description`, `discount_type`, `discount_value`, `min_order_amount`, `max_discount`, `usage_limit`, `usage_count`, `starts_at`, `expires_at`, `is_active`, `created_at`) VALUES
(1, 'WELCOME10', '10% off first order', 'percentage', 10.00, 50.00, 50.00, 100, 0, '2026-02-11 20:33:35', '2026-05-12 20:33:35', 1, '2026-02-11 20:33:35'),
(2, 'AURA20', '20% off orders over GH₵150', 'percentage', 20.00, 150.00, 75.00, 50, 0, '2026-02-11 20:33:35', '2026-03-13 20:33:35', 1, '2026-02-11 20:33:35'),
(3, 'FREESHIP', 'Free shipping on orders over GH₵100', 'fixed', 15.00, 100.00, 15.00, 200, 0, '2026-02-11 20:33:35', '2026-04-12 20:33:35', 1, '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `subscribed_at` timestamp NULL DEFAULT current_timestamp(),
  `unsubscribed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `first_name`, `is_active`, `subscribed_at`, `unsubscribed_at`) VALUES
(1, 'subscriber1@email.com', 'Grace', 1, '2026-02-11 20:33:35', NULL),
(2, 'subscriber2@email.com', 'Priscilla', 1, '2026-02-11 20:33:35', NULL),
(3, 'subscriber3@email.com', 'Esther', 1, '2026-02-11 20:33:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `guest_phone` varchar(20) DEFAULT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled','refunded') DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) DEFAULT 0.00,
  `tax_amount` decimal(10,2) DEFAULT 0.00,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'GHS',
  `shipping_first_name` varchar(100) DEFAULT NULL,
  `shipping_last_name` varchar(100) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_country` varchar(100) DEFAULT 'Ghana',
  `shipping_postal_code` varchar(20) DEFAULT NULL,
  `shipping_phone` varchar(20) DEFAULT NULL,
  `billing_same_as_shipping` tinyint(1) DEFAULT 1,
  `notes` text DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `sku` varchar(100) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `sku` varchar(100) NOT NULL,
  `stock_quantity` int(10) UNSIGNED DEFAULT 0,
  `stock_status` enum('in_stock','out_of_stock','backorder') DEFAULT 'in_stock',
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `hair_type` enum('human_hair','synthetic','blend') DEFAULT 'human_hair',
  `texture` varchar(50) DEFAULT NULL,
  `length_inches` int(10) UNSIGNED DEFAULT NULL,
  `weight_grams` int(10) UNSIGNED DEFAULT NULL,
  `cap_size` varchar(20) DEFAULT NULL,
  `lace_type` varchar(50) DEFAULT NULL,
  `density` varchar(20) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `bestseller` tinyint(1) DEFAULT 0,
  `new_arrival` tinyint(1) DEFAULT 0,
  `rating_avg` decimal(2,1) DEFAULT 0.0,
  `review_count` int(10) UNSIGNED DEFAULT 0,
  `virtual_try_on` tinyint(1) DEFAULT 0,
  `meta_title` varchar(60) DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `short_description`, `price`, `sale_price`, `cost_price`, `sku`, `stock_quantity`, `stock_status`, `category_id`, `brand`, `hair_type`, `texture`, `length_inches`, `weight_grams`, `cap_size`, `lace_type`, `density`, `color`, `featured`, `bestseller`, `new_arrival`, `rating_avg`, `review_count`, `virtual_try_on`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Brazilian Body Wave Lace Front Wig', 'brazilian-body-wave-lace-front', '<p>Experience the luxury of 100% Brazilian virgin hair with our Body Wave Lace Front Wig. This stunning wig features:</p>\r\n<ul>\r\n<li>100% unprocessed Brazilian human hair</li>\r\n<li>Natural body wave pattern</li>\r\n<li>13x4 HD transparent lace frontal</li>\r\n<li>Pre-plucked hairline with baby hairs</li>\r\n<li>180% density for full, voluminous look</li>\r\n<li>Can be dyed, bleached, and heat styled</li>\r\n<li>Natural black color (1B)</li>\r\n<li>Adjustable straps and combs for secure fit</li>\r\n</ul>\r\n<p>Perfect for everyday wear or special occasions. The body wave texture gives you that glamorous, red-carpet look while maintaining a natural appearance. Our HD lace melts into any skin tone for an undetectable finish.</p>\r\n<p><strong>Care Instructions:</strong> Wash with sulfate-free shampoo, condition regularly, and air dry for best results. Use heat protectant when styling.</p>', '100% Brazilian virgin hair body wave wig with HD lace frontal. 180% density, pre-plucked hairline.', 185.00, 159.99, NULL, 'BW-BODY-18', 25, 'in_stock', 1, 'Hair Aura', 'human_hair', 'body_wave', 18, 250, 'medium', 'hd_lace', '180%', '1B Natural Black', 1, 1, 0, 0.0, 0, 0, 'Brazilian Body Wave Wig Ghana | HD Lace Front', 'Buy Brazilian body wave lace front wig in Ghana. 100% virgin hair, HD lace, 180% density. Free delivery in Accra.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(2, 'Peruvian Straight Lace Front Wig', 'peruvian-straight-lace-front', '<p>Achieve sleek, sophisticated style with our Peruvian Straight Lace Front Wig. Features include:</p>\r\n<ul>\r\n<li>100% Peruvian virgin human hair</li>\r\n<li>Silky straight texture</li>\r\n<li>13x6 deep part lace frontal</li>\r\n<li>Pre-plucked with natural baby hairs</li>\r\n<li>150% density</li>\r\n<li>Tangle-free and minimal shedding</li>\r\n<li>Can be flat ironed and curled</li>\r\n<li>Medium cap size with adjustable bands</li>\r\n</ul>\r\n<p>The Peruvian straight texture is known for its softness and natural shine. This wig is perfect for professional settings or when you want a polished, elegant look.</p>', 'Sleek Peruvian straight wig with 13x6 deep part lace. Silky, soft, and tangle-free.', 165.00, NULL, NULL, 'PW-STRAIGHT-20', 18, 'in_stock', 1, 'Hair Aura', 'human_hair', 'straight', 20, 280, 'medium', 'transparent_lace', '150%', '1B Natural Black', 1, 0, 1, 0.0, 0, 0, 'Peruvian Straight Wig Ghana | Deep Part Lace', 'Shop Peruvian straight lace front wig in Ghana. 13x6 deep part, silky texture. Premium quality hair.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(3, 'Deep Curly Human Hair Wig', 'deep-curly-human-hair-wig', '<p>Embrace your curls with our gorgeous Deep Curly Human Hair Wig:</p>\r\n<ul>\r\n<li>100% Brazilian virgin hair</li>\r\n<li>Deep curly/water wave pattern</li>\r\n<li>4x4 lace closure</li>\r\n<li>200% density for maximum volume</li>\r\n<li>Bleached knots for natural scalp appearance</li>\r\n<li>Can be straightened and will return to curl</li>\r\n<li>Free parting for versatile styling</li>\r\n</ul>\r\n<p>This wig is perfect for those who love big, beautiful curls. The deep curly pattern gives you that tropical, beach-ready look all year round.</p>', 'Voluminous deep curly wig with 4x4 lace closure. 200% density for maximum curl definition.', 195.00, 175.00, NULL, 'BW-CURLY-22', 15, 'in_stock', 1, 'Hair Aura', 'human_hair', 'deep_curly', 22, 320, 'medium', 'lace_closure', '200%', '1B Natural Black', 1, 1, 0, 0.0, 0, 0, 'Deep Curly Wig Ghana | 200% Density', 'Buy deep curly human hair wig in Ghana. 200% density, 4x4 closure. Big, beautiful curls.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(4, 'Kinky Straight Lace Wig', 'kinky-straight-lace-wig', '<p>Get that blown-out natural look with our Kinky Straight Lace Wig:</p>\r\n<ul>\r\n<li>100% human hair with kinky straight texture</li>\r\n<li>Mimics natural Afro hair when blow-dried</li>\r\n<li>13x4 lace frontal</li>\r\n<li>180% density</li>\r\n<li>Pre-plucked hairline</li>\r\n<li>Can be curled for versatile styling</li>\r\n</ul>\r\n<p>Perfect for those who want a natural, textured look that blends seamlessly with African hair types.</p>', 'Natural kinky straight texture wig. Mimics blown-out Afro hair. 13x4 lace frontal.', 175.00, NULL, NULL, 'BW-KINKY-16', 20, 'in_stock', 1, 'Hair Aura', 'human_hair', 'kinky_straight', 16, 240, 'medium', 'hd_lace', '180%', '1B Natural Black', 0, 1, 0, 0.0, 0, 0, 'Kinky Straight Wig Ghana | Natural Texture', 'Shop kinky straight lace wig in Ghana. Natural blown-out look. Perfect for African hair texture.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(5, 'Blonde Highlight Body Wave Wig', 'blonde-highlight-body-wave', '<p>Make a statement with our Blonde Highlight Body Wave Wig:</p>\r\n<ul>\r\n<li>100% Brazilian human hair</li>\r\n<li>Beautiful blonde highlights on brown base</li>\r\n<li>13x4 lace frontal</li>\r\n<li>150% density</li>\r\n<li>Pre-colored, ready to wear</li>\r\n<li>Can be restyled with heat tools</li>\r\n</ul>\r\n<p>This stunning highlighted wig is perfect for those who want to experiment with color without damaging their natural hair.</p>', 'Stunning blonde highlight wig with body wave texture. Pre-colored and ready to wear.', 210.00, 189.99, NULL, 'BW-HIGHLIGHT-18', 12, 'in_stock', 1, 'Hair Aura', 'human_hair', 'body_wave', 18, 260, 'medium', 'transparent_lace', '150%', 'P4/27 Highlight', 1, 0, 1, 0.0, 0, 0, 'Blonde Highlight Wig Ghana | Colored Hair', 'Buy blonde highlight body wave wig in Ghana. Pre-colored, no damage to natural hair.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(6, 'HD Transparent Lace Frontal Wig', 'hd-transparent-lace-frontal', '<p>The ultimate in undetectable wigs - our HD Transparent Lace Frontal:</p>\r\n<ul>\r\n<li>HD lace that melts into any skin tone</li>\r\n<li>100% virgin human hair</li>\r\n<li>13x6 frontal for deep parting</li>\r\n<li>200% density</li>\r\n<li>Invisible knots</li>\r\n<li>Can be parted anywhere</li>\r\n</ul>\r\n<p>Our HD lace is the most advanced lace technology, virtually invisible on all skin tones.</p>', 'HD transparent lace wig that melts into any skin tone. 13x6 frontal, 200% density.', 245.00, 219.99, NULL, 'HD-FRONTAL-20', 10, 'in_stock', 2, 'Hair Aura', 'human_hair', 'straight', 20, 300, 'medium', 'hd_lace', '200%', '1B Natural Black', 1, 0, 1, 0.0, 0, 0, 'HD Lace Wig Ghana | Transparent Lace', 'Shop HD transparent lace frontal wig in Ghana. Melts into any skin tone. Undetectable lace.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(7, '360 Lace Frontal Wig', '360-lace-frontal-wig', '<p>Style your hair in any direction with our 360 Lace Frontal Wig:</p>\r\n<ul>\r\n<li>Lace all around the perimeter</li>\r\n<li>Can be worn in high ponytails</li>\r\n<li>100% Brazilian virgin hair</li>\r\n<li>Body wave texture</li>\r\n<li>150% density</li>\r\n<li>Adjustable straps inside</li>\r\n</ul>\r\n<p>The 360 lace design gives you maximum styling versatility - high ponytails, updos, half-up styles, and more.</p>', '360 lace wig for versatile styling. Wear in high ponytails. Lace all around perimeter.', 225.00, NULL, NULL, '360-LACE-18', 14, 'in_stock', 2, 'Hair Aura', 'human_hair', 'body_wave', 18, 280, 'medium', 'transparent_lace', '150%', '1B Natural Black', 0, 1, 0, 0.0, 0, 0, '360 Lace Wig Ghana | Ponytail Ready', 'Buy 360 lace frontal wig in Ghana. High ponytail ready. Full perimeter lace.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(8, 'Bob Lace Front Wig', 'bob-lace-front-wig', '<p>Chic and stylish Bob Lace Front Wig:</p>\r\n<ul>\r\n<li>100% human hair</li>\r\n<li>12-inch bob cut</li>\r\n<li>13x4 lace frontal</li>\r\n<li>Blunt cut or layered options</li>\r\n<li>130% density</li>\r\n<li>Low maintenance</li>\r\n</ul>\r\n<p>The perfect bob wig for a sophisticated, professional look. Easy to maintain and style.</p>', 'Chic bob wig with lace frontal. 12 inches, professional style. Low maintenance.', 145.00, 129.99, NULL, 'BOB-LACE-12', 22, 'in_stock', 2, 'Hair Aura', 'human_hair', 'straight', 12, 180, 'medium', 'transparent_lace', '130%', '1B Natural Black', 1, 1, 0, 0.0, 0, 0, 'Bob Wig Ghana | Lace Front Short Hair', 'Shop bob lace front wig in Ghana. 12-inch chic cut. Professional style.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(9, 'Water Wave Lace Front Wig', 'water-wave-lace-front', '<p>Beautiful Water Wave Lace Front Wig:</p>\r\n<ul>\r\n<li>100% virgin human hair</li>\r\n<li>Water wave pattern</li>\r\n<li>13x4 lace frontal</li>\r\n<li>180% density</li>\r\n<li>Natural wet look</li>\r\n<li>Can be straightened</li>\r\n</ul>\r\n<p>The water wave pattern gives you that beautiful \"wet hair\" look that\'s so popular right now.</p>', 'Water wave pattern wig with wet look. 13x4 lace frontal, 180% density.', 195.00, NULL, NULL, 'WW-LACE-20', 16, 'in_stock', 2, 'Hair Aura', 'human_hair', 'water_wave', 20, 290, 'medium', 'transparent_lace', '180%', '1B Natural Black', 0, 0, 1, 0.0, 0, 0, 'Water Wave Wig Ghana | Wet Look', 'Buy water wave lace front wig in Ghana. Beautiful wet hair look. Trendy style.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(10, 'Heat Resistant Synthetic Curly Wig', 'heat-resistant-synthetic-curly', '<p>Affordable beauty with our Heat Resistant Synthetic Curly Wig:</p>\r\n<ul>\r\n<li>High-quality heat-resistant fiber</li>\r\n<li>Can withstand heat up to 180°C</li>\r\n<li>Beautiful curly pattern</li>\r\n<li>Adjustable cap</li>\r\n<li>Multiple color options</li>\r\n<li>Easy maintenance</li>\r\n</ul>\r\n<p>Perfect for trying new styles without breaking the bank. The heat-resistant fiber allows for some styling versatility.</p>', 'Heat-resistant synthetic curly wig. Up to 180°C styling. Affordable and stylish.', 65.00, 49.99, NULL, 'SYN-CURLY-16', 35, 'in_stock', 3, 'Hair Aura', 'synthetic', 'curly', 16, 200, 'average', NULL, NULL, '1B', 1, 1, 0, 0.0, 0, 0, 'Synthetic Curly Wig Ghana | Heat Resistant', 'Shop heat-resistant synthetic curly wig in Ghana. Affordable, trendy styles.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(11, 'Long Straight Synthetic Wig', 'long-straight-synthetic', '<p>Glamorous long straight synthetic wig:</p>\r\n<ul>\r\n<li>High-quality synthetic fiber</li>\r\n<li>26 inches long</li>\r\n<li>Yaki texture for natural look</li>\r\n<li>Adjustable straps</li>\r\n<li>Natural black color</li>\r\n</ul>\r\n<p>Get that long, sleek look instantly with this affordable synthetic option.</p>', '26-inch long straight synthetic wig. Yaki texture for natural appearance.', 75.00, NULL, NULL, 'SYN-LONG-26', 28, 'in_stock', 3, 'Hair Aura', 'synthetic', 'straight', 26, 250, 'average', NULL, NULL, '1B', 0, 0, 1, 0.0, 0, 0, 'Long Synthetic Wig Ghana | 26 Inch', 'Buy long straight synthetic wig in Ghana. 26 inches, yaki texture. Budget-friendly.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(12, 'Short Pixie Synthetic Wig', 'short-pixie-synthetic', '<p>Bold and beautiful Short Pixie Wig:</p>\r\n<ul>\r\n<li>High-quality synthetic fiber</li>\r\n<li>Pixie cut style</li>\r\n<li>Multiple color options</li>\r\n<li>Ready to wear</li>\r\n<li>Lightweight and comfortable</li>\r\n</ul>\r\n<p>Perfect for summer or when you want a bold, low-maintenance look.</p>', 'Bold pixie cut synthetic wig. Short, stylish, and easy to maintain.', 55.00, 45.00, NULL, 'SYN-PIXIE-8', 40, 'in_stock', 3, 'Hair Aura', 'synthetic', 'straight', 8, 120, 'average', NULL, NULL, '1B', 1, 0, 0, 0.0, 0, 0, 'Pixie Wig Ghana | Short Synthetic Hair', 'Shop short pixie synthetic wig in Ghana. Bold style, easy maintenance.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(13, 'Ombre Synthetic Wig', 'ombre-synthetic-wig', '<p>Trendy ombre color synthetic wig:</p>\r\n<ul>\r\n<li>Beautiful ombre color transition</li>\r\n<li>High-quality fiber</li>\r\n<li>Body wave style</li>\r\n<li>Heat resistant</li>\r\n<li>18 inches</li>\r\n</ul>\r\n<p>Get the trendy ombre look without any chemical processing.</p>', 'Trendy ombre synthetic wig. Beautiful color transition, body wave style.', 85.00, 69.99, NULL, 'SYN-OMBRE-18', 25, 'in_stock', 3, 'Hair Aura', 'synthetic', 'body_wave', 18, 220, 'average', NULL, NULL, 'T1B/30', 1, 1, 1, 0.0, 0, 0, 'Ombre Wig Ghana | Colored Synthetic', 'Buy ombre synthetic wig in Ghana. Trendy colors, no chemical damage.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(14, 'Brazilian Virgin Hair Bundles', 'brazilian-virgin-bundles', '<p>Premium Brazilian Virgin Hair Bundles:</p>\r\n<ul>\r\n<li>100% unprocessed Brazilian hair</li>\r\n<li>Single donor hair</li>\r\n<li>Double machine weft</li>\r\n<li>No shedding, no tangles</li>\r\n<li>Can be dyed and bleached</li>\r\n<li>Available in various lengths</li>\r\n</ul>\r\n<p>Our Brazilian bundles are the highest quality, perfect for sew-ins and wig making.</p>', 'Premium Brazilian virgin hair bundles. Single donor, double weft. No shedding.', 85.00, NULL, NULL, 'EXT-BRZ-12', 50, 'in_stock', 4, 'Hair Aura', 'human_hair', 'body_wave', 12, 100, NULL, NULL, NULL, '1B', 1, 1, 0, 0.0, 0, 0, 'Brazilian Bundles Ghana | Virgin Hair', 'Shop Brazilian virgin hair bundles in Ghana. Single donor, double weft. Wholesale available.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(15, 'Peruvian Straight Bundles', 'peruvian-straight-bundles', '<p>Silky Peruvian Straight Bundles:</p>\r\n<ul>\r\n<li>100% Peruvian virgin hair</li>\r\n<li>Silky straight texture</li>\r\n<li>Thick from top to bottom</li>\r\n<li>Minimal shedding</li>\r\n<li>Can be curled</li>\r\n</ul>\r\n<p>Peruvian hair is known for its thickness and versatility. These bundles blend beautifully with natural hair.</p>', 'Silky Peruvian straight bundles. Thick, full, and versatile styling.', 95.00, 85.00, NULL, 'EXT-PER-14', 40, 'in_stock', 4, 'Hair Aura', 'human_hair', 'straight', 14, 110, NULL, NULL, NULL, '1B', 0, 0, 1, 0.0, 0, 0, 'Peruvian Bundles Ghana | Straight Hair', 'Buy Peruvian straight bundles in Ghana. Silky texture, thick and full.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(16, 'Clip-In Hair Extensions', 'clip-in-extensions', '<p>Easy-to-use Clip-In Hair Extensions:</p>\r\n<ul>\r\n<li>100% human hair</li>\r\n<li>7-piece set</li>\r\n<li>Clip attachments included</li>\r\n<li>120 grams total weight</li>\r\n<li>Can be styled with heat</li>\r\n</ul>\r\n<p>The easiest way to add length and volume instantly. Perfect for special occasions.</p>', '7-piece clip-in extension set. 100% human hair, easy application.', 120.00, NULL, NULL, 'EXT-CLIP-18', 30, 'in_stock', 4, 'Hair Aura', 'human_hair', 'straight', 18, 120, NULL, NULL, NULL, '1B', 1, 0, 0, 0.0, 0, 0, 'Clip-In Extensions Ghana | Human Hair', 'Shop clip-in hair extensions in Ghana. Easy application, instant volume.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(17, 'Silk Base Hair Topper', 'silk-base-hair-topper', '<p>Premium Silk Base Hair Topper for thinning hair:</p>\r\n<ul>\r\n<li>100% human hair</li>\r\n<li>Silk base for most natural look</li>\r\n<li>Covers crown area</li>\r\n<li>Clips for secure attachment</li>\r\n<li>Various sizes available</li>\r\n</ul>\r\n<p>The perfect solution for thinning hair or adding volume to the crown area.</p>', 'Silk base hair topper for thinning hair. Natural look, secure clips.', 150.00, 135.00, NULL, 'TOP-SILK-12', 20, 'in_stock', 5, 'Hair Aura', 'human_hair', 'straight', 12, 80, NULL, 'silk_base', NULL, '1B', 1, 0, 0, 0.0, 0, 0, 'Hair Topper Ghana | Silk Base', 'Buy silk base hair topper in Ghana. Solution for thinning hair. Natural look.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(18, 'Lace Closure 4x4', 'lace-closure-4x4', '<p>Versatile 4x4 Lace Closure:</p>\r\n<ul>\r\n<li>100% human hair</li>\r\n<li>4x4 inch lace area</li>\r\n<li>Free part/middle part/three part options</li>\r\n<li>Bleached knots available</li>\r\n<li>Perfect for sew-ins</li>\r\n</ul>\r\n<p>Essential for completing your sew-in install with a natural-looking part.</p>', '4x4 lace closure for sew-ins. Free parting, bleached knots available.', 75.00, NULL, NULL, 'CLS-4X4-14', 35, 'in_stock', 5, 'Hair Aura', 'human_hair', 'body_wave', 14, 40, NULL, 'lace_closure', NULL, '1B', 0, 1, 0, 0.0, 0, 0, 'Lace Closure Ghana | 4x4 Sew-In', 'Shop 4x4 lace closure in Ghana. Free parting, perfect for sew-ins.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(19, 'Wig Grip Band', 'wig-grip-band', '<p>Essential Wig Grip Band:</p>\r\n<ul>\r\n<li>Velvet material</li>\r\n<li>Keeps wigs secure</li>\r\n<li>Prevents slipping</li>\r\n<li>Adjustable fit</li>\r\n<li>Protects edges</li>\r\n</ul>\r\n<p>A must-have accessory for secure, comfortable wig wear.</p>', 'Velvet wig grip band. Keeps wigs secure, protects edges.', 25.00, NULL, NULL, 'ACC-GRIP-01', 100, 'in_stock', 6, 'Hair Aura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Black', 0, 1, 0, 0.0, 0, 0, 'Wig Grip Ghana | Secure Fit', 'Buy wig grip band in Ghana. Secure fit, protects edges. Essential accessory.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35'),
(20, 'Lace Wig Adhesive', 'lace-wig-adhesive', '<p>Professional Lace Wig Adhesive:</p>\r\n<ul>\r\n<li>Strong hold</li>\r\n<li>Waterproof</li>\r\n<li>Safe for skin</li>\r\n<li>Clear drying</li>\r\n<li>Long-lasting</li>\r\n</ul>\r\n<p>Professional-grade adhesive for secure lace front application.</p>', 'Professional lace wig adhesive. Strong, waterproof, skin-safe hold.', 45.00, 39.99, NULL, 'ACC-GLUE-01', 60, 'in_stock', 6, 'Hair Aura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0.0, 0, 0, 'Wig Adhesive Ghana | Strong Hold', 'Shop lace wig adhesive in Ghana. Professional grade, waterproof hold.', NULL, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `alt_text`, `is_primary`, `sort_order`, `created_at`) VALUES
(1, 1, 'products/brazilian-body-wave-1.jpg', 'Brazilian Body Wave Lace Front Wig - Front View', 1, 1, '2026-02-11 20:33:35'),
(2, 1, 'products/brazilian-body-wave-2.jpg', 'Brazilian Body Wave Wig - Side View', 0, 2, '2026-02-11 20:33:35'),
(3, 1, 'products/brazilian-body-wave-3.jpg', 'Brazilian Body Wave Wig - Back View', 0, 3, '2026-02-11 20:33:35'),
(4, 2, 'products/peruvian-straight-1.jpg', 'Peruvian Straight Lace Front Wig', 1, 1, '2026-02-11 20:33:35'),
(5, 3, 'products/deep-curly-1.jpg', 'Deep Curly Human Hair Wig', 1, 1, '2026-02-11 20:33:35'),
(6, 4, 'products/kinky-straight-1.jpg', 'Kinky Straight Lace Wig', 1, 1, '2026-02-11 20:33:35'),
(7, 5, 'products/blonde-highlight-1.jpg', 'Blonde Highlight Body Wave Wig', 1, 1, '2026-02-11 20:33:35'),
(8, 6, 'products/hd-lace-1.jpg', 'HD Transparent Lace Frontal Wig', 1, 1, '2026-02-11 20:33:35'),
(9, 7, 'products/360-lace-1.jpg', '360 Lace Frontal Wig', 1, 1, '2026-02-11 20:33:35'),
(10, 8, 'products/bob-wig-1.jpg', 'Bob Lace Front Wig', 1, 1, '2026-02-11 20:33:35'),
(11, 9, 'products/water-wave-1.jpg', 'Water Wave Lace Front Wig', 1, 1, '2026-02-11 20:33:35'),
(12, 10, 'products/synthetic-curly-1.jpg', 'Heat Resistant Synthetic Curly Wig', 1, 1, '2026-02-11 20:33:35'),
(13, 11, 'products/synthetic-long-1.jpg', 'Long Straight Synthetic Wig', 1, 1, '2026-02-11 20:33:35'),
(14, 12, 'products/pixie-wig-1.jpg', 'Short Pixie Synthetic Wig', 1, 1, '2026-02-11 20:33:35'),
(15, 13, 'products/ombre-wig-1.jpg', 'Ombre Synthetic Wig', 1, 1, '2026-02-11 20:33:35'),
(16, 14, 'products/brazilian-bundles-1.jpg', 'Brazilian Virgin Hair Bundles', 1, 1, '2026-02-11 20:33:35'),
(17, 15, 'products/peruvian-bundles-1.jpg', 'Peruvian Straight Bundles', 1, 1, '2026-02-11 20:33:35'),
(18, 16, 'products/clip-in-1.jpg', 'Clip-In Hair Extensions', 1, 1, '2026-02-11 20:33:35'),
(19, 17, 'products/silk-topper-1.jpg', 'Silk Base Hair Topper', 1, 1, '2026-02-11 20:33:35'),
(20, 18, 'products/lace-closure-1.jpg', 'Lace Closure 4x4', 1, 1, '2026-02-11 20:33:35'),
(21, 19, 'products/wig-grip-1.jpg', 'Wig Grip Band', 1, 1, '2026-02-11 20:33:35'),
(22, 20, 'products/wig-adhesive-1.jpg', 'Lace Wig Adhesive', 1, 1, '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_name` varchar(100) NOT NULL,
  `variant_value` varchar(100) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `price_adjustment` decimal(10,2) DEFAULT 0.00,
  `stock_quantity` int(10) UNSIGNED DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL CHECK (`rating` between 1 and 5),
  `title` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `is_verified_purchase` tinyint(1) DEFAULT 0,
  `is_approved` tinyint(1) DEFAULT 0,
  `helpful_count` int(10) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_alerts`
--

CREATE TABLE `stock_alerts` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_notified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `notified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_location` varchar(100) DEFAULT NULL,
  `customer_avatar` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT 5,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `customer_name`, `customer_location`, `customer_avatar`, `rating`, `title`, `content`, `is_featured`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Ama Owusu', 'Accra, Ghana', NULL, 5, 'Best Wigs in Ghana!', 'I\'ve been buying wigs from Hair Aura for over a year now, and the quality is consistently amazing. The Brazilian body wave is my favorite - it lasts for months with proper care. Customer service is excellent too!', 1, 1, 1, '2026-02-11 20:33:35'),
(2, 'Kwasi Mensah', 'Kumasi, Ghana', NULL, 5, 'My Wife Loves It', 'Bought a lace front wig for my wife\'s birthday and she absolutely loves it! The HD lace is truly undetectable. Will definitely be ordering again.', 1, 2, 1, '2026-02-11 20:33:35'),
(3, 'Abena Darko', 'Tema, Ghana', NULL, 5, 'Fast Delivery & Great Quality', 'Ordered on Monday, received on Wednesday in Tema! The Peruvian straight wig is so soft and silky. No shedding at all. Highly recommend!', 1, 3, 1, '2026-02-11 20:33:35'),
(4, 'Yaa Asantewaa', 'Sunyani, Ghana', NULL, 5, 'Changed My Look Completely', 'The kinky straight wig blends perfectly with my natural hair. I get compliments everywhere I go. Thank you Hair Aura for helping me unlock my aura!', 1, 4, 1, '2026-02-11 20:33:35'),
(5, 'Efua Mensah', 'Cape Coast, Ghana', NULL, 5, 'Professional Quality', 'As a makeup artist, I recommend Hair Aura to all my clients. The quality is professional grade and the prices are fair. The 360 lace wigs are perfect for bridal styling.', 0, 5, 1, '2026-02-11 20:33:35'),
(6, 'Kofi Addo', 'Takoradi, Ghana', NULL, 4, 'Great Value for Money', 'Bought the synthetic curly wig for my sister and she loves it. Great quality for the price. Delivery was prompt.', 0, 6, 1, '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `is_active` tinyint(1) DEFAULT 1,
  `email_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `remember_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `first_name`, `last_name`, `phone`, `avatar`, `role`, `is_active`, `email_verified`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'admin@hair-aura.debesties.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', '+233201234567', NULL, 'admin', 1, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL),
(2, 'ama.owusu@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ama', 'Owusu', '+233241234567', NULL, 'customer', 1, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL),
(3, 'kwasi.mensah@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kwasi', 'Mensah', '+233551234567', NULL, 'customer', 1, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL),
(4, 'abena.darko@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abena', 'Darko', '+233201234568', NULL, 'customer', 1, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL),
(5, 'yaa.asantewaa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Yaa', 'Asantewaa', '+233501234567', NULL, 'customer', 1, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_action` (`action`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_published` (`is_published`),
  ADD KEY `idx_category` (`category`);
ALTER TABLE `blog_posts` ADD FULLTEXT KEY `idx_search` (`title`,`content`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart_item` (`user_id`,`product_id`,`variant_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_parent` (`parent_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `idx_code` (`code`),
  ADD KEY `idx_active` (`is_active`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_active` (`is_active`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `idx_order_number` (`order_number`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_payment_status` (`payment_status`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order` (`order_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_price` (`price`),
  ADD KEY `idx_featured` (`featured`),
  ADD KEY `idx_bestseller` (`bestseller`),
  ADD KEY `idx_active` (`is_active`),
  ADD KEY `idx_hair_type` (`hair_type`);
ALTER TABLE `products` ADD FULLTEXT KEY `idx_search` (`name`,`description`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_primary` (`is_primary`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_variant_sku` (`sku`),
  ADD KEY `idx_product_variant` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_approved` (`is_approved`),
  ADD KEY `idx_rating` (`rating`);

--
-- Indexes for table `stock_alerts`
--
ALTER TABLE `stock_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_notified` (`is_notified`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_featured` (`is_featured`),
  ADD KEY `idx_active` (`is_active`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_role` (`role`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_wishlist` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_alerts`
--
ALTER TABLE `stock_alerts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_alerts`
--
ALTER TABLE `stock_alerts`
  ADD CONSTRAINT `stock_alerts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Optional tables for contact inbox and admin notes
--
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `label` varchar(60) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'Ghana',
  `postal_code` varchar(20) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_address_user` (`user_id`),
  KEY `idx_user_address_default` (`user_id`,`is_default`),
  CONSTRAINT `fk_user_addresses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(190) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_is_read` (`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL,
  `title` varchar(190) NOT NULL,
  `content` text NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_admin` (`admin_id`),
  KEY `idx_archived` (`is_archived`),
  CONSTRAINT `fk_notes_admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `media_library` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(500) NOT NULL,
  `folder` varchar(80) NOT NULL DEFAULT 'media',
  `mime_type` varchar(120) DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `size_bytes` bigint(20) unsigned NOT NULL DEFAULT 0,
  `alt_text` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_media_path` (`file_path`),
  KEY `idx_media_folder` (`folder`),
  KEY `idx_media_mime` (`mime_type`),
  KEY `idx_media_created` (`created_at`),
  CONSTRAINT `fk_media_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
