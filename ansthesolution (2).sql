-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2019 at 05:07 AM
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
-- Database: `ansthesolution`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_group`
--

CREATE TABLE `account_group` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `bal` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `brachid` int(11) NOT NULL,
  `distributorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_group`
--

INSERT INTO `account_group` (`id`, `name`, `bal`, `date`, `status`, `brachid`, `distributorid`) VALUES
(3, 'sale account', '1000', '2019-07-23', 0, 0, 0),
(4, 'purchase ac', '1000', '2019-07-22', 0, 0, 0),
(5, 'purchase return', '12000', '2019-07-08', 1, 0, 0),
(6, 'manager  account', '12000', '2019-07-25', 1, 0, 0),
(7, 'purchase data', '15000', '2019-07-30', 1, 0, 4),
(8, 'aabc ', '1000', '2019-07-24', 1, 3, 2),
(9, 'for testing', '15000', '2019-07-31', 1, 1, 1),
(10, 'sadf', '1000', '2019-07-25', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `bii_description`
--

CREATE TABLE `bii_description` (
  `id` int(11) NOT NULL,
  `billid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `paidamt` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bii_description`
--

INSERT INTO `bii_description` (`id`, `billid`, `serviceid`, `amount`, `qty`, `paidamt`) VALUES
(1, 1, 2, '1500', 10, '500'),
(2, 1, 4, '300', 10, '200'),
(3, 2, 2, '1500', 5, '600'),
(4, 2, 4, '300', 1, '200'),
(5, 3, 4, '300', 10, '1500'),
(6, 3, 2, '1500', 2, '150'),
(7, 4, 4, '300', 12, '100'),
(8, 4, 2, '1500', 1, '1000'),
(9, 5, 2, '1500', 10, '150'),
(10, 5, 4, '300', 1, '200'),
(11, 6, 2, '1500', 1, '1220'),
(12, 7, 2, '1500', 1, '300'),
(13, 8, 1, '2000', 12, '100'),
(14, 8, 3, '120', 14, '1200'),
(15, 9, 1, '2000', 10, '1500'),
(16, 10, 2, '1500', 10, '150'),
(17, 10, 4, '300', 1, '20'),
(18, 11, 4, '300', 5, '300'),
(19, 11, 2, '1500', 2, '500'),
(20, 12, 1, '2000', 1, '120'),
(21, 12, 3, '120', 2, '200'),
(22, 13, 1, '2000', 1, '500'),
(24, 15, 3, '120', 12, '15'),
(25, 15, 1, '2000', 14, '12'),
(26, 8, 1, '2000', 12, '100'),
(27, 8, 3, '120', 14, '1200'),
(28, 13, 1, '2000', 1, '500'),
(29, 13, 3, '120', 10, '15'),
(30, 8, 1, '2000', 12, '100'),
(31, 8, 3, '120', 14, '1200'),
(32, 8, 1, '2000', 12, '100'),
(33, 8, 3, '120', 14, '1200'),
(36, 14, 3, '120', 10, '150'),
(37, 14, 1, '2000', 1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `bill_master`
--

CREATE TABLE `bill_master` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `grandamt` decimal(10,0) NOT NULL,
  `totalpaidamt` decimal(10,0) NOT NULL,
  `status` int(1) DEFAULT '1',
  `distributorid` int(11) NOT NULL,
  `branchid` int(11) NOT NULL,
  `bill_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_master`
--

INSERT INTO `bill_master` (`id`, `customerid`, `grandamt`, `totalpaidamt`, `status`, `distributorid`, `branchid`, `bill_date`) VALUES
(1, 6, '18000', '700', 1, 2, 3, '2019-07-02'),
(2, 3, '7800', '800', 1, 2, 3, '2019-07-02'),
(3, 4, '6000', '1650', 1, 2, 3, '2019-07-02'),
(4, 4, '5100', '1100', 0, 2, 3, '2019-07-02'),
(5, 3, '15300', '350', 1, 2, 3, '2019-07-02'),
(6, 1, '1500', '1220', 1, 2, 3, '2019-07-02'),
(7, 6, '1500', '300', 1, 2, 3, '2019-07-03'),
(8, 6, '51360', '2600', 1, 5, 1, '2019-07-15'),
(9, 7, '20000', '1500', 1, 1, 1, '2019-07-08'),
(10, 6, '15300', '170', 1, 2, 3, '2019-07-09'),
(11, 8, '4500', '800', 1, 2, 3, '2019-07-09'),
(12, 6, '2240', '320', 1, 5, 1, '2019-07-03'),
(13, 6, '3200', '515', 1, 5, 1, '2019-07-15'),
(14, 9, '3200', '160', 1, 5, 1, '2019-07-15'),
(15, 6, '29440', '27', 1, 5, 1, '2019-07-10');

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
  `status` int(1) NOT NULL DEFAULT '1',
  `bankname` varchar(100) NOT NULL,
  `bankbranchname` varchar(100) NOT NULL,
  `acno` varchar(50) NOT NULL,
  `zfsccode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_mastre`
--

INSERT INTO `branch_mastre` (`id`, `name`, `phone_no`, `b_city`, `address`, `con_name`, `con_email`, `con_phoneno`, `status`, `bankname`, `bankbranchname`, `acno`, `zfsccode`) VALUES
(1, 'ALLY SOFT SOLUTIONS', '123456', 'RAJKOT', 'rajkot', 'VIshal AKbari', 'vishal.rkcet@gmail.com', '9874563210', 1, 'boi', 'boi main', 'boi1215', '1'),
(2, 'CHANDRAPUR', '9850396382', 'RAJKOT', 'MADHUBAN PLAZA SHIVJI NAGAR', 'NIRAJ VARMA', 'varmaniraj.2829@gmail.com', '9975950950', 1, '', '', '', ''),
(3, 'NAGPUR', '9527031448', 'NAGPUR', 'PLOT NO. 95 SHRI HARI NAGAR-1 BESA ROAD MANEWADA SQUARE', 'GOPAL JEETENDRA MANDAL', 'krishnahlf76@gmail.com', '8459010929', 1, '', '', '', ''),
(4, 'ALLY SOFT SOLUTIONS', '9874656321', 'RAJKOT', 'Rajkot', 'VIshal AKbari', 'vishal.rkcet@gmail.com', '7896541230', 1, 'sbi', 'rajkot', 'icic2134', '123456');

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
  `branchid` int(11) NOT NULL,
  `narration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_matserdata`
--

INSERT INTO `customer_matserdata` (`id`, `customername`, `referenceno`, `address`, `pancard_no`, `phone_no`, `aadhar_no`, `category`, `gstinno`, `status`, `distributorid`, `branchid`, `narration`) VALUES
(1, 'Mohit', '101', 'Rajkot', '123456xyz', '9874563210', '0123456789', 2, 'gss101', 0, 2, 3, ''),
(2, 'Ajaz', '102', 'Rajkot', '123456', '992589631', '12345678901122', 3, 'gss102', 1, 2, 3, ''),
(3, 'Anil', '103', 'Rajkot', '123456', '9874563210', '12345678901122', 3, 'gss101', 1, 2, 3, ''),
(4, 'sagar', '105', 'rajkot', '123456', '9874563210', '78965412', 3, 'gss104', 1, 2, 3, ''),
(5, 'VISHESH GIRI', '101', 'rajkot', '123456', '9874563210', '12345678901122', 2, '101', 1, 2, 3, ''),
(6, 'ravi', '101', 'Rajkot', '12132', '9874563210', '101', 2, 'gss1011', 1, 1, 1, ''),
(7, 'palak', '101', 'rajkot', '123456', '9874563210', '12345678901122', 1, 'gss101', 1, 1, 1, ''),
(8, 'customer 1', '101', 'junagadh', '123456', '9874563210', '0123456789', 5, 'gss10123', 1, 2, 3, 'sdfcsdfdsfc sdadcsadfs'),
(9, 'Mohit123', '101', 'Rajkot', '123456', '101', '12345678901122', 3, 'gss101', 1, 1, 1, '');

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
  `status` int(1) NOT NULL DEFAULT '1',
  `disbankname` varchar(50) NOT NULL,
  `disbankbranchname` varchar(50) NOT NULL,
  `disacno` varchar(50) NOT NULL,
  `disifsccode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor_master`
--

INSERT INTO `distributor_master` (`id`, `userrole`, `distributor_name`, `dis_address`, `branchid`, `distributorcode`, `status`, `disbankname`, `disbankbranchname`, `disacno`, `disifsccode`) VALUES
(1, 'distributor', 'NIRAJ VARMA', 'MADHUBAN PLAZA SHIVAJI NAGAR', 1, 'dis001', 1, '', '', '', ''),
(2, 'distributor', 'SAMEER ANDANKAR', 'SAMADHI WARD', 3, 'dis0003', 1, '', '', '', ''),
(3, 'distributor', 'GOPAL MANDAL', 'PLOT NO. 95, SHRI HARI NAGAR, NAGPUR', 2, 'dis003', 0, '', '', '', ''),
(4, 'distributor', 'sagar', 'rajkot', 1, 'dis0003', 1, 'sbi', 'rajkot', 'icic2134', '14'),
(5, 'distributor', 'distributor12', 'rajkot', 1, 'sagar', 1, 'sbi', 'sadsd', 'asds', 'adss');

-- --------------------------------------------------------

--
-- Table structure for table `instraction_master`
--

CREATE TABLE `instraction_master` (
  `id` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `documentrequire` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instraction_master`
