-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pp_project_manager
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pp_project_manager
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pp_project_manager` DEFAULT CHARACTER SET utf8 ;
USE `pp_project_manager` ;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `due_date` DATETIME NULL,
  `done` TINYINT NOT NULL DEFAULT 0,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projects_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_projects_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sections`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sections` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `project_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sections_projects1_idx` (`project_id` ASC),
  CONSTRAINT `fk_sections_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `projects` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `done` TINYINT NOT NULL DEFAULT 0,
  `due_date` DATETIME NULL,
  `assigned_to` INT UNSIGNED NOT NULL,
  `section_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tasks_sections1_idx` (`section_id` ASC),
  INDEX `fk_tasks_users1_idx` (`assigned_to` ASC),
  CONSTRAINT `fk_tasks_sections1`
    FOREIGN KEY (`section_id`)
    REFERENCES `sections` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tasks_users1`
    FOREIGN KEY (`assigned_to`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subtasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `subtasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `done` TINYINT NULL DEFAULT 0,
  `task_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subtasks_tasks1_idx` (`task_id` ASC),
  CONSTRAINT `fk_subtasks_tasks1`
    FOREIGN KEY (`task_id`)
    REFERENCES `tasks` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` TEXT NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `project_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_projects1_idx` (`project_id` ASC),
  INDEX `fk_messages_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_messages_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `projects` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `notes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `project_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notes_projects1_idx` (`project_id` ASC),
  CONSTRAINT `fk_notes_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `projects` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `url` TEXT NOT NULL,
  `project_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_files_projects1_idx` (`project_id` ASC),
  CONSTRAINT `fk_files_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `projects` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schedules`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `due_date` DATETIME NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_schedules_projects1_idx` (`user_id` ASC),
  CONSTRAINT `fk_schedules_projects1`
    FOREIGN KEY (`user_id`)
    REFERENCES `projects` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
