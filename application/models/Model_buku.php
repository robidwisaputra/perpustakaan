<?php 

class Model_buku extends CI_Model{
	public function getAllBuku(){
		return $this->db->get('buku')->result();
	}

	public function tambahBuku($nama_file){
		$data = [
			'id_buku' => $this->getKodeBuku(),
			'judul' => $this->input->post('judul', true),
			'pengarang' => $this->input->post('pengarang', true),
			'penerbit' => $this->input->post('penerbit', true),
			'jenis' => $this->input->post('jenis', true),
			'stok' => $this->input->post('stok', true),
			'gambar' => $nama_file
		];

		$this->db->insert('buku', $data);
	}

	public function ubahBuku(){
		$id = $this->input->post('id');
		$data = [
			'judul' => $this->input->post('judul', true),
			'pengarang' => $this->input->post('pengarang', true),
			'penerbit' => $this->input->post('penerbit', true),
			'jenis' => $this->input->post('jenis', true),
			'stok' => $this->input->post('stok', true),
		];

		$this->db->update('buku', $data, ['id_buku' => $id]);		
	}

	public function hapusBuku($id){
		$this->db->delete('buku', ['id_buku' => $id]);
	}

	public function getBukuById($id){
		return $this->db->get_where('buku', ['id_buku' => $id])->row();
	}

	public function getTotalBuku(){
		return $this->db->count_all_results('buku');
	}

	public function getKodeBuku(){

		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_buku, 4)),0)+1 digit FROM buku')->row_array();
		$kode = 'B' . sprintf('%04d', $no['digit']);
		return $kode;
	}
}