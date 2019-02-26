<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Register extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('user','',TRUE);
		}
		
		public function index() {
			$this->load->view('register_view');
		}

		public function doRegister() {
			$this->form_validation->set_rules('fullname', 'Full name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('retypepassword', 'Retype Password', 'trim|required|callback_check_retypepassword');
				
			if($this->form_validation->run() == FALSE) {
				$this->load->view('register_view');
			} else {
				$email = $this->input->post('email');
				$dataInsert = array(
					'role_id' => 1,
					'password' => MD5($this->input->post('password')),
					'fullname' => $this->input->post('fullname'),
					'email' => $email,
					'created_by' => 0
				);
				$this->user->addAdminUser($dataInsert);
				$data['status'] = true;
				$data['page'] = "register";
				$data['message'] = "Your data successfully submitted";
				$this->load->view('result_common_view', $data);
			}
		}

		public function check_email($email) {
			$checkemail = $this->user->findAdminUserByEmail($email);
			if (!empty($checkemail)){
				$this->form_validation->set_message('check_email', 'Email already exist, please use another');
				return FALSE;
			} else {
				return TRUE;
			}
		}

		public function check_retypepassword($retypepassword) {
			$password = $email = $this->input->post('password');
			if (trim($retypepassword) != trim($password)){
				$this->form_validation->set_message('check_retypepassword', 'Your Password Not Same With Retype Password');
				return FALSE;
			} else {
				return TRUE;
			}
		}

	}
?>