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
(1, 1, 1, '2024-05-13', '2024-05-20');
(2, 2, 2, '2024-05-14', '2024-05-21'),
(3, 3, 3, '2024-05-15', '2024-05-22');


-- Insérer des données dans la table "travaux"
INSERT INTO travaux (num_travaux, travaux) VALUES 
('T001', 'Travaux de peinture intérieure'),
('T002', 'Travaux de plomberie'),
('T003', 'Travaux de menuiserie'),
('T004', 'Travaux de maçonnerie');

-- Insérer des données dans la table "sous_travaux"
INSERT INTO sous_travaux (id_travaux, sous_travaux, unite, prix_unit) VALUES 
(1, 'Peinture des murs', 'm²', 15),
(1, 'Peinture des plafonds', 'm²', 10),
(2, 'Installation de robinetterie', 'unité', 50),
(2, 'Réparation de fuites', 'heure', 25),
(3, 'Fabrication de meubles sur mesure', 'unité', 200),
(3, 'Installation de portes et fenêtres', 'unité', 150),
(4, 'Construction de murs', 'm²', 80),
(4, 'Pose de carrelage', 'm²', 20);

-- Insérer des données dans la table "devis"
INSERT INTO devis (id_sous_travaux, id_maison, quantite) VALUES 
(1, 1, 1), -- 15
(2, 1, 1), -- 10
(3, 1, 1), -- 50
(4, 1, 1), -- 25
(5, 1, 1), -- 200
(6, 1, 1), -- 150
(7, 1, 1), -- 80
(8, 1, 1); -- 20

