<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_offer extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('new_offer_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='New Offer';
		$this->mode='Add';
		$this->MODULEID=19;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->new_offer_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->new_offer_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('retail_shop/manage_new_offer',$data);
	}
	
	public function addedit_new_offer($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->new_offer_model->edit_new_offer();
			}else {
                $this->new_offer_model->add_new_offer();
			}
			redirect('new_offer');
			die();
		}
		
		if($ID!=''){
			$details=$this->new_offer_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('retail_shop/addedit_new_offer',$data);
	}
	
	public function view_new_offer($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->new_offer_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('retail_shop/view_new_offer',$data);
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->new_offer_model->delete_new_offer_data($IDS);
	    }
	}
	

	
}
