<?php
Class Event extends CI_Model {
	
	function lists() {
		$this->db->select('event_id, name, start_date, end_date, place, speaker, host');
		$this->db->from('mtg_event');
		$this->db->where('is_delete = 0'); 
		$this->db->where('status = 1');
		
		$query = $this -> db -> get();
		return $query->result();
	}

	function listsMobile($app_id) {
		$this->db->select('a.event_id, a.name, a.start_date, a.end_date, a.place, a.speaker, a.host');
		$this->db->from('mtg_event a, mtg_absent b');
		$this->db->where('a.is_delete = 0'); 
		$this->db->where('a.status = 1');
		$this->db->where('a.event_id = b.event_id');
		$this->db->where('b.app_id = ' . "'" . $app_id . "'");
		$this->db->group_by('a.event_id');
		
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function listsForAdmin() {
		$this->db->select('*');
		$this->db->from('mtg_event');
		$this->db->where('is_delete = 0');		
		$query = $this->db->get();
		return $query->result();
	}
	
	function findById($event_id) {
		$this->db->select('event_id, name, start_date, end_date, place, speaker, host, qrcode_total');
		$this->db->from('mtg_event');
		$this->db->where('event_id = ' . "'" . $event_id . "'");

		$query = $this -> db -> get();
		return $query->result();
	}

	function findAdminById($event_id) {
		$this->db->select('*');
		$this->db->from('mtg_event');
		$this->db->where('event_id = ' . "'" . $event_id . "'");

		$query = $this -> db -> get();
		return $query->result_array();
	}

	function findMobileById($app_id, $event_id) {
		$this->db->select('a.event_id, a.name, a.start_date, a.end_date, a.place, a.speaker, a.host');
		$this->db->from('mtg_event a, mtg_absent b');		
		$this->db->where('b.app_id = ' . "'" . $app_id . "'");
		$this->db->where('a.event_id = ' . "'" . $event_id . "'");
		$this->db->group_by('b.app_id');

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function add($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_event', $data);
	}
	
	function update($id, $data) {
		$this->db->where('event_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_event', $data);
	}
}
?>