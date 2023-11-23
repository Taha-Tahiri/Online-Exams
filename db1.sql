CREATE DATABASE online_exams;

USE online_exams;

CREATE TABLE users(
	user_id INT PRIMARY KEY AUTO_INCREMENT, 
	first_name VARCHAR(55),
	last_name VARCHAR(55),
	password_ VARCHAR(55),
	email VARCHAR(55) UNIQUE,
	class VARCHAR(55), 
	school VARCHAR(55),
	type_ VARCHAR(55)
);

CREATE TABLE school (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name_ VARCHAR(50) NOT NULL
);

CREATE TABLE class (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name_ VARCHAR(50) NOT NULL ,
  school_id INT,
  FOREIGN KEY (school_id) REFERENCES school(id)
);

CREATE TABLE exams (
	id INT PRIMARY KEY AUTO_INCREMENT,
	exam_id INT,
	user_id INT,
	school_n VARCHAR(50),
	name_ VARCHAR(50),
	start_d DATETIME,
	finish_d DATETIME, 
	duration INT NOT NULL, 
	class_n VARCHAR(50) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE questions (
	id INT PRIMARY KEY AUTO_INCREMENT,
	exam_id INT NOT NULL,
	qn INT,
	question TEXT,
	choices JSON,
	points INT
);


CREATE TABLE grades (
	id INT PRIMARY KEY AUTO_INCREMENT,
	exam_id INT NOT NULL,
	user_id INT NOT NULL, 
	note FLOAT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(user_id) 

);


DELIMITER //

CREATE TRIGGER readonly BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
  IF NEW.type_ <> OLD.type_ THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The column type_ is read-only.';
  END IF;
END //

DELIMITER ;

INSERT INTO school (id, name_)
VALUES (1, 'ISTA Ifrane'),
       (2, 'ISTA Meknes'),
       (3, 'ISTA Fes');
       
INSERT INTO class (id, name_, school_id)
VALUES (1, 'DD_101', 1),
       (2, 'ID_101', 1),
       (3, 'GE_101', 1),
       (4, 'TT_101', 2),
       (5, 'FS_101', 2),
       (6, 'MK_101', 2),
       (7, 'TR_101', 3),
       (8, 'BC_101', 3),
       (9, 'RE_101', 3); 
       
       
   
INSERT INTO exams (user_id, school_n, name_, start_d, finish_d, duration)
VALUES
(4, 'ISTA Ifrane', 'Exam 1', '2023-06-11 10:00:00', '2023-06-11 11:30:00', 90),
(5, 'ISTA Meknas', 'Exam 2', '2023-06-12 14:00:00', '2023-06-12 16:00:00', 120),
(4, 'ISTA Ifrane', 'Exam 3', '2023-06-13 09:30:00', '2023-06-13 11:00:00', 90),
(5, 'ISTA Meknas', 'Exam 4', '2023-06-14 11:00:00', '2023-06-14 12:30:00', 90),
(5, 'ISTA Fes', 'Exam 5', '2023-06-15 13:30:00', '2023-06-15 15:00:00', 90),
(4, 'ISTA Ifrane', 'Exam 6', '2023-06-16 16:00:00', '2023-06-16 17:30:00', 90),
(5, 'ISTA Meknas', 'Exam 7', '2023-06-17 09:00:00', '2023-06-17 10:30:00', 90),
(4, 'ISTA Ifrane', 'Exam 8', '2023-06-18 14:00:00', '2023-06-18 15:30:00', 90),
(5, 'ISTA Meknas', 'Exam 9', '2023-06-19 10:30:00', '2023-06-19 12:00:00', 90),
(4, 'ISTA Fes', 'Exam 10', '2023-06-20 11:30:00', '2023-06-20 13:00:00', 90);


select * from class where school_id=2 ;
DROP TABLE users;
DROP TABLE school;
DROP TABLE class; 
drop TABLE questions;
DROP TABLE exams;


SELECT DATE_FORMAT(datetime_column, '%Y-%m-%d %H:%i') AS date_hour_minutes FROM your_table_name;