<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Finition extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Finition');
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
        $data['finition'] = $this->MD_Finition->list();
		$this->viewer('/v_finition',$data);
	}
    public function updateF(){
        $this->MD_Finition->update($_POST['id'],$_POST['type'],$_POST['cent']);
        redirect('CT_Finition/');
    }
}
?>