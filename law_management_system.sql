-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 04:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `law_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `satisfaction_rating` enum('GREAT','GOOD','NEUTRAL','BAD') NOT NULL,
  `comments` text DEFAULT NULL,
  `consent` tinyint(1) NOT NULL
) ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `email`, `satisfaction_rating`, `comments`, `consent`) VALUES
('Ahmed', 'ahmed23@gmail.com', 'GREAT', 'The service is so great', 1),
('Amir', 'amir@gmail.com', 'GOOD', 'superb at all', 1),
('Bassim', 'bassim65@gmail.com', 'GOOD', 'good work, keep up', 1),
('Hasan', 'hasan61@gmail.com', 'GREAT', 'great work, will not be the last time', 1),
('Hussam', 'hussam@gmail.com', 'NEUTRAL', 'good and bad in same time', 1),
('Iman', 'iman33@gmail.com', 'NEUTRAL', 'not that bad, but need more focus', 1),
('Omar', 'omar98@gmail.com', 'BAD', 'bad service. Will not come again!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `full_name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`full_name`, `email`, `amount`) VALUES
('Asim Mohammed', 'asimmohammed@gmail.com', 350.00),
('Hamood Ahmed', 'hamood@gmail.com', 13597.00),
('Hamood Ahmed', 'hamoodahmed@gmail.com', 750.00),
('Nasser Salim', 'nassersalim@gmail.com', 250.00),
('Raid Hussein', 'raidhussein@gmail.com', 900.00),
('Salim Yahya', 'salimyahya@gmail.com', 555.00),
('Sami Ahmed', 'samiahmed@gmail.com', 100.00),
('Yusuf Khalid', 'yusufkhalid@gmail.com', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(18) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(15) NOT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('am2298', 'amir@gmail.com', 'am44009jd'),
('ba5789', 'baraa@gmail.com', 'be9e34jslm'),
('Hu3442', 'husam@gmail.com', 'huss43nkk'),
('moha', 'mohammedalajmi026@gmail.com', '12345678'),
('s137794', 'S137794@student.squ.edu.om', '12345678'),
('sa2311', 'salim@gmail.com', 'fdddjmsal'),
('yu1221', 'yusuf@gmail.com', 'oiojjjne45'),
('za3999', 'zainab@gmail.com', 'kjjiijm3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
