<?php 

class Login extends CI_Controller{

	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_login', 'login');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('page/login');
	}

	public function aksi_login(){
		$rules = [
        [
          'field' => 'username',
          'label' => 'Username',
          'rules' => 'required'
        ],
        [
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'required'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run() == false){
			$this->load->view('page/login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array(
				'username' => $username,
				'password' => md5($password)
				);
			$cek = $this->login->cek_login("t_users",$where)->num_rows();		
			if($cek > 0){
	 			$data_user = $this->login->getIdUser($username);
				$data_petugas = $this->login->getNamaPetugas($data_user->id_petugas);
				$data_session = array(
					'username' => $username,
					'id_user' => $data_user->id_user,
					'nama' => $data_petugas->nama_petugas,
					'hak_akses' => $data_user->hakakses,
					'status' => "login"
					);
	 
				$this->session->set_userdata($data_session);
	 
				redirect("page");
	 
			}else{
				if($this->input->post('username')){
					$this->session->set_flashdata('aksi', 'Username atau Password Salah!');
				}
				$this->load->view('page/login');
			}
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}