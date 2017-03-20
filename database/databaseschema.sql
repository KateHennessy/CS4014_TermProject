CREATE DATABASE sample; 

CREATE TABLE IF NOT EXISTS `discipline`(
`discipline_id` INT(11) unsigned NOT NULL AUTO_INCREMENT, 
`discipline_name` VARCHAR(128) NOT NULL,
PRIMARY KEY(`discipline_id`),
UNIQUE(`discipline_name`)
);


CREATE TABLE IF NOT EXISTS  `user`(
`user_id` INT(11) unsigned NOT NULL AUTO_INCREMENT, 
`f_name` VARCHAR(100) NOT NULL,
`l_name` VARCHAR(100) NOT NULL,
`email` VARCHAR(128) NOT NULL,
`pass` CHAR(64) NOT NULL,
`discipline_id` INT(11) unsigned NOT NULL,
`reputation` INT(11) NOT NULL,
`signup_date` DATETIME NOT NULL,
PRIMARY KEY(`user_id`),
FOREIGN KEY(`discipline_id`) REFERENCES discipline(`discipline_id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
UNIQUE(`email`)
);

CREATE TABLE IF NOT EXISTS `banned_user`(
`user_id` INT(11) unsigned NOT NULL,
`timestamp` DATETIME, 
PRIMARY KEY(`user_id`),
FOREIGN KEY(`user_id`) REFERENCES user(`user_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `task`(
`task_id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
`creator_id` INT(11) unsigned NOT NULL,
`task_title` VARCHAR(128) NOT NULL,
`task_type` VARCHAR(128) NOT NULL,
`description` VARCHAR(200) NOT NULL,
`claim_deadline` DATETIME NOT NULL,
`completion_deadline` DATETIME NOT NULL,
`no_pages` INT(11) NOT NULL,
`no_words` INT(11) NOT NULL,
`format` VARCHAR(5) NOT NULL,
`storage_address` VARCHAR(200) NOT NULL,
PRIMARY KEY(`task_id`),
FOREIGN KEY (`creator_id`) REFERENCES user(`user_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `flagged_task`(
`task_id` BIGINT(20) unsigned NOT NULL,
`flagger_id` INT(11) unsigned NOT NULL, 
`timestamp` DATETIME NOT NULL,
PRIMARY KEY(`task_id`),
FOREIGN KEY(`task_id`) REFERENCES task(`task_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(`flagger_id`) REFERENCES user(`user_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `status`(
`status_id` INT(11) unsigned NOT NULL AUTO_INCREMENT, 
`status_name` VARCHAR(40) NOT NULL, 
PRIMARY KEY(`status_id`),
UNIQUE(`status_name`)
);

CREATE TABLE IF NOT EXISTS `task_status`(
`task_id` BIGINT(20) unsigned NOT NULL,
`status_id` INT(11) unsigned NOT NULL, 
`timestamp` DATETIME,
PRIMARY KEY(`task_id`,`status_id`,`timestamp`),
FOREIGN KEY(`task_id`) REFERENCES task(`task_id`) 

ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(`status_id`) REFERENCES status(`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS `claimed_task`(
`claimer_id` INT(11) unsigned NOT NULL,
`task_id` BIGINT(20) unsigned NOT NULL,
`score` INT(11) unsigned NOT NULL DEFAULT 0,
PRIMARY KEY(`task_id`),
FOREIGN KEY (`claimer_id`) REFERENCES user (`user_id`) ON DELETE CASCADE  ON UPDATE CASCADE,
FOREIGN KEY(`task_id`) REFERENCES task(`task_id`)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `tag`(
`tag_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
`tag_name` VARCHAR(128) NOT NULL,
PRIMARY KEY(`tag_id`),
UNIQUE(`tag_name`)
);

CREATE TABLE IF NOT EXISTS `user_tag`(
`user_id` INT(11) unsigned NOT NULL,
`tag_id` INT(11) unsigned NOT NULL,
`clicks` INT(11) unsigned NOT NULL DEFAULT 0,
PRIMARY KEY(`user_id`, `tag_id`),
FOREIGN KEY(`user_id`) REFERENCES user(`user_id`) 

ON DELETE CASCADE  ON UPDATE CASCADE,
FOREIGN KEY(`tag_id`) REFERENCES tag(`tag_id`) ON 

DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `task_tag`(
`task_id` BIGINT(20) unsigned NOT NULL,
`tag_id` INT(11) unsigned NOT NULL,
PRIMARY KEY(`task_id`, `tag_id`),
FOREIGN KEY(`task_id`) REFERENCES task(`task_id`) 

ON DELETE CASCADE  ON UPDATE CASCADE,
FOREIGN KEY(`tag_id`) REFERENCES tag(`tag_id`) ON 

DELETE CASCADE ON UPDATE CASCADE
);



INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Graphics');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Artificial Intelligence');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Computer Architecture & Engineering');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Biosystems & Computational Biology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Human-Computer Interaction');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Operating Systems & Networking');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Programming Systems');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Scientific Computing');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Security');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Theory');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Abnormal Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Behavioral Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Biopsychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Cognitive Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Comparative Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Cross-Cultural Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Developmental Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Educational Psychology');
INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES (NULL, 'Experimental Psychology');


INSERT INTO `discipline` (`discipline_id`, `discipline_name`) VALUES (NULL, 'Computer Science');
INSERT INTO `discipline` (`discipline_id`, `discipline_name`) VALUES (NULL, 'Psychology');


INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'unclaimed');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'unfinished');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'in progress');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'expired');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'complete');
INSERT INTO `status` (`status_id`, `status_name`) VALUES (NULL, 'cancelled');


