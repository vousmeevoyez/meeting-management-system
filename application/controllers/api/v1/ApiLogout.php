<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiLogout extends MY_Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		public function doLogout() {
			$app_id = $this->input->get('app_id', TRUE);
			$result = $this->user->findMobileUserByAppId($app_id);
			if (!empty($result[0])) {
				$dataUpdate = array(
					'is_login' => 0
				);
				if($this->user->logout($app_id, $dataUpdate)) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => 0,
							'message' => 'Success Logout',
							'data' => []
					)));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => -4,
							'message' => 'Failed Logout',
							'data' => []
					)));
				}
			}
		}
	}
?>