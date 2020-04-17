<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital_location extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('hospital_location_model');
		$this->load->model('countries_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Hospital Location';
		$this->mode='Add';
		$this->MODULEID=36;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->hospital_location_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->hospital_location_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('hospital_location/manage_hospital_location',$data);
	}
	
	public function addedit_hospital_location($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->hospital_location_model->edit_hospital_location();
			}else {
                $this->hospital_location_model->add_hospital_location();
			}
			redirect($this->main_page);
			die();
		}
		
		if($ID!=''){
			$details=$this->hospital_location_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['countries']=$this->countries_model->getData();
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('hospital_location/addedit_hospital_location',$data);
	}
	

	public function view_hospital_location($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->hospital_location_model->loadDataById($ID);
		$data['details']=$details;
		$data['countries']=$this->countries_model->getData();
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('hospital_location/view_hospital_location',$data);
	}

   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->hospital_location_model->delete_hospital_location_data($IDS);
	    }
	}
	

	
}
