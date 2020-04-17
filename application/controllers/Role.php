<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('role_model');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='Role';
		$this->mode='Add';
		$this->MODULEID=38;
	}
	
	public function index(){ 
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); 
			die();
		}
		
		if($_POST){
			//if($this->employee_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}
		$details=$this->role_model->getData();
		$data['details']=$details;
		$data['mode']="Manage";
		$data['MODULEID']=$this->MODULEID;
		$data['heading']=$this->heading;
		$this->layout('role/manage_role',$data);
	}
	

	public function addedit_role($ID='',$role_id=''){
		$details='';
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){
			redirect('dashboard'); 
			die();
		}
		
		if($_POST){ 
			$this->role_model->addedit($is_active='1',$ID);
			redirect($this->main_page); 
			die();
		}
		
		if($ID!=''){
		$details=$this->role_model->loadDataById($ID);
		$role_id=$details->ID;
		$this->mode='Edit';
		}
		
		$getModulList=$this->role_model->getModulList('1',$role_id);
		$data['getModulList']=$getModulList;
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		$data['MODULEID']=$this->MODULEID;
		$this->layout('role/addedit_role',$data);
	}
	
	public function view_role($ID='',$role_id=''){
		$details='';
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard'); 
			die();
		}
		
		if($ID!=''){
		$details=$this->role_model->loadDataById($ID); 
		$role_id=$details->ID;
		$this->mode='View';
		}
		
		$getModulList=$this->role_model->getModulList('1',$role_id);
		$data['getModulList']=$getModulList;
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		$data['MODULEID']=$this->MODULEID;
		$this->layout('role/view_role',$data);
	}
	
	public function deleteData($IDS=array()){ 
		if(isset($_POST['IDS']) || $IDS){
                    $this->role_model->delete_data($IDS);
					die();			
                }       
	}
	
	
	
}
