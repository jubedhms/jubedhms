<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class services extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('service_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Services List';
		$this->mode='Add';
		$this->MODULEID=20;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->service_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->service_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		//echo '<pre>';print_r($data);die();

		$this->layout('retail_shop/services_list',$data);
	}
	
	public function addedit_service($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->service_model->edit_service();
			}else {
                $this->service_model->add_service();
			}
			redirect('services');
			die();
		}
		
		if($ID!=''){
			$details=$this->service_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('retail_shop/addedit_service',$data);
	}
	
	public function view_service($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->service_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('retail_shop/view_service',$data);
	}
	public function change_image(){
		//commented by sandeep
		/*if(!checkModulePermission($this->MODULEID_P)){ 
			redirect('dashboard');
			die();
		}*/
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		
		if($_POST){
			if($ID!=''){
				$newFileName=$this->service_model->upload_image($ID);
				if(isset($_POST['model_image'])){
					if($_POST['model_image']=='user/user_profile'){
						setSession('p_pic',$newFileName);	// for reset profile image
					}
					redirect($_POST['model_image']);
					die();
				}
			}
		}
		
	$data['main_page']=$this->main_page;
	$data['heading']='';//$this->heading;
	$data['mode']="Change Image";		
	$this->layout('employees/upload_image',$data);
	}
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->service_model->delete_service_data($IDS);
	    }
	}
	

	
}
