-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2018 at 02:29 PM
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
-- Table structure for table `customer_table`
--
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `customer_table`;
CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_table_log`
--
DROP TABLE IF EXISTS `customer_table_log`;
CREATE TABLE `customer_table_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `tableId` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `desciption` varchar(1024) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `imageFile` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images_log`
--

DROP TABLE IF EXISTS `images_log`;
CREATE TABLE `images_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `imageId` int(11) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_log`
--

DROP TABLE IF EXISTS `ingredient_log`;
CREATE TABLE `ingredient_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `imageId` int(11) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menuName` varchar(512) NOT NULL,
  `menuDescription` varchar(1024) NOT NULL,
  `menuStatus` varchar(32) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `rating` varchar(32) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subCategory` varchar(64) NOT NULL,
  `allergenId` int(11) NOT NULL,
  `imageFile` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menuName`, `menuDescription`, `menuStatus`, `price`, `rating`, `archived`, `categoryId`, `subCategory`, `allergenId`, `imageFile`) VALUES
(2, 'Tapsilog', 'Tapsilog', 'Not Available', '95', 'Best Seller', 0, 5, 'Regular', 3, '3'),
(3, 'Hotsilog', 'Hotsilog', 'Available', '95', 'Normal', 1, 1, '', 1, ''),
(4, 'Tocilog', 'Tocilog', 'Available', '95', 'Normal', 1, 1, '', 1, ''),
(5, 'Spamsilog', 'Spamsilog', 'Available', '95', 'Normal', 0, 1, '', 1, ''),
(6, 'Bangsilog', 'Bangsilog', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(7, 'Cornsilog', 'Cornsilog', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(8, 'Breakfast Overload', 'Breakfast Overload', 'Available', '120', 'Normal', 0, 1, '', 1, ''),
(9, 'Porkchop', 'Porkchop', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(10, 'Fish Fillet', 'Fish Fillet', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(11, 'Fried Chicken', 'Fried Chicken', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(12, 'Liempo', 'Liempo', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(13, 'Pork BBQ', 'Pork BBQ', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(14, 'Torikatsu', 'Torikatsu', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(15, 'Sisig', 'Sisig', 'Available', '99', 'Normal', 0, 1, '', 1, ''),
(16, 'Lechon Kawali', 'Lechon Kawali', 'Available', '99', 'Normal', 0, 1, '', 1, '');


INSERT INTO `customer_table`(`id`, `name`, `description`, `archived`) 
VALUES 
(1,'alpha','alpha',0),
(2,'bravo','bravo',0),
(3,'charlie','charlie',0),
(4,'delta','delta',0),
(5,'echo','echo',0),
(6,'foxtrot','foxtrot',0),
(7,'golf','golf',0),
(8,'hotel','hotel',0),
(9,'india','india',0),
(10,'juliet','juliet',0),
(11,'kilo','kilo',0),
(12,'lima','lima',0),
(13,'mike','mike',0),
(14,'november','november',0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_allergen`
--

