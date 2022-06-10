CREATE TABLE if not exists `cmw_faq`(
    `faq_id` INT NOT NULL AUTO_INCREMENT ,
    `question` TEXT NOT NULL ,
    `response` TEXT NOT NULL ,
    `author` VARCHAR(255) NOT NULL ,
PRIMARY KEY (`faq_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
