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
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `status`) VALUES
(1, 'CAST', 1),
(2, 'COED', 1),
(3, 'CEMA', 1),
(4, 'CHS', 1),
(5, 'COENG', 1),
(6, 'SHS', 1);

-- --------------------------------------------------------

--
-- Table structure for table 'events'
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `FacultyID` int(11) NOT NULL AUTO_INCREMENT,
  `facultyNo` varchar(8) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
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
  `weight` int(11) NOT NULL,
  `height` decimal(11,0) NOT NULL,
  `bmi` decimal(11,0) NOT NULL,
  `bp` varchar(3) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(3) NOT NULL,
  `xray` varchar(3) NOT NULL,
  `assess` varchar(3) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `facultyNo` varchar(8) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`MedID`,`FacultyID`),
  UNIQUE KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fmed_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_stats`
--

CREATE TABLE `faculty_stats` (
  `StatsID` int(11) NOT NULL AUTO_INCREMENT,
  `med` varchar(7) NOT NULL,
  `dent` varchar(7) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `facultyNo` varchar(8) NOT NULL,
  PRIMARY KEY (`StatsID`,`facultyNo`),
  UNIQUE KEY `facultyNo` (`facultyNo`),
  CONSTRAINT `fk_fstats_id` FOREIGN KEY (`facultyNo`) REFERENCES `faculties` (`facultyNo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active',
  PRIMARY KEY (`program_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_name`, `dept_id`, `status`) VALUES
