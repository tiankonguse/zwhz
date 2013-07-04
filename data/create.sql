SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `zwhz` DEFAULT CHARACTER SET utf8 ;
USE `zwhz` ;

-- -----------------------------------------------------
-- Table `zwhz`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `zwhz`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `nickName` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `lev` INT NULL DEFAULT 2 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zwhz`.`main`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `zwhz`.`main` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `code` INT NOT NULL COMMENT '0 代表合作院校 有title content link(img) time \\n1 代表合作动态 有title content  time \\n2 代表政策文件 有title content  time \\n3 代表通知公告 有title content  time \\n4 代表友情链接 有title link(url)\\n5 代表动态图片 有title link(img)' ,
  `title` VARCHAR(255) NULL ,
  `link` VARCHAR(255) NULL ,
  `time` VARCHAR(255) NULL ,
  `content` LONGTEXT NULL ,
  `select` TINYINT NULL ,
  `uer` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zwhz`.`login_log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `zwhz`.`login_log` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `login_name` VARCHAR(45) NULL ,
  `login_time` VARCHAR(45) NULL ,
  `login_ip` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
