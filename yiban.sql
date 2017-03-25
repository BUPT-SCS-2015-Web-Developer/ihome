-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-25 06:41:50
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yiban`
--

-- --------------------------------------------------------

--
-- 表的结构 `ihome_comment`
--

CREATE TABLE `ihome_comment` (
  `id` int(20) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `content` varchar(500) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `reply_floor` varchar(20) DEFAULT NULL,
  `create_time` datetime(6) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_comment`
--

INSERT INTO `ihome_comment` (`id`, `question_id`, `user_id`, `content`, `floor`, `reply_floor`, `create_time`, `status`) VALUES
(1, '2', '2015211314', 'yeah_interesting1', '1', '0', '2017-03-07 17:07:37.000000', '1'),
(5, '2', '2015211314', '3yeah_interesting', '3', '0', '2017-03-07 17:11:41.000000', '1'),
(4, '2', '2015211314', '3yeah_interesting', '2', '0', '2017-03-07 17:11:17.000000', '1');

-- --------------------------------------------------------

--
-- 表的结构 `ihome_praise`
--

CREATE TABLE `ihome_praise` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_read` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_praise`
--

INSERT INTO `ihome_praise` (`id`, `user_id`, `question_id`, `type`, `status`, `is_read`) VALUES
(1, '2015211314', '2', 'follow', '1', '1'),
(2, '2015211314', '1', 'follow', '1', '0'),
(3, '2015211314', '1', 'praise', '0', '1');

-- --------------------------------------------------------

--
-- 表的结构 `ihome_question`
--

CREATE TABLE `ihome_question` (
  `id` int(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `content` varchar(500) NOT NULL,
  `create_time` datetime(6) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `is_verify` varchar(20) DEFAULT NULL,
  `is_anonymous` varchar(20) DEFAULT NULL,
  `is_reply` varchar(20) DEFAULT NULL,
  `hot` int(20) NOT NULL,
  `reply` varchar(500) DEFAULT NULL,
  `reply_id` varchar(20) DEFAULT NULL,
  `processor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_question`
--

INSERT INTO `ihome_question` (`id`, `type`, `subject`, `content`, `create_time`, `create_user`, `is_verify`, `is_anonymous`, `is_reply`, `hot`, `reply`, `reply_id`, `processor`) VALUES
(1, '2', 'subject', 'content1', '2016-10-01 07:24:12.000000', '2015211313', '1', '1', '1', 12, '回复', '2015211314', '管委会'),
(2, '1', 'subject', 'content', '2017-03-07 16:35:32.000000', '2015211314', '1', '1', '0', 6, NULL, NULL, NULL),
(3, '2', 'subject', '中文，啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', '2017-03-07 16:38:58.000000', '2015211314', '0', '1', '0', 8, NULL, NULL, NULL),
(4, '1', 'subject', 'content', '2017-03-07 16:39:29.000000', '2015211314', '0', '1', '0', 0, NULL, NULL, NULL),
(5, '1', 'subject', 'content', '2017-03-07 20:21:40.000000', '2015211314', '0', '1', '0', 5, NULL, NULL, NULL),
(6, '2', 'subject', 'content', '2017-03-07 20:21:45.000000', '2015211314', '0', '1', '0', 6, NULL, NULL, NULL),
(7, '1', 'subject', 'content', '2017-03-07 20:21:45.000000', '2015211314', '0', '1', '0', 3, NULL, NULL, NULL),
(8, '1', 'subject', 'content', '2017-03-07 20:21:46.000000', '2015211314', '0', '1', '0', 4, NULL, NULL, NULL),
(9, '1', 'subject', 'content', '2017-03-07 20:21:47.000000', '2015211314', '0', '1', '0', 6, NULL, NULL, NULL),
(10, '1', 'subject', 'content', '2017-03-07 20:21:47.000000', '2015211314', '0', '1', '0', 2, NULL, NULL, NULL),
(11, '1', 'subject', 'content', '2017-03-07 20:21:48.000000', '2015211314', '0', '1', '0', 0, NULL, NULL, NULL),
(12, '1', 'subject', 'content', '2017-03-07 20:21:48.000000', '2015211314', '0', '1', '0', 5, NULL, NULL, NULL),
(13, '1', 'subject', 'content', '2017-03-07 20:21:49.000000', '2015211314', '0', '1', '0', 0, NULL, NULL, NULL),
(14, '0', 'lalalla', 'aaaa', '2017-03-25 11:23:47.000000', '2015211314', '0', '1', '0', 0, NULL, NULL, NULL),
(15, '0', '15666666la', 'aaaa', '2017-03-25 11:23:59.000000', '2015211314', '0', '1', '0', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ihome_user`
--

CREATE TABLE `ihome_user` (
  `yiban_id` varchar(20) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL COMMENT '用户类型'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_user`
--

INSERT INTO `ihome_user` (`yiban_id`, `school_id`, `name`, `type`) VALUES
('123', '2015211313', '赵逸飞', 'ordinary'),
('456', '2015211314', '管理员的昵称', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ihome_comment`
--
ALTER TABLE `ihome_comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ihome_praise`
--
ALTER TABLE `ihome_praise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ihome_question`
--
ALTER TABLE `ihome_question`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ihome_user`
--
ALTER TABLE `ihome_user`
  ADD PRIMARY KEY (`yiban_id`),
  ADD UNIQUE KEY `yiban_id` (`yiban_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ihome_comment`
--
ALTER TABLE `ihome_comment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `ihome_praise`
--
ALTER TABLE `ihome_praise`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `ihome_question`
--
ALTER TABLE `ihome_question`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
