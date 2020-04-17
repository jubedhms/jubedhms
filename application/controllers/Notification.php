<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('notification_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Generic Notification';
		$this->mode='Add';
		$this->MODULEID=33;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->notification_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->notification_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('notification/manage_notification',$data);
	}
	
	public function addedit_notification($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->notification_model->edit_notification();
			}else {
                $this->notification_model->add_notification();
			}
			redirect('notification');
			die();
		}
		
		if($ID!=''){
			$details=$this->notification_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('notification/addedit_notification',$data);
	}
	
	public function view_notification($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->notification_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('notification/view_notification',$data);
	}
	public function change_image(){
		
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		
		if($_POST){
			if($ID!=''){
				$newFileName=$this->notification_model->upload_image($ID);
				redirect($_POST['model_image']);
				die();
				
			}
		}
		
	$data['main_page']=$this->main_page;
	$data['heading']='';//$this->heading;
	$data['mode']="Change Image";		
	}
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->notification_model->delete_notification_data($IDS);
	    }
	}
	

	
}
