-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2016 at 07:49 AM
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
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `acnt_id` int(11) NOT NULL,
  `acType` varchar(15) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `city` varchar(50) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `phone` bigint(20) NOT NULL,
  `debitLimit` float NOT NULL,
  `daysLimit` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `vat_tin_no` int(11) NOT NULL,
  `LBTNo` int(11) NOT NULL,
  `openingBalance` float NOT NULL,
  `CR_or_DR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `date_of_bill` date NOT NULL,
  `bill_number` int(11) NOT NULL,
  `store_location` varchar(50) COLLATE utf8_bin NOT NULL,
  `bill_content` text COLLATE utf8_bin NOT NULL,
  `grandTotal` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `customer_name`, `date_of_bill`, `bill_number`, `store_location`, `bill_content`, `grandTotal`) VALUES
(1, 'Abcd Xyz', '2015-08-16', 1, 'NAGPUR', '{"drugs_list_1":{"name":"tablet1","quantity":"12","total":"60"},"drugs_list_2":{"name":"Drug 2","quantity":"78","total":"546"}}', 606),
(2, 'Abcd Xyz', '2015-08-16', 2, 'NAGPUR', '{"drugs_list_1":{"name":"tablet1","quantity":"12","total":"60"},"drugs_list_2":{"name":"Drug 2","quantity":"78","total":"546"}}', 606),
(3, 'agsj', '2015-08-18', 3, 'NAGPUR', '{"drugs_list_1":{"name":"Drug 2","quantity":"8","total":"56"},"drugs_list_2":{"name":"tablet1","quantity":"8","total":"40"},"drugs_list_3":{"name":"Drug 3","quantity":"4","total":"84"}}', 180),
(4, 'ABCD ytqx', '2015-08-20', 4, 'NAGPUR', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 10","quantity":"500","total":"35000"}}', 35120),
(5, '', '2015-08-20', 5, '', '{"drugs_list_1":{"name":"Drug 10","quantity":"10","total":"700"},"drugs_list_2":{"name":"Drug 1","quantity":"6","total":"72"}}', 0),
(6, '', '2015-08-20', 6, '', '{"drugs_list_1":{"name":"Drug 1","quantity":"5","total":"60"},"drugs_list_2":{"name":"Drug 4","quantity":"18","total":"2250"}}', 0),
(7, '', '2015-08-24', 7, '', '{"drugs_list_1":{"name":"Drug 1","quantity":"60","total":"720"},"drugs_list_2":{"name":"Drug 3","quantity":"12","total":"252"},"drugs_list_3":{"name":"abcd","quantity":"08","total":"120"},"drugs_list_4":{"name":"tablet1","quantity":"25","total":"125"},"drugs_list_5":{"name":"Drug 10","quantity":"8","total":"560"}}', 0),
(8, '', '2015-08-24', 8, '', '{"drugs_list_1":{"name":"tablet1","quantity":"10","total":"50"},"drugs_list_2":{"name":"abcd","quantity":"12","total":"180"},"drugs_list_3":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(9, '', '2015-08-24', 9, '', '{"drugs_list_1":{"name":"abcd","quantity":"5","total":"75"},"drugs_list_2":{"name":"tablet1","quantity":"5","total":"25"}}', 0),
(10, '', '2015-08-24', 10, '', '{"drugs_list_1":{"name":"abcd","quantity":"5","total":"75"},"drugs_list_2":{"name":"tablet1","quantity":"5","total":"25"}}', 0),
(11, '', '2015-08-24', 11, '', '{"drugs_list_1":{"name":"abcd","quantity":"5","total":"75"},"drugs_list_2":{"name":"tablet1","quantity":"5","total":"25"}}', 0),
(12, '', '2015-08-25', 12, '', '{"drugs_list_1":{"name":"abcd","quantity":"5","total":"75"},"drugs_list_2":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_3":{"name":"Drug 2","quantity":"4","total":"28"}}', 0),
(13, '', '2015-08-25', 13, '', '{"drugs_list_1":{"name":"Drug 2","quantity":"10","total":"70"},"drugs_list_2":{"name":"Drug 3","quantity":"4","total":"84"}}', 0),
(14, '', '2015-08-25', 14, '', '{"drugs_list_1":{"name":"abcd","quantity":"5","total":"75"},"drugs_list_2":{"name":"Drug 1","quantity":"15","total":"180"}}', 0),
(15, '', '2015-08-25', 15, '', '{"drugs_list_1":{"name":"Drug 2","quantity":"05","total":"35"}}', 0),
(16, '', '2015-08-27', 16, '', '{"drugs_list_1":{"name":"Drug 3","quantity":"6","total":"126"}}', 0),
(17, '', '2015-08-27', 17, '', '{"drugs_list_1":{"name":"abcd","quantity":"5","total":"75"},"drugs_list_2":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(18, 'Customer 1', '2015-09-03', 18, 'Nagpur', '{"drugs_list_1":{"name":"tablet1","quantity":"15","total":"75"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(19, 'customer23', '2015-09-03', 19, 'Nagpur', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"5","total":"35"}}', 0),
(20, 'sdfwfsdf', '2015-09-03', 20, 'Nagpur', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(21, 'Customer12', '2015-09-04', 21, 'Nagpur', '{"drugs_list_1":{"name":"tablet1","quantity":"10","total":"50"},"drugs_list_2":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(22, 'Customer21', '2015-09-04', 22, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"15","total":"105"}}', 0),
(23, 'Custome1241', '2015-09-04', 23, 'Nagpur', '{"drugs_list_1":{"name":"abcd","quantity":"10","total":"150"},"drugs_list_2":{"name":"tablet1","quantity":"5","total":"25"}}', 0),
(24, 'Custome1231', '2015-09-04', 24, 'Nagpur', '{"drugs_list_1":{"name":"tablet1","quantity":"10","total":"50"},"drugs_list_2":{"name":"Drug 1","quantity":"15","total":"180"}}', 0),
(25, 'Custome2342', '2015-09-04', 25, 'Yavatmal', '{"drugs_list_1":{"name":"tablet1","quantity":"5","total":"25"},"drugs_list_2":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(26, '123asdljna', '2015-09-04', 26, 'Yavatmal', '{"drugs_list_1":{"name":"abcd","quantity":"10","total":"150"},"drugs_list_2":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(27, 'autasd', '2015-09-04', 27, 'Yavatmal', '{"drugs_list_1":{"name":"abcd","quantity":"15","total":"225"},"drugs_list_2":{"name":"tablet1","quantity":"010","total":"50"},"drugs_list_3":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(28, 'Cqokwndo1231', '2015-09-04', 28, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"15","total":"180"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(29, 'asdasd1561', '2015-09-04', 29, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"5","total":"60"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(30, 'ASnd12k1m', '2015-09-04', 30, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(31, 'asdak545', '2015-09-04', 31, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(32, 'asdja', '2015-09-04', 32, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(33, 'asdqwd', '2015-09-04', 33, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(34, 'asdqojw', '2015-09-04', 34, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(35, 'asdasdqw', '2015-09-04', 35, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"15","total":"180"},"drugs_list_2":{"name":"Drug 2","quantity":"16","total":"112"}}', 0),
(36, 'asdajdoqiw', '2015-09-04', 36, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"16","total":"192"},"drugs_list_2":{"name":"Drug 2","quantity":"18","total":"126"}}', 0),
(37, 'asdkjqow', '2015-09-04', 37, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"11","total":"77"}}', 0),
(38, 'Asndk', '2015-09-04', 38, 'Nagpur', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"15","total":"105"}}', 0),
(39, 'asdau', '2015-09-04', 39, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"15","total":"180"},"drugs_list_2":{"name":"abcd","quantity":"10","total":"150"}}', 0),
(40, 'asdkmak', '2015-09-04', 40, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(41, 'CustomerABCD', '2015-09-04', 41, 'Yavatmal', '{"drugs_list_1":{"name":"Drug 1","quantity":"10","total":"120"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(42, 'CustomerNAgpur', '2015-09-04', 42, 'Nagpur', '{"drugs_list_1":{"name":"Drug 1","quantity":"15","total":"180"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(43, 'CustomerNAgpur', '2015-09-04', 43, 'Nagpur', '{"drugs_list_1":{"name":"Drug 1","quantity":"15","total":"180"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0),
(44, 'gfdfgd', '2015-09-10', 44, 'Nagpur', '{"drugs_list_1":{"name":"abcd","quantity":"12","total":"180"},"drugs_list_2":{"name":"Drug 502","quantity":"2","total":"16064"}}', 0),
(45, 'asj', '2015-09-10', 45, 'Nagpur', '{"drugs_list_1":{"name":"tablet1","quantity":"10","total":"50"},"drugs_list_2":{"name":"Drug 1","quantity":"10","total":"120"}}', 0),
(46, 'aksmdkam', '2015-09-10', 46, 'Nagpur', '{"drugs_list_1":{"name":"Drug 1","quantity":"5","total":"60"},"drugs_list_2":{"name":"Drug 2","quantity":"10","total":"70"}}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productRate` int(11) NOT NULL,
  `MRP` varchar(255) NOT NULL,
  `batchNo` varchar(255) NOT NULL,
  `packSize` int(11) NOT NULL,
  `expiryDate` datetime NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `Tax` int(11) NOT NULL,
  `purchaseSize` int(11) NOT NULL,
  `shelf` varchar(255) NOT NULL,
  `Cost` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `$session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `productName`, `quantity`, `productRate`, `MRP`, `batchNo`, `packSize`, `expiryDate`, `manufacturer`, `Tax`, `purchaseSize`, `shelf`, `Cost`, `created`, `modified`, `$session_id`) VALUES
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(1, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(2, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(3, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(4, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4'),
(5, 'ALZOLAM 0.5', 0, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'r5qnu4bvedo6hm7v953o5os8j4');

-- --------------------------------------------------------

--
-- Table structure for table `company_name`
--

CREATE TABLE IF NOT EXISTS `company_name` (
  `id` int(11) NOT NULL,
  `abbreviation` varchar(10) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `company_name`
--

INSERT INTO `company_name` (`id`, `abbreviation`, `name`) VALUES
(1, 'WS', 'MFW');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `LBT Reg No` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `day Limit` int(11) NOT NULL,
  `open balance` varchar(255) NOT NULL,
  `bal_amt` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_address`, `phone_no`, `city`, `email`, `LBT Reg No`, `debit`, `day Limit`, `open balance`, `bal_amt`) VALUES
(1, 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'padmin_ed@yahoo.in', 456, 123, 78, 'S54', 0),
(3, 'Amit Sharma', 'Burdi', 845622421, 'Nagpur', 'amit_gmal@yahoo.in', 456, 789, 456, '78', 0),
(4, 'Preeti', 'gadgenagar', 2147483647, 'Nagpur', '', 0, 0, 0, '', 1),
(6, '', '', 0, '', '', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE IF NOT EXISTS `doctor_details` (
  `id` int(11) NOT NULL,
  `doctor_name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `qualification` varchar(256) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `doctor_no` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`id`, `doctor_name`, `address`, `city`, `qualification`, `reg_no`, `contact_no`, `doctor_no`, `created`, `modified`) VALUES
(1, 'Trupti', 'Â dcddfvf', '2', 'dsdsd', 123, 2147483647, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Priyanka sharma', 'burdi', 'Nagpur', 'Dentist', 123, 76653558, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_nagpur`
--

CREATE TABLE IF NOT EXISTS `inventory_nagpur` (
  `id` int(11) NOT NULL,
  `item` varchar(100) COLLATE utf8_bin NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '100',
  `rate` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `inventory_nagpur`
--

INSERT INTO `inventory_nagpur` (`id`, `item`, `quantity`, `rate`) VALUES
(1, 'abcd', 488, 15),
(2, 'tablet1', 990, 5),
(3, 'Drug 1', 4985, 12),
(4, 'Drug 2', 9655, 7),
(5, 'Drug 3', 9974, 21),
(6, 'Drug 4', 982, 125),
(7, 'Drug 5', 10000, 85),
(8, 'Drug 6', 10000, 48),
(9, 'Drug 7', 10000, 119),
(10, 'Drug 8', 10000, 200),
(11, 'Drug 9', 10000, 45),
(12, 'Drug 10', 9482, 70),
(13, 'Drug 11', 10000, 22),
(14, 'Drug 12', 10000, 192),
(15, 'Drug 13', 10000, 130),
(16, 'Drug 14', 10000, 350),
(17, 'Drug 15', 10000, 345),
(18, 'Drug 16', 10000, 144),
(19, 'Drug 17', 10000, 85),
(20, 'Drug 18', 10000, 270),
(21, 'Drug 19', 10000, 171),
(22, 'Drug 20', 10000, 440),
(23, 'Drug 21', 10000, 294),
(24, 'Drug 22', 10000, 286),
(25, 'Drug 23', 10000, 230),
(26, 'Drug 24', 10000, 504),
(27, 'Drug 25', 10000, 300),
(28, 'Drug 26', 10000, 78),
(29, 'Drug 27', 10000, 378),
(30, 'Drug 28', 10000, 504),
(31, 'Drug 29', 10000, 232),
(32, 'Drug 30', 10000, 630),
(33, 'Drug 31', 10000, 93),
(34, 'Drug 32', 10000, 224),
(35, 'Drug 33', 10000, 825),
(36, 'Drug 34', 10000, 476),
(37, 'Drug 35', 10000, 35),
(38, 'Drug 36', 10000, 612),
(39, 'Drug 37', 10000, 814),
(40, 'Drug 38', 10000, 684),
(41, 'Drug 39', 10000, 663),
(42, 'Drug 40', 10000, 40),
(43, 'Drug 41', 10000, 984),
(44, 'Drug 42', 10000, 798),
(45, 'Drug 43', 10000, 731),
(46, 'Drug 44', 10000, 396),
(47, 'Drug 45', 10000, 810),
(48, 'Drug 46', 10000, 690),
(49, 'Drug 47', 10000, 799),
(50, 'Drug 48', 10000, 1104),
(51, 'Drug 49', 10000, 196),
(52, 'Drug 50', 10000, 1250),
(53, 'Drug 51', 10000, 969),
(54, 'Drug 52', 10000, 884),
(55, 'Drug 53', 10000, 636),
(56, 'Drug 54', 10000, 216),
(57, 'Drug 55', 10000, 660),
(58, 'Drug 56', 10000, 1344),
(59, 'Drug 57', 10000, 399),
(60, 'Drug 58', 10000, 58),
(61, 'Drug 59', 10000, 944),
(62, 'Drug 60', 10000, 840),
(63, 'Drug 61', 10000, 1342),
(64, 'Drug 62', 10000, 1178),
(65, 'Drug 63', 10000, 1260),
(66, 'Drug 64', 10000, 1408),
(67, 'Drug 65', 10000, 520),
(68, 'Drug 66', 10000, 1386),
(69, 'Drug 67', 10000, 938),
(70, 'Drug 68', 10000, 272),
(71, 'Drug 69', 10000, 897),
(72, 'Drug 70', 10000, 350),
(73, 'Drug 71', 10000, 355),
(74, 'Drug 72', 10000, 864),
(75, 'Drug 73', 10000, 1679),
(76, 'Drug 74', 10000, 1628),
(77, 'Drug 75', 10000, 1500),
(78, 'Drug 76', 10000, 1140),
(79, 'Drug 77', 10000, 847),
(80, 'Drug 78', 10000, 858),
(81, 'Drug 79', 10000, 1027),
(82, 'Drug 80', 10000, 1120),
(83, 'Drug 81', 10000, 810),
(84, 'Drug 82', 10000, 492),
(85, 'Drug 83', 10000, 415),
(86, 'Drug 84', 10000, 1848),
(87, 'Drug 85', 10000, 850),
(88, 'Drug 86', 10000, 1462),
(89, 'Drug 87', 10000, 1827),
(90, 'Drug 88', 10000, 1408),
(91, 'Drug 89', 10000, 1513),
(92, 'Drug 90', 10000, 1080),
(93, 'Drug 91', 10000, 455),
(94, 'Drug 92', 10000, 1288),
(95, 'Drug 93', 10000, 465),
(96, 'Drug 94', 10000, 2350),
(97, 'Drug 95', 10000, 950),
(98, 'Drug 96', 10000, 1248),
(99, 'Drug 97', 10000, 1940),
(100, 'Drug 98', 10000, 2254),
(101, 'Drug 99', 10000, 1683),
(102, 'Drug 100', 10000, 800),
(103, 'Drug 101', 10000, 202),
(104, 'Drug 102', 10000, 2244),
(105, 'Drug 103', 10000, 1957),
(106, 'Drug 104', 10000, 2496),
(107, 'Drug 105', 10000, 1890),
(108, 'Drug 106', 10000, 1378),
(109, 'Drug 107', 10000, 1498),
(110, 'Drug 108', 10000, 324),
(111, 'Drug 109', 10000, 2507),
(112, 'Drug 110', 10000, 110),
(113, 'Drug 111', 10000, 1776),
(114, 'Drug 112', 10000, 896),
(115, 'Drug 113', 10000, 791),
(116, 'Drug 114', 10000, 2394),
(117, 'Drug 115', 10000, 575),
(118, 'Drug 116', 10000, 1856),
(119, 'Drug 117', 10000, 1521),
(120, 'Drug 118', 10000, 2950),
(121, 'Drug 119', 10000, 833),
(122, 'Drug 120', 10000, 600),
(123, 'Drug 121', 10000, 1331),
(124, 'Drug 122', 10000, 1464),
(125, 'Drug 123', 10000, 2214),
(126, 'Drug 124', 10000, 1984),
(127, 'Drug 125', 10000, 1500),
(128, 'Drug 126', 10000, 252),
(129, 'Drug 127', 10000, 381),
(130, 'Drug 128', 10000, 768),
(131, 'Drug 129', 10000, 3096),
(132, 'Drug 130', 10000, 2600),
(133, 'Drug 131', 10000, 1703),
(134, 'Drug 132', 10000, 132),
(135, 'Drug 133', 10000, 2128),
(136, 'Drug 134', 10000, 938),
(137, 'Drug 135', 10000, 3240),
(138, 'Drug 136', 10000, 1088),
(139, 'Drug 137', 10000, 2603),
(140, 'Drug 138', 10000, 1656),
(141, 'Drug 139', 10000, 1529),
(142, 'Drug 140', 10000, 2380),
(143, 'Drug 141', 10000, 1692),
(144, 'Drug 142', 10000, 284),
(145, 'Drug 143', 10000, 3432),
(146, 'Drug 144', 10000, 2592),
(147, 'Drug 145', 10000, 3190),
(148, 'Drug 146', 10000, 584),
(149, 'Drug 147', 10000, 1323),
(150, 'Drug 148', 10000, 1480),
(151, 'Drug 149', 10000, 447),
(152, 'Drug 150', 10000, 2400),
(153, 'Drug 151', 10000, 2114),
(154, 'Drug 152', 10000, 2128),
(155, 'Drug 153', 10000, 459),
(156, 'Drug 154', 10000, 924),
(157, 'Drug 155', 10000, 620),
(158, 'Drug 156', 10000, 2184),
(159, 'Drug 157', 10000, 1256),
(160, 'Drug 158', 10000, 1106),
(161, 'Drug 159', 10000, 3021),
(162, 'Drug 160', 10000, 1120),
(163, 'Drug 161', 10000, 161),
(164, 'Drug 162', 10000, 1134),
(165, 'Drug 163', 10000, 1141),
(166, 'Drug 164', 10000, 2788),
(167, 'Drug 165', 10000, 2310),
(168, 'Drug 166', 10000, 830),
(169, 'Drug 167', 10000, 4175),
(170, 'Drug 168', 10000, 1176),
(171, 'Drug 169', 10000, 2704),
(172, 'Drug 170', 10000, 1700),
(173, 'Drug 171', 10000, 3933),
(174, 'Drug 172', 10000, 516),
(175, 'Drug 173', 10000, 1903),
(176, 'Drug 174', 10000, 3828),
(177, 'Drug 175', 10000, 3675),
(178, 'Drug 176', 10000, 1408),
(179, 'Drug 177', 10000, 177),
(180, 'Drug 178', 10000, 890),
(181, 'Drug 179', 10000, 3222),
(182, 'Drug 180', 10000, 720),
(183, 'Drug 181', 10000, 3620),
(184, 'Drug 182', 10000, 1092),
(185, 'Drug 183', 10000, 3111),
(186, 'Drug 184', 10000, 4048),
(187, 'Drug 185', 10000, 2220),
(188, 'Drug 186', 10000, 3906),
(189, 'Drug 187', 10000, 1870),
(190, 'Drug 188', 10000, 3760),
(191, 'Drug 189', 10000, 567),
(192, 'Drug 190', 10000, 760),
(193, 'Drug 191', 10000, 191),
(194, 'Drug 192', 10000, 768),
(195, 'Drug 193', 10000, 2123),
(196, 'Drug 194', 10000, 1358),
(197, 'Drug 195', 10000, 3900),
(198, 'Drug 196', 10000, 4900),
(199, 'Drug 197', 10000, 2364),
(200, 'Drug 198', 10000, 3762),
(201, 'Drug 199', 10000, 1194),
(202, 'Drug 200', 10000, 600),
(203, 'Drug 201', 10000, 804),
(204, 'Drug 202', 10000, 808),
(205, 'Drug 203', 10000, 1015),
(206, 'Drug 204', 10000, 3060),
(207, 'Drug 205', 10000, 205),
(208, 'Drug 206', 10000, 206),
(209, 'Drug 207', 10000, 4554),
(210, 'Drug 208', 10000, 208),
(211, 'Drug 209', 10000, 1045),
(212, 'Drug 210', 10000, 2940),
(213, 'Drug 211', 10000, 844),
(214, 'Drug 212', 10000, 5300),
(215, 'Drug 213', 10000, 4260),
(216, 'Drug 214', 10000, 4494),
(217, 'Drug 215', 10000, 4730),
(218, 'Drug 216', 10000, 1512),
(219, 'Drug 217', 10000, 3472),
(220, 'Drug 218', 10000, 1526),
(221, 'Drug 219', 10000, 219),
(222, 'Drug 220', 10000, 4180),
(223, 'Drug 221', 10000, 2431),
(224, 'Drug 222', 10000, 444),
(225, 'Drug 223', 10000, 4906),
(226, 'Drug 224', 10000, 4928),
(227, 'Drug 225', 10000, 2025),
(228, 'Drug 226', 10000, 3842),
(229, 'Drug 227', 10000, 4767),
(230, 'Drug 228', 10000, 4560),
(231, 'Drug 229', 10000, 2519),
(232, 'Drug 230', 10000, 460),
(233, 'Drug 231', 10000, 5313),
(234, 'Drug 232', 10000, 3248),
(235, 'Drug 233', 10000, 1165),
(236, 'Drug 234', 10000, 702),
(237, 'Drug 235', 10000, 705),
(238, 'Drug 236', 10000, 1180),
(239, 'Drug 237', 10000, 711),
(240, 'Drug 238', 10000, 5950),
(241, 'Drug 239', 10000, 1434),
(242, 'Drug 240', 10000, 1920),
(243, 'Drug 241', 10000, 3133),
(244, 'Drug 242', 10000, 2178),
(245, 'Drug 243', 10000, 1944),
(246, 'Drug 244', 10000, 1952),
(247, 'Drug 245', 10000, 1225),
(248, 'Drug 246', 10000, 984),
(249, 'Drug 247', 10000, 3458),
(250, 'Drug 248', 10000, 4960),
(251, 'Drug 249', 10000, 2739),
(252, 'Drug 250', 10000, 3750),
(253, 'Drug 251', 10000, 3514),
(254, 'Drug 252', 10000, 5292),
(255, 'Drug 253', 10000, 4048),
(256, 'Drug 254', 10000, 2540),
(257, 'Drug 255', 10000, 4590),
(258, 'Drug 256', 10000, 6144),
(259, 'Drug 257', 10000, 514),
(260, 'Drug 258', 10000, 3354),
(261, 'Drug 259', 10000, 4921),
(262, 'Drug 260', 10000, 3120),
(263, 'Drug 261', 10000, 3654),
(264, 'Drug 262', 10000, 4192),
(265, 'Drug 263', 10000, 6575),
(266, 'Drug 264', 10000, 5016),
(267, 'Drug 265', 10000, 4770),
(268, 'Drug 266', 10000, 532),
(269, 'Drug 267', 10000, 6408),
(270, 'Drug 268', 10000, 5360),
(271, 'Drug 269', 10000, 269),
(272, 'Drug 270', 10000, 1080),
(273, 'Drug 271', 10000, 813),
(274, 'Drug 272', 10000, 3808),
(275, 'Drug 273', 10000, 3549),
(276, 'Drug 274', 10000, 2740),
(277, 'Drug 275', 10000, 6050),
(278, 'Drug 276', 10000, 4692),
(279, 'Drug 277', 10000, 3601),
(280, 'Drug 278', 10000, 3058),
(281, 'Drug 279', 10000, 3348),
(282, 'Drug 280', 10000, 6440),
(283, 'Drug 281', 10000, 281),
(284, 'Drug 282', 10000, 7050),
(285, 'Drug 283', 10000, 5377),
(286, 'Drug 284', 10000, 4544),
(287, 'Drug 285', 10000, 2850),
(288, 'Drug 286', 10000, 3146),
(289, 'Drug 287', 10000, 4305),
(290, 'Drug 288', 10000, 3168),
(291, 'Drug 289', 10000, 6936),
(292, 'Drug 290', 10000, 2320),
(293, 'Drug 291', 10000, 6693),
(294, 'Drug 292', 10000, 3796),
(295, 'Drug 293', 10000, 7032),
(296, 'Drug 294', 10000, 6468),
(297, 'Drug 295', 10000, 1770),
(298, 'Drug 296', 10000, 4736),
(299, 'Drug 297', 10000, 7128),
(300, 'Drug 298', 10000, 1192),
(301, 'Drug 299', 10000, 3289),
(302, 'Drug 300', 10000, 7500),
(303, 'Drug 301', 10000, 2408),
(304, 'Drug 302', 10000, 3926),
(305, 'Drug 303', 10000, 4242),
(306, 'Drug 304', 10000, 6080),
(307, 'Drug 305', 10000, 7015),
(308, 'Drug 306', 10000, 3366),
(309, 'Drug 307', 10000, 3377),
(310, 'Drug 308', 10000, 3080),
(311, 'Drug 309', 10000, 6489),
(312, 'Drug 310', 10000, 6820),
(313, 'Drug 311', 10000, 2488),
(314, 'Drug 312', 10000, 6552),
(315, 'Drug 313', 10000, 6886),
(316, 'Drug 314', 10000, 628),
(317, 'Drug 315', 10000, 3780),
(318, 'Drug 316', 10000, 1896),
(319, 'Drug 317', 10000, 3804),
(320, 'Drug 318', 10000, 636),
(321, 'Drug 319', 10000, 5423),
(322, 'Drug 320', 10000, 3520),
(323, 'Drug 321', 10000, 2889),
(324, 'Drug 322', 10000, 4508),
(325, 'Drug 323', 10000, 7429),
(326, 'Drug 324', 10000, 2592),
(327, 'Drug 325', 10000, 3575),
(328, 'Drug 326', 10000, 978),
(329, 'Drug 327', 10000, 7521),
(330, 'Drug 328', 10000, 2952),
(331, 'Drug 329', 10000, 2303),
(332, 'Drug 330', 10000, 2970),
(333, 'Drug 331', 10000, 2979),
(334, 'Drug 332', 10000, 4648),
(335, 'Drug 333', 10000, 7326),
(336, 'Drug 334', 10000, 7682),
(337, 'Drug 335', 10000, 3015),
(338, 'Drug 336', 10000, 6384),
(339, 'Drug 337', 10000, 2696),
(340, 'Drug 338', 10000, 6760),
(341, 'Drug 339', 10000, 1356),
(342, 'Drug 340', 10000, 1020),
(343, 'Drug 341', 10000, 5797),
(344, 'Drug 342', 10000, 4104),
(345, 'Drug 343', 10000, 8232),
(346, 'Drug 344', 10000, 4472),
(347, 'Drug 345', 10000, 4485),
(348, 'Drug 346', 10000, 3806),
(349, 'Drug 347', 10000, 6593),
(350, 'Drug 348', 10000, 8700),
(351, 'Drug 349', 10000, 4188),
(352, 'Drug 350', 10000, 3500),
(353, 'Drug 351', 10000, 3510),
(354, 'Drug 352', 10000, 7392),
(355, 'Drug 353', 10000, 8472),
(356, 'Drug 354', 10000, 2832),
(357, 'Drug 355', 10000, 1065),
(358, 'Drug 356', 10000, 3204),
(359, 'Drug 357', 10000, 3570),
(360, 'Drug 358', 10000, 358),
(361, 'Drug 359', 10000, 6462),
(362, 'Drug 360', 10000, 6120),
(363, 'Drug 361', 10000, 3249),
(364, 'Drug 362', 10000, 724),
(365, 'Drug 363', 10000, 2178),
(366, 'Drug 364', 10000, 2184),
(367, 'Drug 365', 10000, 8760),
(368, 'Drug 366', 10000, 5124),
(369, 'Drug 367', 10000, 9175),
(370, 'Drug 368', 10000, 2208),
(371, 'Drug 369', 10000, 2952),
(372, 'Drug 370', 10000, 1110),
(373, 'Drug 371', 10000, 3339),
(374, 'Drug 372', 10000, 8928),
(375, 'Drug 373', 10000, 5222),
(376, 'Drug 374', 10000, 2992),
(377, 'Drug 375', 10000, 4500),
(378, 'Drug 376', 10000, 752),
(379, 'Drug 377', 10000, 6786),
(380, 'Drug 378', 10000, 1890),
(381, 'Drug 379', 10000, 379),
(382, 'Drug 380', 10000, 1520),
(383, 'Drug 381', 10000, 5715),
(384, 'Drug 382', 10000, 4202),
(385, 'Drug 383', 10000, 9192),
(386, 'Drug 384', 10000, 5376),
(387, 'Drug 385', 10000, 6930),
(388, 'Drug 386', 10000, 772),
(389, 'Drug 387', 10000, 8514),
(390, 'Drug 388', 10000, 1164),
(391, 'Drug 389', 10000, 778),
(392, 'Drug 390', 10000, 5850),
(393, 'Drug 391', 10000, 7820),
(394, 'Drug 392', 10000, 4312),
(395, 'Drug 393', 10000, 6681),
(396, 'Drug 394', 10000, 9850),
(397, 'Drug 395', 10000, 6320),
(398, 'Drug 396', 10000, 5940),
(399, 'Drug 397', 10000, 5558),
(400, 'Drug 398', 10000, 5970),
(401, 'Drug 399', 10000, 8379),
(402, 'Drug 400', 10000, 8800),
(403, 'Drug 401', 10000, 7218),
(404, 'Drug 402', 10000, 2010),
(405, 'Drug 403', 10000, 8463),
(406, 'Drug 404', 10000, 2828),
(407, 'Drug 405', 10000, 4860),
(408, 'Drug 406', 10000, 2842),
(409, 'Drug 407', 10000, 3256),
(410, 'Drug 408', 10000, 2040),
(411, 'Drug 409', 10000, 4908),
(412, 'Drug 410', 10000, 3690),
(413, 'Drug 411', 10000, 3699),
(414, 'Drug 412', 10000, 412),
(415, 'Drug 413', 10000, 8260),
(416, 'Drug 414', 10000, 3312),
(417, 'Drug 415', 10000, 5810),
(418, 'Drug 416', 10000, 5408),
(419, 'Drug 417', 10000, 3753),
(420, 'Drug 418', 10000, 4598),
(421, 'Drug 419', 10000, 6285),
(422, 'Drug 420', 10000, 4200),
(423, 'Drug 421', 10000, 421),
(424, 'Drug 422', 10000, 4220),
(425, 'Drug 423', 10000, 8883),
(426, 'Drug 424', 10000, 7208),
(427, 'Drug 425', 10000, 3825),
(428, 'Drug 426', 10000, 5112),
(429, 'Drug 427', 10000, 2989),
(430, 'Drug 428', 10000, 9844),
(431, 'Drug 429', 10000, 429),
(432, 'Drug 430', 10000, 1290),
(433, 'Drug 431', 10000, 8189),
(434, 'Drug 432', 10000, 8208),
(435, 'Drug 433', 10000, 3031),
(436, 'Drug 434', 10000, 6076),
(437, 'Drug 435', 10000, 10875),
(438, 'Drug 436', 10000, 8284),
(439, 'Drug 437', 10000, 8740),
(440, 'Drug 438', 10000, 3504),
(441, 'Drug 439', 10000, 10536),
(442, 'Drug 440', 10000, 2640),
(443, 'Drug 441', 10000, 7056),
(444, 'Drug 442', 10000, 3094),
(445, 'Drug 443', 10000, 3101),
(446, 'Drug 444', 10000, 4440),
(447, 'Drug 445', 10000, 6230),
(448, 'Drug 446', 10000, 9366),
(449, 'Drug 447', 10000, 9834),
(450, 'Drug 448', 10000, 9856),
(451, 'Drug 449', 10000, 3143),
(452, 'Drug 450', 10000, 5400),
(453, 'Drug 451', 10000, 3157),
(454, 'Drug 452', 10000, 3164),
(455, 'Drug 453', 10000, 9513),
(456, 'Drug 454', 10000, 908),
(457, 'Drug 455', 10000, 10920),
(458, 'Drug 456', 10000, 2280),
(459, 'Drug 457', 10000, 5941),
(460, 'Drug 458', 10000, 2748),
(461, 'Drug 459', 10000, 918),
(462, 'Drug 460', 10000, 6440),
(463, 'Drug 461', 10000, 3688),
(464, 'Drug 462', 10000, 9702),
(465, 'Drug 463', 10000, 3241),
(466, 'Drug 464', 10000, 6960),
(467, 'Drug 465', 10000, 4185),
(468, 'Drug 466', 10000, 3262),
(469, 'Drug 467', 10000, 3736),
(470, 'Drug 468', 10000, 1872),
(471, 'Drug 469', 10000, 6566),
(472, 'Drug 470', 10000, 2820),
(473, 'Drug 471', 10000, 4710),
(474, 'Drug 472', 10000, 2360),
(475, 'Drug 473', 10000, 5676),
(476, 'Drug 474', 10000, 8058),
(477, 'Drug 475', 10000, 6650),
(478, 'Drug 476', 10000, 476),
(479, 'Drug 477', 10000, 5724),
(480, 'Drug 478', 10000, 5258),
(481, 'Drug 479', 10000, 10538),
(482, 'Drug 480', 10000, 8640),
(483, 'Drug 481', 10000, 11063),
(484, 'Drug 482', 10000, 1928),
(485, 'Drug 483', 10000, 12075),
(486, 'Drug 484', 10000, 9196),
(487, 'Drug 485', 10000, 2425),
(488, 'Drug 486', 10000, 11664),
(489, 'Drug 487', 10000, 11201),
(490, 'Drug 488', 10000, 8296),
(491, 'Drug 489', 10000, 1956),
(492, 'Drug 490', 10000, 12250),
(493, 'Drug 491', 10000, 2946),
(494, 'Drug 492', 10000, 5904),
(495, 'Drug 493', 10000, 9860),
(496, 'Drug 494', 10000, 6422),
(497, 'Drug 495', 10000, 495),
(498, 'Drug 496', 10000, 1984),
(499, 'Drug 497', 10000, 9443),
(500, 'Drug 498', 10000, 4482),
(501, 'Drug 499', 10000, 3493),
(502, 'Drug 500', 10000, 3500),
(503, 'Drug 501', 10000, 7014),
(504, 'Drug 502', 9998, 8032),
(505, 'Drug 503', 10000, 5533),
(506, 'Drug 504', 10000, 504),
(507, 'Drug 505', 10000, 3535),
(508, 'Drug 506', 10000, 12650),
(509, 'Drug 507', 10000, 1014),
(510, 'Drug 508', 10000, 9652),
(511, 'Drug 509', 10000, 5599),
(512, 'Drug 510', 10000, 11730),
(513, 'Drug 511', 10000, 6132),
(514, 'Drug 512', 10000, 4096),
(515, 'Drug 513', 10000, 513),
(516, 'Drug 514', 10000, 6168),
(517, 'Drug 515', 10000, 515),
(518, 'Drug 516', 10000, 3096),
(519, 'Drug 517', 10000, 5170),
(520, 'Drug 518', 10000, 12432),
(521, 'Drug 519', 10000, 11937),
(522, 'Drug 520', 10000, 7280),
(523, 'Drug 521', 10000, 11983),
(524, 'Drug 522', 10000, 1566),
(525, 'Drug 523', 10000, 523),
(526, 'Drug 524', 10000, 9432),
(527, 'Drug 525', 10000, 7875),
(528, 'Drug 526', 10000, 526),
(529, 'Drug 527', 10000, 11067),
(530, 'Drug 528', 10000, 4752),
(531, 'Drug 529', 10000, 4761),
(532, 'Drug 530', 10000, 1060),
(533, 'Drug 531', 10000, 7965),
(534, 'Drug 532', 10000, 12236),
(535, 'Drug 533', 10000, 9594),
(536, 'Drug 534', 10000, 534),
(537, 'Drug 535', 10000, 12840),
(538, 'Drug 536', 10000, 13400),
(539, 'Drug 537', 10000, 537),
(540, 'Drug 538', 10000, 13450),
(541, 'Drug 539', 10000, 10241),
(542, 'Drug 540', 10000, 6480),
(543, 'Drug 541', 10000, 12443),
(544, 'Drug 542', 10000, 2710),
(545, 'Drug 543', 10000, 10317),
(546, 'Drug 544', 10000, 13056),
(547, 'Drug 545', 10000, 8720),
(548, 'Drug 546', 10000, 10920),
(549, 'Drug 547', 10000, 2188),
(550, 'Drug 548', 10000, 548),
(551, 'Drug 549', 10000, 10431),
(552, 'Drug 550', 10000, 550),
(553, 'Drug 551', 10000, 8265),
(554, 'Drug 552', 10000, 9384),
(555, 'Drug 553', 10000, 2212),
(556, 'Drug 554', 10000, 8310),
(557, 'Drug 555', 10000, 4995),
(558, 'Drug 556', 10000, 10564),
(559, 'Drug 557', 10000, 8355),
(560, 'Drug 558', 10000, 2790),
(561, 'Drug 559', 10000, 1118),
(562, 'Drug 560', 10000, 13440),
(563, 'Drug 561', 10000, 3927),
(564, 'Drug 562', 10000, 9554),
(565, 'Drug 563', 10000, 12386),
(566, 'Drug 564', 10000, 14100),
(567, 'Drug 565', 10000, 9605),
(568, 'Drug 566', 10000, 11886),
(569, 'Drug 567', 10000, 13608),
(570, 'Drug 568', 10000, 10224),
(571, 'Drug 569', 10000, 11380),
(572, 'Drug 570', 10000, 10260),
(573, 'Drug 571', 10000, 2284),
(574, 'Drug 572', 10000, 10296),
(575, 'Drug 573', 10000, 12606),
(576, 'Drug 574', 10000, 13202),
(577, 'Drug 575', 10000, 9200),
(578, 'Drug 576', 10000, 7488),
(579, 'Drug 577', 10000, 10386),
(580, 'Drug 578', 10000, 11560),
(581, 'Drug 579', 10000, 7527),
(582, 'Drug 580', 10000, 6380),
(583, 'Drug 581', 10000, 12201),
(584, 'Drug 582', 10000, 1164),
(585, 'Drug 583', 10000, 1749),
(586, 'Drug 584', 10000, 14016),
(587, 'Drug 585', 10000, 9945),
(588, 'Drug 586', 10000, 6446),
(589, 'Drug 587', 10000, 9979),
(590, 'Drug 588', 10000, 4116),
(591, 'Drug 589', 10000, 9424),
(592, 'Drug 590', 10000, 10620),
(593, 'Drug 591', 10000, 2955),
(594, 'Drug 592', 10000, 13024),
(595, 'Drug 593', 10000, 5930),
(596, 'Drug 594', 10000, 1188),
(597, 'Drug 595', 10000, 12495),
(598, 'Drug 596', 10000, 596),
(599, 'Drug 597', 10000, 13134),
(600, 'Drug 598', 10000, 11960),
(601, 'Drug 599', 10000, 11381),
(602, 'Drug 600', 10000, 10200),
(603, 'Drug 601', 10000, 7212),
(604, 'Drug 602', 10000, 13846),
(605, 'Drug 603', 10000, 5427),
(606, 'Drug 604', 10000, 4832),
(607, 'Drug 605', 10000, 12100),
(608, 'Drug 606', 10000, 15150),
(609, 'Drug 607', 10000, 12747),
(610, 'Drug 608', 10000, 7904),
(611, 'Drug 609', 10000, 11571),
(612, 'Drug 610', 10000, 5490),
(613, 'Drug 611', 10000, 14664),
(614, 'Drug 612', 10000, 9180),
(615, 'Drug 613', 10000, 6743),
(616, 'Drug 614', 10000, 614),
(617, 'Drug 615', 10000, 7995),
(618, 'Drug 616', 10000, 1232),
(619, 'Drug 617', 10000, 7404),
(620, 'Drug 618', 10000, 3090),
(621, 'Drug 619', 10000, 4952),
(622, 'Drug 620', 10000, 1240),
(623, 'Drug 621', 10000, 14283),
(624, 'Drug 622', 10000, 8086),
(625, 'Drug 623', 10000, 14329),
(626, 'Drug 624', 10000, 4368),
(627, 'Drug 625', 10000, 8750),
(628, 'Drug 626', 10000, 11894),
(629, 'Drug 627', 10000, 5016),
(630, 'Drug 628', 10000, 6280),
(631, 'Drug 629', 10000, 8177),
(632, 'Drug 630', 10000, 1260),
(633, 'Drug 631', 10000, 1262),
(634, 'Drug 632', 10000, 15168),
(635, 'Drug 633', 10000, 15192),
(636, 'Drug 634', 10000, 6340),
(637, 'Drug 635', 10000, 4445),
(638, 'Drug 636', 10000, 12084),
(639, 'Drug 637', 10000, 5733),
(640, 'Drug 638', 10000, 1276),
(641, 'Drug 639', 10000, 3834),
(642, 'Drug 640', 10000, 1920),
(643, 'Drug 641', 10000, 6410),
(644, 'Drug 642', 10000, 2568),
(645, 'Drug 643', 10000, 10931),
(646, 'Drug 644', 10000, 12880),
(647, 'Drug 645', 10000, 2580),
(648, 'Drug 646', 10000, 3230),
(649, 'Drug 647', 10000, 14234),
(650, 'Drug 648', 10000, 10368),
(651, 'Drug 649', 10000, 6490),
(652, 'Drug 650', 10000, 2600),
(653, 'Drug 651', 10000, 11067),
(654, 'Drug 652', 10000, 5216),
(655, 'Drug 653', 10000, 10448),
(656, 'Drug 654', 10000, 9810),
(657, 'Drug 655', 10000, 9825),
(658, 'Drug 656', 10000, 2624),
(659, 'Drug 657', 10000, 5256),
(660, 'Drug 658', 10000, 14476),
(661, 'Drug 659', 10000, 9226),
(662, 'Drug 660', 10000, 13200),
(663, 'Drug 661', 10000, 15864),
(664, 'Drug 662', 10000, 9930),
(665, 'Drug 663', 10000, 11934),
(666, 'Drug 664', 10000, 14608),
(667, 'Drug 665', 10000, 16625),
(668, 'Drug 666', 10000, 16650),
(669, 'Drug 667', 10000, 10672),
(670, 'Drug 668', 10000, 6012),
(671, 'Drug 669', 10000, 669),
(672, 'Drug 670', 10000, 14070),
(673, 'Drug 671', 10000, 7381),
(674, 'Drug 672', 10000, 7392),
(675, 'Drug 673', 10000, 16825),
(676, 'Drug 674', 10000, 2022),
(677, 'Drug 675', 10000, 4050),
(678, 'Drug 676', 10000, 2704),
(679, 'Drug 677', 10000, 5416),
(680, 'Drug 678', 10000, 1356),
(681, 'Drug 679', 10000, 12901),
(682, 'Drug 680', 10000, 11560),
(683, 'Drug 681', 10000, 3405),
(684, 'Drug 682', 10000, 6820),
(685, 'Drug 683', 10000, 16392),
(686, 'Drug 684', 10000, 13680),
(687, 'Drug 685', 10000, 16440),
(688, 'Drug 686', 10000, 8918),
(689, 'Drug 687', 10000, 16488),
(690, 'Drug 688', 10000, 4128),
(691, 'Drug 689', 10000, 6890),
(692, 'Drug 690', 10000, 8970),
(693, 'Drug 691', 10000, 691),
(694, 'Drug 692', 10000, 6228),
(695, 'Drug 693', 10000, 2079),
(696, 'Drug 694', 10000, 12492),
(697, 'Drug 695', 10000, 3475),
(698, 'Drug 696', 10000, 2088),
(699, 'Drug 697', 10000, 11849),
(700, 'Drug 698', 10000, 13960),
(701, 'Drug 699', 10000, 7689),
(702, 'Drug 700', 10000, 12600),
(703, 'Drug 701', 10000, 11216),
(704, 'Drug 702', 10000, 15444),
(705, 'Drug 703', 10000, 2812),
(706, 'Drug 704', 10000, 10560),
(707, 'Drug 705', 10000, 16920),
(708, 'Drug 706', 10000, 6354),
(709, 'Drug 707', 10000, 12726),
(710, 'Drug 708', 10000, 4248),
(711, 'Drug 709', 10000, 7090),
(712, 'Drug 710', 10000, 8520),
(713, 'Drug 711', 10000, 16353),
(714, 'Drug 712', 10000, 10680),
(715, 'Drug 713', 10000, 14973),
(716, 'Drug 714', 10000, 14994),
(717, 'Drug 715', 10000, 7150),
(718, 'Drug 716', 10000, 14320),
(719, 'Drug 717', 10000, 6453),
(720, 'Drug 718', 10000, 5744),
(721, 'Drug 719', 10000, 719),
(722, 'Drug 720', 10000, 13680),
(723, 'Drug 721', 10000, 15141),
(724, 'Drug 722', 10000, 722),
(725, 'Drug 723', 10000, 1446),
(726, 'Drug 724', 10000, 16652),
(727, 'Drug 725', 10000, 13050),
(728, 'Drug 726', 10000, 5082),
(729, 'Drug 727', 10000, 727),
(730, 'Drug 728', 10000, 7280),
(731, 'Drug 729', 10000, 1458),
(732, 'Drug 730', 10000, 8030),
(733, 'Drug 731', 10000, 2193),
(734, 'Drug 732', 10000, 13176),
(735, 'Drug 733', 10000, 5131),
(736, 'Drug 734', 10000, 4404),
(737, 'Drug 735', 10000, 5145),
(738, 'Drug 736', 10000, 4416),
(739, 'Drug 737', 10000, 10318),
(740, 'Drug 738', 10000, 18450),
(741, 'Drug 739', 10000, 8868),
(742, 'Drug 740', 10000, 17760),
(743, 'Drug 741', 10000, 8151),
(744, 'Drug 742', 10000, 6678),
(745, 'Drug 743', 10000, 9659),
(746, 'Drug 744', 10000, 5208),
(747, 'Drug 745', 10000, 3725),
(748, 'Drug 746', 10000, 16412),
(749, 'Drug 747', 10000, 747),
(750, 'Drug 748', 10000, 10472),
(751, 'Drug 749', 10000, 3745),
(752, 'Drug 750', 10000, 750),
(753, 'Drug 751', 10000, 6008),
(754, 'Drug 752', 10000, 18800),
(755, 'Drug 753', 10000, 753),
(756, 'Drug 754', 10000, 7540),
(757, 'Drug 755', 10000, 17365),
(758, 'Drug 756', 10000, 14364),
(759, 'Drug 757', 10000, 12869),
(760, 'Drug 758', 10000, 17434),
(761, 'Drug 759', 10000, 3036),
(762, 'Drug 760', 10000, 13680),
(763, 'Drug 761', 10000, 6849),
(764, 'Drug 762', 10000, 5334),
(765, 'Drug 763', 10000, 8393),
(766, 'Drug 764', 10000, 12224),
(767, 'Drug 765', 10000, 9180),
(768, 'Drug 766', 10000, 13022),
(769, 'Drug 767', 10000, 16107),
(770, 'Drug 768', 10000, 768),
(771, 'Drug 769', 10000, 13073),
(772, 'Drug 770', 10000, 6160),
(773, 'Drug 771', 10000, 19275),
(774, 'Drug 772', 10000, 2316),
(775, 'Drug 773', 10000, 12368),
(776, 'Drug 774', 10000, 9288),
(777, 'Drug 775', 10000, 6975),
(778, 'Drug 776', 10000, 16296),
(779, 'Drug 777', 10000, 6993),
(780, 'Drug 778', 10000, 7780),
(781, 'Drug 779', 10000, 7790),
(782, 'Drug 780', 10000, 10920),
(783, 'Drug 781', 10000, 7810),
(784, 'Drug 782', 10000, 13294),
(785, 'Drug 783', 10000, 10962),
(786, 'Drug 784', 10000, 8624),
(787, 'Drug 785', 10000, 785),
(788, 'Drug 786', 10000, 9432),
(789, 'Drug 787', 10000, 3935),
(790, 'Drug 788', 10000, 13396),
(791, 'Drug 789', 10000, 7101),
(792, 'Drug 790', 10000, 7110),
(793, 'Drug 791', 10000, 7910),
(794, 'Drug 792', 10000, 14256),
(795, 'Drug 793', 10000, 11895),
(796, 'Drug 794', 10000, 15880),
(797, 'Drug 795', 10000, 6360),
(798, 'Drug 796', 10000, 1592),
(799, 'Drug 797', 10000, 9564),
(800, 'Drug 798', 10000, 3192),
(801, 'Drug 799', 10000, 2397),
(802, 'Drug 800', 10000, 3200),
(803, 'Drug 801', 10000, 8811),
(804, 'Drug 802', 10000, 1604),
(805, 'Drug 803', 10000, 4818),
(806, 'Drug 804', 10000, 1608),
(807, 'Drug 805', 10000, 11270),
(808, 'Drug 806', 10000, 12090),
(809, 'Drug 807', 10000, 17754),
(810, 'Drug 808', 10000, 18584),
(811, 'Drug 809', 10000, 19416),
(812, 'Drug 810', 10000, 4860),
(813, 'Drug 811', 10000, 8921),
(814, 'Drug 812', 10000, 7308),
(815, 'Drug 813', 10000, 18699),
(816, 'Drug 814', 10000, 19536),
(817, 'Drug 815', 10000, 16300),
(818, 'Drug 816', 10000, 18768),
(819, 'Drug 817', 10000, 8170),
(820, 'Drug 818', 10000, 19632),
(821, 'Drug 819', 10000, 12285),
(822, 'Drug 820', 10000, 15580),
(823, 'Drug 821', 10000, 6568),
(824, 'Drug 822', 10000, 20550),
(825, 'Drug 823', 10000, 9053),
(826, 'Drug 824', 10000, 18128),
(827, 'Drug 825', 10000, 15675),
(828, 'Drug 826', 10000, 15694),
(829, 'Drug 827', 10000, 19848),
(830, 'Drug 828', 10000, 4968),
(831, 'Drug 829', 10000, 18238),
(832, 'Drug 830', 10000, 830),
(833, 'Drug 831', 10000, 7479),
(834, 'Drug 832', 10000, 6656),
(835, 'Drug 833', 10000, 2499),
(836, 'Drug 834', 10000, 11676),
(837, 'Drug 835', 10000, 7515),
(838, 'Drug 836', 10000, 13376),
(839, 'Drug 837', 10000, 2511),
(840, 'Drug 838', 10000, 5028),
(841, 'Drug 839', 10000, 11746),
(842, 'Drug 840', 10000, 840),
(843, 'Drug 841', 10000, 10092),
(844, 'Drug 842', 10000, 20208),
(845, 'Drug 843', 10000, 8430),
(846, 'Drug 844', 10000, 7596),
(847, 'Drug 845', 10000, 19435),
(848, 'Drug 846', 10000, 3384),
(849, 'Drug 847', 10000, 5929),
(850, 'Drug 848', 10000, 5936),
(851, 'Drug 849', 10000, 2547),
(852, 'Drug 850', 10000, 18700),
(853, 'Drug 851', 10000, 851),
(854, 'Drug 852', 10000, 8520),
(855, 'Drug 853', 10000, 17913),
(856, 'Drug 854', 10000, 10248),
(857, 'Drug 855', 10000, 5130),
(858, 'Drug 856', 10000, 11984),
(859, 'Drug 857', 10000, 4285),
(860, 'Drug 858', 10000, 4290),
(861, 'Drug 859', 10000, 17180),
(862, 'Drug 860', 10000, 1720),
(863, 'Drug 861', 10000, 4305),
(864, 'Drug 862', 10000, 2586),
(865, 'Drug 863', 10000, 7767),
(866, 'Drug 864', 10000, 6048),
(867, 'Drug 865', 10000, 13840),
(868, 'Drug 866', 10000, 14722),
(869, 'Drug 867', 10000, 19941),
(870, 'Drug 868', 10000, 16492),
(871, 'Drug 869', 10000, 19118),
(872, 'Drug 870', 10000, 9570),
(873, 'Drug 871', 10000, 17420),
(874, 'Drug 872', 10000, 7848),
(875, 'Drug 873', 10000, 8730),
(876, 'Drug 874', 10000, 3496),
(877, 'Drug 875', 10000, 14875),
(878, 'Drug 876', 10000, 6132),
(879, 'Drug 877', 10000, 6139),
(880, 'Drug 878', 10000, 21072),
(881, 'Drug 879', 10000, 12306),
(882, 'Drug 880', 10000, 7920),
(883, 'Drug 881', 10000, 17620),
(884, 'Drug 882', 10000, 12348),
(885, 'Drug 883', 10000, 16777),
(886, 'Drug 884', 10000, 14144),
(887, 'Drug 885', 10000, 22125),
(888, 'Drug 886', 10000, 22150),
(889, 'Drug 887', 10000, 3548),
(890, 'Drug 888', 10000, 3552),
(891, 'Drug 889', 10000, 3556),
(892, 'Drug 890', 10000, 21360),
(893, 'Drug 891', 10000, 5346),
(894, 'Drug 892', 10000, 7136),
(895, 'Drug 893', 10000, 893),
(896, 'Drug 894', 10000, 12516),
(897, 'Drug 895', 10000, 13425),
(898, 'Drug 896', 10000, 15232),
(899, 'Drug 897', 10000, 4485),
(900, 'Drug 898', 10000, 11674),
(901, 'Drug 899', 10000, 8990),
(902, 'Drug 900', 10000, 1800),
(903, 'Drug 901', 10000, 21624),
(904, 'Drug 902', 10000, 3608),
(905, 'Drug 903', 10000, 9933),
(906, 'Drug 904', 10000, 7232),
(907, 'Drug 905', 10000, 6335),
(908, 'Drug 906', 10000, 1812),
(909, 'Drug 907', 10000, 13605),
(910, 'Drug 908', 10000, 12712),
(911, 'Drug 909', 10000, 909),
(912, 'Drug 910', 10000, 2730),
(913, 'Drug 911', 10000, 20953),
(914, 'Drug 912', 10000, 19152),
(915, 'Drug 913', 10000, 15521),
(916, 'Drug 914', 10000, 14624),
(917, 'Drug 915', 10000, 10065),
(918, 'Drug 916', 10000, 15572),
(919, 'Drug 917', 10000, 13755),
(920, 'Drug 918', 10000, 13770),
(921, 'Drug 919', 10000, 19299),
(922, 'Drug 920', 10000, 17480),
(923, 'Drug 921', 10000, 11973),
(924, 'Drug 922', 10000, 922),
(925, 'Drug 923', 10000, 1846),
(926, 'Drug 924', 10000, 12012),
(927, 'Drug 925', 10000, 12950),
(928, 'Drug 926', 10000, 14816),
(929, 'Drug 927', 10000, 3708),
(930, 'Drug 928', 10000, 17632),
(931, 'Drug 929', 10000, 3716),
(932, 'Drug 930', 10000, 12090),
(933, 'Drug 931', 10000, 18620),
(934, 'Drug 932', 10000, 1864),
(935, 'Drug 933', 10000, 15861),
(936, 'Drug 934', 10000, 5604),
(937, 'Drug 935', 10000, 9350),
(938, 'Drug 936', 10000, 22464),
(939, 'Drug 937', 10000, 6559),
(940, 'Drug 938', 10000, 23450),
(941, 'Drug 939', 10000, 12207),
(942, 'Drug 940', 10000, 7520),
(943, 'Drug 941', 10000, 2823),
(944, 'Drug 942', 10000, 9420),
(945, 'Drug 943', 10000, 2829),
(946, 'Drug 944', 10000, 17936),
(947, 'Drug 945', 10000, 945),
(948, 'Drug 946', 10000, 12298),
(949, 'Drug 947', 10000, 9470),
(950, 'Drug 948', 10000, 15168),
(951, 'Drug 949', 10000, 1898),
(952, 'Drug 950', 10000, 4750),
(953, 'Drug 951', 10000, 8559),
(954, 'Drug 952', 10000, 13328),
(955, 'Drug 953', 10000, 4765),
(956, 'Drug 954', 10000, 9540),
(957, 'Drug 955', 10000, 955),
(958, 'Drug 956', 10000, 17208),
(959, 'Drug 957', 10000, 23925),
(960, 'Drug 958', 10000, 4790),
(961, 'Drug 959', 10000, 11508),
(962, 'Drug 960', 10000, 3840),
(963, 'Drug 961', 10000, 16337),
(964, 'Drug 962', 10000, 6734),
(965, 'Drug 963', 10000, 4815),
(966, 'Drug 964', 10000, 8676),
(967, 'Drug 965', 10000, 11580),
(968, 'Drug 966', 10000, 14490),
(969, 'Drug 967', 10000, 6769),
(970, 'Drug 968', 10000, 17424),
(971, 'Drug 969', 10000, 13566),
(972, 'Drug 970', 10000, 18430),
(973, 'Drug 971', 10000, 971),
(974, 'Drug 972', 10000, 15552),
(975, 'Drug 973', 10000, 3892),
(976, 'Drug 974', 10000, 2922),
(977, 'Drug 975', 10000, 9750),
(978, 'Drug 976', 10000, 3904),
(979, 'Drug 977', 10000, 14655),
(980, 'Drug 978', 10000, 18582),
(981, 'Drug 979', 10000, 18601),
(982, 'Drug 980', 10000, 15680),
(983, 'Drug 981', 10000, 23544),
(984, 'Drug 982', 10000, 1964),
(985, 'Drug 983', 10000, 4915),
(986, 'Drug 984', 10000, 2952),
(987, 'Drug 985', 10000, 10835),
(988, 'Drug 986', 10000, 4930),
(989, 'Drug 987', 10000, 20727),
(990, 'Drug 988', 10000, 10868),
(991, 'Drug 989', 10000, 8901),
(992, 'Drug 990', 10000, 6930),
(993, 'Drug 991', 10000, 14865),
(994, 'Drug 992', 10000, 992),
(995, 'Drug 993', 10000, 13902),
(996, 'Drug 994', 10000, 19880),
(997, 'Drug 995', 10000, 8955),
(998, 'Drug 996', 10000, 24900),
(999, 'Drug 997', 10000, 8973),
(1000, 'Drug 998', 10000, 15968),
(1001, 'Drug 999', 10000, 17982),
(1002, 'Drug 1000', 10000, 23000),
(1003, 'Drug 1001', 10000, 9009),
(1004, 'Drug 1002', 10000, 18036),
(1005, 'Drug 1003', 10000, 14042),
(1006, 'Drug 1004', 10000, 12048);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemCode` int(11) NOT NULL,
  `manufacturer` varchar(10) COLLATE utf8_bin NOT NULL,
  `marketedBy` varchar(10) COLLATE utf8_bin NOT NULL,
  `productName` text COLLATE utf8_bin NOT NULL,
  `packSize` varchar(10) COLLATE utf8_bin NOT NULL,
  `productRate` float NOT NULL,
  `MRP` float NOT NULL,
  `Tax` float NOT NULL,
  `shelf` varchar(10) COLLATE utf8_bin NOT NULL,
  `RP` int(11) NOT NULL,
  `gNCode` int(11) NOT NULL,
  `mainCategory` varchar(10) COLLATE utf8_bin NOT NULL,
  `subCategory` varchar(20) COLLATE utf8_bin NOT NULL,
  `productType` varchar(20) COLLATE utf8_bin NOT NULL,
  `productGroup` varchar(20) COLLATE utf8_bin NOT NULL,
  `orderQuantity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `iTGroup` int(11) NOT NULL,
  `VAT` float NOT NULL,
  `status` varchar(1) COLLATE utf8_bin NOT NULL,
  `JSUPCODE` int(11) NOT NULL,
  `reorderLvl` varchar(25) COLLATE utf8_bin NOT NULL,
  `drugContent` text COLLATE utf8_bin NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemCode`, `manufacturer`, `marketedBy`, `productName`, `packSize`, `productRate`, `MRP`, `Tax`, `shelf`, `RP`, `gNCode`, `mainCategory`, `subCategory`, `productType`, `productGroup`, `orderQuantity`, `quantity`, `iTGroup`, `VAT`, `status`, `JSUPCODE`, `reorderLvl`, `drugContent`, `stock`) VALUES
(1, 'CADILA', 'CADILA', 'BORTECAD 2MG INJ', '1,VAIL', 15.25, 18.95, 0, '', 0, 0, 'SCHEDULE', 'GE', 'VIA', 'SURGICAL2', 0, 1, 0, 12.5, '', 0, '25', '', 10),
(2, 'SOMECOMPAN', 'STOCKIST', 'ALZOLAM 0.5', '10S', 0, 0, 0, '', 0, 0, 'SCHEDULE', 'GE', 'TAB', 'VAT ON T.P.', 0, 10, 0, 5, '', 0, '', '', -30),
(3, 'Ome', 'Ass', 'Parisutemam', '12', 12, 10, 2, 'row', 0, 0, 'SCHEDULE', 'GE', 'AMP', 'MEDICINE', 0, 9, 0, 0, '', 0, '', '12', 4);

-- --------------------------------------------------------

--
-- Table structure for table `kit_details`
--

CREATE TABLE IF NOT EXISTS `kit_details` (
  `id` int(11) NOT NULL,
  `kit_name` varchar(256) NOT NULL,
  `kit_type` varchar(256) NOT NULL,
  `pat_address` varchar(256) NOT NULL,
  `doctor_name` varchar(256) NOT NULL,
  `remind_days` varchar(256) NOT NULL,
  `product` varchar(256) NOT NULL,
  `qty` varchar(256) NOT NULL,
  `doc_city` varchar(256) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`) VALUES
(4, 'Wish you a Speedy Recovery');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `date` date NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `patient_city` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_city` varchar(255) NOT NULL,
  `cash-or-credit` varchar(255) NOT NULL,
  `bill` text NOT NULL,
  `total` double NOT NULL,
  `total_amt` double NOT NULL,
  `paid_amt` double NOT NULL,
  `discount` double NOT NULL,
  `totalDiscount` double NOT NULL,
  `bal_amt` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `bill_no`, `date`, `patient_name`, `patient_address`, `phone_no`, `patient_city`, `doctor_name`, `doctor_city`, `cash-or-credit`, `bill`, `total`, `total_amt`, `paid_amt`, `discount`, `totalDiscount`, `bal_amt`, `created`, `modified`) VALUES
(143, 1, '2016-06-10', 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5":{"quantity":"2","productRate":"3.052","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""}}', 0, 3.05, 3.05, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 2, '2016-06-10', 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5":{"quantity":"2","productRate":"3.052","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""}}', 0, 3.05, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 3, '2016-06-10', 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5":{"quantity":"2","productRate":"3.052","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""},"BORTECAD 2MG INJ":{"quantity":"2","productRate":"3.79","MRP":"18.95","batchNo":"1151851","packSize":"10","expiryDate":"11\\/18","manufacturer":"CADILA","purchaseSize":"1","Tax":"0","shelf":"","cost":""}}', 0, 6.77, 0, 1, 0.07, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 4, '2016-06-10', 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5":{"quantity":"2","productRate":"3.052","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""}}', 0, 3.05, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 5, '2016-06-27', 'Amit Sharma', 'Burdi', 845622421, 'Nagpur', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"Parisutemam ":{"quantity":"2","productRate":"5","MRP":"10","batchNo":"","packSize":"4","expiryDate":"","manufacturer":"Ome","purchaseSize":"3","Tax":"2","shelf":"row","cost":""}}', 5, 4.9, 0, 2, 0.1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 6, '2016-06-27', 'Amit Sharma', 'Burdi', 845622421, 'Nagpur', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5 ":{"quantity":"3","productRate":"4.577999999999999","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""}}', 4.58, 4.44, 0, 3, 0.14, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 7, '2016-06-27', 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5 ":{"quantity":"2","productRate":"3.052","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""},"BORTECAD 2MG INJ ":{"quantity":"4","productRate":"7.58","MRP":"18.95","batchNo":"1151851","packSize":"10","expiryDate":"11\\/18","manufacturer":"CADILA","purchaseSize":"10","Tax":"0","shelf":"","cost":""}}', 10.63, 10.42, 0, 2, 0.21, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 8, '2016-06-27', 'Amit Sharma', 'Burdi', 845622421, 'Nagpur', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"ALZOLAM 0.5 ":{"quantity":"1","productRate":"1.526","MRP":"15.26","batchNo":"1111","packSize":"10","expiryDate":"11\\/16","manufacturer":"SOMECOMPAN","purchaseSize":"10","Tax":"0","shelf":"","cost":""},"BORTECAD 2MG INJ ":{"quantity":"2","productRate":"3.79","MRP":"18.95","batchNo":"1151851","packSize":"10","expiryDate":"11\\/18","manufacturer":"CADILA","purchaseSize":"10","Tax":"0","shelf":"","cost":""},"Parisutemam ":{"quantity":"2","productRate":"5","MRP":"10","batchNo":"","packSize":"4","expiryDate":"","manufacturer":"Ome","purchaseSize":"3","Tax":"2","shelf":"row","cost":""}}', 14.89, 14.6, 0, 2, 0.3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 9, '2016-06-28', 'Padamini mujumdahar', 'Shradanan Phet', 457874212, 'NAGPUR', 'Priyanka sharma', 'Nagpur', 'C-cash', '{"BORTECAD 2MG INJ ":{"quantity":"2","productRate":"3.79","MRP":"18.95","batchNo":"1151851","packSize":"10","expiryDate":"07\\/18","manufacturer":"CADILA","purchaseSize":"10","Tax":"0","shelf":"","cost":""}}', 3.79, 3.75, 0, 1, 0.04, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL,
  `bank` varchar(100) COLLATE utf8_bin NOT NULL,
  `supplier` varchar(100) COLLATE utf8_bin NOT NULL,
  `check_no` int(11) NOT NULL,
  `check_date` date NOT NULL,
  `paid` float NOT NULL,
  `balance` float NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(11) NOT NULL,
  `type` varchar(25) COLLATE utf8_bin NOT NULL,
  `abbreviation` varchar(4) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `type`, `abbreviation`) VALUES
(1, 'AMPULES', 'AMP'),
(2, 'AYURVEDIC', 'AYU'),
(3, 'BISCUTES', 'B'),
(4, 'BAG', 'BAG'),
(5, 'BAND-AID', 'BAN'),
(6, 'BRUSH', 'BRU'),
(7, 'CAPSULES', 'CAP'),
(8, 'CARD CLAMP', 'CAR'),
(9, 'CATH', 'CAT'),
(10, 'CHO', 'CHO'),
(11, 'CHURAN', 'CHU'),
(12, 'CLAMP', 'CLA'),
(13, 'COIL', 'COI'),
(14, 'CONDOM', 'CON'),
(15, 'COTTON', 'COT'),
(16, 'CRAP', 'CRA'),
(17, 'CREAM', 'CRM'),
(18, 'DIAPER', 'DIA'),
(19, 'DROPS', 'DRP'),
(20, 'ETHI', 'ETH'),
(21, 'EXPECTORENT', 'EXP'),
(22, 'GARGLE', 'GAR'),
(23, 'GAUZE', 'GAU'),
(24, 'GEL', 'GEL'),
(25, 'GENERAL-GOODS', 'GEN'),
(26, 'GENERIC', 'GER'),
(27, 'GRANULES', 'GRA'),
(28, 'GUM TONIC', 'GUM'),
(29, 'HANDGLOVES', 'HAN'),
(30, 'HONEY', 'HON'),
(31, 'INFUSION', 'INF'),
(32, 'INHALER', 'INH'),
(33, 'INJECTION', 'INJ'),
(34, 'LINIMENT', 'LIN'),
(35, 'LIQUID', 'LIQ'),
(36, 'LOTION', 'LOT'),
(37, 'MACHIN', 'MAH'),
(38, 'MAT', 'MAT'),
(39, 'NON-SCHEDULED', 'NON'),
(40, 'OIL', 'OIL'),
(41, 'OINTMENT', 'ONT'),
(42, 'PASTE', 'PAS'),
(43, 'PHENYL', 'PHE'),
(44, 'POWEDER', 'POW'),
(45, 'REGULAR', 'REG'),
(46, 'RESPULES', 'RES'),
(47, 'ROTACAPS', 'ROT'),
(48, 'SCHETS/POUCH', 'SAC'),
(49, 'SALINE', 'SAL'),
(50, 'SANITARY NAPKINS', 'SAN'),
(51, 'SET', 'SET'),
(52, 'SHAMPOO', 'SHM'),
(53, 'SOAP', 'SOA'),
(54, 'SOLUTION', 'SOL'),
(55, 'SPIRIT', 'SPI'),
(56, 'SPRAY', 'SPR'),
(57, 'SUPPOSITORIES', 'SUP'),
(58, 'SUGICAL', 'SUR'),
(59, 'SUSPENSION', 'SUP'),
(60, 'SUTURE', 'SUT'),
(61, 'SV SET', 'SV'),
(62, 'SYRUP', 'SYP'),
(63, 'TABLETS', 'TAB'),
(64, 'TRANCAPS', 'TRA'),
(65, 'TUBE', 'TUB'),
(66, 'VIAL', 'VIA');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) COLLATE utf8_bin NOT NULL,
  `marketedBy` varchar(100) COLLATE utf8_bin NOT NULL,
  `manufacturer` varchar(100) COLLATE utf8_bin NOT NULL,
  `packSize` varchar(11) COLLATE utf8_bin NOT NULL,
  `quantity` int(11) NOT NULL,
  `mainCategory` varchar(100) COLLATE utf8_bin NOT NULL,
  `subCategory` varchar(100) COLLATE utf8_bin NOT NULL,
  `productType` varchar(100) COLLATE utf8_bin NOT NULL,
  `productGroup` varchar(100) COLLATE utf8_bin NOT NULL,
  `purchaseRate` float NOT NULL,
  `MRP` float NOT NULL,
  `Tax` float NOT NULL,
  `VAT` float NOT NULL,
  `mDate` date NOT NULL,
  `exDate` date NOT NULL,
  `shelf` varchar(100) COLLATE utf8_bin NOT NULL,
  `reorderLvl` varchar(100) COLLATE utf8_bin NOT NULL,
  `orderQuantity` int(11) NOT NULL,
  `drugContent` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `productName`, `marketedBy`, `manufacturer`, `packSize`, `quantity`, `mainCategory`, `subCategory`, `productType`, `productGroup`, `purchaseRate`, `MRP`, `Tax`, `VAT`, `mDate`, `exDate`, `shelf`, `reorderLvl`, `orderQuantity`, `drugContent`) VALUES
(2, 'dcold total', 'someSeller', 'someManftr', '10S', 10, 'SCHEDULE', 'GE', '', '', 7.25, 9.75, 0, 0, '0000-00-00', '0000-00-00', '', '', 0, ''),
(3, 'protienX', 'otherSeller', 'otherManuftr', '250g', 5, 'SCHEDULE', 'GE', '', '', 200, 252, 0, 5, '0000-00-00', '0000-00-00', '', '', 0, ''),
(5, 'someOther drug', 'thatSeller123', 'otherManuftr', '10S', 10, 'SCHEDULE', 'GE', 'CAP', 'VAT ON T.P.', 12.2, 15.5, 0, 5, '0000-00-00', '0000-00-00', '', '', 0, ''),
(6, 'someOther drug', 'thatSeller123', 'otherManuftr', '10S', 10, 'SCHEDULE', 'GE', 'CAP', 'VAT ON T.P.', 12.2, 15.5, 0, 5, '0000-00-00', '0000-00-00', '', '', 0, ''),
(7, 'someOther drug', 'thatSeller123', 'otherManuftr', '10S', 10, 'SCHEDULE', 'GE', 'CAP', 'VAT ON T.P.', 12.2, 15.5, 0, 5, '0000-00-00', '0000-00-00', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchasebills`
--

CREATE TABLE IF NOT EXISTS `purchasebills` (
  `id` int(11) NOT NULL,
  `invoiceNumber` int(11) NOT NULL,
  `bType` varchar(20) COLLATE utf8_bin NOT NULL,
  `supplier` varchar(100) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `productName` varchar(100) COLLATE utf8_bin NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `purchaseSize` int(11) NOT NULL,
  `productFree` int(11) NOT NULL,
  `tabQuantity` int(11) NOT NULL,
  `batchNo` varchar(50) COLLATE utf8_bin NOT NULL,
  `expiryDate` varchar(5) COLLATE utf8_bin NOT NULL,
  `purchaseRate` float NOT NULL,
  `discount` float NOT NULL,
  `vatAmount` float NOT NULL,
  `VAT` float NOT NULL,
  `CST` float NOT NULL,
  `MRP` float NOT NULL,
  `purchaseAmount` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `purchasebills`
--

INSERT INTO `purchasebills` (`id`, `invoiceNumber`, `bType`, `supplier`, `date`, `productName`, `productQuantity`, `purchaseSize`, `productFree`, `tabQuantity`, `batchNo`, `expiryDate`, `purchaseRate`, `discount`, `vatAmount`, `VAT`, `CST`, `MRP`, `purchaseAmount`) VALUES
(1, 0, 'INV', 'ajay supplier', '2016-01-10', 'ALZOLAM 0.5', 10, 10, 0, -78, '1111', '11/16', 12, 0, 6, 5, 0, 15.26, 120),
(3, 0, 'INV', 'ajay supplier', '2016-01-10', 'BORTECAD 2MG INJ', 10, 10, 0, 10, '1151851', '07/18', 15.25, 0, 1.91, 12.5, 0, 18.95, 152.5),
(24, 0, 'INV', '', '2016-06-02', 'Parisutemam', 3, 4, 2, 7, '', '', 12, 0.72, 0.36, 1, 0, 10, 36);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseinvoice`
--

CREATE TABLE IF NOT EXISTS `purchaseinvoice` (
  `id` int(11) NOT NULL,
  `invoiceNumber` int(11) NOT NULL,
  `purchaseEntry` int(11) NOT NULL,
  `billDate` date NOT NULL,
  `supplier` varchar(50) COLLATE utf8_bin NOT NULL,
  `cash_or_credit` varchar(10) COLLATE utf8_bin NOT NULL,
  `creditNote` float NOT NULL,
  `debitNote` float NOT NULL,
  `discountPer` float NOT NULL,
  `discount` float NOT NULL,
  `VAT` float NOT NULL,
  `netAmount` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `purchaseinvoice`
--

INSERT INTO `purchaseinvoice` (`id`, `invoiceNumber`, `purchaseEntry`, `billDate`, `supplier`, `cash_or_credit`, `creditNote`, `debitNote`, `discountPer`, `discount`, `VAT`, `netAmount`) VALUES
(1, 121, 0, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 0, 0),
(2, 121, 0, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 0, 0),
(3, 121, 0, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 0, 0),
(4, 1121, 3, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 1.91, 152.5),
(5, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(6, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(7, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(8, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(9, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(10, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(11, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(12, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(13, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(14, 1214, 4, '2016-01-09', 'ajay supplier', '', 0, 0, 0, 0, 6, 120),
(15, 0, 14, '2016-01-10', '', '', 0, 0, 0, 0, 0, 0),
(16, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(17, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(18, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(19, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(20, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(21, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(22, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(23, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(24, 0, 15, '2016-01-10', 'ajay supplier', '', 0, 0, 0, 0, 7.91, 272.5),
(25, 15875, 24, '2016-01-11', 'ajay supplier', '', 0, 0, 0, 0, 6.26, 125.2),
(26, 12312, 25, '2016-01-11', 'ajay supplier', '', 0, 0, 0, 0, 1.91, 152.5),
(27, 0, 26, '2016-01-30', '', '', 0, 0, 0, 0, 7.91, 272.5),
(28, 0, 28, '2016-05-30', '', '', 0, 0, 0, 1.31, 22.96, 87.39),
(29, 0, 29, '2016-05-31', '', '', 0, 0, 0, 0.8, 2, 41.2),
(30, 0, 29, '2016-05-31', '', '', 0, 0, 0, 0.8, 2, 41.2),
(31, 0, 29, '2016-05-31', '', '', 0, 0, 0, 0.8, 2, 41.2),
(32, 121, 32, '2016-06-02', 'ajay supplier', '', 0, 0, 0, 0.3, 0.15, 14.85),
(33, 0, 33, '2016-06-02', '', '', 0, 0, 0, 0.72, 0.36, 35.64);

-- --------------------------------------------------------

--
-- Table structure for table `purchasereturn`
--

CREATE TABLE IF NOT EXISTS `purchasereturn` (
  `id` int(11) NOT NULL,
  `supplier` varchar(100) COLLATE utf8_bin NOT NULL,
  `bType` varchar(10) COLLATE utf8_bin NOT NULL,
  `loss` float NOT NULL,
  `invoiceNo` varchar(10) COLLATE utf8_bin NOT NULL,
  `invoiceDate` date NOT NULL,
  `product` varchar(100) COLLATE utf8_bin NOT NULL,
  `status` varchar(10) COLLATE utf8_bin NOT NULL,
  `amount` float NOT NULL,
  `narration` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sell_items`
--

CREATE TABLE IF NOT EXISTS `sell_items` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productRate` int(11) NOT NULL,
  `MRP` varchar(255) NOT NULL,
  `batchNo` varchar(255) NOT NULL,
  `packSize` int(11) NOT NULL,
  `expiryDate` datetime NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `Tax` int(11) NOT NULL,
  `purchaseSize` int(11) NOT NULL,
  `shelf` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `paid_amt` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `bal_amt` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sell_items`
--

INSERT INTO `sell_items` (`id`, `patient_id`, `productName`, `quantity`, `productRate`, `MRP`, `batchNo`, `packSize`, `expiryDate`, `manufacturer`, `Tax`, `purchaseSize`, `shelf`, `cost`, `total_amt`, `paid_amt`, `discount`, `bal_amt`, `created`, `modified`) VALUES
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 0, 'BORTECAD 2MG INJ', 1, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 15, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'ALZOLAM 0.5', 4, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 2, 'row1', 202, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'ALZOLAM 0.5', 1, 50, '0', '1111', 10, '0000-00-00 00:00:00', 'SOMECOMPAN', 0, 0, 'row1', 50, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'BORTECAD 2MG INJ', 4, 15, '18.95', '1151851', 1, '0000-00-00 00:00:00', 'CADILA', 0, 0, 'row2', 61, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stockist_name`
--

CREATE TABLE IF NOT EXISTS `stockist_name` (
  `id` int(11) NOT NULL,
  `abbreviation` varchar(10) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `stockist_name`
--

INSERT INTO `stockist_name` (`id`, `abbreviation`, `name`, `company_id`) VALUES
(1, 'ASA', 'ajay supplier', 1),
(2, 'ASA', 'ajay supplier', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax_masters`
--

CREATE TABLE IF NOT EXISTS `tax_masters` (
  `id` int(11) NOT NULL,
  `vat_catogary` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `lbt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_masters`
--

INSERT INTO `tax_masters` (`id`, `vat_catogary`, `vat`, `lbt`) VALUES
(1, 'LBT', '40%', '30%');

-- --------------------------------------------------------

--
-- Table structure for table `vat_category`
--

CREATE TABLE IF NOT EXISTS `vat_category` (
  `id` int(11) NOT NULL,
  `vat_type` varchar(15) COLLATE utf8_bin NOT NULL,
  `vat_value` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vat_category`
--

INSERT INTO `vat_category` (`id`, `vat_type`, `vat_value`) VALUES
(1, 'FOOD', 12.5),
(2, 'GENERAL1', 5),
(3, 'GENERAL2', 12.5),
(4, 'SURGICAL1', 5),
(5, 'SURGICAL2', 12.5),
(6, 'COSMETIC', 12.5),
(7, 'VAT ON T.P.', 5),
(8, 'MEDICINE', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acnt_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_name`
--
ALTER TABLE `company_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `inventory_nagpur`
--
ALTER TABLE `inventory_nagpur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemCode`);

--
-- Indexes for table `kit_details`
--
ALTER TABLE `kit_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasebills`
--
ALTER TABLE `purchasebills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseinvoice`
--
ALTER TABLE `purchaseinvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasereturn`
--
ALTER TABLE `purchasereturn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockist_name`
--
ALTER TABLE `stockist_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_masters`
--
ALTER TABLE `tax_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat_category`
--
ALTER TABLE `vat_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acnt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `company_name`
--
ALTER TABLE `company_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doctor_details`
--
ALTER TABLE `doctor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventory_nagpur`
--
ALTER TABLE `inventory_nagpur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1007;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemCode` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kit_details`
--
ALTER TABLE `kit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `purchasebills`
--
ALTER TABLE `purchasebills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `purchaseinvoice`
--
ALTER TABLE `purchaseinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `purchasereturn`
--
ALTER TABLE `purchasereturn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stockist_name`
--
ALTER TABLE `stockist_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tax_masters`
--
ALTER TABLE `tax_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vat_category`
--
ALTER TABLE `vat_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
