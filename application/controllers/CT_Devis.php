<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Devis extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Maison');
        $this->load->model('MD_Travaux_Client');
        $this->load->model('MD_Travaux_Client');
        $this->load->model('MD_Finition');
        $this->load->model('MD_Devis_Client');
        $this->load->model('MD_Devis');
        $this->load->model('MD_Paiement');
    }
    private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
    public function index(){
		$data['maison'] =  $this->MD_Maison->listAll();
        $data['finition'] =   $this->MD_Finition->listAll();
		$this->viewer('/v_add_devis',$data);
	}
    public function detail(){
        $resultats = $this->MD_Travaux_Client->listDetail_Devis($_GET['devis']);
        $data['resultats'] = $resultats;
        $this->viewer('/v_detail_devis',$data);
    }
    public function insert(){
        //echo $_POST['id'].' ---- '.$_POST['finition'].' ---- '.$_POST['dc'].' ---- '.$_POST['db'].' ---- '.$_SESSION['client'][0]['id_client'];
        $finition =  $this->MD_Finition->getOne($_POST['finition']);
        $maison = $this->MD_Maison->getOne($_POST['id']);  //echo 'J- '.$maison->duree;
        $dateF = $this->MD_Devis_Client->ajoutJours($_POST['db'], $maison->duree); //echo 'DATE  = '.$finition->pourcentage;
        $this->MD_Devis_Client->insert($_SESSION['client'][0]['id_client'],$_POST['id'],$_POST['finition'],$_POST['dc'],$_POST['db'],$dateF,$finition->pourcentage);
       

        $last = $this->MD_Devis_Client->getNewDevis_Client($_SESSION['client'][0]['id_client']);
        $sst = $this->MD_Devis->listSous_Travaux_Devis($_POST['id']);
        for ($i=0; $i < count($sst) ; $i++) { 
            //echo '<br> --- ' .$sst[$i]->id_sous_travaux.' &&& '.$sst[$i]->prix_unit.' ///// '.$sst[$i]->quantite;
            $this->MD_Travaux_Client->insert($last->id_devis_client,$sst[$i]->id_sous_travaux,$sst[$i]->prix_unit,$sst[$i]->quantite);
        }redirect('CT_Accueil');
    }
    public function pdf(){
        $this->load->library('Tableau');
        $header = array('num', 'travaux', 'unite', 'quantite', 'prix_unit', 'total');
        $resultats = $this->MD_Travaux_Client->listDetail_Devis($_GET['devis']);
        $pdf = new Tableau();
        $pdf->AddPage();
        $pdf->details($header,$resultats);
        $pdf->Output();
    }
    public function payer(){
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
        $data['devis'] = $_GET['devis'];
        $data['ttl'] = $_GET['ttl'];  $r = $this->MD_Paiement->getReste($_GET['devis']); $reste = $r->reste;
        $data['reste'] =  $data['ttl'] - $reste;
        $data['paiement'] =   $this->MD_Paiement->listPayer_Devis($_GET['devis']);
        $this->viewer('/v_payer',$data);
    }
}
?>