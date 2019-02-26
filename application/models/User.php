<?php
/*
	author : kelvin
*/
Class User extends CI_Model {
	
	function loginMobile($username, $password) {
		$this->db->select('a.app_id, a.username, a.fullname, b.name as jabatan_name');
		$this->db->from('mtg_app_user a, mtg_mst_jabatan b');
		$this->db->where('a.jabatan_id = b.jabatan_id');
		$this->db->where('a.username = ' . "'" . $username . "'"); 
		$this->db->where('a.password = ' . "'" . MD5($password) . "'"); 
		$this->db->where('a.status = 1');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$result = $query->result();

			//start update table mtg_app_user with is_login to 1
			$dataUpdate = array(
				'is_login' => 1
			);
			$this->db->where('app_id', $result[0]->app_id);
			$this->db->update('mtg_app_user', $dataUpdate);
			//end
			return $result;
		} else {
			return false;
		}
	}
	
	function loginAdmin($usermail, $password) {
		$this->db->select('user_id, username, fullname');
		$this->db->from('mtg_admin_user');
		$this->db->where('email = ' . "'" . $usermail . "'"); 
		$this->db->where('password = ' . "'" . MD5($password) . "'"); 
		$this->db->where('status = 1');
		$this->db->where('is_delete = 0');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function logout($id, $data) {
		$this->db->where('app_id', $id);
		return $this->db->update('mtg_app_user', $data);
	}
	
	function findMobileUserByUsername($username) {
		$this->db->select('*');
		$this->db->from('mtg_app_user');
		$this->db->where('username = ' . "'" . $username . "'");
		$this->db->where('is_delete = 0');

		$query = $this->db->get();
		return $query->result();
	}

	function findMobileUserByAppId($app_id) {
		$this->db->select('*');
		$this->db->from('mtg_app_user');
		$this->db->where('app_id = ' . "'" . $app_id . "'");

		$query = $this->db->get();
		return $query->result();
	}
	
	function findAdminUserByEmail($email) {
		$this->db->select('email');
		$this->db->from('mtg_admin_user');
		$this->db->where('email = ' . "'" . $email . "'");
		$this->db->where('is_delete = 0');

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function checkRole($usermail) {
		$this->db->select('a.fullname, b.name, b.role_id');
		$this->db->from('mtg_admin_user a, mtg_admin_role b');
		$this->db->where('a.role_id = b.role_id'); 
		$this->db->where('a.email = ' . "'" . $usermail . "'"); 
		$this->db->limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function listUser() {
		$this->db->select('a.*, b.name as jabatan_name, c.name as unit_kerja_name');
		$this->db->from('mtg_app_user a, mtg_mst_jabatan b, mtg_mst_unit_kerja c');
		$this->db->where('a.jabatan_id = b.jabatan_id AND a.unit_kerja_id = c.unit_kerja_id');
		$this->db->where('a.is_delete = 0');
		$this->db->order_by('a.app_id', 'ASC');

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function listAdminUser() {
		$this->db->select('a.*, b.name as role_name');
		$this->db->from('mtg_admin_user a, mtg_admin_role b');
		$this->db->where('a.role_id = b.role_id'); 
		$this->db->where('a.is_delete = 0');
		$this->db->order_by('a.user_id', 'ASC');

		$query = $this -> db -> get();
		return $query->result();
	}

	function listsAdminUserGuru() {
		$this->db->select('a.*, b.admin_role_name');
		$this->db->from('cmp_admin_user a, cmp_admin_role b');
		$this->db->where('a.admin_role_id = b.admin_role_id'); 
		$this->db->where('a.is_delete = 0'); 
		$this->db->where('a.is_teacher = 1');
		$this->db->order_by('a.created_date', 'ASC');

		$query = $this -> db -> get();
		return $query->result();
	}
	
	function findAdminUserById($id) {
		$this->db->select('a.*, b.name as role_name');
		$this->db->from('mtg_admin_user a, mtg_admin_role b');
		$this->db->where('a.role_id = b.role_id'); 
		$this->db->where('a.user_id = ' . "'" . $id . "'");
		$this->db->where('a.is_delete = 0'); 

		$query = $this -> db -> get();
		return $query->result_array();
	}
	
	function addAdminUser($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_admin_user', $data);
		return $this->db->insert_id();
	}
	
	function updateAdminUser($id, $data) {
		$this->db->where('user_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_admin_user', $data);
	}
	
	function addUser($data) {
		$this->db->set('created_date', 'NOW()', FALSE)->insert('mtg_app_user', $data);
		return $this->db->insert_id();
	}
	
	function updateUser($id, $data) {
		$this->db->where('app_id', $id);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_app_user', $data);
	}

	function updateUserByEmail($email, $data) {
		$this->db->where('email', $email);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_app_user', $data);
	}

	function findUserByUsername($username) {
		$this->db->select('*');
		$this->db->from('mtg_app_user');
		$this->db->where('username = ' . "'" . $username . "'");

		$query = $this -> db -> get();
		return $query->result();
	}

	function findUserById($app_id) {
		$this->db->select('*');
		$this->db->from('mtg_app_user');
		$this->db->where('app_id = ' . "'" . $app_id . "'");

		$query = $this->db->get();
		return $query->result_array();
	}
	
	function findUserByEmail($email) {
		$this->db->select('*');
		$this->db->from('mtg_app_user');
		$this->db->where('email = ' . "'" . $email . "'");

		$query = $this -> db -> get();
		return $query->result();
	}

	function findUserByUsernameEmailPassword($usernameemail,$password) {
		$data = $this->findUserByUsername($usernameemail);
		if (empty($data)) {
			$data2 = $this->findUserByEmail($usernameemail);
			if (empty($data2)) {
				return "false_useremail";
			} else {
				if ($data2[0]->is_delete == 1) {
					return "false_delete";
				} else if ($data2[0]->status == 0) {
					return "false_notactive";
				} else {
					if ($data2[0]->password == MD5($password)) {
						return $data2;
					} else {
						return "false_password";
					}
				}
			}
		} else {
			if ($data[0]->is_delete == 1) {
				return "false_delete";
			} else if ($data[0]->status == 0) {
				return "false_notactive";
			} else {
				if ($data[0]->password == MD5($password)) {
					return $data;
				} else {
					return "false_password";
				}
			}
		}
	}
	
	function addUserChat($data) {
		$this->db->insert('usertable', $data);
		return $this->db->insert_id();
	}
	
	function updateUserChat($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('usertable', $data);
	}

	function updateAdminUserByEmail($email, $data) {
		$this->db->where('email', $email);
		$this->db->set('modified_date', 'NOW()', FALSE)->update('mtg_admin_user', $data);
	}
}
?>