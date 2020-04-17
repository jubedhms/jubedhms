<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Vaccine_appointment extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/vaccine_appointment_model');
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
	* Input: username
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
					$prn=isset($_GET['prn']) ?($_GET['prn']) : "";
					if($prn!=''){
						$response=$this->vaccine_appointment_model->get_data($prn);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "No data found");
						}
					}else{
						$json = array("status" => 0, "message" => "Patient PRN has been empty.");
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
	* Input: ID
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
					$appointment_id=isset($_GET['appointment_id']) ?($_GET['appointment_id']) : "";
					if($appointment_id!=''){
						$response=$this->vaccine_appointment_model->loadDataById($appointment_id);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "No data found");
						}
					}else{
						$json = array("status" => 0, "message" => "Appointment ID has been empty.");
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
	* Method name: add_appointment
	* Desc: book appointment status(true for accepted, false for denied)
	* Input: many fields
	*/
	public function add_appointment_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($prn) && isset($hospital_location_code) && isset($doctor_speciality_code) && isset($doctor_mcr) && isset($vaccine_id) && isset($dose_id) && isset($appointment_date) && isset( $appointment_time) && $prn!='' && $hospital_location_code!='' && $doctor_speciality_code!='' && $doctor_mcr!='' && $vaccine_id!='' && $dose_id!='' && $appointment_date!='' && $appointment_time!=''){
						$hospital_location_name=$this->vaccine_appointment_model->hospitalLocationNameByCode($hospital_location_code);
						$doctor_name=$this->vaccine_appointment_model->doctor_name($doctor_mcr);	
						$_POST['hospital_location_name']=$hospital_location_name;
						$_POST['doctor_name']=$doctor_name;

						$appointment_id=$this->vaccine_appointment_model->add_appointment();	
						if($appointment_id){
							$json = array("status" => 1,"message" => "Ok", "appointment_id"=> $appointment_id);
							
							// for send sms/email alert
							$prn=(isset($parent_prn) && $parent_prn)?$parent_prn:$prn;
							$this->load->model('api_v1/patient_model');
							$username=$this->patient_model->getUsernameByPRN($prn);	
							$message_type= is_numeric($username)?"sms":"email";
							if($message_type=='sms'){
								$message="Lịch hẹn của bạn với bác sĩ ".$doctor_name." vào ".$appointment_date." ".date("h:i:s A",strtotime($appointment_time))." tại ".$hospital_location_name." đã được xác nhận. Vui lòng đến trước giờ hẹn 20 phút. Nếu cần hỗ trợ thêm, bạn vui lòng liên hệ bộ phận CSKH: 19006765";
								$response=$this->genrate_sms($username,$message);
							}else{
								$subject="Vaccine Appointment Confirmed";
								$message='<div style="text-align:center;padding-bottom:20px;"><h2>Vaccine Appointment Confirmed</h2></div><p>Your appointment with the doctor '.$doctor_name.' go to '. $appointment_date.' '.date("h:i:s A", strtotime ($appointment_time)).' at '. $hospital_location_name.' has been confirmed. Please arrive 20 minutes before the scheduled time. If you need further assistance, please contact Customer Service: 19006765.</p>';
								$template_id='1';
								$response=$this->genrate_email($username,$subject,$message,$template_id);
							}
							/*
							if($response){
								$json = array("status" => 1, "message" => "Ok", "appointment_id"=>$appointment_id);
							}else{
								$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later.");	
							}
							*/
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
	* Method name: update_appointment
	* Desc: book appointment status(true for accepted, false for denied)
	* Input: many fields
	*/
	public function update_appointment_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($prn)  && isset($hospital_location_code) && isset($doctor_speciality_code) && isset($doctor_mcr) && isset($vaccine_id) && isset($dose_id) && isset($appointment_date) && isset( $appointment_time) && $prn!='' && $hospital_location_code !='' && $doctor_speciality_code!='' && $doctor_mcr!='' && $vaccine_id!='' && $dose_id!='' && $appointment_date!='' && $appointment_time!=''){
						$appointment_id=$this->vaccine_appointment_model->update_appointment();	
						if($appointment_id){
							$json = array("status" => 1, "appointment_id"=> $appointment_id, "message" => "Ok");
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
	* Method name: delete_appointment
	* Desc: book appointment status(true for accepted, false for denied)
	* Input: many fields
	*/
	public function delete_appointment_delete()
	{ 
		if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$appointment_id= isset($_GET['appointment_id']) ?($_GET['appointment_id']) : "";
					if($appointment_id!=''){
						$response=$this->vaccine_appointment_model->delete_appointment($appointment_id);
						if($response){
							$json = array("status" => 1, "message" => "Appointment has been deleted successfully.");
							$prn=$response["prn"];
							$doctor_name=$response["doctor_name"];
							$hospital_location_name=$response["hospital_location_name"];
							$appointment_date=$response["appointment_date"];
							$appointment_time=$response["appointment_time"];
							
							$this->load->model('api_v1/patient_model');
							$username=$this->patient_model->getUsernameByPRN($prn);
							$message_type= is_numeric($username)?"sms":"email";
							
							if($message_type=='sms'){
								$message="Lịch hẹn của bạn với bác sĩ ".$doctor_name." vào ".$appointment_date." ".date("h:i:s A",strtotime($appointment_time))." tại ".$hospital_location_name." đã được hủy bỏ. Vui lòng đến trước giờ hẹn 20 phút. Nếu cần hỗ trợ thêm, bạn vui lòng liên hệ bộ phận CSKH: 19006765";
								$response=$this->genrate_sms($username,$message);
							}else{
								$subject="Vaccine Appointment Canceled";
								$message='<div style="text-align:center;padding-bottom:20px;"><h2>Vaccine Appointment Confirmed</h2></div><p>Your vaccine appointment with the doctor '.$doctor_name.' go to '. $appointment_date.' '.date("h:i:s A", strtotime ($appointment_time)).' at '. $hospital_location_name.' has been canceled. If you need further assistance, please contact Customer Service: 19006765.</p>';
								$template_id='1';
								$response=$this->genrate_email($username,$subject,$message,$template_id);
							}
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
						}
					}else{
						$json = array("status" => 0, "message" => "Appointment Id has been empty.");
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
				
				if($_SERVER['SERVER_NAME']!="localhost"){
					$this->common_model->setSiteConfig($ID='1');
					$response_status=send_mail($from, $to, $subject, $message);
				}	
			}	
		}	
		return $response_status;
	}
	
}
