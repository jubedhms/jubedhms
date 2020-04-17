<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Bookmark_awareness extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->model('api_v1/bookmark_awareness_model');
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
					$username=isset($_GET['username'])?$_GET['username']:"";
					if($username!=''){
						$language= isset($_GET['language']) ?($_GET['language']) : "en";	
						$response=$this->bookmark_awareness_model->get_data($username,$language);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Mandatory fields have been empty.");	
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
	
	/*
	* Method name: toggle_bookmark
	* Desc: add, remove value status(true for accepted, false for denied)
	* Input: awareness_id, patient username
	*/
	public function toggle_bookmark_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username=isset($_POST['username'])?$_POST['username']:"";
					$awareness_id=isset($_POST['awareness_id'])?$_POST['awareness_id']:"";
					if($username!='' && $awareness_id!=''){
						$response=$this->bookmark_awareness_model->toggle_bookmark($username,$awareness_id);	
						if($response){
							$json = array("status" => 1, "message" => "Ok");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Mandatory fields have been empty.");	
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
