CREATE DATABASE crimedatabase;
USE crimedatabase;
CREATE TABLE police_station
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    address varchar(120)
);
CREATE TABLE police
(
	username varchar(11) PRIMARY KEY,
	name varchar(60),
	pass varchar(32),
    address varchar(120),
    gradelevel  varchar(30),
    pin INT,
    age INT,
    dob date,
    phoneno varchar(10),
    email varchar(60),
    stat_id INT,
   	FOREIGN KEY(stat_id) REFERENCES police_station(id)
);
CREATE TABLE working
(
    user_name varchar(11),
	FOREIGN KEY(user_name) REFERENCES police(username),
    station_id INT,
    FOREIGN KEY(station_id) REFERENCES police_station(id),
    from_when date,
    upto date
);
CREATE TABLE compliant
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    suspect_name varchar(60),
    type_crime varchar(50),
    station_id INT,
    FOREIGN KEY(station_id) REFERENCES police_station(id),
    police_id varchar(11),
    FOREIGN KEY(police_id) REFERENCES police(username),
    place_happened varchar(80),
    date_happened date,
    time_happened time,
    suspect_address varchar(120)
);
CREATE TABLE fir
(
    comp_id INT,
	  FOREIGN KEY(comp_id) REFERENCES compliant(id),
    report varchar(500),
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_fir date,
    time_fir time,
    report_by varchar(60),
    report_address varchar(120),
    id_no varchar(20),
    id_type varchar(20)
);
CREATE TABLE post
(
	doctor varchar(80),
    report varchar(500),
    post_date date,
    hosp_name varchar(90),
    phone_no  varchar(18),
    comp_id INT,
   	FOREIGN KEY(comp_id) REFERENCES compliant(id)
);
CREATE TABLE charge_sheet
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    charges  varchar(150),
    pol_id varchar(11),
    FOREIGN KEY(pol_id) REFERENCES police(username)
);
CREATE TABLE crime_type
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    crime_name varchar(30)
);
CREATE TABLE criminal
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(80),
    age INT,
    dob date,
    ocp varchar(50),
    phone_no varchar(18),
    identifications varchar(160),
    id_no varchar(20),
    id_card varchar(40),
    most_wanted varchar(3),
    address varchar(120)
);
CREATE TABLE witness
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(80),
    age INT,
    dob date,
    ocp varchar(50),
    phone_no varchar(18),
    id_no varchar(20),
    id_card varchar(40),
    address varchar(120)
);
CREATE TABLE criminal_causes
(
    criminal_id INT,
    crime_id INT,
	FOREIGN KEY(criminal_id) REFERENCES criminal(id),
    FOREIGN KEY(crime_id) REFERENCES crime_type(id)
);
CREATE TABLE compliant_criminal
(
    comp_id INT,
    criminal_id INT,
	FOREIGN KEY(criminal_id) REFERENCES criminal(id),
    FOREIGN KEY(comp_id) REFERENCES compliant(id)
);
CREATE TABLE comp_wit
(
    comp_id INT,
    wit_id INT,
	FOREIGN KEY(comp_id) REFERENCES compliant(id),
    FOREIGN KEY(wit_id) REFERENCES witness(id),
    report varchar(500)
);
ALTER TABLE `police` CHANGE `pin` `pin` VARCHAR(4) NULL DEFAULT NULL;
ALTER TABLE `compliant` ADD `status` VARCHAR(50) NOT NULL AFTER `suspect_address`;
