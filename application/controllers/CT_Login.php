<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Login extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
        $this->load->view('pages/v_login',$data);
    }
    public function subscribe(){
        $this->load->view('pages/v_inscription');
    }
    public function deconnect()	{
        if($_SESSION['user'] !== null){
            $this->session->unset_userdata('admin');
        }elseif ($_SESSION['admin'] !== null){
            $this->session->unset_userdata('admin');
        }
        redirect('CT_Login/');
    }
}
?>