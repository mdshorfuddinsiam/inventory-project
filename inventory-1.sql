-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 11:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cement', 5, NULL, 1, '2023-02-28 05:13:50', '2023-02-28 05:13:50'),
(2, 'LED TV', 5, NULL, 1, '2023-02-28 05:14:05', '2023-02-28 05:14:05'),
(3, 'Smart Phone', 5, NULL, 1, '2023-02-28 05:14:17', '2023-02-28 05:14:17'),
(4, 'Steel', 5, NULL, 1, '2023-02-28 05:14:33', '2023-02-28 05:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile_no`, `email`, `address`, `image`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Parvez', '017987654321', 'meru@mailinator.com', 'ppppppppppppppp', 'upload/customer-images/customer_image-63fccac36178c66227png', 5, 5, 0, '2023-02-27 09:22:43', '2023-02-28 05:12:54'),
(2, 'Tarek', '017123456789', 'wevesiby@mailinator.com', 'tttttttttttttttttttttttttttt', 'upload/customer-images/customer_image-63fce1861606a79760png', 5, 5, 1, '2023-02-27 10:59:50', '2023-02-28 05:12:29'),
(3, 'Siam', '01768553824', 'siam@mailinator.com', 'siiiiiiiiiiiiiiiiiiiiiiii', 'upload/customer-images/customer_image-63fde17a397fd8664png', 5, 5, 1, '2023-02-27 11:00:14', '2023-02-28 05:11:54'),
(5, 'Shorfuddin', '01768553823', 'shorfuddin@mailinator.com', 'sssssssssssssssss', 'upload/customer-images/customer_image-63fde143038de30411png', 5, 5, 1, '2023-02-27 11:05:14', '2023-02-28 05:11:18'),
(8, 'Tanvir', '01934181100', 'tanvir@gmail.com', NULL, NULL, NULL, NULL, 1, '2023-03-07 13:13:41', '2023-03-07 13:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE IF NOT EXISTS `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `short_title` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `title`, `short_title`, `video_url`, `image`, `created_at`, `updated_at`) VALUES
(1, 'eeeeeeeeeeee', 'ererererer', 'https://www.google.com/', 'upload/homeslider-images/image-1675106613.png', NULL, '2023-01-30 13:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, '1', '2023-03-07', 'DDDDDDDDDDD', 1, 5, 5, '2023-03-07 13:13:41', '2023-03-09 21:25:15'),
(7, '2', '2023-03-07', 'EEEEEEEEEEE', 1, 5, 5, '2023-03-07 13:15:50', '2023-03-15 11:12:06'),
(8, '3', '2023-03-09', 'XXXXXXXXXXXXXXXX', 0, 5, NULL, '2023-03-09 12:47:43', '2023-03-09 12:47:43'),
(10, '4', '2023-03-15', 'FFFFFFFFFFFFFFF', 1, 5, 5, '2023-03-15 11:15:02', '2023-03-15 11:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `selling_qty` double DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `date`, `category_id`, `product_id`, `selling_qty`, `unit_price`, `selling_price`, `status`, `created_at`, `updated_at`) VALUES
(8, 6, '2023-03-07', 3, 10, 1, 25000, 25000, 1, '2023-03-07 13:13:41', '2023-03-09 21:25:15'),
(9, 6, '2023-03-07', 1, 3, 5, 600, 3000, 1, '2023-03-07 13:13:41', '2023-03-09 21:25:15'),
(10, 7, '2023-03-07', 1, 3, 3, 700, 2100, 1, '2023-03-07 13:15:50', '2023-03-15 11:12:06'),
(11, 8, '2023-03-09', 2, 11, 2, 8000, 16000, 0, '2023-03-09 12:47:43', '2023-03-09 12:47:43'),
(13, 10, '2023-03-15', 1, 3, 10, 550, 5500, 1, '2023-03-15 11:15:02', '2023-03-15 11:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_28_095033_create_home_sliders_table', 2),
(6, '2023_02_23_113112_create_suppliers_table', 3),
(7, '2023_02_27_123446_create_cache_table', 4),
(8, '2023_02_27_135842_create_customers_table', 5),
(9, '2023_02_27_185017_create_units_table', 6),
(10, '2023_02_27_192206_create_units_table', 7),
(11, '2023_02_28_073713_create_categories_table', 8),
(12, '2023_02_28_095624_create_products_table', 9),
(13, '2023_03_01_172248_create_purchases_table', 10),
(14, '2023_03_06_145243_create_invoices_table', 11),
(15, '2023_03_06_150056_create_invoice_details_table', 12),
(16, '2023_03_06_150143_create_payments_table', 12),
(17, '2023_03_06_150231_create_payment_details_table', 12),
(18, '2023_03_06_161446_create_invoices_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('abc@gmail.com', '$2y$10$PeRofvMYfPvpfa3DtuGmruioVQGeWVU1T2uwgf0dSXFMOHRgWaxEu', '2023-01-30 12:41:11'),
('mdshorfuddinsiam6660@gmail.com', '$2y$10$LGjgYE4iZ6NYE1awyUg.H.gUUei6G08gIeGQkyk/7MvMGxJbZVlra', '2023-01-17 05:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `paid_status` varchar(51) DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `created_at`, `updated_at`) VALUES
(2, 6, 8, 'partial_paid', 21500, 4000, 25500, 2500, '2023-03-07 13:13:41', '2023-03-15 19:35:35'),
(3, 7, 3, 'full_due', 0, 2000, 2000, 100, '2023-03-07 13:15:50', '2023-03-07 13:15:50'),
(4, 8, 5, 'full_paid', 15500, 0, 15500, 500, '2023-03-09 12:47:43', '2023-03-09 12:47:43'),
(6, 10, 1, 'partial_paid', 3000, 2100, 5100, 400, '2023-03-15 11:15:02', '2023-03-15 11:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE IF NOT EXISTS `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `invoice_id`, `date`, `current_paid_amount`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 6, '2023-03-07', 20000, NULL, '2023-03-07 13:13:41', '2023-03-07 13:13:41'),
(3, 7, '2023-03-07', 0, NULL, '2023-03-07 13:15:50', '2023-03-07 13:15:50'),
(4, 8, '2023-03-09', 15500, NULL, '2023-03-09 12:47:43', '2023-03-09 12:47:43'),
(6, 10, '2023-03-15', 3000, NULL, '2023-03-15 11:15:02', '2023-03-15 11:15:02'),
(7, 6, '2023-03-15', 1000, 5, '2023-03-14 19:35:35', '2023-03-14 19:35:35'),
(8, 6, '2023-03-16', 500, 5, '2023-03-15 19:35:35', '2023-03-15 19:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `unit_id`, `category_id`, `name`, `quantity`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4, 'Bosundora Steel', 200, 5, NULL, 1, '2023-02-28 05:16:16', '2023-03-20 18:34:23'),
(2, 2, 2, 4, 'KSRM Steel', 350, 5, NULL, 1, '2023-02-28 05:16:39', '2023-03-20 18:33:30'),
(3, 1, 3, 1, 'Bosundora Cement', 152, 5, NULL, 1, '2023-02-28 05:17:39', '2023-03-20 18:33:20'),
(4, 7, 3, 1, 'Shah Cement', 0, 5, NULL, 1, '2023-02-28 05:18:09', '2023-02-28 05:18:09'),
(5, 8, 3, 1, 'Madina Cement', 0, 5, NULL, 1, '2023-02-28 05:18:40', '2023-02-28 05:18:40'),
(6, 5, 3, 1, 'Holcim Cement', 100, 5, NULL, 1, '2023-02-28 05:19:00', '2023-03-20 18:33:40'),
(7, 3, 2, 3, 'Walton Mobile w54', 0, 5, NULL, 1, '2023-02-28 05:20:24', '2023-02-28 05:20:24'),
(8, 6, 2, 3, 'Samsung A30', 2, 5, NULL, 1, '2023-02-28 05:21:10', '2023-03-20 18:34:00'),
(9, 3, 2, 3, 'Walton Mobile w55', 0, 5, NULL, 1, '2023-02-28 05:22:08', '2023-02-28 05:22:08'),
(10, 6, 2, 3, 'Samsung A50', 2, 5, NULL, 1, '2023-03-01 15:07:52', '2023-03-09 21:25:15'),
(11, 6, 2, 2, 'Samsung LM10 TV', 0, 5, NULL, 1, '2023-03-01 15:15:16', '2023-03-20 18:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `product_id`, `purchase_no`, `date`, `description`, `buying_qty`, `unit_price`, `buying_price`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 6, 3, 8, 'A-999', '2023-03-05', 'jjjjjjjjjj', 2, 12500, 25000, 1, 5, NULL, '2023-03-04 18:41:21', '2023-03-20 18:34:00'),
(2, 6, 3, 10, 'A-999', '2023-03-05', 'ooooo', 3, 15000, 45000, 1, 5, NULL, '2023-03-04 18:41:21', '2023-03-04 20:36:23'),
(3, 1, 1, 3, 'A-999', '2023-03-05', 'uuuuuu', 50, 400, 20000, 1, 5, NULL, '2023-03-04 18:41:21', '2023-03-06 13:12:11'),
(7, 2, 4, 2, 'B-999', '2023-03-20', 'Buying KSRM Steel', 300, 60, 18000, 0, 5, NULL, '2023-03-19 19:57:16', '2023-03-19 19:57:16'),
(8, 5, 1, 6, 'B-999', '2023-03-20', 'Buying Holcim Cement', 100, 700, 70000, 1, 5, NULL, '2023-03-19 19:57:16', '2023-03-20 18:33:40'),
(9, 1, 4, 1, 'C-999', '2023-03-17', 'Buying Madina Cement', 200, 650, 130000, 1, 5, NULL, '2023-03-19 20:20:44', '2023-03-20 18:34:23'),
(10, 2, 4, 2, 'E-999', '2023-03-22', 'Buying KSRM Steel', 350, 80, 28000, 1, 5, NULL, '2023-03-19 20:20:44', '2023-03-20 18:33:30'),
(12, 1, 1, 3, 'G-999', '2023-03-23', 'Buying Bosundora Cement', 120, 680, 81600, 1, 5, NULL, '2023-03-19 20:24:51', '2023-03-20 18:33:20'),
(13, 8, 1, 5, 'H-100', '2023-03-01', 'Buying Madina Cement', 50, 560, 28000, 0, 5, NULL, '2023-03-19 20:48:07', '2023-03-19 20:48:07'),
(14, 1, 1, 3, 'I-110', '2023-03-11', 'Buying Bosundora Cement', 80, 600, 48000, 0, 5, NULL, '2023-03-19 20:48:07', '2023-03-19 20:48:07'),
(15, 5, 1, 6, 'k-777', '2023-03-22', NULL, 5, 800, 4000, 0, 5, NULL, '2023-03-21 21:27:34', '2023-03-21 21:27:34'),
(16, 8, 1, 5, 'k-777', '2023-03-22', NULL, 10, 700, 7000, 0, 5, NULL, '2023-03-21 21:27:35', '2023-03-21 21:27:35'),
(17, 5, 1, 6, 'hkjh8889', '2023-03-22', NULL, 1, 0, 0, 0, 5, NULL, '2023-03-21 22:03:07', '2023-03-21 22:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile_no`, `email`, `address`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bosundora', '01934181059', 'bosundora@gmail.com', 'Dhaka, Bangladesh', 5, NULL, 1, '2023-02-28 05:00:59', '2023-02-28 05:00:59'),
(2, 'KSRM', '01934181092', 'ksrm@gmail.com', 'Gulistan, Dhaka', 5, NULL, 0, '2023-02-28 05:01:48', '2023-02-28 05:01:48'),
(3, 'Walton', '01934181001', 'walton@gmail.com', 'Gazipur, Dhaka', 5, NULL, 1, '2023-02-28 05:02:26', '2023-02-28 05:02:26'),
(4, 'Vision', '01934181002', 'vision@gmail.com', 'Gulshan, Dhaka', 5, NULL, 1, '2023-02-28 05:03:06', '2023-02-28 05:03:06'),
(5, 'Holcim', '01934181003', 'holcim@gmail.com', 'Dhanmondi, Dhaka', 5, NULL, 1, '2023-02-28 05:03:40', '2023-02-28 05:03:40'),
(6, 'Samsung', '01934181004', 'samgsung@gmail.com', 'Khilgoan, Dhaka', 5, NULL, 1, '2023-02-28 05:06:46', '2023-02-28 05:06:46'),
(7, 'Shah', '01934181005', 'shah@gmail.com', 'Farmgate, Dhaka', 5, NULL, 1, '2023-02-28 05:07:36', '2023-02-28 05:07:36'),
(8, 'Madina', '01934181006', 'madina@gmail.com', 'Tongi, Gazipur', 5, NULL, 0, '2023-02-28 05:08:13', '2023-02-28 05:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GM', 5, NULL, 1, '2023-02-27 13:26:50', '2023-02-27 13:26:50'),
(2, 'PCS', 5, 5, 1, '2023-02-27 13:28:24', '2023-02-28 05:08:46'),
(3, 'KG', 5, NULL, 1, '2023-02-27 13:28:39', '2023-02-27 13:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', NULL, 'user@gmail.com', NULL, '$2y$10$Zlx9MzFtuN9PZgYcG9dOUuM1MLSykWGS7mGbmGKJjW3umdFsUQLMS', NULL, 'NiKbF9A6YUQRkWhFtVZkVkDgb3dGUwzYKWUVS78tLDD5hyr40iHLpS5gGpTf', '2023-01-17 04:44:57', '2023-01-18 03:54:42'),
(4, 'Demo', 'demo', 'demo@gmail.com', '2023-01-18 04:40:14', '$2y$10$b0UOpOJElqH847dNZlQzFeIHfN07Ehs2VgtpnidV2.CPOfneAvffu', NULL, 'R4sFDhgRuFQUaUJAYbqsCQcMQ0XOIy0fmZ5UBrpi5jV3IshKHfzcDLU1zUci', '2023-01-18 04:39:27', '2023-01-18 05:03:10'),
(5, 'ABC', 'abc', 'abc@gmail.com', '2023-01-22 08:03:29', '$2y$10$NGs2YLJyUQiz9lk3MTk0YOnFkMAihbMYbihLHo7tQJLfHzS.7lNj.', 'upload/profile_image/profile_image-1675109862.png', 'xEkBdI2Cp24E5Jw6fQkhPptW7wXKgkwOdVHnuDEMjuWAQCUmDLqKwn2DPhJv', '2023-01-22 08:01:44', '2023-01-30 14:17:42'),
(7, 'XYZ', 'xyz', 'xyz@gmail.com', NULL, '$2y$10$0XLGWrJm7m3S3ptyg23sjujoX7E6PD/dbOXhuKyTQwX0j/hNAFo4.', NULL, NULL, '2024-01-17 15:54:54', '2024-01-17 15:54:54'),
(12, 'Raju', 'raju', 'rajusheikh061@gmail.com', NULL, '$2y$10$blybYyXlEn/d2yGjkp7aOeOy6Rf5Bkxn7AqXirYt3T5URLnY98EUe', NULL, NULL, '2024-01-25 20:43:14', '2024-01-25 20:43:14'),
(13, 'Siam', 'siam', 'mdshorfuddinsiam6660@gmail.com', '2024-01-25 20:51:19', '$2y$10$JGE8gsJHEhbNv/p6UR86de1LsqVwrxUzW7o8xObhdH0yv6TLkCtD2', NULL, NULL, '2024-01-25 20:49:53', '2024-01-25 20:51:19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
