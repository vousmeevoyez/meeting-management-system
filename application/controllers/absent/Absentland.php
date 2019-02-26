<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Absentland extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->library('ci_qr_code');
        	$this->config->load('qr_code');
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

			$data['active'] = "absent";
			$this->load->view('layout/header', $data);
			$this->load->view('absent/absentPage', $data);
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
				
				$data['active'] = "absent";
				$this->load->view('layout/header', $data);
				$this->load->view('absent/absentAdd', $data);
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

				$data['active'] = "absent";
				$this->load->view('layout/header', $data);
				$this->load->view('absent/absentEdit', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}
		
		public function doAdd() {
			if($this->session->userdata('logged_in')) {	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('time', 'Time', 'trim|required');
				$this->form_validation->set_rules('date', 'Date', 'trim|required');
				$this->form_validation->set_rules('place', 'Place', 'trim|required');
				$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				$this->form_validation->set_rules('host', 'Host', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required|callback_check_status');
				
				if($this->form_validation->run() == FALSE) {
					$session_data = $this->session->userdata('logged_in');
					$session_data_role = $this->session->userdata('role_data');
					$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
					$data['admin_role_name'] = $session_data_role['admin_role_name'];
					$data['admin_role_id'] = $session_data_role['admin_role_id'];

					/*$notif = $this->notifMessages();
					$data['notif'] = $notif;*/

					$data['active'] = "absent";
					$this->load->view('layout/header', $data);
					$this->load->view('absent/absentAdd', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$session_data = $this->session->userdata('logged_in');
					$dataInsert = array(
						'name' => $this->input->post('name'),
						'time' => $this->input->post('time'),
						'date' => $this->input->post('date'),
						'place' => $this->input->post('place'),
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
				$this->form_validation->set_rules('date', 'Date', 'trim|required');
				$this->form_validation->set_rules('place', 'Place', 'trim|required');
				$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');
				$this->form_validation->set_rules('host', 'Host', 'trim|required');
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
					
					$data['active'] = "absent";
					$this->load->view('layout/header', $data);
					$this->load->view('absent/absentEdit', $data);
					$this->load->view('layout/footer', $data);
					
				} else {
					$id = $this->session->userdata('user_id_update');
					$session_data = $this->session->userdata('logged_in');
					$password = "";
					
					$dataUpdate = array(
						'name' => $this->input->post('name'),
						'time' => $this->input->post('time'),
						'date' => $this->input->post('date'),
						'place' => $this->input->post('place'),
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
				redirect('absent/absentland', 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}

		public function doDeleteUser() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id = $this->uri->segment(4);
				$qrcode_id = $this->uri->segment(5);				
				$this->absent->delete($id);
				
				redirect('absent/absentland/viewqrcodedetail/'.$qrcode_id, 'refresh');
		   } else {
				redirect('login', 'refresh');
		   }
		}		

		public function viewqrcode() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['lists'] = $this->qrcodes->findByEventId($id);
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				$data['info'] = "";
				$data['active'] = "absent";
				$this->load->view('layout/header', $data);
				$this->load->view('absent/qrcodePage', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}

		public function viewqrcodedetail() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$this->session->set_userdata('user_id_update', $id);
				$data['singleData'] = $this->qrcodes->findById($id);

				$result = $this->qrcodes->findById($id);
				$event_id = "";
				$section = "";
				foreach($result as $rows) {					
					$lists = $this->absent->findByIds2($rows['event_id'],$rows['section']);
					$data['lists'] = $lists;
					$event_id=$rows['event_id'];
					$section=$rows['section'];
				}
				/*foreach($result as $rows) {
					$lists = $this->absent->findByIds2($rows->event_id, $rows->section);
				$data['lists'] = $lists;
				}		*/		
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				$data['info'] = "";
				$data['active'] = "absent";
				$data['qrcode_id'] = $id;
				$data['event_id'] = $event_id;
				$data['section'] = $section;
				$this->load->view('layout/header', $data);
				$this->load->view('absent/qrcodeDetailPage', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}

		public function viewadddata() {
			if($this->session->userdata('logged_in')) {
				
				$id = $this->uri->segment(4);
				$event_id = $this->uri->segment(5);
				$section = $this->uri->segment(6);
				$lists = $this->user->listUser();
				$data['lists'] = $lists;		
				
				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				/*$notif = $this->notifMessages();
				$data['notif'] = $notif;*/
				$data['info'] = "";
				$data['active'] = "absent";
				$data['qrcode_id'] = $id;
				$data['event_id'] = $event_id;
				$data['section'] = $section;
				$this->load->view('layout/header', $data);
				$this->load->view('absent/qrcodeAddPage', $data);
				$this->load->view('layout/footer', $data);
		   } else {
				redirect('loginadmin', 'refresh');
		   }
		}

		public function doAddUserQrCode() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id = $this->session->userdata('user_id_update');

				$event_id = $this->input->post('event_id');
				$section = $this->input->post('section');
				$qrcode_id = $this->input->post('qrcode_id');
				
				foreach($this->input->post("name") as $name){
					$dataInsert = array(
						'app_id' => $name,
						'event_id' => $event_id,						
						'section' => $section,
						'is_absent' => 0,
						'created_by' => $session_data['user_id']
					);
					$this->absent->add($dataInsert);				    
				}

				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				$lists = $this->qrcodes->lists();
				$data['lists'] = $lists;
				$data['info'] = "";
				$data['active'] = "absent";				

				redirect('absent/absentland/viewqrcodedetail/'.$qrcode_id, 'refresh');
				
			} else {
				redirect('login', 'refresh');
			}
		}

		public function doGenerateQrCode() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id = $this->session->userdata('user_id_update');
				$qrCodeTotal = $this->input->post('qrcode');				
				$name = $this->input->post('name');

				$result = $this->event->findById($id);
				$resQrcodeTotal = "";
				$resQrcodeTotalTemp = "";
				if (!empty($result)) {
					$resQrcodeTotal = $result[0]->qrcode_total;
				}

				$resQrcodeTotalTemp = $resQrcodeTotal + $qrCodeTotal;
				$dataUpdate = array(
					'qrcode_total' => $resQrcodeTotalTemp,
					'modified_by' => $session_data['user_id']
				);
				$this->event->update($id, $dataUpdate);

				for ($i=($resQrcodeTotal+1); $i<=$resQrcodeTotalTemp; $i++) {
					$qr_code_config = array();
			        $qr_code_config['cacheable'] = $this->config->item('cacheable');
			        $qr_code_config['cachedir'] = $this->config->item('cachedir');
			        $qr_code_config['imagedir'] = $this->config->item('imagedir');
			        $qr_code_config['errorlog'] = $this->config->item('errorlog');
			        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
			        $qr_code_config['quality'] = $this->config->item('quality');
			        $qr_code_config['size'] = $this->config->item('size');
			        $qr_code_config['black'] = $this->config->item('black');
			        $qr_code_config['white'] = $this->config->item('white');
			        $this->ci_qr_code->initialize($qr_code_config);

			        // get full name and user details
			        $image_name = $name ."_".$i.".png";

			        // create user content
			        $codeContents = $id.",";
			        $codeContents .= $i.",";
			        $codeContents .= $name.",";
			        $codeContents .= "Absen-".$i;

			        $params['data'] = $codeContents;
			        $params['level'] = 'L';
			        $params['size'] = 8;

			        $baseUrl = base_url();
			        $materialfile_url =  $baseUrl.'global/tmp/qr_codes/'.$image_name;
			        $params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
			        $this->ci_qr_code->generate($params);		        
			        $file = $params['savename'];
			        //print_r($file);

			        $dataInsert = array(
						'event_id' => $id,
						'file' => $materialfile_url,
						'section' => $i,
						'status' => 1,
						'created_by' => $session_data['user_id']
					);
					$this->qrcodes->add($dataInsert);			        

			        /*if(file_exists($file)){
			            header('Content-Description: File Transfer');
			            header('Content-Type: text/csv');
			            header('Content-Disposition: attachment; filename='.basename($file));
			            header('Content-Transfer-Encoding: binary');
			            header('Expires: 0');
			            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			            header('Pragma: public');
			            header('Content-Length: ' . filesize($file));
			            ob_clean();
			            flush();
			            readfile($file);
			            unlink($file); // deletes the temporary file

			            exit;
			        }*/
				}

				$session_data = $this->session->userdata('logged_in');
				$session_data_role = $this->session->userdata('role_data');
				$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
				$data['admin_role_name'] = $session_data_role['admin_role_name'];
				$data['admin_role_id'] = $session_data_role['admin_role_id'];

				$lists = $this->qrcodes->findByEventId($id);
				$data['lists'] = $lists;
				$data['info'] = "";
				$data['active'] = "absent";
				$this->load->view('layout/header', $data);
				$this->load->view('absent/qrcodePage', $data);
				$this->load->view('layout/footer', $data);
				
			} else {
				redirect('login', 'refresh');
			}
		}
	}
?>