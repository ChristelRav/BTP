<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Admin extends CI_Model{
    //login
    public function verify($email, $password) {
        $query = $this->db->get_where('admin', array('email' => $email, 'mot_passe' => $password));
        $client = $query->result_array();
        return $client;
    }
    public function truncate_all_tables() {
        $tables = [
            'temp3',
            'temp2',
            'temp1',
            'travaux_client',
            'paiement',
            'devis_admin',
            'devis',
            'devis_client',
            'sous_travaux',
            'finition',
            'maison',
            'client'
        ];
        foreach ($tables as $table) {
            $sql = "TRUNCATE TABLE $table RESTART IDENTITY CASCADE;";
            $this->db->query($sql);
        }
    }
}
?>