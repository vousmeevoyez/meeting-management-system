<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Memberuser extends MY_Controller {
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
				 
			$listAdminUser = $this->user->listUser();
			$data['listAdminUser'] = $listAdminUser;

			/*$notif = $this->notifMessages();
			$data['notif'] = $notif;*/

			$data['active'] = "memberuser";
			$this->load->view('layout/header', $data);
			$this->load->view('memberuser/memberuserPage', $data);
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
				
				$listsJabatan = $this->jabatan->lists();
				$data['listsJabatan'] = $listsJabatan;

				$listsWorkunit = $this->workunit->lists();
				$data['listsWorkunit'] = $listsWorkunit;
				
				/*$notif = $this->notifMessages();
			 	$data['notif'] = $notif;*/

				$data['active'] = "memberuser";
				$this->load->view('layout/header', $data);
				$this->load->view('memberuser/memberuserAdd', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleUser'] = $this->user->findUserById($id);

				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];
				
				$listsJabatan = $this->jabatan->lists();
				$data['listsJabatan'] = $listsJabatan;

				$listsWorkunit = $this->workunit->lists();
				$data['listsWorkunit'] = $listsWorkunit;
				
				/*$notif = $this->notifMessages();
			 	$data['notif'] = $notif;*/

				$data['active'] = "memberuser";
				$this->load->view('layout/header', $data);
				$this->load->view('memberuser/memberuserEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|callback_check_jabatan');
				$this->form_validation->set_rules('workunit', 'Unit Kerja', 'trim|required|callback_check_unitkerja');
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
				/*$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('phoneno', 'Phone No', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');*/
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];
					
					$listsJabatan = $this->jabatan->lists();
					$data['listsJabatan'] = $listsJabatan;

					$listsWorkunit = $this->workunit->lists();
					$data['listsWorkunit'] = $listsWorkunit;
					
					/*$notif = $this->notifMessages();
			 		$data['notif'] = $notif;*/

					$data['active'] = "memberuser";
					$this->load->view('layout/header', $data);
					$this->load->view('memberuser/memberuserAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$session_data = $this->session->userdata('logged_in');
					$dataInsert = array(
						'jabatan_id' => $this->input->post('jabatan'),
						'unit_kerja_id' => $this->input->post('workunit'),
						'username' => $this->input->post('username'),
						'fullname' => $this->input->post('fullname'),
						'address' => $this->input->post('address'),
						'phoneno' => $this->input->post('phoneno'),
						'email' => $this->input->post('email'),
						'password' => MD5($this->input->post('password')),
						'status' => $this->input->post('status'),
						'created_by' => $session_data['user_id']
					);
					$this->user->addUser($dataInsert);
					
					$this->reindex("Success Add Data");
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|callback_check_jabatan');
				$this->form_validation->set_rules('workunit', 'Unit Kerja', 'trim|required|callback_check_unitkerja');
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
				/*$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('phoneno', 'Phone No', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');*/
				if ($this->input->post('password') != "") {
					$this->form_validation->set_rules('password', 'Password', 'trim|required');
				}
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$id = $this->session->userdata('user_id_update');
					
					$data['singleUser'] = $this->user->findUserById($id);
					
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];
					 
					$listsJabatan = $this->jabatan->lists();
					$data['listsJabatan'] = $listsJabatan;

					$listsWorkunit = $this->workunit->lists();
					$data['listsWorkunit'] = $listsWorkunit;
					
					/*$notif = $this->notifMessages();
			 		$data['notif'] = $notif;*/

					$data['active'] = "memberuser";
					$this->load->view('layout/header', $data);
					$this->load->view('memberuser/memberuserEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$id = $this->session->userdata('user_id_update');
					$session_data = $this->session->userdata('logged_in');
					$password = "";
					
					if ($this->input->post('password') != "") {
						$dataUpdate = array(
							'jabatan_id' => $this->input->post('jabatan'),
							'unit_kerja_id' => $this->input->post('workunit'),
							'username' => $this->input->post('username'),
							'fullname' => $this->input->post('fullname'),
							'address' => $this->input->post('address'),
							'phoneno' => $this->input->post('phoneno'),
							'email' => $this->input->post('email'),
							'password' => MD5($this->input->post('password')),
							'status' => $this->input->post('status'),
							'modified_by' => $session_data['user_id']
						);
						$this->user->updateUser($id, $dataUpdate);
					} else {
						$dataUpdate = array(
							'jabatan_id' => $this->input->post('jabatan'),
							'unit_kerja_id' => $this->input->post('workunit'),
							'username' => $this->input->post('username'),
							'fullname' => $this->input->post('fullname'),
							'address' => $this->input->post('address'),
							'phoneno' => $this->input->post('phoneno'),
							'email' => $this->input->post('email'),
							'status' => $this->input->post('status'),
							'modified_by' => $session_data['user_id']
						);
						$this->user->updateUser($id, $dataUpdate);
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
				$res = $this->user->findUserById($id);
				foreach($res as $rows) {
					$dataUpdate = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->user->updateUser($id, $dataUpdate);
				}
				redirect('memberuser/memberuser', 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}
	}
?>