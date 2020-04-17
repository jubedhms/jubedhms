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
		$this->load->model('api_v1/sub_patient_model');
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
	* Input: token, parent_username, prn, etc
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
					if(isset($device_id) && isset($parent_username) && isset($parent_relation) &&  isset($title) && isset($first_name) && isset($middle_name) && isset($last_name) && isset($gender) && isset($dob) && isset($_FILES['image']) && isset($description) && $device_id!='' && $parent_username!='' && $parent_relation!='' && $first_name!='' && $gender!='' && $dob!='' && $_FILES['image']['name']!=''){	
						$PRN=$this->sub_patient_model->add_sub_patient();	
						if($PRN!=''){
							$json = array("status" => 1, "message" => "Patient has been added successfully.", "prn"=>$PRN);
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
	* Input: token, parent_username, prn, etc
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
					if(isset($parent_username) && isset($parent_relation) && isset($prn) && isset($title) && isset($first_name) && isset($middle_name) && isset($last_name)  && isset($gender) && isset($dob) && isset($description) && $parent_username!='' && $parent_relation!='' && $prn!='' && $first_name!='' && $gender!='' && $dob!='' ){
						$prn=$this->sub_patient_model->update_sub_patient();	
						if($prn!=''){
							$json = array("status" => 1, "message" => "Patient details have been updated.","prn"=>$prn);
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
	* Input: token, parent_username, prn
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
					$prn= isset($_GET['prn']) ?($_GET['prn']) : "";
					if($parent_username!='' && $prn!=''){
						$response=$this->sub_patient_model->sub_patient_health_info($parent_username,$prn);	
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
	* Input: token, parent_username, prn
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
					$prn= isset($_POST['prn']) ?($_POST['prn']) : "";
					if($parent_username!='' && $prn!=''){
						$response=$this->sub_patient_model->update_sub_patient_health_info();	
						if($response!=''){
							$json = array("status" => 1, "message" => "Patient health details have been updated.");
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
	* Input: token, parent_username, prn 
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
				$prn= isset($_GET['prn']) ?($_GET['prn']) : "";
					if($parent_username!='' && $prn!=''){
							$response= $this->sub_patient_model->loadDataById($parent_username,$prn);
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
	* Input: token, parent_username, prn, file
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
					$prn= isset($_POST['prn']) ?($_POST['prn']) : "";
					$file_name=isset($_FILES['image'])?"image" : "";
					if($parent_username!='' && $prn!='' && $file_name!=''){	
						$src=$this->sub_patient_model->upload_image($parent_username,$prn, $file_name);
						if($src!=''){
							$json = array("status" => 1, "message" => "Patient Profile image have been updated.", "image_src"=>$src);
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
	* Input: token, parent_username, prn
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
					$prn= isset($_GET['prn']) ?($_GET['prn']) : "";
					if($parent_username!='' && $prn!=''){
						if($this->sub_patient_model->delete_sub_patient($parent_username,$prn)){
							$json = array("status" => 1, "message" => "Patient ID has been deleted successfully.");
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Parent PRN or Patient PRN has been empty.");
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
