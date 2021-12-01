CREATE TABLE utilisateurs
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login VARCHAR(255),
    prenom VARCHAR(255),
    nom VARCHAR(255),
    password VARCHAR(255),
)