<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiEvent extends MY_Controller {
		
		function __construct() {
			parent::__construct();			
		}
		
		public function getEvents() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);
			$app_id = $this->input->get('app_id', TRUE);
			$resLogin = $this->doLoginCore($username, $password);
			if (!$resLogin) {
				$result = $this->event->listsMobile($app_id);
				if (!empty($result)) {
					
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => 0,
							'message' => 'Success Got Event Data',
							'data' => $result
					)));
					
				} else {
					return $this->output
						->set_content_type('application/json')
						->set_status_header(200)
						->set_output(json_encode(array(
								'status' => -5,
								'message' => 'Event Data Empty',
								'data' => []
						)));
				}
			}
		}

		public function getEventById() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);
			$event_id = $this->input->get('event_id', TRUE);
			$app_id = $this->input->get('app_id', TRUE);
			$resLogin = $this->doLoginCore($username, $password);
			if (!$resLogin) {
				$result = $this->event->findById($event_id);
				if (!empty($result[0])) {				
					
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
							'status' => 0,
							'message' => 'Success Got Event Data',
							'data' => $result[0]
					)));
					
				} else {
					return $this->output
						->set_content_type('application/json')
						->set_status_header(200)
						->set_output(json_encode(array(
								'status' => -5,
								'message' => 'Event Data Empty',
								'data' => []
						)));
				}
			}
		}		
	}
?>