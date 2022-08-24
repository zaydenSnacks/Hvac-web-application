DROP DATABASE IF EXISTS HVAC;
CREATE DATABASE HVAC;
USE HVAC;

CREATE TABLE Users(
	user_id		INT 	PRIMARY KEY		AUTO_INCREMENT,
    user_firstname	VARCHAR(255)	NOT NULL,
    user_lastname	VARCHAR(255)	NOT NULL,
    user_email		VARCHAR(255)	NOT NULL,
    user_phone			INT 	NOT NULL,
    user_address	VARCHAR(255)	NOT NULL,
    user_zipCode		INT 	NOT NULL,
    problem		VARCHAR(255)
);

CREATE TABLE Employee (
	employee_id		INT 	PRIMARY KEY		AUTO_INCREMENT,
    employee_firstname	VARCHAR(255)	NOT NULL,
    employee_lastname	VARCHAR(255)	NOT NULL,
    employee_email		VARCHAR(255)	NOT NULL,
    employee_phone		INT 	NOT NULL,
);


CREATE TABLE Accounts (
	account_id	INT 	PRIMARY KEY 	AUTO_INCREMENT,
    user_id		INT 	NOT NULL,
    account_balance	INT 	NOT NULL,
);

CREATE TABLE Appointment (
	appointment_id 	INT 	PRIMARY KEY 	AUTO_INCREMENT,
    user_id		INT		NOT NULL,
	employee_id		INT 	NOT NULL,
    appointment_type	VARCHAR(255)	NOT NULL,
    appointment_date	DATETIME	NOT NULL,
    appointment_time	VARCHAR(100)	NOT NULL,
	appointment_notes	VARCHAR(255),
		FOREIGN KEY (user_id)
        REFERENCES Users(user_id),
        FOREIGN KEY (employee_id)
        REFERENCES Employee(employee_id)
);

CREATE TABLE Hvac (
	hvac_id		INT 	PRIMARY KEY 	AUTO_INCREMENT,
    serial_number 	INT 	NOT NULL,
    model 	VARCHAR(255) 	NOT NULL,
    hvac_type 	VARCHAR(255) 	NOT NULL,
stock INT
);
















