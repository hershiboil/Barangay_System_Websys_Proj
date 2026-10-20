-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 06:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay_officials`
--

CREATE TABLE `barangay_officials` (
  `officialID` int(5) NOT NULL,
  `officialName` varchar(50) NOT NULL,
  `officialPosition` varchar(50) NOT NULL,
  `imgPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_officials`
--

INSERT INTO `barangay_officials` (`officialID`, `officialName`, `officialPosition`, `imgPath`) VALUES
(1, 'Leni Robredo', 'Barangay Captain', 'user.png'),
(2, 'Elias Montgomery', 'Kagawad', 'user1.png'),
(3, 'Nova Castillo', 'Kagawad', 'user2.png'),
(4, 'Jasper Whitmore', 'Kagawad', 'user3.png'),
(5, 'Liana Vasquez', 'Kagawad', 'user4.png'),
(6, 'Orion Sinclair', 'Kagawad', 'user5.png'),
(7, 'Marisol Delgado', 'Kagawad', 'user6.png'),
(8, 'Zane Holloway', 'Kagawad', 'user7.png'),
(9, 'Selene Laurent', 'SK chairman', 'user8.png'),
(10, 'Felix Carmichael', 'Treasurer', 'user9.png'),
(11, 'Amara Sterling', 'Secretary', 'user10.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_officials`
--
ALTER TABLE `barangay_officials`
  ADD PRIMARY KEY (`officialID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_officials`
--
ALTER TABLE `barangay_officials`
  MODIFY `officialID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
