<?php 

class Model_petugas extends CI_Model{
	public function getAllPetugas(){
		return $this->db->get('petugas')->result();
	}

	public function tambahPetugas(){
		$data = [
			'id_petugas' => $this->getKodePetugas(),
			'nama_petugas' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'telepon' => $this->input->post('telepon', true),
		
		];

		$this->db->insert('petugas', $data);
	}

	public function ubahPetugas(){
		$id = $this->input->post('id');
		$data = [
			'nama_petugas' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'telepon' => $this->input->post('telepon', true),
		
		];

		$this->db->update('petugas', $data, ['id_petugas' => $id]);		
	}

	public function hapusPetugas($id){
		$this->db->delete('petugas', ['id_petugas' => $id]);
	}

	public function getPetugasById($id){
		return $this->db->get_where('petugas', ['id_petugas' => $id])->row();
	}

	public function getTotalPetugas(){
		return $this->db->count_all_results('petugas');
	}

	public function getKodePetugas(){

		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_petugas, 4)),0)+1 digit FROM petugas')->row_array();
		$kode = 'T' . sprintf('%04d', $no['digit']);
		return $kode;
	}
}