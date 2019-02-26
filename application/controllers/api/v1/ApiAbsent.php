<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiAbsent extends MY_Controller {
		
		function __construct() {
			parent::__construct();			
		}
		
		public function doAbsent() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);
			$app_id = $this->input->get('app_id', TRUE);
			$event_id = $this->input->get('event_id', TRUE);
			$section = $this->input->get('section', TRUE);
			$resLogin = $this->doLoginCore($username, $password);
			if (!$resLogin) {
				if($event_id != "0" && $section != "0") {
					$result = $this->absent->findByIds($app_id, $event_id, $section);
					if(!empty($result[0])) {
						return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => -7,
									'message' => 'Anda Sudah Pernah Absen di Session ini',
									'data' => []
							)));
					} else {
						$dataInsert = array(
							'app_id' => $app_id,
							'event_id' => $event_id,
							'section' => $section
						);
						$result2 = $this->absent->add($dataInsert);
						if ($result2) {
							$result3 = $this->event->findById($event_id);
							if (!empty($result3[0])) {
								return $this->output
									->set_content_type('application/json')
									->set_status_header(200)
									->set_output(json_encode(array(
											'status' => 0,
											'message' => 'Selamat Anda sudah hadir di Rapat '.$result3[0]->name.', Session '.$section,
											'data' => $result3[0]
									)));
							}						
							
						} else {
							return $this->output
								->set_content_type('application/json')
								->set_status_header(200)
								->set_output(json_encode(array(
										'status' => -6,
										'message' => 'Failed Do Absent',
										'data' => []
								)));
						}
					}		
				} else {
					return $this->output
								->set_content_type('application/json')
								->set_status_header(200)
								->set_output(json_encode(array(
										'status' => -11,
										'message' => 'QR Code tidak dapat dibaca.',
										'data' => []
								)));
				}
			}
		}
	}
?>