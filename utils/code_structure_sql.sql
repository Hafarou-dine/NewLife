-- Code de structure sql de la base de données
-- Création de la base et encodage du type de données acceptées dans la base de données
CREATE DATABASE newlife CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE newlife;

-- Création des tables
CREATE TABLE droit(
	id_droit INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom_droit VARCHAR(50) NOT NULL UNIQUE
)ENGINE=InnoDB;

CREATE TABLE categorie(
	id_cat INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom_cat VARCHAR(50) NOT NULL UNIQUE
)ENGINE=InnoDB;

CREATE TABLE departement(
	id_dep INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    numero_dep CHAR(4) NOT NULL UNIQUE,
    nom_dep VARCHAR(50) NOT NULL UNIQUE
)ENGINE=InnoDB;

CREATE TABLE utilisateur(
	id_util INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom_util VARCHAR(50) NOT NULL,
    mail_util VARCHAR(255) NOT NULL UNIQUE,
    mdp_util VARCHAR(255) NOT NULL,
    token_util VARCHAR(255) NOT NULL UNIQUE,
    valide_util BOOLEAN NOT NULL DEFAULT FALSE,
    active_util BOOLEAN NOT NULL DEFAULT TRUE,
    id_droit INT DEFAULT 2
)ENGINE=InnoDB;

CREATE TABLE annonce(
	id_ann INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titre_ann VARCHAR(100) NOT NULL,
    descr_ann TEXT NOT NULL,
    prix_ann FLOAT NOT NULL,
    date_ann DATETIME NOT NULL,
    negociable BOOLEAN NOT NULL,
    livraison BOOLEAN NOT NULL,
    vendu BOOLEAN NOT NULL DEFAULT FALSE,
    visible_ann BOOLEAN NOT NULL DEFAULT TRUE,
    id_util INT,
    id_cat INT,
    id_dep INT
)ENGINE=InnoDB;

CREATE TABLE image(
	id_img INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom_img VARCHAR(100) NOT NULL UNIQUE,
    url_img VARCHAR(255) NOT NULL UNIQUE,
    id_ann INT
)ENGINE=InnoDB;

CREATE TABLE message(
	id_msg INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    contenu_msg TEXT NOT NULL,
    date_msg DATETIME NOT NULL,
    id_msg_origine INT,
    id_emetteur INT,
    id_recepteur INT,
    id_ann INT
)ENGINE=InnoDB;

CREATE TABLE recherche(
	id_rech INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titre_rech VARCHAR(100) NOT NULL,
    date_rech DATETIME NOT NULL,
    id_util INT
)ENGINE=InnoDB;

CREATE TABLE enregistrer(
	id_util INT,
    id_ann INT,
    PRIMARY KEY (id_util, id_ann)
)ENGINE=InnoDB;

CREATE TABLE resulter(
	id_rech INT,
    id_ann INT,
    PRIMARY KEY (id_rech, id_ann)
)ENGINE=InnoDB;


-- Création des contraintes de clés étrangère
-- Table utilisateur : id_droit
ALTER TABLE utilisateur
ADD CONSTRAINT fk_posseder_droit
FOREIGN KEY (id_droit)
REFERENCES droit(id_droit);
 
-- Table annonce : id_util
ALTER TABLE annonce
ADD CONSTRAINT fk_deposer_utilisateur
FOREIGN KEY (id_util)
REFERENCES utilisateur(id_util);
 
-- Table annonce : id_cat
ALTER TABLE annonce
ADD CONSTRAINT fk_appartenir_categorie
FOREIGN KEY (id_cat)
REFERENCES categorie(id_cat);
 
-- Table annonce : id_dep
ALTER TABLE annonce
ADD CONSTRAINT fk_localiser_departement
FOREIGN KEY (id_dep)
REFERENCES departement(id_dep);
 
-- Table image : id_ann
ALTER TABLE image
ADD CONSTRAINT fk_illustrer_annonce
FOREIGN KEY (id_ann)
REFERENCES annonce(id_ann);
 
-- Table message : id_msg_origine
ALTER TABLE message
ADD CONSTRAINT fk_repondre_message
FOREIGN KEY (id_msg_origine)
REFERENCES message(id_msg);

-- Table message : id_emetteur
ALTER TABLE message
ADD CONSTRAINT fk_envoyer_utilisateur
FOREIGN KEY (id_emetteur) 
REFERENCES utilisateur(id_util);

-- Table message : id_recepteur
ALTER TABLE message
ADD CONSTRAINT fk_recevoir_utilisateur
FOREIGN KEY (id_recepteur) 
REFERENCES utilisateur(id_util);

-- Table message : id_ann
ALTER TABLE message 
ADD CONSTRAINT fk_concerner_annonce
FOREIGN KEY (id_ann) 
REFERENCES annonce(id_ann);

-- Table recherche : id_util
ALTER TABLE recherche
ADD CONSTRAINT fk_sauvegarder_utilisateur
FOREIGN KEY (id_util) 
REFERENCES utilisateur(id_util);

-- Table enregistrer : id_util
ALTER TABLE enregistrer
ADD CONSTRAINT fk_enregistrer_utilisateur
FOREIGN KEY (id_util)
REFERENCES utilisateur(id_util);

-- Table enregistrer : id_ann
ALTER TABLE enregistrer
ADD CONSTRAINT fk_enregistrer_annonce
FOREIGN KEY (id_ann)
REFERENCES annonce(id_ann);

-- Table resulter : id_rech
ALTER TABLE resulter
ADD CONSTRAINT fk_resulter_recherche
FOREIGN KEY (id_rech)
REFERENCES recherche(id_rech);

-- Table resulter : id_ann
ALTER TABLE resulter
ADD CONSTRAINT fk_resulter_annonce
FOREIGN KEY (id_ann)
REFERENCES annonce(id_ann);


