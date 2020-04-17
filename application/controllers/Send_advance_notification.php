<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_advance_notification extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('send_advance_notification_model');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
	}
	
	public function index(){
		$this->alert_appointment_notification();	
	}
	
	public function count_send_notification(){
		$data=$this->send_advance_notification_model->count_send_notification();	
	}
	
	public function send_lockscreen_notification(){
		return;
		$data=$this->send_advance_notification_model->send_lockscreen_notification();
		
		if($data){
			foreach($data as $key=>$value){
					$ID=$value->ID;
					$patient_id=$value->patient_id;
					$device_token=$value->notification_token;
					$title=strip_tags($value->title);
					$body=strip_tags($value->description);		
					$image_url="";
					$module_name=$value->module_name;
					$module_id=$value->module_id;
					$response=$this->sendNotification($device_token,$title,$body,$image_url,$module_name,$module_id);
					if($response && isset($response->success) && $response->success!='0'){
						$this->send_advance_notification_model->update_personal_as_read($ID);
					}
				$response_data =["ID"=>$ID,"Patient ID"=>$patient_id,"response"=>$response];
				echo "<br>".json_encode($response_data);
			}
		}		
	}
	
	protected function sendNotification_all($topic='',$title='',$body='',$image_url='',$module_name='',$module_id=''){
		if($topic!='' && $title!=''){
			$url="https://fcm.googleapis.com/fcm/send";
			$API_ACCESS_KEY ='AAAA-AmtD74:APA91bFZZHnBQ7v-A43kghSFT5giNLx75IyIKsPRAxmQ55dqcWppYGPZjaEzFIZ3hl4WvkSgeqEDorNNorxL2eSYAvQZwSXxuc1B3OVmqvPb8jQFm_ATp8PoYBri1HZ6l11-iqseLiOM';
		
		
			$notification = [
						'body' 	=> $body,
						'title'	=> $title,
						'icon'	=> 'myicon', /*Default Icon*/
						'sound' => 'mySound', /*Default sound*/
						'vibrate'=>1,
					];
					
			$data =[
					'module_name' => $module_name,
					'module_id' => $module_id
				];
				
			$fields =[
						'to'=> '/topics/'.$topic,
						'notification'	=> $notification,
						'data' =>$data
					];
			
			$headers = [
						'Authorization: key='.$API_ACCESS_KEY,
						'Content-Type: application/json'
					];
			
			#Send Reponse To FireBase Server	
    		$ch = curl_init();
    		curl_setopt( $ch,CURLOPT_URL, $url);
    		curl_setopt( $ch,CURLOPT_POST, true );
    		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    		$result = curl_exec($ch );
			if ($result === FALSE) {
			   //die('FCM Send Error: ' . curl_error($ch));
				return false;
			}else{
				$result=json_decode($result);
			}
			curl_close($ch);
			
			return $result;	
		}else{
			return false;
		}
	}
	
	protected function sendNotification($device_token='',$title='',$body='',$image_url='',$module_name='',$module_id=''){
		if($device_token!='' && $title!=''){
			$url="https://fcm.googleapis.com/fcm/send";
			$API_ACCESS_KEY ='AAAA-AmtD74:APA91bFZZHnBQ7v-A43kghSFT5giNLx75IyIKsPRAxmQ55dqcWppYGPZjaEzFIZ3hl4WvkSgeqEDorNNorxL2eSYAvQZwSXxuc1B3OVmqvPb8jQFm_ATp8PoYBri1HZ6l11-iqseLiOM';
		
		
			$notification = [
						'body' 	=> $body,
						'title'	=> $title,
						'icon'	=> 'myicon', /*Default Icon*/
						'sound' => 'mySound', /*Default sound*/
						'vibrate'=>1,
					];
					
			$data =[
					'module_name' => $module_name,
					'module_id' => $module_id
				];
				
			$fields =[
						'to'=> $device_token,
						'notification'	=> $notification,
						'data' =>$data
					];
					
			$headers = [
						'Authorization: key='.$API_ACCESS_KEY,
						'Content-Type: application/json'
					];
			
			#Send Reponse To FireBase Server	
    		$ch = curl_init();
    		curl_setopt( $ch,CURLOPT_URL, $url);
    		curl_setopt( $ch,CURLOPT_POST, true );
    		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    		$result = curl_exec($ch );
			if ($result === FALSE) {
			   //die('FCM Send Error: ' . curl_error($ch));
				return false;
			}else{
				$result=json_decode($result);
			}
			curl_close( $ch );	
			
			return $result;
			
		}else{
			return false;
		}
				
	}

	
////////////////////////////////////////////////////////
}
