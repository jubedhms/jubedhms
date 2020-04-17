<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Special_offer extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('special_offer_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='New Special Offer';
		$this->mode='Add';
		$this->MODULEID=24;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->special_offer_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->special_offer_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		//echo '<pre>';print_r($data);die();

		$this->layout('retail_shop/manage_special_offer',$data);
	}
	
	public function addedit_special_offer($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->special_offer_model->edit_special_offer();
			}else {
                $this->special_offer_model->add_special_offer();
			}
			redirect('special_offer');
			die();
		}
		
		if($ID!=''){
			$details=$this->special_offer_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('retail_shop/addedit_special_offer',$data);
	}
	
	public function view_special_offer($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->special_offer_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('retail_shop/view_special_offer',$data);
	}
	
	public function change_image(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}
		
		$ID=(isset($_POST['ID']))?$_POST['ID']:'';
		$data='';
		if($_POST){
			if($ID!=''){
				echo $newFileName=$this->special_offer_model->upload_image($ID);
				return true;
				die();
			}
		}
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->special_offer_model->delete_special_offer_data($IDS);
	    }
	}
	

	
}
