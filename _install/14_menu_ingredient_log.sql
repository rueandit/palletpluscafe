-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 10:31 AM
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
-- Table structure for table `menu_ingredient_log`
--

CREATE TABLE `menu_ingredient_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `menuIngredientId` int(11) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_ingredient_log`
--
ALTER TABLE `menu_ingredient_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `ingredientId` (`ingredientId`),
  ADD KEY `menuId` (`menuId`),
  ADD KEY `menuIngredientId` (`menuIngredientId`),
  ADD KEY `modifiedBy` (`modifiedBy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_ingredient_log`
--
ALTER TABLE `menu_ingredient_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_ingredient_log`
--
ALTER TABLE `menu_ingredient_log`
  ADD CONSTRAINT `menu_ingredient_log_ibfk_1` FOREIGN KEY (`ingredientId`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `menu_ingredient_log_ibfk_2` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_ingredient_log_ibfk_3` FOREIGN KEY (`menuIngredientId`) REFERENCES `menu_ingredient` (`id`),
  ADD CONSTRAINT `menu_ingredient_log_ibfk_4` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
