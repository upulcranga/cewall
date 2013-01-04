-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2013 at 06:23 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cewall`
--

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE IF NOT EXISTS `floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `floor_name` (`floor_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`id`, `floor_name`) VALUES
(2, '1st Floor'),
(1, 'Ground Floor'),
(3, 'Top Floor');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE IF NOT EXISTS `lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_name` varchar(30) NOT NULL,
  `floor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lab_name` (`lab_name`),
  KEY `floor_id` (`floor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `lab_name`, `floor_id`) VALUES
(1, 'Network Lab', 1),
(2, 'Meeting Room', 1),
(3, 'hSenid Research Lab', 2),
(4, 'IFS Lab', 2),
(5, 'Logic Networks Lab', 2),
(6, 'Software Testing Lab', 2),
(8, 'CRS Lab', 2),
(9, 'Data Mining Lab', 2),
(10, 'CE Main Lab', 3),
(11, 'ESCAL', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notice_entry`
--

CREATE TABLE IF NOT EXISTS `notice_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL,
  `notice_by` varchar(30) NOT NULL,
  `caption` varchar(200) NOT NULL,
  `time_to_display` int(3) NOT NULL,
  `show_on` date NOT NULL,
  `hide_after` date NOT NULL,
  `file_path` varchar(70) NOT NULL,
  `display` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_path` (`file_path`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `notice_entry`
--

INSERT INTO `notice_entry` (`id`, `type`, `notice_by`, `caption`, `time_to_display`, `show_on`, `hide_after`, `file_path`, `display`) VALUES
(7, 3, 'Vajira Thambawita', 'Test Notice', 6, '2012-01-01', '2022-12-31', 'upload/text/1321182082.html', 0),
(14, 1, 'Kalindu Herath', 'Must watch film', 5, '2012-01-01', '2022-12-31', 'upload/image/1321521844.BMP', 0),
(16, 3, 'Kalindu Herath', 'All CE Students', 5, '2012-01-01', '2022-12-31', 'upload/text/1321857213.html', 0),
(17, 4, 'Kalindu Herath', 'Motorola Winning Team', 5, '2012-01-01', '2022-12-31', 'upload/photo/1327465398.jpg', 1),
(18, 4, 'Kalindu Herath', 'Our Imagine Cup Winners', 5, '2012-01-01', '2022-12-31', 'upload/photo/1327735525.jpg', 0),
(26, 3, 'Instructor In Charge', 'GP 106-Reschedule Labs', 10, '2012-01-01', '2022-12-31', 'upload/text/1351065550.html', 0),
(27, 1, 'Instructed by HoD', 'Study in New Zealand', 10, '2012-01-01', '2022-12-31', 'upload/image/1351068717.JPG', 0),
(32, 1, 'Test', 'Ground Floor Layout', 5, '2012-01-01', '2022-12-31', 'upload/image/1351136210.jpg', 0),
(33, 1, 'Instructed by Dean', 'Time Table Part I', 10, '2012-01-01', '2022-12-31', 'upload/image/1351485055.bmp', 0),
(34, 1, 'Instructed by Dean', 'Time Table Part II', 10, '2012-01-01', '2022-12-31', 'upload/image/1351485076.bmp', 0),
(35, 3, 'Instructed by Dean', 'Course Registration', 10, '2012-01-01', '2022-12-31', 'upload/text/1351485243.html', 0),
(40, 1, 'Roshan Ragel', 'Floor Plan - Ground', 15, '2012-01-01', '2022-12-31', 'upload/image/1352177668.jpg', 1),
(41, 1, 'Roshan Ragel', 'Floor Plan - First', 10, '2012-01-01', '2022-12-31', 'upload/image/1352177685.jpg', 1),
(42, 1, 'Roshan Ragel', 'Floor Plan - Top', 10, '2012-01-01', '2022-12-31', 'upload/image/1352177698.jpg', 1),
(52, 3, 'Roshan Ragel', 'E/09 GE Semester', 15, '0000-00-00', '0000-00-00', 'upload/text/1355113700.html', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notice_type`
--

CREATE TABLE IF NOT EXISTS `notice_type` (
  `id` int(2) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice_type`
--

INSERT INTO `notice_type` (`id`, `type`) VALUES
(1, 'image'),
(4, 'photo'),
(3, 'text'),
(2, 'video');

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE IF NOT EXISTS `periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hour` char(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hour` (`hour`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `hour`) VALUES
(1, '0800-0900'),
(2, '0900-1000'),
(3, '1000-1100'),
(4, '1100-1200'),
(5, '1200-1300'),
(6, '1300-1400'),
(7, '1400-1500'),
(8, '1500-1600'),
(9, '1600-1700'),
(10, '1700-1800');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE IF NOT EXISTS `presence` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `presence_type` varchar(22) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `presence_type` (`presence_type`),
  KEY `presence_type_2` (`presence_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`id`, `presence_type`) VALUES
(5, 'Available'),
(3, 'Away'),
(6, 'Away, will be back at '),
(4, 'Busy'),
(1, 'No Data'),
(2, 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_entry`
--

CREATE TABLE IF NOT EXISTS `reservation_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lab` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lab` (`lab`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `reservation_entry`
--

INSERT INTO `reservation_entry` (`id`, `lab`, `start`, `end`, `description`) VALUES
(1, 1, '2011-11-17 09:00:00', '2011-11-17 10:00:00', 'Routing Algorithms'),
(11, 1, '2011-11-17 08:00:00', '2011-11-17 09:00:00', 'CO314'),
(13, 1, '2012-03-11 20:00:00', '2012-03-11 20:30:00', 'CO512'),
(14, 10, '2012-08-02 10:00:00', '2012-08-02 12:00:00', 'Repair :D'),
(15, 10, '2012-10-24 10:00:00', '2012-10-24 10:30:00', 'Testing'),
(16, 1, '2012-10-24 09:30:00', '2012-10-24 10:30:00', 'Advance Network Lab'),
(18, 5, '2012-10-23 17:00:00', '2012-10-23 20:00:00', 'E-Notice Board Demo'),
(19, 1, '2012-10-23 16:00:00', '2012-10-23 17:00:00', 'Talk-Shine Sort(Pramoth)');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `status_more` varchar(10) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `floor_id` (`floor_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `floor_id`, `status`, `status_more`) VALUES
(1, 'Dr. M.Sandirigama', 1, 5, ''),
(2, 'Dr. S.D.Dewasurendra', 2, 5, ''),
(3, 'Dr. S.Radhakrishnan', 2, 5, ''),
(4, 'Mr. Z.Marikkar', 2, 5, ''),
(5, 'Mr. S.Deegalla', 2, 5, ''),
(6, 'Dr. R.G.Ragel', 3, 5, ''),
(7, 'Dr. D.Elkaduwe', 3, 5, ''),
(8, 'Dr. R. Krishanthmohan', 2, 5, ''),
(9, 'Dr. K.Samarakoon', 2, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', '6572bdaff799084b973320f43f09b363', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(2) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lab`
--
ALTER TABLE `lab`
  ADD CONSTRAINT `lab_ibfk_1` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice_entry`
--
ALTER TABLE `notice_entry`
  ADD CONSTRAINT `notice_entry_ibfk_1` FOREIGN KEY (`type`) REFERENCES `notice_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_entry`
--
ALTER TABLE `reservation_entry`
  ADD CONSTRAINT `reservation_entry_ibfk_1` FOREIGN KEY (`lab`) REFERENCES `lab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`status`) REFERENCES `presence` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`type`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
