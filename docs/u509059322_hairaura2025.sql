-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2026 at 01:21 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

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
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
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
(45, 1, 'login', NULL, NULL, NULL, '154.161.135.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-02-19 01:51:02'),
(46, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 02:51:21'),
(47, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 02:51:29'),
(48, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 03:30:21'),
(49, 6, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 03:36:24'),
(50, 6, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 05:10:44'),
(51, 6, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-19 05:10:54'),
(52, 6, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:36:50'),
(53, 6, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:40:09'),
(54, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:40:15'),
(55, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:41:30'),
(56, 6, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:41:36'),
(57, 6, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:42:11'),
(58, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:42:16'),
(59, 1, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:42:31'),
(60, 6, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-02-19 06:42:36'),
(61, 6, 'logout', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-20 05:34:41'),
(62, 1, 'login', NULL, NULL, NULL, '154.161.8.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-03-01 10:08:46'),
(63, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 10:17:39'),
(64, 1, 'login', NULL, NULL, NULL, '154.161.8.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026-03-01 10:28:29'),
(65, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:fd54:c42b:61d0:ca2b', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-03-01 10:42:53'),
(66, 1, 'logout', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:fd54:c42b:61d0:ca2b', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-03-01 10:54:17'),
(67, 1, 'login', NULL, NULL, NULL, '2a02:a03f:a1e4:4801:fd54:c42b:61d0:ca2b', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-03-01 10:56:14'),
(68, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 11:20:06'),
(69, 1, 'login', NULL, NULL, NULL, '154.161.8.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-03-01 11:20:50'),
(70, 1, 'logout', NULL, NULL, NULL, '154.161.8.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-03-01 11:20:53'),
(71, 1, 'login', NULL, NULL, NULL, '154.161.8.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-03-01 11:21:02'),
(72, 1, 'logout', NULL, NULL, NULL, '154.161.8.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', '2026-03-01 11:21:10'),
(73, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 19:03:35'),
(74, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 20:03:52'),
(75, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 20:04:02'),
(76, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 20:10:54'),
(77, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 20:11:10'),
(78, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 21:13:35'),
(79, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 21:13:46'),
(80, 1, 'login', NULL, NULL, NULL, '154.161.189.92', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-01 21:42:39'),
(81, 1, 'login', NULL, NULL, NULL, '154.161.189.92', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-01 21:42:40'),
(82, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/17.5 Mobile/15A5370a Safari/602.1', '2026-03-01 22:25:49'),
(83, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-01 23:17:41'),
(84, 1, 'login', NULL, NULL, NULL, '154.161.189.87', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-02 00:12:58'),
(85, 1, 'login', NULL, NULL, NULL, '154.161.189.87', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026-03-02 00:17:41'),
(86, 1, 'logout', NULL, NULL, NULL, '154.161.189.87', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', '2026-03-02 00:17:45'),
(87, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 00:21:30'),
(88, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 01:49:22'),
(89, 1, 'logout', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 05:56:00'),
(90, 1, 'login', NULL, NULL, NULL, '155.117.189.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 05:56:14'),
(91, 1, 'logout', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 07:01:42'),
(92, 1, 'login', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 08:59:07'),
(93, 1, 'logout', NULL, NULL, NULL, '154.161.7.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-02 09:29:13'),
(94, 1, 'login', NULL, NULL, NULL, '154.161.7.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-02 09:29:15'),
(95, 1, 'logout', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 10:01:42'),
(96, 1, 'login', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 10:01:51'),
(97, 1, 'logout', NULL, NULL, NULL, '154.161.7.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-02 10:13:07'),
(98, 1, 'login', NULL, NULL, NULL, '154.161.7.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-02 10:17:43'),
(99, 1, 'logout', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 11:09:11'),
(100, 1, 'login', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 14:35:57'),
(101, 1, 'logout', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 17:31:51'),
(102, 1, 'login', NULL, NULL, NULL, '62.235.28.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', '2026-03-02 17:43:00'),
(103, 1, 'login', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-02 17:58:50'),
(104, 1, 'logout', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 00:15:50'),
(105, 1, 'login', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 00:16:11'),
(106, 1, 'login', NULL, NULL, NULL, '154.161.169.216', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', '2026-03-03 00:30:35'),
(107, 1, 'logout', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 01:39:03'),
(108, 1, 'login', NULL, NULL, NULL, '149.40.62.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 01:49:36'),
(109, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 03:08:53'),
(110, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 03:48:53'),
(111, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 04:36:15'),
(112, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 04:38:46'),
(113, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 09:05:38'),
(114, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 10:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'General',
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_count` int(10) UNSIGNED DEFAULT '0',
  `is_published` tinyint(1) DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `category`, `tags`, `meta_title`, `meta_description`, `view_count`, `is_published`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'How to Care for Your Human Hair Wig', 'how-to-care-human-hair-wig', 'Keep your investment looking flawless. Our 600-word masterclass covers washing, heat styling, and nighttime care specifically for the Ghana climate.', '<h2>Why Your Human Hair Wig Deserves V.I.P. Treatment</h2>\r\n<p>In the vibrant, bustling streets of Accra, your \"Hair Aura\" is your crowning glory. But unlike natural hair, a 100% human hair wig doesn\'t have a direct supply of natural oils from your scalp. This means that without the right maintenance, even the most expensive <a href=\"/shop/brazilian-bundles\">Brazilian bundles</a> can become dry, tangled, and lose their luster. Proper care isn\'t just about washing; it\'s about environmental strategy.</p>\r\n\r\n<h3>The Golden Rule of Washing</h3>\r\n<p>Many women in Ghana make the mistake of washing their units too frequently. Unless you are using heavy styling products every day, you should only wash your human hair wig every 10 to 14 wears. When you do wash, the technique is everything. Start by gently detangling with a wide-tooth comb from the ends moving upward. Use only sulfate-free shampoos—sulfates are harsh detergents that strip the cuticle, leading to the dreaded \"wig frizz\" that Accra humidity loves to exploit.</p>\r\n<p><strong>Pro Tip:</strong> Rinse your wig in lukewarm water, never hot. Hot water can damage the lace and weaken the hair knots, leading to shedding.</p>\r\n\r\n<h3>Deep Conditioning: Your Secret Weapon</h3>\r\n<p>Because the hair is essentially \"dead,\" it needs external moisture. Once a month, apply a deep conditioner or a hair mask. Wrap the unit in a plastic cap and let it sit for at least 30 minutes. If you have the time, use a steamer. This opens the hair cuticle and allows the moisture to penetrate deeply, ensuring that <a href=\"/shop/peruvian-straight-lace-front\">Peruvian straight</a> units stay silky and \"bone straight\" for much longer.</p>\r\n\r\n<h3>Styling and Heat Protection</h3>\r\n<p>We know you love your flat irons and curling wands! While human hair is versatile, heat is its number one enemy. Always apply a high-quality heat protectant spray before any styling tool touches the hair. Try to keep your tools below 180°C (350°F). If you can achieve your look with heatless methods—like flexi-rods or silk rollers—your unit will last twice as long.</p>\r\n\r\n<h3>Surviving the Tropical Climate</h3>\r\n<p>In Ghana, humidity and dust are constant factors. To protect your hair from the environment, use a lightweight silicone-based serum. This creates a microscopic barrier that prevents moisture from the air from entering the hair shaft, which is what causes frizz. If you are spending the day at the beach in Ada or a garden party in Aburi, consider a chic silk scarf to protect the hair from excessive sun and wind.</p>\r\n\r\n<h3>The Nighttime Routine</h3>\r\n<p>The fastest way to ruin a wig is to sleep in it. Friction against cotton pillowcases causes tangling and matting at the nape of the neck. Always remove your wig before bed and store it on a wig stand or a mannequin head. This allows the cap to \"breathe\" and helps the unit maintain its original shape. If you absolutely must sleep in it, use a 100% silk or satin bonnet.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>A quality human hair wig is an investment in your confidence. By following these professional steps, you ensure that your Hair Aura remains as stunning as the day you first unboxed it. Remember: Gentle handling today means a beautiful unit for years to come.</p>', 'Straight-hair.webp', 1, 'Wig Care', 'wig care, human hair, maintenance, washing', 'Human Hair Wig Care Guide Ghana | Long-Term Maintenance Tips', 'Expert 600-word guide on maintaining human hair wigs in Ghana. Learn washing, deep conditioning, and heat protection secrets to keep your wig looking new.', 1, 1, '2026-02-11 20:33:00', '2026-02-11 20:33:35', '2026-03-03 04:38:11', NULL),
(2, 'Choosing the Right Wig for Your Face Shape', 'choosing-wig-face-shape', 'Find the perfect wig style that complements your unique face shape.', '<h2>The Perfect Wig for Every Face</h2>\r\n<p>Not all wigs suit every face shape. Understanding your face shape is key to choosing a wig that enhances your natural beauty.</p>\r\n\r\n<h3>Oval Face Shape</h3>\r\n<p>Lucky you! Oval faces can pull off almost any wig style. Try:</p>\r\n<ul>\r\n<li>Long layers</li>\r\n<li>Bob cuts</li>\r\n<li>Curly or straight styles</li>\r\n</ul>\r\n\r\n<h3>Round Face Shape</h3>\r\n<p>Create the illusion of length with:</p>\r\n<ul>\r\n<li>Long, layered wigs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Height at the crown</li>\r\n<li>Avoid chin-length bobs</li>\r\n</ul>\r\n\r\n<h3>Square Face Shape</h3>\r\n<p>Soften angular features with:</p>\r\n<ul>\r\n<li>Wavy or curly textures</li>\r\n<li>Side parts</li>\r\n<li>Layers around the face</li>\r\n<li>Avoid blunt cuts</li>\r\n</ul>\r\n\r\n<h3>Heart Face Shape</h3>\r\n<p>Balance a wider forehead with:</p>\r\n<ul>\r\n<li>Chin-length bobs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Volume at the jawline</li>\r\n</ul>\r\n\r\n<p>Visit Hair Aura to find your perfect wig match!</p>', 'legacy-face-shape.png', 1, 'Wig Guide', 'face shape, wig selection, styling tips', 'Choose Wig for Face Shape Ghana | Hair Aura Guide', 'Find the perfect wig for your face shape. Expert guide from Hair Aura on selecting flattering wig styles.', 1, 1, '2026-02-11 20:33:00', '2026-02-11 20:33:35', '2026-03-03 04:38:11', NULL),
(3, 'Lace Front vs Full Lace Wigs: What\'s the Difference?', 'lace-front-vs-full-lace', 'The ultimate construction showdown. We break down the pros, cons, and price points of Lace Front vs Full Lace to help you invest wisely.', '<h2>The Construction Debate: Frontal vs Full</h2>\r\n<p>In the world of high-end hair, the terms \"Lace Frontal\" and \"Full Lace\" are the most common source of confusion for customers in Ghana. Given that these units are a significant investment, understanding the technical differences is crucial. Are you paying for styling versatility, or are you looking for the best price-to-durability ratio? Let\'s dive into the anatomy of a Hair Aura wig.</p>\r\n\r\n<h3>Lace Front Wigs: The Modern Professional\'s Choice</h3>\r\n<p>A <strong>Lace Front Wig</strong> is constructed with a lace portion only at the front perimeter (usually 13x4 or 13x6 inches). The rest of the wig cap is made of a more durable, breathable mechanical material where \"tracks\" or \"wefts\" are sewn. </p>\r\n<ul>\r\n    <li><strong>Pros:</strong> More affordable, easier to install for beginners, and generally more durable for everyday wear. Because the back is reinforced, it can handle frequent removals better.</li>\r\n    <li><strong>Cons:</strong> Limited styling. You can\'t wear this in a high ponytail or a bun because the \"tracks\" in the back would be visible. You are mostly limited to wearing the hair \"down\" or in a low ponytail.</li>\r\n</ul>\r\n<p><em>Browse our <a href=\"/shop/lace-front-wigs\">Lace Front Collection</a> for the perfect daily-driver unit.</em></p>\r\n\r\n<h3>Full Lace Wigs: The Celebrity Standard</h3>\r\n<p>A <strong>Full Lace Wig</strong> is a masterpiece of craftsmanship. The entire wig cap is made of lace, and every single hair strand is hand-tied into the base. This means that if you part the hair in the middle, the side, or even the very back, it looks like it is growing directly from your scalp.</p>\r\n<ul>\r\n    <li><strong>Pros:</strong> Maximum versatility. You can wear your hair in a high \"Abena\" ponytail, pigtails, or complex bridal updos. It is also the most breathable option, which is a huge plus in the Accra sun.</li>\r\n    <li><strong>Cons:</strong> Much higher price point due to the hundreds of hours of manual labor required. It is also more delicate—since the whole base is lace, it is more prone to tearing if you are rough during removal.</li>\r\n</ul>\r\n\r\n<h3>The 360 Lace Alternative: The Best of Both Worlds?</h3>\r\n<p>At <strong>Hair Aura</strong>, we often recommend the <a href=\"/shop/360-lace-frontal-wig\">360 Lace Frontal</a> as a middle ground. It has lace all around the perimeter but tracks in the center. This allows for high ponytails and updos at a lower cost than a full lace unit.</p>\r\n\r\n<h3>Which is Right for You?</h3>\r\n<p>If you are a \"style chameleon\" who loves changing your look every day and needs that high ponytail for a glamorous event at Polo Club, invest in <strong>Full Lace</strong>. If you are a busy professional woman who wants a flawless, natural hairline for the office but usually wears her hair down, <strong>Lace Front</strong> is the smarter, more economical choice.</p>\r\n\r\n<h3>Final Verdict</h3>\r\n<p>Construction matters. At Hair Aura, we use only premium Swiss and HD lace for both types, ensuring that regardless of your choice, the \"melt\" is always perfect. Check our <a href=\"/shop/full-lace-wigs\">Full Lace section</a> for the ultimate in luxury hair.</p>', 'legacy-lace-comparison.png', 1, 'Wig Education', 'lace front, full lace, wig types, comparison', 'Lace Front vs Full Lace Wigs Comparison | Which to Buy?', 'A 600-word deep dive into wig construction. Learn the pros and cons of lace front and full lace wigs before you buy in Ghana.', 4, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-03-03 04:38:11', NULL),
(4, '5 Trending Wig Styles for 2024', 'trending-wig-styles-2024', 'Stay ahead of the fashion curve. Discover the top 5 wig trends dominating the Ghana hair scene in 2024, from Butterfly Bobs to Kinky Blowouts.', '<h2>Your 2024 Hair Aura Roadmap</h2>\r\n<p>The hair scene in West Africa moves fast. Styles that were \"cool\" last December are already being replaced by more sophisticated, textured looks. As we move through 2024, the theme is \"Realistic Luxury.\" Women in Accra and Kumasi are moving away from overly shiny, synthetic-looking hair and embracing textures and colors that scream \"effortless wealth.\" Here are the top 5 trends you need to know.</p>\r\n\r\n<h3>1. The \"Butterfly Bob\"</h3>\r\n<p>Short hair is having a massive moment! The Butterfly Bob is a layered, voluminous short cut that focuses on movement and \"flicked\" ends. It is much more playful than the traditional blunt bob. It frames the face beautifully and is incredibly heat-friendly for the Ghana weather. Check out our <a href=\"/shop/bob-lace-front-wig\">12-inch bobs</a> to start your butterfly transformation.</p>\r\n\r\n<h3>2. Kinky Blowout Straight</h3>\r\n<p>The \"Natural Glam\" look is peaking. This style mimics African hair that has been freshly blown out and pressed. It has incredible volume and a slight coarseness that makes it look like it\'s growing directly from your scalp. It\'s the perfect \"boss lady\" look for the boardroom or a high-end dinner at Santoku.</p>\r\n\r\n<h3>3. \"Expensive\" Honey Blonde Highlights</h3>\r\n<p>Flat, one-dimensional colors are out. In 2024, it\'s all about multi-tonal highlights. Deep browns mixed with honey and caramel tones create a \"sun-kissed\" look that adds depth and makes the hair look healthier and more expensive. Our <a href=\"/shop/blonde-highlight-wig\">Blonde Highlight collection</a> is flying off the shelves for this very reason.</p>\r\n\r\n<h3>4. The 90s \"Pamela Anderson\" Updo</h3>\r\n<p>Nostalgia is powerful. Huge, messy-chic updos with tendrils framing the face are the top choice for weddings and galas this year. This style requires a <a href=\"/shop/360-lace-frontal-wig\">360 lace unit</a> or a full lace wig to look realistic, but the payoff is pure Hollywood glamour right here in Ghana.</p>\r\n\r\n<h3>5. Ultra-Glueless HD Units</h3>\r\n<p>This is more of a construction trend than a style, but it\'s changing how we wear hair. \"Wearing hair\" is no longer a commitment. The rise of the 5-minute <a href=\"/shop/glueless-wigs\">glueless install</a> means you can switch your style as often as you change your outfit. HD lace has become the standard—anything less is simply visible.</p>\r\n\r\n<h3>How to Style These Trends</h3>\r\n<p>Getting the trend right is about the quality of the hair. Synthetic hair can mimic these looks for a day, but for the movement and \"bounce\" required for the Butterfly Bob or 90s Updo, you need 100% Remy human hair. Shop our \"New Arrivals\" section to stay ahead of the crowd!</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>2024 is about expressing your inner aura with confidence. Whether you go short and sassy or long and natural, make sure your unit reflects the luxury you deserve. Visit Hair Aura in-store or online to see these trends in person.</p>', 'legacy-trends-2026.png', 1, 'Trends', 'wig trends 2024, fashion, styles, Ghana', 'Top 5 Wig Trends Ghana 2024 | Butterfly Bobs & More', 'Discover the biggest wig trends in Ghana for 2024. From the Butterfly Bob to Kinky Blowouts, stay ahead of the fashion curve with our expert guide.', 5, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', '2026-03-03 04:38:11', NULL),
(5, 'How to Secure Your Lace Front Wig', 'secure-lace-front-wig', 'Say goodbye to shifting wigs. Learn the safest and most effective ways to secure your lace front, including adhesive, tape, and glueless methods.', '<h2>Security is Confidence</h2>\r\n<p>There is nothing more distracting than being out at a social event and constantly checking if your wig has shifted. A secure install is the foundation of a great \"Hair Aura.\" But security shouldn\'t come at the cost of your natural edges. In this 600-word masterclass, we explore the best ways to keep your unit locked in place, whether you want a week-long hold or a daily removal option.</p>\r\n\r\n<h3>1. The Glue Method: The Long-Term Hold</h3>\r\n<p>For those who want to wake up with their hair already \"done\" for 3-5 days, adhesive (like Ghost Bond or Walker Tape) is the gold standard. \r\n<ul>\r\n    <li><strong>The Secret:</strong> Cleanliness. Use 90% isopropyl alcohol to remove all oils from your forehead before applying. </li>\r\n    <li><strong>Application:</strong> Apply three thin, even layers. Wait for each layer to turn completely transparent before applying the next. This ensures a \"melted\" look that won\'t turn white or flaky.</li>\r\n</ul>\r\n<p><strong>Warning:</strong> Always use a professional solvent to remove the wig. Never \"rip\" a glued wig off, or you will lose your natural hairline!</p>\r\n\r\n<h3>2. The Glueless Grip: The Healthy Choice</h3>\r\n<p>If you are worried about your edges, the glueless method is the way to go. We recommend a <strong>Velvet Wig Grip</strong>. These bands act as a \"velcro\" for your wig cap. They prevent the wig from sliding back without a single drop of chemicals. Most of our <a href=\"/shop/human-hair-wigs\">Hair Aura units</a> also come with internal adjustable straps and combs for extra security.</p>\r\n\r\n<h3>3. The Elastic Band Method</h3>\r\n<p>Adding a thick elastic band to the back of your wig is a DIY secret that stylists swear by. It pulls the lace flat against your forehead, creating a \"melted\" look even without glue. This is the perfect solution for the woman who wants to take her wig off every night to let her scalp breathe.</p>\r\n\r\n<h3>4. Protecting Your Edges</h3>\r\n<p>No matter which method you choose, your natural hair should be the priority. Always wear a wig cap to create a barrier. If you use glue, ensure it is applied to your skin, NOT your hair. Use a scalp protector before application to prevent irritation. At Hair Aura, we sell a range of <a href=\"/shop/hair-accessories\">Scalp Protectors and Edge Control</a> to keep you protected.</p>\r\n\r\n<h3>5. Maintenance: Surviving the Sweat</h3>\r\n<p>In Ghana\'s heat, sweat can settle under the lace and weaken the adhesive. If you feel your wig starting to lift, don\'t just add more glue. Use a hairdryer on a cool setting to dry the area, then tie it down with a silk scarf for 10 minutes. This often \"re-sets\" the bond without causing product buildup.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>A secure wig is a powerful wig. By choosing the right method for your lifestyle—whether it\'s the long-term bond of professional adhesive or the daily freedom of a glueless grip—you can focus on your day without a second thought about your hair. Shop our accessories to find your perfect security kit!</p>', 'legacy-secure-wig.png', 1, 'Wig Tips', 'lace front, wig security, adhesive, application', 'How to Secure Lace Front Wig Ghana | Glue vs. Glueless', 'Stop your wig from sliding! Our 600-word guide covers the best ways to secure a lace front wig while protecting your natural edges.', 7, 1, '2026-02-11 20:33:00', '2026-02-11 20:33:35', '2026-03-03 04:55:14', NULL),
(6, 'Why Glueless Lace Front Wigs are the Ultimate Game Changer in Accra', 'glueless-lace-front-wigs-accra-guide', 'Discover why glueless wigs are becoming the top choice for women in Ghana. From protecting your edges to surviving the heat, we cover it all.', '<h2>The Rise of the Glueless Revolution</h2>\r\n<p>If you have been keeping an eye on the beauty and hair scene in Accra recently, you will have noticed a significant shift. While the traditional \"glued down\" installation still has its place, the <strong>glueless lace front wig</strong> has taken the city by storm. But why is this happening now? In this comprehensive guide, we explore why dropping the adhesive is the best decision you can make for your hair aura today.</p>\r\n\r\n<h3>1. Protecting Your Precious Edges</h3>\r\n<p>In many parts of West Africa, edge protection is a primary concern. The repeated use of strong adhesives and \"got2b\" style gels can lead to traction alopecia or localized thinning over time. Glueless wigs utilize adjustable straps, internal combs, and velvet wig grips to stay secure without a single drop of glue. This \"breathable\" approach allows your natural hairline to rest and recover, ensuring that when you do take the wig off, your natural edges are as thick and healthy as ever.</p>\r\n<p><em>Check out our <a href=\"/shop/lace-front-wigs\">latest glueless lace front collection</a> to see how natural the hairline can look even without adhesive.</em></p>\r\n\r\n<h3>2. Surviving the Accra Heat and Humidity</h3>\r\n<p>Let\'s be honest: Accra humidity and traditional wig glue do not always get along. There is nothing more stressful than feeling your lace begin to \"lift\" in the middle of a lunch date at Labone or during a wedding ceremony. Traditional adhesives can become \"white\" or tacky when exposed to sweat. Glueless wigs bypass this entire issue. Since there is no adhesive to melt, your look remains crisp and secure from morning until night, regardless of the humidity levels.</p>\r\n\r\n<h3>3. The Convenience Factor: 10-Minute Transformations</h3>\r\n<p>Modern women in Ghana are busier than ever. Between traffic on the N1 and navigating busy work schedules, who has two hours to sit for a professional install every week? A high-quality glueless wig from <strong>Hair Aura</strong> allows for a \"Pluck and Go\" experience. Once your unit is customized, putting it on takes less than 10 minutes. This versatility means you can switch from a professional <a href=\"/shop/human-hair-wigs\">straight bob</a> for the office to a glamorous <a href=\"/shop/human-hair-wigs\">body wave</a> for a night out at Garage or Front/Back.</p>\r\n\r\n<h3>4. Better Scalp Hygiene</h3>\r\n<p>One of the hidden benefits of glueless units is the ability to take them off every single night. This allows you to moisturize your natural hair, let your scalp breathe, and perform your nighttime hair routine. It significantly reduces the \"wig itch\" that often accompanies long-term glued installs. Hygiene is a key part of maintaining your <strong>aura</strong>, and the glueless method is the gold standard for scalp health.</p>\r\n\r\n<h3>Conclusion: Is it Time to Go Glueless?</h3>\r\n<p>The verdict is clear. For the woman who values her time, her health, and her edges, the glueless lace front wig is not just a trend—it\'s a lifestyle upgrade. By choosing premium human hair units, you get the same \"melted\" look of a traditional install with none of the risks.</p>\r\n<p><strong>SEO Tip:</strong> When searching for your next unit, look for \"HD Lace\" combined with \"Glueless\" for the most undetectable finish available in the Ghana market.</p>', 'blog-glueless-wigs.png', 1, 'Wig Guide', 'glueless wigs, Accra hair, edge protection, Ghana beauty, lace front', 'Glueless Lace Front Wigs Accra Guide | Hair Aura', 'Discover why glueless wigs are the top choice for women in Accra. Protect your edges and survive the heat with our expert 600-word guide.', 2, 1, '2026-03-03 00:56:52', '2026-03-03 00:56:52', '2026-03-03 01:50:00', NULL),
(7, 'Brazilian vs. Peruvian Hair: Which One Should You Buy in Ghana?', 'brazilian-vs-peruvian-hair-ghana-comparison', 'Torn between Brazilian and Peruvian hair? We break down the differences in texture, durability, and cost to help you choose the perfect bundles.', '<h2>Making the Ultimate Hair Choice</h2>\r\n<p>When you walk into any high-end hair boutique in East Legon or browse online, the terms \"Brazilian\" and \"Peruvian\" are thrown around constantly. But behind the marketing, there are real physical differences that affect how your hair looks, feels, and lasts. Given the investment involved in 100% human hair, making the right choice is essential for your long-term satisfaction.</p>\r\n\r\n<h3>Understanding Brazilian Hair: The Versatile Queen</h3>\r\n<p><strong>Brazilian hair</strong> is undoubtedly the most popular hair type in the West African market. It is known for its high luster and thickness. Because of its density, you often need fewer bundles to achieve a full look. One of the standout features of Brazilian hair is its ability to hold a curl. If you love the \"bouncy\" look of a <a href=\"/shop/human-hair-wigs\">body wave</a>, Brazilian is usually your best bet.</p>\r\n<ul>\r\n    <li><strong>Texture:</strong> Silky but slightly coarser than Indian hair.</li>\r\n    <li><strong>Luster:</strong> High shine.</li>\r\n    <li><strong>Best for:</strong> Glamorous, voluminous styles and holding heat curls.</li>\r\n</ul>\r\n\r\n<h3>The Peruvian Alternative: Effortless Sophistication</h3>\r\n<p><strong>Peruvian hair</strong> is often described as the \"cool sister\" of Brazilian hair. It is slightly thinner in individual strand diameter but has a very high density of strands. Because it is a bit coarser than Brazilian hair, it actually blends better with natural African hair that has been relaxed or pressed. It is incredibly soft and provides a more \"natural\" movement compared to the high-shine finish of Brazilian units.</p>\r\n<ul>\r\n    <li><strong>Texture:</strong> Coarse and thick but incredibly soft.</li>\r\n    <li><strong>Luster:</strong> Low to medium (more natural).</li>\r\n    <li><strong>Best for:</strong> Sleek straight looks and natural-looking volume.</li>\r\n</ul>\r\n\r\n<h3>The Durability Factor: surviving the Weather</h3>\r\n<p>In the climate of Ghana, humidity is a major factor. Brazilian hair tends to \"swell\" slightly more in humidity if not properly primed with serum. Peruvian hair, due to its texture, often behaves better in the damp air of coastal cities like Tema or Takoradi. However, both require high-quality maintenance. We always recommend using our <a href=\"/blog/how-to-care-human-hair-wig\">Human Hair Care Guide</a> to ensure your bundles last 2+ years.</p>\r\n\r\n<h3>Cost vs. Value in the Ghana Market</h3>\r\n<p>While prices fluctuate, Peruvian hair is often positioned as a more premium, \"exclusive\" option. However, at <strong>Hair Aura</strong>, we believe value comes from quality. Whether you choose Brazilian or Peruvian, the hair must be \"Virgin\" (unprocessed) to truly be worth the GHS you are spending.</p>\r\n\r\n<h3>Final Verdict</h3>\r\n<p>Choose <strong>Brazilian</strong> if you want that \"Red Carpet\" high-shine look and love big curls. Choose <strong>Peruvian</strong> if you want a softer, more natural \"effortless\" style that blends seamlessly with your pressed natural hair. Both are excellent choices found in our <a href=\"/shop/hair-extensions\">Hair Extensions collection</a>.</p>', 'blog-hair-comparison.png', 1, 'Hair Education', 'Brazilian vs Peruvian, hair bundles Ghana, virgin hair guide, hair texture', 'Brazilian vs Peruvian Hair Ghana Comparison | Hair Aura', 'Torn between Brazilian and Peruvian hair? Read our 600-word expert comparison on textures, durability, and cost for the Ghana market.', 1, 1, '2026-03-03 00:56:52', '2026-03-03 00:56:52', '2026-03-03 05:20:53', NULL),
(8, '5 Secret Tips to Protect Your Hair Extensions from Ghana Humidity', 'protect-hair-extensions-humidity-ghana', 'Humidity in Ghana can turn your sleek look into a frizzy mess in minutes. Here are 5 expert tips to keep your extensions perfect.', '<h2>The Battle Against the Frizz</h2>\r\n<p>Ghana\'s tropical climate is beautiful, but for hair extensions, the humidity can be a nightmare. You leave the house with a bone-straight <a href=\"/shop/peruvian-straight-lace-front\">Peruvian wig</a>, but by the time you reach Circle or the airport, your hair has doubled in volume and lost its shine. This is caused by the hair cuticle opening up and absorbing moisture from the air. To maintain your \"Aura,\" you need a specific environmental strategy.</p>\r\n\r\n<h3>1. Seal the Cuticle with the Right Serum</h3>\r\n<p>The biggest mistake is using heavy oils. Heavy oils attract dust and actually weigh the hair down without stopping frizz. Instead, look for a high-quality silicone-based serum. These serums create a microscopic barrier around each hair strand, preventing ambient moisture from entering. Apply it while the hair is slightly damp after washing, and a tiny \"refresher\" drop before you step outside.</p>\r\n\r\n<h3>2. The \"Cold Shot\" Technique</h3>\r\n<p>When styling your hair with a blow dryer or flat iron, always finish with the \"cold\" button. Heat opens the hair cuticle, while cold air seals it. By blowing cold air on your finished style for 60 seconds, you \"lock\" the style in place. This makes it much harder for humidity to disrupt the bonds of the hair.</p>\r\n\r\n<h3>3. Choose Your Texture Wisely</h3>\r\n<p>If you know you will be outdoors for a long event—like an outdoor wedding at the Botanical Gardens—rely on textures that embrace the moisture. <a href=\"/shop/deep-curly-human-hair-wig\">Deep curly</a> or water wave textures actually look *better* as they absorb a bit of moisture. Straight hair is the most vulnerable to humidity, so save the sleek looks for air-conditioned indoor events.</p>\r\n\r\n<h3>4. Nighttime Hydration</h3>\r\n<p>Frizzy hair is often \"thirsty\" hair. If your extensions are properly hydrated from the inside out, they won\'t seek moisture from the atmosphere. Use a deep conditioning treatment once a week. We recommend products that contain Marula or Argan oil, which are highly effective for the types of hair we sell at <strong>Hair Aura</strong>.</p>\r\n\r\n<h3>5. Use an Anti-Humidity Spray</h3>\r\n<p>There are professional \"finishing\" sprays designed specifically to combat West African levels of humidity. These are often labeled as \"humidity shields.\" One light mist over your finished install can act as an \"umbrella\" for your hair. These are available in our <a href=\"/shop/hair-accessories\">Accessories section</a>.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>You don\'t have to let the weather dictate your style. With these five secrets, you can walk confidently through any weather Accra throws at you. Remember, the secret to longevity is always starting with 100% human hair that hasn\'t been chemically compromised.</p>', 'blog-humidity-care.png', 1, 'Wig Care', 'humidity hair care, Ghana weather tips, frizz protection, hair extensions', 'Protect Hair Extensions Humidity Ghana | Expert Tips', 'Don\'t let Ghana humidity ruin your hair. 5 expert tips to stop frizz and keep your extensions sleek and shiny all day long.', 3, 1, '2026-03-03 00:56:52', '2026-03-03 00:56:52', '2026-03-03 04:56:15', NULL),
(9, 'The Ultimate Guide to Bridal Hair: Choosing a Wig for Your Ghana Wedding', 'bridal-wig-guide-ghana-wedding', 'Your wedding day is the ultimate \"Aura\" moment. Learn how to choose between frontals, closures, and 360 units for your traditional and white wedding.', '<h2>Your Big Day, Your Perfect Hair</h2>\r\n<p>In Ghana, a wedding is not just an event; it is a multi-day celebration of family, culture, and beauty. From the vibrant colors of the Kente at the traditional ceremony to the elegance of the white wedding, your hair must be versatile enough to complement every look. For many modern brides, a high-quality wig is the secret weapon for looking flawless under the tropical sun and the cameras.</p>\r\n\r\n<h3>The Traditional Ceremony: Volume and Culture</h3>\r\n<p>Traditional ceremonies often involve heavy jewelry and elaborate headwraps, but many brides choose to wear their hair down or in a sophisticated half-up, half-down style. For this day, we recommend a <strong>360 Lace Frontal</strong>. Because the lace goes all around the perimeter, your stylist can pin it up or create complex updos that look like they are growing directly from your scalp. It provides the most natural look when viewed from any angle during the dance-heavy celebrations.</p>\r\n<p><em>Browse our <a href=\"/shop/360-lace-frontal-wig\">360 lace collection</a> for maximum bridal versatility.</em></p>\r\n\r\n<h3>The White Wedding: Elegance and Undetectability</h3>\r\n<p>For the white wedding, most brides aim for a \"sleek and classic\" or \"romantic and wavy\" look. This is where <strong>HD Lace</strong> becomes essential. With so many close-up photos and videos being taken, you want your lace to be completely \"melted\" into your skin. An <a href=\"/shop/hd-transparent-lace-frontal\">HD Transparent Lace Frontal</a> is our top recommendation for the ceremony. It is virtually invisible even to the naked eye, ensuring your \"Hair Aura\" is nothing but perfection as you walk down the aisle.</p>\r\n\r\n<h3>Length and Texture: What Fits Your Crown?</h3>\r\n<p>Consider your dress neckline. If you have an off-the-shoulder dress, long 24-26 inch <a href=\"/shop/peruvian-straight-lace-front\">straight units</a> provide a dramatic, queen-like frame for your face. If your dress has intricate detailing on the shoulders or back, a chic <a href=\"/shop/bob-lace-front-wig\">bob wig</a> creates a clean, sophisticated line that doesn\'t distract from the gown.</p>\r\n\r\n<h3>The \"Reception Switch\"</h3>\r\n<p>One of the best reasons to use a wig for your wedding? You can change your entire look for the reception! Many brides start with a conservative straight style for the church and switch to a voluminous <a href=\"/shop/human-hair-wigs\">deep curly</a> unit for the evening party. Since our glueless units are so easy to install, this transition is seamless.</p>\r\n\r\n<h3>Bridal Preparation Checklist</h3>\r\n<ul>\r\n    <li>Choose your hair at least 1 month before the wedding.</li>\r\n    <li>Have a trial session with your stylist to test the install.</li>\r\n    <li>Deep condition the unit 3 days before the event.</li>\r\n    <li>Ensure you have a \"wig emergency kit\" with adhesive tape and a wide-tooth comb.</li>\r\n</ul>\r\n\r\n<h3>Conclusion</h3>\r\n<p>You deserve to feel like royalty on your wedding day. Investing in premium human hair ensures that your wedding photos look timeless. At <strong>Hair Aura</strong>, we specialize in helping brides find their perfect crown. Congratulations on your upcoming union!</p>', 'blog-bridal-hair.png', 1, 'Weddings', 'bridal hair Ghana, wedding wigs, HD lace bridal, Ghanaian bride tips', 'Bridal Wig Guide Ghana Wedding | Hair Aura', 'Choosing the perfect wig for your traditional or white wedding in Ghana. Expert advice on HD lace and 360 units for brides.', 0, 1, '2026-03-03 00:56:52', '2026-03-03 00:56:52', '2026-03-03 01:50:00', NULL),
(10, 'How to Master the \"Melt\": A Guide to Tinting Your Lace at Home', 'how-to-tint-lace-at-home-guide', 'Stop wearing \"white\" lace! Learn the professional secrets to tinting your lace frontal or closure to match your skin tone perfectly at home.', '<h2>The Secret to an Undetectable Wig</h2>\r\n<p>The difference between a wig that looks \"obvious\" and one that looks like it\'s growing from your scalp is often just a matter of color. Even high-quality <a href=\"/shop/hd-transparent-lace-frontal\">HD lace</a> sometimes requires a bit of tinting to match the diverse and beautiful skin tones we have here in Ghana. While a professional stylist is great, every wig lover should know how to \"melt\" their own lace at home.</p>\r\n\r\n<h3>1. Choosing Your \"Melt\" Method</h3>\r\n<p>There are three main ways to tint your lace, depending on your experience level and how permanent you want the result to be:</p>\r\n<ul>\r\n    <li><strong>The Foundation Method:</strong> The easiest and safest way. You simply apply your favorite cream or powder foundation to the underside of the lace.</li>\r\n    <li><strong>Lace Tint Sprays/Foams:</strong> Specifically designed products that come in various shades (Light Brown, Medium Brown, Dark Brown). They provide a more even, professional finish.</li>\r\n    <li><strong>The Tea/Coffee Method:</strong> An old-school but effective DIY method using hot water and tea bags to stain the lace.</li>\r\n</ul>\r\n\r\n<h3>2. The Step-by-Step Tinting Process</h3>\r\n<p>If you are using a tint spray or foam—which we highly recommend—follow these steps:</p>\r\n<ol>\r\n    <li>Turn your wig inside out so the lace is facing up.</li>\r\n    <li>Spray or apply foam evenly across the lace area, focusing on the parting and the hairline.</li>\r\n    <li>Use a blow dryer on a warm setting to \"set\" the tint. This prevents the color from transferring to your skin.</li>\r\n    <li>Check the color against your forehead. If it\'s too light, add another layer. If it\'s too dark, gently wipe with a damp cloth.</li>\r\n</ol>\r\n\r\n<h3>3. Avoiding the \"Purple\" or \"Grey\" Undertone</h3>\r\n<p>A common mistake is choosing a tint that is too cool-toned. Many West African skin tones have warm, golden, or reddish undertones. If you use a tint that is too \"ashy,\" your lace will look grey or purple once installed. Look for tints with names like \"Caramel,\" \"Chestnut,\" or \"Golden Brown.\"</p>\r\n\r\n<h3>4. The Importance of Knot Bleaching</h3>\r\n<p>Tinting is only half the battle. If those little black \"dots\" (the knots) are visible, the melt won\'t be perfect. While many of our <a href=\"/shop/human-hair-wigs\">Hair Aura units</a> come pre-plucked, we recommend professional knot bleaching for the ultimate scalp look. Once the knots are bleached, the tint will truly make the lace disappear.</p>\r\n\r\n<h3>5. Maintenance: When to Re-Tint</h3>\r\n<p>Tinting is not permanent. Sweat, washing, and friction will eventually fade the color. We recommend a quick \"refresh\" every 2-3 weeks to keep the melt looking fresh. Having a small bottle of lace tint spray in your beauty bag is a must-have for the modern hair enthusiast.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Mastering the \"melt\" is the final level of your hair journey. It gives you the confidence to wear your hair in any style, knowing that even from inches away, your lace is invisible. Check our <a href=\"/shop/hair-accessories\">Accessories section</a> for the tools you need to master this at home!</p>', 'blog-lace-tinting.png', 1, 'Wig Education', 'tinting lace, lace frontal melt, DIY wig tips, HD lace tinting', 'How to Tint Lace at Home Guide | Master the Melt', 'Stop wearing white lace! 600 words of expert advice on tinting your lace frontal to match your skin tone perfectly for a melted look.', 0, 1, '2026-03-03 00:56:52', '2026-03-03 00:56:52', '2026-03-03 01:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `variant_id`, `quantity`, `created_at`, `updated_at`) VALUES
(59, 1, 34, 29, 1, '2026-03-03 04:42:43', '2026-03-03 04:42:43'),
(60, 1, 1, NULL, 1, '2026-03-03 04:42:43', '2026-03-03 04:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `meta_title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `parent_id`, `sort_order`, `is_active`, `meta_title`, `meta_description`, `created_at`) VALUES
(1, 'Bone-straight', 'bone-straight-hair', 'Premium 100% human hair bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.', 'Bone-straight.webp', NULL, 1, 1, 'Luxury Bone Straight Hair Ghana', 'Indulge in the ultimate sleekness with our premium bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.', '2026-02-19 01:36:53'),
(2, 'Body wave', 'body-wave-hair', 'Enhance your natural beauty with our voluminous, bouncy waves. High-quality 100% human hair that maintains its pattern.', 'Body-wave.webp', NULL, 2, 1, 'Premium Body Wave Hair Ghana', 'Enhance your natural beauty with our voluminous body wave hair. Soft, bouncy waves that maintain their pattern and luster.', '2026-02-19 01:36:53'),
(3, 'Pixie cut', 'pixie-cut', 'Chic and effortless tapered pixie cut wigs for a bold, sophisticated aesthetic and low-maintenance style.', 'cat_IMG_0326.webp', NULL, 3, 1, 'Chic Tapered Pixie Cut Wigs', 'Effortless elegance in a short style. Our tapered pixie cut wigs offer a bold, sophisticated look that\'s easy to maintain.', '2026-02-19 01:36:53'),
(4, 'Pixie curls', 'pixie-curls', 'Bouncy and short curly units with high-definition texture. Playful, chic, and full of personality.', '../products/Frontalpixie-hair-1772363734.webp', NULL, 4, 1, 'Bouncy Pixie Curls Units', 'Playful and chic short curly units. Manageable, high-definition curls that add texture and personality to your style.', '2026-02-19 01:36:53'),
(5, 'Deep wave', 'deep-wave', 'Intense wave pattern delivering maximum volume and defined curls for a stunning ocean-kissed look.', 'Pixie-curls-hair-1772446289.webp', NULL, 5, 1, 'Defined Deep Wave Hair Units', 'Dive into deep texture with our premium deep wave wigs. Intense wave patterns that deliver maximum volume and a stunning ocean-kissed look.', '2026-02-19 01:36:53'),
(6, 'Raw hair', 'raw-hair', 'Unprocessed single donor hair offering unmatched longevity, strength, and styling versatility.', 'Raw-hair.webp', NULL, 6, 1, 'Premium unprocessed Raw Donor Hair', 'The pinnacle of hair quality. Unprocessed, single-donor raw hair that offers unmatched longevity, strength, and styling versatility.', '2026-02-19 01:36:53'),
(7, 'Blunt cut', 'blunt-cut', 'Sharp, leveled bob styles for a clean, modern, and timeless aesthetic that turns heads.', 'Blunt-cut.webp', NULL, 7, 1, 'Modern Sleek Blunt Cut Bobs', 'Sharp, edgy, and timeless. Our blunt cut bob wigs are perfectly leveled for a clean, modern aesthetic that turns heads.', '2026-02-19 01:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT NULL,
  `max_discount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(10) UNSIGNED DEFAULT NULL,
  `usage_count` int(10) UNSIGNED DEFAULT '0',
  `starts_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `description`, `discount_type`, `discount_value`, `min_order_amount`, `max_discount`, `usage_limit`, `usage_count`, `starts_at`, `expires_at`, `is_active`, `created_at`) VALUES
(1, 'WELCOME10', '10% off first order', 'percentage', '10.00', '50.00', '50.00', 100, 0, '2026-02-11 20:33:35', '2026-05-12 20:33:35', 1, '2026-02-11 20:33:35'),
(2, 'AURA20', '20% off orders over GH₵150', 'percentage', '20.00', '150.00', '75.00', 50, 0, '2026-02-11 20:33:35', '2026-03-13 20:33:35', 1, '2026-02-11 20:33:35'),
(3, 'FREESHIP', 'Free shipping on orders over GH₵100', 'fixed', '15.00', '100.00', '15.00', 200, 0, '2026-02-11 20:33:35', '2026-04-12 20:33:35', 1, '2026-02-11 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'media',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_bytes` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
(73, 'Body-wave.webp', 'bone-straight-hair-1771302729.webp', 'uploads/products/Body-wave.webp', 'products', 'image/webp', 'webp', 57188, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(74, 'Bone-straight.webp', 'IMG_0253-1771290057-a36826-1771302729.jpeg', 'uploads/products/Bone-straight.webp', 'products', 'image/webp', 'webp', 49944, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(75, '10-straight-hair.webp', 'IMG_0252-1771290057-e127d8-1771302729.webp', 'uploads/products/10-straight-hair.webp', 'products', 'image/webp', 'webp', 41440, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(76, 'Bouncy-hair.webp', 'IMG_0260-1771290057-e1c76e-1771302729.webp', 'uploads/products/Bouncy-hair.webp', 'products', 'image/webp', 'webp', 71030, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(77, 'web-app-manifest-512x512.webp', '../../img/web-app-manifest-512x512.webp', 'uploads/avatars/../../img/web-app-manifest-512x512.webp', 'avatars', 'image/webp', 'webp', 6966, NULL, 'synced', 1, '2026-02-17 04:32:09', NULL),
(78, 'web-app-manifest-512x512-1771309983.webp', 'web-app-manifest-512x512-1771309983.webp', 'uploads/avatars/web-app-manifest-512x512-1771309983.webp', 'avatars', 'image/webp', 'webp', 6966, NULL, 'synced', 1, '2026-02-17 06:33:03', NULL),
(83, 'Long-straight-hair-1772363734.webp', 'Long-straight-hair-1772363734.webp', 'uploads/products/Long-straight-hair-1772363734.webp', 'products', 'image/webp', 'webp', 52722, NULL, 'synced', 1, '2026-03-01 11:15:34', NULL),
(84, 'Frontalpixie-hair-1772363734.webp', 'Frontalpixie-hair-1772363734.webp', 'uploads/products/Frontalpixie-hair-1772363734.webp', 'products', 'image/webp', 'webp', 88108, NULL, 'synced', 1, '2026-03-01 11:15:34', NULL),
(85, 'Pixie-curls-hair.webp', '../media/Pixie-curls-hair.webp', 'uploads/products/../media/Pixie-curls-hair.webp', 'products', 'image/webp', 'webp', 164626, NULL, 'synced', 1, '2026-03-01 11:15:34', NULL),
(122, 'Bone-straight.webp', 'Bone-straight.webp', 'uploads/categories/Bone-straight.webp', 'categories', 'image/webp', 'webp', 552245, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(123, 'Body-wave.webp', 'Body-wave.webp', 'uploads/categories/Body-wave.webp', 'categories', 'image/webp', 'webp', 563942, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(124, 'Pixie-cut.webp', 'Pixie-cut.webp', 'uploads/categories/Pixie-cut.webp', 'categories', 'image/webp', 'webp', 557350, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(125, 'Pixie-curls.webp', 'Pixie-curls.webp', 'uploads/categories/Pixie-curls.webp', 'categories', 'image/webp', 'webp', 534015, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(126, 'Deep-wave.webp', 'Deep-wave.webp', 'uploads/categories/Deep-wave.webp', 'categories', 'image/webp', 'webp', 663050, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(127, 'Raw-hair.webp', 'Raw-hair.webp', 'uploads/categories/Raw-hair.webp', 'categories', 'image/webp', 'webp', 615095, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(128, 'Blunt-cut.webp', 'Blunt-cut.webp', 'uploads/categories/Blunt-cut.webp', 'categories', 'image/webp', 'webp', 563309, NULL, NULL, NULL, '2026-03-01 20:23:48', NULL),
(137, 'Frontalpixie-hair-1772363734.webp', '../products/Frontalpixie-hair-1772363734.webp', 'uploads/categories/../products/Frontalpixie-hair-1772363734.webp', 'categories', 'image/webp', 'webp', 88108, NULL, 'synced', 1, '2026-03-02 10:08:29', NULL),
(138, 'Pixie-curls-hair.webp', '../products/../media/Pixie-curls-hair.webp', 'uploads/categories/../products/../media/Pixie-curls-hair.webp', 'categories', 'image/webp', 'webp', 164626, NULL, 'synced', 1, '2026-03-02 10:08:29', NULL),
(139, 'Pixie-curls-hair-1772446289.webp', 'Pixie-curls-hair-1772446289.webp', 'uploads/categories/Pixie-curls-hair-1772446289.webp', 'categories', 'image/webp', 'webp', 164626, NULL, 'synced', 1, '2026-03-02 10:11:29', NULL),
(140, 'hero-1-1772462295-dabd09.png', 'hero-1.png', 'uploads/media/hero-1-1772462295-dabd09.png', 'media', 'image/png', 'png', 601385, NULL, NULL, 1, '2026-03-02 14:38:15', NULL),
(141, 'hero-2-1772462295-dafd2e.png', 'hero-2.png', 'uploads/media/hero-2-1772462295-dafd2e.png', 'media', 'image/png', 'png', 330362, NULL, NULL, 1, '2026-03-02 14:38:15', NULL),
(142, 'hero-3-1772462295-1fc65e.png', 'hero-3.png', 'uploads/media/hero-3-1772462295-1fc65e.png', 'media', 'image/png', 'png', 572050, NULL, NULL, 1, '2026-03-02 14:38:15', NULL),
(146, 'momo-payment-banner.png', 'momo-payment-banner.png', 'img/momo-payment-banner.png', 'media', 'image/png', 'png', 198660, NULL, 'static', 1, '2026-03-03 01:49:56', NULL),
(147, 'blog-glueless-wigs.png', 'blog-glueless-wigs.png', 'uploads/blog/blog-glueless-wigs.png', 'blog', 'image/png', 'png', 743118, NULL, 'synced', 1, '2026-03-03 01:50:00', NULL),
(148, 'blog-hair-comparison.png', 'blog-hair-comparison.png', 'uploads/blog/blog-hair-comparison.png', 'blog', 'image/png', 'png', 561138, NULL, 'synced', 1, '2026-03-03 01:50:00', NULL),
(149, 'blog-humidity-care.png', 'blog-humidity-care.png', 'uploads/blog/blog-humidity-care.png', 'blog', 'image/png', 'png', 830134, NULL, 'synced', 1, '2026-03-03 01:50:00', NULL),
(150, 'blog-bridal-hair.png', 'blog-bridal-hair.png', 'uploads/blog/blog-bridal-hair.png', 'blog', 'image/png', 'png', 757268, NULL, 'synced', 1, '2026-03-03 01:50:00', NULL),
(151, 'blog-lace-tinting.png', 'blog-lace-tinting.png', 'uploads/blog/blog-lace-tinting.png', 'blog', 'image/png', 'png', 696297, NULL, 'synced', 1, '2026-03-03 01:50:00', NULL),
(152, 'Bone-straight.webp', '../categories/Bone-straight.webp', 'uploads/blog/../categories/Bone-straight.webp', 'blog', 'image/png', 'webp', 552245, NULL, 'synced', 1, '2026-03-03 01:56:32', NULL),
(157, 'hero-1.png', 'hero-1.png', 'img/hero-1.png', 'media', '', 'png', 601385, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(158, 'hero-2.png', 'hero-2.png', 'img/hero-2.png', 'media', '', 'png', 330362, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(159, 'hero-3.png', 'hero-3.png', 'img/hero-3.png', 'media', '', 'png', 572050, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(160, 'noise.png', 'noise.png', 'img/noise.png', 'media', '', 'png', 54589, NULL, 'static', 1, '2026-03-03 05:38:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `subscribed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `title` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `admin_id`, `title`, `content`, `is_pinned`, `is_archived`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'mnjbuhnubn', 'bbhbuhbuhbu', 0, 0, NULL, '2026-02-19 02:51:49', '2026-02-19 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `guest_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled','refunded') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) DEFAULT '0.00',
  `tax_amount` decimal(10,2) DEFAULT '0.00',
  `discount_amount` decimal(10,2) DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT 'GHS',
  `shipping_first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `shipping_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Ghana',
  `shipping_postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_same_as_shipping` tinyint(1) DEFAULT '1',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `tracking_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `guest_email`, `guest_phone`, `status`, `payment_status`, `payment_method`, `payment_reference`, `subtotal`, `shipping_cost`, `tax_amount`, `discount_amount`, `total`, `currency`, `shipping_first_name`, `shipping_last_name`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_postal_code`, `shipping_phone`, `billing_same_as_shipping`, `notes`, `tracking_number`, `shipped_at`, `delivered_at`, `created_at`, `updated_at`) VALUES
(2, 'HA-20260219-198E', 6, 'styphler17@gmail.com', '+32467814742', 'delivered', 'paid', 'momo', NULL, '5460.00', '0.00', '0.00', '0.00', '5460.00', 'GHS', 'Stiffler', 'Awuah', 'Avenue de l\'Europe 11', 'Herstal', 'Greater Accra', 'Ghana', '4040', '+32467814742', 1, NULL, NULL, '2026-02-19 06:41:13', '2026-02-19 06:42:26', '2026-02-19 06:39:06', '2026-02-19 06:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `sku`, `quantity`, `unit_price`, `total_price`, `created_at`) VALUES
(4, 2, 24, NULL, 'Luxury Vietnamese Bone Straight', NULL, 'VBS-LUX-001', 1, '1200.00', '1200.00', '2026-02-19 06:39:06'),
(5, 2, 24, 6, 'Luxury Vietnamese Bone Straight', NULL, 'VBS-LUX-001', 1, '1200.00', '1200.00', '2026-02-19 06:39:06'),
(6, 2, 28, NULL, 'Sharp Blunt Cut Bob - #1B', NULL, 'BCB-005', 1, '580.00', '580.00', '2026-02-19 06:39:06'),
(7, 2, 28, 17, 'Sharp Blunt Cut Bob - #1B', NULL, 'BCB-005', 1, '580.00', '580.00', '2026-02-19 06:39:06'),
(8, 2, 33, NULL, 'Double Drawn Body Wave', NULL, 'DDBW-010', 2, '950.00', '1900.00', '2026-02-19 06:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_quantity` int(10) UNSIGNED DEFAULT '0',
  `stock_status` enum('in_stock','out_of_stock','backorder') COLLATE utf8mb4_unicode_ci DEFAULT 'in_stock',
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hair_type` enum('human_hair','synthetic','blend') COLLATE utf8mb4_unicode_ci DEFAULT 'human_hair',
  `texture` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length_inches` int(10) UNSIGNED DEFAULT NULL,
  `weight_grams` int(10) UNSIGNED DEFAULT NULL,
  `cap_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lace_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `density` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) DEFAULT '0',
  `bestseller` tinyint(1) DEFAULT '0',
  `new_arrival` tinyint(1) DEFAULT '0',
  `rating_avg` decimal(2,1) DEFAULT '0.0',
  `review_count` int(10) UNSIGNED DEFAULT '0',
  `virtual_try_on` tinyint(1) DEFAULT '0',
  `meta_title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `short_description`, `price`, `sale_price`, `cost_price`, `sku`, `stock_quantity`, `stock_status`, `category_id`, `brand`, `hair_type`, `texture`, `length_inches`, `weight_grams`, `cap_size`, `lace_type`, `density`, `color`, `featured`, `bestseller`, `new_arrival`, `rating_avg`, `review_count`, `virtual_try_on`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Brazilian Body Wave Lace Front', 'brazilian-body-wave-lace-front', 'Indulge in the effortless elegance of our Brazilian Body Wave Lace Front wig. Sourced from high-quality 10A human hair, this unit features a natural, voluminous wave pattern that remains bouncy and vibrant. The HD lace frontal ensures a seamless \"melt\" into your skin for an undetectable hairline.', 'High-quality 10A Brazilian human hair with 180% density and breathable HD lace.', '185.00', '159.99', NULL, 'BW-BODY-18', 24, 'in_stock', 2, 'Hair Aura', 'human_hair', '', NULL, NULL, NULL, NULL, '', '', 0, 0, 0, '0.0', 0, 0, 'Brazilian Body Wave Lace Front Wig | Premium Human Hair', 'Shop our premium Brazilian Body Wave Lace Front wig. High-quality 10A human hair, 180% density, and HD lace for a natural look.', 'brazilian body wave, lace front wig, human hair wig, HD lace wig, hair aura', 1, '2026-02-19 01:36:53', '2026-03-01 19:46:27', NULL),
(3, 'Body wave Special', 'body-wave-special', 'Our \"Body Wave Special\" is a curated luxury unit designed for maximum volume and glamor. This single-donor hair features an intense, deep wave pattern that is incredibly soft to the touch and easy to style. Perfect for those who want a dramatic yet natural appearance.', 'Luxury single-donor body wave with voluminous 200% density and natural luster.', '2700.00', '175.00', NULL, 'SKU-BW-SPEC', 28, 'in_stock', 2, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.0', 0, 0, 'Body Wave Special Luxury Wig | Extra Volume & Luster', 'Exclusively curated Body Wave Special wig with 200% density. Premium single-donor hair for a voluminous, glam look.', 'body wave special, luxury wig, high density wig, premium hair, hair aura', 1, '2026-02-19 01:36:53', '2026-03-01 19:46:27', NULL),
(21, 'Luxe Natural Curls', 'brazilian-curly-4', 'The Luxe Natural Curls wig offers tight, bouncy coils that mimic natural hair perfectly. This short, chic unit is designed for the modern woman who values style and ease. Low maintenance yet high impact, these curls are soft, tangle-free, and retain their shape wash after wash.', '', '250.00', NULL, NULL, 'SKU-CURLY-4', 10, 'in_stock', 2, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.0', 0, 0, 'Luxe Natural Curls Short Wig | Bouncy & Tangle-Free', 'Elegant Luxe Natural Curls wig featuring bouncy, short coils. 100% human hair, low maintenance, and tangle-free.', 'curly wig, natural curls, short curly wig, bouncy hair, hair aura', 1, '2026-02-19 01:36:53', '2026-03-01 19:46:27', NULL),
(23, 'Classic Silky Straight', 'straight-brown-hair', 'Achieve the sleekest look with our Classic Silky Straight bundles. This 10A Grade hair is flawlessly smooth from root to tip, reflecting light with a healthy, natural shine. It can be easily dyed, curled, or styled while maintaining its pristine straightness.', '', '850.00', NULL, NULL, 'SKU-STR-BRN', 10, 'in_stock', 2, 'Hair Aura', 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.0', 0, 0, 'Classic Silky Straight Hair | 10A Grade Human Hair', 'Experience the sleek perfection of Classic Silky Straight hair. 10A Grade, healthy shine, and versatile styling options.', 'silky straight hair, human hair bundles, straight hair ghana, premium hair', 1, '2026-02-19 01:36:53', '2026-03-01 19:46:27', NULL),
(24, 'Luxury Vietnamese Bone Straight', 'luxury-vietnamese-bone-straight', 'Experience the pinnacle of luxury with our Vietnamese Bone Straight hair. Sourced from single donors, this hair is naturally sleek, incredibly soft, and maintains its straightness even after washing.', 'Super double drawn, 100% human hair, Grade 12A.', '1200.00', NULL, NULL, 'VBS-LUX-001', 48, 'in_stock', 1, NULL, 'human_hair', 'Straight', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '4.9', 42, 0, 'Luxury Vietnamese Bone Straight | Super Double Drawn', 'The ultimate in luxury. Vietnamese Bone Straight hair, super double drawn and sourced from single donors for maximum silkiness.', 'vietnamese bone straight, super double drawn, hair aura, luxury hair', 1, '2026-02-19 02:27:23', '2026-03-01 11:28:49', NULL),
(25, 'Ocean Deep Wave Frontal Wig', 'ocean-deep-wave-frontal-wig', 'Our Ocean Deep Wave collection offers intense definition and a natural luster. This 13x4 frontal wig provides a seamless hairline.', '13x4 HD Lace Frontal, 200% Density.', '1500.00', NULL, NULL, 'ODW-FW-002', 30, 'in_stock', 5, NULL, 'human_hair', 'Deep Wave', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '4.8', 35, 0, 'Ocean Deep Wave Frontal Wig | HD Lace 200% Density', 'Get the perfect wet look with our Ocean Deep Wave 13x4 Frontal wig. HD lace and 200% density for a natural, voluminous finish.', 'ocean deep wave, frontal wig, HD lace, wet look hair', 1, '2026-02-19 02:27:23', '2026-03-01 19:46:27', NULL),
(28, 'Sharp Blunt Cut Bob - #1B', 'sharp-blunt-cut-bob-1b', 'A timeless classic. Our Blunt Cut Bob features precision-leveled ends.', '4x4 Closure wig, pre-plucked hairline.', '580.00', NULL, NULL, 'BCB-005', 18, 'in_stock', 7, NULL, 'human_hair', 'Straight', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, '0.0', 0, 0, 'Sharp Blunt Cut Bob #1B | Sleek 4x4 Closure Wig', 'A timeless, sophisticated look. Our sharp blunt cut bob features precision-leveled ends and a pre-plucked 4x4 closure.', 'blunt cut bob, bob wig, closure wig, sleek bob, hair aura', 1, '2026-02-19 02:27:24', '2026-03-01 19:46:27', NULL),
(29, 'Honey Blonde Straight Wig', 'honey-blonde-straight-wig', 'Turn heads with our pre-colored Honey Blonde Straight wig. Perfectly toned.', 'Color #27, 13x4 Frontal, HD Lace.', '1850.00', NULL, NULL, 'HBS-006', 15, 'in_stock', 1, NULL, 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, 'Honey Blonde', 0, 0, 0, '0.0', 0, 0, 'Honey Blonde Straight Wig | Color #27 HD Lace', 'Stunning Honey Blonde #27 Straight wig. 13x4 HD lace frontal for a seamless melt and head-turning appearance.', 'honey blonde wig, colored wig, straight frontal wig, blonde hair', 1, '2026-02-19 02:27:24', '2026-03-01 11:28:49', NULL),
(30, 'Kinky Straight 13x4 Frontal', 'kinky-straight-frontal', 'The perfect blend for natural hair. Mimics blown-out natural hair.', 'Natural texture, 180% density.', '1150.00', NULL, NULL, 'KS-007', 25, 'in_stock', 2, NULL, 'human_hair', 'Kinky Straight', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.0', 0, 0, 'Kinky Straight 13x4 Frontal | Natural Texture Melt', 'The perfect natural blend. Kinky Straight 13x4 frontal wig that mimics blown-out natural hair with 180% density.', 'kinky straight wig, natural hair blend, blow out texture, hair aura', 1, '2026-02-19 02:27:24', '2026-03-01 19:46:27', NULL),
(31, 'Tapered Cut Pixie Wig', 'tapered-cut-pixie', 'Chic and sophisticated. Highlighting your facial features.', 'Tapered back and sides.', '480.00', NULL, NULL, 'TCP-008', 50, 'in_stock', 3, NULL, 'human_hair', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.0', 0, 0, 'Tapered Cut Pixie Wig | Chic & Sophisticated Short Hair', 'Bold and chic. Our Tapered Cut Pixie wig highlights your features with a sophisticated, low-maintenance short style.', 'pixie wig, short hair wig, tapered cut, chic hair', 1, '2026-02-19 02:27:24', '2026-03-01 19:46:27', NULL),
(33, 'Double Drawn Body Wave', 'double-drawn-body-wave', 'Full from top to bottom. Maximum thickness and volume.', 'Super double drawn, thick ends.', '950.00', NULL, NULL, 'DDBW-010', 18, 'in_stock', 2, NULL, 'human_hair', 'Body Wave', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.0', 0, 0, 'Double Drawn Body Wave | Maximum Thickness & Volume', 'Full from top to bottom. Our super double drawn body wave offers maximum thickness and natural bounce.', 'double drawn hair, body wave, thick hair bundles, hair aura', 1, '2026-02-19 02:27:24', '2026-03-01 19:46:27', NULL),
(34, 'Pixie Curls', 'pixie-curls', 'The Pixie Curls unit is a vibrant, easy-to-wear short wig featuring tight, defined curls. Crafted from premium human hair, it provides a playful yet sophisticated look that requires minimal styling while offering maximum impact. Perfect for the woman on the go.', 'Short, bouncy pixie curls with premium definition and natural shine.', '2650.00', NULL, NULL, 'SKU-69A41AD4EF02C', 100, 'in_stock', 4, 'Hair Aura', '', '', 20, NULL, NULL, NULL, '', 'Black', 0, 0, 1, '0.0', 0, 0, 'Short Pixie Curls Human Hair Wig | Bouncy & Defined', 'Playful and sophisticated Pixie Curls short wig. Premium defined curls, minimal styling required, maximum impact.', 'pixie curls, short curly wig, human hair, hair aura', 1, '2026-03-01 10:54:12', '2026-03-02 17:44:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT '0',
  `sort_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `alt_text`, `is_primary`, `sort_order`, `created_at`) VALUES
(41, 1, '10-straight-hair.webp', '10-straight-hair', 1, 1, '2026-02-19 02:16:17'),
(42, 1, 'Bone-straight.webp', 'Bone-straight', 0, 2, '2026-02-19 02:16:17'),
(43, 1, 'Body-wave.webp', 'Body-wave', 0, 3, '2026-02-19 02:16:17'),
(44, 24, 'Bone-straight.webp', NULL, 1, 1, '2026-02-19 02:27:23'),
(45, 25, 'Body-wave.webp', NULL, 1, 1, '2026-02-19 02:27:23'),
(48, 28, '10-straight-hair.webp', NULL, 1, 1, '2026-02-19 02:27:24'),
(49, 29, 'Straight-hair.webp', NULL, 1, 1, '2026-02-19 02:27:24'),
(50, 30, 'Long-straight-hair-1772363734.webp', NULL, 1, 1, '2026-02-19 02:27:24'),
(51, 31, 'Frontalpixie-hair-1772363734.webp', NULL, 1, 1, '2026-02-19 02:27:24'),
(53, 33, 'Bouncy-hair.webp', NULL, 1, 1, '2026-02-19 02:27:24'),
(56, 34, 'Frontalpixie-hair-1772363734.webp', 'Frontalpixie-hair-1772363734', 1, 1, '2026-03-02 17:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_adjustment` decimal(10,2) DEFAULT '0.00',
  `stock_quantity` int(10) UNSIGNED DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `variant_value`, `sku`, `price_adjustment`, `stock_quantity`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 24, 'Size', '12 Inch', 'VBS-LUX-001-12', '0.00', 15, 1, 1, '2026-02-19 02:27:23'),
(2, 24, 'Size', '14 Inch', 'VBS-LUX-001-14', '100.00', 15, 1, 2, '2026-02-19 02:27:23'),
(3, 24, 'Size', '16 Inch', 'VBS-LUX-001-16', '200.00', 15, 1, 3, '2026-02-19 02:27:23'),
(4, 24, 'Size', '18 Inch', 'VBS-LUX-001-18', '300.00', 15, 1, 4, '2026-02-19 02:27:23'),
(5, 24, 'Size', '20 Inch', 'VBS-LUX-001-20', '450.00', 10, 1, 5, '2026-02-19 02:27:23'),
(6, 24, 'Size', '22 Inch', 'VBS-LUX-001-22', '600.00', 10, 1, 6, '2026-02-19 02:27:23'),
(7, 25, 'Size', '20 Inch', 'ODW-FW-20', '0.00', 10, 1, 1, '2026-02-19 02:27:24'),
(8, 25, 'Size', '22 Inch', 'ODW-FW-22', '150.00', 10, 1, 2, '2026-02-19 02:27:24'),
(9, 25, 'Size', '24 Inch', 'ODW-FW-24', '300.00', 10, 1, 3, '2026-02-19 02:27:24'),
(10, 25, 'Size', '26 Inch', 'ODW-FW-26', '450.00', 5, 1, 4, '2026-02-19 02:27:24'),
(17, 28, 'Size', '10 Inch', 'BOB-10', '0.00', 10, 1, 1, '2026-02-19 02:27:24'),
(18, 28, 'Size', '12 Inch', 'BOB-12', '60.00', 10, 1, 2, '2026-02-19 02:27:24'),
(19, 29, 'Size', '22 Inch', 'BLONDE-22', '0.00', 5, 1, 1, '2026-02-19 02:27:24'),
(20, 29, 'Size', '26 Inch', 'BLONDE-26', '300.00', 5, 1, 2, '2026-02-19 02:27:24'),
(21, 30, 'Size', '18 Inch', 'KS-18', '0.00', 10, 1, 1, '2026-02-19 02:27:24'),
(22, 30, 'Size', '22 Inch', 'KS-22', '180.00', 10, 1, 2, '2026-02-19 02:27:24'),
(23, 31, 'Size', 'Standard', 'TCP-STD', '0.00', 50, 1, 1, '2026-02-19 02:27:24'),
(26, 33, 'Size', '18 Inch', 'DDBW-18', '0.00', 10, 1, 1, '2026-02-19 02:27:24'),
(27, 33, 'Size', '22 Inch', 'DDBW-22', '150.00', 10, 1, 2, '2026-02-19 02:27:24'),
(28, 33, 'Size', '26 Inch', 'DDBW-26', '350.00', 5, 1, 3, '2026-02-19 02:27:24'),
(29, 34, '${name}', '${value}', '${sku}', '0.00', 10, 1, 0, '2026-03-01 10:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified_purchase` tinyint(1) DEFAULT '0',
  `is_approved` tinyint(1) DEFAULT '0',
  `helpful_count` int(10) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_alerts`
--

CREATE TABLE `stock_alerts` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_notified` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `notified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT '5',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `sort_order` int(11) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('customer','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `is_active` tinyint(1) DEFAULT '1',
  `is_banned` tinyint(1) DEFAULT '0',
  `email_verified` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `first_name`, `last_name`, `phone`, `avatar`, `role`, `is_active`, `is_banned`, `email_verified`, `created_at`, `updated_at`, `last_login`, `remember_token`, `remember_expires`) VALUES
(1, 'admin@hair-aura.debesties.com', '$2y$10$9hrn/d49Ei2OmTgSilnPPu7DoDi2qfyapg9A3/PY7LlaqCiQQmzHq', 'Hair', 'Aura', '+233508007873', 'web-app-manifest-512x512-1771309983.webp', 'admin', 1, 0, 1, '2026-02-11 20:33:35', '2026-03-03 04:38:46', '2026-03-03 05:38:46', NULL, NULL),
(2, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ama', 'Owusu', '+233241234567', NULL, 'customer', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL, NULL, NULL),
(3, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kwasi', 'Mensah', '+233551234567', NULL, 'customer', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL, NULL, NULL),
(4, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abena', 'Darko', '+233201234568', NULL, 'customer', 1, 0, 1, '2026-02-11 20:33:35', '2026-02-11 20:33:35', NULL, NULL, NULL),
(5, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Yaa', 'Asantewaa', '+233501234567', NULL, 'customer', 0, 1, 1, '2026-02-11 20:33:35', '2026-02-17 05:37:10', NULL, NULL, NULL),
(6, NULL, '$2y$10$9Vh2RZf0Dwjkc4GQwfqyt.j4HCvKihIPqYkBcts7dBf6JvxApa2kC', 'Stiffler', 'Awuah', '+32467814742', 'avatar_69969b8c157f00.81790273.jpg', 'customer', 1, 0, 0, '2026-02-19 03:36:24', '2026-02-19 06:42:36', '2026-02-19 06:42:36', '6873d8cd9bdf11a6e4d2318d0983c3e98d408556509f88418cb10251b0d9ff30', '2026-03-21 06:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `label` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ghana',
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `label`, `first_name`, `last_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `country`, `postal_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Shipping', 'Hair', 'Aura', '+233508007873', 'avenue de l\'europe 11', '', 'Herstal', 'wallonie', 'Ghana', '4040', 1, '2026-02-17 05:43:52', '2026-02-17 05:43:52'),
(2, 6, 'Shipping', 'Stiffler', 'Awuah', '+32467814742', 'Avenue de l\'Europe 11', '', 'Herstal', 'Greater Accra', 'Ghana', '4040', 1, '2026-02-19 06:39:06', '2026-02-19 06:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
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
  ADD KEY `idx_archived` (`is_archived`),
  ADD KEY `idx_notes_deleted` (`deleted_at`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
