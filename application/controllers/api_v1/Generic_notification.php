<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Generic_notification extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/generic_notification_model');
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
	* Desc: get generic notification details status(true for accepted, false for denied)
	* Input: token, 
	*/
	public function get_list_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$language= isset($_GET['language']) ?($_GET['language']) : "en";	
				$response= $this->generic_notification_model->get_data($language);
				if($response){
					$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
				}else{
					$json= array("status" => 0, "message" => 'Record has not been available.', "data"=>[]);
				}
			}else{
				$json= array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json= array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: loadDataByID 
	* Desc: get generic notification details status(true for accepted, false for denied)
	* Input: token, 
	*/
	public function loadDataByID_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$ID= isset($_GET['notification_id']) ?($_GET['notification_id']) :"";
				if($ID!=''){
					$language= isset($_GET['language']) ?($_GET['language']) : "en";	
					$response= $this->generic_notification_model->loadDataByID($ID, $language);
					if($response){
						$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
					}else{
						$json= array("status" => 0, "message" => 'Record has not been available.', "data"=>[]);
					}
				}else{
					$json= array("status" => 0, "message" => 'ID has not been empty.');
				}	
			}else{
				$json= array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json= array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

}
