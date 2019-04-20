-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2019 at 02:42 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fate_wat`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `file_no` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_of_residence` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_of_residence` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci,
  `organization` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_of_birth` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firm_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `firm_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `firm_id`, `created_at`, `updated_at`) VALUES
(1, 'Litigation', 'To handle criminal court casesy', 'WATL_E65E75A5', NULL, NULL),
(2, 'Banking & Finance', 'To handle requisitions and businesses', 'WATL_E65E75A5', NULL, NULL),
(8, 'Energy and infrastructure', 'Handles International Clients', 'WATL_E65E75A5', NULL, NULL),
(9, 'Child Abuse', 'Handles all cases of child abuse and discrimintaion', 'WATL_E65E75A5', NULL, NULL),
(10, 'Discrimination', 'maiores eveniet! Eleifend fames sem morbi amet quidem? Augue gravida ducimus eleifend quidem? Molestie? Lectus nostru', 'WATL_8E88BA66', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` int(10) UNSIGNED NOT NULL,
  `firm_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `uuid` text COLLATE utf8mb4_unicode_ci,
  `activity_flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_flag` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `firms`
--

INSERT INTO `firms` (`id`, `firm_id`, `name`, `email`, `contact1`, `contact2`, `password`, `country`, `area`, `city`, `street_address`, `date_of_reg`, `avatar`, `website`, `description`, `uuid`, `activity_flag`, `verification_flag`, `created_at`, `updated_at`) VALUES
(60, 'WATL_E65E75A5', 'Ssempala & Kansiime Advocates', 'ssempala@gmail.com', '0752121212', '0785363636', '$2y$10$u2ZG.yiZYQjBsOdz2zzpp./8QfzwzKjho34CfJ7l3vLcDf/Nkq1S6', 'Uganda', 'Central', 'Kampala', 'Plot 7, Namirembe road', '2019-03-08 06:36:31', NULL, 'http://sempala.com', 'Nunc similique rhoncus commodo laboris, eius ultricies accumsan magna conubia, taciti facilis? Eleifend illum placerat aut, voluptate, senectus blanditiis mus. Porttitor nisl, quam dis. Optio distinctio scelerisque tempus egestas lectus, fugiat laboris, eget reprehenderit scelerisque incidunt! Qui necessitatibus? Faucibus convallis, ducimus? Rerum! Non soluta repellat, adipisci eius quam dolor iusto, temporibus autem eiusmod vestibulum scelerisque iaculis occaecati viverra dicta auctor, ullam justo, molestie penatibus, offic', '8701397e-3f5e-11e9-aa7c-2a67b0984546', 'active', 'verified', '2019-03-05 12:51:23', '2019-03-05 12:52:27'),
(61, 'WATL_8E88BA66', 'Osh Advocates', 'osh@co.ug', '84563245636', '48563245632', '$2y$10$FROWgN32JT9/svUbhjrQHOpjhOnSXfZMB7N8VHfBysJLgUb/uM3Me', 'Uganda', 'Central', 'Kampala', 'Plot 2, road', '2019-03-28 13:19:02', NULL, 'osh.co.ug', 'Nnatus maxime porta praesent voluptatibus ex consequat aliquet? Distinctio adipiscing vel eiusmod voluptatibus sem laboriosam, animi varius occaecati labore eleifend molestiae, laoreet doloribus molestie aliquam eum cum, placeat quia qui porro? Corrupti ut vero dignissim, elit accums', 'd1a1c142-515b-11e9-8056-1867b0984547', 'active', 'verified', '2019-03-28 10:17:21', '2019-03-28 10:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(511, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendVerificationEmailJob\\\":10:{s:5:\\\"\\u0000*\\u0000to\\\";s:22:\\\"mukikelly792@gmail.com\\\";s:10:\\\"\\u0000*\\u0000to_name\\\";s:28:\\\"Kakooza & Sons Egg Suppliers\\\";s:6:\\\"\\u0000*\\u0000otp\\\";s:13:\\\"WATL_50B14322\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"telescope_uuid\":\"8d1ab864-49e7-46d0-a37c-fce4ec0b53d5\"}', 255, NULL, 1551459761, 1551459761),
(512, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendVerificationEmailJob\\\":10:{s:5:\\\"\\u0000*\\u0000to\\\";s:22:\\\"mukikelly792@gmail.com\\\";s:10:\\\"\\u0000*\\u0000to_name\\\";s:28:\\\"Kakooza & Sons Egg Suppliers\\\";s:6:\\\"\\u0000*\\u0000otp\\\";s:13:\\\"WATL_FA0F4507\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"telescope_uuid\":\"8d1aba27-c204-4f26-8749-1c687a65f71a\"}', 255, NULL, 1551459761, 1551459761),
(513, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendVerificationEmailJob\\\":10:{s:5:\\\"\\u0000*\\u0000to\\\";s:17:\\\"alekds@gmail.comf\\\";s:10:\\\"\\u0000*\\u0000to_name\\\";s:13:\\\"Leanne Graham\\\";s:6:\\\"\\u0000*\\u0000otp\\\";s:13:\\\"WATL_E082E2F9\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"telescope_uuid\":\"8d1abec9-330a-494f-affd-e0f36f2e8be6\"}', 0, NULL, 1551460095, 1551460095),
(514, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendVerificationEmailJob\\\":10:{s:5:\\\"\\u0000*\\u0000to\\\";s:22:\\\"mukikelly792@gmail.com\\\";s:10:\\\"\\u0000*\\u0000to_name\\\";s:20:\\\"Technology Advocates\\\";s:6:\\\"\\u0000*\\u0000otp\\\";s:13:\\\"WATL_74FDADA4\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"telescope_uuid\":\"8d1ca0af-7b23-4ade-8ddb-56d55b52e1ae\"}', 0, NULL, 1551540944, 1551540944),
(515, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendVerificationEmailJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendVerificationEmailJob\\\":10:{s:5:\\\"\\u0000*\\u0000to\\\";s:15:\\\"ulc@gmail.comrt\\\";s:10:\\\"\\u0000*\\u0000to_name\\\";s:28:\\\"Kakooza & Sons Egg Suppliers\\\";s:7:\\\"\\u0000*\\u0000data\\\";a:2:{s:3:\\\"otp\\\";s:13:\\\"WATL_F0170141\\\";s:4:\\\"uuid\\\";s:36:\\\"9dfa7f90-3d02-11e9-a352-1867b0984547\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"telescope_uuid\":\"8d1ca539-aca2-4f00-9b2b-5a784347b0b8\"}', 0, NULL, 1551541706, 1551541706);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practice_groups`
--