-- Insertion des enregistrements de base
-- Insertion des droits
INSERT INTO droit(nom_droit) VALUES ("Administrateur"),("Utilisateur");

-- Insertion des categories
INSERT INTO categorie(nom_cat) VALUES
("Vêtements"),
("Chaussures"),
("Accessoires & Bagagerie"),
("Montres & Bijoux"),
("Équipement bébé"),
("Vêtements bébé"),
("Luxe et Tendance"),
("Ameublement"),
("Électroménager"),
("Arts de la table"),
("Décoration"),
("Linge de maison"),
("Bricolage"),
("Jardinage"),
("Voitures"),
("Motos"),
("DVD - Films"),
("CD - Musique"),
("Livres"),
("Vélos"),
("Sports & Hobbies"),
("Instruments de musique"),
("Collection"),
("Jeux & Jouets"),
("Vins & Gastronomie"),
("Informatique"),
("Consoles & Jeux vidéo"),
("Image & Son"),
("Téléphonie"),
("Autres");

-- Insertion des departements
INSERT INTO departement(numero_dep, nom_dep) VALUES
("01", "Ain"),
("02", "Aisne"),
("03", "Allier"),
("04", "Alpes-de-Haute-Provence"),
("05", "Hautes-Alpes"),
("06", "Alpes-Maritimes"),
("07", "Ardèche"),
("08", "Ardennes"),
("09", "Ariège"),
("10", "Aube"),
("11", "Aude"),
("12", "Aveyron"),
("13", "Bouches-du-Rhône"),
("14", "Calvados"),
("15", "Cantal"),
("16", "Charente"),
("17", "Charente-Maritime"),
("18", "Cher"),
("19", "Corrèze"),
("21", "Côte-d'Or"),
("22", "Côtes-d'Armor"),
("23", "Creuse"),
("24", "Dordogne"),
("25", "Doubs"),
("26", "Drôme"),
("27", "Eure"),
("28", "Eure-et-Loir"),
("29", "Finistère"),
("2A", "Corse-du-Sud"),
("2B", "Haute-Corse"),
("30", "Gard"),
("31", "Haute-Garonne"),
("32", "Gers"),
("33", "Gironde"),
("34", "Hérault"),
("35", "Ille-et-Vilaine"),
("36", "Indre"),
("37", "Indre-et-Loire"),
("38", "Isère"),
("39", "Jura"),
("40", "Landes"),
("41", "Loir-et-Cher"),
("42", "Loire"),
("43", "Haute-Loire"),
("44", "Loire-Atlantique"),
("45", "Loiret"),
("46", "Lot"),
("47", "Lot-et-Garonne"),
("48", "Lozère"),
("49", "Maine-et-Loire"),
("50", "Manche"),
("51", "Marne"),
("52", "Haute-Marne"),
("53", "Mayenne"),
("54", "Meurthe-et-Moselle"),
("55", "Meuse"),
("56", "Morbihan"),
("57", "Moselle"),
("58", "Nièvre"),
("59", "Nord"),
("60", "Oise"),
("61", "Orne"),
("62", "Pas-de-Calais"),
("63", "Puy-de-Dôme"),
("64", "Pyrénées-Atlantiques"),
("65", "Hautes-Pyrénées"),
("66", "Pyrénées-Orientales"),
("67", "Bas-Rhin"),
("68", "Haut-Rhin"),
("69", "Rhône"),
("70", "Haute-Saône"),
("71", "Saône-et-Loire"),
("72", "Sarthe"),
("73", "Savoie"),
("74", "Haute-Savoie"),
("75", "Paris"),
("76", "Seine-Maritime"),
("77", "Seine-et-Marne"),
("78", "Yvelines"),
("79", "Deux-Sèvres"),
("80", "Somme"),
("81", "Tarn"),
("82", "Tarn-et-Garonne"),
("83", "Var"),
("84", "Vaucluse"),
("85", "Vendée"),
("86", "Vienne"),
("87", "Haute-Vienne"),
("88", "Vosges"),
("89", "Yonne"),
("90", "Territoire de Belfort"),
("91", "Essonne"),
("92", "Hauts-de-Seine"),
("93", "Seine-Saint-Denis"),
("94", "Val-de-Marne"),
("95", "Val-d'Oise"),
("971", "Guadeloupe"),
("972", "Martinique"),
("973", "Guyane"),
("974", "La Réunion"),
("976", "Mayotte");

-- Insertion d'un utilisateur Administrateur 
-- mdp : Oh25102000!
INSERT INTO utilisateur(nom_util, mail_util, mdp_util, token_util, valide_util, id_droit) VALUE
("Hafarou-dine", "hafarou22@outlook.com", "$2y$10$mhTdzcNPU4Oqa/13PTCs/eumQhvo9rGJU0EFw8MYVt0s7qUT/XX6y", "4fca2cd987bc3baf85f5f4001025449e55ca753d", 1, 1);



-- Création de compte
-- Compte Utilisateur : SELECT, INSERT, UPDATE 
-- Création du compte
CREATE USER 'hafarou'@'%' IDENTIFIED BY 'oh251020';
-- Attribution des droits au compte
GRANT SELECT, INSERT, UPDATE ON newlife.* TO 'hafarou'@'%';

-- Compte Administrateur : SELECT, INSERT, UPDATE, DELETE
-- Création du compte
CREATE USER 'admin'@'%' IDENTIFIED BY 'oh251020';
-- Attribution des droits au compte
GRANT SELECT, INSERT, UPDATE, DELETE ON newlife.* TO 'admin'@'%';

-- Refresh des droits pour que les 
FLUSH PRIVILEGES;


-- use blog;
-- drop database newlife;
