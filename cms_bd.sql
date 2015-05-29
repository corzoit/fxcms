-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2015 at 08:06 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fakupucp`
--

-- --------------------------------------------------------

--
-- Table structure for table `fxsys`
--

CREATE TABLE IF NOT EXISTS `fxsys` (
  `fxsys_id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(45) NOT NULL,
  `version` varchar(10) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `last_update_dt` datetime NOT NULL,
  `client_business` varchar(100) NOT NULL,
  `client_first_name` varchar(45) NOT NULL,
  `client_last_name` varchar(45) NOT NULL,
  `client_email` varchar(45) NOT NULL COMMENT 'admin',
  `support_email` varchar(45) NOT NULL,
  `lang_sys` varchar(3) NOT NULL,
  `lang_main` varchar(3) NOT NULL,
  `opt_multi_lang` tinyint(1) NOT NULL,
  `timezone` varchar(45) NOT NULL,
  `dt_format` varchar(20) NOT NULL,
  `d_format` varchar(20) NOT NULL,
  `facebook` varchar(45) NOT NULL,
  `twitter` varchar(45) NOT NULL,
  `linkedin` varchar(45) NOT NULL,
  `youtube` varchar(45) NOT NULL,
  `ga` longtext NOT NULL,
  `footer` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`fxsys_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fxsys`
--

