-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 04:45 AM
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
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_name`) VALUES
(2, 'create_admin'),
(2, 'create_allResident'),
(2, 'create_announcement'),
(2, 'create_archivedResident'),
(2, 'create_blotter'),
(2, 'create_currentOfficials'),
(2, 'create_dashboard'),
(2, 'create_formerOfficials'),
(2, 'create_position'),
(2, 'create_reports'),
(2, 'create_residents'),
(2, 'create_roles'),
(2, 'delete_admin'),
(2, 'delete_allResident'),
(2, 'delete_announcement'),
(2, 'delete_archivedResident'),
(2, 'delete_blotter'),
(2, 'delete_currentOfficials'),
(2, 'delete_dashboard'),
(2, 'delete_formerOfficials'),
(2, 'delete_position'),
(2, 'delete_reports'),
(2, 'delete_residents'),
(2, 'delete_roles'),
(2, 'edit_allResident'),
(2, 'edit_announcement'),
(2, 'edit_currentOfficials'),
(2, 'edit_dashboard'),
(2, 'edit_formerOfficials'),
(2, 'edit_residents'),
(2, 'restore_admin'),
(2, 'restore_archivedResident'),
(2, 'restore_blotter'),
(2, 'restore_formerOfficials'),
(2, 'restore_position'),
(2, 'restore_reports'),
(2, 'restore_roles'),
(2, 'view_admin'),
(2, 'view_allResident'),
(2, 'view_announcement'),
(2, 'view_archivedResident'),
(2, 'view_blotter'),
(2, 'view_business'),
(2, 'view_clearance'),
(2, 'view_currentOfficials'),
(2, 'view_dashboard'),
(2, 'view_formerOfficials'),
(2, 'view_indigency'),
(2, 'view_position'),
(2, 'view_reports'),
(2, 'view_residency'),
(2, 'view_residents'),
(2, 'view_roles'),
(3, 'create_admin'),
(3, 'create_allResident'),
(3, 'create_announcement'),
(3, 'create_archivedResident'),
(3, 'create_blotter'),
(3, 'create_currentOfficials'),
(3, 'create_dashboard'),
(3, 'create_formerOfficials'),
(3, 'create_position'),
(3, 'create_reports'),
(3, 'create_residents'),
(3, 'delete_admin'),
(3, 'delete_allResident'),
(3, 'delete_announcement'),
(3, 'delete_archivedResident'),
(3, 'delete_blotter'),
(3, 'delete_currentOfficials'),
(3, 'delete_dashboard'),
(3, 'delete_formerOfficials'),
(3, 'delete_position'),
(3, 'delete_reports'),
(3, 'delete_residents'),
(3, 'edit_allResident'),
(3, 'edit_announcement'),
(3, 'edit_currentOfficials'),
(3, 'edit_dashboard'),
(3, 'edit_formerOfficials'),
(3, 'edit_residents'),
(3, 'restore_admin'),
(3, 'restore_archivedResident'),
(3, 'restore_blotter'),
(3, 'restore_formerOfficials'),
(3, 'restore_position'),
(3, 'restore_reports'),
(3, 'view_admin'),
(3, 'view_allResident'),
(3, 'view_announcement'),
(3, 'view_archivedResident'),
(3, 'view_blotter'),
(3, 'view_business'),
(3, 'view_clearance'),
(3, 'view_currentOfficials'),
(3, 'view_dashboard'),
(3, 'view_formerOfficials'),
(3, 'view_indigency'),
(3, 'view_position'),
(3, 'view_reports'),
(3, 'view_residency'),
(3, 'view_residents');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
