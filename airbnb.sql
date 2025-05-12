-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airbnb`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lister_id` int(20) DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `price` int(20) DEFAULT NULL,
  `commission_amount` mediumtext DEFAULT NULL,
  `payable_amount` mediumtext DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `stay_status` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_0b5ed025495008a307f6b06dd1e4cce2', 'i:1;', 1747016098),
('laravel_cache_0b5ed025495008a307f6b06dd1e4cce2:timer', 'i:1747016098;', 1747016098),
('laravel_cache_f224888b960a550512b78d213822b430', 'i:1;', 1747014828),
('laravel_cache_f224888b960a550512b78d213822b430:timer', 'i:1747014828;', 1747014828);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completes`
--

CREATE TABLE `completes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `lister_id` varchar(255) DEFAULT NULL,
  `property_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `commission_amount` mediumtext DEFAULT NULL,
  `payable_amount` mediumtext DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `completes`
--

INSERT INTO `completes` (`id`, `user_id`, `lister_id`, `property_id`, `name`, `phone`, `email`, `start_date`, `end_date`, `price`, `commission_amount`, `payable_amount`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(75, '1', '1', '64', 'Macc', '92832131321', 'lister@gmail.com', '2025-05-12', '2025-05-16', '14024', '1682.88', '12341.12', 'paid', 'completed', '2025-05-11 08:33:17', '2025-05-11 08:33:17'),
(76, '4', '1', '56', 'Althea', '92832131321', 'user@gmail.com', '2025-05-12', '2025-05-14', '1000', '120.00', '880.00', 'paid', 'completed', '2025-05-11 17:53:30', '2025-05-11 17:53:30'),
(77, '1', '1', '56', 'Macc', '92832131321', 'lister@gmail.com', '2025-05-12', '2025-05-13', '500', '60.00', '440.00', 'unpaid', 'completed', '2025-05-11 17:57:41', '2025-05-11 17:57:41'),
(78, '1', '1', '56', 'Macc', '92832131321', 'lister@gmail.com', '2025-05-12', '2025-05-13', '500', '60.00', '440.00', 'paid', 'completed', '2025-05-11 18:03:13', '2025-05-11 18:03:13'),
(79, '1', '1', '55', 'Macc', '92832131321', 'lister@gmail.com', '2025-05-12', '2025-05-14', '5200', '624.00', '4576.00', 'paid', 'completed', '2025-05-11 18:05:32', '2025-05-11 18:05:32'),
(80, '1', '1', '64', 'Macc', '92832131321', 'lister@gmail.com', '2025-05-12', '2025-05-14', '7012', '841.44', '6170.56', 'paid', 'completed', '2025-05-11 18:11:22', '2025-05-11 18:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `property_type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rooms` mediumtext DEFAULT NULL,
  `guest_max` varchar(255) DEFAULT NULL,
  `bathroom_count` varchar(255) DEFAULT NULL,
  `additionals` longtext DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `map_link` varchar(1400) DEFAULT NULL,
  `room_total_price` varchar(1400) DEFAULT NULL,
  `commission_amount` mediumtext DEFAULT NULL,
  `payable_amount` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `user_id`, `property_type`, `title`, `address`, `image`, `rooms`, `guest_max`, `bathroom_count`, `additionals`, `description`, `map_link`, `room_total_price`, `commission_amount`, `payable_amount`, `created_at`, `updated_at`) VALUES
(55, '1', 'Pool Villas', 'Villa', 'Found at Unit 204, Sunshine Tower, 678 Rizal Avenue, Barangay Santa Lucia, Zambales', '1746893984_main.jpg', '[{\"type\":\"Double Bedroom\",\"quantity\":\"2\",\"price\":\"500\",\"image\":\"1746893984_room_3.jpg\"},{\"type\":\"Single Bedroom\",\"quantity\":\"4\",\"price\":\"400\",\"image\":\"1746896084_room_1001.jpg\"}]', '10', '5', '[{\"type\":\"Amenity\",\"item\":\"TV\",\"price\":\"0\",\"image\":null},{\"type\":\"Amenity\",\"item\":\"Pool\",\"price\":\"0\",\"image\":null},{\"type\":\"Amenity\",\"item\":\"Karaoke\",\"price\":\"0\",\"image\":null},{\"type\":\"Service\",\"item\":\"Kayak\",\"price\":\"2000\",\"image\":\"1746893984_add_5.jpg\"},{\"type\":\"Service\",\"item\":\"ATV\",\"price\":\"2000\",\"image\":\"1746893984_add_6.jpg\"}]', 'To make your stay even more special, this villa offers a range of additional perks at no extra cost. Guests can enjoy a relaxing swim in the private pool, complete with a sun lounge and shaded patio. Daily breakfast is served for two, and a complimentary welcome drink awaits upon arrival. For outdoor fun, the villa includes access to barbecue facilities, kayaks, and paddle boards. Fast Wi-Fi, secure private parking, and daily housekeeping are also included, ensuring a comfortable and convenient experience throughout your stay. Plus, guests can avail of exclusive discounts on local tours and extended bookings.', NULL, '2600.00', '312.00', '2288.00', '2025-05-10 08:19:44', '2025-05-11 07:47:27'),
(56, '1', 'Motel', 'SOGO', 'Found at Unit 204, Sunshine Tower, 678 Rizal Avenue, Barangay Santa Lucia, Zambales', '1746898464_main.jpg', '[{\"type\":\"Double Bedroom\",\"quantity\":\"1\",\"price\":\"500\",\"image\":\"1746898464_room_1.jpg\"}]', '2', '1', '[{\"type\":\"Amenity\",\"item\":\"TV 50 Inches\",\"price\":\"0\",\"image\":null}]', 'To make your stay even more special, this villa offers a range of additional perks at no extra cost. Guests can enjoy a relaxing swim in the private pool, complete with a sun lounge and shaded patio. Daily breakfast is served for two, and a complimentary welcome drink awaits upon arrival. For outdoor fun, the villa includes access to barbecue facilities, kayaks, and paddle boards. Fast Wi-Fi, secure private parking, and daily housekeeping are also included, ensuring a comfortable and convenient experience throughout your stay. Plus, guests can avail of exclusive discounts on local tours and extended bookings.', NULL, '500.00', '60.00', '440.00', '2025-05-10 09:34:24', '2025-05-11 07:47:02'),
(64, '1', 'Private Villas', 'Scapadia', 'Found at Unit 204, Sunshine Tower, 678 Rizal Avenue, Barangay Santa Lucia, Zambales', '1746978731_main.jpg', '[{\"type\":\"Single Bedroom\",\"quantity\":\"2\",\"price\":\"529\",\"image\":\"1746978731_room_1.jpg\"},{\"type\":\"Double Bedroom\",\"quantity\":\"2\",\"price\":\"1224\",\"image\":\"1746978731_room_2.jpg\"}]', '2', '3', '[]', 'To make your stay even more special, this villa offers a range of additional perks at no extra cost. Guests can enjoy a relaxing swim in the private pool, complete with a sun lounge and shaded patio. Daily breakfast is served for two, and a complimentary welcome drink awaits upon arrival. For outdoor fun, the villa includes access to barbecue facilities, kayaks, and paddle boards. Fast Wi-Fi, secure private parking, and daily housekeeping are also included, ensuring a comfortable and convenient experience throughout your stay. Plus, guests can avail of exclusive discounts on local tours and extended bookings.', NULL, '3506.00', '420.72', '3085.28', '2025-05-11 07:52:11', '2025-05-11 08:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(54, '0001_01_01_000000_create_users_table', 1),
(55, '0001_01_01_000001_create_cache_table', 1),
(56, '0001_01_01_000002_create_jobs_table', 1),
(57, '2025_03_30_122912_add_two_factor_columns_to_users_table', 1),
(58, '2025_03_30_122952_create_personal_access_tokens_table', 1),
(59, '2025_04_11_063249_create_listings_table', 1),
(60, '2025_05_02_162715_create_completes_table', 2),
(61, '2025_05_04_132301_create_applications_table', 3),
(62, '2025_05_04_201330_create_galleries_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('hcQhI2HxMzImAghORHayh3JsTgkMwSX6PpYRID1f', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUVFOXBuYk01cGQySVhWVHY2QlUyQm5vQ1RIN2s2djdqSm1sSWZWciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92aWV3X2Jvb2tpbmdzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749050328),
('iviOTnwOurV9HFPaP0BvYpl4OCIuXw4qIleZlXuV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSmxxckM3VlNoZlJaTGxoNTZ0ODZuTWlkNXVVSzJjcGZJRHA4WVM5biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1749050314),
('roEXofh2IlW9IkUGQL7DS0hdfIU6BWwjqOIglskg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3lXRXZWUG8xc1VrNHl1UkhEaHd6Q0wzY2dONGlUUkNsMDg4NFNVOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747028695);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `usertype`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Macc', 'lister@gmail.com', '092832131321', 'lister', NULL, '$2y$12$43VYcZVPdSvwtycwAj.mHeJGZojs41lTXc5I.uzP0FFkbN/ZY8cpe', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-11 05:23:24', '2025-05-04 08:41:42'),
(4, 'Althea', 'user@gmail.com', '092832131321', 'user', NULL, '$2y$12$dSLfkmg8494FUIHiGfyv7eCVowWYxN6pPj1MtWEVuV74.veDLDTjC', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-02 21:23:04', '2025-05-11 17:09:43'),
(5, 'master', 'master@gmail.com', '092832131321', 'admin', NULL, '$2y$12$sPzkIErF/xlX6etMIYekoeIhAizkNccPaS5dbxzlT46QmpccU2JDG', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-04 08:02:09', '2025-05-04 08:02:09'),
(6, 'menchie dela cruz', 'chie_qtpie@yahoo.com', '091234567890', 'lister', NULL, '$2y$12$sOBrau27rlT8MTfD.Z/iIegqnruTG8eQjGHmHaCPSeaOMelcxIwhq', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-04 18:54:04', '2025-05-04 19:03:12'),
(7, 'Macc', 'abadmarcneil16@gmail.com', '092832131321', 'lister', NULL, '$2y$12$OAe.rQDpmDah.0kftBDFieECGxMSqV0Sp.7YtSBN.bjn8w8taRAsu', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-11 17:10:29', '2025-05-11 17:42:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applications_email_unique` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `completes`
--
ALTER TABLE `completes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `completes`
--
ALTER TABLE `completes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
