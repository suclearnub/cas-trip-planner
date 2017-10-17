CREATE TABLE `users` (
	`userNo` INT NOT NULL AUTO_INCREMENT,
	`firstName` varchar(100) NOT NULL,
	`middleName` varchar(100),
	`lastName` varchar(100) NOT NULL,
	`gender` varchar(1) NOT NULL,
	`email` varchar(100) NOT NULL,
	`password` varchar(100) NOT NULL,
	PRIMARY KEY (`userNo`)
);

CREATE TABLE `permissions` (
	`permissionNo` INT NOT NULL AUTO_INCREMENT,
	`description` varchar(100) NOT NULL,
	PRIMARY KEY (`permissionNo`)
);

CREATE TABLE `userPermissions` (
	`userNo` INT NOT NULL,
	`permissionNo` INT NOT NULL
);

CREATE TABLE `trips` (
	`tripNo` INT NOT NULL AUTO_INCREMENT,
	`description` varchar(1000) NOT NULL,
	`startDate` DATETIME NOT NULL,
	`endDate` DATETIME NOT NULL,
	`confirmed` BOOLEAN NOT NULL,
	PRIMARY KEY (`tripNo`)
);

CREATE TABLE `tripParticipants` (
	`userNo` INT NOT NULL,
	`tripNo` INT NOT NULL,
	`confirmed` BOOLEAN NOT NULL DEFAULT '0',
	`passportOK` BOOLEAN NOT NULL DEFAULT '0',
	`visaOK` BOOLEAN NOT NULL DEFAULT '0',
	`paid` BOOLEAN NOT NULL DEFAULT '0'
);

CREATE TABLE `tripActivities` (
	`tripActivityNo` INT NOT NULL AUTO_INCREMENT,
	`tripNo` INT NOT NULL DEFAULT '0',
	`description` varchar(1000) NOT NULL,
	`cost` INT NOT NULL,
	`confirmed` BOOLEAN NOT NULL DEFAULT '0',
	`startDate` DATETIME NOT NULL,
	`endDate` DATETIME NOT NULL,
	PRIMARY KEY (`tripActivityNo`)
);

CREATE TABLE `tripActivityComments` (
	`tripActivityNo` INT NOT NULL,
	`userNo` INT NOT NULL,
	`postDate` DATETIME NOT NULL,
	`message` varchar(1000) NOT NULL
);

CREATE TABLE `tripComments` (
	`tripNo` INT NOT NULL,
	`userNo` INT NOT NULL,
	`postDate` DATETIME NOT NULL,
	`message` varchar(1000) NOT NULL
);

CREATE TABLE `menuItems` (
	`menuItemNo` INT NOT NULL AUTO_INCREMENT,
	`text` varchar(100) NOT NULL,
	`desc` varchar(100) NOT NULL,
	`target` varchar(100) NOT NULL,
	`parent` INT NOT NULL,
	PRIMARY KEY (`menuItemNo`)
);

ALTER TABLE `userPermissions` ADD CONSTRAINT `userPermissions_fk0` FOREIGN KEY (`userNo`) REFERENCES `users`(`userNo`);

ALTER TABLE `userPermissions` ADD CONSTRAINT `userPermissions_fk1` FOREIGN KEY (`permissionNo`) REFERENCES `permissions`(`permissionNo`);

ALTER TABLE `tripParticipants` ADD CONSTRAINT `tripParticipants_fk0` FOREIGN KEY (`userNo`) REFERENCES `users`(`userNo`);

ALTER TABLE `tripParticipants` ADD CONSTRAINT `tripParticipants_fk1` FOREIGN KEY (`tripNo`) REFERENCES `trips`(`tripNo`);

ALTER TABLE `tripActivities` ADD CONSTRAINT `tripActivities_fk0` FOREIGN KEY (`tripNo`) REFERENCES `trips`(`tripNo`);

ALTER TABLE `tripActivityComments` ADD CONSTRAINT `tripActivityComments_fk0` FOREIGN KEY (`tripActivityNo`) REFERENCES `tripActivities`(`tripActivityNo`);

ALTER TABLE `tripActivityComments` ADD CONSTRAINT `tripActivityComments_fk1` FOREIGN KEY (`userNo`) REFERENCES `users`(`userNo`);

ALTER TABLE `tripComments` ADD CONSTRAINT `tripComments_fk0` FOREIGN KEY (`tripNo`) REFERENCES `trips`(`tripNo`);

ALTER TABLE `tripComments` ADD CONSTRAINT `tripComments_fk1` FOREIGN KEY (`userNo`) REFERENCES `users`(`userNo`);
