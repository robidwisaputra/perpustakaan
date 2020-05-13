<?php 

class Model_Peminjaman extends CI_Model{
	
	public function tambahPeminjaman(){
		$data = [
			'id_peminjaman' => $this->input->post('id_peminjaman'),
			'tgl_pinjam' => date('d - F - Y'),
			'id_user' => $this->input->post('id_user'),
			'id_anggota' => $this->input->post('id_anggota', true)
		];
		$this->db->insert('peminjaman', $data);

		$detail = [
			'id_det_peminjaman' => $this->getKodeDetPeminjaman(),
			'id_peminjaman' => $this->input->post('id_peminjaman'),
			'id_buku' => $this->input->post('id_buku', true),
			'status_pinjam' => '0'
		];
		$this->db->insert('det_peminjaman', $detail);
	}

	public function getKodePeminjaman(){
		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_peminjaman, 4)),0)+1 digit FROM peminjaman')->row_array();
		$kode = 'P' . sprintf('%06d', $no['digit']);
		return $kode;
	}

	public function getKodeDetPeminjaman(){
		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_det_peminjaman, 4)),0)+1 digit FROM det_peminjaman')->row_array();
		$kode = 'J' . sprintf('%06d', $no['digit']);
		return $kode;
	}

	public function getPeminjamanById($id){
		$data['peminjaman'] = $this->db->get_where('peminjaman', ['id_anggota' => $id])->row_array();
		$data['detail'] = $this->db->get_where('det_peminjaman', ['id_peminjaman' => $data['peminjaman']['id_peminjaman']])->row_array();
		$data['buku'] = $this->db->get_where('buku', ['id_buku' => $data['detail']['id_buku']])->row_array();
		return $data;


	}

	public function getAllPeminjaman(){
		$this->db->select('anggota.nama_anggota, buku.judul, peminjaman.tgl_pinjam, petugas.nama_petugas');
		$this->db->from('peminjaman');
		$this->db->join('det_peminjaman', 'peminjaman.id_peminjaman = det_peminjaman.id_peminjaman');
		$this->db->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota');
		$this->db->join('buku', 'det_peminjaman.id_buku = buku.id_buku');
		$this->db->join('t_users', 'peminjaman.id_user = t_users.id_user');
		$this->db->join('petugas', 't_users.id_petugas = petugas.id_petugas');

		return $this->db->get()->result();
	}
}