Create TABLE student (
    id int NOT NULL AUTO_INCREMENT primary key,
    name varchar(50) NOT NULL,
    Surname varchar(50) NOT NULL,
    class_id int NOT NULL
);

CREATE TABLE klasa (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL
);
CREATE TABLE Teacher (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    Surname varchar(50) NOT NULL,
    age int(3) NOT NULL
);
CREATE TABLE Subject (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    class_id int NOT NULL
);

CREATE TABLE Person  (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(50) NOT NULL,
    Password varchar(50)  NOT NULL UNIQUE,
    username varchar(50) NOT NULL,
    surname varchar(50) NOT NULL,
    age int(3) NOT NULL
);

ALTER TABLE teacher
ADD FOREIGN KEY (id)REFERENCES subject (id);

ALTER TABLE student
ADD FOREIGN KEY (class_id) REFERENCES klasa(id);

ALTER TABLE Subject
ADD FOREIGN KEY (class_id) REFERENCES klasa (id);