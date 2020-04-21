<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccine extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('vaccine_model');
		
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Vaccine';
		$this->mode='Add';
		$this->MODULEID=20;
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

		$details=$this->vaccine_model->getData($is_active='');
                //print_r($details);die;
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('vaccine/manage_vaccine',$data);
	}
        
        public function vaccine_list(){
            //print_r($_POST);die;
                $details=$this->vaccine_model->getData($is_active='');
                //print_r($details);die;
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
                $this->layout('vaccine/vaccine_list',$data);
        }

                public function addedit_vaccine($ID=''){
            ///print_r($_POST);die;
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details='';
		$vaccine='';
		$dose='';
		
		if($_POST){
			if($ID!=''){
				$this->vaccine_model->edit_vaccines();
			}else {
                                $this->vaccine_model->add_vaccines();
			}
			redirect('vaccine');
			die();
		}
		
		if($ID!=''){
			$vaccine=$this->vaccine_model->loadDataById($ID);
			$dose=$this->vaccine_model->loadVaccineDoseDataById($ID);
			$this->mode='Edit';
		}
                $data['vaccine_package_code']=$this->vaccine_model->getvaccinePackageCode();
		$data['details']=$vaccine;
		$data['dose']=$dose;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('vaccine/addedit_vaccine',$data);
	}
	
	public function view_vaccine($ID=''){
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details='';
		$vaccine='';
		$dose='';
		if($ID!=''){
			$vaccine=$this->vaccine_model->loadDataById($ID);
			$dose=$this->vaccine_model->loadVaccineDoseDataById($ID);
			$this->mode='View';
		}
                $data['vaccine_package_code']=$this->vaccine_model->getvaccinePackageCode();
		$data['details']=$vaccine;
		$data['dose']=$dose;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('vaccine/view_vaccine',$data);
	}
	
   public function deleteData($IDS){
       //echo $IDS;die;
	    if(isset($_POST['IDS']) || $IDS){
                $this->vaccine_model->delete_vaccine_data($IDS);
	    }
	}
        
   public function remove_dose(){
	    if(isset($_POST['id'])){
                if($this->vaccine_model->remove_dose()){
                    $status=1;
                    $msg='Dose deleted successfully';
                }else{
                    $status=0;
                    $msg='Dose delete failed';
                }
                $arr=array("status"=>$status,"msg"=>$msg);
                echo json_encode($arr);
	    }
	}
}
