<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Travaux_Client extends CI_Model{
    //TRAVAUX - PRIX - QTT - DEVIS
    public function listDetail_Devis($devis){
        $this->db->select('t.num_travaux,st.num_sous_travaux,st.sous_travaux,tv.id_sous_travaux,st.unite,tv.quantite,tv.prix_unit,st.id_travaux,t.travaux,(tv.quantite*tv.prix_unit)  as total');
        $this->db->from('travaux_client tv');
        $this->db->join('devis_client dc', 'dc.id_devis_client = tv.id_devis_client');
        $this->db->join('sous_travaux st', 'tv.id_sous_travaux = st.id_sous_travaux');
        $this->db->join('travaux t', 't.id_travaux = st.id_travaux');
        $this->db->where('tv.id_devis_client ', $devis);
        $query = $this->db->get();
        $resultats = array();
        foreach ($query->result() as $row) {
            $resultats[$row->travaux]['travaux'] = $row->travaux;
            $resultats[$row->travaux]['num_travaux'] = $row->num_travaux;
            $resultats[$row->travaux]['id_sous_travaux'][] = $row->id_sous_travaux;
            $resultats[$row->travaux]['num_sous_travaux'][] = $row->num_sous_travaux;
            $resultats[$row->travaux]['sous_travaux'][] = $row->sous_travaux;
            $resultats[$row->travaux]['unite'][] = $row->unite;
            $resultats[$row->travaux]['quantite'][] = $row->quantite;
            $resultats[$row->travaux]['prix_unit'][] = $row->prix_unit;
            $resultats[$row->travaux]['total'][] = $row->total;
        }
        return $resultats;
    }
    function somme($tableau) {
        $total = 0;
        foreach ($tableau as $valeur) {
            $total += $valeur;
        }
        return $total;
    }
    
    public function listTravaux(){
        $this->db->select('*');
        $this->db->from('travaux');
        $query = $this->db->get();
        return $query->result();
    }
    public function listDevis($devis){
        $sst = $this->MD_Travaux_Client->listDetail_Devis($devis);
        $t = $this->MD_Travaux_Client->listTravaux();
        for ($j=0; $j < count($t); $j++) { 
            for ($i=0; $i < count($t); $i++) { 
                    # code...
                }
        }
        return;
    }
}
?>