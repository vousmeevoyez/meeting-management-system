<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Loginadmin extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		public function index() {
			if($this->session->userdata('logged_in')) {
			    redirect('homeadmin', 'refresh');
			} else {
			    $this->load->view('login_view');
			}
		}
	}
?>