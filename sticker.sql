-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 09:33 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sticker`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_calls`
--

CREATE TABLE `api_calls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(11) NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_calls`
--

INSERT INTO `api_calls` (`id`, `app_id`, `device_id`, `app_token`, `package_name`, `app_version`, `version_code`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'TEST4', 'DCxuwBuRoGDTtC2', 'XYZ', '1.1', '123', '127.0.0.1', '2023-02-16 06:40:42', NULL),
(2, 2, 'TEST4', 'rbNRGMamdftAUGa', 'XYZ', '1.1', '123', '127.0.0.1', '2023-02-18 08:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_by_sticker_category`
--

CREATE TABLE `app_by_sticker_category` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted, 0 = Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_by_sticker_category`
--

INSERT INTO `app_by_sticker_category` (`id`, `app_id`, `category_id`, `name`, `image`, `created_at`, `updated_at`, `is_del`) VALUES
(1, 2, 1, 'ABCD', '0ea496c43c90f459b1d89ce793d14060.jpg', '2023-02-16 12:56:38', NULL, 0),
(2, 2, 1, 'XYZ', '60ae843c49506842df5b591e6ba0df06.jpg', '2023-02-18 13:55:45', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_by_text_category`
--

CREATE TABLE `app_by_text_category` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = Deleted, 0 = Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_by_text_category`
--

INSERT INTO `app_by_text_category` (`id`, `app_id`, `category_id`, `name`, `image`, `created_at`, `updated_at`, `is_del`) VALUES
(3, 1, 3, 'XYZ', 'c4c114c982b199442f35a40affbc22d3.jpg', '2023-02-18 14:02:18', NULL, 0);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_del` tinytext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `package_name`, `account_name`, `request_token`, `app_version`, `created_at`, `updated_at`, `is_del`) VALUES
(1, 'vvf', 'vfvf', 'vfv', 'MNhKK0nuG4ZlXxf', 'vfv', '2023-02-07 19:37:04', NULL, '0'),
(2, 'abcd', 'abcd', 'abcd', 'BUzvxsvZXZPNG8c', 'v1', '2023-02-09 17:34:49', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `status_sticker`
--

CREATE TABLE `status_sticker` (
  `id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `images` longtext NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0 COMMENT 'true =1,false =0',
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `created_by` tinyint(1) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_sticker`
--

INSERT INTO `status_sticker` (`id`, `catId`, `images`, `is_new`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, 1, '786025e021fbd3c5cb6f38ad177b6eee.webp', 0, '2023-02-16 07:24:34.274845', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_sticker_category`
--

CREATE TABLE `status_sticker_category` (
  `catId` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `catName` varchar(255) NOT NULL,
  `slug_name` text NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `created_by` tinyint(1) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_sticker_category`
--

INSERT INTO `status_sticker_category` (`catId`, `image`, `catName`, `slug_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, '209d8c70654701d281dc43e732ef8996.jpg', 'Shivratri', 'shivratri', '2023-02-16 12:46:56.964007', NULL, NULL, NULL, 0),
(2, 'be7cd980a8f1fb8700670fe15687d051.jpg', 'Holi', 'holi', '2023-02-16 12:47:39.165035', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_text`
--

CREATE TABLE `status_text` (
  `id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0 COMMENT 'true =1,false =0',
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `created_by` tinyint(1) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_text`
--

INSERT INTO `status_text` (`id`, `catId`, `text`, `is_new`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(2, 3, 'dv', 0, '2023-02-18 06:41:28.063640', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_text_category`
--

CREATE TABLE `status_text_category` (
  `catId` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `catName` varchar(255) NOT NULL,
  `slug_name` text NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `created_by` tinyint(1) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `updated_by` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_text_category`
--

INSERT INTO `status_text_category` (`catId`, `image`, `catName`, `slug_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(3, 'd903abb83dbf2cba96111b24e5b098c0.jpg', 'Shivratri', 'shivratri', '2023-02-18 11:46:44.686947', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '2023-01-20 12:30:07', '$2y$10$vFajGFE2OSJNIiMRmlBtxOoCMo8BCX9GjsMlnUxjszgG4fNT7jlma', NULL, '2023-01-20 12:30:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_calls`
--
ALTER TABLE `api_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_by_sticker_category`
--
ALTER TABLE `app_by_sticker_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_by_text_category`
--
ALTER TABLE `app_by_text_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_sticker`
--
ALTER TABLE `status_sticker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_sticker_category`
--
ALTER TABLE `status_sticker_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `status_text`
--
ALTER TABLE `status_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_text_category`
--
ALTER TABLE `status_text_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_calls`
--
ALTER TABLE `api_calls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_by_sticker_category`
--
ALTER TABLE `app_by_sticker_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_by_text_category`
--
ALTER TABLE `app_by_text_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_sticker`
--
ALTER TABLE `status_sticker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_sticker_category`
--
ALTER TABLE `status_sticker_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_text`
--
ALTER TABLE `status_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_text_category`
--
ALTER TABLE `status_text_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
