-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2017 at 04:27 AM
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
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active'
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `FacultyID` int(11) NOT NULL,
  `facultyNo` varchar(9) NOT NULL,
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
  `cphone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_med`
--

CREATE TABLE `faculty_med` (
  `MedID` int(11) NOT NULL,
  `sysRev` varchar(500) NOT NULL,
  `medHis` varchar(500) NOT NULL,
  `drinker` varchar(3) NOT NULL,
  `smoker` varchar(3) NOT NULL,
  `drug_user` varchar(3) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` decimal(11,0) NOT NULL,
  `bmi` decimal(11,0) NOT NULL,
  `bp` varchar(3) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `t` varchar(3) NOT NULL,
  `xray` varchar(3) NOT NULL,
  `assess` varchar(3) NOT NULL,
  `plan` varchar(3) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `facultyNo` varchar(8) NOT NULL,
  `FacultyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_stats`
--

CREATE TABLE `faculty_stats` (
  `StatsID` int(11) NOT NULL,
  `med` varchar(7) NOT NULL,
  `dent` varchar(7) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `facultyNo` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active'
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
  `StudentID` int(11) NOT NULL,
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
  `cphone` varchar(15) NOT NULL
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
(42, '131-0558', 'Marikit', 'Hans Roben', 'Zarate', '', 20, 'Male', 1, 1, '4th', '1st', '2017 - 2018', 'Calauan, Laguna', 'Nory Marikit', '0909 400 9342'),
(43, '131-0161', 'Compendio', 'Lea', 'Galimba', '', 25, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Liliw, Laguna', 'Julie G. Compendio', '0909 123 4567'),
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
(78, '161-0149', 'Bonifacio', 'Nikki', 'Magale', '', 20, 'Female', 1, 6, '2nd', '1st', '2017 - 2018', '                        ', '', 'none'),
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
(109, '151-0531', 'Dizon', 'Erica', 'Gamina', '', 20, 'Female', 1, 2, '2nd', '1st', '2017 - 2018', '                                                                        ', '', 'none'),
(110, '171-0074', 'Granada', 'Joana Lyn', 'Dasigao', '', 19, 'Female', 2, 4, '1st', '', '2017 - 2018', 'Los Banos, Laguna', 'Martin Granada', '0999 568 4599'),
(111, '151-0300', 'Armia', 'Jacklyn ', 'Delgado', '', 20, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Pila Laguna', 'Marissa Armia', '0936 958 7848'),
(112, '131-0279', 'Bataller', 'Kathlene Grace', 'Isaac', '', 21, 'Female', 2, 5, '4th', '', '2017 - 2018', 'Bubukal Sta.Cruz Laguna', 'Peter Bataller', '0916 897 7485'),
(113, '131-0092', 'Reyes', 'Rose Angela', 'Kamatoy', '', 20, 'Female', 2, 4, '2nd', '', '2017 - 2018', 'Los Banos Laguna', 'Ophelia Reyes', '0916 479 9580'),
(114, '141-1048', 'Cahilig', 'Joshua', 'Espino', '', 20, 'Male', 2, 4, '3rd', '', '2017 - 2018', 'Lumban Laguna', 'Le Cahilig', '0916 689 5578'),
(115, '111-0118', 'Cabillan', 'Jefredel', 'Tina', '', 24, 'Male', 2, 4, '3rd', '', '2017 - 2018', 'Barangay Calumpang Nagcarlan Laguna', 'Joseph Cabillan', '0999 784 5911'),
(116, '161-0131', 'Macatangay', 'Luke Erick John', 'Reyes', '', 19, 'Male', 2, 4, '2nd', '', '2017 - 2018', 'Los Banos, Laguna', 'Demetrio Macatangay', '0918 954 8678'),
(117, '162-0038', 'Oca', 'Jurice Reineal', 'Zotomayor', '', 18, 'Male', 2, 4, '2nd', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Candido Oca', '0949 765 4854'),
(118, '141-1116', 'Vegas', 'Glorie', 'Nadres', '', 19, 'Female', 2, 4, '4th', '', '2017 - 2018', 'Pagsanjan Laguna', 'Willie Vegas', '0935 169 8468'),
(119, '141-0303', 'Francisco', 'Jayve', 'Malbas', '', 19, 'Male', 2, 4, '4th', '', '2017 - 2018', 'Calauan Laguna', 'Louie Francisco', '0935 615 4911'),
(120, '151-1333', 'Bueno', 'Danica', 'Calso', '', 19, 'Female', 2, 5, '3rd', '', '2017 - 2018', 'Nagcarlan Laguna', 'Melvin Bueno', '0915 987 6849'),
(121, '141-0929', 'Saber', 'Johndro', 'Nueva', '', 23, 'Male', 2, 5, '4th', '', '2017 - 2018', 'Liliw Laguna', 'Peter Saber', '0916 485 6795'),
(123, '141-0818', 'Punzalan', 'Jenny Rose', 'Gallianira', '', 21, 'Female', 2, 5, '4th', '', '2017 - 2018', 'Bubukal Sta.Cruz Laguna', 'Beth Punzalan', '0916 848 7791'),
(124, '101-0085', 'Betorio', 'Jessieca', 'Baya', '', 25, 'Female', 2, 5, '4th', '', '2017 - 2018', 'Nagcarlan Laguna', 'Lea Betorio', '0916 487 9210'),
(125, '151-1268', 'Buale', 'Charles', 'Layhing', '', 19, 'Male', 2, 5, '3rd', '', '2017 - 2018', 'Liliw Laguna', 'Mark Buale', '0935 487 9510'),
(127, '151-1129', 'Escobel', 'Rheyniel', 'Angeles', '', 22, 'Male', 2, 5, '3rd', '', '2017 - 2018', 'Majayjay Laguna', 'Lea Escobel', '0948 759 4987'),
(128, '151-1366', 'Rementilla', 'Jimuel ', 'Gicalde', '', 21, 'Male', 2, 5, '3rd', '', '2017 - 2018', 'Barangay San Juan Laguna ', 'Pia Rementilla', '0915 798 4587'),
(129, '151-0173', 'Susano', 'Eunice', 'Espedilla', '', 20, 'Female', 2, 5, '3rd', '', '2017 - 2018', 'Bay Laguna', 'Mark Susano', '0916 845 7955'),
(130, '141-0700', 'Visperas', 'Gerami', 'Santilles', '', 21, 'Male', 2, 5, '4th', '', '2017 - 2018', 'Sta.Cruz, Laguna', 'Paul Visperas', '0936 497 5840'),
(131, '151-0453', 'Absalon', 'Albert', 'Grajo', '', 20, 'Male', 3, 8, '3rd', '', '2017 - 2018', 'Pila Laguna', 'Loreto Absalon', '0919 487 9511'),
(132, '152-0084', 'Anil', 'Shulamite', 'Gutierrez', '', 22, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Barangay Pagsawitan Sta.Cruz, Laguna', 'Jeremy Anil', '0916 577 8469'),
(133, '122-0019', 'Articona', 'Marcia Jane', 'Cordez', '', 24, 'Female', 3, 8, '4th', '', '2017 - 2018', 'Barangay Labuin Sta. Cruz Laguna', 'Mark Articona ', '0912 457 9860'),
(135, '162-0046', 'Lastimosa', 'Cyril ', 'Fang', '', 20, 'Male', 3, 8, '1st', '', '2017 - 2018', 'Barangay San Juan Sta. Cruz, Laguna', 'Jenny Lastimosa', '0915 487 9500'),
(136, '162-0047', 'San Sebastian', 'Elson', 'Esplana', '', 19, 'Male', 3, 8, '1st', '', '2017 - 2018', 'Lumban Laguna', 'Mary San Sebastian', '0916 958 7000'),
(137, '161-0184', 'Mercado', 'Prescious Ann', 'De Rama', '', 19, 'Female', 3, 8, '2nd', '', '2017 - 2018', 'Magdalena, Laguna', 'Jennilyn Mercado', '0949 870 0154'),
(138, '161-0123', 'Capinig', 'Jedidia', 'Villar', '', 20, 'Male', 3, 8, '2nd', '', '2017 - 2018', 'Siniloan Laguna', 'Vicky Capinig', '0915 487 0015'),
(139, '152-0010', 'De Luna', 'Joana Rose', 'Velez', '', 20, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Pila, Laguna', 'Weng De Luna', '0946 795 1000'),
(140, '111-0172', 'Samotia', 'Joyce Ann', 'Realubit', '', 25, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Barangay Malinao Sta.Cruz, Laguna', 'Mercedes Samotia', '0915 470 0256'),
(141, '151-0874', 'Patambang', 'Mica Daniela ', 'Barrozo', '', 20, 'Female', 3, 8, '3rd', '', '2017 - 2018', 'Kalayaan Laguna', 'Sylvia Patambang', '0916 548 7600'),
(144, '151-0114', 'Ortiz', 'Jeschelle', 'Concejero', '', 20, 'Female', 3, 9, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Grace Ortiz', '0916 497 0158'),
(145, '161-0139', 'Serino', 'Joy Clarisse', 'Cabanatan', '', 19, 'Female', 3, 9, '2nd', '', '2017 - 2018', 'Liliw, Laguna', 'Sally Serino', '0915 684 7900'),
(147, '161-0029', 'Vendiola', 'Mark Teddy', 'Cornel', '', 18, 'Male', 3, 9, '2nd', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Jessy Vendiola', '0936 549 0015'),
(148, '161-0026', 'Villarta', 'Maria Lourdes ', 'Obnamia', '', 19, 'Female', 3, 6, '2nd', '', '2017 - 2018', 'Los Banos, Laguna', 'Janelle Villarta', '0936 480 1250'),
(149, '171-0131', 'Odtuhan', 'Mary Rose', 'Mendoza', '', 19, 'Female', 3, 6, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Pia Odtuhan', '0936 457 0152'),
(152, '131-0271', 'Basco', 'Jolina Marie ', 'Quilloy', '', 19, 'Female', 1, 1, '1st', '', '2017 - 2018', 'Pila, Laguna', 'Joseph Basco', '0915 687 4561'),
(153, '151-1288', 'Caballar', 'Roxanne', 'Valenzuela', '', 21, 'Female', 3, 6, '3rd', '', '2017 - 2018', 'Victoria, Laguna', 'Josy Caballar', '0915 365 7871'),
(155, '131-1096', 'Malabayabas', 'Alpha Jel', 'Lopez', '', 20, 'Male', 1, 2, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Jenny Malabayabas', '0936 540 1250'),
(156, '151-0284', 'Avenido', 'Leody', 'Alog', 'Jr', 19, 'Leody', 1, 3, '2nd', '', '2017 - 2018', 'Victoria, Laguna', 'Paul Avenido', '0919 685 0125'),
(157, '151-0304', 'Arizapa', 'Jomari', 'Burgos', '', 18, 'Male', 5, 12, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Irene Arizapa', '0916 501 5203'),
(158, '171-0147', 'Espinoza', 'Faulyn Antonette', 'Elona', '', 17, 'Female', 4, 10, '1st', '', '2017 - 2018', 'Barangay Bagumbayan Sta.Cruz, Laguna', 'Christine Espinoza', '0919 458 0546'),
(159, '141-0628', 'Aranillo', 'Leovien', 'Coronado', '', 20, 'Male', 1, 1, '4th', '', '2017 - 2018', 'Barangay Malinao Nagcarlan, Laguna', 'Lina Aranillo', '0975 849 5012'),
(160, '131-0071', 'Delmundo', 'Mikka Grace', 'Mercado', '', 20, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Lumban, Laguna', 'Maria Delmundo', '0915 869 0125'),
(161, '131-0458', 'Sorizo', 'Angelique', 'Caballes', '', 20, 'Female', 1, 1, '4th', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Josephine Sorizo', '0916 963 6520'),
(162, '131-0950', 'Tranilla', 'Lindon Marconi', 'Bercasio', '', 23, 'Male', 1, 1, '4th', '', '2017 - 2018', 'Sta.Cruz, Laguna', 'Liza Tranilla', '0916 545 0120'),
(163, '131-0685', 'Castro', 'Nico', 'Garon', '', 22, 'Male', 1, 1, '4th', '', '2017 - 2018', 'Pila, Laguna', 'Melissa Castro', '0916 958 0120'),
(164, '151-0143', 'Bueno', 'Melvin', 'Pullan', '', 19, 'Male', 1, 1, '3rd', '', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna', 'Miriam Bueno', '0916 584 0120'),
(165, '141-0314', 'Ansay', 'Judelyn', 'Lipit', '', 19, 'Female', 1, 2, '3rd', '', '2017 - 2018', 'Bay, Laguna', 'Wendy Ansay', '0919 458 6950'),
(166, '151-0738', 'Talabis', 'Jecell', 'Sarsaba', '', 18, 'Female', 1, 2, '2nd', '', '2017 - 2018', 'Barangay Calios Sta.Cruz, Laguna', 'Jeffrey Talabis', '0999 684 8502'),
(167, '141-1199', 'Borbe', 'Lovely Joy', 'Molina', '', 19, 'Female', 1, 3, '2nd', '', '2017 - 2018', 'Barangay Pagsawitan Sta.Cruz, Laguna', 'Allan Borbe', '0916 985 0225'),
(168, '141-0420', 'Berwega', 'Christhel Joy', 'Mantes', '', 20, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Calauan Laguna', 'Dory Berwega', '0999 854 0021'),
(169, '141-0694', 'Villamayor', 'Johnson', 'Delgado', '', 20, 'Male', 5, 12, '4th', '', '2017 - 2018', 'Lumban Laguna', 'John Villamayor', '0916 595 0120'),
(170, '162-0051', 'Abina', 'Lorenz Joy', 'Cahindo', '', 19, 'Female', 4, 11, '1st', '', '2017 - 2018', 'Victoria, Laguna', 'Goring Abina', '0915 696 0129'),
(171, '171-0013', 'Reyes', 'Maria Cecilia', 'Delgado', '', 18, 'Female', 4, 11, '1st', '', '2017 - 2018', 'Los Banos, Laguna', 'Raquel Reyes', '0919 650 3626'),
(172, '151-0774', 'Sta Maria', 'Elaine', 'Corpuz', '', 19, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Victoria, Laguna', 'Catherine Sta Maria', '0916 549 5025'),
(173, '151-1214', 'Ortiaga', 'Meriel', 'Suazo', '', 19, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Pauleen Ortiaga', '0915 693 6100'),
(174, '141-0675', 'Comendador', 'Alvenzon', 'Cartina', '', 17, 'Male', 1, 1, '2nd', '', '2017 - 2018', 'Pagsanjan, Laguna', 'Teody Comendador', '0919 458 6950'),
(175, '141-0875', 'Urbano', 'Daisy', 'Del Puerto', '', 19, 'Female', 1, 3, '3rd', '', '2017 - 2018', 'Pila, Laguna', 'Luis Urbano', '0935 695 0145'),
(176, '141-1010', 'Lualhati', 'Dhustine', 'Monreal', '', 19, 'Female', 1, 3, '4th', '', '2017 - 2018', 'Los Banos, Laguna', 'Glory Lualhati', '0935 964 1015'),
(177, '151-1388', 'De Luna', 'Jennalyn', 'Rafael', '', 19, 'Female', 1, 1, '3rd', '1st', '2017 - 2018', 'Pila, Laguna                        ', 'Bernie De Luna', '0935 497 8598'),
(178, '151-0213', 'Coronado', 'Reinalyn', 'Bringuela', '', 19, 'Female', 1, 1, '3rd', '', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna', 'Melissa Coronado', '0916 598 5699'),
(179, '131-0883', 'Santianez', 'Policarpo', 'Arnejo', 'Jr', 21, 'Male', 1, 1, '3rd', '', '2017 - 2018', 'Barangay Calumpang Nagcarlan, Laguna', 'Francisco Santianez', '0915 969 5679'),
(180, '151-1007', 'Navarro', 'Honey Grace', 'Mercado', '', 9, 'Female', 1, 3, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Jeremy Navarro', '0919 698 6366'),
(181, '151-1248', 'Tope', 'Ian', 'Coronado', '', 19, 'Male', 1, 3, '3rd', '', '2017 - 2018', 'Lumban, Laguna', 'Paul Tope', '0919 643 6652'),
(182, '141-0809', 'Vidal', 'Judy Anne', 'Balmes', '', 19, 'Female', 1, 3, '3rd', '', '2017 - 2018', 'Bay, Laguna', 'Mario Vidal', '0916 596 8799'),
(183, '161-0253', 'Lilia', 'Abegail', 'Samonte', '', 18, 'Female', 4, 11, '2nd', '', '2017 - 2018', 'Victoria, Laguna', 'Mike Lilia', '0915 636 5455'),
(184, '151-1077', 'Muyco', 'Wilfredo', 'Tarroza', 'Jr', 18, 'Male', 3, 9, '2nd', '', '2017 - 2018', 'Liliw, Laguna', 'Lea Muyco', '0916 598 6999'),
(185, '151-0221', 'Torres', 'Milca', 'Espiritu', '', 18, '', 3, 9, '3rd', '', '2017 - 2018', 'Barangay Calios Sta.Cruz, Laguna', 'Michael Torres', '0916 589 7966'),
(186, '151-0495', 'Montejo', 'Joel', 'Paed', '', 18, '', 5, 12, '2nd', '', '2017 - 2018', 'Calauan, Laguna', 'Teresa Montejo', '0916 597 8777'),
(187, '171-0121', 'Nagal', 'Arvin', 'De Leon', '', 17, '', 5, 12, '1st', '', '2017 - 2018', 'Bay, Laguna', 'Artemio Nagal', '0999 643 6665'),
(189, '161-0076', 'Santiago', 'Shela Mae', 'Tuazon', '', 17, '', 4, 10, '2nd', '', '2017 - 2018', 'Pila, Laguna', 'Raymond Santiago', '0925 968 6954'),
(190, '151-1384', 'Eliseo', 'Sherwin', 'Coronado', '', 18, '', 4, 10, '2nd', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Comelyn Eliseo', '0915 996 8694'),
(191, '141-0256', 'Ocot', 'Nikka Mae', 'Malabana', '', 19, '', 1, 2, '2nd', '', '2017 - 2018', 'Dayap Calauan, Laguna', 'Liza Ocot', '0916 986 9745'),
(192, '151-0192', 'Romero', 'Shaira Anne ', 'Del Poso', '', 18, '', 1, 2, '3rd', '', '2017 - 2018', 'Los Banos, Laguna', 'Michelle Romero', '0917 986 8451'),
(193, '171-0167', 'Metin', 'Amir', 'Argente', '', 16, '', 5, 12, '1st', '', '2017 - 2018', 'Barangay Calios Sta.Cruz, Laguna', 'Coney Metin', '0905 698 6479'),
(194, '141-1060', 'Bangay', 'Jan Myloc', 'Evalobo', '', 19, '', 1, 1, '3rd', '', '2017 - 2018', 'Pila, Laguna', 'Grace Bangay', '0927 984 6986'),
(195, '131-0097', 'Leongson', 'Rio Joie', 'Limongco', '', 20, '', 1, 1, '4th', '', '2017 - 2018', 'Sta.Cruz, Laguna', 'Jackelyn Leongson', '0925 968 7741'),
(196, '141-0076', 'Javier', 'Jan Ivy', 'Bonifacio', '', 21, '', 1, 1, '4th', '', '2017 - 2018', 'Barangay Pagsawitan Sta.Cruz, Laguna', 'Anne Javier', '0936 549 7888'),
(197, '141-0181', 'Recodig', 'Jocelyn', 'Dorado', '', 20, '', 1, 1, '4th', '', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna', 'Oscar Recodig', '0975 988 9874'),
(198, '141-0094', 'Villeta', 'Redelyn', 'Alvendia', '', 19, '', 1, 1, '4th', '', '2017 - 2018', 'Magdalena, Laguna', 'Henry Villeta', '0915 699 8746'),
(199, '131-0792', 'Valencia', 'Dervin John', 'Jarabata', '', 20, 'Male', 1, 1, '4th', '1st', '2017 - 2018', 'Bay, Laguna                        ', 'Victoria Valencia', '0936 597 8485'),
(200, '131-0301', 'Pedimonte', 'Joseph ', 'Endaya', '', 21, '', 1, 2, '4th', '', '2017 - 2018', 'Victoria, Laguna', 'Leon Pedimonte', '0946 598 8896'),
(201, '131-0728', 'De Castro', 'Julius Lemuel', 'Areta', '', 21, '', 5, 12, '2nd', '', '2017 - 2018', 'Bay, Laguna', 'Waldo De Castro', '0999 458 7965'),
(202, '161-0020', 'Bagayan', 'Aida', 'Quintero', '', 22, '', 4, 11, '2nd', '', '2017 - 2018', 'Liliw, Laguna', 'Charice Bagayan', '0917 998 6954'),
(203, '131-0779', 'Mandigma', 'Marinela', 'Bautista', '', 21, '', 1, 3, '4th', '', '2017 - 2018', 'Nagcarlan, Laguna', 'Meriam Mandigma', '0916 597 7899'),
(204, '141-0623', 'Dadley', 'Marjorie', 'Toong', '', 20, '', 1, 3, '4th', '', '2017 - 2018', 'Barangay Oogong Sta.Cruz, Laguna', 'Kate Dadley', '0905 956 4986'),
(205, '111-0505', 'Betorio', 'Jacqueline', 'Baya', '', 23, '', 1, 3, '4th', '', '2017 - 2018', 'Pila, Laguna', 'Martin Betorio', 'none'),
(206, '131-0454', 'Sabangan', 'Bebot', 'Rodrigo', 'Jr', 21, 'Male', 1, 3, '4th', '1st', '2017 - 2018', 'Los Banos, Laguna                        ', 'Pedro Sabangan', '0935 978 4955'),
(207, '141-1102', 'Seda', 'Mestica', 'Casino', '', 20, 'Female', 1, 3, '4th', '1st', '2017 - 2018', 'Lumban, Laguna                        ', 'Wendy Seda', '0917 447 8455'),
(208, '151-0076', 'Plantilla', 'Rejoyce', 'Lagubana', '', 18, 'Female', 1, 1, '3rd', '1st', '2017 - 2018', 'Barangay Silangan Lazaan Nagcarlan Laguna                        ', 'Josy Plantilla', '0916 986 9985'),
(209, '131-0414', 'Plantilla', 'Shaira', 'Dorado', '', 20, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Barangay Silangan, Lazaan, Nagcarlan, Laguna                                                        ', 'Pedro C. Plantilla', '0935 535 5030'),
(215, '132-0001', 'Punzalan', 'Elizabeth', 'Elec', '', 24, 'Female', 1, 1, '4th', '1st', '2017 - 2018', 'Pili St., Makiling Subd., Anos, Los Banos, Laguna', 'Anabelle E. Punzalan', '0935 830 6457');

-- --------------------------------------------------------

--
-- Table structure for table `students_med`
--

CREATE TABLE `students_med` (
  `MedID` int(11) NOT NULL,
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
  `plan` text NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `studentNo` varchar(8) NOT NULL,
  `StudentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_med`
--

INSERT INTO `students_med` (`MedID`, `sysRev`, `medHis`, `drinker`, `smoker`, `drug_user`, `mens`, `duration`, `weight`, `height`, `bmi`, `bp`, `cr`, `rr`, `temp`, `xray`, `assess`, `plan`, `date_checked_up`, `studentNo`, `StudentID`) VALUES
(1, 'Recurrent Headache, Cough and colds, Fever, Tonsilitis', 'Blood Infection', 'No', 'No', 'No', 'Regular', '3-5 Days', 65, '1.51', '28.50', '', '', '', '', '', 'fit', 'Student Must Be Sent Home.', '2017-11-24 17:38:05', '132-0001', 215);

-- --------------------------------------------------------

--
-- Table structure for table `students_stats`
--

CREATE TABLE `students_stats` (
  `StatsID` int(11) NOT NULL,
  `med` varchar(7) NOT NULL,
  `dent` varchar(7) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `studentNo` varchar(8) NOT NULL
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
(42, 'Pending', 'Pending', '2017-11-13 17:52:44', '2017-11-13 17:52:44', '131-0558'),
(43, 'Pending', 'Pending', '2017-11-13 17:54:23', '2017-11-13 17:54:23', '131-0161'),
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
(109, 'Pending', 'Pending', '2017-11-12 16:20:46', '2017-11-12 16:20:46', '151-0531'),
(110, 'Pending', 'Pending', '2017-11-12 04:06:34', '2017-11-12 04:06:34', '171-0074'),
(111, 'Pending', 'Pending', '2017-11-12 04:08:45', '2017-11-12 04:08:45', '151-0300'),
(112, 'Pending', 'Pending', '2017-11-12 04:10:31', '2017-11-12 04:10:31', '131-0279'),
(113, 'Pending', 'Pending', '2017-11-12 04:13:07', '2017-11-12 04:13:07', '131-0092'),
(114, 'Pending', 'Pending', '2017-11-12 04:14:31', '2017-11-12 04:14:31', '141-1048'),
(115, 'Pending', 'Pending', '2017-11-12 04:31:24', '2017-11-12 04:31:24', '111-0118'),
(116, 'Pending', 'Pending', '2017-11-12 04:33:49', '2017-11-12 04:33:49', '161-0131'),
(117, 'Pending', 'Pending', '2017-11-12 04:37:18', '2017-11-12 04:37:18', '162-0038'),
(118, 'Pending', 'Pending', '2017-11-12 04:40:24', '2017-11-12 04:40:24', '141-1116'),
(119, 'Pending', 'Pending', '2017-11-12 04:42:16', '2017-11-12 04:42:16', '141-0303'),
(120, 'Pending', 'Pending', '2017-11-12 04:43:51', '2017-11-12 04:43:51', '151-1333'),
(121, 'Pending', 'Pending', '2017-11-12 05:03:53', '2017-11-12 05:03:53', '141-0929'),
(123, 'Pending', 'Pending', '2017-11-12 04:46:08', '2017-11-12 04:46:08', '141-0818'),
(124, 'Pending', 'Pending', '2017-11-12 04:49:01', '2017-11-12 04:49:01', '101-0085'),
(125, 'Pending', 'Pending', '2017-11-12 04:50:19', '2017-11-12 04:50:19', '151-1268'),
(127, 'Pending', 'Pending', '2017-11-12 04:53:08', '2017-11-12 04:53:08', '151-1129'),
(128, 'Pending', 'Pending', '2017-11-12 04:55:29', '2017-11-12 04:55:29', '151-1366'),
(129, 'Pending', 'Pending', '2017-11-12 04:58:21', '2017-11-12 04:58:21', '151-0173'),
(130, 'Pending', 'Pending', '2017-11-12 05:00:49', '2017-11-12 05:00:49', '141-0700'),
(131, 'Pending', 'Pending', '2017-11-12 05:05:23', '2017-11-12 05:05:23', '151-0453'),
(132, 'Pending', 'Pending', '2017-11-12 05:18:16', '2017-11-12 05:18:16', '152-0084'),
(133, 'Pending', 'Pending', '2017-11-12 05:21:45', '2017-11-12 05:21:45', '122-0019'),
(135, 'Pending', 'Pending', '2017-11-12 05:26:38', '2017-11-12 05:26:38', '162-0046'),
(136, 'Pending', 'Pending', '2017-11-12 05:29:16', '2017-11-12 05:29:16', '162-0047'),
(137, 'Pending', 'Pending', '2017-11-12 05:31:34', '2017-11-12 05:31:34', '161-0184'),
(138, 'Pending', 'Pending', '2017-11-12 05:34:42', '2017-11-12 05:34:42', '161-0123'),
(139, 'Pending', 'Pending', '2017-11-12 05:36:28', '2017-11-12 05:36:28', '152-0010'),
(140, 'Pending', 'Pending', '2017-11-12 05:38:47', '2017-11-12 05:38:47', '111-0172'),
(141, 'Pending', 'Pending', '2017-11-12 05:40:13', '2017-11-12 05:40:13', '151-0874'),
(144, 'Pending', 'Pending', '2017-11-12 05:46:13', '2017-11-12 05:46:13', '151-0114'),
(145, 'Pending', 'Pending', '2017-11-12 05:48:20', '2017-11-12 05:48:20', '161-0139'),
(147, 'Pending', 'Pending', '2017-11-12 05:51:14', '2017-11-12 05:51:14', '161-0029'),
(148, 'Pending', 'Pending', '2017-11-12 05:52:45', '2017-11-12 05:52:45', '161-0026'),
(149, 'Pending', 'Pending', '2017-11-12 05:53:49', '2017-11-12 05:53:49', '171-0131'),
(152, 'Pending', 'Pending', '2017-11-12 06:07:02', '2017-11-12 06:07:02', '131-0271'),
(153, 'Pending', 'Pending', '2017-11-12 06:09:42', '2017-11-12 06:09:42', '151-1288'),
(155, 'Pending', 'Pending', '2017-11-12 06:13:40', '2017-11-12 06:13:40', '131-1096'),
(156, 'Pending', 'Pending', '2017-11-12 06:15:12', '2017-11-12 06:15:12', '151-0284'),
(157, 'Pending', 'Pending', '2017-11-12 06:17:58', '2017-11-12 06:17:58', '151-0304'),
(158, 'Pending', 'Pending', '2017-11-12 06:21:18', '2017-11-12 06:21:18', '171-0147'),
(159, 'Pending', 'Pending', '2017-11-12 06:22:49', '2017-11-12 06:22:49', '141-0628'),
(160, 'Pending', 'Pending', '2017-11-12 06:24:02', '2017-11-12 06:24:02', '131-0071'),
(161, 'Pending', 'Pending', '2017-11-12 06:25:43', '2017-11-12 06:25:43', '131-0458'),
(162, 'Pending', 'Pending', '2017-11-12 06:27:58', '2017-11-12 06:27:58', '131-0950'),
(163, 'Pending', 'Pending', '2017-11-12 06:29:29', '2017-11-12 06:29:29', '131-0685'),
(164, 'Pending', 'Pending', '2017-11-12 06:31:32', '2017-11-12 06:31:32', '151-0143'),
(165, 'Pending', 'Pending', '2017-11-12 06:34:44', '2017-11-12 06:34:44', '141-0314'),
(166, 'Pending', 'Pending', '2017-11-12 06:36:59', '2017-11-12 06:36:59', '151-0738'),
(167, 'Pending', 'Pending', '2017-11-12 06:38:44', '2017-11-12 06:38:44', '141-1199'),
(168, 'Pending', 'Pending', '2017-11-12 06:42:25', '2017-11-12 06:42:25', '141-0420'),
(169, 'Pending', 'Pending', '2017-11-12 06:44:48', '2017-11-12 06:44:48', '141-0694'),
(170, 'Pending', 'Pending', '2017-11-12 06:49:02', '2017-11-12 06:49:02', '162-0051'),
(171, 'Pending', 'Pending', '2017-11-12 06:51:54', '2017-11-12 06:51:54', '171-0013'),
(172, 'Pending', 'Pending', '2017-11-12 06:53:36', '2017-11-12 06:53:36', '151-0774'),
(173, 'Pending', 'Pending', '2017-11-12 06:59:03', '2017-11-12 06:59:03', '151-1214'),
(174, 'Pending', 'Pending', '2017-11-12 07:00:44', '2017-11-12 07:00:44', '141-0675'),
(175, 'Pending', 'Pending', '2017-11-12 07:02:53', '2017-11-12 07:02:53', '141-0875'),
(176, 'Pending', 'Pending', '2017-11-12 07:07:39', '2017-11-12 07:07:39', '141-1010'),
(177, 'Pending', 'Pending', '2017-11-12 07:15:04', '2017-11-12 07:15:04', '151-1388'),
(178, 'Pending', 'Pending', '2017-11-12 07:16:19', '2017-11-12 07:16:19', '151-0213'),
(179, 'Pending', 'Pending', '2017-11-12 07:18:08', '2017-11-12 07:18:08', '131-0883'),
(180, 'Pending', 'Pending', '2017-11-12 07:19:36', '2017-11-12 07:19:36', '151-1007'),
(181, 'Pending', 'Pending', '2017-11-12 07:21:12', '2017-11-12 07:21:12', '151-1248'),
(182, 'Pending', 'Pending', '2017-11-12 07:22:31', '2017-11-12 07:22:31', '141-0809'),
(183, 'Pending', 'Pending', '2017-11-12 07:35:55', '2017-11-12 07:35:55', '161-0253'),
(184, 'Pending', 'Pending', '2017-11-12 07:38:14', '2017-11-12 07:38:14', '151-1077'),
(185, 'Pending', 'Pending', '2017-11-12 07:40:00', '2017-11-12 07:40:00', '151-0221'),
(186, 'Pending', 'Pending', '2017-11-12 07:42:07', '2017-11-12 07:42:07', '151-0495'),
(187, 'Pending', 'Pending', '2017-11-12 07:43:42', '2017-11-12 07:43:42', '171-0121'),
(189, 'Pending', 'Pending', '2017-11-12 07:48:19', '2017-11-12 07:48:19', '161-0076'),
(190, 'Pending', 'Pending', '2017-11-12 07:58:21', '2017-11-12 07:58:21', '151-1384'),
(191, 'Pending', 'Pending', '2017-11-12 08:00:20', '2017-11-12 08:00:20', '141-0256'),
(192, 'Pending', 'Pending', '2017-11-12 08:01:38', '2017-11-12 08:01:38', '151-0192'),
(193, 'Pending', 'Pending', '2017-11-12 08:03:40', '2017-11-12 08:03:40', '171-0167'),
(194, 'Pending', 'Pending', '2017-11-12 08:05:09', '2017-11-12 08:05:09', '141-1060'),
(195, 'Pending', 'Pending', '2017-11-12 08:07:17', '2017-11-12 08:07:17', '131-0097'),
(196, 'Pending', 'Pending', '2017-11-12 08:09:16', '2017-11-12 08:09:16', '141-0076'),
(197, 'Pending', 'Pending', '2017-11-12 08:10:31', '2017-11-12 08:10:31', '141-0181'),
(198, 'Pending', 'Pending', '2017-11-12 08:12:10', '2017-11-12 08:12:10', '141-0094'),
(199, 'Pending', 'Pending', '2017-11-12 08:13:36', '2017-11-12 08:13:36', '131-0792'),
(200, 'Pending', 'Pending', '2017-11-12 08:15:39', '2017-11-12 08:15:39', '131-0301'),
(201, 'Pending', 'Pending', '2017-11-12 08:17:06', '2017-11-12 08:17:06', '131-0728'),
(202, 'Pending', 'Pending', '2017-11-12 08:18:29', '2017-11-12 08:18:29', '161-0020'),
(203, 'Pending', 'Pending', '2017-11-12 08:19:52', '2017-11-12 08:19:52', '131-0779'),
(204, 'Pending', 'Pending', '2017-11-12 08:21:24', '2017-11-12 08:21:24', '141-0623'),
(205, 'Pending', 'Pending', '2017-11-12 08:22:32', '2017-11-12 08:22:32', '111-0505'),
(206, 'Pending', 'Pending', '2017-11-12 08:23:52', '2017-11-12 08:23:52', '131-0454'),
(207, 'Ok', 'Pending', '2017-11-16 16:24:19', '2017-11-16 16:24:19', '141-1102'),
(208, 'Ok', 'Ok', '2017-11-14 03:44:49', '2017-11-14 03:44:49', '151-0076'),
(209, 'Ok', 'Ok', '2017-11-14 03:46:40', '2017-11-14 03:46:40', '131-0414'),
(215, 'Pending', 'Pending', '2017-11-24 15:48:57', '2017-11-24 15:48:57', '132-0001');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`) VALUES
(1, 'admin', 'admin@gmail.com', '41e5653fc7aeb894026d6bb7b2db7f65902b454945fa8fd65a6327047b5277fb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`FacultyID`,`facultyNo`),
  ADD UNIQUE KEY `facultyNo` (`facultyNo`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `faculty_med`
--
ALTER TABLE `faculty_med`
  ADD PRIMARY KEY (`MedID`,`FacultyID`),
  ADD UNIQUE KEY `FacultyID` (`FacultyID`);

--
-- Indexes for table `faculty_stats`
--
ALTER TABLE `faculty_stats`
  ADD PRIMARY KEY (`StatsID`,`facultyNo`),
  ADD UNIQUE KEY `facultyNo` (`facultyNo`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`,`studentNo`),
  ADD UNIQUE KEY `studentNo` (`studentNo`),
  ADD KEY `program` (`program`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `students_med`
--
ALTER TABLE `students_med`
  ADD PRIMARY KEY (`MedID`,`StudentID`),
  ADD UNIQUE KEY `StudentID` (`StudentID`);

--
-- Indexes for table `students_stats`
--
ALTER TABLE `students_stats`
  ADD PRIMARY KEY (`StatsID`,`studentNo`),
  ADD UNIQUE KEY `studentNo` (`studentNo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `FacultyID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faculty_med`
--
ALTER TABLE `faculty_med`
  MODIFY `MedID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faculty_stats`
--
ALTER TABLE `faculty_stats`
  MODIFY `StatsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `students_med`
--
ALTER TABLE `students_med`
  MODIFY `MedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students_stats`
--
ALTER TABLE `students_stats`
  MODIFY `StatsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `fk_dept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty_med`
--
ALTER TABLE `faculty_med`
  ADD CONSTRAINT `fk_fmed_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_stats`
--
ALTER TABLE `faculty_stats`
  ADD CONSTRAINT `fk_fstats_id` FOREIGN KEY (`facultyNo`) REFERENCES `faculties` (`facultyNo`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_prog_id` FOREIGN KEY (`program`) REFERENCES `program` (`program_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sdept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE;

--
-- Constraints for table `students_med`
--
ALTER TABLE `students_med`
  ADD CONSTRAINT `fk_med_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE;

--
-- Constraints for table `students_stats`
--
ALTER TABLE `students_stats`
  ADD CONSTRAINT `fk_stats_id` FOREIGN KEY (`studentNo`) REFERENCES `students` (`studentNo`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
