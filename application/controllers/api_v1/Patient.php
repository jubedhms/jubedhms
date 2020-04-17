<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Patient extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/patient_model');
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
	* Method name: get_basic_details
	* Desc: get all Patient and Sub patient Details status(true for accepted, false for denied)
	* Input: token, username
	*/
	public function get_basic_details_get(){ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($username!=''){
						$response= $this->patient_model->get_basic_details($username);
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
	* Method name: get_select_box
	* Desc: get all Patient and Sub patient Details status(true for accepted, false for denied)
	* Input: token, username
	*/
	public function get_select_box_get(){ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($username!=''){
						$response= $this->patient_model->get_select_box($username);
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
	* Method name: checkExistUsername
	* Desc: check existing Username status(true for accepted, false for denied)
	* Input: token, deviceID, username
	*/
	public function checkExistUsername_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			$permission=false;
			$token=isset($_GET['token'])?($_GET['token']):"";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
				if($username!=''){
					$is_existed=$this->patient_model->checkExist($username);	
					if($is_existed==false){
						$message_type= is_numeric($username)?"sms":"email";
						$otp_length=6;
						$otp=randomNum($otp_length);
						
						if($message_type=='sms'){
							$message="Ma OTP cua quy khach la ".$otp." hieu luc trong vong 30 giay. Vui long su dung ma nay de xac nhan tai khoan tren ung dung di dong Hanh Phuc App. Moi thac mac xin lien he 19006765";	
							
							$response=$this->genrate_sms($username,$message);
						}else{
						    $subject="Account Verification";
						    $message='<div style="text-align:center;padding-bottom:20px;"><h2>Account Verification</h2></div><p>Hi, Before we get started, we will need to verify your email.</p><p><b>'.$otp.'</b> is The OTP for account verification. This OTP is valid for one time or 30 mins only. PLS DO NOT SHARE IT WITH ANYONE(HANH PHUC INTERNATIONAL HOSPITAL OR OTHERWISE).</p><p>If you did not make this request, simply ignore this message.</p>';
						    $template_id='1';
							$response=$this->genrate_email($username,$subject,$message,$template_id);
						}
						
						if($response){
							$otp_expiry=30;			// in minutes
							$otp_expired=date( "Y-m-d H:i:s:a", strtotime('+'.$otp_expiry.' minutes'));
							$json = array("status" => 1, "message" => "OTP has been generated.", "otp_expired"=>$otp_expired, "status_code"=> MD5($otp));
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");	
						}
					}else{
						$json = array("status" => 0, "message" => "This username has been registered already");
					}
				}else{
					$json = array("status" => 0, "message" => "Request has been uncompleted");
				}
			}else{
				$json = array("status" => 0, "message" => "Token has been not matched");
			}
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: add_patient_without_otp
	* Desc: registred status(true for accepted, false for denied)
	* Input: token, username, title, first name, middle name, last name,
	*/
	public function add_patient_without_otp_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);		
					if(isset($device_id) && isset($device_type) && isset($notification_token) && isset($username) && isset($password) && isset($first_name) && isset($last_name) && isset($email_id) && isset($contact_number)  && $device_id!='' && $device_type!='' && $username!='' && $password!='' && $first_name!='' && $last_name!='' && $email_id!='' && $contact_number!=''){
						$is_existed=$this->patient_model->checkExist($username);	
						if($is_existed==false){
							$is_existedEmail=$this->patient_model->checkExistEmail($email_id);
							if($is_existedEmail==false){
								$is_existedContactNumber=$this->patient_model->checkExistContactNumber($contact_number);
								if($is_existedContactNumber==false){
									$_POST['siginup_social_media']='1';
									$patient_id=$this->patient_model->add_patient();	
									if($patient_id!=''){
										$json = array("status" => 1, "message" => "Your account has been created successfully.");
									}else{
										$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
									}	
								}else{
									$json = array("status" => 0, "message" => "This Contact number has been registered already");
								}
							}else{
								$json = array("status" => 0, "message" => "This Email address has been registered already");
							}
						}else{
							$json = array("status" => 0, "message" => "This username has been registered already");
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
	* Method name: add_patient
	* Desc: registred status(true for accepted, false for denied)
	* Input: token, username, title, first name, middle name, last name,
	*/
	public function add_patient_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);		
					if(isset($device_id) && isset($device_type) && isset($notification_token) && isset($otp_matched_code) && isset($username) && isset($password) && isset($first_name) && isset($last_name) && isset($email_id) && isset($contact_number)  && $device_id!='' && $device_type!='' && $otp_matched_code!='' && $username!='' && $password!='' && $first_name!='' && $last_name!='' && $email_id!='' && $contact_number!=''){
						$username= isset($_POST['username']) ?($_POST['username']) : "";
						$otp_code=MD5('OTP'.$username.'C');
						$otp_matched_code= isset($_POST['otp_matched_code']) ?($_POST['otp_matched_code']) : "";
						if($otp_code==$otp_matched_code){
							$is_existedEmail=$this->patient_model->checkExistEmail($email_id);
							if($is_existedEmail==false){
								$is_existedContactNumber=$this->patient_model->checkExistContactNumber($contact_number);
								if($is_existedContactNumber==false){
									$patient_id=$this->patient_model->add_patient();	
									if($patient_id!=''){
										$json = array("status" => 1, "message" => "Your account has been created successfully.");
									}else{
										$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
									}
								}else{
									$json = array("status" => 0, "message" => "This Contact number has been registered already");
								}
							}else{
								$json = array("status" => 0, "message" => "This Email address has been registered already");
							}								
						}else{
							$json = array("status" => 0, "message" => "OTP has not matched.");
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
	* Method name: update_patient
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username
	*/
	public function update_patient_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					$username= isset($_POST['username']) ?($_POST['username']) : "";	
					if($username!='' && isset($first_name) && isset($middle_name) && isset($last_name) && isset($email_id) && isset($contact_number) && isset($personal_ID_code) && isset($gender) && isset($dob) && isset($marital_status) && isset($description) && isset($country_code) && isset($state_code) && isset($city_code) && isset($address_line1) && isset($address_line2) && $first_name!='' && $email_id!='' && $contact_number!='' && $gender!='' && $dob!='' && $marital_status!='' && $country_code!='' && $city_code!='' && $address_line1!=''){
					$is_existedEmail=$this->patient_model->checkExistEmail($email_id,$username);
						if($is_existedEmail==false){
							$is_existedContactNumber=$this->patient_model->checkExistContactNumber($contact_number,$username);
							if($is_existedContactNumber==false){		
								$response=$this->patient_model->update_patient();	
								if($response!=''){
									$json = array("status" => 1, "message" => "Your profile has been updated.");
								}else{
									$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
								}
							}else{
								$json = array("status" => 0, "message" => "This Contact number has been registered already");
							}
						}else{
							$json = array("status" => 0, "message" => "This Email address has been registered already");
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
	* Method name: update_patient_group
	* Desc: update patient group(true for accepted, false for denied)
	* Input: token, username, patient_group
	*/
	public function update_patient_group_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					$patient_group= isset($_POST['patient_group']) ?($_POST['patient_group']): "";
					if($username!='' && $patient_group!=''){
						$response=$this->patient_model->update_patient_group();	
						if($response){
							$json = array("status" => 1, "message" => "Patient group have been updated.");
						}else{
							$json = array("status" => 0, "message" => "Username has been not matched.");
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
	* Method name: update_notification_token
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username, old notification_token, new notification_token
	*/
	public function update_notification_token_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					$notification_token= isset($_POST['notification_token']) ?($_POST['notification_token']) : "";
					if($username!='' && $notification_token!=''){
						$response=$this->patient_model->update_notification_token();	
						if($response){
							$json = array("status" => 1, "message" => "Notification token have been updated.");
						}else{
							$json = array("status" => 0, "message" => "Username has been not matched.");
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
	* Method name: patient_health_info
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username
	*/
	public function patient_health_info_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
			// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($username!=''){
						$response=$this->patient_model->patient_health_info($username);	
						if($response!=''){
							$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
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
	* Method name: update_patient_health_info
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username
	*/
	public function update_patient_health_info_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					if($username!=''){
						$response=$this->patient_model->update_patient_health_info();	
						if($response!=''){
							$json = array("status" => 1, "message" => "Your health detail has been updated.");
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
	* Method name: get_profile
	* Desc: get profile status(true for accepted, false for denied)
	* Input: token, 
	*/
	public function get_profile_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
					if($username!=''){
						$response= $this->patient_model->loadDataById($username);
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
	* Method name: account_verification
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username
	*/
	
	public function account_verification_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
				if($username!=''){
					$is_existed=$this->patient_model->checkExist($username);	
					if($is_existed==true){
						$message_type= is_numeric($username)?"sms":"email";
						$otp_length=6;
						$otp=randomNum($otp_length);
						
						if($message_type=='sms'){
							$message="Ma OTP cua quy khach la ".$otp." hieu luc trong vong 30 giay. Vui long su dung ma nay de xac nhan tai khoan tren ung dung di dong Hanh Phuc App. Moi thac mac xin lien he 19006765";	
							
							$response=$this->genrate_sms($username,$message);
						}else{
							$subject="Account Verification";
						    $message='<div style="text-align:center;padding-bottom:20px;"><h2>Account Verification</h2></div><p>Hi, Before we get started, we will need to verify your email.</p><p><b>'.$otp.'</b> is The OTP for account verification. This OTP is valid for one time or 30 mins only. PLS DO NOT SHARE IT WITH ANYONE(HANH PHUC INTERNATIONAL HOSPITAL OR OTHERWISE).</p><p>If you did not make this request, simply ignore this message.</p>';
						    $template_id='1';
							$response=$this->genrate_email($username,$subject,$message,$template_id);
						}
						
						if($response){
							$otp_expiry=30;			// in minutes
							$otp_expired=date( "Y-m-d H:i:s:a", strtotime('+'.$otp_expiry.' minutes'));
							$verification_code= MD5($username);
							$json = array("status" => 1, "message" => "OTP has been generated.", "otp_expired"=>$otp_expired, "status_code"=> MD5($otp), "verification_code"=>$verification_code);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");	
						}			
					}else{
						$json = array("status" => 0, "message" => "This username has been not registered.");
					}
				}else{
					$json = array("status" => 0, "message" => "Request has been uncompleted");
				}
			}else{
				$json = array("status" => 0, "message" => "Token has been not matched");
			}
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: reset_patient_password
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username, old password, new password
	*/
	public function reset_patient_password_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					$verification_code=isset($_POST['verification_code']) ?($_POST['verification_code']) : "";
					$otp_code=MD5('OTP'.$username.'C');
					$otp_matched_code=isset($_POST['otp_matched_code']) ?($_POST['otp_matched_code']) : "";
					$password= isset($_POST['password']) ?($_POST['password']) : "";
					
					if($verification_code!='' && MD5($username) == $verification_code){
						if($otp_code==$otp_matched_code){
							if($username!='' && $password!=''){
								if($this->patient_model->reset_password($username,$password)){
									$json = array("status" => 1, "message" => "Your password has been reset. Please re-login to your account to confirm the new password.");
								}else{
									$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
								}
							}else{
								$json = array("status" => 0, "message" => "Username or password has been empty.");
							}
						}else{
							$json = array("status" => 0, "message" => "otp matched code is incorrect.");	
						}
					}else{
						$json = array("status" => 0, "message" => "Verification code is incorrect.");
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
	* Method name: update_patient_password
	* Desc: update patient status(true for accepted, false for denied)
	* Input: token, username, old password, new password
	*/
	public function update_patient_password_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					if($username!=''){
						$ID=$this->patient_model->update_password();	
						if($ID!='' && is_numeric($ID)){
							$json = array("status" => 1, "message" => "Your password has been changed. Please re-login to your account to confirm the new password.");
						}else{
							$json = array("status" => 0, "message" => "Old password has been not matched.");
						}
					}else{
						$json = array("status" => 0, "message" => "Username has been empty.");
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
	* Method name: update_patient_image
	* Desc: update profile image status(true for accepted, false for denied)
	* Input: token, username, file
	*/
	public function update_patient_image_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					$file_name=isset($_FILES['image'])?"image" : "";
					if($username!='' && $file_name!=''){
						$src=$this->patient_model->upload_image($username, $file_name);	
						if($src!=''){
							$json = array("status" => 1, "message" => "Your account image has been updated.", "image_src"=>$src);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
						}
					}else{
						$json = array("status" => 0, "message" => "Username or image has been empty.");
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
	* Method name: login
	* Desc: match existing Username and password status(true for accepted, false for denied)
	* Input: token, username, password
	*/
	public function login_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
				$password= isset($_GET['password']) ?($_GET['password']) : "";
				$device_id= isset($_GET['device_id']) ?($_GET['device_id']) : "";
					if($username!='' && $password!='' && $device_id!=''){
						$response=$this->patient_model->checkLogin($username, $password, $device_id);
						$json = array("status" =>  $response["status"], "message" => $response["message"], "data"=>$response['data']);
					}else{
						$json = array("status" => 0, "message" => "Request has been uncompleted.");
				}
			}else{
				$json = array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: checkLoginSocialMedia
	* Desc: match existing Username and password status(true for accepted, false for denied)
	* Input: token, username, password
	*/
	public function checkLoginSocialMedia_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$auth_token= isset($_GET['auth_token']) ?($_GET['auth_token']) : "";
				if($auth_token!='' && $auth_token="021s3meodciial12a129"){
					$username= isset($_GET['username']) ?($_GET['username']) : "";
					$password= isset($_GET['password']) ?($_GET['password']) : "";
					$device_id= isset($_GET['device_id']) ?($_GET['device_id']) : "";
						if($username!='' && $password!='' && $device_id!=''){
							$response=$this->patient_model->checkLoginSocialMedia($username, $password, $device_id);
							$json = array("status" =>  $response["status"], "message" => $response["message"], "data"=>$response['data']);
						}else{
							$json = array("status" => 0, "message" => "Request has been uncompleted.");
					}
				}else{
					$json = array("status" => 0, "message" => "Auth Token has been not matched.");
				}	
			}else{
				$json = array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: update_patient_prn
	* Desc: update patient prn (true for accepted, false for denied)
	* Input: token, username
	*/
	public function update_patient_prn_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$username= isset($_POST['username']) ?($_POST['username']) : "";
					if($username!=''){
						$PRN=$this->patient_model->update_prn_by_username($username);	
						if($PRN!=''){
							if($PRN == "Already Existed"){
								$json = array("status" => 0, "message" => "Your PRN number has been existed already.");
							}else{
								$json = array("status" => 1, "message" => "Your PRN number has been updated.", "prn"=> $PRN);
							}
						}else{
							$json = array("status" => 0, "message" => "PRN number has not been founded.");
						}
					}else{
						$json = array("status" => 0, "message" => "Username has been empty.");
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
	* Method name: logout
	* Desc: match existing Username and password status(true for accepted, false for denied)
	* Input: token, username, password
	*/
	public function logout_post(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			// GET data
	 		$permission=false;
	 		echo $token= isset($_POST['token']) ?($_POST['token']) : ""; die;
	 		$permission=$this->matchAppToken($token);
	 		if($permission==true){
	 			$username= isset($_POST['username']) ?($_POST['username']) : "";
				
	 				if($username!=''){
	 					$response=$this->patient_model->checkLogout($username);
	 					if($response){
	 						$json = array("status" => 1, "message" => "Successfully logout.");
	 					}else{
	 						$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");
	 					}
	 				}else{
	 					$json = array("status" => 0, "message" => "Request has been uncompleted.");
	 			}
	 		}else{
	 			$json = array("status" => 0, "message" => "Token has been not matched.");
	 		}
	 	}else{
	 		$json = array("status" => 0, "message" => "Request method not accepted.");
	 	}
		
	 	$this->response($json, REST_Controller::HTTP_OK);
	}
	
	/*
	* Method name: otp_verification
	* Desc: otp verification status(true for accepted, false for denied)
	* Input: token, OTP, status_code
	*/
	// not used now
	public function otp_verification_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
			$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username= isset($_GET['username']) ?($_GET['username']) : "";
				$status_code= isset($_GET['status_code']) ?($_GET['status_code']) : "";
				$otp= isset($_GET['otp']) ?($_GET['otp']) : "";
				if($username!='' && $status_code!='' && $otp!=''){
					$otp_matched_code=MD5('OTP'.$username.'C');
					if($status_code == MD5($otp)){
						$json = array("status" =>1, "message" => "OTP has been matched.", "otp_matched_code"=>$otp_matched_code);
					}else{
						$json = array("status" => 0, "message" => "OTP has not been matched.");
					}
				}else{
					$json = array("status" => 0, "message" => "Request has been uncompleted.");
				}
			}else{
				$json = array("status" => 0, "message" => "Token has been not matched.");	
			}		
		}else{
			$json = array("status" => 0, "message" => "Request method not accepted.");
		}

		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: genrate_sms
	* Desc: sms generate on mobile status(true for accepted, false for denied)
	*/
	private function genrate_sms($contact_number='', $message=''){
		$response_status = array();	
		if($contact_number!='' && $message!=''){
			$contact_number="0".$contact_number;
			$response=send_sms($contact_number,$message);
			$jsonData=isset($response)?json_decode($response):'';
			//print_r($jsonData);	echo $jsonData->response->submission->sms['0']->status;die;
			if(isset($jsonData) && $jsonData!='' && isset($jsonData->response->submission->sms['0']->status) && $jsonData->response->submission->sms['0']->status=="0"){
				$response_status= array("status"=>"1", "message" => "SMS has been generated.");	
				return $response_status;
			}
		}
		return $response_status;	
			
	}

	/*
	* Method name: genrate_email
	* Desc: Email generate on email ID status(true for accepted, false for denied)
	*/
	private function genrate_email($username="",$subject="",$message="",$template_id='1'){
		$response_status = array();
		if($username!='' && $subject!="" && $message!='' && $template_id!=''){
			$this->load->model('email_template_model');
			$email_template=$this->email_template_model->loadDataById($template_id, $is_active='1');
			if(isset($email_template) && $email_template->mail_body!=''){
				$from = $email_template->sender;
				$to = $username;

				$mail_body=str_ireplace('[WEBSITE_LOGO]',base_url('assets/img/logo.png'), $email_template->mail_body);
				$mail_body=str_ireplace('[WEBSITE_NAME]',"HANH PHUC",$mail_body);
				$mail_body=str_ireplace('[MSG]',$message,$mail_body);
				$mail_body=str_ireplace('[THANK_IMG_SRC]',base_url('assets/img/thanks.png'),$mail_body);
			   $message= $mail_body;
				
				//if($_SERVER['SERVER_NAME']!="localhost"){
					$this->common_model->setSiteConfig($ID='1');
					$response_status=send_mail($from, $to, $subject, $message);
				//}	
			}	
		}	
		return $response_status;
	}
	
}
