-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 09:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaintregistration`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `comp_id` int(11) NOT NULL,
  `usercomp_id` int(11) NOT NULL,
  `comptype` varchar(255) DEFAULT NULL,
  `compdetail` varchar(255) DEFAULT NULL,
  `comparea` varchar(255) DEFAULT NULL,
  `complocality` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `solution` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`comp_id`, `usercomp_id`, `comptype`, `compdetail`, `comparea`, `complocality`, `status`, `solution`) VALUES
(10001, 101, 'Removal of garbage', 'Damaged bins', 'punjabibagh', 'H No. 122, street no. 11', 'Completed', 'ghjk'),
(10002, 102, 'Street dogs', 'Street dogs number has increased in our colony and they are very dangerous and does not let us freely move in street.', 'vikas colony', 'H.No. 224, Street No. 12, Vikas Colony', 'Pending', ''),
(10003, 103, 'Staganation of water', 'Poor condition of pipes causing poor flow of water.', 'punjabibagh', 'H.No. 102, Street No. 7, Punjabi bagh', 'Pending', ''),
(10004, 104, 'Non burning of street lights', 'Street lights are not working.', 'punjabibagh', 'H.No. 69, Street No. 6, Punjabi bagh', 'Pending', ''),
(10005, 105, 'Mosquito menace', 'Due to poor condition of road, rain water is collected causing growth of mosquitoes. ', 'vikas colony', 'H.No. 69, Street No. 6, Vikas Colony', 'Pending', ''),
(10006, 106, 'Removal of garbage', 'Damaged bins.', 'vikas colony', 'H.No. 167, Street No. 8, Vikas Colony', 'Pending', ''),
(10007, 107, 'Removal of garbage', 'Garbage bins not present', 'greentown', 'Street No. 8, Urban Estate, Patiala', 'Pending', ''),
(10008, 108, 'Mosquito menace', ' Due to poor condition of road, rain water is collected causing growth of mosquitoes. ', 'greentown', 'Street No. 4, Urban Estate Phase 2, Patiala', 'Pending', ''),
(10009, 109, 'Street dogs', 'Street dogs number has increased in our colony and they are very dangerous and does not let us freely move in street.', 'greentown', 'Street No. 4, Urban Estate Phase 3, Patiala', 'Pending', ''),
(10010, 110, 'Staganation of water', 'Poor condition of pipes causing poor flow of water.', 'punjabibagh', 'Street No. 4, punjabi bagh, Patiala', 'Pending', ''),
(10011, 111, 'Non burning of street lights', 'Poor condition of pipes causing poor flow of water.', 'punjabibagh', 'Street lights are not working.', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_login`
--

CREATE TABLE `staff_login` (
  `staff_id` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(8) NOT NULL,
  `department` varchar(10) NOT NULL DEFAULT 'officer',
  `field` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_login`
--

INSERT INTO `staff_login` (`staff_id`, `email`, `password`, `department`, `field`) VALUES
('admin', 'admin@gmail.com', 'admin12', 'admin', ''),
('officer1', 'officer1@gmail.com', 'off#1', 'officer', 'Removal of garbage'),
('officer2', 'officer2@gmail.com', 'off#2', 'officer', 'Mosquito menace'),
('officer3', 'officer3@gmail.com', 'off#3', 'officer', 'Street dogs'),
('officer4', 'officer4@gmail.com', 'off#4', 'officer', 'Slaganation of water'),
('officer5', 'officer5@gmail.com', 'off#5', 'officer', 'Non burning of street lights'),
('officer6', 'officer6@gmail.com', 'off#6', 'officer', 'Removal of garbage');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pincode` int(11) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`, `pincode`, `state`, `address`) VALUES
(101, 'abc@gmail.com', 'abc', '9876543211', 147001, 'punjab', 'H N0 122, Street No 11, punjabi bagh, patiala'),
(102, 'test1@gmail.com', 'test1', '9875840032', 147001, 'Punjab', 'H.No. 224, Street No. 12, Vikas Colony, Patiala'),
(103, 'test2@gmail.com', 'test2', '7788844123', 147001, 'Punjab', 'H.No. 102, Street No. 7, Punjabi bagh, Patiala'),
(104, 'test3@gmail.com', 'test3', '7788845553', 147001, 'Punjab', 'H.No. 69, Street No. 6, Punjabi bagh, Patiala'),
(105, 'test4@gmail.com', 'test4', '9988845553', 147001, 'Punjab', 'H.No. 69, Street No. 6, Vikas Colony, Patiala'),
(106, 'test5@gmail.com', 'test5', '9987645553', 147001, 'Punjab', 'H.No. 167, Street No. 8, Vikas Colony, Patiala'),
(107, 'test6@gmail.com', 'test6', '7009935250', 147001, 'Punjab', 'H.No. 167, Street No. 8, Urban Estate Phase 1, Patiala'),
(108, 'test7@gmail.com', 'test7', '7119935250', 147001, 'Punjab', 'H.No. 645, Street No. 4, Urban Estate Phase 2, Patiala'),
(109, 'test8@gmail.com', 'test8', '7118835250', 147001, 'Punjab', 'H.No. 543, Street No. 11, Urban Estate Phase 3, Patiala'),
(110, 'test9@gmail.com', 'test9', '7118836250', 147001, 'Punjab', 'H.No. 567, Street No. 11, punjabi bagh Patiala'),
(111, 'test10@gmail.com', 'test10', '7118836244', 147001, 'Punjab', 'H.No. 567, Street No. 6, punjabi bagh Patiala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`comp_id`),
  ADD UNIQUE KEY `comp_id` (`comp_id`),
  ADD UNIQUE KEY `usercomp_id` (`usercomp_id`);

--
-- Indexes for table `staff_login`
--
ALTER TABLE `staff_login`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10012;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
