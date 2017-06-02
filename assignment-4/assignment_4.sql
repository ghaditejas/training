-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2017 at 06:26 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment_4`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_category`
--

CREATE TABLE IF NOT EXISTS `assign_category` (
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
-- Dumping data for table `assign_category`
--

INSERT INTO `assign_category` (`id`, `name`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'ELECTRONICS APPLIANCES ', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:33:37', NULL),
(2, 'CLOTHINGS', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:33:46', NULL),
(3, 'APPAREL', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:33:57', NULL),
(4, 'BOOKS', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:34:06', NULL),
(5, 'COMPUTER ACCESSORIES', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:35:04', NULL),
(6, 'MOBILE ACCESSORIES', 1, '2017-04-11 13:09:35', 0, '2017-04-11 07:39:36', NULL),
(7, 'HOME APPLIANCES', 0, '2017-04-12 12:35:26', 0, '2017-04-12 07:05:26', NULL),
(8, 'afdsf', 0, '2017-06-02 18:25:28', 0, '2017-06-02 12:55:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assign_product`
--

CREATE TABLE IF NOT EXISTS `assign_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `image` varchar(50) NOT NULL,
  `category` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `category_2` (`category`),
  KEY `category_3` (`category`),
  KEY `category_4` (`category`),
  KEY `category_5` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `assign_product`
--

INSERT INTO `assign_product` (`id`, `name`, `price`, `image`, `category`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'Nike Air Zoom', 7000.50, 'product_image_1492157197.png', 3, 1, '2017-04-13 15:35:36', 0, '2017-04-13 10:05:55', NULL),
(2, 'Refrigerator', 10000.00, '', 1, 1, '2017-04-13 15:53:47', 0, '2017-04-13 10:23:47', NULL),
(3, 'Denim', 2000.00, 'product_image_1492079093.jpg', 2, 1, '2017-04-13 15:54:53', 0, '2017-04-13 10:24:53', NULL),
(4, 'Shiva Trilogy', 800.00, 'product_image_1492079146.png', 4, 1, '2017-04-13 15:55:46', 0, '2017-04-13 10:25:46', NULL),
(5, 'Logitech Bluetooth multidevice', 2000.00, 'product_image_1492079271.jpg', 5, 1, '2017-04-13 15:57:51', 0, '2017-04-13 10:27:51', NULL),
(6, 'Bluetooth Earphones', 1201.00, 'product_image_1492079329.png', 6, 0, '2017-04-13 15:58:49', 0, '2017-04-13 10:28:49', NULL),
(7, 'Juice Maker', 5000.00, 'product_image_1492079406.png', 7, 0, '2017-04-13 16:00:06', 0, '2017-04-13 10:30:06', NULL),
(8, 'Mahashweta', 501.00, 'product_image_1492079495.png', 4, 1, '2017-04-13 16:01:35', 0, '2017-04-13 10:31:35', NULL),
(9, 'The monk who sold his ferrari', 800.75, 'product_image_1492079599.jpg', 4, 1, '2017-04-13 16:03:19', 0, '2017-04-13 10:33:19', NULL),
(10, 'Nike Joggers', 2500.00, '', 2, 1, '2017-04-14 14:21:52', 0, '2017-04-14 08:51:52', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_product`
--
ALTER TABLE `assign_product`
  ADD CONSTRAINT `Category product relation` FOREIGN KEY (`category`) REFERENCES `assign_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
