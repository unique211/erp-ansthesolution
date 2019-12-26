-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2019 at 05:56 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--
CREATE DATABASE IF NOT EXISTS `ansthesolution` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ansthesolution`;

-- --------------------------------------------------------

--
-- Table structure for table `bii_description`
--

CREATE TABLE `bii_description` (
  `id` int(11) NOT NULL,
  `billid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `paidamt` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bii_description`
--

INSERT INTO `bii_description` (`id`, `billid`, `serviceid`, `amount`, `qty`, `paidamt`) VALUES
(12, 1, 2, '123.00', 12, '10.00'),
(13, 1, 2, '123.00', 15, '100.00'),
(14, 2, 2, '123.00', 10, '12.00'),
(15, 2, 3, '124.00', 14, '120.00'),
(18, 3, 2, '123.00', 10, '15.00'),
(19, 3, 3, '124.00', 15, '123.00'),
(20, 4, 2, '123.00', 10, '150.00'),
(21, 4, 3, '124.00', 15, '123.00'),
(22, 5, 1, '12312.00', 10, '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `bill_master`
--

CREATE TABLE `bill_master` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `grandamt` decimal(10,2) NOT NULL,
  `totalpaidamt` decimal(10,2) NOT NULL,
  `status` int(1) DEFAULT '1',
  `distributorid` int(11) NOT NULL,
  `branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_master`
--

INSERT INTO `bill_master` (`id`, `customerid`, `grandamt`, `totalpaidamt`, `status`, `distributorid`, `branchid`) VALUES
(1, 1, '3321.00', '110.00', 1, 0, 0),
(2, 2, '2966.00', '132.00', 1, 0, 0),
(3, 3, '3090.00', '138.00', 1, 7, 3),
(4, 2, '3090.00', '273.00', 1, 9, 5),
(5, 2, '123120.00', '1500.00', 1, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `branch_mastre`
--

CREATE TABLE `branch_mastre` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `b_city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `con_name` varchar(100) NOT NULL,
  `con_email` varchar(100) NOT NULL,
  `con_phoneno` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_mastre`
--

INSERT INTO `branch_mastre` (`id`, `name`, `phone_no`, `b_city`, `address`, `con_name`, `con_email`, `con_phoneno`, `status`) VALUES
(3, 'ALLY SOFT SOLUTIONS', '123', 'wqe', 'qweqw', 'VIshal AKbari', 'vishal.rkcet@gmail.com', '1234512', 1),
(5, 'Abc Soluation', '10123456', 'rajkot', 'rajkot', 'VIshal AKbari', 'vishal.rkcet@gmail.com', '9874563210', 1),
(6, ' SOFT SOLUTIONS', '1234567890', 'RAJKOT', 'Rajkot', 'Ajaz', 'ajaz@gmail.com', '123456789', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_matserdata`
--

CREATE TABLE `customer_matserdata` (
  `id` int(11) NOT NULL,
  `customername` varchar(50) NOT NULL,
  `referenceno` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pancard_no` varchar(15) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `aadhar_no` varchar(20) NOT NULL,
  `category` int(11) NOT NULL,
  `gstinno` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `distributorid` int(11) NOT NULL,
  `branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_matserdata`
--

INSERT INTO `customer_matserdata` (`id`, `customername`, `referenceno`, `address`, `pancard_no`, `phone_no`, `aadhar_no`, `category`, `gstinno`, `status`, `distributorid`, `branchid`) VALUES
(1, 'Ajaz', '101', 'Rajkot', '987456321', '123456789', '0123456789', 3, 'gss101', 1, 0, 0),
(2, 'Mohit', '112', 'Rajkot', '123456123', '6541237890', '12345678901122', 2, 'gss103', 1, 0, 0),
(3, 'sagar', '101', 'Rajkot', '123456', '123456', '12345678901122', 3, 'gss101', 1, 7, 3),
(4, 'Mohit123', '101', 'Rajkot', '123456', '789654123', '0123456789', 2, 'gss101', 1, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `distributor_master`
--

CREATE TABLE `distributor_master` (
  `id` int(11) NOT NULL,
  `userrole` varchar(20) NOT NULL,
  `distributor_name` varchar(100) NOT NULL,
  `dis_address` varchar(150) NOT NULL,
  `branchid` int(11) NOT NULL,
  `distributorcode` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor_master`
--

INSERT INTO `distributor_master` (`id`, `userrole`, `distributor_name`, `dis_address`, `branchid`, `distributorcode`, `status`) VALUES
(2, '', 'Dis 2', 'amreli', 3, 'dis002', 1),
(5, '', 'Dis 3', 'Rajkot', 5, 'dis0003', 1),
(6, 'employee', 'Emp1', 'Rajkot', 3, 'emp01', 1),
(7, 'distributor', 'distributor12', 'Rajkot', 3, 'dis001', 1),
(8, 'admin', 'Ajaz', 'Rajkot', 5, '', 1),
(9, 'employee', 'distributor15', 'Rajkot', 5, 'emp005', 1),
(10, 'distributor', 'distributor12', 'Amreli', 3, 'dis0005', 1),
(11, 'employee', 'Emp 2', 'Rajkot', 5, 'mohit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL DEFAULT 'admin',
  `code` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `c_id`, `username`, `password`, `role`, `code`, `status`) VALUES
(1, 0, 'admin', 'admin', 'superadmin', '', 1),
(2, 1, 'vishal', 'jiya', 'admin', '', 1),
(3, 6, 'emp1', 'emp1', 'employee', 'emp01', 1),
(4, 7, 'sagar', '456789', 'distributor', 'dis001', 1),
(5, 8, 'admin', '123456', 'admin', '', 1),
(6, 9, 'ajaz', '123', 'employee', 'emp005', 1),
(7, 10, 'palak', 'palak', 'distributor', 'dis0005', 1),
(8, 11, 'mohit', '123', 'employee', 'mohit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_master`
--

CREATE TABLE `service_master` (
  `id` int(11) NOT NULL,
  `bramchid` int(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_master`
--

INSERT INTO `service_master` (`id`, `bramchid`, `s_name`, `amount`, `status`) VALUES
(1, 3, 'service1', '12312.00', 1),
(2, 3, 'service1', '123.00', 1),
(3, 3, 'service3', '124.00', 1),
(5, 5, 'service6', '1234.00', 1),
(6, 5, 'service15', '100.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bii_description`
--
ALTER TABLE `bii_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_master`
--
ALTER TABLE `bill_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_mastre`
--
ALTER TABLE `branch_mastre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_matserdata`
--
ALTER TABLE `customer_matserdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor_master`
--
ALTER TABLE `distributor_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_master`
--
ALTER TABLE `service_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bii_description`
--
ALTER TABLE `bii_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bill_master`
--
ALTER TABLE `bill_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branch_mastre`
--
ALTER TABLE `branch_mastre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_matserdata`
--
ALTER TABLE `customer_matserdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distributor_master`
--
ALTER TABLE `distributor_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_master`
--
ALTER TABLE `service_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
