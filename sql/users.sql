CREATE EXTENSION IF NOT EXISTS pgcrypto;
/*
Najeebulla Hussaini
November 20th, 2020
WEBD3201
*/
DROP SEQUENCE IF EXISTS users_id_seq CASCADE;
CREATE SEQUENCE users_id_seq START 1000;

DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
	id INT PRIMARY KEY DEFAULT nextval ('users_id_seq'),
	email_address VARCHAR (255) UNIQUE,
	password VARCHAR (255) NOT NULL,
	first_name VARCHAR (128),
	last_name VARCHAR (128),
	last_access TIMESTAMP,
	enrol_date TIMESTAMP,
	phone_number VARCHAR(20),
	extension VARCHAR(4),
	logo_path VARCHAR(255),
	user_type VARCHAR(2)

);
INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, extension, user_type) VALUES(
'luffy@dcmail.ca', crypt('monkey',gen_salt('bf')), 'Monkey D' , 'Luffy' , '2020-09-18 13:02:25' , '2020-09-29 13:11:11' , '999-999-999' , '2343', 's');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, extension, user_type) VALUES(
'ichigo@dcmail.ca', crypt('kurosaki',gen_salt('bf')), 'Ichigo' , 'Kurosaki' , '2020-09-18 12:22:25' , '2020-09-29 15:11:11' , '555-555-555' , '4567', 's');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, extension, user_type) VALUES(
'naruto@dcmail.ca', crypt('uzumaki',gen_salt('bf')), 'Naruto' , 'Uzumaki' , '2020-09-18 11:12:25' , '2020-09-29 18:18:11' , '333-333-333' , '7895', 's');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, extension, user_type) VALUES(
'kyle@dcmail.ca', crypt('agent',gen_salt('bf')), 'Kyle' , 'Chapman' , '2020-10-18 12:12:25' , '2020-10-29 18:15:11' , '444-444-444' , '4569', 'a');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, extension, user_type) VALUES(
'steve@dcmail.ca', crypt('agent',gen_salt('bf')), 'Steve' , 'Forbes' , '2020-12-18 10:12:25' , '2020-12-29 18:13:11' , '111-111-111' , '6592', 'a');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, phone_number, extension, user_type) VALUES(
'bob@dcmail.ca', crypt('agent',gen_salt('bf')), 'Bob' , 'Marley' , '2020-08-18 10:12:25' , '2020-08-29 18:12:11' , '222-222-222' , '7909', 'a');


SELECT * FROM users;