CREATE TABLE `practice_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practice_groups`
--

INSERT INTO `practice_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Banking & Finance', NULL, NULL),
(2, 'Litigation', NULL, NULL),
(3, 'Corporate & Commercial', NULL, NULL),
(4, 'Intellectual Property', NULL, NULL),
(5, 'Product Liability', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `firm_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `firm_id`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Perfoms the system administartive tasks of the law firm', 'WATL_E65E75A5', NULL, NULL),
(2, 'Associate', 'Normal Laywer roles', 'WATL_E65E75A5', NULL, NULL),
(3, 'Partner', 'Privilleged User', 'WATL_E65E75A5', NULL, NULL),
(4, 'Finance Controller', 'Handles Law firm Finance roles', 'WATL_E65E75A5', NULL, NULL),
(5, 'Comptroller', 'quuntur necessitatibus vestibulum. Ac vestibulum? Lectus! Nam, augue nulla nulla eligendi sociis, eum eros totam aliqu', 'WATL_8E88BA66', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `user_role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firm_id` text COLLATE utf8mb4_unicode_ci,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `email`, `password`, `contact`, `date_of_birth`, `profile_pic`, `date_of_reg`, `gender`, `department`, `user_role`, `account_status`, `verification_status`, `firm_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Alvin', 'Nader', 'Mukiibi', 'ulc@gmail.com', '$2y$10$IQZMM4ldIKzoriIKYtRotOzn.YtHPK3aFRSB2hF42NAA23e.jD.UC', '+2632888528145', '1941-02-17', 'cumque', '2019-03-28 13:19:07', 'Male', NULL, 'ulc', 'active', NULL, NULL, 'f1IDp1XKPLNHMsoqsCN8KhMx9D6qBhHZ6GZF3BGqSKePJZVmXFND1AgFihEE', '2019-02-25 08:36:53', '2019-02-25 08:36:53'),
(9, 'Alvinv', NULL, 'Mukiibi', 'ssempala@gmail.com', '$2y$10$VKwqbekrThc9U.xrJJyW3u0ler6SEbdzv4gmV8EzqlzGKD0pOgAA2', '2567538475633', NULL, NULL, '2019-03-28 13:15:08', NULL, NULL, 'administrator', 'active', NULL, 'WATL_E65E75A5', 'kK4teptgzwEkMFPXKxpr6mWdYO3IsYNRJO2urGmlg3wZByxQWDATUiPlfQSi', '2019-03-05 12:52:27', '2019-03-05 12:52:27'),
(10, 'Alvin', NULL, 'Mukiibi', 'mukikelly792@gmail.com', '$2y$10$9JGck4jbuBULi2b.X0n1xuUjhPGXwtY0gD82VrsBbDQjP0lcLAIBW', '256753847633', NULL, NULL, '2019-03-28 12:42:51', 'Male', 2, 'Partner', 'active', 'unverified', 'WATL_E65E75A5', NULL, NULL, NULL),
(11, 'Leanne', NULL, 'Graham', 'stephon26@example.orgyfh', '$2y$10$KtAwbssMPCnCf75QResMp.IYBoEn0EXIPhwzr/RMQPrxxSDkBlxuK', '555', NULL, NULL, '2019-03-28 13:26:12', 'Male', 1, 'Associate', 'active', 'unverified', 'WATL_E65E75A5', NULL, NULL, NULL),
(12, 'Fred', NULL, 'Sentomero', 'osh@co.ug', '$2y$10$z/65eC2lr/Q5KQDqR39G/.JmXjO2Wn9ENMF5Uwt1fKQ79tvCw1ClG', '0753896352', NULL, NULL, '2019-03-28 13:24:22', NULL, NULL, 'administrator', 'active', NULL, 'WATL_8E88BA66', 'WBPfdBHBsmFvaoQyf8goTy1CsMD83Feo8sVmZ5nYSjOS2dHRp8UlK76rNTq5', '2019-03-28 10:18:24', '2019-03-28 10:18:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `firms_email_unique` (`email`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practice_groups`
--
ALTER TABLE `practice_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
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
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `practice_groups`
--
ALTER TABLE `practice_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
