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
  `stat` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `cat`, `stat`) VALUES
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

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'Testing', '#FFD700', '2018-02-27 00:00:00', '2018-02-28 00:00:00'),
(2, 'test', '', '2018-03-18 00:00:00', '2018-03-19 00:00:00');

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
  `age` varchar(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `civil` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `sem` varchar(9) NOT NULL,
  `acadYear` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cperson` varchar(50) NOT NULL,
  `cphone` varchar(15) NOT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  PRIMARY KEY (`FacultyID`,`facultyNo`),
  UNIQUE KEY `facultyNo` (`facultyNo`),
  KEY `dept` (`dept`),
  CONSTRAINT `fk_dept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`FacultyID`, `facultyNo`, `last_name`, `first_name`, `middle_name`, `ext`, `age`, `sex`, `dob`, `civil`, `dept`, `sem`, `acadYear`, `address`, `phone`, `cperson`, `cphone`, `modified`, `status`, `date_deleted`) VALUES
(1, '2017-0001', 'Agra', 'Lauderdale', 'V', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(2, '2017-0002', 'Aguado', 'Numeriano', 'B', '', '', 'Male', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(3, '2017-0003', 'Aguilar', 'Nayreen', 'S', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(4, '2017-0004', 'Alarde', 'Crispulo', 'S', 'Jr', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(5, '2017-0005', 'Alcaraz', ' Arnold', 'D', '', '', 'Male', '', '', 14, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(6, '2017-0006', 'Alvaran', 'Tony Angelo', 'C', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(7, '2017-0007', 'Ambrocio', 'Mayra Christina', 'M', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(8, '2017-0008', 'Angeles', 'Erneliza', 'G', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(9, '2017-0009', 'Apaya', 'Loreta', 'L', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(10, '2017-0010', 'Asumbra', 'Marilyn', 'L', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(11, '2017-0011', 'Atanacio', 'Marlon', 'J', '', '', 'Male', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(12, '2017-0012', 'Baltazar', 'Maria Josel', 'G', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(13, '2017-0013', 'Banocnoc', 'Joselle', 'A', '', '', 'Female', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(14, '2017-0014', 'Bato', 'Monette', 'O', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(15, '2017-0015', 'Belen', 'Liza', 'F', '', '', 'Female', '', '', 8, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(16, '2017-0016', 'Bermudez', 'Josephine', 'C', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(17, '2017-0017', 'Bilog', 'Ronel', 'J', '', '', 'Male', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(18, '2017-0018', 'Bueno', 'Leonida', 'C', '', '', 'Female', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(19, '2017-0019', 'Bulatao', 'Virgilio', '', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(20, '2017-0020', 'Calangian', 'Justine Mae', 'O', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(21, '2017-0021', 'Canonizado', 'Roilan', 'B', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(22, '2017-0022', 'Capistrano', 'Kristel Zorina', 'B', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(23, '2017-0023', 'Dalhag', 'Hendrick', 'M', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(24, '2017-0024', 'De Belen', 'Erika', '', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(25, '2017-0025', 'De Lima', 'MC Joshua', 'Y', '', '', 'Male', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(26, '2017-0026', 'De Torres', 'Korina Fatima', 'M', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(27, '2017-0027', 'Del Rosario', 'Khia', 'D', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(28, '2017-0028', 'Del Rosario', 'Ronuel', 'L', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(29, '2017-0029', 'Dimaculangan', 'Norayda', 'M', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(30, '2017-0030', 'Dimaranan', 'Kay Harold', 'C', '', '', 'Male', '', '', 7, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(31, '2017-0031', 'Dimasaca', 'Audrey Lou', 'S', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(32, '2017-0032', 'Dionisio', 'Robert', 'O', '', '', 'Male', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(33, '2017-0033', 'Diozon', 'Mario', 'F', '', '', 'Male', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(34, '2017-0034', 'Doble', 'Francisco', 'C', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(35, '2017-0035', 'Domingo', 'Olga', 'J', '', '', 'Female', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(36, '2017-0036', 'Dorado', 'Marizol', 'V', '', '', 'Female', '', '', 13, 'unknown', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(37, '2017-0037', 'Elomina', 'Marie Joy', 'O', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(38, '2017-0038', 'Espedido', 'Erixon', 'E', '', '', 'Male', '', '', 11, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(39, '2017-0039', 'Fernandez', 'Gualolarina', 'C', '', '', 'Female', '', '', 14, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(40, '2017-0040', 'Flora', 'Luigi Kim', 'L', '', '', 'Male', '', '', 11, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(41, '2017-0041', 'Francia', 'Arlene', 'Z', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(42, '2017-0042', 'Francia', 'Rogie', 'R', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(43, '2017-0043', 'Fucio', 'Chrisna', 'L', '', '', 'Female', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(44, '2017-0044', 'Gaa', 'Rowel', 'B', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(45, '2017-0045', 'Garbo', 'Roxanne', 'B', '', '', 'Female', '', '', 8, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(46, '2017-0046', 'Gascon', 'Colegio', 'S', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(47, '2017-0047', 'Gonzaga', 'Joanna Lee', 'P', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(48, '2017-0048', 'Hernandez', 'Charlie', 'L', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(49, '2017-0049', 'Herrdura', 'Renee Rose', 'D', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(50, '2017-0050', 'Idian', 'Bermar', 'L', '', '', 'Male', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(51, '2017-0051', 'Isles', 'Mila', 'E', '', '', 'Female', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(52, '2017-0052', 'Julio', 'Alfredo', 'A', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(53, '2017-0053', 'L Cruz', 'Anastacio', 'R', 'Jr', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(54, '2017-0054', 'Lasangre Cruz', 'Paul Gerard', 'R', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(55, '2017-0055', 'Lastimosa', 'Cyril', 'F', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(56, '2017-0056', 'Layos', 'Jhonessa', 'J', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(57, '2017-0057', 'Lubuguin', 'Rhea', 'A', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(58, '2017-0058', 'Macalatan', 'Mark Gian Glenn', 'S', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(59, '2017-0059', 'Madrazo', 'Leah De', 'J', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(60, '2017-0060', 'Magcalas', 'Marian', 'G', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(61, '2017-0061', 'Maglapuz', 'Sharmaine Justine', 'R', '', '', 'Female', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(62, '2017-0062', 'Mahinay', 'Amelyn', 'S', '', '', 'Female', '', '', 7, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(63, '2017-0063', 'Mahinay', 'Ludielyn', 'S', '', '', 'Female', '', '', 7, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(64, '2017-0064', 'Manuel', 'Christine Joy', 'L', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(65, '2017-0065', 'Melendrez', 'Joebert', 'S', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(66, '2017-0066', 'Minas', 'Florencia', 'S', '', '', 'Female', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(67, '2017-0067', 'Mondez', 'Jenneth', 'R', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(68, '2017-0068', 'Napiza', 'Emelyn', 'U', '', '', 'Female', '', '', 14, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(69, '2017-0069', 'Odquier', 'Caitlin Dianne', 'Q', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(70, '2017-0070', 'Palero', 'Madeliene', 'A', '', '', 'Female', '', '', 10, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(71, '2017-0071', 'Paras', 'Jerald', 'P', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(72, '2017-0072', 'Perez', 'Leonora', 'D', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(73, '2017-0073', 'Quintana', 'Marc Lester', 'F', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(74, '2017-0074', 'Ramirez', 'Marlon', 'C', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(75, '2017-0075', 'Regalo', 'May Riz', 'L', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(76, '2017-0076', 'Relova', 'Antonio', 'P', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(77, '2017-0077', 'Rubio', 'Corazon', '', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(78, '2017-0078', 'Sabado', 'Rosemarie', 'D', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(79, '2017-0079', 'Salomon', 'Avelina', 'E', '', '', 'Female', '', '', 2, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(80, '2017-0080', 'San Juan', 'Rose Nannette', 'J', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(81, '2017-0081', 'San Sebastian', 'Elson', 'E', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(82, '2017-0082', 'Santos', 'Enrique', 'G', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(83, '2017-0083', 'Santos', 'Jeffrey', 'M', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(84, '2017-0084', 'Solpico', 'Mary Ann', 'L', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(85, '2017-0085', 'Sultan', 'Nasser Khan', 'C', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(86, '2017-0086', 'Sumilang', 'Glaiza', 'T', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(87, '2017-0087', 'Sumiran', 'Kylie Margin', 'C', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(88, '2017-0088', 'Tan', 'Rosanne', 'O', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(89, '2017-0089', 'Tanlioco', 'Napoleon', 'D', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(90, '2017-0090', 'Trinidad', 'Blas', 'C', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(91, '2017-0091', 'Valenzuela', 'Edna', 'F', '', '', 'Female', '', '', 4, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(92, '2017-0092', 'Valero', 'Ma Nelia', 'A', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(93, '2017-0093', 'Valero', 'Marty', 'R', '', '', 'Male', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(94, '2017-0094', 'Velasco', 'Jennifer', 'R', '', '', 'Female', '', '', 10, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(95, '2017-0095', 'Villaroza', 'Precious Arlene', 'L', '', '', 'Female', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(96, '2017-0096', 'Vinas', 'Myline', 'S', '', '', 'Female', '', '', 1, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(97, '2017-0097', 'Ycogo', 'Agnes ', 'G', '', '', 'Female', '', '', 7, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(98, '2017-0098', 'Yosolon', 'Carolyn', 'R', '', '', 'Female', '', '', 9, '1st', '2017 - 2018', '', '', '', '', '0000-00-00 00:00:00', 'active', '0000-00-00 00:00:00'),
(99, '20130001', 'Reforma', 'Benedict', 'Lapitan', '', '35', 'Male', '05/29/1983', 'Single', 8, '2nd', '2018 - 2019', 'Los Banos, Laguna        ', '0997 395 7657', 'Dominga L. Reforma', '', '2018-03-11 05:11:52', 'active', '2018-03-08 06:49:58'),
(100, '20180001', 'Maglapuz', 'Shaine', 'Ramos', '', '', 'Female', '', 'Single', 1, '2nd', '2018 - 2019', '               ', '0917 104 5229', '', '', '2018-03-09 14:50:20', 'active', '2018-03-08 07:00:34'),
(101, '1234567', 'Reforma', 'Edeksky', '', '', '', 'undefined', '', '', 13, '1st', '2017 - 2018', '', '', '', '', '2018-03-11 05:09:06', 'active', '2018-03-11 04:59:06'),
(102, '2222222', 'Trial', 'Testing', '', '', '', 'undefined', '', '', 9, '2nd', '2018 - 2019', '', '', '', '', '2018-03-11 05:14:00', 'active', '2018-03-11 04:59:58'),
(103, '111111111', 'Tesitn', 'Last Test', '', '', '', 'Male', '', '', 7, '1st', '2012 - 2013', '        ', '', '', '', '2018-03-11 05:16:36', 'deleted', '2018-03-11 05:00:42'),
(104, '4444444', 'Reforma', 'Betzy', '', '', '', 'undefined', '', '', 3, '2nd', '2017 - 2018', '', '', '', '', '2018-03-11 05:04:26', 'active', '2018-03-11 05:04:26'),
(105, '555555555', 'Streses', 'Las Test', '', '', '', 'undefined', '', '', 2, '2nd', '2018 - 2019', '', '', '', '', '2018-03-11 05:28:35', 'deleted', '2018-03-11 05:15:16'),
(106, '6555444', 'Gghjgjh', 'Bhhjhj', 'Jjj', '', '', 'Male', '', '', 13, '1st', '2018 - 2019', '        ', '', '', '', '2018-03-11 22:49:06', 'active', '2018-03-11 06:21:05'),
(107, '12345678', 'Asdasdad', 'Asdasdadasd', 'Adad', '', '', 'Male', '', '', 3, '2nd', '2018 - 2019', '       ', '', '', '', '2018-03-11 22:53:25', 'active', '2018-03-11 22:52:23'),
(108, '12131231', 'Hjh', 'Ssjhkhk', 'Jhjhkjhjh', '', '', 'Male', '', '', 2, '1st', '2018 - 2019', '', '', '', '', '2018-03-11 22:54:39', 'active', '2018-03-11 22:54:39');
-- --------------------------------------------------------

--
-- Table structure for table `faculty_cert`
--

CREATE TABLE `faculty_cert` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rest` varchar(100) NOT NULL,
  `resolution` varchar(50) NOT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fcert_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_den`
--

CREATE TABLE `faculty_den` (
  `DID` int(11) NOT NULL AUTO_INCREMENT,
  `medHis` varchar(500) NOT NULL,
  `D18` int(1) NOT NULL, 
  `D17` int(1) NOT NULL, 
  `D16` int(1) NOT NULL, 
  `D15` int(1) NOT NULL, 
  `D14` int(1) NOT NULL, 
  `D13` int(1) NOT NULL, 
  `D12` int(1) NOT NULL, 
  `D11` int(1) NOT NULL, 
  `D21` int(1) NOT NULL, 
  `D22` int(1) NOT NULL, 
  `D23` int(1) NOT NULL, 
  `D24` int(1) NOT NULL, 
  `D25` int(1) NOT NULL, 
  `D26` int(1) NOT NULL, 
  `D27` int(1) NOT NULL, 
  `D28` int(1) NOT NULL, 
  `D48` int(1) NOT NULL, 
  `D47` int(1) NOT NULL, 
  `D46` int(1) NOT NULL, 
  `D45` int(1) NOT NULL, 
  `D44` int(1) NOT NULL, 
  `D43` int(1) NOT NULL, 
  `D42` int(1) NOT NULL, 
  `D41` int(1) NOT NULL, 
  `D31` int(1) NOT NULL, 
  `D32` int(1) NOT NULL, 
  `D33` int(1) NOT NULL, 
  `D34` int(1) NOT NULL, 
  `D35` int(1) NOT NULL, 
  `D36` int(1) NOT NULL, 
  `D37` int(1) NOT NULL, 
  `D38` int(1) NOT NULL, 
  `dec_x` varchar(2) NOT NULL,
  `dec_f` varchar(2) NOT NULL,
  `missing` varchar(2) NOT NULL,
  `filled` varchar(2) NOT NULL,
  `per_con` varchar(50) NOT NULL,
  `con_rem1` text(50) NOT NULL,
  `con_rem2` text(50) NOT NULL,
  `con_rem3` text(50) NOT NULL,
  `con_rem4` text(50) NOT NULL,
  `con_spec` varchar(50) NOT NULL,
  `denture` varchar(5) NOT NULL,
  `pro_rem1` varchar(50) NOT NULL,
  `pro_spec1` varchar(50) NOT NULL,
  `need` varchar(5) NOT NULL,
  `pro_rem2` varchar(50) NOT NULL,
  `pro_spec2` varchar(50) NOT NULL,
  `pro_rem3` varchar(50) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `facultyNo` varchar(9) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`DID`),
  KEY `FacultyID` (`FacultyID`),
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
  `mens` varchar(15) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `dys` varchar(20) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(30) NOT NULL,
  `bp` varchar(30) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `gen_sur` varchar(50) NOT NULL,
  `skin` varchar(50) NOT NULL,
  `heent` varchar(50) NOT NULL,
  `lungs` varchar(50) NOT NULL,
  `heart` varchar(50) NOT NULL,
  `abdomen` varchar(50) NOT NULL,
  `extreme` varchar(50) NOT NULL,
  `xray` varchar(3) NOT NULL,
  `assess` varchar(5) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `facultyNo` varchar(9) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`MedID`),
  KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `fk_fmed_id` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_soap`
--

CREATE TABLE `faculty_soap` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `sysRev` varchar(500) NOT NULL,
  `med` varchar(500) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(30) NOT NULL,
  `bp` varchar(30) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `assess` text(500) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `facultyNo` varchar(9) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  PRIMARY KEY (`SID`),
  KEY `FacultyID` (`FacultyID`),
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
(98, 'Pending', 'Pending', '2017-11-29 10:59:49', '2017-11-29 10:59:49', '', '2017-0098'),
(99, 'Ok', 'Ok', '2018-03-08 06:49:58', '2018-03-08 09:11:10', '', '20130001'),
(100, 'Pending', 'Ok', '2018-03-08 07:00:34', '2018-03-08 07:47:27', '', '20180001'),
(101, 'Pending', 'Pending', '2018-03-11 04:59:06', '2018-03-11 04:59:06', '', '1234567'),
(102, 'Pending', 'Pending', '2018-03-11 04:59:59', '2018-03-11 04:59:59', '', '2222222'),
(103, 'Ok', 'Ok', '2018-03-11 05:00:42', '2018-03-11 05:19:21', '', '111111111'),
(104, 'Pending', 'Pending', '2018-03-11 05:04:26', '2018-03-11 05:04:26', '', '4444444'),
(105, 'Pending', 'Pending', '2018-03-11 05:15:16', '2018-03-11 05:15:16', '', '555555555'),
(106, 'Pending', 'Pending', '2018-03-11 06:21:05', '2018-03-11 06:21:05', '', '6555444'),
(107, 'Pending', 'Pending', '2018-03-11 22:52:23', '2018-03-11 22:52:23', '', '12345678'),
(108, 'Pending', 'Pending', '2018-03-11 22:54:39', '2018-03-11 22:54:39', '', '12131231');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(8) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `stat` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Blocked, 1:Active',
  PRIMARY KEY (`program_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_name`, `alias`, `dept_id`, `stat`) VALUES
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
  `age` varchar(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `civil` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `yearLevel` varchar(9) NOT NULL,
  `sem` varchar(9) NOT NULL,
  `acadYear` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cperson` varchar(50) NOT NULL,
  `cphone` varchar(15) NOT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  PRIMARY KEY (`StudentID`,`studentNo`),
  UNIQUE KEY `studentNo` (`studentNo`),
  KEY `program` (`program`),
  KEY `dept` (`dept`),
  CONSTRAINT `fk_prog_id` FOREIGN KEY (`program`) REFERENCES `program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sdept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_cert`
--

CREATE TABLE `students_cert` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rest` varchar(100) NOT NULL,
  `resolution` varchar(50) NOT NULL,
  `date_issued` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `StudentID` (`StudentID`),
  CONSTRAINT `fk_cert_id` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_den`
--

CREATE TABLE `students_den` (
  `DID` int(11) NOT NULL AUTO_INCREMENT,
  `medHis` varchar(500) NOT NULL,
  `D18` int(1) NOT NULL, 
  `D17` int(1) NOT NULL, 
  `D16` int(1) NOT NULL, 
  `D15` int(1) NOT NULL, 
  `D14` int(1) NOT NULL, 
  `D13` int(1) NOT NULL, 
  `D12` int(1) NOT NULL, 
  `D11` int(1) NOT NULL, 
  `D21` int(1) NOT NULL, 
  `D22` int(1) NOT NULL, 
  `D23` int(1) NOT NULL, 
  `D24` int(1) NOT NULL, 
  `D25` int(1) NOT NULL, 
  `D26` int(1) NOT NULL, 
  `D27` int(1) NOT NULL, 
  `D28` int(1) NOT NULL, 
  `D48` int(1) NOT NULL, 
  `D47` int(1) NOT NULL, 
  `D46` int(1) NOT NULL, 
  `D45` int(1) NOT NULL, 
  `D44` int(1) NOT NULL, 
  `D43` int(1) NOT NULL, 
  `D42` int(1) NOT NULL, 
  `D41` int(1) NOT NULL, 
  `D31` int(1) NOT NULL, 
  `D32` int(1) NOT NULL, 
  `D33` int(1) NOT NULL, 
  `D34` int(1) NOT NULL, 
  `D35` int(1) NOT NULL, 
  `D36` int(1) NOT NULL, 
  `D37` int(1) NOT NULL, 
  `D38` int(1) NOT NULL, 
  `dec_x` varchar(2) NOT NULL,
  `dec_f` varchar(2) NOT NULL,
  `missing` varchar(2) NOT NULL,
  `filled` varchar(2) NOT NULL,
  `per_con` varchar(50) NOT NULL,
  `con_rem1` text(50) NOT NULL,
  `con_rem2` text(50) NOT NULL,
  `con_rem3` text(50) NOT NULL,
  `con_rem4` text(50) NOT NULL,
  `con_spec` varchar(50) NOT NULL,
  `denture` varchar(5) NOT NULL,
  `pro_rem1` varchar(50) NOT NULL,
  `pro_spec1` varchar(50) NOT NULL,
  `need` varchar(5) NOT NULL,
  `pro_rem2` varchar(50) NOT NULL,
  `pro_spec2` varchar(50) NOT NULL,
  `pro_rem3` varchar(50) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `studentNo` varchar(8) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`DID`),
  KEY `StudentID` (`StudentID`),
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
  `mens` varchar(15) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `dys` varchar(20) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `bmi` varchar(30) NOT NULL,
  `bp` varchar(30) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `gen_sur` varchar(50) NOT NULL,
  `skin` varchar(50) NOT NULL,
  `heent` varchar(50) NOT NULL,
  `lungs` varchar(50) NOT NULL,
  `heart` varchar(50) NOT NULL,
  `abdomen` varchar(50) NOT NULL,
  `extreme` varchar(50) NOT NULL,
  `xray` varchar(3) NOT NULL,
  `assess` varchar(5) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked_up` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `studentNo` varchar(8) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`MedID`),
  KEY `StudentID` (`StudentID`),
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
  `bmi` varchar(30) NOT NULL,
  `bp` varchar(30) NOT NULL,
  `cr` varchar(3) NOT NULL,
  `rr` varchar(3) NOT NULL,
  `temp` varchar(5) NOT NULL,
  `assess` text(500) NOT NULL,
  `plan` text(200) NOT NULL,
  `date_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT 'active',
  `date_deleted` timestamp NOT NULL,
  `checked_by` varchar(50) NOT NULL,
  `studentNo` varchar(8) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`SID`),
  KEY `StudentID` (`StudentID`),
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
  `last_name` varchar(30) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `position` varchar(50) NOT NULL,
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

INSERT INTO `users` (`userId`, `userName`, `first_name`, `last_name`, `userPass`, `position`, `role`, `login_date`) VALUES
(1, 'admin', '', '', '41e5653fc7aeb894026d6bb7b2db7f65902b454945fa8fd65a6327047b5277fb', 'School Nurse', 'superadmin', '2017-12-22 07:10:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
