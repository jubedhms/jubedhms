<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Notification extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/notification_model');
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
	* Method name: get_total_notification
	* Desc: get list status(true for accepted, false for denied)
	*/
	public function get_total_notification_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']):"";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$username= isset($_GET['username'])?($_GET['username']):"";	
					if($username!=''){
						$response=$this->notification_model->get_count($username);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "total_data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "username has been empty.");
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
	* Method name: get_list
	* Desc: get list status(true for accepted, false for denied)
	*/
	public function get_list_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']):"";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$username= isset($_GET['username'])?($_GET['username']):"";	
					if($username!=''){
						$response=$this->notification_model->get_data($username);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "username has been empty.");
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
	* Method name: update_as_read
	* Desc: get list status(true for accepted, false for denied)
	*/
	public function update_as_read_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$username= isset($_POST['username'])?($_POST['username']):"";	
					if($username!=''){
						$response=$this->notification_model->update_as_read($username);	
						if($response){
							$json = array("status" => 1, "message" => "All Notification has been mark as read successfully.");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Patient username has been empty.");
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
	* Method name: loadDataById
	* Desc: get list status(true for accepted, false for denied)
	*/
	public function loadDataById_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$notification_id= isset($_GET['notification_id']) ?($_GET['notification_id']) : "";	
					if($notification_id!=''){
						$response=$this->notification_model->loadDataById($notification_id);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Notification ID has been empty.");
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
