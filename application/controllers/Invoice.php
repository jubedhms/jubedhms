<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {
	public function __construct(){
        parent::__construct();
		//$this->load->model('Invoice_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Invoice List';
		$this->mode='Add';
		$this->MODULEID=32;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->Payment_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		//$details=$this->Payment_model->getData($is_active='');
		//$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		//echo '<pre>';print_r($data);die();

		$this->layout('invoice/invoice_list',$data);
	}
	
	public function addedit_invoice($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->Payment_model->edit_invoice();
			}else {
                $this->Payment_model->add_invoice();
			}
			redirect('product');
			die();
		}
		
		if($ID!=''){
			$details=$this->Payment_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('invoice/addedit_invoice',$data);
	}
	
	public function view_invoice($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->Payment_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('invoice/view_invoice',$data);
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->Payment_model->delete_invoice_data($IDS);
	    }
	}
	

	
}
