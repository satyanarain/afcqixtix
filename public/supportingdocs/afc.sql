CREATE TABLE "bus_types" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "bus_type" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abbreviation" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" varchar(12000) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "bus_types" VALUES(1, 1, 'AC12', 'AC', '2', '2017-12-27 02:54:59', '2018-02-21 05:42:42');
INSERT INTO "bus_types" VALUES(2, 1, 'NON AC', 'NON', '6', '2017-12-27 02:56:04', '2018-01-08 01:28:45');
INSERT INTO "bus_types" VALUES(3, 1, 'Luxury', 'LU1', '4', '2018-01-19 01:17:27', '2018-02-22 00:51:10');
INSERT INTO "bus_types" VALUES(4, 1, 'Sleeper Bus', 'S.P', '3', '2018-01-29 00:56:16', '2018-01-29 00:56:16');
INSERT INTO "bus_types" VALUES(5, 1, 'Delux', 'N. AC', '1', '2018-02-01 06:20:35', '2018-02-01 06:20:51');
INSERT INTO "bus_types" VALUES(6, 1, 'AC', 'Abbreviation', '5', '2018-02-21 05:30:09', '2018-02-21 05:30:23');

CREATE TABLE "bus_type_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "bus_type" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abbreviation" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" varchar(12000) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "bus_type_logs" VALUES(1, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', '2017-12-27 04:03:17');
INSERT INTO "bus_type_logs" VALUES(2, 1, 'NON AC', 'NON', '5', '2017-12-27 02:56:04', '2018-01-08 01:28:45');
INSERT INTO "bus_type_logs" VALUES(3, 1, 'Luxury', 'LU', '3', '2018-01-19 01:17:27', '2018-01-19 01:17:27');
INSERT INTO "bus_type_logs" VALUES(4, 1, 'Sleeper Bus', 'S.P', '2', '2018-01-29 00:56:16', '2018-01-29 00:56:16');
INSERT INTO "bus_type_logs" VALUES(5, 1, 'Delux', 'N. AC', '6', '2018-02-01 06:20:35', '2018-02-01 06:20:51');
INSERT INTO "bus_type_logs" VALUES(6, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', '2018-02-21 05:30:23');
INSERT INTO "bus_type_logs" VALUES(7, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', NULL);
INSERT INTO "bus_type_logs" VALUES(8, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', NULL);
INSERT INTO "bus_type_logs" VALUES(9, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', NULL);
INSERT INTO "bus_type_logs" VALUES(10, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', NULL);
INSERT INTO "bus_type_logs" VALUES(11, 1, 'AC', 'AC', '4', '2017-12-27 02:54:59', NULL);
INSERT INTO "bus_type_logs" VALUES(12, 1, 'AC', 'Abbreviation', '1', '2018-02-21 05:30:09', NULL);
INSERT INTO "bus_type_logs" VALUES(13, 1, 'AC12', 'AC', '1', '2017-12-27 02:54:59', NULL);
INSERT INTO "bus_type_logs" VALUES(14, 1, 'Luxury', 'LU', '6', '2018-01-19 01:17:27', NULL);
INSERT INTO "bus_type_logs" VALUES(15, 1, 'Delux', 'N. AC', '5', '2018-02-01 06:20:35', NULL);
INSERT INTO "bus_type_logs" VALUES(16, 1, 'Sleeper Bus', 'S.P', '2', '2018-01-29 00:56:16', NULL);

CREATE TABLE "concessions" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "concession_provider_master_id" integer NOT NULL,
  "concession_master_id" integer NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "percentage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "pass_type_master_id" integer DEFAULT NULL,
  "print_ticket" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "etm_hot_key_master_id" varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  "concession_allowed_on" date DEFAULT NULL,
  "flat_fare" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "flat_fare_amount" decimal(20,2) DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "concessions" VALUES(8, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '11.00', '2018-01-31 05:09:03', '2018-02-28 06:01:01');
INSERT INTO "concessions" VALUES(9, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', '2018-01-31 06:14:16');
INSERT INTO "concessions" VALUES(11, 1, 14, 2, 1, 'Description', 3, '12', 1, 'No', '1', '2018-02-01', NULL, '214.00', '2018-02-28 05:47:57', '2018-02-28 05:59:39');

CREATE TABLE "concession_fare_slabs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "percentage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "stage_from" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "stage_to" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "fare" decimal(20,2) NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "concession_fare_slabs" VALUES(1, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', '2018-01-25 05:38:57');
INSERT INTO "concession_fare_slabs" VALUES(2, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:39:48');

CREATE TABLE "concession_fare_slab_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "percentage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "stage_from" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "stage_to" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "fare" decimal(20,2) NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "concession_fare_slab_logs" VALUES(1, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', '2018-01-25 05:38:57');
INSERT INTO "concession_fare_slab_logs" VALUES(2, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:39:48');
INSERT INTO "concession_fare_slab_logs" VALUES(3, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', '2018-01-25 05:43:07');
INSERT INTO "concession_fare_slab_logs" VALUES(4, 1, 1, '12', '12', '11', '12.00', '2018-01-25 05:39:48', '2018-01-25 05:49:48');
INSERT INTO "concession_fare_slab_logs" VALUES(5, 1, 1, '10', '12', '11', '12.00', '2018-01-25 05:38:57', NULL);

CREATE TABLE "concession_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "concession_provider_master_id" integer NOT NULL,
  "concession_master_id" integer NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "percentage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "pass_type_master_id" integer DEFAULT NULL,
  "print_ticket" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "etm_hot_key_master_id" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concession_allowed_on" date DEFAULT NULL,
  "flat_fare" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "flat_fare_amount" decimal(20,2) DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "concession_logs" VALUES(8, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', '2018-01-31 05:24:34');
INSERT INTO "concession_logs" VALUES(9, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(10, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(11, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(12, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(13, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(14, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', NULL, '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(15, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(16, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(17, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(18, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'Yes', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(19, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(20, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(21, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(22, 1, 1, 1, 1, 'Description', 1, '1', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(23, 1, 1, 1, 1, 'Description', 1, '10000000000000000', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(24, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(25, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(26, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(27, 1, 6, 1, 1, 'Description', 2, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(28, 1, 8, 1, 1, 'Description', 2, '10', 1, 'No', '1', '2018-02-07', NULL, '20.00', '2018-02-04 23:29:29', NULL);
INSERT INTO "concession_logs" VALUES(29, 1, 8, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-02-07', NULL, '20.00', '2018-02-04 23:29:29', NULL);
INSERT INTO "concession_logs" VALUES(30, 1, 8, 1, 1, 'Description', 2, '10', 1, 'No', '1', '2018-02-07', NULL, '21.00', '2018-02-04 23:29:29', NULL);
INSERT INTO "concession_logs" VALUES(31, 1, 6, 1, 1, 'Description', 1, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(32, 1, 6, 1, 1, 'Description', 1, '2', 1, 'No', '1', '2018-01-01', 'No', '20.00', '2018-01-31 05:33:54', NULL);
INSERT INTO "concession_logs" VALUES(33, 1, 14, 1, 1, 'Description', 1, '12', 1, 'No', '1', '2018-02-01', NULL, '12.00', '2018-02-28 05:47:57', NULL);
INSERT INTO "concession_logs" VALUES(34, 1, 14, 1, 1, 'Description', 2, '12', 1, 'No', '1', '2018-02-01', NULL, '14.00', '2018-02-28 05:47:57', NULL);
INSERT INTO "concession_logs" VALUES(35, 1, 14, 1, 1, 'Description', 2, '12', 1, 'No', '1', '2018-02-01', NULL, '114.00', '2018-02-28 05:47:57', NULL);
INSERT INTO "concession_logs" VALUES(36, 1, 14, 1, 1, 'Description', 3, '12', 1, 'No', '1', '2018-02-01', NULL, '214.00', '2018-02-28 05:47:57', NULL);
INSERT INTO "concession_logs" VALUES(37, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '1.00', '2018-01-31 05:09:03', NULL);
INSERT INTO "concession_logs" VALUES(38, 1, 1, 1, 1, 'Description', 1, '10', 1, 'No', '1', '2018-01-02', 'Yes', '11.00', '2018-01-31 05:09:03', NULL);

CREATE TABLE "concession_masters" (
  "id" integer UNSIGNED NOT NULL,
  "name" varchar(202) COLLATE utf8mb4_unicode_ci NOT NULL

);
INSERT INTO "concession_masters" VALUES(1, 'Student');
INSERT INTO "concession_masters" VALUES(2, 'Senior Citizen');

CREATE TABLE "concession_provider_masters" (
  "id" integer NOT NULL,
  "name" varchar(200) NOT NULL

);
INSERT INTO "concession_provider_masters" VALUES(1, 'ETM');
INSERT INTO "concession_provider_masters" VALUES(2, 'ETM1');

CREATE TABLE "countries" (
  "id" integer UNSIGNED NOT NULL,
  "country_code" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "country_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "countries" VALUES(1, 'AF', 'Afghanistan', NULL, NULL);
INSERT INTO "countries" VALUES(2, 'AL', 'Albania', NULL, NULL);
INSERT INTO "countries" VALUES(3, 'DZ', 'Algeria', NULL, NULL);
INSERT INTO "countries" VALUES(4, 'DS', 'American Samoa', NULL, NULL);
INSERT INTO "countries" VALUES(5, 'AD', 'Andorra', NULL, NULL);
INSERT INTO "countries" VALUES(6, 'AO', 'Angola', NULL, NULL);
INSERT INTO "countries" VALUES(7, 'AI', 'Anguilla', NULL, NULL);
INSERT INTO "countries" VALUES(8, 'AQ', 'Antarctica', NULL, NULL);
INSERT INTO "countries" VALUES(9, 'AG', 'Antigua and Barbuda', NULL, NULL);
INSERT INTO "countries" VALUES(10, 'AR', 'Argentina', NULL, NULL);
INSERT INTO "countries" VALUES(11, 'AM', 'Armenia', NULL, NULL);
INSERT INTO "countries" VALUES(12, 'AW', 'Aruba', NULL, NULL);
INSERT INTO "countries" VALUES(13, 'AU', 'Australia', NULL, NULL);
INSERT INTO "countries" VALUES(14, 'AT', 'Austria', NULL, NULL);
INSERT INTO "countries" VALUES(15, 'AZ', 'Azerbaijan', NULL, NULL);
INSERT INTO "countries" VALUES(16, 'BS', 'Bahamas', NULL, NULL);
INSERT INTO "countries" VALUES(17, 'BH', 'Bahrain', NULL, NULL);
INSERT INTO "countries" VALUES(18, 'BD', 'Bangladesh', NULL, NULL);
INSERT INTO "countries" VALUES(19, 'BB', 'Barbados', NULL, NULL);
INSERT INTO "countries" VALUES(20, 'BY', 'Belarus', NULL, NULL);
INSERT INTO "countries" VALUES(21, 'BE', 'Belgium', NULL, NULL);
INSERT INTO "countries" VALUES(22, 'BZ', 'Belize', NULL, NULL);
INSERT INTO "countries" VALUES(23, 'BJ', 'Benin', NULL, NULL);
INSERT INTO "countries" VALUES(24, 'BM', 'Bermuda', NULL, NULL);
INSERT INTO "countries" VALUES(25, 'BT', 'Bhutan', NULL, NULL);
INSERT INTO "countries" VALUES(26, 'BO', 'Bolivia', NULL, NULL);
INSERT INTO "countries" VALUES(27, 'BA', 'Bosnia and Herzegovina', NULL, NULL);
INSERT INTO "countries" VALUES(28, 'BW', 'Botswana', NULL, NULL);
INSERT INTO "countries" VALUES(29, 'BV', 'Bouvet Island', NULL, NULL);
INSERT INTO "countries" VALUES(30, 'BR', 'Brazil', NULL, NULL);
INSERT INTO "countries" VALUES(31, 'IO', 'British Indian Ocean Territory', NULL, NULL);
INSERT INTO "countries" VALUES(32, 'BN', 'Brunei Darussalam', NULL, NULL);
INSERT INTO "countries" VALUES(33, 'BG', 'Bulgaria', NULL, NULL);
INSERT INTO "countries" VALUES(34, 'BF', 'Burkina Faso', NULL, NULL);
INSERT INTO "countries" VALUES(35, 'BI', 'Burundi', NULL, NULL);
INSERT INTO "countries" VALUES(36, 'KH', 'Cambodia', NULL, NULL);
INSERT INTO "countries" VALUES(37, 'CM', 'Cameroon', NULL, NULL);
INSERT INTO "countries" VALUES(38, 'CA', 'Canada', NULL, NULL);
INSERT INTO "countries" VALUES(39, 'CV', 'Cape Verde', NULL, NULL);
INSERT INTO "countries" VALUES(40, 'KY', 'Cayman Islands', NULL, NULL);
INSERT INTO "countries" VALUES(41, 'CF', 'Central African Republic', NULL, NULL);
INSERT INTO "countries" VALUES(42, 'TD', 'Chad', NULL, NULL);
INSERT INTO "countries" VALUES(43, 'CL', 'Chile', NULL, NULL);
INSERT INTO "countries" VALUES(44, 'CN', 'China', NULL, NULL);
INSERT INTO "countries" VALUES(45, 'CX', 'Christmas Island', NULL, NULL);
INSERT INTO "countries" VALUES(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL);
INSERT INTO "countries" VALUES(47, 'CO', 'Colombia', NULL, NULL);
INSERT INTO "countries" VALUES(48, 'KM', 'Comoros', NULL, NULL);
INSERT INTO "countries" VALUES(49, 'CG', 'Congo', NULL, NULL);
INSERT INTO "countries" VALUES(50, 'CK', 'Cook Islands', NULL, NULL);
INSERT INTO "countries" VALUES(51, 'CR', 'Costa Rica', NULL, NULL);
INSERT INTO "countries" VALUES(52, 'HR', 'Croatia (Hrvatska)', NULL, NULL);
INSERT INTO "countries" VALUES(53, 'CU', 'Cuba', NULL, NULL);
INSERT INTO "countries" VALUES(54, 'CY', 'Cyprus', NULL, NULL);
INSERT INTO "countries" VALUES(55, 'CZ', 'Czech Republic', NULL, NULL);
INSERT INTO "countries" VALUES(56, 'DK', 'Denmark', NULL, NULL);
INSERT INTO "countries" VALUES(57, 'DJ', 'Djibouti', NULL, NULL);
INSERT INTO "countries" VALUES(58, 'DM', 'Dominica', NULL, NULL);
INSERT INTO "countries" VALUES(59, 'DO', 'Dominican Republic', NULL, NULL);
INSERT INTO "countries" VALUES(60, 'TP', 'East Timor', NULL, NULL);
INSERT INTO "countries" VALUES(61, 'EC', 'Ecuador', NULL, NULL);
INSERT INTO "countries" VALUES(62, 'EG', 'Egypt', NULL, NULL);
INSERT INTO "countries" VALUES(63, 'SV', 'El Salvador', NULL, NULL);
INSERT INTO "countries" VALUES(64, 'GQ', 'Equatorial Guinea', NULL, NULL);
INSERT INTO "countries" VALUES(65, 'ER', 'Eritrea', NULL, NULL);
INSERT INTO "countries" VALUES(66, 'EE', 'Estonia', NULL, NULL);
INSERT INTO "countries" VALUES(67, 'ET', 'Ethiopia', NULL, NULL);
INSERT INTO "countries" VALUES(68, 'FK', 'Falkland Islands (Malvinas)', NULL, NULL);
INSERT INTO "countries" VALUES(69, 'FO', 'Faroe Islands', NULL, NULL);
INSERT INTO "countries" VALUES(70, 'FJ', 'Fiji', NULL, NULL);
INSERT INTO "countries" VALUES(71, 'FI', 'Finland', NULL, NULL);
INSERT INTO "countries" VALUES(72, 'FR', 'France', NULL, NULL);
INSERT INTO "countries" VALUES(73, 'FX', 'France, Metropolitan', NULL, NULL);
INSERT INTO "countries" VALUES(74, 'GF', 'French Guiana', NULL, NULL);
INSERT INTO "countries" VALUES(75, 'PF', 'French Polynesia', NULL, NULL);
INSERT INTO "countries" VALUES(76, 'TF', 'French Southern Territories', NULL, NULL);
INSERT INTO "countries" VALUES(77, 'GA', 'Gabon', NULL, NULL);
INSERT INTO "countries" VALUES(78, 'GM', 'Gambia', NULL, NULL);
INSERT INTO "countries" VALUES(79, 'GE', 'Georgia', NULL, NULL);
INSERT INTO "countries" VALUES(80, 'DE', 'Germany', NULL, NULL);
INSERT INTO "countries" VALUES(81, 'GH', 'Ghana', NULL, NULL);
INSERT INTO "countries" VALUES(82, 'GI', 'Gibraltar', NULL, NULL);
INSERT INTO "countries" VALUES(83, 'GK', 'Guernsey', NULL, NULL);
INSERT INTO "countries" VALUES(84, 'GR', 'Greece', NULL, NULL);
INSERT INTO "countries" VALUES(85, 'GL', 'Greenland', NULL, NULL);
INSERT INTO "countries" VALUES(86, 'GD', 'Grenada', NULL, NULL);
INSERT INTO "countries" VALUES(87, 'GP', 'Guadeloupe', NULL, NULL);
INSERT INTO "countries" VALUES(88, 'GU', 'Guam', NULL, NULL);
INSERT INTO "countries" VALUES(89, 'GT', 'Guatemala', NULL, NULL);
INSERT INTO "countries" VALUES(90, 'GN', 'Guinea', NULL, NULL);
INSERT INTO "countries" VALUES(91, 'GW', 'Guinea-Bissau', NULL, NULL);
INSERT INTO "countries" VALUES(92, 'GY', 'Guyana', NULL, NULL);
INSERT INTO "countries" VALUES(93, 'HT', 'Haiti', NULL, NULL);
INSERT INTO "countries" VALUES(94, 'HM', 'Heard and Mc Donald Islands', NULL, NULL);
INSERT INTO "countries" VALUES(95, 'HN', 'Honduras', NULL, NULL);
INSERT INTO "countries" VALUES(96, 'HK', 'Hong Kong', NULL, NULL);
INSERT INTO "countries" VALUES(97, 'HU', 'Hungary', NULL, NULL);
INSERT INTO "countries" VALUES(98, 'IS', 'Iceland', NULL, NULL);
INSERT INTO "countries" VALUES(99, 'IN', 'India', NULL, NULL);
INSERT INTO "countries" VALUES(100, 'IM', 'Isle of Man', NULL, NULL);
INSERT INTO "countries" VALUES(101, 'ID', 'Indonesia', NULL, NULL);
INSERT INTO "countries" VALUES(102, 'IR', 'Iran (Islamic Republic of)', NULL, NULL);
INSERT INTO "countries" VALUES(103, 'IQ', 'Iraq', NULL, NULL);
INSERT INTO "countries" VALUES(104, 'IE', 'Ireland', NULL, NULL);
INSERT INTO "countries" VALUES(105, 'IL', 'Israel', NULL, NULL);
INSERT INTO "countries" VALUES(106, 'IT', 'Italy', NULL, NULL);
INSERT INTO "countries" VALUES(107, 'CI', 'Ivory Coast', NULL, NULL);
INSERT INTO "countries" VALUES(108, 'JE', 'Jersey', NULL, NULL);
INSERT INTO "countries" VALUES(109, 'JM', 'Jamaica', NULL, NULL);
INSERT INTO "countries" VALUES(110, 'JP', 'Japan', NULL, NULL);
INSERT INTO "countries" VALUES(111, 'JO', 'Jordan', NULL, NULL);
INSERT INTO "countries" VALUES(112, 'KZ', 'Kazakhstan', NULL, NULL);
INSERT INTO "countries" VALUES(113, 'KE', 'Kenya', NULL, NULL);
INSERT INTO "countries" VALUES(114, 'KI', 'Kiribati', NULL, NULL);
INSERT INTO "countries" VALUES(115, 'KP', 'Korea, Democratic People\'s Republic of', NULL, NULL);
INSERT INTO "countries" VALUES(116, 'KR', 'Korea, Republic of', NULL, NULL);
INSERT INTO "countries" VALUES(117, 'XK', 'Kosovo', NULL, NULL);
INSERT INTO "countries" VALUES(118, 'KW', 'Kuwait', NULL, NULL);
INSERT INTO "countries" VALUES(119, 'KG', 'Kyrgyzstan', NULL, NULL);
INSERT INTO "countries" VALUES(120, 'LA', 'Lao People\'s Democratic Republic', NULL, NULL);
INSERT INTO "countries" VALUES(121, 'LV', 'Latvia', NULL, NULL);
INSERT INTO "countries" VALUES(122, 'LB', 'Lebanon', NULL, NULL);
INSERT INTO "countries" VALUES(123, 'LS', 'Lesotho', NULL, NULL);
INSERT INTO "countries" VALUES(124, 'LR', 'Liberia', NULL, NULL);
INSERT INTO "countries" VALUES(125, 'LY', 'Libyan Arab Jamahiriya', NULL, NULL);
INSERT INTO "countries" VALUES(126, 'LI', 'Liechtenstein', NULL, NULL);
INSERT INTO "countries" VALUES(127, 'LT', 'Lithuania', NULL, NULL);
INSERT INTO "countries" VALUES(128, 'LU', 'Luxembourg', NULL, NULL);
INSERT INTO "countries" VALUES(129, 'MO', 'Macau', NULL, NULL);
INSERT INTO "countries" VALUES(130, 'MK', 'Macedonia', NULL, NULL);
INSERT INTO "countries" VALUES(131, 'MG', 'Madagascar', NULL, NULL);
INSERT INTO "countries" VALUES(132, 'MW', 'Malawi', NULL, NULL);
INSERT INTO "countries" VALUES(133, 'MY', 'Malaysia', NULL, NULL);
INSERT INTO "countries" VALUES(134, 'MV', 'Maldives', NULL, NULL);
INSERT INTO "countries" VALUES(135, 'ML', 'Mali', NULL, NULL);
INSERT INTO "countries" VALUES(136, 'MT', 'Malta', NULL, NULL);
INSERT INTO "countries" VALUES(137, 'MH', 'Marshall Islands', NULL, NULL);
INSERT INTO "countries" VALUES(138, 'MQ', 'Martinique', NULL, NULL);
INSERT INTO "countries" VALUES(139, 'MR', 'Mauritania', NULL, NULL);
INSERT INTO "countries" VALUES(140, 'MU', 'Mauritius', NULL, NULL);
INSERT INTO "countries" VALUES(141, 'TY', 'Mayotte', NULL, NULL);
INSERT INTO "countries" VALUES(142, 'MX', 'Mexico', NULL, NULL);
INSERT INTO "countries" VALUES(143, 'FM', 'Micronesia, Federated States of', NULL, NULL);
INSERT INTO "countries" VALUES(144, 'MD', 'Moldova, Republic of', NULL, NULL);
INSERT INTO "countries" VALUES(145, 'MC', 'Monaco', NULL, NULL);
INSERT INTO "countries" VALUES(146, 'MN', 'Mongolia', NULL, NULL);
INSERT INTO "countries" VALUES(147, 'ME', 'Montenegro', NULL, NULL);
INSERT INTO "countries" VALUES(148, 'MS', 'Montserrat', NULL, NULL);
INSERT INTO "countries" VALUES(149, 'MA', 'Morocco', NULL, NULL);
INSERT INTO "countries" VALUES(150, 'MZ', 'Mozambique', NULL, NULL);
INSERT INTO "countries" VALUES(151, 'MM', 'Myanmar', NULL, NULL);
INSERT INTO "countries" VALUES(152, 'NA', 'Namibia', NULL, NULL);
INSERT INTO "countries" VALUES(153, 'NR', 'Nauru', NULL, NULL);
INSERT INTO "countries" VALUES(154, 'NP', 'Nepal', NULL, NULL);
INSERT INTO "countries" VALUES(155, 'NL', 'Netherlands', NULL, NULL);
INSERT INTO "countries" VALUES(156, 'AN', 'Netherlands Antilles', NULL, NULL);
INSERT INTO "countries" VALUES(157, 'NC', 'New Caledonia', NULL, NULL);
INSERT INTO "countries" VALUES(158, 'NZ', 'New Zealand', NULL, NULL);
INSERT INTO "countries" VALUES(159, 'NI', 'Nicaragua', NULL, NULL);
INSERT INTO "countries" VALUES(160, 'NE', 'Niger', NULL, NULL);
INSERT INTO "countries" VALUES(161, 'NG', 'Nigeria', NULL, NULL);
INSERT INTO "countries" VALUES(162, 'NU', 'Niue', NULL, NULL);
INSERT INTO "countries" VALUES(163, 'NF', 'Norfolk Island', NULL, NULL);
INSERT INTO "countries" VALUES(164, 'MP', 'Northern Mariana Islands', NULL, NULL);
INSERT INTO "countries" VALUES(165, 'NO', 'Norway', NULL, NULL);
INSERT INTO "countries" VALUES(166, 'OM', 'Oman', NULL, NULL);
INSERT INTO "countries" VALUES(167, 'PK', 'Pakistan', NULL, NULL);
INSERT INTO "countries" VALUES(168, 'PW', 'Palau', NULL, NULL);
INSERT INTO "countries" VALUES(169, 'PS', 'Palestine', NULL, NULL);
INSERT INTO "countries" VALUES(170, 'PA', 'Panama', NULL, NULL);
INSERT INTO "countries" VALUES(171, 'PG', 'Papua New Guinea', NULL, NULL);
INSERT INTO "countries" VALUES(172, 'PY', 'Paraguay', NULL, NULL);
INSERT INTO "countries" VALUES(173, 'PE', 'Peru', NULL, NULL);
INSERT INTO "countries" VALUES(174, 'PH', 'Philippines', NULL, NULL);
INSERT INTO "countries" VALUES(175, 'PN', 'Pitcairn', NULL, NULL);
INSERT INTO "countries" VALUES(176, 'PL', 'Poland', NULL, NULL);
INSERT INTO "countries" VALUES(177, 'PT', 'Portugal', NULL, NULL);
INSERT INTO "countries" VALUES(178, 'PR', 'Puerto Rico', NULL, NULL);
INSERT INTO "countries" VALUES(179, 'QA', 'Qatar', NULL, NULL);
INSERT INTO "countries" VALUES(180, 'RE', 'Reunion', NULL, NULL);
INSERT INTO "countries" VALUES(181, 'RO', 'Romania', NULL, NULL);
INSERT INTO "countries" VALUES(182, 'RU', 'Russian Federation', NULL, NULL);
INSERT INTO "countries" VALUES(183, 'RW', 'Rwanda', NULL, NULL);
INSERT INTO "countries" VALUES(184, 'KN', 'Saint Kitts and Nevis', NULL, NULL);
INSERT INTO "countries" VALUES(185, 'LC', 'Saint Lucia', NULL, NULL);
INSERT INTO "countries" VALUES(186, 'VC', 'Saint Vincent and the Grenadines', NULL, NULL);
INSERT INTO "countries" VALUES(187, 'WS', 'Samoa', NULL, NULL);
INSERT INTO "countries" VALUES(188, 'SM', 'San Marino', NULL, NULL);
INSERT INTO "countries" VALUES(189, 'ST', 'Sao Tome and Principe', NULL, NULL);
INSERT INTO "countries" VALUES(190, 'SA', 'Saudi Arabia', NULL, NULL);
INSERT INTO "countries" VALUES(191, 'SN', 'Senegal', NULL, NULL);
INSERT INTO "countries" VALUES(192, 'RS', 'Serbia', NULL, NULL);
INSERT INTO "countries" VALUES(193, 'SC', 'Seychelles', NULL, NULL);
INSERT INTO "countries" VALUES(194, 'SL', 'Sierra Leone', NULL, NULL);
INSERT INTO "countries" VALUES(195, 'SG', 'Singapore', NULL, NULL);
INSERT INTO "countries" VALUES(196, 'SK', 'Slovakia', NULL, NULL);
INSERT INTO "countries" VALUES(197, 'SI', 'Slovenia', NULL, NULL);
INSERT INTO "countries" VALUES(198, 'SB', 'Solomon Islands', NULL, NULL);
INSERT INTO "countries" VALUES(199, 'SO', 'Somalia', NULL, NULL);
INSERT INTO "countries" VALUES(200, 'ZA', 'South Africa', NULL, NULL);
INSERT INTO "countries" VALUES(201, 'GS', 'South Georgia South Sandwich Islands', NULL, NULL);
INSERT INTO "countries" VALUES(202, 'ES', 'Spain', NULL, NULL);
INSERT INTO "countries" VALUES(203, 'LK', 'Sri Lanka', NULL, NULL);
INSERT INTO "countries" VALUES(204, 'SH', 'St. Helena', NULL, NULL);
INSERT INTO "countries" VALUES(205, 'PM', 'St. Pierre and Miquelon', NULL, NULL);
INSERT INTO "countries" VALUES(206, 'SD', 'Sudan', NULL, NULL);
INSERT INTO "countries" VALUES(207, 'SR', 'Suriname', NULL, NULL);
INSERT INTO "countries" VALUES(208, 'SJ', 'Svalbard and Jan Mayen Islands', NULL, NULL);
INSERT INTO "countries" VALUES(209, 'SZ', 'Swaziland', NULL, NULL);
INSERT INTO "countries" VALUES(210, 'SE', 'Sweden', NULL, NULL);
INSERT INTO "countries" VALUES(211, 'CH', 'Switzerland', NULL, NULL);
INSERT INTO "countries" VALUES(212, 'SY', 'Syrian Arab Republic', NULL, NULL);
INSERT INTO "countries" VALUES(213, 'TW', 'Taiwan', NULL, NULL);
INSERT INTO "countries" VALUES(214, 'TJ', 'Tajikistan', NULL, NULL);
INSERT INTO "countries" VALUES(215, 'TZ', 'Tanzania, United Republic of', NULL, NULL);
INSERT INTO "countries" VALUES(216, 'TH', 'Thailand', NULL, NULL);
INSERT INTO "countries" VALUES(217, 'TG', 'Togo', NULL, NULL);
INSERT INTO "countries" VALUES(218, 'TK', 'Tokelau', NULL, NULL);
INSERT INTO "countries" VALUES(219, 'TO', 'Tonga', NULL, NULL);
INSERT INTO "countries" VALUES(220, 'TT', 'Trinidad and Tobago', NULL, NULL);
INSERT INTO "countries" VALUES(221, 'TN', 'Tunisia', NULL, NULL);
INSERT INTO "countries" VALUES(222, 'TR', 'Turkey', NULL, NULL);
INSERT INTO "countries" VALUES(223, 'TM', 'Turkmenistan', NULL, NULL);
INSERT INTO "countries" VALUES(224, 'TC', 'Turks and Caicos Islands', NULL, NULL);
INSERT INTO "countries" VALUES(225, 'TV', 'Tuvalu', NULL, NULL);
INSERT INTO "countries" VALUES(226, 'UG', 'Uganda', NULL, NULL);
INSERT INTO "countries" VALUES(227, 'UA', 'Ukraine', NULL, NULL);
INSERT INTO "countries" VALUES(228, 'AE', 'United Arab Emirates', NULL, NULL);
INSERT INTO "countries" VALUES(229, 'GB', 'United Kingdom', NULL, NULL);
INSERT INTO "countries" VALUES(230, 'US', 'United States', NULL, NULL);
INSERT INTO "countries" VALUES(231, 'UM', 'United States minor outlying islands', NULL, NULL);
INSERT INTO "countries" VALUES(232, 'UY', 'Uruguay', NULL, NULL);
INSERT INTO "countries" VALUES(233, 'UZ', 'Uzbekistan', NULL, NULL);
INSERT INTO "countries" VALUES(234, 'VU', 'Vanuatu', NULL, NULL);
INSERT INTO "countries" VALUES(235, 'VA', 'Vatican City State', NULL, NULL);
INSERT INTO "countries" VALUES(236, 'VE', 'Venezuela', NULL, NULL);
INSERT INTO "countries" VALUES(237, 'VN', 'Vietnam', NULL, NULL);
INSERT INTO "countries" VALUES(238, 'VG', 'Virgin Islands (British)', NULL, NULL);
INSERT INTO "countries" VALUES(239, 'VI', 'Virgin Islands (U.S.)', NULL, NULL);
INSERT INTO "countries" VALUES(240, 'WF', 'Wallis and Futuna Islands', NULL, NULL);
INSERT INTO "countries" VALUES(241, 'EH', 'Western Sahara', NULL, NULL);
INSERT INTO "countries" VALUES(242, 'YE', 'Yemen', NULL, NULL);
INSERT INTO "countries" VALUES(243, 'ZR', 'Zaire', NULL, NULL);
INSERT INTO "countries" VALUES(244, 'ZM', 'Zambia', NULL, NULL);
INSERT INTO "countries" VALUES(245, 'ZW', 'Zimbabwe', NULL, NULL);
INSERT INTO "countries" VALUES(246, 'AR', 'ARIPO', NULL, NULL);
INSERT INTO "countries" VALUES(247, 'OA', 'OAPI', NULL, NULL);
INSERT INTO "countries" VALUES(248, 'EU', 'EUIPO', NULL, NULL);
INSERT INTO "countries" VALUES(249, 'EP', 'EPO', NULL, NULL);
INSERT INTO "countries" VALUES(250, 'EA', 'EAPO', NULL, NULL);
INSERT INTO "countries" VALUES(251, 'GC', 'GCC', NULL, NULL);
INSERT INTO "countries" VALUES(252, 'TL', 'Timor', NULL, NULL);
INSERT INTO "countries" VALUES(257, 'BX', 'Benelux', NULL, NULL);
INSERT INTO "countries" VALUES(258, 'CW', 'Curacoa', NULL, NULL);
INSERT INTO "countries" VALUES(259, 'BE', 'Bonaire Sint Eustatius Saba', NULL, NULL);
INSERT INTO "countries" VALUES(260, 'TN', 'Tanzania- Zanzibar', NULL, NULL);

CREATE TABLE "crew_details" (
  "id" integer UNSIGNED NOT NULL,
  "depot_id" integer NOT NULL,
  "role" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "user_id" integer NOT NULL,
  "crew_name" varchar(202) COLLATE utf8_unicode_ci NOT NULL,
  "password" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "crew_id" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "gender" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "father_name" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "licence_no" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "valid_up_to" date DEFAULT NULL,
  "pf_no" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "city" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "country_id" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "address" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "mobile" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "date_of_birth" date DEFAULT NULL,
  "date_of_join" date DEFAULT NULL,
  "date_of_leaving" date DEFAULT NULL,
  "password_reset" varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  "status" integer DEFAULT '0',
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "crew_details" VALUES(9, 1, 'Conductor', 1, 'Mukesh', '12345', '12345', 'Male', 'Rajesh', '121212', '2018-07-02', '123456', 'GWALIOR', '99', '10 GOVINDPURI, UNIVERSITY ROAD', '9015548861', '2018-07-02', '2018-07-02', '2018-07-02', NULL, 0, '2018-07-02 14:54:17', '2018-07-02 14:54:17');
INSERT INTO "crew_details" VALUES(10, 1, 'Inspector', 1, 'Mukesh', '12345', '12345', 'Male', 'Dinesh', '121212433443', '2018-07-02', '123456', 'GWALIOR', '99', '10 GOVINDPURI, UNIVERSITY ROAD', '9015548861', '2018-07-02', '2018-07-02', '2018-07-02', NULL, 0, '2018-07-02 14:54:17', '2018-07-02 14:54:17');

CREATE TABLE "crew_detail_logs" (
  "id" integer UNSIGNED NOT NULL,
  "depot_id" integer NOT NULL,
  "role" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "user_id" integer NOT NULL,
  "crew_name" varchar(202) COLLATE utf8_unicode_ci NOT NULL,
  "password" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "crew_id" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "gender" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "father_name" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "licence_no" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "valid_up_to" date DEFAULT NULL,
  "pf_no" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "city" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "country_id" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "address" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "mobile" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "date_of_birth" date DEFAULT NULL,
  "date_of_join" date DEFAULT NULL,
  "date_of_leaving" date DEFAULT NULL,
  "password_reset" varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  "status" integer DEFAULT '0',
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "crew_detail_logs" VALUES(5, 1, '', 1, 'Crew Name', '123', '1', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '18', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', '2018-02-20 04:11:16');
INSERT INTO "crew_detail_logs" VALUES(6, 1, '', 2, '', '', '', '', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO "crew_detail_logs" VALUES(7, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', '2018-02-20 05:17:39');
INSERT INTO "crew_detail_logs" VALUES(8, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL);
INSERT INTO "crew_detail_logs" VALUES(9, 1, '', 2, '', '', '', '', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO "crew_detail_logs" VALUES(10, 1, '', 1, 'Crew Name', '123', '1', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '18', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL);
INSERT INTO "crew_detail_logs" VALUES(11, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL);
INSERT INTO "crew_detail_logs" VALUES(12, 1, 'Driver', 1, 'test', '', '11', '', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO "crew_detail_logs" VALUES(13, 1, 'Conductor', 1, 'Crew Name', '123', '11', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL);
INSERT INTO "crew_detail_logs" VALUES(14, 1, 'Conductor', 1, 'Crew Name', '123', '11', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL);
INSERT INTO "crew_detail_logs" VALUES(15, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL);
INSERT INTO "crew_detail_logs" VALUES(16, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', '', '', NULL, '', '', '18', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL);
INSERT INTO "crew_detail_logs" VALUES(17, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', '', '', NULL, '', '', '18', '', '', NULL, NULL, NULL, NULL, 0, '2018-02-20 05:17:39', NULL);
INSERT INTO "crew_detail_logs" VALUES(18, 2, 'Conductor', 1, 'Crew Name', 'admin', '12323', 'Male', 'Father Name', '32423', '2018-02-01', '343434', 'Delhi', '18', 'H.No 5 Hastsal Village', '2323213213', '2018-02-01', '2018-02-01', '2018-02-01', NULL, 0, '2018-02-20 05:17:39', NULL);
INSERT INTO "crew_detail_logs" VALUES(19, 1, 'Conductor', 1, 'Crew Name', '123', '11', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '1', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL);
INSERT INTO "crew_detail_logs" VALUES(20, 1, 'Conductor', 1, 'Crew Name', '123', '1111', 'Male', 'Father Name', '32423', '2018-02-08', '343', '223', '1', '', '', '2018-02-01', '2018-02-14', '2018-02-08', NULL, 0, '2018-02-20 04:11:16', NULL);
INSERT INTO "crew_detail_logs" VALUES(21, 2, 'Conductor1', 1, 'Crew Name1', 'admin', '123231', 'Male', 'Father Name', '32423', '2018-02-01', '3434341111', 'Delhi1', '1', 'H.No 5 Hastsal Village1', '2323213213', '2018-02-20', '2018-02-20', '2018-02-20', NULL, 0, '2018-02-20 05:17:39', NULL);

CREATE TABLE "denominations" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "denomination_master_id" varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "denomination" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "price" decimal(10,2) NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "denominations" VALUES(1, 1, '13', 'Denomination3', 'Description3', '2.00', '2018-02-02 01:54:46', '2018-02-06 06:32:48');
INSERT INTO "denominations" VALUES(2, 1, '14', 'Denomination2', 'Description2', '1.00', '2018-02-02 03:41:21', '2018-02-06 06:32:56');
INSERT INTO "denominations" VALUES(4, 1, '4', 'Denomination4', 'Description4', '4.00', '2018-02-02 03:48:13', '2018-02-05 02:03:59');
INSERT INTO "denominations" VALUES(5, 1, '1', 'Denomination1', 'Description', '1.00', '2018-02-05 02:00:37', '2018-02-05 02:02:30');
INSERT INTO "denominations" VALUES(6, 1, '12', 'Denomination2', 'Description', '4343.00', '2018-02-05 07:00:13', '2018-02-05 07:00:13');
INSERT INTO "denominations" VALUES(7, 1, '19', 'Denomination', '10', '12.00', '2018-02-12 04:58:34', '2018-02-12 04:58:34');

CREATE TABLE "denomination_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "denomination_master_id" varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "denomination" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "price" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "denomination_logs" VALUES(1, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', '2018-02-02 01:54:46');
INSERT INTO "denomination_logs" VALUES(2, 1, '2', 'Short Reason', 'Reason Description', 1, '2018-02-02 03:41:21', '2018-02-02 03:41:21');
INSERT INTO "denomination_logs" VALUES(3, 1, '1', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:32', '2018-02-02 03:41:32');
INSERT INTO "denomination_logs" VALUES(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13');
INSERT INTO "denomination_logs" VALUES(5, 1, '4', '343', '43433', 4343, '2018-02-05 02:00:37', NULL);
INSERT INTO "denomination_logs" VALUES(6, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', NULL);
INSERT INTO "denomination_logs" VALUES(7, 1, '2', 'Short Reason', 'Reason Description', 1, '2018-02-02 03:41:21', NULL);
INSERT INTO "denomination_logs" VALUES(8, 1, '4', 'Denomination', 'Description', 1, '2018-02-05 02:00:37', NULL);
INSERT INTO "denomination_logs" VALUES(9, 1, '2', 'Denomination', 'Description1', 1, '2018-02-02 03:41:21', NULL);
INSERT INTO "denomination_logs" VALUES(10, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', NULL);
INSERT INTO "denomination_logs" VALUES(11, 1, '3', 'Denomination2', 'Description3', 2, '2018-02-02 01:54:46', NULL);
INSERT INTO "denomination_logs" VALUES(12, 1, '3', 'Denomination', 'DescriptionReason', 4, '2018-02-02 03:48:13', NULL);
INSERT INTO "denomination_logs" VALUES(13, 1, '12', 'Denomination2', 'Description', 4343, '2018-02-05 07:00:13', NULL);
INSERT INTO "denomination_logs" VALUES(14, 1, '12', 'Denomination2', 'Description', 4343, '2018-02-05 07:00:13', NULL);
INSERT INTO "denomination_logs" VALUES(15, 1, '12', 'Denomination2', 'Description', 4343, '2018-02-05 07:00:13', NULL);
INSERT INTO "denomination_logs" VALUES(16, 1, '3', 'Denomination3', 'Description3', 2, '2018-02-02 01:54:46', NULL);
INSERT INTO "denomination_logs" VALUES(17, 1, '2', 'Denomination2', 'Description2', 1, '2018-02-02 03:41:21', NULL);

CREATE TABLE "denomination_masters" (
  "id" integer NOT NULL,
  "name" varchar(200) NOT NULL

);
INSERT INTO "denomination_masters" VALUES(12, 'D1');
INSERT INTO "denomination_masters" VALUES(13, 'D2');
INSERT INTO "denomination_masters" VALUES(14, 'D3');
INSERT INTO "denomination_masters" VALUES(18, 'D4');
INSERT INTO "denomination_masters" VALUES(19, 'D5');
INSERT INTO "denomination_masters" VALUES(20, '6');
INSERT INTO "denomination_masters" VALUES(21, 'D7');

CREATE TABLE "departments" (
  "id" integer UNSIGNED NOT NULL,
  "denomination" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "prince" double(8,2) NOT NULL,
  "documentation_type" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
CREATE TABLE "depots" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_id" integer NOT NULL,
  "short_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_location" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "service_id" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "depots" VALUES(1, 1, 'Sahadara', 131, 'SD', 'Delhi', '1', '2018-01-30 05:53:13', '2018-03-07 05:59:28');
INSERT INTO "depots" VALUES(2, 1, 'Uttam Nagar', 3443, 'Express ', 'Delhi', '1', '2018-01-30 07:09:51', '2018-03-07 06:06:53');
INSERT INTO "depots" VALUES(3, 1, 'Sahadara1', 13, 'mk', 'Delhi', '1', '2018-01-30 07:10:40', '2018-03-07 05:45:59');
INSERT INTO "depots" VALUES(4, 1, 'Sadipur Depot', 4435, 'SD.', 'Sadipur', '1', '2018-03-06 23:38:20', '2018-03-07 05:45:49');
INSERT INTO "depots" VALUES(5, 1, 'Safadar Jang', 3232323, 'BT', 'Safadar Jang', '7', '2018-03-07 05:39:20', '2018-03-08 01:53:37');

CREATE TABLE "depots111" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_id" integer NOT NULL,
  "short_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_location" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "default_service" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "depots111" VALUES(1, 1, 'Sahadara', 1, 'SD', 'Delhi', 'A-G-Holidays', '2018-01-30 05:53:13', '2018-01-30 05:53:13');
INSERT INTO "depots111" VALUES(2, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 'A-G-Holidays', '2018-01-30 07:09:51', '2018-01-30 07:09:51');
INSERT INTO "depots111" VALUES(3, 1, 'Sahadara1', 13, 'mk', 'Delhi11111111111111', 'Apple-Travels', '2018-01-30 07:10:40', '2018-02-21 23:42:52');

CREATE TABLE "depots1111" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_id" integer NOT NULL,
  "short_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_location" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "default_service" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "depots1111" VALUES(1, 1, 'Sahadara', 1, 'SD', 'Delhi', 'A-G-Holidays', '2018-01-30 05:53:13', '2018-01-30 05:53:13');
INSERT INTO "depots1111" VALUES(2, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 'A-G-Holidays', '2018-01-30 07:09:51', '2018-01-30 07:09:51');
INSERT INTO "depots1111" VALUES(3, 1, 'Sahadara1', 13, 'mk', 'Delhi11111111111111', 'Apple-Travels', '2018-01-30 07:10:40', '2018-02-21 23:42:52');

CREATE TABLE "depot_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_id" integer NOT NULL,
  "short_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "depot_location" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "service_id" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "depot_logs" VALUES(1, 1, 'Janak Puri', 3443, 'JK', 'Delhi', 2, '2018-01-30 07:09:51', '2018-03-07 11:08:47');
INSERT INTO "depot_logs" VALUES(2, 1, 'Sadipur Depot', 4435, 'SD.', 'Sadipur', 3, '2018-03-06 23:38:20', '2018-03-07 11:15:49');
INSERT INTO "depot_logs" VALUES(3, 1, 'Sahadara1', 13, 'mk', 'Delhi', 3, '2018-01-30 07:10:40', '2018-03-07 11:15:59');
INSERT INTO "depot_logs" VALUES(4, 1, 'Sahadara', 1, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:17:30');
INSERT INTO "depot_logs" VALUES(5, 1, 'Sahadara', 13, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:29:28');
INSERT INTO "depot_logs" VALUES(6, 1, 'Sahadara', 131, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:29:36');
INSERT INTO "depot_logs" VALUES(7, 1, 'Sahadara', 131, 'SD', 'Delhi', 1, '2018-01-30 05:53:13', '2018-03-07 11:31:45');
INSERT INTO "depot_logs" VALUES(8, 1, 'Uttam Nagar', 3443, 'JK', 'Delhi', 1, '2018-01-30 07:09:51', '2018-03-07 11:36:53');
INSERT INTO "depot_logs" VALUES(9, 1, 'Uttam Nagar', 3443, 'Express ', 'Delhi', 1, '2018-01-30 07:09:51', '2018-03-07 11:37:19');
INSERT INTO "depot_logs" VALUES(10, 1, 'Safadar Jang', 3232323, 'SJ', 'Safadar Jang', 7, '2018-03-07 05:39:20', '2018-03-08 07:23:37');

CREATE TABLE "duties" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route_id" integer UNSIGNED NOT NULL,
  "duty_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "start_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "end_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "shift_id" integer UNSIGNED NOT NULL,
  "order_number" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "duties" VALUES(1, 1, 24, '1', 'Description', '10', '20', 6, '3', '2018-02-27 06:57:29', '2018-02-27 06:57:29');
INSERT INTO "duties" VALUES(3, 1, 24, '2', 'Description\r
', '10', '20', 7, '4', '2018-02-27 07:10:41', '2018-02-27 07:10:41');
INSERT INTO "duties" VALUES(4, 1, 24, '3', 'Description\r
', '10', '20', 6, '1', '2018-02-28 00:15:51', '2018-02-28 00:16:03');
INSERT INTO "duties" VALUES(5, 1, 24, '5', 'Description', '16', '20', 5, '2', '2018-03-07 01:06:02', '2018-03-07 01:06:02');

CREATE TABLE "dutie_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route_id" integer UNSIGNED NOT NULL,
  "duty_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "start_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "end_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "shift_id" integer UNSIGNED NOT NULL,
  "order_number" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "dutie_logs" VALUES(1, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', '2018-02-27 06:57:29');
INSERT INTO "dutie_logs" VALUES(3, 1, 24, '2', 'Description\r
', '10', '20', 7, '2', '2018-02-27 07:10:41', '2018-02-27 07:10:41');
INSERT INTO "dutie_logs" VALUES(4, 1, 24, '4', 'Description\r
', '10', '20', 6, '3', '2018-02-28 00:15:51', NULL);
INSERT INTO "dutie_logs" VALUES(5, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', NULL);
INSERT INTO "dutie_logs" VALUES(6, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', NULL);
INSERT INTO "dutie_logs" VALUES(7, 1, 24, '1', 'Description', '10', '20', 6, '1', '2018-02-27 06:57:29', NULL);
INSERT INTO "dutie_logs" VALUES(8, 1, 24, '1', 'Description', '10', '20', 6, '2', '2018-02-27 06:57:29', NULL);

CREATE TABLE "ETM_details" (
  "id" integer NOT NULL,
  "user_id" integer NOT NULL,
  "depot_id" integer NOT NULL,
  "etm_no" integer NOT NULL,
  "evm_status_master_id" integer NOT NULL,
  "sim_no" integer NOT NULL,
  "emei_no" integer NOT NULL,
  "serial_no" integer NOT NULL,
  "make" integer NOT NULL,
  "warranty" date NOT NULL,
  "project_period" integer NOT NULL,
  "remarks" text NOT NULL,
  "created_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "updated_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "ETM_details" VALUES(1, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. ... Easy Learning with "Show PHP" Our "Show PHP" tool makes it easy to learn PHP, it shows both the PHP source code and the HTML output of the code.', '2018-03-06 06:35:14', '2018-03-06 23:26:18');

CREATE TABLE "ETM_detail_logs" (
  "id" integer NOT NULL,
  "user_id" integer NOT NULL,
  "depot_id" integer NOT NULL,
  "etm_no" integer NOT NULL,
  "evm_status_master_id" integer NOT NULL,
  "sim_no" integer NOT NULL,
  "emei_no" integer NOT NULL,
  "serial_no" integer NOT NULL,
  "make" integer NOT NULL,
  "warranty" date NOT NULL,
  "project_period" integer NOT NULL,
  "remarks" text NOT NULL,
  "created_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "updated_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "ETM_detail_logs" VALUES(1, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, '1', '2018-03-06 06:35:14', '2018-03-07 04:43:10');
INSERT INTO "ETM_detail_logs" VALUES(2, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, '1', '2018-03-06 06:35:14', '2018-03-07 04:43:18');
INSERT INTO "ETM_detail_logs" VALUES(3, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, '1', '2018-03-06 06:35:14', '2018-03-07 04:56:18');
INSERT INTO "ETM_detail_logs" VALUES(4, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. ... Easy Learning with "Show PHP" Our "Show PHP" tool makes it easy to learn PHP, it shows both the PHP source code and the HTML output of the code.', '2018-03-06 06:35:14', '2018-03-07 10:32:21');
INSERT INTO "ETM_detail_logs" VALUES(5, 1, 1, 1, 2, 1, 1, 1, 1, '2018-03-01', 1, 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. ... Easy Learning with "Show PHP" Our "Show PHP" tool makes it easy to learn PHP, it shows both the PHP source code and the HTML output of the code.', '2018-03-06 06:35:14', '2018-03-14 06:33:08');

CREATE TABLE "etm_hot_key_masters" (
  "id" integer NOT NULL,
  "name" varchar(200) NOT NULL

);
INSERT INTO "etm_hot_key_masters" VALUES(1, 'k1');
INSERT INTO "etm_hot_key_masters" VALUES(2, 'k2');

CREATE TABLE "evm_status_masters" (
  "id" integer UNSIGNED NOT NULL,
  "name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL

);
INSERT INTO "evm_status_masters" VALUES(1, 'P1');
INSERT INTO "evm_status_masters" VALUES(2, 'P2');

CREATE TABLE "fares" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "stage" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "adult_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "child_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "luggage_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP

);
CREATE TABLE "fares_copy" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "stage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "adult_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "child_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "luggage_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "fares_copy" VALUES(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');
INSERT INTO "fares_copy" VALUES(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');

CREATE TABLE "fare_details" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "stage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "adult_ticket_amount" decimal(20,2) NOT NULL,
  "child_ticket_amount" decimal(20,2) NOT NULL,
  "luggage_ticket_amount" decimal(20,2) NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO "fare_details" VALUES(14, '1', 14, '1', '5.00', '5.00', '5.00', NULL, '2018-02-27 11:31:36');
INSERT INTO "fare_details" VALUES(15, '1', 14, '2', '5.00', '10.00', '10.00', NULL, '2018-02-27 11:31:36');
INSERT INTO "fare_details" VALUES(26, '1', 6, '1', '1.00', '1.00', '1.00', NULL, '2018-02-28 10:06:32');
INSERT INTO "fare_details" VALUES(27, '1', 6, '2', '5.00', '5.00', '5.00', NULL, '2018-02-28 10:06:32');
INSERT INTO "fare_details" VALUES(28, '1', 6, '3', '5.00', '5.00', '5.00', NULL, '2018-02-28 10:06:32');
INSERT INTO "fare_details" VALUES(29, '1', 6, '4', '20.00', '20.00', '20.00', NULL, '2018-02-28 10:06:32');
INSERT INTO "fare_details" VALUES(30, '1', 6, '5', '20.00', '30.00', '40.00', NULL, '2018-02-28 10:06:32');
INSERT INTO "fare_details" VALUES(31, '1', 16, '1', '10.00', '5.00', '20.00', NULL, '2018-07-12 04:53:09');
INSERT INTO "fare_details" VALUES(32, '1', 16, '2', '20.00', '10.00', '20.00', NULL, '2018-07-12 04:53:09');

CREATE TABLE "fare_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "stage" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "adult_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "child_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "luggage_ticket_amount" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "fare_logs" VALUES(1, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');
INSERT INTO "fare_logs" VALUES(2, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');
INSERT INTO "fare_logs" VALUES(3, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');
INSERT INTO "fare_logs" VALUES(4, '1', 1, '1', '5.00', '5.00', '5.00', '2018-01-19 06:22:19', '2018-01-19 06:30:11');

CREATE TABLE "inspector_remarks" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "inspector_remark" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_remark" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "remark_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "inspector_remarks" VALUES(1, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 1, '2018-02-02 05:55:38', '2018-02-02 05:55:38');
INSERT INTO "inspector_remarks" VALUES(2, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 4, '2018-02-02 06:01:01', '2018-02-02 06:01:01');
INSERT INTO "inspector_remarks" VALUES(3, 1, 'Inspector Remark2', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:13', '2018-02-02 06:01:13');
INSERT INTO "inspector_remarks" VALUES(4, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 2, '2018-02-02 06:01:25', '2018-02-02 06:01:25');
INSERT INTO "inspector_remarks" VALUES(5, 1, 'Inspector Remark11', 'Short Remark', 'Remark Description', 5, '2018-03-05 04:59:18', '2018-03-05 04:59:18');

CREATE TABLE "inspector_remark_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "inspector_remark" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_remark" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "remark_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "inspector_remark_logs" VALUES(1, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 1, '2018-02-02 05:55:38', '2018-02-02 05:55:38');
INSERT INTO "inspector_remark_logs" VALUES(2, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:01', '2018-02-02 06:01:01');
INSERT INTO "inspector_remark_logs" VALUES(3, 1, 'Inspector Remark2', 'Short Remark', 'Remark Description', 2, '2018-02-02 06:01:13', '2018-02-02 06:01:13');
INSERT INTO "inspector_remark_logs" VALUES(4, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 4, '2018-02-02 06:01:25', '2018-02-02 06:01:25');
INSERT INTO "inspector_remark_logs" VALUES(5, 1, 'Inspector Remark1', 'Short Remark', 'Remark Description', 3, '2018-02-02 06:01:01', NULL);
INSERT INTO "inspector_remark_logs" VALUES(6, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 2, '2018-02-02 05:55:38', NULL);
INSERT INTO "inspector_remark_logs" VALUES(7, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 1, '2018-02-02 06:01:25', NULL);
INSERT INTO "inspector_remark_logs" VALUES(8, 1, 'Inspector Remark3', 'Short Remark', 'Remark Description', 1, '2018-02-02 06:01:25', NULL);
INSERT INTO "inspector_remark_logs" VALUES(9, 1, 'Inspector Remark', 'Short Remark', 'Remark Description', 1, '2018-02-02 05:55:38', NULL);

CREATE TABLE "migrations" (
  "id" integer UNSIGNED NOT NULL,
  "migration" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "batch" integer NOT NULL

);
INSERT INTO "migrations" VALUES(4, '2014_10_12_000000_create_users_table', 1);
INSERT INTO "migrations" VALUES(5, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO "migrations" VALUES(7, '2015_06_06_211555_add_expire_time_column_to_notification_table', 1);
INSERT INTO "migrations" VALUES(8, '2015_06_06_211555_change_type_to_extra_in_notifications_table', 1);
INSERT INTO "migrations" VALUES(9, '2015_06_07_211555_alter_category_name_to_unique', 1);
INSERT INTO "migrations" VALUES(11, '2016_05_19_144531_add_stack_id_to_notifications', 1);
INSERT INTO "migrations" VALUES(12, '2016_07_01_153156_update_version4_notifications_table', 1);
INSERT INTO "migrations" VALUES(13, '2016_11_02_193415_drop_version4_unused_tables', 1);
INSERT INTO "migrations" VALUES(14, '2017_12_14_062521_create_depots_table', 1);
INSERT INTO "migrations" VALUES(15, '2017_12_14_070910_entrust_setup_tables', 1);
INSERT INTO "migrations" VALUES(16, '2017_12_14_083124_create_bus_types_table', 1);
INSERT INTO "migrations" VALUES(17, '2017_12_14_090509_create_services_table', 1);
INSERT INTO "migrations" VALUES(18, '2017_12_14_090809_create_vehicles_table', 1);
INSERT INTO "migrations" VALUES(19, '2017_12_14_091242_create_shifts_table', 1);
INSERT INTO "migrations" VALUES(20, '2017_12_14_091813_create_stops_table', 1);
INSERT INTO "migrations" VALUES(21, '2017_12_14_092049_create_routes_table', 1);
INSERT INTO "migrations" VALUES(22, '2017_12_14_092450_create_duties_table', 1);
INSERT INTO "migrations" VALUES(23, '2017_12_14_104150_create_targets_table', 1);
INSERT INTO "migrations" VALUES(24, '2017_12_14_104756_create_trips_table', 1);
INSERT INTO "migrations" VALUES(25, '2017_12_14_105641_create_fares_table', 1);
INSERT INTO "migrations" VALUES(26, '2017_12_14_110249_create_concession_fare_slabs_table', 1);
INSERT INTO "migrations" VALUES(27, '2017_12_14_111321_create_concessions_table', 1);
INSERT INTO "migrations" VALUES(28, '2017_12_14_112355_create_trip_collection_reasons_table', 1);
INSERT INTO "migrations" VALUES(29, '2017_12_14_112956_create_inspector_remarks_table', 1);
INSERT INTO "migrations" VALUES(30, '2017_12_14_113352_create_payout_reasons_table', 1);
INSERT INTO "migrations" VALUES(31, '2017_12_14_113823_create_departments_table', 1);
INSERT INTO "migrations" VALUES(32, '2017_12_14_114129_create_pass_types_table', 1);
INSERT INTO "migrations" VALUES(33, '2017_12_14_120513_create_crew_details_table', 1);
INSERT INTO "migrations" VALUES(34, '2017_12_26_125021_create_bustypes_table', 2);

CREATE TABLE "password_resets" (
  "email" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "token" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL

);
CREATE TABLE "pass_types" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "concession_provider_master_id" integer NOT NULL,
  "pass_type_master_id" integer NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "amount" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "info_message" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "validity_message" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "accept_gender" enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  "accept_age" enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  "accept_age_from" integer DEFAULT NULL,
  "accept_age_to" integer NOT NULL,
  "accept_spouse_age" enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  "accept_spouse_age_from" integer NOT NULL,
  "accept_spouse_age_to" integer NOT NULL,
  "accept_id_number" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "pass_types" VALUES(1, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 1, '2018-02-06 07:23:51', '2018-02-06 07:23:51');
INSERT INTO "pass_types" VALUES(2, 1, 1, 1, 1, 'Description', 'Short Description', 'Amount', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'No', 12, 23, 'No', 2, '2018-02-06 23:53:44', '2018-02-06 23:53:44');
INSERT INTO "pass_types" VALUES(3, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 3, '2018-02-07 04:34:06', '2018-02-07 04:34:06');

CREATE TABLE "pass_type_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "service_id" integer UNSIGNED NOT NULL,
  "concession_provider_master_id" integer NOT NULL,
  "pass_type_master_id" integer NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "amount" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "info_message" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "validity_message" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "accept_gender" enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  "accept_age" enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  "accept_age_from" integer DEFAULT NULL,
  "accept_age_to" integer NOT NULL,
  "accept_spouse_age" enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  "accept_spouse_age_from" integer NOT NULL,
  "accept_spouse_age_to" integer NOT NULL,
  "accept_id_number" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "pass_type_logs" VALUES(1, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 1, '2018-02-06 07:23:51', '2018-02-06 07:23:51');
INSERT INTO "pass_type_logs" VALUES(2, 1, 1, 1, 1, 'Description', 'Short Description', 'Amount', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'No', 12, 23, 'No', 2, '2018-02-06 23:53:44', '2018-02-06 23:53:44');
INSERT INTO "pass_type_logs" VALUES(3, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 3, '2018-02-07 04:34:06', '2018-02-07 04:34:06');
INSERT INTO "pass_type_logs" VALUES(4, 1, 1, 1, 1, 'Description', 'Short Description', '12', '334', 'Validity Message', 'Yes', 'Yes', 12, 20, 'Yes', 12, 23, 'No', 1, '2018-02-06 07:23:51', NULL);

CREATE TABLE "pass_type_masters" (
  "id" integer UNSIGNED NOT NULL,
  "name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL

);
INSERT INTO "pass_type_masters" VALUES(1, 'P1');
INSERT INTO "pass_type_masters" VALUES(2, 'P2');

CREATE TABLE "payout_reasons" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "payout_reason" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_reason" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "reason_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "payout_reasons" VALUES(1, 1, 'Payout Reason2', 'Short Reason', 'Reason Description', 1, '2018-02-05 00:20:40', '2018-03-05 05:12:05');
INSERT INTO "payout_reasons" VALUES(2, 1, 'Payout Reason1', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', '2018-03-05 05:13:08');
INSERT INTO "payout_reasons" VALUES(3, 1, 'Payout Reason3', 'Short Reason3', 'Reason Description3', 3, '2018-02-05 00:23:30', '2018-02-05 00:25:10');

CREATE TABLE "payout_reason_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "payout_reason" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_reason" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "reason_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "payout_reason_logs" VALUES(1, 1, 'Payout Reason1', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', NULL);
INSERT INTO "payout_reason_logs" VALUES(2, 1, 'Payout Reason', 'Short Reason3', 'Reason Description3', 3, '2018-02-05 00:23:30', NULL);
INSERT INTO "payout_reason_logs" VALUES(3, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL);
INSERT INTO "payout_reason_logs" VALUES(4, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL);
INSERT INTO "payout_reason_logs" VALUES(5, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL);
INSERT INTO "payout_reason_logs" VALUES(6, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 1, '2018-02-05 00:23:15', NULL);
INSERT INTO "payout_reason_logs" VALUES(7, 1, 'Payout Reason3', 'Short Reason3', 'Reason Description3', 2, '2018-02-05 00:23:30', NULL);
INSERT INTO "payout_reason_logs" VALUES(8, 1, 'Payout Reason', 'Short Reason', 'Reason Description', 1, '2018-02-05 00:20:40', NULL);
INSERT INTO "payout_reason_logs" VALUES(9, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', NULL);
INSERT INTO "payout_reason_logs" VALUES(10, 1, 'Payout Reason2', 'Short Reason2', 'Reason Description2', 2, '2018-02-05 00:23:15', NULL);

CREATE TABLE "permissions" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "users" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "role" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "changepasswords" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "permissions" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "depots" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "bus_types" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "services" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "vehicles" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "shifts" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "stops" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "routes" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "duties" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "targets" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "trips" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "fares" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concession_fare_slabs" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concessions" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "trip_cancellation_reasons" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "inspector_remarks" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "payout_reasons" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "denominations" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "pass_types" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "crew_details" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "ETM_details" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "view" varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "permissions" VALUES(8, '5', 'users,create,edit,view', 'Admin', 'description', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-01-15 00:30:23', '2018-03-08 04:01:50');
INSERT INTO "permissions" VALUES(12, '1', 'users,create,edit,view', 'Conductor', 'description', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-12 03:51:00');
INSERT INTO "permissions" VALUES(13, '1', 'users,create,edit,view', 'Depot Master', 'description', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-15 00:43:55');

CREATE TABLE "permission_details" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_by" integer NOT NULL,
  "users" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "role_id" integer DEFAULT NULL,
  "changepasswords" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "permissions" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "depots" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "bus_types" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "services" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "vehicles" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "shifts" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "stops" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "routes" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "duties" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "targets" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "trips" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "fares" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concession_fare_slabs" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concessions" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "trip_cancellation_reasons" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "inspector_remarks" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "payout_reasons" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "denominations" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "pass_types" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "crew_details" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "ETM_details" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "view" varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "permission_details" VALUES(8, '5', 1, 'users,create,edit,view', 13, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-01-15 00:30:23', '2018-03-08 04:01:50');
INSERT INTO "permission_details" VALUES(12, '2', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-13 23:53:15');
INSERT INTO "permission_details" VALUES(13, '1', 1, 'users,create,edit,view', 12, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'trips,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-25 04:23:40', '2018-03-21 06:20:59');
INSERT INTO "permission_details" VALUES(17, '20', 1, 'users,create,edit,view', 13, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details', 'ETM_details,create,edit,view', NULL, '2018-03-13 05:06:34', '2018-03-14 05:34:18');
INSERT INTO "permission_details" VALUES(18, '21', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details', 'ETM_details,create,edit,view', NULL, '2018-03-13 23:54:39', '2018-03-13 23:56:46');
INSERT INTO "permission_details" VALUES(19, '22', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-03-14 03:36:17', '2018-03-14 03:36:17');
INSERT INTO "permission_details" VALUES(20, '23', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'crew_details', 'view', NULL, '2018-03-14 05:17:13', '2018-03-14 05:19:28');
INSERT INTO "permission_details" VALUES(21, '24', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'crew_details', 'view', NULL, '2018-03-14 05:20:16', '2018-03-14 05:31:48');
INSERT INTO "permission_details" VALUES(22, '25', 1, 'users,create,edit,view', 8, 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', '', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-03-14 05:53:01', '2018-03-14 05:53:01');

CREATE TABLE "roles" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "users" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "role" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "changepasswords" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "permissions" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "depots" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "bus_types" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "services" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "vehicles" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "shifts" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "stops" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "routes" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "duties" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "targets" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "fares" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concession_fare_slabs" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "concessions" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "trip_cancellation_reasons" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "inspector_remarks" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "payout_reasons" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "denominations" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "pass_types" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "crew_details" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "ETM_details" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "view" varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "roles" VALUES(8, '5', 'users,create,edit,view', '0', '', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,view', 'bus_types,create,edit,view', 'view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', 'view', NULL, '2018-01-15 00:30:23', '2018-03-08 04:01:50');
INSERT INTO "roles" VALUES(9, '1', 'users,create,edit,view', '0', '', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reasons,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominations,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', 'ETM_details,create,edit,view', NULL, '2018-01-15 00:32:12', '2018-03-06 03:17:51');
INSERT INTO "roles" VALUES(10, '6', 'users,create,edit,view', '0', '', 'changepasswords,create,edit,view', 'permissions,create,edit,view', 'depots,create,edit,view', 'bus_types,create,edit,view', 'services,create,edit,view', 'vehicles,create,edit,view', 'shifts,create,edit,view', 'stops,create,edit,view', 'routes,create,edit,view', 'duties,create,edit,view', 'targets,create,edit,view', 'fares,create,edit,view', 'concession_fare_slabs,create,edit,view', 'concessions,create,edit,view', 'trip_cancellation_reason,create,edit,view', 'inspector_remarks,create,edit,view', 'payout_reasons,create,edit,view', 'denominatios,create,edit,view', 'pass_types,create,edit,view', 'crew_details,create,edit,view', '', NULL, '2018-01-25 04:23:40', '2018-01-25 04:23:40');
INSERT INTO "roles" VALUES(11, '1', 'users,create,edit,view', 'Depot Master', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-09 03:27:11', '2018-03-09 03:27:11');

CREATE TABLE "routes" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "source" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "destination" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "via" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "direction" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "default_path" enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  "stop_id" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "stage_number" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "distance" varchar(202) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "hot_key" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "is_this_by" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "routes" VALUES(24, 1, '63', '1', '3', '1', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', '2018-02-27 03:41:05');
INSERT INTO "routes" VALUES(25, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', '2018-02-27 03:28:02');
INSERT INTO "routes" VALUES(26, 1, '65', '1', '1', '1', 'Down', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 03:39:15', '2018-02-27 05:23:11');
INSERT INTO "routes" VALUES(27, 1, '68', '1', '3', '9', 'Up', NULL, NULL, NULL, NULL, NULL, 'No', '2018-02-28 07:18:08', '2018-02-28 07:18:08');
INSERT INTO "routes" VALUES(28, 1, '651', '1', '2', '2', 'Down', NULL, NULL, NULL, NULL, NULL, 'Yes', '2018-03-01 00:44:01', '2018-03-01 00:44:01');
INSERT INTO "routes" VALUES(29, 1, '651', '2', '3', '4', 'Up', NULL, NULL, NULL, NULL, NULL, 'Yes', '2018-03-01 00:48:59', '2018-03-01 00:48:59');
INSERT INTO "routes" VALUES(30, 1, '70', '1', '9', '15', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-03-07 00:51:12', '2018-03-07 01:16:40');
INSERT INTO "routes" VALUES(31, 1, '12345', '12', '6', '11', 'Up', 'Yes', NULL, NULL, NULL, NULL, NULL, '2018-07-10 14:30:13', '2018-07-10 14:30:13');

CREATE TABLE "route_details" (
  "id" integer UNSIGNED NOT NULL,
  "route_id" integer UNSIGNED NOT NULL,
  "stop_id" integer NOT NULL,
  "stage_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "distance" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "hot_key" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "is_this_by" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "route_details" VALUES(32, 651, 5, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(33, 25, 5, '2', '2', '2', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(39, 24, 1, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(40, 24, 1, '2', '2', '2', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(41, 24, 2, '3', '3', '3', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(42, 24, 10, '4', '4', '4', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(43, 651, 11, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(44, 651, 10, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(45, 27, 1, '1', '3', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(46, 27, 8, '2', '5', '2', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(47, 28, 8, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(48, 29, 7, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(63, 30, 13, '1', '1', '1', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(64, 30, 14, '2', '2', '2', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(65, 30, 15, '3', '3', '3', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(66, 30, 16, '4', '4', '4', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(67, 30, 17, '5', '5', '5', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(68, 30, 18, '6', '6', '6', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(69, 30, 19, '7', '7', '7', NULL, NULL, NULL);
INSERT INTO "route_details" VALUES(70, 31, 12, '1', '2', '3', 'Y', NULL, NULL);
INSERT INTO "route_details" VALUES(71, 31, 13, '2', '2', '2', 'e', NULL, NULL);

CREATE TABLE "route_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "source" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "destination" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "via" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "direction" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "default_path" enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  "stop_id" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "stage_number" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "distance" varchar(202) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "hot_key" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "is_this_by" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "route_logs" VALUES(24, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', '2018-02-27 01:09:38');
INSERT INTO "route_logs" VALUES(25, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', '2018-02-27 01:53:31');
INSERT INTO "route_logs" VALUES(26, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(27, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(28, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(29, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(30, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(31, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(32, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(33, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(34, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(35, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(36, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(37, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(38, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(39, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(40, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(41, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(42, 1, '63', '1', '3', '4', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(43, 1, '64', '1', '2', '2', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-27 01:14:01', NULL);
INSERT INTO "route_logs" VALUES(44, 1, '63', '1', '3', '1', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(45, 1, '63', '1', '3', '1', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-02-26 06:52:36', NULL);
INSERT INTO "route_logs" VALUES(46, 1, '65', '1', '1', '1', 'Down', 'Yes', NULL, NULL, NULL, NULL, 'Yes', '2018-02-27 03:39:15', NULL);
INSERT INTO "route_logs" VALUES(47, 1, '70', '1', '9', '15', 'Up', 'Yes', NULL, NULL, NULL, NULL, 'Yes', '2018-03-07 00:51:12', NULL);
INSERT INTO "route_logs" VALUES(48, 1, '70', '1', '9', '15', 'Up', 'Yes', '', '', 'Array', '', 'Yes', '2018-03-07 00:51:12', NULL);

CREATE TABLE "services" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "bus_type_id" integer NOT NULL,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "services" VALUES(1, 1, 1, 'A-G-Holidays ', 'Express ', 5, '2017-12-27 23:20:45', '2018-02-02 05:07:57');
INSERT INTO "services" VALUES(6, 1, 1, 'C-G-Holidays1', 'AT', 3, '2017-12-27 23:20:45', '2018-02-21 23:26:18');
INSERT INTO "services" VALUES(7, 1, 1, 'BSR-Travels', 'BT', 2, '2017-12-28 01:01:05', '2018-01-31 04:14:40');
INSERT INTO "services" VALUES(14, 1, 1, 'C-G-Holidays ', 'Short Name', 4, '2018-02-21 07:05:17', '2018-02-21 07:05:17');
INSERT INTO "services" VALUES(15, 1, 1, ' 	C-G-Holidays', '3', 6, '2018-02-28 06:45:45', '2018-02-28 06:45:45');
INSERT INTO "services" VALUES(16, 1, 1, 'C-G-Holidays123', '1', 1, '2018-02-28 06:57:31', '2018-02-28 06:57:31');

CREATE TABLE "service_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "bus_type_id" integer NOT NULL,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "service_logs" VALUES(1, 1, 1, 'A-G-Holidays ', 'Express ', 2, '2017-12-27 23:20:45', '2018-02-02 05:07:57');
INSERT INTO "service_logs" VALUES(6, 1, 1, 'Aadithya-Travels ', 'AT', 5, '2017-12-27 23:20:45', '2018-02-08 00:25:20');
INSERT INTO "service_logs" VALUES(7, 1, 1, 'BSR-Travels', 'BT', 4, '2017-12-28 01:01:05', '2018-01-31 04:14:40');
INSERT INTO "service_logs" VALUES(8, 1, 2, 'Express bus service', 'EX', 3, '2018-01-04 05:49:05', '2018-01-31 04:13:15');
INSERT INTO "service_logs" VALUES(9, 1, 1, 'Delux', 'Sahadara', 6, '2018-02-01 06:26:45', '2018-02-08 00:25:43');
INSERT INTO "service_logs" VALUES(10, 1, 1, 'Sahadara1', '2323', 7, '2018-02-21 05:46:05', '2018-02-21 05:46:05');
INSERT INTO "service_logs" VALUES(11, 1, 1, 'A-G-Holidays', 'Short Name', 8, '2018-02-21 06:22:50', '2018-02-21 06:22:50');
INSERT INTO "service_logs" VALUES(12, 1, 1, 'Service Name', 'Short Name', 1, '2018-02-21 06:35:14', '2018-02-21 06:35:14');
INSERT INTO "service_logs" VALUES(13, 1, 1, 'A-G-Holidays1', 'Short Name', 9, '2018-02-21 06:53:02', '2018-02-21 06:53:02');
INSERT INTO "service_logs" VALUES(14, 1, 1, 'Aadithya-Travels ', 'AT', 4, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(15, 1, 1, 'C-G-Holidays ', 'Short Name', 1, '2018-02-21 07:05:17', NULL);
INSERT INTO "service_logs" VALUES(16, 1, 1, 'Aadithya-Travels ', 'AT', 4, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(17, 1, 1, 'C-G-Holidays', 'AT', 4, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(18, 1, 1, 'C-G-Holidays', 'AT', 4, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(19, 1, 1, 'C-G-Holidays ', 'Short Name', 1, '2018-02-21 07:05:17', NULL);
INSERT INTO "service_logs" VALUES(20, 1, 1, 'C-G-Holidays ', 'Short Name', 1, '2018-02-21 07:05:17', NULL);
INSERT INTO "service_logs" VALUES(21, 1, 1, 'BSR-Travels', 'BT', 3, '2017-12-28 01:01:05', NULL);
INSERT INTO "service_logs" VALUES(22, 1, 1, 'C-G-Holidays1', 'AT', 4, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(23, 1, 1, 'A-G-Holidays ', 'Express ', 3, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(24, 1, 1, 'C-G-Holidays ', 'Short Name', 2, '2018-02-21 07:05:17', NULL);
INSERT INTO "service_logs" VALUES(25, 1, 1, 'C-G-Holidays1', 'AT', 1, '2017-12-27 23:20:45', NULL);
INSERT INTO "service_logs" VALUES(26, 1, 1, 'C-G-Holidays1', 'AT', 1, '2017-12-27 23:20:45', NULL);

CREATE TABLE "settings" (
  "id" integer UNSIGNED NOT NULL,
  "task_complete_allowed" integer NOT NULL,
  "task_assign_allowed" integer NOT NULL,
  "lead_complete_allowed" integer NOT NULL,
  "lead_assign_allowed" integer NOT NULL,
  "time_change_allowed" integer NOT NULL,
  "comment_allowed" integer NOT NULL,
  "country" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "company" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "settings" VALUES(1, 2, 2, 2, 2, 2, 2, '', 'Media', NULL, NULL);

CREATE TABLE "shifts" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "shift" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abbreviation" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "start_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "end_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "system_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "shifts" VALUES(14, 1, 'Morning', 'MN', '05:30', '12:00', '1', '123', '2018-07-02 14:47:00', '2018-07-02 14:47:00');
INSERT INTO "shifts" VALUES(15, 1, 'After Noon', 'AN', '12:00', '04:00', '2', '1234', '2018-07-02 14:47:34', '2018-07-02 14:47:34');
INSERT INTO "shifts" VALUES(16, 1, 'Evening', 'EN', '04:00', '08:00', '3', '12345', '2018-07-02 14:47:57', '2018-07-02 14:47:57');
INSERT INTO "shifts" VALUES(17, 1, 'Night', 'NT', '08:00', '12:00', '4', '321', '2018-07-02 14:48:15', '2018-07-02 14:48:15');

CREATE TABLE "shift_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "shift" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abbreviation" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "start_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "end_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "system_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "shift_logs" VALUES(5, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '3', '10-11', '2018-01-04 06:09:18', '2018-02-23 05:34:44');
INSERT INTO "shift_logs" VALUES(6, 1, 'Day', 'Abbreviation', '12:36 PM', '20:36 PM', '2', '10-11', '2018-01-04 06:33:13', '2018-01-05 04:04:57');
INSERT INTO "shift_logs" VALUES(7, 1, 'After Noon', 'AN', '12:36 PM', '20:36 PM', '4', '10-11', '2018-01-04 07:23:47', '2018-01-04 07:23:47');
INSERT INTO "shift_logs" VALUES(13, 1, 'Matiny', 'Abbreviation', '10', '20', '1', '12', '2018-02-23 05:34:32', '2018-02-23 05:34:32');
INSERT INTO "shift_logs" VALUES(14, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '3', '10-11', '2018-01-04 06:09:18', NULL);
INSERT INTO "shift_logs" VALUES(15, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '3', '10-11', '2018-01-04 06:09:18', NULL);
INSERT INTO "shift_logs" VALUES(16, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '5', '10-11', '2018-01-04 06:09:18', NULL);
INSERT INTO "shift_logs" VALUES(17, 1, 'Day', 'Abbreviation', '12:36 PM', '20:36 PM', '2', '10-11', '2018-01-04 06:33:13', NULL);
INSERT INTO "shift_logs" VALUES(18, 1, 'Night', 'Abbreviation', '12:36 PM', '16:36 PM', '4', '10-11', '2018-01-04 06:09:18', NULL);
INSERT INTO "shift_logs" VALUES(19, 1, 'Matiny', 'Abbreviation', '10', '20', '2', '12', '2018-02-23 05:34:32', NULL);

CREATE TABLE "shift_start" (
  "id" integer NOT NULL,
  "conductor_id" integer DEFAULT NULL,
  "vehicle_id" integer DEFAULT NULL,
  "route_id" integer DEFAULT NULL,
  "shift_id" integer DEFAULT NULL,
  "driver_id" integer DEFAULT NULL,
  "duty_id" integer DEFAULT NULL,
  "odo_reading" varchar(20) DEFAULT NULL,
  "start_timestamp" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "updated_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);
INSERT INTO "shift_start" VALUES(1, 1, 1, 1, 1, 1, 1, '1212', '2018-06-17 23:39:10', '2018-06-18 06:09:38', '2018-06-18 06:09:38');
INSERT INTO "shift_start" VALUES(2, 1, 1, 1, 1, 1, 1, '1212', '2018-06-18 05:09:10', '2018-06-18 11:45:17', '2018-06-18 11:45:17');
INSERT INTO "shift_start" VALUES(3, 1, 1, 1, 1, 1, 1, '1212', '2018-06-18 05:09:10', '2018-06-18 11:47:35', '2018-06-18 11:47:35');
INSERT INTO "shift_start" VALUES(4, 88, 77, 55, 44, 66, 22, '33', '2018-06-18 05:05:05', '2018-06-18 12:28:19', '2018-06-18 12:28:19');
INSERT INTO "shift_start" VALUES(5, 88, 77, 55, 44, 66, 22, '33', '2018-06-18 10:10:10', '2018-06-18 12:34:48', '2018-06-18 12:34:48');
INSERT INTO "shift_start" VALUES(6, 88, 77, 55, 44, 66, 22, '33', '2018-06-18 10:10:10', '2018-06-18 12:37:42', '2018-06-18 12:37:42');
INSERT INTO "shift_start" VALUES(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:36:38', '2018-06-19 05:36:38');
INSERT INTO "shift_start" VALUES(8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:36:52', '2018-06-19 05:36:52');
INSERT INTO "shift_start" VALUES(9, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:38:39', '2018-06-19 05:38:39');
INSERT INTO "shift_start" VALUES(10, 88, 77, NULL, NULL, 66, NULL, NULL, NULL, '2018-06-19 05:40:36', '2018-06-19 05:40:36');
INSERT INTO "shift_start" VALUES(11, 88, 77, 55, 44, 66, NULL, NULL, NULL, '2018-06-19 05:41:42', '2018-06-19 05:41:42');
INSERT INTO "shift_start" VALUES(12, 88, 77, 55, 44, 66, NULL, NULL, NULL, '2018-06-19 05:42:53', '2018-06-19 05:42:53');
INSERT INTO "shift_start" VALUES(13, 88, 77, 55, 44, 66, 22, '33', NULL, '2018-06-19 06:15:15', '2018-06-19 06:15:15');
INSERT INTO "shift_start" VALUES(14, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:27:50', '2018-06-19 06:27:50');
INSERT INTO "shift_start" VALUES(15, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:28:27', '2018-06-19 06:28:27');
INSERT INTO "shift_start" VALUES(16, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:41:26', '2018-06-19 06:41:26');
INSERT INTO "shift_start" VALUES(17, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:50:20', '2018-06-19 06:50:20');
INSERT INTO "shift_start" VALUES(18, 2222, 22, 44, 55, 33, 77, '66', NULL, '2018-06-19 06:54:50', '2018-06-19 06:54:50');
INSERT INTO "shift_start" VALUES(19, 6666, 1, 44, 55, 333333, 77, '66', NULL, '2018-06-19 07:06:47', '2018-06-19 07:06:47');
INSERT INTO "shift_start" VALUES(20, 1111, 2, 44, 55, 444444, 77, '66', NULL, '2018-06-19 07:18:23', '2018-06-19 07:18:23');
INSERT INTO "shift_start" VALUES(21, 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:20:10', '2018-06-19 08:20:10');
INSERT INTO "shift_start" VALUES(22, 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:20:33', '2018-06-19 08:20:33');
INSERT INTO "shift_start" VALUES(23, 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:20:59', '2018-06-19 08:20:59');
INSERT INTO "shift_start" VALUES(24, NULL, 77, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 08:26:46', '2018-06-19 08:26:46');
INSERT INTO "shift_start" VALUES(25, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 10:21:03', '2018-06-19 10:21:03');
INSERT INTO "shift_start" VALUES(26, 1, 2, 4, 1, 3, 4, '9999999990', NULL, '2018-06-19 11:08:39', '2018-06-19 11:08:39');
INSERT INTO "shift_start" VALUES(27, 1, 2, 2, 2, 3, 3, '9876543210', NULL, '2018-06-19 11:12:03', '2018-06-19 11:12:03');
INSERT INTO "shift_start" VALUES(28, 6, 7, 5, 2, 4, 4, '9988665533', NULL, '2018-06-19 16:51:00', '2018-06-19 16:51:00');
INSERT INTO "shift_start" VALUES(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:05:05', '2018-06-19 16:52:39', '2018-06-19 16:52:39');
INSERT INTO "shift_start" VALUES(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 05:05:00', '2018-06-19 16:54:20', '2018-06-19 16:54:20');
INSERT INTO "shift_start" VALUES(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 00:00:00', '2018-06-19 16:54:29', '2018-06-19 16:54:29');
INSERT INTO "shift_start" VALUES(32, 4, 5, 4, 2, 5, 4, '9876543210', NULL, '2018-06-21 17:18:21', '2018-06-21 17:18:21');
INSERT INTO "shift_start" VALUES(33, 6, 8, 4, 1, 1, 2, '9876543210', NULL, '2018-06-21 17:21:29', '2018-06-21 17:21:29');
INSERT INTO "shift_start" VALUES(34, 1, 1, 2, 1, 3, 2, '9876543210', NULL, '2018-06-21 17:27:15', '2018-06-21 17:27:15');
INSERT INTO "shift_start" VALUES(35, 1, 4, 2, 2, 4, 3, '9876543210', NULL, '2018-06-21 17:56:31', '2018-06-21 17:56:31');
INSERT INTO "shift_start" VALUES(36, 8, 1, 2, 1, 2, 3, '9876543210', NULL, '2018-06-21 18:05:49', '2018-06-21 18:05:49');
INSERT INTO "shift_start" VALUES(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-19 00:00:00', '2018-06-21 18:06:52', '2018-06-21 18:06:52');
INSERT INTO "shift_start" VALUES(38, 1, 2, 4, 2, 1, 1, '9876543210', NULL, '2018-06-21 18:14:09', '2018-06-21 18:14:09');
INSERT INTO "shift_start" VALUES(39, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 10:36:06', '2018-06-22 10:36:06');
INSERT INTO "shift_start" VALUES(40, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 10:37:50', '2018-06-22 10:37:50');
INSERT INTO "shift_start" VALUES(41, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 10:39:48', '2018-06-22 10:39:48');
INSERT INTO "shift_start" VALUES(42, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 11:01:19', '2018-06-22 11:01:19');
INSERT INTO "shift_start" VALUES(43, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 11:01:52', '2018-06-22 11:01:52');
INSERT INTO "shift_start" VALUES(44, 3, 4, 3, 1, 4, 4, '9876543210', NULL, '2018-06-22 11:03:47', '2018-06-22 11:03:47');
INSERT INTO "shift_start" VALUES(45, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:14:29', '2018-06-22 16:14:29');
INSERT INTO "shift_start" VALUES(46, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:15:05', '2018-06-22 16:15:05');
INSERT INTO "shift_start" VALUES(47, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:18:06', '2018-06-22 16:18:06');
INSERT INTO "shift_start" VALUES(48, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-22 16:19:06', '2018-06-22 16:19:06');
INSERT INTO "shift_start" VALUES(49, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-25 12:06:47', '2018-06-25 12:06:47');
INSERT INTO "shift_start" VALUES(50, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-25 12:07:17', '2018-06-25 12:07:17');
INSERT INTO "shift_start" VALUES(51, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-26 12:22:03', '2018-06-26 12:22:03');
INSERT INTO "shift_start" VALUES(52, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-26 17:51:02', '2018-06-26 17:51:02');
INSERT INTO "shift_start" VALUES(53, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-27 12:36:48', '2018-06-27 12:36:48');
INSERT INTO "shift_start" VALUES(54, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-28 11:45:32', '2018-06-28 11:45:32');
INSERT INTO "shift_start" VALUES(55, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-28 11:46:57', '2018-06-28 11:46:57');
INSERT INTO "shift_start" VALUES(56, 11, 22, 44, 55, 33, 77, '66', NULL, '2018-06-28 11:48:55', '2018-06-28 11:48:55');
INSERT INTO "shift_start" VALUES(57, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-06-28 11:50:39', '2018-06-28 11:50:39');
INSERT INTO "shift_start" VALUES(58, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-06-29 13:08:39', '2018-06-29 13:08:39');
INSERT INTO "shift_start" VALUES(59, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 14:15:41', '2018-07-02 14:15:41');
INSERT INTO "shift_start" VALUES(60, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:01:51', '2018-07-02 15:01:51');
INSERT INTO "shift_start" VALUES(61, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:20:01', '2018-07-02 15:20:01');
INSERT INTO "shift_start" VALUES(62, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:22:39', '2018-07-02 15:22:39');
INSERT INTO "shift_start" VALUES(63, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:25:00', '2018-07-02 15:25:00');
INSERT INTO "shift_start" VALUES(64, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:27:29', '2018-07-02 15:27:29');
INSERT INTO "shift_start" VALUES(65, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:32:39', '2018-07-02 15:32:39');
INSERT INTO "shift_start" VALUES(66, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:32:46', '2018-07-02 15:32:46');
INSERT INTO "shift_start" VALUES(67, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:32:51', '2018-07-02 15:32:51');
INSERT INTO "shift_start" VALUES(68, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:33:28', '2018-07-02 15:33:28');
INSERT INTO "shift_start" VALUES(69, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:34:26', '2018-07-02 15:34:26');
INSERT INTO "shift_start" VALUES(70, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:44:50', '2018-07-02 15:44:50');
INSERT INTO "shift_start" VALUES(71, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:46:06', '2018-07-02 15:46:06');
INSERT INTO "shift_start" VALUES(72, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:47:33', '2018-07-02 15:47:33');
INSERT INTO "shift_start" VALUES(73, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:48:48', '2018-07-02 15:48:48');
INSERT INTO "shift_start" VALUES(74, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 15:58:30', '2018-07-02 15:58:30');
INSERT INTO "shift_start" VALUES(75, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 16:03:26', '2018-07-02 16:03:26');
INSERT INTO "shift_start" VALUES(76, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-02 16:05:40', '2018-07-02 16:05:40');
INSERT INTO "shift_start" VALUES(77, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 11:30:13', '2018-07-03 11:30:13');
INSERT INTO "shift_start" VALUES(78, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 11:36:00', '2018-07-03 11:36:00');
INSERT INTO "shift_start" VALUES(79, 5, 12, 26, 13, 6, 1, '9876543210', NULL, '2018-07-03 11:46:48', '2018-07-03 11:46:48');
INSERT INTO "shift_start" VALUES(80, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:10:00', '2018-07-03 12:10:00');
INSERT INTO "shift_start" VALUES(81, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:12:12', '2018-07-03 12:12:12');
INSERT INTO "shift_start" VALUES(82, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:13:11', '2018-07-03 12:13:11');
INSERT INTO "shift_start" VALUES(83, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 12:59:32', '2018-07-03 12:59:32');
INSERT INTO "shift_start" VALUES(84, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:27', '2018-07-03 13:13:27');
INSERT INTO "shift_start" VALUES(85, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:34', '2018-07-03 13:13:34');
INSERT INTO "shift_start" VALUES(86, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:40', '2018-07-03 13:13:40');
INSERT INTO "shift_start" VALUES(87, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:52', '2018-07-03 13:13:52');
INSERT INTO "shift_start" VALUES(88, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:13:59', '2018-07-03 13:13:59');
INSERT INTO "shift_start" VALUES(89, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 13:58:30', '2018-07-03 13:58:30');
INSERT INTO "shift_start" VALUES(90, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 14:04:05', '2018-07-03 14:04:05');
INSERT INTO "shift_start" VALUES(91, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 14:29:05', '2018-07-03 14:29:05');
INSERT INTO "shift_start" VALUES(92, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 15:27:24', '2018-07-03 15:27:24');
INSERT INTO "shift_start" VALUES(93, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 16:46:51', '2018-07-03 16:46:51');
INSERT INTO "shift_start" VALUES(94, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 16:47:04', '2018-07-03 16:47:04');
INSERT INTO "shift_start" VALUES(95, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 16:48:13', '2018-07-03 16:48:13');
INSERT INTO "shift_start" VALUES(96, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:43:55', '2018-07-03 17:43:55');
INSERT INTO "shift_start" VALUES(97, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:51:36', '2018-07-03 17:51:36');
INSERT INTO "shift_start" VALUES(98, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:56:10', '2018-07-03 17:56:10');
INSERT INTO "shift_start" VALUES(99, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:57:12', '2018-07-03 17:57:12');
INSERT INTO "shift_start" VALUES(100, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:58:08', '2018-07-03 17:58:08');
INSERT INTO "shift_start" VALUES(101, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-03 17:59:35', '2018-07-03 17:59:35');
INSERT INTO "shift_start" VALUES(102, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:28:46', '2018-07-04 10:28:46');
INSERT INTO "shift_start" VALUES(103, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:29:59', '2018-07-04 10:29:59');
INSERT INTO "shift_start" VALUES(104, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:31:29', '2018-07-04 10:31:29');
INSERT INTO "shift_start" VALUES(105, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:34:20', '2018-07-04 10:34:20');
INSERT INTO "shift_start" VALUES(106, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:35:46', '2018-07-04 10:35:46');
INSERT INTO "shift_start" VALUES(107, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:37:01', '2018-07-04 10:37:01');
INSERT INTO "shift_start" VALUES(108, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:38:01', '2018-07-04 10:38:01');
INSERT INTO "shift_start" VALUES(109, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:39:27', '2018-07-04 10:39:27');
INSERT INTO "shift_start" VALUES(110, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:41:54', '2018-07-04 10:41:54');
INSERT INTO "shift_start" VALUES(111, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:43:03', '2018-07-04 10:43:03');
INSERT INTO "shift_start" VALUES(112, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:44:23', '2018-07-04 10:44:23');
INSERT INTO "shift_start" VALUES(113, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:45:30', '2018-07-04 10:45:30');
INSERT INTO "shift_start" VALUES(114, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:46:24', '2018-07-04 10:46:24');
INSERT INTO "shift_start" VALUES(115, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:47:25', '2018-07-04 10:47:25');
INSERT INTO "shift_start" VALUES(116, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 10:49:30', '2018-07-04 10:49:30');
INSERT INTO "shift_start" VALUES(117, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 11:04:14', '2018-07-04 11:04:14');
INSERT INTO "shift_start" VALUES(118, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 11:07:47', '2018-07-04 11:07:47');
INSERT INTO "shift_start" VALUES(119, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-04 11:54:28', '2018-07-04 11:54:28');
INSERT INTO "shift_start" VALUES(120, 5, 12, 26, 6, 6, 1, '9090909090', NULL, '2018-07-05 16:22:18', '2018-07-05 16:22:18');
INSERT INTO "shift_start" VALUES(121, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-05 17:56:03', '2018-07-05 17:56:03');
INSERT INTO "shift_start" VALUES(122, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:22:26', '2018-07-06 10:22:26');
INSERT INTO "shift_start" VALUES(123, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:39:44', '2018-07-06 10:39:44');
INSERT INTO "shift_start" VALUES(124, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:46:13', '2018-07-06 10:46:13');
INSERT INTO "shift_start" VALUES(125, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:50:26', '2018-07-06 10:50:26');
INSERT INTO "shift_start" VALUES(126, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 10:54:59', '2018-07-06 10:54:59');
INSERT INTO "shift_start" VALUES(127, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:03:21', '2018-07-06 11:03:21');
INSERT INTO "shift_start" VALUES(128, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:12:12', '2018-07-06 11:12:12');
INSERT INTO "shift_start" VALUES(129, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:15:54', '2018-07-06 11:15:54');
INSERT INTO "shift_start" VALUES(130, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:19:11', '2018-07-06 11:19:11');
INSERT INTO "shift_start" VALUES(131, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:26:16', '2018-07-06 11:26:16');
INSERT INTO "shift_start" VALUES(132, 101, 101, 101, 101, 101, 101, '101', NULL, '2018-07-06 11:59:58', '2018-07-06 11:59:58');
INSERT INTO "shift_start" VALUES(133, 5, 12, 28, 6, 6, 5, '9876543217', '2018-07-11 11:36:09', '2018-07-11 11:36:14', '2018-07-11 11:36:14');
INSERT INTO "shift_start" VALUES(134, 5, 12, 28, 6, 6, 4, '9898989898', '2018-07-11 11:38:15', '2018-07-11 11:38:23', '2018-07-11 11:38:23');
INSERT INTO "shift_start" VALUES(135, 5, 12, 28, 6, 6, 5, '9876543210', '2018-07-11 11:42:13', '2018-07-11 11:42:15', '2018-07-11 11:42:15');

CREATE TABLE "sqlite_db_name" (
  "id" integer NOT NULL,
  "name" varchar(264) NOT NULL,
  "created_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "updated_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);
INSERT INTO "sqlite_db_name" VALUES(1, 'data.sqlite', '2018-07-04 06:01:11', '2018-07-05 08:46:22');

CREATE TABLE "stops" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "stop" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "stop_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abbreviation" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "stops" VALUES(1, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', '2018-02-26 04:40:10');
INSERT INTO "stops" VALUES(2, 1, 'Dabari', '123', 'AN', 'AN', '2018-01-02 06:56:25', '2018-03-07 00:26:12');
INSERT INTO "stops" VALUES(3, 1, 'Nehru Palace', '2', 'NP', 'NP', '2018-01-02 23:40:02', '2018-02-26 04:40:17');
INSERT INTO "stops" VALUES(4, 1, 'Munirka', '6', 'Munirka', 'Munirka', '2018-01-04 06:37:33', '2018-02-26 04:42:14');
INSERT INTO "stops" VALUES(5, 1, 'Tilak Pull', '17', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', '2018-03-07 00:25:57');
INSERT INTO "stops" VALUES(6, 1, 'South Ex', '8', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', '2018-03-07 00:26:35');
INSERT INTO "stops" VALUES(7, 1, 'Badar pur Border', '15', 'Abbreviation', 'MH', '2018-01-05 04:05:14', '2018-03-07 00:25:18');
INSERT INTO "stops" VALUES(8, 1, 'Sadar Bazaar', '10', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', '2018-03-07 00:23:01');
INSERT INTO "stops" VALUES(9, 1, 'Rajendra Place', '12', 'AN', 'AN', '2018-01-08 06:17:05', '2018-03-07 00:23:17');
INSERT INTO "stops" VALUES(10, 1, 'Moti Bag', '11', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', '2018-03-07 00:23:09');
INSERT INTO "stops" VALUES(11, 1, 'Safdar jang', '3', 'KB', 'KB', '2018-01-30 05:56:48', '2018-03-07 00:24:47');
INSERT INTO "stops" VALUES(12, 1, 'AIIMs', '5', 'BV', 'BV', '2018-02-25 23:06:43', '2018-03-07 00:25:08');
INSERT INTO "stops" VALUES(13, 1, 'Dhuali Pyau', '18', 'DP', 'DP', '2018-03-07 00:28:19', '2018-03-07 00:28:19');
INSERT INTO "stops" VALUES(14, 1, 'Distic Center', '21', 'DC', 'DC', '2018-03-07 00:29:53', '2018-03-07 00:29:53');
INSERT INTO "stops" VALUES(15, 1, 'Tikal Nagar', '22', 'T N', 'T N', '2018-03-07 00:30:47', '2018-03-07 00:30:47');
INSERT INTO "stops" VALUES(16, 1, 'Subhash Nagar', '23', 'SN', 'SN', '2018-03-07 00:31:19', '2018-03-07 00:31:19');
INSERT INTO "stops" VALUES(17, 1, 'Tagor Garden', '24', 'T G', 'T G', '2018-03-07 00:32:27', '2018-03-07 00:32:27');
INSERT INTO "stops" VALUES(18, 1, 'Rajauri Garden', '25', 'R G', 'R G', '2018-03-07 00:33:08', '2018-03-07 00:33:08');
INSERT INTO "stops" VALUES(19, 1, 'Moti Nagar', '26', 'M N', 'M N', '2018-03-07 00:34:58', '2018-03-07 00:34:58');

CREATE TABLE "stop_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "stop" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "stop_id" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abbreviation" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "short_name" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "stop_logs" VALUES(1, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', '2018-01-02 23:39:08');
INSERT INTO "stop_logs" VALUES(2, 1, 'ANAND VIHAR', '123', 'AN', 'AN', '2018-01-02 06:56:25', '2018-01-03 00:10:04');
INSERT INTO "stop_logs" VALUES(3, 1, 'JANAK PURI WEST', '43123', 'JANAK PURI', 'JK', '2018-01-02 23:40:02', '2018-01-02 23:40:02');
INSERT INTO "stop_logs" VALUES(4, 1, 'DHAULA KUAN', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:37:33', '2018-01-04 06:37:33');
INSERT INTO "stop_logs" VALUES(5, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', '2018-01-04 06:44:45');
INSERT INTO "stop_logs" VALUES(6, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', '2018-01-04 07:24:03');
INSERT INTO "stop_logs" VALUES(7, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'MH', '2018-01-05 04:05:14', '2018-01-05 04:05:14');
INSERT INTO "stop_logs" VALUES(8, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', '2018-01-08 06:10:46');
INSERT INTO "stop_logs" VALUES(9, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', '2018-01-08 06:17:05');
INSERT INTO "stop_logs" VALUES(10, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', '2018-01-08 23:07:14');
INSERT INTO "stop_logs" VALUES(11, 1, 'kAROL BAG', '123', 'K', 'JK', '2018-01-30 05:56:48', '2018-01-30 05:56:48');
INSERT INTO "stop_logs" VALUES(12, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(13, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(14, 1, 'UTTAM NAGAR', '3232', 'UTTAM NAGAR', 'UN', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(15, 1, 'Uttm Nagar', '3232', 'UG', 'UG', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(16, 1, 'JANAK PURI WEST', '43123', 'JANAK PURI', 'JK', '2018-01-02 23:40:02', NULL);
INSERT INTO "stop_logs" VALUES(17, 1, 'DHAULA KUAN1', '32321', 'Abbreviation', 'Short Name', '2018-02-25 23:06:43', NULL);
INSERT INTO "stop_logs" VALUES(18, 1, 'Uttm Nagar', '3232', 'UN', 'UN', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(19, 1, 'Nehru Palace', '43123', 'NP', 'NP', '2018-01-02 23:40:02', NULL);
INSERT INTO "stop_logs" VALUES(20, 1, 'kAROL BAG', '123', 'K', 'JK', '2018-01-30 05:56:48', NULL);
INSERT INTO "stop_logs" VALUES(21, 1, 'DHAULA KUAN1', '32321', 'Abbreviation', 'Short Name', '2018-02-25 23:06:43', NULL);
INSERT INTO "stop_logs" VALUES(22, 1, 'DHAULA KUAN1', '32321', 'Abbreviation', 'Short Name', '2018-02-25 23:06:43', NULL);
INSERT INTO "stop_logs" VALUES(23, 1, 'DHAULA KUAN', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:37:33', NULL);
INSERT INTO "stop_logs" VALUES(24, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(25, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(26, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(27, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(28, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(29, 1, 'Munirka', '6', 'Munirka', 'Munirka', '2018-01-04 06:37:33', NULL);
INSERT INTO "stop_logs" VALUES(30, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', NULL);
INSERT INTO "stop_logs" VALUES(31, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(32, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(33, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(34, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(35, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(36, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(37, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(38, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(39, 1, 'Munirka', '6', 'Munirka', 'Munirka', '2018-01-04 06:37:33', NULL);
INSERT INTO "stop_logs" VALUES(40, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(41, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', NULL);
INSERT INTO "stop_logs" VALUES(42, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(43, 1, 'ANAND VIHAR', '4324343', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(44, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', NULL);
INSERT INTO "stop_logs" VALUES(45, 1, 'ANAND VIHAR', '123-1', 'AN', 'AN', '2018-01-08 06:17:05', NULL);
INSERT INTO "stop_logs" VALUES(46, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', NULL);
INSERT INTO "stop_logs" VALUES(47, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'Express bus service', '2018-01-08 06:10:46', NULL);
INSERT INTO "stop_logs" VALUES(48, 1, 'Moti Bag', '432434323', 'N. AC', 'Express bus service', '2018-01-08 23:07:14', NULL);
INSERT INTO "stop_logs" VALUES(49, 1, 'Rajendra Place', '1324', 'AN', 'AN', '2018-01-08 06:17:05', NULL);
INSERT INTO "stop_logs" VALUES(50, 1, 'ANAND VIHAR', '123', 'AN', 'AN', '2018-01-02 06:56:25', NULL);
INSERT INTO "stop_logs" VALUES(51, 1, 'ANAND VIHAR', '4324343', 'Abbreviation', 'MH', '2018-01-05 04:05:14', NULL);
INSERT INTO "stop_logs" VALUES(52, 1, 'Karol Bag', '3', 'KB', 'KB', '2018-01-30 05:56:48', NULL);
INSERT INTO "stop_logs" VALUES(53, 1, 'Basant Vihar', '5', 'BV', 'BV', '2018-02-25 23:06:43', NULL);
INSERT INTO "stop_logs" VALUES(54, 1, 'Badar pur Border', '4324343', 'Abbreviation', 'MH', '2018-01-05 04:05:14', NULL);
INSERT INTO "stop_logs" VALUES(55, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', NULL);
INSERT INTO "stop_logs" VALUES(56, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', NULL);
INSERT INTO "stop_logs" VALUES(57, 1, 'ANAND VIHAR', '123-1', 'Abbreviation', 'Express bus service', '2018-01-04 06:44:45', NULL);
INSERT INTO "stop_logs" VALUES(58, 1, 'ANAND VIHAR', '123', 'AN', 'AN', '2018-01-02 06:56:25', NULL);
INSERT INTO "stop_logs" VALUES(59, 1, 'Subhash Nagar', '8', 'Abbreviation', 'Express bus service', '2018-01-04 07:24:03', NULL);
INSERT INTO "stop_logs" VALUES(60, 1, 'Uttm Nagar', '1', 'UN', 'UN', '2018-01-02 06:53:52', NULL);

CREATE TABLE "targets" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route_id" integer UNSIGNED NOT NULL,
  "duty_id" integer NOT NULL,
  "shift_id" integer NOT NULL,
  "trip" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "epkm" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "income" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "incentive" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "driver_share" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "conductor_share" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "targets" VALUES(1, 1, 24, 3, 6, '6', '1200', '1200', '', '', '', '2018-02-28 03:34:05', '2018-02-28 03:34:47');
INSERT INTO "targets" VALUES(2, 1, 24, 3, 6, '23', '2322', '3', '', '', '', '2018-02-28 03:59:25', '2018-02-28 03:59:25');
INSERT INTO "targets" VALUES(3, 1, 24, 3, 6, 'qw', 'wq', 'qw', '', '', '', '2018-02-28 04:00:17', '2018-02-28 04:00:17');
INSERT INTO "targets" VALUES(4, 1, 24, 4, 6, 'wew', 'we', 'wee', 'we', '', '', '2018-02-28 04:02:46', '2018-02-28 04:08:18');
INSERT INTO "targets" VALUES(5, 1, 24, 1, 6, '1', '2', '221', '21', '2121', '21', '2018-02-28 05:04:54', '2018-02-28 05:04:54');

CREATE TABLE "target_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route_id" integer UNSIGNED NOT NULL,
  "duty_id" integer NOT NULL,
  "shift_id" integer NOT NULL,
  "trip" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "epkm" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "income" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "incentive" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "driver_share" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "conductor_share" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "target_logs" VALUES(1, 1, 24, 3, 6, '6', '1200', '1200', '', '', '', '2018-02-28 03:34:05', '2018-02-28 03:34:47');
INSERT INTO "target_logs" VALUES(2, 1, 24, 1, 6, 'wew', 'we', 'wee', 'we', '', '', '2018-02-28 04:02:46', NULL);
INSERT INTO "target_logs" VALUES(3, 1, 24, 4, 6, 'wew', 'we', 'wee', 'we', '', '', '2018-02-28 04:02:46', NULL);
INSERT INTO "target_logs" VALUES(4, 1, 24, 1, 6, '1', '2', '221', '21', '2121', '21', '2018-02-28 05:04:54', NULL);

CREATE TABLE "trips" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route_id" integer NOT NULL,
  "duty_id" integer NOT NULL,
  "shift_id" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "trips" VALUES(21, 1, 24, 1, 5, '2018-03-20 06:31:38', '2018-03-20 06:31:38');
INSERT INTO "trips" VALUES(22, 1, 25, 1, 5, '2018-03-20 06:45:17', '2018-03-21 06:21:19');
INSERT INTO "trips" VALUES(23, 1, 24, 5, 5, '2018-03-21 06:22:01', '2018-03-21 06:22:01');

CREATE TABLE "trip_cancellation_reasons" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "trip_cancellation_reason_category_master_id" varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "short_reason" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "reason_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "trip_cancellation_reasons" VALUES(1, 1, '1', 'Short Reason', 'Reason Description', 5, '2018-02-02 01:54:46', '2018-02-02 01:54:46');
INSERT INTO "trip_cancellation_reasons" VALUES(2, 1, '2', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:21', '2018-02-02 03:41:21');
INSERT INTO "trip_cancellation_reasons" VALUES(3, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 03:41:32', '2018-02-02 03:41:32');
INSERT INTO "trip_cancellation_reasons" VALUES(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13');
INSERT INTO "trip_cancellation_reasons" VALUES(5, 1, '4', 'Short Reason', '1', 1, '2018-03-05 04:28:58', '2018-03-05 04:28:58');

CREATE TABLE "trip_cancellation_reason_category_masters" (
  "id" integer NOT NULL,
  "name" varchar(200) NOT NULL

);
INSERT INTO "trip_cancellation_reason_category_masters" VALUES(1, 'No Fuel');
INSERT INTO "trip_cancellation_reason_category_masters" VALUES(2, 'Others');
INSERT INTO "trip_cancellation_reason_category_masters" VALUES(3, 'T1');
INSERT INTO "trip_cancellation_reason_category_masters" VALUES(4, 'T2');

CREATE TABLE "trip_cancellation_reason_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "trip_cancellation_reason_category_master_id" varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "short_reason" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "reason_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "order_number" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "trip_cancellation_reason_logs" VALUES(1, 1, '1', 'Short Reason', 'Reason Description', 1, '2018-02-02 01:54:46', '2018-02-02 01:54:46');
INSERT INTO "trip_cancellation_reason_logs" VALUES(2, 1, '2', 'Short Reason', 'Reason Description', 2, '2018-02-02 03:41:21', '2018-02-02 03:41:21');
INSERT INTO "trip_cancellation_reason_logs" VALUES(3, 1, '1', 'Short Reason', 'Reason Description', 3, '2018-02-02 03:41:32', '2018-02-02 03:41:32');
INSERT INTO "trip_cancellation_reason_logs" VALUES(4, 1, '3', 'Short Reason1', 'Reason Description1', 4, '2018-02-02 03:48:13', '2018-02-02 03:48:13');
INSERT INTO "trip_cancellation_reason_logs" VALUES(5, 1, '1', 'Short Reason', 'Reason Description', 1, '2018-02-02 01:54:46', NULL);
INSERT INTO "trip_cancellation_reason_logs" VALUES(6, 1, '3', 'Short Reason1', 'Reason Description1', 2, '2018-02-02 03:48:13', NULL);
INSERT INTO "trip_cancellation_reason_logs" VALUES(7, 1, '1', 'Short Reason', 'Reason Description', 2, '2018-02-02 01:54:46', NULL);

CREATE TABLE "trip_details" (
  "id" integer UNSIGNED NOT NULL,
  "trip_id" integer NOT NULL,
  "trip_no" integer NOT NULL,
  "start_time" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "path_route_id" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "deviated_route" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "deviated_path" varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "trip_details" VALUES(62, 21, 1, '12:00PM', '24', '24', '24', NULL, NULL);
INSERT INTO "trip_details" VALUES(63, 21, 2, '12:00PM', '25', '25', '25', NULL, NULL);
INSERT INTO "trip_details" VALUES(70, 22, 1, '12:00PM', '24', '25', '24', NULL, NULL);
INSERT INTO "trip_details" VALUES(71, 22, 2, '06:32PM', '24', '24', '24', NULL, NULL);
INSERT INTO "trip_details" VALUES(72, 22, 3, '06:32PM', '24', '24', '24', NULL, NULL);
INSERT INTO "trip_details" VALUES(75, 23, 1, '12:00PM', '24', '24', '24', NULL, NULL);
INSERT INTO "trip_details" VALUES(76, 23, 2, '06:30PM', '24', '25', '25', NULL, NULL);

CREATE TABLE "trip_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "route_id" integer NOT NULL,
  "duty_id" integer NOT NULL,
  "shift_id" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "trip_logs" VALUES(25, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(26, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(27, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(28, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(29, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(30, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(31, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(32, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(33, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL);
INSERT INTO "trip_logs" VALUES(34, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL);
INSERT INTO "trip_logs" VALUES(35, 1, 24, 1, 5, '2018-03-20 06:31:38', NULL);
INSERT INTO "trip_logs" VALUES(36, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL);
INSERT INTO "trip_logs" VALUES(37, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL);
INSERT INTO "trip_logs" VALUES(38, 1, 25, 7, 5, '2018-03-20 06:45:17', NULL);
INSERT INTO "trip_logs" VALUES(39, 1, 24, 5, 5, '2018-03-21 06:22:01', NULL);

CREATE TABLE "trip_start" (
  "id" integer NOT NULL,
  "service_id" integer DEFAULT NULL,
  "route_id" integer DEFAULT NULL,
  "direction" varchar(64) DEFAULT NULL,
  "start_stop_id" integer DEFAULT NULL,
  "end_stop_id" integer DEFAULT NULL,
  "start_timestamp" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "updated_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);
INSERT INTO "trip_start" VALUES(1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-09 06:52:20', '2018-07-09 06:52:20');
INSERT INTO "trip_start" VALUES(2, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-09 12:25:04', '2018-07-09 12:25:04');
INSERT INTO "trip_start" VALUES(3, NULL, NULL, NULL, 5, NULL, NULL, '2018-07-09 12:28:03', '2018-07-09 12:28:03');
INSERT INTO "trip_start" VALUES(4, 1, 2, 'Up', 5, 6, '2018-07-09 12:28:00', '2018-07-09 12:42:47', '2018-07-09 12:42:47');
INSERT INTO "trip_start" VALUES(5, 11, 12, '13', 14, 15, '2018-07-09 12:28:00', '2018-07-09 12:49:46', '2018-07-09 12:49:46');
INSERT INTO "trip_start" VALUES(6, 7, 28, 'Up', 12, 8, '2018-07-10 17:10:12', '2018-07-10 17:10:17', '2018-07-10 17:10:17');
INSERT INTO "trip_start" VALUES(7, 7, 28, 'Down', 12, 8, '2018-07-10 18:12:55', '2018-07-10 18:12:57', '2018-07-10 18:12:57');
INSERT INTO "trip_start" VALUES(8, 7, 28, 'Up', 12, 8, '2018-07-11 10:56:27', '2018-07-11 10:56:27', '2018-07-11 10:56:27');
INSERT INTO "trip_start" VALUES(9, 7, 28, 'Down', 12, 8, '2018-07-11 11:12:48', '2018-07-11 11:12:52', '2018-07-11 11:12:52');
INSERT INTO "trip_start" VALUES(10, 7, 28, 'Down', 12, 8, '2018-07-11 11:18:22', '2018-07-11 11:18:28', '2018-07-11 11:18:28');
INSERT INTO "trip_start" VALUES(11, 7, 28, 'Up', 12, 8, '2018-07-11 11:27:18', '2018-07-11 11:27:20', '2018-07-11 11:27:20');
INSERT INTO "trip_start" VALUES(12, 7, 28, 'Up', 12, 8, '2018-07-11 11:32:54', '2018-07-11 11:32:59', '2018-07-11 11:32:59');
INSERT INTO "trip_start" VALUES(13, 7, 28, 'Up', 12, 8, '2018-07-11 11:44:09', '2018-07-11 11:44:13', '2018-07-11 11:44:13');
INSERT INTO "trip_start" VALUES(14, 7, 28, 'Up', 12, 8, '2018-07-11 11:44:17', '2018-07-11 11:44:19', '2018-07-11 11:44:19');
INSERT INTO "trip_start" VALUES(15, 6, 28, 'Down', 12, 8, '2018-07-11 13:45:50', '2018-07-11 13:45:55', '2018-07-11 13:45:55');
INSERT INTO "trip_start" VALUES(16, 6, 28, 'Down', 12, 8, '2018-07-11 15:33:50', '2018-07-11 15:33:54', '2018-07-11 15:33:54');
INSERT INTO "trip_start" VALUES(17, 6, 28, 'Down', 12, 8, '2018-07-11 15:36:21', '2018-07-11 15:36:26', '2018-07-11 15:36:26');
INSERT INTO "trip_start" VALUES(18, 6, 28, 'Down', 12, 8, '2018-07-11 15:40:30', '2018-07-11 15:40:34', '2018-07-11 15:40:34');
INSERT INTO "trip_start" VALUES(19, 6, 28, 'Down', 12, 8, '2018-07-11 15:58:19', '2018-07-11 15:58:21', '2018-07-11 15:58:21');
INSERT INTO "trip_start" VALUES(20, 6, 28, 'Down', 12, 8, '2018-07-11 16:02:54', '2018-07-11 16:02:58', '2018-07-11 16:02:58');
INSERT INTO "trip_start" VALUES(21, 6, 28, 'Down', 12, 8, '2018-07-11 16:03:58', '2018-07-11 16:04:02', '2018-07-11 16:04:02');
INSERT INTO "trip_start" VALUES(22, 7, 28, 'Down', 12, 8, '2018-07-11 16:10:58', '2018-07-11 16:11:02', '2018-07-11 16:11:02');
INSERT INTO "trip_start" VALUES(23, 6, 28, 'Down', 12, 8, '2018-07-11 16:17:13', '2018-07-11 16:17:19', '2018-07-11 16:17:19');
INSERT INTO "trip_start" VALUES(24, 6, 28, 'Down', 12, 8, '2018-07-11 16:22:58', '2018-07-11 16:23:01', '2018-07-11 16:23:01');
INSERT INTO "trip_start" VALUES(25, 6, 28, 'Down', 12, 8, '2018-07-11 16:26:19', '2018-07-11 16:26:23', '2018-07-11 16:26:23');
INSERT INTO "trip_start" VALUES(26, 6, 28, 'Down', 12, 8, '2018-07-11 16:44:24', '2018-07-11 16:44:26', '2018-07-11 16:44:26');
INSERT INTO "trip_start" VALUES(27, 6, 28, 'Down', 12, 8, '2018-07-11 16:46:45', '2018-07-11 16:46:49', '2018-07-11 16:46:49');
INSERT INTO "trip_start" VALUES(28, 6, 28, 'Down', 12, 8, '2018-07-11 16:51:22', '2018-07-11 16:51:24', '2018-07-11 16:51:24');
INSERT INTO "trip_start" VALUES(29, 6, 28, 'Down', 12, 8, '2018-07-11 16:55:46', '2018-07-11 16:55:50', '2018-07-11 16:55:50');
INSERT INTO "trip_start" VALUES(30, 6, 28, 'Down', 12, 8, '2018-07-11 16:57:42', '2018-07-11 16:57:44', '2018-07-11 16:57:44');
INSERT INTO "trip_start" VALUES(31, 6, 28, 'Down', 12, 8, '2018-07-11 17:49:27', '2018-07-11 17:49:31', '2018-07-11 17:49:31');
INSERT INTO "trip_start" VALUES(32, 6, 28, 'Down', 12, 8, '2018-07-11 17:52:25', '2018-07-11 17:52:30', '2018-07-11 17:52:30');
INSERT INTO "trip_start" VALUES(33, 6, 28, 'Down', 12, 8, '2018-07-11 17:56:31', '2018-07-11 17:56:36', '2018-07-11 17:56:36');
INSERT INTO "trip_start" VALUES(34, 6, 28, 'Down', 12, 8, '2018-07-11 17:59:10', '2018-07-11 17:59:14', '2018-07-11 17:59:14');
INSERT INTO "trip_start" VALUES(35, 6, 28, 'Down', 12, 8, '2018-07-11 18:04:40', '2018-07-11 18:04:42', '2018-07-11 18:04:42');
INSERT INTO "trip_start" VALUES(36, 6, 28, 'Down', 12, 8, '2018-07-11 18:11:58', '2018-07-11 18:12:03', '2018-07-11 18:12:03');
INSERT INTO "trip_start" VALUES(37, 6, 28, 'Down', 12, 8, '2018-07-11 18:14:31', '2018-07-11 18:14:34', '2018-07-11 18:14:34');
INSERT INTO "trip_start" VALUES(38, 6, 28, 'Down', 12, 8, '2018-07-11 18:17:38', '2018-07-11 18:17:41', '2018-07-11 18:17:41');
INSERT INTO "trip_start" VALUES(39, 6, 28, 'Down', 12, 8, '2018-07-11 18:19:02', '2018-07-11 18:19:07', '2018-07-11 18:19:07');
INSERT INTO "trip_start" VALUES(40, 6, 28, 'Down', 12, 8, '2018-07-11 18:21:45', '2018-07-11 18:21:50', '2018-07-11 18:21:50');
INSERT INTO "trip_start" VALUES(41, 6, 28, 'Down', 12, 8, '2018-07-11 18:27:15', '2018-07-11 18:27:17', '2018-07-11 18:27:17');
INSERT INTO "trip_start" VALUES(42, 6, 28, 'Down', 12, 8, '2018-07-11 18:32:28', '2018-07-11 18:32:32', '2018-07-11 18:32:32');
INSERT INTO "trip_start" VALUES(43, 6, 28, 'Down', 12, 8, '2018-07-12 10:10:49', '2018-07-12 10:10:51', '2018-07-12 10:10:51');
INSERT INTO "trip_start" VALUES(44, 16, 28, 'Down', 12, 8, '2018-07-12 10:43:52', '2018-07-12 10:43:54', '2018-07-12 10:43:54');
INSERT INTO "trip_start" VALUES(45, 16, 28, 'Down', 12, 8, '2018-07-12 10:46:03', '2018-07-12 10:46:05', '2018-07-12 10:46:05');

CREATE TABLE "users" (
  "id" integer UNSIGNED NOT NULL,
  "name" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "user_name" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "email" varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  "address" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "country" varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  "city" varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  "password" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "mobile" varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  "date_of_birth" date DEFAULT NULL,
  "image_path" blob,
  "set_password_token" varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  "remember_token" varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  "status" integer DEFAULT '0',
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "users" VALUES(1, 'Satya', 'satya', 'admin@opiant.online', 'Address', '1', 'City', '$2y$10$Fx77v1au5kCgl/bjynQEC.O8BV9wDdMwB1AXLTxtjk3.p8y7ZzVGe', '3453425454', '2017-12-01', 0x576259656a6d49465f53637265656e73686f742066726f6d20323031372d30342d30362031332d31322d35312e706e67, NULL, '2MmYxZHD7Wb7qfn9F6g3AfgzajlIDSWSOgLFxS1oeX1l1AkgBJYP9PjtSGyz', 0, NULL, '2018-03-14 06:32:17');
INSERT INTO "users" VALUES(2, 'Ravi', 'Ravi Kumar', 'admin1@opiant.online', 'Address', '99', 'City', '$2y$10$qAF5KR29F8/q2.6J0/9aoOOJ9AZ0GXBM7z2ehcE9RWKQHmNmq4ftO', '3453425454', '2017-12-02', 0x566d7a584d4864475f53637265656e73686f742066726f6d20323031372d30342d32362031352d32352d30302e706e67, NULL, '', 0, NULL, '2018-03-07 03:48:31');
INSERT INTO "users" VALUES(5, 'Subhash Prajapati', 'Subhash Prajapati', 'admin3@opiant.online', 'Address', '167', 'City', '$2y$10$qAF5KR29F8/q2.6J0/9aoOOJ9AZ0GXBM7z2ehcE9RWKQHmNmq4ftO', '3441454552', '2018-01-03', 0x4d3873466958396a5f6461696c795f75695f3030325f5f5f6c6f67696e5f706167655f62795f736b7970757269666965722d643968757767772e706e67, 'Y7noP4OlbZH1JyE7wzl764Mc6E9KQidjy8BGE73V', 'Qf8gApi5lFXqmXQh3EKFlasLNQhSVu9X5mwo3rtY9g43h23IVRKfC2hsERlt', 0, '2018-01-04 05:17:37', '2018-03-07 03:48:34');
INSERT INTO "users" VALUES(20, 'Ravishanker2232323', 'Ravishanker', 'satya2000chauhan@gmail.com', 'H.N 5 Hastsal1', '80', 'Delhi1', NULL, '3243243421', '2018-03-01', 0x684d44656271434c5f6461696c795f75695f3030325f5f5f6c6f67696e5f706167655f62795f736b7970757269666965722d643968757767772e706e67, 'JlmxzEmvitvINgrQrDv5Dlrwu13zRDEQPcKhC1ao', 'R3SdfL2qIQWDgPjs5n42UYSACzT9SxXHhR7dtGyE', 0, '2018-03-13 05:06:33', '2018-03-13 06:52:17');
INSERT INTO "users" VALUES(21, 'Hari Prasad', 'Hariprasad', 'satya2000chauhan@gmail.com', 'H.N 5 Hastsal', '1', 'Delhi', NULL, '3243243423', '2018-03-07', NULL, 'hDKlRdf2I05s0432zislCUkpQN2AF5fDI0k5BuP1', 'iqhI158Msxw3Er7Fb2WFfQ6YdT8Qzf82rkObwx9Z', 0, '2018-03-13 23:54:39', '2018-03-13 23:54:39');

CREATE TABLE "vehicles" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "depot_id" integer NOT NULL,
  "vehicle_registration_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "bus_type_id" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "vehicles" VALUES(14, 1, 2, 'DL01AB0001', 1, '2018-07-02 14:49:17', '2018-07-02 14:49:17');
INSERT INTO "vehicles" VALUES(15, 1, 1, 'DL01AB0002', 2, '2018-07-02 14:49:26', '2018-07-02 14:49:26');
INSERT INTO "vehicles" VALUES(16, 1, 4, 'DL01AB0003', 4, '2018-07-02 14:49:36', '2018-07-02 14:49:36');
INSERT INTO "vehicles" VALUES(17, 1, 2, 'DL01AB0004', 6, '2018-07-02 14:49:45', '2018-07-02 14:49:45');
INSERT INTO "vehicles" VALUES(18, 1, 1, 'DL01AB0005', 5, '2018-07-02 14:49:53', '2018-07-02 14:49:53');

CREATE TABLE "vehicle_logs" (
  "id" integer UNSIGNED NOT NULL,
  "user_id" integer NOT NULL,
  "depot_id" integer NOT NULL,
  "vehicle_registration_number" varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  "bus_type_id" integer NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL

);
INSERT INTO "vehicle_logs" VALUES(12, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', '2018-02-22 01:13:10');
INSERT INTO "vehicle_logs" VALUES(13, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', '2018-02-22 01:13:40');
INSERT INTO "vehicle_logs" VALUES(14, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL);
INSERT INTO "vehicle_logs" VALUES(15, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(16, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(17, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL);
INSERT INTO "vehicle_logs" VALUES(18, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(19, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL);
INSERT INTO "vehicle_logs" VALUES(20, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(21, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(22, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL);
INSERT INTO "vehicle_logs" VALUES(23, 1, 1, 'DL-12', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(24, 1, 1, 'DL-121', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(25, 1, 1, 'DL-121', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(26, 1, 1, 'DL-121', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(27, 1, 1, 'DL-12112', 1, '2018-02-22 01:13:10', NULL);
INSERT INTO "vehicle_logs" VALUES(28, 1, 1, 'DL-1234', 6, '2018-02-22 01:13:40', NULL);

