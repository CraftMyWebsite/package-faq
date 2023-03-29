CREATE TABLE if not exists `cmw_faq`(
    `faq_id` INT NOT NULL AUTO_INCREMENT ,
    `faq_question` TEXT NOT NULL ,
    `faq_response` TEXT NOT NULL ,
    `faq_author` VARCHAR(255) NOT NULL ,
PRIMARY KEY (`faq_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
