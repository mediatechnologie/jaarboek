-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2011 at 03:25 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `php_ma-jaarboek`
--

-- --------------------------------------------------------

--
-- Table structure for table `leerling`
--

CREATE TABLE IF NOT EXISTS `leerling` (
  `leerling_id` int(2) unsigned zerofill NOT NULL COMMENT 'leerlingnummer',
  `voornaam` varchar(33) NOT NULL,
  `tussenvoegsels` varchar(33) DEFAULT NULL,
  `achternaam` varchar(33) NOT NULL,
  `richting` int(1) NOT NULL,
  `beschrijving` varchar(222) NOT NULL,
  `wachtwoord` char(32) CHARACTER SET ascii DEFAULT NULL,
  `avatar` varchar(33) NOT NULL,
  PRIMARY KEY (`leerling_id`),
  KEY `richting` (`richting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leerling`
--


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leerling_id` int(2) unsigned zerofill NOT NULL,
  `naam` varchar(33) NOT NULL,
  `beschrijving` varchar(222) NOT NULL,
  `image` varchar(33) DEFAULT NULL,
  `external_link` varchar(222) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `leerling_id` (`leerling_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `project`
--


-- --------------------------------------------------------

--
-- Table structure for table `projectdata`
--

CREATE TABLE IF NOT EXISTS `projectdata` (
  `project_id` int(10) unsigned NOT NULL,
  `data_id` int(1) unsigned NOT NULL,
  `locatie` varchar(33) NOT NULL,
  `mimetype` varchar(33) NOT NULL,
  PRIMARY KEY (`project_id`,`data_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projectdata`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`leerling_id`) REFERENCES `leerling` (`leerling_id`) ON UPDATE CASCADE;

--
-- Constraints for table `projectdata`
--
ALTER TABLE `projectdata`
  ADD CONSTRAINT `projectdata_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

