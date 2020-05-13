<?php 

class Model_anggota extends CI_Model{
	public function getAllAnggota(){
		return $this->db->get('anggota')->result();
	}

	public function tambahAnggota(){
		$data = [
			'id_anggota' => $this->getKodeAnggota(),
			'nama_anggota' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'telepon' => $this->input->post('telepon', true),
			'status_anggota' => $this->input->post('status', true),
		];

		$this->db->insert('anggota', $data);
	}

	public function ubahAnggota(){
		$id = $this->input->post('id');
		$data = [
			'nama_anggota' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'telepon' => $this->input->post('telepon', true),
			'status_anggota' => $this->input->post('status', true),
		];

		$this->db->update('anggota', $data, ['id_anggota' => $id]);		
	}

	public function hapusAnggota($id){
		$this->db->delete('anggota', ['id_anggota' => $id]);
	}

	public function getAnggotaById($id){
		return $this->db->get_where('anggota', ['id_anggota' => $id])->row();
	}

	public function getTotalAnggota(){
		return $this->db->count_all_results('anggota');
	}

	public function getKodeAnggota(){

		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_anggota, 4)),0)+1 digit FROM anggota')->row_array();
		$kode = 'A' . sprintf('%04d', $no['digit']);
		return $kode;
	}
}