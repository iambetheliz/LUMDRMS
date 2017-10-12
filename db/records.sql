-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2017 at 06:12 PM
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
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `id_no` int(7) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `age` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `program` varchar(50) NOT NULL,
  `yearLevel` varchar(9) NOT NULL,
  `sem` varchar(9) NOT NULL,
  `acadYear` varchar(9) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cperson` varchar(50) NOT NULL,
  `cphone` varchar(11) NOT NULL,
  `tphone` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `last_name`, `first_name`, `middle_name`, `age`, `sex`, `program`, `yearLevel`, `sem`, `acadYear`, `address`, `cperson`, `cphone`, `tphone`) VALUES
(1, 'Punzalan', 'Elizabeth', 'Elec', 24, '', '', '', '', '0', '', '', '0', '000-0000'),
(2, 'Compendio', 'Lea', 'Gamba', 24, '', '', '', '', '0', '', '', '0', '000-0000'),
(3, 'Reforma', 'Benedict', 'Lapitan', 25, 'Male', '', '', '', '0', '', '', '0', '000-0000'),
(4, 'Marikit', 'Hans', 'Roben', 22, 'Male', 'BS Information Technology', '', '', '0', '', '', '0', '000-0000'),
(5, 'Reforma', 'Edmond', 'Ferera', 24, 'Male', 'BS Education', '', '', '', '', '', '0', '000-0000'),
(6, 'Punzalan', 'Hazel', 'Elec', 25, 'Female', 'BS Accountancy', '4th', '1st', '2016', '', '', '0', '000-0000'),
(7, 'Perez', 'Phoebe Nicole', 'Gecalao', 23, 'Female', 'BS Applied Physics', '3rd', '2nd', '2017', 'Los Banos, Laguna', '', '935836457', '');

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
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
