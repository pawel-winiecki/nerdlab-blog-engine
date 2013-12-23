SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `BlogDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `BlogDB` ;

-- -----------------------------------------------------
-- Table `BlogDB`.`posts_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`posts_category` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `category_name` VARCHAR(45) NOT NULL ,
  `link` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  `created_on` TIMESTAMP NULL DEFAULT NOW() ,
  `updated_on` TIMESTAMP NULL ,
  `is_active` TINYINT(1) NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idPostsCategory_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `Name_UNIQUE` (`category_name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BlogDB`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  `first_name` VARCHAR(45) NULL ,
  `last_name` VARCHAR(45) NULL ,
  `created_on` TIMESTAMP NULL DEFAULT NOW() ,
  `updated_on` TIMESTAMP NULL ,
  `password_requested_at` TIMESTAMP NULL ,
  `is_active` TINYINT(1) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idUser_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BlogDB`.`post`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `link` VARCHAR(45) NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `short_content` TEXT NOT NULL ,
  `long_content` TEXT NOT NULL ,
  `created_on` TIMESTAMP NULL DEFAULT NOW() ,
  `updated_on` TIMESTAMP NULL ,
  `is_active` TINYINT(1) NULL DEFAULT 1 ,
  `posts_category_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `link_UNIQUE` (`link` ASC) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) ,
  UNIQUE INDEX `idPost_UNIQUE` (`id` ASC) ,
  INDEX `fk_post_posts_category_idx` (`posts_category_id` ASC) ,
  INDEX `fk_post_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_post_posts_category`
    FOREIGN KEY (`posts_category_id` )
    REFERENCES `BlogDB`.`posts_category` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BlogDB`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `BlogDB`.`comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `content` VARCHAR(500) NOT NULL ,
  `created_on` TIMESTAMP NULL DEFAULT NOW() ,
  `updated_on` TIMESTAMP NULL ,
  `is_active` TINYINT(1) NULL DEFAULT 1 ,
  `user_id` INT NOT NULL ,
  `post_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idComment_UNIQUE` (`id` ASC) ,
  INDEX `fk_comment_user1_idx` (`user_id` ASC) ,
  INDEX `fk_comment_post1_idx` (`post_id` ASC) ,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BlogDB`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_post1`
    FOREIGN KEY (`post_id` )
    REFERENCES `BlogDB`.`post` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BlogDB`.`role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_name` VARCHAR(45) NOT NULL ,
  `created_on` TIMESTAMP NULL DEFAULT NOW() ,
  `updated_on` TIMESTAMP NULL ,
  `is_active` TINYINT(1) NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `roleName_UNIQUE` (`role_name` ASC) ,
  UNIQUE INDEX `idRole_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BlogDB`.`user_has_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`user_has_role` (
  `user_id` INT NOT NULL ,
  `role_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `role_id`) ,
  INDEX `fk_user_has_role_role1_idx` (`role_id` ASC) ,
  INDEX `fk_user_has_role_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_has_role_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BlogDB`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_role_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `BlogDB`.`role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `BlogDB` ;

GRANT SELECT, INSERT, TRIGGER ON TABLE `BlogDB`.* TO 'bloguser';
GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `BlogDB`.* TO 'bloguser';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `BlogDB`.`role`
(`role_name`)
VALUES
('ROLE_ADMIN'),('ROLE_AUTHOR'),('ROLE_USER');

INSERT INTO `BlogDB`.`user`
(`login`,
`email`,
`password`,
`is_active`)
VALUES
(
'admin',
'pawel.winiecki+admin@gmail.com',
'836bc6397d06de5f635683cff01822564683b57c5298c38bd389628685d9ce9d74cba952fc80ac305a6dd1d122bb041dfa93377880d478f27b99da3fafc05bf6',
1
);
