<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_list extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('product_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Product List';
		$this->mode='Add';
		$this->MODULEID=20;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->product_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->product_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		//echo '<pre>';print_r($data);die();

		$this->layout('retail_shop/product_list',$data);
	}
	
	public function addedit_product($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->product_model->edit_product();
			}else {
                $this->product_model->add_product();
			}
			redirect('product');
			die();
		}
		
		if($ID!=''){
			$details=$this->product_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('retail_shop/addedit_product',$data);
	}
	
	public function view_product($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->product_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('retail_shop/view_product',$data);
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->product_model->delete_product_data($IDS);
	    }
	}
	

	
}
