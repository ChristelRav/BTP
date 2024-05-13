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
DROP TABLE travaux_client;
DROP TABLE devis_client;
DROP TABLE paiement;
DROP TABLE devis_admin;
DROP TABLE devis;
DROP TABLE sous_travaux;

DROP TABLE travaux;
DROP TABLE finition;
DROP TABLE maison;
DROP TABLE admin;
DROP TABLE client;


--REQUEST

SELECT dc.id_devis_client,dc.date_creation,m.type_maison,f.type_finition,dc.date_debut,dc.date_fin
FROM devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.id_client = 1;

SELECT SUM(d.quantite * st.prix_unit), m.id_maison, m.type_maison, m.caracteristique, m.duree
FROM maison m
JOIN devis d ON d.id_maison = m.id_maison
JOIN sous_travaux st ON d.id_sous_travaux = st.id_sous_travaux
WHERE m.id_maison = 1
GROUP BY m.id_maison, m.type_maison, m.caracteristique, m.duree;
