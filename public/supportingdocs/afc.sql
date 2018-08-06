-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2018 at 07:39 AM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.1.18-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afcqixtix`
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
(1, 1, 'AC12', 'AC', '2', '2017-12-27 02:54:59', '2018-02-21 05:42:42'),
(2, 1, 'NON AC', 'NON', '6', '2017-12-27 02:56:04', '2018-01-08 01:28:45'),
(3, 1, 'Luxury', 'LU1', '4', '2018-01-19 01:17:27', '2018-02-22 00:51:10'),
(4, 1, 'Sleeper Bus', 'S.P', '3', '2018-01-29 00:56:16', '2018-01-29 00:56:16'),
(5, 1, 'Delux', 'N. AC', '1', '2018-02-01 06:20:35', '2018-02-01 06:20:51'),
(6, 1, 'AC', 'Abbreviation', '5', '2018-02-21 05:30:09', '2018-02-21 05:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `bus_type_logs`
--

CREATE TABLE `bus_type_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `bus_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(12000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_type_logs`
--

INSERT INTO `bus_type_logs` (`id`, `user_id`, `bus_type`, `abbreviation`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', '2017-12-27 04:03:17'),
(2, 1, 'NON AC', 'NON', '5', '2017-12-27 02:56:04', '2018-01-08 01:28:45'),
(3, 1, 'Luxury', 'LU', '3', '2018-01-19 01:17:27', '2018-01-19 01:17:27'),
(4, 1, 'Sleeper Bus', 'S.P', '2', '2018-01-29 00:56:16', '2018-01-29 00:56:16'),
(5, 1, 'Delux', 'N. AC', '6', '2018-02-01 06:20:35', '2018-02-01 06:20:51'),
(6, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', '2018-02-21 05:30:23'),
(7, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', NULL),
(8, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', NULL),
(9, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', NULL),
(10, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', NULL),
(11, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', NULL),
(12, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', NULL),
(13, 1, 'AC12', 'AC', '1', '2017-12-27 02:54:59', NULL),
(14, 1, 'Luxury', 'LU', '6', '2018-01-19 01:17:27', NULL),
(15, 1, 'Delux', 'N. AC', '5', '2018-02-01 06:20:35', NULL),
(16, 1, 'Sleeper Bus', 'S.P', '2', '2018-01-29 00:56:16', NULL);

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
(8, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '11.00', '2018-01-31 05:09:03', '2018-02-28 06:01:01'),
(9, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', '2018-01-31 06:14:16'),
(11, 1, 14, 2, 1, 'Description', 3, '12', 1, 'No', '1', '2018-02-01', NULL, '214.00', '2018-02-28 05:47:57', '2018-02-28 05:59:39');

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
(4, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:49:48'),
(5, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', NULL);

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
(27, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL),
(28, 1, 8, 1, 1, 'Description', 2, '10', 1, 'No', '1', '2018-02-07', NULL, '20.00', '2018-02-04 23:29:29', NULL),
(29, 1, 8, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-02-07', NULL, '20.00', '2018-02-04 23:29:29', NULL),
(30, 1, 8, 1, 1, 'Description', 2, '10', 1, 'No', '1', '2018-02-07', NULL, '21.00', '2018-02-04 23:29:29', NULL),
(31, 1, 6, 1, 1, 'Description', 1, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL),
(32, 1, 6, 1, 1, 'Description', 1, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL),
(33, 1, 14, 1, 1, 'Description', 1, '12', 1, 'No', '1', '2018-02-01', NULL, '12.00', '2018-02-28 05:47:57', NULL),
(34, 1, 14, 1, 1, 'Description', 2, '12', 1, 'No', '1', '2018-02-01', NULL, '14.00', '2018-02-28 05:47:57', NULL),
(35, 1, 14, 1, 1, 'Description', 2, '12', 1, 'No', '1', '2018-02-01', NULL, '114.00', '2018-02-28 05:47:57', NULL),
(36, 1, 14, 1, 1, 'Description', 3, '12', 1, 'No', '1', '2018-02-01', NULL, '214.00', '2018-02-28 05:47:57', NULL),
(37, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL),
(38, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '11.00', '2018-01-31 05:09:03', NULL);

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
  `depot_id` int(20) NOT NULL,
  `role` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `crew_name` varchar(202) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `crew_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `licence_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid_up_to` date DEFAULT NULL,
  `pf_no` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `date_of_leaving` date DEFAULT NULL,
  `password_reset` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crew_details`
--

INSERT INTO `crew_details` (`id`, `depot_id`, `role`, `user_id`, `crew_name`, `password`, `crew_id`, `gender`, `father_name`, `licence_no`, `valid_up_to`, `pf_no`, `city`, `country_id`, `address`, `mobile`, `date_of_birth`, `date_of_join`, `date_of_leaving`, `password_reset`, `status`, `created_at`, `updated_at`) VALUES
(9, 1, 'Conductor', 1, 'Mukesh', '12345', '12345', 'Male', 'Rajesh', '121212', '2018-07-02', '123456', 'GWALIOR', '99', '10 GOVINDPURI, UNIVERSITY ROAD', '9015548861', '2018-07-02', '2018-07-02', '2018-07-02', NULL, 0, '2018-07-02 14:54:17', '2018-07-02 14:54:17'),
(10, 1, 'Inspector', 1, 'Mukesh', '12345', '12345', 'Male', 'Dinesh', '121212433443', '2018-07-02', '123456', 'GWALIOR', '99', '10 GOVINDPURI, UNIVERSITY ROAD', '9015548861', '2018-07-02', '2018-07-02', '2018-07-02', NULL, 0, '2018-07-02 14:54:17', '2018-07-02 14:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `crew_detail_logs`
--

CREATE TABLE `crew_detail_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(20) NOT NULL,
  `role` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `crew_name` varchar(202) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `crew_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `licence_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid_up_to` date DEFAULT NULL,
  `pf_no` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `date_of_leaving` date DEFAULT NULL,
  `password_reset` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crew_detail_logs`
--

INSERT INTO `crew_detail_logs` (`id`, `depot_id`, `role`, `user_id`, `crew_name`, `password`, `crew_id`, `gender`, `father_name`, `licence_no`, `valid_up_to`, `pf_no`, `city`, `country_id`, `address`, `mobile`, `date_of_birth`, `date_of_join`, `date_of_leaving`, `password_reset`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, '', 1, 'Crew Name', '123', '1', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '18', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', '2018-02-20 04:11:16'),
(6, 1, '', 2, '', '', '', '', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(7, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', '2018-02-20 05:17:39'),
(8, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL),
(9, 1, '', 2, '', '', '', '', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(10, 1, '', 1, 'Crew Name', '123', '1', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '18', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL),
(11, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL),
(12, 1, 'Driver', 1, 'test', '', '11', '', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(13, 1, 'Conductor', 1, 'Crew Name', '123', '11', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL),
(14, 1, 'Conductor', 1, 'Crew Name', '123', '11', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL),
(15, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL),
(16, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', '', '', NULL, '', '', '18', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL),
(17, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', '', '', NULL, '', '', '18', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL),
(18, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', 'Father Name', '32423', '2018-02-01', '343434', 'Delhi', '18', 'H.No 5 Hastsal Village', '2323213213', '2018-02-01', '2018-02-01', '2018-02-01', NULL, 0, '2018-02-20 05:17:39', NULL),
(19, 1, 'Conductor', 1, 'Crew Name', '123', '11', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '1', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL),
(20, 1, 'Conductor', 1, 'Crew Name', '123', '1111', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '1', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL),
(21, 2, 'Conductor1', 1, 'Crew Name1', 'admin', '123231', 'Male', 'Father Name', '32423', '2018-02-01', '3434341111', 'Delhi1', '1', 'H.No 5 Hastsal Village1', '2323213213', '2018-02-20', '2018-02-20', '2018-02-20', NULL, 0, '2018-02-20 05:17:39', NULL);

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
(1, 1, '13', 'Denomination3', 'Description3', '2.00', '2018-02-02 01:54:46', '2018-02-06 06:32:48'),
(2, 1, '14', 'Denomination2', 'Description2', '1.00', '2018-02-02 03:41:21', '2018-02-06 06:32:56'),
(4, 1, '4', 'Denomination4', 'Description4', '4.00', '2018-02-02 03:48:13', '2018-02-05 02:03:59'),
(5, 1, '1', 'Denomination1', 'Description', '1.00', '2018-02-05 02:00:37', '2018-02-05 02:02:30'),
(6, 1, '12', 'Denomination2', 'Description', '4343.00', '2018-02-05 07:00:13', '2018-02-05 07:00:13'),
(7, 1, '19', 'Denomination', '10', '12.00', '2018-02-12 04:58:34', '2018-02-12 04:58:34');

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
(12, 1, '3', 'Denomination', 'DescriptionReason', 4, '2018-02-02 03:48:13', NULL),
(13, 1, '12', 'Denomination2', 'Description', 4343, '2018-02-05 07:00:13', NULL),
(14, 1, '12', 'Denomination2', 'Description', 4343, '2018-02-05 07:00:13', NULL),
(15, 1, '12', 'Denomination2', 'Description', 4343, '2018-02-05 07:00:13', NULL),
(16, 1, '3', 'Denomination3', 'Description3', 2, '2018-02-02 01:54:46', NULL),
(17, 1, '2', 'Denomination2', 'Description2', 1, '2018-02-02 03:41:21', NULL);

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
(18, 'D4'),
(19, 'D5'),
(20, '6'),
(21, 'D7');

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
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depots`
--

INSERT INTO `depots` (`id`, `user_id`, `name`, `depot_id`, `short_name`, `depot_location`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sahadara', 131, 'SD', 'Delhi', '1', '2018-01-30 05:53:13', '2018-03-07 05:59:28'),
(2, 1, 'Uttam Nagar', 3443, 'Express ', 'Delhi', '1', '2018-01-30 07:09:51', '2018-03-07 06:06:53'),
(3, 1, 'Sahadara1', 13, 'mk', 'Delhi', '1', '2018-01-30 07:10:40', '2018-03-07 05:45:59'),
(4, 1, 'Sadipur Depot', 4435, 'SD.', 'Sadipur', '1', '2018-03-06 23:38:20', '2018-03-07 05:45:49'),
(5, 1, 'Safadar Jang', 3232323, 'BT', 'Safadar Jang', '7', '2018-03-07 05:39:20', '2018-03-08 01:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `depots111`
--

CREATE TABLE `depots111` (
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
-- Dumping data for table `depots111`
--

INSERT INTO `depots111` (`id`, `user_id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sahadara', 1, 'SD', 'Delhi', 'A-G-Holidays', '2018-01-30 05:53:13', '2018-01-30 05:53:13'),
(2, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 'A-G-Holidays', '2018-01-30 07:09:51', '2018-01-30 07:09:51'),
(3, 1, 'Sahadara1', 13, 'mk', 'Delhi11111111111111', 'Apple-Travels', '2018-01-30 07:10:40', '2018-02-21 23:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `depots1111`
--

CREATE TABLE `depots1111` (
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
-- Dumping data for table `depots1111`
--

INSERT INTO `depots1111` (`id`, `user_id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sahadara', 1, 'SD', 'Delhi', 'A-G-Holidays', '2018-01-30 05:53:13', '2018-01-30 05:53:13'),
(2, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 'A-G-Holidays', '2018-01-30 07:09:51', '2018-01-30 07:09:51'),
(3, 1, 'Sahadara1', 13, 'mk', 'Delhi11111111111111', 'Apple-Travels', '2018-01-30 07:10:40', '2018-02-21 23:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `depot_logs`
--

CREATE TABLE `depot_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depot_id` int(20) NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depot_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depot_logs`
--

INSERT INTO `depot_logs` (`id`, `user_id`, `name`, `depot_id`, `short_name`, `depot_location`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 2, '2018-01-30 07:09:51', '2018-03-07 11:08:47'),
(2, 1, 'Sadipur Depot', 4435, 'SD.', 'Sadipur', 3, '2018-03-06 23:38:20', '2018-03-07 11:15:49'),
(3, 1, 'Sahadara1', 13, 'mk', 'Delhi', 3, '2018-01-30 07:10:40', '2018-03-07 11:15:59'),
(4, 1, 'Sahadara', 1, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:17:30'),
(5, 1, 'Sahadara', 13, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:29:28'),
(6, 1, 'Sahadara', 131, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:29:36'),
(7, 1, 'Sahadara', 131, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:31:45'),
(8, 1, 'Uttam Nagar', 3443, 'JK', 'Delhi', 1, '2018-01-30 07:09:51', '2018-03-07 11:36:53'),
(9, 1, 'Uttam Nagar', 3443, 'Express ', 'Delhi', 1, '2018-01-30 07:09:51', '2018-03-07 11:37:19'),
(10, 1, 'Safadar Jang', 3232323, 'SJ', 'Safadar Jang', 7, '2018-03-07 05:39:20', '2018-03-08 07:23:37');

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
  `end_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `duties`
--

INSERT INTO `duties` (`id`, `user_id`, `route_id`, `duty_number`, `description`, `start_time`, `end_time`, `shift_id`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 24, '1', 'Description', '10', '20', 6, '3', '2018-02-27 06:57:29', '2018-02-27 06:57:29'),
(3, 1, 24, '2', 'Description\r\n', '10', '20', 7, '4', '2018-02-27 07:10:41', '2018-02-27 07:10:41'),
(4, 1, 24, '3', 'Description\r\n', '10', '20', 6, '1', '2018-02-28 00:15:51', '2018-02-28 00:16:03'),
(5, 1, 24, '5', 'Description', '16', '20', 5, '2', '2018-03-07 01:06:02', '2018-03-07 01:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `dutie_logs`
--

CREATE TABLE `dutie_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `duty_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dutie_logs`
--

INSERT INTO `dutie_logs` (`id`, `user_id`, `route_id`, `duty_number`, `description`, `start_time`, `end_time`, `shift_id`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', '2018-02-27 06:57:29'),
(3, 1, 24, '2', 'Description\r\n', '10', '20', 7, '2', '2018-02-27 07:10:41', '2018-02-27 07:10:41'),
(4, 1, 24, '4', 'Description\r\n', '10', '20', 6, '3', '2018-02-28 00:15:51', NULL),
(5, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', NULL),
(6, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', NULL),
(7, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', NULL),
(8, 1, 24, '1', 'Description', '10', '20', 6, '2', '2018-02-27 06:57:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ETM_details`
--

CREATE TABLE `ETM_details` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `depot_id` int(20) NOT NULL,
  `etm_no` int(20) NOT NULL,
  `evm_status_master_id` int(20) NOT NULL,
  `sim_no` int(20) NOT NULL,
  `emei_no` int(20) NOT NULL,
  `serial_no` int(20) NOT NULL,
  `make` int(20) NOT NULL,
  `warranty` date NOT NULL,
  `project_period` int(20) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ETM_details`
--

INSERT INTO `ETM_details` (`id`, `user_id`, `depot_id`, `etm_no`, `evm_status_master_id`, `sim_no`, `emei_no`, `serial_no`, `make`, `warranty`, `project_period`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. ... Easy Learning with "Show PHP" Our "Show PHP" tool makes it easy to learn PHP, it shows both the PHP source code and the HTML output of the code.', '2018-03-06 06:35:14', '2018-03-06 23:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `ETM_detail_logs`
--

CREATE TABLE `ETM_detail_logs` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `depot_id` int(20) NOT NULL,
  `etm_no` int(20) NOT NULL,
  `evm_status_master_id` int(20) NOT NULL,
  `sim_no` int(20) NOT NULL,
  `emei_no` int(20) NOT NULL,
  `serial_no` int(20) NOT NULL,
  `make` int(20) NOT NULL,
  `warranty` date NOT NULL,
  `project_period` int(20) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ETM_detail_logs`
--

INSERT INTO `ETM_detail_logs` (`id`, `user_id`, `depot_id`, `etm_no`, `evm_status_master_id`, `sim_no`, `emei_no`, `serial_no`, `make`, `warranty`, `project_period`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, '1', '2018-03-06 06:35:14', '2018-03-07 04:43:10'),
(2, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, '1', '2018-03-06 06:35:14', '2018-03-07 04:43:18'),
(3, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, '1', '2018-03-06 06:35:14', '2018-03-07 04:56:18'),
(4, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. ... Easy Learning with "Show PHP" Our "Show PHP" tool makes it easy to learn PHP, it shows both the PHP source code and the HTML output of the code.', '2018-03-06 06:35:14', '2018-03-07 10:32:21'),
(5, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. ... Easy Learning with "Show PHP" Our "Show PHP" tool makes it easy to learn PHP, it shows both the PHP source code and the HTML output of the code.', '2018-03-06 06:35:14', '2018-03-14 06:33:08');

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
-- Table structure for table `evm_status_masters`
--

CREATE TABLE `evm_status_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evm_status_masters`
--

INSERT INTO `evm_status_masters` (`id`, `name`) VALUES
(1, 'P1'),
(2, 'P2');

-- --------------------------------------------------------

--
-- Table structure for table `fares`
--

CREATE TABLE `fares` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luggage_ticket_amount` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11'),
(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `fare_details`
--

CREATE TABLE `fare_details` (
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
-- Dumping data for table `fare_details`
--

INSERT INTO `fare_details` (`id`, `user_id`, `service_id`, `stage`, `adult_ticket_amount`, `child_ticket_amount`, `luggage_ticket_amount`, `created_at`, `updated_at`) VALUES
(14, '1', 14, '1', '5.00', '5.00', '5.00', NULL, '2018-02-27 11:31:36'),
(15, '1', 14, '2', '5.00', '10.00', '10.00', NULL, '2018-02-27 11:31:36'),
(26, '1', 6, '1', '1.00', '1.00', '1.00', NULL, '2018-02-28 10:06:32'),
(27, '1', 6, '2', '5.00', '5.00', '5.00', NULL, '2018-02-28 10:06:32'),
(28, '1', 6, '3', '5.00', '5.00', '5.00', NULL, '2018-02-28 10:06:32'),
(29, '1', 6, '4', '20.00', '20.00', '20.00', NULL, '2018-02-28 10:06:32'),
(30, '1', 6, '5', '20.00', '30.00', '40.00', NULL, '2018-02-28 10:06:32'),
(31, '1', 16, '1', '10.00', '5.00', '20.00', NULL, '2018-07-12 04:53:09'),
(32, '1', 16, '2', '20.00', '10.00', '20.00', NULL, '2018-07-12 04:53:09');

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
(1, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 1, '2018-02-02 05:55:38', '2018-02-02 05:55:38'),
(2, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 4, '2018-02-02 06:01:01', '2018-02-02 06:01:01'),
(3, 1, 'Inspector Remark2', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:13', '2018-02-02 06:01:13'),
(4, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 2, '2018-02-02 06:01:25', '2018-02-02 06:01:25'),
(5, 1, 'Inspector Remark11', 'Short Remark', 'Remark Description', 5, '2018-03-05 04:59:18', '2018-03-05 04:59:18');

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
(5, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:01', NULL),
(6, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 2, '2018-02-02 05:55:38', NULL),
(7, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 1, '2018-02-02 06:01:25', NULL),
(8, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 1, '2018-02-02 06:01:25', NULL),
(9, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 1, '2018-02-02 05:55:38', NULL);

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
(7, '2015_06_06_211555_add_expire_time_column_to_notification_table', 1),
(8, '2015_06_06_211555_change_type_to_extra_in_notifications_table', 1),
(9, '2015_06_07_211555_alter_category_name_to_unique', 1),
(11, '2016_05_19_144531_add_stack_id_to_notifications', 1),
(12, '2016_07_01_153156_update_version4_notifications_table', 1),
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
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_message` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_gender` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `accept_age` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `accept_age_from` int(20) DEFAULT NULL,
  `accept_age_to` int(20) NOT NULL,
  `accept_spouse_age` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `accept_spouse_age_from` int(20) NOT NULL,
  `accept_spouse_age_to` int(20) NOT NULL,
  `accept_id_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_types`
--

INSERT INTO `pass_types` (`id`, `user_id`, `service_id`, `concession_provider_master_id`, `pass_type_master_id`, `description`, `short_description`, `amount`, `info_message`, `validity_message`, `accept_gender`, `accept_age`, `accept_age_from`, `accept_age_to`, `accept_spouse_age`, `accept_spouse_age_from`, `accept_spouse_age_to`, `accept_id_number`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 1, '2018-02-06 07:23:51', '2018-02-06 07:23:51'),
(2, 1, 1, 1, 1, 'Description', 'Short Description', 'Amount', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'No', 12, 23, 'No', 2, '2018-02-06 23:53:44', '2018-02-06 23:53:44'),
(3, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 3, '2018-02-07 04:34:06', '2018-02-07 04:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `pass_type_logs`
--

CREATE TABLE `pass_type_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `concession_provider_master_id` int(20) NOT NULL,
  `pass_type_master_id` int(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_message` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_gender` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `accept_age` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `accept_age_from` int(20) DEFAULT NULL,
  `accept_age_to` int(20) NOT NULL,
  `accept_spouse_age` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `accept_spouse_age_from` int(20) NOT NULL,
  `accept_spouse_age_to` int(20) NOT NULL,
  `accept_id_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_type_logs`
--

INSERT INTO `pass_type_logs` (`id`, `user_id`, `service_id`, `concession_provider_master_id`, `pass_type_master_id`, `description`, `short_description`, `amount`, `info_message`, `validity_message`, `accept_gender`, `accept_age`, `accept_age_from`, `accept_age_to`, `accept_spouse_age`, `accept_spouse_age_from`, `accept_spouse_age_to`, `accept_id_number`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 1, '2018-02-06 07:23:51', '2018-02-06 07:23:51'),
(2, 1, 1, 1, 1, 'Description', 'Short Description', 'Amount', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'No', 12, 23, 'No', 2, '2018-02-06 23:53:44', '2018-02-06 23:53:44'),
(3, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 3, '2018-02-07 04:34:06', '2018-02-07 04:34:06'),
(4, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 1, '2018-02-06 07:23:51', NULL);

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
(1, 1, 'Payout Reason2', 'Short Reason', 'Reason Description', 1, '2018-02-05 00:20:40', '2018-03-05 05:12:05'),
(2, 1, 'Payout Reason1', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', '2018-03-05 05:13:08'),
(3, 1, 'Payout Reason3', 'Short Reason3', 'Reason Description3', 3, '2018-02-05 00:23:30', '2018-02-05 00:25:10');

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
(2, 1, 'Payout Reason', 'Short Reason3', 'Reason Description3', 3, '2018-02-05 00:23:30', NULL),
(3, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL),
(4, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL),
(5, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL),
(6, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL),
(7, 1, 'Payout Reason3', 'Short Reason3', 'Reason Description3', 2, '2018-02-05 00:23:30', NULL),
(8, 1, 'Payout Reason', 'Short Reason', 'Reason Description', 1, '2018-02-05 00:20:40', NULL),
(9, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', NULL),
(10, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `changepasswords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bus_types` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicles` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shifts` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stops` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routes` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duties` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targets` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trips` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fares` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concession_fare_slabs` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concessions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trip_cancellation_reasons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspector_remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_reasons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denominations` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_types` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crew_details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ETM_details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `users`, `role`, `description`, `changepasswords`, `permissions`, `depots`, `bus_types`, `services`, `vehicles`, `shifts`, `stops`, `routes`, `duties`, `targets`, `trips`, `fares`, `concession_fare_slabs`, `concessions`, `trip_cancellation_reasons`, `inspector_remarks`, `payout_reasons`, `denominations`, `pass_types`, `crew_details`, `ETM_details`, `view`, `created_at`, `updated_at`) VALUES
(8, '5', 'users,create,edit,view', 'Admin', 'description', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-01-15 00:30:23', '2018-03-08 04:01:50'),
(12, '1', 'users,create,edit,view', 'Conductor', 'description', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-12 03:51:00'),
(13, '1', 'users,create,edit,view', 'Depot Master', 'description', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-15 00:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `permission_details`
--

CREATE TABLE `permission_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(20) NOT NULL,
  `users` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(20) DEFAULT NULL,
  `changepasswords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bus_types` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicles` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shifts` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stops` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routes` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duties` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targets` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trips` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fares` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concession_fare_slabs` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concessions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trip_cancellation_reasons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspector_remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_reasons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denominations` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_types` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crew_details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ETM_details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_details`
--

INSERT INTO `permission_details` (`id`, `user_id`, `created_by`, `users`, `role_id`, `changepasswords`, `permissions`, `depots`, `bus_types`, `services`, `vehicles`, `shifts`, `stops`, `routes`, `duties`, `targets`, `trips`, `fares`, `concession_fare_slabs`, `concessions`, `trip_cancellation_reasons`, `inspector_remarks`, `payout_reasons`, `denominations`, `pass_types`, `crew_details`, `ETM_details`, `view`, `created_at`, `updated_at`) VALUES
(8, '5', 1, 'users,create,edit,view', 13, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-01-15 00:30:23', '2018-03-08 04:01:50'),
(12, '2', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-13 23:53:15'),
(13, '1', 1, 'users,create,edit,view', 12, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-21 06:20:59'),
(17, '20', 1, 'users,create,edit,view', 13, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details', 'ETM_details,create,edit,view', NULL, '2018-03-13 05:06:34', '2018-03-14 05:34:18'),
(18, '21', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details', 'ETM_details,create,edit,view', NULL, '2018-03-13 23:54:39', '2018-03-13 23:56:46'),
(19, '22', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-03-14 03:36:17', '2018-03-14 03:36:17'),
(20, '23', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'crew_details', 'view', NULL, '2018-03-14 05:17:13', '2018-03-14 05:19:28'),
(21, '24', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'crew_details', 'view', NULL, '2018-03-14 05:20:16', '2018-03-14 05:31:48'),
(22, '25', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-03-14 05:53:01', '2018-03-14 05:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `changepasswords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bus_types` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicles` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shifts` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stops` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routes` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duties` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targets` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fares` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concession_fare_slabs` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concessions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trip_cancellation_reasons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspector_remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_reasons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denominations` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_types` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crew_details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ETM_details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_id`, `users`, `role`, `description`, `changepasswords`, `permissions`, `depots`, `bus_types`, `services`, `vehicles`, `shifts`, `stops`, `routes`, `duties`, `targets`, `fares`, `concession_fare_slabs`, `concessions`, `trip_cancellation_reasons`, `inspector_remarks`, `payout_reasons`, `denominations`, `pass_types`, `crew_details`, `ETM_details`, `view`, `created_at`, `updated_at`) VALUES
(8, '5', 'users,create,edit,view', '0', '', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-01-15 00:30:23', '2018-03-08 04:01:50'),
(9, '1', 'users,create,edit,view', '0', '', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-15 00:32:12', '2018-03-06 03:17:51'),
(10, '6', 'users,create,edit,view', '0', '', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reason,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominatios,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', '', NULL, '2018-01-25 04:23:40', '2018-01-25 04:23:40'),
(11, '1', 'users,create,edit,view', 'Depot Master', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-09 03:27:11', '2018-03-09 03:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `via` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_path` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `stop_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(202) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot_key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_this_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `user_id`, `route`, `source`, `destination`, `via`, `direction`, `default_path`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`, `created_at`, `updated_at`) VALUES
(24, 1, '63', '1', '3', '1', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', '2018-02-27 03:41:05'),
(25, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', '2018-02-27 03:28:02'),
(26, 1, '65', '1', '1', '1', 'Down', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 03:39:15', '2018-02-27 05:23:11'),
(27, 1, '68', '1', '3', '9', 'Up', NULL, NULL, NULL, NULL, NULL, 'No', '2018-02-28 07:18:08', '2018-02-28 07:18:08'),
(28, 1, '651', '1', '2', '2', 'Down', NULL, NULL, NULL, NULL, NULL, 'Yes', '2018-03-01 00:44:01', '2018-03-01 00:44:01'),
(29, 1, '651', '2', '3', '4', 'Up', NULL, NULL, NULL, NULL, NULL, 'Yes', '2018-03-01 00:48:59', '2018-03-01 00:48:59'),
(30, 1, '70', '1', '9', '15', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-03-07 00:51:12', '2018-03-07 01:16:40'),
(31, 1, '12345', '12', '6', '11', 'Up', 'Yes', NULL, NULL, NULL, NULL, NULL, '2018-07-10 14:30:13', '2018-07-10 14:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `route_details`
--

CREATE TABLE `route_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(20) UNSIGNED NOT NULL,
  `stop_id` int(20) NOT NULL,
  `stage_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hot_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_this_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `route_details`
--

INSERT INTO `route_details` (`id`, `route_id`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`, `created_at`, `updated_at`) VALUES
(32, 651, 5, '1', '1', '1', NULL, NULL, NULL),
(33, 25, 5, '2', '2', '2', NULL, NULL, NULL),
(39, 24, 1, '1', '1', '1', NULL, NULL, NULL),
(40, 24, 1, '2', '2', '2', NULL, NULL, NULL),
(41, 24, 2, '3', '3', '3', NULL, NULL, NULL),
(42, 24, 10, '4', '4', '4', NULL, NULL, NULL),
(43, 651, 11, '1', '1', '1', NULL, NULL, NULL),
(44, 651, 10, '1', '1', '1', NULL, NULL, NULL),
(45, 27, 1, '1', '3', '1', NULL, NULL, NULL),
(46, 27, 8, '2', '5', '2', NULL, NULL, NULL),
(47, 28, 8, '1', '1', '1', NULL, NULL, NULL),
(48, 29, 7, '1', '1', '1', NULL, NULL, NULL),
(63, 30, 13, '1', '1', '1', NULL, NULL, NULL),
(64, 30, 14, '2', '2', '2', NULL, NULL, NULL),
(65, 30, 15, '3', '3', '3', NULL, NULL, NULL),
(66, 30, 16, '4', '4', '4', NULL, NULL, NULL),
(67, 30, 17, '5', '5', '5', NULL, NULL, NULL),
(68, 30, 18, '6', '6', '6', NULL, NULL, NULL),
(69, 30, 19, '7', '7', '7', NULL, NULL, NULL),
(70, 31, 12, '1', '2', '3', 'Y', NULL, NULL),
(71, 31, 13, '2', '2', '2', 'e', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `route_logs`
--

CREATE TABLE `route_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `via` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_path` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `stop_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(202) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot_key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_this_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `route_logs`
--

INSERT INTO `route_logs` (`id`, `user_id`, `route`, `source`, `destination`, `via`, `direction`, `default_path`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`, `created_at`, `updated_at`) VALUES
(24, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', '2018-02-27 01:09:38'),
(25, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', '2018-02-27 01:53:31'),
(26, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(27, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(28, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(29, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(30, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(31, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(32, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(33, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(34, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(35, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(36, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(37, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(38, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(39, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(40, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(41, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(42, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(43, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL),
(44, 1, '63', '1', '3', '1', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(45, 1, '63', '1', '3', '1', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL),
(46, 1, '65', '1', '1', '1', 'Down', 'Yes', NULL, NULL, NULL, NULL, 'Yes', '2018-02-27 03:39:15', NULL),
(47, 1, '70', '1', '9', '15', 'Up', 'Yes', NULL, NULL, NULL, NULL, 'Yes', '2018-03-07 00:51:12', NULL),
(48, 1, '70', '1', '9', '15', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-03-07 00:51:12', NULL);

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
(1, 1, 1, 'A-G-Holidays ', 'Express ', 5, '2017-12-27 23:20:45', '2018-02-02 05:07:57'),
(6, 1, 1, 'C-G-Holidays1', 'AT', 3, '2017-12-27 23:20:45', '2018-02-21 23:26:18'),
(7, 1, 1, 'BSR-Travels', 'BT', 2, '2017-12-28 01:01:05', '2018-01-31 04:14:40'),
(14, 1, 1, 'C-G-Holidays ', 'Short Name', 4, '2018-02-21 07:05:17', '2018-02-21 07:05:17'),
(15, 1, 1, ' 	C-G-Holidays', '3', 6, '2018-02-28 06:45:45', '2018-02-28 06:45:45'),
(16, 1, 1, 'C-G-Holidays123', '1', 1, '2018-02-28 06:57:31', '2018-02-28 06:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
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
-- Dumping data for table `service_logs`
--

INSERT INTO `service_logs` (`id`, `user_id`, `bus_type_id`, `name`, `short_name`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'A-G-Holidays ', 'Express ', 2, '2017-12-27 23:20:45', '2018-02-02 05:07:57'),
(6, 1, 1, 'Aadithya-Travels ', 'AT', 5, '2017-12-27 23:20:45', '2018-02-08 00:25:20'),
(7, 1, 1, 'BSR-Travels', 'BT', 4, '2017-12-28 01:01:05', '2018-01-31 04:14:40'),
(8, 1, 2, 'Express bus service', 'EX', 3, '2018-01-04 05:49:05', '2018-01-31 04:13:15'),
(9, 1, 1, 'Delux', 'Sahadara', 6, '2018-02-01 06:26:45', '2018-02-08 00:25:43'),
(10, 1, 1, 'Sahadara1', '2323', 7, '2018-02-21 05:46:05', '2018-02-21 05:46:05'),
(11, 1, 1, 'A-G-Holidays', 'Short Name', 8, '2018-02-21 06:22:50', '2018-02-21 06:22:50'),
(12, 1, 1, 'Service Name', 'Short Name', 1, '2018-02-21 06:35:14', '2018-02-21 06:35:14'),
(13, 1, 1, 'A-G-Holidays1', 'Short Name', 9, '2018-02-21 06:53:02', '2018-02-21 06:53:02'),
(14, 1, 1, 'Aadithya-Travels ', 'AT', 4, '2017-12-27 23:20:45', NULL),
(15, 1, 1, 'C-G-Holidays ', 'Short Name', 1, '2018-02-21 07:05:17', NULL),
(16, 1, 1, 'Aadithya-Travels ', 'AT', 4, '2017-12-27 23:20:45', NULL),
(17, 1, 1, 'C-G-Holidays', 'AT', 4, '2017-12-27 23:20:45', NULL),
(18, 1, 1, 'C-G-Holidays', 'AT', 4, '2017-12-27 23:20:45', NULL),
(19, 1, 1, 'C-G-Holidays ', 'Short Name', 1, '2018-02-21 07:05:17', NULL),
(20, 1, 1, 'C-G-Holidays ', 'Short Name', 1, '2018-02-21 07:05:17', NULL),
(21, 1, 1, 'BSR-Travels', 'BT', 3, '2017-12-28 01:01:05', NULL),
(22, 1, 1, 'C-G-Holidays1', 'AT', 4, '2017-12-27 23:20:45', NULL),
(23, 1, 1, 'A-G-Holidays ', 'Express ', 3, '2017-12-27 23:20:45', NULL),
(24, 1, 1, 'C-G-Holidays ', 'Short Name', 2, '2018-02-21 07:05:17', NULL),
(25, 1, 1, 'C-G-Holidays1', 'AT', 1, '2017-12-27 23:20:45', NULL),
(26, 1, 1, 'C-G-Holidays1', 'AT', 1, '2017-12-27 23:20:45', NULL);

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
(14, 1, 'Morning', 'MN', '05:30', '12:00', '1', '123', '2018-07-02 14:47:00', '2018-07-02 14:47:00'),
(15, 1, 'After Noon', 'AN', '12:00', '04:00', '2', '1234', '2018-07-02 14:47:34', '2018-07-02 14:47:34'),
(16, 1, 'Evening', 'EN', '04:00', '08:00', '3', '12345', '2018-07-02 14:47:57', '2018-07-02 14:47:57'),
(17, 1, 'Night', 'NT', '08:00', '12:00', '4', '321', '2018-07-02 14:48:15', '2018-07-02 14:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `shift_logs`
--

CREATE TABLE `shift_logs` (
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
-- Dumping data for table `shift_logs`
--

INSERT INTO `shift_logs` (`id`, `user_id`, `shift`, `abbreviation`, `start_time`, `end_time`, `order_number`, `system_id`, `created_at`, `updated_at`) VALUES
(5, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '3', '10-11', '2018-01-04 06:09:18', '2018-02-23 05:34:44'),
(6, 1, 'Day', 'Abbreviation', '12:36 PM', '20:36 PM', '2', '10-11', '2018-01-04 06:33:13', '2018-01-05 04:04:57'),
(7, 1, 'After Noon', 'AN', '12:36 PM', '20:36 PM', '4', '10-11', '2018-01-04 07:23:47', '2018-01-04 07:23:47'),
(13, 1, 'Matiny', 'Abbreviation', '10', '20', '1', '12', '2018-02-23 05:34:32', '2018-02-23 05:34:32'),
(14, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '3', '10-11', '2018-01-04 06:09:18', NULL),
(15, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '3', '10-11', '2018-01-04 06:09:18', NULL),
(16, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '5', '10-11', '2018-01-04 06:09:18', NULL),
(17, 1, 'Day', 'Abbreviation', '12:36 PM', '20:36 PM', '2', '10-11', '2018-01-04 06:33:13', NULL),
(18, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '4', '10-11', '2018-01-04 06:09:18', NULL),
(19, 1, 'Matiny', 'Abbreviation', '10', '20', '2', '12', '2018-02-23 05:34:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shift_start`
--

CREATE TABLE `shift_start` (
  `id` int(11) NOT NULL,
  `conductor_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `duty_id` int(11) DEFAULT NULL,
  `odo_reading` varchar(20) DEFAULT NULL,
  `start_timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift_start`
--

INSERT INTO `shift_start` (`id`, `conductor_id`, `vehicle_id`, `route_id`, `shift_id`, `driver_id`, `duty_id`, `odo_reading`, `start_timestamp`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, '1212', '2018-06-17 23:39:10', '2018-06-18 06:09:38', '2018-06-18 06:09:38'),
(2, 1, 1, 1, 1, 1, 1, '1212', '2018-06-18 05:09:10', '2018-06-18 11:45:17', '2018-06-18 11:45:17'),
(3, 1, 1, 1, 1, 1, 1, '1212', '2018-06-18 05:09:10', '2018-06-18 11:47:35', '2018-06-18 11:47:35'),
(4, 88, 77, 55, 44, 66, 22, '33', '2018-06-18 05:05:05', '2018-06-18 12:28:19', '2018-06-18 12:28:19'),
(5, 88, 77, 55, 44, 66, 22, '33', '2018-06-18 10:10:10', '2018-06-18 12:34:48', '2018-06-18 12:34:48'),
(6, 88, 77, 55, 44, 66, 22, '33', '2018-06-18 10:10:10', '2018-06-18 12:37:42', '2018-06-18 12:37:42'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:36:38', '2018-06-19 05:36:38'),
(8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:36:52', '2018-06-19 05:36:52'),
(9, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:38:39', '2018-06-19 05:38:39'),
(10, 88, 77, NULL, NULL, 66, NULL, NULL, NULL, '2018-06-19 05:40:36', '2018-06-19 05:40:36'),
(11, 88, 77, 55, 44, 66, NULL, NULL, NULL, '2018-06-19 05:41:42', '2018-06-19 05:41:42'),
(12, 88, 77, 55, 44, 66, NULL, NULL, NULL, '2018-06-19 05:42:53', '2018-06-19 05:42:53'),
(13, 88, 77, 55, 44, 66, 22, '33', NULL, '2018-06-19 06:15:15', '2018-06-19 06:15:15'),
(14, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:27:50', '2018-06-19 06:27:50'),
(15, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:28:27', '2018-06-19 06:28:27'),
(16, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:41:26', '2018-06-19 06:41:26'),
(17, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:50:20', '2018-06-19 06:50:20'),
(18, 2222, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:54:50', '2018-06-19 06:54:50'),
(19, 6666, 1, 44, 55, 333333, 77, '66', NULL, '2018-06-19 07:06:47', '2018-06-19 07:06:47'),
(20, 1111, 2, 44, 55, 444444, 77, '66', NULL, '2018-06-19 07:18:23', '2018-06-19 07:18:23'),
(21, 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:20:10', '2018-06-19 08:20:10'),
(22, 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:20:33', '2018-06-19 08:20:33'),
(23, 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:20:59', '2018-06-19 08:20:59'),
(24, NULL, 77, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:26:46', '2018-06-19 08:26:46'),
(25, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 10:21:03', '2018-06-19 10:21:03'),
(26, 1, 2, 4, 1, 3, 4, '9999999990', NULL, '2018-06-19 11:08:39', '2018-06-19 11:08:39'),
(27, 1, 2, 2, 2, 3, 3, '9876543210', NULL, '2018-06-19 11:12:03', '2018-06-19 11:12:03'),
(28, 6, 7, 5, 2, 4, 4, '9988665533', NULL, '2018-06-19 16:51:00', '2018-06-19 16:51:00'),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:05:05', '2018-06-19 16:52:39', '2018-06-19 16:52:39'),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:05:00', '2018-06-19 16:54:20', '2018-06-19 16:54:20'),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 00:00:00', '2018-06-19 16:54:29', '2018-06-19 16:54:29'),
(32, 4, 5, 4, 2, 5, 4, '9876543210', NULL, '2018-06-21 17:18:21', '2018-06-21 17:18:21'),
(33, 6, 8, 4, 1, 1, 2, '9876543210', NULL, '2018-06-21 17:21:29', '2018-06-21 17:21:29'),
(34, 1, 1, 2, 1, 3, 2, '9876543210', NULL, '2018-06-21 17:27:15', '2018-06-21 17:27:15'),
(35, 1, 4, 2, 2, 4, 3, '9876543210', NULL, '2018-06-21 17:56:31', '2018-06-21 17:56:31'),
(36, 8, 1, 2, 1, 2, 3, '9876543210', NULL, '2018-06-21 18:05:49', '2018-06-21 18:05:49'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 00:00:00', '2018-06-21 18:06:52', '2018-06-21 18:06:52'),
(38, 1, 2, 4, 2, 1, 1, '9876543210', NULL, '2018-06-21 18:14:09', '2018-06-21 18:14:09'),
(39, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 10:36:06', '2018-06-22 10:36:06'),
(40, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 10:37:50', '2018-06-22 10:37:50'),
(41, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 10:39:48', '2018-06-22 10:39:48'),
(42, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 11:01:19', '2018-06-22 11:01:19'),
(43, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 11:01:52', '2018-06-22 11:01:52'),
(44, 3, 4, 3, 1, 4, 4, '9876543210', NULL, '2018-06-22 11:03:47', '2018-06-22 11:03:47'),
(45, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:14:29', '2018-06-22 16:14:29'),
(46, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:15:05', '2018-06-22 16:15:05'),
(47, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:18:06', '2018-06-22 16:18:06'),
(48, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:19:06', '2018-06-22 16:19:06'),
(49, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-25 12:06:47', '2018-06-25 12:06:47'),
(50, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-25 12:07:17', '2018-06-25 12:07:17'),
(51, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-26 12:22:03', '2018-06-26 12:22:03'),
(52, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-26 17:51:02', '2018-06-26 17:51:02'),
(53, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-27 12:36:48', '2018-06-27 12:36:48'),
(54, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-28 11:45:32', '2018-06-28 11:45:32'),
(55, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-28 11:46:57', '2018-06-28 11:46:57'),
(56, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-28 11:48:55', '2018-06-28 11:48:55'),
(57, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-06-28 11:50:39', '2018-06-28 11:50:39'),
(58, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-06-29 13:08:39', '2018-06-29 13:08:39'),
(59, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 14:15:41', '2018-07-02 14:15:41'),
(60, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:01:51', '2018-07-02 15:01:51'),
(61, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:20:01', '2018-07-02 15:20:01'),
(62, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:22:39', '2018-07-02 15:22:39'),
(63, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:25:00', '2018-07-02 15:25:00'),
(64, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:27:29', '2018-07-02 15:27:29'),
(65, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:32:39', '2018-07-02 15:32:39'),
(66, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:32:46', '2018-07-02 15:32:46'),
(67, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:32:51', '2018-07-02 15:32:51'),
(68, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:33:28', '2018-07-02 15:33:28'),
(69, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:34:26', '2018-07-02 15:34:26'),
(70, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:44:50', '2018-07-02 15:44:50'),
(71, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:46:06', '2018-07-02 15:46:06'),
(72, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:47:33', '2018-07-02 15:47:33'),
(73, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:48:48', '2018-07-02 15:48:48'),
(74, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:58:30', '2018-07-02 15:58:30'),
(75, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 16:03:26', '2018-07-02 16:03:26'),
(76, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 16:05:40', '2018-07-02 16:05:40'),
(77, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 11:30:13', '2018-07-03 11:30:13'),
(78, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 11:36:00', '2018-07-03 11:36:00'),
(79, 5, 12, 26, 13, 6, 1, '9876543210', NULL, '2018-07-03 11:46:48', '2018-07-03 11:46:48'),
(80, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:10:00', '2018-07-03 12:10:00'),
(81, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:12:12', '2018-07-03 12:12:12'),
(82, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:13:11', '2018-07-03 12:13:11'),
(83, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:59:32', '2018-07-03 12:59:32'),
(84, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:27', '2018-07-03 13:13:27'),
(85, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:34', '2018-07-03 13:13:34'),
(86, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:40', '2018-07-03 13:13:40'),
(87, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:52', '2018-07-03 13:13:52'),
(88, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:59', '2018-07-03 13:13:59'),
(89, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:58:30', '2018-07-03 13:58:30'),
(90, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 14:04:05', '2018-07-03 14:04:05'),
(91, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 14:29:05', '2018-07-03 14:29:05'),
(92, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 15:27:24', '2018-07-03 15:27:24'),
(93, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 16:46:51', '2018-07-03 16:46:51'),
(94, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 16:47:04', '2018-07-03 16:47:04'),
(95, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 16:48:13', '2018-07-03 16:48:13'),
(96, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:43:55', '2018-07-03 17:43:55'),
(97, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:51:36', '2018-07-03 17:51:36'),
(98, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:56:10', '2018-07-03 17:56:10'),
(99, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:57:12', '2018-07-03 17:57:12'),
(100, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:58:08', '2018-07-03 17:58:08'),
(101, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:59:35', '2018-07-03 17:59:35'),
(102, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:28:46', '2018-07-04 10:28:46'),
(103, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:29:59', '2018-07-04 10:29:59'),
(104, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:31:29', '2018-07-04 10:31:29'),
(105, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:34:20', '2018-07-04 10:34:20'),
(106, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:35:46', '2018-07-04 10:35:46'),
(107, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:37:01', '2018-07-04 10:37:01'),
(108, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:38:01', '2018-07-04 10:38:01'),
(109, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:39:27', '2018-07-04 10:39:27'),
(110, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:41:54', '2018-07-04 10:41:54'),
(111, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:43:03', '2018-07-04 10:43:03'),
(112, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:44:23', '2018-07-04 10:44:23'),
(113, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:45:30', '2018-07-04 10:45:30'),
(114, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:46:24', '2018-07-04 10:46:24'),
(115, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:47:25', '2018-07-04 10:47:25'),
(116, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:49:30', '2018-07-04 10:49:30'),
(117, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 11:04:14', '2018-07-04 11:04:14'),
(118, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 11:07:47', '2018-07-04 11:07:47'),
(119, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 11:54:28', '2018-07-04 11:54:28'),
(120, 5, 12, 26, 6, 6, 1, '9090909090', NULL, '2018-07-05 16:22:18', '2018-07-05 16:22:18'),
(121, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-05 17:56:03', '2018-07-05 17:56:03'),
(122, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:22:26', '2018-07-06 10:22:26'),
(123, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:39:44', '2018-07-06 10:39:44'),
(124, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:46:13', '2018-07-06 10:46:13'),
(125, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:50:26', '2018-07-06 10:50:26'),
(126, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:54:59', '2018-07-06 10:54:59'),
(127, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:03:21', '2018-07-06 11:03:21'),
(128, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:12:12', '2018-07-06 11:12:12'),
(129, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:15:54', '2018-07-06 11:15:54'),
(130, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:19:11', '2018-07-06 11:19:11'),
(131, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:26:16', '2018-07-06 11:26:16'),
(132, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:59:58', '2018-07-06 11:59:58'),
(133, 5, 12, 28, 6, 6, 5, '9876543217', '2018-07-11 11:36:09', '2018-07-11 11:36:14', '2018-07-11 11:36:14'),
(134, 5, 12, 28, 6, 6, 4, '9898989898', '2018-07-11 11:38:15', '2018-07-11 11:38:23', '2018-07-11 11:38:23'),
(135, 5, 12, 28, 6, 6, 5, '9876543210', '2018-07-11 11:42:13', '2018-07-11 11:42:15', '2018-07-11 11:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `sqlite_db_name`
--

CREATE TABLE `sqlite_db_name` (
  `id` int(11) NOT NULL,
  `name` varchar(264) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sqlite_db_name`
--

INSERT INTO `sqlite_db_name` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'data.sqlite', '2018-07-04 06:01:11', '2018-07-05 08:46:22');

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
(1, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', '2018-02-26 04:40:10'),
(2, 1, 'Dabari', '123', 'AN', 'AN', '2018-01-02 06:56:25', '2018-03-07 00:26:12'),
(3, 1, 'Nehru Palace', '2', 'NP', 'NP', '2018-01-02 23:40:02', '2018-02-26 04:40:17'),
(4, 1, 'Munirka', '6', 'Munirka', 'Munirka', '2018-01-04 06:37:33', '2018-02-26 04:42:14'),
(5, 1, 'Tilak Pull', '17', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', '2018-03-07 00:25:57'),
(6, 1, 'South Ex', '8', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', '2018-03-07 00:26:35'),
(7, 1, 'Badar pur Border', '15', 'Abbreviation', 'MH', '2018-01-05 04:05:14', '2018-03-07 00:25:18'),
(8, 1, 'Sadar Bazaar', '10', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', '2018-03-07 00:23:01'),
(9, 1, 'Rajendra Place', '12', 'AN', 'AN', '2018-01-08 06:17:05', '2018-03-07 00:23:17'),
(10, 1, 'Moti Bag', '11', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', '2018-03-07 00:23:09'),
(11, 1, 'Safdar jang', '3', 'KB', 'KB', '2018-01-30 05:56:48', '2018-03-07 00:24:47'),
(12, 1, 'AIIMs', '5', 'BV', 'BV', '2018-02-25 23:06:43', '2018-03-07 00:25:08'),
(13, 1, 'Dhuali Pyau', '18', 'DP', 'DP', '2018-03-07 00:28:19', '2018-03-07 00:28:19'),
(14, 1, 'Distic Center', '21', 'DC', 'DC', '2018-03-07 00:29:53', '2018-03-07 00:29:53'),
(15, 1, 'Tikal Nagar', '22', 'T N', 'T N', '2018-03-07 00:30:47', '2018-03-07 00:30:47'),
(16, 1, 'Subhash Nagar', '23', 'SN', 'SN', '2018-03-07 00:31:19', '2018-03-07 00:31:19'),
(17, 1, 'Tagor Garden', '24', 'T G', 'T G', '2018-03-07 00:32:27', '2018-03-07 00:32:27'),
(18, 1, 'Rajauri Garden', '25', 'R G', 'R G', '2018-03-07 00:33:08', '2018-03-07 00:33:08'),
(19, 1, 'Moti Nagar', '26', 'M N', 'M N', '2018-03-07 00:34:58', '2018-03-07 00:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `stop_logs`
--

CREATE TABLE `stop_logs` (
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
-- Dumping data for table `stop_logs`
--

INSERT INTO `stop_logs` (`id`, `user_id`, `stop`, `stop_id`, `abbreviation`, `short_name`, `created_at`, `updated_at`) VALUES
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
(11, 1, 'kAROL BAG', '123', 'K', 'JK', '2018-01-30 05:56:48', '2018-01-30 05:56:48'),
(12, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', NULL),
(13, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', NULL),
(14, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', NULL),
(15, 1, 'Uttm Nagar', '3232', 'UG', 'UG', '2018-01-02 06:53:52', NULL),
(16, 1, 'JANAK PURI WEST', '43123', 'JANAK PURI', 'JK', '2018-01-02 23:40:02', NULL),
(17, 1, 'DHAULA KUAN1', '32321', 'Abbreviation', 'Short Name', '2018-02-25 23:06:43', NULL),
(18, 1, 'Uttm Nagar', '3232', 'UN', 'UN', '2018-01-02 06:53:52', NULL),
(19, 1, 'Nehru Palace', '43123', 'NP', 'NP', '2018-01-02 23:40:02', NULL),
(20, 1, 'kAROL BAG', '123', 'K', 'JK', '2018-01-30 05:56:48', NULL),
(21, 1, 'DHAULA KUAN1', '32321', 'Abbreviation', 'Short Name', '2018-02-25 23:06:43', NULL),
(22, 1, 'DHAULA KUAN1', '32321', 'Abbreviation', 'Short Name', '2018-02-25 23:06:43', NULL),
(23, 1, 'DHAULA KUAN', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:37:33', NULL),
(24, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(25, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(26, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(27, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(28, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(29, 1, 'Munirka', '6', 'Munirka', 'Munirka', '2018-01-04 06:37:33', NULL),
(30, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', NULL),
(31, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', NULL),
(32, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(33, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(34, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(35, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(36, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(37, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(38, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(39, 1, 'Munirka', '6', 'Munirka', 'Munirka', '2018-01-04 06:37:33', NULL),
(40, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(41, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', NULL),
(42, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(43, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(44, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', NULL),
(45, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', NULL),
(46, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', NULL),
(47, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL),
(48, 1, 'Moti Bag', '432434323', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL),
(49, 1, 'Rajendra Place', '1324', 'AN', 'AN', '2018-01-08 06:17:05', NULL),
(50, 1, 'ANAND VIHAR', '123', 'AN', 'AN', '2018-01-02 06:56:25', NULL),
(51, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'MH', '2018-01-05 04:05:14', NULL),
(52, 1, 'Karol Bag', '3', 'KB', 'KB', '2018-01-30 05:56:48', NULL),
(53, 1, 'Basant Vihar', '5', 'BV', 'BV', '2018-02-25 23:06:43', NULL),
(54, 1, 'Badar pur Border', '4324343', 'Abbreviation', 'MH', '2018-01-05 04:05:14', NULL),
(55, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', NULL),
(56, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', NULL),
(57, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', NULL),
(58, 1, 'ANAND VIHAR', '123', 'AN', 'AN', '2018-01-02 06:56:25', NULL),
(59, 1, 'Subhash Nagar', '8', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', NULL),
(60, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', NULL);

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
(1, 1, 24, 3, 6, '6', '1200', '1200', '', '', '', '2018-02-28 03:34:05', '2018-02-28 03:34:47'),
(2, 1, 24, 3, 6, '23', '2322', '3', '', '', '', '2018-02-28 03:59:25', '2018-02-28 03:59:25'),
(3, 1, 24, 3, 6, 'qw', 'wq', 'qw', '', '', '', '2018-02-28 04:00:17', '2018-02-28 04:00:17'),
(4, 1, 24, 4, 6, 'wew', 'we', 'wee', 'we', '', '', '2018-02-28 04:02:46', '2018-02-28 04:08:18'),
(5, 1, 24, 1, 6, '1', '2', '221', '21', '2121', '21', '2018-02-28 05:04:54', '2018-02-28 05:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `target_logs`
--

CREATE TABLE `target_logs` (
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
-- Dumping data for table `target_logs`
--

INSERT INTO `target_logs` (`id`, `user_id`, `route_id`, `duty_id`, `shift_id`, `trip`, `epkm`, `income`, `incentive`, `driver_share`, `conductor_share`, `created_at`, `updated_at`) VALUES
(1, 1, 24, 3, 6, '6', '1200', '1200', '', '', '', '2018-02-28 03:34:05', '2018-02-28 03:34:47'),
(2, 1, 24, 1, 6, 'wew', 'we', 'wee', 'we', '', '', '2018-02-28 04:02:46', NULL),
(3, 1, 24, 4, 6, 'wew', 'we', 'wee', 'we', '', '', '2018-02-28 04:02:46', NULL),
(4, 1, 24, 1, 6, '1', '2', '221', '21', '2121', '21', '2018-02-28 05:04:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route_id` int(20) NOT NULL,
  `duty_id` int(20) NOT NULL,
  `shift_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `user_id`, `route_id`, `duty_id`, `shift_id`, `created_at`, `updated_at`) VALUES
(21, 1, 24, 1, 5, '2018-03-20 06:31:38', '2018-03-20 06:31:38'),
(22, 1, 25, 1, 5, '2018-03-20 06:45:17', '2018-03-21 06:21:19'),
(23, 1, 24, 5, 5, '2018-03-21 06:22:01', '2018-03-21 06:22:01');

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
(1, 1, '1', 'Short Reason', 'Reason Description', 5, '2018-02-02 01:54:46', '2018-02-02 01:54:46'),
(2, 1, '2', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:21', '2018-02-02 03:41:21'),
(3, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 03:41:32', '2018-02-02 03:41:32'),
(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13'),
(5, 1, '4', 'Short Reason', '1', 1, '2018-03-05 04:28:58', '2018-03-05 04:28:58');

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
(6, 1, '3', 'Short Reason1', 'Reason Description1', 2, '2018-02-02 03:48:13', NULL),
(7, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trip_details`
--

CREATE TABLE `trip_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `trip_id` int(20) NOT NULL,
  `trip_no` int(20) NOT NULL,
  `start_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_route_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deviated_route` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deviated_path` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_details`
--

INSERT INTO `trip_details` (`id`, `trip_id`, `trip_no`, `start_time`, `path_route_id`, `deviated_route`, `deviated_path`, `created_at`, `updated_at`) VALUES
(62, 21, 1, '12:00PM', '24', '24', '24', NULL, NULL),
(63, 21, 2, '12:00PM', '25', '25', '25', NULL, NULL),
(70, 22, 1, '12:00PM', '24', '25', '24', NULL, NULL),
(71, 22, 2, '06:32PM', '24', '24', '24', NULL, NULL),
(72, 22, 3, '06:32PM', '24', '24', '24', NULL, NULL),
(75, 23, 1, '12:00PM', '24', '24', '24', NULL, NULL),
(76, 23, 2, '06:30PM', '24', '25', '25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trip_logs`
--

CREATE TABLE `trip_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `route_id` int(20) NOT NULL,
  `duty_id` int(20) NOT NULL,
  `shift_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_logs`
--

INSERT INTO `trip_logs` (`id`, `user_id`, `route_id`, `duty_id`, `shift_id`, `created_at`, `updated_at`) VALUES
(25, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(26, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(27, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(28, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(29, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(30, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(31, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(32, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(33, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL),
(34, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL),
(35, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL),
(36, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL),
(37, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL),
(38, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL),
(39, 1, 24, 5, 5, '2018-03-21 06:22:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trip_start`
--

CREATE TABLE `trip_start` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `direction` varchar(64) DEFAULT NULL,
  `start_stop_id` int(11) DEFAULT NULL,
  `end_stop_id` int(11) DEFAULT NULL,
  `start_timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_start`
--

INSERT INTO `trip_start` (`id`, `service_id`, `route_id`, `direction`, `start_stop_id`, `end_stop_id`, `start_timestamp`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-09 06:52:20', '2018-07-09 06:52:20'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-09 12:25:04', '2018-07-09 12:25:04'),
(3, NULL, NULL, NULL, 5, NULL, NULL, '2018-07-09 12:28:03', '2018-07-09 12:28:03'),
(4, 1, 2, 'Up', 5, 6, '2018-07-09 12:28:00', '2018-07-09 12:42:47', '2018-07-09 12:42:47'),
(5, 11, 12, '13', 14, 15, '2018-07-09 12:28:00', '2018-07-09 12:49:46', '2018-07-09 12:49:46'),
(6, 7, 28, 'Up', 12, 8, '2018-07-10 17:10:12', '2018-07-10 17:10:17', '2018-07-10 17:10:17'),
(7, 7, 28, 'Down', 12, 8, '2018-07-10 18:12:55', '2018-07-10 18:12:57', '2018-07-10 18:12:57'),
(8, 7, 28, 'Up', 12, 8, '2018-07-11 10:56:27', '2018-07-11 10:56:27', '2018-07-11 10:56:27'),
(9, 7, 28, 'Down', 12, 8, '2018-07-11 11:12:48', '2018-07-11 11:12:52', '2018-07-11 11:12:52'),
(10, 7, 28, 'Down', 12, 8, '2018-07-11 11:18:22', '2018-07-11 11:18:28', '2018-07-11 11:18:28'),
(11, 7, 28, 'Up', 12, 8, '2018-07-11 11:27:18', '2018-07-11 11:27:20', '2018-07-11 11:27:20'),
(12, 7, 28, 'Up', 12, 8, '2018-07-11 11:32:54', '2018-07-11 11:32:59', '2018-07-11 11:32:59'),
(13, 7, 28, 'Up', 12, 8, '2018-07-11 11:44:09', '2018-07-11 11:44:13', '2018-07-11 11:44:13'),
(14, 7, 28, 'Up', 12, 8, '2018-07-11 11:44:17', '2018-07-11 11:44:19', '2018-07-11 11:44:19'),
(15, 6, 28, 'Down', 12, 8, '2018-07-11 13:45:50', '2018-07-11 13:45:55', '2018-07-11 13:45:55'),
(16, 6, 28, 'Down', 12, 8, '2018-07-11 15:33:50', '2018-07-11 15:33:54', '2018-07-11 15:33:54'),
(17, 6, 28, 'Down', 12, 8, '2018-07-11 15:36:21', '2018-07-11 15:36:26', '2018-07-11 15:36:26'),
(18, 6, 28, 'Down', 12, 8, '2018-07-11 15:40:30', '2018-07-11 15:40:34', '2018-07-11 15:40:34'),
(19, 6, 28, 'Down', 12, 8, '2018-07-11 15:58:19', '2018-07-11 15:58:21', '2018-07-11 15:58:21'),
(20, 6, 28, 'Down', 12, 8, '2018-07-11 16:02:54', '2018-07-11 16:02:58', '2018-07-11 16:02:58'),
(21, 6, 28, 'Down', 12, 8, '2018-07-11 16:03:58', '2018-07-11 16:04:02', '2018-07-11 16:04:02'),
(22, 7, 28, 'Down', 12, 8, '2018-07-11 16:10:58', '2018-07-11 16:11:02', '2018-07-11 16:11:02'),
(23, 6, 28, 'Down', 12, 8, '2018-07-11 16:17:13', '2018-07-11 16:17:19', '2018-07-11 16:17:19'),
(24, 6, 28, 'Down', 12, 8, '2018-07-11 16:22:58', '2018-07-11 16:23:01', '2018-07-11 16:23:01'),
(25, 6, 28, 'Down', 12, 8, '2018-07-11 16:26:19', '2018-07-11 16:26:23', '2018-07-11 16:26:23'),
(26, 6, 28, 'Down', 12, 8, '2018-07-11 16:44:24', '2018-07-11 16:44:26', '2018-07-11 16:44:26'),
(27, 6, 28, 'Down', 12, 8, '2018-07-11 16:46:45', '2018-07-11 16:46:49', '2018-07-11 16:46:49'),
(28, 6, 28, 'Down', 12, 8, '2018-07-11 16:51:22', '2018-07-11 16:51:24', '2018-07-11 16:51:24'),
(29, 6, 28, 'Down', 12, 8, '2018-07-11 16:55:46', '2018-07-11 16:55:50', '2018-07-11 16:55:50'),
(30, 6, 28, 'Down', 12, 8, '2018-07-11 16:57:42', '2018-07-11 16:57:44', '2018-07-11 16:57:44'),
(31, 6, 28, 'Down', 12, 8, '2018-07-11 17:49:27', '2018-07-11 17:49:31', '2018-07-11 17:49:31'),
(32, 6, 28, 'Down', 12, 8, '2018-07-11 17:52:25', '2018-07-11 17:52:30', '2018-07-11 17:52:30'),
(33, 6, 28, 'Down', 12, 8, '2018-07-11 17:56:31', '2018-07-11 17:56:36', '2018-07-11 17:56:36'),
(34, 6, 28, 'Down', 12, 8, '2018-07-11 17:59:10', '2018-07-11 17:59:14', '2018-07-11 17:59:14'),
(35, 6, 28, 'Down', 12, 8, '2018-07-11 18:04:40', '2018-07-11 18:04:42', '2018-07-11 18:04:42'),
(36, 6, 28, 'Down', 12, 8, '2018-07-11 18:11:58', '2018-07-11 18:12:03', '2018-07-11 18:12:03'),
(37, 6, 28, 'Down', 12, 8, '2018-07-11 18:14:31', '2018-07-11 18:14:34', '2018-07-11 18:14:34'),
(38, 6, 28, 'Down', 12, 8, '2018-07-11 18:17:38', '2018-07-11 18:17:41', '2018-07-11 18:17:41'),
(39, 6, 28, 'Down', 12, 8, '2018-07-11 18:19:02', '2018-07-11 18:19:07', '2018-07-11 18:19:07'),
(40, 6, 28, 'Down', 12, 8, '2018-07-11 18:21:45', '2018-07-11 18:21:50', '2018-07-11 18:21:50'),
(41, 6, 28, 'Down', 12, 8, '2018-07-11 18:27:15', '2018-07-11 18:27:17', '2018-07-11 18:27:17'),
(42, 6, 28, 'Down', 12, 8, '2018-07-11 18:32:28', '2018-07-11 18:32:32', '2018-07-11 18:32:32'),
(43, 6, 28, 'Down', 12, 8, '2018-07-12 10:10:49', '2018-07-12 10:10:51', '2018-07-12 10:10:51'),
(44, 16, 28, 'Down', 12, 8, '2018-07-12 10:43:52', '2018-07-12 10:43:54', '2018-07-12 10:43:54'),
(45, 16, 28, 'Down', 12, 8, '2018-07-12 10:46:03', '2018-07-12 10:46:05', '2018-07-12 10:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(1, 'Satya', 'satya', 'admin@opiant.online', 'Address', '1', 'City', '$2y$10$Fx77v1au5kCgl/bjynQEC.O8BV9wDdMwB1AXLTxtjk3.p8y7ZzVGe', '3453425454', '2017-12-01', 0x576259656a6d49465f53637265656e73686f742066726f6d20323031372d30342d30362031332d31322d35312e706e67, NULL, '2MmYxZHD7Wb7qfn9F6g3AfgzajlIDSWSOgLFxS1oeX1l1AkgBJYP9PjtSGyz', 0, NULL, '2018-03-14 06:32:17'),
(2, 'Ravi', 'Ravi Kumar', 'admin1@opiant.online', 'Address', '99', 'City', '$2y$10$qAF5KR29F8/q2.6J0/9aoOOJ9AZ0GXBM7z2ehcE9RWKQHmNmq4ftO', '3453425454', '2017-12-02', 0x566d7a584d4864475f53637265656e73686f742066726f6d20323031372d30342d32362031352d32352d30302e706e67, NULL, '', 0, NULL, '2018-03-07 03:48:31'),
(5, 'Subhash Prajapati', 'Subhash Prajapati', 'admin3@opiant.online', 'Address', '167', 'City', '$2y$10$qAF5KR29F8/q2.6J0/9aoOOJ9AZ0GXBM7z2ehcE9RWKQHmNmq4ftO', '3441454552', '2018-01-03', 0x4d3873466958396a5f6461696c795f75695f3030325f5f5f6c6f67696e5f706167655f62795f736b7970757269666965722d643968757767772e706e67, 'Y7noP4OlbZH1JyE7wzl764Mc6E9KQidjy8BGE73V', 'Qf8gApi5lFXqmXQh3EKFlasLNQhSVu9X5mwo3rtY9g43h23IVRKfC2hsERlt', 0, '2018-01-04 05:17:37', '2018-03-07 03:48:34'),
(20, 'Ravishanker2232323', 'Ravishanker', 'satya2000chauhan@gmail.com', 'H.N 5 Hastsal1', '80', 'Delhi1', NULL, '3243243421', '2018-03-01', 0x684d44656271434c5f6461696c795f75695f3030325f5f5f6c6f67696e5f706167655f62795f736b7970757269666965722d643968757767772e706e67, 'JlmxzEmvitvINgrQrDv5Dlrwu13zRDEQPcKhC1ao', 'R3SdfL2qIQWDgPjs5n42UYSACzT9SxXHhR7dtGyE', 0, '2018-03-13 05:06:33', '2018-03-13 06:52:17'),
(21, 'Hari Prasad', 'Hariprasad', 'satya2000chauhan@gmail.com', 'H.N 5 Hastsal', '1', 'Delhi', NULL, '3243243423', '2018-03-07', NULL, 'hDKlRdf2I05s0432zislCUkpQN2AF5fDI0k5BuP1', 'iqhI158Msxw3Er7Fb2WFfQ6YdT8Qzf82rkObwx9Z', 0, '2018-03-13 23:54:39', '2018-03-13 23:54:39');

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
(14, 1, 2, 'DL01AB0001', 1, '2018-07-02 14:49:17', '2018-07-02 14:49:17'),
(15, 1, 1, 'DL01AB0002', 2, '2018-07-02 14:49:26', '2018-07-02 14:49:26'),
(16, 1, 4, 'DL01AB0003', 4, '2018-07-02 14:49:36', '2018-07-02 14:49:36'),
(17, 1, 2, 'DL01AB0004', 6, '2018-07-02 14:49:45', '2018-07-02 14:49:45'),
(18, 1, 1, 'DL01AB0005', 5, '2018-07-02 14:49:53', '2018-07-02 14:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_logs`
--

CREATE TABLE `vehicle_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `depot_id` int(20) NOT NULL,
  `vehicle_registration_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_type_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_logs`
--

INSERT INTO `vehicle_logs` (`id`, `user_id`, `depot_id`, `vehicle_registration_number`, `bus_type_id`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', '2018-02-22 01:13:10'),
(13, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', '2018-02-22 01:13:40'),
(14, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL),
(15, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL),
(16, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL),
(17, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL),
(18, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL),
(19, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL),
(20, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL),
(21, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL),
(22, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL),
(23, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL),
(24, 1, 1, 'DL-121', 1, '2018-02-22 01:13:10', NULL),
(25, 1, 1, 'DL-121', 1, '2018-02-22 01:13:10', NULL),
(26, 1, 1, 'DL-121', 1, '2018-02-22 01:13:10', NULL),
(27, 1, 1, 'DL-12112', 1, '2018-02-22 01:13:10', NULL),
(28, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_types`
--
ALTER TABLE `bus_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_type_logs`
--
ALTER TABLE `bus_type_logs`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crew_detail_logs`
--
ALTER TABLE `crew_detail_logs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `depots111`
--
ALTER TABLE `depots111`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depots1111`
--
ALTER TABLE `depots1111`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depot_logs`
--
ALTER TABLE `depot_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duties`
--
ALTER TABLE `duties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `duties_route_id_foreign` (`route_id`),
  ADD KEY `duties_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `dutie_logs`
--
ALTER TABLE `dutie_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `duties_route_id_foreign` (`route_id`),
  ADD KEY `duties_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `ETM_details`
--
ALTER TABLE `ETM_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ETM_detail_logs`
--
ALTER TABLE `ETM_detail_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etm_hot_key_masters`
--
ALTER TABLE `etm_hot_key_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evm_status_masters`
--
ALTER TABLE `evm_status_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_types_service_id_foreign` (`name`(191));

--
-- Indexes for table `fares`
--
ALTER TABLE `fares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fares_service_id_foreign` (`service_id`);

--
-- Indexes for table `fare_details`
--
ALTER TABLE `fare_details`
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
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `pass_types`
--
ALTER TABLE `pass_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_types_service_id_foreign` (`service_id`);

--
-- Indexes for table `pass_type_logs`
--
ALTER TABLE `pass_type_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_types_service_id_foreign` (`service_id`);

--
-- Indexes for table `pass_type_masters`
--
ALTER TABLE `pass_type_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_types_service_id_foreign` (`name`(191));

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_details`
--
ALTER TABLE `permission_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_details`
--
ALTER TABLE `route_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routes_stop_id_foreign` (`route_id`);

--
-- Indexes for table `route_logs`
--
ALTER TABLE `route_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
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
-- Indexes for table `shift_logs`
--
ALTER TABLE `shift_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_start`
--
ALTER TABLE `shift_start`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sqlite_db_name`
--
ALTER TABLE `sqlite_db_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stop_logs`
--
ALTER TABLE `stop_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targets_route_id_foreign` (`route_id`);

--
-- Indexes for table `target_logs`
--
ALTER TABLE `target_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targets_route_id_foreign` (`route_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `trip_details`
--
ALTER TABLE `trip_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_logs`
--
ALTER TABLE `trip_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_start`
--
ALTER TABLE `trip_start`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_logs`
--
ALTER TABLE `vehicle_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_types`
--
ALTER TABLE `bus_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bus_type_logs`
--
ALTER TABLE `bus_type_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `concessions`
--
ALTER TABLE `concessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `concession_fare_slabs`
--
ALTER TABLE `concession_fare_slabs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `concession_fare_slab_logs`
--
ALTER TABLE `concession_fare_slab_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `concession_logs`
--
ALTER TABLE `concession_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `crew_detail_logs`
--
ALTER TABLE `crew_detail_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `denominations`
--
ALTER TABLE `denominations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `denomination_logs`
--
ALTER TABLE `denomination_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `denomination_masters`
--
ALTER TABLE `denomination_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `depots`
--
ALTER TABLE `depots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `depots111`
--
ALTER TABLE `depots111`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `depots1111`
--
ALTER TABLE `depots1111`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `depot_logs`
--
ALTER TABLE `depot_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `duties`
--
ALTER TABLE `duties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dutie_logs`
--
ALTER TABLE `dutie_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ETM_details`
--
ALTER TABLE `ETM_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ETM_detail_logs`
--
ALTER TABLE `ETM_detail_logs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `etm_hot_key_masters`
--
ALTER TABLE `etm_hot_key_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `evm_status_masters`
--
ALTER TABLE `evm_status_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fares`
--
ALTER TABLE `fares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fare_details`
--
ALTER TABLE `fare_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `inspector_remarks`
--
ALTER TABLE `inspector_remarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `inspector_remark_logs`
--
ALTER TABLE `inspector_remark_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `pass_types`
--
ALTER TABLE `pass_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pass_type_logs`
--
ALTER TABLE `pass_type_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `permission_details`
--
ALTER TABLE `permission_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `route_details`
--
ALTER TABLE `route_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `route_logs`
--
ALTER TABLE `route_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `shift_logs`
--
ALTER TABLE `shift_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `shift_start`
--
ALTER TABLE `shift_start`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `sqlite_db_name`
--
ALTER TABLE `sqlite_db_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stops`
--
ALTER TABLE `stops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `stop_logs`
--
ALTER TABLE `stop_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `target_logs`
--
ALTER TABLE `target_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `trip_cancellation_reasons`
--
ALTER TABLE `trip_cancellation_reasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `trip_cancellation_reason_category_masters`
--
ALTER TABLE `trip_cancellation_reason_category_masters`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trip_cancellation_reason_logs`
--
ALTER TABLE `trip_cancellation_reason_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `trip_details`
--
ALTER TABLE `trip_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `trip_logs`
--
ALTER TABLE `trip_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `trip_start`
--
ALTER TABLE `trip_start`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `vehicle_logs`
--
ALTER TABLE `vehicle_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `concession_fare_slabs`
--
ALTER TABLE `concession_fare_slabs`
  ADD CONSTRAINT `concession_fare_slabs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

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
-- Constraints for table `targets`
--
ALTER TABLE `targets`
  ADD CONSTRAINT `targets_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
