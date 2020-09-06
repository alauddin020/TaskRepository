-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2020 at 03:08 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_04_161851_create_user_infos_table', 1),
(7, '2020_09_05_103731_create_user_likes_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Alauddin F-a', 'alauddin020@gmail.com', NULL, '$2y$10$FdIsVxWzyZ4O1UAb47qtnexmZeL33DCE8cHyZK2Bmcvrf3lXnvtay', 'KefUCoQbwQAAfXZBNqy3DMAiwih4pMULuFxtmjGAOSbs7oENl47D1EgFjXl5', '2020-09-05 00:26:39', '2020-09-05 00:26:39'),
(4, 'News and Events', 'superadmin@gmail.com', NULL, '$2y$10$X6Dzu8kisJn6ofYDOLBdN.Dn.Dv1xmovBIXzZgBAlykZ2qQkRC036', NULL, '2020-09-06 01:17:04', '2020-09-06 01:17:04'),
(5, 'Testing', 'testing@gmail.com', NULL, '$2y$10$loZlSDQ9lOG63ki66DBZZ.rIiAc9Xlx/MMoM1XaHCBz54DWShCg.2', NULL, '2020-09-06 02:31:28', '2020-09-06 02:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `birthday` date NOT NULL,
  `gender` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `avatar`, `lat`, `lng`, `birthday`, `gender`, `created_at`, `updated_at`) VALUES
(1, 3, '3.png', 23.7671982, 90.3611304, '2010-09-01', 1, '2020-09-05 00:26:39', '2020-09-05 23:41:34'),
(2, 4, 'default.jpg', 23.7701, 90.3628, '2000-09-05', 2, '2020-09-06 01:17:04', '2020-09-06 01:17:04'),
(3, 5, 'default.jpg', 23.7701, 90.3628, '2003-09-09', 2, '2020-09-06 02:31:28', '2020-09-06 02:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE `user_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'user who liked this',
  `liked_user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'user whom this liked',
  `send_user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'send_user',
  `is_mutual` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is users like each other',
  `unlike` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'unlike',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_likes`
--

INSERT INTO `user_likes` (`id`, `user_id`, `liked_user_id`, `send_user_id`, `is_mutual`, `unlike`, `created_at`, `updated_at`) VALUES
(7, 3, 4, 3, 1, 0, '2020-09-06 06:48:18', '2020-09-06 06:55:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_likes_user_id_foreign` (`user_id`),
  ADD KEY `user_likes_liked_user_id_foreign` (`liked_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `user_likes_liked_user_id_foreign` FOREIGN KEY (`liked_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
