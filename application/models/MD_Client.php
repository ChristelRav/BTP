<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Client extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_client', $id);
        $query = $this->db->get('client'); 
        return $query->result_array(); 
    }
    public function insert($contact) {
        $sql = "insert into client (contact) values (%s) ";
        $sql = sprintf($sql,$this->db->escape($contact));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    //    login
    function verify($contact) {
        $query = $this->db->get_where('client', array('contact' => $contact));
        $client = $query->result_array();
        return $client;
    }
}
?>