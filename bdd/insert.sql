INSERT INTO client (contact) VALUES ('0340784909');
INSERT INTO client (contact) VALUES ('0340584909');
INSERT INTO client (contact) VALUES ('0321084909');


INSERT INTO admin (email, mot_passe) VALUES ('admin1@example.com', '123');
INSERT INTO admin (email, mot_passe) VALUES ('admin2@example.com', '456');
INSERT INTO admin (email, mot_passe) VALUES ('admin3@example.com', '789');


INSERT INTO maison (type_maison, caracteristique, duree) VALUES 
('T1', 'Les maisons de Type T1 sont assez rares mais il est nécessaire de préciser que celle-ci est composée dune seule pièce*, hors cuisine, salle de bains et WC.', NULL),
('T2', 'Les maisons de Type T1 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de deux pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à petite surface habitable.', 91),
('T3', 'Les maisons de Type T3 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de trois pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à surface moyenne habitable. (80 à 100m²)', 122),
('T4', 'Les maisons de Type T4 sont une des plus répandues en France mais il est nécessaire de préciser que celles-ci sont composées de quatre pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à surface raisonnable habitable (90 à 110m²).', 183),
('T5', 'Les maisons de Type T5 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de cinq pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à grande surface habitable. (de 120 à 140m²)', 244),
('T6', 'Les maisons de Type T6 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de six pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à grande surface habitable.(de 140 à 190m²)', 270),
('T7', 'Les maisons de Type T7 sont courantes mais il est nécessaire de préciser que celles-ci sont composées de sept pièces*, hors cuisine, salle de bains et WC. Ce sont généralement des maisons à très grande surface habitable.(+ de 190m²)', 300);



INSERT INTO finition (type_finition, pourcentage) VALUES 
('standard', 0),
('gold', 20),
('premium', 40),
('VIP', 50);


INSERT INTO devis_client (id_client, id_maison, id_finition, date_debut, date_fin) VALUES 
(1, 1, 1, '2024-05-13', '2024-05-13'); --t1 , std  , 
(2, 2, 2, '2024-05-14', '2024-10-14'), --t2 , gold  , 
(3, 3, 3, '2024-05-15', '2024-12-15'); --t3 , premium  , 


-- Insérer des données dans la table "travaux"
INSERT INTO travaux (num_travaux, travaux) VALUES 
('000', 'Travaux preparatoire'),
('100', 'Travaux de terrassement'),
('200', 'Travaux en infrastructure');

-- Insérer des données dans la table "sous_travaux"
INSERT INTO sous_travaux (id_travaux,num_sous_travaux ,sous_travaux, unite, prix_unit) VALUES 
(1,'001', 'mur de soutenement et demi Cloture ht 1m', 'm3', 5120),
(2,'101', 'decapage des terrains meubles', 'm2', 310),
(2,'102', 'Dressage de plateforme', 'm2', 370),
(2,'103', 'fouille ouvrage terrain ferme', 'm3', 220),
(2,'104', 'remblai ouvrage', 'm3', 580),
(2,'105', 'travaux implantation', 'fft', 150),
(3,'201', 'maconnerie de moellons', 'm3', 1650),
(3,'202', 'beton armee : semelles isolees', 'm3', 300),
(3,'203', 'beton armee : amorces potaux', 'm3', 1400),
(3,'204', 'beton armee : chainage bas', 'm3', 400),
(3,'205', 'remblai technique', 'm3', 580),
(3,'206', 'herissonage', 'm3', 570),
(3,'207', 'beton ordinaire', 'm3', 2660),
(3,'208', 'chape de 2 cm', 'm3', 2660);

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

