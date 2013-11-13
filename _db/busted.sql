-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2013 at 10:17 AM
-- Server version: 5.5.20-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `busted`
--

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `title` varchar(8000) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `requirements` varchar(8000) NOT NULL,
  `contact_email` varchar(8000) NOT NULL,
  `department` varchar(8000) NOT NULL,
  `on_location` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `description`, `requirements`, `contact_email`, `department`, `on_location`, `active`) VALUES
(00000001, 'Position1', '<b>Description1</b>', '', 'email1@address.com', 'Department1', 1, 1),
(00000002, 'Position2', '<b>Description2</b>', '', 'email2@address.com', 'Department2', 0, 1),
(00000003, 'Position3', '<b>Description3</b>', '', 'email3@address.com', 'Department3', 1, 0),
(00000004, 'Position4', '<b>Description4</b>', '', 'email4@address.com', 'Department4', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requirement_associative`
--

CREATE TABLE IF NOT EXISTS `requirement_associative` (
  `id_associative` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idpost` int(8) unsigned zerofill NOT NULL,
  `requirement` varchar(8000) NOT NULL,
  PRIMARY KEY (`id_associative`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `requirement_associative`
--

INSERT INTO `requirement_associative` (`id_associative`, `idpost`, `requirement`) VALUES
(00000001, 00000001, 'HTML5/CSS'),
(00000002, 00000001, 'Excellent grasp of JavaScript'),
(00000003, 00000001, 'Excellent knowledge of PHP'),
(00000004, 00000001, 'Experience working in MVC platforms'),
(00000005, 00000001, 'Rugged good looks'),
(00000006, 00000002, 'Experience working in MVC platforms'),
(00000007, 00000002, 'Knowledge of JS libraries and platforms, such as JQuery and Ember.'),
(00000008, 00000002, 'Experience working in an agile environment a plus.'),
(00000009, 00000003, 'Advanced knowledge of Javascript prototyping and object oriented methods.'),
(00000010, 00000003, 'Proficient in SQL.'),
(00000011, 00000003, 'Snazzy wardrobe.'),
(00000012, 00000003, 'Capable of utilizing synergy to increase the pop and sizzle of maximized deliverables.'),
(00000013, 00000003, 'HTML5/CSS3'),
(00000015, 00000004, 'HTML5/CSS3'),
(00000016, 00000004, 'Experience working in MVC platforms'),
(00000017, 00000004, 'Proficient in SQL.'),
(00000018, 00000004, 'Knowledge of JS libraries and platforms, such as JQuery and Ember.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
