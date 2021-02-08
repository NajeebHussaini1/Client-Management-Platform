/*
Najeebulla Hussaini
November 20th, 2020
WEBD3201
*/

DROP TABLE IF EXISTS calls;
CREATE TABLE calls (
	first_name VARCHAR (128),
	last_name VARCHAR (128),
	email_address VARCHAR (255) UNIQUE,
	phone_number VARCHAR (15),
	extension VARCHAR(4),
	logo_path VARCHAR(255),
	call_date TIMESTAMP
);

INSERT INTO calls (first_name, last_name, email_address, phone_number, extension, call_date) VALUES(
'Goku' , 'Kakarot' ,'goku@dcmail.ca', '234-242-225', '6677', '2020-10-29 13:15:11');

INSERT INTO calls (first_name, last_name, email_address, phone_number, extension, call_date) VALUES(
'Vegeta' , 'Trebol' ,'vegeta@dcmail.ca', '888-888-888', '8888', '2020-10-29 14:15:11');

INSERT INTO calls (first_name, last_name, email_address, phone_number, extension, call_date) VALUES(
'Sasuke' , 'Uchiha' ,'sasuke@dcmail.ca', '777-777-777', '5644', '2020-10-29 18:15:11');

SELECT * FROM calls;