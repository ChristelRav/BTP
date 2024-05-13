<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Devis extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Maison');
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
		$data['maison'] =  $this->MD_Maison->listAll();
		$this->viewer('/v_add_devis',$data);
	}
    public function detail(){
        $resultats = $this->MD_Travaux_Client->listDetail_Devis($_GET['devis']);
        $data['resultats'] = $resultats;
        $this->viewer('/v_detail_devis',$data);
    }
    

}
?>