<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiMaterial extends MY_Controller {
		
		function __construct() {
			parent::__construct();			
		}
		
		public function getMaterialByEventId() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);
			$event_id = $this->input->get('event_id', TRUE);
			$resLogin = $this->doLoginCore($username, $password);
			if (!$resLogin) {
				$result = $this->material->listsMobile($event_id);
				if(!empty($result)) {
					return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => 0,
									'message' => 'Success Get Material Data',
									'data' => $result
							),JSON_UNESCAPED_SLASHES));
				} else {					
					return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => -8,
									'message' => 'Failed Get Material Data',
									'data' => []
							)));
				}				
			}
		}
	}
?>