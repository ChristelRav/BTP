<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Sous_Travaux extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_devis_client', $id);
        $query = $this->db->get('devis_client'); 
        return $query->row(); 
    }
    // TRAVAUX - SOUS_TRAVAUX
    public function list(){
        $this->db->select("*");
        $this->db->from('sous_travaux');
        $query = $this->db->get();
        return $query->result();  
    }
    public function update($id,$num,$sst,$unite,$prix) {
        $sql = "update sous_travaux set num_sous_travaux=%s ,  sous_travaux=%s  ,unite=%s ,  prix_unit=%s  where id_sous_travaux =%s";
        $sql = sprintf($sql,$this->db->escape($num),$this->db->escape($sst),$this->db->escape($unite),$this->db->escape($prix),$this->db->escape($id));
        $this->db->query($sql);
    }
    public function insert($num_sous_travaux ,$sous_travaux, $unite, $prix_unit) {
        $sql = "insert into  sous_travaux (num_sous_travaux ,sous_travaux, unite, prix_unit) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($num_sous_travaux),$this->db->escape($sous_travaux),$this->db->escape($unite),$this->db->escape($prix_unit));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
}
?>