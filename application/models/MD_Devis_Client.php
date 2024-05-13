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
    public function insert($id_client, $id_maison, $id_finition,$date_creation, $date_debut, $date_fin,$pourcentage) {
        $sql = "insert into devis_client (id_client, id_maison, id_finition,date_creation, date_debut, date_fin,pourcentage) values ( %s, %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_client),$this->db->escape($id_maison),$this->db->escape($id_finition),$this->db->escape($date_creation),$this->db->escape($date_debut),$this->db->escape($date_fin),$this->db->escape($pourcentage));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    function ajoutJours($date, $nombre_jours) {
        $date_obj = new DateTime($date);
        $date_obj->modify('+' . $nombre_jours . ' days');
        return $date_obj->format('Y-m-d');
    }
    public function getNewDevis_Client($id) {
        $this->db->select('*');
        $this->db->from('devis_client dc');
        $this->db->where('dc.id_client', $id);
        $this->db->order_by('dc.id_devis_client', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row(); 
    }
    public function listDevis_Client_Ttl($client){
        $this->db->select("dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin, dc.pourcentage,dc.etat,
        SUM(tc.quantite * tc.prix_unit) as total,(SUM(tc.quantite * tc.prix_unit) + (SUM(tc.quantite * tc.prix_unit)*dc.pourcentage)/100) as ttl ");
        $this->db->from('devis_client dc');
        $this->db->join('travaux_client tc', 'tc.id_devis_client = dc.id_devis_client');
        $this->db->join('maison m', 'dc.id_maison = m.id_maison');
        $this->db->join('client c', 'dc.id_client = c.id_client');
        $this->db->join('finition f', 'dc.id_finition = f.id_finition');
        $this->db->where('dc.id_client', $client);
        $this->db->group_by('dc.id_devis_client, dc.date_creation, m.type_maison, f.type_finition, dc.date_debut, dc.date_fin');
        $query = $this->db->get();
        return $query->result();  
    }
    public function listDevis_Admin_Ttl($admin){
        $this->db->select("*");
        $this->db->from('v_devis_admin');
        $this->db->where('id_admin ', $admin);
        $query = $this->db->get();
        return $query->result();  
    }
    public function listDevis_attente(){
        $this->db->select("*");
        $this->db->from('v_devis_attente');
        $query = $this->db->get();
        return $query->result();  
    }
    public function update($id,$etat) {
        $sql = "update devis_client set etat=%s where id_devis_client =%s";
        $sql = sprintf($sql,$this->db->escape($etat),$this->db->escape($id));
        $this->db->query($sql);
    }
}
?>