<?php
Class Jabatan extends CI_Model {
	
	function lists() {
		$this->db->select('jabatan_id, name, status');
		$this->db->from('mtg_mst_jabatan');
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function listsForAdmin() {
		$this->db->select('jabatan_id, name, status');
		$this->db->from('mtg_mst_jabatan');
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function findById($id) {
		$this->db->select('*');
		$this->db->from('mtg_mst_jabatan');
		$this->db->where('jabatan_id = ' . "'" . $id . "'");

		$query = $this -> db -> get();
		return $query->result_array();
	}

	function findByName($name) {
		$this->db->select('*');
		$this->db->from('mtg_mst_jabatan');
		$this->db->where('name = ' . "'" . $name . "'");

		$query = $this->db->get();
		return $query->result();
	}
	
	function add($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_mst_jabatan', $data);
	}
	
	function update($id, $data) {
		$this->db->where('jabatan_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_mst_jabatan', $data);
	}
}
?>