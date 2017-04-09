
CREATE TABLE `ks_adver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL COMMENT '图片',
  `flog` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `desc` varchar(50) DEFAULT NULL COMMENT '描述',
  `creat_time` int(11) NOT NULL COMMENT '创建时间',
  `model_time` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
