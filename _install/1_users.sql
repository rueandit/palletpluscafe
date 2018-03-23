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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `userPassword` varchar(64) NOT NULL,
  `userType` varchar(64) NOT NULL,
  `archived` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `userPassword`, `userType`, `archived`) VALUES
(1, 'super1', 'super1', 'superadmin', 0),
(2, 'admin', 'admin', 'admin', 0),
(3, 'cashier', 'cashier', 'cashier', 1),
(4, 'kitchen', 'kitchen', 'kitchen', 0),
(5, 'alpha', 'alpha', 'waiter', 1),
(6, 'bravo', 'bravo', 'waiter', 0),
(7, 'charlie', 'charlie', 'waiter', 0),
(8, 'delta', 'delta', 'waiter', 0),
(9, 'echo', 'echo', 'waiter', 0),
(10, 'foxtrot', 'foxtrot', 'waiter', 0),
(11, 'golf', 'golf', 'waiter', 0),
(12, 'hotel', 'hotel', 'waiter', 0),
(13, 'india', 'india', 'waiter', 0),
(14, 'juliet', 'juliet', 'waiter', 0),
(15, 'kilo', 'kilo', 'waiter', 0),
(16, 'lima', 'lima', 'waiter', 0),
(17, 'mike', 'mike', 'waiter', 0),
(18, 'november', 'november', 'waiter', 0),
(19, 'test', 'test', 'superadmin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
