<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Devis_Admin extends CI_Model{
    public function getOne($id) {
        $this->db->where('id_devis_admin', $id);
        $query = $this->db->get('devis_admin'); 
        return $query->row(); 
    }
    public function insert($id_devis_client, $id_admin) {
        $sql = "insert into devis_admin (id_devis_client, id_admin) values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_devis_client),$this->db->escape($id_admin));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function sumMontant_All_devis($id) {
        $this->db->select("sum(ttl) as all_devis, sum(deja_payer) as effectue");
        $this->db->from('v_devis_admin'); 
        $query = $this->db->get(); 
        return $query->row(); 
    }
    public function sumMontant($id) {
        $this->db->select("ttl");
        $this->db->from('v_devis_admin'); 
        $this->db->where('ref_devis', $id);
        $query = $this->db->get(); 
        return $query->row(); 
    }
    public function calculerDevis_Total_ParMois($annee,$id) {
        $sql = "SELECT to_char(dates.month_date, 'Month') AS mois,COALESCE(SUM(vda.ttl), 0) AS montant_total
            FROM generate_series('".$annee."-01-01'::date,'". $annee."-12-31'::date, '1 month') AS dates(month_date)
            LEFT JOIN v_devis_admin vda ON vda.date_creation >= dates.month_date 
            AND vda.date_creation < dates.month_date + INTERVAL '1 month'
            AND EXTRACT(YEAR FROM vda.date_creation) = $annee
            GROUP BY dates.month_date
            ORDER BY dates.month_date;
            ";
        $query = $this->db->query($sql, array($annee));
        return $query->result();
    }


}
?>