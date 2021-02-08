/*
Najeebulla Hussaini
November 20th, 2020
WEBD3201
*/

DROP TABLE IF EXISTS clients;
CREATE TABLE clients (
	first_name VARCHAR (128),
	last_name VARCHAR (128),
	email_address VARCHAR (255) UNIQUE,
	phone_number VARCHAR (15),
	extension VARCHAR (4),
	logo_path VARCHAR (255),
	id INT REFERENCES users (id)
);

INSERT INTO clients (first_name, last_name, email_address, phone_number, extension, id) VALUES(
'Goku' , 'Kakarot' ,'goku@dcmail.ca', '234-242-225', '1444', '1003');

INSERT INTO clients (first_name, last_name, email_address, phone_number, extension, id) VALUES(
'Vegeta' , 'Trebol' ,'vegeta@dcmail.ca', '888-888-888', '4523', '1004');

INSERT INTO clients (first_name, last_name, email_address, phone_number, extension, id) VALUES(
'Sasuke' , 'Uchiha' ,'sasuke@dcmail.ca', '777-777-777', '1543', '1005');

SELECT * FROM clients; 