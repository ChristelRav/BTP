<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Admin extends CI_Model{
    //login
    function verify($email, $password) {
        $query = $this->db->get_where('admin', array('email' => $email, 'mot_passe' => $password));
        $client = $query->result_array();
        return $client;
    }
}
?>