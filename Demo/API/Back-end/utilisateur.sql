CREATE DATABASE utilisateur;

USE utilisateur;

CREATE TABLE utilisateurs(
id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    mdp VARCHAR(150) NOT NULL,
    dob DATE
);

INSERT INTO utilisateurs (nom, prenom, pseudo, email, mdp, dob)  VALUES ("Depriester","Yoann","Kellyan","yoyo@gmail.com","$2y$10$XgGiLuASkoMuj7sh1qQc2.floXGeR0YxKVcRfxf3tJ.ru3cmcAHB6","1984-02-12"),
("Miura","Kentaro","Guts","griffith@gmail.com","$2y$10$XgGiLuASkoMuj7sh1qQc2.floXGeR0YxKVcRfxf3tJ.ru3cmcAHB6","1966-07-11"),
("Tsutomu","Nihei","Killy","blame@gmail.com","$2y$10$XgGiLuASkoMuj7sh1qQc2.floXGeR0YxKVcRfxf3tJ.ru3cmcAHB6","1971-02-26");
