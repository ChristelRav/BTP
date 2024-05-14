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

DROP TABLE temp1;
DROP TABLE temp2;
DROP TABLE temp3;

DROP VIEW v_dash_devis;
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

ALTER TABLE sous_travaux DROP COLUMN id_travaux CASCADE;

SELECT dc.id_devis_client,dc.date_creation,m.type_maison,f.type_finition,dc.date_debut,dc.date_fin
FROM devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.id_client = 1;

CREATE VIEW v_dash_Devis AS (SELECT dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
SUM(tc.quantite * tc.prix_unit) as total,
(SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl 
FROM devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
GROUP BY dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin);


SELECT SUM(ttl)
FROM v_dash_Devis;

SELECT SUM(ttl)
FROM v_devis_admin;

SELECT SUM(d.quantite * st.prix_unit), m.id_maison, m.type_maison, m.caracteristique, m.duree
FROM maison m
JOIN devis d ON d.id_maison = m.id_maison
JOIN sous_travaux st ON d.id_sous_travaux = st.id_sous_travaux
GROUP BY m.id_maison, m.type_maison, m.caracteristique, m.duree;

SELECT st.num_sous_travaux,tv.id_sous_travaux,st.sous_travaux,st.unite,tv.quantite,tv.prix_unit,(tv.quantite*tv.prix_unit)  as total
FROM travaux_client tv
JOIN devis_client dc ON dc.id_devis_client = tv.id_devis_client
JOIN sous_travaux st ON tv.id_sous_travaux = st.id_sous_travaux
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
    dc.ref_devis,dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
    SUM(tc.quantite * tc.prix_unit) as total,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl,
    (SELECT COALESCE(SUM(p.montant), 0) FROM paiement p WHERE p.id_devis_client = dc.id_devis_client) as deja_payer,
   ( ((SELECT COALESCE(SUM(p.montant), 0) FROM paiement p WHERE p.id_devis_client = dc.id_devis_client) * 100)/  (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100)) as paiement,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100)   -  (SELECT COALESCE(SUM(p.montant), 0) FROM paiement p WHERE p.id_devis_client = dc.id_devis_client) as reste_a_payer
FROM 
    devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
GROUP BY dc.ref_devis,dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage
ORDER BY dc.date_creation DESC
);



CREATE VIEW v_devis_attente  as (SELECT
    dc.ref_devis,dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,
    SUM(tc.quantite * tc.prix_unit) as total,
    (SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl
FROM
devis_client dc
JOIN maison m ON dc.id_maison = m.id_maison
JOIN travaux_client tc ON tc.id_devis_client = dc.id_devis_client
JOIN client c ON dc.id_client = c.id_client
JOIN finition f ON dc.id_finition = f.id_finition
WHERE dc.etat =1
GROUP BY dc.ref_devis,dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage
ORDER BY dc.date_creation DESC
);

--Le montant total des devis
select sum(ttl) as all_devis
from v_devis_admin where id_admin=1;
--
SELECT 
EXTRACT(MONTH FROM dates.month_date) AS mois,
COALESCE(SUM(vda.ttl), 0) AS montant_total
FROM 
generate_series('2024-01-01'::date, '2024-12-31'::date, '1 month') AS dates(month_date)
LEFT JOIN 
v_devis_admin vda ON EXTRACT(MONTH FROM vda.date_creation) = EXTRACT(MONTH FROM dates.month_date)
AND EXTRACT(YEAR FROM vda.date_creation) = 2024
AND vda.id_admin = 1
GROUP BY  mois
ORDER BY mois;

SELECT 
    to_char(dates.month_date, 'Month') AS mois,
    COALESCE(SUM(vda.ttl), 0) AS montant_total
FROM 
    generate_series('2024-01-01'::date, '2024-12-31'::date, '1 month') AS dates(month_date)
LEFT JOIN 
    v_devis_admin vda ON vda.date_creation >= dates.month_date 
    AND vda.date_creation < dates.month_date + INTERVAL '1 month'
    AND EXTRACT(YEAR FROM vda.date_creation) = 2024
    AND vda.id_admin = 1
GROUP BY 
    dates.month_date
ORDER BY 
    dates.month_date;


SELECT sum(tv.quantite*tv.prix_unit)  as total
FROM travaux_client tv
JOIN devis_client dc ON dc.id_devis_client = tv.id_devis_client
JOIN sous_travaux st ON tv.id_sous_travaux = st.id_sous_travaux
where tv.id_devis_client =1;

SELECT sum(tv.quantite*tv.prix_unit)  as total , ((sum(tv.quantite*tv.prix_unit)* f.pourcentage)/100)  as finit ,
(sum(tv.quantite*tv.prix_unit) +  ((sum(tv.quantite*tv.prix_unit)* f.pourcentage)/100) ) as som
FROM travaux_client tv
JOIN devis_client dc ON dc.id_devis_client = tv.id_devis_client
JOIN sous_travaux st ON tv.id_sous_travaux = st.id_sous_travaux
JOIN finition f ON dc.id_finition = f.id_finition
GROUP BY dc.id_finition,f.pourcentage;


--T3

INSERT INTO paiement (ref_paiement,id_devis_client,montant,date_paiement)
SELECT t3.ref_paiement,dc.id_devis_client,t3.montant,t3.date_paiement
FROM temp3 t3
JOIN devis_client dc ON dc.ref_devis =  t3.ref_devis;

--T1

INSERT INTO maison (type_maison,caracteristique,duree,surface)
SELECT distinct t1.type_maison,t1.description,t1.duree_travaux,surface
FROM temp1 t1;


INSERT INTO sous_travaux (num_sous_travaux ,sous_travaux, unite, prix_unit)
SELECT distinct t1.code_travaux , t1.type_travaux, t1. unite, t1. prix_unitaire
FROM temp1 t1;

INSERT INTO devis (id_sous_travaux, id_maison, quantite)
SELECT distinct sst.id_sous_travaux,m.id_maison,t1.quantite
FROM temp1 t1
JOIN maison m ON t1.type_maison = m.type_maison
JOIN sous_travaux sst ON sst.num_sous_travaux = t1.code_travaux;

--TEMP2


INSERT INTO client (contact)
SELECT distinct t2.client
FROM temp2 t2;

INSERT INTO finition (type_finition,pourcentage)
SELECT distinct t2.finition,t2.taux_finition
FROM temp2 t2;

INSERT into devis_client (ref_devis,id_client, id_maison, id_finition,date_creation, date_debut, date_fin,pourcentage,lieu) 
SELECT distinct t2.ref_devis,c.id_client,m.id_maison,f.id_finition,t2.date_devis,t2.date_debut,t2.date_debut + m.duree as date_fin,
t2.taux_finition,t2.lieu
FROM temp2 t2
JOIN client c ON c.contact = t2.client
JOIN  maison m ON t2.type_maison = m.type_maison
JOIN finition f ON f.type_finition = t2.finition;

--