(1, 'BS Information Technology', 1, 1),
(2, 'BS Computer Science', 1, 1),
(3, 'Bachelor in Arts and Communication', 1, 1),
(4, 'Bachelor in Elementary Education', 2, 1),
(5, 'Bachelor in Secondary Education', 2, 1),
(6, 'BS Accountancy', 3, 1),
(7, 'BS Accounting', 3, 1),
(8, 'BS Entrepreneurship', 3, 1),
(9, 'BS Tourism Management', 3, 1),
(10, 'Health Care Services', 4, 1),
(11, 'Midwifery', 4, 1),
(12, 'BS Mechanical Engineering', 5, 1),
(13, 'Grade 11', 6, 1),
(14, 'Grade 12', 6, 1);

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
  CONSTRAINT `fk_prog_id` FOREIGN KEY (`program`) REFERENCES `program` (`program_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_sdept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `studentNo`, `last_name`, `first_name`, `middle_name`, `ext`, `age`, `sex`, `dept`, `program`, `yearLevel`, `sem`, `acadYear`, `address`, `cperson`, `cphone`) VALUES
(1, '161-0142', 'abasola', 'Jonalyn', 'llames', '', 21, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(2, '161-0046', 'ajunan', 'era', 'duaman', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(3, '161-0183', 'arbis', 'pilipina', 'censon', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(4, '161-0096', 'ardonia', 'ryan', 'llarena', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(5, '162-0019', 'carandang', 'mary joys anne', 'delas alas', '', 20, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(6, '161-0136', 'comendador', 'ma allyssa nicole', 'ardez', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(7, '152-0054', 'diaz', 'joefico von', 'escamillas', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(8, '161-0051', 'garbo', 'jonsclark', 'barasi', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(9, '161-0081', 'juancalla', 'dyan anerie', 'abustan', '', 19, 'Female', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(10, '151-0204', 'limonares', 'jude zyron', 'coronado', '', 19, 'Male', 2, 4, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(11, '152-0002', 'aruelo', 'miguel jahson', 'monton', '', 20, 'Male', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(12, '151-0237', 'ambrocio', 'jennielle ann', 'francisco', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(13, '151-0166', 'anin', 'ronalyn', 'novicio', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(14, '151-0805', 'arguzon', 'antonette mae', 'zarzozo', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(15, '141-0769', 'arnigo', 'marjorie', 'suliguin', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(16, '151-0656', 'arriola', 'elaine rose', 'oguerra', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(17, '151-0179', 'bacanto', 'jessica', 'calleza', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(18, '151-0640', 'bandillo', 'honey grace', 'delos santos', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(19, '131-1228', 'barelos', 'arlene', 'bagayan', '', 20, 'Female', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(20, '151-0791', 'bautista', 'marlon', 'napiza', '', 20, 'Male', 2, 4, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(21, '161-0036', 'denum', 'lester', 'angeles', '', 18, 'Male', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(22, '161-0188', 'acabado', 'christine', 'borres', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(23, '161-0066', 'alcaide', 'danica', 'valdez', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(24, '161-0128', 'banca', 'richalyn', '', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(25, '161-0126', 'barcenas', 'mary jane', 'sibonga', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(26, '161-0079', 'cainday', 'sophia nicole', 'fresco', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(27, '161-0135', 'enfante', 'esperanza', 'brion', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(28, '161-0011', 'espiritu', 'adrian', 'chuanco', '', 18, 'Male', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(29, '171-0118', 'ferrer', 'jack', 'zafe', '', 18, 'Male', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(30, '161-0062', 'hernandez', 'nicole mae', 'pamanian', '', 18, 'Female', 3, 9, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(31, '151-1374', 'adrales', 'christian jude', 'guatno', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(32, '151-1364', 'almanza', 'ella mae', 'ramos', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(33, '151-0711', 'almanza', 'bezalel john', 'dacanay', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(34, '151-1435', 'apilado', 'gimevern', 'dineros', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(35, '151-0172', 'arandia', 'nely', 'lopez', '', 19, 'Female', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(36, '151-1417', 'arnejo', 'sabrina joyce ', 'bracamonte', '', 19, 'Female', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(37, '161-0124', 'belga', 'ronilo', 'boce', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(38, '151-1371', 'bortanog', 'marvie neil', 'dela cruz', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(39, '151-1469', 'cabreza', 'chrisman claudine', 'saguinsin', '', 19, 'Female', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(40, '162-0005', 'calaguan', 'joshua', '', '', 19, 'Male', 3, 9, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(41, '132-0001', 'Punzalan', 'Elizabeth', 'Elec', '', 24, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Pili St., Makiling Subd., Anos, Los Banos, Laguna                        ', 'Anabelle E. Punzalan', '0935 830 6457'),
(42, '131-0558', 'Marikit', 'Hans Roben', 'Zarate', '', 20, 'Male', 1, 1, '4th', '1st', '2017 - 2018', 'Calauan, Laguna', 'Nory Marikit', '0909 400 9342'),
(43, '131-0161', 'Compendio', 'Lea', 'Galimba', '', 25, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Liliw, Laguna', 'Julie G. Compendio', '0909 123 4567'),
(44, '131-0162', 'Plantilla', 'Shaira', 'Dorado', '', 23, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Nagcarlan, Laguna', 'Edna Plantilla', '0997 685 4455'),
(45, '171-0142', 'abejon', 'Rjay', 'tatac', '', 20, 'Male', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(46, '171-0040', 'arnoco', 'geraldine', 'morcilla', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(47, '171-0055', 'dalmaob', 'norhaina', 'sailila', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(48, '171-0032', 'de chavez', 'cyndie', 'quintero', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(49, '171-0047', 'de ramos', 'arcel christlyanne', 'soriano', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(50, '171-0015', 'diaz', 'jocelyn', 'parion', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(51, '171-0158', 'dinaya', 'manilyn', 'olais', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(52, '171-0124', 'edillor', 'marela marie', 'sangalang', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(53, '171-0227', 'endiza', 'liz nicole', 'luzena', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(54, '171-0182', 'espinola', 'mary grace', 'bacube', '', 20, 'Female', 2, 4, '1st', '1st', '2017 - 2018', '', '', 'none'),
(55, '151-0349', 'aquino', 'lorenzo', 'mercado', '', 20, 'Male', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(56, '151-1116', 'abe', 'raquel', 'de guzman', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(57, '151-0319', 'anuyo', 'aizza', 'ballesteros', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(58, '151-0953', 'aragon', 'jenelyn', 'sabucor', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(59, '151-0917', 'araneta', 'mary joy ', 'cada', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(60, '111-0350', 'bambano', 'riza', 'OÃ‘A', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(61, '151-1103', 'bautista', 'viviana', 'aquino', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(62, '151-0212', 'bello', 'dahlia', 'coronado', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(63, '151-0184', 'billones', 'charlotte', 'de mesa', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(64, '151-0611', 'binotapa', 'SHIELLA MARIZ', 'colarina', '', 20, 'Female', 2, 5, '3rd', '1st', '2017 - 2018', '', '', 'none'),
(65, '171-0170', 'apilado', 'marc daniel', 'sola', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(66, '162-0018', 'apilado', 'ma nicole', 'sola', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(67, '171-0162', 'castillo', 'regine ', 'perez', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(68, '171-0154', 'castro', 'DON ARDRIX', 'LARAÃ‘O', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(69, '171-0222', 'de guzman', 'mary claire', 'villacora', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(70, '141-1131', 'DELA PEÃ‘A', 'john ray', '', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(71, '141-0838', 'espino', 'kevin christian', 'gutierrez', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(72, '152-0083', 'formentera', 'jomer', 'danaire', '', 20, 'Male', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(73, '162-0003', 'francia', 'arlene', 'zaragga', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(74, '171-0161', 'fulo', 'marjorie', 'dela cruz', '', 20, 'Female', 3, 8, '1st', '1st', '2017 - 2018', '', '', 'none'),
(75, '161-0176', 'araneta', 'MARK JOHN', 'adornado', '', 20, 'Male', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(76, '161-0226', 'acabado', 'MAILYN', 'b', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(77, '161-0104', 'barlas', 'erica', 'pingol', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(78, '161-0149', 'bonifacio', 'nikki', 'magale', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(79, '161-0004', 'cano', 'sherilyn', 'mindoro', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(80, '161-0111', 'cansicio', 'jolina', 'taparo', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(81, '161-0150', 'coral', 'eric brian', 'francia', '', 20, 'Male', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(82, '161-0024', 'guba', 'patricia', 'soriano', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(83, '161-0235', 'guillermo', 'alona', 'doromal', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(84, '161-0287', 'hernandez', 'sarah suzette ', 'landicho', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(85, '161-0171', 'resurreccion', 'jade christian', 'octavio', '', 20, 'Male', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(86, '161-0005', 'araman', 'danica ', 'ortega', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(87, '161-0257', 'aurin', 'rona jane', 'lotino', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(88, '151-0700', 'belista', 'HYACINTH NAZARIA', 'ESTOMAGUIO', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(89, '161-0057', 'buban', 'mel rose', 'perez', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(90, '141-1114', 'david', 'JESSALYN DEL', 'rosario', '', 20, 'Female', 3, 7, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(91, '151-0455', 'abel', 'jomary', 'eres', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(92, '151-1315', 'adea', 'airon', 'francia', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(93, '171-0201', 'agustine', 'evangeline', '', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(94, '171-0110', 'alegre', 'roseanne joy', 'parafina', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(95, '171-0136', 'alegria', 'jojo', 'barros', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(96, '171-0009', 'alfonso', 'gail ronan', 'roxas', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(97, '152-0073', 'AÃ‘ONUEVO', 'genedel', 'corales', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(98, '171-0065', 'arellano', 'rigs albert', 'hernandez', '', 20, 'Male', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(99, '171-0144', 'atienza', ' AYRHA CASANDRA', 'CALASICAS', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(100, '151-1443', 'austria', 'rezzel', 'villanera', '', 20, 'Female', 1, 1, '1st', '1st', '2017 - 2018', '', '', 'none'),
(101, '131-0177', 'ang', 'kier baby', 'valeriano', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(102, '161-0065', 'arete', 'brandon', 'ubaldo', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(103, '141-0718', 'basilio', 'bryan', 'marquez', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(104, '151-1476', 'batocabe', 'jezel', 'romero', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(105, '141-0348', 'bitbit', 'bernadette', 'palabay', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(106, '141-0914', 'VILLOCILLO', 'EDDIELYN', 'VILLOCILLO', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(107, '151-0421', 'canoy', 'JOHN CARLO', 'isidro', '', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(108, '161-0296', 'dela rosa', 'GASPAR', 'albor', 'jr', 20, 'Male', 1, 2, '2nd', '1st', '2017 - 2018', '', '', 'none'),
(109, '151-0531', 'Dizon', 'Erica', 'Gamina', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '                                                                        ', '', 'none');

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
  `weight` int(11) NOT NULL,
  `height` varchar(5) NOT NULL,
  `bmi` varchar(5) NOT NULL,
  `bp` varchar(3) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `xray` varchar(3) NOT NULL,
  `assess` varchar(3) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `studentNo` varchar(8) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`MedID`,`StudentID`),
  UNIQUE KEY `StudentID` (`StudentID`),
  CONSTRAINT `fk_med_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_stats`
--

CREATE TABLE `students_stats` (
  `StatsID` int(11) NOT NULL AUTO_INCREMENT,
  `med` varchar(7) NOT NULL,
  `dent` varchar(7) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `studentNo` varchar(8) NOT NULL,
  PRIMARY KEY (`StatsID`,`studentNo`),
  UNIQUE KEY `studentNo` (`studentNo`),
  CONSTRAINT `fk_stats_id` FOREIGN KEY (`studentNo`) REFERENCES `students` (`studentNo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_stats`
--

INSERT INTO `students_stats` (`StatsID`, `med`, `dent`, `date_registered`, `date_updated`, `studentNo`) VALUES
(1, 'Pending', 'Pending', '2017-11-12 18:38:24', '2017-11-12 18:38:24', '161-0142'),
(2, 'Pending', 'Pending', '2017-11-12 18:39:18', '2017-11-12 18:39:18', '161-0046'),
(3, 'Pending', 'Pending', '2017-11-12 18:41:07', '2017-11-12 18:41:07', '161-0183'),
(4, 'Pending', 'Pending', '2017-11-12 18:41:49', '2017-11-12 18:41:49', '161-0096'),
(5, 'Pending', 'Pending', '2017-11-12 18:42:45', '2017-11-12 18:42:45', '162-0019'),
(6, 'Pending', 'Pending', '2017-11-12 18:44:13', '2017-11-12 18:44:13', '161-0136'),
(7, 'Pending', 'Pending', '2017-11-12 18:49:21', '2017-11-12 18:49:21', '152-0054'),
(8, 'Pending', 'Pending', '2017-11-12 18:50:35', '2017-11-12 18:50:35', '161-0051'),
(9, 'Pending', 'Pending', '2017-11-12 18:52:04', '2017-11-12 18:52:04', '161-0081'),
(10, 'Pending', 'Pending', '2017-11-12 18:52:52', '2017-11-12 18:52:52', '151-0204'),
(11, 'Pending', 'Pending', '2017-11-12 18:55:06', '2017-11-12 18:55:06', '152-0002'),
(12, 'Pending', 'Pending', '2017-11-12 18:55:52', '2017-11-12 18:55:52', '151-0237'),
(13, 'Pending', 'Pending', '2017-11-12 18:56:35', '2017-11-12 18:56:35', '151-0166'),
(14, 'Pending', 'Pending', '2017-11-12 18:58:14', '2017-11-12 18:58:14', '151-0805'),
(15, 'Pending', 'Pending', '2017-11-12 18:59:45', '2017-11-12 18:59:45', '141-0769'),
(16, 'Pending', 'Pending', '2017-11-12 19:01:31', '2017-11-12 19:01:31', '151-0656'),
(17, 'Pending', 'Pending', '2017-11-12 19:02:33', '2017-11-12 19:02:33', '151-0179'),
(18, 'Pending', 'Pending', '2017-11-12 19:03:37', '2017-11-12 19:03:37', '151-0640'),
(19, 'Pending', 'Pending', '2017-11-12 19:04:16', '2017-11-12 19:04:16', '131-1228'),
(20, 'Pending', 'Pending', '2017-11-12 19:04:46', '2017-11-12 19:04:46', '151-0791'),
(21, 'Pending', 'Pending', '2017-11-12 19:07:22', '2017-11-12 19:07:22', '161-0036'),
(22, 'Pending', 'Pending', '2017-11-12 19:08:35', '2017-11-12 19:08:35', '161-0188'),
(23, 'Pending', 'Pending', '2017-11-12 19:09:16', '2017-11-12 19:09:16', '161-0066'),
(24, 'Pending', 'Pending', '2017-11-12 19:09:53', '2017-11-12 19:09:53', '161-0128'),
(25, 'Pending', 'Pending', '2017-11-12 19:10:33', '2017-11-12 19:10:33', '161-0126'),
(26, 'Pending', 'Pending', '2017-11-12 19:11:31', '2017-11-12 19:11:31', '161-0079'),
(27, 'Pending', 'Pending', '2017-11-12 19:12:20', '2017-11-12 19:12:20', '161-0135'),
(28, 'Pending', 'Pending', '2017-11-12 19:12:56', '2017-11-12 19:12:56', '161-0011'),
(29, 'Pending', 'Pending', '2017-11-12 19:13:55', '2017-11-12 19:13:55', '171-0118'),
(30, 'Pending', 'Pending', '2017-11-12 19:14:47', '2017-11-12 19:14:47', '161-0062'),
(31, 'Pending', 'Pending', '2017-11-12 19:16:21', '2017-11-12 19:16:21', '151-1374'),
(32, 'Pending', 'Pending', '2017-11-12 19:17:46', '2017-11-12 19:17:46', '151-1364'),
(33, 'Pending', 'Pending', '2017-11-12 19:19:06', '2017-11-12 19:19:06', '151-0711'),
(34, 'Pending', 'Pending', '2017-11-12 19:19:50', '2017-11-12 19:19:50', '151-1435'),
(35, 'Pending', 'Pending', '2017-11-12 19:20:25', '2017-11-12 19:20:25', '151-0172'),
(36, 'Pending', 'Pending', '2017-11-12 19:21:25', '2017-11-12 19:21:25', '151-1417'),
(37, 'Pending', 'Pending', '2017-11-12 19:22:00', '2017-11-12 19:22:00', '161-0124'),
(38, 'Pending', 'Pending', '2017-11-12 19:22:48', '2017-11-12 19:22:48', '151-1371'),
(39, 'Pending', 'Pending', '2017-11-12 19:23:31', '2017-11-12 19:23:31', '151-1469'),
(40, 'Pending', 'Pending', '2017-11-12 19:24:30', '2017-11-12 19:24:30', '162-0005'),
(41, 'Pending', 'Pending', '2017-11-13 06:08:45', '2017-11-13 06:08:45', '132-0001'),
(42, 'Pending', 'Pending', '2017-11-13 17:52:44', '2017-11-13 17:52:44', '131-0558'),
(43, 'Pending', 'Pending', '2017-11-13 17:54:23', '2017-11-13 17:54:23', '131-0161'),
(44, 'Pending', 'Pending', '2017-11-13 17:57:28', '2017-11-13 17:57:28', '131-0162'),
(45, 'Pending', 'Pending', '2017-11-12 10:37:27', '2017-11-12 10:37:27', '171-0142'),
(46, 'Pending', 'Pending', '2017-11-12 10:38:48', '2017-11-12 10:38:48', '171-0040'),
(47, 'Pending', 'Pending', '2017-11-12 10:40:04', '2017-11-12 10:40:04', '171-0055'),
(48, 'Pending', 'Pending', '2017-11-12 10:48:03', '2017-11-12 10:48:03', '171-0032'),
(49, 'Pending', 'Pending', '2017-11-12 10:50:07', '2017-11-12 10:50:07', '171-0047'),
(50, 'Pending', 'Pending', '2017-11-12 10:51:24', '2017-11-12 10:51:24', '171-0015'),
(51, 'Pending', 'Pending', '2017-11-12 10:52:39', '2017-11-12 10:52:39', '171-0158'),
(52, 'Pending', 'Pending', '2017-11-12 10:54:15', '2017-11-12 10:54:15', '171-0124'),
(53, 'Pending', 'Pending', '2017-11-12 10:54:51', '2017-11-12 10:54:51', '171-0227'),
(54, 'Pending', 'Pending', '2017-11-12 10:55:33', '2017-11-12 10:55:33', '171-0182'),
(55, 'Pending', 'Pending', '2017-11-12 10:56:34', '2017-11-12 10:56:34', '151-0349'),
(56, 'Pending', 'Pending', '2017-11-12 10:57:09', '2017-11-12 10:57:09', '151-1116'),
(57, 'Pending', 'Pending', '2017-11-12 10:57:46', '2017-11-12 10:57:46', '151-0319'),
(58, 'Pending', 'Pending', '2017-11-12 10:58:31', '2017-11-12 10:58:31', '151-0953'),
(59, 'Pending', 'Pending', '2017-11-12 11:00:02', '2017-11-12 11:00:02', '151-0917'),
(60, 'Pending', 'Pending', '2017-11-12 11:01:52', '2017-11-12 11:01:52', '111-0350'),
(61, 'Pending', 'Pending', '2017-11-12 11:02:34', '2017-11-12 11:02:34', '151-1103'),
(62, 'Pending', 'Pending', '2017-11-12 11:03:06', '2017-11-12 11:03:06', '151-0212'),
(63, 'Pending', 'Pending', '2017-11-12 11:03:46', '2017-11-12 11:03:46', '151-0184'),
(64, 'Pending', 'Pending', '2017-11-12 11:04:45', '2017-11-12 11:04:45', '151-0611'),
(65, 'Pending', 'Pending', '2017-11-12 11:16:04', '2017-11-12 11:16:04', '171-0170'),
(66, 'Pending', 'Pending', '2017-11-12 11:18:39', '2017-11-12 11:18:39', '162-0018'),
(67, 'Pending', 'Pending', '2017-11-12 11:19:13', '2017-11-12 11:19:13', '171-0162'),
(68, 'Pending', 'Pending', '2017-11-12 11:19:56', '2017-11-12 11:19:56', '171-0154'),
(69, 'Pending', 'Pending', '2017-11-12 11:20:50', '2017-11-12 11:20:50', '171-0222'),
(70, 'Pending', 'Pending', '2017-11-12 11:22:31', '2017-11-12 11:22:31', '141-1131'),
(71, 'Pending', 'Pending', '2017-11-12 11:23:28', '2017-11-12 11:23:28', '141-0838'),
(72, 'Pending', 'Pending', '2017-11-12 11:24:04', '2017-11-12 11:24:04', '152-0083'),
(73, 'Pending', 'Pending', '2017-11-12 15:32:09', '2017-11-12 15:32:09', '162-0003'),
(74, 'Pending', 'Pending', '2017-11-12 15:32:45', '2017-11-12 15:32:45', '171-0161'),
(75, 'Pending', 'Pending', '2017-11-12 15:36:02', '2017-11-12 15:36:02', '161-0176'),
(76, 'Pending', 'Pending', '2017-11-12 15:37:47', '2017-11-12 15:37:47', '161-0226'),
(77, 'Pending', 'Pending', '2017-11-12 15:38:55', '2017-11-12 15:38:55', '161-0104'),
(78, 'Pending', 'Pending', '2017-11-12 15:39:42', '2017-11-12 15:39:42', '161-0149'),
(79, 'Pending', 'Pending', '2017-11-12 15:40:38', '2017-11-12 15:40:38', '161-0004'),
(80, 'Pending', 'Pending', '2017-11-12 15:41:35', '2017-11-12 15:41:35', '161-0111'),
(81, 'Pending', 'Pending', '2017-11-12 15:42:36', '2017-11-12 15:42:36', '161-0150'),
(82, 'Pending', 'Pending', '2017-11-12 15:43:28', '2017-11-12 15:43:28', '161-0024'),
(83, 'Pending', 'Pending', '2017-11-12 15:44:15', '2017-11-12 15:44:15', '161-0235'),
(84, 'Pending', 'Pending', '2017-11-12 15:45:08', '2017-11-12 15:45:08', '161-0287'),
(85, 'Pending', 'Pending', '2017-11-12 15:47:08', '2017-11-12 15:47:08', '161-0171'),
(86, 'Pending', 'Pending', '2017-11-12 15:53:46', '2017-11-12 15:53:46', '161-0005'),
(87, 'Pending', 'Pending', '2017-11-12 15:54:30', '2017-11-12 15:54:30', '161-0257'),
(88, 'Pending', 'Pending', '2017-11-12 15:55:36', '2017-11-12 15:55:36', '151-0700'),
(89, 'Pending', 'Pending', '2017-11-12 15:56:11', '2017-11-12 15:56:11', '161-0057'),
(90, 'Pending', 'Pending', '2017-11-12 15:57:01', '2017-11-12 15:57:01', '141-1114'),
(91, 'Pending', 'Pending', '2017-11-12 16:02:40', '2017-11-12 16:02:40', '151-0455'),
(92, 'Pending', 'Pending', '2017-11-12 16:03:20', '2017-11-12 16:03:20', '151-1315'),
(93, 'Pending', 'Pending', '2017-11-12 16:03:58', '2017-11-12 16:03:58', '171-0201'),
(94, 'Pending', 'Pending', '2017-11-12 16:04:39', '2017-11-12 16:04:39', '171-0110'),
(95, 'Pending', 'Pending', '2017-11-12 16:05:23', '2017-11-12 16:05:23', '171-0136'),
(96, 'Pending', 'Pending', '2017-11-12 16:06:16', '2017-11-12 16:06:16', '171-0009'),
(97, 'Pending', 'Pending', '2017-11-12 16:07:05', '2017-11-12 16:07:05', '152-0073'),
(98, 'Pending', 'Pending', '2017-11-12 16:07:56', '2017-11-12 16:07:56', '171-0065'),
(99, 'Pending', 'Pending', '2017-11-12 16:08:49', '2017-11-12 16:08:49', '171-0144'),
(100, 'Pending', 'Pending', '2017-11-12 16:09:34', '2017-11-12 16:09:34', '151-1443'),
(101, 'Pending', 'Pending', '2017-11-12 16:11:52', '2017-11-12 16:11:52', '131-0177'),
(102, 'Pending', 'Pending', '2017-11-12 16:12:57', '2017-11-12 16:12:57', '161-0065'),
(103, 'Pending', 'Pending', '2017-11-12 16:13:43', '2017-11-12 16:13:43', '141-0718'),
(104, 'Pending', 'Pending', '2017-11-12 16:14:37', '2017-11-12 16:14:37', '151-1476'),
(105, 'Pending', 'Pending', '2017-11-12 16:15:11', '2017-11-12 16:15:11', '141-0348'),
(106, 'Pending', 'Pending', '2017-11-12 16:18:29', '2017-11-12 16:18:29', '141-0914'),
(107, 'Pending', 'Pending', '2017-11-12 16:19:20', '2017-11-12 16:19:20', '151-0421'),
(108, 'Pending', 'Pending', '2017-11-12 16:20:13', '2017-11-12 16:20:13', '161-0296'),
(109, 'Pending', 'Pending', '2017-11-12 16:20:46', '2017-11-12 16:20:46', '151-0531');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`) VALUES
(1, 'admin', 'admin@gmail.com', '41e5653fc7aeb894026d6bb7b2db7f65902b454945fa8fd65a6327047b5277fb');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
