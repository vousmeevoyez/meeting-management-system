<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Adminuser extends MY_Controller {
		function __construct() {
			parent::__construct();
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
				 
			$listAdminUser = $this->user->listAdminUser();
			$data['listAdminUser'] = $listAdminUser;

			/*$notif = $this->notifMessages();
			$data['notif'] = $notif;*/

			$data['active'] = "adminuser";
			$this->load->view('layout/header', $data);
			$this->load->view('adminuser/adminuserPage', $data);
			$this->load->view('layout/footer', $data);
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
				
				$listsRole = $this->role->lists();
				$data['listsRole'] = $listsRole;

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "adminuser";
				$this->load->view('layout/header', $data);
				$this->load->view('adminuser/adminuserAdd', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleUser'] = $this->user->findAdminUserById($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];
				
				$listsRole = $this->role->lists();
				$data['listsRole'] = $listsRole;

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "adminuser";
				$this->load->view('layout/header', $data);
				$this->load->view('adminuser/adminuserEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('role', 'Role', 'trim|required|callback_check_role');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];
					
					$listsRole = $this->role->lists();
					$data['listsRole'] = $listsRole;

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/
					
					$data['active'] = "adminuser";
					$this->load->view('layout/header', $data);
					$this->load->view('adminuser/adminuserAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$session_data = $this->session->userdata('logged_in');
					$dataInsertUser = array(
						'role_id' => $this->input->post('role'),
						'username' => $this->input->post('username'),
						'fullname' => $this->input->post('fullname'),
						'email' => $this->input->post('email'),
						'password' => MD5($this->input->post('password')),
						'status' => $this->input->post('status'),
						'created_by' => $session_data['user_id']
					);
					$this->user->addAdminUser($dataInsertUser);
					
					$this->reindex("Success Add Data");
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				if ($this->input->post('password') != "") {
					$this->form_validation->set_rules('password', 'Password', 'trim|required');
				}
				$this->form_validation->set_rules('role', 'Role', 'trim|required|callback_check_role');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$id = $this->session->userdata('user_id_update');
					
					$data['singleUser'] = $this->user->findAdminUserById($id);
					
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];
					 
					$listsRole = $this->role->lists();
					$data['listsRole'] = $listsRole;

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/
					
					$data['active'] = "adminuser";
					$this->load->view('layout/header', $data);
					$this->load->view('adminuser/adminuserEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$id = $this->session->userdata('user_id_update');
					$session_data = $this->session->userdata('logged_in');
					$password = "";
					
					if ($this->input->post('password') != "") {
						$dataUpdateUser = array(
							'role_id' => $this->input->post('role'),
							'username' => $this->input->post('username'),
							'fullname' => $this->input->post('fullname'),
							'email' => $this->input->post('email'),
							'password' => MD5($this->input->post('password')),
							'status' => $this->input->post('status'),
							'modified_by' => $session_data['user_id']
						);
						$this->user->updateAdminUser($id, $dataUpdateUser);
					} else {
						$dataUpdateUser = array(
							'role_id' => $this->input->post('role'),
							'username' => $this->input->post('username'),
							'fullname' => $this->input->post('fullname'),
							'email' => $this->input->post('email'),
							'status' => $this->input->post('status'),
							'modified_by' => $session_data['user_id']
						);
						$this->user->updateAdminUser($id, $dataUpdateUser);
					}
					
					$this->reindex("Success Edit Data");
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doDelete() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id = $this->uri->segment(4);
				$res = $this->user->findAdminUserById($id);
				foreach($res as $rows) {
					$dataUpdateUser = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->user->updateAdminUser($id, $dataUpdateUser);
				}
				redirect('adminuser/adminuser', 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}
	}
?>