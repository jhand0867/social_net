-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2017 at 04:21 AM
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
(4, 'affafafafafa', '', 'none', '2017-09-17 17:05:54', 'no', 'no', 0);

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
  `friends_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc_users`
--

INSERT INTO `soc_users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friends_array`) VALUES
(1, 'Joseph', 'Handschu', 'jhsocial', 'password', 'jh@social.com', '2017-09-11', '', 0, 0, '', ''),
(2, 'Joseph', 'Handschu', 'joseph_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'J@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(3, 'Lorena', 'Handschu', 'lorena_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'L@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(4, 'Matthew', 'Handschu', 'matthew_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'M@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(5, 'Matthew', 'Handschu', 'matthew_handschu_1', '5f4dcc3b5aa765d61d8327deb882cf99', 'M1@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(6, 'Maria', 'Handschu', 'maria_handschu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ma@h.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(7, 'Joseph', 'Handschu', 'joseph_handschu_1', 'fbfbe9407f894a925a25e51a66e6f813', 'Jhandschu@gmail.com', '2017-09-13', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `soc_comments`
--
ALTER TABLE `soc_comments`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `soc_likes`
--
ALTER TABLE `soc_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `soc_posts`
--
ALTER TABLE `soc_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `soc_users`
--
ALTER TABLE `soc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
