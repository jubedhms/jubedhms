<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Due_date extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('due_date_model');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Due Date';
		$this->mode='Add';
		$this->MODULEID=16;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->due_date_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$details=$this->due_date_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('due_date/manage_due_date',$data);
	}
	
	public function addedit_due_date($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->due_date_model->edit_due_date();
			}else {
                $this->due_date_model->add_due_date();
			}
			redirect('due_date');
			die();
		}
		
		if($ID!=''){
			$details=$this->due_date_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['PregnancyWeeks']=$this->due_date_model->getPregnancyWeekData($ID);
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']= $this->heading;
		$this->main_page=$this->main_page;
		$this->layout('due_date/addedit_due_date',$data);
	}
	
	public function view_due_date($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}
		
		$details=$this->due_date_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']='View';
		$data['heading']= $this->heading;
		$this->main_page=$this->main_page;

		$this->layout('due_date/view_due_date',$data);
	}
	
	public function change_image(){
		//if(!checkModulePermission($this->MODULEID_P)){ 
			//redirect('dashboard');
			//die();
		//}
		$ID=(isset($_POST['ID']))?$_POST['ID']:'';
		$data='';
		if($_POST){
			if($ID!=''){
				$newFileName=$this->due_date_model->upload_image($ID);
				echo $newFileName;
				die;
			}
		}
	}
	
   public function deleteData($IDS=array()){
	    if(isset($_POST['IDS']) || $IDS){
		    $this->due_date_model->delete_due_date_data($IDS);
	    }
	}
	
        
        public function removedueDate_image(){
            $id=$this->input->post('id');
            $old_img=$this->input->post('old_img');
            if($this->due_date_model->removedueDate_image($id,$old_img)){
                $status=1;
            }else{
                $status=0;
            }
            echo json_encode(array("status"=>$status));
            
        }
        
        public function getdueDate_image(){
            $id=$this->input->post('id');
            if($data=$this->due_date_model->getdueDate_image($id)){
                $image=$data;
                $status=1;
            }else{
                $image='';
                $status=0;
            }
            echo json_encode(array("status"=>$status,'image'=>$image));
            
        }
        
        public function dueDate_imageUpload(){
            $data = $_POST["image"];
            $id = $_POST["id"];
            //$image_array_1 = explode(";", $data);
            $image_array = explode(",", $data);
            $data = base64_decode($image_array[1]);
            //print_r($data);die;
            $imageName = 'illustration_'.time() . '.png';
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."due-date-image/".$curr_year."/".$curr_month."/";
            if (!is_dir($dest)) {
		   mkdir($dest, 0777, TRUE);
		}
            file_put_contents($dest.$imageName, $data);
            $dataimg=array("image_src"=>$name=$dest.$imageName);
            if($id){
            if($this->due_date_model->SaveDueDateImage($id,$dataimg)){
            //echo '<img src="'.$imageName.'" class="img-thumbnail" />';
            echo $dest.$imageName;
            }else{
                echo false;
            }
            }else{
                echo $dest.$imageName;
            }
            
        }

	
}
