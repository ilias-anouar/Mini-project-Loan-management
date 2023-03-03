CREATE TABLE
    `members` (
        `id_member` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(50) NOT NULL,
        `address` VARCHAR(200) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` INT(11) NOT NULL,
        `C_I_N` VARCHAR(50) NOT NULL,
        `date_of_birth` DATE NOT NULL,
        `type` VARCHAR(50) NOT NULL,
        `nickname` VARCHAR(50) NOT NULL,
        `password` VARCHAR(50) NOT NULL,
        `opening_date` DATE NOT NULL,
        `penalty` INT(11) NOT NULL,
        `Role` TINYINT(1) NOT NULL
    );

CREATE TABLE
    `books` (
        `Id_book` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(50) NOT NULL,
        `author` VARCHAR(50) NOT NULL,
        `image` VARCHAR(50) NOT NULL,
        `state` VARCHAR(50) NOT NULL,
        `publishing_date` DATE NOT NULL,
        `date_of_purchase` DATE NOT NULL,
        `pages` INT(11) NOT NULL,
        `type` VARCHAR(50) NOT NULL
    );

CREATE TABLE
    `reservation` (
        `Id_reservation` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `reservation_date` DATETIME NOT NULL,
        `id_member` INT(11) NOT NULL,
        `Id_book` INT(11) NOT NULL,
        FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`),
        FOREIGN KEY (`Id_book`) REFERENCES `books` (`Id_book`)
    );

CREATE TABLE
    `loan` (
        `Id_loan` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `loan_date` DATE NOT NULL,
        `return_date` DATE,
        `Id_reservation` INT(11) NOT NULL UNIQUE,
        `Id_book` INT(11) NOT NULL,
        `id_member` INT(11) NOT NULL,
        FOREIGN KEY (`Id_reservation`) REFERENCES `reservation` (`Id_reservation`),
        FOREIGN KEY (`Id_book`) REFERENCES `books` (`Id_book`),
        FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`)
    );