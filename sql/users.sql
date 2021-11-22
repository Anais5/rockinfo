CREATE TABLE users ( -- représente les infos d'un utilisateur
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    age TINYINT unsigned NOT NULL,
    sexe ENUM('H', 'F') NOT NULL,
    pays VARCHAR(43) NOT NULL,
    email VARCHAR(50) NOT NULL,
    motDePasse CHAR(97) NOT NULL,
    date_inscription DATETIME NOT NULL,
    type_de_compte ENUM('Administrator', 'Redactor', 'Musician', 'User') NOT NULL
);
