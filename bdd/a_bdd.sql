CREATE USER abddu WITH PASSWORD 'prom';
CREATE DATABASE abdd;
GRANT ALL PRIVILEGES ON DATABASE abdd TO abddu;

psql -U abddu -d abdd
create sequence  seqDevis increment by 1;
create sequence  seqPaye increment by 1;

CREATE TABLE client (
    id_client SERIAL PRIMARY KEY,
    contact VARCHAR(12) UNIQUE NOT NULL
);

CREATE TABLE admin (
    id_admin SERIAL PRIMARY KEY,
    email VARCHAR(70),
    mot_passe VARCHAR(70)
);

CREATE TABLE maison (
    id_maison SERIAL PRIMARY KEY,
    type_maison VARCHAR(5),
    caracteristIque TEXT,
    duree INT,
    surface DOUBLE PRECISION -- MODIF
);

CREATE TABLE finition (
    id_finition SERIAL PRIMARY KEY,
    type_finition VARCHAR(50) DEFAULT 'standard',
    pourcentage DOUBLE PRECISION
);

CREATE TABLE sous_travaux (
    id_sous_travaux SERIAL PRIMARY KEY,
    num_sous_travaux VARCHAR(10),
    sous_travaux TEXT,
    unite VARCHAR(10),
    prix_unit DOUBLE PRECISION
);

CREATE TABLE devis (
    id_devis SERIAL PRIMARY KEY,
    id_sous_travaux INT REFERENCES sous_travaux(id_sous_travaux),
    id_maison INT REFERENCES maison(id_maison),
    quantite DOUBLE PRECISION
);

CREATE TABLE devis_client (
    id_devis_client SERIAL PRIMARY KEY,
    ref_devis VARCHAR(30) default(concat('D',nextval('seqDevis'))),  --MODIF
    lieu VARCHAR(100),
    id_client INT REFERENCES client(id_client),
    id_maison INT REFERENCES maison(id_maison),
    id_finition INT REFERENCES finition(id_finition),
    date_creation DATE DEFAULT current_date,
    date_debut DATE,
    date_fin DATE,
    etat INT DEFAULT 1,
    pourcentage DOUBLE PRECISION
);

CREATE TABLE travaux_client (
    id_travaux_client SERIAL PRIMARY KEY,
    id_devis_client INT REFERENCES devis_client(id_devis_client),
    id_sous_travaux INT REFERENCES sous_travaux(id_sous_travaux),
    prix_unit DOUBLE PRECISION,
    quantite DOUBLE PRECISION
);

CREATE TABLE devis_admin (
    id_devis_admin SERIAL PRIMARY KEY,
    id_devis_client INT REFERENCES devis_client(id_devis_client),
    id_admin INT REFERENCES admin(id_admin)
);

CREATE TABLE paiement (
    id_paiement SERIAL PRIMARY KEY,
    ref_paiement VARCHAR(30)  default(concat('P',nextval('seqPaye'))),
    id_devis_client INT REFERENCES devis_client(id_devis_client),
    montant DOUBLE PRECISION,
    date_paiement DATE
); 

CREATE TABLE temp1 (
    type_maison TEXT,
    description TEXT,
    surface DOUBLE PRECISION,
    code_travaux VARCHAR(20),
    type_travaux TEXT,
    unite VARCHAR(20),
    prix_unitaire DOUBLE PRECISION,
    quantite DOUBLE PRECISION,
    duree_travaux INT
);

CREATE TABLE temp2(
    client VARCHAR(20),
    ref_devis VARCHAR(20),
    type_maison TEXT,
    finition VARCHAR(30),
    taux_finition DOUBLE PRECISION,
    date_devis DATE,
    date_debut DATE,
    lieu VARCHAR(100)
);

CREATE TABLE temp3(
    ref_devis VARCHAR(20),
    ref_paiement VARCHAR(20),
    date_paiement DATE,
    montant DOUBLE PRECISION
);
--INSERT

INSERT INTO client (contact) VALUES ('0340784909');
INSERT INTO client (contact) VALUES ('0340584909');
INSERT INTO client (contact) VALUES ('0321084909');


INSERT INTO admin (email, mot_passe) VALUES ('admin1@example.com', '123');
INSERT INTO admin (email, mot_passe) VALUES ('admin2@example.com', '456');
INSERT INTO admin (email, mot_passe) VALUES ('admin3@example.com', '789');


INSERT INTO maison (type_maison, caracteristique, duree,surface) VALUES 
('T1', 'Les maisons de Type T1 sont assez rares mais il est nécessaire de préciser que celle-ci est composée dune seule pièce*, hors cuisine, salle de bains et WC.', 10,70),
('T2', 'Les maisons de Type T1 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de deux pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à petite surface habitable.', 20,100),
('T3', 'Les maisons de Type T3 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de trois pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à surface moyenne habitable. (80 à 100m²)', 30,150),
('T4', 'Les maisons de Type T4 sont une des plus répandues en France mais il est nécessaire de préciser que celles-ci sont composées de quatre pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à surface raisonnable habitable (90 à 110m²).', 40,200),
('T5', 'Les maisons de Type T5 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de cinq pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à grande surface habitable. (de 120 à 140m²)', 50,250),
('T6', 'Les maisons de Type T6 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de six pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à grande surface habitable.(de 140 à 190m²)',40,400),
('T7', 'Les maisons de Type T7 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de sept pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à très grande surface habitable.(+ de 190m²)', 80,600);



INSERT INTO finition (type_finition, pourcentage) VALUES 
('standard', 0),
('gold', 20),
('premium', 40),
('VIP', 50);


