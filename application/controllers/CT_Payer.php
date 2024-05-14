<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Payer extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Paiement');
        $this->load->model('MD_Travaux_Client');
    }
    private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
    public function payer(){
        // Assurez-vous que les données sont valides
        if(isset($_POST['amount']) && isset($_POST['reste']) && isset($_POST['devis']) && isset($_POST['dp'])){
            $amount = floatval($_POST['amount']);
            $rest = floatval($_POST['reste']);
            $ttl = floatval($_POST['ttl']);
            $devis = floatval($_POST['devis']);
            $date = new DateTime($_POST['dp']);
            if($amount > $rest){
                echo json_encode(['error' => 'Le montant ne peut pas être supérieur au reste.']);
                return; // Arrête l'exécution du script
            } else{
                $this->MD_Paiement->insert('REP5467', $devis, $amount, $date->format('Y-m-d'));
                echo json_encode(['error' => 'Paiement enregistré.']);
                return;
            }
                
        } else {
            echo json_encode(['error' => 'Les données nécessaires sont manquantes.']);
            exit; // Arrête l'exécution du script
        }
    }
                                    
}
?>