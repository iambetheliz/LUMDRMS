-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 10:46 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cat` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `cat`, `status`) VALUES
(1, 'CAST', 2, 1),
(2, 'COED', 2, 1),
(3, 'CEMA', 2, 1),
(4, 'CHS', 2, 1),
(5, 'COENG', 2, 1),
(6, 'SHS', 2, 1),
(7, 'Admin', 1, 1),
(8, 'Registrar', 1, 1),
(9, 'Cashier', 1, 1),
(10, 'Clinic', 1, 1),
(11, 'Library', 1, 1),
(12, 'MIS', 1, 1),
(13, 'OSA', 1, 1),
(14, 'Others', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table 'events'
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `FacultyID` int(11) NOT NULL AUTO_INCREMENT,
  `facultyNo` varchar(9) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `stat` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `sem` varchar(9) NOT NULL,
  `acadYear` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cperson` varchar(50) NOT NULL,
  `cphone` varchar(15) NOT NULL,
  PRIMARY KEY (`FacultyID`,`facultyNo`),
  UNIQUE KEY `facultyNo` (`facultyNo`),
  KEY `dept` (`dept`),
  CONSTRAINT `fk_dept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`FacultyID`, `facultyNo`, `last_name`, `first_name`, `middle_name`, `ext`, `age`, `sex`, `dept`, `sem`, `acadYear`, `address`, `cperson`, `cphone`) VALUES
(1, '2017-0001', 'Agra', 'Lauderdale', 'V', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(2, '2017-0002', 'Aguado', 'Numeriano', 'B', '', 0, 'Male', 1, '1st', '2017 - 2018', '', '', 'none'),
(3, '2017-0003', 'Aguilar', 'Nayreen', 'S', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(4, '2017-0004', 'Alarde', 'Crispulo', 'S', 'Jr', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(5, '2017-0005', 'Alcaraz', ' Arnold', 'D', '', 0, 'Male', 14, '1st', '2017 - 2018', '', '', 'none'),
(6, '2017-0006', 'Alvaran', 'Tony Angelo', 'C', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(7, '2017-0007', 'Ambrocio', 'Mayra Christina', 'M', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(8, '2017-0008', 'Angeles', 'Erneliza', 'G', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(9, '2017-0009', 'Apaya', 'Loreta', 'L', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(10, '2017-0010', 'Asumbra', 'Marilyn', 'L', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(11, '2017-0011', 'Atanacio', 'Marlon', 'J', '', 0, 'Male', 1, '1st', '2017 - 2018', '', '', 'none'),
(12, '2017-0012', 'Baltazar', 'Maria Josel', 'G', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(13, '2017-0013', 'Banocnoc', 'Joselle', 'A', '', 0, 'Female', 1, '1st', '2017 - 2018', '', '', 'none'),
(14, '2017-0014', 'Bato', 'Monette', 'O', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(15, '2017-0015', 'Belen', 'Liza', 'F', '', 0, 'Female', 8, '1st', '2017 - 2018', '', '', 'none'),
(16, '2017-0016', 'Bermudez', 'Josephine', 'C', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(17, '2017-0017', 'Bilog', 'Ronel', 'J', '', 0, 'Male', 1, '1st', '2017 - 2018', '', '', 'none'),
(18, '2017-0018', 'Bueno', 'Leonida', 'C', '', 0, 'Female', 2, '1st', '2017 - 2018', '', '', 'none'),
(19, '2017-0019', 'Bulatao', 'Virgilio', '', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(20, '2017-0020', 'Calangian', 'Justine Mae', 'O', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(21, '2017-0021', 'Canonizado', 'Roilan', 'B', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(22, '2017-0022', 'Capistrano', 'Kristel Zorina', 'B', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(23, '2017-0023', 'Dalhag', 'Hendrick', 'M', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(24, '2017-0024', 'De Belen', 'Erika', '', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(25, '2017-0025', 'De Lima', 'MC Joshua', 'Y', '', 0, 'Male', 1, '1st', '2017 - 2018', '', '', 'none'),
(26, '2017-0026', 'De Torres', 'Korina Fatima', 'M', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(27, '2017-0027', 'Del Rosario', 'Khia', 'D', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(28, '2017-0028', 'Del Rosario', 'Ronuel', 'L', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(29, '2017-0029', 'Dimaculangan', 'Norayda', 'M', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(30, '2017-0030', 'Dimaranan', 'Kay Harold', 'C', '', 0, 'Male', 7, '1st', '2017 - 2018', '', '', 'none'),
(31, '2017-0031', 'Dimasaca', 'Audrey Lou', 'S', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(32, '2017-0032', 'Dionisio', 'Robert', 'O', '', 0, 'Male', 2, '1st', '2017 - 2018', '', '', 'none'),
(33, '2017-0033', 'Diozon', 'Mario', 'F', '', 0, 'Male', 2, '1st', '2017 - 2018', '', '', 'none'),
(34, '2017-0034', 'Doble', 'Francisco', 'C', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(35, '2017-0035', 'Domingo', 'Olga', 'J', '', 0, 'Female', 2, '1st', '2017 - 2018', '', '', 'none'),
(36, '2017-0036', 'Dorado', 'Marizol', 'V', '', 0, 'Female', 13, 'unknown', '2017 - 2018', '', '', 'none'),
(37, '2017-0037', 'Elomina', 'Marie Joy', 'O', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(38, '2017-0038', 'Espedido', 'Erixon', 'E', '', 0, 'Male', 11, '1st', '2017 - 2018', '', '', 'none'),
(39, '2017-0039', 'Fernandez', 'Gualolarina', 'C', '', 0, 'Female', 14, '1st', '2017 - 2018', '', '', 'none'),
(40, '2017-0040', 'Flora', 'Luigi Kim', 'L', '', 0, 'Male', 11, '1st', '2017 - 2018', '', '', 'none'),
(41, '2017-0041', 'Francia', 'Arlene', 'Z', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(42, '2017-0042', 'Francia', 'Rogie', 'R', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(43, '2017-0043', 'Fucio', 'Chrisna', 'L', '', 0, 'Female', 1, '1st', '2017 - 2018', '', '', 'none'),
(44, '2017-0044', 'Gaa', 'Rowel', 'B', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(45, '2017-0045', 'Garbo', 'Roxanne', 'B', '', 0, 'Female', 8, '1st', '2017 - 2018', '', '', 'none'),
(46, '2017-0046', 'Gascon', 'Colegio', 'S', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(47, '2017-0047', 'Gonzaga', 'Joanna Lee', 'P', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(48, '2017-0048', 'Hernandez', 'Charlie', 'L', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(49, '2017-0049', 'Herrdura', 'Renee Rose', 'D', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(50, '2017-0050', 'Idian', 'Bermar', 'L', '', 0, 'Male', 1, '1st', '2017 - 2018', '', '', 'none'),
(51, '2017-0051', 'Isles', 'Mila', 'E', '', 0, 'Female', 2, '1st', '2017 - 2018', '', '', 'none'),
(52, '2017-0052', 'Julio', 'Alfredo', 'A', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(53, '2017-0053', 'L Cruz', 'Anastacio', 'R', 'Jr', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(54, '2017-0054', 'Lasangre Cruz', 'Paul Gerard', 'R', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(55, '2017-0055', 'Lastimosa', 'Cyril', 'F', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(56, '2017-0056', 'Layos', 'Jhonessa', 'J', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(57, '2017-0057', 'Lubuguin', 'Rhea', 'A', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(58, '2017-0058', 'Macalatan', 'Mark Gian Glenn', 'S', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(59, '2017-0059', 'Madrazo', 'Leah De', 'J', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(60, '2017-0060', 'Magcalas', 'Marian', 'G', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(61, '2017-0061', 'Maglapuz', 'Sharmaine Justine', 'R', '', 0, 'Female', 1, '1st', '2017 - 2018', '', '', 'none'),
(62, '2017-0062', 'Mahinay', 'Amelyn', 'S', '', 0, 'Female', 7, '1st', '2017 - 2018', '', '', 'none'),
(63, '2017-0063', 'Mahinay', 'Ludielyn', 'S', '', 0, 'Female', 7, '1st', '2017 - 2018', '', '', 'none'),
(64, '2017-0064', 'Manuel', 'Christine Joy', 'L', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(65, '2017-0065', 'Melendrez', 'Joebert', 'S', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(66, '2017-0066', 'Minas', 'Florencia', 'S', '', 0, 'Female', 2, '1st', '2017 - 2018', '', '', 'none'),
(67, '2017-0067', 'Mondez', 'Jenneth', 'R', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(68, '2017-0068', 'Napiza', 'Emelyn', 'U', '', 0, 'Female', 14, '1st', '2017 - 2018', '', '', 'none'),
(69, '2017-0069', 'Odquier', 'Caitlin Dianne', 'Q', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(70, '2017-0070', 'Palero', 'Madeliene', 'A', '', 0, 'Female', 10, '1st', '2017 - 2018', '', '', 'none'),
(71, '2017-0071', 'Paras', 'Jerald', 'P', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(72, '2017-0072', 'Perez', 'Leonora', 'D', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(73, '2017-0073', 'Quintana', 'Marc Lester', 'F', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(74, '2017-0074', 'Ramirez', 'Marlon', 'C', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(75, '2017-0075', 'Regalo', 'May Riz', 'L', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(76, '2017-0076', 'Relova', 'Antonio', 'P', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(77, '2017-0077', 'Rubio', 'Corazon', '', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(78, '2017-0078', 'Sabado', 'Rosemarie', 'D', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(79, '2017-0079', 'Salomon', 'Avelina', 'E', '', 0, 'Female', 2, '1st', '2017 - 2018', '', '', 'none'),
(80, '2017-0080', 'San Juan', 'Rose Nannette', 'J', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(81, '2017-0081', 'San Sebastian', 'Elson', 'E', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(82, '2017-0082', 'Santos', 'Enrique', 'G', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(83, '2017-0083', 'Santos', 'Jeffrey', 'M', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(84, '2017-0084', 'Solpico', 'Mary Ann', 'L', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(85, '2017-0085', 'Sultan', 'Nasser Khan', 'C', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(86, '2017-0086', 'Sumilang', 'Glaiza', 'T', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(87, '2017-0087', 'Sumiran', 'Kylie Margin', 'C', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(88, '2017-0088', 'Tan', 'Rosanne', 'O', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(89, '2017-0089', 'Tanlioco', 'Napoleon', 'D', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(90, '2017-0090', 'Trinidad', 'Blas', 'C', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(91, '2017-0091', 'Valenzuela', 'Edna', 'F', '', 0, 'Female', 4, '1st', '2017 - 2018', '', '', 'none'),
(92, '2017-0092', 'Valero', 'Ma Nelia', 'A', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(93, '2017-0093', 'Valero', 'Marty', 'R', '', 0, 'Male', 13, '1st', '2017 - 2018', '', '', 'none'),
(94, '2017-0094', 'Velasco', 'Jennifer', 'R', '', 0, 'Female', 10, '1st', '2017 - 2018', '', '', 'none'),
(95, '2017-0095', 'Villaroza', 'Precious Arlene', 'L', '', 0, 'Female', 13, '1st', '2017 - 2018', '', '', 'none'),
(96, '2017-0096', 'Vinas', 'Myline', 'S', '', 0, 'Female', 1, '1st', '2017 - 2018', '', '', 'none'),
(97, '2017-0097', 'Ycogo', 'Agnes ', 'G', '', 0, 'Female', 7, '1st', '2017 - 2018', '', '', 'none'),
(98, '2017-0098', 'Yosolon', 'Carolyn', 'R', '', 0, 'Female', 9, '1st', '2017 - 2018', '', '', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_cert`
--

