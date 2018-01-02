-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2018 at 01:46 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialdata`
--
CREATE DATABASE IF NOT EXISTS `socialdata` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `socialdata`;

-- --------------------------------------------------------

--
-- Table structure for table `soc_comments`
--

DROP TABLE IF EXISTS `soc_comments`;
CREATE TABLE IF NOT EXISTS `soc_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_body` text NOT NULL,
  `comment_by` varchar(60) NOT NULL,
  `comment_to` varchar(60) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_removed` varchar(3) NOT NULL,
  `comment_to_post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_comments`
--

INSERT INTO `soc_comments` (`id`, `comment_body`, `comment_by`, `comment_to`, `comment_date`, `comment_removed`, `comment_to_post_id`) VALUES
(1, 'Testing comments to post ', '', 'joseph_handschu', '2017-09-29 23:05:55', 'no', 41),
(2, 'Testing comments to post ', '', 'joseph_handschu', '2017-09-29 23:06:10', 'no', 41),
(3, 'testing comments to post ', 'lorena_handschu', 'joseph_handschu', '2017-09-29 23:10:06', 'no', 41),
(4, 'testing comments to post', 'lorena_handschu', 'joseph_handschu', '2017-09-29 23:10:48', 'no', 41),
(5, 'testing comments ', 'lorena_handschu', 'joseph_handschu', '2017-09-29 23:12:13', 'no', 40),
(6, 'this is comment of Joseph to Joseph', 'joseph_handschu', 'lorena_handschu', '2017-09-29 23:13:41', 'no', 42),
(7, 'wow!!', 'lorena_handschu', 'joseph_handschu', '2017-10-01 07:50:19', 'no', 41),
(8, 'First post to perro', 'lorena_handschu', 'joseph_handschu', '2017-10-01 08:13:41', 'no', 39),
(9, 're wow!', 'lorena_handschu', 'joseph_handschu', '2017-10-01 08:14:43', 'no', 41),
(10, '', 'joseph_handschu', 'lorena_handschu', '2017-10-01 17:17:17', 'no', 44),
(11, '', 'joseph_handschu', 'lorena_handschu', '2017-10-01 17:49:29', 'no', 44),
(12, 'yari yari yara ', 'joseph_handschu', 'lorena_handschu', '2017-10-01 17:50:30', 'no', 44),
(13, 'comment from lorena to matthew # 1', 'lorena_handschu', 'matthew_handschu', '2017-10-01 17:51:49', 'no', 43),
(14, '', 'joseph_handschu', 'lorena_handschu', '2017-10-02 12:49:12', 'no', 44),
(15, '', 'joseph_handschu', 'lorena_handschu', '2017-10-02 12:59:05', 'no', 44),
(16, '', 'joseph_handschu', 'lorena_handschu', '2017-10-02 12:59:09', 'no', 44),
(17, '', 'joseph_handschu', 'lorena_handschu', '2017-10-02 13:07:45', 'no', 44),
(18, '', 'joseph_handschu', 'lorena_handschu', '2017-10-02 13:11:29', 'no', 44),
(19, '', 'joseph_handschu', 'lorena_handschu', '2017-10-03 21:10:00', 'no', 44),
(20, 'Comment from JH', '', 'maria_handschu', '2017-10-16 22:24:02', 'no', 54),
(21, 'Comment from MH', 'matthew_handschu', 'maria_handschu', '2017-10-16 22:24:58', 'no', 54),
(22, 'Comment from LH', 'lorena_handschu', 'maria_handschu', '2017-10-16 22:25:43', 'no', 54),
(23, 'About time.... ;)\r\n', 'joseph_handschu', 'lorena_handschu', '2017-12-27 18:04:20', 'no', 62),
(24, 'About time ..... 2\r\n', 'joseph_handschu', 'lorena_handschu', '2017-12-27 18:06:17', 'no', 62),
(25, 'One more time !!!', 'joseph_handschu', 'lorena_handschu', '2017-12-27 18:09:14', 'no', 62),
(26, 'One more test for notifications', 'joseph_handschu', 'matthew_handschu_1', '2017-12-27 21:33:25', 'no', 61),
(27, 'There we go again!!', 'joseph_handschu', 'matthew_handschu_1', '2017-12-27 21:37:39', 'no', 60),
(28, 'One more for Matthew Handschu1', 'joseph_handschu', 'matthew_handschu_1', '2017-12-27 21:45:28', 'no', 60),
(29, 'Commento from Joseph to Matthew Handschu', 'joseph_handschu', 'matthew_handschu', '2017-12-27 21:48:20', 'no', 43),
(30, 'Well, let\'s make this work!!', 'joseph_handschu', 'matthew_handschu', '2017-12-27 21:51:53', 'no', 43),
(31, 'Hola mama!!', 'matthew_handschu_1', 'lorena_handschu', '2017-12-29 16:30:02', 'no', 62),
(32, 'teting testing', 'matthew_handschu_1', 'joseph_handschu', '2017-12-29 17:54:54', 'no', 57);

-- --------------------------------------------------------

--
-- Table structure for table `soc_friend_requests`
--

DROP TABLE IF EXISTS `soc_friend_requests`;
CREATE TABLE IF NOT EXISTS `soc_friend_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` varchar(50) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `req_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_friend_requests`
--

