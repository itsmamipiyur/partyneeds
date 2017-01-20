-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2017 at 04:48 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcater`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_01_12_051243_add_timestamp_to_tblCustomer', 1),
(4, '2017_01_12_072624_add_timestamps_to_tblEquipmentType', 1),
(5, '2017_01_12_093714_add_timestamps_to_tblEquipment', 1),
(6, '2017_01_13_065037_add_timestamp_to_tblFoodCategory', 1),
(7, '2017_01_15_155634_add_timestamp_to_EventBooking', 1),
(8, '2017_01_15_155854_add_timestamp_to_EventMenu', 1),
(9, '2017_01_15_162528_add_timestamp_to_EventType', 1),
(10, '2017_01_15_162551_add_timestamp_to_Food', 1),
(11, '2017_01_15_162615_add_timestamp_to_FoodCategory', 2),
(12, '2017_01_15_162632_add_timestamp_to_FoodMenu', 2),
(13, '2017_01_15_162646_add_timestamp_to_Menu', 2),
(14, '2017_01_15_162704_add_timestamp_to_MenuType', 2),
(15, '2017_01_15_162729_add_timestamp_to_PackageMenu', 2),
(16, '2017_01_15_162744_add_timestamp_to_Service', 2),
(17, '2017_01_15_162758_add_timestamp_to_ServiceType', 2),
(18, '2017_01_15_184600_add_timestamp_to_tblWaiter', 2),
(19, '2017_01_15_184631_add_timestamp_to_tblEventDrink', 2),
(20, '2017_01_15_184722_add_timestamp_to_tblEventWaiter', 2),
(21, '2017_01_15_184818_add_timestamp_to_tblDamageFee', 2),
(22, '2017_01_15_184928_add_timestamp_to_tblDrink', 2),
(23, '2017_01_15_184943_add_timestamp_to_tblStaff', 2),
(24, '2017_01_15_185014_add_timestamp_to_tblMotif', 2),
(25, '2017_01_15_185059_add_timestamp_to_tblEventMotif', 2),
(26, '2017_01_15_185119_add_timestamp_to_tblEquipmentRate', 2),
(27, '2017_01_15_185347_add_timestamp_to_tblDeliveryFee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `strCustId` varchar(45) NOT NULL,
  `strCustFirst` varchar(100) NOT NULL,
  `strCustMiddle` varchar(100) DEFAULT NULL,
  `strCustLast` varchar(100) NOT NULL,
  `strCustAddress` text NOT NULL,
  `strCustContact` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`strCustId`, `strCustFirst`, `strCustMiddle`, `strCustLast`, `strCustAddress`, `strCustContact`, `created_at`, `updated_at`, `deleted_at`) VALUES
('CUST0001', 'John', 'Rodriguez', 'Romasanta', 'San Jose del Monte, Bulacan', '09999225776', '2017-01-20 07:27:40', '2017-01-20 08:45:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldamagefee`
--

