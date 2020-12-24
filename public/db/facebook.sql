-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2020 at 12:12 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'This is my first comment', '2020-12-17 18:00:00', '2020-12-17 18:00:00'),
(2, 6, 1, 'first dynamic comment', '2020-12-17 13:44:26', '2020-12-17 13:44:26'),
(3, 7, 1, 'first comment', '2020-12-17 13:46:24', '2020-12-17 13:46:24'),
(4, 7, 1, 'dfs', '2020-12-18 03:09:52', '2020-12-18 03:09:52'),
(5, 6, 1, 'this is my another comment', '2020-12-18 06:18:23', '2020-12-18 06:18:23'),
(6, 7, 1, 'are ami', '2020-12-21 01:36:02', '2020-12-21 01:36:02'),
(7, 7, 1, 'ki re mama', '2020-12-22 01:11:08', '2020-12-22 01:11:08'),
(8, 19, 1, 'kira mama.. treat de..', '2020-12-22 13:16:47', '2020-12-22 13:16:47');

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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `status`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, '2020-12-22 13:18:52', NULL, '2020-12-22 13:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 6, 2, NULL, NULL),
(4, 5, 2, NULL, NULL),
(5, 4, 2, NULL, NULL),
(6, 3, 2, NULL, NULL),
(7, 2, 2, NULL, NULL),
(8, 1, 2, NULL, NULL),
(11, 4, 1, NULL, NULL),
(12, 2, 1, NULL, NULL),
(13, 1, 1, NULL, NULL),
(21, 6, 1, NULL, NULL),
(22, 8, 1, NULL, NULL),
(24, 9, 1, NULL, NULL),
(28, 19, 1, NULL, NULL),
(29, 18, 1, NULL, NULL),
(30, 17, 1, NULL, NULL);

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
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(7, '2016_06_01_000004_create_oauth_clients_table', 2),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(11, '2020_12_02_135223_create_posts_table', 3),
(16, '2020_12_11_080720_create_friends_table', 4),
(17, '2020_12_15_152822_create_likes_table', 5),
(18, '2020_12_17_151443_create_comments_table', 6),
(20, '2020_12_20_065243_create_user_images_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, NULL, 'Laravel Personal Access Client', '42learTorFlIHUHP8Qgh63tOgDE6n3fmiPQHctcQ', NULL, 'http://localhost', 1, 0, 0, '2020-11-29 14:18:23', '2020-11-29 14:18:23'),
(2, NULL, 'Laravel Password Grant Client', 'yHhfpd2Vp6RKNwIDUaIq7rUZK4XnHVhJH0clRPad', 'users', 'http://localhost', 0, 1, 0, '2020-11-29 14:18:23', '2020-11-29 14:18:23');

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
(1, 1, '2020-11-29 14:18:23', '2020-11-29 14:18:23');

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
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'a great first post. Barca lost', 'https://img.etimg.com/thumb/msid-62926216,width-480,height-360,imgsize-84450,resizemode-4/pablo-escobar.jpg', '2020-12-05 18:00:00', '2020-12-05 18:00:00'),
(2, 1, 'Barca is no more a great team.', NULL, '2020-12-05 18:00:00', '2020-12-05 18:00:00'),
(3, 1, 'They are just keep loosing all the laliga matches', 'https://e2.365dm.com/20/09/768x432/skysports-lionel-messi-barcelona_5113303.jpg?20200929233110', '2020-12-05 18:00:00', '2020-12-05 18:00:00'),
(4, 2, 'But they are going to win from now on. Another User Post.', 'https://e2.365dm.com/20/09/768x432/skysports-lionel-messi-barcelona_5113303.jpg?20200929233110', '2020-12-05 18:00:00', '2020-12-05 18:00:00'),
(5, 1, 'This is my first dynamic post', NULL, '2020-12-15 06:56:55', '2020-12-15 06:56:55'),
(6, 1, 'this is a great post as second dynamic post', NULL, '2020-12-15 07:19:49', '2020-12-15 07:19:49'),
(7, 1, 'Darren amar bari aisa', NULL, '2020-12-17 09:41:37', '2020-12-17 09:41:37'),
(8, 1, 'ajke skype e kotha koilam', NULL, '2020-12-21 01:37:09', '2020-12-21 01:37:09'),
(9, 1, 'working', NULL, '2020-12-22 00:56:33', '2020-12-22 00:56:33'),
(10, 1, 'first post with image', 'post-images/AncIujHnqiinG8sv8MXj39qgHqHKvcXTXr4dvIbX.jpeg', '2020-12-22 07:15:20', '2020-12-22 07:15:20'),
(11, 1, 'with our favourit sir', 'post-images/T3hs7YNk6gp7G7bxpF670a0QpYFixifNJxm3n2Zb.jpeg', '2020-12-22 07:46:19', '2020-12-22 07:46:19'),
(12, 1, 'this is my personal post', 'post-images/GRmfOkftSNoDBF18A91dyG06ad3xJNQYL5xmGY5u.jpeg', '2020-12-22 07:49:02', '2020-12-22 07:49:02'),
(13, 1, 'post working', 'post-images/VPZpywO4aHQKkZL24Rt4d6oN0sa9GfurBZwVMhvQ.jpeg', '2020-12-22 07:54:46', '2020-12-22 07:54:46'),
(14, 1, 'happy friends at village!!!', 'post-images/1vfZuvOUDP3RgrEge2qbmVh1MDQVQ9H7xel8bpGp.jpeg', '2020-12-22 07:57:57', '2020-12-22 07:57:57'),
(15, 1, 'happy friends again at village', 'post-images/PHzli0Fep2y6WG6VEWsancIRaVOQVoq2eVOG9guy.jpeg', '2020-12-22 07:58:22', '2020-12-22 07:58:22'),
(16, 1, 'text iys', NULL, '2020-12-22 07:59:18', '2020-12-22 07:59:18'),
(17, 1, 'text 2', NULL, '2020-12-22 08:03:42', '2020-12-22 08:03:42'),
(18, 1, 'image with friends', 'post-images/xLe3cAvZK3SfMYGJxAFa79tVdRF51Uc3Ya5hGnKf.jpeg', '2020-12-22 08:04:06', '2020-12-22 08:04:06'),
(19, 1, 'Happy Birthday Dip', 'post-images/YOXktspqNn0bF4VunEZuU8J3OvMFZxjZjqZCYEKg.jpeg', '2020-12-22 13:16:33', '2020-12-22 13:16:33');

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
(1, 'Steven', 'buntygomes23@gmail.com', NULL, '$2y$10$om1ioBFzZg7FYunTppIRR.RduITGRrwfV1Y/iQAYHcsBqYYjJKRC2', NULL, '2020-11-30 01:36:17', '2020-11-30 01:36:17'),
(2, 'Smith', 'stevengomesfreelancer23@gmail.com', NULL, '$2y$10$om1ioBFzZg7FYunTppIRR.RduITGRrwfV1Y/iQAYHcsBqYYjJKRC2', NULL, '2020-11-30 01:36:17', '2020-11-30 01:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `user_id`, `path`, `width`, `height`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, 'user-images/pCQCpLihpIIKt1riLn7zyTCY5iHFS1GqjeZj6KUc.jpeg', '700', '700', 'profile', '2020-12-22 00:53:26', '2020-12-22 00:53:26'),
(2, 1, 'user-images/EPyhAhy7qRzvBgsT0R0xgLM8yit2xfrVzsUo3Xjd.jpeg', '1500', '500', 'cover', '2020-12-22 00:53:39', '2020-12-22 00:53:39'),
(3, 1, 'user-images/gbyOty22PuAXmcJ5vjBKqbzbaoYMrMqaaZNortw5.jpeg', '700', '700', 'profile', '2020-12-22 01:10:42', '2020-12-22 01:10:42'),
(4, 1, 'user-images/9UFN9miut3daoMrVplu31MyBmS6z1lHpDI4Qb0Qh.jpeg', '700', '700', 'profile', '2020-12-22 13:16:01', '2020-12-22 13:16:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `friends_user_id_friend_id_unique` (`user_id`,`friend_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
