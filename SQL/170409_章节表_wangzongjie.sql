
CREATE TABLE `ks_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL COMMENT '所属科目',
  `name` varchar(11) NOT NULL COMMENT '章节名称',
  `flog` int(11) NOT NULL DEFAULT '1' COMMENT '权限',
  `creat_time` int(11) NOT NULL COMMENT '创建时间',
  `model_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8
