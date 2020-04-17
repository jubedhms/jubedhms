<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Doctor_specialization extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/doctor_specialization_model');
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
	* Method name: get_list
	* Desc: get list status(true for accepted, false for denied)
	* Input: patient_id
	*/
	public function get_list_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$language=isset($_GET['language']) ?($_GET['language']) : "en";
					$response=$this->doctor_specialization_model->get_data($language);	
					if($response){
						$json = array("status" => 1, "message" => "Ok", "data"=> $response);
					}else{
						$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
					}
				}else{
					$json = array("status" => 0, "message" => "Token has been not matched");
				}	
			}else{
				$json = array("status" => 0, "message" => "Request has been uncompleted");
			}
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}

	
}
