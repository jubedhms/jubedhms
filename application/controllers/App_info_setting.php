<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_info_setting extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('app_info_setting_model');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='APP Information';
		$this->mode='Manage';
		$this->MODULEID=41;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}
		$data['main_page']=$this->main_page;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		if(checkModulePermission($this->MODULEID,'edit_btn')){ 
		if($_POST){ //print_r($_POST);die();
			$this->app_info_setting_model->update_appsiteconfig();
			redirect($this->main_page);
		}
		}
		$details=$this->app_info_setting_model->getData($is_active='');
		$data['details']=$details;
		$data['heading']=$this->heading;
		$this->layout('settings/app_info_setting',$data);
	}
	
	
	 
////////////////////////////////////////////////////////
}
