<?php 

class Petugas extends CI_Controller{
	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_petugas', 'petugas');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['petugas'] = $this->petugas->getAllPetugas();
		$data['total'] = $this->petugas->getTotalPetugas();
		$this->load->view('templates/header');
		$this->load->view('petugas/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
		$data['petugas'] = null;

		// validation 
		$rules = [
        [
          'field' => 'nama',
          'label' => 'Nama petugas',
          'rules' => 'required'
        ],
        [
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        [
          'field' => 'tgl_lahir',
          'label' => 'Tanggal lahir',
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
			$this->petugas->tambahPetugas();
			$this->session->set_flashdata('aksi', 'ditambahkan');
			redirect('petugas');
		} else {
			$this->load->view('templates/header');
			$this->load->view('petugas/form', $data);
			$this->load->view('templates/footer');	
		}
	}

	public function ubah($id){
		$data['petugas'] = $this->petugas->getPetugasById($id);

		// validation 
		$rules = [
        [
          'field' => 'nama',
          'label' => 'Nama petugas',
          'rules' => 'required'
        ],
        [
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        [
          'field' => 'tgl_lahir',
          'label' => 'Tanggal lahir',
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
			$this->petugas->ubahPetugas();
			$this->session->set_flashdata('aksi', 'diubah');
			redirect('petugas');
		} else {
			$this->load->view('templates/header');
			$this->load->view('petugas/form', $data);
			$this->load->view('templates/footer');	
		}
	}

	public function hapus($id){
		$this->petugas->hapusPetugas($id);
		$this->session->set_flashdata('aksi', 'dihapus');
		redirect('petugas');
	}
}