-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2015 at 04:38 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projectone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` double NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `logindate` datetime NOT NULL,
  `username` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `user_type` int(2) NOT NULL COMMENT '0->Super Admin,1->Employee',
  `Created_date` date NOT NULL,
  `Modify_date` date NOT NULL,
  `Created_Id` int(11) NOT NULL,
  `Modify_Id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active,2-deleted',
  UNIQUE KEY `adminid` (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `logindate`, `username`, `password`, `email`, `user_type`, `Created_date`, `Modify_date`, `Created_Id`, `Modify_Id`, `status`) VALUES
(1, 'admin', 'admin', '2015-10-26 13:17:00', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'vijay.raiyani@vrinsofts.com', 0, '2011-08-16', '2013-08-08', 0, 1, 1),
(2, 'brinda', 'mehta', '2013-08-08 12:46:00', 'brindamehta', 'd12efb10fc97e865b8dbf409cc356091', 'brinda@vrinsoft.com', 0, '2013-08-08', '0000-00-00', 1, 0, 2),
(3, 'brinda', 'mehta', '0000-00-00 00:00:00', 'brinda', 'd12efb10fc97e865b8dbf409cc356091', 'brindamehta@vrinsoft.com', 0, '2013-08-08', '0000-00-00', 2, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rollmanagement`
--

CREATE TABLE IF NOT EXISTS `rollmanagement` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_Id` int(11) NOT NULL,
  `mainsection` varchar(100) NOT NULL,
  `subsection` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `categoryName`, `cr_date`, `status`) VALUES
(1, 'Cat one', '0000-00-00 00:00:00', 1),
(2, 'Cat two', '2014-10-04 14:19:02', 1),
(3, 'Cat three', '2015-10-05 00:59:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE IF NOT EXISTS `tbl_city` (
  `Id` int(4) NOT NULL AUTO_INCREMENT,
  `countryId` int(4) NOT NULL,
  `stateId` int(11) NOT NULL,
  `cityName` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`Id`, `countryId`, `stateId`, `cityName`, `status`) VALUES
(22, 1, 1, 'Tarrytown', 2),
(23, 2, 3, 'Rajkot', 1),
(24, 2, 3, 'Ahmedabad', 1),
(25, 2, 3, 'Junagadh', 2),
(26, 1, 1, 'Harrison', 2),
(27, 1, 1, 'Gedney', 2),
(28, 1, 2, 'Readville', 2),
(29, 1, 2, 'Hull', 2),
(30, 1, 9, 'Buckhorn', 2),
(31, 2, 3, 'aaa', 2),
(32, 8, 14, 'dsgdg', 2),
(33, 10, 11, 'ny', 2),
(34, 10, 11, 'swiden', 2),
(35, 2, 3, 'kadi', 2),
(36, 10, 11, 'swiden', 1),
(37, 2, 3, 'jamnagar', 2),
(38, 2, 3, 'jamnagar', 1),
(39, 2, 3, 'Agra', 1),
(40, 2, 3, 'Agenta', 2),
(41, 10, 11, 'Agraa', 2),
(42, 10, 11, 'agra', 2),
(43, 10, 11, 'Agra', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `Id` int(4) NOT NULL AUTO_INCREMENT,
  `countryName` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `time_zone` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`Id`, `countryName`, `status`, `time_zone`) VALUES
(1, 'US', 2, '-8.0'),
(2, 'India', 1, 'GMT -8:00'),
(3, 'South Africa', 2, '2.0'),
(4, 'Paris', 2, '1.0'),
(5, 'Alaska', 2, '-9.0'),
(6, 'south africa', 1, 'GMT -4:00'),
(7, 'Tehran', 2, '3.5'),
(8, 'us', 1, 'GMT +2:00'),
(9, 'asia', 2, '-6.0'),
(10, 'canada', 1, 'GMT -5:00'),
(11, 'africa', 1, 'GMT -2:00'),
(12, 'test', 2, '-12.0'),
(13, 'USA', 2, 'GMT -7:00'),
(14, 'UK', 2, 'GMT -6:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(255) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `reg_type` int(2) NOT NULL COMMENT '0-Normal, 1-Facebook',
  `username` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `mobileno` varchar(22) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `ref_id`, `fb_id`, `reg_type`, `username`, `emailid`, `password`, `country`, `state`, `city`, `mobileno`, `cr_date`, `status`) VALUES
