<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('patient_model');
		//$this->load->model('location_model');
		
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Patient';
		$this->mode='Add';
		$this->MODULEID=12;
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

		$details=$this->patient_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('patients/manage_patient',$data);
	}
	
	public function addedit_patient($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->patient_model->edit_patient();
			}else {
                $this->patient_model->add_patient();
			}
			redirect('patient');
			die();
		}
		
		if($ID!=''){
			$details=$this->patient_model->loadDataById($is_active='',$ID);
			$this->mode='Edit';
		}

		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('patients/addedit_patient',$data);
	}
	
	public function view_patient($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}		
        $details=$this->patient_model->loadDataById($is_active='',$ID);
        $this->mode='View';

		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('patients/view_patient',$data);
	}
	
	private function change_password_via_admin(){
        if(!checkModulePermission($this->MODULEID)){
            redirect('dashboard');
            die();
        }

        $data='';
        if($_POST){
                $this->patient_model->change_password_via_admin();
                if(isset($_POST['model_password'])){
                    redirect($_POST['model_password']);
                    die();
                }
            }

        $data['main_page']=$this->main_page;
        $data['heading']='';//$this->heading;
        $data['mode']="Change password";
        $this->layout('patients/change_password',$data);
    }
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->patient_model->delete_patient_data($IDS);
	    }
	}
	

	
}
