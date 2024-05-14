<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Travaux extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Sous_Travaux');
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
        $user = $_SESSION['admin'][0]['id_admin'];
        $data['travaux'] = $this->MD_Sous_Travaux->list();
		$this->viewer('/v_travaux',$data);
	}
    public function updateT(){
        $this->MD_Sous_Travaux->update($_POST['id'],$_POST['num'],$_POST['travaux'],$_POST['unite'],$_POST['prix']);
        redirect('CT_Travaux/');
    }
}
?>