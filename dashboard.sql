-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 01:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `allTotal` int(11) NOT NULL,
  `date` date NOT NULL,
  `discount` int(11) NOT NULL,
  `grant_amount` int(11) NOT NULL,
  `due_amount` int(11) NOT NULL DEFAULT 0,
  `change_amount` int(11) NOT NULL,
  `c_name` varchar(55) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `order_id`, `allTotal`, `date`, `discount`, `grant_amount`, `due_amount`, `change_amount`, `c_name`, `c_id`) VALUES
(645, 7535, 800, '2022-12-26', 300, 600, 200, 100, 'Sohail', 76),
(646, 7535, 6500, '2022-12-26', 300, 4000, 2200, 0, 'khan', 77),
(647, 6136, 1800, '2022-12-26', 0, 1800, 0, 0, 'Sohail', 76),
(648, 6136, 1800, '2022-12-26', 0, 1800, 0, 0, 'Sohail', 76),
(649, 2104, 8900, '2022-12-26', 700, 8000, 200, 0, 'Sohail', 76),
(650, 2104, 2700, '2022-12-26', 700, 2600, 0, 600, 'Tahir', 75),
(651, 5309, 2400, '2022-12-26', 0, 3000, 0, 600, 'khan', 77),
(652, 1813, 8000, '2022-12-26', 0, 8000, 0, 0, 'Hoodies', 78),
(653, 5587, 800, '2022-12-14', 0, 800, 0, 0, 'khan', 77),
(654, 6043, 800, '2022-12-26', 0, 800, 0, 0, 'Sohail', 76),
(655, 3142, 1800, '2022-12-06', 0, 1800, 0, 0, 'Sohail', 76),
(656, 4552, 9000, '2022-12-26', 0, 9000, 0, 0, 'Sohail', 76),
(657, 1590, 2000, '2022-12-26', 0, 2000, 0, 0, 'Sohail', 76);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `logo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `logo`) VALUES
(11, 0x556e7469746c65642064657369676e202835292e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `c_phone` int(11) NOT NULL,
  `c_address` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_phone`, `c_address`, `city`, `zip`) VALUES
(75, 'Tahir', 2147483647, 'dir', 'dsaes', '398'),
(76, 'Sohail', 345, 'chakdara', 'mingora', '78657'),
(77, 'khan', 2147483647, 'Malakand, chakdara', 'Malakand', '34525'),
(78, 'Hoodies', 2147483647, 'chakdara', 'sdkljs', '3423'),
(79, 'Jamal', 2147483647, 'dir', 'dsaes', '398');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(20) NOT NULL,
  `admin_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `c_name` varchar(55) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `order_no`, `product_name`, `price`, `qty`, `total`, `c_name`, `c_id`) VALUES
(2057, 2104, 'Drinks', 400, 20, 8000, 'Sohail', 76),
(2058, 2104, 'Milk', 900, 1, 900, 'Sohail', 76),
(2059, 2104, 'Drinks', 900, 2, 1800, 'Tahir', 75),
(2060, 2104, 'Milk', 900, 1, 900, 'Tahir', 75),
(2061, 5309, 'shoes', 400, 6, 2400, 'khan', 77),
(2062, 1813, 'Drinks', 400, 20, 8000, 'Hoodies', 78),
(2063, 5587, 'shoes', 400, 2, 800, 'khan', 77),
(2064, 6043, 'shoes', 400, 2, 800, 'Sohail', 76),
(2065, 3142, 'Software ', 900, 2, 1800, 'Sohail', 76),
(2066, 4552, 'Software ', 4500, 2, 9000, 'Sohail', 76),
(2067, 1590, 'jjjj', 400, 5, 2000, 'Sohail', 76);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `Name` varchar(28) NOT NULL,
  `Store` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `Name`, `Store`, `Email`, `Password`, `image`) VALUES
(24, 'Tahir shah', 'Tahir Supper Store', 'tahirshah809860@gmail.com', '123', 0x494d475f303131302e4a5047);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=658;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2069;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
