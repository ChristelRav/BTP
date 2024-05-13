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
DROP VIEW v_devis_attente;
DROP VIEW v_devis_admin;
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

SELECT dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
SUM(tc.quantite * tc.prix_unit) as total,(SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl 
FROM devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.id_client = 1
GROUP BY dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin;


SELECT SUM(d.quantite * st.prix_unit), m.id_maison, m.type_maison, m.caracteristique, m.duree
FROM maison m
JOIN devis d ON d.id_maison = m.id_maison
JOIN sous_travaux st ON d.id_sous_travaux = st.id_sous_travaux
GROUP BY m.id_maison, m.type_maison, m.caracteristique, m.duree;

SELECT st.num_sous_travaux,tv.id_sous_travaux,st.sous_travaux,st.unite,tv.quantite,tv.prix_unit,st.id_travaux,t.travaux,(tv.quantite*tv.prix_unit)  as total
FROM travaux_client tv
JOIN devis_client dc ON dc.id_devis_client = tv.id_devis_client
JOIN sous_travaux st ON tv.id_sous_travaux = st.id_sous_travaux
JOIN travaux t ON t.id_travaux = st.id_travaux
where tv.id_devis_client =1;


SELECT d.quantite , st.prix_unit ,st.id_sous_travaux
FROM devis d
JOIN sous_travaux st ON d.id_sous_travaux = st.id_sous_travaux
JOIN travaux t ON t.id_travaux = st.id_travaux
WHERE id_maison = 1;

SELECT *
FROM devis_client dc
WHERE id_client = 1
ORDER BY id_devis_client DESC LIMIT 1;

SELECT sum(p.montant)
FROM paiement p
WHERE p.id_devis_client = 1;


SELECT dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
SUM(tc.quantite * tc.prix_unit) as total,(SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl 
FROM devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.etat= 3
GROUP BY dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin;


CREATE VIEW v_devis_admin  as (SELECT 
    dc.id_devis_client,da.id_admin , dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
    SUM(tc.quantite * tc.prix_unit) as total,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl,
    (SELECT COALESCE(SUM(p.montant), 0) FROM paiement p WHERE p.id_devis_client = dc.id_devis_client) as deja_payer,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100)   -  (SELECT COALESCE(SUM(p.montant), 0) FROM paiement p WHERE p.id_devis_client = dc.id_devis_client) as reste_a_payer
FROM 
    devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN devis_admin da  ON da.id_devis_client =  dc.id_devis_client
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.etat = 3 
GROUP BY dc.id_devis_client,da.id_admin , dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage
ORDER BY dc.date_creation DESC
);



CREATE VIEW v_devis_attente  as (SELECT
    dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
    SUM(tc.quantite * tc.prix_unit) as total,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl
FROM
devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.etat =1
GROUP BY dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage
ORDER BY dc.date_creation DESC
);

--Le montant total des devis
select sum(ttl) as all_devis
from v_devis_admin where id_admin=1;
--

