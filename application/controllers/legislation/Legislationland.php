<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Legislationland extends MY_Controller {
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
				 
			$lists = $this->legislation->listsForAdmin();
			$data['lists'] = $lists;

			/*$notif = $this->notifMessages();
			$data['notif'] = $notif;*/

			$data['active'] = "legislation";
			$this->load->view('layout/header', $data);
			$this->load->view('legislation/legislationPage', $data);
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
				
				$data['active'] = "legislation";
				$this->load->view('layout/header', $data);
				$this->load->view('legislation/legislationAdd', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function edit() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleData'] = $this->legislation->findAdminById($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];							
				
				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				
				$data['active'] = "legislation";
				$this->load->view('layout/header', $data);
				$this->load->view('legislation/legislationEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('about', 'About', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					$listsEvent = $this->event->lists();
					$data['listsEvent'] = $listsEvent;					

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/
					
					$data['active'] = "legislation";
					$this->load->view('layout/header', $data);
					$this->load->view('legislation/legislationAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {					
					$name = $this->input->post('name');
					$about = $this->input->post('about');
					$status = $this->input->post('status');

					$listsYear = $this->legislation->findByIds($name);

					$legislationfile_url = "";
					if(isset($_FILES['legislationfile'])) {
						if (!empty($_FILES['legislationfile']['name'])) {
							$configUpload['upload_path']    = './assets/web/files/legislation/';  #the folder placed in the root of project
							$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg|doc|docx|excel|xls|xlsx|pdf'; #allowed types description
							$configUpload['encrypt_name']   = false; #encrypt name of the uploaded file
							$this->load->library('upload', $configUpload); #init the upload class

							if (!$this->upload->do_upload('legislationfile')) {
								$uploadedDetails    = $this->upload->display_errors();
							} else {										
								$uploadedDetails    = $this->upload->data();   
							}
							$baseUrl = base_url();
							$legislationfile_url =  $baseUrl.'assets/web/files/legislation/'.$uploadedDetails['file_name'];
						}
					}

					if (empty($listsYear)) {
						$session_data = $this->session->userdata('logged_in');
						$dataInsert = array(							
							'name' => $name,
							'about' => $about,
							'file' => $legislationfile_url,
							'status' => $status,
							'created_by' => $session_data['user_id']
						);
						$smId = $this->legislation->add($dataInsert);
						
						$this->reindex("Success Add Data");
					} else {
						$this->reindex("Data Already Exist");
					}
				}
			} else {
				redirect('loginadmin', 'refresh');
			}
		}
		
		public function doEdit() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('about', 'About', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				$id = $this->session->userdata('user_id_update');

				if($this->form_validation->run() == FALSE) {
					
					$data['singleData'] = $this->legislation->findAdminById($id);
					
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					$listsEvent = $this->event->lists();
					$data['listsEvent'] = $listsEvent;				

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/

					$data['active'] = "legislation";
					$this->load->view('layout/header', $data);
					$this->load->view('legislation/legislationEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$name = $this->input->post('name');
					$about = $this->input->post('about');
					$status = $this->input->post('status');				
					
					$legislationfile_url = "";
					if(isset($_FILES['legislationfile'])) {
						if (!empty($_FILES['legislationfile']['name'])) {
							$configUpload['upload_path']    = './assets/web/files/legislation/';  #the folder placed in the root of project
							$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg|doc|docx|excel|xls|xlsx|pdf'; #allowed types description
							$configUpload['encrypt_name']   = false; #encrypt name of the uploaded file
							$this->load->library('upload', $configUpload); #init the upload class

							if (!$this->upload->do_upload('legislationfile')) {
								$uploadedDetails    = $this->upload->display_errors();
							} else {										
								$uploadedDetails    = $this->upload->data();   
							}
							$baseUrl = base_url();
							$legislationfile_url =  $baseUrl.'assets/web/files/legislation/'.$uploadedDetails['file_name'];
						} else {
							$legislationfile_url = $this->input->post('legislationfileShadow');
						}
					}  else {
						$legislationfile_url = $this->input->post('legislationfileShadow');
					}

					$session_data = $this->session->userdata('logged_in');

					$dataUpdate = array(						
						'name' => $name,
						'about' => $about,
						'file' => $legislationfile_url,
						'status' => $status,
						'modified_by' => $session_data['user_id']
					);
					$this->legislation->update($id, $dataUpdate);
						
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
				$res = $this->legislation->findAdminById($id);
				foreach($res as $rows) {
					$dataUpdate = array(
						'is_delete' => 1,
						'modified_by' => $session_data['user_id']
					);
					$this->legislation->update($id, $dataUpdate);
				}
				redirect('legislation/legislationland', 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}
	}
?>