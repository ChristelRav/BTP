<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Accueil extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Devis_Client');
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
    public function index(){
        $user = $_SESSION['client'][0]['id_client'];
        $data['listDevis'] = $this->MD_Devis_Client->listDevis_Client_Ttl($user);
		$this->viewer('/v_accueil',$data);
	}
}
?>