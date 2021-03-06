CREATE TABLE `Groups` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`Name` varchar(30) NOT NULL,
	`ID_Course` INT NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Course` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`Number` INT(30) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Lesson` (
	`ID_Students` INT NOT NULL,
	`ID_Subject` INT NOT NULL,
	`Att1` INT(50) NOT NULL DEFAULT '0',
	`Att2` INT(50) NOT NULL DEFAULT '0',
	`Att3` INT(50) NOT NULL DEFAULT '0',
	`Itog` INT(50) NOT NULL DEFAULT '0',
	PRIMARY KEY (`ID_Students`,`ID_Subject`)
);

CREATE TABLE `Subject` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`Name` varchar(30) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Students` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`Name` varchar(30) NOT NULL,
	`ID_Groups` INT NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Teachers` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`Login` varchar(30) NOT NULL UNIQUE,
	`Password` varchar(32) NOT NULL,
	`Hash` varchar(32),
	PRIMARY KEY (`ID`)
);

ALTER TABLE `Groups` ADD CONSTRAINT `Groups_fk0` FOREIGN KEY (`ID_Course`) REFERENCES `Course`(`ID`);

ALTER TABLE `Lesson` ADD CONSTRAINT `Lesson_fk0` FOREIGN KEY (`ID_Students`) REFERENCES `Students`(`ID`);

ALTER TABLE `Lesson` ADD CONSTRAINT `Lesson_fk1` FOREIGN KEY (`ID_Subject`) REFERENCES `Subject`(`ID`);

ALTER TABLE `Students` ADD CONSTRAINT `Students_fk0` FOREIGN KEY (`ID_Groups`) REFERENCES `Groups`(`ID`);

