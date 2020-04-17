<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Cities extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/cities_model');
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
	* Method name: 
	* Desc: get countries details status(true for accepted, false for denied)
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
				$province_code= isset($_GET['province_code']) ?($_GET['province_code']) :"";
				$city_code= isset($_GET['city_code']) ?($_GET['city_code']) : "";	
				$response= $this->cities_model->getData($province_code, $city_code);
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



}
