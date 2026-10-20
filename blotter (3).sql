-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 03:28 PM
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
-- Table structure for table `blotter`
--

CREATE TABLE `blotter` (
  `blotterSeries` int(10) NOT NULL,
  `dates` varchar(50) DEFAULT NULL,
  `complainantName` varchar(50) DEFAULT NULL,
  `complainantAge` int(10) DEFAULT NULL,
  `complainantAddress` varchar(100) DEFAULT NULL,
  `complainantContact` int(20) DEFAULT NULL,
  `defendantName` varchar(50) DEFAULT NULL,
  `defendantAge` int(10) DEFAULT NULL,
  `defendantAddress` varchar(100) DEFAULT NULL,
  `defendantContact` int(20) DEFAULT NULL,
  `complaints` varchar(255) DEFAULT NULL,
  `blotterTime` time DEFAULT NULL,
  `blotterDate` date DEFAULT NULL,
  `blotterPlace` varchar(255) DEFAULT NULL,
  `narrative` text DEFAULT NULL,
  `officerName` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`blotterSeries`, `dates`, `complainantName`, `complainantAge`, `complainantAddress`, `complainantContact`, `defendantName`, `defendantAge`, `defendantAddress`, `defendantContact`, `complaints`, `blotterTime`, `blotterDate`, `blotterPlace`, `narrative`, `officerName`, `position`) VALUES
(123, '2025-04-20', 'Hershey A. Hestiada', 20, 'buenavista', 147483647, 'Rhona Eloisa Lumbes', 19, 'Balinad Daraga Albay', 147483647, 'huhuhuhu', '10:00:00', '2025-04-20', 'buenavista', 'ahahdfw bamjgdujtw6 hagdujwgu', 'Ayis Lobarbio', 'Barangay Captain'),
(320, '', '', 0, '', 0, '', 0, '', 0, '', '00:00:00', '0000-00-00', '', '\r\n                    ', '', ''),
(3201, '', '', 0, '', 0, '', 0, '', 0, '', '00:00:00', '0000-00-00', '', '\r\n                    ', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
