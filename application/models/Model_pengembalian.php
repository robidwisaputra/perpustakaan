<?php 

class Model_pengembalian extends CI_Model{
	
	public function tambahPengembalian(){
		$data = [
			'id_pengembalian' => $this->input->post('id_pengembalian'),
			'tgl_pengembalian' => $this->input->post('tanggalKembali'),
			'id_peminjaman' => $this->input->post('id_peminjaman'),
			'id_user' => $this->input->post('id_user'),
			'denda' => '0'
		];
		$this->db->insert('pengembalian', $data);

		$detail = [
			'id_det_pengembalian' => $this->getKodeDetPengembalian(),
			'id_pengembalian' => $this->input->post('id_pengembalian'),
			'id_buku' => $this->input->post('id_buku')
		];
		$this->db->insert('det_pengembalian', $detail);
	}

	public function getKodePengembalian(){
		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_pengembalian, 4)),0)+1 digit FROM pengembalian')->row_array();
		$kode = 'G' . sprintf('%06d', $no['digit']);
		return $kode;
	}

	public function getKodeDetPengembalian(){
		$no = $this->db->query('SELECT IFNULL(MAX(RIGHT(id_det_pengembalian, 4)),0)+1 digit FROM det_pengembalian')->row_array();
		$kode = 'M' . sprintf('%06d', $no['digit']);
		return $kode;
	}

	public function getAllPengembalian(){
		$this->db->select('anggota.nama_anggota, buku.judul, peminjaman.tgl_pinjam, pengembalian.tgl_pengembalian, petugas.nama_petugas');
		$this->db->from('peminjaman');
		$this->db->join('det_peminjaman', 'peminjaman.id_peminjaman = det_peminjaman.id_peminjaman');
		$this->db->join('pengembalian', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman');
		$this->db->join('det_pengembalian', 'pengembalian.id_pengembalian = det_pengembalian.id_pengembalian');
		$this->db->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota');
		$this->db->join('buku', 'det_peminjaman.id_buku = buku.id_buku');
		$this->db->join('t_users', 'peminjaman.id_user = t_users.id_user');
		$this->db->join('petugas', 't_users.id_petugas = petugas.id_petugas');

		return $this->db->get()->result();
	}
}