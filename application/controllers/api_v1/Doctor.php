<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Doctor extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/doctor_model');
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
	* Input: token
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
					$response=$this->doctor_model->get_data();	
					if($response){
						$json = array("status" => 1, "message" => "Ok", "data"=> $response);
					}else{
						$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
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
	* Method name: loadDataByMCR
	* Desc: get list status(true for accepted, false for denied)
	* Input: patient_id
	*/
	public function loadDataByMCR_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$doctor_mcr=isset($_GET['doctor_mcr'])?$_GET['doctor_mcr']:"";
					$language=isset($_GET['language'])?$_GET['language']:"en";
					if($doctor_mcr!=''){
						$response=$this->doctor_model->loadDataById($doctor_mcr,$language);	
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
	* Method name: get_select_box
	* Desc: get list status(true for accepted, false for denied)
	* Input: token, department_code
	*/
	public function get_select_box_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$response=$this->doctor_model->get_select_box();	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "Somthing went wrong. Please try again later");
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
	* Method name: get_time_schedule
	* Desc: get list status(true for accepted, false for denied)
	* Input: doctor_id, date
	*/
	
	public function get_time_schedule_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$doctor_mcr=isset($_GET['doctor_mcr']) ?($_GET['doctor_mcr']) : "";
					//$hospital_location_code=isset($_GET['hospital_location_code']) ?($_GET['hospital_location_code']) : "";
					$date=isset($_GET['date']) ?($_GET['date']) : "";
					
					if($doctor_mcr!='' && $date!=''){
						// for update doctor available
						$DoctorAvailabilityData=$this->GetDoctorAvailabilityData($doctor_mcr,$date);
						//end
						
						$response=$this->doctor_model->get_data_time_schedule($doctor_mcr,$DoctorAvailabilityData);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "data"=> $response);
						}else{
							$json = array("status" => 0, "message" => "Doctor is not available for choose date.");
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
	
	public function GetDoctorAvailabilityData($doctor_mcr='',$date='')
	{ 
		$mainData=$response=[];
		if($doctor_mcr!='' && $date!=''){				
			$ID='c4ca4238a0b923820dcc509a6f75849b';  
			$this->load->model("api_token_model");	
			$details=$this->api_token_model->loadDataById($ID);

			if($details && isset($details->token_number) && $details->token_number!='' && isset($details->company_code) && $details->company_code!=''){
				try {
					$wsdl = base_url("WSDL/WebMethodGetDoctorAvailabilityData.xml");
					$wsdlLocation=$details->url."hpih_uat/web_services/APPOINTMENT/GetDoctorAvailabilityData.cfc";
					$client=StartSoapClient($wsdl,$wsdlLocation);
					//echo "<pre>";print_r($client);
					
					$params =[
								'token_number'=>$details->token_number, 
								'company_code'=>$details->company_code, 
								'mcr'=>$doctor_mcr, 
								'start_date'=> date("d-M-Y", strtotime($date))
							];
					//print_r($params);die();			
					$result = $client->GetDoctorAvailabilityData($params);
					//echo "<pre>";print_r($result);//die;
					if($result && isset($result->return)){
						$data=$result->return;
						// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
						$search='<?xml version="1.0" encoding="UTF-8"?>';
						if(strpos($data, $search) !== false){
							$string = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
							// numeric tag created issue for function SimpleXML_Load_String so i will convert it into string
							$string = preg_replace('~</(/?\d)~', '</date_$1', $string);
							$string = preg_replace('~<(/?\d)~', '<date_$1', $string);
							//end
							//echo "<pre>";print_r($string);die();

							try{	
								$xml =SimpleXML_Load_String($string, 'SimpleXMLElement', LIBXML_NOCDATA);
								if($xml){
									$array = json_decode(json_encode((array)$xml), TRUE);
									$response=$array['Availability'];
								}else{
									//echo "<pre>";print_r($xml);die();
								}

							}catch(Exception $e) {
								return true;
								//echo '<br/> Error: ' .$e->getMessage();
								//die();
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
									}
								}catch(Exception $e) {
									return true;
									//echo '<br/> Error: ' .$e->getMessage();
									//die();
								}	
							}
							
						}
						
						if($response){
							foreach($response as $key=>$value){
								$isMultidimensional =(isset($value['Session']) && isset($value['Session'][0]))?true:false;
								if(!$isMultidimensional){
									$Session=["0"=>$value['Session']];  // make Multidimensional array
								}else{
									$Session=$value['Session'];
								}
								
								if($Session){
									foreach($Session as $key1=>$value1){ 
										$session_starttime=(isset($value1['StartTime']) && !is_array($value1['StartTime']))?$value1['StartTime']:'';
										$session_endtime=(isset($value1['EndTime']) && !is_array($value1['StartTime']))?$value1['EndTime']:'';
										if($session_starttime!='' && $session_endtime!=''){
											$availability_date=str_replace("date_",'',$key);
											$availability_date=date('Y-m-d',strtotime($availability_date));
											if($availability_date==$date){
												$mainData[]=[
														'doctor_mcr' => $doctor_mcr,
														'date'=>$availability_date,
														'session_starttime' => $session_starttime,
														'session_endtime' => $session_endtime,
														];									
											}					
										}
									}
								}
							 }								
							// for update in database
							$this->load->model("api_soap/get_doctor_availability_model");
							$this->get_doctor_availability_model->delete_doctor_availability_data($doctor_mcr);
							$this->get_doctor_availability_model->add_data($doctor_mcr,$response);
						}
					}
				}catch(Exception $e) {
					return true;
					//echo '<br/> Error: ' .$e->getMessage();
					//die();
				}
			}
		}
		return $mainData;	
	}
	
	
	/*
	* Method name: get_doctor_available_slots
	* Desc: get doctor Next Available Slots details status(true for accepted, false for denied)
	* Input: token,doctor_mcr,doctor_specialty_code,patient_prn,date,time,case_type 
	*/
	
	public function get_doctor_available_slots_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
			//echo "<pre>";print_r($_GET);die;
			// GET data
			$checkExist=$permission=false;
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$hospital_location_code=isset($_GET['hospital_location_code']) ?($_GET['hospital_location_code']) : "";
				$doctor_mcr=isset($_GET['doctor_mcr']) ?($_GET['doctor_mcr']) : "";
				$doctor_specialty= isset($_GET['doctor_specialty_code']) ?($_GET['doctor_specialty_code']) : "";
				$patient_prn= isset($_GET['patient_prn']) ?($_GET['patient_prn']) : "";
				$start_date=isset($_GET['date']) ?date('d-M-Y',strtotime($_GET['date'])):"";
				// we need minus 5 minutes because API return appointment time pass time + 5 minutes
				$start_time=isset($_GET['time'])?date('H:i',strtotime('-5 minutes',strtotime($_GET['time']))):"";
				$case_type=(isset($_GET['case_type']) && $_GET['case_type']=='2')?"FU":"NC";
				$response=$return=$doctorNames=$doctor_list=$slot_list=[];
				
				if($doctor_specialty!='' && $patient_prn!='' && $start_date!=''){
					$ID='c4ca4238a0b923820dcc509a6f75849b';  
					$this->load->model("api_token_model");	
					$details=$this->api_token_model->loadDataById($ID);
					
					if($details && isset($details->token_number) && $details->token_number!='' && isset($details->company_code) && $details->company_code!=''){
						try {
							
							$wsdl = base_url("WSDL/WebMethodGetNextAvailableSlots.xml");
							$wsdlLocation=$details->url."hpih_uat/web_services/APPOINTMENT/GetNextAvailableSlots.cfc";
							$client=StartSoapClient($wsdl,$wsdlLocation);
							//echo "<pre>";print_r($client);
							
							$params =array(
									'token_number'=>$details->token_number,
									'company_code'=>$details->company_code,
									'prn'=>$patient_prn, 
									'specialty_code'=>$doctor_specialty,
									'mcr'=>$doctor_mcr,
									'start_date'=> $start_date, 
									'start_time'=>$start_time,
									'case_type'=> $case_type,
								);

							$result = $client->getNextAvailableSlots($params);
							//echo "<pre>";print_r($result);	die();			
							
							if($result && isset($result->return)){
								$data=$result->return;
								// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
								$search='<?xml version="1.0" encoding="UTF-8"?>';
								if(strpos($data, $search) !== false){
									$string = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
									
									try{	
										$xml =SimpleXML_Load_String($string, 'SimpleXMLElement', LIBXML_NOCDATA);
										if($xml){
											$array = json_decode(json_encode((array)$xml), TRUE);
											//print_r($array);die;
											$response=$array['Slot'];
										}else{
											//echo "<pre>";print_r($xml);die();
											$json= array("status" => 0, "message" => 'Error', "data"=>$xml);
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
												redirect(base_url('api_soap/generate_token'));
												die();
											}else if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00018'){
												$e="GIVEN DATE IS PAST DATE.";
												$json=["status" => 0, "message" => 'Error', "data"=>$e];
											}else{
												$json=["status" => 0, "message" => 'Error', "data"=>$array];
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
									foreach($response as $key=>$value){
										//echo "<pre>";print_r($value);
										if($value['Date']==$start_date ){
											$roomCode=(isset($value['Room']))?$value['Room']:'';
											$rooms=($hospital_location_code!='')?($this->doctor_model->room_location($hospital_location_code,$roomCode)):['not-set'];
											
											if(!empty($rooms)){
												// get doctor list
												$doctor_name=(isset($value['DoctorName']))?$value['DoctorName']:'';
												($doctor_name!='')?(array_push($doctorNames,$doctor_name)):'';
												// end
												
												// get slots details
												$value['hospital_location_code']=$hospital_location_code;
												$value['Date']=date('Y-m-d',strtotime($value['Date']));
												$value['StartTime']=date('h:i A',strtotime($value['StartTime']));
												$value['EndTime']=date('h:i A',strtotime($value['EndTime']));
												
												$doctorData=$this->doctor_model->get_doctor_data($value['DoctorName']);
												if($doctorData){
													$doctor_list[]=$doctorData;
													$slot_list[]=$value;
												}
												//end
											}	
										}
									}
									
									if($doctor_list && $slot_list){
										
										$return=['doctor_list'=>$doctor_list,'slot_list'=>$slot_list];
										$json= ["status" => 1, "message" => 'Ok', "data"=>$return];	
									}else{
										// may be possible doctor is deactive
										$json= ["status" => 0, "message" => 'Please choose next date.', "data"=>""];	
									}
								}else{
									$json= ["status" =>0, "message" => 'Please choose next time.', "data"=>""];
								}
							}
						}catch(Exception $e) {
							//echo '<br/> Error: ' .$e->getMessage();
							//die();
							$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
						}
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
}
