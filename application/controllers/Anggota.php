<?php 

class Anggota extends CI_Controller{
	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_anggota', 'anggota');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['anggota'] = $this->anggota->getAllAnggota();
		$data['total'] = $this->anggota->getTotalAnggota();
		$this->load->view('templates/header');
		$this->load->view('anggota/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
		$data['anggota'] = null;

		// validation 
		$rules = [
        [
          'field' => 'nama',
          'label' => 'Nama Anggota',
          'rules' => 'required'
        ],
        [
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        [
          'field' => 'telepon',
          'label' => 'Nomor Telepon',
          'rules' => 'required|numeric'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run()){
			$this->anggota->tambahAnggota();
			$this->session->set_flashdata('aksi', 'ditambahkan');
			redirect('anggota');
		} else {
			$this->load->view('templates/header');
			$this->load->view('anggota/form', $data);
			$this->load->view('templates/footer');	
		}
	}

	public function ubah($id){
		$data['anggota'] = $this->anggota->getAnggotaById($id);

		// validation 
		$rules = [
        [
          'field' => 'nama',
          'label' => 'Nama Anggota',
          'rules' => 'required'
        ],
        [
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        [
          'field' => 'telepon',
          'label' => 'Nomor Telepon',
          'rules' => 'required|numeric'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run()){
			$this->anggota->ubahAnggota();
			$this->session->set_flashdata('aksi', 'diubah');
			redirect('anggota');
		} else {
			$this->load->view('templates/header');
			$this->load->view('anggota/form', $data);
			$this->load->view('templates/footer');	
		}
	}

	public function hapus($id){
		$this->anggota->hapusAnggota($id);
		$this->session->set_flashdata('aksi', 'dihapus');
		redirect('anggota');
	}
}