CREATE TABLE `faculty_cert` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rest` varchar(100) NOT NULL,
  `resolution` varchar(50) NOT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`FacultyID`),
  UNIQUE KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fcert_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_dental`
--

CREATE TABLE `faculty_dental` (
  `DID` int(11) NOT NULL AUTO_INCREMENT,
  `medHis` varchar(500) NOT NULL,
  `dec_x` int(11) NOT NULL,
  `dec_f` int(11) NOT NULL,
  `missing` int(11) NOT NULL,
  `filled` int(11) NOT NULL,
  `per_con` varchar(50) NOT NULL,
  `con_rem1` varchar(50) NOT NULL,
  `con_rem2` varchar(50) NOT NULL,
  `con_rem3` varchar(50) NOT NULL,
  `con_rem4` varchar(50) NOT NULL,
  `con_spec` varchar(50) NOT NULL,
  `denture` varchar(5) NOT NULL,
  `pro_rem1` varchar(50) NOT NULL,
  `pro_spec1` varchar(50) NOT NULL,
  `need` varchar(5) NOT NULL,
  `pro_rem2` varchar(50) NOT NULL,
  `pro_spec2` varchar(50) NOT NULL,
  `pro_rem3` varchar(50) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`DID`,`FacultyID`),
  UNIQUE KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fdent_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `faculty_med`
--

CREATE TABLE `faculty_med` (
  `MedID` int(11) NOT NULL AUTO_INCREMENT,
  `sysRev` varchar(500) NOT NULL,
  `medHis` varchar(500) NOT NULL,
  `drinker` varchar(3) NOT NULL,
  `smoker` varchar(3) NOT NULL,
  `drug_user` varchar(3) NOT NULL,
  `mens` varchar(10) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(5) NOT NULL,
  `bmi_cat` varchar(20) NOT NULL,
  `bp` varchar(10) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `rr` varchar(10) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `xray` varchar(20) NOT NULL,
  `assess` varchar(3) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `facultyNo` varchar(9) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`MedID`,`FacultyID`),
  UNIQUE KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fmed_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_soap`
--

CREATE TABLE `faculty_soap` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `sysRev` varchar(500) NOT NULL,
  `med` varchar(500) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(5) NOT NULL,
  `bmi_cat` varchar(20) NOT NULL,
  `bp` varchar(10) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `assess` text(500) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`SID`,`FacultyID`),
  UNIQUE KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fsoap_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_stats`
--

