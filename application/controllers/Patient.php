<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('patient_model');		
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Patient';
		$this->mode='Add';
		$this->MODULEID=13;
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

	public function checkprnExist(){
		if($this->input->post('prn_update')){
			 if($this->patient_model->checkprnExist(trim($this->input->post('prn_update')))){
				 $status=1;
				 $msg="This PRN is already exist.";
			 }else{
				 $status=0;
				 $msg="";
			 }
			  echo json_encode(array('status'=>$status,'msg'=>$msg));
		}
	 }

	public function updatePRN(){
	    if($this->input->post('prn_update') && $this->input->post('PID')){
            if($this->patient_model->updatePRN()){
                $status=1;
                $msg="Update successfully.";
            }else{
                $status=0;
                $msg="Update failed.";
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg));
       }
    }
	
	public function view_patient($ID='',$id_type=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}
		
		if($id_type==''){
			$details=$this->patient_model->loadDataById($ID);
		}else{
			$details=$this->patient_model->loadDataByName($ID);
		}
        
        $this->mode='View';
		$this->load->model('countries_model');
        $this->load->model('cities_model');
		$this->load->model('districts_model');
		
		$data['details']=$details;
		$data['countries']=$this->countries_model->getData();
        $data['cities']=$this->cities_model->getData();
		$data['districts']=$this->districts_model->getData();
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('patients/view_patient',$data);
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->patient_model->delete_patient_data($IDS);
	    }
	}
	
}
