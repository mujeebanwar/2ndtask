-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2020 at 06:22 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `Name`) VALUES
(50, 'Sialkot'),
(51, 'Lahore');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(24, 'Developer'),
(25, 'Hr');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `Employee_Name` varchar(255) NOT NULL,
  `Employee_Email` varchar(255) NOT NULL,
  `Employee_Phone` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `software_house_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `Employee_Name`, `Employee_Email`, `Employee_Phone`, `department_id`, `software_house_id`, `city_id`) VALUES
(72, 'zain', 'zain@karigar.pk', '321-613-7253', 24, 46, 50),
(73, 'mujeeb', 'mujeeb@karigar.pk', '03216137254', 25, 47, 50);

-- --------------------------------------------------------

--
-- Table structure for table `software_cities`
--

CREATE TABLE `software_cities` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `software_house_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_cities`
--

INSERT INTO `software_cities` (`id`, `city_id`, `software_house_id`) VALUES
(37, 50, 46),
(38, 51, 47),
(39, 51, 48),
(40, 50, 49),
(41, 50, 50),
(42, 50, 51),
(43, 50, 52),
(44, 50, 53),
(45, 50, 54),
(46, 50, 55);

-- --------------------------------------------------------

--
-- Table structure for table `software_departments`
--

CREATE TABLE `software_departments` (
  `id` int(11) NOT NULL,
  `software_house_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_departments`
--

INSERT INTO `software_departments` (`id`, `software_house_id`, `department_id`) VALUES
(28, 46, 24),
(29, 47, 25),
(30, 46, 26),
(31, 46, 27),
(32, 46, 28),
(33, 46, 29);

-- --------------------------------------------------------

--
-- Table structure for table `software_house`
--

CREATE TABLE `software_house` (
  `id` int(11) NOT NULL,
  `software_house_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_house`
--

INSERT INTO `software_house` (`id`, `software_house_Name`, `Email`, `Phone`) VALUES
(46, 'Karigar', 'info@karigar.pk', '321-613-7259'),
(47, 'Softec', 'Softect@info.pk', '03216137253');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_cities`
--
ALTER TABLE `software_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_departments`
--
ALTER TABLE `software_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_house`
--
ALTER TABLE `software_house`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `software_cities`
--
ALTER TABLE `software_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `software_departments`
--
ALTER TABLE `software_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `software_house`
--
ALTER TABLE `software_house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
