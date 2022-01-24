-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 11, 2022 at 12:52 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.20

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icoinphibit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ether` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bitcoin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fav_ico` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `captcha_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_ifsc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_coin_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_value` int DEFAULT NULL,
  `recaptcha_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha_private_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_supply` double(16,2) NOT NULL DEFAULT '0.00',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chat_script` text COLLATE utf8mb4_unicode_ci,
  `analytics_script` text COLLATE utf8mb4_unicode_ci,
  `contract_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_to_be_launched` date DEFAULT NULL,
  `white_paper` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google2fa_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google2fa_on` tinyint(1) NOT NULL DEFAULT '0',
  `transaction_hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_abi` text COLLATE utf8mb4_unicode_ci,
  `contract_network` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `admins`
--

TRUNCATE TABLE `admins`;
--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `ether`, `bitcoin`, `site_title`, `site_logo`, `fav_ico`, `captcha_key`, `account_name`, `account_number`, `account_ifsc`, `selling_coin_name`, `coin_value`, `recaptcha_public_key`, `recaptcha_private_key`, `total_supply`, `remember_token`, `created_at`, `updated_at`, `chat_script`, `analytics_script`, `contract_address`, `date_to_be_launched`, `white_paper`, `google2fa_secret`, `google2fa_on`, `transaction_hash`, `contract_abi`, `contract_network`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$Rqq8I1EJ.8qR2bK/Ynk6ROQvYgycNG//W9ZzgNsxjvkNi4ic1Kj6e', '0x3faA543fEdf1532e101ac6cF39Ba32406b97645D', '2N8hwP1WmJrFF5QWABn38y63uYLhnJYJYTF', 'ZDKL Ico', 'images/logo.png', 'images/fav_ico.png', '6LfkZlcUAAAAAGrES_YISMZ8Xfz33NKFFWoxtzaC', 'account_name', 'account_number', 'account_ifsc', 'ZDKL', 1, '6LfkZlcUAAAAAHc8UiYZMfoc-TDIR1llPfEYtZ_C', NULL, 100000000.00, 'cFxq8aIGinUY9vFOKxB1C7sHkGvDHTBLEXDUDYiO6CejegyZgZUbBCU4XBJz', '2021-11-28 15:16:59', '2021-11-28 15:16:59', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `admin_password_resets`
--

TRUNCATE TABLE `admin_password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `link_type` enum('link','html') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `cms`
--

TRUNCATE TABLE `cms`;
-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(8, '2018_04_17_082938_create_admins_table', 1),
(9, '2018_04_17_082939_create_admin_password_resets_table', 1),
(10, '2018_04_17_162708_create_transactions_table', 1),
(11, '2018_04_19_071439_create_notifications_table', 1),
(12, '2018_05_05_091201_add_in_transaction_table', 1),
(13, '2018_05_17_112625_create_cms_table', 1),
(14, '2018_05_17_142351_create_progress_bar_table', 1),
(15, '2018_05_18_074256_add_status_in_progress_bar', 1),
(16, '2018_05_19_141325_add_script_fields_added', 1),
(17, '2018_05_21_124434_add_progress_bar_date_in_progress_bar', 1),
(18, '2018_05_22_082154_add_contract_address_in_admon_table', 1),
(19, '2018_05_23_131100_update_transaction_description', 1),
(20, '2018_05_28_113033_add_admin_fields', 1),
(21, '2018_05_29_113936_add_otp_fields_in_admin_table', 1),
(22, '2018_06_13_071712_add_transaction_hash_field', 1),
(23, '2021_11_16_142113_create_wallets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_read` text COLLATE utf8mb4_unicode_ci,
  `is_read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `notifications`
--

TRUNCATE TABLE `notifications`;
-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `oauth_access_tokens`
--

TRUNCATE TABLE `oauth_access_tokens`;
-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `client_id` int NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
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

CREATE TABLE `oauth_clients` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int UNSIGNED NOT NULL,
  `client_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `oauth_personal_access_clients`
--

TRUNCATE TABLE `oauth_personal_access_clients`;
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

--
-- Truncate table before insert `oauth_refresh_tokens`
--

TRUNCATE TABLE `oauth_refresh_tokens`;
-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `progress_bar`
--

