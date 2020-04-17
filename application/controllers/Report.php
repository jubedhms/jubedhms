<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('report_model');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='Report';
		$this->mode='';
		$this->MODULEID=60;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}

        $LOGINID=$this->LOGINID;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		if($_POST){
			//if($this->employee_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}
	}
	
	
	public function api_usage_report(){
		if(!checkModulePermission('13')){ 
			redirect('dashboard'); die;
		}
        $configDetails=$this->report_model->get_configDetails();
        $api_secret_key='';

        if($configDetails){
            $api_secret_key= $configDetails->api_secret_key;
        }

		$result=$this->report_model->api_usage_report($api_secret_key);
		$data['details']=$result;
		$data['configDetails']=$configDetails;
		$data['MODULEID']='13';
		$data['main_page']=$this->main_page;
		$data['heading']=$this->heading;
		$data['mode']='API Usage';
		
		$this->layout('report/api_usage_report',$data);
	}
	
////////////////////////////////////////////////////////
}
