<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Paiement extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_paiement', $id);
        $query = $this->db->get('paiement'); 
        return $query->row(); 
    }
    public function insert($ref_paiement,$id_devis_client, $montant, $date_paiement) {
        $sql = "insert into  paiement (ref_paiement,id_devis_client, montant, date_paiement) values (%s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($ref_paiement),$this->db->escape($id_devis_client),$this->db->escape($montant),$this->db->escape($date_paiement));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function insertS($id_devis_client, $montant, $date_paiement) {
        $sql = "insert into  paiement (id_devis_client, montant, date_paiement) values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_devis_client),$this->db->escape($montant),$this->db->escape($date_paiement));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function listPayer_Devis($id) {
        $this->db->select('*');
        $this->db->from('paiement p');
        $this->db->where('p.id_devis_client', $id);
        $query = $this->db->get();
        return $query->result(); 
    }
    public function getReste($id) {
        $this->db->select('sum(montant) as reste');
        $this->db->from('paiement p');
        $this->db->where('p.id_devis_client', $id);
        $query = $this->db->get();
        return $query->row(); 
    }
}
?>