<?php 

class Pengembalian extends CI_Controller{
	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_pengembalian', 'pengembalian');
		$this->load->model('Model_peminjaman', 'peminjaman');
		$this->load->model('Model_buku', 'buku');
		$this->load->model('Model_anggota', 'anggota');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['id_pengembalian'] = $this->pengembalian->getKodePengembalian();
		$data['anggota'] = $this->anggota->getAllAnggota();
		$data['tanggal'] = date('d - F - Y');
		$this->load->view('templates/header');
		$this->load->view('pengembalian/index', $data);
		$this->load->view('templates/footer');
	}

	public function getPeminjaman(){
		echo json_encode($this->peminjaman->getPeminjamanById($this->input->post('id')));
	}

	public function tambah(){
		$rules = [
        [
          'field' => 'nama_anggota',
          'label' => 'Nama Anggota',
          'rules' => 'required'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run()){
			$this->pengembalian->tambahPengembalian();
			$this->session->set_flashdata('aksi', 'disimpan');
			redirect('pengembalian');
		} else {
			$this->index();
		}

	}

	public function denda(){
		$tanggalPinjam = strtotime($this->input->post('tanggalPinjam'));
    $tanggalKembali = date('d - F - Y', strtotime('+1 week', $tanggalPinjam));
    $hariKembali = explode(' ', $tanggalKembali);
    $hariKembali = $hariKembali[0];
    if(date('d - F - Y') > $tanggalKembali){
    	if(date('d') > $hariKembali){
    		$hari = date('d') - $hariKembali;
    		$denda = 1000 * $hari;
    	} else {
    		
    	}
    }

    return $denda;
	}
}