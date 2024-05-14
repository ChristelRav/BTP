<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Finition extends CI_Model{
    public function list(){
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
    public function insert($type_finition, $pourcentage) {
        $sql = "insert into finition (type_finition,pourcentage) values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($type_finition),$this->db->escape($pourcentage));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function update($id,$type_finition,$pourcentage) {
        $sql = "update finition set type_finition=%s ,  pourcentage=%s    where id_finition=%s";
        $sql = sprintf($sql,$this->db->escape($type_finition),$this->db->escape($pourcentage),$this->db->escape($id));
        $this->db->query($sql);
    }
}
?>