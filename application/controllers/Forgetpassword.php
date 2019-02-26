<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Forgetpassword extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('user','',TRUE);
		}
		
		public function index() {
		    $this->load->view('forgetpassword_view');
		}

		public function doSendEmail() {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
				
			if($this->form_validation->run() == FALSE) {
			    $this->load->view('forgetpassword_view');
			} else {
				$email = $this->input->post('email');
				$changepassurl = base_url()."changepassword?email=".$email;
				$emailcontent = "Please click this link to change your password : <a href='".$changepassurl."'>Change Password</a>";

				$this->load->library('email');
				$this->email->from('kelvin.rifai.dwi.septian@gmail.com', 'Meeting Admin');
				$this->email->to($email);
				$this->email->subject('MEETING APP - FORGET PASSWORD ADMIN');
				$this->email->message($emailcontent);

				if($this->email->send()) {
				 	$data['status'] = true;
					$data['page'] = "forget";
					$data['message'] = "Password already sent to your email. Please check your email or spam folder.";
					$this->load->view('result_common_view', $data);
				} else  {
					show_error($this->email->print_debugger());
				}
			}
		}

		public function check_email($email) {
			$res = $this->user->findAdminUserByEmail($email);
			if(empty($res)) {
				$this->form_validation->set_message('check_email', 'Email not found');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
?>