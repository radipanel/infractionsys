ALTER TABLE `users` ADD `totalInfractions` INT( 1 ) NOT NULL DEFAULT '0', ADD `totalWarnings` INT( 1 ) NOT NULL DEFAULT '0', ADD `banned` INT( 1 ) NOT NULL DEFAULT '0';

INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'Add infraction', 'infraction.add', '_res/infraction/add.php', '5', '0', '0');
INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'Remove infraction', 'infraction.remove', '_res/infraction/remove.php', '5', '0', '0');
INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'View infraction log', 'infraction.viewLog', '_res/infraction/view.php', '5', '0', '0');
INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'Clear infraction log', 'infraction.clearLog', '_res/infraction/clear_log.php', '5', '0', '0');
INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'View my infraction log', 'user.viewMyLog', '_res/infraction/view_mine.php', '1', '0', '0');

CREATE TABLE `infraction_log` (
`id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`username` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ,
`reason` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
`type` VARCHAR( 100 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
`addrem` VARCHAR( 3 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
`issuedby` VARCHAR( 100 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
`timestamp` TIMESTAMP( 255 ) ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = MYISAM ;
