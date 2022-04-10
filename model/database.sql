CREATE DATABASE hypnos;

USE hypnos;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    role CHAR(3),
    password CHAR(255) NOT NULL,
    UNIQUE (EMAIL)
);

CREATE TABLE hotels (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    zipcode VARCHAR(50) NOT NULL,
    street CHAR(50) NOT NULL,
    streetnumber VARCHAR(5),
    description TEXT(255) NOT NULL,
    manager INT(11) NOT NULL,
    FOREIGN KEY (manager) REFERENCES users(id)
);

CREATE TABLE suites (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    featured VARCHAR(50) NOT NULL,
    description TEXT(255) NOT NULL,
    price FLOAT NOT NULL,
    linkbooking VARCHAR(50) NOT NULL,
    hotel INT(11) NOT NULL,
    FOREIGN KEY (hotel) REFERENCES hotels(id)
);

CREATE TABLE galleries (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(50) NOT NULL,
    suite INT(11) NOT NULL,
    FOREIGN KEY (suite) REFERENCES suites(id)
);

-- Table associative
CREATE TABLE bookings (
    user_id INT(11) NOT NULL,
    suite_id INT(11) NOT NULL,
    begin DATE NOT NULL,
    end DATE NOT NULL,
    bill FLOAT NOT NULL,
    PRIMARY KEY (begin, user_id, suite_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (suite_id) REFERENCES suites(id)
);