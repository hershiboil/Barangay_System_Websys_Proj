-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 10:04 PM
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
-- Table structure for table `complaints_entry`
--

CREATE TABLE `complaints_entry` (
  `id` int(11) NOT NULL,
  `resident_ID` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints_entry`
--

INSERT INTO `complaints_entry` (`id`, `resident_ID`, `type`, `description`, `created_at`) VALUES
(5, 1001, 'Vandalism', 'huhuhu', '2025-05-17 20:58:45'),
(6, 1001, 'Noise Disturbance', 'huhuh', '2025-05-17 21:27:37'),
(7, 1001, 'huhu', 'hkh', '2025-05-19 00:29:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints_entry`
--
ALTER TABLE `complaints_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints_entry`
--
ALTER TABLE `complaints_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints_entry`
--
ALTER TABLE `complaints_entry`
  ADD CONSTRAINT `complaints_entry_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `resident_info` (`resident_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
