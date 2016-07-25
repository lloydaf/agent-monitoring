-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2016 at 10:15 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agent`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_details`
--

CREATE TABLE IF NOT EXISTS `agent_details` (
  `agent_name` varchar(255) NOT NULL,
  `agent_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `add_line_1` varchar(255) NOT NULL,
  `add_line_2` varchar(255) DEFAULT NULL,
  `add_street` varchar(255) DEFAULT NULL,
  `add_area` varchar(255) NOT NULL,
  `add_city` varchar(255) NOT NULL,
  `agent_poc` varchar(255) DEFAULT NULL,
  `agent_contact_number` varchar(255) DEFAULT NULL,
  `available_to_add` tinyint(1) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `agent_info`
--

CREATE TABLE IF NOT EXISTS `agent_info` (
  `Agent_Name` varchar(255) NOT NULL,
  `POC` varchar(255) NOT NULL,
  `Contact_No` varchar(13) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Available_to_add` tinyint(1) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Contact_No`),
  UNIQUE KEY `Contact_No` (`Contact_No`),
  KEY `Agent_Name` (`Agent_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `live_sessions`
--

CREATE TABLE IF NOT EXISTS `live_sessions` (
  `username` varchar(255) NOT NULL,
  `session_id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`username`),
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Table structure for table `pending_requests`
--

CREATE TABLE IF NOT EXISTS `pending_requests` (
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `contact_no` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `visited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `region_of_work` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`username`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `contact_no` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `visited_date` date NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
