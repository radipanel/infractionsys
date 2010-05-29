ALTER TABLE `users` ADD `totalInfractions` INT( 1 ) NOT NULL DEFAULT '0', ADD `totalWarnings` INT( 1 ) NOT NULL DEFAULT '0'

CREATE TABLE `infraction_log` (
`id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`username` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ,
`reason` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE = MYISAM ;
