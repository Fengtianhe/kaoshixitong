CREATE TABLE `ks_user_permission` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `course_1` tinyint(4) DEFAULT '-1',
  `course_2` tinyint(4) DEFAULT '-1',
  `course_3` tinyint(4) DEFAULT '-1',
  `course_4` tinyint(4) DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
