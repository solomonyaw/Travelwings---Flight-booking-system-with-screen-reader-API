-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2018 at 02:28 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircrafts`
--

CREATE TABLE `aircrafts` (
  `id` int(10) UNSIGNED NOT NULL,
  `typeid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='table of planes owned by the airline';

--
-- Dumping data for table `aircrafts`
--

INSERT INTO `aircrafts` (`id`, `typeid`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `flightid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `class` enum('first','business','economy','') COLLATE utf16_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='booking details';

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `flightid`, `userid`, `amount`, `class`, `quantity`) VALUES
(14, 1, 1, 5000, 'first', 1),
(16, 1, 1, 50000, 'first', 10),
(17, 1, 1, 5000, 'first', 1),
(21, 5, 12, 200000, 'economy', 2),
(23, 6, 15, 18000, 'economy', 2);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(10) UNSIGNED NOT NULL,
  `aircraftid` int(11) UNSIGNED NOT NULL,
  `startcity` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `endcity` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `firstavl` int(11) NOT NULL DEFAULT '0',
  `bizavl` int(11) NOT NULL DEFAULT '0',
  `econavl` int(11) NOT NULL DEFAULT '0',
  `firstfare` int(11) NOT NULL,
  `bizfare` int(11) NOT NULL,
  `econfare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='table of flights operating';

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `aircraftid`, `startcity`, `endcity`, `starttime`, `endtime`, `firstavl`, `bizavl`, `econavl`, `firstfare`, `bizfare`, `econfare`) VALUES
(1, 1, 'Accra', 'London', '2018-03-08 06:20:00', '2018-03-09 09:00:00', 1, 0, 2, 5000, 0, 0),
(3, 3, 'Accra', 'New York', '2018-04-11 00:00:00', '2018-04-12 00:00:00', 0, 0, 6, 400, 0, 0),
(5, 5, 'Accra', 'Lagos', '2018-03-09 04:07:12', '2018-03-13 06:11:15', 5, 10, 100, 300000, 200000, 100000),
(6, 3, 'Accra', 'Jerusalem', '2018-03-07 09:08:00', '2018-03-08 18:08:00', 5, 10, 100, 2000, 4000, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seatno` int(11) NOT NULL,
  `flightid` int(11) NOT NULL,
  `class` enum('first','business','economy','') COLLATE utf16_unicode_ci NOT NULL,
  `isbooked` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seatno`, `flightid`, `class`, `isbooked`) VALUES
