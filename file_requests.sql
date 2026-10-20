-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 03:19 AM
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
-- Table structure for table `file_requests`
--

CREATE TABLE `file_requests` (
  `id` int(11) NOT NULL,
  `resident_ID` int(11) NOT NULL,
  `request_type` varchar(100) NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected','Claimed') DEFAULT 'Pending',
  `claim_date` date DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `business_location` varchar(255) DEFAULT NULL,
  `purpose` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_requests`
--

INSERT INTO `file_requests` (`id`, `resident_ID`, `request_type`, `request_date`, `status`, `claim_date`, `rejection_reason`, `business_name`, `business_location`, `purpose`) VALUES
(5, 1001, 'indigency', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(6, 1001, 'indigency', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(7, 1002, 'residency', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(8, 1002, 'indigency', '2025-05-11', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1002, 'clearance', '2025-05-11', 'Claimed', NULL, NULL, NULL, NULL, NULL),
(10, 1002, 'businessPermit', '2025-05-11', 'Approved', NULL, NULL, NULL, NULL, NULL),
(11, 1002, 'residency', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(12, 1002, 'clearance', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(13, 1002, 'clearance', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(14, 1003, 'indigency', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(15, 1003, 'businessPermit', '2025-05-11', 'Pending', NULL, NULL, NULL, NULL, NULL),
(16, 1003, 'resdency', '2025-05-12', 'Pending', NULL, NULL, NULL, NULL, NULL),
(17, 1001, 'resdency', '2025-05-17', 'Pending', NULL, NULL, NULL, NULL, NULL),
(18, 1001, 'clearance', '2025-05-17', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1001, 'clearance', '2025-05-17', 'Claimed', NULL, NULL, NULL, NULL, NULL),
(20, 1001, 'residency', '2025-05-17', 'Approved', NULL, NULL, NULL, NULL, NULL),
(31, 1001, 'businessPermit', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, NULL),
(32, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(33, 1001, 'businessPermit', '2025-05-19', 'Claimed', NULL, NULL, 'Hershey', 'Balinad', NULL),
(34, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(35, 1001, 'businessPermit', '2025-05-19', 'Claimed', NULL, NULL, 'Rhona', 'Balinad', NULL),
(36, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(37, 1001, 'businessPermit', '2025-05-19', 'Pending', NULL, NULL, 'Hershey', 'Balinadhuhu', NULL),
(38, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(39, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(40, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(41, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(42, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(43, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(44, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(45, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(46, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'huhu'),
(47, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'uhuhuhuuhu'),
(48, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'hu'),
(49, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'huhu'),
(50, 1001, 'clearance', '2025-05-19', 'Claimed', NULL, NULL, NULL, NULL, 'hu'),
(51, 1001, 'clearance', '2025-05-19', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_requests`
--
ALTER TABLE `file_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_requests`
--
ALTER TABLE `file_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_requests`
--
ALTER TABLE `file_requests`
  ADD CONSTRAINT `file_requests_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `resident_info` (`resident_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