INSERT INTO devis_client (id_client,ref_devis,lieu, id_maison, id_finition, date_debut, date_fin) VALUES 
(1,'D001','Isoraka', 1, 1, '2024-05-13', '2024-05-23'); --t1 , std  , 
(2,'D002','Soanierana' 2, 2, '2024-05-14', '2024-10-14'), --t2 , gold  , 
(3,'D003','Antsahavola' 3, 3, '2024-05-15', '2024-12-15'); --t3 , premium  , 


-- Insérer des données dans la table "sous_travaux"
INSERT INTO sous_travaux (num_sous_travaux ,sous_travaux, unite, prix_unit) VALUES 
('001', 'mur de soutenement et demi Cloture ht 1m', 'm3', 5120),
('101', 'decapage des terrains meubles', 'm2', 310),
('102', 'Dressage de plateforme', 'm2', 370),
('103', 'fouille ouvrage terrain ferme', 'm3', 220),
('104', 'remblai ouvrage', 'm3', 580),
('105', 'travaux implantation', 'fft', 150),
('201', 'maconnerie de moellons', 'm3', 1650),
('202', 'beton armee : semelles isolees', 'm3', 300),
('203', 'beton armee : amorces potaux', 'm3', 1400),
('204', 'beton armee : chainage bas', 'm3', 400),
('205', 'remblai technique', 'm3', 580),
('206', 'herissonage', 'm3', 570),
('207', 'beton ordinaire', 'm3', 2660),
('208', 'chape de 2 cm', 'm3', 2660);

-- Insérer des données dans la table "devis"
INSERT INTO devis (id_sous_travaux, id_maison, quantite) VALUES 
(1, 1, 1), -- 5120
(2, 1, 1), -- 310
(3, 1, 1), -- 370

(4, 2, 1), -- 220
(5, 2, 1), -- 580
(6, 2, 1), -- 150

(7, 3, 1), -- 1650
(8, 3, 1), -- 300
(7, 3, 1), -- 1400

(7, 4, 1), -- 1650
(8, 4, 1), -- 300
(7, 4, 1), -- 1400

(1, 5, 1), -- 5120
(2, 5, 1), -- 310
(3, 5, 1), -- 370

(4, 6, 1), -- 220
(5, 6, 1), -- 580
(6, 6, 1), -- 150

(7, 7, 1), -- 1650
(8, 7, 1), -- 300
(7, 7, 1); -- 1400

-- Insérer des données dans la table "travaux client"
INSERT INTO travaux_client (id_devis_client, id_sous_travaux, prix_unit, quantite)
VALUES
    (1, 1, 5120, 1),
    (1, 3, 310, 1),
    (1, 2, 370, 1);


INSERT INTO paiement (ref_paiement,id_devis_client, montant, date_paiement)
VALUES ('WEORJ456',1, 100.50, '2024-05-13');


INSERT INTO devis_admin (id_devis_client, id_admin)
VALUES (1, 1);


-- REQUEST


---SELECT TABLE
SELECT * FROM travaux_client;
SELECT * FROM devis_client;
SELECT * FROM paiement;
SELECT * FROM devis_admin;
SELECT * FROM devis;
SELECT * FROM sous_travaux;

SELECT * FROM travaux;
SELECT * FROM finition;

SELECT * FROM maison;
SELECT * FROM admin;
SELECT * FROM client;


---DELETE TABLE
DELETE TABLE travaux_client;
DELETE FROM devis_client;
DELETE FROM paiement;
DELETE FROM devis_admin;
DELETE FROM devis;
DELETE FROM sous_travaux;

DELETE FROM travaux;
DELETE FROM finition;

DELETE FROM maison;
DELETE FROM admin;
DELETE FROM client;

---DROP TABLE
DROP VIEW v_dash_devis;
DROP VIEW v_devis_attente;
DROP VIEW v_devis_admin;


DROP TABLE temp3;
DROP TABLE temp2;
DROP TABLE temp1;
DROP TABLE travaux_client;
DROP TABLE paiement;
DROP TABLE devis_admin;
DROP TABLE devis;
DROP TABLE devis_client;
DROP TABLE sous_travaux;
DROP TABLE finition;
DROP TABLE maison;
DROP TABLE admin;
DROP TABLE client;


INSERT INTO paiement (ref_paiement,id_devis_client,montant,date_paiement)
SELECT t3.ref_paiement,dc.id_devis_client,t3.montant,t3.date_paiement
FROM temp3 t3
JOIN devis_client dc ON dc.ref_devis =  t3.ref_devis;



SELECT 
    dc.id_devis_client, 
    dc.date_creation, 
    m.type_maison, 
    f.type_finition, 
    dc.date_debut, 
    dc.date_fin, 
    dc.pourcentage,
    dc.etat,
    SUM(tc.quantite * tc.prix_unit) AS total,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit) * dc.pourcentage) / 100) AS ttl
FROM 
    devis_client dc
JOIN 
    travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN 
    maison m ON dc.id_maison = m.id_maison
JOIN 
    client c ON dc.id_client = c.id_client
JOIN 
    finition f ON dc.id_finition = f.id_finition
WHERE 
    dc.id_client = 2
GROUP BY 
    dc.id_devis_client, 
    dc.date_creation, 
    m.type_maison, 
    f.type_finition, 
    dc.date_debut, 
    dc.date_fin, 
    dc.pourcentage, 
    dc.etat;



TRUNCATE  TABLE temp3  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE temp2  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE temp1  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE travaux_client  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE paiement  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE devis_admin  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE devis  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE devis_client  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE sous_travaux  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE finition  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE maison  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE admin  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE client  RESTART IDENTITY CASCADE;