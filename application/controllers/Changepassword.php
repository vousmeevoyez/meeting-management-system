<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Changepassword extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('user','',TRUE);
		}
		
		public function index() {
			$data['email'] = $this->input->get('email');
		    $this->load->view('changepassword_view', $data);
		}

		public function doChangePassword() {	
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirmpassword', 'Retype Password', 'trim|required');
				
			if($this->form_validation->run() == FALSE) {
			    $this->load->view('changepassword_view');
				
			} else {
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$konfirmasipassword = $this->input->post('confirmpassword');
				if (trim($password) != trim($konfirmasipassword)) {
					echo "<script>alert('Your Password Not Same');</script>";
					$data['email'] = $email;
		    		$this->load->view('changepassword_view', $data);
				} else {
					$dataUpdate = array(
						'password' => MD5($password)
					);
					$this->user->updateAdminUserByEmail($email, $dataUpdate);
					echo "<script>alert('Password successfully changed');</script>";
					redirect('loginadmin', 'refresh');
				}
			}
		}
	}
?>