--

INSERT INTO `instraction_master` (`id`, `serviceid`, `documentrequire`, `status`) VALUES
(1, 4, 'asdsd dfddsd', 1),
(2, 4, 'asdsdsafsf dsfds', 0),
(3, 3, 'sdfsf', 1),
(4, 2, 'sdsfsf', 1),
(5, 1, 'sadsd', 1);

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
(5, 8, 'admin', '123456', 'admin', '', 1),
(9, 1, 'varmaniraj.2829', '	Niraj@123', 'distributor', 'dis001', 1),
(10, 2, 'sam123', 'Niraj@123', 'distributor', 'dis0003', 1),
(11, 3, 'admin', '123', 'distributor', 'dis003', 0),
(12, 4, 'sagar', '123456', 'distributor', 'dis0003', 1),
(13, 5, 'sagar123', 'sagar', 'distributor', 'sagar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_master`
--

CREATE TABLE `payment_master` (
  `id` int(11) NOT NULL,
  `e_no` int(11) NOT NULL,
  `e_date` date NOT NULL,
  `name` varchar(250) NOT NULL,
  `r_no` int(11) NOT NULL,
  `r_date` date NOT NULL,
  `type` varchar(250) NOT NULL,
  `agroup` varchar(250) NOT NULL,
  `payment` varchar(250) NOT NULL,
  `bankname` varchar(250) NOT NULL,
  `checkno` varchar(250) NOT NULL,
  `t_id` varchar(250) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `distributorid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `branchid` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_master`
--

INSERT INTO `payment_master` (`id`, `e_no`, `e_date`, `name`, `r_no`, `r_date`, `type`, `agroup`, `payment`, `bankname`, `checkno`, `t_id`, `amount`, `remark`, `distributorid`, `userid`, `branchid`, `status`) VALUES
(1, 10, '2019-07-08', '3', 1, '2019-07-08', 'return', '5', 'Cheque', '', '', '', '1500', 'for test', 0, 4, 0, 1),
(2, 121, '2019-07-08', '2', 12, '2019-07-08', '', '8', 'Cheque', '', '', '', '1000', 'asdad', 2, 2, 3, 0),
(3, 3, '2019-07-08', '3', 12, '2019-07-31', 'payment', '6', 'Cash', '', '', '', '1000', 'sdfs', 0, 4, 0, 1),
(4, 12, '2019-07-02', '6', 12, '2019-07-08', 'return', '5', 'Cash', '', '', '', '1200', 'sdfsd', 0, 4, 0, 1),
(5, 121, '2019-07-08', '2', 12, '2019-07-08', 'return', '8', 'Cheque', '', '', '', '1000', 'asdad', 2, 2, 3, 1),
(6, 12, '2019-07-08', '4', 12, '2019-07-08', 'return', '8', 'Cheque', '', '', '', '1000', 'sadsfs', 2, 2, 3, 1),
(7, 12, '2019-07-05', '6', 12, '2019-07-31', 'payment', '8', 'Cheque', '', '', '', '1350', 'asdad', 2, 2, 3, 1),
(8, 1, '2019-07-08', '6', 14, '2019-07-08', 'payment', '8', 'Cheque', '', '', '', '1000', 'for tetsing', 2, 2, 3, 1),
(9, 101, '2019-07-08', '6', 12, '2019-07-25', 'payment', '9', 'Cheque', '', '', '', '1000', 'for testing', 1, 1, 1, 1),
(10, 12, '2019-07-03', '6', 101, '2019-07-08', 'return', '9', 'Cheque', '', '', '', '1500', 'fop c', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_master`
--

CREATE TABLE `service_master` (
  `id` int(11) NOT NULL,
  `bramchid` int(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_master`
--

INSERT INTO `service_master` (`id`, `bramchid`, `s_name`, `amount`, `status`) VALUES
(1, 1, 'GST REGISTRATION', '2000', 1),
(2, 3, 'SOCIETY REGISTRATION - COMPLETE REGISTRATION', '1500', 1),
(3, 1, 'NGO REGISTRATION	', '120', 1),
(4, 3, 'CHANGE REPORT (BODY) - WRITING & DOCUMENTATION', '300', 1),
(5, 3, 'service2', '1500', 0),
(6, 2, 'service3', '1500', 0),
(7, 3, 'service45', '1223', 1),
(8, 4, 'GST RETURN - REGULAR', '12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_group`
--
ALTER TABLE `account_group`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `instraction_master`
--
ALTER TABLE `instraction_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_master`
--
ALTER TABLE `payment_master`
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
-- AUTO_INCREMENT for table `account_group`
--
ALTER TABLE `account_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bii_description`
--
ALTER TABLE `bii_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `bill_master`
--
ALTER TABLE `bill_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `branch_mastre`
--
ALTER TABLE `branch_mastre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_matserdata`
--
ALTER TABLE `customer_matserdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `distributor_master`
--
ALTER TABLE `distributor_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instraction_master`
--
ALTER TABLE `instraction_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_master`
--
ALTER TABLE `payment_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_master`
--
ALTER TABLE `service_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
