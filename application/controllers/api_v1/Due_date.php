<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Due_date extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/due_date_model');
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
	* Method name: loadDataByWeek
	* Desc: get Due Date details status(true for accepted, false for denied)
	* Input: token, week, language
	*/
	public function loadDataByWeek_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$pregnancy_week= isset($_GET['pregnancy_week']) ?($_GET['pregnancy_week']) : "";
				$language= (isset($_GET['language']) && ($_GET['language']=='en' || $_GET['language']=='vi')) ?($_GET['language']) :"en";
				$response= $this->due_date_model->loadDataByWeekData($pregnancy_week,$language);
				if($response){
					$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
				}else{
					$json= array("status" => 0, "message" => 'NO data available', "data"=>[]);
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
