<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Cart extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->model('api_v1/cart_model');
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
					$prn=isset($_GET['prn'])?$_GET['prn']:"";
					if($prn!=''){
						$response=$this->cart_model->get_data($prn);	
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
	* Method name: add_item
	* Desc: add item status(true for accepted, false for denied)
	* Input:  prn,module_name,module_id,code 
	*/
	public function add_item_post()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// Get data
			if(isset($_POST)){
				$permission=false;
				$token= isset($_POST['token']) ?($_POST['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$prn=isset($_POST['prn'])?$_POST['prn']:"";
					$module_name=isset($_POST['module_name'])?$_POST['module_name']:"";
					$module_id=isset($_POST['module_id'])?$_POST['module_id']:"";
					$quantity=isset($_POST['quantity'])?$_POST['quantity']:"1";
					if($prn!='' && $module_name!='' && ($module_name=='special_offer' || $module_name=='product' || $module_name=='service' || $module_name=='food_beverage') && $module_id!='' && $quantity!=''){
						$response=$this->cart_model->add_item($prn,$module_name,$module_id,$quantity);	
						if($response){
							$json = array("status" => 1, "message" => "Ok", "cart_id"=>$response);
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
	* Method name: remove_item
	* Desc: remove item status(true for accepted, false for denied)
	* Input: prn,module_name,module_id,code 
	*/
	public function remove_item_delete()
	{ 
		if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        	// Get data
			if(isset($_GET)){
				$permission=false;
				$token= isset($_GET['token']) ?($_GET['token']) : "";
				$permission=$this->matchAppToken($token);
				if($permission==true){	
					$prn=isset($_GET['prn'])?$_GET['prn']:"";
					$cart_id=isset($_GET['cart_id'])?$_GET['cart_id']:"";
					if($prn!='' && $cart_id!=''){
						$response=$this->cart_model->remove_item($prn,$cart_id);	
						if($response){
							$json = array("status" => 1, "message" => "Ok");
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
	
	
}
