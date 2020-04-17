<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_doctor extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model("api_token_model");
		$this->load->model("api_soap/get_doctor_model");
	}
	
	public function index(){
		$response=array();
	
		$ID='c4ca4238a0b923820dcc509a6f75849b';   
		$details=$this->api_token_model->loadDataById($ID);
		
		if($details && isset($details->token_number) && $details->token_number!='' && isset($details->company_code) && $details->company_code!=''){
			try {
				$wsdl = base_url("WSDL/WebMethodGetDoctorData.xml");
				$wsdlLocation=$details->url."hpih_uat/web_services/APPOINTMENT/GetDoctorData.cfc";
				$client=StartSoapClient($wsdl,$wsdlLocation);
				//echo "<pre>";print_r($client);die();

				$params =array('token_number'=>$details->token_number, 'company_code'=>$details->company_code);
				//print_r($params);die();			
				$result = $client->GetDoctorData($params);
				//echo "<pre>";print_r($result);	die;			

				if($result && isset($result->return)){
					$data=$result->return;
					
					// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
					$search='<?xml version="1.0" encoding="UTF-8"?>';
					if(strpos($data, $search) !== false){
						$data = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
						//echo "<pre>";print_r($data);	die;
						try{
							//$xml =  new SimpleXMLElement($data);
							$xml   = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
							$array = json_decode(json_encode((array)$xml), TRUE);
							$response=$array['Doctor'];
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
									die();
								}
							}catch(Exception $e) {
								echo '<br/> Error: ' .$e->getMessage();
								die();
							}	
						}
						
					}
					
					if($response){
						// for update in datbase
						$return=$this->get_doctor_model->add_data($response);
						echo "<pre>";print_r($return);die();
						// end	
					}
				}
			}catch(Exception $e) {
				echo '<br/> Error: ' .$e->getMessage();
				die();
			  }
		}

	}


	private function save_error_token($data_to_write='',$dest='',$file_name=''){			
		$target_file=$dest.$file_name;
		if (!is_dir($dest)) {
			mkdir($dest, 0777, TRUE);
		}

		$fp = fopen($target_file, 'a');
		if(!$fp){
		echo 'file is not opend';
		}
		fwrite($fp, $data_to_write);
		fclose($fp);
	}

}
