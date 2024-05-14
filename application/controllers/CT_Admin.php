<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Admin extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Admin');
    }
    public function index(){
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
        $this->load->view('pages/v_login_admin',$data);
    }
    public function login(){
        $email = $this->input->post('mail');
        $mdp = $this->input->post('pass');
        $admin = $this->MD_Admin->verify($email, $mdp);
        if ($admin){
            $this->session->set_userdata('admin', $admin);
            redirect('CT_Tableau/dashboard');
            return;
        }
        else{
            $data['error'] = 'Email ou mot de passe invalide';
        }
        redirect('CT_Admin/index?error=' . urlencode($data['error']));
    }
    public function deconnect()	{
        $this->session->unset_userdata('admin');
        redirect('CT_Admin/');
    }
}
?>