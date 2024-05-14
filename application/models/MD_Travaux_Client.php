<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Travaux_Client extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_travaux_client', $id);
        $query = $this->db->get('travaux_client'); 
        return $query->row(); 
    }
    //TRAVAUX - PRIX - QTT - DEVIS
    public function listDetail_Devis($devis){
        $this->db->select('st.num_sous_travaux,st.sous_travaux,tv.id_sous_travaux,st.unite,tv.quantite,tv.prix_unit,(tv.quantite*tv.prix_unit)  as total');
        $this->db->from('travaux_client tv');
        $this->db->join('devis_client dc', 'dc.id_devis_client = tv.id_devis_client');
        $this->db->join('sous_travaux st', 'tv.id_sous_travaux = st.id_sous_travaux');
        $this->db->where('tv.id_devis_client ', $devis);
        $query = $this->db->get();
        return $query->result();
    }
    public function sumMontant($devis) {
        $this->db->select('sum(tv.quantite*tv.prix_unit)  as total , ((sum(tv.quantite*tv.prix_unit)* f.pourcentage)/100)  as finit ,
        (sum(tv.quantite*tv.prix_unit) +  ((sum(tv.quantite*tv.prix_unit)* f.pourcentage)/100) ) as som');
        $this->db->from('travaux_client tv');
        $this->db->join('devis_client dc', 'dc.id_devis_client = tv.id_devis_client');
        $this->db->join('sous_travaux st', 'tv.id_sous_travaux = st.id_sous_travaux');
        $this->db->join('finition f', 'dc.id_finition = f.id_finition');
        $this->db->where('tv.id_devis_client ', $devis);
        $this->db->group_by('dc.id_finition,f.pourcentage');
        $query = $this->db->get(); 
        return $query->row(); 
    }
    function somme($tableau) {
        $total = 0;
        foreach ($tableau as $valeur) {
            $total += $valeur;
        }
        return $total;
    }
    public function listTravaux(){
        $this->db->select('*');
        $this->db->from('travaux');
        $query = $this->db->get();
        return $query->result();
    }
    public function insert($id_devis_client, $id_sous_travaux, $prix_unit, $quantite) {
        $sql = "insert into travaux_client (id_devis_client, id_sous_travaux, prix_unit, quantite) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_devis_client),$this->db->escape($id_sous_travaux),$this->db->escape($prix_unit),$this->db->escape($quantite));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
}
?>