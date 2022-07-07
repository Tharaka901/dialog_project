-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 05:56 AM
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
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'approve_status = 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dsrs`
--

INSERT INTO `dsrs` (`id`, `in_hand`, `cash`, `cheque`, `dsr_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 4, 1, 2, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

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
(1, 'Internet Card 49', 45, 49, 1000, 1, '2022-07-04 07:08:20', '2022-07-04 07:08:20'),
(2, 'Internet Card 99', 90, 100, 1000, 1, '2022-07-04 07:13:04', '2022-07-04 07:13:04'),
(3, 'Internet Card 199', 180, 199, 500, 1, '2022-07-04 07:26:10', '2022-07-04 07:26:10'),
(4, 'Internet Card 249', 230, 250, 500, 1, '2022-07-04 07:26:53', '2022-07-04 07:26:53'),
(5, 'Dialog Tv', 4500, 5000, 150, 1, '2022-07-04 07:27:24', '2022-07-04 07:27:24'),
(6, 'Dialog Broadband EDIT', 800, 990, 650, 1, '2022-07-04 07:28:06', '2022-07-04 07:28:06');

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
(39, '2022_07_05_095611_create_dsrs_table', 1);

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
  `re_item_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `re_item_qty` double NOT NULL DEFAULT 0,
  `re_item_amount` double NOT NULL DEFAULT 0,
  `dsr_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retailer_returns`
--

INSERT INTO `retailer_returns` (`id`, `re_customer_name`, `re_item_name`, `re_item_qty`, `re_item_amount`, `dsr_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Viduranga', 'DIALOG', 7, 8, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

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
(1, 'KIT', 1, 10, 1, 1, '2022-07-05 21:43:23', '2022-07-05 21:43:23');

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
(1, 'rehan peter', 'rehan@gmail.com', '256465186418', '0489411846', 'Panadura', '$2y$10$WhA9uQF599EF9Fi.wx93TuMsMutlQKtpJTRiDUZArDt/sKUsEqOm.', 'upload/user_images/1656933319.jpg', 1, NULL, '2022-07-04 05:45:19', '2022-07-04 05:45:19'),
(2, 'erandaka', 'erandaka@gmail.com', '123489494986', '0756486186', 'Malabe', '$2y$10$wSy7ivlrjVSCfECerhNKZuhw0VhEYxWmOXnNjFiigcsh8ojy4AjS2', 'upload/user_images/1656933369.jpg', 1, NULL, '2022-07-04 05:46:09', '2022-07-04 05:46:09'),
(3, 'Kasun Dimantha', 'kasun@gmail.com', '516486516486', '4646848948', 'Colombo', '$2y$10$GIOFmb0xaPO1nJQZA0IkvO1ATJ46D/..AKOUzCSBFFF.WIu.2K09G', 'upload/user_images/1656933403.jpg', 1, NULL, '2022-07-04 05:46:43', '2022-07-04 05:46:43'),
(4, 'Harsha Dilshan edit', 'harsha@gmail.com', '123', '546', 'route name edit', '$2y$10$3aZTsF53qj7j7oHEkoh5qulKO3b.7kUM4rImSwDB0rO1qVvWLPlD2', 'upload/user_images/1656934822.png', 1, NULL, '2022-07-04 05:47:25', '2022-07-04 05:47:25');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credit_collections`
--
ALTER TABLE `credit_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `directbankings`
--
ALTER TABLE `directbankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dsrs`
--
ALTER TABLE `dsrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retailer_returns`
--
ALTER TABLE `retailer_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
