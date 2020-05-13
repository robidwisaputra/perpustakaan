<?php 

class Model_login extends CI_Model{
	public function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	public function getIdUser($username){
		return $this->db->get_where('t_users', ['username' => $username])->row();
	}

	public function getNamaPetugas($id_petugas){
		return $this->db->get_where('petugas', ['id_petugas' => $id_petugas])->row();
	}
}