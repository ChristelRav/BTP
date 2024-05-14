<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Devis extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_devis', $id);
        $query = $this->db->get('devis'); 
        return $query->row(); 
    }
    public function listAll(){
        $this->db->select('*');
        $this->db->from('devis');
        $query = $this->db->get();
        return $query->result();
    }
    //SS_TRAVAUX - DEVIS
    public function listSous_Travaux_Devis($id) {
        $this->db->select("d.quantite , st.prix_unit ,st.id_sous_travaux");
        $this->db->from('devis d'); // Correction: nom de la table 'devis' en minuscules
        $this->db->join('sous_travaux st', 'd.id_sous_travaux = st.id_sous_travaux');
        $this->db->where('d.id_maison', $id);
        $query = $this->db->get(); 
        return $query->result(); 
    }

    public function update($id,$idss,$idm,$qtt) {
        $sql = "update devis set id_sous_travaux=%s ,  id_maison=%s  ,quantite=%s   where id_devis=%s";
        $sql = sprintf($sql,$this->db->escape($idss),$this->db->escape($idm),$this->db->escape($qtt),$this->db->escape($id));
        $this->db->query($sql);
    }
    public function insert($id_sous_travaux, $id_maison, $quantite) {
        $sql = "insert into devis (id_sous_travaux, id_maison, quantite)  values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_sous_travaux),$this->db->escape($id_maison),$this->db->escape($quantite));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    
}
?>