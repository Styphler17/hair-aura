-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2026 at 02:01 AM
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

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `entity_type`, `entity_id`, `details`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-13 05:58:40'),
(2, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-13 06:02:56'),
(3, 1, 'login', NULL, NULL, NULL, '185.132.176.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 23:32:50'),
(4, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-16 23:35:18'),
(5, 1, 'logout', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-16 23:35:31'),
(6, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 00:30:49'),
(7, 1, 'logout', NULL, NULL, NULL, '185.132.176.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 00:34:48'),
(8, 1, 'login', NULL, NULL, NULL, '185.132.176.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 00:34:58'),
(9, 1, 'login', NULL, NULL, NULL, '154.161.129.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-17 00:47:34'),
(10, 1, 'logout', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 00:54:58'),
(11, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 00:55:39'),
(12, 1, 'logout', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 01:03:06'),
(13, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 01:07:31'),
(14, 1, 'logout', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 01:07:59'),
(15, 1, 'login', NULL, NULL, NULL, '154.161.129.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-02-17 01:18:19'),
(16, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 01:24:21'),
(17, 1, 'logout', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 01:31:26'),
(18, 1, 'logout', NULL, NULL, NULL, '154.161.129.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-02-17 01:31:34'),
(19, 1, 'login', NULL, NULL, NULL, '154.161.129.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-02-17 01:32:39'),
(20, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-17 01:33:01'),
(21, 1, 'logout', NULL, NULL, NULL, '185.132.176.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 01:35:24'),
(22, 1, 'login', NULL, NULL, NULL, '185.132.176.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 01:35:31'),
(23, 1, 'logout', NULL, NULL, NULL, '185.132.176.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 02:32:30'),
(24, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 04:15:30'),
(25, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 05:16:46'),
(26, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 05:16:53'),
(27, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 06:19:02'),
(28, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 06:19:38'),
(29, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-17 06:33:12'),
(30, 1, 'login', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-17 10:53:43'),
(31, 1, 'login', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-18 12:09:09'),
(32, 1, 'logout', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-18 12:21:11'),
(33, 1, 'login', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-18 12:22:43'),
(34, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:1d9d:b6e0:23ef:aea6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-18 12:26:16'),
(35, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-18 21:43:41'),
(36, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-18 22:43:54'),
(37, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-18 22:44:02'),
(38, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-18 23:48:20'),
(39, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-18 23:49:03'),
(40, 1, 'login', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-19 00:02:45'),
(41, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 00:49:25'),
(42, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 00:49:38'),
(43, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 01:50:47'),
(44, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 01:51:01'),
(45, 1, 'login', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-19 01:51:02');

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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `category`, `tags`, `meta_title`, `meta_description`, `view_count`, `is_published`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'How to Care for Your Human Hair Wig', 'how-to-care-human-hair-wig', 'Learn the essential tips for maintaining your human hair wig to ensure it lasts for years.', '<h2>Proper Care Makes All the Difference</h2>\r\n<p>Investing in a quality human hair wig is just the first step. Proper care and maintenance are essential to ensure your wig stays beautiful and lasts for years to come.</p>\r\n\r\n<h3>Washing Your Wig</h3>\r\n<p>Wash your human hair wig every 7-10 wears, or when product buildup becomes noticeable:</p>\r\n<ul>\r\n<li>Use sulfate-free shampoo and conditioner</li>\r\n<li>Detangle gently before washing</li>\r\n<li>Wash in cool water, never hot</li>\r\n<li>Pat dry with a towel - never rub</li>\r\n<li>Air dry on a wig stand</li>\r\n</ul>\r\n\r\n<h3>Styling Tips</h3>\r\n<p>Human hair wigs can be styled just like your natural hair:</p>\r\n<ul>\r\n<li>Always use heat protectant before styling</li>\r\n<li>Keep heat tools below 180°C</li>\r\n<li>Deep condition monthly</li>\r\n<li>Store on a wig stand when not in use</li>\r\n</ul>\r\n\r\n<h3>Nighttime Care</h3>\r\n<p>Never sleep in your wig! Remove it before bed and store properly to maintain its shape and prevent tangling.</p>\r\n\r\n<p>Follow these tips and your Hair Aura wig will maintain its beauty for years!</p>', 'IMG_0262-1771290058-3c0e4a-1771302729.webp', 1, 'Wig Care', 'wig care, human hair, maintenance, washing', 'How to Care for Human Hair Wig Ghana | Hair Aura', 'Learn essential tips for caring for your human hair wig. Washing, styling, and maintenance guide from Hair Aura.', 1, 1, '2026-02-11 20:33:00', '2026-02-11 20:33:35', '2026-02-17 04:32:09', NULL),
(2, 'Choosing the Right Wig for Your Face Shape', 'choosing-wig-face-shape', 'Find the perfect wig style that complements your unique face shape.', '<h2>The Perfect Wig for Every Face</h2>\r\n<p>Not all wigs suit every face shape. Understanding your face shape is key to choosing a wig that enhances your natural beauty.</p>\r\n\r\n<h3>Oval Face Shape</h3>\r\n<p>Lucky you! Oval faces can pull off almost any wig style. Try:</p>\r\n<ul>\r\n<li>Long layers</li>\r\n<li>Bob cuts</li>\r\n<li>Curly or straight styles</li>\r\n</ul>\r\n\r\n<h3>Round Face Shape</h3>\r\n<p>Create the illusion of length with:</p>\r\n<ul>\r\n<li>Long, layered wigs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Height at the crown</li>\r\n<li>Avoid chin-length bobs</li>\r\n</ul>\r\n\r\n<h3>Square Face Shape</h3>\r\n<p>Soften angular features with:</p>\r\n<ul>\r\n<li>Wavy or curly textures</li>\r\n<li>Side parts</li>\r\n<li>Layers around the face</li>\r\n<li>Avoid blunt cuts</li>\r\n</ul>\r\n\r\n<h3>Heart Face Shape</h3>\r\n<p>Balance a wider forehead with:</p>\r\n<ul>\r\n<li>Chin-length bobs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Volume at the jawline</li>\r\n</ul>\r\n\r\n<p>Visit Hair Aura to find your perfect wig match!</p>', NULL, 1, 'Wig Guide', 'face shape, wig selection, styling tips', 'Choose Wig for Face Shape Ghana | Hair Aura Guide', 'Find the perfect wig for your face shape. Expert guide from Hair Aura on selecting flattering wig styles.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL),
(3, 'Lace Front vs Full Lace Wigs: What\'s the Difference?', 'lace-front-vs-full-lace', 'Understanding the differences between lace front and full lace wigs to make the right choice.', '<h2>Lace Front vs Full Lace: The Breakdown</h2>\r\n<p>When shopping for wigs, you\'ll often see \"lace front\" and \"full lace\" options. But what\'s the difference, and which is right for you?</p>\r\n\r\n<h3>Lace Front Wigs</h3>\r\n<p>Lace front wigs have lace only at the front hairline:</p>\r\n<ul>\r\n<li>More affordable</li>\r\n<li>Natural-looking hairline</li>\r\n<li>Cannot be parted everywhere</li>\r\n<li>Less styling versatility</li>\r\n<li>More durable construction</li>\r\n</ul>\r\n\r\n<h3>Full Lace Wigs</h3>\r\n<p>Full lace wigs have lace covering the entire cap:</p>\r\n<ul>\r\n<li>Can be parted anywhere</li>\r\n<li>Can be worn in high ponytails</li>\r\n<li>More breathable</li>\r\n<li>Higher price point</li>\r\n<li>Requires more careful handling</li>\r\n</ul>\r\n\r\n<h3>Which Should You Choose?</h3>\r\n<p>Choose lace front if you:</p>\r\n<ul>\r\n<li>Want a natural look on a budget</li>\r\n<li>Don\'t need high ponytail styles</li>\r\n<li>Want a more durable option</li>\r\n</ul>\r\n\r\n<p>Choose full lace if you:</p>\r\n<ul>\r\n<li>Want maximum styling versatility</li>\r\n<li>Wear high ponytails or updos</li>\r\n<li>Prioritize breathability</li>\r\n</ul>\r\n\r\n<p>Hair Aura offers both options to suit your needs and budget!</p>', NULL, 1, 'Wig Education', 'lace front, full lace, wig types, comparison', 'Lace Front vs Full Lace Wigs Ghana | Hair Aura', 'Understand the difference between lace front and full lace wigs. Expert comparison from Hair Aura.', 2, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-16 23:17:45', NULL),
(4, '5 Trending Wig Styles for 2024', 'trending-wig-styles-2024', 'Discover the hottest wig trends taking Ghana and Africa by storm this year.', '<h2>2024 Wig Trends You Need to Know</h2>\r\n<p>The wig industry is constantly evolving, and 2024 brings exciting new trends. Here are the top 5 styles dominating the Ghana and African markets:</p>\r\n\r\n<h3>1. The Wet Look</h3>\r\n<p>Water wave and deep wave wigs styled to look wet are everywhere. This sleek, glossy look is perfect for both casual and formal occasions.</p>\r\n\r\n<h3>2. Bold Colors</h3>\r\n<p>From honey blonde to burgundy to fashion colors, bold is beautiful. More women are experimenting with colored wigs to express their personality.</p>\r\n\r\n<h3>3. The Modern Bob</h3>\r\n<p>The classic bob gets an update with blunt cuts, asymmetrical lines, and textured ends. It\'s chic, professional, and low maintenance.</p>\r\n\r\n<h3>4. Kinky Textures</h3>\r\n<p>Embracing natural textures is a major trend. Kinky straight and Afro-textured wigs that blend with natural hair are in high demand.</p>\r\n\r\n<h3>5. HD Lace Everything</h3>\r\n<p>HD lace wigs that melt into any skin tone are becoming the standard. The undetectable finish is a game-changer.</p>\r\n\r\n<p>Shop all these trending styles at Hair Aura and stay ahead of the fashion curve!</p>', NULL, 1, 'Trends', 'wig trends 2024, fashion, styles, Ghana', 'Trending Wig Styles 2024 Ghana | Hair Aura', 'Discover 2024\'s hottest wig trends in Ghana. Water waves, bold colors, modern bobs and more at Hair Aura.', 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-19 01:48:08', NULL),
(5, 'How to Secure Your Lace Front Wig', 'secure-lace-front-wig', 'Expert tips for keeping your lace front wig secure and comfortable all day long.', '<h2>Keep Your Wig Secure All Day</h2>\r\n<p>Nothing is more frustrating than a shifting wig. Here are professional tips to keep your lace front wig secure:</p>\r\n\r\n<h3>Preparation is Key</h3>\r\n<ul>\r\n<li>Start with clean, dry skin</li>\r\n<li>Use alcohol to remove oils from hairline</li>\r\n<li>Protect your edges with a wig grip</li>\r\n</ul>\r\n\r\n<h3>Application Techniques</h3>\r\n<ul>\r\n<li>Use quality adhesive or wig tape</li>\r\n<li>Apply thin, even layers of glue</li>\r\n<li>Wait for adhesive to get tacky before applying</li>\r\n<li>Press lace firmly into place</li>\r\n<li>Tie down with a scarf for 10-15 minutes</li>\r\n</ul>\r\n\r\n<h3>Maintenance Throughout the Day</h3>\r\n<ul>\r\n<li>Avoid excessive sweating when possible</li>\r\n<li>Carry blotting papers for oily skin</li>\r\n<li>Keep a small emergency kit with extra tape</li>\r\n</ul>\r\n\r\n<h3>Removal</h3>\r\n<p>Always use proper adhesive remover and be gentle with your edges. Never rip the wig off!</p>\r\n\r\n<p>Shop wig adhesives and accessories at Hair Aura for the best hold.</p>', NULL, 1, 'Wig Tips', 'lace front, wig security, adhesive, application', 'Secure Lace Front Wig Ghana | Hair Aura Tips', 'Learn how to secure your lace front wig. Professional application tips from Hair Aura.', 4, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-02-17 19:35:28', NULL);

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
(1, 'Bone-straight', 'bone-straight-hair', 'Premium 100% human hair bone straight wigs.', 'Bone-straight.jpeg', NULL, 1, 1, 'Luxury Bone Straight Hair Ghana | Super Sleek & Silky', 'Experience the silkiness of our luxury bone straight hair. No frizz, no tangles.', '2026-02-19 01:36:53'),
(18, 'Body wave', 'body-wave-hair', '100% human hair body wave', 'Body-wave.webp', NULL, 2, 1, 'Premium Body Wave Hair Ghana | Natural & Bouncy Wigs', 'Shop 100% human hair body wave wigs and bundles. High-quality and natural luster.', '2026-02-19 01:36:53'),
(19, 'Pixie cut', 'pixie-cut', 'Classic tapered pixie cuts', NULL, NULL, 3, 1, 'Tapered Pixie Cut Wigs | Elegant Short Hair Units', 'Elegant and tapered pixie cut wigs for a sophisticated look.', '2026-02-19 01:36:53'),
(20, 'Pixie curls', 'pixie-curls', 'Bouncy and short curly units', NULL, NULL, 4, 1, 'Bouncy Pixie Curls Wigs | Short & Chic Curly Hair', 'Style your look with our manageable and bouncy pixie curl wigs.', '2026-02-19 01:36:53'),
(21, 'Deep wave', 'deep-wave', 'Intense wave pattern for volume', NULL, NULL, 5, 1, 'Ocean Deep Wave Hair | Defined Curls & Volume', 'Deep wave bundles and wigs with intense definition and volume.', '2026-02-19 01:36:53'),
(23, 'Raw hair', 'raw-hair', 'Unprocessed single donor hair', NULL, NULL, 6, 1, 'Raw Virgin Hair Ghana | Unprocessed Human Hair Bundles', 'Pure, unprocessed raw hair bundles. Strong, healthy, and can be bleached.', '2026-02-19 01:36:53'),
(24, 'Blunt cut', 'blunt-cut', 'Sharp and leveled bob styles', NULL, NULL, 7, 1, 'Classic Blunt Cut Bob Wigs | Sleek & Sharp Styles', 'Sophisticated blunt cut bobs for a sharp, modern look.', '2026-02-19 01:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(190) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'How do I choose the right wig size?', 'Most of our wigs come in a standard \'Average\' size (22-22.5 inches) which fits 95% of customers perfectly thanks to adjustable straps and inner combs. For custom sizing needs, please contact our support.', 3, 1, '2026-02-17 04:55:38', '2026-02-17 04:55:38'),
(4, 'What\'s the difference between human hair and synthetic wigs?', 'Human hair wigs (Brazilian, Peruvian, etc.) offer the most natural look, can be dyed, and last 1-2 years with proper care. Synthetic wigs are more affordable, hold their style even after washing, and are perfect for quick style changes, typically lasting 4-6 months.', 4, 1, '2026-02-17 04:55:38', '2026-02-17 04:55:38'),
(5, 'How do I install a lace front wig?', 'To install your lace front, first braid your natural hair flat. Clean your forehead with alcohol, apply a thin layer of lace glue or use a glueless method with a wig grip. Position the wig, press the lace into the adhesive, and style as desired. We also offer installation guides in our blog!', 5, 1, '2026-02-17 04:55:38', '2026-02-17 04:55:38'),
(6, 'What payment methods do you accept in Ghana?', 'We accept all major mobile money (MoMo) payments (MTN, Telecel, AT), bank transfers, and secure card payments (Visa/Mastercard). Cash on delivery is available for verified orders within Accra.', 6, 1, '2026-02-17 04:55:38', '2026-02-17 04:55:38'),
(7, 'What types of wigs does Hair Aura sell in Ghana?', 'Hair Aura specializes in premium 100% human hair wigs, including lace fronts, closure wigs, and full lace options. We also offer high-quality heat-safe synthetic wigs and premium hair extensions specifically curated for the Ghanaian market.', 1, 1, '2026-02-17 04:58:17', '2026-02-17 04:58:17'),
(14, 'Do you ship across Ghana?', 'Yes! We offer nationwide delivery including Accra, Kumasi, and Tema...', 2, 1, '2026-02-17 05:05:03', '2026-02-17 05:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `media_library`
--

CREATE TABLE `media_library` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(500) NOT NULL,
  `folder` varchar(80) NOT NULL DEFAULT 'media',
  `mime_type` varchar(120) DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `size_bytes` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `alt_text` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_library`
--

INSERT INTO `media_library` (`id`, `file_name`, `original_name`, `file_path`, `folder`, `mime_type`, `extension`, `size_bytes`, `alt_text`, `tags`, `created_by`, `created_at`, `deleted_at`) VALUES
(1, 'apple-touch-icon.webp', 'apple-touch-icon.webp', 'img/apple-touch-icon.webp', 'media', 'image/webp', 'webp', 2728, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(2, 'default-avatar.svg', 'default-avatar.svg', 'img/default-avatar.svg', 'media', 'image/svg+xml', 'svg', 497, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(3, 'favicon-96x96.webp', 'favicon-96x96.webp', 'img/favicon-96x96.webp', 'media', 'image/webp', 'webp', 1554, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(4, 'favicon.ico', 'favicon.ico', 'img/favicon.ico', 'media', 'image/vnd.microsoft.icon', 'ico', 15086, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(5, 'favicon.svg', 'favicon.svg', 'img/favicon.svg', 'media', 'image/svg+xml', 'svg', 17663, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(6, 'favicon.webp', 'favicon.webp', 'img/favicon.webp', 'media', 'image/webp', 'webp', 930, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(7, 'favicon_1.webp', 'favicon_1.webp', 'img/favicon_1.webp', 'media', 'image/webp', 'webp', 7416, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(8, 'hero-1.webp', 'hero-1.webp', 'img/hero-1.webp', 'media', 'image/webp', 'webp', 96290, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(9, 'hero-2.webp', 'hero-2.webp', 'img/hero-2.webp', 'media', 'image/webp', 'webp', 43258, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(10, 'hero-3.webp', 'hero-3.webp', 'img/hero-3.webp', 'media', 'image/webp', 'webp', 55706, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(11, 'logo.webp', 'logo.webp', 'img/logo.webp', 'media', 'image/webp', 'webp', 7416, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(12, 'logo_1.webp', 'logo_1.webp', 'img/logo_1.webp', 'media', 'image/webp', 'webp', 2408, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(14, 'og-image.webp', 'og-image.webp', 'img/og-image.webp', 'media', 'image/webp', 'webp', 47978, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(15, 'og-image_1.webp', 'og-image_1.webp', 'img/og-image_1.webp', 'media', 'image/webp', 'webp', 7416, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(16, 'product-placeholder.webp', 'product-placeholder.webp', 'img/product-placeholder.webp', 'media', 'image/webp', 'webp', 47978, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(17, 'web-app-manifest-192x192.webp', 'web-app-manifest-192x192.webp', 'img/web-app-manifest-192x192.webp', 'media', 'image/webp', 'webp', 2920, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(18, 'web-app-manifest-512x512.webp', 'web-app-manifest-512x512.webp', 'img/web-app-manifest-512x512.webp', 'media', 'image/webp', 'webp', 6966, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(50, 'Long-straight-hair.webp', 'IMG_0254.webp', 'uploads/media/Long-straight-hair.webp', 'media', 'image/webp', 'webp', 52722, NULL, NULL, 1, '2026-02-17 01:00:57', NULL),
(56, 'Pixie-curls-hair.webp', 'IMG_0258.webp', 'uploads/media/Pixie-curls-hair.webp', 'media', 'image/webp', 'webp', 164626, NULL, NULL, 1, '2026-02-17 01:00:58', NULL),
(58, 'Frontalpixie-hair.webp', 'IMG_0256.webp', 'uploads/media/Frontalpixie-hair.webp', 'media', 'image/webp', 'webp', 88108, NULL, NULL, 1, '2026-02-17 01:00:58', NULL),
(62, 'Rawdonor.webp', 'IMG_0250.webp', 'uploads/media/Rawdonor.webp', 'media', 'image/webp', 'webp', 102998, NULL, NULL, 1, '2026-02-17 01:00:58', NULL),
(63, 'Bouncy-baby-hair.webp', 'IMG_0246.webp', 'uploads/media/Bouncy-baby-hair.webp', 'media', 'image/webp', 'webp', 49176, NULL, NULL, 1, '2026-02-17 01:00:58', NULL),
(66, '8127290172131658699-1771290131-1a2aa2.mp4', '-8127290172131658699.mp4', 'uploads/media/8127290172131658699-1771290131-1a2aa2.mp4', 'media', 'video/mp4', 'mp4', 859973, NULL, NULL, 1, '2026-02-17 01:02:11', NULL),
(70, 'Brownbodywave.webp', 'IMG_0245-1771290057-a3a44b-1771302729.webp', 'uploads/categories/Brownbodywave.webp', 'categories', 'image/webp', 'webp', 72372, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(71, 'Body-wave.webp', 'IMG_0248-1771290057-340e2f-1771302729.webp', 'uploads/categories/Body-wave.webp', 'categories', 'image/webp', 'webp', 57188, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(72, 'Straight-hair.webp', 'IMG_0262-1771290058-3c0e4a-1771302729.webp', 'uploads/blog/Straight-hair.webp', 'blog', 'image/webp', 'webp', 61594, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(73, 'Body-wave.webp', 'bone-straight-hair-1771302729.webp', 'uploads/products/Body-wave.webp', 'products', 'image/webp', 'webp', 57188, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(74, 'Bone-straight.jpeg', 'IMG_0253-1771290057-a36826-1771302729.jpeg', 'uploads/products/Bone-straight.jpeg', 'products', 'image/jpeg', 'jpeg', 49944, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(75, '10-straight-hair.webp', 'IMG_0252-1771290057-e127d8-1771302729.webp', 'uploads/products/10-straight-hair.webp', 'products', 'image/webp', 'webp', 41440, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(76, 'Bouncy-hair.webp', 'IMG_0260-1771290057-e1c76e-1771302729.webp', 'uploads/products/Bouncy-hair.webp', 'products', 'image/webp', 'webp', 71030, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(77, 'web-app-manifest-512x512.webp', '../../img/web-app-manifest-512x512.webp', 'uploads/avatars/../../img/web-app-manifest-512x512.webp', 'avatars', 'image/webp', 'webp', 6966, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(78, 'web-app-manifest-512x512-1771309983.webp', 'web-app-manifest-512x512-1771309983.webp', 'uploads/avatars/web-app-manifest-512x512-1771309983.webp', 'avatars', 'image/webp', 'webp', 6966, NULL, 'synced', 1, '2026-02-17 06:33:03', NULL),
(80, 'noise.png', 'noise.png', 'img/noise.png', 'media', 'image/png', 'png', 54589, NULL, 'static', 1, '2026-02-19 01:55:11', NULL);

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
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(190) NOT NULL,
  `content` text NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `short_description`, `price`, `sale_price`, `cost_price`, `sku`, `stock_quantity`, `stock_status`, `category_id`, `brand`, `hair_type`, `texture`, `length_inches`, `weight_grams`, `cap_size`, `lace_type`, `density`, `color`, `featured`, `bestseller`, `new_arrival`, `rating_avg`, `review_count`, `virtual_try_on`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Brazilian Body Wave Lace Front', 'brazilian-body-wave-lace-front', 'High quality Brazilian body wave.', '180% density HD lace.', 185.00, 159.99, NULL, 'BW-BODY-18', 24, 'in_stock', 18, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.0, 0, 0, NULL, NULL, NULL, 1, '2026-02-19 01:36:53', '2026-02-19 01:36:53', NULL),
(3, 'Body wave Special', 'body-wave-special', 'Luxury deep curly pattern.', 'Voluminous 200% density.', 2700.00, 175.00, NULL, 'SKU-BW-SPEC', 28, 'in_stock', 18, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.0, 0, 0, NULL, NULL, NULL, 1, '2026-02-19 01:36:53', '2026-02-19 01:36:53', NULL),
(21, 'Curly hair', 'brazilian-curly-4', 'Short bouncy curls.', '', 250.00, NULL, NULL, 'SKU-CURLY-4', 10, 'in_stock', 18, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.0, 0, 0, NULL, NULL, NULL, 1, '2026-02-19 01:36:53', '2026-02-19 01:36:53', NULL),
(23, 'Straight hair', 'straight-brown-hair', 'Sleek straight brown hair.', '', 850.00, NULL, NULL, 'SKU-STR-BRN', 10, 'in_stock', 18, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.0, 0, 0, NULL, NULL, NULL, 1, '2026-02-19 01:36:53', '2026-02-19 01:48:03', NULL);

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
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `is_active` tinyint(1) DEFAULT 1,
  `is_banned` tinyint(1) DEFAULT 0,
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

INSERT INTO `users` (`id`, `email`, `password_hash`, `first_name`, `last_name`, `phone`, `avatar`, `role`, `is_active`, `is_banned`, `email_verified`, `created_at`, `updated_at`, `last_login`, `remember_token`, `remember_expires`) VALUES
(1, 'admin@hair-aura.debesties.com', '$2y$10$9hrn/d49Ei2OmTgSilnPPu7DoDi2qfyapg9A3/PY7LlaqCiQQmzHq', 'Hair', 'Aura', '+233508007873', 'web-app-manifest-512x512-1771309983.webp', 'admin', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-19 01:51:02', '2026-02-19 01:51:02', NULL, NULL),
(2, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ama', 'Owusu', '+233241234567', NULL, 'customer', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL, NULL, NULL),
(3, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kwasi', 'Mensah', '+233551234567', NULL, 'customer', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL, NULL, NULL),
(4, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abena', 'Darko', '+233201234568', NULL, 'customer', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL, NULL, NULL),
(5, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Yaa', 'Asantewaa', '+233501234567', NULL, 'customer', 0, 1, 1, '2026-02-11 20:33:35', '2026-02-17 05:37:10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `label`, `first_name`, `last_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `country`, `postal_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Shipping', 'Hair', 'Aura', '+233508007873', 'avenue de l\'europe 11', '', 'Herstal', 'wallonie', 'Ghana', '4040', 1, '2026-02-17 05:43:52', '2026-02-17 05:43:52');

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
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_is_read` (`is_read`);

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
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_library`
--
ALTER TABLE `media_library`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_media_path` (`file_path`),
  ADD KEY `idx_media_folder` (`folder`),
  ADD KEY `idx_media_mime` (`mime_type`),
  ADD KEY `idx_media_created` (`created_at`),
  ADD KEY `fk_media_created_by` (`created_by`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_active` (`is_active`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_admin` (`admin_id`),
  ADD KEY `idx_archived` (`is_archived`);

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
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_address_user` (`user_id`),
  ADD KEY `idx_user_address_default` (`user_id`,`is_default`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `media_library`
--
ALTER TABLE `media_library`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `media_library`
--
ALTER TABLE `media_library`
  ADD CONSTRAINT `fk_media_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `fk_user_addresses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
