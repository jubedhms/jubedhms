<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_token extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("api_token_model");
	}
	
	public function index(){
		$current_date=date("Y-m-d H:i:s");
		$ID='c4ca4238a0b923820dcc509a6f75849b';   
		$details=$this->api_token_model->loadDataById($ID);
		$expiry_time=$details->expiry_time;

		//if($expiry_time <= $current_date){
			$wsdlURL=$details->url;	
			$oldToken=$details->token_number;
			// for expire old token
			$tokenLogout=$this->tokenLogout($wsdlURL,$oldToken);
			//echo 'Message: <br/><br/>Logout : '.$tokenLogout;			
			//end

			// for generate new token
			$tokenLogin=$this->tokenLogin($details);
			//echo '<br> Login : New Token- '.$tokenLogin;
			
			$json = ["status" => 1,"message" => "Ok", "token"=> $tokenLogin];
			echo json_encode($json);die;
			
			//end
		//}else{
			//echo "Token number has been generated already.";
		//}
	}
		


	private function tokenLogin($details){
		
		$newToken='';
		if($details && isset($details->token_number) && $details->token_number!=''){
			try {
				$wsdl = base_url("WSDL/WebMethodLogin.xml");
				$wsdlLocation=$details->url."hpih_uat/web_services/authentication/login.cfc";
				$client=StartSoapClient($wsdl,$wsdlLocation);
				//echo "<pre>";print_r($client);die();

				$params =array('company_code'=>$details->company_code,
								'system_code'=>$details->api_key, 
								'password'=>$details->account_key
								);
							
				$result = $client->login($params);
				//echo "<pre>";print_r($result);				
				
				if($result && isset($result->return)){
					$data=$result->return;
					
					// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
					$search='<?xml version="1.0" encoding="UTF-8">';
					if(strpos($data, $search) !== false){
						$data=str_ireplace([$search], '', $data);
					}

					// for check return data have token number or not
					if(strpos($data, "<Token_number>") !== false){
						$string=str_ireplace([$search], '', $data);
						$xml =  new SimpleXMLElement($string);
						$array = json_decode(json_encode((array)$xml), TRUE);
						$newToken=trim($array['Token']['Token_number']);
					}else{
						echo '<br/> Login : '.$data;
						die();
					}
					// end

					// for check token number is integer or not
					if(!is_numeric($newToken)){
						//echo '<br/> Login : '.$data;
						//die();
						$json = ["status" => 0,"message" => $data];
						echo json_encode($json);die;
					}
					// end

					$expiry_time=date("Y-m-d 23:59:59");	// last time of the day
					
					// make an array for insert in database
					$_POST=array(
							'ID'=>$details->ID,
							'title' =>"SOAP API11",
							'company_code'=>$details->company_code,
							'api_key'=>$details->api_key,
							'account_key'=>$details->account_key,
							'token_number'=>$newToken,
							'expiry_time'=>$expiry_time,
						);
					// end
						
					// for update in datbase
					$this->api_token_model->edit_APIconifg();
					// end
					
					return $newToken;
				}
			}catch(Exception $e) {
				//echo '<br/> Login : ' .$e->getMessage();
				//die();
				$json = ["status" => 0,"message" => $e->getMessage()];
				echo json_encode($json);die;
			  }
		}
	}

	private function tokenLogout($wsdlURL='',$token_number=''){
		$response='';
		if($token_number!='' && $wsdlURL!=''){
			try{	
				// for logout to generate token
				$wsdl = base_url("WSDL/WebMethodLogout.xml");
				$wsdlLocation=$wsdlURL."hpih_uat/web_services/authentication/Logout.cfc";
				$client=StartSoapClient($wsdl,$wsdlLocation);
				//echo "<pre>";print_r($client);die();
				$result = $client->logout(array('token_number'=> $token_number));
				if($result && isset($result->return)){
					return $result->return;
				}else{
					// save error log
					$date=date("Y-m-d H:i:s A");
					$data_to_write="SOAP Token Number: ".$token_number." on date: ".$date." \n";
					$dest = base_url('error-log/');
					$file_name="soap-token-log.txt";
					$this->save_error_token($data_to_write,$dest,$file_name);
					// end

					//echo "<pre> Logout : ";print_r($result);die;
					$json = ["status" => 0,"message" => $result];
					echo json_encode($json);die;
					
				}
			}catch(Exception $e) {
				//echo 'Message: <br/><br/>Old Token Number: '.$token_number;
				
				// save error log
				$date=date("Y-m-d H:i:s A");
				$data_to_write="SOAP Token Number: ".$token_number." on date: ".$date." \n";
				$dest = base_url('error-log/');
				$file_name="soap-token-log.txt";
				$this->save_error_token($data_to_write,$dest,$file_name);
				// end
				
				//echo '<br>Message: Logout : ' .$e->getMessage();
				//die();
				$json = ["status" => 0,"message" => $e->getMessage()];
				echo json_encode($json);die;
			}
		}else{
			//echo "Please send mandatory fields.";die;
			$json = ["status" => 0,"message" => "Please send mandatory fields."];
			echo json_encode($json);die;
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
