-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 03:32 AM
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
-- Database: `certificate_requests`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `request_type` enum('indigency','clearance','residency','businessPermit') NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `claim_date` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_type`, `request_date`, `status`, `claim_date`, `rejection_reason`) VALUES
(3, 'residency', '2025-04-19 19:56:53', 'approved', '2005-11-11 03:00:00', NULL),
(5, 'businessPermit', '2025-04-19 19:57:01', 'approved', '2025-04-19 14:04:53', NULL),
(6, 'clearance', '2025-04-19 19:57:31', 'approved', '2025-04-19 13:58:04', NULL),
(7, 'residency', '2025-04-19 19:57:41', 'approved', '2025-04-19 13:57:59', NULL),
(8, 'residency', '2025-04-19 20:18:29', 'pending', NULL, NULL),
(9, 'clearance', '2025-04-20 02:11:42', 'pending', NULL, NULL),
(10, 'businessPermit', '2025-04-20 02:11:50', 'approved', '2005-12-10 04:00:00', NULL),
(11, 'businessPermit', '2025-04-20 02:18:54', 'rejected', NULL, 'kasi naman'),
(12, 'indigency', '2025-04-20 02:58:19', 'pending', NULL, NULL),
(13, 'clearance', '2025-04-20 02:58:27', 'rejected', NULL, 'kasi ikaw'),
(14, 'indigency', '2025-04-20 03:02:03', 'pending', NULL, NULL),
(15, 'businessPermit', '2025-04-20 03:03:03', 'pending', NULL, NULL),
(16, 'indigency', '2025-04-20 04:57:06', 'approved', '2005-10-17 04:00:00', NULL),
(17, 'indigency', '2025-04-20 05:06:50', 'pending', NULL, NULL),
(18, 'indigency', '2025-04-20 05:10:29', 'approved', '2000-11-11 04:00:00', NULL),
(19, 'indigency', '2025-04-20 05:17:43', 'rejected', NULL, 'bakit ba'),
(20, 'indigency', '2025-04-20 05:24:45', 'pending', NULL, NULL),
(21, 'indigency', '2025-04-20 05:26:42', 'pending', NULL, NULL),
(22, 'indigency', '2025-04-20 05:32:15', 'pending', NULL, NULL),
(23, 'businessPermit', '2025-04-20 05:34:18', 'pending', NULL, NULL),
(24, 'indigency', '2025-04-20 05:45:47', 'pending', NULL, NULL),
(25, 'indigency', '2025-04-20 05:46:17', 'pending', NULL, NULL),
(26, 'indigency', '2025-04-20 05:48:43', 'pending', NULL, NULL),
(27, 'clearance', '2025-04-20 06:01:57', 'pending', NULL, NULL),
(28, 'indigency', '2025-04-20 06:02:19', 'pending', NULL, NULL),
(29, 'residency', '2025-04-20 06:03:19', 'approved', '2005-12-12 04:00:00', NULL),
(30, 'indigency', '2025-04-20 06:08:10', 'pending', NULL, NULL),
(31, 'indigency', '2025-04-20 06:10:14', 'pending', NULL, NULL),
(32, 'indigency', '2025-04-20 06:14:53', 'pending', NULL, NULL),
(33, 'indigency', '2025-04-20 06:15:01', 'pending', NULL, NULL),
(34, 'indigency', '2025-04-20 06:20:27', 'pending', NULL, NULL),
(35, 'businessPermit', '2025-04-20 06:24:14', 'pending', NULL, NULL),
(36, 'clearance', '2025-04-20 06:24:23', 'rejected', NULL, 'kais u'),
(37, 'indigency', '2025-04-20 06:41:10', 'pending', NULL, NULL),
(38, 'indigency', '2025-04-20 00:45:23', 'pending', NULL, NULL),
(39, 'indigency', '2025-04-20 06:46:20', 'pending', NULL, NULL),
(40, 'indigency', '2025-04-20 06:50:22', 'pending', NULL, NULL),
(41, 'indigency', '2025-04-20 06:57:57', 'rejected', NULL, 'damn'),
(42, 'indigency', '2025-04-20 07:01:50', 'approved', '2005-12-12 04:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests_status`
--

CREATE TABLE `requests_status` (
  `request_id` int(11) NOT NULL,
  `request_type` enum('indigency','clearance','residency','businessPermit') DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests_status`
--

INSERT INTO `requests_status` (`request_id`, `request_type`, `status`) VALUES
(17, NULL, 'pending'),
(18, NULL, 'pending'),
(19, NULL, 'rejected'),
(20, NULL, 'pending'),
(21, NULL, 'pending'),
(22, NULL, 'pending'),
(23, NULL, 'pending'),
(26, 'indigency', 'pending'),
(27, 'clearance', 'pending'),
(28, 'indigency', 'pending'),
(29, 'residency', 'pending'),
(30, 'indigency', 'pending'),
(31, 'indigency', 'pending'),
(32, 'indigency', 'pending'),
(33, 'indigency', 'pending'),
(34, 'indigency', 'pending'),
(35, 'businessPermit', 'pending'),
(36, 'clearance', 'pending'),
(37, 'indigency', 'pending'),
(39, 'indigency', 'pending'),
(40, 'indigency', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests_status`
--
ALTER TABLE `requests_status`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests_status`
--
ALTER TABLE `requests_status`
  ADD CONSTRAINT `requests_status_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
