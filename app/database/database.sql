-- First version of DB

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `BlogDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `BlogDB` ;

-- -----------------------------------------------------
-- Table `BlogDB`.`PostsCategories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`PostsCategories` (
  `idPostsCategory` INT NOT NULL AUTO_INCREMENT ,
  `categoryName` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  `createdOn` TIMESTAMP NULL DEFAULT NOW() ,
  `updatedOn` TIMESTAMP NULL ,
  `isActive` TINYINT(1) NULL DEFAULT 1 ,
  PRIMARY KEY (`idPostsCategory`) ,
  UNIQUE INDEX `idPostsCategory_UNIQUE` (`idPostsCategory` ASC) ,
  UNIQUE INDEX `Name_UNIQUE` (`categoryName` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BlogDB`.`Posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BlogDB`.`Posts` (
  `idPost` INT NOT NULL AUTO_INCREMENT ,
  `link` VARCHAR(45) NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `shortContent` TEXT NOT NULL ,
  `longContent` TEXT NOT NULL ,
  `createdOn` TIMESTAMP NULL DEFAULT NOW() ,
  `updatedOn` TIMESTAMP NULL ,
  `isActive` TINYINT(1) NULL DEFAULT 1 ,
  `PostsCategories_idPostsCategory` INT NOT NULL ,
  PRIMARY KEY (`idPost`) ,
  UNIQUE INDEX `link_UNIQUE` (`link` ASC) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) ,
  UNIQUE INDEX `idPost_UNIQUE` (`idPost` ASC) ,
  INDEX `fk_Posts_PostsCategories_idx` (`PostsCategories_idPostsCategory` ASC) ,
  CONSTRAINT `fk_Posts_PostsCategories`
    FOREIGN KEY (`PostsCategories_idPostsCategory` )
    REFERENCES `BlogDB`.`PostsCategories` (`idPostsCategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

USE `BlogDB` ;

CREATE USER 'bloguser' IDENTIFIED BY 'blogpassword';

GRANT SELECT, INSERT, TRIGGER ON TABLE `BlogDB`.* TO 'bloguser';
GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `BlogDB`.* TO 'bloguser';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
