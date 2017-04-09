
CREATE TABLE `ks_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL COMMENT '科目名称',
  `flog` int(11) NOT NULL DEFAULT '1' COMMENT '权限',
  `creat_time` int(11) NOT NULL COMMENT '创建时间',
  `model_time` int(11) NOT NULL COMMENT '修改时间',
  `area` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8
