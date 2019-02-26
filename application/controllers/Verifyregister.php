<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifyregister extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('user','',TRUE);
  }

  public function index() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('usermail', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('userpass', 'Password', 'trim|required|callback_check_database');
    //$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_check_captcha');
	
    if($this->form_validation->run() == FALSE) {
      //$data['image']=$this->_create_captcha();
      $this->load->view('login_view');
    } else {
      redirect('homeadmin', 'refresh');
    }
  }
  
  public function check_database($password) {
    $usermail = $this->input->post('usermail');
    $result = $this->user->loginAdmin($usermail, $password);
    $resultCheckRole = $this->user->checkRole($usermail);
    
    if($result) {
      $sess_array = array();
      foreach($result as $row) {
        $sess_array = array(
			'user_id' => $row->user_id,
			'username' => $row->username,
			'fullname' => $row->fullname
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
	  
  	  $sess_array_role = array();
  	  if($resultCheckRole) {
    		foreach($resultCheckRole as $row) {
    			$sess_array_role = array(
    			  'admin_user_fullname' => $row->fullname,
    			  'admin_role_name' => $row->name,
    			  'admin_role_id' => $row->role_id
    			);
    			$this->session->set_userdata('role_data', $sess_array_role);
    		}
  	  }

      $session_data = $this->session->userdata('logged_in');

      $cookie = array(
        'name'   => 'cookie_logged_in',
        'value'  => 'Cookie - Keep me logged in',
        'expire' => '2592000'
      );

      if($this->input->post('logged_in')) {
          set_cookie($cookie);
      } else if (!$this->input->post('logged_in')) {
    		if(get_cookie('cookie_logged_in')!="") {
          delete_cookie('cookie_logged_in');
        }
      }
      return TRUE;
    } else {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return FALSE;
    }
  }

  public function check_captcha($string) {
    if($string==$this->session->userdata('captchaword')) {
      return TRUE;
    } else {
      $this->form_validation->set_message('check_captcha', 'Wrong captcha code');
      return FALSE;
    }
  }
}
?>