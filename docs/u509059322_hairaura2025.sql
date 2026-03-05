-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2026 at 02:40 PM
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
(114, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 10:25:06'),
(115, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 12:27:56'),
(116, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 13:57:24'),
(117, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 15:55:00'),
(118, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 15:55:03'),
(119, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 16:22:24'),
(120, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 16:23:44'),
(121, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 17:58:35'),
(122, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 17:59:00'),
(123, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 18:00:51'),
(124, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 18:07:17'),
(125, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-03 19:01:48'),
(126, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 01:36:12'),
(127, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 01:37:21'),
(128, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 02:44:39'),
(129, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 06:16:40'),
(130, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 07:22:26'),
(131, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 07:22:42'),
(132, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 10:20:23'),
(133, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 23:20:44'),
(134, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-04 23:49:08'),
(135, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 06:44:29'),
(136, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 06:44:41'),
(137, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 07:47:05'),
(138, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 07:49:41'),
(139, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 08:07:18'),
(140, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 08:07:29'),
(141, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 10:13:25'),
(142, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 10:15:13'),
(143, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 10:33:52'),
(144, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 10:33:55'),
(145, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 11:46:23'),
(146, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 11:46:25'),
(147, 1, 'logout', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 12:28:54'),
(148, 1, 'login', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-05 12:29:04');

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
(1, 'How to Care for Your Human Hair Wig', 'how-to-care-human-hair-wig', 'Keep your investment looking flawless. Our 600-word masterclass covers washing, heat styling, and nighttime care specifically for the Ghana climate.', '<h2>Why Your Human Hair Wig Deserves V.I.P. Treatment</h2>\r\n<p>In the vibrant, bustling streets of Accra, your \"Hair Aura\" is your crowning glory. But unlike natural hair, a 100% human hair wig doesn\'t have a direct supply of natural oils from your scalp. This means that without the right maintenance, even the most expensive <a href=\"/shop/brazilian-bundles\">Brazilian bundles</a> can become dry, tangled, and lose their luster. Proper care isn\'t just about washing; it\'s about environmental strategy.</p>\r\n\r\n<h3>The Golden Rule of Washing</h3>\r\n<p>Many women in Ghana make the mistake of washing their units too frequently. Unless you are using heavy styling products every day, you should only wash your human hair wig every 10 to 14 wears. When you do wash, the technique is everything. Start by gently detangling with a wide-tooth comb from the ends moving upward. Use only sulfate-free shampoos—sulfates are harsh detergents that strip the cuticle, leading to the dreaded \"wig frizz\" that Accra humidity loves to exploit.</p>\r\n<p><strong>Pro Tip:</strong> Rinse your wig in lukewarm water, never hot. Hot water can damage the lace and weaken the hair knots, leading to shedding.</p>\r\n\r\n<h3>Deep Conditioning: Your Secret Weapon</h3>\r\n<p>Because the hair is essentially \"dead,\" it needs external moisture. Once a month, apply a deep conditioner or a hair mask. Wrap the unit in a plastic cap and let it sit for at least 30 minutes. If you have the time, use a steamer. This opens the hair cuticle and allows the moisture to penetrate deeply, ensuring that <a href=\"/shop/peruvian-straight-lace-front\">Peruvian straight</a> units stay silky and \"bone straight\" for much longer.</p>\r\n\r\n<h3>Styling and Heat Protection</h3>\r\n<p>We know you love your flat irons and curling wands! While human hair is versatile, heat is its number one enemy. Always apply a high-quality heat protectant spray before any styling tool touches the hair. Try to keep your tools below 180°C (350°F). If you can achieve your look with heatless methods—like flexi-rods or silk rollers—your unit will last twice as long.</p>\r\n\r\n<h3>Surviving the Tropical Climate</h3>\r\n<p>In Ghana, humidity and dust are constant factors. To protect your hair from the environment, use a lightweight silicone-based serum. This creates a microscopic barrier that prevents moisture from the air from entering the hair shaft, which is what causes frizz. If you are spending the day at the beach in Ada or a garden party in Aburi, consider a chic silk scarf to protect the hair from excessive sun and wind.</p>\r\n\r\n<h3>The Nighttime Routine</h3>\r\n<p>The fastest way to ruin a wig is to sleep in it. Friction against cotton pillowcases causes tangling and matting at the nape of the neck. Always remove your wig before bed and store it on a wig stand or a mannequin head. This allows the cap to \"breathe\" and helps the unit maintain its original shape. If you absolutely must sleep in it, use a 100% silk or satin bonnet.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>A quality human hair wig is an investment in your confidence. By following these professional steps, you ensure that your Hair Aura remains as stunning as the day you first unboxed it. Remember: Gentle handling today means a beautiful unit for years to come.</p>', 'Straight-hair.webp', 1, 'Wig Care', 'wig care, human hair, maintenance, washing', 'Human Hair Wig Care Guide Ghana | Long-Term Maintenance Tips', 'Expert 600-word guide on maintaining human hair wigs in Ghana. Learn washing, deep conditioning, and heat protection secrets to keep your wig looking new.', 1, 1, '2026-01-04 09:00:00', '2026-02-11 20:33:35', '2026-03-05 14:40:29', NULL),
(2, 'Choosing the Right Wig for Your Face Shape', 'choosing-wig-face-shape', 'Find the perfect wig style that complements your unique face shape.', '<h2>The Perfect Wig for Every Face</h2>\r\n<p>Not all wigs suit every face shape. Understanding your face shape is key to choosing a wig that enhances your natural beauty.</p>\r\n\r\n<h3>Oval Face Shape</h3>\r\n<p>Lucky you! Oval faces can pull off almost any wig style. Try:</p>\r\n<ul>\r\n<li>Long layers</li>\r\n<li>Bob cuts</li>\r\n<li>Curly or straight styles</li>\r\n</ul>\r\n\r\n<h3>Round Face Shape</h3>\r\n<p>Create the illusion of length with:</p>\r\n<ul>\r\n<li>Long, layered wigs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Height at the crown</li>\r\n<li>Avoid chin-length bobs</li>\r\n</ul>\r\n\r\n<h3>Square Face Shape</h3>\r\n<p>Soften angular features with:</p>\r\n<ul>\r\n<li>Wavy or curly textures</li>\r\n<li>Side parts</li>\r\n<li>Layers around the face</li>\r\n<li>Avoid blunt cuts</li>\r\n</ul>\r\n\r\n<h3>Heart Face Shape</h3>\r\n<p>Balance a wider forehead with:</p>\r\n<ul>\r\n<li>Chin-length bobs</li>\r\n<li>Side-swept bangs</li>\r\n<li>Volume at the jawline</li>\r\n</ul>\r\n\r\n<p>Visit Hair Aura to find your perfect wig match!</p>', 'blog_face_shape_2026.webp', 1, 'Wig Guide', 'face shape, wig selection, styling tips', 'Choose Wig for Face Shape Ghana | Hair Aura Guide', 'Find the perfect wig for your face shape. Expert guide from Hair Aura on selecting flattering wig styles.', 4, 1, '2026-01-07 09:00:00', '2026-02-11 20:33:35', '2026-03-05 14:40:29', NULL),
(3, 'Lace Front vs Full Lace Wigs: What\'s the Difference?', 'lace-front-vs-full-lace', 'The ultimate construction showdown. We break down the pros, cons, and price points of Lace Front vs Full Lace to help you invest wisely.', '<h2>The Construction Debate: Frontal vs Full</h2>\r\n<p>In the world of high-end hair, the terms \"Lace Frontal\" and \"Full Lace\" are the most common source of confusion for customers in Ghana. Given that these units are a significant investment, understanding the technical differences is crucial. Are you paying for styling versatility, or are you looking for the best price-to-durability ratio? Let\'s dive into the anatomy of a Hair Aura wig.</p>\r\n\r\n<h3>Lace Front Wigs: The Modern Professional\'s Choice</h3>\r\n<p>A <strong>Lace Front Wig</strong> is constructed with a lace portion only at the front perimeter (usually 13x4 or 13x6 inches). The rest of the wig cap is made of a more durable, breathable mechanical material where \"tracks\" or \"wefts\" are sewn. </p>\r\n<ul>\r\n    <li><strong>Pros:</strong> More affordable, easier to install for beginners, and generally more durable for everyday wear. Because the back is reinforced, it can handle frequent removals better.</li>\r\n    <li><strong>Cons:</strong> Limited styling. You can\'t wear this in a high ponytail or a bun because the \"tracks\" in the back would be visible. You are mostly limited to wearing the hair \"down\" or in a low ponytail.</li>\r\n</ul>\r\n<p><em>Browse our <a href=\"/shop/lace-front-wigs\">Lace Front Collection</a> for the perfect daily-driver unit.</em></p>\r\n\r\n<h3>Full Lace Wigs: The Celebrity Standard</h3>\r\n<p>A <strong>Full Lace Wig</strong> is a masterpiece of craftsmanship. The entire wig cap is made of lace, and every single hair strand is hand-tied into the base. This means that if you part the hair in the middle, the side, or even the very back, it looks like it is growing directly from your scalp.</p>\r\n<ul>\r\n    <li><strong>Pros:</strong> Maximum versatility. You can wear your hair in a high \"Abena\" ponytail, pigtails, or complex bridal updos. It is also the most breathable option, which is a huge plus in the Accra sun.</li>\r\n    <li><strong>Cons:</strong> Much higher price point due to the hundreds of hours of manual labor required. It is also more delicate—since the whole base is lace, it is more prone to tearing if you are rough during removal.</li>\r\n</ul>\r\n\r\n<h3>The 360 Lace Alternative: The Best of Both Worlds?</h3>\r\n<p>At <strong>Hair Aura</strong>, we often recommend the <a href=\"/shop/360-lace-frontal-wig\">360 Lace Frontal</a> as a middle ground. It has lace all around the perimeter but tracks in the center. This allows for high ponytails and updos at a lower cost than a full lace unit.</p>\r\n\r\n<h3>Which is Right for You?</h3>\r\n<p>If you are a \"style chameleon\" who loves changing your look every day and needs that high ponytail for a glamorous event at Polo Club, invest in <strong>Full Lace</strong>. If you are a busy professional woman who wants a flawless, natural hairline for the office but usually wears her hair down, <strong>Lace Front</strong> is the smarter, more economical choice.</p>\r\n\r\n<h3>Final Verdict</h3>\r\n<p>Construction matters. At Hair Aura, we use only premium Swiss and HD lace for both types, ensuring that regardless of your choice, the \"melt\" is always perfect. Check our <a href=\"/shop/full-lace-wigs\">Full Lace section</a> for the ultimate in luxury hair.</p>', 'blog_lace_comparison_2026.webp', 1, 'Wig Education', 'lace front, full lace, wig types, comparison', 'Lace Front vs Full Lace Wigs Comparison | Which to Buy?', 'A 600-word deep dive into wig construction. Learn the pros and cons of lace front and full lace wigs before you buy in Ghana.', 4, 1, '2026-01-10 09:00:00', '2026-02-11 20:33:35', '2026-03-05 14:40:29', NULL),
(4, '5 Trending Wig Styles for 2024', 'trending-wig-styles-2024', 'Stay ahead of the fashion curve. Discover the top 5 wig trends dominating the Ghana hair scene in 2024, from Butterfly Bobs to Kinky Blowouts.', '<h2>Your 2024 Hair Aura Roadmap</h2>\r\n<p>The hair scene in West Africa moves fast. Styles that were \"cool\" last December are already being replaced by more sophisticated, textured looks. As we move through 2024, the theme is \"Realistic Luxury.\" Women in Accra and Kumasi are moving away from overly shiny, synthetic-looking hair and embracing textures and colors that scream \"effortless wealth.\" Here are the top 5 trends you need to know.</p>\r\n\r\n<h3>1. The \"Butterfly Bob\"</h3>\r\n<p>Short hair is having a massive moment! The Butterfly Bob is a layered, voluminous short cut that focuses on movement and \"flicked\" ends. It is much more playful than the traditional blunt bob. It frames the face beautifully and is incredibly heat-friendly for the Ghana weather. Check out our <a href=\"/shop/bob-lace-front-wig\">12-inch bobs</a> to start your butterfly transformation.</p>\r\n\r\n<h3>2. Kinky Blowout Straight</h3>\r\n<p>The \"Natural Glam\" look is peaking. This style mimics African hair that has been freshly blown out and pressed. It has incredible volume and a slight coarseness that makes it look like it\'s growing directly from your scalp. It\'s the perfect \"boss lady\" look for the boardroom or a high-end dinner at Santoku.</p>\r\n\r\n<h3>3. \"Expensive\" Honey Blonde Highlights</h3>\r\n<p>Flat, one-dimensional colors are out. In 2024, it\'s all about multi-tonal highlights. Deep browns mixed with honey and caramel tones create a \"sun-kissed\" look that adds depth and makes the hair look healthier and more expensive. Our <a href=\"/shop/blonde-highlight-wig\">Blonde Highlight collection</a> is flying off the shelves for this very reason.</p>\r\n\r\n<h3>4. The 90s \"Pamela Anderson\" Updo</h3>\r\n<p>Nostalgia is powerful. Huge, messy-chic updos with tendrils framing the face are the top choice for weddings and galas this year. This style requires a <a href=\"/shop/360-lace-frontal-wig\">360 lace unit</a> or a full lace wig to look realistic, but the payoff is pure Hollywood glamour right here in Ghana.</p>\r\n\r\n<h3>5. Ultra-Glueless HD Units</h3>\r\n<p>This is more of a construction trend than a style, but it\'s changing how we wear hair. \"Wearing hair\" is no longer a commitment. The rise of the 5-minute <a href=\"/shop/glueless-wigs\">glueless install</a> means you can switch your style as often as you change your outfit. HD lace has become the standard—anything less is simply visible.</p>\r\n\r\n<h3>How to Style These Trends</h3>\r\n<p>Getting the trend right is about the quality of the hair. Synthetic hair can mimic these looks for a day, but for the movement and \"bounce\" required for the Butterfly Bob or 90s Updo, you need 100% Remy human hair. Shop our \"New Arrivals\" section to stay ahead of the crowd!</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>2024 is about expressing your inner aura with confidence. Whether you go short and sassy or long and natural, make sure your unit reflects the luxury you deserve. Visit Hair Aura in-store or online to see these trends in person.</p>', 'blog_trends_2024_2026.webp', 1, 'Trends', 'wig trends 2024, fashion, styles, Ghana', 'Top 5 Wig Trends Ghana 2024 | Butterfly Bobs & More', 'Discover the biggest wig trends in Ghana for 2024. From the Butterfly Bob to Kinky Blowouts, stay ahead of the fashion curve with our expert guide.', 5, 1, '2026-01-13 09:00:00', '2026-02-11 20:33:35', '2026-03-05 14:40:29', NULL),
(5, 'How to Secure Your Lace Front Wig', 'secure-lace-front-wig', 'Say goodbye to shifting wigs. Learn the safest and most effective ways to secure your lace front, including adhesive, tape, and glueless methods.', '<h2>Security is Confidence</h2>\r\n<p>There is nothing more distracting than being out at a social event and constantly checking if your wig has shifted. A secure install is the foundation of a great \"Hair Aura.\" But security shouldn\'t come at the cost of your natural edges. In this 600-word masterclass, we explore the best ways to keep your unit locked in place, whether you want a week-long hold or a daily removal option.</p>\r\n\r\n<h3>1. The Glue Method: The Long-Term Hold</h3>\r\n<p>For those who want to wake up with their hair already \"done\" for 3-5 days, adhesive (like Ghost Bond or Walker Tape) is the gold standard. \r\n<ul>\r\n    <li><strong>The Secret:</strong> Cleanliness. Use 90% isopropyl alcohol to remove all oils from your forehead before applying. </li>\r\n    <li><strong>Application:</strong> Apply three thin, even layers. Wait for each layer to turn completely transparent before applying the next. This ensures a \"melted\" look that won\'t turn white or flaky.</li>\r\n</ul>\r\n<p><strong>Warning:</strong> Always use a professional solvent to remove the wig. Never \"rip\" a glued wig off, or you will lose your natural hairline!</p>\r\n\r\n<h3>2. The Glueless Grip: The Healthy Choice</h3>\r\n<p>If you are worried about your edges, the glueless method is the way to go. We recommend a <strong>Velvet Wig Grip</strong>. These bands act as a \"velcro\" for your wig cap. They prevent the wig from sliding back without a single drop of chemicals. Most of our <a href=\"/shop/human-hair-wigs\">Hair Aura units</a> also come with internal adjustable straps and combs for extra security.</p>\r\n\r\n<h3>3. The Elastic Band Method</h3>\r\n<p>Adding a thick elastic band to the back of your wig is a DIY secret that stylists swear by. It pulls the lace flat against your forehead, creating a \"melted\" look even without glue. This is the perfect solution for the woman who wants to take her wig off every night to let her scalp breathe.</p>\r\n\r\n<h3>4. Protecting Your Edges</h3>\r\n<p>No matter which method you choose, your natural hair should be the priority. Always wear a wig cap to create a barrier. If you use glue, ensure it is applied to your skin, NOT your hair. Use a scalp protector before application to prevent irritation. At Hair Aura, we sell a range of <a href=\"/shop/hair-accessories\">Scalp Protectors and Edge Control</a> to keep you protected.</p>\r\n\r\n<h3>5. Maintenance: Surviving the Sweat</h3>\r\n<p>In Ghana\'s heat, sweat can settle under the lace and weaken the adhesive. If you feel your wig starting to lift, don\'t just add more glue. Use a hairdryer on a cool setting to dry the area, then tie it down with a silk scarf for 10 minutes. This often \"re-sets\" the bond without causing product buildup.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>A secure wig is a powerful wig. By choosing the right method for your lifestyle—whether it\'s the long-term bond of professional adhesive or the daily freedom of a glueless grip—you can focus on your day without a second thought about your hair. Shop our accessories to find your perfect security kit!</p>', 'blog_secure_wig_2026.webp', 1, 'Wig Tips', 'lace front, wig security, adhesive, application', 'How to Secure Lace Front Wig Ghana | Glue vs. Glueless', 'Stop your wig from sliding! Our 600-word guide covers the best ways to secure a lace front wig while protecting your natural edges.', 8, 1, '2026-01-16 09:00:00', '2026-02-11 20:33:35', '2026-03-05 14:40:29', NULL),
(6, 'Why Glueless Lace Front Wigs are the Ultimate Game Changer in Accra', 'glueless-lace-front-wigs-accra-guide', 'Discover why glueless wigs are becoming the top choice for women in Ghana. From protecting your edges to surviving the heat, we cover it all.', '<h2>The Rise of the Glueless Revolution</h2>\r\n<p>If you have been keeping an eye on the beauty and hair scene in Accra recently, you will have noticed a significant shift. While the traditional \"glued down\" installation still has its place, the <strong>glueless lace front wig</strong> has taken the city by storm. But why is this happening now? In this comprehensive guide, we explore why dropping the adhesive is the best decision you can make for your hair aura today.</p>\r\n\r\n<h3>1. Protecting Your Precious Edges</h3>\r\n<p>In many parts of West Africa, edge protection is a primary concern. The repeated use of strong adhesives and \"got2b\" style gels can lead to traction alopecia or localized thinning over time. Glueless wigs utilize adjustable straps, internal combs, and velvet wig grips to stay secure without a single drop of glue. This \"breathable\" approach allows your natural hairline to rest and recover, ensuring that when you do take the wig off, your natural edges are as thick and healthy as ever.</p>\r\n<p><em>Check out our <a href=\"/shop/lace-front-wigs\">latest glueless lace front collection</a> to see how natural the hairline can look even without adhesive.</em></p>\r\n\r\n<h3>2. Surviving the Accra Heat and Humidity</h3>\r\n<p>Let\'s be honest: Accra humidity and traditional wig glue do not always get along. There is nothing more stressful than feeling your lace begin to \"lift\" in the middle of a lunch date at Labone or during a wedding ceremony. Traditional adhesives can become \"white\" or tacky when exposed to sweat. Glueless wigs bypass this entire issue. Since there is no adhesive to melt, your look remains crisp and secure from morning until night, regardless of the humidity levels.</p>\r\n\r\n<h3>3. The Convenience Factor: 10-Minute Transformations</h3>\r\n<p>Modern women in Ghana are busier than ever. Between traffic on the N1 and navigating busy work schedules, who has two hours to sit for a professional install every week? A high-quality glueless wig from <strong>Hair Aura</strong> allows for a \"Pluck and Go\" experience. Once your unit is customized, putting it on takes less than 10 minutes. This versatility means you can switch from a professional <a href=\"/shop/human-hair-wigs\">straight bob</a> for the office to a glamorous <a href=\"/shop/human-hair-wigs\">body wave</a> for a night out at Garage or Front/Back.</p>\r\n\r\n<h3>4. Better Scalp Hygiene</h3>\r\n<p>One of the hidden benefits of glueless units is the ability to take them off every single night. This allows you to moisturize your natural hair, let your scalp breathe, and perform your nighttime hair routine. It significantly reduces the \"wig itch\" that often accompanies long-term glued installs. Hygiene is a key part of maintaining your <strong>aura</strong>, and the glueless method is the gold standard for scalp health.</p>\r\n\r\n<h3>Conclusion: Is it Time to Go Glueless?</h3>\r\n<p>The verdict is clear. For the woman who values her time, her health, and her edges, the glueless lace front wig is not just a trend—it\'s a lifestyle upgrade. By choosing premium human hair units, you get the same \"melted\" look of a traditional install with none of the risks.</p>\r\n<p><strong>SEO Tip:</strong> When searching for your next unit, look for \"HD Lace\" combined with \"Glueless\" for the most undetectable finish available in the Ghana market.</p>', 'blog_glueless_wigs_2026.webp', 1, 'Wig Guide', 'glueless wigs, Accra hair, edge protection, Ghana beauty, lace front', 'Glueless Lace Front Wigs Accra Guide | Hair Aura', 'Discover why glueless wigs are the top choice for women in Accra. Protect your edges and survive the heat with our expert 600-word guide.', 2, 1, '2026-01-19 09:00:00', '2026-03-03 00:56:52', '2026-03-05 14:40:29', NULL),
(7, 'Brazilian vs. Peruvian Hair: Which One Should You Buy in Ghana?', 'brazilian-vs-peruvian-hair-ghana-comparison', 'Torn between Brazilian and Peruvian hair? We break down the differences in texture, durability, and cost to help you choose the perfect bundles.', '<h2>Making the Ultimate Hair Choice</h2>\r\n<p>When you walk into any high-end hair boutique in East Legon or browse online, the terms \"Brazilian\" and \"Peruvian\" are thrown around constantly. But behind the marketing, there are real physical differences that affect how your hair looks, feels, and lasts. Given the investment involved in 100% human hair, making the right choice is essential for your long-term satisfaction.</p>\r\n\r\n<h3>Understanding Brazilian Hair: The Versatile Queen</h3>\r\n<p><strong>Brazilian hair</strong> is undoubtedly the most popular hair type in the West African market. It is known for its high luster and thickness. Because of its density, you often need fewer bundles to achieve a full look. One of the standout features of Brazilian hair is its ability to hold a curl. If you love the \"bouncy\" look of a <a href=\"/shop/human-hair-wigs\">body wave</a>, Brazilian is usually your best bet.</p>\r\n<ul>\r\n    <li><strong>Texture:</strong> Silky but slightly coarser than Indian hair.</li>\r\n    <li><strong>Luster:</strong> High shine.</li>\r\n    <li><strong>Best for:</strong> Glamorous, voluminous styles and holding heat curls.</li>\r\n</ul>\r\n\r\n<h3>The Peruvian Alternative: Effortless Sophistication</h3>\r\n<p><strong>Peruvian hair</strong> is often described as the \"cool sister\" of Brazilian hair. It is slightly thinner in individual strand diameter but has a very high density of strands. Because it is a bit coarser than Brazilian hair, it actually blends better with natural African hair that has been relaxed or pressed. It is incredibly soft and provides a more \"natural\" movement compared to the high-shine finish of Brazilian units.</p>\r\n<ul>\r\n    <li><strong>Texture:</strong> Coarse and thick but incredibly soft.</li>\r\n    <li><strong>Luster:</strong> Low to medium (more natural).</li>\r\n    <li><strong>Best for:</strong> Sleek straight looks and natural-looking volume.</li>\r\n</ul>\r\n\r\n<h3>The Durability Factor: surviving the Weather</h3>\r\n<p>In the climate of Ghana, humidity is a major factor. Brazilian hair tends to \"swell\" slightly more in humidity if not properly primed with serum. Peruvian hair, due to its texture, often behaves better in the damp air of coastal cities like Tema or Takoradi. However, both require high-quality maintenance. We always recommend using our <a href=\"/blog/how-to-care-human-hair-wig\">Human Hair Care Guide</a> to ensure your bundles last 2+ years.</p>\r\n\r\n<h3>Cost vs. Value in the Ghana Market</h3>\r\n<p>While prices fluctuate, Peruvian hair is often positioned as a more premium, \"exclusive\" option. However, at <strong>Hair Aura</strong>, we believe value comes from quality. Whether you choose Brazilian or Peruvian, the hair must be \"Virgin\" (unprocessed) to truly be worth the GHS you are spending.</p>\r\n\r\n<h3>Final Verdict</h3>\r\n<p>Choose <strong>Brazilian</strong> if you want that \"Red Carpet\" high-shine look and love big curls. Choose <strong>Peruvian</strong> if you want a softer, more natural \"effortless\" style that blends seamlessly with your pressed natural hair. Both are excellent choices found in our <a href=\"/shop/hair-extensions\">Hair Extensions collection</a>.</p>', 'blog_hair_comparison_2026.webp', 1, 'Hair Education', 'Brazilian vs Peruvian, hair bundles Ghana, virgin hair guide, hair texture', 'Brazilian vs Peruvian Hair Ghana Comparison | Hair Aura', 'Torn between Brazilian and Peruvian hair? Read our 600-word expert comparison on textures, durability, and cost for the Ghana market.', 1, 1, '2026-01-22 09:00:00', '2026-03-03 00:56:52', '2026-03-05 14:40:29', NULL),
(8, '5 Secret Tips to Protect Your Hair Extensions from Ghana Humidity', 'protect-hair-extensions-humidity-ghana', 'Humidity in Ghana can turn your sleek look into a frizzy mess in minutes. Here are 5 expert tips to keep your extensions perfect.', '<h2>The Battle Against the Frizz</h2>\r\n<p>Ghana\'s tropical climate is beautiful, but for hair extensions, the humidity can be a nightmare. You leave the house with a bone-straight <a href=\"/shop/peruvian-straight-lace-front\">Peruvian wig</a>, but by the time you reach Circle or the airport, your hair has doubled in volume and lost its shine. This is caused by the hair cuticle opening up and absorbing moisture from the air. To maintain your \"Aura,\" you need a specific environmental strategy.</p>\r\n\r\n<h3>1. Seal the Cuticle with the Right Serum</h3>\r\n<p>The biggest mistake is using heavy oils. Heavy oils attract dust and actually weigh the hair down without stopping frizz. Instead, look for a high-quality silicone-based serum. These serums create a microscopic barrier around each hair strand, preventing ambient moisture from entering. Apply it while the hair is slightly damp after washing, and a tiny \"refresher\" drop before you step outside.</p>\r\n\r\n<h3>2. The \"Cold Shot\" Technique</h3>\r\n<p>When styling your hair with a blow dryer or flat iron, always finish with the \"cold\" button. Heat opens the hair cuticle, while cold air seals it. By blowing cold air on your finished style for 60 seconds, you \"lock\" the style in place. This makes it much harder for humidity to disrupt the bonds of the hair.</p>\r\n\r\n<h3>3. Choose Your Texture Wisely</h3>\r\n<p>If you know you will be outdoors for a long event—like an outdoor wedding at the Botanical Gardens—rely on textures that embrace the moisture. <a href=\"/shop/deep-curly-human-hair-wig\">Deep curly</a> or water wave textures actually look *better* as they absorb a bit of moisture. Straight hair is the most vulnerable to humidity, so save the sleek looks for air-conditioned indoor events.</p>\r\n\r\n<h3>4. Nighttime Hydration</h3>\r\n<p>Frizzy hair is often \"thirsty\" hair. If your extensions are properly hydrated from the inside out, they won\'t seek moisture from the atmosphere. Use a deep conditioning treatment once a week. We recommend products that contain Marula or Argan oil, which are highly effective for the types of hair we sell at <strong>Hair Aura</strong>.</p>\r\n\r\n<h3>5. Use an Anti-Humidity Spray</h3>\r\n<p>There are professional \"finishing\" sprays designed specifically to combat West African levels of humidity. These are often labeled as \"humidity shields.\" One light mist over your finished install can act as an \"umbrella\" for your hair. These are available in our <a href=\"/shop/hair-accessories\">Accessories section</a>.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>You don\'t have to let the weather dictate your style. With these five secrets, you can walk confidently through any weather Accra throws at you. Remember, the secret to longevity is always starting with 100% human hair that hasn\'t been chemically compromised.</p>', 'blog_humidity_care_2026.webp', 1, 'Wig Care', 'humidity hair care, Ghana weather tips, frizz protection, hair extensions', 'Protect Hair Extensions Humidity Ghana | Expert Tips', 'Don\'t let Ghana humidity ruin your hair. 5 expert tips to stop frizz and keep your extensions sleek and shiny all day long.', 3, 1, '2026-01-25 09:00:00', '2026-03-03 00:56:52', '2026-03-05 14:40:29', NULL),
(9, 'The Ultimate Guide to Bridal Hair: Choosing a Wig for Your Ghana Wedding', 'bridal-wig-guide-ghana-wedding', 'Your wedding day is the ultimate \"Aura\" moment. Learn how to choose between frontals, closures, and 360 units for your traditional and white wedding.', '<h2>Your Big Day, Your Perfect Hair</h2>\r\n<p>In Ghana, a wedding is not just an event; it is a multi-day celebration of family, culture, and beauty. From the vibrant colors of the Kente at the traditional ceremony to the elegance of the white wedding, your hair must be versatile enough to complement every look. For many modern brides, a high-quality wig is the secret weapon for looking flawless under the tropical sun and the cameras.</p>\r\n\r\n<h3>The Traditional Ceremony: Volume and Culture</h3>\r\n<p>Traditional ceremonies often involve heavy jewelry and elaborate headwraps, but many brides choose to wear their hair down or in a sophisticated half-up, half-down style. For this day, we recommend a <strong>360 Lace Frontal</strong>. Because the lace goes all around the perimeter, your stylist can pin it up or create complex updos that look like they are growing directly from your scalp. It provides the most natural look when viewed from any angle during the dance-heavy celebrations.</p>\r\n<p><em>Browse our <a href=\"/shop/360-lace-frontal-wig\">360 lace collection</a> for maximum bridal versatility.</em></p>\r\n\r\n<h3>The White Wedding: Elegance and Undetectability</h3>\r\n<p>For the white wedding, most brides aim for a \"sleek and classic\" or \"romantic and wavy\" look. This is where <strong>HD Lace</strong> becomes essential. With so many close-up photos and videos being taken, you want your lace to be completely \"melted\" into your skin. An <a href=\"/shop/hd-transparent-lace-frontal\">HD Transparent Lace Frontal</a> is our top recommendation for the ceremony. It is virtually invisible even to the naked eye, ensuring your \"Hair Aura\" is nothing but perfection as you walk down the aisle.</p>\r\n\r\n<h3>Length and Texture: What Fits Your Crown?</h3>\r\n<p>Consider your dress neckline. If you have an off-the-shoulder dress, long 24-26 inch <a href=\"/shop/peruvian-straight-lace-front\">straight units</a> provide a dramatic, queen-like frame for your face. If your dress has intricate detailing on the shoulders or back, a chic <a href=\"/shop/bob-lace-front-wig\">bob wig</a> creates a clean, sophisticated line that doesn\'t distract from the gown.</p>\r\n\r\n<h3>The \"Reception Switch\"</h3>\r\n<p>One of the best reasons to use a wig for your wedding? You can change your entire look for the reception! Many brides start with a conservative straight style for the church and switch to a voluminous <a href=\"/shop/human-hair-wigs\">deep curly</a> unit for the evening party. Since our glueless units are so easy to install, this transition is seamless.</p>\r\n\r\n<h3>Bridal Preparation Checklist</h3>\r\n<ul>\r\n    <li>Choose your hair at least 1 month before the wedding.</li>\r\n    <li>Have a trial session with your stylist to test the install.</li>\r\n    <li>Deep condition the unit 3 days before the event.</li>\r\n    <li>Ensure you have a \"wig emergency kit\" with adhesive tape and a wide-tooth comb.</li>\r\n</ul>\r\n\r\n<h3>Conclusion</h3>\r\n<p>You deserve to feel like royalty on your wedding day. Investing in premium human hair ensures that your wedding photos look timeless. At <strong>Hair Aura</strong>, we specialize in helping brides find their perfect crown. Congratulations on your upcoming union!</p>', 'blog_bridal_hair_2026.webp', 1, 'Weddings', 'bridal hair Ghana, wedding wigs, HD lace bridal, Ghanaian bride tips', 'Bridal Wig Guide Ghana Wedding | Hair Aura', 'Choosing the perfect wig for your traditional or white wedding in Ghana. Expert advice on HD lace and 360 units for brides.', 0, 1, '2026-01-28 09:00:00', '2026-03-03 00:56:52', '2026-03-05 14:40:29', NULL),
(10, 'How to Master the \"Melt\": A Guide to Tinting Your Lace at Home', 'how-to-tint-lace-at-home-guide', 'Stop wearing \"white\" lace! Learn the professional secrets to tinting your lace frontal or closure to match your skin tone perfectly at home.', '<h2>The Secret to an Undetectable Wig</h2>\r\n<p>The difference between a wig that looks \"obvious\" and one that looks like it\'s growing from your scalp is often just a matter of color. Even high-quality <a href=\"/shop/hd-transparent-lace-frontal\">HD lace</a> sometimes requires a bit of tinting to match the diverse and beautiful skin tones we have here in Ghana. While a professional stylist is great, every wig lover should know how to \"melt\" their own lace at home.</p>\r\n\r\n<h3>1. Choosing Your \"Melt\" Method</h3>\r\n<p>There are three main ways to tint your lace, depending on your experience level and how permanent you want the result to be:</p>\r\n<ul>\r\n    <li><strong>The Foundation Method:</strong> The easiest and safest way. You simply apply your favorite cream or powder foundation to the underside of the lace.</li>\r\n    <li><strong>Lace Tint Sprays/Foams:</strong> Specifically designed products that come in various shades (Light Brown, Medium Brown, Dark Brown). They provide a more even, professional finish.</li>\r\n    <li><strong>The Tea/Coffee Method:</strong> An old-school but effective DIY method using hot water and tea bags to stain the lace.</li>\r\n</ul>\r\n\r\n<h3>2. The Step-by-Step Tinting Process</h3>\r\n<p>If you are using a tint spray or foam—which we highly recommend—follow these steps:</p>\r\n<ol>\r\n    <li>Turn your wig inside out so the lace is facing up.</li>\r\n    <li>Spray or apply foam evenly across the lace area, focusing on the parting and the hairline.</li>\r\n    <li>Use a blow dryer on a warm setting to \"set\" the tint. This prevents the color from transferring to your skin.</li>\r\n    <li>Check the color against your forehead. If it\'s too light, add another layer. If it\'s too dark, gently wipe with a damp cloth.</li>\r\n</ol>\r\n\r\n<h3>3. Avoiding the \"Purple\" or \"Grey\" Undertone</h3>\r\n<p>A common mistake is choosing a tint that is too cool-toned. Many West African skin tones have warm, golden, or reddish undertones. If you use a tint that is too \"ashy,\" your lace will look grey or purple once installed. Look for tints with names like \"Caramel,\" \"Chestnut,\" or \"Golden Brown.\"</p>\r\n\r\n<h3>4. The Importance of Knot Bleaching</h3>\r\n<p>Tinting is only half the battle. If those little black \"dots\" (the knots) are visible, the melt won\'t be perfect. While many of our <a href=\"/shop/human-hair-wigs\">Hair Aura units</a> come pre-plucked, we recommend professional knot bleaching for the ultimate scalp look. Once the knots are bleached, the tint will truly make the lace disappear.</p>\r\n\r\n<h3>5. Maintenance: When to Re-Tint</h3>\r\n<p>Tinting is not permanent. Sweat, washing, and friction will eventually fade the color. We recommend a quick \"refresh\" every 2-3 weeks to keep the melt looking fresh. Having a small bottle of lace tint spray in your beauty bag is a must-have for the modern hair enthusiast.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Mastering the \"melt\" is the final level of your hair journey. It gives you the confidence to wear your hair in any style, knowing that even from inches away, your lace is invisible. Check our <a href=\"/shop/hair-accessories\">Accessories section</a> for the tools you need to master this at home!</p>', 'blog_lace_tinting_2026.webp', 1, 'Wig Education', 'tinting lace, lace frontal melt, DIY wig tips, HD lace tinting', 'How to Tint Lace at Home Guide | Master the Melt', 'Stop wearing white lace! 600 words of expert advice on tinting your lace frontal to match your skin tone perfectly for a melted look.', 0, 1, '2026-01-31 09:00:00', '2026-03-03 00:56:52', '2026-03-05 14:40:29', NULL),
(11, 'The 2026 Guide to Ready-to-Wear Wigs in Accra', '2026-guide-ready-to-wear-wigs-accra', 'Fashion in Accra moves at the speed of light. In 2026, the standard is \"Ready to Wear\". Discover why convenience and HD lace are the ultimate lifestyle upgrade.', '<h2>The Ready-to-Wear Revolution in 2026</h2>\r\n<p>Accra is a city of movers and shakers. As we navigate through 2026, the modern Ghanaian woman is demanding more from her hair: more speed, more comfort, and a look that is \"effortlessly luxury\". The era of spending four hours in a salon chair just for a simple install is fading into the past, replaced by the **ready to wear wig** revolution. But what exactly makes a wig \"ready to wear\" in the 2026 landscape?</p>\r\n\r\n<h3>Why \"Ready to Wear\" is King</h3>\r\n<p>A true ready-to-wear unit is defined by its ability to be installed in under 10 minutes without professional help. At Hair Aura, our 2026 collection is engineered with the busy professional in mind. We have eliminated the stressful parts of wig ownership. These units come with pre-bleached knots—meaning you don\'t see those tiny black dots on the lace—and a pre-plucked hairline that mimics the natural \"melt\" flawlessly. In 2026, the goal is for no one to know where your forehead ends and your wig begins.</p>\r\n\r\n<h3>The Anatomy of a 2026 Ready-to-Wear Unit</h3>\r\n<p>When you search for **wigs in Accra Ghana**, you will see many claims, but a premium unit needs the right foundation. Our 2026 models feature: \r\n<ul>\r\n    <li>**Ultra-Thin HD Lace:** This is the most undetectable lace on the market, virtually disappearing into any skin tone.</li>\r\n    <li>**Adjustable Elastic Bands:** Forget messy glues; these internal bands provide a custom fit that stays secure through a full day of meetings or a night out at Polo Club.</li>\r\n    <li>**Breathable Mesh Caps:** Specifically designed for the Ghana climate to allow airflow and prevent the scalp from overheating.</li>\r\n</ul></p>\r\n\r\n<h3>Convenience Meets Luxury</h3>\r\n<p>The 2026 lifestyle is about reclaiming your time. Between navigating traffic on the George Bush Highway and managing a thriving career, who has the patience for high-maintenance hair? **Ready to wear wigs** allow you to switch your look as easily as you change your outfit. You can go from a sleek office bob to a voluminous evening style in minutes. This versatility is why these units are dominating the market this year.</p>\r\n\r\n<h3>Sustainability and Longevity</h3>\r\n<p>Investing in a Hair Aura ready-to-wear unit is also a move toward sustainable fashion. Because these wigs are built with 100% human hair and reinforced construction, they outlast synthetic alternatives by years. With proper care, a 2026 unit remains as vibrant and soft as the day you first unboxed it. We believe luxury should be an investment, not a recurring expense.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>The standard has shifted. Whether you are a dedicated wig enthusiast or a beginner looking for your first high-quality piece, the **ready to wear** movement in Accra is here to stay. Visit our showroom to find your perfect 2026 crown and experience the freedom of effortless beauty.</p>', 'blog_ready_to_wear_2026.png', 1, 'Trends', 'ready to wear wigs, wigs in Accra Ghana, 2026 fashion, HD lace', '2026 Ready-to-Wear Wigs Guide Accra | Hair Aura', 'Learn why ready-to-wear wigs are the gold standard for Accra women in 2026. Discover HD lace secrets and 10-minute install tips.', 0, 1, '2026-02-03 09:00:00', '2026-03-05 00:16:41', '2026-03-05 14:40:29', NULL),
(12, 'Beyond the Frontal: Why Lace Closure Wigs are King in 2026', 'lace-closure-wigs-vs-frontals-2026', 'Is the frontal era over? We explore why 5x5 and 6x6 lace closure wigs are dominating the Ghana hair scene in 2026 for their durability and natural look.', '<h2>The Return of the Closure</h2>\r\n<p>For years, the 13x4 frontal was the undisputed champion of the Ghana hair scene. If you wanted that \"ear-to-ear\" melt, you had to have a frontal. But as we enter 2026, a significant shift is occurring. Modern customers are moving back toward the **lace closure wig**, specifically the larger 5x5 and 6x6 variations. This post explores why these units are being hailed as the \"smarter\" choice for **human hair wigs Ghana** enthusiasts today.</p>\r\n\r\n<h3>The 5x5 and 6x6 Advantage</h3>\r\n<p>In the past, closures were limited. You had a tiny 4x4 square that limited your parting options. 2026 has changed all that. The modern 5x5 and 6x6 closures provide a deep parting area that allows for sophisticated middle and side parts that look just as natural as a frontal. You get the \"scalp\" look across the entire crown of your head, which is where it matters most for realism.</p>\r\n\r\n<h3>Why Closures are King in 2026</h3>\r\n<p>**1. Unmatched Durability:**\r\nLace frontals are delicate. The lace extends all the way to the ears, where sweat and friction often cause tearing or \"lifting.\" A **lace closure wig** has a more reinforced cap construction, making it significantly more durable for everyday wear. For the woman who wants her wig to last 2+ years, a closure is the logical choice.</p>\r\n<p>**2. The Glueless Freedom:**\r\nMost frontals require some form of adhesive to stay flat at the ears. Closures, however, are essentially glueless by design. In 2026, Ghanaian women are prioritizing the health of their natural edges. By choosing a closure, you eliminate the need for glue, allowing your natural hairline to breathe and thrive.</p>\r\n<p>**3. Maintenance Made Easy:**\r\nLet\'t be honest: maintaining a frontal is a part-time job. Between \"re-melts\" and cleaning glue residue, it can be exhausting. A closure wig requires almost zero daily maintenance. You put it on, adjust the straps, and you are ready to face the world.</p>\r\n\r\n<h3>Human Hair Quality in Ghana</h3>\r\n<p>When searching for **human hair wigs Ghana**, quality is paramount. At Hair Aura, our closure units are made with the same premium, single-donor hair as our most expensive frontals. You are not compromising on the hair quality—you are simply choosing a more practical and reliable construction. Whether it is a silky straight unit or a bouncy body wave, the closure offers a seamless look that stands the test of time.</p>\r\n\r\n<h3>Which One Should You Choose?</h3>\r\n<p>If you are a celebrity or a \"style chameleon\" who needs to pull her hair back into a high ponytail every day, stay with the frontal. But if you are a busy, stylish woman who wants a flawless middle part, a healthy hairline, and a wig that stays looking new for years, the 5x5 or 6x6 **lace closure wig** is your best friend in 2026.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Trends come and go, but practicality combined with luxury never goes out of style. The closure revolution is about giving you more confidence with less effort. Explore our 2026 closure collection and find your perfect, low-maintenance match today.</p>', 'blog_lace_closure_vs_frontal_2026.png', 1, 'Wig Guide', 'lace closure wigs, human hair wigs Ghana, 2026 trends, glueless wigs', 'Lace Closure Wigs vs Frontals 2026 | Hair Aura Ghana', 'Is the frontal era over? Discover why lace closure wigs are the smarter investment in 2026 for durability and natural looks in Ghana.', 1, 1, '2026-02-06 09:00:00', '2026-03-05 00:16:42', '2026-03-05 14:40:29', NULL),
(13, 'Short & Bold: Pixie Cut and Bob Wig Trends for 2026', 'pixie-cut-and-bob-wig-trends-2026', 'Short hair is the ultimate power move in 2026. Discover the sharpest bobs and most sophisticated pixie cuts trending in Accra right now.', '<h2>Short Hair, Big Confidence</h2>\r\n<p>There is an old saying that a woman who cuts her hair is about to change her life. In 2026, Ghanaian women are embracing this sentiment more than ever, but they are doing it with the versatility of wigs. The **pixie cut wig** and the sharp **bob wig** have emerged as the definitive power styles for the year. Short hair is no longer just a \"practical choice\" for the heat; it is a high-fashion statement of confidence and sophistication.</p>\r\n\r\n<h3>The 2026 \"Glass Bob\" Trend</h3>\r\n<p>The standard for bobs in 2026 is the \"Glass Bob.\" This is a razor-sharp, perfectly leveled cut that has a mirror-like shine. Whether it is a classic 10-inch or a more modern 14-inch length, the bob wig provides a clean silhouette that complements both power suits and evening gowns. In the bright Accra sun, the way our premium human hair reflects light makes the \"Glass Bob\" the most head-turning style of the season.</p>\r\n\r\n<h3>The Sophisticated Pixie</h3>\r\n<p>For the truly bold, the **pixie cut wig** is the ultimate choice. Our 2026 pixie collection focuses on \"tapered elegance.\" These units feature closely cropped backs and sides with more volume and texture at the crown. This contrast draws attention to the eyes and cheekbones, providing a facelift-like effect that is incredibly flattering. Best of all? It is the coolest option for the tropical climate, allowing your neck and shoulders to breathe while you look effortlessly chic.</p>\r\n\r\n<h3>Color Play: Beyond Natural Black</h3>\r\n<p>While natural black remains a staple, 2026 is seeing a surge in \"muted luxury\" colors for short hair. Honey blonde highlights, deep chocolate browns, and even subtle burgundy tones are being used to add depth and dimension to pixie cuts and bobs. Short hair allows for more adventurous color choices because it doesn\'t overwhelm the face. Our custom-colored units are designed to complement the warm undertones of West African skin perfectly.</p>\r\n\r\n<h3>Maintenance for Short Wigs</h3>\r\n<p>Short wigs are often perceived as \"easier,\" but they still require the right touch. To keep your **bob wig** looking sharp, avoid heavy oils that can weigh down the hair and kill the bounce. Use a lightweight heat protectant and a high-quality flat iron to keep those ends crisp. For the **pixie cut wig**, a small amount of styling foam or a \"holding\" serum can help define the texture and keep those layers in place all day long.</p>\r\n\r\n<h3>Why Short is Better in 2026</h3>\r\n<p>Beyond fashion, short hair represents a modern, progressive lifestyle. It is for the woman who has nothing to hide. It is the style of founders, executives, and icons. At Hair Aura, we have curated a selection that ensures \"short and bold\" doesn\'t mean sacrificing the luxury and softness of 100% human hair.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>If you have been waiting for a sign to try a shorter style, this is it. 2026 is the year to step out of your comfort zone and into a shorter, sharper version of yourself. Visit us to explore the textures and cuts that are defining the new Accra aesthetic.</p>', 'blog_pixie_bob_trends_2026.webp', 1, 'Trends', 'pixie cut wig, bob wig, short wig trends 2026, Accra fashion', 'Pixie Cut & Bob Wig Trends 2026 | Hair Aura Ghana', 'Short hair is the style of the year. Explore the latest pixie cut and bob wig trends in 2026 for a bold, sophisticated Ghanaian look.', 0, 1, '2026-02-09 09:00:00', '2026-03-05 00:16:42', '2026-03-05 14:40:29', NULL);
INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `category`, `tags`, `meta_title`, `meta_description`, `view_count`, `is_published`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'Mastering the Wave: Curls & Body Wave Wig Maintenance', 'curly-and-body-wave-wig-maintenance-2026', 'Defined curls and soft waves are the heart of the Hair Aura aesthetic. Learn how to keep your curly and body wave wigs bouncy and tangle-free in 2026.', '<h2>The Allure of the Wave</h2>\r\n<p>There is something undeniably magnetic about a voluminous **body wave wig** or a high-definition **curly wig**. Texture adds life, movement, and a touch of romance to any look. In the 2026 beauty landscape, \"Texture is Luxury.\" However, any hair enthusiast in Ghana knows that maintaining that \"fresh out of the box\" bounce requires more than just good luck—it requires a proven maintenance strategy.</p>\r\n\r\n<h3>The 2026 Approach to Hydration</h3>\r\n<p>In the past, we over-relied on heavy mousses and gels to \"tame\" curls. In 2026, the trend is \"Light and Airy.\" Curls and waves are most beautiful when they can move freely in the breeze. The secret is internal hydration. Because human hair is no longer attached to a scalp, it cannot hydrate itself. This means you must manually provide the moisture that curls crave.</p>\r\n\r\n<h3>The \"Re-Wet and Set\" Method</h3>\r\n<p>The most important rule for **curly wigs** in 2026 is: **Never brush your curls when they are dry.** This is the fastest way to cause frizz and damage the curl pattern. Instead, use a spray bottle filled with a mixture of 90% water and 10% high-quality leave-in conditioner. Generously mist your unit until damp, detangle gently with your fingers or a wide-tooth comb starting from the ends, and let it air-dry. This \"sets\" the curls into their natural form, providing definition without the \"crunchy\" feeling of old-school gels.</p>\r\n\r\n<h3>Keeping your Body Wave Bouncy</h3>\r\n<p>The **body wave wig** is beloved for its soft, elegant \"S\" pattern. To keep this pattern from falling flat, you must be careful with heat. While our human hair can handle styling, excessive flat-ironing will eventually \"train\" the hair to stay straight. For 2026, we recommend heatless styling. Large flexi-rods or satin rollers applied at night can maintain that beautiful wave pattern indefinitely without the risk of heat damage.</p>\r\n\r\n<h3>Nighttime Protection: The Non-Negotiable</h3>\r\n<p>Accra nights can be humid, and friction against a cotton pillowcase is the enemy of texture. The friction causes the hair cuticle to roughen up, leading to tangles at the nape of the neck. In 2026, a 100% silk or satin bonnet is a non-negotiable accessory for any wig owner. If you have a particularly long unit, consider a loose braid before bed to keep the hair from matting while you sleep.</p>\r\n\r\n<h3>The Environment: Humidity Strategy</h3>\r\n<p>Ghana\'s climate is the true test of any wig. For curly and wavy textures, humidity can actually be an ally if your hair is properly \"sealed.\" Use a lightweight silicone-based serum as the final step in your routine. This creates a microscopic barrier that prevents the hair from absorbing too much atmospheric moisture, ensuring your **body wave wig** stays sleek and your **curly wigs** stay defined, even on a humid day at the coast.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Mastering your waves is about understanding the science of hair. By treating your units with the right hydration and the right protection, you ensure that your \"Hair Aura\" remains as vibrant and youthful as the day you first put it on. Luxury is sustained through care.</p>', 'blog_body_wave_maintenance_2026.webp', 1, 'Wig Care', 'curly wigs, body wave wig, wig maintenance Ghana, 2026 hair care', 'Curly & Body Wave Maintenance 2026 | Hair Aura Ghana', 'Keep your curls defined and waves bouncy. Our 2026 guide covers the re-wet and set method and nighttime care for Ghanaian humidity.', 0, 1, '2026-02-12 09:00:00', '2026-03-05 00:16:42', '2026-03-05 14:40:29', NULL),
(15, 'Cultural Identity: Afro Wigs and Braided Wigs for the Modern Woman', 'afro-and-braided-wigs-2026-trends', 'Celebrate your heritage with the ultimate convenience. Explore the rising popularity of premium braided wigs and afro wigs in 2026 Ghana.', '<h2>The Crown of Heritage in 2026</h2>\r\n<p>Fashion and identity have always been inseparable in West Africa. As we navigate the global trends of 2026, we are seeing a beautiful, localized movement: the celebration of natural hair textures and traditional craftsmanship through the medium of high-end wigs. The **afro wig** and the **braided wigs** are no longer just \"backup styles\"—they are center-stage trends that allow the modern Ghanaian woman to embrace her heritage with the convenience of 2026 technology.</p>\r\n\r\n<h3>The 2026 Afro Aesthetic: Textures that Speak</h3>\r\n<p>The **afro wig** of 2026 is a far cry from the synthetic \"costume\" pieces of the past. Today\'s premium units use high-quality human hair that has been meticulously processed to mimic kinky, coily, and 4C textures. These units are breathable, lightweight, and incredibly soft. They provide the look of years of healthy natural hair growth in seconds. For the woman who loves her natural texture but wants a break from the intensive daily maintenance of \"shrinking\" and \"detangling,\" the 2026 afro wig is a life-changing alternative.</p>\r\n\r\n<h3>Braided Wigs: The Art of Convenience</h3>\r\n<p>Traditional braiding is an art form, but let\'s be honest: sitting for 8 to 12 hours in a salon chair is a luxury many of us can no longer afford. The rise of the **braided wigs** in 2026 is driven by the demand for time-efficiency. Our luxury collection features hand-tied, knotless braids on full lace or HD lace foundations. The results are undetectable. You get a perfect, symmetrical set of braids that would normally cost a full day of your time, but instead, you can install them in less than 5 minutes. They are lightweight, tension-free, and perfect for protecting your natural scalp from the weight of traditional extensions.</p>\r\n\r\n<h3>The Power of Versatility</h3>\r\n<p>Why choose between a sleek bob and a full head of braids? 2026 is about having the freedom to be both. You can wear a professional straight unit to the office on Monday and switch to a culturally significant **afro wig** for a gallery opening on Wednesday. This versatility allows you to express different facets of your personality and identity without permanent changes to your natural hair. It is the ultimate form of self-expression.</p>\r\n\r\n<h3>Care and Longevity for Specialty Units</h3>\r\n<p>Specialty units like braided wigs require unique care. You don\'t wash them as you would a straight unit. Instead, you focus on scalp hygiene and keeping the lace clean. For the **afro wig**, maintaining the \"kink\" without it turning into \"matting\" requires specific hydrating sprays and minimal manipulation. In 2026, we sell a dedicated \"Heritage Care Kit\" designed to keep these specialized textures looking fresh for years.</p>\r\n\r\n<h3>Conclusion: Reclaiming the Crown</h3>\r\n<p>The 2026 hair scene in Ghana is a celebration of the past and the future. By combining traditional styles with modern wig construction, we are giving women the tools to wear their culture with pride and ease. Your \"Hair Aura\" is a reflection of who you are, where you come from, and where you are going. Visit us to find the crown that speaks your language.</p>', 'blog_braided_afro_wigs_2026.webp', 1, 'Trends', 'braided wigs, afro wig, cultural hair trends 2026, natural hair wigs', 'Afro & Braided Wigs Trends 2026 | Hair Aura Ghana', 'Celebrate your heritage with the ultimate 2026 convenience. Explore the rising popularity of premium braided wigs and afro wigs in Ghana.', 0, 1, '2026-02-15 09:00:00', '2026-03-05 00:16:42', '2026-03-05 14:40:29', NULL),
(16, 'The Science of Shine: 2026 Luxury Extension Maintenance', 'luxury-extension-maintenance-guide-2026', 'Invested in premium extensions? Learn the 2026 secret to maintaining that diamond-like shine and silkiness through the Accra humidity.', '<h2>Preserving the Aura of Luxury</h2>\r\n<p>Buying premium human hair extensions in Ghana is an investment in your personal brand. In 2026, high-quality hair is more than just an accessory; it is a statement of status and self-care. But even the finest Peruvian or Brazilian hair can lose its luster if not treated with the right scientific approach. At Hair Aura, we have developed the definitive 2026 guide to maintaining that \"just-installed\" silkiness for months on end.</p>\r\n\r\n<h3>The Mineral Water Secret</h3>\r\n<p>One of the biggest hidden enemies of hair extensions in Accra is the mineral content in our tap water. Hard water can lead to mineral buildup, making the hair feel stiff and dry over time. In 2026, we recommend a final rinse with bottled or filtered water after every wash. This simple step ensures that no harsh minerals remain on the hair cuticle, allowing the natural shine of the human hair to beam through.</p>\r\n\r\n<h3>The 2026 Shampoo Protocol</h3>\r\n<p>Sulfate-free is no longer enough. For 2026, we look for pH-balanced, nutrient-dense cleansing systems. Your extensions do not receive natural oils from your scalp, so you must infuse them with moisture during every wash. Avoid vigorous rubbing; instead, gently \"smooth\" the shampoo down the length of the hair. This prevents tangling and preserves the integrity of the hair strands.</p>\r\n\r\n<h3>Advanced Heat Styling</h3>\r\n<p>We all love a sleek bone-straight look, but excessive heat is the primary cause of damage. In 2026, the era of \"cranking the flat iron to 450 degrees\" is over. Modern extensions are of such high quality that they only require moderate heat (300-350 degrees) combined with a high-end silk-infusion heat protectant. This \"seals\" the cuticle without burning it, resulting in a finish that looks like liquid gold.</p>\r\n\r\n<h3>The Nightly Ritual</h3>\r\n<p>Your hair goes through a lot during the day. At night, it needs a recovery period. In addition to using a silk pillowcase, we recommend applying a pea-sized amount of light argon or marula oil to the ends of your extensions before bed. This prevents the ends from becoming brittle—a common issue in the dry Harmattan season—and ensures your hair remains bouncy and tangle-free by morning.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Luxury maintenance isn\'t hard; it just requires consistency. By following the 2026 Science of Shine protocol, you protect your investment and ensure you always step out with your aura at its most radiant. Explore our recommended care products in-store today.</p>', 'blog_luxury_extension_care_2026.png', 1, 'Wig Care', 'extension maintenance, human hair care, 2026 beauty tips', '2026 Luxury Extension Maintenance | Hair Aura Accra', 'Keep your hair extensions silky and shiny in 2026. Discover our professional maintenance protocol for premium human hair in Ghana.', 0, 1, '2026-02-18 09:00:00', '2026-03-05 00:23:36', '2026-03-05 14:40:29', NULL),
(17, 'Bridal Elegance: The Ultimate 2026 Wedding Wig Guide', 'bridal-wig-trends-ghana-2026', 'For the 2026 bride, the hair is the centerpiece. Discover the most elegant bridal wig trends and installation secrets for your big day in Ghana.', '<h2>Your Biggest Day, Your Best Hair</h2>\r\n<p>The Ghanaian wedding scene in 2026 is a masterpiece of tradition and modern luxury. For the bride, every detail must be perfect, but nothing frames the face quite like the hair. Whether it is for the traditional engagement or the white wedding, the \"Bridal Wig\" has become the preferred choice for 2026 brides who want a flawless, versatile look that stays perfect from the morning prep to the final dance at the reception.</p>\r\n\r\n<h3>The Timeless Hollywood Wave</h3>\r\n<p>The most requested bridal style in 2026 is the Hollywood Wave. This look requires a high-density **body wave wig** that can hold a structured, elegant wave. The key to the 2026 bridal look is \"volume without weight.\" Our premium HD lace units allow for a hairline that is invisible even to High-Definition wedding cameras, ensuring that every photo captures only your beauty, not your hair secret.</p>\r\n\r\n<h3>The Traditional Low Bun</h3>\r\n<p>For the traditional ceremony, many 2026 brides are opting for the sophisticated low bun. This is achieved using a **lace closure wig** or a frontal unit with enough length to be swept back gracefully. This style highlights traditional accessories and jewelry, providing a regal silhouette that pays homage to Ghanaian heritage. In 2026, the bun is often accented with \"glass skin\" edges—hairlines that are melted so perfectly they look like an extension of the forehead.</p>\r\n\r\n<h3>Installation Strategy for Brides</h3>\r\n<p>You have enough to worry about on your wedding day. In 2026, we recommend a professional \"Bridal Install\" two days before the ceremony. This allows the lace to settle and ensures that the unit is secure for all the hugging and dancing that is to come. For destination weddings, our **ready to wear wigs** offer a stress-free alternative that can be self-installed if a stylist is not available, without sacrificing the premium finish.</p>\r\n\r\n<h3>Bridal Hair Care: The Morning Of</h3>\r\n<p>Avoid excessive products on the morning of your wedding. A bit of anti-humidity spray is essential for the Accra climate, but you want the hair to move naturally. If you are wearing a veil, ensure your stylist has a secure method for pinning it to the wig cap without tearing the delicate HD lace. In 2026, we provide a \"Bridal Emergency Kit\" with every wedding unit purchase, including extra pins, lace melt spray, and a small silk scarf.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Your wedding is a once-in-a-lifetime event. You deserve a crown that reflects your inner radiance. At Hair Aura, we specialize in making bridal dreams come true through the art of luxury hair. Book your bridal consultation today and let us help you find your perfect 2026 wedding hair.</p>', 'blog_bridal_trends_2026.png', 1, 'Bridal', 'bridal wigs Ghana, wedding hair trends 2026, bridal install', '2026 Bridal Wig Guide Ghana | Hair Aura Wedding', 'Discover the most elegant 2026 bridal wig trends in Ghana. From Hollywood waves to sophisticated buns, find your perfect wedding hair.', 1, 1, '2026-02-21 09:00:00', '2026-03-05 00:23:36', '2026-03-05 14:40:29', NULL),
(18, 'The Raw Donor Difference: Why 2026 is the Year of Raw Hair', 'raw-donor-hair-vs-processed-2026', 'In 2026, purity is the ultimate luxury. Learn why raw donor hair is the premium choice for women who want the absolute best human hair in Ghana.', '<h2>The Pursuit of Purity</h2>\r\n<p>As the wig industry in Ghana grows, so does the sophistication of the consumer. In 2026, the savvy shopper is no longer just looking for \"human hair\"; they are looking for **raw donor hair**. But what exactly is the \"Raw Difference,\" and why is it worth the premium price tag? This year, we are seeing a massive shift toward raw hair as the ultimate standard for luxury and longevity.</p>\r\n\r\n<h3>What is Raw Hair in 2026?</h3>\r\n<p>Raw hair is hair in its most natural state. It has never been chemically processed for texture or color. It comes from a single donor, meaning the cuticles are all aligned in the same direction. This is naturally the highest quality of **human hair wigs Ghana** has to offer. In 2026, where \"authenticity\" is the buzzword of the year, raw hair is the only choice for the purist.</p>\r\n\r\n<h3>Why Raw Hair is Worth the Investment</h3>\r\n<p>**1. Unmatched Longevity:**\r\nProcessed hair is beautiful but has a shorter lifespan because the chemical treatments eventually break down the hair fibers. Raw donor hair, if cared for properly, can last 3 to 5 years. It is a long-term investment that actually saves you money over time.</p>\r\n<p>**2. Superior Color Customization:**\r\nBecause raw hair has never been bleached or dyed, it takes color beautifully. If you want that perfect \"Level 10 Platinum Blonde\" or a specific vibrant tone, raw hair is the only foundation that can achieve it without losing its silkiness and strength.</p>\r\n<p>**3. Natural Movement:**\r\nProcessed hair often has a \"uniform\" look that can sometimes feel artificial. Raw hair has natural imperfections and varied strand thicknesses that mimic your own hair perfectly. It has a \"swish\" and a bounce that processed bundles simply cannot replicate.</p>\r\n\r\n<h3>Navigating the Market in Ghana</h3>\r\n<p>With the rise in popularity, there is also a rise in \"faux-raw\" hair. In 2026, to identify true raw donor hair, look at the scent and the texture. It should smell like hair, not chemicals. It should feel slightly textured to the touch, not overly \"silky-coated\" (which often indicates a silicone finish). At Hair Aura, we pride ourselves on our transparent sourcing, ensuring every raw bundle is the absolute pinnacle of quality.</p>\r\n\r\n<h3>Caring for Raw Hair</h3>\r\n<p>Raw hair requires the same care you would give your own natural hair on its best day. It needs moisture, it needs gentle detangling, and it loves to be air-dried. In 2026, we advocate for the \"Low manipulation\" approach. Let the natural beauty of the raw hair shine through without over-styling.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>2026 is the year we stop settling for the temporary and start investing in the eternal. Raw donor hair is the crown you keep. Visit us to feel the difference for yourself and join the raw hair revolution.</p>', 'blog_raw_donor_luxury_2026.webp', 1, 'Wig Guide', 'raw donor hair, luxury hair Ghana, 2026 hair trends', 'Raw Donor Hair Guide 2026 | Hair Aura luxury', 'Why is raw donor hair the top choice for 2026? Learn about the longevity and quality of pure human hair in Ghana.', 0, 1, '2026-02-24 09:00:00', '2026-03-05 00:23:36', '2026-03-05 14:40:29', NULL),
(19, 'Glueless Technology: The 2026 Hairline Revolution', 'glueless-wig-technology-2026', 'Edgy hair doesn\'t have to mean damaged edges. Explore the 2026 glueless wig revolution that is saving hairlines across Accra.', '<h2>The End of the Glue Era</h2>\r\n<p>For years, the \"wig life\" was synonymous with messy adhesives, sticky residues, and the constant fear of damaging your natural edges. But as we step into 2026, a new era has arrived: the **Glueless Revolution**. Ghanaian women are no longer willing to sacrifice their hairline for their hairstyle. At Hair Aura, we have pioneered 2026 glueless technology that provides the most secure fit in history without a single drop of glue.</p>\r\n\r\n<h3>What makes it \"Glueless\" in 2026?</h3>\r\n<p>Past \"glueless\" wigs were often just standard wigs with clips that felt uncomfortable. In 2026, the technology is much more sophisticated. Our units use a combination of: \r\n<ul>\r\n    <li>**3D Mesh Caps:** These are pre-molded to fit the average head shape, creating a \"vacuum-like\" grip that stays on through wind and movement.</li>\r\n    <li>**HD Silicone Ribbing:** A tiny, invisible strip of skin-safe silicone along the perimeter that prevents the lace from sliding without the need for adhesive.</li>\r\n    <li>**Double-Reinforced Elastic Bands:** Adjustable bands that pull the lace flat against the forehead for that \"melted\" look.</li>\r\n</ul></p>\r\n\r\n<h3>The 2026 Edge Health Movement</h3>\r\n<p>Across Accra, \"Edge Health\" is the biggest beauty topic of 2026. Women are moving away from permanent installs that keep the hair covered for weeks. The beauty of a glueless unit is that you can take it off every single night. This allows you to moisturize your natural hairline, give your scalp a massage, and ensure your natural hair remains healthy and flourishing. It is the ultimate \"Protective Style\" that actually protects.</p>\r\n\r\n<h3>Realism without the Sticky Mess</h3>\r\n<p>The biggest myth about glueless wigs is that they don\'t look as natural as glued ones. In 2026, the combination of ultra-thin HD lace and specialized knot-bleaching techniques means that our **ready to wear wigs** look perfectly melted just by sitting on the skin. You can achieve a professional-level install in front of your bedroom mirror in under two minutes.</p>\r\n\r\n<h3>Versatility for the Active Woman</h3>\r\n<p>In 2026, the Ghanaian woman is more active than ever. Whether you are hitting the gym at Cantonments or traveling for business, a glueless unit offers a level of convenience that glued installs cannot match. If you get sweaty after a workout, you can simply remove the wig, wash your scalp, and put it back on fresh. It is the height of hygiene and convenience.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>You shouldn\'t have to choose between a beautiful wig and a beautiful natural hairline. The 2026 glueless revolution is here to give you both. Reclaim your edges and your freedom with Hair Aura\'s latest technology.</p>', 'blog_glueless_tech_2026.png', 1, 'Wig Guide', 'glueless wigs, edge health, 2026 wig tech, Accra beauty', 'Glueless Wig Technology 2026 | Hair Aura Ghana', 'Save your edges with 2026 glueless wig technology. Discover the secrets to a secure, adhesive-free install in Accra.', 0, 1, '2026-02-27 09:00:00', '2026-03-05 00:23:36', '2026-03-05 14:40:29', NULL),
(20, 'Volume & Vibe: Mastering Voluminous Curls in 2026', 'voluminous-curly-wig-trends-2026', 'The \"Big Hair\" era is back for 2026. Learn how to style and maintain voluminous curly wigs that command attention in every room.', '<h2>Go Big or Go Home</h2>\r\n<p>If 2025 was the year of \"sleek and straight,\" 2026 is officially the year of the \"Big Curl Energy.\" From voluminous Afro-textures to bouncy Hawaiian waves, \"Volume & Vibe\" is the theme for the Accra social scene this year. But wearing a **curly wig** with massive volume requires a specific set of skills to ensure it looks intentional and high-fashion, rather than unkempt.</p>\r\n\r\n<h3>The 2026 Volume Strategy</h3>\r\n<p>In 2026, volume is not just about \"frizz\"; it is about \"defined fluff.\" To achieve this, we use the \"Pick and Fluff\" technique. After your unit is completely dry (following our Re-Wet and Set method), use a wide-tooth pick starting from the roots to lift the hair. The key is to avoid disturbing the ends of the curls, which keeps the look defined while adding massive height and body at the crown.</p>\r\n\r\n<h3>Curls that Command a Room</h3>\r\n<p>A voluminous **curly wig** is the ultimate accessory for the woman who wants to be noticed. It frames the face with a soft, ethereal quality that is incredibly youthful and vibrant. In 2026, we are seeing these styles paired with bold makeup and structured tailoring, creating a sophisticated \"New-Age African\" aesthetic that is dominating both local and international fashion circles in Accra.</p>\r\n\r\n<h3>The Layered Cut Advantage</h3>\r\n<p>To get the best volume in 2026, the cut is just as important as the curl. We recommend a layered cut for your curly units. Layers prevent the \"triangle shape\" that often plagues curly wigs and instead allow for a rounded, voluminous silhouette that moves beautifully. At Hair Aura, our 2026 curly collection comes pre-layered by master stylists to ensure perfect volume straight out of the package.</p>\r\n\r\n<h3>Humidity Control for Big Hair</h3>\r\n<p>The Accra humidity can either be your best friend or your worst enemy when it comes to volume. To keep your vibe consistent, we use \"Volume-Shield\" sprays. These are lightweight mists that prevent the curls from collapsing under the weight of atmospheric moisture. They provide a flexible hold that keeps your \"Big Hair\" big all night long.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>2026 is about taking up space. It is about confidence, heritage, and the joy of texture. Whether you are rocking a tight coil or a loose wave, embrace the volume and let your hair tell your story. Explore our 2026 Vibe Collection and find your loudest look yet.</p>', 'blog_voluminous_curls_2026.webp', 1, 'Trends', 'curly wigs, big hair 2026, Accra fashion, voluminous curls', 'Voluminous Curly Wig Trends 2026 | Hair Aura Ghana', 'Big hair is back! Master the voluminous curly wig trends of 2026 with our expert styling and maintenance tips for Accra.', 0, 1, '2026-03-02 09:00:00', '2026-03-05 00:23:36', '2026-03-05 14:40:29', NULL),
(21, 'The 2026 Wig Travel Guide: Pack Like a Pro', 'wig-travel-packing-guide-2026', 'Traveling for business or leisure in 2026? Learn how to pack, store, and maintain your luxury wigs so they arrive as flawless as you do.', '<h2>Jet-Setting with Style</h2>\r\n<p>In 2026, the modern Ghanaian woman is a global citizen. Whether you are flying from Kotoka to London or taking a weekend trip to Kumasi, your \"Hair Aura\" must travel with you. But packing a luxury unit isn\'t like packing a pair of shoes. Without the right technique, you could arrive at your destination with a matted, tangled mess. This is the definitive 2026 guide to traveling with your luxury wigs.</p>\r\n\r\n<h3>The Storage Strategy</h3>\r\n<p>Never just \"throw\" your wig into your suitcase. In 2026, we recommend the \"Silk Envelope\" method. Turn your wig inside out, carefully place the hair inside the cap, and slide it into a silk or satin storage bag. This protects the delicate human hair from friction against other items in your luggage. For shorter styles like a **bob wig**, a structured wig carrier is even better, as it prevents the cut from being crushed during transit.</p>\r\n\r\n<h3>The Travel Essentials Kit</h3>\r\n<p>Don\'t rely on hotel hair products. Travel with your own \"Wig Survival Kit\" which, in 2026, should include: \r\n<ul>\r\n    <li>A travel-sized mist bottle for your \"Re-Wet and Set\" routine.</li>\r\n    <li>A high-quality wide-tooth comb.</li>\r\n    <li>A small bottle of silk-infusion serum.</li>\r\n    <li>A collapsible wig stand to allow your unit to \"breathe\" once you arrive at your hotel.</li>\r\n</ul></p>\r\n\r\n<h3>Wig Security at the Airport</h3>\r\n<p>A common concern for 2026 travelers is airport security. Modern scanners are incredibly advanced and can detect the metallic elements in some older wig clips. To ensure a stress-free experience, we recommend wearing a **glueless wig** with silicone ribbing instead of clips. This ensures you pass through security without a hitch while keeping your edges perfectly intact.</p>\r\n\r\n<h3>Maintaining the Look on the Go</h3>\r\n<p>Change of climate can affect your hair. If you are traveling from Accra\'s humidity to a dryer environment, your hair may need extra hydration. Use a light leave-in conditioner every morning to keep the hair supple. If you are wearing a **pixie cut wig**, a small travel-sized foam can help you maintain that \"snatched\" look in any time zone.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Travel should be about the destination, not the stress of your hair. By packing like a pro, you ensure that you step off the plane looking just as radiant as when you boarded. Safe travels and beautiful hair for all your 2026 adventures!</p>', 'blog_wig_travel_2026.png', 1, 'Wig Tips', 'wig travel guide, packing tips, 2026 travel beauty', 'The 2026 Wig Travel Guide | Hair Aura Ghana', 'Learn how to pack and protect your luxury wigs for travel in 2026. Expert tips for storage, security, and maintenance on the go.', 0, 1, '2026-03-05 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(22, 'Hot Weather Wig Hacks: Beating the Accra Heat', 'hot-weather-wig-tips-accra-2026', 'Accra heat in 2026 is no joke. Discover the professional hacks to staying cool, fresh, and flawless while wearing your favorite human hair wigs.', '<h2>Summer Without the Sweat</h2>\r\n<p>The tropical climate in Ghana is part of our charm, but for a wig wearer, the 2026 heat can be a challenge. How do you maintain a \"melted\" look when it is 35 degrees outside? How do you keep your scalp fresh? At Hair Aura, we have mastered the art of the \"Cool Install.\" These are the hacks you need for the peak heat seasons in Accra.</p>\r\n\r\n<h3>Choose a Breathable Cap</h3>\r\n<p>Not all wig caps are created equal. In 2026, we prioritize \"Ultra-Vent\" technology—caps that have a larger mesh pattern to allow maximum airflow to your scalp. This is the difference between feeling like you are wearing a hat and feeling like you are wearing nothing at all. Breathability is the first step to staying cool.</p>\r\n\r\n<h3>The Powder Protect Method</h3>\r\n<p>Sweat is the enemy of lace longevity. In 2026, we advocate for the \"Powder Protect\" method. Before putting on your wig, apply a light dusting of translucent setting powder or specialized scalp powder to your forehead and hairline. This acts as a microscopic sponge, absorbing excess moisture throughout the day and preventing your lace from lifting due to sweat.</p>\r\n\r\n<h3>Style Strategically</h3>\r\n<p>On the hottest days, get the hair off your neck. High-fashion updos or low ponytails aren\'t just chic; they are functional. Styles like the **bob wig** or the **pixie cut wig** are naturally superior for the heat because they don\'t trap body heat against your shoulders. If you are wearing a longer unit, consider a loose braid or using a silk scrunchie to pull it back during the hottest hours of the day.</p>\r\n\r\n<h3>Scalp Hygiene in the Heat</h3>\r\n<p>A fresh scalp is a happy scalp. In 2026, use an alcohol-free witch hazel or a specialized scalp spray twice a day. Gently pat it under your lace using a cotton pad. This kills bacteria that cause odor and keeps your scalp feeling tingly and cool. It is the refreshing \"pick-me-up\" your hair aura needs mid-afternoon.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Don\'t let the sun dull your shine. With these professional hacks, you can command the Accra streets in 2026 while staying as cool as a cucumber. Stay hydrated, stay stylish, and stay radiant!</p>', 'blog_summer_heat_hacks_2026.png', 1, 'Wig Tips', 'hot weather wig tips, summer hair hacks, 2026 beauty tips', 'Hot Weather Wig Hacks 2026 | Hair Aura Accra', 'Stay cool while wearing a wig in 2026. Our guide covers breathable caps, sweat protection, and styling for the hot Accra climate.', 1, 1, '2026-03-08 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(23, 'The Art of the Wig Switch: Seamlessly Changing Styles', 'how-to-switch-wigs-seamlessly-2026', 'Why settle for one look? Learn the 2026 secrets to transitioning from work to play by switching your wigs like a professional stylist.', '<h2>One Woman, Many Auras</h2>\r\n<p>In 2026, versatility is the ultimate luxury. The modern woman doesn\'t have one \"signature look\"; she has a wardrobe of styles. The ability to switch from a professional bone-straight unit for a board meeting to a voluminous **curly wig** for dinner at the Polo Club is a superpower. But how do you make the switch without spending hours in front of a mirror? Welcome to the Art of the Wig Switch.</p>\r\n\r\n<h3>Foundation is Everything</h3>\r\n<p>The secret to a quick switch lies in your natural hair foundation. In 2026, we recommend the \"Flat-Back Strategy.\" Whether you have braids or a flat-wrap, ensure it is as flat as possible. A flat foundation allows different cap constructions to sit perfectly every time. If your natural hair is too bulky, one wig might look great while another looks \"wiggy.\" Consistency is key.</p>\r\n\r\n<h3>The Glueless Advantage</h3>\r\n<p>It is almost impossible to switch wigs quickly if you are using glue. This is why **glueless technology** is the backbone of the wig switch movement in 2026. With a high-quality glueless unit, you can literally \"pop\" one off and \"pop\" another on in under 60 seconds. Make sure your \"switching\" collection features units with similar hairline shapes to minimize the need for re-blending your edges.</p>\r\n\r\n<h3>Blending Your Edges</h3>\r\n<p>To make the transition truly seamless, use a light-hold edge gel that can be easily \"reactivated\" with a bit of water. When you take off your first wig, mist your edges, brush them back, and you are ready for the next one. In 2026, simplicity is sophistication. You don\'t need complex \"baby hairs\" for every look; sometimes a clean, pushed-back hairline is the most elegant way to switch styles.</p>\r\n\r\n<h3>The Storage Cabinet</h3>\r\n<p>To switch quickly, your wigs must be \"ready to wear.\" In 2026, we recommend maintaining a \"Style Cabinet\" where your units are stored on mannequin heads or hung in silk bags. If a wig is tangled or needs styling, it isn\'t ready for a switch. Keep your collection organized, hydrated, and styled so you can transform your look at a moment\'s notice.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Your hair is an expression of your mood and your mission. Don\'t be afraid to experiment. Use the Art of the Wig Switch to surprise the world—and yourself—every single day. Explore our \"Switch Series\" in-store and find your next transformation.</p>', 'blog_wig_switch_tips_2026.webp', 1, 'Wig Tips', 'wig switch guide, hairstyle transitions, 2026 beauty trends', 'Master the Art of the Wig Switch 2026 | Hair Aura', 'Learn how to transition between wig styles seamlessly in 2026. Quick tips for foundation, glueless switches, and edge blending.', 0, 1, '2026-03-11 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(24, 'Extending the Life: The 2026 Deep Conditioning Ritual', 'deep-conditioning-wig-ritual-2026', 'Don\'t let your investment dry out. Learn the 2026 deep conditioning method that keeps human hair wigs looking brand new for years.', '<h2>The Secret to Longevity</h2>\r\n<p>A luxury human hair wig is more than just a purchase; it is a long-term companion. At Hair Aura, we see units that are three, four, even five years old and still look incredible. The secret? It isn\'t magic—it is the \"Deep Conditioning Ritual.\" In 2026, we have refined this process to ensure that your hair remains soft, manageable, and radiant throughout its long life.</p>\r\n\r\n<h3>Why Deep Conditioning is Essential</h3>\r\n<p>Human hair extensions are not connected to a scalp, meaning they don\'t receive the natural oils needed to stay hydrated. Over time, environmental stressors like the sun and pollution can make the hair feel brittle. Deep conditioning in 2026 is about \"lipidic restoration\"—putting those lost oils back into the hair shaft to maintain its elasticity and shine.</p>\r\n\r\n<h3>The 2026 Ritual Protocol</h3>\r\n<p>**1. The Prep:**\r\nGently detangle your dry wig from ends to roots. Wash it with a pH-balanced, sulfate-free cleanser to remove any product buildup.</p>\r\n<p>**2. The Treatment:**\r\nApply a generous amount of a high-end mask. In 2026, we look for ingredients like Baobab oil, Marula oil, and Hydrolyzed Silk. Avoid the lace area—conditioner on the knots can loosen them over time.</p>\r\n<p>**3. The \"Steam Melt\":**\r\nPlace your unit in a plastic zip-top bag and seal it. Let it sit in a bowl of warm (not boiling) water for 30 minutes. The gentle heat opens the hair cuticle, allowing the treatment to penetrate deep into the cortex. This is the 2026 hack for salon-quality results at home.</p>\r\n<p>**4. The Cold Rinse:**\r\nRinse the hair with cool water. This closes the cuticle, locking in the moisture and creating that mirror-like shine we all love.</p>\r\n\r\n<h3>Frequency Matters</h3>\r\n<p>How often should you perform the ritual? In the 2026 Accra climate, we recommend once every two to three weeks if you wear the unit daily. If it is a specialty unit you only wear occasionally, once every two months is sufficient. The key is to act before the hair feels dry. Prevention is better than a cure.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Caring for your luxury hair is a form of self-love. When your wig looks good, you feel good. By following the 2026 Deep Conditioning Ritual, you ensure that your investment pays off in confidence and beauty every single day. Visit our care section for the best masks and oils for your ritual.</p>', 'blog_deep_condition_ritual_2026.webp', 1, 'Wig Tips', 'deep conditioning tips, wig care 2026, human hair longevity', '2026 Deep Conditioning Ritual Guide | Hair Aura', 'Keep your human hair wigs soft and shiny for years. Discover our 2026 \"Steam Melt\" deep conditioning method for luxury units.', 0, 1, '2026-03-14 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(25, 'Understanding Lace Types: 2026 HD, Swiss & Transparent', 'understanding-lace-types-2026', 'Confused about lace? We break down the technical differences between HD, Swiss, and Transparent lace for the 2026 Ghanaian beauty market.', '<h2>The Foundation of the Melt</h2>\r\n<p>The biggest question we get at Hair Aura is: \"What is the difference between these lace types?\" In 2026, the market is flooded with technical terms that can be overwhelming for even the most experienced wig wearer. The lace is the most critical part of your unit—it is what creates the illusion of hair growing from your scalp. Understanding the technical differences is the key to achieving your perfect \"Hair Aura\" in 2026.</p>\r\n\r\n<h3>HD Lace: The 226 Industry Standard</h3>\r\n<p>HD stands for High-Definition. In 2026, HD lace is the absolute gold standard. It is a royal Swiss lace that is ultra-thin, invisible, and incredibly soft. Its primary advantage is that it is undetectable even under the closest inspection or High-Definition photography. It melts into any skin tone without the need for heavy tinting. However, because it is so thin, it is also the most delicate. It requires gentle handling and professional care to maintain its structural integrity over time.</p>\r\n\r\n<h3>Swiss Lace: The Reliable Classic</h3>\r\n<p>Standard Swiss lace is slightly thicker than HD lace but significantly more durable. In 2026, we recommend Swiss lace for everyday wear, especially for **lace closure wigs** that will be removed and installed frequently. It provides a great melt and can be tinted to match your skin perfectly using a lace spray or foundation. If you are active or want a wig that can withstand a bit more \"wear and tear,\" Swiss lace is the most practical choice.</p>\r\n\r\n<h3>Transparent Lace: Perfect for Light Tones</h3>\r\n<p>Transparent lace is exactly what it sounds like—it has a white or clear base. While it was originally designed for lighter skin tones, in 2026, many Ghanaian women use it by applying a \"lace tint\" to match their specific undertones. It is very durable and offers a crisp, clean hairline. It is an excellent middle ground for those who want a better melt than traditional lace but don\'t want the fragility of HD lace.</p>\r\n\r\n<h3>The 2026 Lace Tint Revolution</h3>\r\n<p>Regardless of the lace type you choose, tinting is the final step to a flawless install. Modern 2026 lace tint sprays are specialized to mimic the complex undertones of West African skin. Whether you have warm, cool, or neutral undertones, there is a tint color for you. A light mist of tint on the inside of your lace will transform even a standard Swiss lace into a custom masterpiece that looks like it belongs on your head.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Lace selection is about balancing realism with lifestyle. At Hair Aura, we offer all three types so you can choose the one that fits your needs perfectly for 2026. Visit our \"Lace Lab\" in-store to see the differences in person and get a professional skin-matching consultation today.</p>', 'blog_lace_types_2026.png', 1, 'Hair Education', 'lace types guide, HD lace vs Swiss, 2026 wig education', '2026 Lace Types Guide | Hair Aura Ghana', 'What is the difference between HD, Swiss, and Transparent lace in 2026? Learn which lace type is best for your skin tone and lifestyle.', 0, 1, '2026-03-17 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(26, 'The Science of Hair Density: Finding Your 2026 Volume', 'understanding-wig-hair-density-2026', 'What do the percentages mean? Discover the technical side of hair density and how to choose the right volume for your face shape in 2026.', '<h2>Weight vs. Volume</h2>\r\n<p>When you browse luxury wigs in 2026, you will often see percentages like 150%, 180%, or even 250%. This refers to the \"Hair Density\"—the amount of hair that is actually sewn into the wig cap. Choosing the right density is a science. Too little, and the unit looks thin and \"gappy\"; too much, and it can look overwhelming and artificial. This is the 2026 guide to mastering the science of density.</p>\r\n\r\n<h3>150% Density: The Natural Standard</h3>\r\n<p>For most women, 150% density mimics a health head of natural hair. It is lightweight, breathable, and perfect for styles like the **bob wig** or sleek straight units. In 2026, this is our \"Essentials\" density. It is the most comfortable for daily wear in the Accra heat and provides a silhouette that is sophisticated and realistic. It is especially flattering for women with smaller face shapes who don\'t want their hair to \"wear them.\"</p>\r\n\r\n<h3>180% - 210% Density: The \"Glams\" Look</h3>\r\n<p>This is the most popular density range in Ghana for 2026. It provides significant volume and \"swish\" without being overly heavy. 180% density is ideal for **body wave wigs** and longer straight styles, as it ensures the hair looks full from the roots to the tips. If you love a voluminous finish and want that extra \"wow\" factor for photos and events, 200% density is your sweet spot.</p>\r\n\r\n<h3>250% Density: High-Fashion Volume</h3>\r\n<p>For the \"Big Hair\" era of 2026, 250% density is the ultimate choice. This is reserved for voluminous **curly wigs** and extra-long luxury units. It creates a massive, ethereal silhouette that commands attention in any room. Because of the weight, these units require a more structured cap construction to ensure they stay secure. It is the density of choice for performers, influencers, and anyone who lives for high-fashion volume.</p>\r\n\r\n<h3>Density and Face Shape</h3>\r\n<p>In 2026, we use hair to balance our features. If you have an oval or heart-shaped face, almost any density works. For those with a rounder face, higher densities with long layers can help elongate the silhouette. Conversely, if you have a very narrow face, a moderate density with volume at the sides can add a beautiful balance. At Hair Aura, we provide \"Density consultations\" to help you find the mathematical perfect volume for your specific features.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Density is more than just \"more hair\"; it is a tool for self-expression. By understanding the percentages, you can shop with confidence in 2026, knowing exactly how your new unit will fall and flow. Explore our density collection and find your perfect volume today.</p>', 'blog_hair_density_2026.webp', 1, 'Hair Education', 'wig density guide, 150 vs 180 density, 2026 hair science', '2026 Wig Density Guide | Hair Aura Accra', 'What is 150% or 200% wig density? Learn the technical side of hair volume and how to choose the right density for your face in 2026.', 0, 1, '2026-03-20 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(27, 'Anatomy of a Luxury Wig: Inside a Hair Aura Unit', 'anatomy-of-a-luxury-wig-2026', 'Ever wondered what makes a wig \"premium\"? We take you inside the construction of a 2026 Hair Aura unit to show our commitment to quality.', '<h2>Beyond the Hair</h2>\r\n<p>When you hold a Hair Aura wig, you can feel the quality immediately. But luxury isn\'t just about the hair strands themselves; it is about the engineering underneath. In 2026, a truly premium unit is a masterpiece of textile engineering and traditional craftsmanship. Let\'s take a look inside the \"Anatomy of Luxury\" and see what sets our 2026 collection apart from the rest.</p>\r\n\r\n<h3>The Single-Donor Promise</h3>\r\n<p>The foundation of every luxury unit is the hair itself. We use only single-donor hair, meaning every strand on your wig came from the same person. This ensures that the texture, porosity, and cuticle alignment are perfectly consistent. In 2026, this is the only way to prevent tangling and ensure the hair behaves naturally. Cheap wigs often mix hair from multiple donors, which leads to \"different\" strands reacting uniquely to weather and products—a recipe for disaster.</p>\r\n\r\n<h3>The \"Invisible\" Weft Technology</h3>\r\n<p>Turn one of our units inside out and you will see the \"Hair Aura Invisible Weft.\" In 2026, we use ultra-thin, machine-reinforced wefts that are designed to lay completely flat against the head. This eliminates the \"bulky\" feeling at the back of the head and allows for a more natural silhouette. Our wefts are also double-stitched to ensure zero shedding, even after years of washing and styling.</p>\r\n\r\n<h3>HD Elasticity and Breathability</h3>\r\n<p>The cap itself is made from a specialized 2026 high-stretch mesh that is both breathable and durable. It is designed to accommodate different head shapes without losing its elasticity. We have integrated \"Aero-Pores\" into the sections that don\'t have hair to ensure your scalp can breathe, preventing the \"itchy\" feeling that often accompanies low-quality wigs in the Accra heat.</p>\r\n\r\n<h3>The Detail in the Knots</h3>\r\n<p>Look at the hairline. Every hair is hand-tied into the lace. In 2026, our master craftsmen use \"Single Knotting\" at the very front of the hairline. These knots are so small they are practically invisible to the naked eye. As we move back into the unit, we transition to \"Double Knotting\" for added security. This combination provides the most realistic hairline in the industry while maintaining the durability you expect from a luxury investment.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>At Hair Aura, we believe that true luxury is found in the details that you *don\'t* see. By investing in superior construction, we ensure that your \"Hair Aura\" is as reliable as it is beautiful. Experience the anatomy of luxury in our 2026 collection today.</p>', 'blog_wig_anatomy_2026.webp', 1, 'Hair Education', 'wig construction, luxury hair quality, 2026 hair engineering', 'Anatomy of a Luxury Wig 2026 | Hair Aura', 'What makes a wig premium? Discover the technical details of our 2026 wig construction, from single-donor hair to invisible wefts.', 0, 1, '2026-03-23 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(28, 'Wig Cap Construction 101: Comfort & Security', 'wig-cap-construction-guide-2026', 'The cap is the engine of your wig. Learn about the different 2026 cap constructions and find the one that fits your lifestyle perfectly.', '<h2>The Foundation of Comfort</h2>\r\n<p>A beautiful wig is worthless if it is uncomfortable to wear. In 2026, wig cap technology has reached a point where you should almost forget you are wearing a unit. But with so many options—Full Lace, Lace Front, 360, and Glueless—how do you know which one is right for your lifestyle? This is your 2026 technical guide to wig cap construction.</p>\r\n\r\n<h3>Full Lace: The Ultimate Freedom</h3>\r\n<p>In a Full Lace unit, every single hair is hand-tied into a full lace base. In 2026, this remains the most luxury and versatile option. It allows you to part your hair anywhere—from the crown to the nape—and even pull your hair into a high ponytail. It is the most breathable option because the entire cap is made of lace. However, it requires the most care and a professional install to look its best. It is the choice of the 2026 \"Style Chameleon.\"</p>\r\n\r\n<h3>The Hybrid Frontal: Realism + Ease</h3>\r\n<p>Our 13x4 and 13x6 frontal units are \"hybrids\"—lace in the front for a perfect hairline and high-stretch wefts in the back for comfort. In 2026, this is our most popular construction. It gives you the \"ear-to-ear\" melt you want for the face, while the wefts in the back provide a snug, secure fit that doesn\'t require as much maintenance as a full lace unit. It is the perfect daily luxury for the modern woman.</p>\r\n\r\n<h3>360 Lace: Perfect for Updos</h3>\r\n<p>360 lace units have a lace perimeter all the way around the head, with wefts only in the center. In 2026, this is the preferred choice for women who love wearing buns and up-styles but want a more affordable option than full lace. You get a natural hairline at the front and the back of your neck, allowing you to sweep the hair up without revealing your secret. It is the ultimate \"Event Wig\" for 2026.</p>\r\n\r\n<h3>The 226 \"Comfort-Snap\" System</h3>\r\n<p>Regardless of the base construction, all Hair Aura 2026 units feature our \"Comfort-Snap\" adjustable system. This includes reinforced combs that can be removed if you prefer a completely glueless fit, and an extra-wide elastic band that distributes pressure evenly across the back of the head. We have eliminated the \"headache\" of traditional wigs, ensuring you can wear your aura from sunrise to sunset in total comfort.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Your cap construction should match your life. If you are always on the go, a hybrid frontal might be best. If you live for versatility, go for full lace. At Hair Aura, we take the time to measure your head and understand your needs, ensuring you leave with a unit that fits like a second skin. Find your fit in our 2026 collection today.</p>', 'blog_cap_construction_2026.webp', 1, 'Hair Education', 'wig cap types, full lace vs lace front, 2026 wig tech', '2026 Wig Cap Construction Guide | Hair Aura Accra', 'Full lace, lace front, or 360? Learn the pros and cons of each wig cap construction for 2026 and find your perfect fit in Ghana.', 0, 1, '2026-03-26 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL);
INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `category`, `tags`, `meta_title`, `meta_description`, `view_count`, `is_published`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 'The Bride\'s Countdown: A 6-Month Prep Timeline', 'bridal-wig-preparation-timeline-2026', 'Your wedding hair begins months before the big day. Follow our 2026 bridal countdown to ensure your \"Hair Aura\" is perfect.', '<h2>Timing is Everything</h2>\r\n<p>Planning a wedding in 2026 Ghana is a marathon, not a sprint. While you are busy with venues, caterers, and kente colors, your hair belongs at the top of your checklist. A \"Bridal Aura\" doesn\'t happen overnight. To ensure your unit is perfect, customized, and installed flawlessly, you need a timeline. This is the 2026 Hair Aura Bridal Countdown.</p>\r\n\r\n<h3>6 Months Out: The Discovery Phase</h3>\r\n<p>At the six-month mark, start your research. What is your overall wedding aesthetic? Are you going for a vintage Hollywood vibe or a modern, sleek finish? Visit our Instagram and browse our 2026 Bridal collection. Book an initial consultation to discuss your vision with one of our master stylists. This is the time to decide if you want a custom-colored unit or a specific hair texture that might need to be specially sourced.</p>\r\n\r\n<h3>3 Months Out: The Selection</h3>\r\n<p>It is time to make it official. Once you have your dress and your traditional engagement colors decided, choose your wedding and engagement wigs. In 2026, many brides are choosing two distinct units. At Hair Aura, we recommend securing your bridal units now to ensure they are available and blocked for your date. If you need custom coloring or specialized density, the three-month mark is the perfect time to start the customization process.</p>\r\n\r\n<h3>1 Month Out: The Hair Trial</h3>\r\n<p>Do not wait until your wedding morning to see how your wig looks with your veil and accessories. One month before the big day, book a full Hair Trial. Bring your veil, your jewelry, and even your makeup artist if possible. This allows us to adjust the styling, fine-tune the hairline, and ensure the fit is 100% comfortable. In 2026, a \"digital trial\" is also available, where we send you High-Def videos of your unit on a mannequin head for approval.</p>\r\n\r\n<h3>1 Week Out: The Hair Prep</h3>\r\n<p>The week of the wedding is for your natural hair. Get a fresh set of flat, neat cornrows or a flat-wrap. This is also the time for your final scalp treatment to ensure your base is healthy and clean. Your bridal wigs should be fully styled and waiting in their silk bags, ready for the \"Transformation Day.\"</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>By following this 2026 timeline, you eliminate \"hair stress\" from your wedding week. You can focus on your joy, knowing that your crowning glory is already perfect and waiting for you. Start your countdown with a Hair Aura consultation today.</p>', 'blog_bridal_timeline_2026.png', 1, 'Weddings', 'bridal hair timeline, wedding prep 2026, bridal wig guide', '2026 Bridal Wig Preparation Timeline | Hair Aura', 'Ensure your wedding hair is flawless with our 6-month bridal wig prep timeline for 2026. From selection to the final trial.', 0, 1, '2026-03-29 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(30, 'Maid of Honor Style: Elegant Group Coordination', 'bridal-party-wig-coordination-2026', 'A cohesive bridal party is a 2026 wedding must. Learn how to coordinate wig styles for your bridesmaids that complement the bride without overshadowing her.', '<h2>The Beautiful Supporting Cast</h2>\r\n<p>In 2026, the Ghanaian bridal party is a vision of synchronized luxury. While the bride is the star, the bridesmaids and the Maid of Honor provide the frame. Achieving a cohesive \"Bridal Party Aura\" requires coordination, especially when it comes to hair. How do you ensure everyone looks uniform yet individual? This is the 2026 guide to bridal party wig coordination.</p>\r\n\r\n<h3>Theme and Texture</h3>\r\n<p>The most elegant weddings in 2026 choose a \"Texture Theme.\" For example, if the bride is wearing a Hollywood wave, the bridal party might wear soft, cohesive curls or sleek bobs. Avoid having one bridesmaid in an afro and another in bone-straight hair unless \"diverse textures\" is the specific theme. Coordination doesn\'t mean wearing the same wig, but it does mean having a shared aesthetic energy.</p>\r\n\r\n<h3>Length Hierarchy</h3>\r\n<p>In 2026, many brides are utilizing a \"Length Hierarchy.\" The bride wears the longest, most voluminous unit, while the bridesmaids wear shorter, more manageable lengths. A classic choice for the bridal party is the 12-inch or 14-inch **body wave wig**. It is long enough to feel glamorous but doesn\'t compete with the bride\'s 24-inch bridal masterpiece. It creates a beautiful tiered effect in group photos.</p>\r\n\r\n<h3>The Group Install Package</h3>\r\n<p>To ensure consistency, we recommend a \"Group Install.\" In 2026, Hair Aura offers on-site bridal party services where our stylists install and style every bridesmaid\'s unit simultaneously. This ensures the hairlines are blended with the same technique and the curls are brushed out to the same degree of \"fluff.\" Consistency is what transforms a group of women into a \"World-Class Bridal Party.\"</p>\r\n\r\n<h3>Budgeting and Gifting</h3>\r\n<p>Many 2026 brides are choosing \"Bridal Party Wig Sets\" as their bridesmaid gifts. This is a practical and luxurious gift that ensures everyone has high-quality hair for the wedding and beyond. We offer special \"Group Packages\" for parties of 4 or more, including the units, the installs, and a specialized \"Wedding Day Care Kit\" for each bridesmaid to keep her hair looking fresh through the reception.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Your bridal party is a reflection of your union\'s beauty and support. By coordinating your hair aura, you create a visual symphony that enhances the magic of your big day. Explore our \"Party Packages\" and let us style your squad for 2026.</p>', 'blog_bridal_party_2026.webp', 1, 'Weddings', 'bridal party hair, bridesmaid wigs 2026, wedding group styling', '2026 Bridal Party Wig Coordination | Hair Aura', 'Coordinate your bridesmaid hair perfectly with our 2026 wedding guide. Tips on texture, length hierarchy, and group install packages.', 0, 1, '2026-04-01 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(31, 'Traditional Engagement Trends for the 2026 Bride', 'traditional-engagement-hair-trends-2026', 'Celebrate tradition with 2026 luxury. Discover the top wig trends for Ghanaian traditional engagements, from kente-coordinated colors to cultural textures.', '<h2>A Modern Tribute to Tradition</h2>\r\n<p>The traditional engagement is the heart of any Ghanaian wedding. It is a day of vibrant colors, rich kente, and deep cultural significance. In 2026, the \"Engagement Hair\" has become just as important as the kente choice. Brides are looking for styles that honor their heritage while embracing the luxury and ease of modern wig technology. These are the trends defining the 2026 traditional engagement scene.</p>\r\n\r\n<h3>Kente-Coordinated Color</h3>\r\n<p>In 2026, we are seeing a rise in \"Subtle Custom Color\" designed to complement the specific tones in a bride\'s kente. If your kente has warm gold and orange tones, a **body wave wig** with honey-bronze highlights is a masterpiece. For brides wearing cooler tones or deep greens, a jet-black unit with a high-gloss \"glass skin\" finish provides a stunning contrast. Color coordination is the ultimate 2026 power move for the traditional bride.</p>\r\n\r\n<h3>The Cultural Volume: Afro-Lux</h3>\r\n<p>The **afro wig** has made a massive comeback in the 2026 traditional scene. Brides are choosing voluminous, textured units that mirror their natural hair but with the \"elevated\" finish of premium human hair. Often accented with traditional gold hairpins or beaded headpieces, the \"Afro-Lux\" look is a powerful statement of identity and beauty that perfectly complements traditional attire.</p>\r\n\r\n<h3>Braid Versatility: The \"Knotless\" Wig</h3>\r\n<p>Many brides prefer the classic look of braids for their engagement but don\'t want the tension or the time commitment of a traditional install. The **braided wigs** of 2026, featuring perfect, lightweight knotless braids on Full Lace foundations, are the definitive solution. These allow you to have a complex, elegant braided style that looks perfectly natural but can be removed after the long day of ceremonies, giving your scalp the rest it deserves.</p>\r\n\r\n<h3>Headpiece Integration</h3>\r\n<p>Traditional engagements often involve multiple headpieces or wraps throughout the day. In 2026, the \"Low-Profile\" wig is key. We design units with specific flat-weft areas that allow traditional crowns and wraps to sit securely without sliding. During your consultation, bring your traditional headwear so we can customize your unit\'s density and cap construction for a perfect, regal fit.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>The traditional engagement is a celebration of who you are and where you come from. Your hair should tell that story with grace and luxury. At Hair Aura, we are honored to be part of your cultural journey. Visit us to see how we are blending tradition with 2026 innovation.</p>', 'blog_engagement_trends_2026.webp', 1, 'Weddings', 'traditional engagement hair, kente hair trends, 2026 Ghanaian wedding', '2026 Traditional Engagement Hair Trends | Hair Aura', 'Honor tradition with 2026 luxury. Explore the top wig trends for Ghanaian traditional engagements, from color coordination to Afro-lux.', 2, 1, '2026-04-04 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(32, 'Reception Ready: The Party Wig Switch', 'wedding-reception-party-wig-switch-2026', 'From the altar to the dance floor. Learn why 2026 brides are switching to shorter, sassier \"Party Wigs\" for their wedding reception.', '<h2>Let the Celebration Begin</h2>\r\n<p>You have made it through the vows and the photos. Now, it is time to dance! For the 2026 bride, the reception is a time to let loose and celebrate. But a 24-inch bridal unit can be heavy and hot on a crowded dance floor. This is why the \"Party Wig Switch\" has become the must-have trend for the year. Switching your hair is the ultimate way to signal that the ceremony is over and the party has officially begun.</p>\r\n\r\n<h3>The \"Sassy Switch\": Bobs and Pixies</h3>\r\n<p>The most popular reception switch in 2026 is moving from a long, formal unit to a sharp **bob wig** or a bold **pixie cut wig**. These shorter styles are lightweight, cool, and allow for maximum movement. Imagine stepping into your second dress with a completely new, edgier hairstyle—it is a \"wow\" moment that your guests will be talking about for years. Plus, there is no long hair getting caught in your jewelry while you are dancing the night away!</p>\r\n\r\n<h3>Glueless Switching Technology</h3>\r\n<p>How do you change your hair in the middle of a wedding? In 2026, the answer is **glueless technology**. Your bridal stylist can help you switch from your glued-on bridal frontal to a perfectly fitting, pre-styled glueless \"Party Unit\" in under five minutes. It is a quick wardrobe change for your head. The secure band and silicone grip ensure that no matter how hard you dance, your hair aura stays exactly where it belongs.</p>\r\n\r\n<h3>The \"Reception Glow\" Aesthetic</h3>\r\n<p>Reception units in 2026 often feature more \"glow.\" This might be a slightly higher luster hair or subtle, shimmering highlights that catch the club lights of the venue. The goal is to look vibrant and energetic. While the bridal unit was about classic elegance, the party unit is about modern vibrancy. It is your time to shine as a new wife.</p>\r\n\r\n<h3>Practicality Meets Luxury</h3>\r\n<p>Beyond the look, switching to a shorter unit for the reception also protects your expensive bridal wig from the sweat, champagne, and friction of the party. By switching, you ensure your \"main\" wedding wig remains in pristine condition for your honeymoon and future anniversary photos. It is a smart, fashionable way to manage your luxury hair assets in 2026.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Don\'t let your hair hold you back from the best night of your life. Embrace the \"Party Wig Switch\" and dance into your future with confidence and style. Explore our \"Reception Series\" and plan your 2026 transformation today.</p>', 'blog_party_wig_switch_2026.webp', 1, 'Weddings', 'wedding reception hair, party wig switch, 2026 bridal trends', '2026 Wedding Reception Party Wig Switch | Hair Aura', 'Learn why 2026 brides are switching hair for the reception. Discover the best \"party wigs\" from bobs to pixies for dancing the night away.', 0, 1, '2026-04-07 09:00:00', '2026-03-05 00:28:31', '2026-03-05 14:40:29', NULL),
(33, 'Wig Storage 101: Preserving Shape and Luster', 'wig-storage-preservation-guide-2026', 'Proper storage is the difference between a wig that lasts months and one that lasts years. Learn the 2026 standards for professional wig storage at home.', '<h2>The Home for Your Crown</h2>\r\n<p>In 2026, a luxury wig collection is an asset that deserves a proper home. Many enthusiasts make the mistake of leaving their units on a table or in a cramped drawer, leading to tangles, dust buildup, and loss of the original style. Professional storage is not just about \"neatness\"; it is about preserving the structural integrity of the lace and the vitality of the human hair strands. This is the 2026 guide to storing your wigs like a pro.</p>\r\n\r\n<h3>The Mannequin Method: For Daily Drivers</h3>\r\n<p>For the wigs you wear most often, mannequin heads are the gold standard. In 2026, we recommend canvas cork heads over styrofoam. Canvas allows the cap to breathe and maintains the correct head shape without over-stretching the elastic. Storing your wig on a head ensures that the style—whether it is a sharp bob or voluminous curls—remains intact, saving you prep time every morning. Protect it from the Accra dust with a light silk scarf draped over the top.</p>\r\n\r\n<h3>The Silk Bag System: For Long-Term Assets</h3>\r\n<p>Wigs that you only wear for special occasions or specific moods should be stored in high-quality silk or satin bags. In 2026, the \"Airless Seal\" is trending. Gently detangle the unit, apply a drop of protective serum, and slide it into the bag. Silk prevents friction and keeps the hair cuticle flat, ensuring the \"swish\" remains perfect for months. Store these bags in a cool, dry place away from direct sunlight, which can fade custom colors over time.</p>\r\n\r\n<h3>Climate Control and Humidity</h3>\r\n<p>Ghana\'s humidity is a constant factor. In 2026, a \"Wig Closet\" with moderate ventilation is ideal. Avoid storing hair in bathrooms where steam from showers can cause premature frizz or even mold on the wig cap. If you have a large collection, consider using moisture-absorbing packets in your storage containers. Keeping the environment consistent is the best way to ensure your human hair remains bouncy and fresh.</p>\r\n\r\n<h3>The Pre-Storage Ritual</h3>\r\n<p>Never store a dirty wig. In 2026, we advocate for the \"Clean and Store\" protocol. Before a wig goes into long-term storage, it should be washed, deep-conditioned, and completely air-dried. Storing a wig with product buildup or moisture is the fastest way to ruin the lace knots and the hair texture. A clean wig is a preserved wig.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Your hair aura is only as good as the care you give it when it isn\'t on your head. Invest in quality storage, and your wigs will reward you with years of beauty. Explore our 2026 Home Care and Storage collection in-store today.</p>', 'blog_wig_storage_2026.png', 1, 'Hair Education', 'wig storage tips, hair care 2026, luxury wig preservation', '2026 Wig Storage Guide | Hair Aura Ghana', 'Learn how to store your luxury wigs to preserve their shape and shine. Expert 2026 tips on mannequin storage and silk bag systems.', 1, 1, '2026-04-10 09:00:00', '2026-03-05 00:35:32', '2026-03-05 14:40:29', NULL),
(34, 'Color Theory for Wigs: Choosing Muted Luxury Tones', 'wig-color-theory-luxury-trends-2026', 'Color is more than just fashion; it is science. Discover how to choose 2026 muted luxury tones that perfectly complement West African skin tones.', '<h2>The Power of Palette</h2>\r\n<p>Choosing the right color for your wig can transform your entire look. In 2026, the trend in Accra has shifted away from \"harsh\" neons toward \"Muted Luxury\"—sophisticated, complex tones that look like they could have grown from your own scalp. Understanding color theory is the secret to finding a shade that makes your skin glow and your eyes pop. This is the 2026 masterclass on luxury wig color.</p>\r\n\r\n<h3>The \"Undertone\" Secret</h3>\r\n<p>Color theory starts with your undertone. West African skin tones are rich and diverse, falling into Warm (gold/yellow), Cool (red/blue), or Neutral categories. In 2026, we match hair color to these undertones. For warm skins, honey blonds and chocolate browns with a copper base are magical. For cool skins, jet blacks and \"iced\" espresso tones provide a regal finish. Matching your wig color to your undertone ensures a \"harmonious\" look that feels natural even with high-fashion shades.</p>\r\n\r\n<h3>The Rise of \"Rooted\" Colors</h3>\r\n<p>In 2026, a flat, single-color wig is a thing of the past. \"Rooted\" colors—where the hair is darker at the roots and gradually transitions to a lighter shade—are the standard for luxury. This mimics the way natural hair grows and creates depth and dimension. Whether it is a subtle \"sun-kissed\" highlight or a bold ombre, rooted colors soften the transition to the face and make the hairline look even more realistic.</p>\r\n\r\n<h3>Muted Luxury Tones: The 2026 Palette</h3>\r\n<p>The 2026 palette is defined by \"Natural Sophistication.\" We are seeing a surge in: \r\n<ul>\r\n    <li>**Burnt Cinnamon:** A deep reddish-brown that glows in the Ghanaian sun.</li>\r\n    <li>**Smoked Honey:** A muted blond that isn\'t too bright but adds a \"light\" to the face.</li>\r\n    <li>**Espresso Velvet:** A black that is so deep it has a soft, brownish-grey undertone, looking incredibly realistic.</li>\r\n</ul> These colors are achieved through specialized 2026 \"multi-tonal\" dyeing techniques that involve layering three or more shades for a realistic finish.</p>\r\n\r\n<h3>Color Maintenance: Protecting the Hue</h3>\r\n<p>High-quality color requires high-quality care. The Accra sun is strong, and UV rays can fade professional colors. In 2026, we recommend UV-protectant hair mists. These acts as \"sunscreen\" for your wig, preventing the color from turning brassy or dull. Use color-safe, sulfate-free shampoos to ensure your muted luxury tones stay vibrant and true for as long as possible.</p>\r\n\r\n<h3>Conclusion</h3>\r\n<p>Don\'t just pick a color; pick a masterpiece. By understanding color theory, you can choose a unit that doesn\'t just look good, but makes *you* look your best. Book a professional color consultation at Hair Aura and find your 2026 signature shade.</p>', 'blog_wig_color_2026.webp', 1, 'Hair Education', 'wig color theory, muted luxury hair, 2026 color trends', '2026 Wig Color Theory Guide | Hair Aura Accra', 'Choosing the right wig color for your skin tone in 2026. Discover the secrets of muted luxury tones and rooted colors.', 0, 1, '2026-04-13 09:00:00', '2026-03-05 00:35:32', '2026-03-05 14:40:29', NULL),
(35, 'The Ethics of Hair: Understanding Sustainable Sourcing', 'ethical-hair-sourcing-sustainability-2026', '<pre>In 2026, luxury must be responsible. Learn about the Hair Aura commitment to ethical sourcing and why sustainable human hair matters.</pre>', '<h2>Beauty with a Conscience</h2>\r\n<p>As the global hair industry evolves in 2026, \"<strong>Luxury</strong>\" is being redefined. It is no longer just about the finish of the hair; it is about the story behind it. The modern Ghanaian consumer is increasingly concerned with the ethics of their purchases. Where did this hair come from? Were the donors treated fairly? At Hair Aura, we believe that true beauty cannot exist without integrity. This is the 2026 guide to ethical hair sourcing.</p>\r\n<h3>The Single-Donor Traceability</h3>\r\n<p>In 2026, traceability is the ultimate luxury. Our \"<strong>Raw Donor</strong>\" collection comes with a sourcing guarantee. We only work with communities where hair donation is a voluntary, culturally respected practice. By sourcing from single donors, we don\'t just ensure quality; we ensure that we know exactly where every bundle originated. This eliminates the \"uncertainty\" that often plagues the mass-market hair industry.</p>\r\n<h3>Fair Trade in the Hair World</h3>\r\n<p>Sustainability in the hair industry means ensuring that everyone in the supply chain benefits. For 2026, we have strengthened our partnerships with ethical collectors who provide fair compensation to donors. We believe that by supporting these ethical practices, we are helping to build a more sustainable future for the entire beauty industry. When you wear a Hair Aura unit, you are wearing a product of respect and fair trade.</p>\r\n<h3>Eco-Friendly Processing</h3>\r\n<p>Traditional hair processing often involves harsh chemicals that are bad for the hair and the environment. In 2026, Hair Aura has shifted toward \"<strong>Bio-Cleansing</strong>\" systems. These use natural enzymes and plant-based cleaners to prepare the hair, preserving its natural strength while minimizing the environmental footprint. Our goal is to provide the world\'s best human hair while protecting the world that produced it.</p>\r\n<h3>The Longevity as Sustainability</h3>\r\n<p>The most sustainable choice you can make is to buy hair that lasts. Fast-fashion synthetic wigs end up in landfills within weeks. A high-quality, ethically sourced Hair Aura unit is designed to last years. By choosing quality over quantity, you are reducing waste and making a responsible choice for the planet. In 2026, sustainability is a lifestyle, and it starts with the crown you wear.</p>\r\n<h3>Conclusion</h3>\r\n<p>The future of luxury is ethical. We are proud to lead the way in Ghana by providing hair that is as kind to the world as it is beautiful on you. Thank you for choosing beauty with a conscience. Explore our 2026 Sustainability Collection and wear your aura with pride.</p>', 'blog_hair_ethics_2026.webp', 1, 'Hair Education', 'ethical hair sourcing, sustainable beauty 2026, luxury hair ethics', '2026 Ethical Hair Sourcing Guide | Hair Aura', 'Learn about the importance of ethical and sustainable hair sourcing in 2026. How Hair Aura ensures parity and quality in every unit.', 3, 1, '2026-04-16 09:00:00', '2026-03-05 00:35:32', '2026-03-05 14:40:29', NULL);

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
(61, 1, 1, NULL, 1, '2026-03-04 06:17:28', '2026-03-04 06:17:28'),
(62, 1, 34, 29, 1, '2026-03-04 06:17:28', '2026-03-04 06:17:28'),
(63, 1, 24, 1, 1, '2026-03-04 06:17:28', '2026-03-04 06:17:28');

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
(1, 'apple-touch-icon.webp', 'apple-touch-icon.webp', 'uploads/favicons/apple-touch-icon.webp', 'favicons', 'image/webp', 'webp', 2728, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(2, 'default-avatar.svg', 'default-avatar.svg', 'img/default-avatar.svg', 'media', 'image/svg+xml', 'svg', 497, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(3, 'favicon-96x96.webp', 'favicon-96x96.webp', 'uploads/favicons/favicon-96x96.webp', 'favicons', 'image/webp', 'webp', 1554, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(4, 'favicon.ico', 'favicon.ico', 'uploads/favicons/favicon.ico', 'favicons', 'image/vnd.microsoft.icon', 'ico', 15086, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(5, 'favicon.svg', 'favicon.svg', 'uploads/favicons/favicon.svg', 'favicons', 'image/svg+xml', 'svg', 17663, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(6, 'favicon.webp', 'favicon.webp', 'uploads/favicons/favicon.webp', 'favicons', 'image/webp', 'webp', 930, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(7, 'favicon_1.webp', 'favicon_1.webp', 'uploads/favicons/favicon_1.webp', 'favicons', 'image/webp', 'webp', 7416, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(11, 'logo.webp', 'logo.webp', 'uploads/logos/logo.webp', 'logos', 'image/webp', 'webp', 7416, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(12, 'logo_1.webp', 'logo_1.webp', 'uploads/logos/logo_1.webp', 'logos', 'image/webp', 'webp', 2408, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(14, 'og-image.webp', 'og-image.webp', 'uploads/logos/og-image.webp', 'logos', 'image/webp', 'webp', 47978, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(15, 'og-image_1.webp', 'og-image_1.webp', 'uploads/logos/og-image_1.webp', 'logos', 'image/webp', 'webp', 7416, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(16, 'product-placeholder.webp', 'product-placeholder.webp', 'img/product-placeholder.webp', 'media', 'image/webp', 'webp', 47978, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
(17, 'web-app-manifest-192x192.webp', 'web-app-manifest-192x192.webp', 'uploads/favicons/web-app-manifest-192x192.webp', 'favicons', 'image/webp', 'webp', 2920, NULL, 'static', 1, '2026-02-17 00:32:16', NULL),
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
(146, 'momo-payment-banner.png', 'momo-payment-banner.png', 'img/momo-payment-banner.png', 'media', 'image/png', 'png', 198660, NULL, 'static', 1, '2026-03-03 01:49:56', NULL),
(152, 'Bone-straight.webp', '../categories/Bone-straight.webp', 'uploads/blog/../categories/Bone-straight.webp', 'blog', 'image/png', 'webp', 552245, NULL, 'synced', 1, '2026-03-03 01:56:32', NULL),
(157, 'hero-1.png', 'hero-1.png', 'img/hero-1.png', 'media', '', 'png', 601385, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(158, 'hero-2.png', 'hero-2.png', 'img/hero-2.png', 'media', '', 'png', 330362, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(159, 'hero-3.png', 'hero-3.png', 'img/hero-3.png', 'media', '', 'png', 572050, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(160, 'noise.png', 'noise.png', 'img/noise.png', 'media', '', 'png', 54589, NULL, 'static', 1, '2026-03-03 05:38:56', NULL),
(162, 'cat_IMG_0326.webp', 'cat_IMG_0326.webp', 'uploads/categories/cat_IMG_0326.webp', 'categories', '', 'webp', 103872, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(163, 'Straight-hair.webp', 'Straight-hair.webp', 'uploads/blog/Straight-hair.webp', 'blog', 'image/webp', 'webp', 589590, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(164, 'blog_face_shape_2026.webp', 'blog_face_shape_2026.webp', 'uploads/blog/blog_face_shape_2026.webp', 'blog', 'image/webp', 'webp', 611930, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(165, 'blog_lace_comparison_2026.webp', 'blog_lace_comparison_2026.webp', 'uploads/blog/blog_lace_comparison_2026.webp', 'blog', 'image/webp', 'webp', 106936, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(166, 'blog_trends_2024_2026.webp', 'blog_trends_2024_2026.webp', 'uploads/blog/blog_trends_2024_2026.webp', 'blog', 'image/webp', 'webp', 157794, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(167, 'blog_secure_wig_2026.webp', 'blog_secure_wig_2026.webp', 'uploads/blog/blog_secure_wig_2026.webp', 'blog', 'image/webp', 'webp', 93924, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(168, 'blog_glueless_wigs_2026.webp', 'blog_glueless_wigs_2026.webp', 'uploads/blog/blog_glueless_wigs_2026.webp', 'blog', 'image/webp', 'webp', 66450, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(169, 'blog_hair_comparison_2026.webp', 'blog_hair_comparison_2026.webp', 'uploads/blog/blog_hair_comparison_2026.webp', 'blog', 'image/webp', 'webp', 129726, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(170, 'blog_humidity_care_2026.webp', 'blog_humidity_care_2026.webp', 'uploads/blog/blog_humidity_care_2026.webp', 'blog', 'image/webp', 'webp', 126270, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(171, 'blog_bridal_hair_2026.webp', 'blog_bridal_hair_2026.webp', 'uploads/blog/blog_bridal_hair_2026.webp', 'blog', 'image/webp', 'webp', 158538, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(172, 'blog_lace_tinting_2026.webp', 'blog_lace_tinting_2026.webp', 'uploads/blog/blog_lace_tinting_2026.webp', 'blog', 'image/webp', 'webp', 74162, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(173, 'blog_ready_to_wear_2026.png', 'blog_ready_to_wear_2026.png', 'uploads/blog/blog_ready_to_wear_2026.png', 'blog', 'image/png', 'png', 709109, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(174, 'blog_lace_closure_vs_frontal_2026.png', 'blog_lace_closure_vs_frontal_2026.png', 'uploads/blog/blog_lace_closure_vs_frontal_2026.png', 'blog', 'image/png', 'png', 561138, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(175, 'blog_pixie_bob_trends_2026.webp', 'blog_pixie_bob_trends_2026.webp', 'uploads/blog/blog_pixie_bob_trends_2026.webp', 'blog', 'image/webp', 'webp', 500159, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(176, 'blog_body_wave_maintenance_2026.webp', 'blog_body_wave_maintenance_2026.webp', 'uploads/blog/blog_body_wave_maintenance_2026.webp', 'blog', 'image/webp', 'webp', 620512, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(177, 'blog_braided_afro_wigs_2026.webp', 'blog_braided_afro_wigs_2026.webp', 'uploads/blog/blog_braided_afro_wigs_2026.webp', 'blog', 'image/webp', 'webp', 642876, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(178, 'blog_luxury_extension_care_2026.png', 'blog_luxury_extension_care_2026.png', 'uploads/blog/blog_luxury_extension_care_2026.png', 'blog', 'image/png', 'png', 830134, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(179, 'blog_bridal_trends_2026.png', 'blog_bridal_trends_2026.png', 'uploads/blog/blog_bridal_trends_2026.png', 'blog', 'image/png', 'png', 757268, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(180, 'blog_raw_donor_luxury_2026.webp', 'blog_raw_donor_luxury_2026.webp', 'uploads/blog/blog_raw_donor_luxury_2026.webp', 'blog', 'image/webp', 'webp', 764723, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(181, 'blog_glueless_tech_2026.png', 'blog_glueless_tech_2026.png', 'uploads/blog/blog_glueless_tech_2026.png', 'blog', 'image/png', 'png', 743118, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(182, 'blog_voluminous_curls_2026.webp', 'blog_voluminous_curls_2026.webp', 'uploads/blog/blog_voluminous_curls_2026.webp', 'blog', 'image/webp', 'webp', 746358, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(183, 'blog_wig_travel_2026.png', 'blog_wig_travel_2026.png', 'uploads/blog/blog_wig_travel_2026.png', 'blog', 'image/png', 'png', 552245, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(184, 'blog_summer_heat_hacks_2026.png', 'blog_summer_heat_hacks_2026.png', 'uploads/blog/blog_summer_heat_hacks_2026.png', 'blog', 'image/png', 'png', 830134, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(185, 'blog_wig_switch_tips_2026.webp', 'blog_wig_switch_tips_2026.webp', 'uploads/blog/blog_wig_switch_tips_2026.webp', 'blog', 'image/webp', 'webp', 594750, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(186, 'blog_deep_condition_ritual_2026.webp', 'blog_deep_condition_ritual_2026.webp', 'uploads/blog/blog_deep_condition_ritual_2026.webp', 'blog', 'image/webp', 'webp', 589590, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(187, 'blog_lace_types_2026.png', 'blog_lace_types_2026.png', 'uploads/blog/blog_lace_types_2026.png', 'blog', 'image/png', 'png', 588047, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(188, 'blog_hair_density_2026.webp', 'blog_hair_density_2026.webp', 'uploads/blog/blog_hair_density_2026.webp', 'blog', 'image/webp', 'webp', 746358, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(189, 'blog_wig_anatomy_2026.webp', 'blog_wig_anatomy_2026.webp', 'uploads/blog/blog_wig_anatomy_2026.webp', 'blog', 'image/webp', 'webp', 594750, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(190, 'blog_cap_construction_2026.webp', 'blog_cap_construction_2026.webp', 'uploads/blog/blog_cap_construction_2026.webp', 'blog', 'image/webp', 'webp', 630760, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(191, 'blog_bridal_timeline_2026.png', 'blog_bridal_timeline_2026.png', 'uploads/blog/blog_bridal_timeline_2026.png', 'blog', 'image/png', 'png', 757268, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(192, 'blog_bridal_party_2026.webp', 'blog_bridal_party_2026.webp', 'uploads/blog/blog_bridal_party_2026.webp', 'blog', 'image/webp', 'webp', 607057, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(193, 'blog_engagement_trends_2026.webp', 'blog_engagement_trends_2026.webp', 'uploads/blog/blog_engagement_trends_2026.webp', 'blog', 'image/webp', 'webp', 764723, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(194, 'blog_party_wig_switch_2026.webp', 'blog_party_wig_switch_2026.webp', 'uploads/blog/blog_party_wig_switch_2026.webp', 'blog', 'image/webp', 'webp', 500159, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(195, 'blog_wig_storage_2026.png', 'blog_wig_storage_2026.png', 'uploads/blog/blog_wig_storage_2026.png', 'blog', 'image/png', 'png', 588047, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(196, 'blog_wig_color_2026.webp', 'blog_wig_color_2026.webp', 'uploads/blog/blog_wig_color_2026.webp', 'blog', 'image/webp', 'webp', 607057, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(197, 'blog_hair_ethics_2026.webp', 'blog_hair_ethics_2026.webp', 'uploads/blog/blog_hair_ethics_2026.webp', 'blog', 'image/webp', 'webp', 642876, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(198, 'Straight-hair.webp', 'Straight-hair.webp', 'uploads/products/Straight-hair.webp', 'products', '', 'webp', 589590, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL),
(199, 'avatar_69969b8c157f00.81790273.jpg', 'avatar_69969b8c157f00.81790273.jpg', 'uploads/avatars/avatar_69969b8c157f00.81790273.jpg', 'avatars', '', 'jpg', 3713169, NULL, 'synced', 1, '2026-03-05 12:51:17', NULL);

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
(56, 34, 'Frontalpixie-hair-1772363734.webp', 'Frontalpixie-hair-1772363734', 1, 1, '2026-03-02 17:44:04'),
(60, 3, 'Body-wave.webp', 'Body wave Special', 1, 1, '2026-03-03 13:24:47'),
(61, 21, 'Pixie-curls-hair-1772544664.webp', 'Luxe Natural Curls', 1, 1, '2026-03-03 13:24:56'),
(62, 23, 'Straight-hair.webp', 'Classic Silky Straight', 1, 1, '2026-03-03 13:25:05');

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
(1, 'admin@hair-aura.debesties.com', '$2y$10$9hrn/d49Ei2OmTgSilnPPu7DoDi2qfyapg9A3/PY7LlaqCiQQmzHq', 'Hair', 'Aura', '+233508007873', 'web-app-manifest-512x512-1771309983.webp', 'admin', 1, 0, 1, '2026-02-11 20:33:35', '2026-03-05 12:29:04', '2026-03-05 13:29:04', NULL, NULL),
(2, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ama', 'Owusu', '+233241234567', NULL, 'customer', 0, 0, 1, '2026-02-11 20:33:35', '2026-03-03 17:00:46', NULL, NULL, NULL),
(3, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kwasi', 'Mensah', '+233551234567', NULL, 'customer', 0, 0, 1, '2026-02-11 20:33:35', '2026-03-03 17:00:46', NULL, NULL, NULL),
(4, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abena', 'Darko', '+233201234568', NULL, 'customer', 0, 0, 1, '2026-02-11 20:33:35', '2026-03-03 17:00:46', NULL, NULL, NULL),
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `media_library`
--
ALTER TABLE `media_library`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
