-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 
-- Generation Time: May 13, 2014 at 10:21 AM
-- Server version: 5.1.66
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `finGame`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(10) unsigned NOT NULL,
  `transaction` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `symbol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  `price` float(65,4) unsigned NOT NULL,
  PRIMARY KEY (`id`,`transaction`,`datetime`,`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `transaction`, `datetime`, `symbol`, `shares`, `price`) VALUES
(25, 'BUY', '2014-05-07 12:23:39', 'OGZPY', 1000, 7.7050),
(25, 'BUY', '2014-05-07 12:23:58', 'OGZPY', 200, 7.7050),
(25, 'BUY', '2014-05-07 12:24:25', 'OGZPY', 100, 7.7050);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(10) NOT NULL,
  `symbol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `symbol`, `shares`) VALUES
(25, 'OGZPY', 1300);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `cash`) VALUES
(25, 'zafar', '$1$l6A/UyI2$96Tme5nIjwYK0pHzF3cM0.', '1.5218');