CREATE TABLE `tbldamagefee` (
  `strDamaFeeId` varchar(45) NOT NULL,
  `strDamaFeeName` varchar(100) NOT NULL,
  `strDamaFeeEquiId` varchar(45) NOT NULL,
  `txtDamaFeeDesc` text,
  `dblDamaFeeAmount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliveryfee`
--

CREATE TABLE `tbldeliveryfee` (
  `strDeliFeeId` varchar(45) NOT NULL,
  `strDeliFeeName` varchar(100) NOT NULL,
  `txtDeliFeeDesc` text,
  `dblDeliFeeAmount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbldrink`
--

CREATE TABLE `tbldrink` (
  `strDrinkId` varchar(45) NOT NULL,
  `strDrinkName` varchar(100) NOT NULL,
  `txtDrinkDesc` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldrink`
--

INSERT INTO `tbldrink` (`strDrinkId`, `strDrinkName`, `txtDrinkDesc`, `updated_at`, `created_at`, `deleted_at`) VALUES
('DRK0001', 'Mineral Water', 'wattaaah', '2017-01-20 08:36:19', '2017-01-20 08:18:07', NULL),
('DRK0002', 'Iced Tea', 'yas', '2017-01-20 08:18:36', '2017-01-20 08:18:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment`
--

CREATE TABLE `tblequipment` (
  `strEquiId` varchar(45) NOT NULL,
  `strEquiName` varchar(100) NOT NULL,
  `strEquiEquiTypeId` varchar(45) NOT NULL,
  `txtEquiDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblequipment`
--

INSERT INTO `tblequipment` (`strEquiId`, `strEquiName`, `strEquiEquiTypeId`, `txtEquiDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('EQUI0001', 'Videoke Sets', 'EQUITYPE0003', 'ssss', '2017-01-20 07:54:54', '2017-01-20 08:41:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblequipmentrate`
--

CREATE TABLE `tblequipmentrate` (
  `strEquiRateEquiId` varchar(45) NOT NULL,
  `dblEquiRateRate` decimal(10,2) NOT NULL,
  `dtmEquiRateAsOf` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblequipmenttype`
--

CREATE TABLE `tblequipmenttype` (
  `strEquiTypeId` varchar(45) NOT NULL,
  `strEquiTypeName` varchar(100) NOT NULL,
  `txtEquiTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblequipmenttype`
--

INSERT INTO `tblequipmenttype` (`strEquiTypeId`, `strEquiTypeName`, `txtEquiTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('EQUITYPE0001', 'Rental Equipments', 'lol', '2017-01-20 07:47:57', '2017-01-20 08:41:40', NULL),
('EQUITYPE0002', 'Catering Equipment', 'caterrsss', '2017-01-20 07:50:22', '2017-01-20 08:23:01', NULL),
('EQUITYPE0003', 'Electronics', 'kuryente', '2017-01-20 07:52:00', '2017-01-20 07:52:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbleventbooking`
--

CREATE TABLE `tbleventbooking` (
  `strEvenBookId` varchar(45) NOT NULL,
  `strEvenBookCustId` varchar(45) NOT NULL,
  `strEvenBookTransDate` datetime NOT NULL,
  `dtmEvenBookSchedule` datetime NOT NULL,
  `strEvenBookAddress` text,
  `strEvenBookEvenTypeId` varchar(45) DEFAULT NULL,
  `txtEvenBookDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventdrink`
--

CREATE TABLE `tbleventdrink` (
  `strEvenDrinEvenBookId` varchar(45) NOT NULL,
  `strEvenDrinDrinId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventmenu`
--

CREATE TABLE `tbleventmenu` (
  `strEvenMenuEvenBookId` varchar(45) NOT NULL,
  `strEvenMenuMenuId` varchar(45) NOT NULL,
  `intEvenMenuPax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventmotif`
--

CREATE TABLE `tbleventmotif` (
  `strEvenMotiEvenBookId` varchar(45) NOT NULL,
  `strEvenMotiMotiId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventtype`
--

CREATE TABLE `tbleventtype` (
  `strEvenTypeId` varchar(45) NOT NULL,
  `strEvenTypeName` varchar(100) NOT NULL,
  `txtEvenTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbleventtype`
--

INSERT INTO `tbleventtype` (`strEvenTypeId`, `strEvenTypeName`, `txtEvenTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('EVNTYPE0001', 'Weddings', '', '2017-01-20 08:09:39', '2017-01-20 08:41:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbleventwaiter`
--

CREATE TABLE `tbleventwaiter` (
  `strEvenWaitEvenBookId` varchar(45) NOT NULL,
  `strEvenWaitWaitId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblfood`
--

CREATE TABLE `tblfood` (
  `strFoodId` varchar(45) NOT NULL,
  `strFoodName` varchar(100) NOT NULL,
  `strFoodFoodCateId` varchar(45) NOT NULL,
  `txtFoodDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfood`
--

INSERT INTO `tblfood` (`strFoodId`, `strFoodName`, `strFoodFoodCateId`, `txtFoodDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('FOOD0001', 'Chicken Afritada', 'FOODCATE0001', 'Yummysss', '2017-01-20 07:34:35', '2017-01-20 08:45:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfoodcategory`
--

CREATE TABLE `tblfoodcategory` (
  `strFoodCateId` varchar(45) NOT NULL,
  `strFoodCateName` varchar(100) NOT NULL,
  `txtFoodCateDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfoodcategory`
--

INSERT INTO `tblfoodcategory` (`strFoodCateId`, `strFoodCateName`, `txtFoodCateDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('FOODCATE0001', 'Chicken', 'sdasada', '2017-01-20 07:32:00', '2017-01-20 08:44:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfoodmenu`
--

CREATE TABLE `tblfoodmenu` (
  `strFoodMenuMenuId` varchar(45) NOT NULL,
  `strFoodMenuFoodId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblmenu`
--

CREATE TABLE `tblmenu` (
  `strMenuId` varchar(45) NOT NULL,
  `dtmMenuCreatedAt` datetime NOT NULL,
  `dblMenuRate` decimal(10,2) NOT NULL,
  `strMenuMenuType` varchar(45) NOT NULL,
  `txtMenuDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblmenutype`
--

CREATE TABLE `tblmenutype` (
  `strMenuTypeId` varchar(45) NOT NULL,
  `strMenuTypeName` varchar(100) NOT NULL,
  `txtMenuTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblmotif`
--

CREATE TABLE `tblmotif` (
  `strMotiId` varchar(45) NOT NULL,
  `strMotiName` varchar(100) NOT NULL,
  `txtMotiDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmotif`
--

INSERT INTO `tblmotif` (`strMotiId`, `strMotiName`, `txtMotiDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('MOTIF0001', 'Ben 10', 'Woww', '2017-01-16 00:13:41', '2017-01-20 08:10:24', NULL),
('MOTIF0002', 'Barbie', NULL, '2017-01-16 00:43:29', '2017-01-20 08:14:31', NULL),
('MOTIF0003', 'Pink', 'Color', '2017-01-16 00:44:23', '2017-01-16 00:44:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage`
--

CREATE TABLE `tblpackage` (
  `strPackId` varchar(45) NOT NULL,
  `strPackName` varchar(100) NOT NULL,
  `txtPackDesc` text,
  `dblPackRate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblpackagemenu`
--

CREATE TABLE `tblpackagemenu` (
  `strPackMenuPackId` varchar(45) NOT NULL,
  `strPackMenuMenuId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblservice`
--

CREATE TABLE `tblservice` (
  `strServId` varchar(45) NOT NULL,
  `strServName` varchar(100) NOT NULL,
  `strServServType` varchar(45) NOT NULL,
  `txtServDesc` text,
  `dblServRate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblservicetype`
--

CREATE TABLE `tblservicetype` (
  `strServTypeId` varchar(45) NOT NULL,
  `strServTypeName` varchar(100) NOT NULL,
  `txtServTypeDesc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `strStafId` varchar(45) NOT NULL,
  `strStafFirst` varchar(100) NOT NULL,
  `strStafMiddle` varchar(100) DEFAULT NULL,
  `strStafLast` varchar(100) NOT NULL,
  `strStafPassword` varchar(50) NOT NULL,
  `intStafIsAdmin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblwaiter`
--

CREATE TABLE `tblwaiter` (
  `strWaitId` varchar(45) NOT NULL,
  `strWaitFirst` varchar(100) NOT NULL,
  `strWaitMiddle` varchar(100) DEFAULT NULL,
  `strWaitLast` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@localhost.com', '$2y$10$RVCbtKBs5q1wlqKgjqqN4Oqf2HCmDSnGT0t.Vd6TFgRcclhwy2pvS', NULL, '2017-01-15 23:46:49', '2017-01-15 23:46:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`strCustId`);

--
-- Indexes for table `tbldamagefee`
--
ALTER TABLE `tbldamagefee`
  ADD PRIMARY KEY (`strDamaFeeId`),
  ADD KEY `fk_strDamaFeeEquiId_idx` (`strDamaFeeEquiId`);

--
-- Indexes for table `tbldeliveryfee`
--
ALTER TABLE `tbldeliveryfee`
  ADD PRIMARY KEY (`strDeliFeeId`);

--
-- Indexes for table `tbldrink`
--
ALTER TABLE `tbldrink`
  ADD PRIMARY KEY (`strDrinkId`);

--
-- Indexes for table `tblequipment`
--
ALTER TABLE `tblequipment`
  ADD PRIMARY KEY (`strEquiId`),
  ADD KEY `fk_strEquiEquiTypeId_idx` (`strEquiEquiTypeId`);

--
-- Indexes for table `tblequipmentrate`
--
ALTER TABLE `tblequipmentrate`
  ADD PRIMARY KEY (`strEquiRateEquiId`),
  ADD KEY `fk_strEquiRateEquiId_idx` (`strEquiRateEquiId`);

--
-- Indexes for table `tblequipmenttype`
--
ALTER TABLE `tblequipmenttype`
  ADD PRIMARY KEY (`strEquiTypeId`);

--
-- Indexes for table `tbleventbooking`
--
ALTER TABLE `tbleventbooking`
  ADD PRIMARY KEY (`strEvenBookId`),
  ADD KEY `fk_strEvenBookCustId_idx` (`strEvenBookCustId`),
  ADD KEY `fk_strEvenBookEvenTypeId_idx` (`strEvenBookEvenTypeId`);

--
-- Indexes for table `tbleventdrink`
--
ALTER TABLE `tbleventdrink`
  ADD PRIMARY KEY (`strEvenDrinEvenBookId`,`strEvenDrinDrinId`),
  ADD KEY `fk_strEvenDrinDrinId_idx` (`strEvenDrinDrinId`);

--
-- Indexes for table `tbleventmenu`
--
ALTER TABLE `tbleventmenu`
  ADD PRIMARY KEY (`strEvenMenuEvenBookId`,`strEvenMenuMenuId`),
  ADD KEY `fk_strEvenMenuMenuId_idx` (`strEvenMenuMenuId`);

--
-- Indexes for table `tbleventmotif`
--
ALTER TABLE `tbleventmotif`
  ADD PRIMARY KEY (`strEvenMotiEvenBookId`),
  ADD KEY `fk_strEvenMotiMotiId_idx` (`strEvenMotiMotiId`);

--
-- Indexes for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  ADD PRIMARY KEY (`strEvenTypeId`);

--
-- Indexes for table `tbleventwaiter`
--
ALTER TABLE `tbleventwaiter`
  ADD PRIMARY KEY (`strEvenWaitEvenBookId`,`strEvenWaitWaitId`),
  ADD KEY `fk_strEvenWaitWaitId_idx` (`strEvenWaitWaitId`);

--
-- Indexes for table `tblfood`
--
ALTER TABLE `tblfood`
  ADD PRIMARY KEY (`strFoodId`),
  ADD KEY `fk_strFoodFoodCateId_idx` (`strFoodFoodCateId`);

--
-- Indexes for table `tblfoodcategory`
--
ALTER TABLE `tblfoodcategory`
  ADD PRIMARY KEY (`strFoodCateId`);

--
-- Indexes for table `tblfoodmenu`
--
ALTER TABLE `tblfoodmenu`
  ADD PRIMARY KEY (`strFoodMenuMenuId`,`strFoodMenuFoodId`),
  ADD KEY `fk_strFoodMenuFoodId_idx` (`strFoodMenuFoodId`);

--
-- Indexes for table `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`strMenuId`),
  ADD KEY `fk_strMenuMenuType_idx` (`strMenuMenuType`);

--
-- Indexes for table `tblmenutype`
--
ALTER TABLE `tblmenutype`
  ADD PRIMARY KEY (`strMenuTypeId`);

--
-- Indexes for table `tblmotif`
--
ALTER TABLE `tblmotif`
  ADD PRIMARY KEY (`strMotiId`);

--
-- Indexes for table `tblpackage`
--
ALTER TABLE `tblpackage`
  ADD PRIMARY KEY (`strPackId`);

--
-- Indexes for table `tblpackagemenu`
--
ALTER TABLE `tblpackagemenu`
  ADD PRIMARY KEY (`strPackMenuPackId`,`strPackMenuMenuId`),
  ADD KEY `fk_strPackMenuMenuId_idx` (`strPackMenuMenuId`);

--
-- Indexes for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD PRIMARY KEY (`strServId`),
  ADD KEY `fk_strServServType_idx` (`strServServType`);

--
-- Indexes for table `tblservicetype`
--
ALTER TABLE `tblservicetype`
  ADD PRIMARY KEY (`strServTypeId`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`strStafId`);

--
-- Indexes for table `tblwaiter`
--
ALTER TABLE `tblwaiter`
  ADD PRIMARY KEY (`strWaitId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbldamagefee`
--
ALTER TABLE `tbldamagefee`
  ADD CONSTRAINT `fk_strDamaFeeEquiId` FOREIGN KEY (`strDamaFeeEquiId`) REFERENCES `tblequipment` (`strEquiId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblequipment`
--
ALTER TABLE `tblequipment`
  ADD CONSTRAINT `fk_strEquiEquiTypeId` FOREIGN KEY (`strEquiEquiTypeId`) REFERENCES `tblequipmenttype` (`strEquiTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblequipmentrate`
--
ALTER TABLE `tblequipmentrate`
  ADD CONSTRAINT `fk_strEquiRateEquiId` FOREIGN KEY (`strEquiRateEquiId`) REFERENCES `tblequipment` (`strEquiId`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventbooking`
--
ALTER TABLE `tbleventbooking`
  ADD CONSTRAINT `fk_strEvenBookCustId` FOREIGN KEY (`strEvenBookCustId`) REFERENCES `tblcustomer` (`strCustId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strEvenBookEvenTypeId` FOREIGN KEY (`strEvenBookEvenTypeId`) REFERENCES `tbleventtype` (`strEvenTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventdrink`
--
ALTER TABLE `tbleventdrink`
  ADD CONSTRAINT `fk_strEvenDrinDrinId` FOREIGN KEY (`strEvenDrinDrinId`) REFERENCES `tbldrink` (`strDrinkId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strEvenDrinEvenBookId` FOREIGN KEY (`strEvenDrinEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventmenu`
--
ALTER TABLE `tbleventmenu`
  ADD CONSTRAINT `fk_strEvenMenuEvenBookId` FOREIGN KEY (`strEvenMenuEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strEvenMenuMenuId` FOREIGN KEY (`strEvenMenuMenuId`) REFERENCES `tblmenu` (`strMenuId`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventmotif`
--
ALTER TABLE `tbleventmotif`
  ADD CONSTRAINT `fk_strEvenMotiEvenBookId` FOREIGN KEY (`strEvenMotiEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strEvenMotiMotiId` FOREIGN KEY (`strEvenMotiMotiId`) REFERENCES `tblmotif` (`strMotiId`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventwaiter`
--
ALTER TABLE `tbleventwaiter`
  ADD CONSTRAINT `fk_strEvenWaitEvenBookId` FOREIGN KEY (`strEvenWaitEvenBookId`) REFERENCES `tbleventbooking` (`strEvenBookId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strEvenWaitWaitId` FOREIGN KEY (`strEvenWaitWaitId`) REFERENCES `tblwaiter` (`strWaitId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblfood`
--
ALTER TABLE `tblfood`
  ADD CONSTRAINT `fk_strFoodFoodCateId` FOREIGN KEY (`strFoodFoodCateId`) REFERENCES `tblfoodcategory` (`strFoodCateId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblfoodmenu`
--
ALTER TABLE `tblfoodmenu`
  ADD CONSTRAINT `fk_strFoodMenuFoodId` FOREIGN KEY (`strFoodMenuFoodId`) REFERENCES `tblfood` (`strFoodId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strFoodMenuMenuId` FOREIGN KEY (`strFoodMenuMenuId`) REFERENCES `tblmenu` (`strMenuId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD CONSTRAINT `fk_strMenuMenuType` FOREIGN KEY (`strMenuMenuType`) REFERENCES `tblmenutype` (`strMenuTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblpackagemenu`
--
ALTER TABLE `tblpackagemenu`
  ADD CONSTRAINT `fk_strPackMenuMenuId` FOREIGN KEY (`strPackMenuMenuId`) REFERENCES `tblmenu` (`strMenuId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_strPackMenuPackId` FOREIGN KEY (`strPackMenuPackId`) REFERENCES `tblpackage` (`strPackId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD CONSTRAINT `fk_strServServType` FOREIGN KEY (`strServServType`) REFERENCES `tblservicetype` (`strServTypeId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