(1, 6, 'first', 0),
(2, 6, 'first', 0),
(3, 6, 'first', 0),
(4, 6, 'first', 0),
(5, 6, 'first', 0),
(6, 6, 'business', 0),
(7, 6, 'business', 0),
(8, 6, 'business', 0),
(9, 6, 'business', 0),
(10, 6, 'business', 0),
(11, 6, 'business', 0),
(12, 6, 'business', 0),
(13, 6, 'business', 0),
(14, 6, 'business', 0),
(15, 6, 'business', 0),
(16, 6, 'economy', 0),
(17, 6, 'economy', 0),
(18, 6, 'economy', 0),
(19, 6, 'economy', 0),
(20, 6, 'economy', 0),
(21, 6, 'economy', 0),
(22, 6, 'economy', 0),
(23, 6, 'economy', 0),
(24, 6, 'economy', 0),
(25, 6, 'economy', 0),
(26, 6, 'economy', 0),
(27, 6, 'economy', 0),
(28, 6, 'economy', 0),
(29, 6, 'economy', 0),
(30, 6, 'economy', 0),
(31, 6, 'economy', 0),
(32, 6, 'economy', 0),
(33, 6, 'economy', 0),
(34, 6, 'economy', 0),
(35, 6, 'economy', 0),
(36, 6, 'economy', 0),
(37, 6, 'economy', 0),
(38, 6, 'economy', 0),
(39, 6, 'economy', 0),
(40, 6, 'economy', 0),
(41, 6, 'economy', 0),
(42, 6, 'economy', 0),
(43, 6, 'economy', 0),
(44, 6, 'economy', 0),
(45, 6, 'economy', 0),
(46, 6, 'economy', 0),
(47, 6, 'economy', 0),
(48, 6, 'economy', 0),
(49, 6, 'economy', 0),
(50, 6, 'economy', 0),
(51, 6, 'economy', 0),
(52, 6, 'economy', 0),
(53, 6, 'economy', 0),
(54, 6, 'economy', 0),
(55, 6, 'economy', 0),
(56, 6, 'economy', 0),
(57, 6, 'economy', 0),
(58, 6, 'economy', 0),
(59, 6, 'economy', 0),
(60, 6, 'economy', 0),
(61, 6, 'economy', 0),
(62, 6, 'economy', 0),
(63, 6, 'economy', 0),
(64, 6, 'economy', 0),
(65, 6, 'economy', 0),
(66, 6, 'economy', 0),
(67, 6, 'economy', 0),
(68, 6, 'economy', 0),
(69, 6, 'economy', 0),
(70, 6, 'economy', 0),
(71, 6, 'economy', 0),
(72, 6, 'economy', 0),
(73, 6, 'economy', 0),
(74, 6, 'economy', 0),
(75, 6, 'economy', 0),
(76, 6, 'economy', 0),
(77, 6, 'economy', 0),
(78, 6, 'economy', 0),
(79, 6, 'economy', 0),
(80, 6, 'economy', 0),
(81, 6, 'economy', 0),
(82, 6, 'economy', 0),
(83, 6, 'economy', 0),
(84, 6, 'economy', 0),
(85, 6, 'economy', 0),
(86, 6, 'economy', 0),
(87, 6, 'economy', 0),
(88, 6, 'economy', 0),
(89, 6, 'economy', 0),
(90, 6, 'economy', 0),
(91, 6, 'economy', 0),
(92, 6, 'economy', 0),
(93, 6, 'economy', 0),
(94, 6, 'economy', 0),
(95, 6, 'economy', 0),
(96, 6, 'economy', 0),
(97, 6, 'economy', 0),
(98, 6, 'economy', 0),
(99, 6, 'economy', 0),
(100, 6, 'economy', 0),
(101, 6, 'economy', 0),
(102, 6, 'economy', 0),
(103, 6, 'economy', 0),
(104, 6, 'economy', 0),
(105, 6, 'economy', 0),
(106, 6, 'economy', 0),
(107, 6, 'economy', 0),
(108, 6, 'economy', 0),
(109, 6, 'economy', 0),
(110, 6, 'economy', 0),
(111, 6, 'economy', 0),
(112, 6, 'economy', 0),
(113, 6, 'economy', 0),
(114, 6, 'economy', 0),
(115, 6, 'economy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `firstcap` int(11) NOT NULL,
  `bizcap` int(11) NOT NULL,
  `econcap` int(11) NOT NULL,
  `rateperkm` int(11) NOT NULL,
  `fixedcost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='aircraft types';

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `firstcap`, `bizcap`, `econcap`, `rateperkm`, `fixedcost`) VALUES
(1, 'Boeing 747', 20, 50, 200, 3, 1000),
(3, 'Airbus A320', 5, 10, 100, 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `address` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT '0',
  `balance` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='users data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `isadmin`, `balance`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 'admin', '546546', 'sfasdad', 1, -25000),
(2, 'riya@ams.com', 'riya', 'riya', 'bubna', '654654654', 'sfdfs', 1, 5000),
(12, 'hello@gmail.com', 'veronica', 'Mugisha', 'michael', '0703749602', 'kitemu', 0, -202000),
(15, 'adesolo2006@gmail.com', 'tricomlim', 'solomon', 'adeklo', '0540834343', 'tema', 0, -19000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeid` (`typeid`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flightid` (`flightid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aircraftid` (`aircraftid`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircrafts`
--
ALTER TABLE `aircrafts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD CONSTRAINT `aircrafts_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `types` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`flightid`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`aircraftid`) REFERENCES `aircrafts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
