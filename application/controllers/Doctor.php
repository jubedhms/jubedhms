<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('doctor_model');
		$this->load->model('countries_model');
		$this->load->model('doctor_specialization_model');
        $this->load->model('districts_model');
        $this->load->model('doctor_availability_model');
        $this->load->library('pagination');
        
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Doctor';
		$this->mode='Add';
		$this->MODULEID=9;
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
        
		$data['doctor_specialization']=$this->doctor_specialization_model->getData($is_active='1');
		$details=$this->doctor_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('doctor/manage_doctor',$data);
	}
	
	public function addedit_doctor($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($this->session->userdata('is_edit')==1){
				$this->session->unset_userdata('is_edit');
		}else{
		if($_POST){
			if($ID!=''){
				$this->doctor_model->edit_doctor();
			}else {
				redirect('doctor');
			}
				$this->session->set_userdata('is_edit','1');
				redirect('doctor/addedit_doctor/'.$ID,'refresh');
			die();
		}
		}
		
		if($ID!=''){
			$details=$this->doctor_model->loadDataById($ID);
			$this->mode='Edit';
		}
		$data['doctor_specialization']=$this->doctor_specialization_model->getData($is_active='1');
		$data['profile_specialization']=$this->doctor_specialization_model->getProfileSpecializationData($is_active='1');
		$data['banner']=$this->doctor_model->getDoctor_banner($is_active='1');
		$data['countries']=$this->countries_model->getData($is_active='1');
		$data['districts']=$this->districts_model->getData($is_active='1');
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('doctor/addedit_doctor',$data);
	}
        
        public function removedoctor_education(){
            $id=$this->input->post('id');
            if($this->doctor_model->removedoctor_education($id)){
                $status=1;
                
            }else{
                $status=0;
            }
            echo json_encode(array("status"=>$status));
            
        }
        public function removedoctor_experience(){
            $id=$this->input->post('id');
            if($this->doctor_model->removedoctor_experience($id)){
                $status=1;
                
            }else{
                $status=0;
            }
            echo json_encode(array("status"=>$status));
            
        }
        public function removedoctor_award(){
            $id=$this->input->post('id');
            if($this->doctor_model->removedoctor_award($id)){
                $status=1;
                
            }else{
                $status=0;
            }
            echo json_encode(array("status"=>$status));
            
        }

        public function view_doctor($ID=''){
			if(!checkModulePermission($this->MODULEID,'view_btn')){ 
				redirect('dashboard');
				die();
			}		
			$this->mode='View';
			$details=$this->doctor_model->loadDataById($ID);
			$data['doctor_specialization']=$this->doctor_specialization_model->getData($is_active='1');
			$data['profile_specialization']=$this->doctor_specialization_model->getProfileSpecializationData($is_active='1');
			$data['banner']=$this->doctor_model->getDoctor_banner($is_active='1');
			$data['countries']=$this->countries_model->getData();
			$data['districts']=$this->districts_model->getData();
			$data['details']=$details;
			$data['main_page']=$this->main_page;
			$data['MODULEID']=$this->MODULEID;
			$data['mode']=$this->mode;
			$data['heading']=$this->heading;
			$this->main_page=$this->main_page;
			
			$this->layout('doctor/view_doctor',$data);
	}
	
	public function change_image(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		if($_POST){
			if($ID!=''){
				echo $newFileName=$this->doctor_model->upload_image($ID);
				die();	
			}
		}
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->doctor_model->delete_doctor_data($IDS);
	    }
	}
        
   public function addedit_avalability($IDS){
	    if($IDS){
                $data['Docdata']=$this->doctor_availability_model->getDoctorById($IDS);
				$data['availability']=$this->doctor_availability_model->getavailability($IDS);
				$data['Doc_location']=$this->doctor_availability_model->getdoctorlocation();
                //print_r($data);die;
                $this->layout('doctor/addedit_avalability',$data);
	    }
	}
   public function avalability_filter(){
                //avalability date abd doctor id
				$data['availability']=$this->doctor_availability_model->getavailabilitybyDocId();
				$data['Doc_location']=$this->doctor_availability_model->getdoctorlocation();
                if(!empty($data)){
                echo json_encode($data);
                }else{
                    echo false;
                }
                //print_r($data);die;
                //$this->layout('doctor/addedit_avalability',$data);
	   
	}
        
    public function saveTime(){
       //echo $this->input->post('availid');die;
       //print_r($_POST);die;
        $this->doctor_availability_model->saveTime();
	}
        
    public function removeTime(){
        $this->doctor_availability_model->removeTime();
	}
	
	
    public function doctorListView_pagination(){
            $no_limit=$this->input->post('filter_no');
            if($no_limit!=''){
                $limit=$no_limit;
            }else{
                $limit=10;
            }
         $total_rows=0;
		$config = array();
		$config["base_url"] = base_url()."doctor/doctorListView_pagination/";
		$config["total_rows"] =$total_rows= $this->doctor_model->get_count($is_active='');
		$config["per_page"] = $limit;
		//Note:-
		//Very simple configuration. I have separated by line to understand it easily. We can also customize it another way according to the requirement.
		//we can also use searching easily. If it is required, I can send that code.
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['num_links'] = 2;
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active highlight"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$config['next_tag_open'] = '<li class="pg-next">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_tag_open'] = '<li class="pg-prev">';
		$config['prev_tag_close'] = '</li>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$offset = 0;
		if($this->input->get('per_page')){
			$pageNo=$this->input->get('per_page');
			$offset = ($pageNo - 1) * $limit;
		}		
        $this->pagination->initialize($config);
        $data['page'] = $offset;
        $data["links"] = $this->pagination->create_links();
        $details=$this->doctor_model->getData_list($is_active='',$limit, $offset);
        $data['details']=$details;
        $data['limit']=$limit;
        $data['start_of']=$this->pagination->cur_page;
        $data['end_of']=$this->pagination->per_page;
        $data['total_data']=$total_rows;
        $data['MODULEID']=$this->MODULEID;
        $data['mode']="Manage";
        $data['heading']=$this->heading;

        $this->layout('doctor/doctor_list_view',$data);
    }
	
	
	
    public function doctorListView(){
        $details=$this->doctor_model->getData($is_active='');
        $data['details']=$details;
        $data['MODULEID']=$this->MODULEID;
        $data['mode']="Manage";
        $data['heading']=$this->heading;
        $this->layout('doctor/doctor_list_view',$data);
    }
    
    public function doctorGridView(){
        $limit=12; $total_rows=0;
		$config = array();
		$config["base_url"] = base_url()."doctor/doctorGridView/";
		$config["total_rows"] = $total_rows=$this->doctor_model->get_count($is_active='');
		$config["per_page"] = $limit;
		//Note:-
		//Very simple configuration. I have separated by line to understand it easily. We can also customize it another way according to the requirement.
		//we can also use searching easily. If it is required, I can send that code.
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['num_links'] = 2;
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active highlight"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$config['next_tag_open'] = '<li class="pg-next">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_tag_open'] = '<li class="pg-prev">';
		$config['prev_tag_close'] = '</li>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$offset = 0;
		if($this->input->get('per_page')){
			$pageNo=$this->input->get('per_page');
			$offset = ($pageNo - 1) * $limit;
		}		
        $this->pagination->initialize($config);
        $data['page'] = $offset;
        $data["links"] = $this->pagination->create_links();
	//$details = $this->pdata_model->getdata($limit, $offset);
        
        
        $details=$this->doctor_model->getDataGrid($is_active='',$limit, $offset);
        $data['details']=$details;
		$data['limit']=$limit;
        $data['start_of']=$this->pagination->cur_page;
        $data['end_of']=$this->pagination->per_page;
        $data['total_data']=$total_rows;
        $data['MODULEID']=$this->MODULEID;
        $data['mode']="Manage";
        $data['heading']=$this->heading;

        $this->layout('doctor/doctor_grid_view',$data);
    }
    
    public function removedoctor_image(){
            $id=$this->input->post('id');
            $old_img=$this->input->post('old_img');
            if($this->doctor_model->removedoctor_image($id,$old_img)){
                $status=1;
            }else{
                $status=0;
            }
            echo json_encode(array("status"=>$status));
            
        }
        
    public function getDoctor_image(){
            $id=$this->input->post('id');
            if($data=$this->doctor_model->getDoctor_image($id)){
                $image=$data;
                $status=1;
            }else{
                $image='';
                $status=0;
            }
            echo json_encode(array("status"=>$status,'image'=>$image));
            
        }
    
		public function Doctor_imageUpload(){
            $data = $_POST["image"];
            $id = $_POST["id"];
            //$image_array_1 = explode(";", $data);
            $image_array = explode(",", $data);
            $data = base64_decode($image_array[1]);
            //print_r($data);die;
            $imageName = 'doctor_image'.time() . '.png';
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."doctor-profile-image/".$curr_year."/".$curr_month."/";
            if (!is_dir($dest)) {
		   mkdir($dest, 0777, TRUE);
		}
            file_put_contents($dest.$imageName, $data);
            $dataimg=array("image"=>$name=$dest.$imageName);
            if($this->doctor_model->SaveDoctorImage($id,$dataimg)){
            //echo '<img src="'.$imageName.'" class="img-thumbnail" />';
            echo $dest.$imageName;
            }else{
                echo false;
            }
        }
	
}
