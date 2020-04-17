<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_banner_setting extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('app_banner_setting_model');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='APP Banners';
		$this->mode='Manage';
		$this->MODULEID=37;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}
		
		$details=$this->app_banner_setting_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->layout('settings/app_banner_setting',$data);
	}
	
	public function change_image(){
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		if($_POST){
			if($ID!=''){
				$newFileName=$this->app_banner_setting_model->upload_image($ID);
				redirect($_POST['model_image']);
				die();				
			}
		}
	}
	 
////////////////////////////////////////////////////////
}
