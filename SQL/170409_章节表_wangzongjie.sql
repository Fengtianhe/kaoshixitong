CREATE TABLE `ks_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属科目',
  `name` varchar(11) NOT NULL DEFAULT '0' COMMENT '章节名称',
  `flog` int(11) NOT NULL DEFAULT '0' COMMENT '权限',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8
