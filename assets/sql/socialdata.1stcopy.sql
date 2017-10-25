-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2017 at 09:54 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `soc_comments`
--

CREATE TABLE `soc_comments` (
  `id` int(11) NOT NULL,
  `comment_body` text NOT NULL,
  `comment_by` varchar(60) NOT NULL,
  `comment_to` varchar(60) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_removed` varchar(3) NOT NULL,
  `comment_to_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(19, '', 'joseph_handschu', 'lorena_handschu', '2017-10-03 21:10:00', 'no', 44);

-- --------------------------------------------------------

--
-- Table structure for table `soc_friend_requests`
--

CREATE TABLE `soc_friend_requests` (
  `id` int(11) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `req_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_friend_requests`
--

INSERT INTO `soc_friend_requests` (`id`, `user_from`, `user_to`, `req_date`, `status`) VALUES
(1, 'maria_handschu', 'matthew_handschu_1', '2017-10-08', 'A'),
(2, 'lorena_handschu', 'maria_handschu', '2017-10-08', 'A'),
(3, 'joseph_handschu', 'maria_handschu', '2017-10-08', 'A'),
(4, 'lorena_handschu', 'joseph_handschu', '2017-10-09', 'A'),
(5, 'maria_handschu', 'matthew_handschu', '2017-10-09', 'A'),
(6, 'joseph_handschu', 'joseph_handschu_1', '2017-10-09', 'P'),
(7, 'lorena_handschu', 'matthew_handschu_1', '2017-10-10', 'P'),
(8, 'joseph_handschu', 'matthew_handschu_1', '2017-10-10', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `soc_likes`
--

CREATE TABLE `soc_likes` (
  `id` int(11) NOT NULL,
  `like_username` varchar(60) NOT NULL,
  `like_to_post_id` int(11) NOT NULL,
  `like_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_likes`
--

INSERT INTO `soc_likes` (`id`, `like_username`, `like_to_post_id`, `like_date`) VALUES
(8, 'lorena_handschu', 36, '2017-10-07 13:54:56'),
(12, 'joseph_handschu', 44, '2017-10-07 14:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `soc_posts`
--

CREATE TABLE `soc_posts` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `post_added_by` varchar(60) NOT NULL,
  `post_user_to` varchar(60) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_user_closed` varchar(3) NOT NULL,
  `post_deleted` varchar(3) NOT NULL,
  `post_likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(42, 'First post of Lorena', 'lorena_handschu', 'none', '2017-09-24 21:44:25', 'no', 'no', 0),
(43, 'Matt\'s first post', 'matthew_handschu', 'none', '2017-10-01 08:18:52', 'no', 'no', 4),
(44, 'New post, any comments?', 'lorena_handschu', 'none', '2017-10-01 10:34:23', 'no', 'no', 1),
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
(55, 'Post to self', 'joseph_handschu', 'none', '2017-10-13 20:04:24', 'no', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `soc_users`
--

CREATE TABLE `soc_users` (
  `id` int(11) NOT NULL,
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
  `preferred_lang` varchar(3) NOT NULL DEFAULT 'ENG'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_users`
--

INSERT INTO `soc_users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friends_array`, `preferred_lang`) VALUES
(1, 'Joseph', 'Handschu', 'jhsocial', 'password', 'jh@social.com', '2017-09-11', '', 0, 0, '', '', 'ENG'),
(2, 'Joseph', 'Handschu', 'joseph_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'J@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_emerald.png', 20, 5, 'no', ',matthew_handschu,maria_handschu,lorena_handschu,', 'ENG'),
(3, 'Lorena', 'Handschu', 'lorena_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'L@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_pumpkin.png', 2, 1, 'no', ',matthew_handschu,maria_handschu,joseph_handschu,', 'ENG'),
(4, 'Matthew', 'Handschu', 'matthew_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'M@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 1, 4, 'no', ',lorena_handschu,maria_handschu,', 'ENG'),
(5, 'Matthew', 'Handschu1', 'matthew_handschu_1', '5f4dcc3b5aa765d61d8327deb882cf99', 'M1@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',maria_handschu,', 'SPA'),
(6, 'Maria', 'Handschu', 'maria_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ma@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_emerald.png', 2, 0, 'no', ',lorena_handschu,joseph_handschu,matthew_handschu,matthew_handschu_1,', 'ENG'),
(7, 'Joseph', 'Handschu', 'joseph_handschu_1', 'fbfbe9407f894a925a25e51a66e6f813', 'Jhandschu@gmail.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',', 'ENG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `soc_comments`
--
ALTER TABLE `soc_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soc_friend_requests`
--
ALTER TABLE `soc_friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soc_likes`
--
ALTER TABLE `soc_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soc_posts`
--
ALTER TABLE `soc_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soc_users`
--
ALTER TABLE `soc_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `soc_comments`
--
ALTER TABLE `soc_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `soc_friend_requests`
--
ALTER TABLE `soc_friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `soc_likes`
--
ALTER TABLE `soc_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `soc_posts`
--
ALTER TABLE `soc_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `soc_users`
--
ALTER TABLE `soc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
