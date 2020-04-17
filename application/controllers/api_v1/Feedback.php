<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Feedback extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/feedback_model');
	}
	
	public function index_get()
	{
		$json = array("status" => 0, "message" => "Request URL not accepted");
		$this->response($json, REST_Controller::HTTP_OK); 
	}


	// for match app token
	private function matchAppToken($token=''){
		if($token!=''){
			return true;
		}else{
			return false;
		}
	}
	//end	
	
	/*
	* Method name: add_feedback
	* Desc: registred sub patient status(true for accepted, false for denied)
	* Input: token, username, title, first name, middle name, last name,
	*/
	// public function add_feedback_post()
	// { 
	// 	if($_SERVER['REQUEST_METHOD'] == "POST"){
	// 		// Get data
	// 		if(isset($_POST)){
	// 			$permission=false;
	// 			$token= isset($_POST['token']) ?($_POST['token']) : "";
	// 			$permission=$this->matchAppToken($token);
	// 			if($permission==true){
	// 				extract($_POST);
	// 				if(isset($username) && isset($hospital_rate)  && isset($checkup_rate)  && isset($description) && $username!='' && $hospital_rate!=''  && $checkup_rate!=''){
	// 					if(is_numeric($hospital_rate)  && is_numeric($checkup_rate) && $hospital_rate!=0 && $hospital_rate<=5  && $checkup_rate!=0 && $checkup_rate<=5){
	// 						if($this->feedback_model->add_feedback()){
	// 							$json = array("status" => 1, "message" => "Thanks for the feedback on your experience with our services. We sincerely appreciate your insight because it helps us build a better customer experience.");
	// 						}else{
	// 							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
	// 						}
	// 					}else{
	// 						$json = array("status" => 0, "message" => "Checkup rate and Hospital rate must be numeric and between 0 to 5.");
	// 					}
	// 				}else{
	// 					$json = array("status" => 0, "message" => "Mandatory fields have been empty.");
	// 				}
	// 			}else{
	// 				$json = array("status" => 0, "message" => "Token has been not matched.");
	// 			}
	// 		}else{
	// 			$json = array("status" => 0, "message" => "Request has been uncompleted.");
	// 		}	
	// 	}else{
	// 		$json = array("status" => 0, "message" => "Request method not accepted.");
	// 	}
	// 	$this->response($json, REST_Controller::HTTP_OK);
	// }
	public function add_feedback_post()
	{ 
            //print_r($_POST);die;
		if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $lang=isset($_POST['language'])?$_POST['language']:'';
                    if($lang && $lang=='en'){
                        $languageb='Thanks for the feedback on your experience with our services. We sincerely appreciate your insight because it helps us build a better customer experience.';
                    }else{
                        $languageb='Cảm ơn các đóng góp của bạn. Chúng tôi hi vọng sẽ phục vụ bạn tốt hơn trong những lần tiếp theo.';
                    }			
// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($username) && isset($waiting_time_hospital)  && isset($medical_facility_equipment)  && isset($friendiness_privacy) && isset($quality_medical_examination) && isset($overall_service_exclude_exam) && isset($feedback_remark) && isset($special_recommend) && $waiting_time_hospital!='' && $medical_facility_equipment!='' && $friendiness_privacy!='' && $quality_medical_examination!='' && $overall_service_exclude_exam!='' && $username!=''){
						if(is_numeric($waiting_time_hospital)  && is_numeric($medical_facility_equipment) && is_numeric($friendiness_privacy) && is_numeric($quality_medical_examination) && is_numeric($overall_service_exclude_exam)){
							if($this->feedback_model->add_feedback()){
								$json = array("status" => 1, "message" => $languageb);
							}else{
								$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
							}
						}else{
							$json = array("status" => 0, "message" => "Checkup rate and Hospital rate must be numeric and between 1 to 5.");
						}
					}else{
						$json = array("status" => 0, "message" => "Mandatory fields have been empty.");
					}
				}else{
					$json = array("status" => 0, "message" => "Token has been not matched.");
				}
			}else{
				$json = array("status" => 0, "message" => "Request has been uncompleted.");
			}	
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}
        
        
        
        public function add_feedback_services_post()
	{ 
            //print_r($_POST);die;
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
                    $lang=isset($_POST['language'])?$_POST['language']:'';
                    if($lang && $lang=='en'){
                        $languageb='Thanks for the feedback on your experience with our services. We sincerely appreciate your insight because it helps us build a better customer experience.';
                    }else{
                        $languageb='Cảm ơn các đóng góp của bạn. Chúng tôi hi vọng sẽ phục vụ bạn tốt hơn trong những lần tiếp theo.';
                    }
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($username) && $username!=''){
							if($this->feedback_model->add_feedback_services()){
								$json = array("status" => 1, "message" =>$languageb );
							}else{
								$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
							}
					}else{
						$json = array("status" => 0, "message" => "Mandatory fields have been empty.");
					}
				}else{
					$json = array("status" => 0, "message" => "Token has been not matched.");
				}
			}else{
				$json = array("status" => 0, "message" => "Request has been uncompleted.");
			}	
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}
        
        public function add_feedback_medical_staff_post()
	{ 
            //print_r($_POST);die;
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
                    $lang=isset($_POST['language'])?$_POST['language']:'';
                    if($lang && $lang=='en'){
                        $languageb='Thanks for the feedback on your experience with our services. We sincerely appreciate your insight because it helps us build a better customer experience.';
                    }else{
                        $languageb='Cảm ơn các đóng góp của bạn. Chúng tôi hi vọng sẽ phục vụ bạn tốt hơn trong những lần tiếp theo.';
                    }
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($username) && $username!=''){
							if($this->feedback_model->add_feedback_medical_staff()){
								$json = array("status" => 1, "message" =>$languageb);
							}else{
								$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
							}
					}else{
						$json = array("status" => 0, "message" => "Mandatory fields have been empty.");
					}
				}else{
					$json = array("status" => 0, "message" => "Token has been not matched.");
				}
			}else{
				$json = array("status" => 0, "message" => "Request has been uncompleted.");
			}	
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}
	
	public function add_doctor_feedback_post()
	{ 
            //print_r($_POST);die;
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
                    $lang=isset($_POST['language'])?$_POST['language']:'';
                    if($lang && $lang=='en'){
                        $languageb='Thanks for the feedback on your experience with our services. We sincerely appreciate your insight because it helps us build a better customer experience.';
                    }else{
                        $languageb='Cảm ơn các đóng góp của bạn. Chúng tôi hi vọng sẽ phục vụ bạn tốt hơn trong những lần tiếp theo.';
                    }
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token'])?($_POST['token']): "";
				$username= isset($_POST['username'])?($_POST['username']): "";
				$name= isset($_POST['name'])?($_POST['name']): "";
				$mobile= isset($_POST['mobile'])?($_POST['mobile']): "";
				$feedback= isset($_POST['feedback'])?($_POST['feedback']): "";
				$doctor_mcr= isset($_POST['doctor_mcr'])?($_POST['doctor_mcr']): "";
				$star_rating= isset($_POST['star_rating'])?($_POST['star_rating']): "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($username) && $username!='' && $doctor_mcr!='' && $feedback!='' && $star_rating!=''){
							if($this->feedback_model->add_doctor_feedback()){
								$json = array("status" => 1, "message" => $languageb);
							}else{
								$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
							}
					}else{
						$json = array("status" => 0, "message" => "Mandatory fields have been empty.");
					}
				}else{
					$json = array("status" => 0, "message" => "Token has been not matched.");
				}
			}else{
				$json = array("status" => 0, "message" => "Request has been uncompleted.");
			}	
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}

	public function get_doctor_feedback_get(){
            $permission=false;
            $response=array();
            $token= isset($_GET['token']) ?($_GET['token']) : "";
			$doctor_mcr= isset($_GET['doctor_mcr']) ?($_GET['doctor_mcr']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true && $doctor_mcr!=''){
            $response=$this->feedback_model->get_doctor_feedback($doctor_mcr);
            if($response){
                $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
            }else{
                $json= array("status" => 0, "message" => 'Ok',"data"=>array());
            }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
        $this->response($json, REST_Controller::HTTP_OK);
        }


	
}
