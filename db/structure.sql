SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `user_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_role` (
  `role_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `role_name` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`role_id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(100) NULL DEFAULT NULL ,
  `user_full_name` VARCHAR(255) NULL DEFAULT NULL ,
  `user_password` VARCHAR(45) NULL DEFAULT NULL ,
  `user_email` VARCHAR(45) NULL DEFAULT NULL ,
  `user_description` TEXT NULL DEFAULT NULL ,
  `user_role_role_id` INT(11) NULL ,
  `user_is_deleted` TINYINT(1) NULL DEFAULT 0 ,
  `user_input_date` TIMESTAMP NULL DEFAULT NULL ,
  `user_last_update` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_user_user_role1_idx` (`user_role_role_id` ASC) ,
  CONSTRAINT `fk_user_user_role1`
    FOREIGN KEY (`user_role_role_id` )
    REFERENCES `user_role` (`role_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `activity_log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `activity_log` (
  `log_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `log_date` TIMESTAMP NULL DEFAULT NULL ,
  `log_action` VARCHAR(45) NULL DEFAULT NULL ,
  `log_module` VARCHAR(45) NULL DEFAULT NULL ,
  `log_info` TEXT NULL DEFAULT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`log_id`) ,
  INDEX `fk_g_activity_log_g_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_g_activity_log_g_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `ci_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ci_sessions` (
  `id` VARCHAR(40) NOT NULL ,
  `ip_address` VARCHAR(45) NOT NULL ,
  `timestamp` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `data` BLOB NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `ci_sessions_timestamp` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mediamanager`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mediamanager` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `type` VARCHAR(45) NULL DEFAULT NULL ,
  `isfile` TINYINT(1) NULL DEFAULT '0' ,
  `label` TEXT NULL DEFAULT NULL ,
  `info` TEXT NULL DEFAULT NULL ,
  `upload_at` DATETIME NULL DEFAULT NULL ,
  `album_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `mediamanager_album`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mediamanager_album` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(255) NULL DEFAULT NULL ,
  `upload_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `posts_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `posts_category` (
  `category_id` INT NOT NULL AUTO_INCREMENT ,
  `category_name` VARCHAR(100) NULL ,
  PRIMARY KEY (`category_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `posts` (
  `posts_id` INT NOT NULL AUTO_INCREMENT ,
  `posts_title` VARCHAR(255) NULL ,
  `posts_description` TEXT NULL ,
  `posts_image` VARCHAR(255) NULL ,
  `posts_published_date` TIMESTAMP NULL ,
  `posts_is_published` TINYINT(1) NULL DEFAULT 0 ,
  `posts_category_category_id` INT NULL ,
  `user_user_id` INT(11) NULL ,
  `posts_input_date` TIMESTAMP NULL ,
  `posts_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`posts_id`) ,
  INDEX `fk_posts_posts_category1_idx` (`posts_category_category_id` ASC) ,
  INDEX `fk_posts_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_posts_posts_category1`
    FOREIGN KEY (`posts_category_category_id` )
    REFERENCES `posts_category` (`category_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_posts_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `student` (
  `student_id` INT NOT NULL AUTO_INCREMENT ,
  `student_nip` VARCHAR(45) NULL ,
  `student_name` VARCHAR(255) NULL ,
  `student_password` VARCHAR(45) NULL ,
  `student_phone` VARCHAR(45) NULL ,
  `student_email` VARCHAR(45) NULL ,
  `student_address` TEXT NULL ,
  `student_budget` DECIMAL(13) NULL ,
  `student_is_deleted` TINYINT(1) NULL ,
  `user_user_id` INT(11) NULL ,
  `student_input_date` TIMESTAMP NULL ,
  PRIMARY KEY (`student_id`) ,
  INDEX `fk_student_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_student_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `periode`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `periode` (
  `periode_id` INT NOT NULL AUTO_INCREMENT ,
  `periode_date` DATE NULL ,
  `periode_total_budget` DECIMAL(13) NULL DEFAULT 0 ,
  `periode_description` VARCHAR(45) NULL ,
  `user_user_id` INT(11) NULL ,
  `periode_input_date` TIMESTAMP NULL ,
  `periode_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`periode_id`) ,
  INDEX `fk_periode_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_periode_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `input_transaction`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `input_transaction` (
  `transaction_id` INT NOT NULL AUTO_INCREMENT ,
  `transaction_is_late` TINYINT(1) NULL DEFAULT 0 COMMENT '0=Tidak telat, 1=Telat' ,
  `periode_periode_id` INT NULL ,
  `student_student_id` INT NULL ,
  `transaction_input_date` TIMESTAMP NULL ,
  `transaction_last_update` TIMESTAMP NULL ,
  `user_user_id` INT(11) NULL ,
  PRIMARY KEY (`transaction_id`) ,
  INDEX `fk_periode_has_student_student1_idx` (`student_student_id` ASC) ,
  INDEX `fk_periode_has_student_periode1_idx` (`periode_periode_id` ASC) ,
  INDEX `fk_periode_transaction_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_periode_has_student_periode1`
    FOREIGN KEY (`periode_periode_id` )
    REFERENCES `periode` (`periode_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_periode_has_student_student1`
    FOREIGN KEY (`student_student_id` )
    REFERENCES `student` (`student_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_periode_transaction_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `class_setting`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `class_setting` (
  `setting_id` INT NOT NULL AUTO_INCREMENT ,
  `setting_name` VARCHAR(255) NULL ,
  `setting_value` TEXT NULL ,
  `setting_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`setting_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `output_transaction`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `output_transaction` (
  `output_transaction_id` INT NOT NULL AUTO_INCREMENT ,
  `transaction_title` VARCHAR(255) NULL ,
  `transaction_date` TIMESTAMP NULL ,
  `transaction_description` TEXT NULL ,
  `transaction_budget` DECIMAL(13) NULL ,
  `user_user_id` INT(11) NULL ,
  `transaction_input_date` TIMESTAMP NULL ,
  `transaction_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`output_transaction_id`) ,
  INDEX `fk_output_transaction_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_output_transaction_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
