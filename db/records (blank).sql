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
  `age` varchar(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `stat` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `sem` varchar(9) NOT NULL,
  `acadYear` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cperson` varchar(50) NOT NULL,
  `cphone` varchar(15) NOT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`FacultyID`,`facultyNo`),
  UNIQUE KEY `facultyNo` (`facultyNo`),
  KEY `dept` (`dept`),
  CONSTRAINT `fk_dept_id` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `age` varchar(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `stat` varchar(10) NOT NULL,
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
