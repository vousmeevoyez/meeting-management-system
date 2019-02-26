<?php
Class Role extends CI_Model {
	
	function lists() {
		$this->db->select('role_id, name');
		$this->db->from('mtg_admin_role');
		$this->db->where('status = 1');
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function listsForAdmin() {
		$this->db->select('role_id, name, status');
		$this->db->from('mtg_admin_role');
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function findById($id) {
		$this->db->select('*');
		$this->db->from('mtg_admin_role');
		$this->db->where('role_id = ' . "'" . $id . "'");

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function add($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_admin_role', $data);
	}
	
	function update($id, $data) {
		$this->db->where('role_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_admin_role', $data);
	}
}
?>