(1, 'REG03102014095401', '', 0, 'username', 'test@email.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 3, 24, '1234567890', '2014-05-16 22:29:12', 1),
(2, 'REG03102014095402', '', 0, 'username', 'testuser@email.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '', '2014-10-03 15:24:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

CREATE TABLE IF NOT EXISTS `tbl_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offerCategory` int(11) NOT NULL,
  `offerName` varchar(255) NOT NULL,
  `offerCode` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `neededPoints` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `image` text NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_offers`
--

INSERT INTO `tbl_offers` (`id`, `offerCategory`, `offerName`, `offerCode`, `price`, `neededPoints`, `country`, `image`, `cr_date`, `status`) VALUES
(1, 1, 'OFFER 15 OFF', 'OFF15RGC5', '15.00', 15000, 2, '280914192054Penguins.jpg', '2014-09-29 00:48:37', 1),
(2, 1, 'BEST OFFERS PAYPAL', 'BSTOFFPAY456', '20.00', 20000, 2, '041014084832Desert.jpg', '2014-10-04 14:18:33', 1),
(3, 2, 'Amazon Offers', 'AMZOFF3456', '50.00', 30000, 2, '041014084936Tulips.jpg', '2014-10-04 14:19:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plans`
--

CREATE TABLE IF NOT EXISTS `tbl_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` decimal(10,2) NOT NULL,
  `image_limit` int(5) NOT NULL,
  `month` int(5) NOT NULL COMMENT 'Number of month',
  `category` text NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_plans`
--

INSERT INTO `tbl_plans` (`id`, `plan_name`, `plan_price`, `image_limit`, `month`, `category`, `cr_date`, `status`) VALUES
(1, 'Basic', '0.00', 5, 1, '1', '2015-10-09 00:00:00', 1),
(2, 'Silver', '10.00', 30, 6, '1,2', '2015-10-10 00:00:00', 1),
(3, 'Gold', '100.00', 500, 12, '1,2,3', '2015-10-11 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rewards`
--

CREATE TABLE IF NOT EXISTS `tbl_rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `reward_img` int(5) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_rewards`
--

INSERT INTO `tbl_rewards` (`id`, `user_id`, `reward_img`, `cr_date`, `status`) VALUES
(1, 21, 5, '2015-10-13 00:41:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE IF NOT EXISTS `tbl_section` (
  `Section_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT 'default.png',
  `Description` text,
  `Order_no` int(11) DEFAULT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0-inactive,1-active,2-deleted',
  PRIMARY KEY (`Section_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`Section_Id`, `Name`, `Link`, `Image`, `Description`, `Order_no`, `page_name`, `section_name`, `status`) VALUES
(1, 'Dashboard', 'dashboard', 'dashboard.png', 'This is Dashboard Page...', 1, 'Dashboard', 'Manage Dashboard', 1),
(2, 'Master', 'country', 'default.png', 'This is master section..', 15, 'Country', 'Manage Country', 1),
(54, 'Category', 'category', 'default.png', NULL, 5, 'Category', 'Category Management', 1),
(57, 'Artist Management', 'artists', 'default.png', NULL, 2, 'Artist Management', 'Artist Management', 1),
(58, 'Packages', 'plans', 'default.png', NULL, 3, 'Packages', 'Packages', 1),
(59, 'Rewards', 'rewards', 'default.png', NULL, 4, 'Rewards', 'Rewards', 1),
(60, 'Payment', 'payment', 'default.png', NULL, 5, 'Payment', 'Payment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sectionlink`
--

CREATE TABLE IF NOT EXISTS `tbl_sectionlink` (
  `Subsection_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Section_Id` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'default.png',
  `Order_no` int(11) DEFAULT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0-inactive,1-active,2-deleted',
  PRIMARY KEY (`Subsection_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_sectionlink`
--

INSERT INTO `tbl_sectionlink` (`Subsection_Id`, `Section_Id`, `Title`, `Link`, `Image`, `Order_no`, `page_name`, `section_name`, `status`) VALUES
(1, 2, 'Country Management', 'country', 'default.png', 1, 'Country', 'Manage Country', 1),
(5, 2, 'Settings', 'setting', 'default.png', 6, 'Settings', 'Manage Settings', 1),
(15, 2, 'State Management', 'state', 'default.png', 2, 'State', 'Manage State', 1),
(16, 2, 'City Management', 'city', 'default.png', 3, 'City', 'Manage City', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL COMMENT 'site info email',
  `theme` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`Id`, `email`, `theme`) VALUES
(1, 'admin@yahoo.com', 'screen_blue.css');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
  `Id` int(4) NOT NULL AUTO_INCREMENT,
  `countryId` int(4) NOT NULL,
  `stateName` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`Id`, `countryId`, `stateName`, `status`) VALUES
(1, 1, 'NY', 2),
(2, 1, 'MA', 2),
(3, 2, 'Gujarat', 1),
(4, 2, 'Maharashtra', 1),
(5, 2, 'Karnataka', 2),
(6, 1, 'ID', 2),
(7, 1, 'IL', 2),
(8, 1, 'KS', 2),
(9, 1, 'CA', 2),
(10, 2, 'Kerala', 1),
(11, 10, 'saskatvan', 1),
(12, 12, 'tes', 2),
(13, 8, 'new york', 1),
(14, 8, 'califonia', 1),
(15, 2, 'rajasthan', 1),
(16, 11, 'aaaaaaaabbbbb', 2),
(17, 2, 'sdfsdf', 2),
(18, 10, 'torento', 2),
(19, 11, 'vbnv n', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `plan_id` int(11) NOT NULL,
  `image_limit` int(5) NOT NULL,
  `usertype` int(2) NOT NULL COMMENT '1-Artist, 2-Client, 3-Company',
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL COMMENT '0-Inactive, 1-Active, 2-Deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `ref_id`, `first_name`, `last_name`, `emailid`, `password`, `gender`, `country`, `state`, `city`, `mobileno`, `image`, `plan_id`, `image_limit`, `usertype`, `cr_date`, `status`) VALUES
(2, 'ART10041520034166', 'Ajesh', 'Nair', 'ajesh.nair@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 0, '1234567890', '041015200340280914192054Penguins.jpg', 1, 0, 0, '2015-10-05 01:33:41', 1),
(21, 'ART10111520400431', 'Ajesh', 'Nair', 'ajshnr@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 0, '1234567890', '111015224251Chrysanthemum.jpg', 3, 503, 0, '2015-10-12 02:10:04', 1),
(25, 'ART10261520543714', 'Ajesh', 'Nair', 'ajesh.nair@outlook.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 10, 11, 36, '', '', 1, 1, 1, '2015-10-27 02:24:37', 1),
(26, 'ART10261520551620', 'Ajesh', 'Nair', 'ajesh.nair.test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 10, 11, 36, '', '', 0, 0, 2, '2015-10-27 02:25:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_images`
--

CREATE TABLE IF NOT EXISTS `tbl_user_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `image` text NOT NULL,
  `image_text` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_user_images`
--

INSERT INTO `tbl_user_images` (`id`, `user_id`, `image`, `image_text`, `category_id`, `cr_date`, `status`) VALUES
(1, 21, '121015010046Desert.jpg', 'Test Text', 1, '2015-10-12 06:30:46', 1),
(2, 21, '121015014035Tulips.jpg', 'Test Two', 3, '2015-10-12 07:10:36', 1),
(3, 25, '261015230611Tulips.jpg', 'Test Text One', 1, '2015-10-27 04:36:11', 1),
(4, 25, '261015230627Desert.jpg', 'Test Text Two', 1, '2015-10-27 04:36:27', 1),
(5, 25, '261015230647Koala.jpg', 'Test Text Three', 1, '2015-10-27 04:36:47', 1),
(6, 25, '261015231541Jellyfish.jpg', 'Test Text Four', 1, '2015-10-27 04:45:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_plan`
--

CREATE TABLE IF NOT EXISTS `tbl_user_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `cr_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_user_plan`
--

INSERT INTO `tbl_user_plan` (`id`, `plan_id`, `user_id`, `start_date`, `end_date`, `paid_amount`, `cr_date`, `status`) VALUES
(15, 3, 21, '2015-10-11', '2016-10-11', '100.00', '2015-10-12 04:40:40', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
