/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `qrcodes` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `scandrivers` (
  `qrcode_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `scandrivers_driver_id_foreign` (`driver_id`),
  CONSTRAINT `scandrivers_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_no_hp_unique` (`no_hp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_27_123926_update_user', 1),
(6, '2024_03_01_054041_create_qrcodes_table', 1),
(7, '2024_03_01_054404_create_scandrivers_table', 1);



INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', 'f61b319fa243d1dbeae5e516a30e6b3ab61147ca480ab507492a95405c7bbbb0', '[\"*\"]', NULL, NULL, '2024-03-05 04:18:41', '2024-03-05 04:18:41');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '11a9f1743d992998568f7cb9467ccdb7134af8a83443b93caeecf1846bb9b338', '[\"*\"]', NULL, NULL, '2024-03-05 04:21:47', '2024-03-05 04:21:47');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\User', '1540f2ce-3a36-43cb-8b5c-0d21ad8dadb1', 'auth_token', '5af6c68fd5ede50a0357777b218a9d0f6cb1953c4b39757fff1272f2635379b2', '[\"*\"]', NULL, NULL, '2024-03-05 04:36:13', '2024-03-05 04:36:13');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '7e00480dedc2de25e0d5a4aec92f4fcb17c723f0f81ddb9aab021374293ff452', '[\"*\"]', NULL, NULL, '2024-03-05 05:04:56', '2024-03-05 05:04:56'),
(6, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '6ca01cb2926b624d590026d8bb9ee3142ba7aa8050bafe3689db1e5429ad6dc4', '[\"*\"]', '2024-03-05 05:36:14', NULL, '2024-03-05 05:34:59', '2024-03-05 05:36:14'),
(7, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', 'f4984fb9aed3d77ad7a2c450b4bd9503c937fe7cffe926fb8dc796e7683a5906', '[\"*\"]', NULL, NULL, '2024-03-05 05:45:42', '2024-03-05 05:45:42'),
(8, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '6506d2c7baa26feab21b7cd328ef4f3bdca84837c439ad4ee1f36b6e6ab6a4ec', '[\"*\"]', '2024-03-05 23:11:00', NULL, '2024-03-05 06:30:09', '2024-03-05 23:11:00'),
(9, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '988735290795ec101806785ce2ea7b0e133b9263f3563979f487e3b05072c716', '[\"*\"]', '2024-03-05 23:31:34', NULL, '2024-03-05 09:41:33', '2024-03-05 23:31:34'),
(10, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '6ab1e3295dafc063912e875377de4dbbb780d7d8640bab44b803381e6dd716da', '[\"*\"]', NULL, NULL, '2024-03-05 14:41:35', '2024-03-05 14:41:35'),
(11, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', 'f27e9543efafaf19b933feaa6393f2b2f15afa2626ea895baa331155cb6d039c', '[\"*\"]', NULL, NULL, '2024-03-05 14:53:18', '2024-03-05 14:53:18'),
(12, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', 'a64eedfee8c936c059d1980af01693b45bd3658d2f8764589a2e86d99898dab6', '[\"*\"]', NULL, NULL, '2024-03-05 15:04:11', '2024-03-05 15:04:11'),
(13, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '88099d921f227d9f5e47c53ca9395d8241444fe976de7b60ed9edc85d1df0f69', '[\"*\"]', NULL, NULL, '2024-03-05 15:09:00', '2024-03-05 15:09:00'),
(14, 'App\\Models\\User', '264666f9-4507-4b78-a5f5-e97961436364', 'auth_token', '86efce825247ee1b9e2cf9a6a45778e00ba968916c074e209d426de00b966742', '[\"*\"]', '2024-03-05 15:14:39', NULL, '2024-03-05 15:12:17', '2024-03-05 15:14:39'),
(15, 'App\\Models\\User', '264666f9-4507-4b78-a5f5-e97961436364', 'auth_token', '9daf1ce4e1e37f56dcaba4e62234634e08ad5b6c561d378169268d17cffd3db3', '[\"*\"]', '2024-03-05 15:21:39', NULL, '2024-03-05 15:21:22', '2024-03-05 15:21:39'),
(16, 'App\\Models\\User', 'b9c9691d-4a0e-4825-bef8-99392c547f79', 'auth_token', '0dedf9fd294e08d03363002a350fbed11bf6907013735a57afef9950f61a1114', '[\"*\"]', '2024-03-05 16:49:50', NULL, '2024-03-05 15:25:31', '2024-03-05 16:49:50'),
(17, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', '41c18cfa79658ee76f0e247fd1686f61dce7cb7a59107ba593d88a330f8bee8d', '[\"*\"]', NULL, NULL, '2024-03-05 23:11:38', '2024-03-05 23:11:38'),
(18, 'App\\Models\\User', 'b9c9691d-4a0e-4825-bef8-99392c547f79', 'auth_token', '12b2ee37d980419daa4f3b0f56c6a31f9adf85c31fa42f039ba9af58ffc826e8', '[\"*\"]', '2024-03-05 23:49:08', NULL, '2024-03-05 23:32:01', '2024-03-05 23:49:08'),
(19, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', 'ae25c94cd18c47593af4b670448d114af128bac0d79a52db8fad9c60cd11ae65', '[\"*\"]', NULL, NULL, '2024-03-06 00:01:57', '2024-03-06 00:01:57'),
(20, 'App\\Models\\User', 'b9c9691d-4a0e-4825-bef8-99392c547f79', 'auth_token', 'f387ca514fe54e3e4ab3c0b2e682589ef6b035229d17bf14c5d5aafeeeb728db', '[\"*\"]', NULL, NULL, '2024-03-06 00:03:51', '2024-03-06 00:03:51'),
(21, 'App\\Models\\User', 'b9c9691d-4a0e-4825-bef8-99392c547f79', 'auth_token', '21e547d738fd8d4ec1cb6422fd4c713ac28b38153ff409d23698e60106d0b7e8', '[\"*\"]', '2024-03-06 00:30:56', NULL, '2024-03-06 00:11:18', '2024-03-06 00:30:56'),
(22, 'App\\Models\\User', 'b9c9691d-4a0e-4825-bef8-99392c547f79', 'auth_token', '637000422521e26e435f274f05947f9b922fb60a8f7683e03dd4efbcdaf37daa', '[\"*\"]', '2024-03-06 08:18:35', NULL, '2024-03-06 05:14:19', '2024-03-06 08:18:35'),
(23, 'App\\Models\\User', 'b9c9691d-4a0e-4825-bef8-99392c547f79', 'auth_token', '334a212cf5c2ecde80517981d4c0828a0fa68cfa8e0ce76a91b1cc8856241ce7', '[\"*\"]', '2024-03-06 07:52:42', NULL, '2024-03-06 07:19:45', '2024-03-06 07:52:42'),
(24, 'App\\Models\\User', '75a916d8-a8cd-44c3-b791-3f54598e366f', 'auth_token', 'b32732ad2a08feec34f46dfabe5d9162e182c49e92ed9baa46bd62bfa05c0367', '[\"*\"]', '2024-03-07 10:03:27', NULL, '2024-03-07 07:31:04', '2024-03-07 10:03:27');

INSERT INTO `qrcodes` (`id`, `created_at`, `updated_at`) VALUES
('167f9d58-029a-4512-9325-d3eb36327860', '2024-03-06 08:12:56', '2024-03-06 08:12:56');


INSERT INTO `scandrivers` (`qrcode_id`, `driver_id`, `waktu`, `created_at`, `updated_at`) VALUES
('08f13809-d103-4417-a25e-35e88d78caed', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 14:21:17', '2024-03-06 07:21:17', '2024-03-06 07:21:17');
INSERT INTO `scandrivers` (`qrcode_id`, `driver_id`, `waktu`, `created_at`, `updated_at`) VALUES
('2c88c9d3-86ee-4d7e-a710-3c710f0d6170', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 14:26:46', '2024-03-06 07:26:46', '2024-03-06 07:26:46');
INSERT INTO `scandrivers` (`qrcode_id`, `driver_id`, `waktu`, `created_at`, `updated_at`) VALUES
('c2a7fc72-5a6a-4d56-a61f-ee4b1197be1d', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 14:47:48', '2024-03-06 07:47:48', '2024-03-06 07:47:48');
INSERT INTO `scandrivers` (`qrcode_id`, `driver_id`, `waktu`, `created_at`, `updated_at`) VALUES
('a2428265-986b-4906-9883-e228e646ea32', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 14:54:33', '2024-03-06 07:54:33', '2024-03-06 07:54:33'),
('58004116-a99d-4ee7-b458-735bf44b091f', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 14:57:43', '2024-03-06 07:57:43', '2024-03-06 07:57:43'),
('8dd3e40c-31ae-4d7b-8f73-f0b1de585e78', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 14:58:29', '2024-03-06 07:58:29', '2024-03-06 07:58:29'),
('4cbf5983-1c7f-4955-b4cd-66df66f95e83', 'b9c9691d-4a0e-4825-bef8-99392c547f79', '2024-03-06 15:12:56', '2024-03-06 08:12:56', '2024-03-06 08:12:56');

INSERT INTO `users` (`id`, `name`, `no_hp`, `image`, `no_hp_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `roles`) VALUES
('1540f2ce-3a36-43cb-8b5c-0d21ad8dadb1', 'tes', '082134', '1709613352.jpg', NULL, '$2y$12$FsCdGabOuGpHkGwyTphdUe6W2w8DZLl4aK/KAjjixDlSCOc1lXF3m', NULL, '2024-03-05 04:35:53', '2024-03-05 04:35:53', 'Driver');
INSERT INTO `users` (`id`, `name`, `no_hp`, `image`, `no_hp_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `roles`) VALUES
('264666f9-4507-4b78-a5f5-e97961436364', 'tes2', '0723', '1709651497.jpg', NULL, '$2y$12$RUV.BfYc8WtYfe5mYZFeWe7P8Gk8Y/VRwaNHXWGAcQtugZInLuCXy', NULL, '2024-03-05 15:11:38', '2024-03-05 15:11:38', 'Driver');
INSERT INTO `users` (`id`, `name`, `no_hp`, `image`, `no_hp_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `roles`) VALUES
('5b125122-fdba-4b4a-be17-dbe16e755b20', 'Driver Ojol', '03123131311', 'https://picsum.photos/200/300', '2024-03-05 03:45:27', '$2y$12$eTDHSrATkeVJe05V4UZdKu/yzTI.TYGKwW27MA0dB5BHIy0rfU03u', 'wYrVoIhvin', '2024-03-05 03:45:27', '2024-03-05 03:45:27', 'Driver');
INSERT INTO `users` (`id`, `name`, `no_hp`, `image`, `no_hp_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `roles`) VALUES
('624d760d-4c05-43fa-bc17-7079b8d3bc70', 'tes35', '08231234133', '1709611168.png', NULL, '$2y$12$lYEj0DPHbwAMoDGrjEGFOuCWdqddmiubrApv4Z0lXtA05FqQDdeyK', NULL, '2024-03-05 03:59:29', '2024-03-05 03:59:29', 'Driver'),
('75a916d8-a8cd-44c3-b791-3f54598e366f', 'Nurcholis', '0821', '1709610857.png', NULL, '$2y$12$Y8XrrHiZYzxQcJDzAyahUuNRwr/BnScpk89hU7pTcO3dwCmFcJWxm', NULL, '2024-03-05 03:54:18', '2024-03-05 03:54:18', 'Admin'),
('b9c9691d-4a0e-4825-bef8-99392c547f79', 'tes3', '0623', '1709652318.jpg', NULL, '$2y$12$81zHmcZxvHQFZgRisD65NeveOIMwFqf7PKVPJwM41sbQup7EvQqeu', NULL, '2024-03-05 15:25:19', '2024-03-05 15:25:19', 'Driver'),
('d20f4ff7-f2ea-48b6-a285-7035e5365a64', 'Admin Holis', '08123456789', 'https://picsum.photos/200/300', '2024-03-05 03:45:27', '$2y$12$10hsg4hBxd/jE/wpahpO5Oqafo2H.tcm3ILBroJMuVdb8/II76XQm', 'vIm4hyd84rG0fzWuB84gyXusoA8aovFbAu0GArZAZb9bZ9Vr1M6ibenKAtd9', '2024-03-05 03:45:27', '2024-03-05 03:45:27', 'Admin');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;