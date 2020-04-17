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
	
		public function add_appointment_post(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$response=[];
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					extract($_POST);
					if(isset($prn) && isset($slot_number) && isset($hospital_location_code) && isset($doctor_speciality_code) && isset($doctor_mcr) && isset($vaccine_id) && isset($dose_id) && isset($appointment_date) && isset( $appointment_time) && $prn!='' && $slot_number!='' && $hospital_location_code!='' && $doctor_speciality_code!='' && $doctor_mcr!='' && $vaccine_id!='' && $dose_id!='' && $appointment_date!='' && $appointment_time!=''){
						$appointment_type_id=3;
						$case_type=($appointment_type_id=='3')?'NC':'FU';	
						
						// add appointment details in HIS database via wsdl method
						$this->load->model("api_token_model");
						$ID='c4ca4238a0b923820dcc509a6f75849b';   
						$details=$this->api_token_model->loadDataById($ID);
						if($details && isset($details->token_number) && $details->token_number!='' && isset($details->company_code) && $details->company_code!=''){
							try {
								$wsdl = base_url("WSDL/WebMethodMakeAppointment.xml");
								$wsdlLocation=$details->url."hpih_uat/web_services/APPOINTMENT/MakeAppointment.cfc";
								$client=StartSoapClient($wsdl,$wsdlLocation);
								//echo "<pre>";print_r($client);die;	
								$params =[
											'token_number'=>$details->token_number,
											'company_code'=>$details->company_code,
											'prn'=>$prn, 
											'slot_number'=>$slot_number,
											'case_type'=>$case_type
										];
								//echo "<pre>";print_r($params);	
								$result = $client->MakeAppointment($params);
								//echo "<pre>";print_r($result);//die;				
								
								if($result && isset($result->return)){
									$data=$result->return;
									// for check return data have <?xml version="1.0" encoding="UTF-8?"> this line. If data have this line then remove
									$search='<?xml version="1.0" encoding="UTF-8"?>';
									if(strpos($data, $search) !== false){
										$string = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
										
										try{	
											$xml =SimpleXML_Load_String($string, 'SimpleXMLElement', LIBXML_NOCDATA);
											if($xml){
												$array = json_decode(json_encode((array)$xml), TRUE);
												//echo "<pre>";print_r($array);die;
												$response=$array['AppointmentBookingConfirmation'];
											}else{
												$json= array("status" => 0, "message" => 'Error', "data"=>$xml);
												//echo "<pre>";print_r($xml);die();
											}

										}catch(Exception $e) {
											//echo '<br/> Error: ' .$e->getMessage();
											//die();
											$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
										  }
									}else{ 
										// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
										$search='<?xml version="1.0" encoding="UTF-8">';
										if(strpos($data, $search) !== false){
											$data=str_ireplace([$search], '', $data);
											try{
												$xml =  new SimpleXMLElement($data);
												//$xml   = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
												$array = json_decode(json_encode((array)$xml), TRUE);
												
												if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00005'){
													$e="Your token number is expired. Please regenrate Token number and reload this Page.<br/> ";
													$json= array("status" => 0, "message" => 'Error', "data"=>$e);
												}else if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00028'){
													$e="SLOT NUMBER DOES NOT EXIST IN THE SYSTEM, PLEASE CHECK.";
													$json= array("status" => 0, "message" => 'Error', "data"=>$e);	
												}
											}catch(Exception $e) {
												//echo '<br/> Error: ' .$e->getMessage();
												//die();
												$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
											}	
										}	
									}
									
									if($response){
										$json= ["status" =>0, "message" => 'Response not received', "data"=>""];
										if($response['AppointmentStatus']=="CONFIRMED"){
											// add appointment details in HMS database
											$his_appointment_number=isset($response['AppointmentNumber'])?$response['AppointmentNumber']:'';
											
											if($his_appointment_number!=''){
												$this->add_appointment_hms($response);
												$json= ["status" => 1, "message" => 'Ok', "data"=>$response];	
											}else{
												$json= ["status" =>0, "message" => 'Appointment Number not received', "data"=>$response];
											}
										}
									}else{
										//$json= ["status" =>0, "message" => 'Response not received', "data"=>""];
									}
								}			
							}catch(Exception $e){
								//echo '<br/> Error: ' .$e->getMessage();
								//die();
								$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
							}
						}
						//end		
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

	// add appointment details in HMS database
	public function add_appointment_hms($his_response)
	{ 
		if(!$his_response){
			$json = array("status" => 0, "message" => "Somthing went wrong in HMS. Please try again later");
		}
		
		extract($_POST);
		$hospital_location_name=$his_response["Clinic"]; //$this->vaccine_appointment_model->hospitalLocationNameByCode($hospital_location_code);
		$his_appointment_number=$his_response['AppointmentNumber'];
		
		$doctor_name=$his_response['DoctorName'];//$this->vaccine_appointment_model->doctor_name($doctor_mcr);	
		
		$_POST['his_appointment_number']=$his_appointment_number;
		$_POST['hospital_location_name']=$hospital_location_name;
		$_POST['doctor_name']=$doctor_name;

		$response=$this->vaccine_appointment_model->add_appointment();	
		if($response){
			$json = array("status" => 1,"message" => "Ok", "appointment_id"=> $response['appointment_id']);
			
			// for send sms/email alert
			$prn=(isset($parent_prn) && $parent_prn)?$parent_prn:$prn;
			$username=$response['username'];
			$message_type= is_numeric($username)?"sms":"email";
			
			if($message_type=='sms'){
				$message="Lịch hẹn tiêm ngừa vắc xin của bạn với bác sĩ ".$doctor_name." vào ngày ".$appointment_date." ". date("h:i:s A", strtotime($appointment_time))." tại ".$hospital_location_name." đã được xác nhận. Bạn vui lòng có mặt trước 15 phút đẻ chuẩn bị tiêm ngừa.";
				$response=$this->genrate_sms($username,$message);
			}else{
				$subject="Your vaccine appointment has been confirmed.";
				$message='<div style="text-align:center;padding-bottom:20px;"><h2>Vaccine appointment confirmation</h2></div><p>Your appointment with the doctor '.$doctor_name.' on Appointment Date '. $appointment_date.' '.date("h:i:s A", strtotime ($appointment_time)).' at '. $hospital_location_name.' has been confirmed. Please present at hospital before 15 mins for check in purpose.</p>';
				$template_id='1';
				$response=$this->genrate_email($username,$subject,$message,$template_id);
			}
		}
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
				$response=[];
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$prn= isset($_GET['prn']) ?($_GET['prn']) : "";					
					$appointment_id= isset($_GET['appointment_id']) ?($_GET['appointment_id']) : "";
					$his_appointment_number= isset($_GET['his_appointment_number']) ?($_GET['his_appointment_number']) : "";
					if($prn!='' && $appointment_id!='' && $his_appointment_number!=''){
						// add appointment details in HIS database via wsdl method
						$this->load->model("api_token_model");
						$ID='c4ca4238a0b923820dcc509a6f75849b';   
						$details=$this->api_token_model->loadDataById($ID);
						if($details && isset($details->token_number) && $details->token_number!='' && isset($details->company_code) && $details->company_code!=''){
							
							try {
								$wsdl = base_url("WSDL/WebMethodCancelAppointment.xml");
								$wsdlLocation=$details->url."hpih_uat/web_services/APPOINTMENT/CancelAppointment.cfc";
								$client=StartSoapClient($wsdl,$wsdlLocation);
								//echo "<pre>";print_r($client);die();
								$params =[
											'token_number'=>$details->token_number,
											'company_code'=>$details->company_code,
											'prn'=>$prn, 
											'appointment_number'=>$his_appointment_number,
											'reason'=>'Canceled from Mobile App'
										];
								//echo "<pre>";print_r($params);
								$result = $client->CancelAppointment($params);
								//echo "<pre>";print_r($result);die;				
								if($result && isset($result->return)){
									$data=$result->return;
									// for check return data have <?xml version="1.0" encoding="UTF-8?"> this line. If data have this line then remove
									$search='<?xml version="1.0" encoding="UTF-8"?>';
									if(strpos($data, $search) !== false){
										$string = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
										
										try{	
											$xml =SimpleXML_Load_String($string, 'SimpleXMLElement', LIBXML_NOCDATA);
											if($xml){
												$array = json_decode(json_encode((array)$xml), TRUE);
												//echo "<pre>";print_r($array);die;
												$response=$array['AppointmentCancelConfirmation'];
											}else{
												$json= array("status" => 0, "message" => 'Error', "data"=>$xml);
												//echo "<pre>";print_r($xml);die();
											}

										}catch(Exception $e) {
											//echo '<br/> Error: ' .$e->getMessage();
											//die();
											$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
										  }
									}else{ 
										// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
										$search='<?xml version="1.0" encoding="UTF-8">';
										if(strpos($data, $search) !== false){
											$data=str_ireplace([$search], '', $data);
											try{
												$xml =  new SimpleXMLElement($data);
												//$xml   = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
												$array = json_decode(json_encode((array)$xml), TRUE);
												
												if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00005'){
													$json = array("status" => 0, "message" => "Please try again later.");
													$this->response($json, REST_Controller::HTTP_OK);
													redirect(base_url('api_soap/generate_token'));
													die();
												}else if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00034'){
													//print_r($array);die;
													$e="APPOINTMENT NUMBER DOES NOT EXIST IN THE SYSTEM, PLEASE CHECK..";
													$json= array("status" => 0, "message" => 'Error', "data"=>$e);	
												}
											}catch(Exception $e) {
												//echo '<br/> Error: ' .$e->getMessage();
												//die();
												$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
											}	
										}	
									}
									
									// delete appointment details in HMS database
									if($response){
										$this->delete_appointment_hms($appointment_id);
										$json = array("status" => 1, "message" => "Appointment has been canceled successfully.");
									}else{
										//$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
									}
								// end
								}			
							}catch(Exception $e){
								//echo '<br/> Error: ' .$e->getMessage();
								//die();
								$json = array("status" => 0, "message" => $e->getMessage());
							}
						}else{
							$json = array("status" => 0, "message" => "HIS API details mismatch");
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

	
	public function delete_appointment_hms($appointment_id='')
	{ 
		if($appointment_id!=''){
			$response=$this->vaccine_appointment_model->delete_appointment($appointment_id);
			if($response){
				$prn=$response["prn"];
				$username=$response["username"];
				$doctor_name=$response["doctor_name"];
				$hospital_location_name=$response["hospital_location_name"];
				$appointment_date=$response["appointment_date"];
				$appointment_time=$response["appointment_time"];
				
				$message_type= is_numeric($username)?"sms":"email";
				
				if($message_type=='sms'){
					$message="Lịch hẹn của bạn với bác sĩ ".$doctor_name." vào ngày ".$appointment_date." ".date("h:i:s A",strtotime($appointment_time))." tại ".$hospital_location_name." đã được hủy. Nếu bạn muốn đặt lịch hẹn lại, vui lòng thao tác trên ứng dụng của bệnh viện hoặc liên hệ Bộ phận Chăm sóc Khách hàng qua số 19006765 để được hỗ trợ.";
					$response=$this->genrate_sms($username,$message);
				}else{
					$subject="Your appointment has been Canceled.";
					$message='<div style="text-align:center;padding-bottom:20px;"><h2>Appointment cancellation Confirmation</h2></div><p>Your appointment with the doctor '.$doctor_name.' on Appointment Date'. $appointment_date.' '.date("h:i:s A", strtotime ($appointment_time)).' at '. $hospital_location_name.' has been canceled. If you wish to rebook again the appointment, please visit our app or contact to our Customer Service: 19006765 for further assistance.</p>';
					$template_id='1';
					$response=$this->genrate_email($username,$subject,$message,$template_id);
				}	
			}
		}
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
