-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2016 at 01:46 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shutdown_places`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bird`
--

CREATE TABLE `Bird` (
  `id` int(6) UNSIGNED NOT NULL,
  `brname` varchar(30) NOT NULL,
  `description` varchar(150) NOT NULL,
  `bradder` varchar(50) DEFAULT NULL,
  `brtime` datetime DEFAULT NULL,
  `brlat` float DEFAULT NULL,
  `brlng` float DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Bird`
--

INSERT INTO `Bird` (`id`, `brname`, `description`, `bradder`, `brtime`, `brlat`, `brlng`, `reg_date`) VALUES
(1, 'testname', 'testdesc', 'testadder', '2016-06-01 08:00:00', 26.5173, 80.2331, '2016-06-24 11:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `Eventloc`
--

CREATE TABLE `Eventloc` (
  `id` int(6) UNSIGNED NOT NULL,
  `eventname` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `idloc` int(10) DEFAULT NULL,
  `location` varchar(150) NOT NULL,
  `adder` varchar(100) NOT NULL,
  `eventstart` datetime DEFAULT NULL,
  `eventend` datetime DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Eventloc`
--

INSERT INTO `Eventloc` (`id`, `eventname`, `description`, `idloc`, `location`, `adder`, `eventstart`, `eventend`, `reg_date`) VALUES
(7, 'testevent', 'testdesc', 1260, 'OPEN AIR THEATOR[OAT]IN NSAC  PROGRAMS', '', '2017-03-14 20:00:00', '2017-03-14 22:00:00', '2016-06-24 11:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `Lostfound`
--

CREATE TABLE `Lostfound` (
  `id` int(6) UNSIGNED NOT NULL,
  `objname` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `idloc` int(10) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `adder` varchar(30) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `objtime` datetime DEFAULT NULL,
  `objsel` int(2) DEFAULT NULL,
  `removetime` datetime DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lostfound`
--

INSERT INTO `Lostfound` (`id`, `objname`, `description`, `idloc`, `location`, `adder`, `address`, `objtime`, `objsel`, `removetime`, `reg_date`) VALUES
(1, 'testname', 'testdescr', 75, 'NORTHERN LAB[]CORRIDORE', 'testadder', 'testaddress', '2016-06-10 13:00:00', 2, NULL, '2016-06-24 11:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `Shutdown`
--

CREATE TABLE `Shutdown` (
  `id` int(6) UNSIGNED NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `layerfeat` varchar(10) DEFAULT NULL,
  `featname` varchar(255) DEFAULT NULL,
  `detail` varchar(200) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `strtshutdown` datetime DEFAULT NULL,
  `endshutdown` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Shutdown`
--

INSERT INTO `Shutdown` (`id`, `description`, `layerfeat`, `featname`, `detail`, `reg_date`, `strtshutdown`, `endshutdown`) VALUES
(63, '2', '21', 'CENTER FOR ENVIRONMENTAL SCIENCE ', NULL, '2016-06-24 11:46:14', '2016-06-06 18:27:00', '2016-06-07 18:27:00'),
(66, '3', '72', 'MECHANICAL ENGG LAB[NL I]A  ME', NULL, '2016-06-24 11:46:07', '2016-06-06 18:27:00', '2016-06-07 18:27:00'),
(76, '1', '1225', 'IIT FIELD CRICKET GROUND[CRICKET GROUND]COMMON', NULL, '2016-06-24 11:46:00', '2016-06-06 18:27:00', '2016-06-07 18:27:00'),
(93, '4', '12', 'AERO DYNAMICS LAB[AL]B', 'repair work', '2016-06-06 12:58:58', '2016-06-06 18:27:00', '2016-07-22T14:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`) VALUES
(1, 'test', 'test@testmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'shahryar', 'shahryaramd786@gmail.com', '912ec803b2ce49e4a541068d495ab570');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bird`
--
ALTER TABLE `Bird`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Eventloc`
--
ALTER TABLE `Eventloc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Lostfound`
--
ALTER TABLE `Lostfound`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Shutdown`
--
ALTER TABLE `Shutdown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bird`
--
ALTER TABLE `Bird`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Eventloc`
--
ALTER TABLE `Eventloc`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `Lostfound`
--
ALTER TABLE `Lostfound`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Shutdown`
--
ALTER TABLE `Shutdown`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
