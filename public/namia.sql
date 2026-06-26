-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2026 at 05:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `namia`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dump_leads`
--

CREATE TABLE `dump_leads` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE `follow_ups` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `follow_up_date` date DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `complete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow_ups`
--

INSERT INTO `follow_ups` (`id`, `lead_id`, `follow_up_date`, `remark`, `complete`, `created_at`, `updated_at`) VALUES
(3, 3, '2026-03-28', 'call me again', 0, '2026-03-25 05:13:22', '2026-03-25 05:13:22'),
(4, 2, '2026-03-26', 'call me again', 0, '2026-03-26 02:07:44', '2026-03-26 02:07:44'),
(5, 3, '2026-03-27', 'call me again', 0, '2026-03-26 23:56:50', '2026-03-26 23:56:50'),
(6, 7, '2026-03-28', 'call me again', 0, '2026-03-27 01:25:31', '2026-03-27 01:25:31'),
(7, 9, '2026-03-27', 'call me again', 0, '2026-03-27 01:28:40', '2026-03-27 01:28:40'),
(8, 44, '2026-04-06', 'call me again', 1, '2026-04-08 04:47:31', '2026-04-07 23:17:31'),
(9, 44, '2026-04-16', 'call me again', 1, '2026-04-08 04:47:18', '2026-04-07 23:17:18'),
(10, 44, '2026-04-28', 'call me again', 0, '2026-04-07 07:04:58', '2026-04-07 07:04:58'),
(11, 44, '2026-04-08', 'call me again', 0, '2026-04-07 23:40:15', '2026-04-07 23:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `stage` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `user_id`, `name`, `location`, `email`, `phone`, `status`, `notes`, `project`, `source`, `stage`, `created_by`, `created_at`, `updated_at`) VALUES
(19, 5, 'Akshay', 'Zirakpur', '', '8975432176', 'Cold', 'Test', '', '', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(20, 5, 'Vijay', '', '', '7873287621', 'Cold', '', '', '', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(21, 5, 'Vishal', '', '', '6739872134', 'Cold', '', '', 'Meta', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(22, 5, 'Vinay Kumar', '', 'test@test.com', '7623987621', 'Cold', '', '', '', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(23, 5, 'Ajay', 'Shimla', NULL, '0000989898', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(24, 5, 'Vishal Kimar', 'Kangra', NULL, '9898989898', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(25, 5, 'John Doe', 'Mohali', NULL, '9876543210', 'Cold', NULL, NULL, 'Tele Sale', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(26, 5, 'Jane Smith', 'Chandigarh', NULL, '9999999999', 'Cold', NULL, NULL, 'Tele Sale', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(27, 5, 'The International Trucking', 'Mohali', NULL, '09878972502', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(28, 5, 'Marshall India Logistics', 'Ludhiana', NULL, '09878697090', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(29, 5, 'Supreme Logistics Co.', 'Ludhiana', NULL, '09501449768', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(30, 5, 'GO Speed E Logistics', 'Ludhiana', NULL, '09814649511', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(31, 5, 'Brightways Logistics', 'Jalandhar', NULL, '08533903333', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(32, 5, 'Surgeport Logistics Pvt Ltd', 'Jalandhar', NULL, '08056119224', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(33, 5, 'Himachal Punjab Roadways Co', 'Jalandhar', NULL, '09622208895', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(34, 5, 'Punjab Himachal Goods Transport Co', 'Jalandhar', NULL, '09814579937', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(35, 5, 'MMC Logistic Pvt Ltd', 'Ludhiana', NULL, '09317710003', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(36, 5, 'Mahalaxmi Logistics Pvt Ltd', 'Ludhiana', NULL, '09872355595', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(37, 5, 'Shiva Logistics', 'Ludhiana', NULL, '09357133136', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(38, 5, 'Golden Temple Transport Company Pvt Ltd', 'Ludhiana/Jalandhar', NULL, '09417700011', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(39, 5, 'ATC – Amritsar Transport Co Pvt Ltd', 'Jalandhar', NULL, '09317668380', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(40, 5, 'Tera Tera Logistics', 'Mohali', NULL, '07973538756', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(41, 5, 'One Point Logistics Solution Pvt Ltd', 'Jalandhar', NULL, '09781337070', 'Cold', NULL, NULL, 'Referral', NULL, 2, '2026-03-27 11:42:56', '2026-03-27 06:12:56'),
(42, 1, 'Navjot Singh', 'Mohali', 'test@company.com', '9815330449', 'Cold', NULL, 'None specified', 'Meta', NULL, 1, '2026-04-09 06:48:05', '2026-04-09 01:18:05'),
(43, 1, 'Navjot Singh', 'Mohali', 'test@company.com', '9815330449', 'Cold', NULL, 'None specified', 'Meta', NULL, 1, '2026-04-09 06:48:05', '2026-04-09 01:18:05'),
(44, 1, 'Navjot Singh', 'TDI MOHALI', 'sqs@dert', '9815330449', 'Cold', NULL, 'GDPL 114', 'Meta', 'Visit', 1, '2026-04-08 06:35:46', '2026-04-08 01:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `staus` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `staus`, `created_at`, `updated_at`) VALUES
(1, 'GDPL 91', 1, '2026-03-31 00:44:02', '2026-03-31 00:44:02'),
(2, 'GDPL 114', 1, '2026-03-31 23:28:25', '2026-03-31 23:28:25'),
(3, 'Atlantis 360', 1, '2026-03-31 23:29:06', '2026-03-31 23:29:06'),
(4, 'Mohali Walk', 1, '2026-03-31 23:29:38', '2026-03-31 23:29:38'),
(5, 'Yugen Infra', 1, '2026-03-31 23:30:48', '2026-03-31 23:30:48'),
(7, 'Goa', 1, '2026-03-31 23:32:52', '2026-03-31 23:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4q6UDDDbpFB8qIG89x6vCGmELi8iIvMzdNz6gniK', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHVwOGtLYnJVMkJ3eTk3Y2lwTURPQVNHRmVnRUhHYVh3OEhBUkhvTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1779773621),
('6wpeRqr0fLaRJLxh2PHCcirw1IwFtHQRu9VUk4yH', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemloUVgzcHlFcU5XTXJIcmduNGNnZU9jTXdvbWZRZGpGbUdQTlNidCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb2xsb3ctdXAiO3M6NToicm91dGUiO3M6OToiZm9sbG93LXVwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1775566607),
('clJVQGfZWJzbPAR97Kw1NNhCLGwMjibSP9o1MHgQ', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSmVlYVlTbmMwOWRqSVFQY2huZTZNekplcVJUbFVlWDBoZmpYZWQxaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGwtbGVhZHMvNDQiO3M6NToicm91dGUiO3M6MTQ6ImFsbC1sZWFkcy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1779692411),
('D2nASH3MFQOMU8hseUmeOuDSy8Ec46u0JwNhnAeF', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibzBCaWVwTWtNWEVuV3lHNTE4TnNuZWpBUHBUa2dGTEJEQWpidnpSTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFkcy80NCI7czo1OiJyb3V0ZSI7czoxMDoibGVhZHMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1775548222),
('GeMVT6A9vBwtm2cSoX2Ja47XX95sVHM31763bjNh', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNklLb2h3MnpNQVpQUlZmNGNSUXBVSFd5QmxTdEFpb2dTbVp5a1d0RyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGVhZHMvNDQiO3M6NToicm91dGUiO3M6MTA6ImxlYWRzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1775570058),
('GR3ISBOMJ4KElELwQKavJfDtJtIbpwkOcvpCfllA', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWU4yd0p3dklmcHY3M3FJRmNSU0VCYXJzZzlYTTJLbDBBMkRvanVOMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779716289),
('hxfPAR9ACnnWDdId7J6VCr4Hy8iontxqJLAgZz0D', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOFR5V2JjR1hUQnFoZ0FaY01aNjhmdTQwZ2swUnlHZ0pTNVVLSjNnayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1775719617),
('PuWGMXHt9fpwPfVYDgqymky0HJ3fqm8Cw9lhtDv7', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibnJodGxCUzRtdDliWXEwMUhQanNjWThXZ1ZpemJRVW5qbWJGMzRYTSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3RhZmYvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE3OiJjb21wYW55LWRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1775630157),
('wOCPRaAy5AvgjcsRAHjRSZfY51Gxigf6cKAe9omU', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieGd6bm91c1RUYlhBNjNPT1ZlR2RIY1g0VzBOY3RLTzRjNUxNeDQ3ayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1775195141);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `staus` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `staus`, `created_at`, `updated_at`) VALUES
(2, 'Cold', 1, '2026-04-01 04:23:07', '2026-04-01 04:23:07'),
(3, 'Exploring', 1, '2026-04-01 04:23:46', '2026-04-01 04:23:46'),
(4, 'Interested', 1, '2026-04-01 04:24:23', '2026-04-01 04:24:23'),
(5, 'Ready to Invest', 1, '2026-04-01 04:24:50', '2026-04-01 04:24:50'),
(6, 'Not connected', 1, '2026-04-01 04:25:10', '2026-04-01 04:25:10'),
(7, 'Dead', 1, '2026-04-01 04:25:26', '2026-04-01 04:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `company_id`, `role`) VALUES
(1, 'Test Company', 'test@company.com', '2026-02-09 04:15:55', '$2y$12$Z2LoQ2DJPtC2FPg.UP6gN.LMqjmUboCWPDPR4Evw/fEKrTHOQonqm', 'GSWo246EKE35fwpJEdaHraqX5NOmBYVurxXEcWKcpPud1pOuzMEIywycLOHG', '2026-02-09 04:15:55', '2026-02-09 04:15:55', NULL, 1, 'company'),
(2, 'Admin', 'admin@girafe.com', NULL, '$2y$12$Z2LoQ2DJPtC2FPg.UP6gN.LMqjmUboCWPDPR4Evw/fEKrTHOQonqm', NULL, '2026-02-09 04:18:26', '2026-02-09 04:18:26', NULL, NULL, 'admin'),
(5, 'Navjot Singh', 'navjot.singh@thegirafe.in', NULL, '$2y$12$6K/.3VbmfPI1GWiWnTDyWO0x.JJE6M9NRrwhNFAG67SF94TizmhtK', NULL, '2026-03-05 04:58:59', '2026-03-05 04:58:59', NULL, NULL, 'company');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `dump_leads`
--
ALTER TABLE `dump_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dump_leads`
--
ALTER TABLE `dump_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `follow_ups`
--
ALTER TABLE `follow_ups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
