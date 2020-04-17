<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergency_calls extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('Emergency_calls_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Emergency Call List';
		$this->mode='Add';
		$this->MODULEID=6;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->Emergency_call_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->Emergency_calls_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		//echo '<pre>';print_r($data);die();

		$this->layout('emergency_call/manage_emergency_call',$data);
	}

	
	public function view($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->Emergency_calls_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('emergency_call/view',$data);
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->Emergency_calls_model->delete_emergency_calls_data($IDS);
	    }
	}
        
   public function view_map($ID){
                $details=$this->Emergency_calls_model->getLatLon($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']='Google Map';
		$this->main_page=$this->main_page;
            
                $this->layout('emergency_call/map',$data);
	}
}
