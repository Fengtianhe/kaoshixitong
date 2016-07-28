CREATE TABLE `ks_user_log` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `admin_id` int(11) NOT NULL DEFAULT '0',
   `user_id` int(11) NOT NULL DEFAULT '0',
   `value` int(11) NOT NULL DEFAULT '0',
   `create_time` int(11) NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8