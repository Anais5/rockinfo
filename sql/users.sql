CREATE TABLE users ( -- représente les infos d'un utilisateur
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    age TINYINT unsigned NOT NULL,
    sexe ENUM('H', 'F') NOT NULL,
    pays VARCHAR(43) NOT NULL,
    email VARCHAR(50) PRIMARY KEY NOT NULL,
    newsletter BOOLEAN NOT NULL,
    motDePasse CHAR(97) NOT NULL,
    date_inscription DATETIME NOT NULL,
    type_de_compte ENUM('Administrator', 'Redactor', 'Musician', 'User') NOT NULL
);

CREATE TABLE articles (
    titre VARCHAR(50) PRIMARY KEY NOT NULL,
    email VARCHAR(50) NOT NULL,
    date_parution DATETIME NOT NULL
);
