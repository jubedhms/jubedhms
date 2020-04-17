<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Doctor_available_slots  extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("api_token_model");
	}
	
	public function index()
	{
		try {
			$ID='c4ca4238a0b923820dcc509a6f75849b';  
			$this->load->model("api_token_model");	
			$details=$this->api_token_model->loadDataById($ID);
			
			$wsdl = base_url("WSDL/WebMethodGetNextAvailableSlots.xml");
			$wsdlLocation=$details->url."/hpih_uat/web_services/APPOINTMENT/GetNextAvailableSlots.cfc";
			$client=StartSoapClient($wsdl,$wsdlLocation);
			//echo "<pre>";print_r($client);
			
			$date='29-Feb-2020';//date('Y-m-d');
			$time='';//'07:50 PM';//date('h:i A');
			
			$doctor_specialty='01';
			$doctor_mcr='';//'110803';//'110504';
			$patient_prn='00071057';
			$start_date=$date?date('d-M-Y',strtotime($date)):'';
			// we need minus 5 minutes because API return appointment time pass time + 5 minutes
			$start_time=$time?date('H:i',strtotime('-5 minutes',strtotime($time))):'';
			$case_type='FU';
			
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
			echo "<pre>";print_r($params);		
			$result = $client->getNextAvailableSlots($params);
			
			echo "<pre>";print_r($result->return);	die();
			$response=[];
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
									$response=$array['Slot'];
								}else{
									echo "<pre>";print_r($xml);die();
								}

							}catch(Exception $e) {
								echo '<br/> Error: ' .$e->getMessage();
								die();
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
										echo "Your token number is expired. Please regenrate Token number and reload this Page.<br/> ";
										echo anchor(base_url('api_soap/generate_token'), 'Click here for regenrate Token number', array('target' => '_blank', 'class' => 'new_window'));
										//redirect($this->main_page); 
										die();
									}
								}catch(Exception $e) {
									echo '<br/> Error: ' .$e->getMessage();
									die();
								}	
							}
							
						}
						
						$return=[];
						if($response){
							foreach($response as $key=>$value){
								if($value['Date']==$start_date){
									$return=$value;
								}
							}
							
							echo "<pre>";print_r($return);
						}
					}
			
		}catch(Exception $e) {
			echo '<br/> Error: ' .$e->getMessage();
			die();
		  }
	}

}
