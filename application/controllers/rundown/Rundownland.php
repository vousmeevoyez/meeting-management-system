<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Rundownland extends MY_Controller {
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

			/*$lists = $this->rundown->listsForAdmin();
			$data['lists'] = $lists;*/

			/*$notif = $this->notifMessages();
			$data['notif'] = $notif;*/

			$data['active'] = "rundown";
			$this->load->view('layout/header', $data);
			$this->load->view('rundown/rundownPage', $data);
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
				$event_id = $this->uri->segment(4);
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				$listsEvent = $this->event->lists();
				$data['listsEvent'] = $listsEvent;

				/*$listsClass = $this->classes->lists();
				$data['listsClass'] = $listsClass;*/

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "rundown";
				$data['event_id'] = $event_id;
				$this->load->view('layout/header', $data);
				$this->load->view('rundown/rundownAdd', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleData'] = $this->rundown->findAdminById($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				$listsEvent = $this->event->lists();
				$data['listsEvent'] = $listsEvent;				
				
				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "rundown";
				$data['event_id'] = $id;
				$this->load->view('layout/header', $data);
				$this->load->view('rundown/rundownEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}

		public function showrundown() {
			if($this->session->userdata('logged_in')) {
				$event_id = $this->uri->segment(4);
				$info = $this->uri->segment(5);
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

				$lists = $this->rundown->listsForAdmin($event_id);
				$data['lists'] = $lists;
				
				$data['active'] = "rundown";
				$data['event_id'] = $event_id;
				$this->load->view('layout/header', $data);
				$this->load->view('rundown/rundown2Page', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				//$this->form_validation->set_rules('meeting', 'Meeting Name', 'trim|required|callback_check_meeting');
				$this->form_validation->set_rules('date', 'Date', 'trim|required');
				$this->form_validation->set_rules('time', 'Time', 'trim|required');
				$this->form_validation->set_rules('name', 'Rundown Name', 'trim|required');
				//$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					$listsEvent = $this->event->lists();
					$data['listsEvent'] = $listsEvent;

					/*$listsClass = $this->classes->lists();
					$data['listsClass'] = $listsClass;*/

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/
					
					$data['active'] = "rundown";
					$data['event_id'] = $this->input->post('meetingShadow');
					$this->load->view('layout/header', $data);
					$this->load->view('rundown/rundownAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$meeting = $this->input->post('meetingShadow');
					$date = $this->input->post('date');
					$time = $this->input->post('time');
					$name = $this->input->post('name');
					$speaker = $this->input->post('speaker');
					$status = $this->input->post('status');

					$listsYear = $this->rundown->findByIds($meeting, $name, $date, $time);

					if (empty($listsYear)) {
						$session_data = $this->session->userdata('logged_in');
						$dataInsert = array(
							'event_id' => $meeting,
							'date' => $date,
							'time' => $time,
							'name' => $name,
							'speaker' => $speaker,
							'status' => $status,
							'created_by' => $session_data['user_id']
						);
						$smId = $this->rundown->add($dataInsert);
						
						redirect('rundown/rundownland/showrundown/'.$meeting.'/Success Add data', 'refresh');
					} else {
						redirect('rundown/rundownland/showrundown/'.$meeting.'/Data Already Exist', 'refresh');
					}
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				//$this->form_validation->set_rules('meeting', 'Meeting Name', 'trim|required|callback_check_meeting');
				$this->form_validation->set_rules('date', 'Date', 'trim|required');
				$this->form_validation->set_rules('time', 'Time', 'trim|required');
				$this->form_validation->set_rules('name', 'Rundown Name', 'trim|required');
				//$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				$id = $this->session->userdata('user_id_update');

				if($this->form_validation->run() == FALSE) {
					
					$data['singleData'] = $this->rundown->findAdminById($id);
					
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					$listsEvent = $this->event->lists();
					$data['listsEvent'] = $listsEvent;

					/*$listsLevel = $this->levels->lists();
					$data['listsLevel'] = $listsLevel;*/

					/*$listsClass = $this->classes->lists();
					$data['listsClass'] = $listsClass;*/

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/

					$data['active'] = "rundown";
					$data['event_id'] = $this->input->post('meetingShadow');
					$this->load->view('layout/header', $data);
					$this->load->view('rundown/rundownEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$meeting = $this->input->post('meetingShadow');
					$date = $this->input->post('date');
					$time = $this->input->post('time');
					$name = $this->input->post('name');
					$speaker = $this->input->post('speaker');
					$status = $this->input->post('status');

					$listsYear = $this->rundown->findByIds($meeting, $name, $date, $time);
					
					//if (empty($listsYear)) {
						$session_data = $this->session->userdata('logged_in');

						$dataUpdate = array(
							'event_id' => $meeting,
							'date' => $date,
							'time' => $time,
							'name' => $name,
							'speaker' => $speaker,
							'status' => $status,
							'modified_by' => $session_data['user_id']
						);
						$this->rundown->update($id, $dataUpdate);
						
						redirect('rundown/rundownland/showrundown/'.$meeting.'/Success Edit Data', 'refresh');						
					//} else {
					//	$this->reindex("Data Already Exist");
					//}
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doDelete() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id = $this->uri->segment(4);
				$event_id = $this->uri->segment(5);
				$res = $this->rundown->findAdminById($id);
				foreach($res as $rows) {
					$dataUpdate = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->rundown->update($id, $dataUpdate);
				}
				redirect('rundown/rundownland/showrundown/'.$event_id, 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}
	}
?>