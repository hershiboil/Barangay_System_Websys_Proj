-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 03:48 AM
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
-- Database: `blotter`
--

-- --------------------------------------------------------

--
-- Table structure for table `blotter`
--

CREATE TABLE `blotter` (
  `blotterSeries` int(10),
  `dates` varchar(50),
  `complainantName` varchar(50),
  `complainantAge` int(10),
  `complainantAddress` varchar(100),
  `complainantContact` int(20),
  `defendantName` varchar(50),
  `defendantAge` int(10),
  `defendantAddress` varchar(100),
  `defendantContact` int(20),
  `complaints` varchar(255),
  `blotterTime` time,
  `blotterDate` date,
  `blotterPlace` varchar(255),
  `narrative` text,
  `officerName` varchar(50),
  `position` varchar(50) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`blotterSeries`, `dates`, `complainantName`, `complainantAge`, `complainantAddress`, `complainantContact`, `defendantName`, `defendantAge`, `defendantAddress`, `defendantContact`, `narrative`, `officerName`, `position`) VALUES
(123, '2025-04-20', 'Hershey A. Hestiada', 20, 'buenavista', 2147483647, 'Rhona Eloisa Lumbes', 19, 'Balinad Daraga Albay', 2147483647, 'ahahdfw bamjgdujtw6 hagdujwgu', 'Ayis Lobarbio', 'Barangay Captain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blotter`
--
ALTER TABLE `blotter`
  ADD PRIMARY KEY (`blotterSeries`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blotter`
--
ALTER TABLE `blotter`
  MODIFY `blotterSeries` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12346;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
