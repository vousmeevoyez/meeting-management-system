<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Meetingland extends MY_Controller {
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
				 
			$lists = $this->event->listsForAdmin();
			$data['lists'] = $lists;

			/*$notif = $this->notifMessages();
			$data['notif'] = $notif;*/

			$data['active'] = "meeting";
			$this->load->view('layout/header', $data);
			$this->load->view('meeting/meetingPage', $data);
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

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "meeting";
				$this->load->view('layout/header', $data);
				$this->load->view('meeting/meetingAdd', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleData'] = $this->event->findAdminById($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/

				$data['active'] = "meeting";
				$this->load->view('layout/header', $data);
				$this->load->view('meeting/meetingEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('time', 'Time', 'trim|required');
				$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
				$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				//$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				//$this->form_validation->set_rules('host', 'Host', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/

					$data['active'] = "meeting";
					$this->load->view('layout/header', $data);
					$this->load->view('meeting/meetingAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$session_data = $this->session->userdata('logged_in');
					$dataInsert = array(
						'name' => $this->input->post('name'),
						'time' => $this->input->post('time'),
						'start_date' => $this->input->post('start_date'),
						'end_date' => $this->input->post('end_date'),
						'place' => $this->input->post('location'),
						'status' => $this->input->post('status'),
						'created_by' => $session_data['user_id']
					);
					$this->event->add($dataInsert);
					
					$this->reindex("Success Add Data");
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('time', 'Time', 'trim|required');
				$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
				$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				//$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				//$this->form_validation->set_rules('host', 'Host', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$id = $this->session->userdata('user_id_update');
					
					$data['singleData'] = $this->event->findAdminById($id);
					
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/
					
					$data['active'] = "meeting";
					$this->load->view('layout/header', $data);
					$this->load->view('meeting/meetingEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$id = $this->session->userdata('user_id_update');
					$session_data = $this->session->userdata('logged_in');
					$password = "";
					
					$dataUpdate = array(
						'name' => $this->input->post('name'),
						'time' => $this->input->post('time'),
						'start_date' => $this->input->post('start_date'),
						'end_date' => $this->input->post('end_date'),
						'place' => $this->input->post('location'),
						'status' => $this->input->post('status'),
						'modified_by' => $session_data['user_id']
					);
					$this->event->update($id, $dataUpdate);
					
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
				$res = $this->event->findAdminById($id);
				foreach($res as $rows) {
					$dataUpdate = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->event->update($id, $dataUpdate);
				}
				redirect('meeting/meetingland', 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}
	}
?>