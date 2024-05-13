<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Tableau extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Devis_Admin');
        $this->load->model('MD_Devis_Client');
    }
    private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
    public function index_admin(){
        $user = $_SESSION['admin'][0]['id_admin'];
        $data['listDevis'] = $this->MD_Devis_Client->listDevis_Admin_Ttl($user);
		$this->viewer('/v_accueil_admin',$data);
	}
    public function attente(){
        $user = $_SESSION['admin'][0]['id_admin'];
        $data['listDevis'] = $this->MD_Devis_Client->listDevis_attente();
		$this->viewer('/v_devis_attente',$data);
	}
    public function dashboard(){
        $actual = date("Y");
        $data['ttl'] = $this->MD_Devis_Admin->sumMontant_All_devis($_SESSION['admin'][0]['id_admin']);
        $data['dash'] = $this->MD_Devis_Admin->calculerDevis_Total_ParMois($actual,$_SESSION['admin'][0]['id_admin']);
        $this->viewer('/v_tableau_bord_admin',$data);
    }
    public function dash(){
        $data['ttl'] = $this->MD_Devis_Admin->sumMontant_All_devis($_SESSION['admin'][0]['id_admin']);
        $data['dash'] = $this->MD_Devis_Admin->calculerDevis_Total_ParMois($_POST['an'],$_SESSION['admin'][0]['id_admin']);
        $this->viewer('/v_tableau_bord_admin',$data);
    }
    public function update(){
        $this->MD_Devis_Client->update($_GET['devis'],3);
        $this->MD_Devis_Admin->insert($_GET['devis'], $_SESSION['admin'][0]['id_admin']);
        redirect('CT_Tableau/index_admin');
    }
}
?>