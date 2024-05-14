<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Temp extends CI_Model{

    public function insert1($type_maison,$description,$surface,$code_travaux,$type_travaux,$unite,$prix_unitaire,$quantite,$duree_travaux) {
        $prix_unitaire = str_replace(',', '.', $prix_unitaire);
        $quantite = str_replace(',', '.', $quantite);
        $sql = "insert into temp1 (type_maison,description,surface,code_travaux,type_travaux,unite,prix_unitaire,quantite,duree_travaux) values ( %s, %s,%s, %s,%s, %s,%s, %s,%s) ";
        $sql = sprintf($sql,$this->db->escape($type_maison),$this->db->escape($description),$this->db->escape($surface),$this->db->escape($code_travaux),$this->db->escape($type_travaux),$this->db->escape($unite),$this->db->escape($prix_unitaire),$this->db->escape($quantite),$this->db->escape($duree_travaux));
        $this->db->query($sql);
    }
    public function insert2($client,$ref_devis,$type_maison,$finition,$taux_finition,$date_devis,$date_debut,$lieu) {
        $date_devis = DateTime::createFromFormat('d/m/Y', $date_devis)->format('Y-m-d');
        $date_debut = DateTime::createFromFormat('d/m/Y', $date_debut)->format('Y-m-d');
        $taux_finition = str_replace(',', '.', $taux_finition);
        $sql = "insert into temp2 (client,ref_devis,type_maison,finition,taux_finition,date_devis,date_debut,lieu) values ( %s, %s, %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($client),$this->db->escape($ref_devis),$this->db->escape($type_maison),$this->db->escape($finition),$this->db->escape($taux_finition),$this->db->escape($date_devis),$this->db->escape($date_debut),$this->db->escape($lieu));
        $this->db->query($sql);
    }
    public function insert3($ref_devis,$ref_paiement,$date_paiement,$montant)  {
        $date_paiement = DateTime::createFromFormat('d/m/Y', $date_paiement)->format('Y-m-d');
        $sql = "insert into temp3 (ref_devis,ref_paiement,date_paiement,montant) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($ref_devis),$this->db->escape($ref_paiement),$this->db->escape($date_paiement),$this->db->escape($montant));
        $this->db->query($sql);
    }

      //TEMP3
    public function insert_paiement(){
        $sql = "INSERT INTO paiement (ref_paiement,id_devis_client,montant,date_paiement)
        SELECT t3.ref_paiement,dc.id_devis_client,t3.montant,t3.date_paiement
        FROM temp3 t3
        JOIN devis_client dc ON dc.ref_devis =  t3.ref_devis";
        $this->db->query($sql);

    }
    //TEMP1
    public function insert_maison_travaux(){
        $sql = "INSERT INTO maison (type_maison,caracteristique,duree,surface)
        SELECT distinct t1.type_maison,t1.description,t1.duree_travaux,surface
        FROM temp1 t1";
        $this->db->query($sql);
    }
    public function insert_maison_travaux2(){

        $sql = "INSERT INTO sous_travaux (num_sous_travaux ,sous_travaux, unite, prix_unit)
        SELECT distinct t1.code_travaux , t1.type_travaux, t1. unite, t1. prix_unitaire
        FROM temp1 t1";
        $this->db->query($sql);
    }
    public function insert_maison_travaux3(){
        $sql = " INSERT INTO devis (id_sous_travaux, id_maison, quantite)
        SELECT distinct sst.id_sous_travaux,m.id_maison,t1.quantite
        FROM temp1 t1
        JOIN maison m ON t1.type_maison = m.type_maison
        JOIN sous_travaux sst ON sst.num_sous_travaux = t1.code_travaux";
        $this->db->query($sql);
    }
    //TEMP2
    public function insert_devis(){
        $sql = "INSERT INTO client (contact)
        SELECT distinct t2.client
        FROM temp2 t2";
        $this->db->query($sql);
    }
    public function insert_devis2(){
        $sql = "INSERT INTO finition (type_finition,pourcentage)
        SELECT distinct t2.finition,t2.taux_finition
        FROM temp2 t2";
        $this->db->query($sql);
    }
    public function insert_devis3(){
        $sql = "INSERT into devis_client (ref_devis,id_client, id_maison, id_finition,date_creation, date_debut, date_fin,pourcentage,lieu) 
        SELECT distinct t2.ref_devis,c.id_client,m.id_maison,f.id_finition,t2.date_devis,t2.date_debut,t2.date_debut + m.duree as date_fin,
        t2.taux_finition,t2.lieu
        FROM temp2 t2
        JOIN client c ON c.contact = t2.client
        JOIN  maison m ON t2.type_maison = m.type_maison
        JOIN finition f ON f.type_finition = t2.finition";
        $this->db->query($sql);

        $this->load->model('MD_Devis_Client');
        $this->load->model('MD_Devis');
        $this->load->model('MD_Travaux_Client');
        $data = $this->MD_Devis_Client->listDC();
        foreach ($data as $row) {
            $last = $this->MD_Devis_Client->getNewDevis_Client($row->id_client);
            $sst = $this->MD_Devis->listSous_Travaux_Devis($row->id_maison);
            for ($i=0; $i < count($sst) ; $i++) { 
            echo '<br> --- ' .$sst[$i]->id_sous_travaux.' &&& '.$sst[$i]->prix_unit.' ///// '.$sst[$i]->quantite;
                $this->MD_Travaux_Client->insert($last->id_devis_client,$sst[$i]->id_sous_travaux,$sst[$i]->prix_unit,$sst[$i]->quantite);
            }
        }
    }

}
?>