<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiLegislation extends MY_Controller {
		
		function __construct() {
			parent::__construct();			
		}
		
		public function getLegislations() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);			
			$resLogin = $this->doLoginCore($username, $password);
			if (!$resLogin) {
				$result = $this->legislation->listsMobile();
				if(!empty($result)) {
					return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => 0,
									'message' => 'Success Get Legislation Data',
									'data' => $result
							),JSON_UNESCAPED_SLASHES));
				} else {					
					return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => -10,
									'message' => 'Failed Get Legislation Data',
									'data' => []
							)));
				}				
			}
		}
	}
?>