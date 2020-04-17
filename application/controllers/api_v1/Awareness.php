<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Awareness extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/awareness_model');
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
	* Method name: get_categories_list
	* Desc: get list status(true for accepted, false for denied)
	*/
	public function get_categories_list_get()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){
					$language= isset($_GET['language']) ?($_GET['language']) : "en";	
					$response_en=[
								['ID' =>'1', 'name'=>'Gynecological health after give birth'],
								['ID' =>'2', 'name'=> 'Healthy - Beautiful women'],
								['ID' =>'3', 'name'=>'Prenatal health'],
								['ID' =>'4' , 'name'=> 'Nutrition for pregnant women'],
								['ID' =>'5', 'name'=> 'Healthy - Beautiful pregnant'],
								['ID' =>'6', 'name'=> 'Clever pregnant women'],
								['ID' =>'7', 'name'=> 'The development of fetus through each stage'],
								['ID' =>'8' , 'name'=> 'Nutrition for children'],
								['ID' =>'9' , 'name'=>'Diseases prevention and treatment for children'],
								['ID' =>'10', 'name'=>'The development of children in each stage']
							];
							
					$response_vi=[
								['ID' =>'1', 'name'=>'Sức khỏe phụ khoa sau sinh sản'],
								['ID' =>'2', 'name'=> 'Phụ nữ khỏe – đẹp'],
								['ID' =>'3', 'name'=>'Sức khỏe tiền sản'],
								['ID' =>'4' , 'name'=> 'Dinh dưỡng cho mẹ bầu'],
								['ID' =>'5', 'name'=> 'Mẹ bầu khỏe - đẹp'],
								['ID' =>'6', 'name'=> 'Mẹ bầu thông thái'],
								['ID' =>'7', 'name'=> 'Sự phát triển thai nhi qua từng giai đoạn'],
								['ID' =>'8' , 'name'=> 'Dinh dưỡng cho con'],
								['ID' =>'9' , 'name'=>'Phòng và điều trị bệnh cho trẻ'],
								['ID' =>'10', 'name'=>'Sự phát triển của trẻ theo từng giai đoạn']
							];	
					
					$response=($language=="vi")?$response_vi:$response_en;	
					
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
	* Method name: get_list
	* Desc: get list status(true for accepted, false for denied)
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
					$language= isset($_GET['language']) ?($_GET['language']) : "en";	
					$response=$this->awareness_model->get_data($language);	
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

	
}
