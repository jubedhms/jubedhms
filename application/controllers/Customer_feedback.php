<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_feedback extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('Feedback_model');
                $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Feedback List';
		$this->mode='Add';
		$this->MODULEID=52;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->Feedback_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->Feedback_model->getData($is_active='');
		$remarks=$this->Feedback_model->getFeedbackremaks($is_active='');
		$FeedbackData=$this->Feedback_model->getFeedbackData($is_active='');
                $data['overall']=$FeedbackData;
		$FeedbackDataRateWise=$this->Feedback_model->getFeedbackDataRateWise($is_active='');
                $data['DataRateWise']=$FeedbackDataRateWise;
		$FeedbackDataRateWise_services=$this->Feedback_model->getFeedbackDataRateWise_services($is_active='');
                //print_r($FeedbackDataRateWise_services);die;
                $data['DataRateWise_services']=$FeedbackDataRateWise_services;
		$FeedbackDataRateWise_mstaff=$this->Feedback_model->getFeedbackDataRateWise_medicalStaff($is_active='');
                $data['DataRateWise_mstaff']=$FeedbackDataRateWise_mstaff;
                //print_r($FeedbackData);die;
		$data['details']=$details;
		$data['remarks']=$remarks;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		$this->layout('feedback/manage_customer_feedback',$data);
	}
	
	public function addedit_feedback($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->Feedback_model->edit_feedback();
			}else {
                $this->Feedback_model->add_feedback();
			}
			redirect('product');
			die();
		}
		
		if($ID!=''){
			$details=$this->Feedback_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('retail_shop/addedit_feedback',$data);
	}
	
	public function view($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->Feedback_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('feedback/view',$data);
	}
	
   public function deleteData($IDS=array()){
        if(isset($_POST['IDS']) || $IDS){
            $this->Feedback_model->delete_feedback_data($IDS);
        }
	}
        
   public function hide(){
            if($this->Feedback_model->hide()){
                $status=1;
                $msg='Hide status successful';
            }else{
                $status=0;
                $msg='Hide status failed';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg));
	}
        
   public function show(){
            if($this->Feedback_model->show()){
                $status=1;
                $msg='Show status successful';
            }else{
                $status=0;
                $msg='Show status failed';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg));
	}
	

	
}
