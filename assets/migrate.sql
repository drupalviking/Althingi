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
CREATE  TABLE `althingi`.`Meeting` (
  `assembly_number` INT NOT NULL ,
  `meeting_number` INT NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `starts` DATETIME NULL ,
  `starts_epoch` INT NULL ,
  `ends` DATETIME NULL ,
  `ends_epoch` INT NULL ,
  `seating` VARCHAR(255) NULL ,
  `document_xml` VARCHAR(255) NULL ,
  PRIMARY KEY (`assembly_number`, `meeting_number`) );
  CREATE  TABLE `althingi`.`Speech` (
  `speech_id` INT NOT NULL ,
  `person_id` INT NULL ,
  `person_type` VARCHAR(255) NULL ,
  `from` DATETIME NULL ,
  `from_epoch` INT NULL ,
  `to` DATETIME NULL ,
  `date_epoch` INT NULL ,
  `speech_type` VARCHAR(255) NULL ,
  `iteration` VARCHAR(45) NULL ,
  `meeting` INT NULL ,
  `speech_xml` VARCHAR(255) NULL ,
  `speech_html` VARCHAR(255) NULL ,
  `party_id` INT NULL ,
  `party` VARCHAR(255) NULL ,
  `foreperson` VARCHAR(1) NULL ,
  PRIMARY KEY (`speech_id`) );
ALTER TABLE `althingi`.`Speech` CHANGE COLUMN `speech_id` `id` INT(11) NOT NULL  , ADD COLUMN `issue_id` INT NULL  AFTER `id` ;
ALTER TABLE `althingi`.`Speech` CHANGE COLUMN `date_epoch` `to_epoch` INT(11) NULL DEFAULT NULL  , ADD COLUMN `speech_length` INT NULL  AFTER `to_epoch` ;
ALTER TABLE `althingi`.`Speech` ADD COLUMN `assembly_number` INT NULL  AFTER `iteration` ;
ALTER TABLE `althingi`.`Speech` CHANGE COLUMN `foreperson` `foreperson` TINYINT NULL DEFAULT NULL  ;
ALTER TABLE `althingi`.`Speech` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;
ALTER TABLE `althingi`.`IssueDocument` DROP FOREIGN KEY `fk_IssueDocument_Issue1` ;
DROP TABLE `althingi`.`IssueSpeech`;
ALTER TABLE `althingi`.`Vote` DROP FOREIGN KEY `fk_Vote_Issue1` , DROP FOREIGN KEY `fk_Vote_Commitee1` ;
ALTER TABLE `althingi`.`Assembly_has_Person` DROP FOREIGN KEY `fk_Assembly_has_Person_Person1` , DROP FOREIGN KEY `fk_Assembly_has_Person_Party1` , DROP FOREIGN KEY `fk_Assembly_has_Person_Assembly1` ;
ALTER TABLE `althingi`.`Commitee_has_Person` DROP FOREIGN KEY `fk_Commitee_has_Person_Person1` , DROP FOREIGN KEY `fk_Commitee_has_Person_Party1` , DROP FOREIGN KEY `fk_Commitee_has_Person_Commitee1` , DROP FOREIGN KEY `fk_Commitee_has_Person_Assembly1` ;
ALTER TABLE `althingi`.`Issue` DROP FOREIGN KEY `fk_Issue_Assembly1` ;
