-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2016 at 03:44 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_app`
--
DROP DATABASE `products_app`;
CREATE DATABASE IF NOT EXISTS `products_app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `products_app`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock_quantity` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `vat_rate` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `part_number`, `description`, `image`, `stock_quantity`, `cost_price`, `selling_price`, `vat_rate`) VALUES
(1, 'FAC5724827H', 'AN.J8PB - 8 Piece Screwdriver Set Machined blades for a perfect fit in the screw head. Moulded polymer handle for durable performance, a comfortable grip and excellent resistance to chemicals.', 'fac5724827h.jpg', 12, '30.50', '45.90', '20.00'),
(2, 'SLY6011500A', 'AK61312 Chrome vanadium steel key shafts, heat treated, hardened, with fully polished mirror finish. Slimline aluminium housing. Features an eight-in-one Phillips and Pozi bit.', 'sly6011500a.jpg', 111, '7.22', '11.94', '20.00'),
(3, 'OSA2798510K', 'Model Number MT219E The multi-tool includes a 1.1m flexible drive making it ideal for small DIY and craft jobs such as drilling, polishing, grinding and engraving.', 'osa2798510k.jpg', 22, '23.99', '35.99', '20.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
