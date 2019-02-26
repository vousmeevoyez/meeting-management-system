<?php
Class Absent extends CI_Model {
	
	function lists() {
		$this->db->select('app_id, event_id, section');
		$this->db->from('mtg_absent');
		$this->db->where('is_delete = 0'); 
		$this->db->where('status = 1');
		
		$query = $this -> db -> get();
		return $query->result();
	}

	function findById($absent_id) {
		$this->db->select('app_id, event_id, section');
		$this->db->from('mtg_absent');
		$this->db->where('absent_id = ' . "'" . $absent_id . "'");		

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function findByIds($app_id, $event_id, $section) {
		$this->db->select('app_id, event_id, section');
		$this->db->from('mtg_absent');
		$this->db->where('app_id = ' . "'" . $app_id . "'");
		$this->db->where('event_id = ' . "'" . $event_id . "'");
		$this->db->where('section = ' . "'" . $section . "'");

		$query = $this -> db -> get();
		return $query->result();
	}

	function findByIds2($event_id, $section) {
		$this->db->select('c.fullname, b.name, a.absent_id, a.section, a.created_date, a.is_absent, d.name as jabatan_name, e.name as unit_kerja_name');
		$this->db->from('mtg_absent a, mtg_event b, mtg_app_user c, mtg_mst_jabatan d, mtg_mst_unit_kerja e');
		$this->db->where('a.event_id = b.event_id AND a.app_id = c.app_id');
		$this->db->where('c.jabatan_id = d.jabatan_id AND c.unit_kerja_id = e.unit_kerja_id');
		$this->db->where('a.event_id = ' . "'" . $event_id . "'");
		$this->db->where('a.section = ' . "'" . $section . "'");
		$this->db->order_by('c.app_id', 'ASC');

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
		return $this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_absent', $data);
	}
	
	function update($id, $data) {
		$this->db->where('absent_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_absent', $data);
	}

	function delete($id) {
		$this->db->where('absent_id', $id);
		$this->db->delete('mtg_absent');
	}
}
?>