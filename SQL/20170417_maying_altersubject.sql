ALTER TABLE `ks_subject` ADD COLUMN `sortnum` tinyint NOT NULL DEFAULT 0 AFTER `flog`;

ALTER TABLE `ks_chapter` ADD COLUMN `sortnum` tinyint NOT NULL DEFAULT 0 AFTER `flog`;

ALTER TABLE `ks_chapter` ADD COLUMN `sn` tinyint NOT NULL DEFAULT 0 AFTER `id`;