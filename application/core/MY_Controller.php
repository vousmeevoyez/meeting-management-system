<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class MY_Controller extends CI_Controller {
		
		function __construct() {
			parent::__construct();
            $this->load->model('user','',TRUE);
            $this->load->model('role','',TRUE);
            $this->load->model('event','',TRUE);
            $this->load->model('absent','',TRUE);
            $this->load->model('material','',TRUE);
            $this->load->model('rundown','',TRUE);
            $this->load->model('legislation','',TRUE);
            $this->load->model('qrcodes','',TRUE);
            $this->load->model('workunit','',TRUE);
            $this->load->model('jabatan','',TRUE);
		}

        public function doLoginCore($username, $password) {            
            $user = $this->user->findMobileUserByUsername($username);
            if (!empty($user)) {
                if ($user[0]->status == 0) {
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                                'status' => -11,
                                'message' => 'Wrong Authentication When Request API',
                                'data' => []
                        )));
                    
                } else {
                    $result = $this->user->loginMobile($username, $password);
                    if($result) {
                        return 0;
                    } else {
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                                'status' => -11,
                                'message' => 'Wrong Authentication When Request API',
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
                                'message' => 'Wrong Authentication When Request API',
                                'data' => []
                        )));
            }
        }
		
		public function _create_captcha() {
		    $this->load->helper('captcha');
		    $options = array('word' => $this->rand5(1,9),'img_path'=>FCPATH.'/assets/web/images/captcha/','img_url'=>site_url().'/assets/web/images/captcha/','img_width'=>'150','img_height'=>'40','expiration'=>7200);
		    $cap = create_captcha($options);
		    $image = $cap['image'];
		    $this->session->set_userdata('captchaword', $cap['word']);
		    return $image;
		}
		
		public function rand5($min,$max){
			$num = "";
			for($i=0 ; $i<5; $i++){
				$num .= mt_rand($min,$max);
			}
			return $num;
		}

		public function send_notification($registatoin_ids, $message, $title, $senderid, $sender_lname, $logintype, $chattype, $messagetype) {
            // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';

            $data = array('message' => $message, 'title' => $title, 'senderid' => $senderid, 'sender_lname' => $sender_lname, 'logintype' => $logintype, 'chattype' => $chattype, 'messagetype' => $messagetype);

            $fields = array(
                'registration_ids' => $registatoin_ids,
                'data' => $data,
            );

            $headers = array(
                'Authorization: key=AIzaSyDV1-iu-R44uqfA0aFS0DzY91P37tFe9NA',
                'Content-Type: application/json'
            );
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
                echo $result;
            }

            // Close connection
            curl_close($ch);

            //echo $result;
        }

        public function stripHTMLtags($str) {
            $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
            $t = htmlentities($t, ENT_QUOTES, "UTF-8");
            return $t;
        }

        public function getUserIP() {
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];

            if (filter_var($client, FILTER_VALIDATE_IP)) {
                $ip = $client;
            } else if (filter_var($forward, FILTER_VALIDATE_IP)){
                $ip = $forward;
            } else {
                $ip = $remote;
            }
            return $ip;
        }

        public function notifMessages() {
            $lists = $this->contact->findByReadStatus();
            $total = count($lists);
            $data['total'] = $total;
            $data['lists'] = $lists;
            return $data;
        }

        public function deleteCaptchaFiles() {
            $this->load->helper('directory');
            $this->load->helper("file");

            $dir_fiels = directory_map('assets/web/images/captcha/');
            $len = sizeOf($dir_fiels);
            for($i=0; $i<$len;$i++){
                unlink('assets/web/images/captcha/'.$dir_fiels[$i]);
            }
        }

        public function doAjaxPackageName($basedonid) {            
            $lists = $this->packages->findByBasedOnId($basedonid);

            $post_data = array();
            foreach ($lists as $key) {
                $post_data2 = 
                array(
                    'name' => $key['name'],
                    'package_id' => $key['package_id']
                );
                array_push($post_data,$post_data2);
            }

            $data = json_encode(array(
                        'status' => 'SUCCESS',
                        'desc' => 'Success get package data',
                        'content' => $post_data
                    ));
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output($data);
        }

        public function doAjaxPackageName2($mgsid, $packagetypeid) {            
            $lists = $this->packages->findByMgsAndTypeId($mgsid, $packagetypeid);

            $post_data = array();
            foreach ($lists as $key) {
                $post_data2 = 
                array(
                    'cost' => number_format($key['cost'],0,',','.')
                );
                array_push($post_data,$post_data2);
            }

            $data = json_encode(array(
                        'status' => 'SUCCESS',
                        'desc' => 'Success get package data',
                        'content' => $post_data
                    ));
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output($data);
        }

        public function doAjaxGetSubjectsByClIdWeb($clid) {            
            $lists = $this->mgsubjects->findByClId($clid);

            $post_data = array();
            if(!empty($lists)) {

                for ($i=0; $i<count($lists); $i++) {
                    $listsSubjects = $this->subjects->findById($lists[$i]['subjects_id']);

                    $post_data2 = 
                    array(
                        'subjects_id' => $listsSubjects[0]['subjects_id'],
                        'name' => $listsSubjects[0]['name'],
                    );
                    array_push($post_data,$post_data2);
                }
                
            } else {
                //do nothing
            }
            
            $data = json_encode(array(
                'status' => 'SUCCESS',
                'desc' => 'Success get subjects data',
                'content' => $post_data
            ));
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output($data);
        }


        //Checking Custom Drop Down Menu

        public function check_meeting($status) {
            if ($status == -1) {
                $this->form_validation->set_message('check_meeting', 'The Meeting Name field is required.');
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function check_jabatan($status) {
            if ($status == -1) {
                $this->form_validation->set_message('check_jabatan', 'The Jabatan field is required.');
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function check_unitkerja($status) {
            if ($status == -1) {
                $this->form_validation->set_message('check_unitkerja', 'The Work Unit field is required.');
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function check_status($status) {
            if ($status == -1) {
                $this->form_validation->set_message('check_status', 'The Status field is required.');
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function check_role($role) {
            if ($role == -1) {
                $this->form_validation->set_message('check_role', 'The Role field is required.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
	}
?>