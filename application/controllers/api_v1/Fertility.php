<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Fertility extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/fertility_model');
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
	* Desc: get fertility date details status(true for accepted, false for denied)
	* Input: token, username, from date, to date
	*/
	public function get_list_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
				$start_date= isset($_GET['start_date']) ?($_GET['start_date']) : "";
				$end_date= isset($_GET['end_date']) ?($_GET['end_date']) : "";
				if($username!=''){
					$response= $this->fertility_model->getData($username,$start_date,$end_date);
					if($response){
						$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
					}else{
						$json= array("status" => 0, "message" => 'NO data available', "data"=>[]);
					}
				}else{
					$json= array("status" => 0, "message" => "Mendetory fields has been not empty.");
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
	* Method name: add_fertility
	* Desc: add Due Date details status(true for accepted, false for denied)
	* Input: token, username, start_date, end_date
	*/
	public function add_fertility_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// POST data
			$checkExist=$permission=false;
			$token= isset($_POST['token']) ?($_POST['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_POST['username']) ?($_POST['username']) : "";
				$start_date= isset($_POST['start_date']) ?($_POST['start_date']) : "";
				$end_date= isset($_POST['end_date']) ?($_POST['end_date']) : "";
				if($username!='' && $start_date!='' && $end_date!=''){
					$response= $this->fertility_model->add_fertility($username,$start_date,$end_date);
					if($response){
						$json= array("status" => 1, "message" => 'Ok');
					}else{
						$json= array("status" => 0, "message" => 'Some thing went wrong. Please try again later.');
					}
				}else{
					$json= array("status" => 0, "message" => "Mendetory fields has been not empty.");
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
