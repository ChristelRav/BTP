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
            $devis = floatval($_POST['devis']);
            // Convertissez $_POST['dp'] en un objet DateTime
            $date = new DateTime($_POST['dp']);
    
            // Vérifiez si le montant est supérieur au reste
            if($amount > $rest){
                // Renvoyez une réponse JSON indiquant l'erreur
                echo json_encode(['error' => 'Le montant ne peut pas être supérieur au reste.']);
                return;
            }
    
            // Traitez le paiement ici
            // Supposons que vous avez une méthode insert dans votre modèle MD_Paiement
            $this->MD_Paiement->insert('REP5467', $devis, $amount, $date->format('Y-m-d'));
        } else {
            // Renvoyez une réponse JSON indiquant que les données sont manquantes
            echo json_encode(['error' => 'Les données nécessaires sont manquantes.']);
        }
    }
    
}
?>