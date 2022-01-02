-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2021 at 10:06 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.3.33-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chai`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_types`
--

CREATE TABLE `asset_types` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asset_types`
--

INSERT INTO `asset_types` (`id`, `name`, `duration`, `created_at`, `updated_at`) VALUES
(2, 'IT EQUIPMENT', 3, '2021-10-10 13:12:02', NULL),
(3, 'FURNITURE', 5, '2021-10-10 13:12:39', NULL),
(4, 'EQUIPMENT', 5, '2021-10-10 13:12:39', NULL),
(5, 'VEHICLE', 5, '2021-10-10 13:12:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` mediumint UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `iso2` char(2) DEFAULT NULL,
  `phonecode` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `wikiDataId` varchar(255) DEFAULT NULL COMMENT 'Rapid API GeoDB Cities'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso3`, `iso2`, `phonecode`, `capital`, `currency`, `created_at`, `updated_at`, `flag`, `wikiDataId`) VALUES
(1, 'Afghanistan', 'AFG', 'AF', '93', 'Kabul', 'AFN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q889'),
(2, 'Aland Islands', 'ALA', 'AX', '+358-18', 'Mariehamn', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(3, 'Albania', 'ALB', 'AL', '355', 'Tirana', 'ALL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q222'),
(4, 'Algeria', 'DZA', 'DZ', '213', 'Algiers', 'DZD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q262'),
(5, 'American Samoa', 'ASM', 'AS', '+1-684', 'Pago Pago', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(6, 'Andorra', 'AND', 'AD', '376', 'Andorra la Vella', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q228'),
(7, 'Angola', 'AGO', 'AO', '244', 'Luanda', 'AOA', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q916'),
(8, 'Anguilla', 'AIA', 'AI', '+1-264', 'The Valley', 'XCD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(9, 'Antarctica', 'ATA', 'AQ', '', '', '', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(10, 'Antigua And Barbuda', 'ATG', 'AG', '+1-268', 'St. John\'s', 'XCD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q781'),
(11, 'Argentina', 'ARG', 'AR', '54', 'Buenos Aires', 'ARS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q414'),
(12, 'Armenia', 'ARM', 'AM', '374', 'Yerevan', 'AMD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q399'),
(13, 'Aruba', 'ABW', 'AW', '297', 'Oranjestad', 'AWG', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(14, 'Australia', 'AUS', 'AU', '61', 'Canberra', 'AUD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q408'),
(15, 'Austria', 'AUT', 'AT', '43', 'Vienna', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q40'),
(16, 'Azerbaijan', 'AZE', 'AZ', '994', 'Baku', 'AZN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q227'),
(17, 'Bahamas The', 'BHS', 'BS', '+1-242', 'Nassau', 'BSD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q778'),
(18, 'Bahrain', 'BHR', 'BH', '973', 'Manama', 'BHD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q398'),
(19, 'Bangladesh', 'BGD', 'BD', '880', 'Dhaka', 'BDT', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q902'),
(20, 'Barbados', 'BRB', 'BB', '+1-246', 'Bridgetown', 'BBD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q244'),
(21, 'Belarus', 'BLR', 'BY', '375', 'Minsk', 'BYR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q184'),
(22, 'Belgium', 'BEL', 'BE', '32', 'Brussels', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q31'),
(23, 'Belize', 'BLZ', 'BZ', '501', 'Belmopan', 'BZD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q242'),
(24, 'Benin', 'BEN', 'BJ', '229', 'Porto-Novo', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q962'),
(25, 'Bermuda', 'BMU', 'BM', '+1-441', 'Hamilton', 'BMD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(26, 'Bhutan', 'BTN', 'BT', '975', 'Thimphu', 'BTN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q917'),
(27, 'Bolivia', 'BOL', 'BO', '591', 'Sucre', 'BOB', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q750'),
(28, 'Bosnia and Herzegovina', 'BIH', 'BA', '387', 'Sarajevo', 'BAM', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q225'),
(29, 'Botswana', 'BWA', 'BW', '267', 'Gaborone', 'BWP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q963'),
(30, 'Bouvet Island', 'BVT', 'BV', '', '', 'NOK', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(31, 'Brazil', 'BRA', 'BR', '55', 'Brasilia', 'BRL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q155'),
(32, 'British Indian Ocean Territory', 'IOT', 'IO', '246', 'Diego Garcia', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(33, 'Brunei', 'BRN', 'BN', '673', 'Bandar Seri Begawan', 'BND', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q921'),
(34, 'Bulgaria', 'BGR', 'BG', '359', 'Sofia', 'BGN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q219'),
(35, 'Burkina Faso', 'BFA', 'BF', '226', 'Ouagadougou', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q965'),
(36, 'Burundi', 'BDI', 'BI', '257', 'Bujumbura', 'BIF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q967'),
(37, 'Cambodia', 'KHM', 'KH', '855', 'Phnom Penh', 'KHR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q424'),
(38, 'Cameroon', 'CMR', 'CM', '237', 'Yaounde', 'XAF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1009'),
(39, 'Canada', 'CAN', 'CA', '1', 'Ottawa', 'CAD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q16'),
(40, 'Cape Verde', 'CPV', 'CV', '238', 'Praia', 'CVE', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1011'),
(41, 'Cayman Islands', 'CYM', 'KY', '+1-345', 'George Town', 'KYD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(42, 'Central African Republic', 'CAF', 'CF', '236', 'Bangui', 'XAF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q929'),
(43, 'Chad', 'TCD', 'TD', '235', 'N\'Djamena', 'XAF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q657'),
(44, 'Chile', 'CHL', 'CL', '56', 'Santiago', 'CLP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q298'),
(45, 'China', 'CHN', 'CN', '86', 'Beijing', 'CNY', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q148'),
(46, 'Christmas Island', 'CXR', 'CX', '61', 'Flying Fish Cove', 'AUD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(47, 'Cocos (Keeling) Islands', 'CCK', 'CC', '61', 'West Island', 'AUD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(48, 'Colombia', 'COL', 'CO', '57', 'Bogota', 'COP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q739'),
(49, 'Comoros', 'COM', 'KM', '269', 'Moroni', 'KMF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q970'),
(50, 'Congo', 'COG', 'CG', '242', 'Brazzaville', 'XAF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q971'),
(51, 'Congo The Democratic Republic Of The', 'COD', 'CD', '243', 'Kinshasa', 'CDF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q974'),
(52, 'Cook Islands', 'COK', 'CK', '682', 'Avarua', 'NZD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q26988'),
(53, 'Costa Rica', 'CRI', 'CR', '506', 'San Jose', 'CRC', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q800'),
(54, 'Cote D\'Ivoire (Ivory Coast)', 'CIV', 'CI', '225', 'Yamoussoukro', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1008'),
(55, 'Croatia (Hrvatska)', 'HRV', 'HR', '385', 'Zagreb', 'HRK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q224'),
(56, 'Cuba', 'CUB', 'CU', '53', 'Havana', 'CUP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q241'),
(57, 'Cyprus', 'CYP', 'CY', '357', 'Nicosia', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q229'),
(58, 'Czech Republic', 'CZE', 'CZ', '420', 'Prague', 'CZK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q213'),
(59, 'Denmark', 'DNK', 'DK', '45', 'Copenhagen', 'DKK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q35'),
(60, 'Djibouti', 'DJI', 'DJ', '253', 'Djibouti', 'DJF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q977'),
(61, 'Dominica', 'DMA', 'DM', '+1-767', 'Roseau', 'XCD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q784'),
(62, 'Dominican Republic', 'DOM', 'DO', '+1-809 and 1-829', 'Santo Domingo', 'DOP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q786'),
(63, 'East Timor', 'TLS', 'TL', '670', 'Dili', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q574'),
(64, 'Ecuador', 'ECU', 'EC', '593', 'Quito', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q736'),
(65, 'Egypt', 'EGY', 'EG', '20', 'Cairo', 'EGP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q79'),
(66, 'El Salvador', 'SLV', 'SV', '503', 'San Salvador', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q792'),
(67, 'Equatorial Guinea', 'GNQ', 'GQ', '240', 'Malabo', 'XAF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q983'),
(68, 'Eritrea', 'ERI', 'ER', '291', 'Asmara', 'ERN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q986'),
(69, 'Estonia', 'EST', 'EE', '372', 'Tallinn', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q191'),
(70, 'Ethiopia', 'ETH', 'ET', '251', 'Addis Ababa', 'ETB', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q115'),
(71, 'Falkland Islands', 'FLK', 'FK', '500', 'Stanley', 'FKP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(72, 'Faroe Islands', 'FRO', 'FO', '298', 'Torshavn', 'DKK', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(73, 'Fiji Islands', 'FJI', 'FJ', '679', 'Suva', 'FJD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q712'),
(74, 'Finland', 'FIN', 'FI', '358', 'Helsinki', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q33'),
(75, 'France', 'FRA', 'FR', '33', 'Paris', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q142'),
(76, 'French Guiana', 'GUF', 'GF', '594', 'Cayenne', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(77, 'French Polynesia', 'PYF', 'PF', '689', 'Papeete', 'XPF', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(78, 'French Southern Territories', 'ATF', 'TF', '', 'Port-aux-Francais', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(79, 'Gabon', 'GAB', 'GA', '241', 'Libreville', 'XAF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1000'),
(80, 'Gambia The', 'GMB', 'GM', '220', 'Banjul', 'GMD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1005'),
(81, 'Georgia', 'GEO', 'GE', '995', 'Tbilisi', 'GEL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q230'),
(82, 'Germany', 'DEU', 'DE', '49', 'Berlin', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q183'),
(83, 'Ghana', 'GHA', 'GH', '233', 'Accra', 'GHS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q117'),
(84, 'Gibraltar', 'GIB', 'GI', '350', 'Gibraltar', 'GIP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(85, 'Greece', 'GRC', 'GR', '30', 'Athens', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q41'),
(86, 'Greenland', 'GRL', 'GL', '299', 'Nuuk', 'DKK', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(87, 'Grenada', 'GRD', 'GD', '+1-473', 'St. George\'s', 'XCD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q769'),
(88, 'Guadeloupe', 'GLP', 'GP', '590', 'Basse-Terre', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(89, 'Guam', 'GUM', 'GU', '+1-671', 'Hagatna', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(90, 'Guatemala', 'GTM', 'GT', '502', 'Guatemala City', 'GTQ', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q774'),
(91, 'Guernsey and Alderney', 'GGY', 'GG', '+44-1481', 'St Peter Port', 'GBP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(92, 'Guinea', 'GIN', 'GN', '224', 'Conakry', 'GNF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1006'),
(93, 'Guinea-Bissau', 'GNB', 'GW', '245', 'Bissau', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1007'),
(94, 'Guyana', 'GUY', 'GY', '592', 'Georgetown', 'GYD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q734'),
(95, 'Haiti', 'HTI', 'HT', '509', 'Port-au-Prince', 'HTG', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q790'),
(96, 'Heard and McDonald Islands', 'HMD', 'HM', ' ', '', 'AUD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(97, 'Honduras', 'HND', 'HN', '504', 'Tegucigalpa', 'HNL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q783'),
(98, 'Hong Kong S.A.R.', 'HKG', 'HK', '852', 'Hong Kong', 'HKD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(99, 'Hungary', 'HUN', 'HU', '36', 'Budapest', 'HUF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q28'),
(100, 'Iceland', 'ISL', 'IS', '354', 'Reykjavik', 'ISK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q189'),
(101, 'India', 'IND', 'IN', '91', 'New Delhi', 'INR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q668'),
(102, 'Indonesia', 'IDN', 'ID', '62', 'Jakarta', 'IDR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q252'),
(103, 'Iran', 'IRN', 'IR', '98', 'Tehran', 'IRR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q794'),
(104, 'Iraq', 'IRQ', 'IQ', '964', 'Baghdad', 'IQD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q796'),
(105, 'Ireland', 'IRL', 'IE', '353', 'Dublin', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q27'),
(106, 'Israel', 'ISR', 'IL', '972', 'Jerusalem', 'ILS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q801'),
(107, 'Italy', 'ITA', 'IT', '39', 'Rome', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q38'),
(108, 'Jamaica', 'JAM', 'JM', '+1-876', 'Kingston', 'JMD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q766'),
(109, 'Japan', 'JPN', 'JP', '81', 'Tokyo', 'JPY', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q17'),
(110, 'Jersey', 'JEY', 'JE', '+44-1534', 'Saint Helier', 'GBP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q785'),
(111, 'Jordan', 'JOR', 'JO', '962', 'Amman', 'JOD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q810'),
(112, 'Kazakhstan', 'KAZ', 'KZ', '7', 'Astana', 'KZT', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q232'),
(113, 'Kenya', 'KEN', 'KE', '254', 'Nairobi', 'KES', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q114'),
(114, 'Kiribati', 'KIR', 'KI', '686', 'Tarawa', 'AUD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q710'),
(115, 'Korea North\n', 'PRK', 'KP', '850', 'Pyongyang', 'KPW', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q423'),
(116, 'Korea South', 'KOR', 'KR', '82', 'Seoul', 'KRW', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q884'),
(117, 'Kuwait', 'KWT', 'KW', '965', 'Kuwait City', 'KWD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q817'),
(118, 'Kyrgyzstan', 'KGZ', 'KG', '996', 'Bishkek', 'KGS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q813'),
(119, 'Laos', 'LAO', 'LA', '856', 'Vientiane', 'LAK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q819'),
(120, 'Latvia', 'LVA', 'LV', '371', 'Riga', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q211'),
(121, 'Lebanon', 'LBN', 'LB', '961', 'Beirut', 'LBP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q822'),
(122, 'Lesotho', 'LSO', 'LS', '266', 'Maseru', 'LSL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1013'),
(123, 'Liberia', 'LBR', 'LR', '231', 'Monrovia', 'LRD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1014'),
(124, 'Libya', 'LBY', 'LY', '218', 'Tripolis', 'LYD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1016'),
(125, 'Liechtenstein', 'LIE', 'LI', '423', 'Vaduz', 'CHF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q347'),
(126, 'Lithuania', 'LTU', 'LT', '370', 'Vilnius', 'LTL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q37'),
(127, 'Luxembourg', 'LUX', 'LU', '352', 'Luxembourg', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q32'),
(128, 'Macau S.A.R.', 'MAC', 'MO', '853', 'Macao', 'MOP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(129, 'Macedonia', 'MKD', 'MK', '389', 'Skopje', 'MKD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q221'),
(130, 'Madagascar', 'MDG', 'MG', '261', 'Antananarivo', 'MGA', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1019'),
(131, 'Malawi', 'MWI', 'MW', '265', 'Lilongwe', 'MWK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1020'),
(132, 'Malaysia', 'MYS', 'MY', '60', 'Kuala Lumpur', 'MYR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q833'),
(133, 'Maldives', 'MDV', 'MV', '960', 'Male', 'MVR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q826'),
(134, 'Mali', 'MLI', 'ML', '223', 'Bamako', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q912'),
(135, 'Malta', 'MLT', 'MT', '356', 'Valletta', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q233'),
(136, 'Man (Isle of)', 'IMN', 'IM', '+44-1624', 'Douglas, Isle of Man', 'GBP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(137, 'Marshall Islands', 'MHL', 'MH', '692', 'Majuro', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q709'),
(138, 'Martinique', 'MTQ', 'MQ', '596', 'Fort-de-France', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(139, 'Mauritania', 'MRT', 'MR', '222', 'Nouakchott', 'MRO', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1025'),
(140, 'Mauritius', 'MUS', 'MU', '230', 'Port Louis', 'MUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1027'),
(141, 'Mayotte', 'MYT', 'YT', '262', 'Mamoudzou', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(142, 'Mexico', 'MEX', 'MX', '52', 'Mexico City', 'MXN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q96'),
(143, 'Micronesia', 'FSM', 'FM', '691', 'Palikir', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q702'),
(144, 'Moldova', 'MDA', 'MD', '373', 'Chisinau', 'MDL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q217'),
(145, 'Monaco', 'MCO', 'MC', '377', 'Monaco', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(146, 'Mongolia', 'MNG', 'MN', '976', 'Ulan Bator', 'MNT', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q711'),
(147, 'Montenegro', 'MNE', 'ME', '382', 'Podgorica', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q236'),
(148, 'Montserrat', 'MSR', 'MS', '+1-664', 'Plymouth', 'XCD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(149, 'Morocco', 'MAR', 'MA', '212', 'Rabat', 'MAD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1028'),
(150, 'Mozambique', 'MOZ', 'MZ', '258', 'Maputo', 'MZN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1029'),
(151, 'Myanmar', 'MMR', 'MM', '95', 'Nay Pyi Taw', 'MMK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q836'),
(152, 'Namibia', 'NAM', 'NA', '264', 'Windhoek', 'NAD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1030'),
(153, 'Nauru', 'NRU', 'NR', '674', 'Yaren', 'AUD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q697'),
(154, 'Nepal', 'NPL', 'NP', '977', 'Kathmandu', 'NPR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q837'),
(155, 'Netherlands Antilles', 'ANT', 'AN', '', '', '', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(156, 'Netherlands The', 'NLD', 'NL', '31', 'Amsterdam', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q55'),
(157, 'New Caledonia', 'NCL', 'NC', '687', 'Noumea', 'XPF', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(158, 'New Zealand', 'NZL', 'NZ', '64', 'Wellington', 'NZD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q664'),
(159, 'Nicaragua', 'NIC', 'NI', '505', 'Managua', 'NIO', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q811'),
(160, 'Niger', 'NER', 'NE', '227', 'Niamey', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1032'),
(161, 'Nigeria', 'NGA', 'NG', '234', 'Abuja', 'NGN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1033'),
(162, 'Niue', 'NIU', 'NU', '683', 'Alofi', 'NZD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q34020'),
(163, 'Norfolk Island', 'NFK', 'NF', '672', 'Kingston', 'AUD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(164, 'Northern Mariana Islands', 'MNP', 'MP', '+1-670', 'Saipan', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(165, 'Norway', 'NOR', 'NO', '47', 'Oslo', 'NOK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q20'),
(166, 'Oman', 'OMN', 'OM', '968', 'Muscat', 'OMR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q842'),
(167, 'Pakistan', 'PAK', 'PK', '92', 'Islamabad', 'PKR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q843'),
(168, 'Palau', 'PLW', 'PW', '680', 'Melekeok', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q695'),
(169, 'Palestinian Territory Occupied', 'PSE', 'PS', '970', 'East Jerusalem', 'ILS', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(170, 'Panama', 'PAN', 'PA', '507', 'Panama City', 'PAB', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q804'),
(171, 'Papua new Guinea', 'PNG', 'PG', '675', 'Port Moresby', 'PGK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q691'),
(172, 'Paraguay', 'PRY', 'PY', '595', 'Asuncion', 'PYG', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q733'),
(173, 'Peru', 'PER', 'PE', '51', 'Lima', 'PEN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q419'),
(174, 'Philippines', 'PHL', 'PH', '63', 'Manila', 'PHP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q928'),
(175, 'Pitcairn Island', 'PCN', 'PN', '870', 'Adamstown', 'NZD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(176, 'Poland', 'POL', 'PL', '48', 'Warsaw', 'PLN', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q36'),
(177, 'Portugal', 'PRT', 'PT', '351', 'Lisbon', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q45'),
(178, 'Puerto Rico', 'PRI', 'PR', '+1-787 and 1-939', 'San Juan', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(179, 'Qatar', 'QAT', 'QA', '974', 'Doha', 'QAR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q846'),
(180, 'Reunion', 'REU', 'RE', '262', 'Saint-Denis', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(181, 'Romania', 'ROU', 'RO', '40', 'Bucharest', 'RON', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q218'),
(182, 'Russia', 'RUS', 'RU', '7', 'Moscow', 'RUB', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q159'),
(183, 'Rwanda', 'RWA', 'RW', '250', 'Kigali', 'RWF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1037'),
(184, 'Saint Helena', 'SHN', 'SH', '290', 'Jamestown', 'SHP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(185, 'Saint Kitts And Nevis', 'KNA', 'KN', '+1-869', 'Basseterre', 'XCD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q763'),
(186, 'Saint Lucia', 'LCA', 'LC', '+1-758', 'Castries', 'XCD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q760'),
(187, 'Saint Pierre and Miquelon', 'SPM', 'PM', '508', 'Saint-Pierre', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(188, 'Saint Vincent And The Grenadines', 'VCT', 'VC', '+1-784', 'Kingstown', 'XCD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q757'),
(189, 'Saint-Barthelemy', 'BLM', 'BL', '590', 'Gustavia', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(190, 'Saint-Martin (French part)', 'MAF', 'MF', '590', 'Marigot', 'EUR', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(191, 'Samoa', 'WSM', 'WS', '685', 'Apia', 'WST', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q683'),
(192, 'San Marino', 'SMR', 'SM', '378', 'San Marino', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q238'),
(193, 'Sao Tome and Principe', 'STP', 'ST', '239', 'Sao Tome', 'STD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1039'),
(194, 'Saudi Arabia', 'SAU', 'SA', '966', 'Riyadh', 'SAR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q851'),
(195, 'Senegal', 'SEN', 'SN', '221', 'Dakar', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1041'),
(196, 'Serbia', 'SRB', 'RS', '381', 'Belgrade', 'RSD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q403'),
(197, 'Seychelles', 'SYC', 'SC', '248', 'Victoria', 'SCR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1042'),
(198, 'Sierra Leone', 'SLE', 'SL', '232', 'Freetown', 'SLL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1044'),
(199, 'Singapore', 'SGP', 'SG', '65', 'Singapur', 'SGD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q334'),
(200, 'Slovakia', 'SVK', 'SK', '421', 'Bratislava', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q214'),
(201, 'Slovenia', 'SVN', 'SI', '386', 'Ljubljana', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q215'),
(202, 'Solomon Islands', 'SLB', 'SB', '677', 'Honiara', 'SBD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q685'),
(203, 'Somalia', 'SOM', 'SO', '252', 'Mogadishu', 'SOS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1045'),
(204, 'South Africa', 'ZAF', 'ZA', '27', 'Pretoria', 'ZAR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q258'),
(205, 'South Georgia', 'SGS', 'GS', '', 'Grytviken', 'GBP', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(206, 'South Sudan', 'SSD', 'SS', '211', 'Juba', 'SSP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q958'),
(207, 'Spain', 'ESP', 'ES', '34', 'Madrid', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q29'),
(208, 'Sri Lanka', 'LKA', 'LK', '94', 'Colombo', 'LKR', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q854'),
(209, 'Sudan', 'SDN', 'SD', '249', 'Khartoum', 'SDG', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1049'),
(210, 'Suriname', 'SUR', 'SR', '597', 'Paramaribo', 'SRD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q730'),
(211, 'Svalbard And Jan Mayen Islands', 'SJM', 'SJ', '47', 'Longyearbyen', 'NOK', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(212, 'Swaziland', 'SWZ', 'SZ', '268', 'Mbabane', 'SZL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1050'),
(213, 'Sweden', 'SWE', 'SE', '46', 'Stockholm', 'SEK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q34'),
(214, 'Switzerland', 'CHE', 'CH', '41', 'Berne', 'CHF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q39'),
(215, 'Syria', 'SYR', 'SY', '963', 'Damascus', 'SYP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q858'),
(216, 'Taiwan', 'TWN', 'TW', '886', 'Taipei', 'TWD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q865'),
(217, 'Tajikistan', 'TJK', 'TJ', '992', 'Dushanbe', 'TJS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q863'),
(218, 'Tanzania', 'TZA', 'TZ', '255', 'Dodoma', 'TZS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q924'),
(219, 'Thailand', 'THA', 'TH', '66', 'Bangkok', 'THB', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q869'),
(220, 'Togo', 'TGO', 'TG', '228', 'Lome', 'XOF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q945'),
(221, 'Tokelau', 'TKL', 'TK', '690', '', 'NZD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(222, 'Tonga', 'TON', 'TO', '676', 'Nuku\'alofa', 'TOP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q678'),
(223, 'Trinidad And Tobago', 'TTO', 'TT', '+1-868', 'Port of Spain', 'TTD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q754'),
(224, 'Tunisia', 'TUN', 'TN', '216', 'Tunis', 'TND', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q948'),
(225, 'Turkey', 'TUR', 'TR', '90', 'Ankara', 'TRY', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q43'),
(226, 'Turkmenistan', 'TKM', 'TM', '993', 'Ashgabat', 'TMT', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q874'),
(227, 'Turks And Caicos Islands', 'TCA', 'TC', '+1-649', 'Cockburn Town', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(228, 'Tuvalu', 'TUV', 'TV', '688', 'Funafuti', 'AUD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q672'),
(229, 'Uganda', 'UGA', 'UG', '256', 'Kampala', 'UGX', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q1036'),
(230, 'Ukraine', 'UKR', 'UA', '380', 'Kiev', 'UAH', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q212'),
(231, 'United Arab Emirates', 'ARE', 'AE', '971', 'Abu Dhabi', 'AED', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q878'),
(232, 'United Kingdom', 'GBR', 'GB', '44', 'London', 'GBP', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q145'),
(233, 'United States', 'USA', 'US', '1', 'Washington', 'USD', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q30'),
(234, 'United States Minor Outlying Islands', 'UMI', 'UM', '1', '', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(235, 'Uruguay', 'URY', 'UY', '598', 'Montevideo', 'UYU', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q77'),
(236, 'Uzbekistan', 'UZB', 'UZ', '998', 'Tashkent', 'UZS', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q265'),
(237, 'Vanuatu', 'VUT', 'VU', '678', 'Port Vila', 'VUV', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q686'),
(238, 'Vatican City State (Holy See)', 'VAT', 'VA', '379', 'Vatican City', 'EUR', '2018-07-20 14:41:03', '2019-08-02 19:38:22', 1, 'Q237'),
(239, 'Venezuela', 'VEN', 'VE', '58', 'Caracas', 'VEF', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q717'),
(240, 'Vietnam', 'VNM', 'VN', '84', 'Hanoi', 'VND', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q881'),
(241, 'Virgin Islands (British)', 'VGB', 'VG', '+1-284', 'Road Town', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(242, 'Virgin Islands (US)', 'VIR', 'VI', '+1-340', 'Charlotte Amalie', 'USD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(243, 'Wallis And Futuna Islands', 'WLF', 'WF', '681', 'Mata Utu', 'XPF', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(244, 'Western Sahara', 'ESH', 'EH', '212', 'El-Aaiun', 'MAD', '2018-07-20 14:41:03', '2018-07-20 14:41:03', 1, NULL),
(245, 'Yemen', 'YEM', 'YE', '967', 'Sanaa', 'YER', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q805'),
(246, 'Zambia', 'ZMB', 'ZM', '260', 'Lusaka', 'ZMK', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q953'),
(247, 'Zimbabwe', 'ZWE', 'ZW', '263', 'Harare', 'ZWL', '2018-07-20 14:41:03', '2019-08-02 19:38:23', 1, 'Q954');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\AdminUserModel', 1),
(2, 'App\\Models\\AdminUserModel', 64359);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `module_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_slug`, `name`, `title`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admins', 'admins', 'Admins', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(2, 'admins', 'manage-admins', 'Manage Admins', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(3, 'admins', 'manage-roles', 'Manage Roles', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(4, 'admins', 'manage-permissions', 'Manage Permissions', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(5, 'admins', 'manage-admins-access', 'Manage Admins Access', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(6, 'admins', 'manage-roles-access', 'Manage Roles Access', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(7, 'admins', 'manage-permissions-access', 'Manage Permissions Access', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(8, 'users', 'users', 'Users', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(9, 'users', 'manage-users', 'Manage Users', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(10, 'users', 'manage-users-access', 'Manage Users Access', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(11, 'teams', 'teams', 'Teams', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(12, 'teams', 'manage-teams', 'Manage Teams', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(13, 'teams', 'manage-teams-access', 'Manage Teams Access', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(14, 'categories', 'categories', 'Categories', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(15, 'categories', 'manage-categories', 'Manage Categories', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52'),
(16, 'categories', 'manage-categories-access', 'Manage Categories Access', 'admin', '2021-10-06 02:08:52', '2021-10-06 02:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `remember_me`
--

CREATE TABLE `remember_me` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `initial_login_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'admin', '2019-03-12 23:42:45', '2019-03-12 23:42:45'),
(2, 'Staff', 'admin', '2021-10-01 11:36:27', '2021-10-10 05:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(8, 2),
(10, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'test', '2021-10-13 05:11:43', '2021-10-13 05:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `old_id` int DEFAULT NULL,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `phone_number` varchar(21) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firm_name` varchar(251) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `country_id` int DEFAULT NULL,
  `state` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(251) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(51) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_credits` decimal(16,2) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-active, 0- inactive',
  `basecamp_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `old_id`, `username`, `first_name`, `last_name`, `email`, `password`, `str_password`, `remember_token`, `last_ip`, `phone_number`, `firm_name`, `address_1`, `address_2`, `country_id`, `state`, `city`, `zip_code`, `remaining_credits`, `status`, `basecamp_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'Kabego', 'Aoudry', 'sheshkumarprjpt@gmail.com', '$2y$10$EKWm.OyjZk/O817Gtzg7xOpHO4rCoTjAAVkUNOITl4/AJmgxMFzH2', NULL, 'oIwZLmvguzn0j8PHLD4Lz1ckjrrNjtAl9QDtWFPDEA2kxWCxL9xc4CocqCHT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 17312680, NULL, '2021-10-06 11:32:25'),
(64360, NULL, 'test-test', 'test', 'test', 'test@gmail.com', '$2y$10$EKWm.OyjZk/O817Gtzg7xOpHO4rCoTjAAVkUNOITl4/AJmgxMFzH2', '123456', NULL, '::1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2021-10-13 04:30:20', '2021-10-13 04:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_assets_has_movement`
--

CREATE TABLE `user_assets_has_movement` (
  `id` int NOT NULL,
  `fk_user_id` int DEFAULT NULL,
  `fk_asset_id` int DEFAULT NULL,
  `moved_from` varchar(255) DEFAULT NULL,
  `moved_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_assets_has_movement`
--

INSERT INTO `user_assets_has_movement` (`id`, `fk_user_id`, `fk_asset_id`, `moved_from`, `moved_to`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '123', 'santa cruise', '2021-12-01 03:59:12', '2021-12-20 09:30:18'),
(2, 1, 2, 'santa cruise', 'banta cruise', '2021-12-16 03:59:12', '2021-12-20 09:30:21'),
(3, 1, 2, 'banta cruise', 'santa cruise', '2021-12-30 03:59:12', '2021-12-20 09:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_asset_has_images`
--

CREATE TABLE `user_asset_has_images` (
  `id` int NOT NULL,
  `fk_user_id` int NOT NULL,
  `fk_asset_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_asset_has_images`
--

INSERT INTO `user_asset_has_images` (`id`, `fk_user_id`, `fk_asset_id`, `image`, `thumb`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 'asset/image/2/1639635330-2021-12-1517-17.png', 'asset/image/2/thumb/1639635330-2021-12-1517-17.png', '2021-12-16 00:45:30', '2021-12-16 00:45:30'),
(7, 1, 2, 'asset/image/2/1639635330-screenshot-from-2021-12-14-13-22-03.png', 'asset/image/2/thumb/1639635330-screenshot-from-2021-12-14-13-22-03.png', '2021-12-16 00:45:30', '2021-12-16 00:45:30'),
(8, 1, 2, 'asset/image/2/1639635330-bankpaassbook.png', 'asset/image/2/thumb/1639635330-bankpaassbook.png', '2021-12-16 00:45:30', '2021-12-16 00:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_assets`
--

CREATE TABLE `user_has_assets` (
  `id` int NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `fk_user_id` int NOT NULL,
  `fk_team_id` int NOT NULL,
  `fa_type` varchar(255) DEFAULT NULL,
  `code_bar_id` varchar(255) DEFAULT NULL,
  `fk_category_id` int NOT NULL,
  `equipment_description` text,
  `acquisition_date` date DEFAULT NULL,
  `acquisition_cost_local` varchar(255) NOT NULL,
  `acquisition_cost_usd` varchar(255) DEFAULT NULL,
  `purchased_with_donor_funds` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `in_country_location` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `invoice_document` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serial_vehicle_identification_logbook` varchar(255) DEFAULT NULL,
  `confirmed_by` varchar(255) DEFAULT NULL,
  `inventory_confirmation_date` date DEFAULT NULL,
  `comments` text,
  `still_with_chai` varchar(255) DEFAULT NULL,
  `disposal_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_has_assets`
--

INSERT INTO `user_has_assets` (`id`, `slug`, `fk_user_id`, `fk_team_id`, `fa_type`, `code_bar_id`, `fk_category_id`, `equipment_description`, `acquisition_date`, `acquisition_cost_local`, `acquisition_cost_usd`, `purchased_with_donor_funds`, `project_id`, `in_country_location`, `invoice`, `invoice_document`, `manufacturer`, `model`, `serial_vehicle_identification_logbook`, `confirmed_by`, `inventory_confirmation_date`, `comments`, `still_with_chai`, `disposal_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1-dell-laptop-model-3456', 1, 1, '', 'CHAI-KIN-RDC-IT-EQUIPMENT-001', 2, 'Dell laptop Model 3456', '1981-01-02', '', '', '', '', '', '12213123', 'invoice/1/1634121893-one-page-presentation..pdf', '', '', '', '', NULL, '', '', NULL, 'active', '2021-10-13 05:12:39', '2021-12-23 22:41:39', NULL),
(2, '2-hp-inspiron', 1, 1, '', 'CHAI-KIN-RDC-EQUIPMENT-002', 4, 'HP inspiron', '2016-07-07', '123', '123', 'yes', '123', 'santa cruise', '12312332', 'asset/invoice/2/1639314772-october.pdf', '', '', '', '', NULL, '', '', NULL, 'active', '2021-12-12 07:42:52', '2021-12-23 22:41:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_types`
--
ALTER TABLE `asset_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remember_me`
--
ALTER TABLE `remember_me`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_assets_has_movement`
--
ALTER TABLE `user_assets_has_movement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_asset_has_images`
--
ALTER TABLE `user_asset_has_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_has_assets`
--
ALTER TABLE `user_has_assets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_types`
--
ALTER TABLE `asset_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `remember_me`
--
ALTER TABLE `remember_me`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64361;

--
-- AUTO_INCREMENT for table `user_assets_has_movement`
--
ALTER TABLE `user_assets_has_movement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_asset_has_images`
--
ALTER TABLE `user_asset_has_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_has_assets`
--
ALTER TABLE `user_has_assets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
