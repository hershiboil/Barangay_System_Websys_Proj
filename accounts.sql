-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 04:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `resident_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`resident_id`, `password`, `role_id`, `status`, `last_modified`) VALUES
(20250001, '$2y$10$NQ31KjkSxpTII.YghzW3BOwnSA0oglyE2iL/vlHUSt.emXNDRGs1u', 2, 'active', '2025-05-21 21:07:19'),
(20250002, '$2y$10$csQ4eXeCgDGzzjjohwZ98OO4kCxjPC93x21JKFU3.1BuacQKnG9JW', 1, 'active', '2025-05-21 22:04:04'),
(20250003, '$2y$10$NN0gU74E8Jg7oGoD7TxcCuVFK.7wlwWvYokTleqBjyL/VP9trvHkK', 1, 'active', '2025-05-21 21:40:13'),
(20250010, '$2y$10$8p4iXsHKxDuGwshpCyKoqubTLypInVyMZfwg4/S70z3/JDQe8Qtjy', 3, 'active', '2025-05-21 21:20:19'),
(20250012, '$2y$10$jHJqS7Kgq8sbww6eTU8vOeSsbQ8awC4SzOe6LOCQmSFk9DsnTPVUS', 1, 'active', '2025-05-22 02:04:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `fk_accounts_role` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_accounts_resident` FOREIGN KEY (`resident_id`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accounts_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
