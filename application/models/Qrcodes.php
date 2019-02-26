<?php
Class Qrcodes extends CI_Model {
	
	function lists() {
		$this->db->select('a.*, b.name as event_name');
		$this->db->from('mtg_event_qrcode a, mtg_event b');
		$this->db->where('a.event_id = b.event_id');
		$this->db->where('a.is_delete = 0'); 
		$this->db->where('a.status = 1');
		
		$query = $this -> db -> get();
		return $query->result();
	}

	function listsMobile($app_id) {
		$this->db->select('a.event_id, a.name, a.date, a.place, a.speaker, a.host');
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
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function findById($qrcode_id) {
		$this->db->select('a.*, b.*');
		$this->db->from('mtg_event_qrcode a, mtg_event b');
		$this->db->where('a.event_id = b.event_id');
		$this->db->where('a.qrcode_id = ' . "'" . $qrcode_id . "'");

		$query = $this -> db -> get();
		return $query->result_array();
	}

	function findByEventId($event_id) {
		$this->db->select('a.*, b.start_date, b.end_date,b.name as event_name');
		$this->db->from('mtg_event_qrcode a, mtg_event b');
		$this->db->where('a.event_id = b.event_id');
		$this->db->where('a.event_id = ' . "'" . $event_id . "'");

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
		$this->db->select('a.event_id, a.name, a.date, a.place, a.speaker, a.host');
		$this->db->from('mtg_event a, mtg_absent b');		
		$this->db->where('b.app_id = ' . "'" . $app_id . "'");
		$this->db->where('a.event_id = ' . "'" . $event_id . "'");
		$this->db->group_by('b.app_id');

		$query = $this -> db -> get();
		return $query->result();
	}

	function findByNumber($package_id, $number) {
		$this->db->select('*');
		$this->db->from('el_mg_vouchers');
		$this->db->where('package_id = ' . "'" . $package_id . "'");
		$this->db->where('number = ' . "'" . $number . "'");
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result_array();
	}

	function findByOnlyNumber($number) {
		$this->db->select('a.*, b.cl_id, b.mgs_id, b.based_on_id, b.name, b.description, b.duration, b.duration_type, c.name as name_jenis_paket');
		$this->db->from('el_mg_vouchers a, el_mg_packages b, el_master_package_based_on c');
		$this->db->where('a.package_id = b.package_id');
		$this->db->where('b.based_on_id = c.based_on_id');
		$this->db->where('a.number = ' . "'" . $number . "'");
		$this->db->where('a.is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result_array();
	}

	function findByPackageId($package_id) {
		$this->db->select('*');
		$this->db->from('el_mg_vouchers');
		$this->db->where('package_id = ' . "'" . $package_id . "'");
		$this->db->where('is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result_array();
	}
	
	function add($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_event_qrcode', $data);
	}
	
	function update($id, $data) {
		$this->db->where('qrcode_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_event_qrcode', $data);
	}
}
?>