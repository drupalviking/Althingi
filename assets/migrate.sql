ALTER TABLE `althingi`.`Assembly` ADD COLUMN `period` VARCHAR(100) NULL  AFTER `to` ;
ALTER TABLE `althingi`.`Assembly` CHANGE COLUMN `to` `to` DATE NULL DEFAULT NULL  ;
UPDATE Assembly SET dirty = 0;
ALTER TABLE `althingi`.`Assembly_has_Person` ADD COLUMN `constituency_id` INT(11) NULL DEFAULT NULL  AFTER `type` ;
ALTER TABLE `althingi`.`Assembly_has_Person` ADD COLUMN `constituency_number` INT(11) NULL DEFAULT NULL  AFTER `constituency` ;
ALTER TABLE `althingi`.`Person` ADD COLUMN `abbr` VARCHAR(20) NULL DEFAULT NULL  AFTER `name` , ADD COLUMN `dob` DATE NULL DEFAULT NULL  AFTER `abbr` ;
ALTER TABLE `althingi`.`Person` ADD COLUMN `website` VARCHAR(255) NULL DEFAULT NULL  AFTER `dob` ;
ALTER TABLE `althingi`.`Person` ADD COLUMN `facebook` VARCHAR(255) NULL DEFAULT NULL  AFTER `website` , ADD COLUMN `twitter` VARCHAR(255) NULL DEFAULT NULL  AFTER `facebook` , ADD COLUMN `blogg` VARCHAR(255) NULL DEFAULT NULL  AFTER `twitter` ;
ALTER TABLE `althingi`.`Commitee` DROP COLUMN `description` , ADD COLUMN `short_abbr` VARCHAR(45) NULL DEFAULT NULL  AFTER `name` , ADD COLUMN `long_abbr` VARCHAR(45) NULL DEFAULT NULL  AFTER `short_abbr` , ADD COLUMN `first_assembly` INT(11) NULL DEFAULT NULL  AFTER `long_abbr` , ADD COLUMN `last_assembly` INT(11) NULL DEFAULT NULL  AFTER `first_assembly` ;
ALTER TABLE `althingi`.`Issue` ADD COLUMN `issue_analysis` VARCHAR(1000) NULL DEFAULT NULL  AFTER `tag` , ADD COLUMN `category` VARCHAR(45) NULL DEFAULT NULL  AFTER `issue_analysis` ;
ALTER TABLE `althingi`.`Issue` ADD COLUMN `status` VARCHAR(1000) NULL DEFAULT NULL  AFTER `category` ;
ALTER TABLE `althingi`.`IssueDocument` DROP COLUMN `body` , ADD COLUMN `document_number` INT NULL  AFTER `date` , ADD COLUMN `type` VARCHAR(255) NULL  AFTER `document_number` , ADD COLUMN `html` VARCHAR(255) NULL  AFTER `type` , ADD COLUMN `pdf` VARCHAR(255) NULL  AFTER `html` , ADD COLUMN `issue_number` INT NULL  AFTER `pdf` , ADD COLUMN `assembly_number` INT NULL  AFTER `issue_number` ;
ALTER TABLE `althingi`.`Vote` ADD COLUMN `time_epoch` INT(11) NULL DEFAULT NULL  AFTER `time` ;
ALTER TABLE `althingi`.`Vote` ADD COLUMN `document_id` INT(11) NULL DEFAULT NULL  AFTER `result` , ADD COLUMN `assembly_id` INT(11) NULL DEFAULT NULL  AFTER `document_id` ;
CREATE  TABLE `althingi`.`ReviewRequest` (
  `id` INT NOT NULL ,
  `review_request_number` INT NULL ,
  `date` DATE NULL ,
  `date_epoch` INT NULL ,
  `reciever` VARCHAR(1000) NULL ,
  `commitee` VARCHAR(255) NULL ,
  `commitee_id` INT NULL ,
  `diary_number` INT NULL ,
  `issue_number` INT NULL ,
  `assembly_number` INT NULL ,
  PRIMARY KEY (`id`) );
ALTER TABLE `althingi`.`ReviewRequest` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;
CREATE  TABLE `althingi`.`Review` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `diary_number` INT NULL ,
  `sender` VARCHAR(1000) NULL ,
  `commitee` VARCHAR(255) NULL ,
  `commitee_id` INT NULL ,
  `arrival_date` DATE NULL ,
  `arrival_date_epoch` INT NULL ,
  `send_date` DATE NULL ,
  `send_date_epoch` INT NULL ,
  `review_type` VARCHAR(255) NULL ,
  `path` VARCHAR(255) NULL ,
  `issue_number` INT NULL ,
  `assembly_number` INT NULL ,
  PRIMARY KEY (`id`) );
