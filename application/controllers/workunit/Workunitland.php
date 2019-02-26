<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Workunitland extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('role','',TRUE);
		}
		
		public function reindex($info) {
			if ($info != "") {
				$data['info'] = $info;
			} else {
				$data['info'] = "";		
			}

			$session_data = $this->session->userdata('logged_in');
			$session_data_role = $this->session->userdata('role_data');
			$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
			$data['admin_role_name'] = $session_data_role['admin_role_name'];
			$data['admin_role_id'] = $session_data_role['admin_role_id'];
			$data['info'] = $info;				
			 
			$lists = $this->workunit->lists();
			$data['lists'] = $lists;

			$data['active'] = "workunit";
			$this->load->view('layout/header', $data);
			$this->load->view('workunit/workunitPage', $data);
			$this->load->view('layout/footer');		   
		}

		public function index() {
			if($this->session->userdata('logged_in')) {
				$this->reindex("");
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function add() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];
				 
				$data['active'] = "workunit";
				$this->load->view('layout/header', $data);
				$this->load->view('workunit/workunitAdd', $data);
				$this->load->view('layout/footer');
		   } else {
				redirect('login', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleData'] = $this->workunit->findById($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];
				
				$data['active'] = "workunit";
				$this->load->view('layout/header', $data);
				$this->load->view('workunit/workunitEdit', $data);
				$this->load->view('layout/footer');
		   } else {
				redirect('login', 'refresh');
		   }
		}		
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];
					
					$data['active'] = "workunit";
					$this->load->view('layout/header', $data);
					$this->load->view('workunit/workunitAdd', $data);
					$this->load->view('layout/footer');
					
				} else {
					$name = $this->input->post('name');
					$status = $this->input->post('status');
					
					$result = $this->workunit->findByName($name);

					if (empty($result)) {
						$session_data = $this->session->userdata('logged_in');
						$dataInsert = array(
							'name' => $name,
							'status' => $status,
							'created_by' => $session_data['user_id']
						);
						$this->workunit->add($dataInsert);

						$this->reindex("Success Add Data");
					} else {
						$this->reindex("Data Already Exist");
					}					
				}
			} else {
				redirect('login', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$id = $this->session->userdata('user_id_update');
					
					$data['singleRole'] = $this->workunit->findRoleById($id);
					
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];
					
					$data['active'] = "workunit";
					$this->load->view('layout/header', $data);
					$this->load->view('workunit/workunitEdit', $data);
					$this->load->view('layout/footer');
					
				} else {
					$name = $this->input->post('name');
					$status = $this->input->post('status');					
					
					$id = $this->session->userdata('user_id_update');
					$session_data = $this->session->userdata('logged_in');
						
					$dataUpdate = array(
						'name' => $name,
						'status' => $status,
						'modified_by' => $session_data['user_id']
					);
					$this->workunit->update($id, $dataUpdate);

					$this->reindex("Success Edit Data");
				}
			} else {
				redirect('login', 'refresh');
			}
		}

		public function doDelete() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id = $this->uri->segment(4);
				$res = $this->workunit->findById($id);
				foreach($res as $rows) {
					$dataUpdateUser = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->workunit->update($id, $dataUpdateUser);
				}
				redirect('workunit/workunitland', 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}
		
		public function check_status($status) {
			if ($status == -1) {
				$this->form_validation->set_message('check_status', 'Silahkan Pilih Status');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
?>