<?php 

$this->load->view('template/header');

if(!isset($_SESSION['client'])){
    $this->load->view('template/menu_admin');
}else{
    $this->load->view('template/menu');
}
if(!isset($_SESSION['client'])){
    $this->load->view('template/navbar_admin');
}else{
    $this->load->view('template/navbar');
}


$this->load->view('pages/'.$page,$data);

$this->load->view('template/footer');
?>