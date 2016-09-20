-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2016 at 11:01 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_offline_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `salereturn`
--

CREATE TABLE IF NOT EXISTS `salereturn` (
  `id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `bill_no` int(11) NOT NULL,
  `bill` text NOT NULL,
  `salreturn_amt` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salereturn`
--

INSERT INTO `salereturn` (`id`, `return_date`, `bill_no`, `bill`, `salreturn_amt`) VALUES
(3, '2016-06-02', 10, '{"ALZOLAM 0.5":{"productName":"ALZOLAM 0.5","quantity":"5","productRate":"7.63","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":"","return":2,"returnamt":"1.53"},"Parisutemam ":{"productName":"Parisutemam ","quantity":"4","productRate":"10","MRP":"10","batchNo":"","packSize":"4","expiryDate":"","manufacturer":"Ome","purchaseSize":"3","Tax":"2","shelf":"row","cost":"","return":0,"returnamt":""}}', 1.53),
(4, '2016-08-11', 10, '{"ALZOLAM 0.5":{"productName":"ALZOLAM 0.5","quantity":"5","productRate":"7.63","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":"","return":3,"returnamt":"1.53"},"Parisutemam ":{"productName":"Parisutemam ","quantity":"4","productRate":"10","MRP":"10","batchNo":"","packSize":"4","expiryDate":"","manufacturer":"Ome","purchaseSize":"3","Tax":"2","shelf":"row","cost":"","return":0,"returnamt":""}}', 1.53);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salereturn`
--
ALTER TABLE `salereturn`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salereturn`
--
ALTER TABLE `salereturn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
