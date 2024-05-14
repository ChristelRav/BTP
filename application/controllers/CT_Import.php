<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Import extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Csv');
        $this->load->model('MD_Devis_Client');
        $this->load->model('MD_Devis_Admin');
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
            $csv_data = []; $som = [];
            $first_line = true; // Variable de contrôle pour la première ligne
            $line_number = 0;
            $aggregated_data = [];
            $negative_amount_lines = [];
            $invalid_date_lines = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                $line_number++;
                if ($first_line) {
                    $first_line = false;
                    continue; // Ignorer la première ligne
                }
                if (!$this->MD_Csv->is_positive($line[3])) {$negative_amount_lines[] = $line_number;}
                if (!$this->MD_Csv->is_valid_date($line[2])) {$invalid_date_lines[] = $line_number;}
                $csv_data[] = $line;
                //$this->MD_Temp->insert3($line[0],$line[1],$line[2],$line[3]);
            }
            
            fclose($file);
            if(!empty($negative_amount_lines) || !empty($invalid_date_lines)){
                $data['int'] = $negative_amount_lines;
                $data['date'] = $invalid_date_lines;
                $this->viewer('/v_import',$data);
                }else{
                    foreach ($csv_data as $line) {
                        $ref_devis = $line[0];
                        $montant = is_numeric($line[3]) ? (float)$line[3] : 0;
        
                        if (!isset($aggregated_data[$ref_devis])) {
                            $aggregated_data[$ref_devis] = 0;
                        }
                        $aggregated_data[$ref_devis] += $montant;
                        //$this->MD_Temp->insert3($line[0], $line[1], $line[2], $line[3]);
                    }
                    echo '<br>';
                    foreach ($aggregated_data as $ref_devis => $total) {
                        
                        $ttl = $this->MD_Devis_Admin->sumMontant($ref_devis);
                        echo  $ttl->ttl." ---- La somme des montants pour ref_devis $ref_devis est $total.<br>";
                        $diff = $ttl->ttl -  $total;
                        if($diff<0){
                            $data['erreur'] ='paiement invalide';
                            $this->viewer('/v_import',$data);
                        }else{
                            foreach ($csv_data as $line) {
                                $this->MD_Temp->insert3($line[0], $line[1], $line[2], $line[3]);
                            }
                            $this->MD_Temp->insert_paiement();
                            $this->viewer('/v_import',array());
                        }
                    }
                    
                    //
                }
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
            //errorf1
            $line_number = 0;
            $negative_amount_lines = []; $invalid_duree =  [];
            $invalid_surface = [];  $invalid_qtt = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                $line_number++;
                if ($first_line) {
                    $first_line = false;
                    continue; // Ignorer la première ligne
                }
                if (!$this->MD_Csv->is_positive($line[6])) {$negative_amount_lines[] = $line_number;  echo $line[6].'<br>'     ;}
                if (!$this->MD_Csv->is_positive($line[7])) {$invalid_qtt[] = $line_number; echo $line[7].'<br>';}
                if (!$this->MD_Csv->is_positive($line[2])) {$invalid_surface[] = $line_number;  echo '////'.$line[2].'<br>'; }
                if ($this->MD_Csv->is_decimal( str_replace(',', '.', $line[8]))) {$invalid_duree[] = $line_number;  echo $line[8].'<br>';}
                
                $csv_data[] = $line;   
               
              }
            if(!empty($negative_amount_lines) || !empty($invalid_surface) || !empty($invalid_qtt) || !empty($invalid_duree)){
                $data['err'] = $negative_amount_lines;   $data['err1'] = $invalid_surface;
                $data['err2'] = $invalid_qtt;         $data['err3'] = $invalid_duree;
               $this->viewer('/v_import',$data);
            }else{
                foreach ($csv_data as $line) {
                    $this->MD_Temp->insert1($line[0],$line[1],$line[2],$line[3],$line[4],$line[5],$line[6],$line[7],$line[8]);
                }
                //TEMP1
                $this->MD_Temp->insert_maison_travaux();
                $this->MD_Temp->insert_maison_travaux2();
                $this->MD_Temp->insert_maison_travaux3();
                $this->viewer('/v_import',array());
            }
            $negative_cent = []; $invalid_dt1 =  [];
            $invalid_dt2 = [];  $ln = 0;
            while (($line = fgetcsv($f, 1000, ',')) !== FALSE) {
                $ln++;
                if ($first_l) {
                    $first_l = false;
                    continue; // Ignorer la première ligne
                }
                if (!$this->MD_Csv->is_positive($this->MD_Csv->removePercentage($line[4]))) {$negative_cent[] = $ln; echo $line[4].'<br>';}
                if (!$this->MD_Csv->is_valid_date($line[5])) {$invalid_dt1[] = $ln; echo $line[5].'<br>';}
                if (!$this->MD_Csv->is_valid_date($line[6])) {$invalid_dt2[] = $ln; echo $line[6].'<br>';}
                $csv_dt[] = $line;
               // echo $line[5].'<br>';
            }
            if(!empty($negative_cent) || !empty($invalid_dt1) || !empty($invalid_dt2) ){
                $data['e'] = $negative_cent;   $data['e1'] = $invalid_dt1;
                $data['e2'] = $invalid_dt2; 
                //echo implode(', ', $negative_cent).' --  ' ;
                $this->viewer('/v_import',$data);
            }else{
                foreach ($csv_dt as $line) {
                    $val = $this->MD_Csv->removePercentage($line[4]);
                    echo $val;
                    $this->MD_Temp->insert2($line[0],$line[1],$line[2],$line[3],$val,$line[5],$line[6],$line[7]);
                }
                //TEMP2
                $this->MD_Temp->insert_devis();
                $this->MD_Temp->insert_devis2();
                $this->MD_Temp->insert_devis3();
                $this->viewer('/v_import',array());
            }
            fclose($file);
            
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
            redirect('csv');
        }
    }
}
?>