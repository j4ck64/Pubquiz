-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'question'
-- 
-- ---

DROP TABLE IF EXISTS `question`;
		
CREATE TABLE `question` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(300) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `publish_date` TIMESTAMP NOT NULL DEFAULT 'current_timestamp()',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'user_anwser'
-- 
-- ---

DROP TABLE IF EXISTS `user_anwser`;
		
CREATE TABLE `user_anwser` (
  `id` INTEGER NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `anwser` VARCHAR(300) NULL DEFAULT NULL,
  `user_id` INTEGER NULL DEFAULT NULL,
  `question_id` INTEGER(100) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'user'
-- 
-- ---

DROP TABLE IF EXISTS `user`;
		
CREATE TABLE `user` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `email` VARCHAR(40) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'anwser'
-- 
-- ---

DROP TABLE IF EXISTS `anwser`;
		
CREATE TABLE `anwser` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `anwser` VARCHAR(300) NULL DEFAULT NULL,
  `question_id` INTEGER NOT NULL,
  `dummy_anwser` VARCHAR(300) NOT NULL,
  `dummy_anwser2` VARCHAR(300) NOT NULL,
  `dummy_anwser3` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `user_anwser` ADD FOREIGN KEY (user_id) REFERENCES `user` (`id`);
ALTER TABLE `user_anwser` ADD FOREIGN KEY (question_id) REFERENCES `question` (`id`);
ALTER TABLE `anwser` ADD FOREIGN KEY (question_id) REFERENCES `question` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `question` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user_anwser` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `anwser` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `question` (`id`,`question`,`slug`,`publish_date`) VALUES
-- ('','','','');
-- INSERT INTO `user_anwser` (`id`,`anwser`,`user_id`,`question_id`) VALUES
-- ('','','','');
-- INSERT INTO `user` (`id`,`email`,`password`,`is_admin`) VALUES
-- ('','','','');
-- INSERT INTO `anwser` (`id`,`anwser`,`question_id`,`dummy_anwser`,`dummy_anwser2`,`dummy_anwser3`) VALUES
-- ('','','','','','');