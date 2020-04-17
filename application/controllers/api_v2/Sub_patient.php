<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Sub_patient extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v2/sub_patient_model');
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
	* Desc: get profile status(true for accepted, false for denied)
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
				$parent_username= isset($_GET['parent_username']) ?($_GET['parent_username']) : "";
					if($parent_username!=''){
							$response= $this->sub_patient_model->getData($parent_username);
						if($response){
							$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
						}else{
							$json= array("status" => 1, "message" => 'Ok', "data"=>array());
						}
					}else{
						$json = array("status" => 0, "message" => "Request has been uncompleted.");
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
	* Method name: add_sub_patient
	* Desc: registred sub patient status(true for accepted, false for denied)
	* Input: token, parent_username, username, etc
	*/
	public function add_sub_patient_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);		
					if(isset($device_id) && isset($parent_username) && isset($parent_relation) && isset($first_name) && isset($middle_name) && isset($last_name) && isset($gender) && isset($dob) && isset($_FILES['image']) && isset($description) && isset($country_code) && $device_id!='' && $parent_username!='' && $parent_relation!='' && $first_name!='' && $gender!='' && $dob!='' && $_FILES['image']['name']!='' && $country_code!=''){	
						$response=$this->sub_patient_model->add_sub_patient();	
						if($response){
							$json = array("status" => 1, "message" => "Your new sub-account has been generated.");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
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

	/*
	* Method name: update_sub_patient
	* Desc: update sub patient status(true for accepted, false for denied)
	* Input: token, parent_username, username, etc
	*/
	public function update_sub_patient_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);	
					if(isset($parent_username) && isset($parent_relation) && isset($username) && isset($first_name) && isset($middle_name) && isset($last_name)  && isset($gender) && isset($dob) && isset($description) && isset($country_code) && $parent_username!='' && $parent_relation!='' && $username!='' && $first_name!='' && $gender!='' && $dob!='' && $country_code!=''){
						$response=$this->sub_patient_model->update_sub_patient();	
						if($response){
							$json = array("status" => 1, "message" => "Your sub-account profile has been updated.");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
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
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: sub_patient_health_info
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, parent_username, username
	*/
	public function sub_patient_health_info_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
			// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$parent_username= isset($_GET['parent_username']) ?($_GET['parent_username']) : "";
					$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($parent_username!='' && $username!=''){
						$response=$this->sub_patient_model->sub_patient_health_info($parent_username,$username);	
						if($response!=''){
							$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try agin later.");
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
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: update_sub_patient_health_info
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, parent_username, username
	*/
	public function update_sub_patient_health_info_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$parent_username= isset($_POST['parent_username']) ?($_POST['parent_username']) : "";
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					if($parent_username!='' && $username!=''){
						$response=$this->sub_patient_model->update_sub_patient_health_info();	
						if($response!=''){
							$json = array("status" => 1, "message" => "Your sub-account health detail has been updated.");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try agin later.");
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
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: get_profile
	* Desc: get profile status(true for accepted, false for denied)
	* Input: token, parent_username, username 
	*/
	public function get_profile_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$parent_username= isset($_GET['parent_username']) ?($_GET['parent_username']) : "";
				$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($parent_username!='' && $username!=''){
							$response= $this->sub_patient_model->loadDataById($parent_username,$username);
						if($response){
							$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
						}else{
							$json= array("status" => 1, "message" => 'Ok', "data"=>array());
						}
					}else{
						$json = array("status" => 0, "message" => "Request has been uncompleted.");
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
	* Method name: update_sub_patient_image
	* Desc: update profile image status(true for accepted, false for denied)
	* Input: token, parent_username, username, file
	*/
	public function update_sub_patient_image_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$parent_username= isset($_POST['parent_username']) ?($_POST['parent_username']) : "";
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					$file_name=isset($_FILES['image'])?"image" : "";
					if($parent_username!='' && $username!='' && $file_name!=''){	
						$src=$this->sub_patient_model->upload_image($parent_username,$username, $file_name);
						if($src!=''){
							$json = array("status" => 1, "message" => "Your sub-account image has been updated.", "image_src"=>$src);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
						}
					}else{
						$json = array("status" => 0, "message" => "Parent PRN or Patient PRN or image has been empty.");
					}
				}else{
					$json = array("status" => 0, "message" => "Token has been not matched.");
				}	
			}else{
				$json = array("status" => 0, "message" => "Request has been uncompleted.");
			}
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		$this->response($json, REST_Controller::HTTP_OK);
	}

	
	/*
	* Method name: delete_sub_patient
	* Desc: delete sub patient status(true for accepted, false for denied)
	* Input: token, parent_username, username
	*/
	public function delete_sub_patient_delete()
	{ 
		if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
			// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$parent_username= isset($_GET['parent_username']) ?($_GET['parent_username']) : "";
					$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($parent_username!='' && $username!=''){
						if($this->sub_patient_model->delete_sub_patient($parent_username,$username)){
							$json = array("status" => 1, "message" => "Your sub-account has been removed successfully.");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Parent username or Patient username has been empty.");
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
