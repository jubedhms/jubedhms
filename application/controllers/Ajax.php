<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$SES_PREFIX=$this->config->item('SESSION_PREFIX'); 
		$this->login_data=$this->session->userdata($SES_PREFIX.'login_data');
		if($this->login_data){
			$this->LOGINID=$this->login_data->id;
			$this->LOGINROLEID=$this->login_data->role_id;
			$this->ROLEID=$this->login_data->role_id;
		}	
    }
        
	public function index(){
		
	}	
	
    public function changeStatus($tableName='',$ID='',$show_status=''){ 
	if($_POST){
		$this->load->model('common_model');
		$this->common_model->changeStatus();
		}

	}
	
	public function checkExistEmpUsername($value=''){
		if($_POST){
		$this->load->model('user_model');
		$exist=$this->user_model->checkExist();
		echo json_encode($exist); die();
		}
	}
	
	public function checkExistDoctorUsername($value=''){
		if($_POST){
		$this->load->model('doctor_model');
		$exist=$this->doctor_model->checkExistUsername();
		echo json_encode($exist); die();
		}
	}
	
	public function checkExistDoctorMCR($value=''){
		if($_POST){
		$this->load->model('doctor_model');
		$exist=$this->doctor_model->checkExistMCR();
		echo json_encode($exist); die();
		}
	}
	
	public function checkExistPatientUsername($value=''){
		if($_POST){
		$this->load->model('patient_model');
		$exist=$this->patient_model->checkExistUsername();
		echo json_encode($exist); die();
		}
	}
	
	public function checkExistPatientPRN($value=''){
		if($_POST){
		$this->load->model('patient_model');
		$exist=$this->patient_model->checkExistPRN();
		echo json_encode($exist); die();
		}
	}
	
	// for retail shops	
	public function checkExistProductID($value=''){
		if($_POST){
			$this->load->model('product_model');
			$exist=$this->product_model->checkExist();
			echo json_encode($exist); die();
		}
	}
	
	public function checkSecondExistProductID($value=''){
		if($_POST){
			$this->load->model('product_model');
			$exist=$this->product_model->checkSecondExist();
			echo json_encode($exist); die();
		}
	}
	
	public function checkExistServiceID($value=''){
		if($_POST){
			$this->load->model('service_model');
			$exist=$this->service_model->checkExist();
			echo json_encode($exist); die();
		}
	}
	
	public function checkSecondExistServiceID($value=''){
		if($_POST){
			$this->load->model('service_model');
			$exist=$this->service_model->checkSecondExist($value);
			echo json_encode($exist); die();
		}
	}
	
	public function checkExistSpecialOfferID($value=''){
		if($_POST){
			$this->load->model('new_offer_model');
			$exist=$this->new_offer_model->checkExist();
			echo json_encode($exist); die();
		}
	}
	
	public function checkSecondExistSpecialOfferID($value=''){
		if($_POST){
			$this->load->model('new_offer_model');
			$exist=$this->new_offer_model->checkSecondExist();
			echo json_encode($exist); die();
		}
	}
	
	public function checkExistFoodBeverageCode($value=''){
		if($_POST){
			$this->load->model('food_beverage_model');
			$exist=$this->food_beverage_model->checkExist();
			echo json_encode($exist); die();
		}
	}
	
	public function checkSecondFoodBeverageCode($value=''){
		if($_POST){
			$this->load->model('food_beverage_model');
			$exist=$this->food_beverage_model->checkSecondExist();
			echo json_encode($exist); die();
		}
	}
	// end
	
}