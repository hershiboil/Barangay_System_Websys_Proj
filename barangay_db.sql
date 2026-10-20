-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 09:15 AM
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
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `activity_description` text DEFAULT NULL,
  `activity_date` datetime DEFAULT current_timestamp(),
  `request_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `resident_ID`, `activity_description`, `activity_date`, `request_ID`) VALUES
(2, 20250005, 'Requested clearance certificate for reason: hhhh', '2025-05-21 14:53:45', 3);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateToday` date NOT NULL,
  `modified` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `content`, `dateToday`, `modified`) VALUES
(8, 'HERSHEY', 'HERSHEY what what, YES GALING', '2025-05-11', 'yes'),
(9, 'helooo', 'ia am batman w w', '2025-05-11', 'yes'),
(10, 'lknknmnm', 'kbkbjbnnbbn', '2025-05-11', NULL),
(11, 'nmbmbmbmb', 'jghvjvhjj', '2025-05-11', NULL),
(12, 'Community Clean-up Drive', 'Join us for our monthly clean-up drive. Together, we maintain the beauty of our barangay.', '2025-05-11', NULL),
(13, 'HEHHEHEHE', 'Monday', '2025-05-11', NULL),
(14, 'uhuuhu', 'hhih', '2025-05-21', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `complaints_entry`
--

CREATE TABLE `complaints_entry` (
  `id` int(11) NOT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `report_status` varchar(50) DEFAULT 'pending',
  `solution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints_entry`
--

INSERT INTO `complaints_entry` (`id`, `resident_ID`, `type`, `description`, `created_at`, `report_status`, `solution`) VALUES
(1, 20250005, 'Noise Disturbance', 'huhhu', '2025-05-21 11:19:13', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_files`
--

CREATE TABLE `complaint_files` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `resident_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_requests`
--

CREATE TABLE `file_requests` (
  `id` int(11) NOT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `request_type` varchar(100) DEFAULT NULL,
  `request_date` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected','Claimed') DEFAULT 'Pending',
  `claim_date` datetime DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `business_name` varchar(150) DEFAULT NULL,
  `business_location` varchar(255) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_requests`
--

INSERT INTO `file_requests` (`id`, `resident_ID`, `request_type`, `request_date`, `status`, `claim_date`, `rejection_reason`, `business_name`, `business_location`, `purpose`, `expired_at`) VALUES
(1, 20250005, 'indigency', '2025-05-21 11:23:07', 'Approved', NULL, NULL, NULL, NULL, 'uhuhuhuuhu', NULL),
(2, 20250005, 'residency', '2025-05-21 11:25:33', 'Pending', NULL, NULL, NULL, NULL, 'uhuhuhuuhu', NULL),
(3, 20250005, 'clearance', '2025-05-21 14:53:45', 'Claimed', '2025-12-12 00:00:00', NULL, NULL, NULL, 'hhhh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages_entry`
--

CREATE TABLE `messages_entry` (
  `message_ID` int(11) NOT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_sent` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages_entry`
--

INSERT INTO `messages_entry` (`message_ID`, `resident_ID`, `name`, `subject`, `message`, `email`, `date_sent`) VALUES
(1, 20250005, 'Ayis', 'Excuse Letter', 'huhuh', 'lobarbioayis19@gmail.com', '2025-05-21 11:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `created_at` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `resident_ID`, `message`, `status`, `created_at`, `is_read`) VALUES
(1, 20250005, 'Your request for clearance has been submitted successfully.', 'Active', '2025-05-21 14:53:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `pos_limit` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `last_modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `title`, `pos_limit`, `description`, `last_modified`) VALUES
(1, 'captain', 2, '', '2025-05-20 09:39:42'),
(8, 'secretary', 1, '', '2025-04-18 18:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `residents_info`
--

CREATE TABLE `residents_info` (
  `resident_ID` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `nick_name` varchar(100) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(200) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `municipality` varchar(10) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `father_contact` varchar(100) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `mother_contact` varchar(100) DEFAULT NULL,
  `spouse_name` varchar(200) DEFAULT NULL,
  `spouse_contact` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(200) DEFAULT NULL,
  `guardian_relation` varchar(200) DEFAULT NULL,
  `guardian_contact` varchar(100) DEFAULT NULL,
  `national_ID_num` varchar(100) DEFAULT NULL,
  `sss_num` varchar(100) DEFAULT NULL,
  `tin_num` varchar(100) DEFAULT NULL,
  `gsis_num` varchar(100) DEFAULT NULL,
  `pagibig_num` varchar(100) DEFAULT NULL,
  `philhealth_num` varchar(100) DEFAULT NULL,
  `resident_status` varchar(100) NOT NULL,
  `voter` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `senior_citizen` varchar(255) DEFAULT NULL,
  `solo_parent` varchar(50) NOT NULL,
  `is_4ps` varchar(50) NOT NULL,
  `profile_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents_info`
--

INSERT INTO `residents_info` (`resident_ID`, `first_name`, `middle_name`, `last_name`, `suffix`, `nick_name`, `gender`, `occupation`, `age`, `blood_type`, `civil_status`, `birthdate`, `birthplace`, `nationality`, `religion`, `contact_number`, `email`, `province`, `municipality`, `zip_code`, `barangay`, `purok`, `street`, `father_name`, `father_contact`, `mother_name`, `mother_contact`, `spouse_name`, `spouse_contact`, `guardian_name`, `guardian_relation`, `guardian_contact`, `national_ID_num`, `sss_num`, `tin_num`, `gsis_num`, `pagibig_num`, `philhealth_num`, `resident_status`, `voter`, `pwd`, `senior_citizen`, `solo_parent`, `is_4ps`, `profile_photo`) VALUES
(20250001, 'Rhona Eloisa ', 'Llona', 'Lumbes ', '', '', 'Female', 'Student', 19, 'O+', 'Single', '2005-08-24', 'Legazpi City, Albay', 'Filipino', 'Roman Catholic', '09690991543', 'eloisalumbes@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Piña', 'Km. 8', 'Rolly M. Lumbes', '', 'Natividad L. Lumbes', '09561226769', '', '', '', '', '', '', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250002, 'Rhea Nicole', 'Llona', 'Lumbes ', '', '', 'Female', 'Student', 18, 'O+', 'Single', '2006-09-15', 'Legazpi City, Albay', '', 'Roman Catholic', '09774929792', 'nicolelumbes@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Piña', 'Km. 8', 'Rolly M. Lumbes', '', 'Natividad L. Lumbes', '09561226769', '', '', '', '', '', '', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250003, 'Natividad', 'Llona', 'Lumbes ', '', '', 'Female', 'Teacher', 54, 'A+', 'Widowed', '1970-12-24', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '09561226769', 'eloisalumbes@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Piña', 'Km. 8', 'Joaqin Llona', '', 'Julia M. Llona', '', 'Rolly M. Lumbes', '', '', '', '', '', '', '', '', '', '', 'Active', 'No', 'Yes', 'No', 'Yes', 'No', 'default.png'),
(20250004, 'Angel', 'Andes', 'Orillana', '', '', 'Female', 'Student', 19, 'A-', 'Single', '2005-07-11', 'Pio Duran, Albay', 'Filipino', 'Roman Catholic', '9531037488', 'angelorillana@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sampaloc', 'Km. 8\r\n', '', '', '', '', '', '', '', '', '', '3810-4629-1735', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250005, 'Kristine Mae', 'Bataller', 'Bataller', '', 'Tine', 'Female', 'Student', 20, 'AB+', 'Single', '2004-12-26', 'Bacacay, Albay', 'Filipino', 'Roman Catholic', '9398251532', 'kristinemaebataller@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Pili', 'Km. 8', '', '', '', '', '', '', '', '', '', '5794-2651-8490', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250006, 'Sofia ', '', 'Smith', '', 'Fyang', 'Female', 'Actress', 18, 'O-', 'Single', '2006-05-14', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9223465789', 'fyangsmith@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', '', '', '', '', '', '9347-1850-7463', '', '', '', '', '', 'Inactive', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250007, 'Jimmy', '', 'Morano', '', '', 'Male', 'Farmer', 37, 'O+', 'Separated', '1988-01-01', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9924977532', 'jimmymorano@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', '', '', '', '', '', '6273-9481-2756', '34-5968423-0', '123-456-789-000', '2000356412', '2041-9765-3840', '12-345678901-2', 'Active', 'Yes', 'Yes', 'No', 'No', 'No', 'default.png'),
(20250008, 'Emilio ', '', 'Daez', '', 'Mio', 'Male', 'Actress', 25, 'O+', 'Single', '2000-03-09', 'Manito, Albay', 'Filipino', 'Roman Catholic', '9123456789', 'emiliodaez@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Lukban', '', '', '', '', '', '', '', '', '', '', '8402-7619-3840', '59-2041867-5', '741-852-963-001', '1908741209', '3752-1840-7612', '98-271946382-7', 'Inactive', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250009, 'Dave ', 'Domingo', 'Añonuevo', '', '', 'Male', 'Student', 16, 'A+', 'Single', '2009-02-19', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9876543211', 'daveañonuevo@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', 'Edwin Añonuevo', '9678766543', 'Rosalie Añonuevo', '9781123412', '', '', '', '', '', '7904-2831-6482', '', '', '', '', '', 'Active', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250010, 'Rose', 'Millavas', 'Lopez', '', '', 'Female', 'Teacher', 39, 'B-', 'Married', '1986-03-17', 'Legazpi CIty, Albay', 'Filipino', 'Roman Catholic', '9657883456', 'roselopez@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', 'Ronel M. Lopez', '9786234124', '', '', '', '3510-9742-1837', '46-1287053-1', '395-270-681-003', '4782109832', '1603-8492-5740', '56-390284761-9', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250011, 'Ronel', 'Morano', 'Lopez', '', '', 'Male', 'Teacher', 39, 'O+', 'Maried', '1986-09-15', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9457869876', 'ronellopez@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', 'Rodlfo Lopez', '923645265', 'Lydia M. Lopez', '9671234321', '', '', '', '', '', '9058-6214-7395', '80-4692301-9', '884-133-209-004', '5801243987', '2985-1038-4751', '83-847263591-0', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250012, 'Lydia ', 'Morano', 'Lopez', '', '', 'Female', 'Retired', 69, 'O+', 'Married', '1955-09-14', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9671234321', 'N/A', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', 'Rodolfo Lopez', '9236452652', '', '', '', '1273-8659-2046', '23-9851426-4', '321-567-234-005', '', '', '61-094785263-8', 'Active', 'Yes', 'No', 'Yes', 'No', 'No', 'default.png'),
(20250013, 'Miguel', 'Basco', 'Majadillas', '', '', 'Male', 'Mechanic', 35, 'O+', 'Widowed', '1990-05-29', 'Daraga, Albay', 'Filipino', 'Christian', '9123225643', 'miguelmajadillas@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Tambis', '', '', '', '', '', '', '', '', '', '', '4120-9374-5620', '67-3108429-7', '999-888-777-006', '7412089764', '1792-4857-2039', '45-837194620-3', 'Active', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'default.png'),
(20250014, 'Rosalle', 'Domingo', 'Añonuevo', '', 'Sally', 'Female', 'Housewife', 45, 'B+', 'Maried', '1980-11-20', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9781123412', 'sallyañonuevo@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', 'Edwin Añonuevo', '9678766543', '', '', '', '2481-7603-3951', '12-6741983-8', '213-345-876-007', '8250194730', '6431-7285-9104', '29-570483162-5', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250015, 'Edwin', 'Mazo', 'Añonuevo', '', 'Ed', 'Male', 'Kagawad', 48, 'A+', 'Married', '1977-06-28', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9678766543', 'edañonuevo@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', 'Rosalie Añonuevo', '9781123412', '', '', '', '5638-1742-6093', '39-8526107-3', '157-963-258-008', '6547389201', '7139-2948-1653', '38-192847365-1', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250016, 'Antonette', '', 'Loterte', '', 'Tonet', 'Female', 'House Helper', 43, 'O+', 'Widowed', '1982-11-21', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9776654327', 'tonetloterte@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Mangga', '', '', '', '', '', '', '', 'Lydia M. Lopez', 'Daughter', '9671234321', '8371-2840-5642', '45-7634928-6', '407-301-904-009', '3298401725', '5384-0973-5810', '67-305918472-6', 'Active', 'Yes', 'No', 'No', 'Yes', 'Yes', 'default.png'),
(20250017, 'Francesca', '', 'Morano', '', 'Ikay', 'Female', 'Retired', 83, 'O+', 'Widowed', '1942-03-12', 'Daraga, Albay', 'Filipino', 'Roman Catholic', 'N/A', 'N/A', 'Albay', 'Daraga', 4501, 'Balinad', 'Sunkist', '', '', '', '', '', '', '', '', '', '', '6951-7392-1846', '53-7410963-2', '875-630-941-010', '', '', '50-192837465-4', 'Active', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'default.png'),
(20250018, 'Marvin', 'Lopez', 'Caballero', 'Jr.', 'Junior', 'Male', 'Tricycle Driver', 32, 'B+', 'Married', '1992-03-04', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9231122233', 'marvinjr@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sampaloc', 'Km. 8', '', '', '', '', 'Maria Caballero', '9314556677', '', '', '', '4492-3378-1120', '33-1119203-3', '304-789-521-011', '6049182370', '8023-4791-6204', '94-263591847-0', 'Active', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250019, 'Daniel', 'Arboleda', 'Mercado', '', 'Dan', 'Male', 'Delivery Rider', 28, 'O+', 'Single', '1997-08-14', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9123345567', 'danmercado@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Pili', '', '', '', '', '', '', '', '', '', '', '1342-5568-9912', '12-0093842-1', '982-143-765-012', '2094837516', '2750-3984-7152', '31-872046195-2', 'Active', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250020, 'Jenny', 'Ramos', 'Calaycay', '', 'Jen', 'Female', 'Beautician', 41, 'AB-', 'Married', '1984-12-30', 'Camalig, Albay', 'Filipino', 'Roman Catholic', '9145567789', 'jennycalaycay@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Pili', '', '', '', '', '', 'Manuel Calaycay', '9115566778', '', '', '', '2341-7741-1134', '41-9034720-6', '176-209-384-013', '9375102843', '4195-7382-0196', '75-483920176-8', 'Active', 'No', 'No', 'No', 'Yes', 'No', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `resident_ID` int(5) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` enum('resident','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`resident_ID`, `password`, `user_role`) VALUES
(20250001, 'rhona123', 'admin'),
(20250004, 'angel123', 'admin'),
(20250005, 'kristine123', 'resident'),
(20250018, 'marvin123', 'resident');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_ID` (`resident_ID`),
  ADD KEY `request_ID` (`request_ID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints_entry`
--
ALTER TABLE `complaints_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- Indexes for table `complaint_files`
--
ALTER TABLE `complaint_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- Indexes for table `file_requests`
--
ALTER TABLE `file_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- Indexes for table `messages_entry`
--
ALTER TABLE `messages_entry`
  ADD PRIMARY KEY (`message_ID`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_ID` (`resident_ID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents_info`
--
ALTER TABLE `residents_info`
  ADD PRIMARY KEY (`resident_ID`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD KEY `resident_ID` (`resident_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `complaints_entry`
--
ALTER TABLE `complaints_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaint_files`
--
ALTER TABLE `complaint_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_requests`
--
ALTER TABLE `file_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages_entry`
--
ALTER TABLE `messages_entry`
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `residents_info`
--
ALTER TABLE `residents_info`
  MODIFY `resident_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20250023;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_log_ibfk_2` FOREIGN KEY (`request_ID`) REFERENCES `file_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaints_entry`
--
ALTER TABLE `complaints_entry`
  ADD CONSTRAINT `complaints_entry_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint_files`
--
ALTER TABLE `complaint_files`
  ADD CONSTRAINT `complaint_files_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_files_ibfk_2` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_requests`
--
ALTER TABLE `file_requests`
  ADD CONSTRAINT `file_requests_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages_entry`
--
ALTER TABLE `messages_entry`
  ADD CONSTRAINT `messages_entry_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users1`
--
ALTER TABLE `users1`
  ADD CONSTRAINT `users1_ibfk_1` FOREIGN KEY (`resident_ID`) REFERENCES `residents_info` (`resident_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
