<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Devis_Client extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_devis_client', $id);
        $query = $this->db->get('devis_client'); 
        return $query->row(); 
    }
    // DEVIS - CLIENT
    public function listDevis_Client($client){
        $this->db->select("dc.id_devis_client,dc.date_creation,m.type_maison,f.type_finition,dc.date_debut,dc.date_fin");
        $this->db->from('devis_client dc');
        $this->db->join('maison m', 'dc.id_maison = m.id_maison');
        $this->db->join('client c', 'dc.id_client = c.id_client');
        $this->db->join('finition f', 'dc.id_finition = f.id_finition');
        $this->db->where('dc.id_client', $client);
        $query = $this->db->get();
        return $query->result();  
    }
}
?>