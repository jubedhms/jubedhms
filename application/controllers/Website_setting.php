<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_setting extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='Settings';
		$this->mode='Website';
		$this->MODULEID=40;
	}
	
	public function index()
	{
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die();
		}

		$data['main_page']=$this->main_page;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;

		if(checkModulePermission($this->MODULEID,'edit_btn')){ 
		if($_POST){ //print_r($_POST);die();
			$this->common_model->update_websiteconfig();
			redirect($this->main_page);
		}
		}
		$result=$this->common_model->getwebsiteconfig();
		$data['details']=$result;
		$data['MODULEID']=$this->MODULEID;
		$this->layout('settings/website_setting',$data);
	}
	
	public function change_logo_image(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die();
		}
		
		$data['main_page']=$this->main_page;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;

		if(checkModulePermission($this->MODULEID,'edit_btn')){ 
		if($_POST){ //print_r($_POST);die();
			$this->common_model->change_image();
			redirect($this->main_page);
		}
		}
		$result=$this->common_model->getwebsiteconfig();
		$data['details']=$result;
		$data['MODULEID']=$this->MODULEID;
		$this->layout('settings/website_setting',$data);
	
	}
	
	
}	
/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */