-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 10:32 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pallet_plus_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders_log`
--

CREATE TABLE `orders_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(32) NOT NULL,
  `action` varchar(32) NOT NULL,
  `orderId` int(11) NOT NULL,
  `tableId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `cash` tinyint(1) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_log`
--

INSERT INTO `orders_log` (`id`, `createdDate`, `modifiedDate`, `modifiedBy`, `action`, `orderId`, `tableId`, `menuId`, `status`, `paid`, `cash`, `archived`) VALUES
(1, '2018-03-18 09:32:05', '2018-03-18 09:32:05', 'alpha', 'added', 1, 2, 1, 'Pending', 0, 0, 0),
(2, '2018-03-18 09:32:05', '2018-03-18 09:32:05', 'alpha', 'added', 2, 2, 1, 'Pending', 0, 0, 0),
(3, '2018-03-18 09:32:05', '2018-03-18 09:32:05', 'alpha', 'added', 3, 2, 2, 'Pending', 0, 0, 0),
(4, '2018-03-18 09:32:05', '2018-03-18 09:32:05', 'alpha', 'added', 4, 2, 2, 'Pending', 0, 0, 0),
(5, '2018-03-18 09:32:05', '2018-03-18 09:32:05', 'alpha', 'added', 5, 2, 5, 'Pending', 0, 0, 0),
(6, '2018-03-18 09:33:36', '2018-03-18 09:33:36', 'alpha', 'added', 6, 2, 1, 'Pending', 0, 0, 0),
(7, '2018-03-18 09:33:36', '2018-03-18 09:33:36', 'alpha', 'added', 7, 2, 1, 'Pending', 0, 0, 0),
(8, '2018-03-18 09:33:36', '2018-03-18 09:33:36', 'alpha', 'added', 8, 2, 2, 'Pending', 0, 0, 0),
(9, '2018-03-18 09:33:36', '2018-03-18 09:33:36', 'alpha', 'added', 9, 2, 2, 'Pending', 0, 0, 0),
(10, '2018-03-18 09:33:36', '2018-03-18 09:33:36', 'alpha', 'added', 10, 2, 5, 'Pending', 0, 0, 0),
(11, '2018-03-18 11:12:34', '2018-03-18 11:12:34', 'alpha', 'added', 11, 4, 1, 'Pending', 0, 0, 0),
(12, '2018-03-18 11:12:34', '2018-03-18 11:12:34', 'alpha', 'added', 12, 4, 1, 'Pending', 0, 0, 0),
(13, '2018-03-18 11:12:34', '2018-03-18 11:12:34', 'alpha', 'added', 13, 4, 2, 'Pending', 0, 0, 0),
(14, '2018-03-18 11:12:34', '2018-03-18 11:12:34', 'alpha', 'added', 14, 4, 5, 'Pending', 0, 0, 0),
(15, '2018-03-18 11:12:34', '2018-03-18 11:12:34', 'alpha', 'added', 15, 4, 8, 'Pending', 0, 0, 0),
(16, '2018-03-18 11:16:11', '2018-03-18 11:16:11', 'alpha', 'added', 16, 12, 1, 'Pending', 0, 0, 0),
(17, '2018-03-18 11:16:11', '2018-03-18 11:16:11', 'alpha', 'added', 17, 12, 2, 'Pending', 0, 0, 0),
(18, '2018-03-18 18:59:20', '2018-03-18 18:59:20', 'alpha', 'added', 18, 8, 1, 'Pending', 0, 0, 0),
(19, '2018-03-18 18:59:20', '2018-03-18 18:59:20', 'alpha', 'added', 19, 8, 2, 'Pending', 0, 0, 0),
(20, '2018-03-18 18:59:20', '2018-03-18 18:59:20', 'alpha', 'added', 20, 8, 2, 'Pending', 0, 0, 0),
(21, '2018-03-18 18:59:20', '2018-03-18 18:59:20', 'alpha', 'added', 21, 8, 6, 'Pending', 0, 0, 0),
(22, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 1, 2, 1, 'Completed', 1, 1, 0),
(23, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 2, 2, 1, 'Completed', 1, 1, 0),
(24, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 3, 2, 2, 'Completed', 1, 1, 0),
(25, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 4, 2, 2, 'Completed', 1, 1, 0),
(26, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 5, 2, 5, 'Completed', 1, 1, 0),
(27, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 6, 2, 1, 'Completed', 1, 1, 0),
(28, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 7, 2, 1, 'Completed', 1, 1, 0),
(29, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 8, 2, 2, 'Completed', 1, 1, 0),
(30, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 9, 2, 2, 'Completed', 1, 1, 0),
(31, '2018-03-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 10, 2, 5, 'Completed', 1, 1, 0),
(32, '2018-03-20 16:18:35', '2018-03-20 16:18:35', 'alpha', 'added', 22, 10, 1, 'Pending', 0, 0, 0),
(33, '2018-03-20 16:18:35', '2018-03-20 16:18:35', 'alpha', 'added', 23, 10, 2, 'Pending', 0, 0, 0),
(34, '2018-03-12 09:32:05', '2018-03-18 09:32:05', 'cashier', 'updated', 24, 2, 1, 'Completed', 0, 0, 0),
(35, '2018-03-12 09:32:05', '2018-03-18 09:32:05', 'cashier', 'updated', 25, 2, 1, 'Completed', 0, 0, 0),
(36, '2018-03-12 09:32:05', '2018-03-18 09:32:05', 'cashier', 'updated', 26, 2, 2, 'Completed', 0, 0, 0),
(37, '2018-03-13 09:32:05', '2018-03-18 09:32:05', 'cashier', 'updated', 27, 2, 2, 'Completed', 0, 0, 0),
(38, '2018-03-13 09:32:05', '2018-03-18 09:32:05', 'cashier', 'updated', 28, 2, 5, 'Completed', 0, 0, 0),
(39, '2018-03-14 09:33:36', '2018-03-18 09:33:36', 'cashier', 'updated', 29, 2, 1, 'Completed', 0, 0, 0),
(40, '2018-03-14 09:33:36', '2018-03-18 09:33:36', 'cashier', 'updated', 30, 2, 1, 'Completed', 0, 0, 0),
(41, '2018-03-15 09:33:36', '2018-03-18 09:33:36', 'cashier', 'updated', 31, 2, 2, 'Completed', 0, 0, 0),
(42, '2018-03-15 09:33:36', '2018-03-18 09:33:36', 'cashier', 'updated', 32, 2, 2, 'Completed', 0, 0, 0),
(43, '2018-03-15 09:33:36', '2018-03-18 09:33:36', 'cashier', 'updated', 33, 2, 5, 'Completed', 0, 0, 0),
(44, '2018-03-16 11:12:34', '2018-03-18 11:12:34', 'cashier', 'updated', 34, 4, 1, 'Completed', 0, 0, 0),
(45, '2018-03-16 11:12:34', '2018-03-18 11:12:34', 'cashier', 'updated', 35, 4, 1, 'Completed', 0, 0, 0),
(46, '2018-03-17 11:12:34', '2018-03-18 11:12:34', 'cashier', 'updated', 36, 4, 2, 'Completed', 0, 0, 0),
(47, '2018-03-17 11:12:34', '2018-03-18 11:12:34', 'cashier', 'updated', 37, 4, 5, 'Completed', 0, 0, 0),
(48, '2018-03-17 11:12:34', '2018-03-18 11:12:34', 'cashier', 'updated', 38, 4, 8, 'Completed', 0, 0, 0),
(49, '2018-03-17 11:16:11', '2018-03-18 11:16:11', 'cashier', 'updated', 39, 12, 1, 'Completed', 0, 0, 0),
(50, '2018-03-19 11:16:11', '2018-03-18 11:16:11', 'cashier', 'updated', 40, 12, 2, 'Completed', 0, 0, 0),
(51, '2018-03-19 18:59:20', '2018-03-18 18:59:20', 'cashier', 'updated', 41, 8, 1, 'Completed', 0, 0, 0),
(52, '2018-03-20 18:59:20', '2018-03-18 18:59:20', 'cashier', 'updated', 42, 8, 2, 'Completed', 0, 0, 0),
(53, '2018-03-21 18:59:20', '2018-03-18 18:59:20', 'cashier', 'updated', 43, 8, 2, 'Completed', 0, 0, 0),
(54, '2018-03-22 18:59:20', '2018-03-18 18:59:20', 'cashier', 'updated', 44, 8, 6, 'Completed', 0, 0, 0),
(55, '2018-03-23 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 45, 2, 1, 'Completed', 1, 1, 0),
(56, '2018-03-24 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 46, 2, 1, 'Completed', 1, 1, 0),
(57, '2018-03-25 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 47, 2, 2, 'Completed', 1, 1, 0),
(58, '2018-03-26 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 48, 2, 2, 'Completed', 1, 1, 0),
(59, '2018-03-27 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 49, 2, 5, 'Completed', 1, 1, 0),
(60, '2018-03-28 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 50, 2, 1, 'Completed', 1, 1, 0),
(61, '2018-03-29 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 51, 2, 1, 'Completed', 1, 1, 0),
(62, '2018-03-30 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 52, 2, 2, 'Completed', 1, 1, 0),
(63, '2018-03-31 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 53, 2, 2, 'Completed', 1, 1, 0),
(64, '2018-04-01 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 54, 2, 5, 'Completed', 1, 1, 0),
(65, '2018-04-02 16:18:35', '2018-03-20 16:18:35', 'alpha', 'added', 22, 45, 1, 'Pending', 0, 0, 0),
(66, '2018-04-23 16:18:35', '2018-03-20 16:18:35', 'alpha', 'added', 23, 46, 2, 'Pending', 0, 0, 0),
(68, '2018-04-01 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 57, 2, 5, 'Completed', 1, 1, 0),
(69, '2018-04-02 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 58, 1, 5, 'Completed', 1, 1, 0),
(70, '2018-04-02 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 59, 1, 5, 'Completed', 1, 1, 0),
(71, '2018-04-03 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 60, 1, 5, 'Completed', 1, 1, 0),
(72, '2018-04-03 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 61, 2, 5, 'Completed', 1, 1, 0),
(73, '2018-04-03 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 62, 2, 5, 'Completed', 1, 1, 0),
(74, '2018-04-04 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 63, 2, 5, 'Completed', 1, 1, 0),
(75, '2018-04-05 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 64, 3, 5, 'Completed', 1, 1, 0),
(76, '2018-04-05 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 65, 3, 5, 'Completed', 1, 1, 0),
(77, '2018-04-06 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 66, 3, 5, 'Completed', 1, 1, 0),
(78, '2018-04-06 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 67, 4, 5, 'Completed', 1, 1, 0),
(79, '2018-04-06 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 68, 4, 5, 'Completed', 1, 1, 0),
(80, '2018-04-07 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 69, 4, 5, 'Completed', 1, 1, 0),
(81, '2018-04-08 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 70, 4, 5, 'Completed', 1, 1, 0),
(82, '2018-04-09 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 71, 4, 5, 'Completed', 1, 1, 0),
(83, '2018-04-10 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 72, 5, 5, 'Completed', 1, 1, 0),
(84, '2018-04-11 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 73, 5, 5, 'Completed', 1, 1, 0),
(85, '2018-04-12 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 74, 5, 5, 'Completed', 1, 1, 0),
(86, '2018-04-13 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 75, 5, 5, 'Completed', 1, 1, 0),
(87, '2018-04-14 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 76, 6, 5, 'Completed', 1, 1, 0),
(88, '2018-04-15 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 77, 6, 5, 'Completed', 1, 1, 0),
(89, '2018-04-16 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 78, 6, 5, 'Completed', 1, 1, 0),
(90, '2018-04-17 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 79, 6, 5, 'Completed', 1, 1, 0),
(91, '2018-04-18 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 80, 6, 5, 'Completed', 1, 1, 0),
(92, '2018-04-19 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 81, 7, 5, 'Completed', 1, 1, 0),
(93, '2018-04-20 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 82, 7, 5, 'Completed', 1, 1, 0),
(94, '2018-04-21 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 83, 8, 5, 'Completed', 1, 1, 0),
(95, '2018-04-22 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 84, 8, 5, 'Completed', 1, 1, 0),
(96, '2018-04-23 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 85, 9, 5, 'Completed', 1, 1, 0),
(97, '2018-04-24 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 86, 9, 5, 'Completed', 1, 1, 0),
(98, '2018-04-25 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 87, 9, 5, 'Completed', 1, 1, 0),
(99, '2018-04-26 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 88, 9, 5, 'Completed', 1, 1, 0),
(100, '2018-04-27 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 89, 9, 5, 'Completed', 1, 1, 0),
(101, '2018-04-28 19:58:24', '2018-03-18 19:58:24', 'cashier', 'updated', 90, 9, 5, 'Completed', 1, 1, 0),
(102, '2018-03-22 13:14:51', '2018-03-22 13:14:51', 'alpha', 'added', 91, 14, 2, 'Pending', 0, 0, 0),
(103, '2018-03-22 13:14:51', '2018-03-22 13:14:51', 'alpha', 'added', 92, 14, 2, 'Pending', 0, 0, 0),
(104, '2018-03-22 13:14:51', '2018-03-22 13:14:51', 'alpha', 'added', 93, 14, 3, 'Pending', 0, 0, 0),
(105, '2018-03-22 13:14:51', '2018-03-22 13:14:51', 'alpha', 'added', 94, 14, 1, 'Pending', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders_log`
--
ALTER TABLE `orders_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders_log`
--
ALTER TABLE `orders_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
