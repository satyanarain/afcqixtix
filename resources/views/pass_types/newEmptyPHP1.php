-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2018 at 11:59 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.27-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qixtix`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_types`
--

CREATE TABLE `bus_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `bus_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(12000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_types`
--

INSERT INTO `bus_types` (`id`, `user_id`, `bus_type`, `abbreviation`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'AC', 'AC', '2', '2017-12-27 02:54:59', '2017-12-27 04:03:17'),
(2, 1, 'NON AC', 'NON', '5', '2017-12-27 02:56:04', '2018-01-08 01:28:45'),
(3, 1, 'Luxury', 'LU', '4', '2018-01-19 01:17:27', '2018-01-19 01:17:27'),
(4, 1, 'Sleeper Bus', 'S.P', '3', '2018-01-29 00:56:16', '2018-01-29 00:56:16'),
(5, 1, 'Delux', 'N. AC', '1', '2018-02-01 06:20:35', '2018-02-01 06:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `concessions`
--

CREATE TABLE `concessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `concession_provider_master_id` int(20) NOT NULL,
  `concession_master_id` int(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_type_master_id` int(20) DEFAULT NULL,
  `print_ticket` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etm_hot_key_master_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concession_allowed_on` date DEFAULT NULL,
  `flat_fare` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flat_fare_amount` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concessions`
--

INSERT INTO `concessions` (`id`, `user_id`, `service_id`, `concession_provider_master_id`, `concession_master_id`, `description`, `order_number`, `percentage`, `pass_type_master_id`, `print_ticket`, `etm_hot_key_master_id`, `concession_allowed_on`, `flat_fare`, `flat_fare_amount`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', '2018-01-31 06:26:37'),
(9, 1, 6, 1, 1, 'Description', 3, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', '2018-01-31 06:14:16'),
(10, 1, 8, 1, 1, 'Description', 2, '10', 1, 'No', '1', '2018-02-07', NULL, '20.00', '2018-02-04 23:29:29', '2018-02-04 23:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `concession_fare_slabs`
--

CREATE TABLE `concession_fare_slabs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fare` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concession_fare_slabs`
--

INSERT INTO `concession_fare_slabs` (`id`, `user_id`, `service_id`, `percentage`, `stage_from`, `stage_to`, `fare`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', '2018-01-25 05:38:57'),
(2, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `concession_fare_slab_logs`
--

CREATE TABLE `concession_fare_slab_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fare` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concession_fare_slab_logs`
--

INSERT INTO `concession_fare_slab_logs` (`id`, `user_id`, `service_id`, `percentage`, `stage_from`, `stage_to`, `fare`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', '2018-01-25 05:38:57'),
(2, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:39:48'),
(3, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', '2018-01-25 05:43:07'),
(4, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `concession_logs`
--

CREATE TABLE `concession_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `concession_provider_master_id` int(20) NOT NULL,
  `concession_master_id` int(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_type_master_id` int(20) DEFAULT NULL,
  `print_ticket` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etm_hot_key_master_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concession_allowed_on` date DEFAULT NULL,
  `flat_fare` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flat_fare_amount` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concession_logs`
--

INSERT INTO `concession_logs` (`id`, `user_id`, `service_id`, `concession_provider_master_id`, `concession_master_id`, `description`, `order_number`, `percentage`, `pass_type_master_id`, `print_ticket`, `etm_hot_key_master_id`, `concession_allowed_on`, `flat_fare`, `flat_fare_amount`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', '2018-01-31 05:24:34'),
(9, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(10, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(11, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(12, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(13, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(14, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', NULL, '20.00', '2018-01-31 05:33:54', NULL),
(15, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL),
(16, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL),
(17, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL),
(18, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL),
(19, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(20, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL),
(21, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(22, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(23, 1, 1, 1, 1, 'Description', 1, '10000000000000000', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(24, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL),
(25, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL),
(26, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(27, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `concession_masters`
--

CREATE TABLE `concession_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(202) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concession_masters`
--

INSERT INTO `concession_masters` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Senior Citizen');

-- --------------------------------------------------------

--
-- Table structure for table `concession_provider_masters`
--

CREATE TABLE `concession_provider_masters` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `concession_provider_masters`
--

INSERT INTO `concession_provider_masters` (`id`, `name`) VALUES
(1, 'ETM'),
(2, 'ETM1');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', NULL, NULL),
(2, 'AL', 'Albania', NULL, NULL),
(3, 'DZ', 'Algeria', NULL, NULL),
(4, 'DS', 'American Samoa', NULL, NULL),
(5, 'AD', 'Andorra', NULL, NULL),
(6, 'AO', 'Angola', NULL, NULL),
(7, 'AI', 'Anguilla', NULL, NULL),
(8, 'AQ', 'Antarctica', NULL, NULL),
(9, 'AG', 'Antigua and Barbuda', NULL, NULL),
(10, 'AR', 'Argentina', NULL, NULL),
(11, 'AM', 'Armenia', NULL, NULL),
(12, 'AW', 'Aruba', NULL, NULL),
(13, 'AU', 'Australia', NULL, NULL),
(14, 'AT', 'Austria', NULL, NULL),
(15, 'AZ', 'Azerbaijan', NULL, NULL),
(16, 'BS', 'Bahamas', NULL, NULL),
(17, 'BH', 'Bahrain', NULL, NULL),
(18, 'BD', 'Bangladesh', NULL, NULL),
(19, 'BB', 'Barbados', NULL, NULL),
(20, 'BY', 'Belarus', NULL, NULL),
(21, 'BE', 'Belgium', NULL, NULL),
(22, 'BZ', 'Belize', NULL, NULL),
(23, 'BJ', 'Benin', NULL, NULL),
(24, 'BM', 'Bermuda', NULL, NULL),
(25, 'BT', 'Bhutan', NULL, NULL),
(26, 'BO', 'Bolivia', NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', NULL, NULL),
(28, 'BW', 'Botswana', NULL, NULL),
(29, 'BV', 'Bouvet Island', NULL, NULL),
(30, 'BR', 'Brazil', NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL),
(32, 'BN', 'Brunei Darussalam', NULL, NULL),
(33, 'BG', 'Bulgaria', NULL, NULL),
(34, 'BF', 'Burkina Faso', NULL, NULL),
(35, 'BI', 'Burundi', NULL, NULL),
(36, 'KH', 'Cambodia', NULL, NULL),
(37, 'CM', 'Cameroon', NULL, NULL),
(38, 'CA', 'Canada', NULL, NULL),
(39, 'CV', 'Cape Verde', NULL, NULL),
(40, 'KY', 'Cayman Islands', NULL, NULL),
(41, 'CF', 'Central African Republic', NULL, NULL),
(42, 'TD', 'Chad', NULL, NULL),
(43, 'CL', 'Chile', NULL, NULL),
(44, 'CN', 'China', NULL, NULL),
(45, 'CX', 'Christmas Island', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'CO', 'Colombia', NULL, NULL),
(48, 'KM', 'Comoros', NULL, NULL),
(49, 'CG', 'Congo', NULL, NULL),
(50, 'CK', 'Cook Islands', NULL, NULL),
(51, 'CR', 'Costa Rica', NULL, NULL),
(52, 'HR', 'Croatia (Hrvatska)', NULL, NULL),
(53, 'CU', 'Cuba', NULL, NULL),
(54, 'CY', 'Cyprus', NULL, NULL),
(55, 'CZ', 'Czech Republic', NULL, NULL),
(56, 'DK', 'Denmark', NULL, NULL),
(57, 'DJ', 'Djibouti', NULL, NULL),
(58, 'DM', 'Dominica', NULL, NULL),
(59, 'DO', 'Dominican Republic', NULL, NULL),
(60, 'TP', 'East Timor', NULL, NULL),
(61, 'EC', 'Ecuador', NULL, NULL),
(62, 'EG', 'Egypt', NULL, NULL),
(63, 'SV', 'El Salvador', NULL, NULL),
(64, 'GQ', 'Equatorial Guinea', NULL, NULL),
(65, 'ER', 'Eritrea', NULL, NULL),
(66, 'EE', 'Estonia', NULL, NULL),
(67, 'ET', 'Ethiopia', NULL, NULL),
(68, 'FK', 'Falkland Islands (Malvinas)', NULL, NULL),
(69, 'FO', 'Faroe Islands', NULL, NULL),
(70, 'FJ', 'Fiji', NULL, NULL),
(71, 'FI', 'Finland', NULL, NULL),
(72, 'FR', 'France', NULL, NULL),
(73, 'FX', 'France, Metropolitan', NULL, NULL),
(74, 'GF', 'French Guiana', NULL, NULL),
(75, 'PF', 'French Polynesia', NULL, NULL),
(76, 'TF', 'French Southern Territories', NULL, NULL),
(77, 'GA', 'Gabon', NULL, NULL),
(78, 'GM', 'Gambia', NULL, NULL),
(79, 'GE', 'Georgia', NULL, NULL),
(80, 'DE', 'Germany', NULL, NULL),
(81, 'GH', 'Ghana', NULL, NULL),
(82, 'GI', 'Gibraltar', NULL, NULL),
(83, 'GK', 'Guernsey', NULL, NULL),
(84, 'GR', 'Greece', NULL, NULL),
(85, 'GL', 'Greenland', NULL, NULL),
(86, 'GD', 'Grenada', NULL, NULL),
(87, 'GP', 'Guadeloupe', NULL, NULL),
(88, 'GU', 'Guam', NULL, NULL),
(89, 'GT', 'Guatemala', NULL, NULL),
(90, 'GN', 'Guinea', NULL, NULL),
(91, 'GW', 'Guinea-Bissau', NULL, NULL),
(92, 'GY', 'Guyana', NULL, NULL),
(93, 'HT', 'Haiti', NULL, NULL),
(94, 'HM', 'Heard and Mc Donald Islands', NULL, NULL),
(95, 'HN', 'Honduras', NULL, NULL),
(96, 'HK', 'Hong Kong', NULL, NULL),
(97, 'HU', 'Hungary', NULL, NULL),
(98, 'IS', 'Iceland', NULL, NULL),
(99, 'IN', 'India', NULL, NULL),
(100, 'IM', 'Isle of Man', NULL, NULL),
(101, 'ID', 'Indonesia', NULL, NULL),
(102, 'IR', 'Iran (Islamic Republic of)', NULL, NULL),
(103, 'IQ', 'Iraq', NULL, NULL),
(104, 'IE', 'Ireland', NULL, NULL),
(105, 'IL', 'Israel', NULL, NULL),
(106, 'IT', 'Italy', NULL, NULL),
(107, 'CI', 'Ivory Coast', NULL, NULL),
(108, 'JE', 'Jersey', NULL, NULL),
(109, 'JM', 'Jamaica', NULL, NULL),
(110, 'JP', 'Japan', NULL, NULL),
(111, 'JO', 'Jordan', NULL, NULL),
(112, 'KZ', 'Kazakhstan', NULL, NULL),
(113, 'KE', 'Kenya', NULL, NULL),
(114, 'KI', 'Kiribati', NULL, NULL),
(115, 'KP', 'Korea, Democratic People\'s Republic of', NULL, NULL),
(116, 'KR', 'Korea, Republic of', NULL, NULL),
(117, 'XK', 'Kosovo', NULL, NULL),
(118, 'KW', 'Kuwait', NULL, NULL),
(119, 'KG', 'Kyrgyzstan', NULL, NULL),
(120, 'LA', 'Lao People\'s Democratic Republic', NULL, NULL),
(121, 'LV', 'Latvia', NULL, NULL),
(122, 'LB', 'Lebanon', NULL, NULL),
(123, 'LS', 'Lesotho', NULL, NULL),
(124, 'LR', 'Liberia', NULL, NULL),
(125, 'LY', 'Libyan Arab Jamahiriya', NULL, NULL),
(126, 'LI', 'Liechtenstein', NULL, NULL),
(127, 'LT', 'Lithuania', NULL, NULL),
(128, 'LU', 'Luxembourg', NULL, NULL),
(129, 'MO', 'Macau', NULL, NULL),
(130, 'MK', 'Macedonia', NULL, NULL),
(131, 'MG', 'Madagascar', NULL, NULL),
(132, 'MW', 'Malawi', NULL, NULL),
(133, 'MY', 'Malaysia', NULL, NULL),
(134, 'MV', 'Maldives', NULL, NULL),
(135, 'ML', 'Mali', NULL, NULL),
(136, 'MT', 'Malta', NULL, NULL),
(137, 'MH', 'Marshall Islands', NULL, NULL),
(138, 'MQ', 'Martinique', NULL, NULL),
(139, 'MR', 'Mauritania', NULL, NULL),
(140, 'MU', 'Mauritius', NULL, NULL),
(141, 'TY', 'Mayotte', NULL, NULL),
(142, 'MX', 'Mexico', NULL, NULL),
(143, 'FM', 'Micronesia, Federated States of', NULL, NULL),
(144, 'MD', 'Moldova, Republic of', NULL, NULL),
(145, 'MC', 'Monaco', NULL, NULL),
(146, 'MN', 'Mongolia', NULL, NULL),
(147, 'ME', 'Montenegro', NULL, NULL),
(148, 'MS', 'Montserrat', NULL, NULL),
(149, 'MA', 'Morocco', NULL, NULL),
(150, 'MZ', 'Mozambique', NULL, NULL),
(151, 'MM', 'Myanmar', NULL, NULL),
(152, 'NA', 'Namibia', NULL, NULL),
(153, 'NR', 'Nauru', NULL, NULL),
(154, 'NP', 'Nepal', NULL, NULL),
(155, 'NL', 'Netherlands', NULL, NULL),
(156, 'AN', 'Netherlands Antilles', NULL, NULL),
(157, 'NC', 'New Caledonia', NULL, NULL),
(158, 'NZ', 'New Zealand', NULL, NULL),
(159, 'NI', 'Nicaragua', NULL, NULL),
(160, 'NE', 'Niger', NULL, NULL),
(161, 'NG', 'Nigeria', NULL, NULL),
(162, 'NU', 'Niue', NULL, NULL),
(163, 'NF', 'Norfolk Island', NULL, NULL),
(164, 'MP', 'Northern Mariana Islands', NULL, NULL),
(165, 'NO', 'Norway', NULL, NULL),
(166, 'OM', 'Oman', NULL, NULL),
(167, 'PK', 'Pakistan', NULL, NULL),
(168, 'PW', 'Palau', NULL, NULL),
(169, 'PS', 'Palestine', NULL, NULL),
(170, 'PA', 'Panama', NULL, NULL),
(171, 'PG', 'Papua New Guinea', NULL, NULL),
(172, 'PY', 'Paraguay', NULL, NULL),
(173, 'PE', 'Peru', NULL, NULL),
(174, 'PH', 'Philippines', NULL, NULL),
(175, 'PN', 'Pitcairn', NULL, NULL),
(176, 'PL', 'Poland', NULL, NULL),
(177, 'PT', 'Portugal', NULL, NULL),
(178, 'PR', 'Puerto Rico', NULL, NULL),
(179, 'QA', 'Qatar', NULL, NULL),
(180, 'RE', 'Reunion', NULL, NULL),
(181, 'RO', 'Romania', NULL, NULL),
(182, 'RU', 'Russian Federation', NULL, NULL),
(183, 'RW', 'Rwanda', NULL, NULL),
(184, 'KN', 'Saint Kitts and Nevis', NULL, NULL),
(185, 'LC', 'Saint Lucia', NULL, NULL),
(186, 'VC', 'Saint Vincent and the Grenadines', NULL, NULL),
(187, 'WS', 'Samoa', NULL, NULL),
(188, 'SM', 'San Marino', NULL, NULL),
(189, 'ST', 'Sao Tome and Principe', NULL, NULL),
(190, 'SA', 'Saudi Arabia', NULL, NULL),
(191, 'SN', 'Senegal', NULL, NULL),
(192, 'RS', 'Serbia', NULL, NULL),
(193, 'SC', 'Seychelles', NULL, NULL),
(194, 'SL', 'Sierra Leone', NULL, NULL),
(195, 'SG', 'Singapore', NULL, NULL),
(196, 'SK', 'Slovakia', NULL, NULL),
(197, 'SI', 'Slovenia', NULL, NULL),
(198, 'SB', 'Solomon Islands', NULL, NULL),
(199, 'SO', 'Somalia', NULL, NULL),
(200, 'ZA', 'South Africa', NULL, NULL),
(201, 'GS', 'South Georgia South Sandwich Islands', NULL, NULL),
(202, 'ES', 'Spain', NULL, NULL),
(203, 'LK', 'Sri Lanka', NULL, NULL),
(204, 'SH', 'St. Helena', NULL, NULL),
(205, 'PM', 'St. Pierre and Miquelon', NULL, NULL),
(206, 'SD', 'Sudan', NULL, NULL),
(207, 'SR', 'Suriname', NULL, NULL),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', NULL, NULL),
(209, 'SZ', 'Swaziland', NULL, NULL),
(210, 'SE', 'Sweden', NULL, NULL),
(211, 'CH', 'Switzerland', NULL, NULL),
(212, 'SY', 'Syrian Arab Republic', NULL, NULL),
(213, 'TW', 'Taiwan', NULL, NULL),
(214, 'TJ', 'Tajikistan', NULL, NULL),
(215, 'TZ', 'Tanzania, United Republic of', NULL, NULL),
(216, 'TH', 'Thailand', NULL, NULL),
(217, 'TG', 'Togo', NULL, NULL),
(218, 'TK', 'Tokelau', NULL, NULL),
(219, 'TO', 'Tonga', NULL, NULL),
(220, 'TT', 'Trinidad and Tobago', NULL, NULL),
(221, 'TN', 'Tunisia', NULL, NULL),
(222, 'TR', 'Turkey', NULL, NULL),
(223, 'TM', 'Turkmenistan', NULL, NULL),
(224, 'TC', 'Turks and Caicos Islands', NULL, NULL),
(225, 'TV', 'Tuvalu', NULL, NULL),
(226, 'UG', 'Uganda', NULL, NULL),
(227, 'UA', 'Ukraine', NULL, NULL),
(228, 'AE', 'United Arab Emirates', NULL, NULL),
(229, 'GB', 'United Kingdom', NULL, NULL),
(230, 'US', 'United States', NULL, NULL),
(231, 'UM', 'United States minor outlying islands', NULL, NULL),
(232, 'UY', 'Uruguay', NULL, NULL),
(233, 'UZ', 'Uzbekistan', NULL, NULL),
(234, 'VU', 'Vanuatu', NULL, NULL),
(235, 'VA', 'Vatican City State', NULL, NULL),
(236, 'VE', 'Venezuela', NULL, NULL),
(237, 'VN', 'Vietnam', NULL, NULL),
(238, 'VG', 'Virgin Islands (British)', NULL, NULL),
(239, 'VI', 'Virgin Islands (U.S.)', NULL, NULL),
(240, 'WF', 'Wallis and Futuna Islands', NULL, NULL),
(241, 'EH', 'Western Sahara', NULL, NULL),
(242, 'YE', 'Yemen', NULL, NULL),
(243, 'ZR', 'Zaire', NULL, NULL),
(244, 'ZM', 'Zambia', NULL, NULL),
(245, 'ZW', 'Zimbabwe', NULL, NULL),
(246, 'AR', 'ARIPO', NULL, NULL),
(247, 'OA', 'OAPI', NULL, NULL),
(248, 'EU', 'EUIPO', NULL, NULL),
(249, 'EP', 'EPO', NULL, NULL),
(250, 'EA', 'EAPO', NULL, NULL),
(251, 'GC', 'GCC', NULL, NULL),
(252, 'TL', 'Timor', NULL, NULL),
(257, 'BX', 'Benelux', NULL, NULL),
(258, 'CW', 'Curacoa', NULL, NULL),
(259, 'BE', 'Bonaire Sint Eustatius Saba', NULL, NULL),
(260, 'TN', 'Tanzania- Zanzibar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crew_details`
--

CREATE TABLE `crew_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `crew` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `denominations`
--

CREATE TABLE `denominations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `denomination_master_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denomination` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `denominations`
--

INSERT INTO `denominations` (`id`, `user_id`, `denomination_master_id`, `denomination`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '3', 'Denomination3', 'Description3', '2.00', '2018-02-02 01:54:46', '2018-02-05 02:03:26'),
(2, 1, '2', 'Denomination2', 'Description2', '1.00', '2018-02-02 03:41:21', '2018-02-05 02:02:39'),
(4, 1, '4', 'Denomination4', 'Description4', '4.00', '2018-02-02 03:48:13', '2018-02-05 02:03:59'),
(5, 1, '1', 'Denomination1', 'Description', '1.00', '2018-02-05 02:00:37', '2018-02-05 02:02:30'),
(6, 1, '12', 'Denomination2', 'Description', '4343.00', '2018-02-05 07:00:13', '2018-02-05 07:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `denomination_logs`
--

CREATE TABLE `denomination_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `denomination_master_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denomination` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `denomination_logs`
--

INSERT INTO `denomination_logs` (`id`, `user_id`, `denomination_master_id`, `denomination`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', '2018-02-02 01:54:46'),
(2, 1, '2', 'Short Reason', 'Reason Description', 1, '2018-02-02 03:41:21', '2018-02-02 03:41:21'),
(3, 1, '1', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:32', '2018-02-02 03:41:32'),
(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13'),
(5, 1, '4', '343', '43433', 4343, '2018-02-05 02:00:37', NULL),
(6, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', NULL),
(7, 1, '2', 'Short Reason', 'Reason Description', 1, '2018-02-02 03:41:21', NULL),
(8, 1, '4', 'Denomination', 'Description', 1, '2018-02-05 02:00:37', NULL),
(9, 1, '2', 'Denomination', 'Description1', 1, '2018-02-02 03:41:21', NULL),
(10, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', NULL),
(11, 1, '3', 'Denomination2', 'Description3', 2, '2018-02-02 01:54:46', NULL),
(12, 1, '3', 'Denomination', 'DescriptionReason', 4, '2018-02-02 03:48:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `denomination_masters`
--

CREATE TABLE `denomination_masters` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denomination_masters`
--

INSERT INTO `denomination_masters` (`id`, `name`) VALUES
(12, 'D1'),
(13, 'D2'),
(14, 'D3'),
(18, 'D4');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `denomination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prince` double(8,2) NOT NULL,
  `documentation_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `depots`
--

CREATE TABLE `depots` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depot_id` int(20) NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depot_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depots`
--

INSERT INTO `depots` (`id`, `user_id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sahadara', 1, 'SD', 'Delhi', 'A-G-Holidays', '2018-01-30 05:53:13', '2018-01-30 05:53:13'),
(2, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 'A-G-Holidays', '2018-01-30 07:09:51', '2018-01-30 07:09:51'),
(3, 1, 'Munirka', 13, 'mk', 'Delhi', 'Apple-Travels', '2018-01-30 07:10:40', '2018-01-30 07:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `duties`
--

CREATE TABLE `duties` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `duty_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `duties`
--

INSERT INTO `duties` (`id`, `user_id`, `route_id`, `duty_number`, `description`, `start_time`, `shift_id`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '1-1', 'Description', '12pm', 6, '31232', '2018-01-03 05:29:56', '2018-01-04 07:04:58'),
(2, 1, 2, '1-2', 'Description', '12pm', 6, '31232', '2018-01-03 05:31:16', '2018-01-04 07:05:15'),
(3, 1, 2, '1-1', 'Legacy interface notice: This discussion was created before the release of DataTables 1.10, which introduced a more modern API. The documentation for the old DataTables API is still available and newer versions are backwards compatible, but the primary documentation on this site refers to DataTables 1.10 and newer. A conversion guide details how the two API styles relate. Updating to 1.10+ is recommended if you haven\'t already.', '12:36 PM', 5, '31232', '2018-01-04 07:14:57', '2018-01-04 07:24:57'),
(4, 1, 2, 'Duty Number', 'Description', '12:36 PM', 7, '1-1', '2018-01-04 07:24:53', '2018-01-04 07:24:53'),
(5, 1, 4, '1-1', 'Your job duties include stopping to let passengers board and de-board, collecting fares, interacting with customers, and maintaining order on your bus. You must know your route well, stay alert in bad traffic or weather conditions, and follow safety rules of the road.', '12:36 PM', 7, '1-1', '2018-01-08 23:04:05', '2018-01-08 23:04:05'),
(6, 1, 2, '1-1', 'Description', '12:36 PM', 6, '31232', '2018-01-08 23:08:53', '2018-01-08 23:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `etm_hot_key_masters`
--

CREATE TABLE `etm_hot_key_masters` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etm_hot_key_masters`
--

INSERT INTO `etm_hot_key_masters` (`id`, `name`) VALUES
(1, 'k1'),
(2, 'k2');

-- --------------------------------------------------------

--
-- Table structure for table `fares`
--

CREATE TABLE `fares` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult_ticket_amount` decimal(20,2) NOT NULL,
  `child_ticket_amount` decimal(20,2) NOT NULL,
  `luggage_ticket_amount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fares`
--

INSERT INTO `fares` (`id`, `user_id`, `service_id`, `stage`, `adult_ticket_amount`, `child_ticket_amount`, `luggage_ticket_amount`, `created_at`, `updated_at`) VALUES
(4, '1', 1, '1', '5.00', '5.00', '10.00', '2018-01-31 02:04:09', '2018-01-31 02:04:09'),
(5, '1', 6, '1', '12.00', '12.00', '12.00', NULL, '2018-01-31 02:12:10'),
(6, '1', 6, '2', '5.00', '5.00', '10.00', '2018-01-31 02:10:29', '2018-01-31 02:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `fares_copy`
--

CREATE TABLE `fares_copy` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luggage_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fares_copy`
--

INSERT INTO `fares_copy` (`id`, `user_id`, `service_id`, `stage`, `adult_ticket_amount`, `child_ticket_amount`, `luggage_ticket_amount`, `created_at`, `updated_at`) VALUES
(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `fare_logs`
--

CREATE TABLE `fare_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luggage_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fare_logs`
--

INSERT INTO `fare_logs` (`id`, `user_id`, `service_id`, `stage`, `adult_ticket_amount`, `child_ticket_amount`, `luggage_ticket_amount`, `created_at`, `updated_at`) VALUES
(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11'),
(2, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11'),
(3, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11'),
(4, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `inspector_remarks`
--

CREATE TABLE `inspector_remarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `inspector_remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inspector_remarks`
--

INSERT INTO `inspector_remarks` (`id`, `user_id`, `inspector_remark`, `short_remark`, `remark_description`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 2, '2018-02-02 05:55:38', '2018-02-02 05:55:38'),
(2, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 4, '2018-02-02 06:01:01', '2018-02-02 06:01:01'),
(3, 1, 'Inspector Remark2', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:13', '2018-02-02 06:01:13'),
(4, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 1, '2018-02-02 06:01:25', '2018-02-02 06:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `inspector_remark_logs`
--

CREATE TABLE `inspector_remark_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `inspector_remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inspector_remark_logs`
--

INSERT INTO `inspector_remark_logs` (`id`, `user_id`, `inspector_remark`, `short_remark`, `remark_description`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 1, '2018-02-02 05:55:38', '2018-02-02 05:55:38'),
(2, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:01', '2018-02-02 06:01:01'),
(3, 1, 'Inspector Remark2', 'Short Remark', 'Remark Description', 2, '2018-02-02 06:01:13', '2018-02-02 06:01:13'),
(4, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 4, '2018-02-02 06:01:25', '2018-02-02 06:01:25'),
(5, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2015_06_07_211555_alter_category_name_to_unique', 1),
(13, '2016_11_02_193415_drop_version4_unused_tables', 1),
(14, '2017_12_14_062521_create_depots_table', 1),
(15, '2017_12_14_070910_entrust_setup_tables', 1),
(16, '2017_12_14_083124_create_bus_types_table', 1),
(17, '2017_12_14_090509_create_services_table', 1),
(18, '2017_12_14_090809_create_vehicles_table', 1),
(19, '2017_12_14_091242_create_shifts_table', 1),
(20, '2017_12_14_091813_create_stops_table', 1),
(21, '2017_12_14_092049_create_routes_table', 1),
(22, '2017_12_14_092450_create_duties_table', 1),
(23, '2017_12_14_104150_create_targets_table', 1),
(24, '2017_12_14_104756_create_trips_table', 1),
(25, '2017_12_14_105641_create_fares_table', 1),
(26, '2017_12_14_110249_create_concession_fare_slabs_table', 1),
(27, '2017_12_14_111321_create_concessions_table', 1),
(28, '2017_12_14_112355_create_trip_collection_reasons_table', 1),
(29, '2017_12_14_112956_create_inspector_remarks_table', 1),
(30, '2017_12_14_113352_create_payout_reasons_table', 1),
(31, '2017_12_14_113823_create_departments_table', 1),
(32, '2017_12_14_114129_create_pass_types_table', 1),
(33, '2017_12_14_120513_create_crew_details_table', 1),
(34, '2017_12_26_125021_create_bustypes_table', 2);



-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pass_types`
--

CREATE TABLE `pass_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `concession_provider_master_id` int(20) NOT NULL,
  `pass_type_master_id` int(20) NOT NULL,
  `passprovider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ammount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_age` int(11) NOT NULL,
  `accept_age_from` date NOT NULL,
  `accept_age_to` date NOT NULL,
  `accept_spouse_age` int(11) NOT NULL,
  `accept_spouse_age_from` date NOT NULL,
  `accept_spouse_age_to` date NOT NULL,
  `accept_id_number` tinyint(1) NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pass_type_masters`
--

CREATE TABLE `pass_type_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_type_masters`
--

INSERT INTO `pass_type_masters` (`id`, `name`) VALUES
(1, 'P1'),
(2, 'P2');

-- --------------------------------------------------------

--
-- Table structure for table `payout_reasons`
--

CREATE TABLE `payout_reasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `payout_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_reasons`
--

INSERT INTO `payout_reasons` (`id`, `user_id`, `payout_reason`, `short_reason`, `reason_description`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Payout Reason', 'Short Reason', 'Reason Description', 3, '2018-02-05 00:20:40', '2018-02-05 00:20:40'),
(2, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', '2018-02-05 00:25:03'),
(3, 1, 'Payout Reason3', 'Short Reason3', 'Reason Description3', 1, '2018-02-05 00:23:30', '2018-02-05 00:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `payout_reason_logs`
--

CREATE TABLE `payout_reason_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `payout_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_reason_logs`
--

INSERT INTO `payout_reason_logs` (`id`, `user_id`, `payout_reason`, `short_reason`, `reason_description`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Payout Reason1', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', NULL),
(2, 1, 'Payout Reason', 'Short Reason3', 'Reason Description3', 3, '2018-02-05 00:23:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changepasswords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bus_types` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicles` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shifts` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stops` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `routes` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duties` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `targets` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fares` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concession_fare_slabs` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concessions` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_cancellation_reasons` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inspector_remarks` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payout_reasons` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denominations` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_types` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crew_details` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `users`, `changepasswords`, `permissions`, `depots`, `bus_types`, `services`, `vehicles`, `shifts`, `stops`, `routes`, `duties`, `targets`, `fares`, `concession_fare_slabs`, `concessions`, `trip_cancellation_reasons`, `inspector_remarks`, `payout_reasons`, `denominations`, `pass_types`, `crew_details`, `view`, `created_at`, `updated_at`) VALUES
(8, '5', 'users,create,edit,view', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', '', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', '', '', '', '', '', '', '', '', NULL, '2018-01-15 00:30:23', '2018-01-18 23:33:18'),
(9, '1', 'users,create,edit,view', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', NULL, '2018-01-15 00:32:12', '2018-02-05 01:01:45'),
(10, '6', 'users,create,edit,view', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reason,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominatios,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-01-25 04:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `permissions_`
--

CREATE TABLE `permissions_` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions_old`
--

CREATE TABLE `permissions_old` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions_old`
--

INSERT INTO `permissions_old` (`id`, `name`, `display_name`, `description`, `route`, `created_at`, `updated_at`) VALUES
(1, 'manage_roles', 'Manage roles', '', 'roles', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(2, 'create_roles', 'Create roles', '', 'roles/create', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(3, 'update_roles', 'Update roles', '', 'roles/{roles}/edit', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(4, 'delete_roles', 'Delete roles', '', 'roles/{roles}', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(5, 'manage_users', 'Manager users', '', 'users', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(6, 'create_users', 'Create users', '', 'users/create', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(7, 'update_users', 'Update users', '', 'users/{users}/edit', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(8, 'delete_users', 'Delete users', '', 'users/{users}', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(9, 'manage_permissions', 'Manage permissions', '', 'permissions', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(10, 'create_permissions', 'Create permissions', '', 'permissions/create', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(11, 'update_permissions', 'Update permissions', '', 'permissions/{permissions}/edit', '2017-12-10 19:36:33', '2017-12-10 19:36:33'),
(12, 'delete_permissions', 'Delete permissions', '', 'permissions/{permissions}', '2017-12-10 19:36:34', '2017-12-10 19:36:34'),
(14, 'create_setting', 'Delete permissions', '', 'permissions/{permissions}', '2017-12-10 19:36:34', '2017-12-10 19:36:34'),
(15, 'test123', 'Test123', 'Description', NULL, '2017-12-15 02:02:57', '2017-12-15 02:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(14, 1),
(15, 1),
(9, 2),
(10, 2),
(11, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role_`
--

CREATE TABLE `permission_role_` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 'NULL', '2017-12-21 18:30:00', '2017-12-28 18:30:00'),
(2, 'editor', 'Editor', 'NULL', '2017-12-07 18:30:00', '2017-12-06 18:30:00'),
(3, 'user', 'User', 'NULL', '2017-12-28 18:30:00', '2017-12-21 18:30:00'),
(4, 'depot', 'Depot', 'Test', '2017-12-15 02:01:20', '2017-12-15 02:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_path` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stop_id` int(10) UNSIGNED NOT NULL,
  `stage_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hot_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_this_by` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `user_id`, `route`, `path`, `direction`, `default_path`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`, `created_at`, `updated_at`) VALUES
(2, 1, '63', '63:JANKPURI C1', '1', '1', 1, '22', '22.00', '22', 0, '2018-01-03 02:06:29', '2018-01-03 03:17:35'),
(3, 1, '64', '63:JANKPURI C1', '1', '1', 2, '22', '22.00', '22', 0, '2018-01-03 05:39:40', '2018-01-03 05:39:40'),
(4, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '22 KM', '22t', 0, '2018-01-04 06:50:32', '2018-01-04 06:50:32'),
(5, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '22 KM', '22t', 0, '2018-01-04 06:51:31', '2018-01-04 06:51:31'),
(6, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '22 KM', '22t', 0, '2018-01-04 07:24:29', '2018-01-04 07:24:29'),
(7, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '22 KM', '22', 0, '2018-01-05 04:05:40', '2018-01-05 04:05:40'),
(8, 1, 'New Root', '63:JANKPURI C1', '1', '1', 1, '22MM', '22', '22', 0, '2018-01-08 06:19:37', '2018-01-08 23:08:26'),
(9, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '22 KM', '22t', 0, '2018-01-08 07:06:54', '2018-01-08 07:06:54'),
(10, 1, '63-123', '63:JANKPURI C1', '1', '1', 2, '22MM', '22 KM', '22t', 0, '2018-01-08 07:09:23', '2018-01-08 07:09:23'),
(11, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '12', '22t', 0, '2018-01-08 07:12:50', '2018-01-08 07:12:50'),
(12, 1, '63-123', '63:JANKPURI C1', '1', '1', 1, '22MM', '22 KM', '22', 0, '2018-01-08 23:08:16', '2018-01-08 23:08:16'),
(13, 1, 'Mayur Vihar', 'Ashram', '1', NULL, 1, '3', '35', '22', 1, '2018-01-18 11:24:36', '2018-01-18 11:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `bus_type_id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `bus_type_id`, `name`, `short_name`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'A-G-Holidays ', 'Express ', 6, '2017-12-27 23:20:45', '2018-02-02 05:07:57'),
(6, 1, 1, 'Aadithya-Travels ', 'AT', 1, '2017-12-27 23:20:45', '2018-01-31 04:14:50'),
(7, 1, 1, 'BSR-Travels', 'BT', 2, '2017-12-28 01:01:05', '2018-01-31 04:14:40'),
(8, 1, 2, 'Express bus service', 'EX', 4, '2018-01-04 05:49:05', '2018-01-31 04:13:15'),
(9, 1, 1, 'Delux', 'Sahadara', 3, '2018-02-01 06:26:45', '2018-02-01 06:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_complete_allowed` int(11) NOT NULL,
  `task_assign_allowed` int(11) NOT NULL,
  `lead_complete_allowed` int(11) NOT NULL,
  `lead_assign_allowed` int(11) NOT NULL,
  `time_change_allowed` int(11) NOT NULL,
  `comment_allowed` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `task_complete_allowed`, `task_assign_allowed`, `lead_complete_allowed`, `lead_assign_allowed`, `time_change_allowed`, `comment_allowed`, `country`, `company`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 2, 2, 2, '', 'Media', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `user_id`, `shift`, `abbreviation`, `start_time`, `end_time`, `order_number`, `system_id`, `created_at`, `updated_at`) VALUES
(5, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '31232', '10-11', '2018-01-04 06:09:18', '2018-01-08 06:05:20'),
(6, 1, 'Day', 'Abbreviation', '12:36 PM', '20:36 PM', '33:33', '10-11', '2018-01-04 06:33:13', '2018-01-05 04:04:57'),
(7, 1, 'Night', 'AN', '12:36 PM', '20:36 PM', '1-1', '10-11', '2018-01-04 07:23:47', '2018-01-04 07:23:47'),
(8, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '31232', '10-11', '2018-01-05 04:04:48', '2018-01-05 04:04:48'),
(9, 1, 'After Noon', 'AN', '12:36 PM', '14:36 PM', '31232', '10', '2018-01-05 04:16:14', '2018-01-05 04:16:14'),
(10, 1, 'Night', 'N. AC', '12:36 PM', '16:36 PM', '31232', '10-11', '2018-01-08 06:05:37', '2018-01-08 06:05:37'),
(11, 1, 'After Noon', 'Abbreviation', '12:36 PM', '16:36 PM', '31232', '10-11', '2018-01-08 23:06:42', '2018-01-08 23:06:42'),
(12, 1, 'After Noon', 'AN', '12:3', '20:36 PM', '1-1', '10', '2018-01-11 00:41:49', '2018-01-11 00:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE `stops` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `stop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`id`, `user_id`, `stop`, `stop_id`, `abbreviation`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', '2018-01-02 23:39:08'),
(2, 1, 'ANAND VIHAR', '123', 'AN', 'AN', '2018-01-02 06:56:25', '2018-01-03 00:10:04'),
(3, 1, 'JANAK PURI WEST', '43123', 'JANAK PURI', 'JK', '2018-01-02 23:40:02', '2018-01-02 23:40:02'),
(4, 1, 'DHAULA KUAN', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:37:33', '2018-01-04 06:37:33'),
(5, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', '2018-01-04 06:44:45'),
(6, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', '2018-01-04 07:24:03'),
(7, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'MH', '2018-01-05 04:05:14', '2018-01-05 04:05:14'),
(8, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', '2018-01-08 06:10:46'),
(9, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', '2018-01-08 06:17:05'),
(10, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', '2018-01-08 23:07:14'),
(11, 1, 'kAROL BAG', '123', 'K', 'JK', '2018-01-30 05:56:48', '2018-01-30 05:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `duty_id` int(20) NOT NULL,
  `shift_id` int(20) NOT NULL,
  `trip` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `epkm` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `income` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incentive` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_share` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conductor_share` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `targets`
--

INSERT INTO `targets` (`id`, `user_id`, `route_id`, `duty_id`, `shift_id`, `trip`, `epkm`, `income`, `incentive`, `driver_share`, `conductor_share`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 5, 'Trip', '12.04', '4524543', '23', '233', '230', '2018-01-18 07:10:52', '2018-01-25 05:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `duty_id` int(10) UNSIGNED NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `devited_route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devited_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_cancellation_reasons`
--

CREATE TABLE `trip_cancellation_reasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `trip_cancellation_reason_category_master_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_cancellation_reasons`
--

INSERT INTO `trip_cancellation_reasons` (`id`, `user_id`, `trip_cancellation_reason_category_master_id`, `short_reason`, `reason_description`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', '2018-02-02 01:54:46'),
(2, 1, '2', 'Short Reason', 'Reason Description', 1, '2018-02-02 03:41:21', '2018-02-02 03:41:21'),
(3, 1, '1', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:32', '2018-02-02 03:41:32'),
(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `trip_cancellation_reason_category_masters`
--

CREATE TABLE `trip_cancellation_reason_category_masters` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_cancellation_reason_category_masters`
--

INSERT INTO `trip_cancellation_reason_category_masters` (`id`, `name`) VALUES
(1, 'No Fuel'),
(2, 'Others'),
(3, 'T1'),
(4, 'T2');

-- --------------------------------------------------------

--
-- Table structure for table `trip_cancellation_reason_logs`
--

CREATE TABLE `trip_cancellation_reason_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `trip_cancellation_reason_category_master_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_cancellation_reason_logs`
--

INSERT INTO `trip_cancellation_reason_logs` (`id`, `user_id`, `trip_cancellation_reason_category_master_id`, `short_reason`, `reason_description`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Short Reason', 'Reason Description', 1, '2018-02-02 01:54:46', '2018-02-02 01:54:46'),
(2, 1, '2', 'Short Reason', 'Reason Description', 2, '2018-02-02 03:41:21', '2018-02-02 03:41:21'),
(3, 1, '1', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:32', '2018-02-02 03:41:32'),
(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13'),
(5, 1, '1', 'Short Reason', 'Reason Description', 1, '2018-02-02 01:54:46', NULL),
(6, 1, '3', 'Short Reason1', 'Reason Description1', 2, '2018-02-02 03:48:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image_path` blob,
  `set_password_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `address`, `country`, `city`, `password`, `mobile`, `date_of_birth`, `image_path`, `set_password_token`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Satya', 'satya', 'admin@opiant.online', 'Address', '1', 'City', '$2y$10$MWfXGKCjCjbWualp7R/xXud3QibZbw9xCz2BPnIWGLHyMXabTDWyC', '3453425454', '2017-12-01', 0x576259656a6d49465f53637265656e73686f742066726f6d20323031372d30342d30362031332d31322d35312e706e67, NULL, 'D6ATGdMUzi4HLnn60cFAVxBxKoMu5pnVoqoS7sg45PwdO2S0IN0o8m7cmv2K', 0, NULL, '2018-02-01 01:31:54'),
(2, 'Ravi', 'Ravi Kumar', 'admin1@opiant.online', 'Address', '99', 'City', '$2y$10$qAF5KR29F8/q2.6J0/9aoOOJ9AZ0GXBM7z2ehcE9RWKQHmNmq4ftO', '3453425454', '2017-12-02', 0x566d7a584d4864475f53637265656e73686f742066726f6d20323031372d30342d32362031352d32352d30302e706e67, NULL, '', 0, NULL, '2018-01-17 04:39:19'),
(5, 'Subhash Prajapati', 'Subhash Prajapati', 'admin3@opiant.online', 'Address', '167', 'City', '$2y$10$qAF5KR29F8/q2.6J0/9aoOOJ9AZ0GXBM7z2ehcE9RWKQHmNmq4ftO', '3441454552', '2018-01-03', 0x4d3873466958396a5f6461696c795f75695f3030325f5f5f6c6f67696e5f706167655f62795f736b7970757269666965722d643968757767772e706e67, 'Y7noP4OlbZH1JyE7wzl764Mc6E9KQidjy8BGE73V', 'Qf8gApi5lFXqmXQh3EKFlasLNQhSVu9X5mwo3rtY9g43h23IVRKfC2hsERlt', 0, '2018-01-04 05:17:37', '2018-01-17 04:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `users_`
--

CREATE TABLE `users_` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `set_password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_1`
--

CREATE TABLE `users_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `set_password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `depot_id` int(20) NOT NULL,
  `vehicle_registration_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_type_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `user_id`, `depot_id`, `vehicle_registration_number`, `bus_type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'DL-12', 1, '2017-12-28 02:50:04', '2018-01-11 00:39:08'),
(2, 1, 10, 'DL-1243', 2, '2017-12-28 02:55:29', '2018-01-10 04:09:39'),
(3, 1, 2, 'DL-1243555', 2, '2017-12-28 03:34:23', '2018-01-08 05:58:57'),
(4, 1, 1, 'DL-12', 1, '2018-01-05 04:03:52', '2018-01-05 04:03:52'),
(5, 1, 4, 'DL-1243555', 3, '2018-01-05 04:04:26', '2018-01-05 04:04:26'),
(6, 1, 3, 'DL-1243555', 2, '2018-01-08 05:59:08', '2018-01-08 05:59:08'),
(7, 1, 2, 'DL-1243555', 2, '2018-01-08 23:06:14', '2018-01-08 23:06:14'),
(8, 1, 10, 'DL-1243555', 2, '2018-01-10 04:10:14', '2018-01-10 04:10:14'),
(9, 1, 17, 'DL-1243', 1, '2018-01-10 04:10:33', '2018-01-10 04:10:33'),
(10, 1, 10, 'DL-1243111321', 9, '2018-01-11 00:34:15', '2018-01-11 00:34:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_types`
--
ALTER TABLE `bus_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concessions`
--
ALTER TABLE `concessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concessions_service_id_foreign` (`service_id`);

--
-- Indexes for table `concession_fare_slabs`
--
ALTER TABLE `concession_fare_slabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concession_fare_slabs_service_id_foreign` (`service_id`);

--
-- Indexes for table `concession_fare_slab_logs`
--
ALTER TABLE `concession_fare_slab_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concession_fare_slabs_service_id_foreign` (`service_id`);

--
-- Indexes for table `concession_logs`
--
ALTER TABLE `concession_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concessions_service_id_foreign` (`service_id`);

--
-- Indexes for table `concession_masters`
--
ALTER TABLE `concession_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concession_provider_masters`
--
ALTER TABLE `concession_provider_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crew_details`
--
ALTER TABLE `crew_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crew_details_depot_id_foreign` (`depot_id`),
  ADD KEY `crew_details_role_id_foreign` (`role_id`);

--
-- Indexes for table `denominations`
--
ALTER TABLE `denominations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `denomination_logs`
--
ALTER TABLE `denomination_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `denomination_masters`
--
ALTER TABLE `denomination_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depots`
--
ALTER TABLE `depots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duties`
--
ALTER TABLE `duties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `duties_route_id_foreign` (`route_id`),
  ADD KEY `duties_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `etm_hot_key_masters`
--
ALTER TABLE `etm_hot_key_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fares`
--
ALTER TABLE `fares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fares_service_id_foreign` (`service_id`);

--
-- Indexes for table `fare_logs`
--
ALTER TABLE `fare_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspector_remarks`
--
ALTER TABLE `inspector_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspector_remark_logs`
--
ALTER TABLE `inspector_remark_logs`
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
-- Indexes for table `pass_types`
--
ALTER TABLE `pass_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_types_service_id_foreign` (`service_id`);

--
-- Indexes for table `pass_type_masters`
--
ALTER TABLE `pass_type_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_types_service_id_foreign` (`name`);

--
-- Indexes for table `payout_reasons`
--
ALTER TABLE `payout_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_reason_logs`
--
ALTER TABLE `payout_reason_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`user_id`);

--
-- Indexes for table `permissions_`
--
ALTER TABLE `permissions_`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permissions_old`
--
ALTER TABLE `permissions_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_role_`
--
ALTER TABLE `permission_role_`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routes_stop_id_foreign` (`stop_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targets_route_id_foreign` (`route_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_route_id_foreign` (`route_id`),
  ADD KEY `trips_duty_id_foreign` (`duty_id`),
  ADD KEY `trips_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `trip_cancellation_reasons`
--
ALTER TABLE `trip_cancellation_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_cancellation_reason_category_masters`
--
ALTER TABLE `trip_cancellation_reason_category_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_cancellation_reason_logs`
--
ALTER TABLE `trip_cancellation_reason_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_`
--
ALTER TABLE `users_`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_1`
--
ALTER TABLE `users_1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_types`
--
ALTER TABLE `bus_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `concessions`
--
ALTER TABLE `concessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `concession_fare_slabs`
--
ALTER TABLE `concession_fare_slabs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `concession_fare_slab_logs`
--
ALTER TABLE `concession_fare_slab_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `concession_logs`
--
ALTER TABLE `concession_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `concession_masters`
--
ALTER TABLE `concession_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `concession_provider_masters`
--
ALTER TABLE `concession_provider_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;
--
-- AUTO_INCREMENT for table `crew_details`
--
ALTER TABLE `crew_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `denominations`
--
ALTER TABLE `denominations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `denomination_logs`
--
ALTER TABLE `denomination_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `denomination_masters`
--
ALTER TABLE `denomination_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `depots`
--
ALTER TABLE `depots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `duties`
--
ALTER TABLE `duties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `etm_hot_key_masters`
--
ALTER TABLE `etm_hot_key_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fares`
--
ALTER TABLE `fares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `inspector_remarks`
--
ALTER TABLE `inspector_remarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inspector_remark_logs`
--
ALTER TABLE `inspector_remark_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--


-- AUTO_INCREMENT for table `pass_types`
--
ALTER TABLE `pass_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pass_type_masters`
--
ALTER TABLE `pass_type_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payout_reasons`
--
ALTER TABLE `payout_reasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payout_reason_logs`
--
ALTER TABLE `payout_reason_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions_`
--
ALTER TABLE `permissions_`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions_old`
--
ALTER TABLE `permissions_old`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `stops`
--
ALTER TABLE `stops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trip_cancellation_reasons`
--
ALTER TABLE `trip_cancellation_reasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trip_cancellation_reason_category_masters`
--
ALTER TABLE `trip_cancellation_reason_category_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trip_cancellation_reason_logs`
--
ALTER TABLE `trip_cancellation_reason_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_`
--
ALTER TABLE `users_`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_1`
--
ALTER TABLE `users_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `concession_fare_slabs`
--
ALTER TABLE `concession_fare_slabs`
  ADD CONSTRAINT `concession_fare_slabs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `crew_details`
--
ALTER TABLE `crew_details`
  ADD CONSTRAINT `crew_details_depot_id_foreign` FOREIGN KEY (`depot_id`) REFERENCES `depots` (`id`),
  ADD CONSTRAINT `crew_details_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `duties`
--
ALTER TABLE `duties`
  ADD CONSTRAINT `duties_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `duties_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`);

--
-- Constraints for table `fares`
--
ALTER TABLE `fares`
  ADD CONSTRAINT `fares_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);


--
-- Constraints for table `pass_types`
--
ALTER TABLE `pass_types`
  ADD CONSTRAINT `pass_types_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `permission_role_`
--
ALTER TABLE `permission_role_`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions_` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_stop_id_foreign` FOREIGN KEY (`stop_id`) REFERENCES `stops` (`id`);

--
-- Constraints for table `targets`
--
ALTER TABLE `targets`
  ADD CONSTRAINT `targets_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`);

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_duty_id_foreign` FOREIGN KEY (`duty_id`) REFERENCES `duties` (`id`),
  ADD CONSTRAINT `trips_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `trips_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `routes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;