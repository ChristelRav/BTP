<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Sous_Travaux extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_devis_client', $id);
        $query = $this->db->get('devis_client'); 
        return $query->row(); 
    }
    // TRAVAUX - SOUS_TRAVAUX
    public function list($travaux){
        $this->db->select("*");
        $this->db->from('sous_travaux');
        $this->db->where('id_travaux', $travaux);
        $query = $this->db->get();
        return $query->result();  
    }
}
?>