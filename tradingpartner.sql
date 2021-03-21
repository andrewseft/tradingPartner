-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2021 at 08:50 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradingpartner`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hyperlink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `hyperlink`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cb66d365-2524-43c3-b9af-900f68c91ca6.jpg', 'https://www.hnicalls.com', 1, '2021-03-01 17:45:59', '2021-03-01 17:45:59'),
(2, '2552f136-9967-4c04-9e2c-f96dd3ef2a40.jpg', 'https://www.hnicalls.com', 1, '2021-03-01 17:46:17', '2021-03-01 17:46:17'),
(3, '25724dde-d328-4baf-a5de-67dfd566c751.jpg', 'https://www.hnicalls.com', 1, '2021-03-01 17:46:29', '2021-03-01 17:46:29'),
(4, 'f4fb34f9-5e89-46c1-a5e4-d697e47f1cb3.jpg', 'https://www.hnicalls.com', 1, '2021-03-01 17:46:39', '2021-03-01 17:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Buy,2=>Sell',
  `qty` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `option` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bid_users`
--

CREATE TABLE `bid_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Buy,2=>Sell',
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `option` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 1, 0, '2021-01-14 19:58:04', '2021-02-23 18:08:00'),
(2, 'HOLDING', 1, 1, '2021-01-16 05:06:01', '2021-02-23 18:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `category_plan`
--

CREATE TABLE `category_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_plan`
--

INSERT INTO `category_plan` (`id`, `category_id`, `plan_id`) VALUES
(6, 2, 3),
(8, 2, 4),
(9, 1, 5),
(10, 2, 5),
(11, 2, 1),
(12, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Basic', '2021-01-14 19:58:04', '2021-01-14 19:58:04'),
(2, 2, 'en', 'HOLDING', '2021-01-16 05:06:01', '2021-02-23 18:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `number`, `message`, `created_at`, `updated_at`, `image`) VALUES
(1, 'anil sharma', 'sharmaanil@gmail.com', '8866458588', 'Hi anil here', '2021-02-21 11:37:33', '2021-02-21 11:37:33', 'b67067c2-460f-4c72-af58-3890ae1da225.png');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Active,0=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `phonecode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 93, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(2, 'AL', 'Albania', 355, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(3, 'DZ', 'Algeria', 213, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(4, 'AS', 'American Samoa', 1684, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(5, 'AD', 'Andorra', 376, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(6, 'AO', 'Angola', 244, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(7, 'AI', 'Anguilla', 1264, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(8, 'AQ', 'Antarctica', 0, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(9, 'AG', 'Antigua And Barbuda', 1268, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(10, 'AR', 'Argentina', 54, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(11, 'AM', 'Armenia', 374, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(12, 'AW', 'Aruba', 297, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(13, 'AU', 'Australia', 61, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(14, 'AT', 'Austria', 43, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(15, 'AZ', 'Azerbaijan', 994, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(16, 'BS', 'Bahamas The', 1242, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(17, 'BH', 'Bahrain', 973, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(18, 'BD', 'Bangladesh', 880, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(19, 'BB', 'Barbados', 1246, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(20, 'BY', 'Belarus', 375, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(21, 'BE', 'Belgium', 32, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(22, 'BZ', 'Belize', 501, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(23, 'BJ', 'Benin', 229, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(24, 'BM', 'Bermuda', 1441, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(25, 'BT', 'Bhutan', 975, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(26, 'BO', 'Bolivia', 591, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(27, 'BA', 'Bosnia and Herzegovina', 387, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(28, 'BW', 'Botswana', 267, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(29, 'BV', 'Bouvet Island', 0, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(30, 'BR', 'Brazil', 55, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(31, 'IO', 'British Indian Ocean Territory', 246, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(32, 'BN', 'Brunei', 673, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(33, 'BG', 'Bulgaria', 359, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(34, 'BF', 'Burkina Faso', 226, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(35, 'BI', 'Burundi', 257, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(36, 'KH', 'Cambodia', 855, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(37, 'CM', 'Cameroon', 237, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(38, 'CA', 'Canada', 1, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(39, 'CV', 'Cape Verde', 238, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(40, 'KY', 'Cayman Islands', 1345, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(41, 'CF', 'Central African Republic', 236, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(42, 'TD', 'Chad', 235, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(43, 'CL', 'Chile', 56, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(44, 'CN', 'China', 86, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(45, 'CX', 'Christmas Island', 61, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(46, 'CC', 'Cocos (Keeling) Islands', 672, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(47, 'CO', 'Colombia', 57, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(48, 'KM', 'Comoros', 269, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(49, 'CG', 'Congo', 242, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(50, 'CD', 'Congo The Democratic Republic Of The', 242, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(51, 'CK', 'Cook Islands', 682, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(52, 'CR', 'Costa Rica', 506, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(53, 'CI', 'Cote D Ivoire (Ivory Coast)', 225, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(54, 'HR', 'Croatia (Hrvatska)', 385, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(55, 'CU', 'Cuba', 53, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(56, 'CY', 'Cyprus', 357, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(57, 'CZ', 'Czech Republic', 420, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(58, 'DK', 'Denmark', 45, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(59, 'DJ', 'Djibouti', 253, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(60, 'DM', 'Dominica', 1767, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(61, 'DO', 'Dominican Republic', 1809, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(62, 'TP', 'East Timor', 670, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(63, 'EC', 'Ecuador', 593, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(64, 'EG', 'Egypt', 20, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(65, 'SV', 'El Salvador', 503, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(66, 'GQ', 'Equatorial Guinea', 240, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(67, 'ER', 'Eritrea', 291, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(68, 'EE', 'Estonia', 372, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(69, 'ET', 'Ethiopia', 251, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(70, 'XA', 'External Territories of Australia', 61, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(71, 'FK', 'Falkland Islands', 500, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(72, 'FO', 'Faroe Islands', 298, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(73, 'FJ', 'Fiji Islands', 679, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(74, 'FI', 'Finland', 358, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(75, 'FR', 'France', 33, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(76, 'GF', 'French Guiana', 594, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(77, 'PF', 'French Polynesia', 689, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(78, 'TF', 'French Southern Territories', 0, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(79, 'GA', 'Gabon', 241, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(80, 'GM', 'Gambia The', 220, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(81, 'GE', 'Georgia', 995, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(82, 'DE', 'Germany', 49, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(83, 'GH', 'Ghana', 233, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(84, 'GI', 'Gibraltar', 350, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(85, 'GR', 'Greece', 30, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(86, 'GL', 'Greenland', 299, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(87, 'GD', 'Grenada', 1473, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(88, 'GP', 'Guadeloupe', 590, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(89, 'GU', 'Guam', 1671, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(90, 'GT', 'Guatemala', 502, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(91, 'XU', 'Guernsey and Alderney', 44, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(92, 'GN', 'Guinea', 224, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(93, 'GW', 'Guinea-Bissau', 245, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(94, 'GY', 'Guyana', 592, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(95, 'HT', 'Haiti', 509, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(96, 'HM', 'Heard and McDonald Islands', 0, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(97, 'HN', 'Honduras', 504, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(98, 'HK', 'Hong Kong S.A.R.', 852, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(99, 'HU', 'Hungary', 36, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(100, 'IS', 'Iceland', 354, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(101, 'IN', 'India', 91, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(102, 'ID', 'Indonesia', 62, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(103, 'IR', 'Iran', 98, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(104, 'IQ', 'Iraq', 964, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(105, 'IE', 'Ireland', 353, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(106, 'IL', 'Israel', 972, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(107, 'IT', 'Italy', 39, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(108, 'JM', 'Jamaica', 1876, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(109, 'JP', 'Japan', 81, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(110, 'XJ', 'Jersey', 44, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(111, 'JO', 'Jordan', 962, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(112, 'KZ', 'Kazakhstan', 7, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(113, 'KE', 'Kenya', 254, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(114, 'KI', 'Kiribati', 686, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(115, 'KP', 'Korea North', 850, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(116, 'KR', 'Korea South', 82, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(117, 'KW', 'Kuwait', 965, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(118, 'KG', 'Kyrgyzstan', 996, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(119, 'LA', 'Laos', 856, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(120, 'LV', 'Latvia', 371, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(121, 'LB', 'Lebanon', 961, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(122, 'LS', 'Lesotho', 266, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(123, 'LR', 'Liberia', 231, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(124, 'LY', 'Libya', 218, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(125, 'LI', 'Liechtenstein', 423, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(126, 'LT', 'Lithuania', 370, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(127, 'LU', 'Luxembourg', 352, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(128, 'MO', 'Macau S.A.R.', 853, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(129, 'MK', 'Macedonia', 389, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(130, 'MG', 'Madagascar', 261, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(131, 'MW', 'Malawi', 265, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(132, 'MY', 'Malaysia', 60, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(133, 'MV', 'Maldives', 960, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(134, 'ML', 'Mali', 223, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(135, 'MT', 'Malta', 356, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(136, 'XM', 'Man (Isle of)', 44, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(137, 'MH', 'Marshall Islands', 692, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(138, 'MQ', 'Martinique', 596, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(139, 'MR', 'Mauritania', 222, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(140, 'MU', 'Mauritius', 230, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(141, 'YT', 'Mayotte', 269, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(142, 'MX', 'Mexico', 52, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(143, 'FM', 'Micronesia', 691, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(144, 'MD', 'Moldova', 373, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(145, 'MC', 'Monaco', 377, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(146, 'MN', 'Mongolia', 976, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(147, 'MS', 'Montserrat', 1664, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(148, 'MA', 'Morocco', 212, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(149, 'MZ', 'Mozambique', 258, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(150, 'MM', 'Myanmar', 95, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(151, 'NA', 'Namibia', 264, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(152, 'NR', 'Nauru', 674, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(153, 'NP', 'Nepal', 977, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(154, 'AN', 'Netherlands Antilles', 599, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(155, 'NL', 'Netherlands The', 31, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(156, 'NC', 'New Caledonia', 687, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(157, 'NZ', 'New Zealand', 64, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(158, 'NI', 'Nicaragua', 505, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(159, 'NE', 'Niger', 227, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(160, 'NG', 'Nigeria', 234, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(161, 'NU', 'Niue', 683, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(162, 'NF', 'Norfolk Island', 672, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(163, 'MP', 'Northern Mariana Islands', 1670, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(164, 'NO', 'Norway', 47, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(165, 'OM', 'Oman', 968, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(166, 'PK', 'Pakistan', 92, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(167, 'PW', 'Palau', 680, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(168, 'PS', 'Palestinian Territory Occupied', 970, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(169, 'PA', 'Panama', 507, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(170, 'PG', 'Papua new Guinea', 675, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(171, 'PY', 'Paraguay', 595, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(172, 'PE', 'Peru', 51, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(173, 'PH', 'Philippines', 63, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(174, 'PN', 'Pitcairn Island', 0, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(175, 'PL', 'Poland', 48, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(176, 'PT', 'Portugal', 351, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(177, 'PR', 'Puerto Rico', 1787, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(178, 'QA', 'Qatar', 974, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(179, 'RE', 'Reunion', 262, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(180, 'RO', 'Romania', 40, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(181, 'RU', 'Russia', 70, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(182, 'RW', 'Rwanda', 250, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(183, 'SH', 'Saint Helena', 290, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(184, 'KN', 'Saint Kitts And Nevis', 1869, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(185, 'LC', 'Saint Lucia', 1758, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(186, 'PM', 'Saint Pierre and Miquelon', 508, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(188, 'WS', 'Samoa', 684, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(189, 'SM', 'San Marino', 378, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(190, 'ST', 'Sao Tome and Principe', 239, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(191, 'SA', 'Saudi Arabia', 966, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(192, 'SN', 'Senegal', 221, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(193, 'RS', 'Serbia', 381, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(194, 'SC', 'Seychelles', 248, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(195, 'SL', 'Sierra Leone', 232, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(196, 'SG', 'Singapore', 65, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(197, 'SK', 'Slovakia', 421, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(198, 'SI', 'Slovenia', 386, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(199, 'XG', 'Smaller Territories of the UK', 44, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(200, 'SB', 'Solomon Islands', 677, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(201, 'SO', 'Somalia', 252, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(202, 'ZA', 'South Africa', 27, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(203, 'GS', 'South Georgia', 0, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(204, 'SS', 'South Sudan', 211, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(205, 'ES', 'Spain', 34, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(206, 'LK', 'Sri Lanka', 94, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(207, 'SD', 'Sudan', 249, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(208, 'SR', 'Suriname', 597, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(210, 'SZ', 'Swaziland', 268, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(211, 'SE', 'Sweden', 46, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(212, 'CH', 'Switzerland', 41, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(213, 'SY', 'Syria', 963, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(214, 'TW', 'Taiwan', 886, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(215, 'TJ', 'Tajikistan', 992, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(216, 'TZ', 'Tanzania', 255, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(217, 'TH', 'Thailand', 66, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(218, 'TG', 'Togo', 228, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(219, 'TK', 'Tokelau', 690, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(220, 'TO', 'Tonga', 676, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(221, 'TT', 'Trinidad And Tobago', 1868, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(222, 'TN', 'Tunisia', 216, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(223, 'TR', 'Turkey', 90, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(224, 'TM', 'Turkmenistan', 7370, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(225, 'TC', 'Turks And Caicos Islands', 1649, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(226, 'TV', 'Tuvalu', 688, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(227, 'UG', 'Uganda', 256, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(228, 'UA', 'Ukraine', 380, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(229, 'AE', 'United Arab Emirates', 971, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(230, 'GB', 'United Kingdom', 44, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(231, 'US', 'United States', 1, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(232, 'UM', 'United States Minor Outlying Islands', 1, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(233, 'UY', 'Uruguay', 598, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(234, 'UZ', 'Uzbekistan', 998, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(235, 'VU', 'Vanuatu', 678, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(236, 'VA', 'Vatican City State (Holy See)', 39, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(237, 'VE', 'Venezuela', 58, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(238, 'VN', 'Vietnam', 84, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(239, 'VG', 'Virgin Islands (British)', 1284, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(240, 'VI', 'Virgin Islands (US)', 1340, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(241, 'WF', 'Wallis And Futuna Islands', 681, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(242, 'EH', 'Western Sahara', 212, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(243, 'YE', 'Yemen', 967, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(244, 'YU', 'Yugoslavia', 38, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(245, 'ZM', 'Zambia', 260, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(246, 'ZW', 'Zimbabwe', 263, 0, '2021-01-10 16:17:27', '2021-01-10 16:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `dummy_users`
--

CREATE TABLE `dummy_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `request_data` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dummy_users`
--

INSERT INTO `dummy_users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `request_data`) VALUES
(11, 'Arif Ahmad', 'a1@gmail.com', 'Test@123', '2021-03-05 21:29:39', '2021-03-05 21:29:39', '{\"number\":\"91123456700\",\"investmentCapital\":\"1\",\"password\":\"Test@123\",\"referral_code\":null,\"device_token\":\"fUBepi56Q0uejF8znCQUBQ:APA91bHfpWo7niNXPfyTqZsUVUrGRGxMD5-g2NiJprf2ZTpdy5PmJJ5yAhy2hBsODLv11VWD5ze6UyMTurbcF_a3iCHUDBsPDo0pd1X8_0sN--5IGeRfNVCqh1U6WzbG1fPX3EM410ps\",\"name\":\"Arif Ahmad\",\"device_type\":\"Andorid\",\"email\":\"a1@gmail.com\"}'),
(12, 'Arif Ahmad', 'a2@gmail.com', 'Test@123', '2021-03-05 21:31:52', '2021-03-05 21:31:52', '{\"number\":\"918292101310\",\"investmentCapital\":\"1\",\"password\":\"Test@123\",\"referral_code\":null,\"device_token\":\"fUBepi56Q0uejF8znCQUBQ:APA91bHfpWo7niNXPfyTqZsUVUrGRGxMD5-g2NiJprf2ZTpdy5PmJJ5yAhy2hBsODLv11VWD5ze6UyMTurbcF_a3iCHUDBsPDo0pd1X8_0sN--5IGeRfNVCqh1U6WzbG1fPX3EM410ps\",\"name\":\"Arif Ahmad\",\"device_type\":\"Andorid\",\"email\":\"a2@gmail.com\"}');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(2, 1, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(3, 1, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(4, 1, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(5, 1, '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(7, 1, '2021-01-16 07:35:03', '2021-01-16 07:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `email_translations`
--

CREATE TABLE `email_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_translations`
--

INSERT INTO `email_translations` (`id`, `email_id`, `locale`, `title`, `subject`, `description`, `keyword`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'This email is sent to user when user clicks Forgot Password', 'Reset  Password', '\n                    <p>Dear <strong>[NAME]</strong></p>\n\n                    <p>A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, click on button:</p>\n\n                    <center><a href=\"[RESET_PASSWORD_LINK]\" rel=\"nofollow\" style=\"display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none\" target=\"_other\">Reset Password</a></center>\n\n                    <p>If you&rsquo;re having trouble clicking the &#39;Reset Password&#39; button, copy and paste the URL below into your web browser:</p>\n\n                    <p>[RESET_PASSWORD_LINK]</p>\n\n                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n                ', '\n                    <table class=\"table table-bordered\">\n                        <thead>\n                            <tr>\n                                <th width=\"50\">&nbsp;</th>\n                                <th width=\"400\">Information PlaceHolder</th>\n                                <th>Explaination</th>\n                            </tr>\n                        </thead>\n                        <tbody>\n                            <tr>\n                                <td>1</td>\n                                <td>[NAME]</td>\n                                <td>This will be replaced by full name of user.</td>\n                            </tr>\n                            <tr>\n                                <td>2</td>\n                                <td>[RESET_PASSWORD_LINK]</td>\n                                <td>This will be replaced by link of reset password in email.</td>\n                            </tr>\n                            <tr>\n                                <td>3</td>\n                                <td>Message</td>\n                                <td>\n                                <p>Dear <strong>tradingPartner</strong></p>\n\n                                <p>A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, click on button:</p>\n\n                                <center><a href=\"[RESET_PASSWORD_LINK]\" rel=\"nofollow\" style=\"display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none\" target=\"_other\">Reset Password</a></center>\n\n                                <p>If you&rsquo;re having trouble clicking the &#39;Reset Password&#39; button, copy and paste the URL below into your web browser:</p>\n\n                                <p>www.tradingPartner.com/reset_password</p>\n\n                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                ', '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(2, 2, 'en', 'This email is sent to user when they reset their password successfully', 'Password Reset Successfully', '\n                    <p>Dear <strong>[NAME]</strong></p>\n\n                    <p>A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, click on button:</p>\n\n                    <center><a href=\"[RESET_PASSWORD_LINK]\" rel=\"nofollow\" style=\"display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none\" target=\"_other\">Reset Password</a></center>\n\n                    <p>If you&rsquo;re having trouble clicking the &#39;Reset Password&#39; button, copy and paste the URL below into your web browser:</p>\n\n                    <p>[RESET_PASSWORD_LINK]</p>\n\n                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n                ', '\n                    <table class=\"table table-bordered\">\n                        <thead>\n                            <tr>\n                                <th width=\"50\">&nbsp;</th>\n                                <th width=\"400\">Information PlaceHolder</th>\n                                <th>Explaination</th>\n                            </tr>\n                        </thead>\n                        <tbody>\n                            <tr>\n                                <td>1</td>\n                                <td>[NAME]</td>\n                                <td>This will be replaced by full name of user.</td>\n                            </tr>\n                            <tr>\n                                <td>2</td>\n                                <td>Message</td>\n                                <td>\n                                <p>Dear<strong> tradingPartner</strong></p>\n\n                                <p>You have reset your password successfully.</p>\n\n                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                ', '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(3, 3, 'en', 'User/ Driver will receive this confirmation email when User/ Driver creates an account', 'Activate your account', '\n                    <p>Dear <strong>[NAME]&nbsp;</strong></p>\n\n                    <p>Your account has been&nbsp;set up at <strong>[SITE_NAME]</strong>.&nbsp;Kindly click the Account Activation Link&nbsp;to verify your email address.</p>\n\n                    <p>&nbsp;</p>\n\n                    <center><a href=\"[ACCOUNT_ACTIVATION_LINK]\" style=\"display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none\" target=\"_other\">Account Activation Link</a></center>\n\n                    <p>&nbsp;</p>\n\n                    <p>Email Address: [EMAIL]</p>\n\n                    <p>If you&rsquo;re having trouble clicking the &#39;Account Activation Link&#39; button, copy and paste the URL below into your web browser:</p>\n\n                    <p><a class=\"view_link\" href=\"[ACCOUNT_ACTIVATION_LINK]\" style=\"word-break: break-all;\" target=\"_other\">[ACCOUNT_ACTIVATION_LINK]</a></p>\n\n                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n                ', '\n                    <table class=\"table table-bordered\">\n                    <thead>\n                        <tr>\n                            <th width=\"50\">&nbsp;</th>\n                            <th width=\"400\">Information PlaceHolder</th>\n                            <th>Explaination</th>\n                        </tr>\n                    </thead>\n                        <tbody>\n                            <tr>\n                                <td>1</td>\n                                <td>[NAME]</td>\n                                <td>This will be replaced by full name of user.</td>\n                            </tr>\n                            <tr>\n                                <td>2</td>\n                                <td>[SITE_NAME]</td>\n                                <td>This will be replaced by Name of platform/Website.</td>\n                            </tr>\n                            <tr>\n                                <td>3</td>\n                                <td>[EMAIL]</td>\n                                <td>This will be replaced by EMAIL of user.</td>\n                            </tr>\n                            <tr>\n                                <td>4</td>\n                                <td>[ACCOUNT_ACTIVATION_LINK]</td>\n                                <td>This will be replaced by account activation link.</td>\n                            </tr>\n                            <tr>\n                                <td>5</td>\n                                <td>Message</td>\n                                <td>\n                                <p>Dear <strong>tradingPartner&nbsp;</strong></p>\n\n                                <p>Your account has been&nbsp;set up at <strong>tradingPartner.com</strong>.&nbsp;Kindly click the Account Activation Link&nbsp;to verify your email address.</p>\n\n                                <p>&nbsp;</p>\n\n                                <center><a href=\"[ACCOUNT_ACTIVATION_LINK]\" style=\"display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none\" target=\"_other\">Account Activation Link</a></center>\n\n                                <p>&nbsp;</p>\n\n                                <p>Email Address: user@tradingPartner.com</p>\n\n                                <p>If you&rsquo;re having trouble clicking the &#39;Account Activation Link&#39; button, copy and paste the URL below into your web browser:</p>\n\n                                <p><a class=\"view_link\" href=\"[ACCOUNT_ACTIVATION_LINK]\" style=\"word-break: break-all;\" target=\"_other\">tradingPartner.com/account/activation</a></p>\n\n                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                ', '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(4, 4, 'en', 'Account Active', 'Account Active', '\n                    <h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear [NAME],</h1>\n\n                    <p>Your account has been successfully activated on <strong>[SITE_NAME]</strong>, now you can log in your account.</p>\n\n                    <center>&nbsp;</center>', '\n                    <table class=\"table table-bordered\">\n                        <thead>\n                            <tr>\n                                <th width=\"50\">&nbsp;</th>\n                                <th width=\"400\">Information PlaceHolder</th>\n                                <th>Explaination</th>\n                            </tr>\n                        </thead>\n                        <tbody>\n                            <tr>\n                                <td>1</td>\n                                <td>[NAME]</td>\n                                <td>This will be replaced by full name of user.</td>\n                            </tr>\n                            <tr>\n                                <td>2</td>\n                                <td>[SITE_NAME]</td>\n                                <td>This will be replaced by Name of platform/Website.</td>\n                            </tr>\n                            <tr>\n                                <td>3</td>\n                                <td>Message</td>\n                                <td>\n                                <h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear tradingPartner,</h1>\n\n                                <p>Your account has been successfully activated on <strong>tradingPartner.com</strong>, now you can log in to your account.</p>\n\n                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n\n                                <center>&nbsp;</center>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                ', '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(5, 5, 'en', 'User/ Driver will receive this email when there is a new notification', 'You have a new notification', '\n                    <h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear [NAME],</h1>\n\n                    <p>Your account has been successfully activated on <strong>[SITE_NAME]</strong>, now you can log in to your account.</p>\n\n                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\n\n                    <center>&nbsp;</center>\n                ', '\n                    <table class=\"table table-bordered\">\n                        <thead>\n                            <tr>\n                                <th width=\"50\">&nbsp;</th>\n                                <th width=\"400\">Information PlaceHolder</th>\n                                <th>Explaination</th>\n                            </tr>\n                        </thead>\n                        <tbody>\n                            <tr>\n                                <td>1</td>\n                                <td>[NAME]</td>\n                                <td>This will be replaced by full name of user.</td>\n                            </tr>\n                            <tr>\n                                <td>2</td>\n                                <td>[ACTION]</td>\n                                <td>This will be replaced by Action of platform/Website.</td>\n                            </tr>\n                            <tr>\n                                <td>3</td>\n                                <td>Message</td>\n                                <td>\n                                <p>Dear<strong> tradingPartner&nbsp;</strong></p>\n\n                                <p>You have a new notification, kindly check in your account.</p>\n\n                                <p><span>Your account has been deactivated</span></p>\n\n                                <p>If you have any questions, please email us at info@tradingPartner.com</p>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                ', '2021-01-10 16:17:27', '2021-01-10 16:17:27'),
(6, 7, 'en', 'OTP', 'OTP', '<h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear [NAME],</h1>\r\n\r\n<p>Your account has been successfully created on <strong>[SITE_NAME]</strong>, first, verify your OTP then log in to your account</p>\r\n\r\n<p>Your OTP: <strong>[OTP]</strong></p>\r\n\r\n<p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\r\n\r\n<center>&nbsp;</center>', '<table>\r\n	<thead>\r\n		<tr>\r\n			<th>&nbsp;</th>\r\n			<th>Information PlaceHolder</th>\r\n			<th>Explaination</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>[NAME]</td>\r\n			<td>This will be replaced by full name of user.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>[OTP]</td>\r\n			<td>This will be replaced by OTP</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3</td>\r\n			<td>Message</td>\r\n			<td>\r\n			<h1>Dear User,</h1>\r\n\r\n			<p>Your account has been successfully created on <strong>tranding partner</strong>, first, verify your OTP then log in to your account</p>\r\n\r\n			<p>Your OTP: <strong>1234</strong></p>\r\n\r\n			<p>If you have any questions, please email us at enquiry@tradingPartner.com</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '2021-01-16 07:35:03', '2021-01-16 07:35:03');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'database', 'default', '{\"uuid\":\"9831bd13-926e-43a3-a8ee-9ebf29adab8e\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:7;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";N;s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";s:4:\\\"3369\\\";s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"f6891881-8c0b-4573-a643-104aae4c6028\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-01-16 14:01:18.548592\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Trying to get property \'description\' of non-object in E:\\xampp\\htdocs\\project\\tradingPartner\\app\\Notifications\\EmailNotification.php:62\nStack trace:\n#0 E:\\xampp\\htdocs\\project\\tradingPartner\\app\\Notifications\\EmailNotification.php(62): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Trying to get p...\', \'E:\\\\xampp\\\\htdocs...\', 62, Array)\n#1 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\Channels\\MailChannel.php(51): App\\Notifications\\EmailNotification->toMail(Object(App\\DummyUser))\n#2 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\DummyUser), Object(App\\Notifications\\EmailNotification))\n#3 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\DummyUser), \'9202395e-c68c-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#4 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#5 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#6 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#7 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#8 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#9 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#11 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#12 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#13 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#14 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#15 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#16 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#17 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#18 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#19 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#20 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#23 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#25 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#26 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#27 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#28 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#31 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#32 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#33 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#34 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Command\\Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#35 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#36 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#38 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#39 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 E:\\xampp\\htdocs\\project\\tradingPartner\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 {main}', '2021-01-16 08:31:32'),
(2, 'database', 'default', '{\"uuid\":\"7d8d7f02-4e6d-4302-b8ba-4bfb8b038ec5\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:7;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";N;s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";s:4:\\\"3934\\\";s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"78008868-06a6-4050-8016-38c9482915e7\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-01-16 14:01:46.681256\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Trying to get property \'description\' of non-object in E:\\xampp\\htdocs\\project\\tradingPartner\\app\\Notifications\\EmailNotification.php:62\nStack trace:\n#0 E:\\xampp\\htdocs\\project\\tradingPartner\\app\\Notifications\\EmailNotification.php(62): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Trying to get p...\', \'E:\\\\xampp\\\\htdocs...\', 62, Array)\n#1 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\Channels\\MailChannel.php(51): App\\Notifications\\EmailNotification->toMail(Object(App\\DummyUser))\n#2 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\DummyUser), Object(App\\Notifications\\EmailNotification))\n#3 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\DummyUser), \'7c4ade94-5a45-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#4 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#5 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#6 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#7 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#8 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#9 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#11 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#12 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#13 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#14 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#15 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#16 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#17 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#18 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#19 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#20 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#23 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#25 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#26 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#27 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#28 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#31 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#32 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#33 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#34 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Command\\Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#35 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#36 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#38 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\symfony\\console\\Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#39 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 E:\\xampp\\htdocs\\project\\tradingPartner\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 E:\\xampp\\htdocs\\project\\tradingPartner\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 {main}', '2021-01-16 08:31:48'),
(3, 'database', 'default', '{\"uuid\":\"6b37c81c-df44-48e9-8075-a850ca6e63b3\",\"displayName\":\"App\\\\Notifications\\\\OTPNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\OTPNotification\\\":14:{s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000slug\\\";i:7;s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:43:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000language\\\";N;s:38:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000url\\\";s:4:\\\"9682\\\";s:47:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"5cb9e17a-fb2e-4842-b8dd-762270e86cc3\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-02-01 23:59:51.062493\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\DummyUser]. in /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:481\nStack trace:\n#0 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): Illuminate\\Notifications\\Notification->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(45): Illuminate\\Notifications\\Notification->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: Illuminate\\Notifications\\Notification->__wakeup()\n#4 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize(\'O:48:\"Illuminat...\')\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#17 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2021-02-27 20:59:00'),
(4, 'database', 'default', '{\"uuid\":\"81a40e54-b3ce-4049-9476-0dbe55ba213e\",\"displayName\":\"App\\\\Notifications\\\\OTPNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\OTPNotification\\\":14:{s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000slug\\\";i:7;s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:43:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000language\\\";N;s:38:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000url\\\";s:4:\\\"2125\\\";s:47:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"662449e6-91a7-4413-a315-97e242415d5d\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-02-02 00:11:09.250529\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\DummyUser]. in /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:481\nStack trace:\n#0 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): Illuminate\\Notifications\\Notification->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(45): Illuminate\\Notifications\\Notification->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: Illuminate\\Notifications\\Notification->__wakeup()\n#4 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize(\'O:48:\"Illuminat...\')\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#17 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2021-02-27 20:59:05'),
(5, 'database', 'default', '{\"uuid\":\"86cf9104-d0e9-4333-90bd-536658684555\",\"displayName\":\"App\\\\Notifications\\\\OTPNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\OTPNotification\\\":14:{s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000slug\\\";i:7;s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:43:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000language\\\";N;s:38:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000url\\\";s:4:\\\"6979\\\";s:47:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"49f9b29a-1a3e-4f72-b6c2-c642e4e83e16\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-02-02 00:28:35.350470\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\DummyUser]. in /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:481\nStack trace:\n#0 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): Illuminate\\Notifications\\Notification->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(45): Illuminate\\Notifications\\Notification->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: Illuminate\\Notifications\\Notification->__wakeup()\n#4 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize(\'O:48:\"Illuminat...\')\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#17 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2021-02-27 20:59:10');
INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(6, 'database', 'default', '{\"uuid\":\"82e4a28f-3768-4f73-9dc5-3657433ed290\",\"displayName\":\"App\\\\Notifications\\\\OTPNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\OTPNotification\\\":14:{s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000slug\\\";i:7;s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:43:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000language\\\";N;s:38:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000url\\\";s:4:\\\"4490\\\";s:47:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"76d40176-daac-42dd-8140-f6adf44aed70\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-02-14 21:34:28.981254\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\DummyUser]. in /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:481\nStack trace:\n#0 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): Illuminate\\Notifications\\Notification->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(45): Illuminate\\Notifications\\Notification->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: Illuminate\\Notifications\\Notification->__wakeup()\n#4 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize(\'O:48:\"Illuminat...\')\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#17 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2021-02-27 21:00:29'),
(7, 'database', 'default', '{\"uuid\":\"0061a983-77cd-444a-b536-b98f2cc412a8\",\"displayName\":\"App\\\\Notifications\\\\OTPNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:7;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\OTPNotification\\\":14:{s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000slug\\\";i:7;s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:43:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000language\\\";N;s:38:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000url\\\";s:4:\\\"4411\\\";s:47:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"b2a67860-278a-4548-af20-7603f6539fc4\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-02-28 22:22:00.982418\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\DummyUser]. in /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:481\nStack trace:\n#0 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): Illuminate\\Notifications\\Notification->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(45): Illuminate\\Notifications\\Notification->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: Illuminate\\Notifications\\Notification->__wakeup()\n#4 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize(\'O:48:\"Illuminat...\')\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#17 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2021-02-28 16:52:03'),
(8, 'database', 'default', '{\"uuid\":\"93c77f0a-da53-4e51-8021-85b33869deaf\",\"displayName\":\"App\\\\Notifications\\\\OTPNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";a:1:{i:0;i:8;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\OTPNotification\\\":14:{s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000slug\\\";i:7;s:39:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:13:\\\"App\\\\DummyUser\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:43:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000language\\\";N;s:38:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000url\\\";s:4:\\\"6527\\\";s:47:\\\"\\u0000App\\\\Notifications\\\\OTPNotification\\u0000notification\\\";N;s:2:\\\"id\\\";s:36:\\\"457df88d-d662-402a-ba1c-df027a19ade9\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-01 21:25:05.992049\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\DummyUser]. in /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:481\nStack trace:\n#0 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): Illuminate\\Notifications\\Notification->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(45): Illuminate\\Notifications\\Notification->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: Illuminate\\Notifications\\Notification->__wakeup()\n#4 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize(\'O:48:\"Illuminat...\')\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#17 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2021-03-01 15:55:07'),
(9, 'database', 'default', '{\"uuid\":\"49b8bcf3-c40e-4bed-9398-5833917dd1a9\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:138:\\\"You have successfully added  12156.45 in your wallet, current balance now is 12354.07, and please see more details in your passbook on app\\\";s:2:\\\"id\\\";s:36:\\\"1f59ae93-7843-4db2-9390-ecaa894f7b3e\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:31:10.964328\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1190)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'1d85dca7-8e9b-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:04:27'),
(10, 'database', 'default', '{\"uuid\":\"137366d1-51e8-4048-83cc-30767827c372\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:47:\\\"Arif Ahmad has been added a 12156.45 his wallet\\\";s:2:\\\"id\\\";s:36:\\\"b3453e3c-13ae-4723-b766-d878517edc6d\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:31:11.281517\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1196)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'38a1cee8-329a-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:04:54');
INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(11, 'database', 'default', '{\"uuid\":\"a4b0887f-c3c0-44d5-8cb3-92e4b7954cbf\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:69:\\\"You have Buy a PMS plan and his qty is 20, we will update you shortly\\\";s:2:\\\"id\\\";s:36:\\\"c90e6c3e-b57f-43cc-b54f-799bf8d9a08c\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:38:16.146659\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1227)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'a83ba8c8-ff2d-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:14:24'),
(12, 'database', 'default', '{\"uuid\":\"f027a2f1-e686-4a1e-a705-6ec845afbec5\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:52:\\\"Arif Ahmad has been Buy a PMS plan and his qty is 20\\\";s:2:\\\"id\\\";s:36:\\\"6cd3ceff-be31-4b7e-9f7f-77e4e2bee00b\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:38:16.596400\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1230)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'f190d067-b25a-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:14:54'),
(13, 'database', 'default', '{\"uuid\":\"cc555b53-95db-40dd-8732-8f4d47f44c9d\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:136:\\\"You have successfully added  100.00 in your wallet, current balance now is 12354.07, and please see more details in your passbook on app\\\";s:2:\\\"id\\\";s:36:\\\"5415612a-bf52-4721-a894-d575791889ea\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:38:54.166271\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1233)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'f4514a57-5217-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:15:23');
INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(14, 'database', 'default', '{\"uuid\":\"40145fda-cfde-4aee-9991-c500f331e242\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:45:\\\"Arif Ahmad has been added a 100.00 his wallet\\\";s:2:\\\"id\\\";s:36:\\\"cd9fc667-8831-4d34-8a16-65e3fa45ae57\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:38:54.516369\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1236)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'bad227b6-ffec-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:15:54'),
(15, 'database', 'default', '{\"uuid\":\"ccf14fd2-f0df-4281-a8eb-20f2e3761ea2\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:77:\\\"You have Buy a PMS INFRA plan and his qty is 1000, we will update you shortly\\\";s:2:\\\"id\\\";s:36:\\\"198e46bd-97bc-4548-b18c-72ba50f5415c\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:47:11.074947\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1253)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'afe26921-a526-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:20:09'),
(16, 'database', 'default', '{\"uuid\":\"f502d027-57ec-4bb5-a7c7-22334c50213e\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:60:\\\"Arif Ahmad has been Buy a PMS INFRA plan and his qty is 1000\\\";s:2:\\\"id\\\";s:36:\\\"8b9a83f0-59bb-492d-9301-5251fc2a594c\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 18:47:11.383861\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1256)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'df4c75b9-18bd-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:20:39');
INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(17, 'database', 'default', '{\"uuid\":\"f387a0ba-94ec-49ff-aad2-3e4788a13c39\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:137:\\\"You have successfully added  9678.65 in your wallet, current balance now is 17032.72, and please see more details in your passbook on app\\\";s:2:\\\"id\\\";s:36:\\\"8245d0f9-39ce-4ed9-b5f9-4f021d410400\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 19:02:49.755990\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1273)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'eba588fb-a710-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:36:12'),
(18, 'database', 'default', '{\"uuid\":\"eee7edd7-3051-43d1-9fa8-0508934e2e78\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:46:\\\"Arif Ahmad has been added a 9678.65 his wallet\\\";s:2:\\\"id\\\";s:36:\\\"21003af7-76c2-4a20-a1fe-2683a465f5d4\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 19:02:50.164792\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1276)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'753749a3-1de5-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:36:42'),
(19, 'database', 'default', '{\"uuid\":\"04c6aef7-1df3-46fd-865f-946c71f440ca\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:77:\\\"You have Buy a PMS INFRA plan and his qty is 1000, we will update you shortly\\\";s:2:\\\"id\\\";s:36:\\\"d2c308e0-a56f-4369-8c1d-be98a8cf4ce2\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 19:12:08.345324\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1293)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'15892591-dc44-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:45:27');
INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(20, 'database', 'default', '{\"uuid\":\"64fa419e-269e-4020-af88-74d059be45f2\",\"displayName\":\"App\\\\Notifications\\\\EmailNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":13:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EmailNotification\\\":14:{s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000slug\\\";i:5;s:41:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:8:\\\"App\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:45:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000language\\\";s:2:\\\"en\\\";s:40:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000url\\\";N;s:49:\\\"\\u0000App\\\\Notifications\\\\EmailNotification\\u0000notification\\\";s:60:\\\"Arif Ahmad has been Buy a PMS INFRA plan and his qty is 1000\\\";s:2:\\\"id\\\";s:36:\\\"b89ced1e-bc76-46c0-bf8d-a15eb021a934\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-03-06 19:12:08.906674\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:12:\\\"Asia\\/Kolkata\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";r:24;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Swift_TransportException: Connection could not be established with host smtp.mailtrap.io :stream_socket_client(): php_network_getaddresses: getaddrinfo failed: Name or service not known in /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:269\nStack trace:\n#0 [internal function]: Swift_Transport_StreamBuffer->{closure}(2, \'stream_socket_c...\', \'/home/hnicalls/...\', 272, Array)\n#1 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(272): stream_socket_client(\'tcp://smtp.mail...\', 0, \'php_network_get...\', 30, 4, Resource id #1296)\n#2 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(58): Swift_Transport_StreamBuffer->establishSocketConnection()\n#3 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(143): Swift_Transport_StreamBuffer->initialize(Array)\n#4 /home/hnicalls/bankniftypms.com/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()\n#5 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send(Object(Swift_Message), Array)\n#6 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage(Object(Swift_Message))\n#7 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/Channels/MailChannel.php(65): Illuminate\\Mail\\Mailer->send(\'emails.notifica...\', Array, Object(Closure))\n#8 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(App\\User), Object(App\\Notifications\\EmailNotification))\n#9 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(App\\User), \'54eebe7f-5e78-4...\', Object(App\\Notifications\\EmailNotification), \'mail\')\n#10 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#11 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#12 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#13 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Notifications/SendQueuedNotifications.php(94): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Database\\Eloquent\\Collection), Object(App\\Notifications\\EmailNotification), Array)\n#14 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#15 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#16 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#17 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#18 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#19 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#20 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#21 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#22 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#23 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#24 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#25 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#26 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#29 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#30 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#31 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#34 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#35 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#36 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#37 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#38 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#39 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call(Array)\n#40 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Command/Command.php(258): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(920): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(266): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 /home/hnicalls/bankniftypms.com/vendor/symfony/console/Application.php(142): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 /home/hnicalls/bankniftypms.com/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 /home/hnicalls/bankniftypms.com/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2021-03-06 13:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `index` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `index`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '2021-02-07 19:14:44', '2021-02-07 19:14:44'),
(2, 0, 1, '2021-02-07 19:15:16', '2021-02-07 19:15:16'),
(3, 0, 1, '2021-02-07 19:15:35', '2021-02-07 19:15:35'),
(4, 0, 1, '2021-02-07 19:16:08', '2021-02-07 19:16:08'),
(5, 0, 1, '2021-02-07 19:16:23', '2021-02-07 19:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `locale`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Which material types can you work with?', '<p class=\"accordion-content show\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet.</p>', '2021-02-07 19:14:44', '2021-02-07 19:22:24'),
(2, 2, 'en', 'What access do I have on the free plan?', '<p class=\"accordion-content\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>', '2021-02-07 19:15:16', '2021-02-07 19:23:14'),
(3, 3, 'en', 'Can I get support from the Author?', '<p class=\"accordion-content\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>', '2021-02-07 19:15:35', '2021-02-07 19:21:49'),
(4, 4, 'en', 'Which material can you work with?', '<p class=\"accordion-content\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>', '2021-02-07 19:16:08', '2021-02-07 19:21:58'),
(5, 5, 'en', 'Why Choose Our Services In Your Business?', '<p class=\"accordion-content\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>', '2021-02-07 19:16:23', '2021-02-07 19:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `investment_capitals`
--

CREATE TABLE `investment_capitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investment_capitals`
--

INSERT INTO `investment_capitals` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '5', 1, '2021-01-10 16:23:18', '2021-01-10 16:23:18'),
(2, '10', 1, '2021-01-10 16:23:23', '2021-01-10 16:23:23'),
(3, '15', 1, '2021-01-10 16:23:30', '2021-01-10 16:23:30');

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

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '{\\r\\n    \\\"Email\\\": \\\"Email\\\"\\r\\n}', 1, '2021-01-10 16:17:27', '2021-01-10 16:17:27');

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_09_19_135535_create_settings_table', 1),
(10, '2019_10_21_053605_create_notifications_table', 1),
(11, '2020_06_18_164800_create_emails_table', 1),
(12, '2020_06_19_164057_create_pages_table', 1),
(13, '2020_06_26_235435_create_jobs_table', 1),
(14, '2020_06_27_172831_create_email_translations_table', 1),
(15, '2020_06_27_172840_create_page_translations_table', 1),
(16, '2020_06_27_172850_create_languages_table', 1),
(17, '2020_08_24_054400_create_banners_table', 1),
(18, '2020_08_27_063948_create_countries_table', 1),
(19, '2020_09_07_072231_create_categories_table', 1),
(20, '2020_09_07_072513_create_category_translations_table', 1),
(21, '2020_09_13_185709_create_modules_table', 1),
(22, '2020_09_14_170833_create_module_users_table', 1),
(23, '2020_09_26_075055_create_faqs_table', 1),
(24, '2020_09_26_075432_create_faq_translations_table', 1),
(25, '2020_10_15_220340_create_user_profiles_table', 1),
(26, '2021_01_10_001648_create_investment_capitals_table', 1),
(27, '2021_01_10_001815_create_plans_table', 1),
(29, '2021_01_14_212519_create_tags_table', 2),
(30, '2021_01_16_112246_create_category_plans_table', 3),
(31, '2021_01_16_112642_create_plan_tags_table', 3),
(32, '2021_01_16_134834_create_dummy_users_table', 4),
(33, '2021_01_19_001519_create_wallets_table', 5),
(34, '2021_01_19_010737_create_orders_table', 6),
(35, '2021_01_24_120026_add__t_ransaction_id_to_wallets_table', 7),
(36, '2021_01_24_165859_add_opening_balance_to_plans_table', 8),
(37, '2021_01_24_172044_create_planlogs_table', 9),
(38, '2021_01_28_153253_create_subscriptions_table', 10),
(39, '2021_01_28_173247_add_is_move_to_orders_table', 10),
(40, '2021_01_31_195200_create_subscription_redeems_table', 11),
(41, '2021_01_31_205310_add_sebi_to_settings_table', 11),
(42, '2021_01_31_223453_create_contact_us_table', 11),
(43, '2021_02_01_231919_add_referral_code_to_users_table', 12),
(44, '2021_02_01_235556_add_request_data_to_dummy_users_table', 13),
(46, '2021_02_02_001901_create_referral_uses_table', 14),
(47, '2021_02_06_223755_add_wallet_charge_to_settings_table', 15),
(48, '2021_02_07_012803_create_referral_logs_table', 16),
(49, '2021_02_10_220648_create_set_redeem_amounts_table', 17),
(50, '2021_02_19_124003_create_bids_table', 18),
(51, '2021_02_19_134309_create_bid_users_table', 18),
(53, '2021_02_21_143656_add_type_to_plans_table', 19),
(54, '2021_02_21_170049_add_image_to_contact_us_table', 20),
(57, '2021_02_21_231736_add_status_to_bid_users_table', 21),
(58, '2021_02_21_232121_add_status_to_bids_table', 21),
(59, '2021_02_22_225820_add_avg_amount_to_orders_table', 22),
(60, '2021_02_23_010643_add_avg_amount_to_subscriptions_table', 23),
(61, '2021_02_23_233147_add_market_cap_to_plans_table', 24),
(62, '2021_02_25_002536_add_pl_to_plans_table', 25),
(63, '2021_02_25_223629_add_is_pms_to_orders_table', 26),
(64, '2021_02_25_223902_add_is_pms_to_users_table', 26),
(65, '2021_02_26_213407_add_pl_to_planlogs_table', 27),
(66, '2021_02_26_233830_add_earning_per_share_to_plan_table', 28),
(68, '2021_02_27_231517_create_subscription_holdings_table', 29),
(69, '2021_03_02_001921_create_statements_table', 30);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `controller`, `status`) VALUES
(1, 'Customer', 'CustomerController', 1),
(2, 'Staffs', 'StaffsController', 1),
(3, 'Pages', 'PagesController', 1),
(4, 'Email', 'EmailController', 1),
(5, 'Banner', 'BannerController', 1),
(6, 'Setting', 'SettingController', 1),
(7, 'Job Area', 'ZoneController', 1),
(8, 'Vehicles Types', 'TypeController', 1),
(9, 'Vehicles Companies', 'MakeController', 1),
(10, 'Vehicles Models', 'VehicleModelController', 1),
(11, 'Faqs', 'FaqController', 1),
(12, 'Categories', 'CategoryController', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_user`
--

CREATE TABLE `module_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Unread,2=>Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `language`, `title`, `url`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Admin has been updated your account.', 1, '2021-01-10 16:45:41', '2021-01-10 16:45:41'),
(2, 2, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account password has been changed by administrator,please use this Octal@123 and login your account.', 1, '2021-01-10 16:50:23', '2021-01-10 16:50:23'),
(3, 4, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Admin has been updated your account.', 1, '2021-01-16 19:54:45', '2021-01-16 19:54:45'),
(5, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-01-17 19:25:30', '2021-01-17 19:25:30'),
(6, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-01-17 19:25:32', '2021-01-17 19:25:32'),
(7, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-01-17 19:25:35', '2021-01-17 19:25:35'),
(8, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account has been deactivated, please contact our support team otherwise Please check your inbox and verify your email address.', 1, '2021-01-17 19:25:38', '2021-01-17 19:25:38'),
(9, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-01-17 19:50:19', '2021-01-17 19:50:19'),
(10, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-01-17 19:51:04', '2021-01-17 19:51:04'),
(11, 2, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been rejected by administrator. because <b>sdsd</b>', 1, '2021-01-17 20:03:46', '2021-01-17 20:03:46'),
(49, 3, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been added  500.00 in your wallet, current balance now is 500.00, and please see more details in your passbook on app', 1, '2021-02-06 17:05:18', '2021-02-06 17:05:18'),
(50, 5, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'message.REFERRAL_AMOUNT', 1, '2021-02-06 19:50:00', '2021-02-06 19:50:00'),
(51, 5, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'You have received a referral bonus for Feb  amount 0.40 in your wallet, current balance now is 822.80, and please see more details in your passbook on app', 1, '2021-02-06 19:56:12', '2021-02-06 19:56:12'),
(56, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account password has been changed by administrator,please use this Admin@123 and login your account.', 1, '2021-02-09 14:02:06', '2021-02-09 14:02:06'),
(58, 3, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'You have successfully added  10,000.00 in your wallet, current balance now is 8,145.00, and please see more details in your passbook on app', 1, '2021-02-12 12:03:23', '2021-02-12 12:03:23'),
(60, 9, 'en', 'User Registered', 'http://127.0.0.1/project/tradingPartner/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-02-14 16:05:42', '2021-02-14 16:05:46'),
(61, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-02-14 16:41:07', '2021-02-14 16:41:07'),
(62, 3, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been added  10.00 in your wallet, current balance now is 10.00, and please see more details in your passbook on app', 1, '2021-02-14 16:41:33', '2021-02-14 16:41:33'),
(63, 3, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been added  1,000,000.00 in your wallet, current balance now is 1,000,010.00, and please see more details in your passbook on app', 1, '2021-02-14 16:44:52', '2021-02-14 16:44:52'),
(65, 3, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been debit 500.00 in your wallet, current balance now is 990,510.00, and please see more details in your passbook on app', 1, '2021-02-14 17:40:30', '2021-02-14 17:40:30'),
(78, 4, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been credit 10,000.00 in your wallet, current balance now is 10,000.00, and please see more details in your passbook on app', 1, '2021-02-25 18:22:38', '2021-02-25 18:22:38'),
(79, 3, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been credit 400,000.00 in your wallet, current balance now is 400,000.00, and please see more details in your passbook on app', 1, '2021-02-25 18:28:15', '2021-02-25 18:28:15'),
(96, 3, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account password has been changed by administrator,please use this Abc@123 and login your account.', 1, '2021-02-26 18:32:49', '2021-02-26 18:32:49'),
(100, 5, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account kyc has been approved by administrator.', 1, '2021-02-27 17:09:39', '2021-02-27 17:09:39'),
(101, 5, 'en', 'Account Status', 'http://127.0.0.1/project/tradingPartner', 'Your account password has been changed by administrator,please use this Abc@123 and login your account.', 1, '2021-02-27 17:11:38', '2021-02-27 17:11:38'),
(102, 5, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been credit 10,000.00 in your wallet, current balance now is 10,000.00, and please see more details in your passbook on app', 1, '2021-02-27 17:13:11', '2021-02-27 17:13:11'),
(104, 5, 'en', 'Wallet Status', 'http://127.0.0.1/project/tradingPartner/admin/customer/index', 'Administrator has been credit 10,000.00 in your wallet, current balance now is 10,000.00, and please see more details in your passbook on app', 1, '2021-02-27 18:13:15', '2021-02-27 18:13:15'),
(106, 10, 'en', 'User Registered', 'http://bankniftypms.com/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-02-28 08:05:36', '2021-02-28 08:05:37'),
(108, 11, 'en', 'User Registered', 'http://bankniftypms.com/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-02-28 12:42:12', '2021-02-28 12:42:14'),
(112, 12, 'en', 'User Registered', 'http://bankniftypms.com/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-02-28 16:52:01', '2021-02-28 16:52:02'),
(113, 12, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account kyc has been approved by administrator.', 1, '2021-02-28 16:56:21', '2021-02-28 16:56:21'),
(114, 12, 'en', 'Wallet Status', 'http://bankniftypms.com/admin/customer/index', 'Administrator has been credit 10,000.00 in your wallet, current balance now is 10,000.00, and please see more details in your passbook on app', 1, '2021-02-28 16:56:51', '2021-02-28 16:56:51'),
(119, 12, 'en', 'Wallet Status', 'http://www.bankniftypms.com/admin/customer/index', 'You have successfully added  -15,380.00 in your wallet, current balance now is -15,380.00, and please see more details in your passbook on app', 1, '2021-03-01 12:23:37', '2021-03-01 12:23:38'),
(120, 13, 'en', 'User Registered', 'http://bankniftypms.com/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-03-01 15:55:06', '2021-03-01 15:55:07'),
(121, 13, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account kyc has been approved by administrator.', 1, '2021-03-01 15:56:34', '2021-03-01 15:56:34'),
(122, 13, 'en', 'Wallet Status', 'http://bankniftypms.com/admin/customer/index', 'Administrator has been credit 15,000.00 in your wallet, current balance now is 15,000.00, and please see more details in your passbook on app', 1, '2021-03-01 15:57:04', '2021-03-01 15:57:04'),
(124, 11, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account kyc has been approved by administrator.', 1, '2021-03-01 16:49:43', '2021-03-01 16:49:43'),
(125, 11, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account password has been changed by administrator,please use this Test@123 and login your account.', 1, '2021-03-01 16:50:08', '2021-03-01 16:50:08'),
(141, 12, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account kyc has been approved by administrator.', 1, '2021-03-03 17:55:50', '2021-03-03 17:55:50'),
(174, 14, 'en', 'User Registered', 'http://bankniftypms.com/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-03-04 16:20:34', '2021-03-04 16:20:35'),
(175, 14, 'en', 'Account Status', 'http://www.bankniftypms.com', 'Your account kyc has been approved by administrator.', 1, '2021-03-04 16:24:55', '2021-03-04 16:24:55'),
(176, 14, 'en', 'Wallet Status', 'http://www.bankniftypms.com/admin/customer/index', 'Administrator has been credit 5,000.00 in your wallet, current balance now is 5,000.00, and please see more details in your passbook on app', 1, '2021-03-04 16:25:49', '2021-03-04 16:25:49'),
(182, 14, 'en', 'Wallet Status', 'http://www.bankniftypms.com/admin/customer/index', 'Administrator has been credit 5,000.00 in your wallet, current balance now is 5,000.00, and please see more details in your passbook on app', 1, '2021-03-04 17:57:54', '2021-03-04 17:57:54'),
(184, 13, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account password has been changed by administrator,please use this Test@123 and login your account.', 1, '2021-03-04 17:59:37', '2021-03-04 17:59:37'),
(185, 14, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account password has been changed by administrator,please use this Test@123 and login your account.', 1, '2021-03-04 18:00:28', '2021-03-04 18:00:28'),
(190, 15, 'en', 'User Registered', 'http://bankniftypms.com/public/admin/customer/index', 'Your account has been successfully registered', 1, '2021-03-04 20:59:19', '2021-03-04 20:59:20'),
(194, 11, 'en', 'Account Status', 'http://www.bankniftypms.com', 'Your account password has been changed by administrator,please use this Test@123 and login your account.', 1, '2021-03-05 21:22:55', '2021-03-05 21:22:55'),
(195, 11, 'en', 'Account Status', 'http://www.bankniftypms.com', 'Your account password has been changed by administrator,please use this Test@123 and login your account.', 1, '2021-03-05 21:23:06', '2021-03-05 21:23:06'),
(198, 15, 'en', 'Account Status', 'http://www.bankniftypms.com', 'Your account kyc has been approved by administrator.', 1, '2021-03-06 06:46:27', '2021-03-06 06:46:27'),
(205, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 400', 1, '2021-03-06 08:29:31', '2021-03-06 08:29:32'),
(206, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 1980.00 his wallet', 1, '2021-03-06 08:33:01', '2021-03-06 08:33:02'),
(207, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 400', 1, '2021-03-06 08:42:02', '2021-03-06 08:42:03'),
(208, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 494.90 his wallet', 1, '2021-03-06 09:20:22', '2021-03-06 09:20:22'),
(209, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS plan and his qty is 200', 1, '2021-03-06 09:32:56', '2021-03-06 09:32:57'),
(210, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 5,000.00 his wallet', 1, '2021-03-06 09:40:19', '2021-03-06 09:40:19'),
(211, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 400', 1, '2021-03-06 09:40:56', '2021-03-06 09:40:57'),
(212, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 2919.65 his wallet', 1, '2021-03-06 09:41:36', '2021-03-06 09:41:37'),
(213, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 400', 1, '2021-03-06 09:45:19', '2021-03-06 09:45:19'),
(214, 14, 'en', 'Account Status', 'http://bankniftypms.com', 'Your account password has been changed by administrator,please use this Test@123 and login your account.', 1, '2021-03-06 09:53:06', '2021-03-06 09:53:06'),
(215, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 494.90 his wallet', 1, '2021-03-06 09:54:23', '2021-03-06 09:54:23'),
(216, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 0.00 his wallet', 1, '2021-03-06 09:56:42', '2021-03-06 09:56:43'),
(217, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 0.00 his wallet', 1, '2021-03-06 09:58:13', '2021-03-06 09:58:13'),
(218, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 1000', 1, '2021-03-06 10:14:07', '2021-03-06 10:14:07'),
(219, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS HOLDING plan and his qty is 100', 1, '2021-03-06 11:08:23', '2021-03-06 11:08:23'),
(220, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 949.78 his wallet', 1, '2021-03-06 11:10:10', '2021-03-06 11:10:11'),
(221, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 36051.80 his wallet', 1, '2021-03-06 11:27:20', '2021-03-06 11:27:21'),
(222, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 20', 1, '2021-03-06 12:24:27', '2021-03-06 12:24:28'),
(223, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 5,000.00 his wallet', 1, '2021-03-06 12:27:10', '2021-03-06 12:27:11'),
(224, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 1000', 1, '2021-03-06 12:28:23', '2021-03-06 12:28:24'),
(225, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 12156.45 his wallet', 1, '2021-03-06 13:01:08', '2021-03-06 13:01:09'),
(226, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS plan and his qty is 20', 1, '2021-03-06 13:08:13', '2021-03-06 13:08:14'),
(227, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 100.00 his wallet', 1, '2021-03-06 13:08:51', '2021-03-06 13:08:52'),
(228, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 1000', 1, '2021-03-06 13:17:08', '2021-03-06 13:17:09'),
(229, 1, 'en', 'Wallet Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been added a 9678.65 his wallet', 1, '2021-03-06 13:32:47', '2021-03-06 13:32:47'),
(230, 1, 'en', 'Plan Status', 'http://bankniftypms.com/public/admin/customer/index', 'Arif Ahmad has been Buy a PMS INFRA plan and his qty is 1000', 1, '2021-03-06 13:42:06', '2021-03-06 13:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0844c2b2aa48e8c402e3d2b217c53125551edbdb46180bdbdbbd12c3199614988168821701088dd3', 14, 1, 'token', '[]', 0, '2021-03-04 18:14:27', '2021-03-04 18:14:27', '2022-03-04 23:44:27'),
('10e7049e95d4a41459fc0592ada057c3a48fce7539ca41606448d302ae41714559cbab634a3a9213', 12, 1, 'token', '[]', 0, '2021-02-28 17:16:40', '2021-02-28 17:16:40', '2022-02-28 22:46:40'),
('118100825b2e77dba47f81135ef1b273165ae805f230cba077de6654b9c1bd90adaf300ff5d26b70', 5, 1, 'token', '[]', 0, '2021-01-28 17:56:28', '2021-01-28 17:56:28', '2022-01-28 23:26:28'),
('12e4c2b506b1875b3abd70e98900a5016a1ce53e8410176e1663f404e759485f7414c66f002cf6c6', 12, 1, 'token', '[]', 0, '2021-03-03 03:02:40', '2021-03-03 03:02:40', '2022-03-03 08:32:40'),
('18b7c1bd089942104631063fb5bee436293cb3706dfef24ddd5309039265faebe59dd2e9ef7c723d', 14, 1, 'token', '[]', 0, '2021-03-05 21:32:14', '2021-03-05 21:32:14', '2022-03-06 03:02:14'),
('19de986fac7f64421209107663fb87b0c70e263794a143281c7fb7e23c5ac6d8b5894788b1fa05c6', 14, 1, 'token', '[]', 0, '2021-03-04 16:20:35', '2021-03-04 16:20:35', '2022-03-04 21:50:35'),
('1f71bea9457f4cf2b85a89d66bd77cbb5bdf0559098b338a60afb6c821f0ac0f4b7ad2f934b4abd1', 12, 1, 'token', '[]', 0, '2021-03-01 18:06:36', '2021-03-01 18:06:36', '2022-03-01 23:36:36'),
('26d9681e974c7f099732faa00976cc7f51d3a69e0011c2f96dcfee6bb0b8edb443b36bb4ac09b7ef', 14, 1, 'token', '[]', 0, '2021-03-06 09:53:48', '2021-03-06 09:53:48', '2022-03-06 15:23:48'),
('303d0de7ce4e7c9bf662a922ad341b06d0aa5683127a125b17afdaeb31cee31be7dd0584262ab31a', 3, 1, 'token', '[]', 0, '2021-02-21 11:14:00', '2021-02-21 11:14:00', '2022-02-21 16:44:00'),
('33c162568fa43d623d5f82c33124caab14c11f88a4c2974b6bb24acfda68574a4a62720c85b36bd5', 12, 1, 'token', '[]', 0, '2021-02-28 17:03:09', '2021-02-28 17:03:09', '2022-02-28 22:33:09'),
('340f93459dd44dcc225cb99f3ed20714b50e968c7143135b9d8d73065da8b47ecda095367cef1330', 14, 1, 'token', '[]', 0, '2021-03-05 06:01:34', '2021-03-05 06:01:34', '2022-03-05 11:31:34'),
('41606f9ba8fc9915f240ee0fc6a6c875e3c7f7390e519626384b825c581981744f30682921d5f208', 13, 1, 'token', '[]', 0, '2021-03-01 15:55:07', '2021-03-01 15:55:07', '2022-03-01 21:25:07'),
('483388c077dcd84bbcb7a97bf27fe2b18cd287d1b58a810a2415e6a34da1237361939c7f64761780', 12, 1, 'token', '[]', 0, '2021-03-03 17:54:01', '2021-03-03 17:54:01', '2022-03-03 23:24:01'),
('4deb61348ae6524258d7d5daf2f67e4103654044ce8305229dc602148898bedaab862dbcbe484870', 11, 1, 'token', '[]', 0, '2021-03-05 21:26:42', '2021-03-05 21:26:42', '2022-03-06 02:56:42'),
('53f66a6af6d13bacc1c75d4c8afaa80cfc70fab3dccd08b9f399806c4f34aa64b25bdd6e9f41f516', 15, 1, 'token', '[]', 0, '2021-03-04 20:59:20', '2021-03-04 20:59:20', '2022-03-05 02:29:20'),
('6c60cd2d59064c95c77bb7810562fbb4859c70a4184c182dafce3907de1cdc7695c0f80006ae78c7', 12, 1, 'token', '[]', 0, '2021-03-03 03:11:19', '2021-03-03 03:11:19', '2022-03-03 08:41:19'),
('70ca2e94bded7114a1d0f972144e6728413b36f456a0fbdf3c835aefd3fdfddf310d47ed6ffe2f9d', 6, 1, 'token', '[]', 0, '2021-02-01 18:40:10', '2021-02-01 18:40:10', '2022-02-02 00:10:10'),
('70fa43f94716b7bc145a05fad98d5e19c323aece51266a89f11d3a51cc76942440e80455ada98905', 7, 1, 'token', '[]', 0, '2021-02-01 18:46:53', '2021-02-01 18:46:53', '2022-02-02 00:16:53'),
('77866db8e514f905833924ecdb183c416afd971640430f4d75b60a4c917cdb782768c911419f982d', 12, 1, 'token', '[]', 0, '2021-03-01 17:07:19', '2021-03-01 17:07:19', '2022-03-01 22:37:19'),
('77bdbec9f9d604bb13ec662da78c6e2d5b5d2c7ef1eb772e6b5eae473f2b2c17b656ad761e999570', 12, 1, 'token', '[]', 0, '2021-03-01 03:58:00', '2021-03-01 03:58:00', '2022-03-01 09:28:00'),
('7a829e1521f100549f56208146d53b3997a0916d31f2b51c8e490226d9c893b247d1c2a6139bef01', 12, 1, 'token', '[]', 0, '2021-03-04 16:15:20', '2021-03-04 16:15:20', '2022-03-04 21:45:20'),
('7e01466d177152bb522818a72cdf020db751bf31d4154314438ee778afc03f7a494018ea53bd0320', 14, 1, 'token', '[]', 0, '2021-03-05 18:29:45', '2021-03-05 18:29:45', '2022-03-05 23:59:45'),
('7e49d2ea2218c130c188ddceb38b666344217f7e7aa1ef005e65aabc0cec193420fac413d3125ff4', 10, 1, 'token', '[]', 0, '2021-02-28 08:05:37', '2021-02-28 08:05:37', '2022-02-28 13:35:37'),
('7fabbf3702b9d3d69cf42d1276413c5a94080c8dd23ffb22aae8e7f77f9dfae1b6d86bb9f6b454a7', 14, 1, 'token', '[]', 0, '2021-03-06 08:28:54', '2021-03-06 08:28:54', '2022-03-06 13:58:54'),
('9a03750357e75baf2c8b986b92ceaf141ff7eb3d959728264b97ac6d728b4d85c45b8e0cd3eaa0e6', 11, 1, 'token', '[]', 0, '2021-02-28 12:42:13', '2021-02-28 12:42:13', '2022-02-28 18:12:13'),
('a042ae621cef65fd6b14304818d44dc42450f218bdef78d4c1b11a4ad6a26ee34f51dfd1c562c8ee', 12, 1, 'token', '[]', 0, '2021-02-28 16:52:02', '2021-02-28 16:52:02', '2022-02-28 22:22:02'),
('a5682c96ef127fc6d665674b0a04ac75599f9dfebc537f32adec8ac77689580c5c914e7cbdbc4c20', 12, 1, 'token', '[]', 0, '2021-03-04 02:32:25', '2021-03-04 02:32:25', '2022-03-04 08:02:25'),
('a8d7459f9d2eef042cf71e05ebdf06b0cefa4de697e6b001c51ea57a5f7e05bac0dc4f9209d2af82', 12, 1, 'token', '[]', 0, '2021-03-04 03:15:13', '2021-03-04 03:15:13', '2022-03-04 08:45:13'),
('b265070147059cd4ab16c06b62edea9355abee4fee95bd309421d37fa86b61275f528af4c87c4c01', 11, 1, 'token', '[]', 0, '2021-03-01 16:50:24', '2021-03-01 16:50:24', '2022-03-01 22:20:24'),
('c192133846438804e292afb5c3c328f4ba4601360e9eedc4be49743bd0c593afc44b22bc6fa9436d', 12, 1, 'token', '[]', 0, '2021-03-03 18:01:07', '2021-03-03 18:01:07', '2022-03-03 23:31:07'),
('c3d5d4ec499356ce65ff3e27185174c4dc0297c33f1299dd9ddf619eaf0d80469356fcee83c6cb71', 9, 1, 'token', '[]', 0, '2021-02-14 16:05:46', '2021-02-14 16:05:46', '2022-02-14 21:35:46'),
('c8c0b1a92dbcc981dcbdcbd14489607304e195df688fa37518bdf523f2323b7310d214e31c8f3a52', 5, 1, 'token', '[]', 0, '2021-02-27 17:11:45', '2021-02-27 17:11:45', '2022-02-27 22:41:45'),
('c9f04070bad6ce96dd956f350a41b9e9daece047de343d10d6a17f7c288f514364da1e8cfa66b8ef', 4, 1, 'token', '[]', 0, '2021-02-22 18:44:56', '2021-02-22 18:44:56', '2022-02-23 00:14:56'),
('cac05d9258fab520e97cce941cc616a3af676f30deaca5e981389230c0c773a17c7522b11fbe5da5', 8, 1, 'token', '[]', 0, '2021-02-01 18:58:47', '2021-02-01 18:58:47', '2022-02-02 00:28:47'),
('d5be40052f0223d3bc68eb2a9c934fd0884427d7a6aec9516c58c1ab594d32fd99f914d7eb8193b0', 12, 1, 'token', '[]', 0, '2021-03-03 17:04:58', '2021-03-03 17:04:58', '2022-03-03 22:34:58'),
('d7033122e80725cb3e0bfa7756ff221bc64c995040f884929a286a9322bf81b6ceed378cad500d57', 12, 1, 'token', '[]', 0, '2021-03-04 03:29:43', '2021-03-04 03:29:43', '2022-03-04 08:59:43'),
('d98f1672c92e87887f1bf218c94d42b07255ba91ce008929867bcbc5877e3b5a14253314bc6d5570', 11, 1, 'token', '[]', 0, '2021-02-28 19:34:28', '2021-02-28 19:34:28', '2022-03-01 01:04:28'),
('e48f24459da3776e830ba9cfe5a14324bffcff58e023e7a42ca05894e83819abf7970eb2b31167b9', 14, 1, 'token', '[]', 0, '2021-03-06 11:38:20', '2021-03-06 11:38:20', '2022-03-06 17:08:20'),
('f16b2650a9d40ed4ab07bf18ee7594a2a4244a1530d45690d8f851f2f483a73dc21aef4b8b52e0b9', 14, 1, 'token', '[]', 0, '2021-03-04 18:00:51', '2021-03-04 18:00:51', '2022-03-04 23:30:51'),
('f32c4d8dd9ebef8947a893531a79dde682ee839496b4e1811131aed1a9d1591b924063acc9d7bdce', 3, 1, 'token', '[]', 0, '2021-02-26 18:33:00', '2021-02-26 18:33:00', '2022-02-27 00:03:00'),
('f451a07a1cd9c0f70bd59e5fa7a7d2f117f89272e65568414deb3ec12c12711aa603c8d53252eb41', 12, 1, 'token', '[]', 0, '2021-03-01 18:01:47', '2021-03-01 18:01:47', '2022-03-01 23:31:47'),
('f575da6b5d1c04d329e46619ed04f45b5bc56a242400852da29a000538a4e67e8965f2c4a5135b8e', 14, 1, 'token', '[]', 0, '2021-03-04 18:00:30', '2021-03-04 18:00:30', '2022-03-04 23:30:30'),
('fe07db7f779981595497f1dd38aa7a9358ac87d1728877d7239bf53f0b30e0bdb401d2384002360a', 11, 1, 'token', '[]', 0, '2021-03-05 21:25:02', '2021-03-05 21:25:02', '2022-03-06 02:55:02'),
('ff1de36bedc9d5e2e86b3f7ed7f00d1bc540c6be1dd1273d7d88e18f0df13bf4afdae24b3d724a9e', 11, 1, 'token', '[]', 0, '2021-03-05 21:23:57', '2021-03-05 21:23:57', '2022-03-06 02:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, NULL, 'tradingPartner Personal Access Client', 'OL5Kg97XKihITendUAozhkc8tNcOdpsNy5FW9NCx', NULL, 'http://localhost', 1, 0, 0, '2021-01-16 09:11:16', '2021-01-16 09:11:16'),
(2, NULL, 'tradingPartner Password Grant Client', 'AqNPTRgwSkM1ZtfaeCJjeYbShiqxD4ndYk3AKSsG', 'users', 'http://localhost', 0, 1, 0, '2021-01-16 09:11:16', '2021-01-16 09:11:16');

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
(1, 1, '2021-01-16 09:11:16', '2021-01-16 09:11:16');

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Buy,2=>Redeem',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_move` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes,0=>No',
  `avg_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `all_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pms` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>No,1=>Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `plan_id`, `qty`, `remark`, `status`, `type`, `created_at`, `updated_at`, `is_move`, `avg_amount`, `all_amount`, `is_pms`) VALUES
(1, 14, '5000.00', 3, '1000.00', 'Waiting for funds allocation', 1, 2, '2021-03-06 12:28:23', '2021-03-14 06:22:03', 1, '0.00', NULL, 1),
(2, 14, '8.00', 3, '1000.00', 'PMS Stop', 1, 2, '2021-03-06 13:01:09', '2021-03-14 06:22:03', 1, '0.00', NULL, 0),
(3, 14, '100.00', 1, '20.00', 'Waiting for funds allocation', 1, 2, '2021-03-06 13:08:13', '2021-03-14 06:22:03', 1, '0.00', NULL, 1),
(4, 14, '7.50', 1, '20.00', 'PMS Stop', 1, 2, '2021-03-06 13:08:52', '2021-03-14 06:22:04', 1, '0.00', NULL, 0),
(5, 14, '5000.00', 3, '1000.00', 'Waiting for funds allocation', 1, 2, '2021-03-06 13:17:08', '2021-03-14 06:22:05', 1, '0.00', NULL, 1),
(6, 14, '10.00', 3, '1000.00', 'PMS Stop', 1, 2, '2021-03-06 13:32:48', '2021-03-14 06:22:05', 1, '0.00', NULL, 0),
(7, 14, '5000.00', 3, '1000.00', 'Waiting for funds allocation', 1, 1, '2021-03-06 13:42:05', '2021-03-06 13:42:05', 0, '0.00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-02-06 05:45:41', '2021-02-06 05:45:41'),
(2, 1, '2021-02-06 05:46:44', '2021-02-06 05:46:44'),
(3, 1, '2021-02-06 05:47:34', '2021-02-06 05:47:34'),
(4, 1, '2021-02-06 05:48:26', '2021-02-06 05:48:26'),
(5, 1, '2021-02-26 20:47:34', '2021-02-26 20:47:34'),
(6, 1, '2021-03-14 10:25:28', '2021-03-14 10:25:28'),
(7, 1, '2021-03-14 10:25:47', '2021-03-14 10:25:47'),
(8, 1, '2021-03-14 10:26:07', '2021-03-14 10:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `title`, `description`, `meta_keyword`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'About us', '<div class=\"container\">\r\n<div class=\"section-title\">\r\n<h2>About Our App</h2>\r\n\r\n<div class=\"bar\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"row align-items-center\">\r\n<div class=\"col-lg-6\">\r\n<div class=\"about-content\">\r\n<h3>Our process is simple, Our App is powerful</h3>\r\n\r\n<div class=\"bar\">&nbsp;</div>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable.</p>\r\n\r\n<p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-6\">\r\n<div class=\"about-image\"><img alt=\"image\" src=\"img/about.png\" /></div>\r\n</div>\r\n</div>\r\n</div>', NULL, NULL, NULL, '2021-02-06 05:45:41', '2021-02-07 19:30:51'),
(2, 2, 'en', 'Privacy Policies', '<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">This Privacy Policy sets out how </span></span><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">HNI CALLS PRIVATE LIMITED</span></span></b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">&nbsp;(&ldquo;bankniftypms.com&rdquo;) uses and protects any information that its Clients provide. Bankniftypms.com has a firm policy of protecting the confidentiality and security of information that it collects from its Clients. Bankniftypms.com takes extreme care to ensure that the non- public personal information of its Clients is not shared with unaffiliated third parties as it considers the privacy of its Clients to be of paramount importance.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com is committed to safeguarding the privacy of its Clients. Any and all information by which its clients can be identified when accessing their account information will only be used in accordance with this Privacy statement.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com does not share the non‐public personal information of its Clients with unaffiliated third parties except as required by law or for its daily business purposes. Such information may be shared with Asset Management Companies without a prior intimation to its Clients in order to ensure that their requirements are met with in a timely manner.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">This Privacy Policy is subject to and incorporated in the Terms of Use posted on the bankniftypms.com Website.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Use of Website</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Any use of the bankniftypms.com Website constitutes acceptance of the terms of this Privacy Policy, including any amendments and/or modifications or revisions thereof, which may be made by bankniftypms.com at any time in its sole discretion.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Why We Collect</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">In the course of providing its Clients with products and services as per their requirements, bankniftypms.com may obtain non-public personal information about its Clients.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Use of Information</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com limits the collection and use of non‐public personal information to the minimum it believes is necessary to deliver the best services to its Clients. The said services include financial investment services in the fields of securities mutual funds and portfolio management, mutual fund distribution, investment, brokerage planning and development services, financial consultancy relating to tax, and advisory services relating to pension and tax planning.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">What We Collect</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com, in the course of providing products and services to its Clients, may collect and retain certain personal information about them including:</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li class=\"15\" style=\"margin-left:8px\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Name</span></span></li>\r\n	<li class=\"15\" style=\"margin-left:8px\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Email id</span></span></li>\r\n	<li class=\"15\" style=\"margin-left:8px\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Contact number</span></span></li>\r\n	<li class=\"15\" style=\"margin-left:8px\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Location and address</span></span></li>\r\n	<li class=\"15\" style=\"margin-left:8px\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Profile</span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Sharing Information With Employees</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">The employees of bankniftypms.com have limited access to the personal information of its Clients based on their responsibilities. All employees of bankniftypms.com have been duly instructed to protect the confidentiality of the same as described in these policies, which are strictly enforced.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">PMS Mobile Apps</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com mobile applications allow its Clients to access their accounts using wireless or mobile devices. The privacy practices of bankniftypms.com apply to any personal information or other information that bankniftypms.com may collect through the apps.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Privacy Principles Of PMS</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Bankniftypms.com does not sell, trade or rent Client information.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com does not share Client information with persons or entities outside bankniftypms.com who are doing business for their own marketing purposes except as provided hereinabove.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com offers the same protection for prospective Clients and former Clients with regard to the use of personal information.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com will continue to adhere to this Privacy Policy even if its relationship with a Client ends.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Links to Third - Party Sites</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">This Website may contain links to third-party Websites. Bankniftypms.com is not responsible for the contents, information, security or privacy practices of such other Websites. This Privacy Policy applies solely to this Website.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">The Clients of bankniftypms.com are expected to read the privacy statements of all the destination web sites which they visit. Bankniftypms.com does not control cookies on the third- party sites, and these are not subject to this Privacy Policy.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Disclosure</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com does not disclose any kind of non- public personal information about its Clients or former Clients to anyone except when we believe it necessary for the conduct of its business or where disclosure is required by law.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Storage of Information</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">All information obtained by bankniftypms.com is held in a secured database to which only they will have access.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Cookies</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com and its third-party service providers may use Cookies and similar technologies to support the operation of the Website. These Cookies help bankniftypms.com to collect information about Visitors to the Website including date and time of visits, pages viewed, amount of time spent on the Website or general information about the device used to access the site. Bankniftypms.com also uses Cookies for security purposes. The Visitors of the Website are at liberty to refuse/delete Cookies.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\">&nbsp;</p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">Amendment of Privacy Policy</span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">bankniftypms.com reserves the right to amend the Privacy Policy, in whole or in part, at its sole discretion. This page will be replaced with an updated version in the event there is a change in the Policy. Clients are expected to check the &ldquo;Privacy Policy&rdquo; page any time they access the bankniftypms.com Website so as to be aware of any changes which may occur from time to time.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-bottom:14px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\">The continued use of the bankniftypms.com Website constitutes the Users&rsquo; acknowledge and agreement to the Privacy Policy as modified, and that such Privacy Policy shall apply to the personal data previously collected by the Website. In the event a Client/Clients have an objection to the amendment carried out to the Privacy Policy, they may cease using the Website, and refrain from submitting any additional personal information to bankniftypms.com.</span></span></span></span></span></p>', NULL, NULL, NULL, '2021-02-06 05:46:44', '2021-02-21 09:39:43'),
(3, 3, 'en', 'Terms and conditions', '<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Introduction</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The following terms along with the disclaimer and privacy policy serve as the agreement governing the visitor&rsquo;s use of the website of HNI CALLS PRIVATE LIMITED private limited (&ldquo;bankniftypms.com&rdquo;).</span></span></span><br />\r\n<span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">By accessing, viewing, or using this site, the visitor acknowledges that you have read, understand, and agree with these terms. If you do not wish to be bound by these terms, please do not use this site.</span></span></span><br />\r\n<span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">By continuing to access or use this site or any service on this site, you signify your acceptance of these terms and conditions.</span></span></span><br />\r\n<span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">These terms and conditions are subject to change without notice from time to time at the sole discretion of bankniftypms.com. bankniftypms.com will notify the visitors of amendments to these terms and conditions by posting them to this website.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Registration</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Users of this Website are required to register their Profile with bankniftypms.com, and create their Account by providing the information required by bankniftypms.com.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Scope of the Terms and Conditions</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">These Terms, as amended by bankniftypms.com from time to time, set out the basis on which the Visitors may use this Website, and provide information about the way bankniftypms.com provides related services detailed on this Website, which include aggregation of data of Asset Management Companies, and providing information on the financial products and services of bankniftypms.com to Individual Users.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Acceptance of Terms of Use</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Agreement is an electronic contract that establishes the legally binding terms the Visitors should accept to use the Website.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Links to third- party Websites</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors of this Website agree and acknowledge not holding bankniftypms.com responsible for the content or operation of third party sites. A hyperlink from this Website to another Website does not imply that bankniftypms.com endorses the content on that web site or the operator or operations of that site. The Visitors are solely responsible for determining the extent to which they may use any content on any other Website to which they might link from this Website.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Use of the Website</span></span></span></span></b></span></span></span></p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors are prohibited from using this Website in a manner that causes, or may cause, damage to the Website or impairment of the availability or accessibility of the Website; or in any way which is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity.</span></span></span></span></span></span></li>\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors are also prohibited from using this Website for any purpose related to marketing without the express written consent of bankniftypms.com.</span></span></span></span></span></span></li>\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors are responsible for possessing a suitable computer equipment and software to access this Website.</span></span></span></span></span></span></li>\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors are permitted to use this Website and the services available through it for their own personal, non-commercial purposes. The sale of the services on this Website to a third party is prohibited.</span></span></span></span></span></span></li>\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors are prohibited from creating a link to any pages of this Website without the prior written consent of bankniftypms.com.</span></span></span></span></span></span></li>\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Misuse of this Website entitles bankniftypms.com to block the Users&rsquo; account immediately without prior notification.</span></span></span></span></span></span></li>\r\n	<li style=\"margin-top:7px; margin-bottom:7px; margin-left:8px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Any attempt to damage this Website is illegal, and bankniftypms.com reserves the right to seek damages/monetary relief for the same.</span></span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Intellectual Property rights</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">All information, text, tools and data format on this Website are the exclusive properties of bankniftypms.com. The Visitors are only permitted to view information on this Website. They or their Financial Advisors are not permitted to print, copy, download or store the same for commercial purposes. All intellectual and other property information shall continue to be held by bankniftypms.com, and no rights of any kind in it shall pass to the Visitors.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Indemnification</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors agree and undertake to keep bankniftypms.com indemnified against any losses, damages, costs, liabilities and expenses incurred or suffered by bankniftypms.com arising out of any breach of any of these terms and conditions, or arising out of any claim as a result of the breach of the terms and conditions by the Visitors.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Assignment</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Any rights granted to the Visitors and obligations incurred by the Visitors under these Terms and Conditions are personal to the Visitors, and may not be transferred to any third party. Bankniftypms.com may, at any time, sub-contract the performance of all or any of its obligations under these Terms and Conditions. Bankniftypms.com may transfer, assign, or delegate these Terms and its rights and obligations without the consent of the Visitors.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Variation of these Terms and Conditions</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">bankniftypms.com reserves the right to vary, in its sole discretion, the Terms and Conditions of Use from time to time. The latest version will be uploaded on the Website. The Visitors&rsquo; continued use of this Website implies agree to be legally bound by these terms and conditions, as amended or updated from time to time.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Unauthorized Use</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Visitors are responsible for any use of the Website by them. The Visitors undertake to use their best endeavours to ensure that none of their actions will damage the Website.</span></span></span><br />\r\n<span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Unauthorised use of this Website entitles PMS to initiate legal actions against the offender.</span></span></span><br />\r\n<span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Use of this Website may be monitored, tracked and recorded. Anyone using this Website expressly consents to such monitoring, tracking and recording.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Access to the Website</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">bankniftypms.com reserves the right to withdraw or amend the services it provides on this Website without notice or to restrict access to this Website. bankniftypms.com cannot be held liable if for any reason this Website is unavailable at any time or for any period.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Entire Agreement</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">These Terms and Conditions of Use, together with the Privacy Policy and Disclaimer of bankniftypms.com, constitutes the entire agreement between bankniftypms.com and the Visitors in relation to the use of the Website, and supersedes all previous agreements in respect of the use of the Website.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Severability</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">If any part of these Terms and Conditions are held unlawful, void or unenforceable, that part will be deemed severable, and will not affect the validity and enforceability of any remaining provisions.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Waiver</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">In the event bankniftypms.com does not exercise any right or remedy which it has under these Terms &amp; Conditions, this does not mean bankniftypms.com has waived its right to it or any other right or remedy.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Applicable laws</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">These Terms and Conditions will be governed by and construed in accordance with Indian laws, and any disputes relating to the same will be subject to the non- exclusive jurisdiction of the Courts of West Bengal, India.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><b><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">Term</span></span></span></span></b></span></span></span></p>\r\n\r\n<p style=\"margin-top:7px; margin-bottom:7px\"><span style=\"font-size:11pt\"><span style=\"line-height:114%\"><span style=\"font-family:Calibri\"><span style=\"font-size:13.5000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Agreement is for an indefinite term. Subject to the terms contained herein, either bankniftypms.com or the Visitor can terminate this Agreement for any reason, provided that such termination shall be conditional upon, including but not limited to, discharge of all contractual and statutory obligations.</span></span></span></span></span></span></p>', NULL, NULL, NULL, '2021-02-06 05:47:35', '2021-02-21 09:38:12');
INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `title`, `description`, `meta_keyword`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(4, 4, 'en', 'Help', '<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">I. Introduction</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Website and the information provided on this Website to readers and Users have been issued by PMS Wealth Advisors Private Limited (&ldquo;</span></span></span><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">bankniftypms.com</span></span></span></span></b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">&rdquo;).</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Disclaimer governs the use of the bankniftypms.com Website. Usage of the Website implies acceptance of the Disclaimer in full. An individual / corporate entity who / which has a disagreement with any part of this Disclaimer shall not use this Website.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Usage of this Website also implies that the exclusions and limitations of liability set out in this Disclaimer are reasonable.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">II. Purpose</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The information contained in this Website is intended to provide Users with objective information about the Portfolio management services and strategies, and financial products and services of bankniftypms.com. The same is not intended to constitute a recommendation, guidance or proposal in regard to the suitability of any product in respect of any financial needs of the Users. Bankniftypms.com only provides suggestions with regard to the suitability of a financial product in view of the financial needs of the Users. These suggestions are given by bankniftypms.com only on the basis of the User profile and other information provided by the Users. Bankniftypms.com assumes no responsibility for any risk faced by the Users as a result of inaccuracy/incompleteness of the said information.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Bankniftypms.com may provide suggestions to the Users to avail the services of an Asset Management Company (&ldquo;AMC&rdquo;). Bankniftypms.com, however, assumes no responsibility for the performance of the said AMC.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The information contained in this Website is solely for general information purposes. The said information is provided by bankniftypms.com, and bankniftypms.com makes no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the Website or the information, products, services, or related graphics contained on the Website for any purpose. Bankniftypms.com assumes no responsibility for errors or omissions in the contents on the Website.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The information contained in this Website is neither to be construed as financial advice nor to be regarded as a definitive analysis of any financial, legal or other issue in itself. No reliance should be made solely on this information to make a financial or investment decision. Bankniftypms.com is only making suggestions to the Users with regard to the suitability of a financial product, and the final decision is the sole responsibility of the Users.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">III. No warranties</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Website is provided &ldquo;as is&rdquo; without any representations or warranties, express or implied. In no event will bankniftypms.com be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this Website.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">IV. PMS Performance</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The performance of PMS strategies may or may not be sustained in future, and the same is not to be used as a basis for comparison with other investments. The names of the strategies do not indicate its future prospects and returns in any manner. The Data placed on this Website are extracted from the Factsheets/Disclosures of the respective AMCs, and from the investor statements distributed by bankniftypms.com. Bankniftypms.com has taken due care and caution for the compilation of data on this Website. In no event will bankniftypms.com be liable for any error or omissions in the information or the consequences of the use of the information on this Website.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">V. Assumption of risk</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Users agree and acknowledge that the use of this Website is done at their own risk.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The information contained on the Website is a summary of the business of bankniftypms.com, is provided for the understanding and convenience of the Users, and is subject to change without notice. Accordingly, any financial or investment decision must be made by Users on the information contained in the prospectus of bankniftypms.com, and not solely on the contents of this Website.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">VI. Third- party Websites</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Users of this Website are able to link to other Websites, which are not under the control of bankniftypms.com. Bankniftypms.com has no control over the nature, content and availability of those sites. The inclusion of any link does not necessarily imply a recommendation or endorse the views expressed within them.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Bankniftypms.com does not guarantee the accuracy, relevance or completeness of the information contained in these third party sites.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">VII. Individual Users</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Website contains general clauses in relation to the business of bankniftypms.com, and does not take into account specific investment goals, the financial situation or specific requirements of individual Users. In view of the same, individual Users are required to obtain financial advice as to the suitability of their financial situation and requirements prior to making an investment. Bankniftypms.com accepts no liability for the individual Users&rsquo; sole reliance on the information contained in this Website.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Bankniftypms.com states and affirms that not all financial products are suitable for all Investors. It is the sole responsibility of the Investor to understand, and make an independent assessment of the suitability and appropriateness of the financial product. Bankniftypms.com assumes no responsibility for the same.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">VIII. Smooth running of the Website</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">bankniftypms.com takes all possible steps to ensure that the Website runs smoothly. However, bankniftypms.com takes no responsibility for, and will not be liable for, the Website being temporarily unavailable due to technical issues beyond its control.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">IX. Reproduction of the Website</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">Any reproduction of this Website, in whole or in part, is strictly prohibited. The Users of the Website agree and acknowledge that they will use, and they will instruct their advisors and professionals assisting them to use the information on the Website only for making decisions with regard to investments, and balancing risk against performance.</span></span></span><br />\r\n<span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Users of this Website are not permitted to publish, transmit, or otherwise reproduce this Website or information from this Website, in whole or in part, in any format without the express written consent of bankniftypms.com.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">X. Intellectual Property rights</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">bankniftypms.com owns the intellectual property rights in the Website and the material on the Website, which are reserved. Republishing/reproduction of the contents on this Website would amount to an infringement of the intellectual property rights of bankniftypms.com.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">XI. Indemnification</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">The Users agree and undertake to keep bankniftypms.com indemnified against any losses, damages, costs, liabilities and expenses incurred or suffered by bankniftypms.com arising out of any breach of any of these terms and conditions, or arising out of any claim as a result of the breach of the terms and conditions by the Users.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">XII. Harmful components on the Website</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">bankniftypms.com takes all possible steps to ensure that this Website is free of viruses or other harmful components. However, bankniftypms.com does not warrant the Website is absolutely free of the same.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">XIII. Amendment of this Disclaimer</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">bankniftypms.com reserves the right to amend this Disclaimer from time to time at its sole discretion. The revised Disclaimer will apply to the use of the Website with effect from the date of the publication of the revised Disclaimer on the Website. The Users are, therefore, required to visit this Website Disclaimer on an ongoing basis to be apprised of any changes.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">XIV. Consequences of breach of the terms and conditions</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">In the event of breach of these terms and conditions by a User/Users, bankniftypms.com is at liberty to take such action as bankniftypms.com deems appropriate to deal with the breach, including suspending the User/Users&rsquo; access to the Website; prohibiting the User/Users from accessing the Website; blocking computers using the Users&rsquo; IP address from accessing the Website; contacting the Users&rsquo; internet service provider to request that they block their access to the Website; and/or initiating legal actions against the User/Users.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">XV. Entire Agreement</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Disclaimer, together with the Privacy Policy and the Terms and Conditions of Use of bankniftypms.com constitutes the entire agreement between bankniftypms.com and the Users in relation to the use of the Website, and supersedes all previous agreements in respect of the use of the Website.</span></span></span></span></p>\r\n\r\n<h3 align=\"justify\" style=\"text-align:justify; margin-top:7px; margin-bottom:7px\"><span style=\"font-size:13.5pt\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-family:&quot;Times New Roman&quot;\"><span style=\"font-weight:bold\"><b><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\"><span style=\"font-weight:bold\">XVI. Applicable laws</span></span></span></span></b></span></span></span></span></h3>\r\n\r\n<p align=\"justify\" class=\"15\" style=\"text-align:justify\"><span style=\"text-justify:inter-ideograph\"><span style=\"font-size:12.0000pt\"><span style=\"font-family:Cambria\"><span style=\"color:#000000\">This Disclaimer will be governed by and construed in accordance with Indian laws, and any disputes relating to this Disclaimer will be subject to the non- exclusive jurisdiction of the Courts of West Bengal, India.</span></span></span></span></p>', NULL, NULL, NULL, '2021-02-06 05:48:26', '2021-02-21 09:39:23'),
(5, 5, 'en', 'SPM start', '<p>Like all securities, investing in stocks or its any instruments are subject to market, or systematic, risk. This is because there is no way to predict what will happen in the future or whether a given asset will increase or decrease in value. Because the market cannot be accurately predicted or completely controlled, no investment is risk-free, by accepting the I Accept button you are agreed &amp; accepted to all our terms &amp; Condition, Refund Policy &amp; Privacy Policy</p>', NULL, NULL, NULL, '2021-02-26 20:47:34', '2021-02-26 20:47:34'),
(6, 6, 'en', 'Cancellation Policy', '<p>Cancellation&nbsp;Policy</p>', NULL, NULL, NULL, '2021-03-14 10:25:28', '2021-03-14 10:25:28'),
(7, 7, 'en', 'Return Policy', '<p>Return&nbsp;Policy</p>', NULL, NULL, NULL, '2021-03-14 10:25:47', '2021-03-14 10:25:47'),
(8, 8, 'en', 'Refund Policy', '<p>Refund&nbsp;Policy</p>', NULL, NULL, NULL, '2021-03-14 10:26:07', '2021-03-14 10:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'anil01@gmail.com', '1182b3d6104a89450bf49af225c22a6ef0a4be50', '2021-01-16 09:06:31', '2021-01-16 09:06:31'),
(2, 'rajkumawat439@gmail.com', '986e08ff107f65683f0bb0d04478de5295b13485', '2021-02-28 07:59:07', '2021-02-28 07:59:07'),
(3, 'arifspj@gmail.com', '7778a5fc79dec1cab3fda7090c12ba3e7ca37a32', '2021-03-04 13:24:06', '2021-03-04 13:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `planlogs`
--

CREATE TABLE `planlogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` int(11) NOT NULL,
  `pre_closing_balance` decimal(10,2) DEFAULT NULL,
  `current_balance` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pl` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` int(11) NOT NULL DEFAULT 0,
  `pl_p` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planlogs`
--

INSERT INTO `planlogs` (`id`, `plan_id`, `pre_closing_balance`, `current_balance`, `created_at`, `updated_at`, `pl`, `type`, `pl_p`) VALUES
(1, 3, '4000.00', '4000.00', '2021-03-06 10:14:40', '2021-03-06 13:45:39', '4.00', 1, 80),
(2, 2, '500.00', '500.00', '2021-03-06 11:08:57', '2021-03-06 11:08:57', '5.00', 1, 100),
(3, 1, '5000.00', '5000.00', '2021-03-07 12:58:02', '2021-03-07 12:58:02', '0.00', 1, 0),
(4, 3, '5000.00', '5000.00', '2021-03-07 17:59:49', '2021-03-07 18:03:50', '-5.00', 0, -100);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT 1,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `position` int(11) DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `opening_balance` decimal(10,2) DEFAULT NULL,
  `closing_balance` decimal(10,2) DEFAULT NULL,
  `min_qty` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Redeem,2=>Trading',
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_cap` int(11) NOT NULL,
  `pl` decimal(10,2) NOT NULL DEFAULT 0.00,
  `earningPerShare` decimal(10,2) NOT NULL DEFAULT 0.00,
  `change` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `user_id`, `title`, `description`, `amount`, `qty`, `position`, `status`, `deleted_at`, `created_at`, `updated_at`, `opening_balance`, `closing_balance`, `min_qty`, `type`, `start_time`, `end_time`, `market_cap`, `pl`, `earningPerShare`, `change`) VALUES
(1, 1, 'PMS', '<p>Building wealth for our investors</p>\r\n\r\n<p>Professional Management Of Portfolio</p>\r\n\r\n<p>Controlling Risk</p>\r\n\r\n<p>Maximize the Returns</p>\r\n\r\n<p>Superior Returns</p>\r\n\r\n<p>The investment horizon of 3-5 days</p>', 5.00, 100000, 1, 1, NULL, '2021-02-23 18:18:12', '2021-03-07 12:58:01', '5.00', '0.00', NULL, 3, '09:00', '15:30', 0, '5000.00', '0.00', '0.00'),
(2, 1, 'PMS HOLDING', '<p>Building wealth for our investors</p>\r\n\r\n<p>Professional Management Of Portfolio</p>\r\n\r\n<p>Controlling Risk</p>\r\n\r\n<p>Maximize the Returns</p>\r\n\r\n<p>Superior Returns</p>\r\n\r\n<p>The investment horizon of 3-5 days</p>', 5.00, 100000, 1, 1, NULL, '2021-02-23 18:18:12', '2021-03-06 11:08:57', '5.00', '5.00', NULL, 3, '09:00', '15:30', 34550, '500.00', '5.00', '100.00'),
(3, 1, 'PMS INFRA', '<p>Invest in Property </p>', 5.00, 100000, 1, 1, NULL, '2021-03-02 19:59:15', '2021-03-07 18:03:50', '5.00', '-5.00', NULL, 3, '09:00', '15:30', 76959, '-5000.00', '-5.00', '-100.00'),
(4, 1, 'test anil', '<p>tet</p>', 5.00, 1200, 1, 1, NULL, '2021-03-07 12:43:11', '2021-03-07 12:43:11', '5.00', '0.00', 120, 3, '09:59', '15:30', 0, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `plan_tag`
--

CREATE TABLE `plan_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_tag`
--

INSERT INTO `plan_tag` (`id`, `tag_id`, `plan_id`) VALUES
(3, 2, 2),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `referral_logs`
--

CREATE TABLE `referral_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_user` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `amount` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_logs`
--

INSERT INTO `referral_logs` (`id`, `to_user`, `from_user`, `amount`, `created_at`, `updated_at`) VALUES
(2, 5, 4, '0.4', '2021-02-06 20:03:31', '2021-02-06 20:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `referral_uses`
--

CREATE TABLE `referral_uses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_user` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `referral_commission` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_uses`
--

INSERT INTO `referral_uses` (`id`, `to_user`, `from_user`, `referral_commission`, `created_at`, `updated_at`) VALUES
(1, 4, 5, 50, '2021-02-02 17:42:35', '2021-02-02 17:42:35'),
(2, 9, 5, 1, '2021-02-14 16:05:42', '2021-02-14 16:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copy_right` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform_commission` double(8,2) NOT NULL DEFAULT 10.00,
  `admin_limit` int(11) NOT NULL DEFAULT 10,
  `front_limit` int(11) NOT NULL DEFAULT 10,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `planform_fee` double(8,2) DEFAULT NULL,
  `commission` double(8,2) DEFAULT NULL,
  `sebi` double(8,2) DEFAULT NULL,
  `sgst` decimal(8,2) DEFAULT NULL,
  `stamp_duty` decimal(8,2) DEFAULT NULL,
  `stt` double(8,2) DEFAULT NULL,
  `igst` double(8,2) DEFAULT NULL,
  `cgst` double(8,2) DEFAULT NULL,
  `exchange_transaction_tax` double(8,2) DEFAULT NULL,
  `wallet_charge` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `support_email`, `number`, `name`, `address`, `copy_right`, `platform_commission`, `admin_limit`, `front_limit`, `created_at`, `updated_at`, `planform_fee`, `commission`, `sebi`, `sgst`, `stamp_duty`, `stt`, `igst`, `cgst`, `exchange_transaction_tax`, `wallet_charge`) VALUES
(1, 'info@bankniftypms.com', 'info@bankniftypms.com', '918789741379', 'Banknifty PMS', 'Patna, Bihar', '2021 @ bankniftypms.com', 40.00, 50, 50, '2021-01-10 16:17:27', '2021-03-04 19:02:15', 20.00, 5.00, 0.25, '0.50', '0.50', 0.50, 0.50, 0.50, 0.50, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `set_redeem_amounts`
--

CREATE TABLE `set_redeem_amounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statements`
--

CREATE TABLE `statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `buy_avg` decimal(10,2) DEFAULT NULL,
  `sell_avg` decimal(10,2) DEFAULT NULL,
  `amount_chg` decimal(10,2) DEFAULT NULL,
  `chg` decimal(10,2) DEFAULT NULL,
  `qty` decimal(10,2) DEFAULT NULL,
  `pl` decimal(10,2) DEFAULT NULL,
  `invested` decimal(10,2) DEFAULT NULL,
  `current_value` decimal(10,2) DEFAULT NULL,
  `PL_balance` decimal(10,2) DEFAULT NULL,
  `capital_balance` decimal(10,2) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `platform_fee` decimal(10,2) DEFAULT NULL,
  `total_commission` decimal(10,2) DEFAULT NULL,
  `realised_profit` decimal(10,2) DEFAULT NULL,
  `is_pay` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>No,1=>Yes',
  `is_move` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statements`
--

INSERT INTO `statements` (`id`, `user_id`, `plan_id`, `buy_avg`, `sell_avg`, `amount_chg`, `chg`, `qty`, `pl`, `invested`, `current_value`, `PL_balance`, `capital_balance`, `commission`, `platform_fee`, `total_commission`, `realised_profit`, `is_pay`, `is_move`, `created_at`, `updated_at`) VALUES
(1, 14, 3, '5.00', '10.00', '5.00', '100.00', '1000.00', '5000.00', '5000.00', '10000.00', '5000.00', '10000.00', '250.00', '20.00', '321.35', '4678.65', 1, 1, '2021-03-06 13:32:15', '2021-03-14 06:22:05'),
(2, 14, 3, '5.00', '-3.00', '-3.00', '-60.00', '1000.00', '-3000.00', '5000.00', '-3000.00', '-3000.00', '2000.00', '0.00', '20.00', '-9.90', '-2990.10', 0, 0, '2021-03-06 13:42:05', '2021-03-06 13:43:27'),
(3, 14, 3, '5.00', '8.00', '3.00', '60.00', '1000.00', '3000.00', '5000.00', '8000.00', '3000.00', '8000.00', '150.00', '20.00', '200.85', '2799.15', 0, 0, '2021-03-06 13:42:52', '2021-03-06 13:42:52'),
(4, 14, 3, '5.00', '9.00', '4.00', '80.00', '1000.00', '4000.00', '5000.00', '9000.00', '4000.00', '9000.00', '200.00', '20.00', '261.10', '3738.90', 0, 0, '2021-03-06 13:43:03', '2021-03-06 13:43:03'),
(5, 14, 3, '5.00', '13.00', '8.00', '160.00', '1000.00', '8000.00', '5000.00', '13000.00', '8000.00', '13000.00', '400.00', '20.00', '502.10', '7497.90', 0, 0, '2021-03-06 13:43:58', '2021-03-06 13:43:58'),
(6, 14, 3, '5.00', '-2.00', '-2.00', '-40.00', '1000.00', '-2000.00', '5000.00', '-2000.00', '-2000.00', '3000.00', '0.00', '20.00', '0.10', '-2000.10', 0, 0, '2021-03-06 13:44:06', '2021-03-06 13:44:06'),
(7, 14, 3, '5.00', '7.00', '2.00', '40.00', '1000.00', '2000.00', '5000.00', '7000.00', '2000.00', '7000.00', '100.00', '20.00', '140.60', '1859.40', 0, 0, '2021-03-06 13:44:36', '2021-03-06 13:44:36'),
(8, 14, 3, '5.00', '6.00', '1.00', '20.00', '1000.00', '1000.00', '5000.00', '6000.00', '1000.00', '6000.00', '50.00', '20.00', '80.35', '919.65', 0, 0, '2021-03-06 13:44:53', '2021-03-06 13:44:53'),
(9, 14, 3, '5.00', '-6.00', '-6.00', '-120.00', '1000.00', '-6000.00', '5000.00', '-6000.00', '-6000.00', '-1000.00', '0.00', '20.00', '-39.90', '-5960.10', 0, 0, '2021-03-06 13:45:22', '2021-03-06 13:45:22'),
(10, 14, 3, '5.00', '9.00', '4.00', '80.00', '1000.00', '4000.00', '5000.00', '9000.00', '4000.00', '9000.00', '200.00', '20.00', '261.10', '3738.90', 0, 0, '2021-03-06 13:45:39', '2021-03-06 13:45:39'),
(11, 14, 3, '5.00', '-5.00', '-5.00', '-100.00', '1000.00', '-5000.00', '5000.00', '-5000.00', '-5000.00', '0.00', '0.00', '0.00', '0.00', '-5000.00', 0, 0, '2021-03-07 17:59:50', '2021-03-07 18:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `show_qty` int(11) NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Buy,2=>Redeem',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pl_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pl_percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avg_amount` decimal(10,2) NOT NULL,
  `all_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_holdings`
--

CREATE TABLE `subscription_holdings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `qty` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `pl` decimal(10,2) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `platform_fee` decimal(10,2) DEFAULT NULL,
  `total_tax` decimal(10,2) DEFAULT NULL,
  `total_commission` decimal(10,2) DEFAULT NULL,
  `expense` decimal(10,2) DEFAULT NULL,
  `realised_profit` decimal(10,2) DEFAULT NULL,
  `profit_change` decimal(10,2) DEFAULT NULL,
  `is_pay` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>No,1=>Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_holdings`
--

INSERT INTO `subscription_holdings` (`id`, `user_id`, `plan_id`, `qty`, `amount`, `totalAmount`, `pl`, `commission`, `platform_fee`, `total_tax`, `total_commission`, `expense`, `realised_profit`, `profit_change`, `is_pay`, `created_at`, `updated_at`) VALUES
(1, 14, 3, '1000.00', '-1.00', '-1000.00', '-1000.00', '0.00', '20.00', '-9.90', '0.00', '0.00', '-1000.00', '-20.00', 1, '2021-03-06 10:14:06', '2021-03-06 13:32:47'),
(2, 14, 2, '100.00', '5.00', '500.00', '500.00', '25.00', '20.00', '5.23', '50.23', '10.05', '449.78', '89.96', 1, '2021-03-06 11:08:22', '2021-03-06 11:10:10'),
(3, 14, 3, '1000.00', '5.00', '5000.00', '5000.00', '250.00', '20.00', '51.35', '321.35', '6.43', '4678.65', '93.57', 1, '2021-03-06 12:17:40', '2021-03-06 13:32:47'),
(4, 14, 3, '20.00', '250.00', '5000.00', '5000.00', '250.00', '20.00', '51.35', '321.35', '6.43', '4678.65', '4678.65', 1, '2021-03-06 12:24:27', '2021-03-06 13:32:47'),
(5, 14, 3, '1000.00', '3.00', '3000.00', '3000.00', '150.00', '20.00', '30.85', '200.85', '6.70', '2799.15', '55.98', 1, '2021-03-06 12:28:23', '2021-03-06 13:32:47'),
(6, 14, 1, '20.00', '5.00', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '2021-03-06 13:08:13', '2021-03-06 13:08:51'),
(7, 14, 3, '1000.00', '5.00', '5000.00', '5000.00', '250.00', '20.00', '51.35', '321.35', '6.43', '4678.65', '93.57', 1, '2021-03-06 13:17:08', '2021-03-06 13:32:47'),
(8, 14, 3, '1000.00', '4.00', '4000.00', '4000.00', '200.00', '20.00', '41.10', '261.10', '6.53', '3738.90', '74.78', 0, '2021-03-06 13:42:05', '2021-03-06 13:45:39'),
(9, 14, 3, '1000.00', '-5.00', '-5000.00', '-5000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '-5000.00', '-100.00', 0, '2021-03-07 17:59:50', '2021-03-07 18:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_redeems`
--

CREATE TABLE `subscription_redeems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Buy,2=>Redeem',
  `realized` double(8,2) DEFAULT NULL,
  `planform_fee` double(8,2) DEFAULT NULL,
  `commission` double(8,2) DEFAULT NULL,
  `sebi` double(8,2) DEFAULT NULL,
  `sgst` double(8,2) DEFAULT NULL,
  `stamp_duty` double(8,2) DEFAULT NULL,
  `stt` double(8,2) DEFAULT NULL,
  `igst` double(8,2) DEFAULT NULL,
  `cgst` double(8,2) DEFAULT NULL,
  `exchange_transaction_tax` double(8,2) DEFAULT NULL,
  `total_charges` double(8,2) DEFAULT NULL,
  `final_pl` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `position`, `status`, `created_at`, `updated_at`) VALUES
(2, 'CNC', 1, 1, '2021-01-14 19:36:00', '2021-02-23 18:08:39'),
(3, 'NSE', 1, 1, '2021-01-16 05:06:32', '2021-02-23 18:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '1=>Admin,2=>SubAdmin,3=>User',
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Active,2=>Deactive',
  `notification` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>On,2=>Off',
  `online` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>On,2=>Off',
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investmentCapital` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_kyc` tinyint(1) NOT NULL DEFAULT 0,
  `device_token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_referral` int(11) DEFAULT NULL,
  `is_pms` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>No,1=>Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `token`, `first_name`, `last_name`, `email`, `number`, `username`, `image`, `password`, `status`, `notification`, `online`, `latitude`, `longitude`, `social_id`, `investmentCapital`, `email_verified_at`, `last_login_at`, `last_login_ip`, `language`, `address`, `api_token`, `is_kyc`, `device_token`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `referral_code`, `is_referral`, `is_pms`) VALUES
(1, 1, NULL, 'Super', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$fby1MvHUFTbifJJ2jgwUZe6YUl9leKSoOLdBHF.y0Tg6jTVfdkAby', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '2021-03-15 21:56:41', '127.0.0.1', 'en', NULL, NULL, 0, NULL, NULL, NULL, '2021-01-10 16:17:26', '2021-03-15 16:26:41', '', NULL, 0),
(2, 3, '9a8508e1-6f83-4a7b-8f2d-a9c082ff7a91', 'anil', 'sharma', 'anil@gmail.com', '8866458588', NULL, NULL, '$2y$10$DBpTxYfFK/nKjaXNEoa8s.UkbsX6iGlN99rsrqxRtKelvEcJyhaW6', 1, 1, 0, '26.9124336', '75.7872709', NULL, 3, NULL, NULL, NULL, 'en', 'Jaipur, Rajasthan, India', NULL, 2, NULL, NULL, NULL, '2021-01-10 16:42:17', '2021-01-17 20:03:46', '', NULL, 0),
(3, 3, '3610285c-e1ae-434b-b383-8d335b540191', 'anil sharma', NULL, 'anil01@gmail.com', '8866458229', NULL, NULL, '$2y$10$KbWqE89YkHoEL0MbX57WdexdO/bBl4p9WkBMoPKN4Qt04WIxR89/O', 1, 1, 0, NULL, NULL, NULL, 3, NULL, '2021-02-27 00:03:00', '127.0.0.1', 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjMyYzRkOGRkOWViZWY4OTQ3YTg5MzUzMWE3OWRkZTY4MmVlODM5NDk2YjRlMTgxMTEzMWFlZDFhOWQxNTkxYjkyNDA2M2FjYzlkN2JkY2UiLCJpYXQiOjE2MTQzNjQzODAsIm5iZiI6MTYxNDM2NDM4MCwiZXhwIjoxNjQ1OTAwMzgwLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.FvKJHBAfbohlWNg0q9Uy1p8Ov18gpWU4kwshqX-C7FTgqtQenqkea2ZGEw4FUOcM3mP8MFbxtzAt-IHusFaOEXTODMlAqk5dfS4OnvVbwJnkokP8sp8vIAyRpkq0eMPoKZbShlSO5_uZClbaqOhhx-rKUK-kwPYHsqlK1gZhTlvtNGLKuhhzKVTmq3w2N6awOYBuAaB_kE3B5dyk_9N4_RQWKfjCEpwGP21DQ_0Mf4DfebkTGkbSyidgIYMSyTNrwtYV7WNgblF7n96n-DyL2_WJAw4TfxN8zVNs0-sF1j2IcHtM9Lkemi0zRg6k2x37aw4nHxS_KMZERtBMXmnsNgaHqrnB6fNeQORLKsfT5ZAl24-jl9wA5w_IWBweYsHHT8-i90nhSm3W-ZyTeDxCFwieMazy1qqNfXf6V4zm05y7Htb1bG-oOhg29wPatN6BKvR-CzYMvD1Ms7_GIsjoqC7eI3GiZlwagcWQaymLgtLm7yFSEif0fkRwMcZS1e4JRmnoaLjXjfZA4BWVcJPDbFWTQzNGGTv2k8v5DqUXKgUcsaXN7ga6EBA35wMzkYkPafmbb0NvpAgNbiK0rfsa2lM-a__U8miUAPNwf2vxWcdcjfA1Uu13SUB6L5FhwwDOfiy1IHdmJifqL9CMvDU7mH8YaDZrc8aQXJ9VH1IXSIA', 1, '001', NULL, NULL, '2021-01-16 08:58:55', '2021-02-26 18:33:00', '', NULL, 0),
(4, 3, 'bfc521b6-a2b4-43bd-b9a2-d03d05bfe0b3', 'anil sharma', NULL, 'anil02@gmail.com', '8866458589', NULL, 'd57a8315-1472-49eb-be85-7f2b315ed5d8.jpeg', '$2y$10$cgVwj0urFF9mDVsaUWj/NOrSmbCeQ3Z0P/AYxg//LVuIqiLzuxlzS', 1, 1, 0, '48.379433', '31.16558', NULL, 3, NULL, '2021-02-23 00:14:56', '127.0.0.1', 'en', 'Ukraine', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzlmMDQwNzBiYWQ2Y2U5NmRkOTU2ZjM1MGE0MWI5ZTlkYWVjZTA0N2RlMzQzZDEwZDZhMTdmN2MyODhmNTE0MzY0ZGExZThjZmE2NmI4ZWYiLCJpYXQiOjE2MTQwMTk0OTYsIm5iZiI6MTYxNDAxOTQ5NiwiZXhwIjoxNjQ1NTU1NDk2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.E7Ug1u7aAh0o__h32lpCmqaWwogXDGV9YXSuztGWuYEwVavF2o041MSblU5EFMpwj_8sE5RdqM2J-9q7KXk83SLnVNDXG-XT86mzcm4MVW6883UzR1-qPIr4VMQRXeJx5FIhDLWR-20HQkHk6uycBW1sqlpEIrTqcoEL_M4rpA9iFDoDfb1eXxDzn45ZiB-d8oKgLoIwPKToN2zk6NY1Y5Zx4xBkC6bUJG1Jy3I9NKs8C57LLJtCtDCjQSpIuCGYn7mVXruZQCDs2fRvwOqxJTI_uFFgOjLzMSX659PMptx0e6V69KxWnK9c_0GsPCFrKfthmCDt5jSo8EuKfStc-Ey7Qyn2c1kPMBaMQ_UhoHSIcbRdrSHQijiFdyuwP05i1XcBBU8eV_UDV_ZJ7_yM0qV9jrQTcV-kIszPNKBuAYBYDycLXVYJSwiMRvvypsByi2M5POXCdiDY24JaRLXeOidkX5g9MwqaqZRjfdlyaOiGUWqOikurMYG6e0ZT7KOGRhiJ4F-fWRMFjcP3G0ixX7phgRCg5IBFbz43D_BHYJNZrdwhtd4v3q4rc9AA_YpC0OSNaHuEG6I_uPLCAN2532CVRvOfpcl2Lh29V3uTckoOR84g4eJpQqlSagSavHQobwdSaMa5CmDqK9ME5gOr_EK9-RZXBJGENnj2JVHWAEw', 1, '001', NULL, NULL, '2021-01-16 09:00:16', '2021-02-22 18:44:56', '1234567891011', 5, 0),
(5, 3, '4c641a8e-8073-4b7c-acac-e2093abf8fcd', 'Raj Kumawat', NULL, 'rajkumawat439@gmail.com', '9694357792', NULL, 'fb5df0a4-4a33-46c5-91a6-1ce466bad425.jpg', '$2y$10$vegk5OEw6noRQACq2k5tGOhXoC4sQtsJVqkwwLfmZbJKlvQ4UVZB6', 1, 1, 0, NULL, NULL, NULL, 3, NULL, '2021-02-27 22:41:46', '127.0.0.1', 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzhjMGIxYTkyZGJjYzk4MWRjYmRjYmQxNDQ4OTYwNzMwNGUxOTVkZjY4OGZhMzc1MThiZGY1MjNmMjMyM2I3MzEwZDIxNGUzMWM4ZjNhNTIiLCJpYXQiOjE2MTQ0NDU5MDYsIm5iZiI6MTYxNDQ0NTkwNiwiZXhwIjoxNjQ1OTgxOTA1LCJzdWIiOiI1Iiwic2NvcGVzIjpbXX0.ejjPWZ2rdXdyoOy4Gx_1dghtzDR-X3Qo-lgjXJ2SOr7OxBr--tVKm5eMK4QLYJP491JxxPsGahMzVUxFLamH5Y5LfcS0i70ZOpA-Chnewe2yiTY-cC6U1_sI9pHl2FJYCC1pJ2ZVEHLwsm3EWCp85VAs7sEtsZRP0PZiKD4cVO4TOCYeVOYSP7QJnx9MLQm5O4GL0v9NhebS6NpQ-pFJkQVad_cT6GXn8WX_NP1eetRi_G-m_-FK3N8I37acQFqi3MMOgS5Prb0FtODvJfTLltcWr0hGqe-5hUXriTaT81UkL7HFD1_66hop6czJtxLor0HGUGDkWMW-5_Z9Sv8YtwTcBzh1TJ4CJthygL05WlQImDdPzVNlcvNiHJRrwJhyvSVyCq5dxz93WbJltfFkn-bQ_cdmIJlNDBVOgkayrbIX5g8MbqMV3Gri48DwNUnHbZdb2NcNGqHT0-UfYIlWTmR08opAFnU--YwO8kGqVEjmqeINwmPdFU9BBKzuJi9g46R4mtmi3ViIn4eZR-bMpXAhqXFUD4f04aaumoOY99Lwj1VRKn2FhGQTvJDFwQAO3YUQ-0R7Htb0YrIkk63kmqsDiWKjgXVfRg-dKZwggT7ViTuBMd3qDFM6k9FAsmYFYTBPIxh4ZWHazm9FPnxb_SiVezk3lbJ44lFnvzU8QlE', 1, '001', NULL, NULL, '2021-01-28 14:52:22', '2021-02-27 17:11:46', '007', NULL, 0),
(6, 3, '8fb4a93f-9ac6-4eac-886c-c5f994d5f75d', 'anil sharma', NULL, 'anil002@gmail.com', '88664528589', NULL, NULL, '$2y$10$5u2vzg.FPZ4xZmGEj.niDulrQL/Fd6wbCcYX8XictKq6gcwfUD4fi', 1, 1, 0, NULL, NULL, NULL, 3, NULL, '2021-02-02 00:10:10', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzBjYTJlOTRiZGVkNzExNGExZDBmOTcyMTQ0ZTY3Mjg0MTNiMzZmNDU2YTBmYmRmM2M4MzVhZWZkM2ZkZmRkZjMxMGQ0N2VkNmZmZTJmOWQiLCJpYXQiOjE2MTIyMDQ4MTAsIm5iZiI6MTYxMjIwNDgxMCwiZXhwIjoxNjQzNzQwODEwLCJzdWIiOiI2Iiwic2NvcGVzIjpbXX0.IKqDWftHEM0UxluAtfI3Sn9_UstA7KBPaHHOtpCo_746NqEg154ryXW3JzAQ0QJY3NN3F-YTHx4rGdfUz6fqy1S4E41wNTiuTR6Dk13hjfJdqFSmUE5vEp-rPH0_biqioYjcSNLLgNvb9vphbGmc-U9YOTRvEcR74ws3X8Up22GOMduJ5yAhfUWlLsZAyIl0pHD64dDYgS-yE_28z_oFVlibd6oWig8NfrQkcnpf1yfPD62utc1vACXcR2qFiSPqvhhxiC6f5QEnQ8oIHckJXE7JBPuiRDO5uL0uSL02joViFIdqHz0-Mwx1xWanUfHtvHMS9eoE_6DNN-xpsv2VuUoELU8uzq-PUFrjMCS0gq8m-Jpz_nreywLz2_jt6tVj1mrdFgTPM43a_DK9fFO30QRCh2LOolC3-lqu-iL1UllDyNby8ayTBIR2V57Dwmg3SEztL4aagirgdTCHZIcTyOp5ZsMfHIUEIW5-wvWy20lHUc4Z21rQ9WtmSg3QwgT-chK_ykmWwE15VGmr6KLfwsAsqegjqdgY2UR7VhU7YYaGMRQgC2dm3EhR4EIaJPv3gH_S91Du2_0ngyLEgVv2hOqQAgA5YkdgLej3-Yec5NB2GacIIKG-D9JQb-hF0xeYSeMeOmsJ9hum5M0sEG-RSY9IvDthRCw6R2ZTUtAq9yA', 0, '123', NULL, NULL, '2021-02-01 18:40:08', '2021-02-01 18:40:10', '3b13da4e-d49f-464b-8c6c-a1c6162c0e66', NULL, 0),
(7, 3, '8e7dd4df-e203-4055-a8ea-b8a381ef0a67', 'anil sharma', NULL, 'anil003@gmail.com', '38664528589', NULL, NULL, '$2y$10$wWfrNkOZE6je2nEBH3okBO7uxrNX7mItzrXfJF6TWZdjGi8KhCZg.', 1, 1, 0, NULL, NULL, NULL, 3, NULL, '2021-02-02 00:16:53', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzBmYTQzZjk0NzE2YjdiYzE0NWEwNWZhZDk4ZDVlMTljMzIzYWVjZTUxMjY2YTg5ZjExZDNhNTFjYzc2OTQyNDQwZTgwNDU1YWRhOTg5MDUiLCJpYXQiOjE2MTIyMDUyMTMsIm5iZiI6MTYxMjIwNTIxMywiZXhwIjoxNjQzNzQxMjEzLCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.ovwgAeVIdr4cidukDLXrkfu91alqfe8RNt6j4DoVuqjEvCfTbdf6GmxG_rsXyC2xwV0DO-KLhabTt-Xyw_bUoUaNhzuvdGg3q_oOlbkE_jkM7Sj45-qOWddFwLJ8fPDoWLG4zzJG8ntKzhoyi1z-D2jeqWX-WSqk969wm87ttQguRxoe36SpUrYA-QhsFknzE9u0RPA-qPiM3QH0Gb4ThFrJPgXN1oGQ4lY8ynZgpePXaJwlzN9Tleu9cmuet1t-dY9GNBoigETpj_zOxnkEvNMpwoKhpXNGxN_fwLZKHEuUpjAZ1rqmVGx-7K_XdEITVTh4LHETWbVCAjUBu8hY-LyaUbMeyyFWOnVQ3cQOKA2E9s7PaKXghPjPgvdZQT9bFUNjAg7axRCxz_tyHuZZKmrZWeq3tBYBD3sUrvTfM5s4k9Mj4hSOoG1hRiw0XUiJobzgQgKrsI3-6UcykiIP1nacRvbpqSdLiLVIXk3C8z4JQWEjwXtVD3PeKbfJuJUOz0ihlSAjW_lddHbMraaga_V7alfXJrvDNgxJQLKl_Mm27o87T9TiKJ1EC7gSjCOQdEWqbCUmRXuuazDBjFal1jJfftuYFNXzrTL8ssnZ-OVm6FbXogPYPzBePznIpv2q6ZxE-yxWF0gpHQPaJ7dK1UslrMxAZAe09q78bb2mwiU', 0, '123', NULL, NULL, '2021-02-01 18:46:52', '2021-02-01 18:46:53', 'd6f336bd-7750-42cd-8b79-8db4f0204898', 5, 0),
(8, 3, 'c6694824-fe09-44b6-ad21-6ecff8a2af8b', 'anil sharma', NULL, 'anil004@gmail.com', '48664528589', NULL, NULL, '$2y$10$l36FZNC6WE4U2oO5sUuYhOjM4tIRHEaiX47o2qAJA4NBPwG2AxBga', 1, 1, 0, NULL, NULL, NULL, 3, NULL, '2021-02-02 00:28:47', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiY2FjMDVkOTI1OGZhYjUyMGU5N2NjZTk0MWNjNjE2YTNhZjY3NmYzMGRlYWNhNWU5ODEzODkyMzBjMGM3NzNhMTdjNzUyMmIxMWZiZTVkYTUiLCJpYXQiOjE2MTIyMDU5MjcsIm5iZiI6MTYxMjIwNTkyNywiZXhwIjoxNjQzNzQxOTI3LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.eGaFVGR6NqwtVctCd1s4UedcFnHfFHFdgVDV6fMklkG0SW7vOB1b1hQXqgy7MvazsyWjQyPQOcTt6IeFSN1xqoImhNS5q1UPkWPZj7Wz7ighT6gTg-0cW5JAfDQb6b_doLSkcy9RzUoaNZ67d0HLlvXmK88ZJ-m1ArtfAJU0EuaQ3O3IxkNRcerIGPSQREwfLdPArka3BJ6qNG-jgzestwZDX6TkABo2ya1MR1MNxB1WnjnD9LjuIOzC-K1g7gTzxl-6jOY4xE3QFe4Dha5WZ7D-RAkdm5BUi8bBfsoWITnlXes9BoGXGJaWST5bBxFDF016yYeIWAI3LD9tWnUJ-JjDdWYK_fE0ilCOol9Iq1perr80I5c0amJ4IwLU9Hne6dzWwlDds_W3690GhrvSRUKU_0m7QslQw_KzphMHSSFF5MAvR9TQkwOhDninZn2wZPRdrmD-FhpHbPagghvWvY0wio5ynllsE31sTKGHOP_4ksxVrNod2aDRUOawQHqba5gsvGjjumsF30GXk7c7MyGO9FzMoQ-o6sjLkp359oywSaQFAQlVg7tuwtM2GgvSlA4sT2S2z-xH_1s_yaR88RyBj6qq2m4Ocl0HFf2dOejwwK8gAE5VSPZWLpETPA0MXKjVRqUWlX1NriE5gifxTe3MZbGqoNmWaZuxHgF5k5Y', 0, '123', NULL, NULL, '2021-02-01 18:58:47', '2021-02-01 18:58:47', '7e9134d8-fb70-43b7-b702-8818ee3b7e60', 5, 0),
(9, 3, 'f8f341dc-8668-439a-a614-d9664055058c', 'anil sharma', NULL, 'anil0010@gmail.com', '48664528529', NULL, NULL, '$2y$10$nHWflUehDHuiobhvSBlNCuuOIuVvTt0MVuvPaRnr9xVA7PfkZ.iWu', 1, 1, 0, NULL, NULL, NULL, 3, NULL, '2021-02-14 21:35:46', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzNkNWQ0ZWM0OTkzNTZjZTY1ZmYzZTI3MTg1MTc0YzRkYzAyOTdjMzNmMTI5OWRkOWRkZjYxOWVhZjBkODA0NjkzNTZmY2VlODNjNmNiNzEiLCJpYXQiOjE2MTMzMTg3NDYsIm5iZiI6MTYxMzMxODc0NiwiZXhwIjoxNjQ0ODU0NzQ2LCJzdWIiOiI5Iiwic2NvcGVzIjpbXX0.BHoeeYq3Rifb21GtUWhSIybaxJLIGKpJH5yOuopHS-dg6gOVCgO4UF0uFjG9tTob7IVJdDOk-qOVSf4Klf0erfpV1rg4_9Gj7B_JKIHzgfvfRBQ3pK81NCCKjqCBN6rWcwAFcmcP5M5MhCZ1gIeCG8HrrL2sH-2esL54zv-3sgotPYB-gJuKPKHhcQNjMk3rAUiBbZANby965PZVRdLCa0royd2SAGGKlwffSyI2VGEOEHT3ZizCytUNWcVp1d0snvuFMg1LWQjUGhPk3HIG0c0FM6D6aUngOx8EabKz414zTWt33ndbhGKkmFLn2gOMv62gsvqDsNFxnESRLqc2ngHrUXMSxwbbX2nquQE-UFSo9LWNWQD_CGwkZy4X9-GrsEpt-wtQcy385VYGKnIVW6vcGLJkHE5BJFT43Q6T7MNZF_A_qKHHpqAom4xO-unBj4pBMGGiO7Id8n7GZmkMEv0hQdkjpTKRa94uP3ng3wmvJ64VvmH-z5s2Ar4j93mAAHu7wGt8koOBckPNWttd3MHA_cVf23JSszCMA2ZkXetPsSX9G5fXhjaCGcdTXTjM3F2MfChBB60Mq7mfTmqjoIYX0f38zsvzzdANdF620m8eyHO8pIigoEh6-45OP0Ro08cFa6BSb4DGADFuHMmYMdKERqiQof8VYC_pRDA3O1o', 0, '123', NULL, NULL, '2021-02-14 16:05:42', '2021-02-14 16:05:46', '46744389', 5, 0),
(10, 3, '9ac32d63-52d2-4278-ba3d-c345d3d9f56b', 'Gagan Kumawat', NULL, 'gagan@mailinator.com', '8080808080', NULL, NULL, '$2y$10$bWAWwCBCVNJaUJKAv44dX.AuJiqvTKpvKbQt3zRFK9tPvaSZs68U.', 1, 1, 0, NULL, NULL, NULL, 2, NULL, '2021-02-28 13:35:37', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2U0OWQyZWEyMjE4YzEzMGMxODhkZGNlYjM4YjY2NjM0NDIxN2Y3ZTdhYTFlZjAwNWU2NWFhYmMwY2VjMTkzNDIwZmFjNDEzZDMxMjVmZjQiLCJpYXQiOjE2MTQ0OTk1MzcsIm5iZiI6MTYxNDQ5OTUzNywiZXhwIjoxNjQ2MDM1NTM3LCJzdWIiOiIxMCIsInNjb3BlcyI6W119.xCBnR9DbpoR092GVEnyg_FXeTPnMu1xFc-BToeIxk2ohxTrY5MFvKJ5hk6Gu9omXn43AmqQgLv8bg98NxJNBKhWmbk16yB_5ObPgaNSVNqftXFmVaEsntCOS7S1Zmw11m5NDi3PTxFt0Cm8BNcDpVyvpwWxIMn9x1dY61BHmKc-a1KNv6r_sgP_NRrXYcrNf6FXSB4RhzGRSwYHJhGSsEqzV665IFIvCB2SPbKqC5Ho4Ec8T8FgQ39Y_8YArY8GMFrJQdhGx0by4zCQ_2lak62Wl9pHFsol2RLArN-e3MLJ9CnOMcLXUSoaWHB-yrzWWcn96u88TgUHj5BcWubxtzxWJEK11LXVZb1E9hpYIKuj6lLI3n4lLrwJckIfsnexcduMV8GgyqkHn4vlSod9u3TYgBUMLr3nA6nkf58-JRk212aMnVVq8ml6cpuhdSSW3hJNTRfSHqXmhf2aklKEP_2EXtT1tU1XrOtZ6u4JbUWTQwaIBKpu7pEZ-ht0Fm03PqtnbC9WCYBPW1-EMxiKclNcSDOcMxhEYXzhxtNIkaBL6dKw5St84ilpLeDgI-S0crhkJo5RfAm2OHH2LF9R8dbzctlI3vZuRFWqWDo8TWms10joyH920SLuH7FVSDyIGupRRy2UZ61LFanmHTlllcaYRIIYim8g_CtCexAdN_WA', 0, 'eT7WAedeQjG0AoRXwu6Vq0:APA91bFqizx4EnU8AbgtJdxz9L65AsG8q5mMPUOqxDQUU8Xa3L0ipNKvzzsjcur76c27oOg0gUu50NZwS9sS1oape3g_xkpQXk_8eUHP6IQzdQUGhtI6yOWhxysLp77Y9qSClwd1-TTA', NULL, NULL, '2021-02-28 08:05:36', '2021-02-28 08:05:37', '69787415', NULL, 0),
(11, 3, '8c3a9bc3-9574-4f46-a8d9-fc687dc5772f', 'Arif Ahmad', NULL, 'arifspj@gmail.com', '8292101313', NULL, NULL, '$2y$10$hDXzUDRtn2hF.DorD4bsKORDCTnJSkkcoAlbEjlOrTAntu7J8.nfS', 1, 1, 0, NULL, NULL, NULL, 1, NULL, '2021-03-06 03:01:24', '157.35.244.80', 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGRlYjYxMzQ4YWU2NTI0MjU4ZDdkNWRhZjJmNjdlNDEwMzY1NDA0NGNlODMwNTIyOWRjNjAyMTQ4ODk4YmVkYWFiODYyZGJjYmU0ODQ4NzAiLCJpYXQiOjE2MTQ5Nzk2NjksIm5iZiI6MTYxNDk3OTY2OSwiZXhwIjoxNjQ2NTE1NjAyLCJzdWIiOiIxMSIsInNjb3BlcyI6W119.rVHJq7gIlvf5kqU4nvzkRs7kS9BeBFbw4SVjQ7xtaDcd6BZJ3AfVG-84G84x1QxQR591kqOU3aZv5VwipMUDlIHYZ8oLaFqzU6N5sNv4JnYS4uo8_5XIal27nRQAuyqfXEM89HHqKJzQtxNfUZlc_qcnzUARBQCgaUyX7CamkjcI786qEmxyEX9QDcYHysIXebjKEUu_wU6GN3ZVKicYl8JsDRyFLscGPNool6EBXPR0Dpb7AeMxkrPIKOlgv55fm7y1SdvuC-EPk-1RpNZLOSDFmPWoheT-pUJq2tpCMl17MkuYACLTaE8Oi8Mnbx-iG9jG7MFq_MH9LQ6zJwjt8vsZRPZuAArn77dSgxi9Xvit0CRNjhXapwUNK9viPemv1BgUk8mCrZErSLzOH1YcYuqbwp2Ql6xd2e1mWYBEiRyx5Af424Mb_insa5HWatalaMZiLISPRT4zHfMx95VeQzwqpF34V7_dWaTcndxKXE4E7s0tinLKr32nWsTCw0Vx9CtvREWZgMsSsHiLNVxZwwnheBRe5MVQO1NVU1O-wAIBPWtDpR4REoUPBU99ly9kOzy3IMvcjfkR_XB7NyEWN2qAfHcDBvuNzfwmNkk7ctmxEKk7BUfDVP5JOq7ef7HMANvLZUGnlLKQ2tCxEhcr4GyFAgJ8Xwqi7VE2lEADqq0', 1, 'fUBepi56Q0uejF8znCQUBQ:APA91bHfpWo7niNXPfyTqZsUVUrGRGxMD5-g2NiJprf2ZTpdy5PmJJ5yAhy2hBsODLv11VWD5ze6UyMTurbcF_a3iCHUDBsPDo0pd1X8_0sN--5IGeRfNVCqh1U6WzbG1fPX3EM410ps', NULL, NULL, '2021-02-28 12:42:12', '2021-03-05 21:31:24', '14511914', NULL, 0),
(12, 3, '44340cc7-b3ec-414b-b99b-6c76e5674d8f', 'anil sharma', NULL, 'sharma@gmail.com', '128866458', NULL, NULL, '$2y$10$P1GnAQYn/gLZWXNiolPLdOKwoJllbEZmceuS8SQpx2.8YKpE5T5jS', 1, 1, 0, NULL, NULL, NULL, 1, NULL, '2021-03-04 21:45:20', '223.238.197.67', 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2E4MjllMTUyMWYxMDA1NDlmNTYyMDgxNDZkNTNiMzk5N2EwOTE2ZDMxZjJiNTFjOGU0OTAyMjZkOWM4OTNiMjQ3ZDFjMmE2MTM5YmVmMDEiLCJpYXQiOjE2MTQ4NzQ1MjAsIm5iZiI6MTYxNDg3NDUyMCwiZXhwIjoxNjQ2NDEwNTIwLCJzdWIiOiIxMiIsInNjb3BlcyI6W119.Rsr3FEU4CylfkoKTJXkKm45Wo1mGbVut4XB_4tmRtpy8oWsuwtZM922vwBOjDZb8WNDrOqYxvS4tsmI3uDwIRtTQE35BCsPZGywFe30lJd5-qCuF4acsngeMC8Gqtnwk8zqRPKS_P-kYlDU4nAJ_erQNXEKZdKuo_URLdjYb9dYsz8gGTRxW-scpgshLp_DJnE5jE0jEFgqccLaHC8Ft8dEhkSRDdFB_Ij4_tiXlutEd46G70zTGuNDxVPTBtLBGpbiyqVvCPdYrzqgDIpMsXyZ5Lo8ybi80kS0VSS2JRQJUw11qPtwbTbIAJ9Gs-Hl1oTMbXh5CveM1AmxQsCYIp1P9PJm8oKtTknibmM52yXQljkLC11N1KAodP6zer4hmN6wtTYTglSKF39oSdy6jHLKYjvr07yHimC-V5efKAplxIEupGeK7S4b__Zz45uAvUVEKM6F5uO_RnDxNR5BCA4fFEvW6zcVw8XNlqjN-pwi4bL6Im7Ysf6s83PWa7xVVotLpFqpaEqSay217NcP-tczvHSsd5lsr8P636IWwzDVuNSPkHK4PsLp85Pcs0PsHRPEk6LN7Gao2YH5hl89nnQv0YZL2EW9vfaSB1YJsFbm1M2IWgsQCYOVsIEpewBFfcXltCNgreYjZTXLS3i6MsAJecdDEtmR2KFMy5lImqZA', 1, 'ej8ndB1wTwarDvvP4etNKq:APA91bGg_gMxNE4WUxp_-oDqejjkQY7gGRy6sxpcesMNLQBZnUNqk7dFPeqYBJt92pwLfdDY60wgYcPQkFeWEZC7cQmH_Y3IU-KkVmg1v4Pk3jsjJN1CGHhtW-dZ7LPEvle62bXvYaQF', NULL, NULL, '2021-02-28 16:52:01', '2021-03-04 16:15:20', '64587765', NULL, 0),
(13, 3, '80830e4e-257f-4ba8-a2c8-249d5c914095', 'herry', NULL, 'harry@gmail.com', '123458647', NULL, NULL, '$2y$10$uBVgFSr890AvpxUyJ31eH.3wQ8MKAMAGhOj5HG2u6ZYPqBBukj7li', 1, 1, 0, NULL, NULL, NULL, 1, NULL, '2021-03-01 21:25:07', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDE2MDZmOWJhOGZjOTkxNWYyNDBlZTBmYzZhNmM4NzVlM2M3ZjczOTBlNTE5NjI2Mzg0YjgyNWM1ODE5ODE3NDRmMzA2ODI5MjFkNWYyMDgiLCJpYXQiOjE2MTQ2MTQxMDcsIm5iZiI6MTYxNDYxNDEwNywiZXhwIjoxNjQ2MTUwMTA3LCJzdWIiOiIxMyIsInNjb3BlcyI6W119.RQwxoPVm-3cNZlVxtN_BufVGF78H0rgjM7D-hAe2FfZGo9bHzxpF_ouzhr1klGq6dt-Kix0PSu2mShzi6pIcIIR1p0_tSMD9H0IPVFf_bV5HvZv8WiO1TfpELATosOLzn44dtcaWu9eDS5wXaXEgFK7wNUyJSXmxYfl4vZJnqPGgUG1y7g-hTFCKvHDE0Gn3R1n1ci-8nj9QcQiOLeD1Yx03wzTPtyw98PPjrovCewPHAYf7_TEXiUZWiSgy0CrZ6MdWgGtpBlybK0k4Ui0IXsnHqJSlPFAqTm4HaxjzfMcc5eTowChWYZhB8Eclco_e06v42fAl2uwmmbAEeqoeHHWf4oy1gQmY7osAKaWwL_CQRAX4C0SAU0-9h2kRc64e9ofbXGdFB3YcDw9FOn7n7LtxYCMITMWnDKpmBGIQWEPzFePP-0lpIy2W0yrb8m-1FOGNv0E13JGiqGGltjQb9WghpKXcnXH6UiSzSFYAB9m6o5fD7S60MD95jE2pw9IAagVObtuaA_n1ID6njsng4O-ZdZXM5LKT0jHOWwnEceXFqPfYBLnzDwxNdOJwxBzSSz4unaUCmMYub-KkNE6GK2wr1eTDfaWR7VFG3IfN7cKReKIqL99YIAR_SVuSfTL8Cey_QUJU2nTy1sxSzfVeoGxtrRmhCL1ju04_DpzU4kQ', 1, 'fLKm1ImSRwyI6IOKClKoIA:APA91bGuHyJPpUZkwDQsMmh2ru8u7sUlVRV0qtlGZhvgfhRgBAjubBIgM1W-hUdm6MEo9DSGDJUHtzeAi60aVQC7CNAhUWeONW9RobTGXvOHW4JCkIcgZTmFJ7tVnBnDHCzB8F_ebn39', NULL, NULL, '2021-03-01 15:55:06', '2021-03-04 17:59:36', '43950476', NULL, 0),
(14, 3, '624218b6-5f3f-4af9-8e59-3bed0be2da13', 'Arif Ahmad', NULL, 'a@gmail.com', '91912340000', NULL, NULL, '$2y$10$.1VFHlmAMrXybGryO4w8QuYs8FXf9c7tRSs4mDrvqDWwvNw3/6pv.', 1, 1, 0, NULL, NULL, NULL, 1, NULL, '2021-03-06 17:08:20', '223.188.147.237', 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTQ4ZjI0NDU5ZGEzNzc2ZTgzMGJhOWNmZTVhMTQzMjRiZmZjZmY1OGUwMjNlN2E0MmNhMDU4OTRlODM4MTlhYmY3OTcwZWIyYjMxMTY3YjkiLCJpYXQiOjE2MTUwMzA3MDAsIm5iZiI6MTYxNTAzMDcwMCwiZXhwIjoxNjQ2NTY2NzAwLCJzdWIiOiIxNCIsInNjb3BlcyI6W119.O1NT5Bq8KeqfiDCAl2FU2P6Q8HveiTpU_5JCKKhLpCOF2al02iLENl81ZzffOuDX4jrtGnJVz-Yprgzw0Pbw18hUtjGBRyf1Y3xv7zQbVoNNhTHogGGchsbaTaDLdTi1rAjrr3yukXv6TlDQHUTBi0rmyw5AA8QR5ueLHDlLeAamlLttbrlyLvTmqCGb3k2_QnWjFzXCslnIu7C0kgbQneqA4nduulq9sYwHIqEm3m32HODe4FfVinUFIFFyBSa8fq91kBZDsMHFyVEO7szfPJSWrxBVGwvnaWt-ujDFT6CrpmfIsvf4FRzRKuwzsK4c_vkEhiZb9Tm7iOXsytfonOS9hVAQN8o1unO3aNk1iwnsBktW9lCKSYunxAee-zh59b4jK-JeZsEDJ9a3Jlxnl0htvZpAkUw73B9rSxSkguD0x7VHxYx57rG7NMlMid7z35UYXB-hFAix5viNQrqDBty4G1_mrDnKd1bhonlBIGZDjPfzunFWXUhQ7g8vQhqNy3-VUPYAqdIQCNUUR89Plk38ivKnwa2Qc_rCh84yT5ab72KAbCq_FP9nK6u45ouPltz5UNEnmT-e0UVKpBcV-GkqMdp91-Ka-3iaVzqD4xCPjuqcvxd-0jM-AZ8uiyZf0wUt9toarIjPk5Um5_eDvjFIeYPFWngCNg3NvDPycz8', 1, 'eT7WAedeQjG0AoRXwu6Vq0:APA91bFqizx4EnU8AbgtJdxz9L65AsG8q5mMPUOqxDQUU8Xa3L0ipNKvzzsjcur76c27oOg0gUu50NZwS9sS1oape3g_xkpQXk_8eUHP6IQzdQUGhtI6yOWhxysLp77Y9qSClwd1-TTA', NULL, NULL, '2021-03-04 16:20:34', '2021-03-06 11:38:20', '09114321', NULL, 0),
(15, 3, 'a88d6380-fa0b-4f2e-b0e1-72ba22f8fa9d', 'a', NULL, 'aj@gmail.com', '4', NULL, NULL, '$2y$10$snrlhE463TqatT7By.dheeGSFSEFPheoQ/l6RMeYFSy190TJ67oba', 1, 1, 0, NULL, NULL, NULL, 1, NULL, '2021-03-05 02:29:20', NULL, 'en', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTNmNjZhNmFmNmQxM2JhY2MxYzc1ZDRjOGFmYWE4MGNmYzcwZmFiM2RjY2QwOGI5ZjM5OTgwNmM0ZjM0YWE2NGIyNWJkZDZlOWY0MWY1MTYiLCJpYXQiOjE2MTQ4OTE1NjAsIm5iZiI6MTYxNDg5MTU2MCwiZXhwIjoxNjQ2NDI3NTYwLCJzdWIiOiIxNSIsInNjb3BlcyI6W119.kWneZTwozizafWDxPlvKc2wgEln8_uHaPKBsH7pTsEvzRLuDlBPj8eyq9gvSw9hHaGCacsDzzKBWGABj914X6n4eXZRl5clepcKRdv7AhKoBy_O8SPvPUarMSPM7aDTFN71DrwRnW7FLX9DnRSyPLcSmAjPZL4sXM6rAVfVQEu6k7D1LpVuNbAPH-she88xZfbhwoRq8tXcqrVbghs1DNyCWQ8qY0wDZH-plvP7x2lNF54SBsesgMNf6buruTlTHheGuFAx0te-IrV5X-Kh9ahn_x9x2ImqEHwyyyu2lw6OU4qMSAJRt_wIx9Gj4f9kpGDUXohd1akjCtiTSmSe5kUX09Zz8f_JvOI42V7V256pAfuacfEAbDAGYeD3tgu-06MI3qR_CznPGcx5n4CNXqrwJ58H8087kjBwTkv_GBJadWpimo3WZpvPUnGrcXDmK7hvrkrcF4yPMRvpF_Im3fuQWkxXOSuOzA735kgIRHv_jVcdXkffZcQGhdJy40-ZEwy_3rt_LkIwO-ISZTJ_6HWshjFdIJwWsbF_Dk9-MKTC6AoyR09fik-jSL6n__jp6w4XHtKbnXCp_JXZgEgU4gWdanW-TnYAgNWpEjk2M2hfN1xmt1uVSrjtPnBxN9Fc-BT9R2W-HBPEEacPfKERju9cJAEiQMpKY6ZEKgQgfKnc', 1, 'fUBepi56Q0uejF8znCQUBQ:APA91bHfpWo7niNXPfyTqZsUVUrGRGxMD5-g2NiJprf2ZTpdy5PmJJ5yAhy2hBsODLv11VWD5ze6UyMTurbcF_a3iCHUDBsPDo0pd1X8_0sN--5IGeRfNVCqh1U6WzbG1fPX3EM410ps', NULL, NULL, '2021-03-04 20:59:19', '2021-03-06 06:46:27', '10236818', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `adahr_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adahr_card_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_cart_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_cart_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `adahr_card_number`, `adahr_card_image`, `pan_cart_number`, `pan_cart_image`, `bank_name`, `account_number`, `ifsc_code`, `created_at`, `updated_at`) VALUES
(4, 4, '1000001', '3db3d627-c59d-4ec9-833c-1ef88297d0e6.jpeg', 'ABC1001', '4fc95040-6203-4858-a165-7b8c002f3571.jpeg', 'HDFC', '001001', 'HDFC001001', '2021-01-17 18:54:01', '2021-01-17 18:57:00'),
(5, 5, '852085208520', '17bea7e1-149b-40af-8752-e41de18b915e.jpg', '637363', '24801369-00f7-4761-8c41-81997d8a18ec.jpg', 'HDFC', '38303030303030', 'HDFC0000641', '2021-01-29 17:48:13', '2021-01-29 17:48:13'),
(6, 3, '1000001', NULL, 'ABC1001', NULL, 'HDFC', '001001', 'HDFC001001', '2021-02-14 16:10:42', '2021-02-14 16:10:42'),
(7, 12, '123456789', 'c8fa45ae-5ab4-4403-878c-794a2684d23d.jpg', 'cvggghhhh', '1eaa72b7-c8e2-4735-9a8e-226b5add363a.jpg', 'HDFC0000644', '123456789008', 'HDFC0000644', '2021-02-28 16:55:38', '2021-02-28 16:55:38'),
(8, 13, '1225486', 'be757594-99f0-4e95-b9d2-09f0c49e4582.jpg', 'ggvdhdv', 'd35e219e-d271-45e2-92a2-87cfa1b3781a.jpg', 'hdfc', '12344588886458', 'HDFC0000644', '2021-03-01 15:56:18', '2021-03-01 15:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `closing_bal` decimal(10,2) NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Credit,2=>Debit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `amount`, `closing_bal`, `remark`, `type`, `created_at`, `updated_at`, `transaction_id`) VALUES
(1, 12, '5000.00', '5000.00', 'Add amount on wallet', 1, '2021-03-03 18:22:00', '2021-03-03 18:22:00', '1614795720927'),
(2, 12, '5000.00', '0.00', 'Bought a new plan', 2, '2021-03-03 18:22:18', '2021-03-03 18:22:18', NULL),
(3, 12, '5000.00', '5000.00', 'Sell Plan', 1, '2021-03-03 18:23:05', '2021-03-03 18:23:05', '0'),
(4, 12, '2000.00', '3000.00', 'Bought a new plan', 2, '2021-03-03 18:24:41', '2021-03-03 18:24:41', NULL),
(5, 12, '2000.00', '5000.00', 'Sell Plan', 1, '2021-03-03 18:25:47', '2021-03-03 18:25:47', '0'),
(6, 12, '5000.00', '0.00', 'Bought a new plan', 2, '2021-03-03 18:33:53', '2021-03-03 18:33:53', NULL),
(7, 12, '5000.00', '5000.00', 'Add amount on wallet', 1, '2021-03-03 18:36:25', '2021-03-03 18:36:25', '1614796586010'),
(8, 12, '1000.00', '4000.00', 'Bought a new plan', 2, '2021-03-03 18:36:52', '2021-03-03 18:36:52', NULL),
(9, 12, '500.00', '3500.00', 'Bought a new plan', 2, '2021-03-03 18:37:33', '2021-03-03 18:37:33', NULL),
(10, 11, '5000.00', '5000.00', 'Add amount on wallet', 1, '2021-03-03 21:26:04', '2021-03-03 21:26:04', '1614806763025'),
(11, 11, '5.55', '4994.45', 'Bought a new plan', 2, '2021-03-03 21:26:32', '2021-03-03 21:26:32', NULL),
(12, 11, '4.65', '4989.80', 'Bought a new plan', 2, '2021-03-03 21:29:00', '2021-03-03 21:29:00', NULL),
(13, 11, '49.53', '4940.27', 'Bought a new plan', 2, '2021-03-03 21:30:04', '2021-03-03 21:30:04', NULL),
(14, 11, '4940.27', '0.00', 'Bought a new plan', 2, '2021-03-03 21:35:42', '2021-03-03 21:35:42', NULL),
(15, 12, '3500.00', '0.00', 'Bought a new plan', 2, '2021-03-04 02:42:58', '2021-03-04 02:42:58', NULL),
(16, 12, '5000.00', '5000.00', 'Add amount on wallet', 1, '2021-03-04 02:59:19', '2021-03-04 02:59:19', '1614826757582'),
(17, 12, '5000.00', '0.00', 'Bought a new plan', 2, '2021-03-04 03:00:07', '2021-03-04 03:00:07', NULL),
(18, 5, '0.00', '0.00', 'Sell Plan', 1, '2021-03-04 03:05:43', '2021-03-04 03:05:43', '0'),
(19, 5, '0.00', '0.00', 'Sell Plan', 1, '2021-03-04 03:06:28', '2021-03-04 03:06:28', '0'),
(20, 5, '0.00', '0.00', 'Sell Plan', 1, '2021-03-04 03:06:31', '2021-03-04 03:06:31', '0'),
(21, 12, '13500.00', '13500.00', 'Sell Plan', 1, '2021-03-04 03:15:57', '2021-03-04 03:15:57', '0'),
(22, 12, '2000.00', '11500.00', 'Bought a new plan', 2, '2021-03-04 03:19:13', '2021-03-04 03:19:13', NULL),
(23, 12, '2000.00', '13500.00', 'Sell Plan', 1, '2021-03-04 03:27:09', '2021-03-04 03:27:09', '0'),
(24, 12, '13500.00', '0.00', 'Bought a new plan', 2, '2021-03-04 03:28:59', '2021-03-04 03:28:59', NULL),
(25, 12, '13500.00', '13500.00', 'Sell Plan', 1, '2021-03-04 03:29:52', '2021-03-04 03:29:52', '0'),
(26, 12, '13500.00', '0.00', 'Bought a new plan', 2, '2021-03-04 15:45:29', '2021-03-04 15:45:29', NULL),
(27, 12, '14314.01', '14314.01', 'Sell Plan', 1, '2021-03-04 16:16:01', '2021-03-04 16:16:01', '0'),
(28, 12, '14314.01', '0.00', 'Bought a new plan', 2, '2021-03-04 16:16:34', '2021-03-04 16:16:34', NULL),
(29, 14, '5000.00', '5000.00', 'Administrator has been credit amount on wallet', 1, '2021-03-04 16:25:49', '2021-03-04 16:25:49', NULL),
(30, 14, '2.33', '4997.67', 'Bought a new plan', 2, '2021-03-04 16:26:08', '2021-03-04 16:26:08', NULL),
(31, 14, '2.33', '5000.00', 'Sell Plan', 1, '2021-03-04 16:29:37', '2021-03-04 16:29:37', '0'),
(32, 14, '5.66', '4994.34', 'Bought a new plan', 2, '2021-03-04 16:31:02', '2021-03-04 16:31:02', NULL),
(33, 14, '5.66', '5000.00', 'Sell Plan', 1, '2021-03-04 17:10:46', '2021-03-04 17:10:46', '0'),
(34, 14, '5000.00', '0.00', 'Bought a new plan', 2, '2021-03-04 17:38:24', '2021-03-04 17:38:24', NULL),
(35, 14, '5000.00', '5000.00', 'Administrator has been credit amount on wallet', 1, '2021-03-04 17:57:54', '2021-03-04 17:57:54', NULL),
(36, 14, '1000.00', '4000.00', 'Bought a new plan', 2, '2021-03-04 17:58:20', '2021-03-04 17:58:20', NULL),
(37, 14, '2.32', '3997.68', 'Bought a new plan', 2, '2021-03-04 18:15:41', '2021-03-04 18:15:41', NULL),
(38, 14, '2.32', '4000.00', 'Sell Plan', 1, '2021-03-04 18:17:52', '2021-03-04 18:17:52', '0'),
(39, 14, '1399.53', '5399.53', 'Sell Plan', 1, '2021-03-04 18:49:56', '2021-03-04 18:49:56', '0'),
(40, 14, '1000.00', '4399.53', 'Bought a new plan', 2, '2021-03-04 18:50:46', '2021-03-04 18:50:46', NULL),
(41, 12, '50000.00', '50000.00', 'Add amount on wallet', 1, '2021-03-05 18:03:13', '2021-03-05 18:03:13', '1614967393346'),
(42, 12, '50000.00', '0.00', 'Bought a new plan', 2, '2021-03-05 18:04:07', '2021-03-05 18:04:07', NULL),
(43, 14, '0.55', '4398.98', 'Bought a new plan', 2, '2021-03-05 20:31:48', '2021-03-05 20:31:48', NULL),
(44, 12, '5000.00', '5000.00', 'Add amount on wallet', 1, '2021-03-06 06:04:56', '2021-03-06 06:04:56', '1615010695463'),
(45, 12, '5000.00', '0.00', 'Bought a new plan', 2, '2021-03-06 06:05:12', '2021-03-06 06:05:12', NULL),
(46, 14, '2044.09', '6443.07', 'Sell Plan', 1, '2021-03-06 06:54:31', '2021-03-06 06:54:31', '0'),
(47, 14, '2000.00', '4443.07', 'Bought a new plan', 2, '2021-03-06 06:55:49', '2021-03-06 06:55:49', NULL),
(48, 14, '2000.00', '2443.07', 'Bought a new plan', 2, '2021-03-06 07:20:38', '2021-03-06 07:20:38', NULL),
(49, 14, '1980.00', '4423.07', 'Sell Plan', 1, '2021-03-06 07:42:48', '2021-03-06 07:42:48', '0'),
(50, 14, '2000.00', '2423.07', 'Bought a new plan', 2, '2021-03-06 07:49:08', '2021-03-06 07:49:08', NULL),
(51, 14, '1980.00', '4403.07', 'Sell Plan', 1, '2021-03-06 08:08:40', '2021-03-06 08:08:40', '0'),
(52, 14, '2000.00', '2403.07', 'Bought a new plan', 2, '2021-03-06 08:29:31', '2021-03-06 08:29:31', NULL),
(53, 14, '1980.00', '4383.07', 'Sell Plan', 1, '2021-03-06 08:33:01', '2021-03-06 08:33:01', '0'),
(54, 14, '2000.00', '2383.07', 'Bought a new plan', 2, '2021-03-06 08:42:02', '2021-03-06 08:42:02', NULL),
(55, 14, '494.90', '2877.97', 'Sell Plan', 1, '2021-03-06 09:20:22', '2021-03-06 09:20:22', '0'),
(56, 14, '1000.00', '1877.97', 'Bought a new plan', 2, '2021-03-06 09:32:56', '2021-03-06 09:32:56', NULL),
(57, 14, '5000.00', '6877.97', 'Add amount on wallet', 1, '2021-03-06 09:40:19', '2021-03-06 09:40:19', '1615023616670'),
(58, 14, '2000.00', '4877.97', 'Bought a new plan', 2, '2021-03-06 09:40:56', '2021-03-06 09:40:56', NULL),
(59, 14, '2919.65', '7797.62', 'Sell Plan', 1, '2021-03-06 09:41:36', '2021-03-06 09:41:36', '0'),
(60, 14, '2000.00', '5797.62', 'Bought a new plan', 2, '2021-03-06 09:45:17', '2021-03-06 09:45:17', NULL),
(61, 14, '5000.00', '797.62', 'Bought a new plan', 2, '2021-03-06 10:14:07', '2021-03-06 10:14:07', NULL),
(62, 14, '500.00', '297.62', 'Bought a new plan', 2, '2021-03-06 11:08:22', '2021-03-06 11:08:22', NULL),
(63, 14, '100.00', '197.62', 'Bought a new plan', 2, '2021-03-06 12:24:27', '2021-03-06 12:24:27', NULL),
(64, 14, '5000.00', '5197.62', 'Add amount on wallet', 1, '2021-03-06 12:27:10', '2021-03-06 12:27:10', '1615033627775'),
(65, 14, '5000.00', '197.62', 'Bought a new plan', 2, '2021-03-06 12:28:23', '2021-03-06 12:28:23', NULL),
(66, 14, '12156.45', '12354.07', 'Sell Plan', 1, '2021-03-06 13:01:08', '2021-03-06 13:01:08', '0'),
(67, 14, '100.00', '12254.07', 'Bought a new plan', 2, '2021-03-06 13:08:13', '2021-03-06 13:08:13', NULL),
(68, 14, '100.00', '12354.07', 'Sell Plan', 1, '2021-03-06 13:08:51', '2021-03-06 13:08:51', '0'),
(69, 14, '5000.00', '7354.07', 'Bought a new plan', 2, '2021-03-06 13:17:08', '2021-03-06 13:17:08', NULL),
(70, 14, '9678.65', '17032.72', 'Sell Plan', 1, '2021-03-06 13:32:47', '2021-03-06 13:32:47', '0'),
(71, 14, '5000.00', '12032.72', 'Bought a new plan', 2, '2021-03-06 13:42:05', '2021-03-06 13:42:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bid_users`
--
ALTER TABLE `bid_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_plan`
--
ALTER TABLE `category_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_translations_category_id_foreign` (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_id_index` (`id`);

--
-- Indexes for table `dummy_users`
--
ALTER TABLE `dummy_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emails_id_index` (`id`);

--
-- Indexes for table `email_translations`
--
ALTER TABLE `email_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_translations_title_unique` (`title`),
  ADD KEY `email_translations_email_id_foreign` (`email_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment_capitals`
--
ALTER TABLE `investment_capitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_id_index` (`id`);

--
-- Indexes for table `module_user`
--
ALTER TABLE `module_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_id_index` (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_translations_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `planlogs`
--
ALTER TABLE `planlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_tag`
--
ALTER TABLE `plan_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_logs`
--
ALTER TABLE `referral_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_uses`
--
ALTER TABLE `referral_uses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_email_unique` (`email`),
  ADD UNIQUE KEY `settings_support_email_unique` (`support_email`),
  ADD KEY `settings_id_index` (`id`);

--
-- Indexes for table `set_redeem_amounts`
--
ALTER TABLE `set_redeem_amounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_holdings`
--
ALTER TABLE `subscription_holdings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_redeems`
--
ALTER TABLE `subscription_redeems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bid_users`
--
ALTER TABLE `bid_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_plan`
--
ALTER TABLE `category_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `dummy_users`
--
ALTER TABLE `dummy_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_translations`
--
ALTER TABLE `email_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `investment_capitals`
--
ALTER TABLE `investment_capitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=855;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module_user`
--
ALTER TABLE `module_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `planlogs`
--
ALTER TABLE `planlogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plan_tag`
--
ALTER TABLE `plan_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `referral_logs`
--
ALTER TABLE `referral_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `referral_uses`
--
ALTER TABLE `referral_uses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `set_redeem_amounts`
--
ALTER TABLE `set_redeem_amounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statements`
--
ALTER TABLE `statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_holdings`
--
ALTER TABLE `subscription_holdings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subscription_redeems`
--
ALTER TABLE `subscription_redeems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `email_translations`
--
ALTER TABLE `email_translations`
  ADD CONSTRAINT `email_translations_email_id_foreign` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
