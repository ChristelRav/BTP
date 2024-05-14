<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Maison extends CI_Model{
    public function listAll(){
        $this->db->select('SUM(d.quantite * st.prix_unit) as total,m.surface, m.id_maison, m.type_maison, m.caracteristique, m.duree');
        $this->db->from('maison m');
        $this->db->join('devis d', 'd.id_maison = m.id_maison');
        $this->db->join('sous_travaux st', 'd.id_sous_travaux = st.id_sous_travaux');
        $this->db->group_by('m.id_maison,m.surface, m.type_maison, m.caracteristique, m.duree');
        $query = $this->db->get();
        return $query->result();
    }
    public function getOne($id) {
        $this->db->where('id_maison', $id);
        $query = $this->db->get('maison'); 
        return $query->row(); 
    }
    public function insert($type_maison, $caracteristique,$duree,$surface) {
        $sql = "insert into  maison (type_maison, caracteristique, duree,surface) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($type_maison),$this->db->escape($caracteristique),$this->db->escape($duree),$this->db->escape($surface));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
}
?>