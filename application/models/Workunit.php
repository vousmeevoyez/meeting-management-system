<?php
Class Workunit extends CI_Model {
	
	function lists() {
		$this->db->select('unit_kerja_id, name, status');
		$this->db->from('mtg_mst_unit_kerja');		
		$this->db->where('is_delete = 0');

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function listsForAdmin() {
		$this->db->select('unit_kerja_id, name, status');
		$this->db->from('mtg_mst_unit_kerja');
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function findById($id) {
		$this->db->select('*');
		$this->db->from('mtg_mst_unit_kerja');
		$this->db->where('unit_kerja_id = ' . "'" . $id . "'");

		$query = $this->db->get();
		return $query->result_array();
	}

	function findByName($name) {
		$this->db->select('*');
		$this->db->from('mtg_mst_unit_kerja');
		$this->db->where('name = ' . "'" . $name . "'");

		$query = $this->db->get();
		return $query->result();
	}
	
	function add($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_mst_unit_kerja', $data);
	}
	
	function update($id, $data) {
		$this->db->where('unit_kerja_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_mst_unit_kerja', $data);
	}
}
?>