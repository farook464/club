-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 10:31 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rg`
--

-- --------------------------------------------------------

--
-- Table structure for table `rt_chat`
--

CREATE TABLE IF NOT EXISTS `rt_chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_agent` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rt_chat`
--

INSERT INTO `rt_chat` (`chat_id`, `request_id`, `user_id`, `agent_id`, `message`, `is_agent`, `created_at`) VALUES
(1, 0, 1, 1, 'hellow', 0, '2015-09-22 20:13:09'),
(2, 0, 1, 1, '123', 0, '2015-09-22 20:13:21'),
(3, 0, 11, 1, 'lol', 0, '2015-09-22 20:21:25'),
(4, 0, 11, 1, 'haha', 0, '2015-09-22 20:22:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
