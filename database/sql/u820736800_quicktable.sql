-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2024 at 01:56 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u820736800_quicktable`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `background_image` varchar(191) NOT NULL,
  `business_type` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `base_price` int(11) NOT NULL,
  `reports` int(11) NOT NULL DEFAULT 0,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '2024-06-10 08:52:03'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `name`, `address`, `phone`, `email`, `description`, `background_image`, `business_type`, `status`, `base_price`, `reports`, `owner_id`, `created_at`) VALUES
(1, 'Diana', 'Rue 20, Marrakech, Morocco', '+212612345678', 'litchicafe@contact.com', 'Drink coffee and relax', '/uploads/1718019407.png', 'Coffee shop', '1', 2, 0, 2, '2024-06-10 08:52:14'),
(2, 'Black Milk', 'Rue 20, Youssoufia, Morocco', '+212612345678', 'blackmilk@contact.com', 'Best view for work or chat.', '../uploads/defaultbusiness.jpg', 'Coffee Shop', '1', 3, 0, 2, '2024-06-10 08:52:14'),
(3, 'Free Food', 'New Adress', 'New Phone', 'New Email', 'Welcome everyone', '/uploads/1719799427.png', 'Restaurant', '1', 1, 0, 5, '2024-06-10 08:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, 'Help me my ticket was stolen', '2024-06-14 23:03:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 3, 3, '2024-06-10 14:07:30', NULL),
(2, 3, 2, '2024-06-10 14:07:34', NULL),
(3, 3, 6, '2024-06-10 14:38:24', NULL),
(4, 3, 1, '2024-06-10 14:38:26', NULL),
(5, 3, 11, '2024-06-14 23:01:49', NULL),
(9, 3, 4, '2024-09-20 08:16:10', NULL),
(10, 3, 5, '2024-10-02 18:56:16', NULL),
(11, 3, 7, '2024-10-02 18:56:17', NULL),
(12, 3, 12, '2024-10-02 18:56:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `business_id`, `created_at`, `updated_at`) VALUES
(1, 'Black Coffee', 'Aut illo magnam facere et saepe vero est voluptatem. Iste a suscipit eos magnam. Qui amet atque ut rerum. Quaerat odio et et quae aut voluptatum expedita. Necessitatibus ut nisi voluptatem omnis minima.', 2, 1, '1985-01-26 17:05:38', '2024-06-14 22:45:36'),
(2, 'in', 'Dolores veniam repellat saepe ullam dolorem. Omnis numquam ut qui veritatis est explicabo velit.', 2, 1, '2023-06-10 03:37:14', '2002-04-17 00:08:27'),
(3, 'esse', 'Officiis nam sunt hic saepe qui. Molestiae nemo et consequuntur ullam dolore iure minus. Ex repudiandae doloremque facere quod totam dolor. Dolore officia quis quis exercitationem.', 7, 1, '1993-11-19 09:54:28', '1977-01-11 03:27:09'),
(4, 'assumenda', 'Mollitia quia eos dolorem quia consequuntur. Neque officiis consequuntur excepturi et repellat quae. Aspernatur facilis magnam facilis corrupti tenetur. Modi accusamus voluptate accusamus quas modi dolore eius quo.', 3, 1, '2006-03-01 05:59:41', '2023-10-04 22:28:48'),
(5, 'aperiam', 'Ut enim dolorem sequi quae ea autem. Tempora aliquam magni expedita animi perspiciatis beatae voluptatem recusandae. Sint voluptas aut placeat. Accusantium hic eos non libero ex veritatis.', 6, 1, '2018-06-18 14:03:36', '1993-05-31 10:00:54'),
(6, 'praesentium', 'Atque dolor molestiae aspernatur placeat atque dolorem repudiandae error. Aliquam dolor eum dignissimos corporis. Rem adipisci exercitationem laboriosam ducimus alias quis voluptatem.', 4, 1, '1988-04-06 08:16:48', '2015-08-23 23:09:18'),
(7, 'cupiditate', 'Ut perspiciatis enim iusto qui. Dolore quo sint fuga ut quisquam nulla quidem. Atque numquam dolorum aliquid eius earum. Exercitationem occaecati ut et enim distinctio. Ut ex id repellat enim iusto reiciendis et.', 2, 1, '2011-04-21 19:03:46', '2001-09-04 18:50:43'),
(8, 'assumenda', 'Vitae voluptas natus quo ipsam nam praesentium asperiores. Veniam nihil sed et quas quis nihil. Voluptate qui reprehenderit ut sed.', 7, 1, '1974-08-06 13:54:49', '2016-09-30 17:29:48'),
(9, 'molestias', 'Consectetur aut dolor neque tempora. Voluptatum quas doloremque ducimus saepe. Beatae dolores maxime consequatur vel repudiandae.', 2, 1, '1988-01-28 08:33:37', '1980-10-26 13:44:38'),
(10, 'cumque', 'Ut non commodi aut officiis et aliquam nostrum. Itaque laudantium voluptatem delectus illo. Omnis dolorem perferendis modi sunt.', 6, 1, '1996-10-04 13:28:35', '1999-12-07 06:03:23'),
(11, 'velit', 'Placeat laudantium laboriosam ducimus eum beatae. Ipsa mollitia ducimus reiciendis harum accusantium sequi sit explicabo. Natus corrupti nihil sit assumenda odit.', 9, 1, '2003-02-25 20:09:56', '2012-09-22 09:56:14'),
(12, 'dolores', 'Dolorem id voluptas quos enim. Consequatur sit dolores velit sint. Earum nisi ut qui vel aliquam. Ut aut adipisci et quas sit corporis possimus.', 4, 1, '1978-11-26 01:31:47', '2018-09-03 02:28:35'),
(13, 'natus', 'Corrupti eveniet quia et ducimus quasi. Minus nesciunt omnis occaecati voluptatem illum adipisci. Sed quisquam atque repellendus ex illo natus sunt. Omnis omnis voluptas voluptatem voluptates.', 5, 1, '2002-11-02 03:35:24', '2009-09-27 20:10:42'),
(14, 'minus', 'Rerum fugit autem et velit. Sit aliquid dolore quae consequatur id qui. Ducimus aut nostrum aut est. Officia nihil sapiente ad sit consequatur unde.', 4, 1, '1996-09-14 21:42:55', '1993-03-21 13:20:23'),
(15, 'error', 'Iste iste aliquid molestiae sapiente aut. Beatae nesciunt rerum eos voluptatibus dolore. Quo pariatur expedita occaecati ut inventore. Et cumque sit facilis aut reiciendis distinctio. Quo qui ipsum sunt nam autem aut.', 5, 1, '2005-08-28 00:58:21', '1998-01-14 18:26:12'),
(16, 'nemo', 'Veniam omnis ullam fuga et ullam officia libero. Omnis dicta corrupti eius et ipsum. Cumque dolor corporis voluptates impedit sit porro minima.', 9, 1, '1982-01-17 10:06:57', '2004-05-12 09:59:50'),
(17, 'id', 'Iste labore enim consectetur perferendis tempore officiis. Minus ut non ipsa cumque accusamus in aut. Reiciendis aut temporibus quia qui voluptatem modi. Consequatur laboriosam nisi mollitia repellat pariatur odio.', 5, 1, '2008-08-09 12:55:28', '1978-06-25 01:18:07'),
(18, 'est', 'Id iste minima reprehenderit vitae. Qui architecto velit esse doloremque. Voluptates sunt aliquam ipsum quibusdam debitis eos cum sed. Aut fuga id qui excepturi sint corporis.', 4, 1, '2016-01-23 11:42:14', '1991-01-18 00:23:59'),
(19, 'velit', 'Sit hic esse quia voluptatibus omnis. Et aut ut praesentium explicabo vitae accusantium minima repudiandae. Dolore repudiandae ipsum culpa consectetur.', 5, 1, '1988-10-04 22:05:17', '1974-02-14 02:57:00'),
(20, 'nobis', 'Nemo perspiciatis neque numquam vero repellat. Reiciendis doloribus voluptates consequatur quasi.', 8, 1, '2006-05-10 13:02:34', '1998-03-11 19:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_05_03_000001_create_customer_columns', 1),
(3, '2019_05_03_000002_create_subscriptions_table', 1),
(4, '2019_05_03_000003_create_subscription_items_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_03_105013_business', 1),
(7, '2024_03_04_102902_posts', 1),
(8, '2024_03_06_111432_menu', 1),
(9, '2024_03_07_084400_reservation', 1),
(10, '2024_04_07_223130_slides', 1),
(11, '2024_04_17_091536_reports', 1),
(12, '2024_04_18_083024_likes', 1),
(13, '2024_04_23_132349_inbox', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`, `deleted`, `business_id`, `likes`, `created_at`, `updated_at`) VALUES
(1, 'Delectus cum consectetur debitis non ab.', 'Quam facilis itaque voluptatem omnis quae mollitia aut velit. Libero id et odit aliquam suscipit non. Consequatur in odit aut aut.', '../uploads/defaultpost.jpg', 1, 1, 1, '2017-10-01 01:46:58', '2018-12-03 14:01:17'),
(2, 'Et alias cupiditate ut iusto aspernatur et.', 'Placeat architecto et vitae sed quae nam sit. Est voluptate qui assumenda illo ut dolorem sapiente repudiandae. Minus qui magni asperiores velit. Qui quod et et similique et mollitia.', '../uploads/defaultpost.jpg', 1, 1, 1, '1994-03-27 08:59:22', '1984-12-12 08:17:14'),
(3, 'Tempora ea sed sequi repellat consequatur mollitia facere.', 'Qui aperiam itaque nobis quis pariatur quo eum. Qui quis et ipsa reprehenderit.', '../uploads/defaultpost.jpg', 0, 1, 1, '2021-06-30 15:46:02', '2018-04-01 23:15:19'),
(4, 'Id modi vitae velit sed qui et voluptas.', 'Nesciunt eos adipisci occaecati incidunt ad culpa a rerum. Dicta nihil voluptatem tempore nesciunt voluptas temporibus. Repellendus quasi magni eveniet distinctio doloribus occaecati.', '../uploads/defaultpost.jpg', 0, 2, 1, '1975-08-31 05:42:41', '2003-05-25 09:40:42'),
(5, 'Nihil at deleniti qui consequuntur voluptas enim.', 'Nam asperiores quasi perferendis. Aspernatur consequatur omnis vero quia sunt sapiente veniam. Et necessitatibus ut et laboriosam velit. Non ipsam cumque dolorum impedit fugiat qui aspernatur.', '../uploads/defaultpost.jpg', 0, 2, 1, '1973-01-15 01:53:14', '1994-11-09 01:41:09'),
(6, 'Explicabo in itaque architecto.', 'Eos quod delectus quia omnis voluptas nemo cumque. Nihil accusantium adipisci sapiente praesentium qui error. Fugiat omnis accusantium omnis iure reprehenderit recusandae sunt. Iusto quasi tempore sit aut sequi tempora culpa.', '../uploads/defaultpost.jpg', 1, 1, 1, '1972-05-22 15:06:40', '2007-08-31 22:47:21'),
(7, 'Rerum deleniti molestiae dolorem incidunt nihil omnis ut ipsa.', 'Quis autem distinctio reiciendis. Ducimus exercitationem autem voluptates repudiandae. Cumque aliquam recusandae hic doloribus reprehenderit. Ut quidem occaecati dolorem laboriosam.', '../uploads/defaultpost.jpg', 0, 2, 1, '1990-10-21 02:57:27', '1978-03-20 02:40:48'),
(8, 'Esse illo beatae ut iusto perspiciatis.', 'Nostrum eligendi facilis in facere at sequi. In delectus facilis odio eligendi distinctio reiciendis voluptatibus. Nihil unde temporibus vel animi.', '../uploads/defaultpost.jpg', 1, 2, 0, '2013-05-07 15:29:27', '1983-05-16 14:16:20'),
(9, 'Fuga accusamus iusto impedit ducimus atque temporibus deleniti.', 'Similique dolores minima amet accusantium nemo maiores. Sapiente omnis culpa adipisci ut sapiente ut dolore. Et autem itaque in ut aut. Laborum ex aperiam voluptatem et.', '../uploads/defaultpost.jpg', 0, 2, 0, '2002-07-21 01:24:06', '2021-10-26 20:35:56'),
(10, 'Animi facere dolorum et quaerat facere provident autem.', 'Eos ab est et fugit nemo commodi. Aut quidem repellendus culpa non voluptatem et voluptatem. Tempora nobis omnis laboriosam et architecto earum.', '../uploads/defaultpost.jpg', 1, 1, 0, '1996-09-29 06:38:12', '2000-02-17 00:25:28'),
(11, 'Welcome to our new coffee shop', '<p>3azwa 9 tinipisi</p>', '../uploads/666ccb832bbd5.jpg', 0, 1, 1, '2024-06-14 23:00:19', '2024-06-14 23:00:19'),
(12, 'dfgsdfgsdf', '<p>sdkjhu tiu tiutiu ut o tuit uitfa</p>', '../uploads/66821663d5b19.jpg', 0, 3, 1, '2024-07-01 02:37:50', '2024-07-01 02:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(191) NOT NULL,
  `token` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `business_id`, `item_id`, `quantity`, `type`, `token`, `status`, `expires_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 3, 2, 'stripe', 22378287, 0, '2024-06-17 14:09:01', NULL, '2024-06-10 14:09:01', NULL),
(2, 3, 1, 16, 6, 'stripe', 23420350, 1, '2024-06-17 14:47:40', NULL, '2024-06-10 14:47:40', NULL),
(3, 3, 1, 1, 2, 'stripe', 71738348, 1, '2024-06-21 14:02:13', NULL, '2024-06-14 14:02:13', NULL),
(4, 6, 1, 1, 2, 'stripe', 41485815, 0, '2024-07-09 11:57:12', NULL, '2024-07-02 11:57:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `slider_index` int(11) NOT NULL,
  `slide_index` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `business_id`, `slider_index`, `slide_index`, `image`, `created_at`, `updated_at`) VALUES
(7, 'Places', 2, 1, 1, '../assets/noimage.png', '2024-06-10 07:52:14', '2024-06-10 07:52:14'),
(8, 'Places', 2, 1, 2, '../assets/noimage.png', '2024-06-10 07:52:14', '2024-06-10 07:52:14'),
(9, 'Places', 2, 1, 3, '../assets/noimage.png', '2024-06-10 07:52:14', '2024-06-10 07:52:14'),
(10, 'Dishes', 2, 2, 1, '../assets/noimage.png', '2024-06-10 07:52:14', '2024-06-10 07:52:14'),
(11, 'Dishes', 2, 2, 2, '../assets/noimage.png', '2024-06-10 07:52:14', '2024-06-10 07:52:14'),
(12, 'Dishes', 2, 2, 3, '../assets/noimage.png', '2024-06-10 07:52:14', '2024-06-10 07:52:14'),
(16, 'Dishes', 1, 2, 1, '../uploads/6666e652d7bd8.jpg', '2024-06-10 11:41:06', '2024-06-10 11:41:06'),
(17, 'Dishes', 1, 2, 2, '../uploads/6666e652d8b2f.jpg', '2024-06-10 11:41:06', '2024-06-10 11:41:06'),
(18, 'Dishes', 1, 2, 3, '../uploads/6666e652d9270.jpg', '2024-06-10 11:41:06', '2024-06-10 11:41:06'),
(19, 'Coffee', 1, 1, 1, '../uploads/666cc8b1a36f9.jpg', '2024-06-14 22:48:17', '2024-06-14 22:48:17'),
(20, 'Coffee', 1, 1, 2, '../uploads/666cc8b1a69bf.jpg', '2024-06-14 22:48:17', '2024-06-14 22:48:17'),
(21, 'Coffee', 1, 1, 3, '../uploads/666cc8b1a7ff7.jpg', '2024-06-14 22:48:17', '2024-06-14 22:48:17'),
(28, 'Servers', 3, 1, 1, '../uploads/66820ed3b5989.jpg', '2024-07-01 02:05:07', '2024-07-01 02:05:07'),
(29, 'Servers', 3, 1, 2, '../uploads/66820ed3b683e.jpg', '2024-07-01 02:05:07', '2024-07-01 02:05:07'),
(30, 'Servers', 3, 1, 3, '../uploads/66820ed3b6fea.jpg', '2024-07-01 02:05:07', '2024-07-01 02:05:07'),
(31, 'Dishes', 3, 2, 1, '../uploads/66820ed3b75d2.jpg', '2024-07-01 02:05:07', '2024-07-01 02:05:07'),
(32, 'Dishes', 3, 2, 2, '../uploads/66820ed3b7f25.jpg', '2024-07-01 02:05:07', '2024-07-01 02:05:07'),
(33, 'Dishes', 3, 2, 3, '../uploads/66820ed3b8929.jpg', '2024-07-01 02:05:07', '2024-07-01 02:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `stripe_id` varchar(191) NOT NULL,
  `stripe_status` varchar(191) NOT NULL,
  `stripe_price` varchar(191) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(191) NOT NULL,
  `stripe_product` varchar(191) NOT NULL,
  `stripe_price` varchar(191) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'User',
  `pp` varchar(191) NOT NULL DEFAULT '../uploads/defaultuser.webp',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) DEFAULT NULL,
  `pm_type` varchar(191) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `role`, `pp`, `status`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'Othman', ' Admin', 'othmandevsup@gmail.com', '2024-06-10 07:52:13', '$2y$12$d6DXVzOcPFD6ch6dOk5cs.CISYeq1YDvwCYZ2VTFfyyav90qVYOTy', 'Admin', '../uploads/defaultuser.webp', 1, '2024-06-10 07:52:13', '2024-06-10 07:52:13', NULL, NULL, NULL, NULL),
(2, 'Othman', 'kharbouch', 'othman4dev@gmail.com', '2024-06-10 07:52:13', '$2y$12$Bv3GHj5MEbX1mfEc4EDYh.NU/oTrnfKqX.WZwEeas7aCwNRrV1sw.', 'Owner', '../uploads/1718019422.png', 1, '2024-06-10 07:52:13', '2024-06-10 07:52:13', NULL, NULL, NULL, NULL),
(3, 'Othman', ' User', 'otmankharbouch813@gmail.com', '2024-06-10 07:52:14', '$2y$12$1LCVgpnquFYRKcAIos0GQeBSxfe9NiVzWY7Eb5iMsKcveb9NXJ1za', 'User', '../uploads/defaultuser.webp', 1, '2024-06-10 07:52:14', '2024-06-10 07:52:14', NULL, NULL, NULL, NULL),
(4, 'Wendy', 'Hartman', 'wanifehute@mailinator.com', NULL, '$2y$10$lyfIwMkWSrvEY.ivTJsZWOv5lyOzwYwbJ3J/IFgNHr8oqesDsHI3y', 'User', '../uploads/defaultuser.webp', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Achraf', 'Oumaadani', 'aoumaadani@gmail.com', '2024-07-01 01:54:23', '$2y$10$lOFeNYy5FzTw7JJucXbEguGKs5r7Jo4jvIBLhMedvMmEKtqX8N4..', 'Owner', '../uploads/1719799352.png', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Fati', 'Fleur', 'elgliouif@gmail.com', '2024-07-02 11:56:10', '$2y$10$78AZASEb2tPApHNqaeAw9e6gB5gxQist27Dbse7prlAxXPhwAxyP6', 'User', '../uploads/defaultuser.webp', 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_business_id_foreign` (`business_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_business_id_foreign` (`business_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_business_id_foreign` (`business_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_user_id_foreign` (`user_id`),
  ADD KEY `reservation_business_id_foreign` (`business_id`),
  ADD KEY `reservation_item_id_foreign` (`item_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slides_business_id_foreign` (`business_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`),
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`),
  ADD CONSTRAINT `reservation_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `reservation_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `slides_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
