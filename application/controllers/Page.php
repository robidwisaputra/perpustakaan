<?php 

class Page extends CI_Controller{
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect("login");
		}
	}
	public function index(){
		if($this->session->userdata('hak_akses') == 'admin'){
			$this->load->view('templates/header');	
		}else{
			$this->load->view('templates/header_operator');
		}
		
		$this->load->view('page/home');
		$this->load->view('templates/footer');
	}
}