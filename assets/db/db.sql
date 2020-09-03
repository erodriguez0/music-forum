-- TABLES

CREATE TABLE `category` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_desc` varchar(256) COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `post` (
  `post_id` int(30) NOT NULL AUTO_INCREMENT,
  `post_content` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_img` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_thread` int(10) NOT NULL,
  `post_user` int(10) NOT NULL,
  `post_state` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reply` (
  `reply_id` int(30) NOT NULL AUTO_INCREMENT,
  `reply_content` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_user` int(10) NOT NULL,
  `reply_post` int(10) NOT NULL,
  `reply_state` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `thread` (
  `thread_id` int(30) NOT NULL AUTO_INCREMENT,
  `thread_title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thread_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thread_content` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thread_img` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thread_top` int(10) NOT NULL,
  `thread_user` int(10) NOT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `topic` (
  `top_id` int(8) NOT NULL AUTO_INCREMENT,
  `top_name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_desc` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_cat` int(10) NOT NULL,
  PRIMARY KEY (`top_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_uname` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pwd` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_fname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_lname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_img` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `user_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_level` int(2) NOT NULL DEFAULT '1',
  `user_state` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_info` (
  `info_id` int(10) NOT NULL AUTO_INCREMENT,
  `info_bio` varchar(384) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_gender` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_bday` date DEFAULT NULL,
  `info_home` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_work` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_school` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_education` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_website` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_user` int(10) NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- END TABLES
-- TRIGGERS

DELIMITER $$
CREATE TRIGGER `user_info_insert` AFTER INSERT ON `user` FOR EACH ROW BEGIN
		INSERT INTO user_info(info_user) VALUES (new.user_id);
	END
$$
DELIMITER ;

-- END TRIGGERS
-- INDICES

ALTER TABLE `category`
  ADD UNIQUE KEY `cat_name_unique` (`cat_name`);

ALTER TABLE `post`
  ADD KEY `post_user` (`post_user`),
  ADD KEY `post_thread` (`post_thread`);

ALTER TABLE `thread`
  ADD KEY `thread_user` (`thread_user`),
  ADD KEY `thread_top` (`thread_top`);

ALTER TABLE `topic`
  ADD UNIQUE KEY `top_name_unique` (`top_name`),
  ADD KEY `top_cat` (`top_cat`);

ALTER TABLE `user`
  ADD UNIQUE KEY `user_name_unique` (`user_uname`),
  ADD UNIQUE KEY `user_email_unique` (`user_email`);

ALTER TABLE `user_info`
  ADD KEY `info_user` (`info_user`);

-- END INDICES
-- FOREIGN KEYS

ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`post_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`post_thread`) REFERENCES `thread` (`thread_id`);

ALTER TABLE `reply`
  ADD CONSTRAINT `reply_post_ibfk_1` FOREIGN KEY (`reply_post`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `reply_user_ibfk_2` FOREIGN KEY (`reply_user`) REFERENCES `user` (`user_id`);

ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`thread_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`thread_top`) REFERENCES `topic` (`top_id`);

ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`top_cat`) REFERENCES `category` (`cat_id`);

ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`info_user`) REFERENCES `user` (`user_id`);

-- END FOREIGN KEYS