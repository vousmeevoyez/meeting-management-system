<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Materialland extends MY_Controller {
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

			$data['active'] = "material";
			$this->load->view('layout/header', $data);
			$this->load->view('material/materialPage', $data);
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
				
				$data['active'] = "material";
				$data['event_id'] = $event_id;
				$this->load->view('layout/header', $data);
				$this->load->view('material/materialAdd', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleData'] = $this->material->findAdminById($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				$listsEvent = $this->event->lists();
				$data['listsEvent'] = $listsEvent;				
				
				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "material";
				$data['event_id'] = $id;
				$this->load->view('layout/header', $data);
				$this->load->view('material/materialEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}

		public function showmaterial() {
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

				$lists = $this->material->listsForAdmin($event_id);
				$data['lists'] = $lists;
				
				$data['active'] = "material";
				$data['event_id'] = $event_id;
				$this->load->view('layout/header', $data);
				$this->load->view('material/material2Page', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				//$this->form_validation->set_rules('meeting', 'Meeting Name', 'trim|required|callback_check_meeting');
				$this->form_validation->set_rules('name', 'Material Name', 'trim|required');
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
					
					$data['active'] = "material";
					$data['event_id'] = $this->input->post('meetingShadow');
					$this->load->view('layout/header', $data);
					$this->load->view('material/materialAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$meeting = $this->input->post('meetingShadow');
					$name = $this->input->post('name');
					$speaker = $this->input->post('speaker');
					$status = $this->input->post('status');

					$listsYear = $this->material->findByIds($meeting,$name);

					$materialfile_url = "";
					if(isset($_FILES['materialfile'])) {
						if (!empty($_FILES['materialfile']['name'])) {
							$configUpload['upload_path']    = './assets/web/files/';  #the folder placed in the root of project
							$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg|doc|docx|excel|xls|xlsx|ppt|pptx|pdf'; #allowed types description
							$configUpload['encrypt_name']   = false; #encrypt name of the uploaded file
							$this->load->library('upload', $configUpload); #init the upload class

							if (!$this->upload->do_upload('materialfile')) {
								$uploadedDetails    = $this->upload->display_errors();
							} else {										
								$uploadedDetails    = $this->upload->data();   
							}
							$baseUrl = base_url();
							$materialfile_url =  $baseUrl.'assets/web/files/'.$uploadedDetails['file_name'];
						}
					}

					if (empty($listsYear)) {
						$session_data = $this->session->userdata('logged_in');
						$dataInsert = array(
							'event_id' => $meeting,
							'name' => $name,
							'speaker' => $speaker,
							'file' => $materialfile_url,
							'status' => $status,
							'created_by' => $session_data['user_id']
						);
						$smId = $this->material->add($dataInsert);
						
						redirect('material/materialland/showmaterial/'.$meeting.'/Success Add data', 'refresh');
						
					} else {
						redirect('material/materialland/showmaterial/'.$meeting.'/Data Already Exist', 'refresh');
						
					}
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				//$this->form_validation->set_rules('meeting', 'Meeting Name', 'trim|required|callback_check_meeting');
				$this->form_validation->set_rules('name', 'Material Name', 'trim|required');
				//$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				$id = $this->session->userdata('user_id_update');

				if($this->form_validation->run() == FALSE) {
					
					$data['singleData'] = $this->material->findAdminById($id);
					
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

					$data['active'] = "material";
					$data['event_id'] = $this->input->post('meetingShadow');
					$this->load->view('layout/header', $data);
					$this->load->view('material/materialEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$meeting = $this->input->post('meetingShadow');
					$name = $this->input->post('name');
					$speaker = $this->input->post('speaker');
					$status = $this->input->post('status');					
					
					$materialfile_url = "";
					if(isset($_FILES['materialfile'])) {
						if (!empty($_FILES['materialfile']['name'])) {
							$configUpload['upload_path']    = './assets/web/files/';  #the folder placed in the root of project
							$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg|doc|docx|excel|xls|xlsx|ppt|pptx|pdf'; #allowed types description
							$configUpload['encrypt_name']   = false; #encrypt name of the uploaded file
							$this->load->library('upload', $configUpload); #init the upload class

							if (!$this->upload->do_upload('materialfile')) {
								$uploadedDetails    = $this->upload->display_errors();
							} else {										
								$uploadedDetails    = $this->upload->data();   
							}
							$baseUrl = base_url();
							$materialfile_url =  $baseUrl.'assets/web/files/'.$uploadedDetails['file_name'];
						} else {
							$materialfile_url = $this->input->post('materialfileShadow');
						}
					} else {
						$materialfile_url = $this->input->post('materialfileShadow');
					}

					$session_data = $this->session->userdata('logged_in');

					$dataUpdate = array(
						'event_id' => $meeting,
						'name' => $name,
						'speaker' => $speaker,
						'file' => $materialfile_url,
						'status' => $status,
						'modified_by' => $session_data['user_id']
					);
					$this->material->update($id, $dataUpdate);
						
					redirect('material/materialland/showmaterial/'.$meeting.'/Success Edit Data', 'refresh');					
					
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
				$res = $this->material->findAdminById($id);
				foreach($res as $rows) {
					$dataUpdate = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->material->update($id, $dataUpdate);
				}
				redirect('material/materialland/showmaterial/'.$event_id, 'refresh');				
		   } else {
				redirect('login', 'refresh');
		   }
		}
	}
?>