<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Client extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Client');
    }
    public function index(){
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
        $this->load->view('pages/v_login_client');
    }
    public function login(){
        $contact = $this->input->post('contact');
        $client = $this->MD_Client->verify($contact);
        if ($client){
            echo 'efa misy = '.$client[0]['id_client'];
            $this->session->set_userdata('client', $client);
        }
        else{
           $this->MD_Client->insert($contact);
        }
        redirect('CT_Accueil');
    }
    public function deconnect()	{
        $this->session->unset_userdata('client');
        redirect('CT_Client/');
    }
}
?>