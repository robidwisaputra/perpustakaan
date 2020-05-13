<?php 

class Peminjaman extends CI_Controller {

	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_Peminjaman', 'peminjaman');
		$this->load->model('Model_buku', 'buku');
		$this->load->model('Model_anggota', 'anggota');
		$this->load->library('form_validation');
	}


	public function index(){
		$data['buku'] = $this->buku->getAllBuku();
		$data['anggota'] = $this->anggota->getAllAnggota();
		$data['tanggal'] = date('d - F - Y');
		$data['tanggalKembali'] = date('d - F - Y', strtotime('+1 week'));
		$data['id_peminjaman'] = $this->peminjaman->getKodePeminjaman();
		$this->load->view('templates/header');
		$this->load->view('peminjaman/index', $data);
		$this->load->view('templates/footer');
	}

	public function pinjam(){
		// validation 
		$rules = [
        [
          'field' => 'nama_anggota',
          'label' => 'Nama Anggota',
          'rules' => 'required'
        ],
        [
          'field' => 'judul',
          'label' => 'Buku',
          'rules' => 'required'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run()){
			$this->peminjaman->tambahPeminjaman();
			$this->session->set_flashdata('aksi', 'disimpan');
			redirect('peminjaman');
		} else {
			$this->index();
		}
	}
}