CREATE TABLE `ks_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `way` int(11) NOT NULL DEFAULT '1' COMMENT '1：qq  2：qq群  3： 微信群',
  `flog` int(11) NOT NULL DEFAULT '0' COMMENT '1:开启 2：关闭',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8