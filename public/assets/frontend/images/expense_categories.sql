-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2026 at 01:24 PM
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
-- Database: `shiv`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `key`, `label`, `created_at`, `updated_at`) VALUES
(1, 'utilities', 'Utilities (Electricity, Water)', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(2, 'maintenance', 'Maintenance & Repairs', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(3, 'priest_salary', 'Priest / Staff Salary', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(4, 'festival', 'Festival Expenses', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(5, 'supplies', 'Pooja Supplies', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(6, 'charity', 'Charity / Annadanam', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(7, 'other', 'Other', '2026-08-03 08:31:20', '2026-08-03 08:31:20'),
(8, 'construction', 'Construction', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(9, 'idols', 'Idols', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(10, 'event', 'Event', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(11, 'ops', 'Ops', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(12, 'dakshina', 'Dakshina', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(13, 'tent', 'Tent', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(14, 'pran_pratishtha', 'Pran Pratishtha', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(15, 'speaker', 'Speaker', '2026-08-03 08:32:50', '2026-08-03 08:32:50'),
(16, 'carpenter', 'Carpenter', '2026-08-03 08:32:50', '2026-08-03 08:32:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_categories_key_unique` (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
