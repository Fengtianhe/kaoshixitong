CREATE TABLE `ks_user_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `one_result` text COMMENT '科目一 答案',
  `two_result` text COMMENT '科目二答案',
  `three_result` text,
  `four_result` text,
  PRIMARY KEY (`id`),
  KEY `index2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;