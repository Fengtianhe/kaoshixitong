CREATE TABLE `ks_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
