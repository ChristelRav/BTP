<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Maison extends CI_Model{
    public function listAll(){
        $this->db->select('SUM(d.quantite * st.prix_unit) as total, m.id_maison, m.type_maison, m.caracteristique, m.duree');
        $this->db->from('maison m');
        $this->db->join('devis d', 'd.id_maison = m.id_maison');
        $this->db->join('sous_travaux st', 'd.id_sous_travaux = st.id_sous_travaux');
        $this->db->where('m.id_maison', 1);
        $this->db->group_by('m.id_maison, m.type_maison, m.caracteristique, m.duree');
        $query = $this->db->get();
        return $query->result();
    }
}
?>