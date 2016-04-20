CREATE TABLE `ks_system` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `simulation` tinyint(4) DEFAULT NULL,
  `practice` tinyint(4) DEFAULT NULL,
  `practice_child1` tinyint(4) DEFAULT NULL,
  `practice_child2` tinyint(4) DEFAULT NULL,
  `practice_child3` tinyint(4) DEFAULT NULL,
  `practice_child4` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