INSERT INTO `fxsys` (`fxsys_id`, `auth_key`, `version`, `creation_dt`, `last_update_dt`, `client_business`, `client_first_name`, `client_last_name`, `client_email`, `support_email`, `lang_sys`, `lang_main`, `opt_multi_lang`, `timezone`, `dt_format`, `d_format`, `facebook`, `twitter`, `linkedin`, `youtube`, `ga`, `footer`, `status`) VALUES
(1, 'AsdKE', '0.1', '2015-05-25 00:00:00', '0000-00-00 00:00:00', 'University', '', '', '', '', 'es', 'es', 1, 'America/Lima', 'd/m/y h:i a', 'd/m/y', '', '', '', '', '', '', 1),
(2, 'AsdKEIjk', '0.1', '2015-05-25 00:00:00', '0000-00-00 00:00:00', 'University', '', '', '', '', 'en', 'en', 1, 'America/Los_Angeles', 'm/d/y h:i a', 'm/d/y', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fxsyslang`
--

CREATE TABLE IF NOT EXISTS `fxsyslang` (
  `fxsyslang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fxsys_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  PRIMARY KEY (`fxsyslang_id`),
  UNIQUE KEY `lang_UNIQUE` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fxsyslang`
--

INSERT INTO `fxsyslang` (`fxsyslang_id`, `fxsys_id`, `lang`) VALUES
(1, 1, 'es'),
(2, 2, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `fxsysuser`
--

CREATE TABLE IF NOT EXISTS `fxsysuser` (
  `fxsysuser_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'admin' COMMENT 'admin',
  PRIMARY KEY (`fxsysuser_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `fxsysuser_id` (`fxsysuser_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fxsysuser`
--

INSERT INTO `fxsysuser` (`fxsysuser_id`, `first_name`, `last_name`, `email`, `password`, `type`) VALUES
(4, 'alex', 'corzo', 'alexcorzo@gmail.com', '7e6beb26cb9dd7abaf8ecf95257a9245', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `fxsysuser_log`
--

CREATE TABLE IF NOT EXISTS `fxsysuser_log` (
  `fxsysuser_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `fxsysuser_id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `login_dt` datetime NOT NULL,
  `logout_dt` datetime NOT NULL,
  `expires_dt` datetime NOT NULL,
  PRIMARY KEY (`fxsysuser_log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=359 ;

--
-- Dumping data for table `fxsysuser_log`
--

INSERT INTO `fxsysuser_log` (`fxsysuser_log_id`, `fxsysuser_id`, `session_id`, `login_dt`, `logout_dt`, `expires_dt`) VALUES
(351, 4, '2simhqnllvofuqppod94c3qq84', '2015-05-25 17:26:38', '2015-05-25 17:27:05', '2015-05-25 22:26:38'),
(352, 4, 'u0ci83im1q52qqc2glu3v49ff6', '2015-05-25 17:32:07', '0000-00-00 00:00:00', '2015-05-25 22:32:07'),
(353, 4, 'u0ci83im1q52qqc2glu3v49ff6', '2015-05-25 22:45:51', '0000-00-00 00:00:00', '2015-05-26 03:45:51'),
(354, 4, 'c9jsvvifnv58qaoc3th8k85rr1', '2015-05-26 14:54:05', '0000-00-00 00:00:00', '2015-05-26 19:54:05'),
(355, 4, 'boedc1h9rao6l0fjfbmt8931q3', '2015-05-26 16:02:23', '0000-00-00 00:00:00', '2015-05-26 21:02:23'),
(356, 4, '1q13nuckiumafhfogn69r2s876', '2015-05-27 14:47:56', '0000-00-00 00:00:00', '2015-05-27 19:47:56'),
(357, 4, '1q13nuckiumafhfogn69r2s876', '2015-05-27 19:49:28', '0000-00-00 00:00:00', '2015-05-28 00:49:28'),
(358, 4, 'htro2tp4pm5phg0gal9jvo5592', '2015-05-28 17:05:42', '0000-00-00 00:00:00', '2015-05-28 22:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `fx_author`
--

CREATE TABLE IF NOT EXISTS `fx_author` (
  `fx_author_id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_dt` datetime NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `facebook` varchar(45) NOT NULL,
  `twitter` varchar(45) NOT NULL,
  `linkedin` varchar(45) NOT NULL,
  `youtube` varchar(45) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_author_lang`
--

CREATE TABLE IF NOT EXISTS `fx_author_lang` (
  `fx_author_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_author_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`fx_author_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_contact`
--

CREATE TABLE IF NOT EXISTS `fx_contact` (
  `fx_contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_dt` datetime NOT NULL,
  `lang` varchar(3) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dob` varchar(45) NOT NULL,
  `business` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `suburb` varchar(45) NOT NULL,
  `postcode` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `opt_email` varchar(45) NOT NULL,
  `opt_sms` varchar(45) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_contact_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  FULLTEXT KEY `first_name` (`first_name`,`last_name`,`email`,`business`,`phone`,`mobile`,`address`,`country`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_contact_message`
--

CREATE TABLE IF NOT EXISTS `fx_contact_message` (
  `fx_contact_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_contact_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `lang` varchar(3) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `admin_reply` tinyint(1) NOT NULL COMMENT 'indicates admin wrote the message',
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_contact_message_id`),
  FULLTEXT KEY `subject` (`subject`,`message`),
  FULLTEXT KEY `subject_2` (`subject`,`message`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_design`
--

CREATE TABLE IF NOT EXISTS `fx_design` (
  `fx_design_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `html_content` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`fx_design_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fx_design`
--

INSERT INTO `fx_design` (`fx_design_id`, `name`, `html_content`, `status`) VALUES
(1, 'design1', '<div id="cont_1432834927242" class="ui-draggable ui-draggable-handle a-container-h CtxMenuH ui-droppable" data-type="a-container-h"><div style="width: 100%; text-align: center;" id="wid_1432834927804" class="ui-draggable ui-draggable-handle a-widget CtxMenuW ui-resizable" data-type="a-widget"><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-e"></div><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-s"></div><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se"></div><h3 class="widget-title">Header</h3></div></div><div id="cont_1432834928879" class="ui-draggable ui-draggable-handle a-container-h CtxMenuH ui-droppable" data-type="a-container-h"><div style="width: 100%; text-align: center;" id="wid_1432834930726" class="ui-draggable ui-draggable-handle a-widget CtxMenuW ui-resizable" data-type="a-widget"><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-e"></div><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-s"></div><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se"></div><h3 class="widget-title">Content</h3></div></div><div id="cont_1432834938646" class="ui-draggable ui-draggable-handle a-container-h CtxMenuH ui-droppable" data-type="a-container-h"><div style="width: 100%;" id="wid_1432834940160" class="ui-draggable ui-draggable-handle a-widget CtxMenuW ui-resizable" data-type="a-widget"><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-e"></div><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-s"></div><div style="z-index: 90;" class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se"></div></div></div>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fx_folder`
--

CREATE TABLE IF NOT EXISTS `fx_folder` (
  `fx_folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_folder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fx_folder`
--

INSERT INTO `fx_folder` (`fx_folder_id`, `owner_id`, `name`, `deleted`) VALUES
(1, 0, 'media', 0),
(2, 1, 'img', 0),
(3, 1, 'documents', 0),
(4, 0, 'repository', 0),
(5, 4, 'page', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_form`
--

CREATE TABLE IF NOT EXISTS `fx_form` (
  `fx_form_id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_dt` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `intro` longtext NOT NULL,
  `target_email` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_answer`
--

CREATE TABLE IF NOT EXISTS `fx_form_answer` (
  `fx_form_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_page_id` int(11) NOT NULL,
  `fx_contact_id` int(11) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `lang` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`fx_form_answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_field`
--

CREATE TABLE IF NOT EXISTS `fx_form_field` (
  `fx_form_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `field_behaviour` varchar(20) NOT NULL DEFAULT 'none' COMMENT 'none,first_name,last_name,etc...',
  `field_type` varchar(20) NOT NULL COMMENT 'text, long-text, radio, combo, checkbox, unique-code,reusable-code',
  `options` longtext NOT NULL,
  `compulsory` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`fx_form_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_field_answer`
--

CREATE TABLE IF NOT EXISTS `fx_form_field_answer` (
  `fx_form_field_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_field_id` int(11) NOT NULL,
  `fx_form_answer_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`fx_form_field_answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_field_lang`
--

CREATE TABLE IF NOT EXISTS `fx_form_field_lang` (
  `fx_form_field_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_field_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  PRIMARY KEY (`fx_form_field_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_lang`
--

CREATE TABLE IF NOT EXISTS `fx_form_lang` (
  `fx_form_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `intro` longtext NOT NULL,
  PRIMARY KEY (`fx_form_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_page`
--

CREATE TABLE IF NOT EXISTS `fx_form_page` (
  `fx_form_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_id` int(11) NOT NULL,
  `fx_page_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `intro` longtext NOT NULL,
  `target_email` varchar(100) NOT NULL,
  PRIMARY KEY (`fx_form_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_form_page_lang`
--

CREATE TABLE IF NOT EXISTS `fx_form_page_lang` (
  `fx_form_page_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_form_page_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `intro` longtext NOT NULL,
  PRIMARY KEY (`fx_form_page_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_media`
--

CREATE TABLE IF NOT EXISTS `fx_media` (
  `fx_media_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_folder_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_type` varchar(45) NOT NULL,
  `size_kb` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_menu`
--

CREATE TABLE IF NOT EXISTS `fx_menu` (
  `fx_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_dt` datetime NOT NULL,
  `key_menu` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `fx_menu`
--

INSERT INTO `fx_menu` (`fx_menu_id`, `creation_dt`, `key_menu`, `description`, `private`, `position`, `deleted`) VALUES
(7, '2015-05-25 18:02:22', 'top', 'Menu', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_menu_lang`
--

CREATE TABLE IF NOT EXISTS `fx_menu_lang` (
  `fx_menu_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_menu_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`fx_menu_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_order`
--

CREATE TABLE IF NOT EXISTS `fx_order` (
  `fx_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_contact_id` int(11) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `lang` varchar(3) NOT NULL,
  `comments` longtext NOT NULL,
  `del_fee` float NOT NULL,
  `del_address` varchar(45) NOT NULL,
  `del_suburb` varchar(45) NOT NULL,
  `del_postcode` varchar(45) NOT NULL,
  `del_country` varchar(45) NOT NULL,
  `discount_value` float NOT NULL,
  `discount_per` float NOT NULL,
  `tax` float NOT NULL,
  `total` float NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_order_comment`
--

CREATE TABLE IF NOT EXISTS `fx_order_comment` (
  `fx_order_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_order_id` int(11) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `lang` varchar(3) NOT NULL,
  `comments` longtext NOT NULL,
  `admin_reply` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_order_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_order_line`
--

CREATE TABLE IF NOT EXISTS `fx_order_line` (
  `fx_order_line_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_order_id` int(11) NOT NULL,
  `fx_page_id` int(11) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `price` float NOT NULL,
  `discount_val` float NOT NULL,
  `discount_per` float NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_order_line_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_page`
--

CREATE TABLE IF NOT EXISTS `fx_page` (
  `fx_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_section_id` int(11) NOT NULL,
  `fx_author_id` int(11) NOT NULL,
  `creation_dt` varchar(45) NOT NULL,
  `last_update_dt` varchar(45) NOT NULL,
  `start_dt` datetime NOT NULL,
  `end_dt` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_key` varchar(45) NOT NULL,
  `content` longtext NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `meta_title` longtext NOT NULL,
  `meta_keywords` longtext NOT NULL,
  `meta_description` longtext NOT NULL,
  `comments_type` varchar(10) NOT NULL DEFAULT 'none' COMMENT 'none, admin, facebook',
  `private` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `page_default` tinyint(1) NOT NULL COMMENT '1 => default',
  `page_type` varchar(10) NOT NULL COMMENT 'none,gallery',
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_page_id`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=474 ;

--
-- Dumping data for table `fx_page`
--

INSERT INTO `fx_page` (`fx_page_id`, `fx_section_id`, `fx_author_id`, `creation_dt`, `last_update_dt`, `start_dt`, `end_dt`, `title`, `title_key`, `content`, `thumbnail`, `image`, `meta_title`, `meta_keywords`, `meta_description`, `comments_type`, `private`, `position`, `page_default`, `page_type`, `deleted`) VALUES
(473, 58, 0, '2015-05-27 22:02:40', '', '2015-05-25 22:02:00', '2015-06-06 22:02:00', 'In&iacute;cio', '', '<h3 style="box-sizing: border-box; margin-top: 20px; margin-bottom: 10px; font-family: Montserrat, sans-serif; font-weight: 500; line-height: 1.1; color: #333333; font-size: 24px; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><a style="box-sizing: border-box; color: #428bca; text-decoration: none; background-color: transparent;" href="http://www.fakupucp.com/">Inicio</a></h3>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #333333; font-family: Montserrat, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="box-sizing: border-box; color: #292f33; font-family: Arial, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; float: none; display: inline !important; background-color: #f5f8fa;">Somos la mejor Asesoria Universitaria......</span></p>', 'download_36713.jpg', 'download_74573.jpg', '', '', '', 'none', 0, 0, 1, 'none', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_page_file`
--

CREATE TABLE IF NOT EXISTS `fx_page_file` (
  `fx_page_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_page_id` int(11) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`fx_page_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_page_lang`
--

CREATE TABLE IF NOT EXISTS `fx_page_lang` (
  `fx_page_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_page_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `title` varchar(45) NOT NULL,
  `title_key` varchar(45) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(45) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL,
  `meta_description` varchar(45) NOT NULL,
  PRIMARY KEY (`fx_page_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_post`
--

CREATE TABLE IF NOT EXISTS `fx_post` (
  `fx_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_contact_id` int(11) NOT NULL,
  `fx_page_id` int(11) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `lang` varchar(3) NOT NULL,
  `comments` longtext NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_post_id`),
  FULLTEXT KEY `comments` (`comments`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_product`
--

CREATE TABLE IF NOT EXISTS `fx_product` (
  `fx_page_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount_val` float NOT NULL,
  `discount_per` float NOT NULL,
  `stock` int(11) NOT NULL,
  `hide_no_stock` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fx_section`
--

CREATE TABLE IF NOT EXISTS `fx_section` (
  `fx_section_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_menu_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `creation_dt` datetime NOT NULL,
  `title` varchar(45) NOT NULL,
  `intro` longtext NOT NULL,
  `section_type` varchar(45) NOT NULL DEFAULT 'standard' COMMENT 'standard,blog,product',
  `display_type` varchar(45) NOT NULL DEFAULT 'list' COMMENT 'list,grid',
  `icon` varchar(100) NOT NULL,
  `opt_link` tinyint(1) NOT NULL,
  `link` varchar(100) NOT NULL,
  `link_target` varchar(10) NOT NULL DEFAULT '_self' COMMENT '_self,_blank',
  `link_external` tinyint(1) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `fx_section`
--

INSERT INTO `fx_section` (`fx_section_id`, `fx_menu_id`, `owner_id`, `creation_dt`, `title`, `intro`, `section_type`, `display_type`, `icon`, `opt_link`, `link`, `link_target`, `link_external`, `private`, `position`, `deleted`) VALUES
(58, 7, 0, '2015-05-26 17:06:30', 'Inicio', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 1, 0),
(59, 7, 0, '2015-05-26 17:43:35', 'Nosotros', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 2, 0),
(60, 0, 59, '2015-05-26 18:01:37', 'Misi&oacute;n', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 1, 0),
(61, 0, 59, '2015-05-26 18:02:50', 'Visi&oacute;n', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 2, 0),
(62, 7, 0, '2015-05-26 18:04:22', 'Testimonios', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 3, 0),
(63, 7, 0, '2015-05-26 18:04:43', 'Galer&iacute;a de Im&aacute;genes', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 4, 0),
(64, 7, 0, '2015-05-27 22:09:03', 'Cont&aacute;ctanos', '', 'Standard', 'List', '', 0, 'http://192.168.0.14/FAKUPUCP/contact', '_self', 1, 0, 5, 0),
(65, 7, 0, '2015-05-27 16:37:27', 'Reservas', '', 'Standard', 'List', '', 0, 'http://reservas.fakupucp.com/', '_blank', 1, 0, 6, 0),
(66, 7, 0, '2015-05-27 16:36:40', 'Facebook', '', 'Standard', 'List', 'download_76343.jpg', 0, 'https://www.facebook.com', '_blank', 1, 0, 7, 0),
(67, 0, 62, '2015-05-26 18:07:44', 'Nuestros Profesores', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 1, 0),
(68, 0, 62, '2015-05-26 18:08:00', 'Nuestros Cursos', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 2, 0),
(69, 0, 63, '2015-05-26 18:08:18', 'Nuestras Instalaciones', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 1, 0),
(70, 0, 63, '2015-05-26 18:08:37', 'Nuestros Docentes', '', 'Standard', 'List', '', 0, '', '_self', 0, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_section_lang`
--

CREATE TABLE IF NOT EXISTS `fx_section_lang` (
  `fx_menu_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_section_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `title` varchar(45) NOT NULL,
  `intro` longtext NOT NULL,
  `icon` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `link_external` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_menu_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_slideshow`
--

CREATE TABLE IF NOT EXISTS `fx_slideshow` (
  `fx_slideshow_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_section_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_slideshow_id`),
  UNIQUE KEY `code` (`code`),
  KEY `fx_section_id` (`fx_section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fx_slideshow`
--

INSERT INTO `fx_slideshow` (`fx_slideshow_id`, `fx_section_id`, `code`, `title`, `width`, `height`, `deleted`) VALUES
(1, 0, '0001', 'Slides Show', 1200, 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_slideshow_bk`
--

CREATE TABLE IF NOT EXISTS `fx_slideshow_bk` (
  `fx_slideshow_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `opt_link` tinyint(1) NOT NULL,
  `link` varchar(100) NOT NULL,
  `link_target` varchar(10) NOT NULL DEFAULT '_self' COMMENT '_self,_blank',
  `link_external` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_slideshow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_slideshow_image`
--

CREATE TABLE IF NOT EXISTS `fx_slideshow_image` (
  `fx_slideshow_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_slideshow_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `opt_link` tinyint(1) NOT NULL,
  `link` varchar(100) NOT NULL,
  `link_target` varchar(10) NOT NULL DEFAULT '_self' COMMENT '_self,_blank',
  `link_external` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`fx_slideshow_image_id`),
  KEY `fk_fx_slideshow_image_fx_slideshow1_idx` (`fx_slideshow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fx_slideshow_image`
--

INSERT INTO `fx_slideshow_image` (`fx_slideshow_image_id`, `fx_slideshow_id`, `image`, `caption`, `opt_link`, `link`, `link_target`, `link_external`, `position`, `deleted`) VALUES
(1, 1, 'b1_25877.jpg', '1', 0, '', '_self', 0, 1, 0),
(2, 1, 'b1_43135.jpg', '1', 0, '', '_self', 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_slideshow_image_lang`
--

CREATE TABLE IF NOT EXISTS `fx_slideshow_image_lang` (
  `fx_slideshow_image_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_slideshow_image_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `caption` varchar(100) NOT NULL,
  PRIMARY KEY (`fx_slideshow_image_lang_id`),
  KEY `fk_fx_slideshow_lang_fx_slideshow1` (`fx_slideshow_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fx_slideshow_image_lang`
--

INSERT INTO `fx_slideshow_image_lang` (`fx_slideshow_image_lang_id`, `fx_slideshow_image_id`, `lang`, `caption`) VALUES
(1, 1, 'new', 'n'),
(2, 2, 'new', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `fx_slideshow_lang`
--

CREATE TABLE IF NOT EXISTS `fx_slideshow_lang` (
  `fx_slideshow_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_slideshow_id` int(11) NOT NULL,
  `lang` varchar(3) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`fx_slideshow_lang_id`),
  KEY `fk_fx_slideshow_lang_fx_slideshow2` (`fx_slideshow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fx_slideshow_lang_bk`
--

CREATE TABLE IF NOT EXISTS `fx_slideshow_lang_bk` (
  `fx_slideshow_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_slideshow_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `caption` varchar(100) NOT NULL,
  PRIMARY KEY (`fx_slideshow_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fx_slideshow_image`
--
ALTER TABLE `fx_slideshow_image`
  ADD CONSTRAINT `fk_fx_slideshow_image_fx_slideshow1` FOREIGN KEY (`fx_slideshow_id`) REFERENCES `fx_slideshow` (`fx_slideshow_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fx_slideshow_image_lang`
--
ALTER TABLE `fx_slideshow_image_lang`
  ADD CONSTRAINT `fk_fx_slideshow_lang_fx_slideshow1` FOREIGN KEY (`fx_slideshow_image_id`) REFERENCES `fx_slideshow_image` (`fx_slideshow_image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fx_slideshow_lang`
--
ALTER TABLE `fx_slideshow_lang`
  ADD CONSTRAINT `fk_fx_slideshow_lang_fx_slideshow2` FOREIGN KEY (`fx_slideshow_id`) REFERENCES `fx_slideshow` (`fx_slideshow_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
