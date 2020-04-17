<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('role_model');
		$this->load->model('countries_model');
		$this->load->model('districts_model');
		
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Employee';
		$this->mode='Add';
		$this->MODULEID=39;
		$this->MODULEID_P=8;  // for view and edit profile
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
		
		$details=$this->user_model->getData($is_active='');
		$data['details']=$details;
		$data['loginID']=$this->LOGINID;
		$data['loginRoleID']=$this->ROLEID;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('employees/manage_user',$data);
	}
	
	// function for profile	
	public function user_profile(){
		//if(!checkModulePermission($this->MODULEID_P)){ 
			//redirect('dashboard');
			//die();
		//}
		
		$ID=$this->LOGINID;
		if($_POST){
			if($ID!=''){
				$this->user_model->edit_user();
			}
		}
		
		$details=$this->user_model->loadDataById($ID);
		$data['details']=$details;
		$data['role_details']=$this->role_model->getData($is_active='1');
		$data['loginID']=$this->LOGINID;
		$data['loginRoleID']=$this->ROLEID;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID_P;
		$data['mode']="Profile";
		$data['heading']=$this->heading;
		if($details->role_id=='1'){
			$this->layout('employees/admin_profile',$data);
		}else{
			$this->layout('employees/profile',$data);
		}
	}
	//end
	
	public function addedit_user($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details=(object) ['getModulList'=>$this->user_model->getModulList('1')];
		
		if($_POST){
			if($ID!=''){
				$this->user_model->edit_user();
			}else {
                $this->user_model->add_user();
			}
			redirect('user');
			die();
		}
		
		if($ID!=''){
			$details=$this->user_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['role_details']=$this->role_model->getData($is_active='1');
		$data['getModulList']=$details->getModulList;
		$data['assignRole']=$this->load->view('employees/assign_role', $data, TRUE);
		$data['loginID']=$this->LOGINID;
		$data['loginRoleID']=$this->ROLEID;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('employees/addedit_user',$data);
	}
	
	public function view_user($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$this->mode='View';
		$data['role_details']=$this->role_model->getData($is_active='1');
		$details=$this->user_model->loadDataById($ID);
		
		$data['details']=$details;
		$data['getModulList']=$details->getModulList;
		$data['assignRole']=$this->load->view('employees/assign_role', $data, TRUE);
		$data['loginID']=$this->LOGINID;
		$data['loginRoleID']=$this->ROLEID;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('employees/view_user',$data);
	}
	
	public function change_password_via_admin(){
        if(!checkModulePermission($this->MODULEID)){
            redirect('dashboard');
            die();
        }
        $data='';
        if($_POST){
                $this->user_model->change_password_via_admin();
                if(isset($_POST['model_password'])){
                    redirect($_POST['model_password']);
                    die();
                }
            }

        $data['main_page']=$this->main_page;
        $data['heading']='';//$this->heading;
        $data['mode']="Change password";
        $this->layout('employees/change_password',$data);
    }
    
	public function change_password(){
		if(!checkModulePermission($this->MODULEID_P)){ 
			redirect('dashboard');
			die();
		}
		
		$ID=$this->LOGINID;
		$data='';
		if($_POST){
			if($ID!=''){
				$this->user_model->change_password($ID);
				if(isset($_POST['model_password'])){
					redirect($_POST['model_password']);
					die();
				}
			}
		}
		
	$data['main_page']=$this->main_page;
	$data['heading']='';//$this->heading;
	$data['mode']="Change Password";		
	$this->layout('employees/change_password',$data);
	}
	
	public function change_image(){
		//if(!checkModulePermission($this->MODULEID_P)){ 
			//redirect('dashboard');
			//die();
		//}
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		if($_POST){
			if($ID!=''){
				$newFileName=$this->user_model->upload_image($ID);
				if(isset($_POST['login_profile_image']) && $_POST['login_profile_image']=='1'){
					setSession('p_pic',$newFileName);
				}	
				
				echo $newFileName;
				die;
			}
		}
	}
	
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->user_model->delete_user_data($IDS);
	    }
	}
	

	
}
