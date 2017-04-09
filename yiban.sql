-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-09 06:32:36
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
  `user_name` varchar(20) DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  `is_anonymous` varchar(5) DEFAULT NULL,
  `floor` varchar(20) NOT NULL,
  `reply_floor` varchar(20) DEFAULT NULL,
  `create_time` datetime(6) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_comment`
--

INSERT INTO `ihome_comment` (`id`, `question_id`, `user_id`, `user_name`, `content`, `is_anonymous`, `floor`, `reply_floor`, `create_time`, `status`) VALUES
(1, '2', '2015211314', NULL, 'yeah_interesting1', '1', '1', '0', '2017-03-07 17:07:37.000000', '1'),
(5, '2', '2015211314', NULL, '3yeah_interesting', '1', '3', '0', '2017-03-07 17:11:41.000000', '1'),
(4, '2', '2015211314', NULL, '3yeah_interesting', '1', '2', '0', '2017-03-07 17:11:17.000000', '1'),
(6, '9', '2015211314', '管理员的昵称', '5555', '1', '1', '0', '2017-03-29 16:39:18.000000', '1'),
(7, '9', '2015211314', '管理员的昵称', 'hhh', '0', '2', '0', '2017-03-29 16:39:25.000000', '1'),
(8, '9', '2015211314', '管理员的昵称', '回复2L: 嘻嘻', '1', '3', '2', '2017-03-29 16:39:32.000000', '1'),
(9, '6', '2015211314', '管理员的昵称', '这个问题是啥啊', '1', '1', '0', '2017-03-29 16:40:14.000000', '1');

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
(3, '2015211314', '1', 'praise', '0', '1'),
(4, '2015211314', '9', 'praise', '0', '0'),
(5, '2015211314', '9', 'follow', '0', '0');

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
  `create_user_name` varchar(20) NOT NULL,
  `is_verify` varchar(20) DEFAULT NULL,
  `is_anonymous` varchar(20) DEFAULT NULL,
  `is_reply` varchar(20) DEFAULT NULL,
  `is_delete` varchar(5) DEFAULT NULL,
  `hot` int(20) NOT NULL,
  `reply` varchar(500) DEFAULT NULL,
  `reply_id` varchar(20) DEFAULT NULL,
  `reply_time` datetime(6) DEFAULT NULL,
  `processor` varchar(20) DEFAULT NULL,
  `progress` varchar(20) DEFAULT NULL,
  `attitude` varchar(50) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `efficiency` varchar(50) DEFAULT NULL,
  `all_in_all` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_question`
--

INSERT INTO `ihome_question` (`id`, `type`, `subject`, `content`, `create_time`, `create_user`, `create_user_name`, `is_verify`, `is_anonymous`, `is_reply`, `is_delete`, `hot`, `reply`, `reply_id`, `reply_time`, `processor`, `progress`, `attitude`, `result`, `efficiency`, `all_in_all`, `description`) VALUES
(1, '2', 'subject', 'content1', '2016-10-01 07:24:12.000000', '2015211313', '', '1', '1', '1', NULL, 12, '回复', '2015211314', NULL, '管委会', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '1', 'subject', 'content', '2017-03-07 16:35:32.000000', '2015211314', '', '1', '1', '0', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2', 'subject', '中文，啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', '2017-03-07 16:38:58.000000', '2015211314', '', '0', '1', '0', NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '1', 'subject', 'content', '2017-03-07 16:39:29.000000', '2015211314', '', '0', '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '1', 'subject', 'content', '2017-03-07 20:21:40.000000', '2015211314', '', '0', '1', '0', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2', 'subject', 'content', '2017-03-07 20:21:45.000000', '2015211314', '', '0', '1', '0', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '1', 'subject', 'content', '2017-03-07 20:21:45.000000', '2015211314', '', '0', '1', '0', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '1', 'subject', 'content', '2017-03-07 20:21:46.000000', '2015211314', '', '0', '1', '0', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '1', 'subject', 'content', '2017-03-07 20:21:47.000000', '2015211314', '', '0', '1', '0', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '1', 'subject', 'content', '2017-03-07 20:21:47.000000', '2015211314', '', '0', '1', '0', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '1', 'subject', 'content', '2017-03-07 20:21:48.000000', '2015211314', '', '0', '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '1', 'subject', 'content', '2017-03-07 20:21:48.000000', '2015211314', '', '0', '1', '0', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '1', 'subject', 'content', '2017-03-07 20:21:49.000000', '2015211314', '', '0', '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '0', 'lalalla', 'aaaa', '2017-03-25 11:23:47.000000', '2015211314', '', '0', '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '0', '15666666la', 'aaaa', '2017-03-25 11:23:59.000000', '2015211314', '', '0', '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ihome_recommend`
--

CREATE TABLE `ihome_recommend` (
  `id` int(10) NOT NULL,
  `question_id` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ihome_recommend`
--

INSERT INTO `ihome_recommend` (`id`, `question_id`, `status`) VALUES
(1, '2', '1'),
(2, '4', '1');

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
-- Indexes for table `ihome_recommend`
--
ALTER TABLE `ihome_recommend`
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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `ihome_praise`
--
ALTER TABLE `ihome_praise`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `ihome_question`
--
ALTER TABLE `ihome_question`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `ihome_recommend`
--
ALTER TABLE `ihome_recommend`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
