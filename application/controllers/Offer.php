<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class offer extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('offer_model');
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
			//if($this->offer_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->offer_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('retail_shop/manage_offer',$data);
	}
	
	public function addedit_offer($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->offer_model->edit_offer();
			}else {
                $this->offer_model->add_offer();
			}
			redirect('offer');
			die();
		}
		
		if($ID!=''){
			$details=$this->offer_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('retail_shop/addedit_offer',$data);
	}
	
	public function view_offer($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->offer_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('retail_shop/view_offer',$data);
	}
	public function change_image(){
		//commented by sandeep
		/*if(!checkModulePermission($this->MODULEID_P)){ 
			redirect('dashboard');
			die();
		}*/
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		
		if($_POST){
			if($ID!=''){
				$newFileName=$this->offer_model->upload_image($ID);
				redirect($_POST['model_image']);
				die();
				/*if(isset($_POST['model_image'])){
					if($_POST['model_image']=='user/user_profile'){
						setSession('p_pic',$newFileName);	// for reset profile image
					}
					redirect($_POST['model_image']);
					die();
				}*/
			}
		}
		
	$data['main_page']=$this->main_page;
	$data['heading']='';//$this->heading;
	$data['mode']="Change Image";		
	$this->layout('employees/upload_image',$data);
	}
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->offer_model->delete_offer_data($IDS);
	    }
	}
	

	
}
