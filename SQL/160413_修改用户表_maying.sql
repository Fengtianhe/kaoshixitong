ALTER TABLE `kaoshi`.`ks_user` CHANGE `is_del` `is_del` TINYINT(4) DEFAULT -1 NOT NULL COMMENT '-1：正常   1：删除', ADD COLUMN `last_login_time` INT NULL COMMENT '最后登录时间' AFTER `time_length`, ADD COLUMN `create_time` INT NULL COMMENT '创建时间' AFTER `last_login_time`, ADD COLUMN `update_time` INT NULL COMMENT '修改时间' AFTER `create_time`; 