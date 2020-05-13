<?php 

class Buku extends CI_Controller{
	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_buku', 'buku');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['buku'] = $this->buku->getAllBuku();
		$data['total'] = $this->buku->getTotalBuku();
		$this->load->view('templates/header');
		$this->load->view('buku/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
		$data['buku'] = null;

		// validation 
		$rules = [
        [
          'field' => 'judul',
          'label' => 'Judul',
          'rules' => 'required'
        ],
        [
          'field' => 'pengarang',
          'label' => 'Pengarang',
          'rules' => 'required'
        ],
        [
          'field' => 'penerbit',
          'label' => 'penerbit',
          'rules' => 'required'
        ],
        [
          'field' => 'stok',
          'label' => 'Stok',
          'rules' => 'required|numeric'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run()){
			$this->session->set_flashdata('aksi', 'ditambahkan');
			$nama_file = $this->upload();
			$this->buku->tambahBuku($nama_file);	
			redirect('buku');
		} else {
			$this->load->view('templates/header');
			$this->load->view('buku/form', $data);
			$this->load->view('templates/footer');	
		}
	}

	public function ubah($id){
		$data['buku'] = $this->buku->getBukuById($id);

		// validation 
		$rules = [
        [
          'field' => 'judul',
          'label' => 'Judul',
          'rules' => 'required'
        ],
        [
          'field' => 'pengarang',
          'label' => 'Pengarang',
          'rules' => 'required'
        ],
        [
          'field' => 'penerbit',
          'label' => 'penerbit',
          'rules' => 'required'
        ],
        [
          'field' => 'stok',
          'label' => 'Stok',
          'rules' => 'required|numeric'
        ]
		];
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

		if($this->form_validation->run()){
			$this->buku->ubahBuku();
			$this->session->set_flashdata('aksi', 'diubah');
			redirect('buku');
		} else {
			$this->load->view('templates/header');
			$this->load->view('buku/form', $data);
			$this->load->view('templates/footer');	
		}
	}

	public function hapus($id){
		$this->buku->hapusBuku($id);
		$this->session->set_flashdata('aksi', 'dihapus');
		redirect('buku');
	}

	public function upload(){
    $config['upload_path']          = './assets/gambar/';
    $config['allowed_types']        = 'jpg|jpeg';
    $config['max_size']             = 2048;
    $config['file_name']       	    = $this->input->post('judul') .'-' . $this->input->post('pengarang');
    $config['remove_spaces']				= false;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('gambar'))
    {
      $error = array('error' => $this->upload->display_errors());

      return 'default.jpg';
    }
    else
    {
      $this->upload->data();

      $this->index();

      return $config['file_name'] . '.jpg';
    }
	}
}