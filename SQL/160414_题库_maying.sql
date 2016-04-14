set names utf8;
CREATE TABLE `ks_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '题干',
  `explain` varchar(200) NOT NULL DEFAULT '' COMMENT '解释',
  `is_true` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否正确',
  `category` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类别 类似科目一 科目二',
  `question_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '题型',
  `province_id` int(11) NOT NULL DEFAULT '0' COMMENT '省',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '市',
  `area_id` int(11) NOT NULL DEFAULT '0' COMMENT '区',
  `is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `admin_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='题库表';

CREATE TABLE `ks_question_stem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属题干id',
  `stem_content` varchar(200) NOT NULL DEFAULT '' COMMENT '内容',
  `sn` tinyint(4) NOT NULL DEFAULT '0' COMMENT '编号',
  `is_true` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为正确答案',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='题库选项表';
