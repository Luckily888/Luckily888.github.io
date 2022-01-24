-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 15, 2022 at 06:31 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipbpay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `admins`
--

TRUNCATE TABLE `admins`;
--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@test.com', '$2y$10$uvN5ib7XQRSE0HEwJ3Cwou6AJ8RMf76MVr5rGeln/lxb.AB6CjMQa', NULL, '2019-07-26 09:31:37', '2021-02-23 05:32:32'),
(2, 'Admin David', 'd888777@icloud.com', '$2y$10$Rnnr1S8ulAIP0El.rY4NN.RFqdKxuElWi3mPScyaKchk0aU5Zyh3m', NULL, '2021-12-25 10:49:41', '2021-12-25 10:49:41'),
(3, 'Qi Admin', 'bandmaster_c@hotmail.com', '$2y$10$DNAJNy115KwiROPGymg.Le91t2iZfK.hsXKV8qlGXgK9lkoNH52mO', NULL, '2021-12-25 12:54:51', '2021-12-25 12:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
CREATE TABLE `borrows` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `loan_currency_id` bigint UNSIGNED NOT NULL,
  `loan_amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `collateral_currency_id` bigint UNSIGNED NOT NULL,
  `collateral_amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `borrow_period_id` bigint UNSIGNED NOT NULL,
  `percentage` double(14,8) NOT NULL DEFAULT '0.00000000',
  `period_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest_amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `end_period_amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `borrows`
--

TRUNCATE TABLE `borrows`;
--
-- Dumping data for table `borrows`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_periods`
--

DROP TABLE IF EXISTS `borrow_periods`;
CREATE TABLE `borrow_periods` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_amount` int NOT NULL,
  `period_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_percentage` double(14,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `borrow_periods`
--

TRUNCATE TABLE `borrow_periods`;
--
-- Dumping data for table `borrow_periods`
--

INSERT INTO `borrow_periods` (`id`, `name`, `period_amount`, `period_type`, `interest_percentage`, `created_at`, `updated_at`) VALUES
(1, '12 Months', 12, 'month', 8.00000000, '2021-03-25 13:09:54', '2021-03-25 13:09:54'),
(2, '24 Months', 24, 'month', 8.00000000, '2021-03-25 13:09:54', '2021-03-25 13:09:54'),
(3, '36 Months', 36, 'month', 8.00000000, '2021-03-25 13:09:54', '2021-03-25 13:09:54'),
(4, '48 Months', 48, 'month', 8.00000000, '2021-03-25 13:09:54', '2021-03-25 13:09:54'),
(5, '60 Months', 60, 'month', 8.00000000, '2021-03-25 13:09:54', '2021-03-25 13:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `convert_currency_id` int UNSIGNED DEFAULT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `companies`
--

TRUNCATE TABLE `companies`;
--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `activated`, `created_at`, `updated_at`, `address`, `convert_currency_id`, `token`) VALUES
(1, 'Elicoin Esports Betting', 0, '2019-02-26 13:05:00', NULL, '0245B919201E8E00B4332551E33B7C731910073D4FC33EDF011531B9FD507DC9FE', NULL, NULL),
(2, 'Blue chip poker', 1, '2019-02-26 13:05:00', NULL, NULL, NULL, NULL),
(3, 'Zeno suit', 0, '2019-02-26 13:05:00', NULL, NULL, NULL, NULL),
(4, 'BATTLE ANGELS INPHIBIT ESPORTS', 1, '2019-02-26 13:05:00', NULL, NULL, NULL, NULL),
(5, 'Vanilla Connect', 1, '2019-02-26 13:05:00', NULL, '03D6E7B6BCC49202FB59B8A771C568DED8BA62FB0763880624A01430C7C68B3B62', NULL, NULL),
(6, 'SPEKTRAL CBD HUB', 1, '2019-08-01 00:00:00', '2019-08-01 00:00:00', NULL, NULL, NULL),
(7, 'Verboden', 1, '2019-09-28 00:00:00', NULL, NULL, NULL, '$2y$10$vUhfnSBqRlRX0L.peWZrK.PD9r1BeEiJZDG8YVHc3UAIYjj4Om8.K');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
CREATE TABLE `credits` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_type_id` int UNSIGNED NOT NULL,
  `image_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int UNSIGNED DEFAULT NULL,
  `icon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `credits`
--

TRUNCATE TABLE `credits`;
--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `name`, `credit_type_id`, `image_path`, `desc`, `user_id`, `created_at`, `updated_at`, `currency_id`, `icon`) VALUES
(1, 'Dota2', 1, NULL, NULL, NULL, NULL, NULL, 16, 'dota2'),
(2, 'LOL', 1, NULL, NULL, NULL, NULL, NULL, 16, 'lol'),
(3, 'ROV', 1, NULL, NULL, NULL, NULL, NULL, 16, 'rov'),
(4, 'Esport', 1, NULL, NULL, NULL, NULL, NULL, 16, NULL),
(5, 'Poker', 1, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(6, 'EdgeTV Inc', 1, NULL, NULL, NULL, NULL, NULL, 21, NULL),
(7, 'Casino', 1, NULL, NULL, NULL, NULL, NULL, 23, NULL),
(8, 'Pachinko Youta Inc', 1, NULL, NULL, NULL, NULL, NULL, 33, 'pachinko'),
(9, 'Specktral Inc', 2, NULL, NULL, NULL, NULL, NULL, 14, NULL),
(10, 'CBD Future US', 2, NULL, NULL, NULL, NULL, NULL, 26, NULL),
(11, 'CBD Future Asia', 2, NULL, NULL, NULL, NULL, NULL, 25, NULL),
(12, 'MedicalT', 3, NULL, NULL, NULL, NULL, NULL, 34, NULL),
(13, 'IPB Inc', 4, NULL, NULL, NULL, NULL, NULL, 12, NULL),
(14, 'Provincial Electricity Authority (PEA)', 5, NULL, NULL, NULL, NULL, NULL, 35, 'pea'),
(15, 'Metropolitan Waterworks Authority (MWA)', 5, NULL, NULL, NULL, NULL, NULL, 35, 'mwa'),
(16, 'Gas Company', 5, NULL, NULL, NULL, NULL, NULL, 35, NULL),
(17, 'Fuel Station Thailand', 5, NULL, NULL, NULL, NULL, NULL, 35, NULL),
(18, 'Air Asia', 6, NULL, NULL, NULL, NULL, NULL, 36, NULL),
(19, 'Hotels', 6, NULL, NULL, NULL, NULL, NULL, 36, NULL),
(20, 'Golf', 7, NULL, NULL, NULL, NULL, NULL, 37, NULL),
(21, 'Fitness', 7, NULL, NULL, NULL, NULL, NULL, 37, NULL),
(22, 'Movies', 7, NULL, NULL, NULL, NULL, NULL, 37, NULL),
(23, 'Electronics', 7, NULL, NULL, NULL, NULL, NULL, 37, NULL),
(24, 'Fashion', 7, NULL, NULL, NULL, NULL, NULL, 24, NULL),
(25, 'Electric Bangkok', 5, NULL, NULL, NULL, NULL, NULL, 35, NULL),
(26, 'Electric Chiang Mai', 5, NULL, NULL, NULL, NULL, NULL, 35, NULL),
(27, 'Immigration', 8, NULL, NULL, NULL, NULL, NULL, 38, NULL),
(28, 'Trademarks & Patents', 8, NULL, NULL, NULL, NULL, NULL, 38, NULL),
(29, 'Civil', 8, NULL, NULL, NULL, NULL, NULL, 38, NULL),
(30, 'Criminal', 8, NULL, NULL, NULL, NULL, NULL, 38, NULL),
(31, 'Business & Compliance', 8, NULL, NULL, NULL, NULL, NULL, 38, NULL),
(32, 'Yamaha Bike Rental Inc', 6, NULL, NULL, NULL, NULL, NULL, 36, NULL),
(33, 'IPB Eagle Inc', 7, NULL, NULL, NULL, NULL, NULL, 39, NULL),
(35, 'Life Extension Inc', 3, NULL, NULL, NULL, NULL, NULL, 40, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_types`
--

DROP TABLE IF EXISTS `credit_types`;
CREATE TABLE `credit_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `credit_types`
--

TRUNCATE TABLE `credit_types`;
--
-- Dumping data for table `credit_types`
--

INSERT INTO `credit_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Game/Entertainment Credits', NULL, NULL),
(2, 'CBD Credits', NULL, NULL),
(3, 'Medical Tourism Credits', NULL, NULL),
(4, 'IEO/Crowdfunding Credits', NULL, NULL),
(5, 'Utility Credits', NULL, NULL),
(6, 'Travel Credits', NULL, NULL),
(7, 'Lifestyle Credits', NULL, NULL),
(8, 'Law Credits', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_users`
--

DROP TABLE IF EXISTS `credit_users`;
CREATE TABLE `credit_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `credit_id` bigint UNSIGNED NOT NULL,
  `balance` double(14,8) NOT NULL DEFAULT '0.00000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `credit_users`
--

TRUNCATE TABLE `credit_users`;
--
-- Dumping data for table `credit_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conversion` double(14,8) NOT NULL DEFAULT '1.00000000',
  `isDevvio` tinyint(1) NOT NULL DEFAULT '0',
  `devID` decimal(20,0) DEFAULT NULL,
  `isERC20` tinyint(1) NOT NULL DEFAULT '0',
  `symbol_api` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_virtual` int NOT NULL DEFAULT '0',
  `is_fiat` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `currencies`
--

TRUNCATE TABLE `currencies`;
--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `created_at`, `updated_at`, `conversion`, `isDevvio`, `devID`, `isERC20`, `symbol_api`, `is_virtual`, `is_fiat`) VALUES
(1, 'Bitcoin', 'btc', NULL, '2022-01-15 06:30:42', 43025.11500000, 0, NULL, 0, NULL, 0, 0),
(2, 'Bluechip Token', 'blu', NULL, '2019-07-26 09:35:42', 10.00000000, 0, NULL, 1, NULL, 0, 0),
(4, 'Ethereum', 'eth', NULL, '2022-01-15 06:30:42', 3316.31000000, 0, NULL, 0, NULL, 0, 0),
(5, 'Lite Coin', 'ltc', NULL, '2022-01-15 06:30:42', 148.76000000, 0, NULL, 0, NULL, 0, 0),
(6, 'EOS', 'eos', NULL, '2022-01-15 06:30:43', 2.86500000, 0, NULL, 0, NULL, 0, 0),
(7, 'Bitcoin cash', 'bch', NULL, '2022-01-15 06:30:43', 388.05000000, 0, NULL, 0, NULL, 0, 0),
(8, 'CBD Token', 'cbd', '2019-08-01 06:45:50', '2019-08-01 06:45:50', 1.00000000, 0, NULL, 1, NULL, 0, 0),
(9, 'BlueIPB', 'bluipb', '2019-08-07 00:00:00', '2019-08-23 02:35:39', 10.00000000, 1, '23448491045770499', 0, NULL, 0, 0),
(10, 'CMULightening', 'cmul', '2019-08-07 00:00:00', NULL, 1.00000000, 1, '23448491045770500', 0, NULL, 0, 0),
(11, 'E-Donation Coin', 'edipb', '2019-08-07 00:00:00', NULL, 1.00000000, 1, '23448491045770501', 0, NULL, 0, 0),
(12, 'IPB2', 'ipb2', NULL, NULL, 5.00000000, 1, '23448491045770502', 0, NULL, 0, 0),
(13, 'USD IPB', 'usdipb', '2019-08-07 00:00:00', '2019-08-14 07:35:33', 1.00000000, 1, '23448491045770503', 0, NULL, 0, 1),
(14, 'CBD IPB', 'cbdipb', '2019-08-07 00:00:00', '2019-08-15 05:08:28', 5.00000000, 1, '23448491045770504', 0, NULL, 0, 0),
(15, 'Vote Coin', 'vcipb', NULL, NULL, 1.00000000, 1, '23448491045770505', 0, NULL, 0, 0),
(16, 'Elicoin', 'elc', '2019-08-10 00:00:00', NULL, 1.00000000, 1, '23448491045770506', 0, NULL, 0, 0),
(17, 'MOP IPB', 'mopipb', '2019-08-19 14:42:27', '2022-01-15 06:30:45', 0.12474600, 1, '23448491045770508', 0, 'mop', 0, 1),
(18, 'HKD IPB', 'hkdipb', '2019-08-19 14:42:53', '2022-01-15 06:30:45', 0.12845380, 1, '23448491045770509', 0, 'hkd', 0, 1),
(19, 'THB IPB', 'thbipb', '2019-08-19 14:43:49', '2022-01-15 06:30:47', 0.03014325, 1, '23448491045770510', 0, 'thb', 0, 1),
(20, 'GBP IPB', 'gbpipb', '2019-08-19 14:44:29', '2022-01-15 06:30:48', 1.36754942, 1, '23448491045770511', 0, 'gbp', 0, 1),
(21, 'EDGE TV', 'edge', '2019-08-21 15:36:53', '2019-08-21 15:36:53', 1.00000000, 0, NULL, 1, NULL, 1, 0),
(23, 'Elicoin Red', 'elcred', '2019-08-21 15:36:53', '2019-08-21 15:36:53', 1.00000000, 0, NULL, 1, NULL, 1, 0),
(24, 'Chiang Mai Connect', 'CMC', '2019-08-30 02:58:38', '2022-01-11 10:30:13', 1.00000000, 1, '23448491045770515', 0, NULL, 0, 0),
(25, 'CBD Asia', 'cbdasia', '2019-08-21 15:36:53', '2019-08-21 15:36:53', 4.00000000, 0, NULL, 1, NULL, 1, 0),
(26, 'CBD US', 'cbdus', '2019-08-21 15:36:53', '2019-08-21 15:36:53', 4.00000000, 0, NULL, 1, NULL, 1, 0),
(27, 'Utility Phitech IPB', 'UIPB', '2019-08-21 15:36:53', '2022-01-11 10:29:30', 1.00000000, 0, NULL, 1, NULL, 1, 0),
(31, 'JPY IPB', 'jpyipb', '2019-11-02 15:58:59', '2022-01-11 10:24:07', 1.00000000, 1, '23448491045770516', 0, NULL, 0, 1),
(32, 'Blockchain Cafe', '', '2019-11-02 16:23:31', '2022-01-07 04:35:48', 1.00000000, 0, NULL, 0, NULL, 0, 1),
(33, 'Pachinko Youta', 'py', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(34, 'Medical', 'mc', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(35, 'Utility', 'uc', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(36, 'Travel', 'tc', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(37, 'Lifestyle', 'lc', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(38, 'Law', 'lwc', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(39, 'IPB Eagle', 'ec', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 0),
(40, 'Life Extension', 'lex', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770518', 0, NULL, 0, 0),
(41, 'Game Development', 'gameipb', '2020-05-01 14:05:10', '2020-05-01 14:05:12', 1.00000000, 1, '23448491045770518', 0, NULL, 0, 0),
(42, 'Gold IPB (TBA)', 'goldipb', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 1),
(43, 'EUR IPB', 'euripb', '2019-11-02 16:23:31', '2022-01-11 10:23:01', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 1),
(44, 'SGD IPB', 'sgdipb', '2019-11-02 16:23:31', '2022-01-11 10:23:19', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 1),
(45, 'KRW IPB', 'krwipb', '2019-11-02 16:23:31', '2022-01-11 10:23:42', 1.00000000, 1, '23448491045770517', 0, NULL, 0, 1),
(46, 'USDT', 'usdt', '2019-11-02 16:23:31', '2019-11-02 16:23:31', 1.00000000, 1, '23448491045770517', 1, NULL, 0, 0),
(47, 'ZDKL', 'zdkl', '2019-08-21 15:36:53', '2019-08-21 15:36:53', 1.00000000, 0, NULL, 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `devvio_histories`
--

DROP TABLE IF EXISTS `devvio_histories`;
CREATE TABLE `devvio_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `uid` int NOT NULL,
  `amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coin_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `devvio_histories`
--

TRUNCATE TABLE `devvio_histories`;
--
-- Dumping data for table `devvio_histories`
--

-- --------------------------------------------------------

--
-- Table structure for table `donates`
--

DROP TABLE IF EXISTS `donates`;
CREATE TABLE `donates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED DEFAULT NULL,
  `start_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `donates`
--

TRUNCATE TABLE `donates`;
--
-- Dumping data for table `donates`
--

INSERT INTO `donates` (`id`, `name`, `image_path`, `desc`, `user_id`, `start_datetime`, `end_datetime`, `created_at`, `updated_at`) VALUES
(1, 'CMU Life Extension Research Center', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(2, 'Zeno London Mayor Campaign', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(3, 'CMU Blockchain Research', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(4, 'Donate Republican Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(5, 'Donate Democratic Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(6, 'Donate Thailand New Future Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(7, 'Donate Thailand Palang Pracharath Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(8, 'Donate Thailand Bhum Jai Thai Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(9, 'Donate Japan Liberal Democratic Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(10, 'Donate South Korea Democratic Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL),
(11, 'Donate UK Conservative Party', NULL, ' ', NULL, '2020-11-01 05:34:28', '2020-11-30 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donate_users`
--

DROP TABLE IF EXISTS `donate_users`;
CREATE TABLE `donate_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `donate_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `ref` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `note` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `donate_users`
--

TRUNCATE TABLE `donate_users`;
--
-- Dumping data for table `donate_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `exchange_transactions`
--

DROP TABLE IF EXISTS `exchange_transactions`;
CREATE TABLE `exchange_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `from_currency_id` int NOT NULL,
  `from_currency_amount` double(14,8) NOT NULL,
  `from_currency_before` double(14,8) NOT NULL,
  `from_currency_after` double(14,8) NOT NULL,
  `from_currency_conversion` double(14,8) NOT NULL DEFAULT '1.00000000',
  `to_currency_id` int NOT NULL,
  `to_currency_amount` double(14,8) NOT NULL,
  `to_currency_before` double(14,8) NOT NULL,
  `to_currency_after` double(14,8) NOT NULL,
  `to_currency_conversion` double(14,8) NOT NULL DEFAULT '1.00000000',
  `uid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `exchange_transactions`
--

TRUNCATE TABLE `exchange_transactions`;
--
-- Dumping data for table `exchange_transactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE `histories` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` int NOT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(14,8) NOT NULL,
  `currency_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uid` int NOT NULL,
  `method` enum('payment','transfer','credit-payment') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tnx_id` bigint DEFAULT NULL,
  `receiver` bigint DEFAULT NULL,
  `convert_currency_id` int UNSIGNED DEFAULT NULL,
  `convert_amount` double(14,8) DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `histories`
--

TRUNCATE TABLE `histories`;
--
-- Dumping data for table `histories`
--

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

DROP TABLE IF EXISTS `kycs`;
CREATE TABLE `kycs` (
  `id` int UNSIGNED NOT NULL,
  `uid` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `id_card` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `verified` tinyint(1) DEFAULT NULL,
  `verified_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `id_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `kycs`
--

TRUNCATE TABLE `kycs`;
--
-- Dumping data for table `kycs`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_07_08_072956_create_wallets_table', 1),
(9, '2019_07_08_075131_create_currencies_table', 1),
(10, '2019_07_09_093736_create_companies_table', 1),
(11, '2019_07_10_085821_create_notifications_table', 1),
(12, '2019_07_10_085859_add_balance_to_wallets_table', 1),
(13, '2019_07_11_051304_create_histories_table', 1),
(14, '2019_07_11_052613_add_uid_to_histories_table', 1),
(15, '2019_07_12_045323_create_transactions_table', 1),
(16, '2019_07_12_054015_add_uid_to_transactions_table', 1),
(17, '2019_07_25_043459_create_admins_table', 1),
(18, '2019_07_25_083835_add_timestamp_to_currencies_table', 1),
(19, '2019_07_26_050416_add_currency_to_transactions_table', 1),
(20, '2019_07_26_062942_add_conversion_to_currencies_table', 1),
(21, '2019_08_07_084347_add_password_dev_to_users_table', 1),
(22, '2019_08_07_090010_add_is_devvio_to_currencies_table', 1),
(23, '2019_08_08_061242_add_uuid_to_users_table', 1),
(24, '2019_08_09_110532_add_address_to_companies_table', 1),
(25, '2019_08_10_060058_create_devvio_histories_table', 1),
(26, '2019_08_10_084352_add_coin_id_to__devvio_history_table', 1),
(27, '2019_08_13_091259_add_link_to_notifications_table', 1),
(28, '2019_08_15_072453_add_method_to_histories_table', 1),
(29, '2019_08_21_162100_add_is_e_r_c20_to_currencies_table', 1),
(30, '2019_08_22_100101_add_convert_currency_id_to_companies', 1),
(31, '2019_08_24_062343_add_symbol_api_to_currencies_table', 1),
(32, '2019_08_26_085056_add_is_virtual_to_currencies', 2),
(34, '2019_09_26_102940_create_exchange_transactions_table', 4),
(35, '2019_09_28_151747_add_token_to_companies_table', 5),
(36, '2019_09_21_063434_create_kyc_table', 6),
(37, '2019_10_18_041305_add_kyc_field_to_users', 6),
(38, '2019_11_04_054212_add_note_to_histories', 7),
(39, '2020_02_13_130757_create_vote_headers_table', 8),
(40, '2020_02_13_131235_create_vote_choices_table', 8),
(41, '2020_02_13_131300_create_user_votes_table', 8),
(42, '2020_02_13_140306_add_dates_to_vote_headers', 9),
(43, '2020_02_13_143211_add_vote_header_id_to_user_votes', 10),
(44, '2020_02_17_110824_create_donates_table', 11),
(46, '2020_02_17_111316_create_donate_users_table', 12),
(47, '2020_02_18_071946_create_games_table', 13),
(48, '2020_02_18_072120_create_game_wallets_table', 13),
(49, '2020_02_18_085400_create_credit_types_table', 13),
(50, '2020_02_18_085451_create_credits_table', 13),
(51, '2020_02_18_085516_create_credit_users_table', 13),
(52, '2020_02_20_105534_add_currency_id_to_credits', 14),
(53, '2020_02_20_064851_add_icon_to_credits', 15),
(54, '2020_05_29_033547_add_unique_to_wallets', 16),
(56, '2020_06_11_023805_create_ref_token_sales_table', 17),
(57, '2020_06_23_034648_create_user_contacts_table', 18),
(58, '2020_11_26_054353_add_verification_fields_for_users', 19),
(59, '2020_12_17_051927_add_photo2_to_kycs_table', 20),
(60, '2021_02_03_072150_create_withdraws_table', 21),
(61, '2021_03_23_052521_create_borrows_table', 22),
(62, '2021_03_23_061841_create_borrow_periods_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `readed` tinyint(1) NOT NULL DEFAULT '0',
  `uid` int NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `notifications`
--

TRUNCATE TABLE `notifications`;
--
-- Dumping data for table `notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `oauth_auth_codes`
--

TRUNCATE TABLE `oauth_auth_codes`;
-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `oauth_clients`
--

TRUNCATE TABLE `oauth_clients`;
--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'XhUyviXs63XOLISp4EQjba0PK5xBQOdCpNmpnd8O', 'http://localhost', 1, 0, 0, '2019-08-26 13:22:54', '2019-08-26 13:22:54'),
(2, NULL, 'Laravel Password Grant Client', '3DXWHgbBrG18dJSm0EzTTP83mazFdGXI9wXjNLkc', 'http://localhost', 0, 1, 0, '2019-08-26 13:22:54', '2019-08-26 13:22:54'),
(3, NULL, 'Laravel Personal Access Client', '5hWpX1ntXPF40mOsasG4LBrmukfYXC9TfmPe1E3k', 'http://localhost', 1, 0, 0, '2020-01-21 10:29:23', '2020-01-21 10:29:23'),
(4, NULL, 'Laravel Password Grant Client', 'ZlOFzh5AC13gHdjohyRWytvaRxlSK6nQipDs7bLb', 'http://localhost', 0, 1, 0, '2020-01-21 10:29:27', '2020-01-21 10:29:27'),
(5, NULL, 'Laravel Personal Access Client', '9xChVyMzUbJHRLbh2xzjT1zt1IpEjN7ssf1KDvZe', 'http://localhost', 1, 0, 0, '2021-12-23 04:55:49', '2021-12-23 04:55:49'),
(6, NULL, 'Laravel Password Grant Client', 'lEOyN3MGiHNrLkGy9KAQocRIrn83d6BHvGRsht3P', 'http://localhost', 0, 1, 0, '2021-12-23 04:55:49', '2021-12-23 04:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int UNSIGNED NOT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `oauth_personal_access_clients`
--

TRUNCATE TABLE `oauth_personal_access_clients`;
--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-08-26 13:22:54', '2019-08-26 13:22:54'),
(2, 3, '2020-01-21 10:29:27', '2020-01-21 10:29:27'),
(3, 5, '2021-12-23 04:55:49', '2021-12-23 04:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `ref_token_sales`
--

DROP TABLE IF EXISTS `ref_token_sales`;
CREATE TABLE `ref_token_sales` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_raised` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_rate` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `ref_token_sales`
--

TRUNCATE TABLE `ref_token_sales`;
--
-- Dumping data for table `ref_token_sales`
--

INSERT INTO `ref_token_sales` (`id`, `name`, `image_path`, `symbol`, `status`, `use_raised`, `start_date`, `sale_price`, `currency_price`, `return_rate`, `created_at`, `updated_at`) VALUES
(1, 'Spectrecoin', '01_Spectrecoin.png', 'XSPEC', 'Completed ', '$15,427.00', 'Jan, 2017', '$0.001', '$0.225', '277.16x\r', NULL, NULL),
(2, 'Stratis', 'binance.png', 'STRAT', 'Completed ', '$600,945.00', 'Jul, 2016', '$0.007', '$1.543', '215.68x\r', NULL, NULL),
(3, 'NEO', '03_NEO.png', 'NEO', 'Completed ', '$3,758,871.00', 'Sep, 2016', '$0.188', '$22.140', '117.80x\r', NULL, NULL),
(4, 'Antshares', '04_Antshares.png', 'NEO', 'Completed ', '$15,427.00', 'Sep, 2016', '$0.188', '$19.103', '101.64x\r', NULL, NULL),
(5, 'Ark', '05_Ark.png', 'ARK', 'Completed ', '$942,593.00', 'Dec, 2016', '$0.761', '$0.728', '73.15x\r', NULL, NULL),
(6, 'Komodo', '06_Komodo.png', 'KMD', 'Completed ', '$1,983,781.00', 'Nov, 2016', '$0.022', '$1.163', '52.75x\r', NULL, NULL),
(7, 'Lisk', '07_Lisk.png', 'LSK', 'Completed ', '$6,500,000.00', 'Mar, 2016', '$0.076', '$3.483', '45.55x\r', NULL, NULL),
(8, 'Storj-x', '08_Storj-x.png', 'SJCX', 'Completed ', '$461,802.00', 'Aug, 2014', '$0.009', '$0.267', '29.53x\r', NULL, NULL),
(9, 'Aeternity - Phase 1', '09_Aeternity - Phase 1.png', 'AE', 'Completed ', '$5,800,000.00', 'Apr, 2017', '$0.042', '$1.180', '28.30x\r', NULL, NULL),
(10, 'Augur', '10_Augur.png', 'REP', 'Completed ', '$5,300,000.00', 'Oct, 2015', '$0.602', '$13.590', '22.57x\r', NULL, NULL),
(11, 'Bitquence', '11_Bitquence.png', 'ETHOS', 'Completed ', '$2,266,876.00', 'Jul, 2017', '$0.033', '$0.510', '15.45x\r', NULL, NULL),
(12, 'Golem', '12_Golem.png', 'GNT', 'Completed ', '$8,596,000.00', 'Nov, 2016', '$0.010', '$0.145', '13.80x\r', NULL, NULL),
(13, '0X', '13_0X.png', 'ZRX', 'Completed ', '$24,000,000.00', 'Aug, 2017', '$0.048', '$0.615', '12.82x\r', NULL, NULL),
(14, 'Qtum', '14_Qtum.png', 'QTUM', 'Completed ', '$15,664,829.00', 'Apr, 2017', '$0.307', '$3.917', '12.75x\r', NULL, NULL),
(15, 'Augmentors', '15_Augmentors.png', 'DTB', 'Completed ', '$1,069,525.00', 'Feb, 2017', '$0.015', '$0.194', '12.67x\r', NULL, NULL),
(16, 'DigixDAO', '16_DigixDAO.png', 'DGD', 'Completed ', '$5,500,000.00', 'Mar, 2016', '$3.235', '$40.511', '12.52x\r', NULL, NULL),
(17, 'Waves', '17_Waves.png', 'WAVES', 'Completed ', '$16,010,008.00', 'May, 2016', '$0.188', '$2.179', '11.57x\r', NULL, NULL),
(18, 'Genesis Vision', '18_Genesis Vision.png', 'GVT', 'Completed ', '$2,836,724.00', 'Nov, 2017', '$0.761', '$8.801', '11.56x\r', NULL, NULL),
(19, 'Omise GO', '19_Omise GO.png', 'OMG', 'Completed ', '$25,000,000.00', 'Jun, 2017', '$0.326', '$3.667', '11.25x\r', NULL, NULL),
(20, 'Neblio', '20_Neblio.png', 'NEBL', 'Completed ', '$2,102,281.00', 'Aug, 2017', '$0.178', '$1.936', '10.91x\r', NULL, NULL),
(21, 'Populous', '21_Populous.png', 'PPT', 'Completed ', '$10,842,332.00', 'Jun, 2017', '$0.301', '$3.198', '10.62x\r', NULL, NULL),
(22, 'Zilliqa', '22_Zilliqa.png', 'ZIL', 'Completed ', '$22,000,000.00', 'Jan, 2018', '$0.003', '$0.036', '10.28x\r', NULL, NULL),
(23, 'Etheroll', '23_Etheroll.png', 'DICE', 'Completed ', '$304,295.00', 'Feb, 2017', '$0.068', '$0.577', '8.53x\r', NULL, NULL),
(24, 'Bitcrystals (Spells of Genesis)', '24_Bitcrystals.png', 'BCY', 'Completed ', '$200,000.00', 'Sep, 2015', '$0.015', '$0.101', '6.84x\r', NULL, NULL),
(25, 'Beyond the Void', '25_Beyond the Void.png', 'NXC', 'Completed ', '$115,500.00', 'Nov, 2016', '$0.004', '$0.027', '6.69x\r', NULL, NULL),
(26, 'ICON', '26_ICON.png', 'ICX', 'Completed ', '$42,561,000.00', 'Sep, 2017', '$0.106', '$0.688', '6.47x\r', NULL, NULL),
(27, 'Metal', '27_Metal.png', 'MTL', 'Completed ', '$1,945,000.00', 'Mar, 2017', '$0.118', '$0.702', '5.96x\r', NULL, NULL),
(28, 'VibeHub', '28_VibeHub.png', 'VIBE', 'Completed ', '$1,435,724.00', 'Sep, 2017', '$0.020', '$0.102', '5.14x\r', NULL, NULL),
(29, 'Wings', '29_Wings.png', 'WINGS', 'Completed ', '$2,074,000.00', 'Jan, 2017', '$0.028', '$0.137', '4.97x\r', NULL, NULL),
(30, 'Tokes', '30_Tokes.png', 'TKS', 'Completed ', '$81,100.00', 'Jan, 2017', '$0.125', '$0.613', '4.90x\r', NULL, NULL),
(31, 'Basic Attention Token', '31_Basic Attention Token.png', 'BAT', 'Completed ', '$36,000,000.00', 'May, 2017', '$0.036', '$0.175', '4.87x\r', NULL, NULL),
(32, 'Internxt', '32_Internxt.png', 'INXT', 'Completed ', '$209,405.00', 'Sep, 2017', '$0.644', '$3.055', '4.74x\r', NULL, NULL),
(33, 'Dent', '33_Dent.png', 'DENT', 'Completed ', '$4,386,168.00', 'Jul, 2017', '$0.000', '$0.002', '4.74x\r', NULL, NULL),
(34, 'Dragonchain', '34_Dragonchain.png', 'DRGN', 'Completed ', '$13,179,332.00', 'Nov, 2017', '$0.055', '$0.258', '4.67x\r', NULL, NULL),
(35, 'Edgeless', '35_Edgeless.png', 'EDG', 'Completed ', '$2,700,000.00', 'Mar, 2017', '$0.039', '$0.180', '4.60x\r', NULL, NULL),
(36, 'Particl', '36_Particl.png', 'PART', 'Completed ', '$688,849.00', 'Apr, 2017', '$0.582', '$2.648', '4.55x\r', NULL, NULL),
(37, 'Quarkchain', '37_Quarkchain.png', 'QKC', 'Completed ', '$20,000,000.00', 'Jun, 2018', '$0.010', '$0.041', '4.06x\r', NULL, NULL),
(38, 'ChainLink', '38_ChainLink.png', 'LINK', 'Completed ', '$32,000,000.00', 'Sep, 2017', '$0.091', '$0.338', '3.69x\r', NULL, NULL),
(39, 'Tezos', '39_Tezos.png', 'XTZ', 'Completed ', '$230,607,347.00', 'Jul, 2017', '$0.470', '$1.688', '3.59x\r', NULL, NULL),
(40, 'Aeternity - Phase 2', '40_Aeternity - Phase 2.png', 'AE', 'Completed ', '$24,990,653.00', 'Jun, 2017', '$0.284', '$1.006', '3.55x\r', NULL, NULL),
(41, 'Iconomi', '41_Iconomi.png', 'ICN', 'Completed ', '$10,682,516.00', 'Sep, 2016', '$0.126', '$0.417', '3.32x\r', NULL, NULL),
(42, 'Wanchain', '42_Wanchain.png', 'WAN', 'Completed ', '$35,704,520.00', 'Oct, 2017', '$0.309', '$1.008', '3.26x\r', NULL, NULL),
(43, 'Veritaseum', '43_Veritaseum.png', 'VERI', 'Completed ', '$11,000,000.00', 'May, 2017', '$5.644', '$17.967', '3.18x\r', NULL, NULL),
(44, 'Wagerr', '44_Wagerr.png', 'WGR', 'Completed ', '$10,837,500.00', 'Jun, 2017', '$0.064', '$0.170', '2.67x\r', NULL, NULL),
(45, 'Matrix', '45_Matrix.png', 'MAN', 'Completed ', '$13,415,485.00', 'Jab, 2018', '$0.089', '$0.237', '2.65x\r', NULL, NULL),
(46, 'Decentraland', '46_Decentraland.png', 'MANA', 'Completed ', '$25,000,000.00', 'Aug, 2017', '$0.030', '$0.079', '2.63x\r', NULL, NULL),
(47, 'Peerplays', '47_Peerplays.png', 'PPY', 'Completed ', '$500,000.00', 'May, 2017', '$0.526', '$1.313', '2.50x\r', NULL, NULL),
(48, 'Funfair', '48_Funfair.png', 'FUN', 'Completed ', '$26,000,000.00', 'Jun, 2017', '$0.007', '$0.018', '2.47x\r', NULL, NULL),
(49, 'Incent', '49_Incent.png', 'INCNT', 'Completed ', '$1,000,000.00', 'Sep, 2016', '$0.043', '$0.106', '2.45x\r', NULL, NULL),
(50, 'Electroneum', '50_Electroneum.png', 'ETN', 'Completed ', '$40,000,000.00', 'Oct, 2017', '$0.007', '$0.016', '2.45x\r', NULL, NULL),
(51, 'SunContract', '51_SunContract.png', 'SNC', 'Completed ', '$1,980,156.00', 'Aug, 2017', '$0.016', '$0.039', '2.39x\r', NULL, NULL),
(52, 'Substratum', '52_Substratum.png', 'SUB', 'Completed ', '$13,800,000.00', 'Sep, 2017', '$0.051', '$0.114', '2.26x\r', NULL, NULL),
(53, 'Quantum Resistant Ledger', '53_Quantum Resistant Ledger.png', 'QRL', 'Completed ', '$4,160,000.00', 'May, 2017', '$0.107', '$0.231', '2.17x\r', NULL, NULL),
(54, 'BlockV', '54_BlockV.png', 'VEE', 'Completed ', '$21,478,865.00', 'Oct, 2017', '$0.006', '$0.011', '1.87x\r', NULL, NULL),
(55, 'Santiment', '55_Santiment.png', 'SAN', 'Completed ', '$12,094,650.00', 'Jul, 2017', '$0.269', '$0.495', '1.84x\r', NULL, NULL),
(56, 'Mothership', '56_Mothership.png', 'MSP', 'Completed ', '$4,819,379.00', 'Jul, 2017', '$0.034', '$0.063', '1.83x\r', NULL, NULL),
(57, 'Cindicator', '57_Cindicator.png', 'CND', 'Completed ', '$15,000,000.00', 'Sep, 2017', '$0.013', '$0.024', '1.83x\r', NULL, NULL),
(58, 'The Divi Project', '58_The Divi Project.png', 'DIVX', 'Completed ', '$2,902,872.00', 'Nov, 2017', '$0.564', '$0.972', '1.72x\r', NULL, NULL),
(59, 'Decent', '59_Decent.png', 'DCT', 'Completed ', '$4,126,300.00', 'Nov, 2016', '$0.107', '$0.184', '1.72x\r', NULL, NULL),
(60, 'SingularDTV', '60_SingularDTV.png', 'SNGLS', 'Completed ', '$7,500,000.00', 'Oct, 2016', '$0.015', '$0.026', '1.72x\r', NULL, NULL),
(61, 'Coss', '61_Coss.png', 'COSS', 'Completed ', '$3,168,713.00', 'Sep, 2017', '$0.040', '$0.066', '1.67x\r', NULL, NULL),
(62, 'Power Ledger', '62_Power Ledger.png', 'POWR', 'Completed ', '$26,356,589.00', 'Oct, 2017', '$0.110', '$0.183', '1.67x\r', NULL, NULL),
(63, 'Ecobit', '63_Ecobit.png', 'ECOB', 'Completed ', '$4,500,000.00', 'Jun, 2017', '$0.010', '$0.017', '1.63x\r', NULL, NULL),
(64, 'Monaco', '64_Monaco.png', 'MCO', 'Completed ', '$26,954,906.00', 'Jun, 2017', '$2.844', '$4.640', '1.63x\r', NULL, NULL),
(65, 'Pundi X', '65_Pundi X.png', 'NPXS', 'Completed ', '$41,700,000.00', 'Jan, 2018', '$0.001', '$0.002', '1.56x\r', NULL, NULL),
(66, 'District0X', '66_District0X.png', 'DNT', 'Completed ', '$9,789,541.00', 'Aug, 2017', '$0.016', '$0.025', '1.54x\r', NULL, NULL),
(67, 'THETA', '67_THETA.png', 'THETA', 'Completed ', '$20,000,000.00', 'Jan, 2018', '$0.059', '$0.091', '1.54x\r', NULL, NULL),
(68, 'TomoChain', '68_TomoChain.png', 'TOMO', 'Completed ', '$8,500,000.00', 'Mar, 2018', '$0.170', '$0.257', '1.51x\r', NULL, NULL),
(69, 'Poet', '69_Poet.png', 'POE', 'Completed ', '$10,000,000.00', 'Aug, 2017', '$0.006', '$0.009', '1.46x\r', NULL, NULL),
(70, 'Enjin Coin', '70_Enjin Coin.png', 'ENJ', 'Completed ', '$22,953,541.00', 'Oct, 2017', '$0.031', '$0.045', '1.42x\r', NULL, NULL),
(71, 'Tokenomy', '71_Tokenomy.png', 'TEN', 'Completed ', '$12,965,992.00', 'Feb, 2018', '$0.118', '$0.163', '1.38x\r', NULL, NULL),
(72, 'Mainframe', '72_Mainframe.png', 'MFT', 'Completed ', '$25,656,000.00', 'Feb, 2018', '$0.005', '$0.007', '1.38x\r', NULL, NULL),
(73, 'Naga Group', '73_Naga Group.png', 'NGC', 'Completed ', '$50,020,960.00', 'Dec, 2017', '$0.227', '$0.298', '1.31x\r', NULL, NULL),
(74, 'Aurora', '74_Aurora.png', 'AURA', 'Completed ', '$5,308,131.00', 'Jan, 2018', '$0.066', '$0.086', '1.29x\r', NULL, NULL),
(75, 'Aragon', '75_Aragon.png', 'ANT', 'Completed ', '$25,000,000.00', 'May, 2017', '$0.744', '$0.929', '1.25x\r', NULL, NULL),
(76, 'ZrCoin', '76_ZrCoin.png', 'ZRC', 'Completed ', '$7,070,000.00', 'Jun, 2017', '$1.417', '$1.764', '1.24x\r', NULL, NULL),
(77, 'AppCoins', '77_AppCoins.png', 'APPC', 'Completed ', '$16,845,377.00', 'Dec, 2017', '$0.094', '$0.116', '1.24x\r', NULL, NULL),
(78, 'AdToken', '78_AdToken.png', 'ADT', 'Completed ', '$10,000,000.00', 'Jun, 2017', '$0.010', '$0.012', '1.22x\r', NULL, NULL),
(79, 'Hive Project', '79_Hive Project.png', 'HVN', 'Completed ', '$9,026,546.00', 'Aug, 2017', '$0.024', '$0.029', '1.21x\r', NULL, NULL),
(80, 'Civic', '80_Civic.png', 'CVC', 'Completed ', '$33,000,000.00', 'Jun, 2017', '$0.024', '$0.121', '1.21x\r', NULL, NULL),
(81, 'Boscoin', '81_Boscoin.png', 'BOS', 'Completed ', '$12,202,996.00', 'Jun, 2017', '$0.024', '$0.053', '1.21x\r', NULL, NULL),
(82, 'Bread', '82_Bread.png', 'BRD', 'Completed ', '$32,000,000.00', 'Dec, 2017', '$0.302', '$0.363', '1.20x\r', NULL, NULL),
(83, 'Metronome', '83_Metronome.png', 'MET', 'Completed ', '$10,242,818.00', 'Jun, 2018', '$1.280', '$1.529', '1.19x\r', NULL, NULL),
(84, 'Credits', '84_Credits.png', 'CS', 'Completed ', '$22,103,354.00', 'Feb ,2018', '$0.158', '$0.187', '1.18x\r', NULL, NULL),
(85, 'Golos', '85_Golos.png', 'GOLOS', 'Completed ', '$462,000.00', 'Dec, 2016', '$0.017', '$0.019', '1.13\r', NULL, NULL),
(86, 'Kyber Network', '86_Kyber Network.png', 'KNC', 'Completed ', '$49,304,000.00', 'Sep, 2017', '$0.357', '$0.402', '1.12x\r', NULL, NULL),
(87, 'Status', '87_Status.png', 'SNT', 'Completed ', '$107,664,904.00', 'Jun, 2017', '$0.036', '$0.039', '1.10x\r', NULL, NULL),
(88, 'Bluzelle', '88_Bluzelle.png', 'BLZ', 'Completed ', '$19,500,000.00', 'Jan, 2018', '$0.118', '$0.130', '1.10x\r', NULL, NULL),
(89, 'DeepBrain Chain', '89_DeepBrain Chain.png', 'DBC', 'Planned', '$12,000,000.00', 'Dec, 2018', '$0.008', '$0.009', '1.09x', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `txid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(14,8) NOT NULL,
  `blockNumber` int NOT NULL,
  `from` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `use` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uid` int NOT NULL,
  `currency` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `transactions`
--

TRUNCATE TABLE `transactions`;
--
-- Dumping data for table `transactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passwordDev` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_verified_at` timestamp NULL DEFAULT NULL,
  `phone_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `country_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

DROP TABLE IF EXISTS `user_contacts`;
CREATE TABLE `user_contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `contact_user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

DROP TABLE IF EXISTS `user_votes`;
CREATE TABLE `user_votes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `vote_choice_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `ref` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `note` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vote_header_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vote_choices`
--

DROP TABLE IF EXISTS `vote_choices`;
CREATE TABLE `vote_choices` (
  `id` bigint UNSIGNED NOT NULL,
  `vote_header_id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` double(8,2) NOT NULL DEFAULT '0.00',
  `count_user_vote` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `vote_choices`
--

TRUNCATE TABLE `vote_choices`;
--
-- Dumping data for table `vote_choices`
--

INSERT INTO `vote_choices` (`id`, `vote_header_id`, `name`, `desc`, `score`, `count_user_vote`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'yes', NULL, 0.00, 1, NULL, NULL, '2020-11-11 16:45:06'),
(2, 1, 'no', NULL, 0.00, 0, NULL, NULL, NULL),
(3, 2, 'yes', NULL, 0.00, 0, NULL, NULL, '2020-04-06 06:40:29'),
(4, 2, 'no', NULL, 0.00, 0, NULL, NULL, '2020-06-18 05:09:12'),
(5, 3, 'yes', NULL, 0.00, 0, NULL, NULL, '2020-04-06 07:10:53'),
(6, 4, 'yes', NULL, 0.00, 0, NULL, NULL, '2020-05-28 08:27:29'),
(7, 5, 'yes', NULL, 0.00, 1, NULL, NULL, '2020-11-11 05:28:06'),
(8, 3, 'no', NULL, 0.00, 0, NULL, NULL, '2020-04-08 08:03:35'),
(9, 4, 'no', NULL, 0.00, 0, NULL, NULL, NULL),
(10, 5, 'no', NULL, 0.00, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote_headers`
--

DROP TABLE IF EXISTS `vote_headers`;
CREATE TABLE `vote_headers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_datetime` timestamp NULL DEFAULT NULL,
  `end_datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `vote_headers`
--

TRUNCATE TABLE `vote_headers`;
--
-- Dumping data for table `vote_headers`
--

INSERT INTO `vote_headers` (`id`, `name`, `image_path`, `desc`, `user_id`, `created_at`, `updated_at`, `start_datetime`, `end_datetime`) VALUES
(1, 'Can Zeno Goldsmith win London Mayor election?', NULL, 'vote now ...', NULL, NULL, NULL, '2020-02-01 00:00:00', '2020-11-30 00:00:00'),
(2, 'Do you think Trump will win 2020?', NULL, 'vote now ...', NULL, NULL, NULL, '2020-02-01 00:00:00', '2020-11-30 00:00:00'),
(3, 'Do you agree with the UK digital asset regulation 105?', NULL, 'vote now ...', NULL, NULL, NULL, '2020-02-01 00:00:00', '2020-11-30 00:00:00'),
(4, 'Do you support 1 rai hemp grow for Thailand?', NULL, 'vote now ...', NULL, NULL, NULL, '2020-02-01 00:00:00', '2020-11-30 00:00:00'),
(5, 'Do you support Thailand digital innovation mandate?', NULL, 'vote now ...', NULL, NULL, NULL, '2020-02-01 00:00:00', '2020-11-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `uid` int NOT NULL,
  `currency` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `balance` double(14,8) NOT NULL DEFAULT '0.00000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

DROP TABLE IF EXISTS `withdraws`;
CREATE TABLE `withdraws` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `amount` double(14,8) NOT NULL DEFAULT '0.00000000',
  `balance_before` double(14,8) NOT NULL DEFAULT '0.00000000',
  `balance_after` double(14,8) NOT NULL DEFAULT '0.00000000',
  `receive_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve_user_id` bigint UNSIGNED DEFAULT NULL,
  `action_datetime` timestamp NULL DEFAULT NULL,
  `transaction_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrows_user_id_foreign` (`user_id`);

--
-- Indexes for table `borrow_periods`
--
ALTER TABLE `borrow_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credits_credit_type_id_foreign` (`credit_type_id`);

--
-- Indexes for table `credit_types`
--
ALTER TABLE `credit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_users`
--
ALTER TABLE `credit_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_users_user_id_foreign` (`user_id`),
  ADD KEY `credit_users_credit_id_foreign` (`credit_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devvio_histories`
--
ALTER TABLE `devvio_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donates`
--
ALTER TABLE `donates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donate_users`
--
ALTER TABLE `donate_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donate_users_user_id_foreign` (`user_id`),
  ADD KEY `donate_users_donate_id_foreign` (`donate_id`);

--
-- Indexes for table `exchange_transactions`
--
ALTER TABLE `exchange_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

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
-- Indexes for table `ref_token_sales`
--
ALTER TABLE `ref_token_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_contacts_user_id_foreign` (`user_id`),
  ADD KEY `user_contacts_contact_user_id_foreign` (`contact_user_id`);

--
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_votes_user_id_vote_choice_id_unique` (`user_id`,`vote_choice_id`),
  ADD KEY `user_votes_vote_choice_id_foreign` (`vote_choice_id`);

--
-- Indexes for table `vote_choices`
--
ALTER TABLE `vote_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vote_choices_vote_header_id_foreign` (`vote_header_id`);

--
-- Indexes for table `vote_headers`
--
ALTER TABLE `vote_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ux_uid_currency` (`uid`,`currency`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_user_id_foreign` (`user_id`),
  ADD KEY `withdraws_currency_id_foreign` (`currency_id`),
  ADD KEY `withdraws_wallet_id_foreign` (`wallet_id`),
  ADD KEY `withdraws_transaction_id_foreign` (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `credit_users`
--
ALTER TABLE `credit_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `devvio_histories`
--
ALTER TABLE `devvio_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `donates`
--
ALTER TABLE `donates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `donate_users`
--
ALTER TABLE `donate_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `exchange_transactions`
--
ALTER TABLE `exchange_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1243;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_token_sales`
--
ALTER TABLE `ref_token_sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628830;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_votes`
--
ALTER TABLE `user_votes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `vote_choices`
--
ALTER TABLE `vote_choices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vote_headers`
--
ALTER TABLE `vote_headers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7717;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `credits`
--
ALTER TABLE `credits`
  ADD CONSTRAINT `credits_credit_type_id_foreign` FOREIGN KEY (`credit_type_id`) REFERENCES `credit_types` (`id`);

--
-- Constraints for table `credit_users`
--
ALTER TABLE `credit_users`
  ADD CONSTRAINT `credit_users_credit_id_foreign` FOREIGN KEY (`credit_id`) REFERENCES `credits` (`id`),
  ADD CONSTRAINT `credit_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `donate_users`
--
ALTER TABLE `donate_users`
  ADD CONSTRAINT `donate_users_donate_id_foreign` FOREIGN KEY (`donate_id`) REFERENCES `donates` (`id`),
  ADD CONSTRAINT `donate_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD CONSTRAINT `user_contacts_contact_user_id_foreign` FOREIGN KEY (`contact_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD CONSTRAINT `user_votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_votes_vote_choice_id_foreign` FOREIGN KEY (`vote_choice_id`) REFERENCES `vote_choices` (`id`);

--
-- Constraints for table `vote_choices`
--
ALTER TABLE `vote_choices`
  ADD CONSTRAINT `vote_choices_vote_header_id_foreign` FOREIGN KEY (`vote_header_id`) REFERENCES `vote_headers` (`id`);

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `withdraws_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `withdraws_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
