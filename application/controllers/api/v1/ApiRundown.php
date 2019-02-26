<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	author : kelvin
*/
	class ApiRundown extends MY_Controller {
		
		function __construct() {
			parent::__construct();			
		}
		
		public function getRundownByEventId() {
			$username = $this->input->get('name', TRUE);
			$password = $this->input->get('password', TRUE);
			$event_id = $this->input->get('event_id', TRUE);
			$resLogin = $this->doLoginCore($username, $password);
			if (!$resLogin) {
				$result = $this->rundown->listsMobile($event_id);
				$resultDate = $this->rundown->findDate($event_id);
				if(!empty($result)) {
					$post_data0 = array();
					foreach ($resultDate as $keyDate) {
						$dateParent = $keyDate->date;

						$post_data4 = array();
						foreach ($result as $key) {
							$date = $key->date;

							if (trim($dateParent) == trim($date)) {
								$post_data5 = 
					                array(
					                    'rundown_name' => $key->rundown_name,
					                    'time' => $key->time,
					                    'speaker' => $key->speaker
					                );
				                array_push($post_data4, $post_data5);
							}							
			            }
			            $post_data3 = 
								array(
									'date' => $dateParent,
									'rundown' => $post_data4
								);
						array_push($post_data0, $post_data3);
					}						           

					$post_data = 
						array(
		                    'event_id' => $result[0]->event_id,
		                    'event_name' => $result[0]->event_name,
		                    'place' => $result[0]->place,
		                    'details' => $post_data0
		                );

					
					return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => 0,
									'message' => 'Success Get Rundown Data',
									'data' => $post_data
							)));
				} else {					
					return $this->output
							->set_content_type('application/json')
							->set_status_header(200)
							->set_output(json_encode(array(
									'status' => -9,
									'message' => 'Failed Get Rundown Data',
									'data' => []
							)));
				}				
			}
		}
	}
?>