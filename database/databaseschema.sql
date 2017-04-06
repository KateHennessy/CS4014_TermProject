-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2017 at 11:25 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group10`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_user`
--

CREATE TABLE `banned_user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `claimed_task`
--

CREATE TABLE `claimed_task` (
  `claimer_id` int(11) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE `discipline` (
  `discipline_id` int(11) UNSIGNED NOT NULL,
  `discipline_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flagged_task`
--

CREATE TABLE `flagged_task` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `flagger_id` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) UNSIGNED NOT NULL,
  `status_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) UNSIGNED NOT NULL,
  `tag_name` varchar(128) NOT NULL,
  `discipline_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` int(11) UNSIGNED NOT NULL,
  `task_title` varchar(128) NOT NULL,
  `task_type` varchar(128) NOT NULL,
  `description` varchar(600) NOT NULL,
  `claim_deadline` datetime NOT NULL,
  `completion_deadline` datetime NOT NULL,
  `no_pages` int(11) NOT NULL,
  `no_words` int(11) NOT NULL,
  `format` varchar(5) NOT NULL,
  `storage_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `task_tag`
--

CREATE TABLE `task_tag` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pass` char(64) NOT NULL,
  `discipline_id` int(11) UNSIGNED NOT NULL,
  `reputation` int(11) NOT NULL,
  `signup_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_tag`
--

CREATE TABLE `user_tag` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `tag_id` int(11) UNSIGNED NOT NULL,
  `clicks` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_user`
--
ALTER TABLE `banned_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `claimed_task`
--
ALTER TABLE `claimed_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `claimer_id` (`claimer_id`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`discipline_id`),
  ADD UNIQUE KEY `discipline_name` (`discipline_name`);

--
-- Indexes for table `flagged_task`
--
ALTER TABLE `flagged_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `flagger_id` (`flagger_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status_name` (`status_name`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`),
  ADD KEY `tag_ibfk_1` (`discipline_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`creator_id`,`task_title`),
  ADD UNIQUE KEY `task_id` (`task_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`task_id`,`status_id`,`timestamp`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `task_tag`
--
ALTER TABLE `task_tag`
  ADD PRIMARY KEY (`task_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `discipline_id` (`discipline_id`);

--
-- Indexes for table `user_tag`
--
ALTER TABLE `user_tag`
  ADD PRIMARY KEY (`user_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `discipline_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `banned_user`
--
ALTER TABLE `banned_user`
  ADD CONSTRAINT `banned_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `claimed_task`
--
ALTER TABLE `claimed_task`
  ADD CONSTRAINT `claimed_task_ibfk_1` FOREIGN KEY (`claimer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `claimed_task_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flagged_task`
--
ALTER TABLE `flagged_task`
  ADD CONSTRAINT `flagged_task_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flagged_task_ibfk_2` FOREIGN KEY (`flagger_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`discipline_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_status`
--
ALTER TABLE `task_status`
  ADD CONSTRAINT `task_status_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_status_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_tag`
--
ALTER TABLE `task_tag`
  ADD CONSTRAINT `task_tag_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`discipline_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tag`
--
ALTER TABLE `user_tag`
  ADD CONSTRAINT `user_tag_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;




  INSERT INTO `discipline` (`discipline_id`, `discipline_name`) VALUES (NULL, 'Computer Science');
  INSERT INTO `discipline` (`discipline_id`, `discipline_name`) VALUES (NULL, 'Psychology');
  INSERT INTO `discipline` (`discipline_id`, `discipline_name`) VALUES (NULL, 'History');



INSERT INTO `tag` (`tag_id`, `tag_name` ,`discipline_id`) VALUES (NULL, 'Graphics', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Artificial Intelligence', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Computer Architecture & Engineering', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Biosystems & Computational Biology', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Human-Computer Interaction', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Operating Systems & Networking', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Programming Systems', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Scientific Computing', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Security', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Theory', 1);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Abnormal Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Behavioral Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Biopsychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Cognitive Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Comparative Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Cross-Cultural Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Developmental Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Educational Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Experimental Psychology', 2);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'War', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Middle Ages', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'History of Women', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Vikings', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Roman Empire', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Ancient Egypt', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Prehistoric', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Religion', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'Social History', 3);
INSERT INTO `tag` (`tag_id`, `tag_name`,`discipline_id`) VALUES (NULL, 'World History', 3);



INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'unclaimed');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'unfinished');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'in progress');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'expired');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'complete');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'cancelled');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
