-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 03:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dialog`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE `additional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dsr_id` int(11) NOT NULL,
  `sum_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`id`, `dsr_id`, `sum_id`, `date`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '6', '2022-12-06', 1, 1, '2022-12-05 22:26:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addtional_bank`
--

CREATE TABLE `addtional_bank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `additional_id` int(11) NOT NULL DEFAULT 0,
  `bank_id` int(11) NOT NULL,
  `bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edited_bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_amount` double NOT NULL DEFAULT 0,
  `edited_bank_amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addtional_credit`
--

CREATE TABLE `addtional_credit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `additional_id` int(11) NOT NULL DEFAULT 0,
  `credit_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edited_credit_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_amount` double NOT NULL DEFAULT 0,
  `edited_credit_amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addtional_credit_collection`
--

CREATE TABLE `addtional_credit_collection` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `additional_id` int(11) NOT NULL DEFAULT 0,
  `credit_collection_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edited_credit_collection_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_collection_amount` double NOT NULL DEFAULT 0,
  `edited_credit_collection_amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addtional_directbank`
--

CREATE TABLE `addtional_directbank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `additional_id` int(11) NOT NULL DEFAULT 0,
  `bank_id` int(11) NOT NULL,
  `direct_bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edited_direct_bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_bank_amount` double NOT NULL DEFAULT 0,
  `edited_direct_bank_amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addtional_directbank`
--

INSERT INTO `addtional_directbank` (`id`, `additional_id`, `bank_id`, `direct_bank_ref_no`, `edited_direct_bank_ref_no`, `direct_bank_amount`, `edited_direct_bank_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '741', '741', 100, 150, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$2lVNK7kxZxOq7zPPJoZUzusu6NqwCCVXPSx9r8PmVJsFgmdY3ECLO', 1, NULL, NULL),
(3, 'Tharaka', 'tharaka@gmail.com', '$2y$10$JNsoX21LQ3QvPJgwDomKAecl7RQ9ci76LW3V6jPFNgyFtI68h5fq6', 1, NULL, NULL),
(4, 'Piumi', 'piumi@gmail.com', '$2a$12$JlXKF3ojGpMW/lzBmnWyOuAT0RqZ134GR92bhIUQqD7BRjbi6p/5.', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bankings`
--

CREATE TABLE `bankings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bankings`
--

INSERT INTO `bankings` (`id`, `bank_id`, `bank_ref_no`, `bank_amount`, `dsr_id`, `sum_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1234', 5000, 3, 3, 1, '2022-12-14 06:13:00', '2022-12-14 06:13:00'),
(2, 2, '741', 100, 3, 3, 1, '2022-12-14 06:13:00', '2022-12-14 06:13:00'),
(3, 3, '1234', 100, 3, 8, 1, '2022-12-14 07:09:11', '2022-12-14 07:09:11'),
(4, 4, '741', 200, 3, 8, 1, '2022-12-14 07:09:11', '2022-12-14 07:09:11'),
(5, 2, '1234', 500, 4, 9, 1, '2022-12-14 07:09:26', '2022-12-14 07:09:26'),
(6, 3, '741', 1000, 4, 9, 1, '2022-12-14 07:09:26', '2022-12-14 07:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cargills Bank', 1, '2022-11-22 18:10:53', '2022-11-22 18:10:53'),
(2, 'Sampath Bank', 1, '2022-11-22 18:11:04', '2022-11-22 18:11:04'),
(3, 'Sampath Bank - Online', 1, '2022-11-22 18:11:54', '2022-12-06 01:03:18'),
(4, 'People\'s Bank', 1, '2022-11-22 18:12:07', '2022-11-22 18:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_amount` double NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `credit_customer_name`, `credit_amount`, `sum_id`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'rehan', 250, 1, 1, 1, '2022-12-14 06:12:55', '2022-12-14 06:12:55'),
(2, 'abc', 50, 1, 1, 1, '2022-12-14 06:12:55', '2022-12-14 06:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `credit_collections`
--

CREATE TABLE `credit_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_collection_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_collection_amount` double NOT NULL DEFAULT 0,
  `option_id` int(11) NOT NULL,
  `sum_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_collections`
--

INSERT INTO `credit_collections` (`id`, `credit_collection_customer_name`, `credit_collection_amount`, `option_id`, `sum_id`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'rehan', 20, 1, 4, 4, 1, '2022-12-14 06:13:05', '2022-12-14 06:13:05'),
(2, 'abc', 30, 2, 4, 4, 1, '2022-12-14 06:13:05', '2022-12-14 06:13:05'),
(3, 'def', 50, 3, 4, 4, 1, '2022-12-14 06:13:05', '2022-12-14 06:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `credit_collection_items`
--

CREATE TABLE `credit_collection_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_collection_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_collection_items`
--

INSERT INTO `credit_collection_items` (`id`, `credit_collection_id`, `item_id`, `item_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, 1, '2022-12-14 06:13:05', '2022-12-14 06:13:05'),
(2, 2, 2, 30, 1, '2022-12-14 06:13:05', '2022-12-14 06:13:05'),
(3, 3, 2, 50, 1, '2022-12-14 06:13:05', '2022-12-14 06:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `credit_items`
--

CREATE TABLE `credit_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_items`
--

INSERT INTO `credit_items` (`id`, `credit_id`, `item_id`, `item_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 1, '2022-12-14 06:12:55', '2022-12-14 06:12:55'),
(2, 1, 2, 150, 1, '2022-12-14 06:12:55', '2022-12-14 06:12:55'),
(3, 2, 3, 50, 1, '2022-12-14 06:12:55', '2022-12-14 06:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `directbankings`
--

CREATE TABLE `directbankings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_bank_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_bank_id` int(11) NOT NULL,
  `direct_bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_bank_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directbankings`
--

INSERT INTO `directbankings` (`id`, `direct_bank_customer_name`, `direct_bank_id`, `direct_bank_ref_no`, `direct_bank_amount`, `dsr_id`, `sum_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'abc', 1, '1234', 200, 2, 2, 1, '2022-12-14 06:12:58', '2022-12-14 06:12:58'),
(2, 'xyz', 3, '741', 100, 2, 2, 1, '2022-12-14 06:12:58', '2022-12-14 06:12:58'),
(3, 'rehan', 1, '1234', 200, 1, 6, 1, '2022-12-14 07:04:07', '2022-12-14 07:04:07'),
(4, 'charith', 3, '741', 100, 1, 6, 1, '2022-12-14 07:04:07', '2022-12-14 07:04:07'),
(5, 'oshan', 1, '1234', 500, 2, 7, 1, '2022-12-14 07:04:27', '2022-12-14 07:04:27'),
(6, 'kasun', 3, '741', 820, 2, 7, 1, '2022-12-14 07:04:27', '2022-12-14 07:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `drs_cheques`
--

CREATE TABLE `drs_cheques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sum_id` int(11) NOT NULL,
  `dsrs_id` int(11) NOT NULL,
  `cheque_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_amount` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drs_cheques`
--

INSERT INTO `drs_cheques` (`id`, `sum_id`, `dsrs_id`, `cheque_no`, `cheque_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '45896', 30, 1, '2022-12-14 06:13:10', '2022-12-14 06:13:10'),
(2, 5, 1, '45896', 30, 1, '2022-12-14 06:13:48', '2022-12-14 06:13:48'),
(3, 5, 1, '123', 70, 1, '2022-12-14 06:13:48', '2022-12-14 06:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `dsrs`
--

CREATE TABLE `dsrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `in_hand` double NOT NULL DEFAULT 0,
  `cash` double NOT NULL DEFAULT 0,
  `cheque` double NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL,
  `dsr_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dsrs`
--

INSERT INTO `dsrs` (`id`, `in_hand`, `cash`, `cheque`, `sum_id`, `dsr_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 230, 100, 130, 5, 5, 1, '2022-12-14 06:13:10', '2022-12-14 06:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `dsr_retun_no`
--

CREATE TABLE `dsr_retun_no` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dsr_return_id` int(11) NOT NULL,
  `dsr_stock_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dsr_stocks`
--

CREATE TABLE `dsr_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL,
  `total` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dsr_stock_items`
--

CREATE TABLE `dsr_stock_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dsr_stock_id` double NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `issue_return_qty` double NOT NULL DEFAULT 0,
  `approve_return_qty` double NOT NULL DEFAULT 0,
  `sale_qty` double NOT NULL DEFAULT 0,
  `retailer_qty` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchasing_price` double NOT NULL DEFAULT 0,
  `selling_price` double NOT NULL DEFAULT 0,
  `qty` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `purchasing_price`, `selling_price`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MBB - 49', 45.8, 47, 500000, 1, '2022-07-04 01:38:20', '2022-07-04 01:38:20'),
(2, 'MBB - 99', 92.6, 95, 500000, 1, '2022-07-04 01:43:04', '2022-07-04 01:43:04'),
(3, 'MBB - 199', 183.5, 188.3, 500000, 1, '2022-07-04 01:56:10', '2022-07-04 01:56:10'),
(4, 'MBB - 649', 584, 603.5, 500000, 1, '2022-07-04 01:56:53', '2022-07-04 01:56:53'),
(5, 'LNB DTTL - TR', 750, 800, 500000, 1, '2022-07-04 01:57:24', '2022-07-04 01:57:24'),
(6, '30 M Cable', 2300, 2350, 500000, 1, '2022-07-04 01:58:06', '2022-07-04 01:58:06'),
(7, 'MBB - 449', 404, 417.5, 500000, 1, '2022-08-05 15:22:27', '2022-08-05 15:22:27'),
(8, 'LNB Pack - WR', 0, 0, 500000, 1, '2022-08-05 15:25:30', '2022-08-05 15:25:30'),
(9, '12V Power Adapter', 1300, 1350, 500000, 1, '2022-08-05 15:26:25', '2022-08-05 15:26:25'),
(10, 'DTV - RCU Pack - TR', 800, 850, 500000, 1, '2022-08-05 15:27:32', '2022-08-05 15:27:32'),
(11, 'Remote Control DTTL - WR', 0, 0, 500000, 1, '2022-08-05 15:28:56', '2022-08-05 15:28:56'),
(12, 'DTV STB Pack HD', 5500, 5500, 500000, 1, '2022-08-05 15:29:32', '2022-08-05 15:29:32'),
(13, 'DTV STB Pack HD - WR', 0, 0, 500000, 1, '2022-08-05 15:30:28', '2022-08-05 15:30:28'),
(14, 'LTE SIM Native Card', 0, 0, 500000, 1, '2022-08-05 15:32:01', '2022-08-05 15:32:01'),
(15, 'New Accessory Pack - TR', 7490, 7490, 500000, 1, '2022-08-05 15:32:48', '2022-08-05 15:32:48'),
(16, '64K 4G Pre Paid ¼ SIZE - FOC', 100, 100, 499550, 1, '2022-08-05 15:34:21', '2022-08-05 15:34:21'),
(17, 'Self-Activation Pack - FOC', 0, 0, 500000, 1, '2022-08-05 15:37:01', '2022-08-05 15:37:01'),
(18, 'KIT-50', 47, 48, 493500, 1, '2022-08-05 15:37:38', '2022-08-05 15:37:38'),
(19, 'KIT-100', 93.75, 96, 492480, 1, '2022-08-05 15:38:19', '2022-08-05 15:38:19'),
(20, 'KIT-400', 368, 378, 499950, 1, '2022-08-05 15:39:09', '2022-08-05 15:39:09'),
(21, 'KIT-1000', 900, 930, 500000, 1, '2022-08-05 15:39:51', '2022-08-05 15:39:51'),
(22, 'KIT-345', 324.3, 331.2, 500000, 1, '2022-08-05 15:41:30', '2022-08-05 15:41:30'),
(23, 'LTE 4G Router S10', 3990, 3990, 500000, 1, '2022-08-05 15:42:26', '2022-08-05 15:42:26'),
(24, 'One Wallet', 1, 1, 550000, 1, '2022-08-05 15:43:14', '2022-08-05 15:43:14'),
(25, 'IDD-198', 180, 185, 500000, 1, '2022-08-05 15:44:50', '2022-08-05 15:44:50'),
(26, 'IDD-98', 90, 92.5, 500000, 1, '2022-08-05 15:45:35', '2022-08-05 15:45:35'),
(27, '15m Cable Pack', 1400, 1450, 500000, 1, '2022-08-05 15:46:34', '2022-08-05 15:46:34'),
(28, 'LTE 4G Router S10 - TR', 5990, 5990, 500000, 1, '2022-08-05 15:47:24', '2022-08-05 15:47:24'),
(29, 'DTV e-OAF - TR', 0, 0, 500000, 1, '2022-08-05 15:48:40', '2022-08-05 15:48:40'),
(30, 'Online Activation SIM Pack', 0, 0, 500000, 1, '2022-08-05 15:49:32', '2022-08-05 15:49:32'),
(31, 'Android TV Stick - TR', 9900, 9900, 500000, 1, '2022-08-05 15:50:18', '2022-08-05 15:50:18'),
(32, 'MBB - 59', 55.2, 56.6, 490000, 1, '2022-09-11 22:56:57', '2022-09-11 22:56:57'),
(33, 'MBB - 119', 111.2, 114.1, 491500, 1, '2022-09-11 22:57:27', '2022-09-11 22:57:27'),
(34, 'EZCash', 1, 1, 1800000, 1, '2022-09-12 20:34:54', '2022-09-12 20:34:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_resets_table', 1),
(36, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(37, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(38, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(39, '2016_06_01_000004_create_oauth_clients_table', 1),
(40, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(41, '2019_08_19_000000_create_failed_jobs_table', 1),
(42, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(43, '2022_07_03_071847_create_admins_table', 1),
(44, '2022_07_04_120017_create_items_table', 1),
(45, '2022_07_05_094403_create_directbankings_table', 1),
(46, '2022_07_16_070115_create_stocks_table', 1),
(47, '2022_07_18_075251_create_dsr_stocks_table', 1),
(48, '2022_07_20_064804_create_retailer_returns_table', 1),
(49, '2022_07_25_054513_create_dsr_retun_no_table', 1),
(50, '2022_09_02_113035_create_sales_table', 1),
(51, '2022_11_18_132538_create_banks_table', 1),
(52, '2022_11_23_095038_create_drs_cheques_table', 1),
(53, '2022_11_23_095843_create_credit_items_table', 1),
(54, '2022_11_23_102652_create_credit_collection_items_table', 1),
(55, '2022_11_29_041208_create_pending_sum_table', 1),
(56, '2022_11_29_041958_create_pending_sum_status_table', 1),
(57, '2022_11_29_043105_create_dsrs_table', 1),
(58, '2022_11_29_052051_create_credits_table', 1),
(59, '2022_11_29_052200_create_dsr_stock_items_table', 1),
(60, '2022_11_29_052712_create_additional_table', 1),
(61, '2022_11_29_053033_create_addtional_directbank_table', 1),
(62, '2022_11_29_053156_create_addtional_credit_table', 1),
(63, '2022_11_29_053238_create_addtional_credit_collection_table', 1),
(64, '2022_11_29_060247_create_bankings_table', 1),
(65, '2022_11_29_073839_create_addtional_bank_table', 1),
(66, '2022_12_03_044944_create_credit_collections_table', 1),
(67, '2022_12_06_063836_create_pending_sum_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_sum`
--

CREATE TABLE `pending_sum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dsr_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inhand_sum` double NOT NULL DEFAULT 0,
  `inhand_cash` double NOT NULL DEFAULT 0,
  `inhand_cheque` double NOT NULL DEFAULT 0,
  `sales_sum` double NOT NULL DEFAULT 0,
  `credit_sum` double NOT NULL DEFAULT 0,
  `credit_collection_sum` double NOT NULL DEFAULT 0,
  `banking_sum` double NOT NULL DEFAULT 0,
  `banking_sampath` double NOT NULL DEFAULT 0,
  `banking_cargils` double NOT NULL DEFAULT 0,
  `banking_peoples` double NOT NULL DEFAULT 0,
  `banking_sampth_online` double NOT NULL DEFAULT 0,
  `direct_banking_sum` double NOT NULL DEFAULT 0,
  `direct_banking_sampath` double NOT NULL DEFAULT 0,
  `direct_banking_cargils` double NOT NULL DEFAULT 0,
  `direct_banking_peoples` double NOT NULL DEFAULT 0,
  `direct_banking_sampth_online` double NOT NULL DEFAULT 0,
  `retialer_sum` double NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pending_sum`
--

INSERT INTO `pending_sum` (`id`, `dsr_id`, `date`, `inhand_sum`, `inhand_cash`, `inhand_cheque`, `sales_sum`, `credit_sum`, `credit_collection_sum`, `banking_sum`, `banking_sampath`, `banking_cargils`, `banking_peoples`, `banking_sampth_online`, `direct_banking_sum`, `direct_banking_sampath`, `direct_banking_cargils`, `direct_banking_peoples`, `direct_banking_sampth_online`, `retialer_sum`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-12-01', 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(2, 2, '2022-12-02', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, 0, 200, 0, 100, 0, 0, 1, NULL, NULL),
(3, 3, '2022-12-03', 0, 0, 0, 0, 0, 0, 5100, 0, 5000, 0, 100, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(4, 4, '2022-12-04', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(5, 5, '2022-12-05', 230, 100, 130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(6, 1, '2022-12-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, 0, 200, 0, 100, 0, 0, 1, NULL, NULL),
(7, 2, '2022-12-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1320, 0, 500, 0, 820, 0, 0, 1, NULL, NULL),
(8, 3, '2022-12-08', 0, 0, 0, 0, 0, 0, 300, 100, 0, 200, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(9, 4, '2022-12-09', 0, 0, 0, 0, 0, 0, 1500, 500, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pending_sum_status`
--

CREATE TABLE `pending_sum_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sum_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inhand_sum` int(11) NOT NULL DEFAULT 0,
  `sales_sum` int(11) NOT NULL DEFAULT 0,
  `credit_sum` int(11) NOT NULL DEFAULT 0,
  `credit_collection_sum` int(11) NOT NULL DEFAULT 0,
  `banking_sum` int(11) NOT NULL DEFAULT 0,
  `direct_banking_sum` int(11) NOT NULL DEFAULT 0,
  `retialer_sum` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pending_sum_status`
--

INSERT INTO `pending_sum_status` (`id`, `sum_id`, `dsr_id`, `date`, `inhand_sum`, `sales_sum`, `credit_sum`, `credit_collection_sum`, `banking_sum`, `direct_banking_sum`, `retialer_sum`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-12-01', 0, 0, 1, 0, 0, 0, 0, 0, NULL, NULL),
(2, 2, 2, '2022-12-02', 0, 0, 0, 0, 0, 1, 0, 0, NULL, NULL),
(3, 3, 3, '2022-12-03', 0, 0, 0, 0, 1, 0, 0, 0, NULL, NULL),
(4, 4, 4, '2022-12-04', 0, 0, 0, 1, 0, 0, 0, 0, NULL, NULL),
(5, 5, 5, '2022-12-05', 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(6, 6, 1, '2022-12-06', 0, 0, 0, 0, 0, 1, 0, 0, NULL, NULL),
(7, 7, 2, '2022-12-07', 0, 0, 0, 0, 0, 1, 0, 0, NULL, NULL),
(8, 8, 3, '2022-12-08', 0, 0, 0, 0, 1, 0, 0, 0, NULL, NULL),
(9, 9, 4, '2022-12-09', 0, 0, 0, 0, 1, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retailer_returns`
--

CREATE TABLE `retailer_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `re_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `re_item_id` int(11) NOT NULL,
  `re_item_qty` double NOT NULL DEFAULT 0,
  `re_item_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_qty` double NOT NULL DEFAULT 0,
  `item_amount` double NOT NULL DEFAULT 0,
  `stock_balance` double NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nic` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo_path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nic`, `contact`, `route`, `password`, `profile_photo_path`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rehan peter', 'rehan@gmail.com', '256465186418', '0489411846', 'Panadura', '$2y$10$HLFr/Phfs9c2Lkq0zU.msemsG.ucJleZ4Bz96xLqB2MKjO7iIuO8q', 'upload/user_images/1656933319.jpg', 1, NULL, '2022-07-04 00:15:19', '2022-07-04 00:15:19'),
(2, 'erandaka', 'erandaka@gmail.com', '123489494986', '0756486186', 'Malabe', '$2y$10$wSy7ivlrjVSCfECerhNKZuhw0VhEYxWmOXnNjFiigcsh8ojy4AjS2', 'upload/user_images/1656933369.jpg', 0, NULL, '2022-07-04 00:16:09', '2022-07-04 00:16:09'),
(3, 'Kasun Dimantha', 'kasun@gmail.com', '516486516486', '4646848948', 'Colombo', '$2y$10$C9nBDAVX8YSOpJGW0XRGoe.J.WfQwFRjB2rcirSIMUT.4VfRxRfYG', 'upload/user_images/1656933403.jpg', 0, NULL, '2022-07-04 00:16:43', '2022-07-04 00:16:43'),
(4, 'Harsha Dilshan', 'harsha@gmail.com', '123', '546', 'route name edit', '$2y$10$3aZTsF53qj7j7oHEkoh5qulKO3b.7kUM4rImSwDB0rO1qVvWLPlD2', 'upload/user_images/1656934822.png', 0, NULL, '2022-07-04 00:17:25', '2022-07-04 00:17:25'),
(5, 'Nuwan Kulasekara', 'nuwan@gmail.com', '12489484848v', '5664646846', 'Route', '$2y$10$h1.SX.HbUKdaMczNgoJib.qlQx4M1UhnbFL3AYtczxE5AlvjXMSuq', 'upload/user_images/1657262257.jpg', 0, NULL, '2022-07-07 19:37:37', '2022-07-07 19:37:37'),
(6, 'Charith Madushan', 'charith@gmail.com', '99999999', '000000000', 'Malabe', '$2y$10$wSy7ivlrjVSCfECerhNKZuhw0VhEYxWmOXnNjFiigcsh8ojy4AjS2', 'upload/user_images/1659376599.jpg', 0, NULL, '2022-08-01 06:56:39', '2022-08-01 06:56:39'),
(7, 'Homagama', 'chamaravimukthi1995@gmail.com', '953211491V', '770644233', 'HOMAGAMA', '$2y$10$mSB7ucwT.meD4T5awnRPw.uLqhXJDgRQfNfskEv80hev/AVDFaVFe', 'upload/user_images/1663143309.jpg', 1, NULL, '2022-08-04 15:31:31', '2022-08-04 15:31:31'),
(8, 'Korathota', 'chathurangabunty86@gmail.com', '863593654V', '770527547', 'KORATHOTA', '$2y$10$JmMlkQaTR.jUEDGXLm2hQOY3n4usoOSjeWz5uIUXcSA2MM5z/m1vC', 'upload/user_images/1659666874.jpg', 1, NULL, '2022-08-04 15:34:34', '2022-08-04 15:34:34'),
(9, 'Padukka', 'dinu.n1991@gmail.com', '912031209V', '779153966', 'PADUKKA', '$2y$10$TNJeOH2mviLf.9sYJDYfEOAEqjc71LkFOYOIhritlCb9QRpM0hmBm', 'upload/user_images/1663143224.jpg', 1, NULL, '2022-08-04 15:36:42', '2022-08-04 15:36:42'),
(10, 'Godagama', 'gbuddhika890620@gmail.com', '891721196V', '779175504', 'GODAGAMA', '$2y$10$LXnU6D.ZDyPgbKc8Nm0JV.Zqvm1pk75AEgss1LkToLO.wdY90trdO', 'upload/user_images/1659667118.jpg', 1, NULL, '2022-08-04 15:38:38', '2022-08-04 15:38:38'),
(11, 'Kaduwela', 'Kavindag716@gmail.com', '961991064V', '740995611', 'KADUWELA', '$2y$10$NoliQFxncgdwU6n6ftvoWOkGYxDn/WrM4jZM5n6zHUJaP1kA0g5wW', 'upload/user_images/1659673016.jpg', 1, NULL, '2022-08-04 17:16:56', '2022-08-04 17:16:56'),
(12, 'Nawagamuwa', 'hasiruashen24@gmail.com', '199933112714', '768450813', 'NAWAGAMUWA', '$2y$10$XI1T0xHPZbPrA/lSH4cC5O06ggxvPE2WrdrkGgV5iqXXalmWTzs.e', 'upload/user_images/1659673095.jpg', 1, NULL, '2022-08-04 17:18:15', '2022-08-04 17:18:15'),
(13, 'Kiriwattuduwa', 'Indunilprasanna000@gmail.com', '960562500V', '779171687', 'KIRIWATTUDUWA', '$2y$10$6pAW4KWQbyEWhH9RY2ByBOr2FAp5bGzR9UknBU8sY0plMSZTIiM6O', 'upload/user_images/1659673188.jpg', 1, NULL, '2022-08-04 17:19:48', '2022-08-04 17:19:48'),
(14, 'Meegoda', 'Bhnaukamalindu@gmail.com', '200011301260', '770830430', 'MEEGODA', '$2y$10$04A8kbqe.2DsVFZdmnn5Uu4ulqSTqmQtSTyAKYr/RYrMAVxV4U3ue', 'upload/user_images/1659673399.jpg', 1, NULL, '2022-08-04 17:23:19', '2022-08-04 17:23:19'),
(15, 'Thummodara', 'Kanishkanishan525@gmail.com', '980732100V', '772050335', 'THUMMODARA', '$2y$10$LaTHX1oJh6htiaevratLreR8Bv7/ukRs0yrDZInHlKleAVM.WhlWe', 'upload/user_images/1659673520.jpg', 1, NULL, '2022-08-04 17:25:20', '2022-08-04 17:25:20'),
(16, 'Hanwella', 'oshandavimukthi82@gmail.com', '931713140V', '770847019', 'HANWELLA', '$2y$10$qLCmcXm1.VXJy2Vg9c9ii.TI1FERl19yxS9pNfAA0CsU1zhCPacwC', 'upload/user_images/1659673652.jpg', 1, NULL, '2022-08-04 17:27:32', '2022-08-04 17:27:32'),
(17, 'Awissawella', 'tdsruwankumara.lk@gmail.com', '740492080V', '771322694', 'AWISSAWELLA', '$2y$10$XjYr2WWuKBXCtj3Uuk5uveDywGMJ5MYpCp.2EOdDgH.yC6LxJSdom', 'upload/user_images/1659673850.jpg', 1, NULL, '2022-08-04 17:30:50', '2022-08-04 17:30:50'),
(18, 'Kosgama', 'Shanukasanjaya11@gmail.com', '903152923V', '771680913', 'KOSGAMA', '$2y$10$yF1GfNPpWKVTHhSmlJUxdeC58.NlTBJW9Lrk/RlgWoGy6QCPcmLU2', 'upload/user_images/1659674017.jpg', 1, NULL, '2022-08-04 17:33:37', '2022-08-04 17:33:37'),
(19, 'Kaluaggala', 'shashikaeranda2020@gmail.com', '891101538V', '768916293', 'KALUAGGALA', '$2y$10$WT9RAd2YCg.HTfiKTlqiDuavM07jwitj6KZKJ2aQMyc9d/vUv8LxS', 'upload/user_images/1659674165.jpg', 1, NULL, '2022-08-04 17:36:05', '2022-08-04 17:36:05'),
(20, 'Ez Cash', 'adishantha89@gmail.com', '890631320V', '775764926', 'EZ CASH', '$2y$10$zX5mQeO18dkr.gU0mfEG8OSQsPg0JsnR8TLPwvzf/b4Aui/Ce8CxG', 'upload/user_images/1659674242.jpg', 1, NULL, '2022-08-04 17:37:22', '2022-08-04 17:37:22'),
(21, 'ONLINE DSR', 'jayawardenanetwork2@gmail.com', 'network', '768906944', 'ALL TERITORY', '$2y$10$msxD9.3BF6u1DLe0qf3WbuM4sDu1pZXQc2X2.OLyKSRYDLNzJGssy', 'upload/user_images/1659674346.jpg', 1, NULL, '2022-08-04 17:39:06', '2022-08-04 17:39:06'),
(22, 'Tharaka', 'tharaka@gmail.com', '903620579V', '0763593506', 'Anuradhapura', '$2y$10$ggOUa.uPcmFeTdvgTwgWdeinTTHbPv56CisBWRSTtvCS.yh4eLUqO', 'upload/user_images/1664504969.jpg', 1, NULL, '2022-08-23 15:28:59', '2022-08-23 15:28:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional`
--
ALTER TABLE `additional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addtional_bank`
--
ALTER TABLE `addtional_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addtional_credit`
--
ALTER TABLE `addtional_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addtional_credit_collection`
--
ALTER TABLE `addtional_credit_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addtional_directbank`
--
ALTER TABLE `addtional_directbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankings`
--
ALTER TABLE `bankings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_collections`
--
ALTER TABLE `credit_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_collection_items`
--
ALTER TABLE `credit_collection_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_items`
--
ALTER TABLE `credit_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directbankings`
--
ALTER TABLE `directbankings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drs_cheques`
--
ALTER TABLE `drs_cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dsrs`
--
ALTER TABLE `dsrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dsr_retun_no`
--
ALTER TABLE `dsr_retun_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dsr_stocks`
--
ALTER TABLE `dsr_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dsr_stock_items`
--
ALTER TABLE `dsr_stock_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pending_sum`
--
ALTER TABLE `pending_sum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_sum_status`
--
ALTER TABLE `pending_sum_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `retailer_returns`
--
ALTER TABLE `retailer_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional`
--
ALTER TABLE `additional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `addtional_bank`
--
ALTER TABLE `addtional_bank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addtional_credit`
--
ALTER TABLE `addtional_credit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addtional_credit_collection`
--
ALTER TABLE `addtional_credit_collection`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addtional_directbank`
--
ALTER TABLE `addtional_directbank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bankings`
--
ALTER TABLE `bankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_collections`
--
ALTER TABLE `credit_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credit_collection_items`
--
ALTER TABLE `credit_collection_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credit_items`
--
ALTER TABLE `credit_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `directbankings`
--
ALTER TABLE `directbankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drs_cheques`
--
ALTER TABLE `drs_cheques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dsrs`
--
ALTER TABLE `dsrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dsr_retun_no`
--
ALTER TABLE `dsr_retun_no`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dsr_stocks`
--
ALTER TABLE `dsr_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dsr_stock_items`
--
ALTER TABLE `dsr_stock_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_sum`
--
ALTER TABLE `pending_sum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pending_sum_status`
--
ALTER TABLE `pending_sum_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retailer_returns`
--
ALTER TABLE `retailer_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
