-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 04:27 PM
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
(20250000, 'Juan', 'Santos', 'Dela Cruz', '', 'Jun', 'Male', 'Student', 21, 'O+', 'Single', '2003-04-15', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '09774629791', 'juan.delacruz@example.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sampaloc', '', 'Jose Dela Cruz', '09171234567', 'Maria Dela Cruz', '09181234567', '', '', 'Pedro Reyes', 'Uncle', '09201234567', '123456789000', '34-5678901-2', '123-456-789', '', '123456789012', '1234-5678-9012', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250001, 'Rhona Eloisa ', 'Llona', 'Lumbes ', '', '', 'Female', 'Student', 19, 'O+', 'Single', '2005-08-24', 'Legazpi City, Albay', 'Filipino', 'Roman Catholic', '09690991543', 'eloisalumbes@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Piña', 'Km. 8', 'Rolly M. Lumbes', '', 'Natividad L. Lumbes', '09561226769', '', '', '', '', '', '', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250002, 'Rhea Nicole', 'Llona', 'Lumbes ', '', '', 'Female', 'Student', 18, 'O+', 'Single', '2006-09-15', 'Legazpi City, Albay', '', 'Roman Catholic', '09774929792', 'nicolelumbes@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Piña', 'Km. 8', 'Rolly M. Lumbes', '', 'Natividad L. Lumbes', '09561226769', '', '', '', '', '', '', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250003, 'Natividad', 'Llona', 'Lumbes ', '', '', 'Female', 'Teacher', 54, 'A+', 'Widowed', '1970-12-24', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '09561226769', 'eloisalumbes@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Piña', 'Km. 8', 'Joaqin Llona', '', 'Julia M. Llona', '', 'Rolly M. Lumbes', '', '', '', '', '', '', '', '', '', '', 'Active', 'No', 'Yes', 'No', 'Yes', 'No', 'default.png'),
(20250004, 'Angel', 'Andes', 'Orillana', '', '', 'Female', 'Student', 19, 'A-', 'Single', '2005-07-11', 'Pio Duran, Albay', 'Filipino', 'Roman Catholic', '9531037488', 'angelorillana@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sampaloc', '', '', '', '', '', '', '', '', '', '', '3810-4629-1735', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
(20250005, 'Kristine Mae', 'Bataller', 'Bataller', '', 'Tine', 'Female', 'Student', 20, 'AB+', 'Single', '2004-12-26', 'Bacacay, Albay', 'Filipino', 'Roman Catholic', '9398251532', 'kristinemaebataller@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Pili', '', '', '', '', '', '', '', '', '', '', '5794-2651-8490', '', '', '', '', '', 'Active', 'Yes', 'No', 'No', 'No', 'No', 'default.png'),
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
(20250018, 'Marvin', 'Lopez', 'Caballero', 'Jr.', 'Junior', 'Male', 'Tricycle Driver', 32, 'B+', 'Married', '1992-03-04', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9231122233', 'marvinjr@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Sampaloc', '', '', '', '', '', 'Maria Caballero', '9314556677', '', '', '', '4492-3378-1120', '33-1119203-3', '304-789-521-011', '6049182370', '8023-4791-6204', '94-263591847-0', 'Active', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250019, 'Daniel', 'Arboleda', 'Mercado', '', 'Dan', 'Male', 'Delivery Rider', 28, 'O+', 'Single', '1997-08-14', 'Daraga, Albay', 'Filipino', 'Roman Catholic', '9123345567', 'danmercado@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Pili', '', '', '', '', '', '', '', '', '', '', '1342-5568-9912', '12-0093842-1', '982-143-765-012', '2094837516', '2750-3984-7152', '31-872046195-2', 'Active', 'No', 'No', 'No', 'No', 'No', 'default.png'),
(20250020, 'Jenny', 'Ramos', 'Calaycay', '', 'Jen', 'Female', 'Beautician', 41, 'AB-', 'Married', '1984-12-30', 'Camalig, Albay', 'Filipino', 'Roman Catholic', '9145567789', 'jennycalaycay@gmail.com', 'Albay', 'Daraga', 4501, 'Balinad', 'Pili', '', '', '', '', '', 'Manuel Calaycay', '9115566778', '', '', '', '2341-7741-1134', '41-9034720-6', '176-209-384-013', '9375102843', '4195-7382-0196', '75-483920176-8', 'Active', 'No', 'No', 'No', 'Yes', 'No', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `residents_info`
--
ALTER TABLE `residents_info`
  ADD PRIMARY KEY (`resident_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `residents_info`
--
ALTER TABLE `residents_info`
  MODIFY `resident_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20250023;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