CREATE TABLE `progress_bar` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hint` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `progress_bar_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `progress_bar`
--

TRUNCATE TABLE `progress_bar`;
-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `send_amount` double(16,8) NOT NULL DEFAULT '0.00000000',
  `send_price` double(16,8) NOT NULL DEFAULT '0.00000000',
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_network` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receive_network` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_receive_amount` double(16,8) NOT NULL DEFAULT '0.00000000',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `txn_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screenshot` text COLLATE utf8mb4_unicode_ci,
  `ether` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_screenshot` text COLLATE utf8mb4_unicode_ci,
  `wallet_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cash_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `transactions`
--

TRUNCATE TABLE `transactions`;
--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `send_amount`, `send_price`, `symbol`, `transfer_network`, `receive_network`, `expected_receive_amount`, `status`, `txn_id`, `description`, `screenshot`, `ether`, `wallet_address`, `wallet_screenshot`, `wallet_name`, `new_transaction_id`, `created_at`, `updated_at`, `cash_type`, `currency`, `others`) VALUES
(1, 1, 1.00000000, 54266.70000000, 'btc', 'btc-chain', 'erc-20', 54266.70000000, 'complete', NULL, NULL, NULL, NULL, '1sdfdfkjkdflkjasdffdf', NULL, NULL, NULL, '2021-11-28 15:18:34', '2021-11-28 15:19:23', NULL, NULL, NULL),
(2, 1, 2.00000000, 4323.98000000, 'eth', 'btc-chain', 'bep-20', 8647.96000000, 'complete', NULL, NULL, NULL, NULL, '1234', NULL, NULL, NULL, '2021-11-29 14:56:46', '2021-11-29 14:58:23', NULL, NULL, NULL),
(3, 1, 700.00000000, 1.00000000, 'usdt', 'btc-chain', 'erc-20', 700.00000000, 'complete', NULL, NULL, NULL, NULL, '234', NULL, NULL, NULL, '2021-11-29 14:59:14', '2021-11-29 15:33:03', NULL, NULL, NULL),
(4, 1, 1.00000000, 57039.00000000, 'btc', 'btc-chain', 'erc-20', 57039.00000000, 'complete', NULL, NULL, NULL, NULL, '123344556', NULL, NULL, NULL, '2021-11-29 15:28:45', '2021-11-29 15:33:23', NULL, NULL, NULL),
(5, 1, 1.00000000, 49708.10000000, 'btc', 'btc-chain', 'ipb-chain', 49708.10000000, 'complete', NULL, NULL, NULL, NULL, '233', NULL, NULL, NULL, '2021-12-05 12:37:02', '2021-12-05 12:38:54', NULL, NULL, NULL),
(6, 1, 0.00200000, 49722.60000000, 'btc', 'btc-chain', 'erc-20', 99.44520000, 'pending', NULL, NULL, NULL, NULL, 'asdasd', NULL, NULL, NULL, '2021-12-09 04:36:22', '2021-12-09 04:38:31', NULL, NULL, NULL),
(7, 1, 100.00000000, 49795.30000000, 'btc', 'btc-chain', 'bep-20', 49795.30000000, 'cancel', NULL, NULL, NULL, NULL, '1a', NULL, NULL, NULL, '2021-12-09 04:51:45', '2021-12-09 05:39:32', NULL, NULL, NULL),
(8, 1, 23.00000000, 1.00000000, 'usdt', 'btc-chain', 'erc-20', 23.00000000, 'pending', NULL, NULL, NULL, NULL, '123', NULL, NULL, NULL, '2021-12-09 05:39:47', '2021-12-09 05:39:56', NULL, NULL, NULL),
(9, 1, 23.00000000, 4389.42000000, 'eth', 'btc-chain', 'erc-20', 100956.66000000, 'complete', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, '2021-12-09 05:40:13', '2022-01-06 05:53:03', NULL, NULL, NULL),
(10, 1, 12.00000000, 49796.50000000, 'btc', 'btc-chain', 'erc-20', 597558.00000000, 'cancel', NULL, NULL, NULL, NULL, '123', NULL, NULL, NULL, '2021-12-09 06:03:01', '2021-12-09 06:10:11', NULL, NULL, NULL),
(11, 1, 0.00500000, 43155.00000000, 'btc', 'btc-chain', 'erc-20', 215.77500000, 'complete', NULL, NULL, NULL, NULL, 'iuhfhy298h3xuiiwnfjksdnfjaiuad', NULL, NULL, NULL, '2022-01-06 05:30:48', '2022-01-06 05:53:09', NULL, NULL, NULL),
(12, 1, 12.00000000, 1.00000000, 'usdt', 'ipb-chain', 'erc-20', 12.00000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-06 05:33:42', '2022-01-06 05:33:42', NULL, NULL, NULL),
(13, 1, 1.00000000, 0.00000000, 'btc', 'btc-chain', 'erc-20', 0.00000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-06 05:47:37', '2022-01-06 05:47:37', NULL, NULL, NULL),
(14, 1, 1.00000000, 0.00000000, 'btc', 'btc-chain', 'erc-20', 0.00000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-06 05:48:19', '2022-01-06 05:48:19', NULL, NULL, NULL),
(15, 1, 1.00000000, 43007.20000000, 'btc', 'btc-chain', 'erc-20', 43007.20000000, 'complete', NULL, NULL, NULL, NULL, 'ii', NULL, NULL, NULL, '2022-01-06 05:50:50', '2022-01-06 05:53:12', NULL, NULL, NULL),
(16, 1, 1.00000000, 43163.30000000, 'btc', 'btc-chain', 'erc-20', 43163.30000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-06 06:20:34', '2022-01-06 06:20:34', NULL, NULL, NULL),
(17, 1, 1.00000000, 43021.30000000, 'btc', 'btc-chain', 'erc-20', 43021.30000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-06 06:47:54', '2022-01-06 06:47:54', NULL, NULL, NULL),
(18, 1, 1.00000000, 43028.90000000, 'btc', 'btc-chain', 'erc-20', 43028.90000000, 'confirm', NULL, NULL, NULL, NULL, '12345', NULL, NULL, NULL, '2022-01-06 06:50:30', '2022-01-06 06:50:42', NULL, NULL, NULL),
(19, 1, 22.00000000, 1.00000000, 'usdt', 'btc-chain', 'erc-20', 22.00000000, 'pending', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, '2022-01-06 07:05:44', '2022-01-06 07:05:53', NULL, NULL, NULL),
(20, 1, 100.00000000, 42031.70000000, 'btc', 'btc-chain', 'erc-20', 42031.70000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 09:34:43', '2022-01-11 09:34:43', NULL, NULL, NULL),
(21, 1, 100.00000000, 42031.70000000, 'btc', 'btc-chain', 'erc-20', 42031.70000000, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 09:34:44', '2022-01-11 09:34:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` text COLLATE utf8mb4_unicode_ci,
  `more_address` text COLLATE utf8mb4_unicode_ci,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` int UNSIGNED DEFAULT NULL,
  `card_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_image_path` text COLLATE utf8mb4_unicode_ci,
  `selfie_image_path` text COLLATE utf8mb4_unicode_ci,
  `address_image_path` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kyc_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-verify',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `citizenship`, `phone_prefix`, `phone`, `street_address`, `more_address`, `district`, `city`, `country`, `zip_code`, `card_type`, `card_no`, `card_image_path`, `selfie_image_path`, `address_image_path`, `email`, `password`, `kyc_status`, `verified`, `verification_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'XX', '4', '44', '9999999999', NULL, NULL, NULL, NULL, '4', NULL, 3, '123123123455543234543434343', 'card_1_1639031877.png', NULL, NULL, 'user@email.com', '$2y$10$QWVhL5RiagSEJh5ebzG5oeXp2NZJmrXQKm2L4ufU3bbZrSOtratwe', 'verify', 1, NULL, 'rrOs3fJsQ6e4NcjJvoPYO4vM4NMrm20iXmLl8qhV8w7fZ4v0UOq0trWfKQji', '2021-11-28 15:16:59', '2022-01-06 06:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `network` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `wallets`
--

TRUNCATE TABLE `wallets`;
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
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
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
-- Indexes for table `progress_bar`
--
ALTER TABLE `progress_bar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_bar`
--
ALTER TABLE `progress_bar`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
