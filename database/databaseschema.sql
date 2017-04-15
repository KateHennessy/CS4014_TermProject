-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2017 at 05:56 PM
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
CREATE DATABASE IF NOT EXISTS `group10` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `group10`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `ChangeBannedTasksToCancelled`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ChangeBannedTasksToCancelled` (IN `u_ID` INT(11))  BEGIN
 DECLARE done INT DEFAULT FALSE;
  DECLARE t_ID BIGINT(20);
DECLARE c CURSOR FOR
SELECT task_id
FROM claimed_task JOIN task USING(task_id)
   WHERE task_id IN
   		(SELECT ts1.task_id
     	FROM task_status ts1
     	WHERE ts1.timestamp >= ALL
     		(SELECT ts2.timestamp
         	FROM task_status ts2
         	WHERE ts2.task_id = ts1.task_id
        	)
     	AND ts1.status_id =
         (SELECT status_id
          FROM status
          WHERE status_name='in progress'
         )
    ) AND claimer_id = u_ID;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
          OPEN c;
menuLoop: LOOP
  	     FETCH c INTO t_ID;
               IF done THEN LEAVE menuLoop; END IF;
               CALL UpdateTaskStatus(t_id, (SELECT status_id FROM status WHERE status_name='cancelled'));

  	  END LOOP;
  	CLOSE c;
  END$$

DROP PROCEDURE IF EXISTS `ChangeClaimedToUnfinished`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ChangeClaimedToUnfinished` ()  BEGIN
        DECLARE done INT DEFAULT FALSE;
	    DECLARE t_ID BIGINT(20);
        DECLARE c CURSOR FOR
           SELECT ts1.task_id
           FROM task_status ts1
           WHERE ts1.timestamp >= ALL
                (SELECT ts2.timestamp
                 FROM task_status ts2
                 WHERE ts1.task_id = ts2.task_id)
           AND ts1.task_id IN
           		(SELECT t1.task_id
                 FROM task t1
                 WHERE t1.completion_deadline < NOW()
                )
          AND ts1.status_id =
          		(SELECT status_id
                 FROM status
                 WHERE status_name='in progress');

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN c;
menuLoop: LOOP
	     FETCH c INTO t_ID;
             IF done THEN LEAVE menuLoop; END IF;

              CALL UpdateUserReputation((SELECT claimer_id FROM `claimed_task` WHERE task_id = t_id), -30);
             CALL UpdateTaskStatus(t_id, (SELECT status_id FROM `status` WHERE status_name='unfinished'));

	  END LOOP;
	CLOSE c;
END$$

DROP PROCEDURE IF EXISTS `ChangeUnclaimedToExpired`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ChangeUnclaimedToExpired` ()  BEGIN
        DECLARE done INT DEFAULT FALSE;
	    DECLARE t_ID BIGINT(20);
        DECLARE c CURSOR FOR
            SELECT ts1.task_id
            FROM task_status ts1
            WHERE  ts1.timestamp >= ALL
                (SELECT ts2.timestamp
                 FROM task_status ts2
                 WHERE ts1.task_id = ts2.task_id)
            AND ts1.task_id IN
                (SELECT t1.task_id
                 FROM task t1
                 WHERE t1.claim_deadline < NOW())
            AND ts1.status_id =
              (SELECT status_id
                 FROM status
                 WHERE status_name='unclaimed');

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN c;
menuLoop: LOOP
	     FETCH c INTO t_ID;
             IF done THEN LEAVE menuLoop; END IF;
             CALL UpdateTaskStatus(t_id, (SELECT status_id FROM status WHERE status_name='expired'));

	  END LOOP;
	CLOSE c;
END$$

DROP PROCEDURE IF EXISTS `UpdateTaskStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTaskStatus` (IN `task_id` BIGINT(20), IN `status_id` INT(11))  INSERT INTO `task_status` (`task_id`, `status_id`, `timestamp`)
		VALUES(task_id, status_id, NOW())$$

DROP PROCEDURE IF EXISTS `UpdateUserReputation`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserReputation` (IN `u_ID` INT(11), IN `repChange` INT(11))  BEGIN