CREATE TABLE `menu_allergen` (
  `id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_allergen`
--

INSERT INTO `menu_allergen` (`id`, `code`, `description`, `archived`) VALUES
(1, 'milk', 'Milk', 0),
(2, 'peanuts', 'Peanuts', 0),
(3, 'eggs', 'Eggs', 0),
(4, 'fish', 'Fish', 0),
(5, 'soy', 'Soy', 0),
(6, 'wheat', 'Wheat', 0),
(7, 'treenuts', 'Tree Nuts', 0),
(8, 'others', 'Others', 0),
(9, 'none', 'None', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_allergen_log`
--

CREATE TABLE `menu_allergen_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `allergenId` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`id`, `code`, `description`, `archived`) VALUES
(1, 'breakfast', 'Breakfast Meals', 0),
(2, 'rice', 'Rice Meals', 0),
(3, 'pasta', 'Pastas', 0),
(4, 'burgers', 'Burgers', 0),
(5, 'pizza', 'Pizzas', 0),
(6, 'starters', 'Starters', 0),
(7, 'sandwiches', 'Sandwiches', 0),
(8, 'dessert', 'dessert', 0),
(9, 'fruitshakes', 'Fruit Shakes', 0),
(10, 'milkshakes', 'Milk Shakes', 0),
(11, 'refreshments', 'Refreshments', 0),
(12, 'coffee', 'Coffee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_category_log`
--

CREATE TABLE `menu_category_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `menuCategoryId` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_ingredient`
--

CREATE TABLE `menu_ingredient` (
  `id` int(11) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `menu_log`
--

CREATE TABLE `menu_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `menuId` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` varchar(32) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `allergenId` int(11) NOT NULL,
  `rating` varchar(32) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `imageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `cash` tinyint(1) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `tableId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders_log`
--

CREATE TABLE `orders_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `orderId` int(11) NOT NULL,
  `tableId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `cash` tinyint(1) NOT NULL,
  `archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`) VALUES
(1, 'super', 'super', 'superadmin'),
(2, 'admin', 'admin', 'admin'),
(3, 'cashier', 'cashier', 'cashier'),
(4, 'kitchen', 'kitchen', 'kitchen'),
(5, 'alpha', 'alpha', 'waiter'),
(6, 'bravo', 'bravo', 'waiter'),
(7, 'charlie', 'charlie', 'waiter'),
(8, 'delta', 'delta', 'waiter'),
(9, 'echo', 'echo', 'waiter'),
(10, 'foxtrot', 'foxtrot', 'waiter'),
(11, 'golf', 'golf', 'waiter'),
(12, 'hotel', 'hotel', 'waiter'),
(13, 'india', 'india', 'waiter'),
(14, 'juliet', 'juliet', 'waiter'),
(15, 'kilo', 'kilo', 'waiter'),
(16, 'lima', 'lima', 'waiter'),
(17, 'mike', 'mike', 'waiter'),
(18, 'november', 'november', 'waiter');

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `id` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `customer_table_log`
--
ALTER TABLE `customer_table_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `modifiedBy` (`modifiedBy`),
  ADD KEY `tableId` (`tableId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `images_log`
--
ALTER TABLE `images_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `modifiedBy` (`modifiedBy`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `imageId` (`imageId`);

--
-- Indexes for table `ingredient_log`
--
ALTER TABLE `ingredient_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `modifiedBy` (`modifiedBy`),
  ADD KEY `imageId` (`imageId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `allergenId` (`allergenId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `menu_allergen`
--
ALTER TABLE `menu_allergen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `menu_allergen_log`
--
ALTER TABLE `menu_allergen_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `allergenId` (`allergenId`),
  ADD KEY `modifiedBy` (`modifiedBy`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `menu_category_log`
--
ALTER TABLE `menu_category_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `modifiedBy` (`modifiedBy`),
  ADD KEY `menuCategoryId` (`menuCategoryId`);

--
-- Indexes for table `menu_ingredient`
--
ALTER TABLE `menu_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `menuId` (`menuId`),
  ADD KEY `ingredientId` (`ingredientId`);

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
-- Indexes for table `menu_log`
--
ALTER TABLE `menu_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `allergenId` (`allergenId`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `imageId` (`imageId`),
  ADD KEY `menuId` (`menuId`),
  ADD KEY `modifiedBy` (`modifiedBy`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `tableId` (`tableId`),
  ADD KEY `menuId` (`menuId`);

--
-- Indexes for table `orders_log`
--
ALTER TABLE `orders_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `menuId` (`menuId`),
  ADD KEY `modifiedBy` (`modifiedBy`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `tableId` (`tableId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `modifiedBy` (`modifiedBy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_table_log`
--
ALTER TABLE `customer_table_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images_log`
--
ALTER TABLE `images_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredient_log`
--
ALTER TABLE `ingredient_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_allergen`
--
ALTER TABLE `menu_allergen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_allergen_log`
--
ALTER TABLE `menu_allergen_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu_category_log`
--
ALTER TABLE `menu_category_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_ingredient`
--
ALTER TABLE `menu_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_ingredient_log`
--
ALTER TABLE `menu_ingredient_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_log`
--
ALTER TABLE `menu_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_log`
--
ALTER TABLE `orders_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_table_log`
--
ALTER TABLE `customer_table_log`
  ADD CONSTRAINT `customer_table_log_ibfk_1` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customer_table_log_ibfk_2` FOREIGN KEY (`tableId`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `images_log`
--
ALTER TABLE `images_log`
  ADD CONSTRAINT `images_log_ibfk_1` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`imageId`) REFERENCES `images` (`id`);

--
-- Constraints for table `ingredient_log`
--
ALTER TABLE `ingredient_log`
  ADD CONSTRAINT `ingredient_log_ibfk_1` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ingredient_log_ibfk_2` FOREIGN KEY (`imageId`) REFERENCES `images` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`allergenId`) REFERENCES `menu_allergen` (`id`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `menu_category` (`id`);

--
-- Constraints for table `menu_allergen_log`
--
ALTER TABLE `menu_allergen_log`
  ADD CONSTRAINT `menu_allergen_log_ibfk_1` FOREIGN KEY (`allergenId`) REFERENCES `menu_allergen` (`id`),
  ADD CONSTRAINT `menu_allergen_log_ibfk_2` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `menu_category_log`
--
ALTER TABLE `menu_category_log`
  ADD CONSTRAINT `menu_category_log_ibfk_1` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `menu_category_log_ibfk_2` FOREIGN KEY (`menuCategoryId`) REFERENCES `menu_category` (`id`);

--
-- Constraints for table `menu_ingredient`
--
ALTER TABLE `menu_ingredient`
  ADD CONSTRAINT `menu_ingredient_ibfk_1` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_ingredient_ibfk_2` FOREIGN KEY (`ingredientId`) REFERENCES `ingredient` (`id`);

--
-- Constraints for table `menu_ingredient_log`
--
ALTER TABLE `menu_ingredient_log`
  ADD CONSTRAINT `menu_ingredient_log_ibfk_1` FOREIGN KEY (`ingredientId`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `menu_ingredient_log_ibfk_2` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_ingredient_log_ibfk_3` FOREIGN KEY (`menuIngredientId`) REFERENCES `menu_ingredient` (`id`),
  ADD CONSTRAINT `menu_ingredient_log_ibfk_4` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `menu_log`
--
ALTER TABLE `menu_log`
  ADD CONSTRAINT `menu_log_ibfk_1` FOREIGN KEY (`allergenId`) REFERENCES `menu_allergen` (`id`),
  ADD CONSTRAINT `menu_log_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `menu_category` (`id`),
  ADD CONSTRAINT `menu_log_ibfk_3` FOREIGN KEY (`imageId`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `menu_log_ibfk_4` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_log_ibfk_5` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`tableId`) REFERENCES `customer_table` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`);

--
-- Constraints for table `orders_log`
--
ALTER TABLE `orders_log`
  ADD CONSTRAINT `orders_log_ibfk_1` FOREIGN KEY (`menuId`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `orders_log_ibfk_2` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_log_ibfk_3` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_log_ibfk_4` FOREIGN KEY (`tableId`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `users_log`
--
ALTER TABLE `users_log`
  ADD CONSTRAINT `users_log_ibfk_1` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
