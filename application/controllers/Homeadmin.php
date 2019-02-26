<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Homeadmin extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		public function index() {
			if($this->session->userdata('logged_in')) {
		     	$session_data = $this->session->userdata('logged_in');
			 	$session_data_role = $this->session->userdata('role_data');
		     	$data['admin_user_fullname'] = $session_data_role['admin_user_fullname'];
			 	$data['admin_role_name'] = $session_data_role['admin_role_name'];
			 	$data['admin_role_id'] = $session_data_role['admin_role_id'];

			 	//$notif = $this->notifMessages();
			 	//$data['notif'] = $notif;

			 	$data['active'] = "dashboard";
			 	$this->load->view('layout/header', $data);
		     	$this->load->view('dashboard_view', $data);
			 	$this->load->view('layout/footer', $data);
		   } else {
		     	redirect('loginadmin', 'refresh');
		   }
		}
		
		public function logout() {
			$this->session->unset_userdata('logged_in');
			session_destroy();
			redirect('homeadmin', 'refresh');
		 }
	}
?>