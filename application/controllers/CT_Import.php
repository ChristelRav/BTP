<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Import extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Csv');
        $this->load->model('MD_Devis_Client');
        $this->load->model('MD_Temp');
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
        $data=array();
		$this->viewer('/v_import',$data);
	}
    public function import1(){
        if (isset($_FILES['csv_file']['name']) && $_FILES['csv_file']['name'] != '') {
            $path = $_FILES['csv_file']['tmp_name'];
            $file = fopen($path, 'r');
            $csv_data = [];
            $first_line = true; // Variable de contrôle pour la première ligne
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                if ($first_line) {
                    $first_line = false;
                    continue; // Ignorer la première ligne
                }
                $csv_data[] = $line;
                echo '<br>';
                $this->MD_Temp->insert3($line[0],$line[1],$line[2],$line[3]);
            }
            fclose($file);
            $this->MD_Temp->insert_paiement();
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
            redirect('csv');
        }
    }    
    public function import2(){
        if (isset($_FILES['csv_file1']['name']) && $_FILES['csv_file1']['name'] != '' || isset($_FILES['csv_file2']['name']) && $_FILES['csv_file2']['name'] != '' ) {
            $path = $_FILES['csv_file1']['tmp_name'];    $p = $_FILES['csv_file2']['tmp_name'];
            $file = fopen($path, 'r');   $f= fopen($p, 'r');
            $csv_data = [];    $csv_dt = [];
            $first_line = true;    $first_l = true; 
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                if ($first_line) {
                    $first_line = false;
                    continue; // Ignorer la première ligne
                }
                $csv_data[] = $line;
                echo $line[0].'<br>';
                $this->MD_Temp->insert1($line[0],$line[1],$line[2],$line[3],$line[4],$line[5],$line[6],$line[7],$line[8]);
            }
            //TEMP1
            $this->MD_Temp->insert_maison_travaux();
            $this->MD_Temp->insert_maison_travaux2();
            $this->MD_Temp->insert_maison_travaux3();
            while (($line = fgetcsv($f, 1000, ',')) !== FALSE) {
                if ($first_l) {
                    $first_l = false;
                    continue; // Ignorer la première ligne
                }
                $csv_dt[] = $line;
                echo $line[0].'<br>';
                $val = $this->MD_Csv->removePercentage($line[4]);
                $this->MD_Temp->insert2($line[0],$line[1],$line[2],$line[3],$val,$line[5],$line[6],$line[7]);
            }
            //TEMP2
            $this->MD_Temp->insert_devis();
            $this->MD_Temp->insert_devis2();
            $this->MD_Temp->insert_devis3();
            fclose($file);
            
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
            redirect('csv');
        }
    }
}
?>