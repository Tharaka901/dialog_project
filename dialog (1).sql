-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 04:06 AM
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
(1, 1, '1234', 5000, 1, 1, 1, '2022-12-02 10:07:00', '2022-12-02 10:07:00'),
(2, 2, '741', 100, 1, 1, 1, '2022-12-02 10:07:00', '2022-12-02 10:07:00');

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
(1, 'Cargills Bank', 1, '2022-11-22 12:40:53', '2022-11-22 12:40:53'),
(2, 'People\'s Bank', 1, '2022-11-22 12:41:04', '2022-11-22 12:41:04'),
(3, 'Sampath Bank', 1, '2022-11-22 12:41:54', '2022-11-22 12:41:54'),
(4, 'Sampath Bank - Online', 1, '2022-11-22 12:42:07', '2022-11-22 12:42:07');

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
(1, 'rehan', 120, 1, 1, 1, '2022-12-01 20:24:31', '2022-12-02 08:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `credit_collections`
--

CREATE TABLE `credit_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_collection_customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_collection_amount` double NOT NULL DEFAULT 0,
  `sum_id` int(11) NOT NULL,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 1, 20, 1, '2022-12-02 08:24:31', '2022-12-02 08:24:31'),
(2, 1, 2, 40, 1, '2022-12-02 08:24:31', '2022-12-02 08:24:31'),
(3, 1, 1, 20, 1, '2022-12-02 08:29:14', '2022-12-02 08:29:14'),
(4, 1, 1, 20, 1, '2022-12-02 08:30:30', '2022-12-02 08:30:30'),
(5, 1, 2, 40, 1, '2022-12-02 08:30:30', '2022-12-02 08:30:30');

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
(1, 'abc', 1, '1234', 5000, 1, 1, 1, '2022-12-02 10:02:32', '2022-12-02 10:02:32'),
(2, 'xyz', 2, '741', 100, 1, 1, 1, '2022-12-02 10:02:32', '2022-12-02 10:02:32');

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
(128, '2022_11_29_052931_create_addtional_bank_table', 1),
(134, '2014_10_12_000000_create_users_table', 2),
(135, '2014_10_12_100000_create_password_resets_table', 2),
(136, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(137, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(138, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(139, '2016_06_01_000004_create_oauth_clients_table', 2),
(140, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(141, '2019_08_19_000000_create_failed_jobs_table', 2),
(142, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(143, '2022_07_03_071847_create_admins_table', 2),
(144, '2022_07_04_120017_create_items_table', 2),
(145, '2022_07_05_094403_create_directbankings_table', 2),
(146, '2022_07_16_070115_create_stocks_table', 2),
(147, '2022_07_18_075251_create_dsr_stocks_table', 2),
(148, '2022_07_20_064804_create_retailer_returns_table', 2),
(149, '2022_07_25_054513_create_dsr_retun_no_table', 2),
(150, '2022_09_02_113035_create_sales_table', 2),
(151, '2022_11_18_132538_create_banks_table', 2),
(152, '2022_11_23_095038_create_drs_cheques_table', 2),
(153, '2022_11_23_095843_create_credit_items_table', 2),
(154, '2022_11_23_102652_create_credit_collection_items_table', 2),
(155, '2022_11_29_041208_create_pending_sum_table', 2),
(156, '2022_11_29_041958_create_pending_sum_status_table', 2),
(157, '2022_11_29_043105_create_dsrs_table', 2),
(158, '2022_11_29_051347_create_credit_collections_table', 2),
(159, '2022_11_29_052051_create_credits_table', 2),
(160, '2022_11_29_052200_create_dsr_stock_items_table', 2),
(161, '2022_11_29_052712_create_additional_table', 2),
(162, '2022_11_29_053033_create_addtional_directbank_table', 2),
(163, '2022_11_29_053156_create_addtional_credit_table', 2),
(164, '2022_11_29_053238_create_addtional_credit_collection_table', 2),
(165, '2022_11_29_060247_create_bankings_table', 2),
(166, '2022_11_29_073839_create_addtional_bank_table', 2);

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
  `direct_banking_sum` double NOT NULL DEFAULT 0,
  `direct_banking_sampath` double NOT NULL DEFAULT 0,
  `direct_banking_cargils` double NOT NULL DEFAULT 0,
  `direct_banking_peoples` double NOT NULL DEFAULT 0,
  `retialer_sum` double NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pending_sum`
--

INSERT INTO `pending_sum` (`id`, `dsr_id`, `date`, `inhand_sum`, `inhand_cash`, `inhand_cheque`, `sales_sum`, `credit_sum`, `credit_collection_sum`, `banking_sum`, `banking_sampath`, `banking_cargils`, `banking_peoples`, `direct_banking_sum`, `direct_banking_sampath`, `direct_banking_cargils`, `direct_banking_peoples`, `retialer_sum`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-12_02', 0, 0, 0, 0, 0, 0, 5100, 0, 5000, 100, 5100, 0, 5000, 100, 0, 0, 0, NULL, NULL);

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
(1, 1, 1, '2022-12_02', 0, 0, 0, 0, 1, 1, 0, 0, NULL, NULL);

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
(1, 'rehan peter', 'rehan@gmail.com', '256465186418', '0489411846', 'Panadura', '$2y$10$HLFr/Phfs9c2Lkq0zU.msemsG.ucJleZ4Bz96xLqB2MKjO7iIuO8q', 'upload/user_images/1656933319.jpg', 1, NULL, '2022-07-03 18:45:19', '2022-07-03 18:45:19'),
(2, 'Tharaka', 'tharaka@gmail.com', '903620579V', '0763593506', 'Anuradhapura', '$2y$10$ggOUa.uPcmFeTdvgTwgWdeinTTHbPv56CisBWRSTtvCS.yh4eLUqO', 'upload/user_images/1664504969.jpg', 1, NULL, '2022-08-23 09:58:59', '2022-08-23 09:58:59');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bankings`
--
ALTER TABLE `bankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_collections`
--
ALTER TABLE `credit_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_collection_items`
--
ALTER TABLE `credit_collection_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_items`
--
ALTER TABLE `credit_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `directbankings`
--
ALTER TABLE `directbankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drs_cheques`
--
ALTER TABLE `drs_cheques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dsrs`
--
ALTER TABLE `dsrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pending_sum_status`
--
ALTER TABLE `pending_sum_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