CREATE TABLE `faculty_stats` (
  `StatsID` int(11) NOT NULL AUTO_INCREMENT,
  `med` varchar(7) NOT NULL DEFAULT 'Pending',
  `dent` varchar(7) NOT NULL DEFAULT 'Pending',
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `facultyNo` varchar(9) NOT NULL,
  PRIMARY KEY (`StatsID`,`facultyNo`),
  UNIQUE KEY `facultyNo` (`facultyNo`),
  CONSTRAINT `fk_fstats_id` FOREIGN KEY (`facultyNo`) REFERENCES `faculties` (`facultyNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_stats`
--

INSERT INTO `faculty_stats` (`StatsID`, `med`, `dent`, `date_registered`, `date_updated`, `checked_by`, `facultyNo`) VALUES
(1, 'Pending', 'Pending', '2017-11-28 03:54:00', '2017-11-28 03:54:00', '', '2017-0001'),
(2, 'Pending', 'Pending', '2017-11-28 03:54:42', '2017-11-28 03:54:42', '', '2017-0002'),
(3, 'Pending', 'Pending', '2017-11-28 03:56:25', '2017-11-28 03:56:25', '', '2017-0003'),
(4, 'Pending', 'Pending', '2017-11-28 03:57:46', '2017-11-28 03:57:46', '', '2017-0004'),
(5, 'Pending', 'Pending', '2017-11-28 04:01:42', '2017-11-28 04:01:42', '', '2017-0005'),
(6, 'Pending', 'Pending', '2017-11-28 04:02:33', '2017-11-28 04:02:33', '', '2017-0006'),
(7, 'Pending', 'Pending', '2017-11-28 05:26:51', '2017-11-28 05:26:51', '', '2017-0007'),
(8, 'Pending', 'Pending', '2017-11-28 05:28:37', '2017-11-28 05:28:37', '', '2017-0008'),
(9, 'Pending', 'Pending', '2017-11-28 05:29:16', '2017-11-28 05:29:16', '', '2017-0009'),
(10, 'Pending', 'Pending', '2017-11-28 05:29:58', '2017-11-28 05:29:58', '', '2017-0010'),
(11, 'Pending', 'Pending', '2017-11-28 05:30:35', '2017-11-28 05:30:35', '', '2017-0011'),
(12, 'Pending', 'Pending', '2017-11-28 05:31:28', '2017-11-28 05:31:28', '', '2017-0012'),
(13, 'Pending', 'Pending', '2017-11-28 05:32:04', '2017-11-28 05:32:04', '', '2017-0013'),
(14, 'Pending', 'Pending', '2017-11-28 05:32:50', '2017-11-28 05:32:50', '', '2017-0014'),
(15, 'Pending', 'Pending', '2017-11-28 05:33:26', '2017-11-28 05:33:26', '', '2017-0015'),
(16, 'Pending', 'Pending', '2017-11-28 05:34:17', '2017-11-28 05:34:17', '', '2017-0016'),
(17, 'Pending', 'Pending', '2017-11-28 05:35:05', '2017-11-28 05:35:05', '', '2017-0017'),
(18, 'Pending', 'Pending', '2017-11-28 05:36:02', '2017-11-28 05:36:02', '', '2017-0018'),
(19, 'Pending', 'Pending', '2017-11-28 05:36:55', '2017-11-28 05:36:55', '', '2017-0019'),
(20, 'Pending', 'Pending', '2017-11-28 05:37:49', '2017-11-28 05:37:49', '', '2017-0020'),
(21, 'Pending', 'Pending', '2017-11-28 05:39:16', '2017-11-28 05:39:16', '', '2017-0021'),
(22, 'Pending', 'Pending', '2017-11-28 05:40:05', '2017-11-28 05:40:05', '', '2017-0022'),
(23, 'Pending', 'Pending', '2017-11-29 10:14:01', '2017-11-29 10:14:01', '', '2017-0023'),
(24, 'Pending', 'Pending', '2017-11-29 10:14:43', '2017-11-29 10:14:43', '', '2017-0024'),
(25, 'Pending', 'Pending', '2017-11-29 10:15:15', '2017-11-29 10:15:15', '', '2017-0025'),
(26, 'Pending', 'Pending', '2017-11-29 10:16:01', '2017-11-29 10:16:01', '', '2017-0026'),
(27, 'Pending', 'Pending', '2017-11-29 10:16:42', '2017-11-29 10:16:42', '', '2017-0027'),
(28, 'Pending', 'Pending', '2017-11-29 10:17:11', '2017-11-29 10:17:11', '', '2017-0028'),
(29, 'Pending', 'Pending', '2017-11-29 10:17:39', '2017-11-29 10:17:39', '', '2017-0029'),
(30, 'Pending', 'Pending', '2017-11-29 10:18:15', '2017-11-29 10:18:15', '', '2017-0030'),
(31, 'Pending', 'Pending', '2017-11-29 10:18:53', '2017-11-29 10:18:53', '', '2017-0031'),
(32, 'Pending', 'Pending', '2017-11-29 10:19:58', '2017-11-29 10:19:58', '', '2017-0032'),
(33, 'Pending', 'Pending', '2017-11-29 10:20:54', '2017-11-29 10:20:54', '', '2017-0033'),
(34, 'Pending', 'Pending', '2017-11-29 10:21:24', '2017-11-29 10:21:24', '', '2017-0034'),
(35, 'Pending', 'Pending', '2017-11-29 10:21:56', '2017-11-29 10:21:56', '', '2017-0035'),
(36, 'Pending', 'Pending', '2017-11-29 10:22:28', '2017-11-29 10:22:28', '', '2017-0036'),
(37, 'Pending', 'Pending', '2017-11-29 10:23:34', '2017-11-29 10:23:34', '', '2017-0037'),
(38, 'Pending', 'Pending', '2017-11-29 10:24:30', '2017-11-29 10:24:30', '', '2017-0038'),
(39, 'Pending', 'Pending', '2017-11-29 10:25:09', '2017-11-29 10:25:09', '', '2017-0039'),
(40, 'Pending', 'Pending', '2017-11-29 10:25:46', '2017-11-29 10:25:46', '', '2017-0040'),
(41, 'Pending', 'Pending', '2017-11-29 10:26:12', '2017-11-29 10:26:12', '', '2017-0041'),
(42, 'Pending', 'Pending', '2017-11-29 10:26:41', '2017-11-29 10:26:41', '', '2017-0042'),
(43, 'Pending', 'Pending', '2017-11-29 10:27:09', '2017-11-29 10:27:09', '', '2017-0043'),
(44, 'Pending', 'Pending', '2017-11-29 10:27:37', '2017-11-29 10:27:37', '', '2017-0044'),
(45, 'Pending', 'Pending', '2017-11-29 10:28:13', '2017-11-29 10:28:13', '', '2017-0045'),
(46, 'Pending', 'Pending', '2017-11-29 10:29:05', '2017-11-29 10:29:05', '', '2017-0046'),
(47, 'Pending', 'Pending', '2017-11-29 10:29:42', '2017-11-29 10:29:42', '', '2017-0047'),
(48, 'Pending', 'Pending', '2017-11-29 10:30:10', '2017-11-29 10:30:10', '', '2017-0048'),
(49, 'Pending', 'Pending', '2017-11-29 10:31:03', '2017-11-29 10:31:03', '', '2017-0049'),
(50, 'Pending', 'Pending', '2017-11-29 10:31:30', '2017-11-29 10:31:30', '', '2017-0050'),
(51, 'Pending', 'Pending', '2017-11-29 10:31:58', '2017-11-29 10:31:58', '', '2017-0051'),
(52, 'Pending', 'Pending', '2017-11-29 10:32:27', '2017-11-29 10:32:27', '', '2017-0052'),
(53, 'Pending', 'Pending', '2017-11-29 10:33:32', '2017-11-29 10:33:32', '', '2017-0053'),
(54, 'Pending', 'Pending', '2017-11-29 10:34:19', '2017-11-29 10:34:19', '', '2017-0054'),
(55, 'Pending', 'Pending', '2017-11-29 10:34:43', '2017-11-29 10:34:43', '', '2017-0055'),
(56, 'Pending', 'Pending', '2017-11-29 10:35:17', '2017-11-29 10:35:17', '', '2017-0056'),
(57, 'Pending', 'Pending', '2017-11-29 10:35:48', '2017-11-29 10:35:48', '', '2017-0057'),
(58, 'Pending', 'Pending', '2017-11-29 10:36:22', '2017-11-29 10:36:22', '', '2017-0058'),
(59, 'Pending', 'Pending', '2017-11-29 10:37:14', '2017-11-29 10:37:14', '', '2017-0059'),
(60, 'Pending', 'Pending', '2017-11-29 10:37:40', '2017-11-29 10:37:40', '', '2017-0060'),
(61, 'Pending', 'Pending', '2017-11-29 10:38:12', '2017-11-29 10:38:12', '', '2017-0061'),
(62, 'Pending', 'Pending', '2017-11-29 10:38:57', '2017-11-29 10:38:57', '', '2017-0062'),
(63, 'Pending', 'Pending', '2017-11-29 10:39:24', '2017-11-29 10:39:24', '', '2017-0063'),
(64, 'Pending', 'Pending', '2017-11-29 10:40:09', '2017-11-29 10:40:09', '', '2017-0064'),
(65, 'Pending', 'Pending', '2017-11-29 10:40:38', '2017-11-29 10:40:38', '', '2017-0065'),
(66, 'Pending', 'Pending', '2017-11-29 10:41:24', '2017-11-29 10:41:24', '', '2017-0066'),
(67, 'Pending', 'Pending', '2017-11-29 10:42:15', '2017-11-29 10:42:15', '', '2017-0067'),
(68, 'Pending', 'Pending', '2017-11-29 10:42:47', '2017-11-29 10:42:47', '', '2017-0068'),
(69, 'Pending', 'Pending', '2017-11-29 10:43:22', '2017-11-29 10:43:22', '', '2017-0069'),
(70, 'Pending', 'Pending', '2017-11-29 10:43:53', '2017-11-29 10:43:53', '', '2017-0070'),
(71, 'Pending', 'Pending', '2017-11-29 10:44:22', '2017-11-29 10:44:22', '', '2017-0071'),
(72, 'Pending', 'Pending', '2017-11-29 10:44:57', '2017-11-29 10:44:57', '', '2017-0072'),
(73, 'Pending', 'Pending', '2017-11-29 10:45:25', '2017-11-29 10:45:25', '', '2017-0073'),
(74, 'Pending', 'Pending', '2017-11-29 10:46:00', '2017-11-29 10:46:00', '', '2017-0074'),
(75, 'Pending', 'Pending', '2017-11-29 10:46:38', '2017-11-29 10:46:38', '', '2017-0075'),
(76, 'Pending', 'Pending', '2017-11-29 10:47:04', '2017-11-29 10:47:04', '', '2017-0076'),
(77, 'Pending', 'Pending', '2017-11-29 10:47:32', '2017-11-29 10:47:32', '', '2017-0077'),
(78, 'Pending', 'Pending', '2017-11-29 10:48:09', '2017-11-29 10:48:09', '', '2017-0078'),
(79, 'Pending', 'Pending', '2017-11-29 10:48:38', '2017-11-29 10:48:38', '', '2017-0079'),
(80, 'Pending', 'Pending', '2017-11-29 10:49:48', '2017-11-29 10:49:48', '', '2017-0080'),
(81, 'Pending', 'Pending', '2017-11-29 10:50:28', '2017-11-29 10:50:28', '', '2017-0081'),
(82, 'Pending', 'Pending', '2017-11-29 10:51:15', '2017-11-29 10:51:15', '', '2017-0082'),
(83, 'Pending', 'Pending', '2017-11-29 10:51:43', '2017-11-29 10:51:43', '', '2017-0083'),
(84, 'Pending', 'Pending', '2017-11-29 10:52:08', '2017-11-29 10:52:08', '', '2017-0084'),
(85, 'Pending', 'Pending', '2017-11-29 10:52:37', '2017-11-29 10:52:37', '', '2017-0085'),
(86, 'Pending', 'Pending', '2017-11-29 10:53:06', '2017-11-29 10:53:06', '', '2017-0086'),
(87, 'Pending', 'Pending', '2017-11-29 10:53:42', '2017-11-29 10:53:42', '', '2017-0087'),
(88, 'Pending', 'Pending', '2017-11-29 10:54:14', '2017-11-29 10:54:14', '', '2017-0088'),
(89, 'Pending', 'Pending', '2017-11-29 10:54:45', '2017-11-29 10:54:45', '', '2017-0089'),
(90, 'Pending', 'Pending', '2017-11-29 10:55:12', '2017-11-29 10:55:12', '', '2017-0090'),
(91, 'Pending', 'Pending', '2017-11-29 10:55:58', '2017-11-29 10:55:58', '', '2017-0091'),
(92, 'Pending', 'Pending', '2017-11-29 10:56:42', '2017-11-29 10:56:42', '', '2017-0092'),
(93, 'Pending', 'Pending', '2017-11-29 10:57:13', '2017-11-29 10:57:13', '', '2017-0093'),
(94, 'Pending', 'Pending', '2017-11-29 10:57:50', '2017-11-29 10:57:50', '', '2017-0094'),
(95, 'Pending', 'Pending', '2017-11-29 10:58:29', '2017-11-29 10:58:29', '', '2017-0095'),
(96, 'Pending', 'Pending', '2017-11-29 10:58:53', '2017-11-29 10:58:53', '', '2017-0096'),
(97, 'Pending', 'Pending', '2017-11-29 10:59:21', '2017-11-29 10:59:21', '', '2017-0097'),
(98, 'Pending', 'Pending', '2017-11-29 10:59:49', '2017-11-29 10:59:49', '', '2017-0098');


-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(8) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active',
  PRIMARY KEY (`program_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_name`, `alias`, `dept_id`, `status`) VALUES
(1, 'BS Information Technology', 'BSIT', 1, 1),
(2, 'BS Computer Science', 'BSCS', 1, 1),
(3, 'Bachelor in Arts and Communication', 'BAC', 1, 1),
(4, 'Bachelor in Elementary Education', 'BEED', 2, 1),
(5, 'Bachelor in Secondary Education', 'BSED', 2, 1),
(6, 'BS Accountancy', 'BSA', 3, 1),
(7, 'BS Accounting', 'BSAct', 3, 1),
(8, 'BS Entrepreneurship', 'BSEntrep', 3, 1),
(9, 'BS Tourism Management', 'BSTM', 3, 1),
(10, 'Health Care Services', 'HCS', 4, 1),
(11, 'Midwifery', 'MID', 4, 1),
(12, 'BS Mechanical Engineering', 'BSME', 5, 1),
(13, 'Grade 11', 'GR11', 6, 1),
(14, 'Grade 12', 'GR12', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL AUTO_INCREMENT,
  `studentNo` varchar(8) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `stat` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `yearLevel` varchar(9) NOT NULL,
  `sem` varchar(9) NOT NULL,
  `acadYear` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cperson` varchar(50) NOT NULL,
  `cphone` varchar(15) NOT NULL,
  PRIMARY KEY (`StudentID`,`studentNo`),
  UNIQUE KEY `studentNo` (`studentNo`),
  KEY `program` (`program`),
  KEY `dept` (`dept`),
  CONSTRAINT `fk_prog_id` FOREIGN KEY (`program`) REFERENCES `program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sdept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `studentNo`, `last_name`, `first_name`, `middle_name`, `ext`, `age`, `sex`, `dept`, `program`, `yearLevel`, `sem`, `acadYear`, `address`, `cperson`, `cphone`) VALUES
(1, '161-0142', 'Abasola', 'Jonalyn', 'Llames', '', 21, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(2, '161-0046', 'Ajunan', 'Era', 'Duaman', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(3, '161-0183', 'Arbis', 'Pilipina', 'Censon', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(4, '161-0096', 'Ardonia', 'Ryan', 'Llarena', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(5, '162-0019', 'Carandang', 'Mary Joys Anne', 'Delas Alas', '', 20, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(6, '161-0136', 'Comendador', 'Ma. Allyssa Nicole', 'Ardez', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(7, '152-0054', 'Diaz', 'Joefico Von', 'Escamillas', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(8, '161-0051', 'Garbo', 'Jonsclark', 'Barasi', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(9, '161-0081', 'Juancalla', 'Dyan Anerie', 'Abustan', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(10, '151-0204', 'Limonares', 'Jude Zyron', 'Coronado', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(11, '152-0002', 'Aruelo', 'Miguel Jahson', 'Monton', '', 20, 'Male', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(12, '151-0237', 'Ambrocio', 'Jennielle Ann', 'Francisco', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(13, '151-0166', 'Anin', 'Ronalyn', 'Novicio', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(14, '151-0805', 'Arguzon', 'Antonette Mae', 'Zarzozo', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(15, '141-0769', 'Arnigo', 'Marjorie', 'Suliguin', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(16, '151-0656', 'Arriola', 'Elaine Rose', 'Oguerra', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(17, '151-0179', 'Bacanto', 'Jessica', 'Calleza', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(18, '151-0640', 'Bandillo', 'Honey Grace', 'Delos Santos', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(19, '131-1228', 'Barelos', 'Arlene', 'Bagayan', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(20, '151-0791', 'Bautista', 'Marlon', 'Napiza', '', 20, 'Male', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(21, '161-0036', 'Denum', 'Lester', 'Angeles', '', 18, 'Male', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(22, '161-0188', 'Acabado', 'Christine', 'Borres', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(23, '161-0066', 'Alcaide', 'Danica', 'Valdez', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(24, '161-0128', 'Banca', 'Richalyn', '', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(25, '161-0126', 'Barcenas', 'Mary Jane', 'Sibonga', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(26, '161-0079', 'Cainday', 'Sophia Nicole', 'Fresco', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(27, '161-0135', 'Enfante', 'Esperanza', 'Brion', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(28, '161-0011', 'Espiritu', 'Adrian', 'Chuanco', '', 18, 'Male', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(29, '171-0118', 'Ferrer', 'Jack', 'Zafe', '', 18, 'Male', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(30, '161-0062', 'Hernandez', 'Nicole Mae', 'Pamanian', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(31, '151-1374', 'Adrales', 'Christian Jude', 'Guatno', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(32, '151-1364', 'Almanza', 'Ella Mae', 'Ramos', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(33, '151-0711', 'Almanza', 'Bezalel John', 'Dacanay', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(34, '151-1435', 'Apilado', 'Gimevern', 'Dineros', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(35, '151-0172', 'Arandia', 'Nely', 'Lopez', '', 19, 'Female', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(36, '151-1417', 'Arnejo', 'Sabrina Joyce ', 'Bracamonte', '', 19, 'Female', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(37, '161-0124', 'Belga', 'Ronilo', 'Boce', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(38, '151-1371', 'Bortanog', 'Marvie Neil', 'Dela Cruz', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(39, '151-1469', 'Cabreza', 'Chrisman Claudine', 'Saguinsin', '', 19, 'Female', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(40, '162-0005', 'Calaguan', 'Joshua', '', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(41, '131-0558', 'Marikit', 'Hans Roben', 'Zarate', '', 20, 'Male', 1, 1, '4th', '1st', '2017 - 2018', 'Calauan, Laguna', 'Nory Marikit', '0909 400 9342'),
(42, '131-0161', 'Compendio', 'Lea', 'Galimba', '', 25, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Liliw, Laguna', 'Julie G. Compendio', '0909 123 4567'),
(43, '171-0142', 'Abejon', 'R-Jay', 'Tatac', '', 20, 'Male', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(44, '171-0040', 'Arnoco', 'Geraldine', 'Morcilla', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(45, '171-0055', 'Dalmaob', 'Norhaina', 'Sailila', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(46, '171-0032', 'De Chavez', 'Cyndie', 'Quintero', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(47, '171-0047', 'De Ramos', 'Arcel Christlyanne', 'soriano', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(48, '171-0015', 'Diaz', 'Jocelyn', 'Parion', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(49, '171-0158', 'Dinaya', 'Manilyn', 'Olais', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(50, '171-0124', 'Edillor', 'Marela Marie', 'Sangalang', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(51, '171-0227', 'Endiza', 'Liz Nicole', 'Luzena', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(52, '171-0182', 'Espinola', 'Mary Grace', 'Bacube', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(53, '151-0349', 'Aquino', 'Lorenzo', 'Mercado', '', 20, 'Male', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(54, '151-1116', 'Abe', 'Raquel', 'De Guzman', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(55, '151-0319', 'Anuyo', 'Aizza', 'Ballesteros', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(56, '151-0953', 'Aragon', 'Jenelyn', 'Sabucor', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(57, '151-0917', 'Araneta', 'Mary Joy ', 'Cada', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(58, '111-0350', 'Bambano', 'Riza', 'Oña', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(59, '151-1103', 'Bautista', 'Viviana', 'Aquino', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(60, '151-0212', 'Bello', 'Dahlia', 'Coronado', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(61, '151-0184', 'Billones', 'Charlotte', 'De Mesa', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(62, '151-0611', 'Binotapa', 'Shiella Mariz', 'Colarina', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(63, '171-0170', 'Apilado', 'Marc Daniel', 'Sola', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(64, '162-0018', 'Apilado', 'Ma. Nicole', 'Sola', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(65, '171-0162', 'Castillo', 'Regine ', 'Perez', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(66, '171-0154', 'Castro', 'Don Ardrix', 'Laraño', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(67, '171-0222', 'De Guzman', 'Mary Claire', 'Villacora', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(68, '141-1131', 'Dela Peña', 'John Ray', '', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(69, '141-0838', 'Espino', 'Kevin Christian', 'Gutierrez', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(70, '152-0083', 'Formentera', 'Jomer', 'Danaire', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(71, '162-0003', 'Francia', 'Arlene', 'Zaragga', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(72, '171-0161', 'Fulo', 'Marjorie', 'Dela Cruz', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(73, '161-0176', 'Araneta', 'Mark John', 'Adornado', '', 20, 'Male', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(74, '161-0226', 'Acabado', 'Mailyn', 'B', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(75, '161-0104', 'Barlas', 'Erica', 'Pingol', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(76, '161-0149', 'Bonifacio', 'Nikki', 'Magale', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '                        ', '', 'none'),
(77, '161-0004', 'Cano', 'Sherilyn', 'Mindoro', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(78, '161-0111', 'Cansicio', 'Jolina', 'Taparo', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(79, '161-0150', 'Coral', 'Eric Brian', 'Francia', '', 20, 'Male', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(80, '161-0024', 'Guba', 'Patricia', 'Soriano', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(81, '161-0235', 'Guillermo', 'Alona', 'Doromal', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(82, '161-0287', 'Hernandez', 'Sarah Suzette ', 'Landicho', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(83, '161-0171', 'Resurreccion', 'Jade Christian', 'Octavio', '', 20, 'Male', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(84, '161-0005', 'Araman', 'Danica ', 'Ortega', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(85, '161-0257', 'Aurin', 'Rona Jane', 'Lotino', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(86, '151-0700', 'Belista', 'Hyacinth Nazaria', 'Estomaguio', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(87, '161-0057', 'Buban', 'Mel Rose', 'Perez', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(88, '141-1114', 'David', 'Jessalyn Del', 'rosario', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(89, '151-0455', 'Abel', 'Jomary', 'Eres', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(90, '151-1315', 'Adea', 'Airon', 'Francia', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(91, '171-0201', 'Agustine', 'Evangeline', '', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(92, '171-0110', 'Alegre', 'Roseanne Joy', 'Parafina', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(93, '171-0136', 'Alegria', 'Jojo', 'Barros', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(94, '171-0009', 'Alfonso', 'Gail Ronan', 'Roxas', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(95, '152-0073', 'Añunuevo', 'Genedel', 'Corales', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(96, '171-0065', 'Arellano', 'Rigs Albert', 'Hernandez', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(97, '171-0144', 'Atienza', ' Ayhra Casandra', 'Calasicas', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(98, '151-1443', 'Austria', 'Rezzel', 'Villanera', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(99, '131-0177', 'Ang', 'Kier Baby', 'Valeriano', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(100, '161-0065', 'Arete', 'Brandon', 'Ubaldo', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(101, '141-0718', 'Basilio', 'Bryan', 'Marquez', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(102, '151-1476', 'Batocabe', 'Jezel', 'Romero', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(103, '141-0348', 'Bitbit', 'Bernadette', 'Palabay', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(104, '141-0914', 'Villocillo', 'Eddielyn', 'Villocillo', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(105, '151-0421', 'Canoy', 'John Carlo', 'Isidro', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(106, '161-0296', 'Dela Rosa', 'Gaspar', 'Albor', 'Jr', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(107, '151-0531', 'Dizon', 'Erica', 'Gamina', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '                                                                        ', '', 'none'),
(108, '171-0074', 'Granada', 'Joana Lyn', 'Dasigao', '', 19, 'Female', 2, 4, '1st', '', '2017 - 2018', 'Los Banos, Laguna', 'Martin Granada', '0999 568 4599'),
(109, '151-0300', 'Armia', 'Jacklyn ', 'Delgado', '', 20, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Pila Laguna', 'Marissa Armia', '0936 958 7848'),
(110, '131-0279', 'Bataller', 'Kathlene Grace', 'Isaac', '', 21, 'Female', 2, 5, '4th', '', '2017 - 2018', 'Bubukal Sta.Cruz Laguna', 'Peter Bataller', '0916 897 7485'),
(111, '131-0092', 'Reyes', 'Rose Angela', 'Kamatoy', '', 20, 'Female', 2, 4, '2nd', '', '2017 - 2018', 'Los Banos Laguna', 'Ophelia Reyes', '0916 479 9580'),
(112, '141-1048', 'Cahilig', 'Joshua', 'Espino', '', 20, 'Male', 2, 4, '3rd', '', '2017 - 2018', 'Lumban Laguna', 'Le Cahilig', '0916 689 5578'),
(113, '111-0118', 'Cabillan', 'Jefredel', 'Tina', '', 24, 'Male', 2, 4, '3rd', '', '2017 - 2018', 'Barangay Calumpang Nagcarlan Laguna', 'Joseph Cabillan', '0999 784 5911'),
(114, '161-0131', 'Macatangay', 'Luke Erick John', 'Reyes', '', 19, 'Male', 2, 4, '2nd', '', '2017 - 2018', 'Los Banos, Laguna', 'Demetrio Macatangay', '0918 954 8678'),
(115, '162-0038', 'Oca', 'Jurice Reineal', 'Zotomayor', '', 18, 'Male', 2, 4, '2nd', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Candido Oca', '0949 765 4854'),
(116, '141-1116', 'Vegas', 'Glorie', 'Nadres', '', 19, 'Female', 2, 4, '4th', '', '2017 - 2018', 'Pagsanjan Laguna', 'Willie Vegas', '0935 169 8468'),
(117, '141-0303', 'Francisco', 'Jayve', 'Malbas', '', 19, 'Male', 2, 4, '4th', '', '2017 - 2018', 'Calauan Laguna', 'Louie Francisco', '0935 615 4911'),
(118, '151-1333', 'Bueno', 'Danica', 'Calso', '', 19, 'Female', 2, 5, '3rd', '', '2017 - 2018', 'Nagcarlan Laguna', 'Melvin Bueno', '0915 987 6849'),
(119, '141-0929', 'Saber', 'Johndro', 'Nueva', '', 23, 'Male', 2, 5, '4th', '', '2017 - 2018', 'Liliw Laguna', 'Peter Saber', '0916 485 6795'),
(120, '141-0818', 'Punzalan', 'Jenny Rose', 'Gallianira', '', 21, 'Female', 2, 5, '4th', '', '2017 - 2018', 'Bubukal Sta.Cruz Laguna', 'Beth Punzalan', '0916 848 7791'),
(121, '101-0085', 'Betorio', 'Jessieca', 'Baya', '', 25, 'Female', 2, 5, '4th', '', '2017 - 2018', 'Nagcarlan Laguna', 'Lea Betorio', '0916 487 9210'),
(122, '151-1268', 'Buale', 'Charles', 'Layhing', '', 19, 'Male', 2, 5, '3rd', '', '2017 - 2018', 'Liliw Laguna', 'Mark Buale', '0935 487 9510'),
(123, '151-1129', 'Escobel', 'Rheyniel', 'Angeles', '', 22, 'Male', 2, 5, '3rd', '', '2017 - 2018', 'Majayjay Laguna', 'Lea Escobel', '0948 759 4987'),
(124, '151-1366', 'Rementilla', 'Jimuel ', 'Gicalde', '', 21, 'Male', 2, 5, '3rd', '', '2017 - 2018', 'Barangay San Juan Laguna ', 'Pia Rementilla', '0915 798 4587'),
(125, '151-0173', 'Susano', 'Eunice', 'Espedilla', '', 20, 'Female', 2, 5, '3rd', '', '2017 - 2018', 'Bay Laguna', 'Mark Susano', '0916 845 7955'),
(126, '141-0700', 'Visperas', 'Gerami', 'Santilles', '', 21, 'Male', 2, 5, '4th', '', '2017 - 2018', 'Sta.Cruz, Laguna', 'Paul Visperas', '0936 497 5840'),
(127, '151-0453', 'Absalon', 'Albert', 'Grajo', '', 20, 'Male', 3, 8, '3rd', '', '2017 - 2018', 'Pila Laguna', 'Loreto Absalon', '0919 487 9511'),
(128, '152-0084', 'Anil', 'Shulamite', 'Gutierrez', '', 22, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Barangay Pagsawitan Sta.Cruz, Laguna', 'Jeremy Anil', '0916 577 8469'),
(129, '122-0019', 'Articona', 'Marcia Jane', 'Cordez', '', 24, 'Female', 3, 8, '4th', '', '2017 - 2018', 'Barangay Labuin Sta. Cruz Laguna', 'Mark Articona ', '0912 457 9860'),
(130, '162-0046', 'Lastimosa', 'Cyril ', 'Fang', '', 20, 'Male', 3, 8, '1st', '', '2017 - 2018', 'Barangay San Juan Sta. Cruz, Laguna', 'Jenny Lastimosa', '0915 487 9500'),
(131, '162-0047', 'San Sebastian', 'Elson', 'Esplana', '', 19, 'Male', 3, 8, '1st', '', '2017 - 2018', 'Lumban Laguna', 'Mary San Sebastian', '0916 958 7000'),
(132, '161-0184', 'Mercado', 'Prescious Ann', 'De Rama', '', 19, 'Female', 3, 8, '2nd', '', '2017 - 2018', 'Magdalena, Laguna', 'Jennilyn Mercado', '0949 870 0154'),
(133, '161-0123', 'Capinig', 'Jedidia', 'Villar', '', 20, 'Male', 3, 8, '2nd', '', '2017 - 2018', 'Siniloan Laguna', 'Vicky Capinig', '0915 487 0015'),
(134, '152-0010', 'De Luna', 'Joana Rose', 'Velez', '', 20, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Pila, Laguna', 'Weng De Luna', '0946 795 1000'),
(135, '111-0172', 'Samotia', 'Joyce Ann', 'Realubit', '', 25, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Barangay Malinao Sta.Cruz, Laguna', 'Mercedes Samotia', '0915 470 0256'),
(136, '151-0874', 'Patambang', 'Mica Daniela ', 'Barrozo', '', 20, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Kalayaan Laguna', 'Sylvia Patambang', '0916 548 7600'),
(137, '151-0114', 'Ortiz', 'Jeschelle', 'Concejero', '', 20, 'Female', 3, 9, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Grace Ortiz', '0916 497 0158'),
(138, '161-0139', 'Serino', 'Joy Clarisse', 'Cabanatan', '', 19, 'Female', 3, 9, '2nd', '', '2017 - 2018', 'Liliw, Laguna', 'Sally Serino', '0915 684 7900'),
(139, '161-0029', 'Vendiola', 'Mark Teddy', 'Cornel', '', 18, 'Male', 3, 9, '2nd', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Jessy Vendiola', '0936 549 0015'),
(140, '161-0026', 'Villarta', 'Maria Lourdes ', 'Obnamia', '', 19, 'Female', 3, 6, '2nd', '', '2017 - 2018', 'Los Banos, Laguna', 'Janelle Villarta', '0936 480 1250'),
(141, '171-0131', 'Odtuhan', 'Mary Rose', 'Mendoza', '', 19, 'Female', 3, 6, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Pia Odtuhan', '0936 457 0152'),
(142, '131-0271', 'Basco', 'Jolina Marie ', 'Quilloy', '', 19, 'Female', 1, 1, '1st', '', '2017 - 2018', 'Pila, Laguna', 'Joseph Basco', '0915 687 4561'),
(143, '151-1288', 'Caballar', 'Roxanne', 'Valenzuela', '', 21, 'Female', 3, 6, '3rd', '', '2017 - 2018', 'Victoria, Laguna', 'Josy Caballar', '0915 365 7871'),
(144, '131-1096', 'Malabayabas', 'Alpha Jel', 'Lopez', '', 20, 'Male', 1, 2, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Jenny Malabayabas', '0936 540 1250'),
(145, '151-0284', 'Avenido', 'Leody', 'Alog', 'Jr', 19, 'Male', 1, 3, '2nd', '', '2017 - 2018', 'Victoria, Laguna', 'Paul Avenido', '0919 685 0125'),
(146, '151-0304', 'Arizapa', 'Jomari', 'Burgos', '', 18, 'Male', 5, 12, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Irene Arizapa', '0916 501 5203'),
(147, '171-0147', 'Espinoza', 'Faulyn Antonette', 'Elona', '', 17, 'Female', 4, 10, '1st', '', '2017 - 2018', 'Barangay Bagumbayan Sta.Cruz, Laguna', 'Christine Espinoza', '0919 458 0546'),
(148, '141-0628', 'Aranillo', 'Leovien', 'Coronado', '', 20, 'Male', 1, 1, '4th', '', '2017 - 2018', 'Barangay Malinao Nagcarlan, Laguna', 'Lina Aranillo', '0975 849 5012'),
(149, '131-0071', 'Delmundo', 'Mikka Grace', 'Mercado', '', 20, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Lumban, Laguna', 'Maria Delmundo', '0915 869 0125'),
(150, '131-0458', 'Sorizo', 'Angelique', 'Caballes', '', 20, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Josephine Sorizo', '0916 963 6520'),
(151, '131-0950', 'Tranilla', 'Lindon Marconi', 'Bercasio', '', 23, 'Male', 1, 1, '4th', '', '2017 - 2018', 'Sta.Cruz, Laguna', 'Liza Tranilla', '0916 545 0120'),
(152, '131-0685', 'Castro', 'Nico', 'Garon', '', 22, 'Male', 1, 1, '4th', '', '2017 - 2018', 'Pila, Laguna', 'Melissa Castro', '0916 958 0120'),
(153, '151-0143', 'Bueno', 'Melvin', 'Pullan', '', 19, 'Male', 1, 1, '3rd', '', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna', 'Miriam Bueno', '0916 584 0120'),
(154, '141-0314', 'Ansay', 'Judelyn', 'Lipit', '', 19, 'Female', 1, 2, '3rd', '', '2017 - 2018', 'Bay, Laguna', 'Wendy Ansay', '0919 458 6950'),
(155, '151-0738', 'Talabis', 'Jecell', 'Sarsaba', '', 18, 'Female', 1, 2, '2nd', '', '2017 - 2018', 'Barangay Calios Sta.Cruz, Laguna', 'Jeffrey Talabis', '0999 684 8502'),
(156, '141-1199', 'Borbe', 'Lovely Joy', 'Molina', '', 19, 'Female', 1, 3, '2nd', '', '2017 - 2018', 'Barangay Pagsawitan Sta.Cruz, Laguna', 'Allan Borbe', '0916 985 0225'),
(157, '141-0420', 'Berwega', 'Christhel Joy', 'Mantes', '', 20, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Calauan Laguna', 'Dory Berwega', '0999 854 0021'),
(158, '141-0694', 'Villamayor', 'Johnson', 'Delgado', '', 20, 'Male', 5, 12, '4th', '', '2017 - 2018', 'Lumban Laguna', 'John Villamayor', '0916 595 0120'),
(159, '162-0051', 'Abina', 'Lorenz Joy', 'Cahindo', '', 19, 'Female', 4, 11, '1st', '', '2017 - 2018', 'Victoria, Laguna', 'Goring Abina', '0915 696 0129'),
(160, '171-0013', 'Reyes', 'Maria Cecilia', 'Delgado', '', 18, 'Female', 4, 11, '1st', '', '2017 - 2018', 'Los Banos, Laguna', 'Raquel Reyes', '0919 650 3626'),
(161, '151-0774', 'Sta Maria', 'Elaine', 'Corpuz', '', 19, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Victoria, Laguna', 'Catherine Sta Maria', '0916 549 5025'),
(162, '151-1214', 'Ortiaga', 'Meriel', 'Suazo', '', 19, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Pauleen Ortiaga', '0915 693 6100'),
(163, '141-0675', 'Comendador', 'Alvenzon', 'Cartina', '', 17, 'Male', 1, 1, '2nd', '', '2017 - 2018', 'Pagsanjan, Laguna', 'Teody Comendador', '0919 458 6950'),
(164, '141-0875', 'Urbano', 'Daisy', 'Del Puerto', '', 19, 'Female', 1, 3, '3rd', '', '2017 - 2018', 'Pila, Laguna', 'Luis Urbano', '0935 695 0145'),
(165, '141-1010', 'Lualhati', 'Dhustine', 'Monreal', '', 19, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Los Banos, Laguna', 'Glory Lualhati', '0935 964 1015'),
(166, '151-1388', 'De Luna', 'Jennalyn', 'Rafael', '', 19, 'Female', 1, 1, '3rd', '1st', '2017 - 2018', 'Pila, Laguna                        ', 'Bernie De Luna', '0935 497 8598'),
(167, '151-0213', 'Coronado', 'Reinalyn', 'Bringuela', '', 19, 'Female', 1, 1, '3rd', '', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna', 'Melissa Coronado', '0916 598 5699'),
(168, '131-0883', 'Santianez', 'Policarpo', 'Arnejo', 'Jr', 21, 'Male', 1, 1, '3rd', '', '2017 - 2018', 'Barangay Calumpang Nagcarlan, Laguna', 'Francisco Santianez', '0915 969 5679'),
(169, '151-1007', 'Navarro', 'Honey Grace', 'Mercado', '', 9, 'Female', 1, 3, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Jeremy Navarro', '0919 698 6366'),
(170, '151-1248', 'Tope', 'Ian', 'Coronado', '', 19, 'Male', 1, 3, '3rd', '', '2017 - 2018', 'Lumban, Laguna', 'Paul Tope', '0919 643 6652'),
(171, '141-0809', 'Vidal', 'Judy Anne', 'Balmes', '', 19, 'Female', 1, 3, '3rd', '', '2017 - 2018', 'Bay, Laguna', 'Mario Vidal', '0916 596 8799'),
(172, '161-0253', 'Lilia', 'Abegail', 'Samonte', '', 18, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Victoria, Laguna', 'Mike Lilia', '0915 636 5455'),
(173, '151-1077', 'Muyco', 'Wilfredo', 'Tarroza', 'Jr', 18, 'Male', 3, 9, '2nd', '', '2017 - 2018', 'Liliw, Laguna', 'Lea Muyco', '0916 598 6999'),
(174, '151-0221', 'Torres', 'Milca', 'Espiritu', '', 18, 'Female', 3, 9, '3rd', '', '2017 - 2018', 'Barangay Calios Sta.Cruz, Laguna', 'Michael Torres', '0916 589 7966'),
(175, '151-0495', 'Montejo', 'Joel', 'Paed', '', 18, 'Male', 5, 12, '2nd', '', '2017 - 2018', 'Calauan, Laguna', 'Teresa Montejo', '0916 597 8777'),
(176, '171-0121', 'Nagal', 'Arvin', 'De Leon', '', 17, 'Male', 5, 12, '1st', '', '2017 - 2018', 'Bay, Laguna', 'Artemio Nagal', '0999 643 6665'),
(177, '161-0076', 'Santiago', 'Shela Mae', 'Tuazon', '', 17, 'Female', 4, 10, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Raymond Santiago', '0925 968 6954'),
(178, '151-1384', 'Eliseo', 'Sherwin', 'Coronado', '', 18, 'Male', 4, 10, '2nd', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Comelyn Eliseo', '0915 996 8694'),
(179, '141-0256', 'Ocot', 'Nikka Mae', 'Malabana', '', 19, 'Female', 1, 2, '2nd', '', '2017 - 2018', 'Dayap Calauan, Laguna', 'Liza Ocot', '0916 986 9745'),
(180, '151-0192', 'Romero', 'Shaira Anne ', 'Del Poso', '', 18, 'Female', 1, 2, '3rd', '', '2017 - 2018', 'Los Banos, Laguna', 'Michelle Romero', '0917 986 8451'),
(181, '171-0167', 'Metin', 'Amir', 'Argente', '', 16, 'Male', 5, 12, '1st', '', '2017 - 2018', 'Barangay Calios Sta.Cruz, Laguna', 'Coney Metin', '0905 698 6479'),
(182, '141-1060', 'Bangay', 'Jan Myloc', 'Evalobo', '', 19, 'Male', 1, 1, '3rd', '', '2017 - 2018', 'Pila, Laguna', 'Grace Bangay', '0927 984 6986'),
(183, '131-0097', 'Leongson', 'Rio Joie', 'Limongco', '', 20, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Sta.Cruz, Laguna', 'Jackelyn Leongson', '0925 968 7741'),
(183, '141-0076', 'Javier', 'Jan Ivy', 'Bonifacio', '', 21, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Barangay Pagsawitan Sta.Cruz, Laguna', 'Anne Javier', '0936 549 7888'),
(185, '141-0181', 'Recodig', 'Jocelyn', 'Dorado', '', 20, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna', 'Oscar Recodig', '0975 988 9874'),
(186, '141-0094', 'Villeta', 'Redelyn', 'Alvendia', '', 19, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Magdalena, Laguna', 'Henry Villeta', '0915 699 8746'),
(187, '131-0792', 'Valencia', 'Dervin John', 'Jarabata', '', 20, 'Male', 1, 1, '4th', '1st', '2017 - 2018', 'Bay, Laguna                        ', 'Victoria Valencia', '0936 597 8485'),
(188, '131-0301', 'Pedimonte', 'Joseph ', 'Endaya', '', 21, 'Male', 1, 2, '4th', '', '2017 - 2018', 'Victoria, Laguna', 'Leon Pedimonte', '0946 598 8896'),
(189, '131-0728', 'De Castro', 'Julius Lemuel', 'Areta', '', 21, 'Male', 5, 12, '2nd', '', '2017 - 2018', 'Bay, Laguna', 'Waldo De Castro', '0999 458 7965'),
(190, '161-0020', 'Bagayan', 'Aida', 'Quintero', '', 22, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Liliw, Laguna', 'Charice Bagayan', '0917 998 6954'),
(191, '131-0779', 'Mandigma', 'Marinela', 'Bautista', '', 21, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Meriam Mandigma', '0916 597 7899'),
(192, '141-0623', 'Dadley', 'Marjorie', 'Toong', '', 20, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Barangay Oogong Sta.Cruz, Laguna', 'Kate Dadley', '0905 956 4986'),
(193, '111-0505', 'Betorio', 'Jacqueline', 'Baya', '', 23, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Pila, Laguna', 'Martin Betorio', 'none'),
(194, '131-0454', 'Sabangan', 'Bebot', 'Rodrigo', 'Jr', 21, 'Male', 1, 3, '4th', '1st', '2017 - 2018', 'Los Banos, Laguna                        ', 'Pedro Sabangan', '0935 978 4955'),
(195, '141-1102', 'Seda', 'Mestica', 'Casino', '', 20, 'Female', 1, 3, '4th', '1st', '2017 - 2018', 'Lumban, Laguna                        ', 'Wendy Seda', '0917 447 8455'),
(196, '151-0076', 'Plantilla', 'Rejoyce', 'Lagubana', '', 18, 'Female', 1, 1, '3rd', '1st', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna                        ', 'Josy Plantilla', '0916 986 9985'),
(197, '131-0414', 'Plantilla', 'Shaira', 'Dorado', '', 20, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Barangay Silangan, Lazaan, Nagcarlan, Laguna                                                        ', 'Pedro C. Plantilla', '0935 535 5030'),
(198, '132-0001', 'Punzalan', 'Elizabeth', 'Elec', '', 24, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Pili St., Makiling Subd., Anos, Los Banos, Laguna', 'Anabelle E. Punzalan', '0935 830 6457');

-- --------------------------------------------------------

--
-- Table structure for table `students_cert`
--

CREATE TABLE `students_cert` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rest` varchar(100) NOT NULL,
  `resolution` varchar(50) NOT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`StudentID`),
  UNIQUE KEY `StudentID` (`StudentID`),
  CONSTRAINT `fk_cert_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_dental`
--

CREATE TABLE `students_dental` (
  `DID` int(11) NOT NULL AUTO_INCREMENT,
  `medHis` varchar(500) NOT NULL,
  `dec_x` int(11) NOT NULL,
  `dec_f` int(11) NOT NULL,
  `missing` int(11) NOT NULL,
  `filled` int(11) NOT NULL,
  `per_con` varchar(50) NOT NULL,
  `con_rem1` varchar(50) NOT NULL,
  `con_rem2` varchar(50) NOT NULL,
  `con_rem3` varchar(50) NOT NULL,
  `con_rem4` varchar(50) NOT NULL,
  `con_spec` varchar(50) NOT NULL,
  `denture` varchar(5) NOT NULL,
  `pro_rem1` varchar(50) NOT NULL,
  `pro_spec1` varchar(50) NOT NULL,
  `need` varchar(5) NOT NULL,
  `pro_rem2` varchar(50) NOT NULL,
  `pro_spec2` varchar(50) NOT NULL,
  `pro_rem3` varchar(50) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`DID`,`StudentID`),
  UNIQUE KEY `StudentID` (`StudentID`),
  CONSTRAINT `fk_dent_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_med`
--

CREATE TABLE `students_med` (
  `MedID` int(11) NOT NULL AUTO_INCREMENT,
  `sysRev` varchar(500) NOT NULL,
  `medHis` varchar(500) NOT NULL,
  `drinker` varchar(3) NOT NULL,
  `smoker` varchar(3) NOT NULL,
  `drug_user` varchar(3) NOT NULL,
  `mens` varchar(10) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(5) NOT NULL,
  `bmi_cat` varchar(20) NOT NULL,
  `bp` varchar(10) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `xray` varchar(3) NOT NULL,
  `assess` varchar(3) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `studentNo` varchar(8) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`MedID`,`StudentID`),
  UNIQUE KEY `StudentID` (`StudentID`),
  CONSTRAINT `fk_med_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_soap`
--

CREATE TABLE `students_soap` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `sysRev` varchar(500) NOT NULL,
  `med` varchar(500) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(5) NOT NULL,
  `bmi_cat` varchar(20) NOT NULL,
  `bp` varchar(10) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `assess` text(500) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`SID`,`StudentID`),
  UNIQUE KEY `StudentID` (`StudentID`),
  CONSTRAINT `fk_soap_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_stats`
--

CREATE TABLE `students_stats` (
  `StatsID` int(11) NOT NULL AUTO_INCREMENT,
  `med` varchar(7) NOT NULL DEFAULT 'Pending',
  `dent` varchar(7) NOT NULL DEFAULT 'Pending',
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checked_by` varchar(50) NOT NULL,
  `studentNo` varchar(8) NOT NULL,
  PRIMARY KEY (`StatsID`,`studentNo`),
  UNIQUE KEY `studentNo` (`studentNo`),
  CONSTRAINT `fk_stats_id` FOREIGN KEY (`studentNo`) REFERENCES `students` (`studentNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_stats`
--

INSERT INTO `students_stats` (`StatsID`, `med`, `dent`, `date_registered`, `date_updated`, `checked_by`, `studentNo`) VALUES
(1, 'Pending', 'Pending', '2017-11-12 18:38:24', '2017-11-12 18:38:24', '', '161-0142'),
(2, 'Pending', 'Pending', '2017-11-12 18:39:18', '2017-11-12 18:39:18', '', '161-0046'),
(3, 'Pending', 'Pending', '2017-11-12 18:41:07', '2017-11-12 18:41:07', '', '161-0183'),
(4, 'Pending', 'Pending', '2017-11-12 18:41:49', '2017-11-12 18:41:49', '', '161-0096'),
(5, 'Pending', 'Pending', '2017-11-12 18:42:45', '2017-11-12 18:42:45', '', '162-0019'),
(6, 'Pending', 'Pending', '2017-11-12 18:44:13', '2017-11-12 18:44:13', '', '161-0136'),
(7, 'Pending', 'Pending', '2017-11-12 18:49:21', '2017-11-12 18:49:21', '', '152-0054'),
(8, 'Pending', 'Pending', '2017-11-12 18:50:35', '2017-11-12 18:50:35', '', '161-0051'),
(9, 'Pending', 'Pending', '2017-11-12 18:52:04', '2017-11-12 18:52:04', '', '161-0081'),
(10, 'Pending', 'Pending', '2017-11-12 18:52:52', '2017-11-12 18:52:52', '', '151-0204'),
(11, 'Pending', 'Pending', '2017-11-12 18:55:06', '2017-11-12 18:55:06', '', '152-0002'),
(12, 'Pending', 'Pending', '2017-11-12 18:55:52', '2017-11-12 18:55:52', '', '151-0237'),
(13, 'Pending', 'Pending', '2017-11-12 18:56:35', '2017-11-12 18:56:35', '', '151-0166'),
(14, 'Pending', 'Pending', '2017-11-12 18:58:14', '2017-11-12 18:58:14', '', '151-0805'),
(15, 'Pending', 'Pending', '2017-11-12 18:59:45', '2017-11-12 18:59:45', '', '141-0769'),
(16, 'Pending', 'Pending', '2017-11-12 19:01:31', '2017-11-12 19:01:31', '', '151-0656'),
(17, 'Pending', 'Pending', '2017-11-12 19:02:33', '2017-11-12 19:02:33', '', '151-0179'),
(18, 'Pending', 'Pending', '2017-11-12 19:03:37', '2017-11-12 19:03:37', '', '151-0640'),
(19, 'Pending', 'Pending', '2017-11-12 19:04:16', '2017-11-12 19:04:16', '', '131-1228'),
(20, 'Pending', 'Pending', '2017-11-12 19:04:46', '2017-11-12 19:04:46', '', '151-0791'),
(21, 'Pending', 'Pending', '2017-11-12 19:07:22', '2017-11-12 19:07:22', '', '161-0036'),
(22, 'Pending', 'Pending', '2017-11-12 19:08:35', '2017-11-12 19:08:35', '', '161-0188'),
(23, 'Pending', 'Pending', '2017-11-12 19:09:16', '2017-11-12 19:09:16', '', '161-0066'),
(24, 'Pending', 'Pending', '2017-11-12 19:09:53', '2017-11-12 19:09:53', '', '161-0128'),
(25, 'Pending', 'Pending', '2017-11-12 19:10:33', '2017-11-12 19:10:33', '', '161-0126'),
(26, 'Pending', 'Pending', '2017-11-12 19:11:31', '2017-11-12 19:11:31', '', '161-0079'),
(27, 'Pending', 'Pending', '2017-11-12 19:12:20', '2017-11-12 19:12:20', '', '161-0135'),
(28, 'Pending', 'Pending', '2017-11-12 19:12:56', '2017-11-12 19:12:56', '', '161-0011'),
(29, 'Pending', 'Pending', '2017-11-12 19:13:55', '2017-11-12 19:13:55', '', '171-0118'),
(30, 'Pending', 'Pending', '2017-11-12 19:14:47', '2017-11-12 19:14:47', '', '161-0062'),
(31, 'Pending', 'Pending', '2017-11-12 19:16:21', '2017-11-12 19:16:21', '', '151-1374'),
(32, 'Pending', 'Pending', '2017-11-12 19:17:46', '2017-11-12 19:17:46', '', '151-1364'),
(33, 'Pending', 'Pending', '2017-11-12 19:19:06', '2017-11-12 19:19:06', '', '151-0711'),
(34, 'Pending', 'Pending', '2017-11-12 19:19:50', '2017-11-12 19:19:50', '', '151-1435'),
(35, 'Pending', 'Pending', '2017-11-12 19:20:25', '2017-11-12 19:20:25', '', '151-0172'),
(36, 'Pending', 'Pending', '2017-11-12 19:21:25', '2017-11-12 19:21:25', '', '151-1417'),
(37, 'Pending', 'Pending', '2017-11-12 19:22:00', '2017-11-12 19:22:00', '', '161-0124'),
(38, 'Pending', 'Pending', '2017-11-12 19:22:48', '2017-11-12 19:22:48', '', '151-1371'),
(39, 'Pending', 'Pending', '2017-11-12 19:23:31', '2017-11-12 19:23:31', '', '151-1469'),
(40, 'Pending', 'Pending', '2017-11-12 19:24:30', '2017-11-12 19:24:30', '', '162-0005'),
(41, 'Pending', 'Pending', '2017-11-13 17:52:44', '2017-11-13 17:52:44', '', '131-0558'),
(42, 'Pending', 'Pending', '2017-11-13 17:54:23', '2017-11-13 17:54:23', '', '131-0161'),
(43, 'Pending', 'Pending', '2017-11-12 10:37:27', '2017-11-12 10:37:27', '', '171-0142'),
(44, 'Pending', 'Pending', '2017-11-12 10:38:48', '2017-11-12 10:38:48', '', '171-0040'),
(45, 'Pending', 'Pending', '2017-11-12 10:40:04', '2017-11-12 10:40:04', '', '171-0055'),
(46, 'Pending', 'Pending', '2017-11-12 10:48:03', '2017-11-12 10:48:03', '', '171-0032'),
(47, 'Pending', 'Pending', '2017-11-12 10:50:07', '2017-11-12 10:50:07', '', '171-0047'),
(48, 'Pending', 'Pending', '2017-11-12 10:51:24', '2017-11-12 10:51:24', '', '171-0015'),
(49, 'Pending', 'Pending', '2017-11-12 10:52:39', '2017-11-12 10:52:39', '', '171-0158'),
(50, 'Pending', 'Pending', '2017-11-12 10:54:15', '2017-11-12 10:54:15', '', '171-0124'),
(51, 'Pending', 'Pending', '2017-11-12 10:54:51', '2017-11-12 10:54:51', '', '171-0227'),
(52, 'Pending', 'Pending', '2017-11-12 10:55:33', '2017-11-12 10:55:33', '', '171-0182'),
(53, 'Pending', 'Pending', '2017-11-12 10:56:34', '2017-11-12 10:56:34', '', '151-0349'),
(54, 'Pending', 'Pending', '2017-11-12 10:57:09', '2017-11-12 10:57:09', '', '151-1116'),
(55, 'Pending', 'Pending', '2017-11-12 10:57:46', '2017-11-12 10:57:46', '', '151-0319'),
(56, 'Pending', 'Pending', '2017-11-12 10:58:31', '2017-11-12 10:58:31', '', '151-0953'),
(57, 'Pending', 'Pending', '2017-11-12 11:00:02', '2017-11-12 11:00:02', '', '151-0917'),
(58, 'Pending', 'Pending', '2017-11-12 11:01:52', '2017-11-12 11:01:52', '', '111-0350'),
(59, 'Pending', 'Pending', '2017-11-12 11:02:34', '2017-11-12 11:02:34', '', '151-1103'),
(60, 'Pending', 'Pending', '2017-11-12 11:03:06', '2017-11-12 11:03:06', '', '151-0212'),
(61, 'Pending', 'Pending', '2017-11-12 11:03:46', '2017-11-12 11:03:46', '', '151-0184'),
(62, 'Pending', 'Pending', '2017-11-12 11:04:45', '2017-11-12 11:04:45', '', '151-0611'),
(63, 'Pending', 'Pending', '2017-11-12 11:16:04', '2017-11-12 11:16:04', '', '171-0170'),
(64, 'Pending', 'Pending', '2017-11-12 11:18:39', '2017-11-12 11:18:39', '', '162-0018'),
(65, 'Pending', 'Pending', '2017-11-12 11:19:13', '2017-11-12 11:19:13', '', '171-0162'),
(66, 'Pending', 'Pending', '2017-11-12 11:19:56', '2017-11-12 11:19:56', '', '171-0154'),
(67, 'Pending', 'Pending', '2017-11-12 11:20:50', '2017-11-12 11:20:50', '', '171-0222'),
(68, 'Pending', 'Pending', '2017-11-12 11:22:31', '2017-11-12 11:22:31', '', '141-1131'),
(69, 'Pending', 'Pending', '2017-11-12 11:23:28', '2017-11-12 11:23:28', '', '141-0838'),
(70, 'Pending', 'Pending', '2017-11-12 11:24:04', '2017-11-12 11:24:04', '', '152-0083'),
(71, 'Pending', 'Pending', '2017-11-12 15:32:09', '2017-11-12 15:32:09', '', '162-0003'),
(72, 'Pending', 'Pending', '2017-11-12 15:32:45', '2017-11-12 15:32:45', '', '171-0161'),
(73, 'Pending', 'Pending', '2017-11-12 15:36:02', '2017-11-12 15:36:02', '', '161-0176'),
(74, 'Pending', 'Pending', '2017-11-12 15:37:47', '2017-11-12 15:37:47', '', '161-0226'),
(75, 'Pending', 'Pending', '2017-11-12 15:38:55', '2017-11-12 15:38:55', '', '161-0104'),
(76, 'Pending', 'Pending', '2017-11-12 15:39:42', '2017-11-12 15:39:42', '', '161-0149'),
(77, 'Pending', 'Pending', '2017-11-12 15:40:38', '2017-11-12 15:40:38', '', '161-0004'),
(78, 'Pending', 'Pending', '2017-11-12 15:41:35', '2017-11-12 15:41:35', '', '161-0111'),
(79, 'Pending', 'Pending', '2017-11-12 15:42:36', '2017-11-12 15:42:36', '', '161-0150'),
(80, 'Pending', 'Pending', '2017-11-12 15:43:28', '2017-11-12 15:43:28', '', '161-0024'),
(81, 'Pending', 'Pending', '2017-11-12 15:44:15', '2017-11-12 15:44:15', '', '161-0235'),
(82, 'Pending', 'Pending', '2017-11-12 15:45:08', '2017-11-12 15:45:08', '', '161-0287'),
(83, 'Pending', 'Pending', '2017-11-12 15:47:08', '2017-11-12 15:47:08', '', '161-0171'),
(84, 'Pending', 'Pending', '2017-11-12 15:53:46', '2017-11-12 15:53:46', '', '161-0005'),
(85, 'Pending', 'Pending', '2017-11-12 15:54:30', '2017-11-12 15:54:30', '', '161-0257'),
(86, 'Pending', 'Pending', '2017-11-12 15:55:36', '2017-11-12 15:55:36', '', '151-0700'),
(87, 'Pending', 'Pending', '2017-11-12 15:56:11', '2017-11-12 15:56:11', '', '161-0057'),
(88, 'Pending', 'Pending', '2017-11-12 15:57:01', '2017-11-12 15:57:01', '', '141-1114'),
(89, 'Pending', 'Pending', '2017-11-12 16:02:40', '2017-11-12 16:02:40', '', '151-0455'),
(90, 'Pending', 'Pending', '2017-11-12 16:03:20', '2017-11-12 16:03:20', '', '151-1315'),
(91, 'Pending', 'Pending', '2017-11-12 16:03:58', '2017-11-12 16:03:58', '', '171-0201'),
(92, 'Pending', 'Pending', '2017-11-12 16:04:39', '2017-11-12 16:04:39', '', '171-0110'),
(93, 'Pending', 'Pending', '2017-11-12 16:05:23', '2017-11-12 16:05:23', '', '171-0136'),
(94, 'Pending', 'Pending', '2017-11-12 16:06:16', '2017-11-12 16:06:16', '', '171-0009'),
(95, 'Pending', 'Pending', '2017-11-12 16:07:05', '2017-11-12 16:07:05', '', '152-0073'),
(96, 'Pending', 'Pending', '2017-11-12 16:07:56', '2017-11-12 16:07:56', '', '171-0065'),
(97, 'Pending', 'Pending', '2017-11-12 16:08:49', '2017-11-12 16:08:49', '', '171-0144'),
(98, 'Pending', 'Pending', '2017-11-12 16:09:34', '2017-11-12 16:09:34', '', '151-1443'),
(99, 'Pending', 'Pending', '2017-11-12 16:11:52', '2017-11-12 16:11:52', '', '131-0177'),
(100, 'Pending', 'Pending', '2017-11-12 16:12:57', '2017-11-12 16:12:57', '', '161-0065'),
(101, 'Pending', 'Pending', '2017-11-12 16:13:43', '2017-11-12 16:13:43', '', '141-0718'),
(102, 'Pending', 'Pending', '2017-11-12 16:14:37', '2017-11-12 16:14:37', '', '151-1476'),
(103, 'Pending', 'Pending', '2017-11-12 16:15:11', '2017-11-12 16:15:11', '', '141-0348'),
(104, 'Pending', 'Pending', '2017-11-12 16:18:29', '2017-11-12 16:18:29', '', '141-0914'),
(105, 'Pending', 'Pending', '2017-11-12 16:19:20', '2017-11-12 16:19:20', '', '151-0421'),
(106, 'Pending', 'Pending', '2017-11-12 16:20:13', '2017-11-12 16:20:13', '', '161-0296'),
(107, 'Pending', 'Pending', '2017-11-12 16:20:46', '2017-11-12 16:20:46', '', '151-0531'),
(108, 'Pending', 'Pending', '2017-11-12 04:06:34', '2017-11-12 04:06:34', '', '171-0074'),
(109, 'Pending', 'Pending', '2017-11-12 04:08:45', '2017-11-12 04:08:45', '', '151-0300'),
(110, 'Pending', 'Pending', '2017-11-12 04:10:31', '2017-11-12 04:10:31', '', '131-0279'),
(111, 'Pending', 'Pending', '2017-11-12 04:13:07', '2017-11-12 04:13:07', '', '131-0092'),
(112, 'Pending', 'Pending', '2017-11-12 04:14:31', '2017-11-12 04:14:31', '', '141-1048'),
(113, 'Pending', 'Pending', '2017-11-12 04:31:24', '2017-11-12 04:31:24', '', '111-0118'),
(114, 'Pending', 'Pending', '2017-11-12 04:33:49', '2017-11-12 04:33:49', '', '161-0131'),
(115, 'Pending', 'Pending', '2017-11-12 04:37:18', '2017-11-12 04:37:18', '', '162-0038'),
(116, 'Pending', 'Pending', '2017-11-12 04:40:24', '2017-11-12 04:40:24', '', '141-1116'),
(117, 'Pending', 'Pending', '2017-11-12 04:42:16', '2017-11-12 04:42:16', '', '141-0303'),
(118, 'Pending', 'Pending', '2017-11-12 04:43:51', '2017-11-12 04:43:51', '', '151-1333'),
(119, 'Pending', 'Pending', '2017-11-12 05:03:53', '2017-11-12 05:03:53', '', '141-0929'),
(120, 'Pending', 'Pending', '2017-11-12 04:46:08', '2017-11-12 04:46:08', '', '141-0818'),
(121, 'Pending', 'Pending', '2017-11-12 04:49:01', '2017-11-12 04:49:01', '', '101-0085'),
(122, 'Pending', 'Pending', '2017-11-12 04:50:19', '2017-11-12 04:50:19', '', '151-1268'),
(123, 'Pending', 'Pending', '2017-11-12 04:53:08', '2017-11-12 04:53:08', '', '151-1129'),
(124, 'Pending', 'Pending', '2017-11-12 04:55:29', '2017-11-12 04:55:29', '', '151-1366'),
(125, 'Pending', 'Pending', '2017-11-12 04:58:21', '2017-11-12 04:58:21', '', '151-0173'),
(126, 'Pending', 'Pending', '2017-11-12 05:00:49', '2017-11-12 05:00:49', '', '141-0700'),
(127, 'Pending', 'Pending', '2017-11-12 05:05:23', '2017-11-12 05:05:23', '', '151-0453'),
(128, 'Pending', 'Pending', '2017-11-12 05:18:16', '2017-11-12 05:18:16', '', '152-0084'),
(129, 'Pending', 'Pending', '2017-11-12 05:21:45', '2017-11-12 05:21:45', '', '122-0019'),
(130, 'Pending', 'Pending', '2017-11-12 05:26:38', '2017-11-12 05:26:38', '', '162-0046'),
(131, 'Pending', 'Pending', '2017-11-12 05:29:16', '2017-11-12 05:29:16', '', '162-0047'),
(132, 'Pending', 'Pending', '2017-11-12 05:31:34', '2017-11-12 05:31:34', '', '161-0184'),
(133, 'Pending', 'Pending', '2017-11-12 05:34:42', '2017-11-12 05:34:42', '', '161-0123'),
(134, 'Pending', 'Pending', '2017-11-12 05:36:28', '2017-11-12 05:36:28', '', '152-0010'),
(135, 'Pending', 'Pending', '2017-11-12 05:38:47', '2017-11-12 05:38:47', '', '111-0172'),
(136, 'Pending', 'Pending', '2017-11-12 05:40:13', '2017-11-12 05:40:13', '', '151-0874'),
(137, 'Pending', 'Pending', '2017-11-12 05:46:13', '2017-11-12 05:46:13', '', '151-0114'),
(138, 'Pending', 'Pending', '2017-11-12 05:48:20', '2017-11-12 05:48:20', '', '161-0139'),
(139, 'Pending', 'Pending', '2017-11-12 05:51:14', '2017-11-12 05:51:14', '', '161-0029'),
(140, 'Pending', 'Pending', '2017-11-12 05:52:45', '2017-11-12 05:52:45', '', '161-0026'),
(141, 'Pending', 'Pending', '2017-11-12 05:53:49', '2017-11-12 05:53:49', '', '171-0131'),
(142, 'Pending', 'Pending', '2017-11-12 06:07:02', '2017-11-12 06:07:02', '', '131-0271'),
(143, 'Pending', 'Pending', '2017-11-12 06:09:42', '2017-11-12 06:09:42', '', '151-1288'),
(144, 'Pending', 'Pending', '2017-11-12 06:13:40', '2017-11-12 06:13:40', '', '131-1096'),
(145, 'Pending', 'Pending', '2017-11-12 06:15:12', '2017-11-12 06:15:12', '', '151-0284'),
(146, 'Pending', 'Pending', '2017-11-12 06:17:58', '2017-11-12 06:17:58', '', '151-0304'),
(147, 'Pending', 'Pending', '2017-11-12 06:21:18', '2017-11-12 06:21:18', '', '171-0147'),
(148, 'Pending', 'Pending', '2017-11-12 06:22:49', '2017-11-12 06:22:49', '', '141-0628'),
(149, 'Pending', 'Pending', '2017-11-12 06:24:02', '2017-11-12 06:24:02', '', '131-0071'),
(150, 'Pending', 'Pending', '2017-11-12 06:25:43', '2017-11-12 06:25:43', '', '131-0458'),
(151, 'Pending', 'Pending', '2017-11-12 06:27:58', '2017-11-12 06:27:58', '', '131-0950'),
(152, 'Pending', 'Pending', '2017-11-12 06:29:29', '2017-11-12 06:29:29', '', '131-0685'),
(153, 'Pending', 'Pending', '2017-11-12 06:31:32', '2017-11-12 06:31:32', '', '151-0143'),
(154, 'Pending', 'Pending', '2017-11-12 06:34:44', '2017-11-12 06:34:44', '', '141-0314'),
(155, 'Pending', 'Pending', '2017-11-12 06:36:59', '2017-11-12 06:36:59', '', '151-0738'),
(156, 'Pending', 'Pending', '2017-11-12 06:38:44', '2017-11-12 06:38:44', '', '141-1199'),
(157, 'Pending', 'Pending', '2017-11-12 06:42:25', '2017-11-12 06:42:25', '', '141-0420'),
(158, 'Pending', 'Pending', '2017-11-12 06:44:48', '2017-11-12 06:44:48', '', '141-0694'),
(159, 'Pending', 'Pending', '2017-11-12 06:49:02', '2017-11-12 06:49:02', '', '162-0051'),
(160, 'Pending', 'Pending', '2017-11-12 06:51:54', '2017-11-12 06:51:54', '', '171-0013'),
(161, 'Pending', 'Pending', '2017-11-12 06:53:36', '2017-11-12 06:53:36', '', '151-0774'),
(162, 'Pending', 'Pending', '2017-11-12 06:59:03', '2017-11-12 06:59:03', '', '151-1214'),
(163, 'Pending', 'Pending', '2017-11-12 07:00:44', '2017-11-12 07:00:44', '', '141-0675'),
(164, 'Pending', 'Pending', '2017-11-12 07:02:53', '2017-11-12 07:02:53', '', '141-0875'),
(165, 'Pending', 'Pending', '2017-11-12 07:07:39', '2017-11-12 07:07:39', '', '141-1010'),
(166, 'Pending', 'Pending', '2017-11-12 07:15:04', '2017-11-12 07:15:04', '', '151-1388'),
(167, 'Pending', 'Pending', '2017-11-12 07:16:19', '2017-11-12 07:16:19', '', '151-0213'),
(168, 'Pending', 'Pending', '2017-11-12 07:18:08', '2017-11-12 07:18:08', '', '131-0883'),
(169, 'Pending', 'Pending', '2017-11-12 07:19:36', '2017-11-12 07:19:36', '', '151-1007'),
(170, 'Pending', 'Pending', '2017-11-12 07:21:12', '2017-11-12 07:21:12', '', '151-1248'),
(171, 'Pending', 'Pending', '2017-11-12 07:22:31', '2017-11-12 07:22:31', '', '141-0809'),
(172, 'Pending', 'Pending', '2017-11-12 07:35:55', '2017-11-12 07:35:55', '', '161-0253'),
(173, 'Pending', 'Pending', '2017-11-12 07:38:14', '2017-11-12 07:38:14', '', '151-1077'),
(174, 'Pending', 'Pending', '2017-11-12 07:40:00', '2017-11-12 07:40:00', '', '151-0221'),
(175, 'Pending', 'Pending', '2017-11-12 07:42:07', '2017-11-12 07:42:07', '', '151-0495'),
(176, 'Pending', 'Pending', '2017-11-12 07:43:42', '2017-11-12 07:43:42', '', '171-0121'),
(177, 'Pending', 'Pending', '2017-11-12 07:48:19', '2017-11-12 07:48:19', '', '161-0076'),
(178, 'Pending', 'Pending', '2017-11-12 07:58:21', '2017-11-12 07:58:21', '', '151-1384'),
(179, 'Pending', 'Pending', '2017-11-12 08:00:20', '2017-11-12 08:00:20', '', '141-0256'),
(180, 'Ok', 'Pending', '2017-11-12 08:01:38', '2017-12-20 13:09:26', '', '151-0192'),
(181, 'Pending', 'Pending', '2017-11-12 08:03:40', '2017-11-12 08:03:40', '', '171-0167'),
(182, 'Pending', 'Pending', '2017-11-12 08:05:09', '2017-11-12 08:05:09', '', '141-1060'),
(183, 'Pending', 'Pending', '2017-11-12 08:07:17', '2017-11-12 08:07:17', '', '131-0097'),
(184, 'Pending', 'Pending', '2017-11-12 08:09:16', '2017-11-12 08:09:16', '', '141-0076'),
(185, 'Pending', 'Pending', '2017-11-12 08:10:31', '2017-11-12 08:10:31', '', '141-0181'),
(186, 'Pending', 'Pending', '2017-11-12 08:12:10', '2017-11-12 08:12:10', '', '141-0094'),
(187, 'Pending', 'Pending', '2017-11-12 08:13:36', '2017-11-12 08:13:36', '', '131-0792'),
(188, 'Pending', 'Pending', '2017-11-12 08:15:39', '2017-11-12 08:15:39', '', '131-0301'),
(189, 'Pending', 'Pending', '2017-11-12 08:17:06', '2017-11-12 08:17:06', '', '131-0728'),
(190, 'Pending', 'Pending', '2017-11-12 08:18:29', '2017-11-12 08:18:29', '', '161-0020'),
(191, 'Pending', 'Pending', '2017-11-12 08:19:52', '2017-11-12 08:19:52', '', '131-0779'),
(192, 'Pending', 'Pending', '2017-11-12 08:21:24', '2017-11-12 08:21:24', '', '141-0623'),
(193, 'Pending', 'Pending', '2017-11-12 08:22:32', '2017-11-12 08:22:32', '', '111-0505'),
(194, 'Pending', 'Pending', '2017-11-12 08:23:52', '2017-11-12 08:23:52', '', '131-0454'),
(195, 'Ok', 'Pending', '2017-11-16 16:24:19', '2017-12-20 12:45:22', 'iambetheliz', '141-1102'),
(196, 'Ok', 'Ok', '2017-11-14 03:44:49', '2017-11-14 03:44:49', '', '151-0076'),
(197, 'Ok', 'Ok', '2017-11-14 03:46:40', '2017-11-14 03:46:40', '', '131-0414'),
(198, 'Pending', 'Ok', '2017-11-24 15:48:57', '2017-12-20 12:41:34', 'admin', '132-0001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diseases`
--

CREATE TABLE `tbl_diseases` (
  `Dis_ID` int(11) NOT NULL AUTO_INCREMENT,
  `diseases` varchar(30) NOT NULL,
  `category` varchar(20) NOT NULL,
  `identity` varchar(20) NOT NULL,
  `date_diag` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PatientID` int(11) NOT NULL,
  PRIMARY KEY (`Dis_ID`)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `ext_name` varchar(3) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'admin',
  `login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `first_name`, `middle_name`, `last_name`, `ext_name`, `userEmail`, `userPass`, `position`, `role`, `login_date`) VALUES
(1, 'admin', '', '', '', '', 'admin@gmail.com', '41e5653fc7aeb894026d6bb7b2db7f65902b454945fa8fd65a6327047b5277fb', 'Head Nurse', 'superadmin', '2017-12-22 07:10:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
