CREATE DATABASE garage12;

USE garage12;

CREATE TABLE car  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    horsePower INT NOT NULL,
    image VARCHAR(255) NOT NULL
);

INSERT INTO car (model, brand, horsePower, image)
VALUES ('Model S', 'Tesla', 670, 'modelS.jpg');
INSERT INTO car (model, brand, horsePower, image)
VALUES ('Civic', 'Honda', 158, 'civic.jpg');
INSERT INTO car (model, brand, horsePower, image)
VALUES ('Golf', 'Volkswagen', 150, 'golf.jpg');
INSERT INTO car (model, brand, horsePower, image)
VALUES ('Mustang', 'Ford', 450, 'mustang.jpg');
INSERT INTO car (model, brand, horsePower, image)
VALUES ('911 Carrera', 'Porsche', 379, 'carrera.jpg');

CREATE TABLE User ( id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL);