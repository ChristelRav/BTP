CREATE USER btpu WITH PASSWORD 'prom15';
CREATE DATABASE btp;
GRANT ALL PRIVILEGES ON DATABASE btp TO btpu;

psql -U btpu -d btp

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
    duree INT
);

CREATE TABLE finition (
    id_finition SERIAL PRIMARY KEY,
    type_finition VARCHAR(50) DEFAULT 'standard',
    pourcentage DOUBLE PRECISION
);

CREATE TABLE travaux (
    id_travaux SERIAL PRIMARY KEY,
    num_travaux VARCHAR(10),
    travaux TEXT
);

CREATE TABLE sous_travaux (
    id_sous_travaux SERIAL PRIMARY KEY,
    id_travaux INT REFERENCES travaux(id_travaux),
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
    id_client INT REFERENCES client(id_client),
    id_maison INT REFERENCES maison(id_maison),
    id_finition INT REFERENCES finition(id_finition),
    date_creation DATE DEFAULT current_date,
    date_debut DATE,
    date_fin DATE,
    etat INT DEFAULT 1
);

CREATE TABLE devis_admin (
    id_devis_admin SERIAL PRIMARY KEY,
    id_devis_client INT REFERENCES devis_client(id_devis_client),
    id_admin INT REFERENCES admin(id_admin)
);

CREATE TABLE paiement (
    id_paiement SERIAL PRIMARY KEY,
    id_devis_client INT REFERENCES devis_client(id_devis_client),
    montant DOUBLE PRECISION,
    date_paiement DATE
); 