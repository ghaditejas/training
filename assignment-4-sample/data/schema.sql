-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2016 at 12:35 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `assignment_4_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `a4_category`
--

CREATE TABLE IF NOT EXISTS `a4_category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `a4_product`
--

CREATE TABLE IF NOT EXISTS `a4_product` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `category_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id_2` (`category_id`,`name`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `a4_product`
--
ALTER TABLE `a4_product`
  ADD CONSTRAINT `a4_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `a4_category` (`id`);
