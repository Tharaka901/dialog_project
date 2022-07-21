-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 05:18 AM
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
(1, 'Admin', 'admin@gmail.com', '$2y$10$WhA9uQF599EF9Fi.wx93TuMsMutlQKtpJTRiDUZArDt/sKUsEqOm.', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bankings`
--

CREATE TABLE `bankings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bankings`
--

INSERT INTO `bankings` (`id`, `bank_name`, `bank_ref_no`, `bank_amount`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sampath', '123456789', 9, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `credit_customer_name`, `credit_amount`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chathuranga', 5, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `credit_collections`
--

CREATE TABLE `credit_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_collection_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_collection_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_collections`
--

INSERT INTO `credit_collections` (`id`, `credit_collection_customer_name`, `credit_collection_amount`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chathuranga', 6, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `directbankings`
--

CREATE TABLE `directbankings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_bank_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_bank_ref_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direct_bank_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directbankings`
--

INSERT INTO `directbankings` (`id`, `direct_bank_customer_name`, `direct_bank_name`, `direct_bank_ref_no`, `direct_bank_amount`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Viduranga', 'Commercial', '987654321', 10, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `dsrs`
--

CREATE TABLE `dsrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `in_hand` double NOT NULL DEFAULT 0,
  `cash` double NOT NULL DEFAULT 0,
  `cheque` double NOT NULL DEFAULT 0,
  `dsr_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dsrs`
--

INSERT INTO `dsrs` (`id`, `in_hand`, `cash`, `cheque`, `dsr_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 3, 4, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `dsr_returns`
--

CREATE TABLE `dsr_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dsr_stock_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
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

--
-- Dumping data for table `dsr_stocks`
--

INSERT INTO `dsr_stocks` (`id`, `stock_id`, `dsr_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1542, 1, '2022-07-19 05:51:18', '2022-07-19 05:51:18'),
(2, 1, 2, 1148, 1, '2022-07-19 05:55:40', '2022-07-19 05:55:40'),
(3, 1, 2, 25700, 1, '2022-07-19 05:56:21', '2022-07-19 05:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `dsr_stock_items`
--

CREATE TABLE `dsr_stock_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dsr_stock_id` double NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dsr_stock_items`
--

INSERT INTO `dsr_stock_items` (`id`, `dsr_stock_id`, `item_id`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1, '2022-07-19 05:51:18', '2022-07-19 05:51:18'),
(2, 1, 2, 4, 1, '2022-07-19 05:51:18', '2022-07-19 05:51:18'),
(3, 1, 3, 5, 1, '2022-07-19 05:51:18', '2022-07-19 05:51:18'),
(4, 2, 3, 2, 1, '2022-07-19 05:55:40', '2022-07-19 05:55:40'),
(5, 2, 4, 0.5, 1, '2022-07-19 05:55:40', '2022-07-19 05:55:40'),
(6, 3, 6, 5, 1, '2022-07-19 05:56:21', '2022-07-19 05:56:21'),
(7, 3, 5, 4, 1, '2022-07-19 05:56:21', '2022-07-19 05:56:21'),
(8, 3, 4, 0.5, 1, '2022-07-19 05:56:21', '2022-07-19 05:56:21');

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
(1, 'Internet Card 49', 45, 49, 942, 1, '2022-07-04 07:08:20', '2022-07-04 07:08:20'),
(2, 'Internet Card 99', 90, 100, 931, 1, '2022-07-04 07:13:04', '2022-07-04 07:13:04'),
(3, 'Internet Card 199', 180, 199, 543, 1, '2022-07-04 07:26:10', '2022-07-04 07:26:10'),
(4, 'Internet Card 249', 230, 250, 394, 1, '2022-07-04 07:26:53', '2022-07-04 07:26:53'),
(5, 'Dialog Tv', 4500, 5000, 123, 1, '2022-07-04 07:27:24', '2022-07-04 07:27:24'),
(6, 'Dialog Broadband EDIT', 800, 990, 525, 1, '2022-07-04 07:28:06', '2022-07-04 07:28:06');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_03_071847_create_admins_table', 1),
(6, '2022_07_04_120017_create_items_table', 1),
(7, '2022_07_05_093949_create_sales_table', 1),
(8, '2022_07_05_094024_create_credits_table', 1),
(9, '2022_07_05_094219_create_credit_collections_table', 1),
(10, '2022_07_05_094307_create_retailer_returns_table', 1),
(11, '2022_07_05_094337_create_bankings_table', 1),
(12, '2022_07_05_094403_create_directbankings_table', 1),
(13, '2022_07_05_095611_create_dsrs_table', 1),
(27, '2014_10_12_000000_create_users_table', 1),
(28, '2014_10_12_100000_create_password_resets_table', 1),
(29, '2019_08_19_000000_create_failed_jobs_table', 1),
(30, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(31, '2022_07_03_071847_create_admins_table', 1),
(32, '2022_07_04_120017_create_items_table', 1),
(33, '2022_07_05_093949_create_sales_table', 1),
(34, '2022_07_05_094024_create_credits_table', 1),
(35, '2022_07_05_094219_create_credit_collections_table', 1),
(36, '2022_07_05_094307_create_retailer_returns_table', 1),
(37, '2022_07_05_094337_create_bankings_table', 1),
(38, '2022_07_05_094403_create_directbankings_table', 1),
(39, '2022_07_05_095611_create_dsrs_table', 1),
(40, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(41, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(42, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(43, '2016_06_01_000004_create_oauth_clients_table', 2),
(44, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(45, '2022_07_08_080439_create_stocks_table', 3),
(46, '2022_07_08_102458_stock_has_dsr', 4),
(47, '2022_07_08_102458_stock_dsr_items', 5),
(69, '2014_10_12_000000_create_users_table', 1),
(70, '2014_10_12_100000_create_password_resets_table', 1),
(71, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(72, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(73, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(74, '2016_06_01_000004_create_oauth_clients_table', 1),
(75, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(76, '2019_08_19_000000_create_failed_jobs_table', 1),
(77, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(78, '2022_07_03_071847_create_admins_table', 1),
(79, '2022_07_04_120017_create_items_table', 1),
(80, '2022_07_05_093949_create_sales_table', 1),
(81, '2022_07_05_094024_create_credits_table', 1),
(82, '2022_07_05_094219_create_credit_collections_table', 1),
(83, '2022_07_05_094307_create_retailer_returns_table', 1),
(84, '2022_07_05_094337_create_bankings_table', 1),
(85, '2022_07_05_094403_create_directbankings_table', 1),
(86, '2022_07_05_095611_create_dsrs_table', 1),
(87, '2022_07_08_080439_create_stocks_table', 1),
(88, '2022_07_08_102458_stock_dsr_items', 1),
(89, '2022_07_08_102458_stock_has_dsr', 1),
(90, '2022_07_16_070115_create_stocks_table', 6),
(91, '2022_07_16_070851_create_dsr_stocks_table', 7),
(92, '2022_07_16_071653_create_dsr_stock_items_table', 7),
(93, '2022_07_17_074459_create_dsr_returns_table', 8),
(94, '2022_07_18_075251_create_dsr_stocks_table', 9),
(95, '2022_07_20_064804_create_retailer_returns_table', 10),
(96, '2022_07_20_122723_create_dsr_returns_table', 11);

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

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'uvBrGzSgErXnSA9IOtAtMZ3rQ1TZjlRM4H1pXp55', NULL, 'http://localhost', 1, 0, 0, '2022-07-06 23:52:44', '2022-07-06 23:52:44'),
(2, NULL, 'Laravel Password Grant Client', 'WuKDCgbhPvR7VwZ6AjjVUnSKICANRArqJ34Ja0xi', 'users', 'http://localhost', 0, 1, 0, '2022-07-06 23:52:44', '2022-07-06 23:52:44'),
(3, NULL, 'Laravel Personal Access Client', '19AbJtmoqwpR58wjq1SYjXGQhe8mySMvVOhzUMan', NULL, 'http://localhost', 1, 0, 0, '2022-07-06 23:52:53', '2022-07-06 23:52:53'),
(4, NULL, 'Laravel Password Grant Client', '04xaew5VpdJ2FExD7dR8SKgwOXhQszh1rX2nsCiP', 'users', 'http://localhost', 0, 1, 0, '2022-07-06 23:52:53', '2022-07-06 23:52:53');

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

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-07-06 23:52:44', '2022-07-06 23:52:44'),
(2, 3, '2022-07-06 23:52:53', '2022-07-06 23:52:53');

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
  `item_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_qty` double NOT NULL DEFAULT 0,
  `item_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `item_name`, `item_qty`, `item_amount`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KIT', 1, 10, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23'),
(2, 'Dialog 49', 20, 50, 1, 1, '2022-07-20 02:33:36', '2022-07-20 02:33:36'),
(3, 'Dialog 199', 10, 200, 1, 1, '2022-07-20 02:33:36', '2022-07-20 02:33:36');

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

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `stock_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Main Stock', 1, NULL, NULL);

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
(1, 'rehan peter', 'rehan@gmail.com', '256465186418', '0489411846', 'Panadura', '$2y$10$h4VP3PW92cZ32CJJdtn/x.jUisKLNztlyarTv0QjOp1cLhXSm3grm', 'upload/user_images/1656933319.jpg', 1, NULL, '2022-07-04 05:45:19', '2022-07-04 05:45:19'),
(2, 'erandaka', 'erandaka@gmail.com', '123489494986', '0756486186', 'Malabe', '$2y$10$wSy7ivlrjVSCfECerhNKZuhw0VhEYxWmOXnNjFiigcsh8ojy4AjS2', 'upload/user_images/1656933369.jpg', 1, NULL, '2022-07-04 05:46:09', '2022-07-04 05:46:09'),
(3, 'Kasun Dimantha', 'kasun@gmail.com', '516486516486', '4646848948', 'Colombo', '$2y$10$GIOFmb0xaPO1nJQZA0IkvO1ATJ46D/..AKOUzCSBFFF.WIu.2K09G', 'upload/user_images/1656933403.jpg', 1, NULL, '2022-07-04 05:46:43', '2022-07-04 05:46:43'),
(4, 'Harsha Dilshan edit', 'harsha@gmail.com', '123', '546', 'route name edit', '$2y$10$3aZTsF53qj7j7oHEkoh5qulKO3b.7kUM4rImSwDB0rO1qVvWLPlD2', 'upload/user_images/1656934822.png', 1, NULL, '2022-07-04 05:47:25', '2022-07-04 05:47:25'),
(5, 'Nuwan Kulasekara', 'nuwan@gmail.com', '12489484848v', '5664646846', 'Route', '$2y$10$h1.SX.HbUKdaMczNgoJib.qlQx4M1UhnbFL3AYtczxE5AlvjXMSuq', 'upload/user_images/1657262257.jpg', 1, NULL, '2022-07-08 01:07:37', '2022-07-08 01:07:37');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `directbankings`
--
ALTER TABLE `directbankings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dsrs`
--
ALTER TABLE `dsrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dsr_returns`
--
ALTER TABLE `dsr_returns`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bankings`
--
ALTER TABLE `bankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_collections`
--
ALTER TABLE `credit_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `directbankings`
--
ALTER TABLE `directbankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dsrs`
--
ALTER TABLE `dsrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dsr_returns`
--
ALTER TABLE `dsr_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dsr_stocks`
--
ALTER TABLE `dsr_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dsr_stock_items`
--
ALTER TABLE `dsr_stock_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