INSERT INTO `soc_friend_requests` (`id`, `user_from`, `user_to`, `req_date`, `status`) VALUES
(1, 'maria_handschu', 'matthew_handschu_1', '2017-10-08', 'P'),
(2, 'lorena_handschu', 'maria_handschu', '2017-10-08', 'A'),
(3, 'joseph_handschu', 'maria_handschu', '2017-10-08', 'A'),
(4, 'lorena_handschu', 'joseph_handschu', '2017-10-09', 'A'),
(5, 'maria_handschu', 'matthew_handschu', '2017-10-09', 'A'),
(6, 'joseph_handschu', 'joseph_handschu_1', '2017-10-09', 'P'),
(7, 'lorena_handschu', 'matthew_handschu_1', '2017-10-10', 'A'),
(8, 'joseph_handschu', 'matthew_handschu_1', '2017-10-10', 'A'),
(9, 'matthew_handschu', 'joseph_handschu', '2017-11-24', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `soc_likes`
--

DROP TABLE IF EXISTS `soc_likes`;
CREATE TABLE IF NOT EXISTS `soc_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `like_username` varchar(60) NOT NULL,
  `like_to_post_id` int(11) NOT NULL,
  `like_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_likes`
--

INSERT INTO `soc_likes` (`id`, `like_username`, `like_to_post_id`, `like_date`) VALUES
(8, 'lorena_handschu', 36, '2017-10-07 13:54:56'),
(12, 'joseph_handschu', 44, '2017-10-07 14:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `soc_log`
--

DROP TABLE IF EXISTS `soc_log`;
CREATE TABLE IF NOT EXISTS `soc_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `log` mediumtext NOT NULL,
  `login_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_log`
--

INSERT INTO `soc_log` (`id`, `session_id`, `username`, `log`, `login_date_time`, `logout_date_time`) VALUES
(1, 'vbsndds6ihu4ed6v39ekghijo7', 'joseph_handschu', 'Starting Session: ', '2017-10-28 16:27:37', '0000-00-00 00:00:00'),
(2, '88kg44gkc5qltmv9bsuc0fbrj2', 'joseph_handschu', 'Starting Session: 88kg44gkc5qltmv9bsuc0fbrj2', '2017-10-28 16:28:20', '0000-00-00 00:00:00'),
(3, '012n62mkdt312ni5clrtlkr792', 'joseph_handschu', 'Starting Session: 012n62mkdt312ni5clrtlkr792', '2017-10-28 16:29:45', '0000-00-00 00:00:00'),
(4, 'udp7gc4lpn3v5qbquenkeuasf4', 'lorena_handschu', 'Starting Session: udp7gc4lpn3v5qbquenkeuasf4', '2017-10-28 16:29:54', '0000-00-00 00:00:00'),
(5, 'btmga1curouva4j21egoaoq740', 'lorena_handschu', ' SESS Starting Session: btmga1curouva4j21egoaoq740', '2017-10-28 21:16:59', '0000-00-00 00:00:00'),
(6, 'hha5f6lb80poolfmmphso0hrk1', 'lorena_handschu', ' SESS Starting Session: hha5f6lb80poolfmmphso0hrk1', '2017-10-28 21:17:05', '0000-00-00 00:00:00'),
(7, 'vll8r5h7lgpri1skf8i4jjsbg5', 'matthew_handschu', ' SESS Starting Session: vll8r5h7lgpri1skf8i4jjsbg5', '2017-10-28 21:18:27', '0000-00-00 00:00:00'),
(8, '0kaaaqe8ub3cu4dfii61tbr251', 'lorena_handschu', ' SESS Starting Session: 0kaaaqe8ub3cu4dfii61tbr251', '2017-10-28 21:20:34', '0000-00-00 00:00:00'),
(9, '2brisahgpib8d7plc1ect5f7u3', 'maria_handschu', ' SESS Starting Session: 2brisahgpib8d7plc1ect5f7u3', '2017-10-28 21:22:42', '0000-00-00 00:00:00'),
(10, '7qrvmm2ke3rc87r0st18ktjmu0', 'lorena_handschu', '2017-10-28 21:23:43:000000 SESS Starting Session: 7qrvmm2ke3rc87r0st18ktjmu0', '2017-10-28 21:23:43', '0000-00-00 00:00:00'),
(11, '15b7j95agf4l3ngsldc00rv407', 'lorena_handschu', '2017-10-28 21:23:49:000000 SESS Starting Session: 15b7j95agf4l3ngsldc00rv407 ', '2017-10-28 21:23:49', '0000-00-00 00:00:00'),
(12, '215fra1p5flqjbjg00slkdlif0', 'lorena_handschu', '2017-10-28 21:24:36:000000 SESS Starting Session: 215fra1p5flqjbjg00slkdlif0', '2017-10-28 21:24:36', '0000-00-00 00:00:00'),
(13, 'e7co3vvnhig0a7dom2e95enka2', '', '2017-10-29 20:03:55:000000 SESS Starting Session: e7co3vvnhig0a7dom2e95enka2', '2017-10-29 20:03:55', '0000-00-00 00:00:00'),
(14, 'ouv0mght8abef6a055ibdrpe30', '', '2017-10-29 20:08:35:000000 SESS Starting Session: ouv0mght8abef6a055ibdrpe30', '2017-10-29 20:08:35', '0000-00-00 00:00:00'),
(15, 'f2qk9fei5c02ummehvnb1ur2h4', '', '2017-10-29 20:42:31:000000 SESS Starting Session: f2qk9fei5c02ummehvnb1ur2h4', '2017-10-29 20:42:31', '0000-00-00 00:00:00'),
(16, 'jf92jablmk3v0kk2e5b6ket0g6', '', '2017-10-31 20:53:25:000000 SESS Starting Session: jf92jablmk3v0kk2e5b6ket0g6', '2017-10-31 20:53:25', '0000-00-00 00:00:00'),
(17, '3a5ske7uncbtsrid9bthfu90o0', '', '2017-10-31 22:49:27:000000 SESS Starting Session: 3a5ske7uncbtsrid9bthfu90o0', '2017-10-31 22:49:27', '0000-00-00 00:00:00'),
(18, 'o1o6clkj39uq6f2hhchqkabqg4', '', '2017-11-08 13:36:03:000000 SESS Starting Session: o1o6clkj39uq6f2hhchqkabqg4', '2017-11-08 13:36:03', '0000-00-00 00:00:00'),
(19, 'vqpq038s759i8dnb71gcmdn6g0', 'lorena_handschu', '2017-11-09 17:52:15:000000 SESS Starting Session: vqpq038s759i8dnb71gcmdn6g0', '2017-11-09 17:52:15', '0000-00-00 00:00:00'),
(20, '3ecu33meqe1i7bkfqt39l70ij6', 'lorena_handschu', '2017-11-09 17:53:41:000000 SESS Starting Session: 3ecu33meqe1i7bkfqt39l70ij6', '2017-11-09 17:53:41', '0000-00-00 00:00:00'),
(21, 'ksop243lesscnnk9jti80ma7l1', 'lorena_handschu', 'Session was started some time ago!!!./r/nwhat ever....', '2017-11-09 17:56:20', '2017-11-09 18:46:23'),
(22, '91pcj9nceglnu1ihptvkdlrin3', 'joseph_handschu', '2017-11-09 18:17:26:000000 SESS Starting Session: 91pcj9nceglnu1ihptvkdlrin3/r/nwhat ever....', '2017-11-09 18:17:26', '2017-11-09 22:26:22'),
(23, '91pcj9nceglnu1ihptvkdlrin3', 'joseph_handschu', '2017-11-09 18:17:26:000000 SESS Starting Session: 91pcj9nceglnu1ihptvkdlrin3/r/nwhat ever....', '2017-11-09 18:17:42', '2017-11-09 22:26:22'),
(24, 'r9src8s2qgl43n96tfcirmvn26', 'joseph_handschu', '2017-11-13 23:07:03:000000 SESS Starting Session: r9src8s2qgl43n96tfcirmvn26\r\nwhat ever....', '2017-11-13 23:07:03', '2017-11-13 23:07:03'),
(25, '9k8bhpof2gdvg3rk1bh8o0vkt2', '', '2017-11-13 23:18:22:000000 SESS Starting Session: 9k8bhpof2gdvg3rk1bh8o0vkt2\r\nwhat ever....', '2017-11-13 23:18:22', '2017-11-13 23:18:22'),
(26, 't4bgkujpb4m324b70b6nccser6', '', '2017-11-13 23:18:23:000000 SESS Starting Session: t4bgkujpb4m324b70b6nccser6\r\nwhat ever....', '2017-11-13 23:18:23', '2017-11-13 23:18:23'),
(27, '4jjsn9npt0dl1u036hmbkksig2', '', '2017-11-24 17:01:41:000000 SESS Starting Session: 4jjsn9npt0dl1u036hmbkksig2\r\nwhat ever....', '2017-11-24 17:01:41', '2017-11-24 17:01:41'),
(28, 'shrl30g319iat3orjul4au21k4', '', '2017-11-24 21:01:25:000000 SESS Starting Session: shrl30g319iat3orjul4au21k4\r\nwhat ever....', '2017-11-24 21:01:25', '2017-11-24 21:01:25'),
(29, 'nvhkhunjf28nejh5lu663tcqj5', '', '2017-11-29 18:06:55:000000 SESS Starting Session: nvhkhunjf28nejh5lu663tcqj5\r\nwhat ever....', '2017-11-29 18:06:55', '2017-11-29 18:06:55'),
(30, '3d63anl5887pcdud90d3p6pls3', '', '2017-11-29 18:09:12:000000 SESS Starting Session: 3d63anl5887pcdud90d3p6pls3\r\nwhat ever....', '2017-11-29 18:09:12', '2017-11-29 18:09:12'),
(31, 'gejcpliubiajs0ba8ll3tsf0o2', 'joseph_handschu', '2017-12-08 17:56:31:000000 SESS Starting Session: gejcpliubiajs0ba8ll3tsf0o2\r\nwhat ever....', '2017-12-08 17:56:31', '2017-12-08 17:56:31'),
(32, 'fkvecl7ui929qhebu3itrvh7o0', '', '2017-12-14 16:10:36:000000 SESS Starting Session: fkvecl7ui929qhebu3itrvh7o0\r\nwhat ever....', '2017-12-14 16:10:36', '2017-12-14 16:10:36'),
(33, 'naa43ogd8dive4irle2rckruc2', '', '2017-12-15 12:59:25:000000 SESS Starting Session: naa43ogd8dive4irle2rckruc2\r\nwhat ever....', '2017-12-15 12:59:25', '2017-12-15 12:59:26'),
(34, '3ep4kg69e9dt36degf19orf7m5', '', '2017-12-15 17:26:32:000000 SESS Starting Session: 3ep4kg69e9dt36degf19orf7m5\r\nwhat ever....', '2017-12-15 17:26:32', '2017-12-15 17:26:32'),
(35, 'n76njjpa2nn84c6fopl0c75le1', 'joseph_handschu', '2017-12-17 15:02:33:000000 SESS Starting Session: n76njjpa2nn84c6fopl0c75le1\r\nwhat ever....', '2017-12-17 15:02:33', '2017-12-17 15:02:33'),
(36, 'vkbo7qgcp429atbd7kehmb6o55', 'matthew_handschu', '2017-12-17 15:16:56:000000 SESS Starting Session: vkbo7qgcp429atbd7kehmb6o55\r\nwhat ever....', '2017-12-17 15:16:56', '2017-12-17 15:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `soc_messages`
--

DROP TABLE IF EXISTS `soc_messages`;
CREATE TABLE IF NOT EXISTS `soc_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_user_to` varchar(50) NOT NULL,
  `msg_user_from` varchar(50) NOT NULL,
  `msg_body` text NOT NULL,
  `msg_date` datetime NOT NULL,
  `msg_opened` varchar(3) NOT NULL,
  `msg_viewed` varchar(3) NOT NULL,
  `msg_deleted` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_messages`
--

INSERT INTO `soc_messages` (`id`, `msg_user_to`, `msg_user_from`, `msg_body`, `msg_date`, `msg_opened`, `msg_viewed`, `msg_deleted`) VALUES
(1, 'joseph_handschu', 'matthew_handschu_1', '', '2017-10-25 17:36:33', 'yes', 'yes', 'no'),
(2, 'joseph_handschu', 'matthew_handschu_1', 'HeyMatt', '2017-10-25 17:37:08', 'yes', 'yes', 'no'),
(3, 'joseph_handschu', 'matthew_handschu_1', 'HeyMatt', '2017-10-25 17:37:14', 'yes', 'yes', 'no'),
(4, 'joseph_handschu', 'matthew_handschu_1', 'fasdfsdafasf', '2017-10-25 18:50:07', 'yes', 'yes', 'no'),
(5, 'joseph_handschu', 'matthew_handschu_1', 'afasfasfafasf', '2017-10-25 18:50:10', 'yes', 'yes', 'no'),
(6, 'joseph_handschu', 'matthew_handschu_1', '11111111111111111', '2017-10-25 18:50:17', 'yes', 'yes', 'no'),
(7, 'joseph_handschu', 'matthew_handschu_1', '22222222222222', '2017-10-25 18:50:22', 'yes', 'yes', 'no'),
(8, 'joseph_handschu', 'matthew_handschu_1', '33333333333333', '2017-10-25 18:50:28', 'yes', 'yes', 'no'),
(9, 'joseph_handschu', 'matthew_handschu_1', '444444444444', '2017-10-25 18:50:33', 'yes', 'yes', 'no'),
(10, 'matthew_handschu_1', 'joseph_handschu', 'HeyMatt', '2017-10-25 18:51:55', 'yes', 'yes', 'no'),
(11, 'matthew_handschu_1', 'joseph_handschu', 'Howareyoudude?', '2017-10-25 18:52:04', 'yes', 'yes', 'no'),
(12, 'matthew_handschu_1', 'joseph_handschu', 'kjlfakjlkajflkasjfadsf', '2017-10-25 18:52:07', 'yes', 'yes', 'no'),
(13, 'matthew_handschu_1', 'joseph_handschu', '111111111111111', '2017-10-25 18:52:14', 'yes', 'yes', 'no'),
(14, 'matthew_handschu_1', 'joseph_handschu', '2222222222222', '2017-10-25 18:52:19', 'yes', 'yes', 'no'),
(15, 'matthew_handschu_1', 'joseph_handschu', '333333333333', '2017-10-25 18:52:24', 'yes', 'yes', 'no'),
(16, 'matthew_handschu_1', 'joseph_handschu', '444444444444', '2017-10-25 18:52:28', 'yes', 'yes', 'no'),
(17, 'joseph_handschu', 'matthew_handschu_1', 'AmessagetoJoseph.', '2017-10-25 21:01:32', 'yes', 'yes', 'no'),
(18, 'joseph_handschu', 'matthew_handschu_1', 'Test test test', '2017-10-25 21:03:12', 'yes', 'yes', 'no'),
(19, 'joseph_handschu', 'matthew_handschu_1', '', '2017-10-25 21:03:34', 'yes', 'yes', 'no'),
(20, 'joseph_handschu', 'matthew_handschu_1', 'New Message to Joseph', '2017-10-26 16:46:57', 'yes', 'yes', 'no'),
(21, 'joseph_handschu', 'matthew_handschu_1', 'New Message to Joseph', '2017-10-26 16:48:10', 'yes', 'yes', 'no'),
(22, 'joseph_handschu', 'matthew_handschu_1', 'New message 1 to Joseph', '2017-10-26 16:48:44', 'yes', 'yes', 'no'),
(23, 'lorena_handschu', 'joseph_handschu', 'Hola', '2017-10-26 22:20:20', 'yes', 'yes', 'no'),
(24, 'joseph_handschu', 'lorena_handschu', 'hola... este es mi primer mensaje \r\n', '2017-10-26 22:20:38', 'yes', 'yes', 'no'),
(25, 'lorena_handschu', 'joseph_handschu', 'Que haces?', '2017-10-26 22:20:54', 'yes', 'yes', 'no'),
(26, 'joseph_handschu', 'lorena_handschu', 'segundo', '2017-10-26 22:21:03', 'yes', 'yes', 'no'),
(27, 'joseph_handschu', 'lorena_handschu', 'ta chevere tu chat', '2017-10-26 22:21:26', 'yes', 'yes', 'no'),
(28, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:24:49', 'yes', 'yes', 'no'),
(29, 'joseph_handschu', 'lorena_handschu', 'ta chevere tu chat', '2017-10-26 22:25:06', 'yes', 'yes', 'no'),
(30, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:26:53', 'yes', 'yes', 'no'),
(31, 'joseph_handschu', 'lorena_handschu', 'que pasa si el mensaje es bien largo y te quieren contar una historia y empiezan desde que nacio y te dan los detalles con punto y coma, sin respirar, sin chance que tu puedas decir ahh', '2017-10-26 22:26:54', 'yes', 'yes', 'no'),
(32, 'joseph_handschu', 'lorena_handschu', 'que pasa si el mensaje es bien largo y te quieren contar una historia y empiezan desde que nacio y te dan los detalles con punto y coma, sin respirar, sin chance que tu puedas decir ahh', '2017-10-26 22:27:11', 'yes', 'yes', 'no'),
(33, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:27:19', 'yes', 'yes', 'no'),
(34, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:28:11', 'yes', 'yes', 'no'),
(35, 'joseph_handschu', 'lorena_handschu', 'que pasa si el mensaje es bien largo y te quieren contar una historia y empiezan desde que nacio y te dan los detalles con punto y coma, sin respirar, sin chance que tu puedas decir ahh', '2017-10-26 22:28:50', 'yes', 'yes', 'no'),
(36, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:29:07', 'yes', 'yes', 'no'),
(37, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:29:59', 'yes', 'yes', 'no'),
(38, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:30:27', 'yes', 'yes', 'no'),
(39, 'joseph_handschu', 'lorena_handschu', 'que pasa si el mensaje es bien largo y te quieren contar una historia y empiezan desde que nacio y te dan los detalles con punto y coma, sin respirar, sin chance que tu puedas decir ahh', '2017-10-26 22:32:14', 'yes', 'yes', 'no'),
(40, 'joseph_handschu', 'lorena_handschu', 'que pasa si el mensaje es bien largo y te quieren contar una historia y empiezan desde que nacio y te dan los detalles con punto y coma, sin respirar, sin chance que tu puedas decir ahh', '2017-10-26 22:33:39', 'yes', 'yes', 'no'),
(41, 'joseph_handschu', 'lorena_handschu', 'que pasa si el mensaje es bien largo y te quieren contar una historia y empiezan desde que nacio y te dan los detalles con punto y coma, sin respirar, sin chance que tu puedas decir ahh', '2017-10-26 22:33:53', 'yes', 'yes', 'no'),
(42, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:34:27', 'yes', 'yes', 'no'),
(43, 'lorena_handschu', 'joseph_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-10-26 22:54:00', 'yes', 'yes', 'no'),
(44, 'lorena_handschu', 'joseph_handschu', 'One more message to test the duplication', '2017-10-26 22:54:39', 'yes', 'yes', 'no'),
(45, 'lorena_handschu', 'joseph_handschu', 'One more message to test the duplication', '2017-10-26 22:54:46', 'yes', 'yes', 'no'),
(46, 'lorena_handschu', 'joseph_handschu', 'Pongamos bonitos mensajes jajaja', '2017-10-26 22:58:52', 'yes', 'yes', 'no'),
(47, 'lorena_handschu', 'joseph_handschu', 'Pongamos bonitos mensajes jajaja', '2017-10-26 22:58:59', 'yes', 'yes', 'no'),
(48, 'lorena_handschu', 'joseph_handschu', 'Hello again!\r\n', '2017-10-28 14:59:00', 'yes', 'yes', 'no'),
(49, 'lorena_handschu', 'joseph_handschu', 'Hello again!\r\n', '2017-10-28 15:04:39', 'yes', 'yes', 'no'),
(50, 'lorena_handschu', 'joseph_handschu', 'One more hello!!', '2017-10-28 15:04:56', 'yes', 'yes', 'no'),
(51, 'joseph_handschu', 'matthew_handschu_1', 'This a new message', '2017-10-31 20:54:44', 'yes', 'yes', 'no'),
(52, 'matthew_handschu_1', 'joseph_handschu', 'It\'s Halloween!!!', '2017-10-31 22:08:56', 'yes', 'yes', 'no'),
(53, '', '', 'This a new message', '2017-10-31 22:49:27', 'yes', 'no', 'no'),
(54, 'matthew_handschu', 'lorena_handschu', 'Hello Matthew 1', '2017-11-11 18:02:00', 'yes', 'yes', 'no'),
(55, 'matthew_handschu', 'lorena_handschu', 'Hello Matthew 1', '2017-11-11 18:09:07', 'yes', 'yes', 'no'),
(56, 'matthew_handschu', 'lorena_handschu', 'Hello Matthew 1', '2017-11-11 18:09:11', 'yes', 'yes', 'no'),
(57, 'matthew_handschu', 'lorena_handschu', 'Hello !!\r\n', '2017-11-11 18:09:29', 'yes', 'yes', 'no'),
(58, 'matthew_handschu', 'lorena_handschu', 'Hola\r\n', '2017-11-11 18:11:01', 'yes', 'yes', 'no'),
(59, 'matthew_handschu', 'lorena_handschu', 'Hola\r\n', '2017-11-11 18:11:23', 'yes', 'yes', 'no'),
(60, 'matthew_handschu', 'lorena_handschu', 'hhhhhh', '2017-11-11 18:12:34', 'yes', 'yes', 'no'),
(61, 'matthew_handschu', 'lorena_handschu', 'hhhhhh', '2017-11-11 18:12:38', 'yes', 'yes', 'no'),
(62, 'matthew_handschu', 'lorena_handschu', 'Ya tenemos para chatear en privado, solo falta subir imagenes', '2017-11-11 18:13:59', 'yes', 'yes', 'no'),
(63, 'matthew_handschu', 'lorena_handschu', 'gggggg', '2017-11-11 18:14:06', 'yes', 'yes', 'no'),
(64, 'lorena_handschu', 'joseph_handschu', 'hola 11/11', '2017-11-11 18:15:14', 'yes', 'yes', 'no'),
(65, 'lorena_handschu', 'joseph_handschu', 'hola 11/11', '2017-11-11 18:16:29', 'yes', 'yes', 'no'),
(66, 'lorena_handschu', 'joseph_handschu', 'hola 11/11', '2017-11-13 23:06:24', 'yes', 'yes', 'no'),
(67, 'lorena_handschu', 'joseph_handschu', 'yo yo 11/13', '2017-11-13 23:08:01', 'yes', 'yes', 'no'),
(68, 'joseph_handschu', 'lorena_handschu', 'wasup', '2017-11-13 23:08:31', 'yes', 'yes', 'no'),
(69, 'matthew_handschu', 'joseph_handschu', 'Hola Matt!! 11/24', '2017-11-24 16:40:15', 'yes', 'yes', 'no'),
(70, 'maria_handschu', 'matthew_handschu', 'Hey Maria 11/24', '2017-11-24 16:42:58', 'yes', 'yes', 'no'),
(71, 'joseph_handschu', 'matthew_handschu', 'Hey Joe 11/24\r\n', '2017-11-24 17:05:18', 'yes', 'yes', 'no'),
(72, 'matthew_handschu', 'joseph_handschu', 'wasup 11/24', '2017-11-24 17:05:53', 'yes', 'yes', 'no'),
(73, 'joseph_handschu', 'matthew_handschu', 'Hey Joe 11/24\r\n', '2017-11-24 17:06:09', 'yes', 'yes', 'no'),
(74, 'joseph_handschu', 'matthew_handschu', 'Hey Joe 11/24\r\n', '2017-11-24 17:06:36', 'yes', 'yes', 'no'),
(75, 'matthew_handschu', 'joseph_handschu', 'wasup 11/24', '2017-11-24 17:06:55', 'yes', 'yes', 'no'),
(76, 'maria_handschu', 'joseph_handschu', 'Hey\r\n', '2017-11-24 17:23:14', 'yes', 'yes', 'no'),
(77, 'maria_handschu', 'joseph_handschu', 'mari are you there?\r\n', '2017-12-01 20:45:38', 'yes', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `soc_notifications`
--

DROP TABLE IF EXISTS `soc_notifications`;
CREATE TABLE IF NOT EXISTS `soc_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nt_user_to` varchar(50) NOT NULL,
  `nt_user_from` varchar(50) NOT NULL,
  `nt_text` text NOT NULL,
  `nt_link` varchar(100) NOT NULL,
  `nt_datetime` date NOT NULL,
  `nt_opened` varchar(3) NOT NULL,
  `nt_viewed` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_notifications`
--

INSERT INTO `soc_notifications` (`id`, `nt_user_to`, `nt_user_from`, `nt_text`, `nt_link`, `nt_datetime`, `nt_opened`, `nt_viewed`) VALUES
(1, 'joseph_handschu', 'lorena_handschu', 'test test ', '', '0000-00-00', 'no', 'yes'),
(2, 'matthew_handschu_1', 'matthew_handschu_1n', 'Friend request', 'post.php?id=60', '2017-12-27', 'yes', 'no'),
(3, 'matthew_handschu_1', 'matthew_handschu_1', 'Friend request', 'post.php?id=60', '2017-12-27', 'yes', 'no'),
(4, 'matthew_handschu', 'matthew_handschu', 'Friend request', 'post.php?id=43', '2017-12-27', 'no', 'yes'),
(5, 'lorena_handschu', '', 'Commented on a post you commented on', 'post.php?id=43', '2017-12-27', 'no', 'yes'),
(6, 'matthew_handschu', 'matthew_handschu', 'Friend request', 'post.php?id=43', '2017-12-27', 'no', 'yes'),
(7, 'lorena_handschu', 'matthew_handschu', 'Commented on a post you commented on', 'post.php?id=43', '2017-12-27', 'no', 'yes'),
(8, 'lorena_handschu', 'lorena_handschu', 'Sent a friend request', 'post.php?id=62', '2017-12-29', 'no', 'yes'),
(10, 'lorena_handschu', 'lorena_handschu', 'Sent a friend request', 'post.php?id=62', '2017-12-29', 'no', 'yes'),
(11, 'joseph_handschu', 'joseph_handschu', 'Sent a friend request', 'post.php?id=57', '2017-12-29', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `soc_posts`
--

DROP TABLE IF EXISTS `soc_posts`;
CREATE TABLE IF NOT EXISTS `soc_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_body` text NOT NULL,
  `post_added_by` varchar(60) NOT NULL,
  `post_user_to` varchar(60) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_user_closed` varchar(3) NOT NULL,
  `post_deleted` varchar(3) NOT NULL,
  `post_likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_posts`
--

INSERT INTO `soc_posts` (`id`, `post_body`, `post_added_by`, `post_user_to`, `post_date`, `post_user_closed`, `post_deleted`, `post_likes`) VALUES
(1, 'Test', 'j@h.com', 'none', '2017-09-17 16:00:00', 'no', 'no', 0),
(2, 'fafafafaffafaf', '', 'none', '2017-09-17 17:04:34', 'no', 'no', 0),
(3, 'fafafafaffafaf', '', 'none', '2017-09-17 17:05:35', 'no', 'no', 0),
(4, 'affafafafafa', '', 'none', '2017-09-17 17:05:54', 'no', 'no', 0),
(5, 'today is sep 23', '', 'none', '2017-09-23 12:37:00', 'no', 'no', 0),
(6, 'One more test in Sep 23', '', 'none', '2017-09-23 12:38:48', 'no', 'no', 0),
(7, 'today is sep 23 test 3', '', 'none', '2017-09-23 12:39:56', 'no', 'no', 0),
(8, 'Today is Sep 23 test 4', '', 'none', '2017-09-23 12:42:07', 'no', 'no', 0),
(9, 'Today is Sep 23 test 5', '', 'none', '2017-09-23 12:44:20', 'no', 'no', 0),
(10, 'Today is Sep 23 test 5', '', 'none', '2017-09-23 12:46:07', 'no', 'no', 0),
(11, 'Today is Sep 23 test 5', '', 'none', '2017-09-23 12:46:13', 'no', 'no', 0),
(12, 'today is sep 23 test 5', '', 'none', '2017-09-23 12:46:24', 'no', 'no', 0),
(31, 'Today is Sep 23 test 18', 'joseph_handschu', 'none', '2017-09-23 13:25:31', 'no', 'no', 0),
(32, 'First post of joseph_handschu', 'joseph_handschu', 'none', '2017-09-23 13:25:52', 'no', 'no', 1),
(33, 'First post of joseph_handschu', 'joseph_handschu', 'none', '2017-09-23 13:26:05', 'no', 'no', 1),
(34, 'gato', 'joseph_handschu', 'none', '2017-09-23 13:29:38', 'no', 'no', 0),
(35, 'gato', 'joseph_handschu', 'none', '2017-09-23 13:30:39', 'no', 'no', 0),
(36, 'to track changes', 'joseph_handschu', 'none', '2017-09-23 13:30:48', 'no', 'no', 1),
(37, 'gato', 'joseph_handschu', 'none', '2017-09-23 13:31:40', 'no', 'no', 1),
(38, 'perro', 'joseph_handschu', 'none', '2017-09-23 13:32:27', 'no', 'no', -2),
(39, 'perro', 'joseph_handschu', 'none', '2017-09-23 13:32:36', 'no', 'no', 1),
(40, 'Last post before leaving home', 'joseph_handschu', 'none', '2017-09-23 14:25:18', 'no', 'no', 1),
(41, 'test test test', 'joseph_handschu', 'none', '2017-09-23 14:39:55', 'no', 'no', 4),
(42, 'First post of Lorena', 'lorena_handschu', 'none', '2017-09-24 21:44:25', 'no', 'yes', 0),
(43, 'Matt\'s first post', 'matthew_handschu', 'none', '2017-10-01 08:18:52', 'no', 'no', 4),
(44, 'New post, any comments?', 'lorena_handschu', 'none', '2017-10-01 10:34:23', 'no', 'yes', 1),
(45, 'First post from Maria ', 'maria_handschu', 'none', '2017-10-08 20:38:13', 'no', 'no', 0),
(46, 'fsadfafafafa', 'joseph_handschu', 'none', '2017-10-12 16:05:40', 'no', 'no', 0),
(47, 'A test of posting into another user\'s page', 'joseph_handschu', 'none', '2017-10-13 12:07:36', 'no', 'no', 0),
(48, 'Hey Maria!!', 'joseph_handschu', 'none', '2017-10-13 12:30:47', 'no', 'no', 0),
(49, 'test test test', 'joseph_handschu', 'maria_handschu', '2017-10-13 14:44:55', 'no', 'no', 0),
(50, 'fafafafafafaf', 'joseph_handschu', 'maria_handschu', '2017-10-13 16:27:34', 'no', 'no', 0),
(51, 'ssssssssss', 'joseph_handschu', 'maria_handschu', '2017-10-13 16:29:43', 'no', 'no', 0),
(52, 'sssssss', 'joseph_handschu', 'maria_handschu', '2017-10-13 17:46:46', 'no', 'no', 0),
(53, 'testing testing', 'joseph_handschu', 'maria_handschu', '2017-10-13 17:50:59', 'no', 'no', 0),
(54, 'This is a post from maria to joseph', 'maria_handschu', 'joseph_handschu', '2017-10-13 17:53:14', 'no', 'no', 0),
(55, 'Post to self', 'joseph_handschu', 'joseph_handschu', '2017-10-13 20:04:24', 'no', 'no', 0),
(56, 'New post to Lorena', 'lorena_handschu', 'lorena_handschu', '2017-10-16 19:33:42', 'no', 'yes', 0),
(57, 'Posting to myself', 'joseph_handschu', 'none', '2017-10-16 20:20:57', 'no', 'no', 0),
(58, 'kk', 'joseph_handschu', 'matthew_handschu_1', '2017-10-17 18:43:51', 'no', 'yes', 0),
(59, 'Hola Loco!!', 'joseph_handschu', 'matthew_handschu_1', '2017-10-17 18:43:55', 'no', 'no', 0),
(60, 'ss', 'matthew_handschu_1', 'none', '2017-10-17 18:45:04', 'no', 'no', 0),
(61, 'Test', 'matthew_handschu_1', 'none', '2017-10-17 18:46:33', 'no', 'no', 0),
(62, 'Hola Loco!!', 'lorena_handschu', 'joseph_handschu', '2017-10-30 22:06:39', 'no', 'no', 0),
(63, 'Test of duplicate...', 'joseph_handschu', 'none', '2017-10-31 22:10:02', 'no', 'yes', 0),
(64, 'Test Maria to Maria 11/24', 'maria_handschu', 'none', '2017-11-24 16:47:41', 'no', 'no', 0),
(65, 'Hello!!', 'matthew_handschu', 'maria_handschu', '2017-12-17 15:27:41', 'no', 'yes', 0),
(66, 'Post to Matthew 1 profile', 'joseph_handschu', 'matthew_handschu_1', '2017-12-29 18:09:43', 'no', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `soc_users`
--

DROP TABLE IF EXISTS `soc_users`;
CREATE TABLE IF NOT EXISTS `soc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friends_array` text NOT NULL,
  `preferred_lang` varchar(3) NOT NULL DEFAULT 'ENG',
  `gender` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_users`
--

INSERT INTO `soc_users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friends_array`, `preferred_lang`, `gender`) VALUES
(1, 'Joseph', 'Handschu', 'jhsocial', 'password', 'jh@social.com', '2017-09-11', '', 0, 0, '', '', 'ENG', ''),
(2, 'Joseph', 'Handschu', 'joseph_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'J@h.com', '2017-09-13', 'assets/images/profile_pics/joseph_handschu7e90fadab4cadeab92e92481bcc0091an.jpeg', 24, 5, 'no', ',matthew_handschu,lorena_handschu,matthew_handschu_1,matthew_handschu,', 'ENG', ''),
(3, 'Lorena', 'Handschu', 'lorena_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'L@h.com', '2017-09-13', 'assets/images/profile_pics/lorena_handschu6365bdeab245068934af2e8e53385b1en.jpeg', 4, 1, 'no', ',matthew_handschu,maria_handschu,joseph_handschu,matthew_handschu_1,', 'ENG', ''),
(4, 'Matthew', 'Handschu', 'matthew_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'M@h.com', '2017-09-13', 'assets/images/profile_pics/matthew_handschu5cc7a59555fa4bd09ac58df9c9a3a7dbn.jpeg', 2, 4, 'no', ',lorena_handschu,maria_handschu,joseph_handschu,', 'ENG', ''),
(5, 'Matthew', 'Handschu1', 'matthew_handschu_1', '5f4dcc3b5aa765d61d8327deb882cf99', 'M1@h.com', '2017-09-13', 'assets/images/profile_pics/matthew_handschu_16f7a1b2f9a2ae1370e1c005c60740e60n.jpeg', 2, 0, 'no', ',lorena_handschu,joseph_handschu,', 'SPA', ''),
(6, 'Maria', 'Handschu', 'maria_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ma@h.com', '2017-09-13', 'assets/images/profile_pics/maria_handschu75e3328f662abb543c9cb4cb4cd521dfn.jpeg', 3, 0, 'no', ',lorena_handschu,matthew_handschu,', 'ENG', ''),
(7, 'Joseph', 'Handschu', 'joseph_handschu_1', 'fbfbe9407f894a925a25e51a66e6f813', 'Jhandschu@gmail.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',', 'ENG', ''),
(8, 'Juan', 'Perez', 'juan_perez', '5f4dcc3b5aa765d61d8327deb882cf99', 'J@p.com', '2017-10-27', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', ''),
(9, 'John', 'Doe', 'john_doe', '5f4dcc3b5aa765d61d8327deb882cf99', 'J@d.com', '2017-10-27', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', ''),
(10, 'Jane', 'Doe', 'jane_doe', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ja@d.com', '2017-10-27', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', ''),
(11, 'Fasdfa', 'Afaffaa', 'fasdfa_afaffaa', 'c483f6ce851c9ecd9fb835ff7551737c', 'A@b.com', '2017-10-27', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', ''),
(12, 'Gato', 'Felix', 'gato_felix', '5f4dcc3b5aa765d61d8327deb882cf99', 'G@f.com', '2017-10-27', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', ''),
(13, 'Dafadfasdf', 'Fasfasfadsfa', 'dafadfasdf_fasfasfadsfa', '5f4dcc3b5aa765d61d8327deb882cf99', 'F@u.com', '2017-10-27', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', ''),
(14, 'Mickey', 'Mouse', 'mickey_mouse', '5f4dcc3b5aa765d61d8327deb882cf99', 'M@m.com', '2018-01-01', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', 'N'),
(15, 'Minie', 'Mouse', 'minie_mouse', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mi@m.com', '2018-01-01', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',', 'ENG', 'F'),
(16, 'Captain', 'America', 'captain_america', '5f4dcc3b5aa765d61d8327deb882cf99', 'C@a.com', '2018-01-01', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',', 'ENG', 'M');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
