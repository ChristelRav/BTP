<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Finition extends CI_Model{
    public function listAll(){
        $this->db->select('*');
        $this->db->from('finition');
        $query = $this->db->get();
        return $query->result();
    }
    public function getOne($id) {
        $this->db->where('id_finition', $id);
        $query = $this->db->get('finition'); 
        return $query->row(); 
    }
}
?>