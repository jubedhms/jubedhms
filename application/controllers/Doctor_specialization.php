<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_specialization extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('doctor_specialization_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Doctor Specialization';
		$this->mode='Add';
		$this->MODULEID=11;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->doctor_specialization_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->doctor_specialization_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('doctor/manage_doctor_specialization',$data);
	}
	
	public function addedit_doctor_specialization($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->doctor_specialization_model->edit_doctor_specialization();
			}else {
                $this->doctor_specialization_model->add_doctor_specialization();
			}
			redirect('department');
			die();
		}
		
		if($ID!=''){
			$details=$this->doctor_specialization_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('doctor/addedit_doctor_specialization',$data);
	}
	

	public function view_doctor_specialization($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->doctor_specialization_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('doctor/view_doctor_specialization',$data);
	}

   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->doctor_specialization_model->delete_doctor_specialization_data($IDS);
	    }
	}
	

	
}
