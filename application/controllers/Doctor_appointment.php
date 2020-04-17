<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_appointment extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('doctor_appointment_model');
		$this->load->model('patient_model');
		$this->load->model('sub_patient_model');
		$this->load->model('hospital_location_model');
 		$this->load->model('doctor_model');
		$this->load->model('doctor_specialization_model');
 
       	$this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Doctor Appointment';
		$this->mode='Add';
		$this->MODULEID=10;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}
		
		if($_POST){
			//if($this->doctor_appointment_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}
		$prn=isset($_GET['prn'])?$_GET['prn']:'';
		$doctor_mcr=isset($_GET['mcr'])?$_GET['mcr']:'';
		$details=$this->doctor_appointment_model->getData($is_active='',$prn,$doctor_mcr);
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('appointment/manage_doctor_appointment',$data);
	}
	
	public function addedit_appointment($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->doctor_appointment_model->edit_appointment();
			}else {
                $this->doctor_appointment_model->add_appointment();
			}
			redirect('doctor_appointment');
			die();
		}
		
		if($ID!=''){
			$details=$this->doctor_appointment_model->loadDataById($ID);
			$data['sub_patients']=$this->sub_patient_model->getData($is_active='1',$details->parent_prn,$select_box='yes');
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['patients']=$this->patient_model->getData($is_active='1',$select_box='yes');
		$data['sub_patients']=$this->sub_patient_model->getData($is_active='1',$parent_prn="",$select_box='yes');
		$data['hospitalLocations']=$this->hospital_location_model->getData($is_active='1');
		$data['doctorSpecializations']=$this->doctor_specialization_model->getData($is_active='1');
		$data['doctors']=$this->doctor_model->getData($is_active='1');
		
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('appointment/addedit_doctor_appointment',$data);
	}
	
	public function view_appointment($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->doctor_appointment_model->loadDataById($ID);
		$data['details']=$details;
		$data['patients']=$this->patient_model->getData($is_active='1',$select_box='yes');
		$data['sub_patients']=$this->sub_patient_model->getData($is_active='1',$details->parent_prn,$select_box='yes');
		$data['hospitalLocations']=$this->hospital_location_model->getData($is_active='1');
		$data['doctors']=$this->doctor_model->getData($is_active='1');
		$data['doctorSpecializations']=$this->doctor_specialization_model->getData($is_active='1');
		
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('appointment/view_doctor_appointment',$data);
	}

	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->doctor_appointment_model->delete_appointment_data($IDS);
	    }
	}
	

	
}
