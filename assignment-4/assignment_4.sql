-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2017 at 05:50 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `assign_category`
--

INSERT INTO `assign_category` (`id`, `name`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'ELECTRONICS APPLIANCES', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:33:37', NULL),
(2, 'CLOTHINGS', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:33:46', NULL),
(3, 'APPAREL', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:33:57', NULL),
(4, 'BOOKS', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:34:06', NULL),
(5, 'COMPUTER ACCESSORIES', 1, '0000-00-00 00:00:00', 0, '2017-04-11 06:35:04', NULL),
(6, 'MOBILE ACCESSORIES', 1, '2017-04-11 13:09:35', 0, '2017-04-11 07:39:36', NULL),
(7, 'HOME APPLIANCES', 1, '2017-04-12 12:35:26', 0, '2017-04-12 07:05:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assign_product`
--

CREATE TABLE IF NOT EXISTS `assign_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` decimal(11,0) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_product`
--
ALTER TABLE `assign_product`
  ADD CONSTRAINT `Category product relation` FOREIGN KEY (`category`) REFERENCES `assign_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

