-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 04:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transmittal`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_transmittal`
--

CREATE TABLE `new_transmittal` (
  `new_transmittalID` bigint(20) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `receiverName` varchar(100) NOT NULL,
  `receiverTelephone` varchar(100) NOT NULL,
  `receiverAddress` text NOT NULL,
  `receiverProvince` varchar(100) NOT NULL,
  `receiverCity` varchar(100) NOT NULL,
  `receiverRegion` varbinary(100) NOT NULL,
  `isMetroManila` int(11) NOT NULL,
  `parcelName` text NOT NULL,
  `totalParcel` bigint(20) NOT NULL,
  `COD` decimal(15,2) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateDeleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_transmittal`
--

INSERT INTO `new_transmittal` (`new_transmittalID`, `companyName`, `receiverName`, `receiverTelephone`, `receiverAddress`, `receiverProvince`, `receiverCity`, `receiverRegion`, `isMetroManila`, `parcelName`, `totalParcel`, `COD`, `remarks`, `dateUpdated`, `dateCreated`, `dateDeleted`) VALUES
(1, 'Jem', 'Jean Marie Justado', '9214536102', 'Blk 1 Lot 45 You', 'Metro Manila', 'Cainta', 0x4e4352, 1, 'Jelly Cushion Bu', 2, '0.00', '#1022', '2021-02-25 03:27:17', '2021-02-25 03:27:17', NULL),
(2, 'Jem', 'Arjay Diangzon', '9099054722', 'Blk 10 Lot 22 Sa', 'Metro Manila', 'Cainta', 0x6e6372, 1, 'Car Pillow Massa', 1, '1599.00', '#2216', '2021-02-25 03:27:44', '2021-02-25 03:27:17', NULL),
(3, 'Jem', 'Pamela Cajalne', '9065242391', 'Blk 5 Lot 9 Santo', 'Metro Manila', 'Makati', 0x4e4352, 1, 'Facial Brush', 1, '1685.00', '#1006', '2021-02-25 03:27:17', '2021-02-25 03:27:17', NULL),
(4, 'Jem', 'Sofia Elaine Vergara', '9565206252', '251 Rosario Orti', 'Metro Manila', 'Pasig', 0x4e4352, 0, 'Blackhead Remo', 1, '849.00', '#0122', '2021-02-25 03:27:57', '2021-02-25 03:27:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transmittal`
--

CREATE TABLE `transmittal` (
  `transmittalID` bigint(20) NOT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `receiverName` varchar(100) DEFAULT NULL,
  `receiverTelephone` varchar(100) DEFAULT NULL,
  `receiverAddress` text DEFAULT NULL,
  `receiverProvince` varchar(100) DEFAULT NULL,
  `receiverCity` varchar(100) DEFAULT NULL,
  `receiverRegion` varchar(100) DEFAULT NULL,
  `isMetroManila` int(11) NOT NULL,
  `parcelName` text DEFAULT NULL,
  `totalParcel` bigint(20) DEFAULT NULL,
  `COD` decimal(15,2) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `inspected` varchar(100) DEFAULT NULL,
  `rider` varchar(100) DEFAULT NULL,
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateDeleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_accountID` bigint(20) NOT NULL,
  `companyID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `contactNumber` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateDeleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_accountID`, `companyID`, `roleID`, `firstname`, `middlename`, `lastname`, `username`, `email`, `password`, `contactNumber`, `status`, `dateUpdated`, `dateCreated`, `dateDeleted`) VALUES
(1, 1, 1, 'Iam', NULL, 'Admin', 'admin', 'admin@gmail.com', 'admin', '0909-905-4766', 1, '2020-11-21 01:42:48', '2020-11-21 01:42:48', NULL),
(2, 1, 1, 'Arjay', NULL, 'Diangzon', 'arjaydiangzon', 'arjaydiangzon@gmail.com', 'arjaydiangzon', '0909-905-4767', 1, '2020-11-21 01:42:48', '2020-11-21 01:42:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_transmittal`
--
ALTER TABLE `new_transmittal`
  ADD PRIMARY KEY (`new_transmittalID`);

--
-- Indexes for table `transmittal`
--
ALTER TABLE `transmittal`
  ADD PRIMARY KEY (`transmittalID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_accountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `new_transmittal`
--
ALTER TABLE `new_transmittal`
  MODIFY `new_transmittalID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transmittal`
--
ALTER TABLE `transmittal`
  MODIFY `transmittalID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_accountID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
