<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiLogin extends MY_Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		public function doLogin() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);
			
			$user = $this->user->findMobileUserByUsername($username);
			if (!empty($user)) {
				if ($user[0]->status == 0) {
					$data = json_encode(array(
						'status' => -1,
						'message' => 'User not active',
						'data' => []
					));
							
					$this->output
						->set_content_type('application/json')
						->set_status_header(200)
						->set_output($data);
				} else {
					$result = $this->user->loginMobile($username, $password);
					if($result) {
						return $this->output
									->set_content_type('application/json')
									->set_status_header(200)
									->set_output(json_encode(array(
											'status' => 0,
											'message' => 'Success Login',
											'data' => $result[0]
									)));
					} else {
						return $this->output
									->set_content_type('application/json')
									->set_status_header(200)
									->set_output(json_encode(array(
											'status' => -2,
											'message' => 'Wrong Email or Password',
											'data' => []
									)));
					}
				}
			} else {
				$data = json_encode(array(
					'status' => -3,
					'message' => 'User not found',
					'data' => []
				));
						
				$this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output($data);
			}
		}
		
		function getAllUsers(){
            $users = $this->user->listUser();
            $data = json_encode(array(
						'status' => 0,
						'message' => 'Success get all Users data',
						'data' => $users
					));
			header('HTTP/1.1: 200');
			header('Status: 200');
			header('Content-Length: '.strlen($data));
			exit($data);
		}
	}
?>