DECLARE current_rep INT(11) DEFAULT 0;
DECLARE new_rep INT(11) DEFAULT 0;

SELECT reputation INTO current_rep FROM user WHERE user_id = u_ID;
SET new_rep = current_rep + repChange;

UPDATE user SET reputation = new_rep WHERE user_id = u_ID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `banned_user`
--

DROP TABLE IF EXISTS `banned_user`;
CREATE TABLE `banned_user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `banned_user`
--
DROP TRIGGER IF EXISTS `RemoveBannedTasks`;
DELIMITER $$
CREATE TRIGGER `RemoveBannedTasks` BEFORE INSERT ON `banned_user` FOR EACH ROW BEGIN
  DELETE FROM `task` WHERE `task`.`creator_id` = NEW.user_id AND `task_id` NOT IN (SELECT `task_id` FROM claimed_task);
  CALL ChangeBannedTasksToCancelled(New.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `claimed_task`
--

DROP TABLE IF EXISTS `claimed_task`;
CREATE TABLE `claimed_task` (
  `claimer_id` int(11) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

DROP TABLE IF EXISTS `discipline`;
CREATE TABLE `discipline` (
  `discipline_id` int(11) UNSIGNED NOT NULL,
  `discipline_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`discipline_id`, `discipline_name`) VALUES
(1, 'Computer Science'),
(3, 'History'),
(2, 'Psychology');

-- --------------------------------------------------------

--
-- Table structure for table `flagged_task`
--

DROP TABLE IF EXISTS `flagged_task`;
CREATE TABLE `flagged_task` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `flagger_id` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(11) UNSIGNED NOT NULL,
  `status_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(6, 'cancelled'),
(5, 'complete'),
(4, 'expired'),
(3, 'in progress'),
(1, 'unclaimed'),
(2, 'unfinished');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id` int(11) UNSIGNED NOT NULL,
  `tag_name` varchar(128) NOT NULL,
  `discipline_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `discipline_id`) VALUES
(1, 'Graphics', 1),
(2, 'Artificial Intelligence', 1),
(3, 'Computer Architecture & Engineering', 1),
(4, 'Biosystems & Computational Biology', 1),
(5, 'Human-Computer Interaction', 1),
(6, 'Operating Systems & Networking', 1),
(7, 'Programming Systems', 1),
(8, 'Scientific Computing', 1),
(9, 'Security', 1),
(10, 'Theory', 1),
(11, 'Abnormal Psychology', 2),
(12, 'Behavioral Psychology', 2),
(13, 'Biopsychology', 2),
(14, 'Cognitive Psychology', 2),
(15, 'Comparative Psychology', 2),
(16, 'Cross-Cultural Psychology', 2),
(17, 'Developmental Psychology', 2),
(18, 'Educational Psychology', 2),
(19, 'Experimental Psychology', 2),
(20, 'War', 3),
(21, 'Middle Ages', 3),
(22, 'History of Women', 3),
(23, 'Vikings', 3),
(24, 'Roman Empire', 3),
(25, 'Ancient Egypt', 3),
(26, 'Prehistoric', 3),
(27, 'Religion', 3),
(28, 'Social History', 3),
(29, 'World History', 3);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
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

DROP TABLE IF EXISTS `task_status`;
CREATE TABLE `task_status` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `task_status`
--
DROP TRIGGER IF EXISTS `CheckTaskStatusUpdate`;
DELIMITER $$
CREATE TRIGGER `CheckTaskStatusUpdate` BEFORE INSERT ON `task_status` FOR EACH ROW BEGIN
  IF NEW.task_id IN
  	(SELECT ts1.task_id FROM task_status ts1 WHERE ts1.timestamp >= ALL
     	(SELECT ts2.timestamp FROM task_status ts2 WHERE ts1.task_id = ts2.task_id) AND ts1.status_id = NEW.status_id
    )
  THEN
   SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This status is already the most recent set for this task.';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `task_tag`
--

DROP TABLE IF EXISTS `task_tag`;
CREATE TABLE `task_tag` (
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
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

DROP TABLE IF EXISTS `user_tag`;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
