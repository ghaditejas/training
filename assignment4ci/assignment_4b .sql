-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2017 at 06:12 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment_4b`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'ELECTRONICS', 1, '0000-00-00 00:00:00', 0, '2017-04-20 10:45:48', NULL),
(2, 'ELECTRONIC APPLIANCES', 1, '2017-04-20 16:18:35', 0, '2017-04-20 10:48:35', NULL),
(4, 'HOME APPLIANCES', 1, '2017-04-20 16:18:44', 0, '2017-04-20 10:48:44', NULL),
(5, 'CLOTHINGS', 1, '2017-04-20 16:19:00', 0, '2017-04-20 10:49:00', NULL),
(6, 'APPAREL', 1, '2017-04-20 16:19:00', 0, '2017-04-20 10:49:00', NULL),
(7, 'MOBILE ACCESSORIES', 1, '2017-04-20 16:19:24', 0, '2017-04-20 10:49:24', NULL),
(8, 'BOOKS', 1, '2017-04-20 16:19:32', 0, '2017-04-20 10:49:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `image` varchar(50) NOT NULL,
  `category` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `category`, `status`, `created_on`, `created_by`, `modified_by`, `modified_on`) VALUES
(1, 'Shiva Trilogy', 800.75, 'product1492770165.jpg', 8, 1, '2017-04-21 15:52:45', 0, NULL, '2017-04-21 10:22:45'),
(2, 'Denim', 5000.00, 'product1492772394.jpg', 5, 1, '2017-04-21 16:29:54', 0, NULL, '2017-04-21 10:59:54'),
(3, 'Bluetooth headphones', 3000.00, 'product1492777276.jpg', 7, 1, '2017-04-21 16:30:46', 0, NULL, '2017-04-21 11:00:46'),
(4, 'Juice Maker', 1500.50, 'product1492772490.jpg', 4, 1, '2017-04-21 16:31:30', 0, NULL, '2017-04-21 11:01:30'),
(5, 'Air Conditioner', 15000.00, '', 2, 1, '2017-04-21 16:33:30', 0, NULL, '2017-04-21 11:03:30'),
(6, 'Nike Joggers', 5000.99, 'product1492772651.jpg', 6, 1, '2017-04-21 16:34:11', 0, NULL, '2017-04-21 11:04:11'),
(7, 'Bluetooth headphones', 3000.00, 'product1492776130.jpg', 7, 0, '2017-04-21 17:32:10', 0, NULL, '2017-04-21 12:02:10'),
(8, 'Bluetooth headphones', 3000.00, 'product1492776244.jpg', 7, 0, '2017-04-21 17:34:04', 0, NULL, '2017-04-21 12:04:04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Category product relation` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
