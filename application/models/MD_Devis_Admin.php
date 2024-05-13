<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Devis_Admin extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_devis_admin', $id);
        $query = $this->db->get('devis_admin'); 
        return $query->row(); 
    }
    public function insert($id_devis_client, $id_admin) {
        $sql = "insert into devis_admin (id_devis_client, id_admin) values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_devis_client),$this->db->escape($id_admin));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function sumMontant_All_devis($id) {
        $this->db->select("sum(ttl) as all_devis");
        $this->db->from('v_devis_admin'); 
        $this->db->where('id_admin', $id);
        $query = $this->db->get(); 
        return $query->row(); 
    }
}
?>