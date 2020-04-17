<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pregnancy_period extends MY_Controller {
	public function __construct(){
        parent::__construct();
            $this->load->library('pagination');
            $this->load->model('pregnancy_period_model');
            $this->main_page=base_url(''.strtolower(get_class($this)));
            $this->heading='Pregnancy Period';
            $this->mode='Add';
            $this->MODULEID=17;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->pregnancy_period_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		//$details=$this->pregnancy_period_model->getData($is_active='');
		//$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('pregnancy_period/manage_pregnancy_period',$data);
	}
	
	public function addedit_pregnancy_period($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->pregnancy_period_model->edit_pregnancy_period();
			}else {
                $this->pregnancy_period_model->add_pregnancy_period();
			}
			redirect('pregnancy_period');
			die();
		}
		
		if($ID!=''){
			$details=$this->pregnancy_period_model->loadDataById($ID);
			$this->mode='Edit';
		}
		
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']='Pregnancy Period';
		$this->main_page=$this->main_page;
		$this->layout('pregnancy_period/addedit_pregnancy_period',$data);
	}
	
	public function view_pregnancy_period($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->pregnancy_period_model->loadDataById($ID);
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']='Pregnancy Period';
		$this->main_page=$this->main_page;
		
		$this->layout('pregnancy_period/view_pregnancy_period',$data);
	}
	public function change_image(){
		
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		
		if($_POST){
			if($ID!=''){
				$newFileName=$this->pregnancy_period_model->upload_image($ID);
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
		    $this->pregnancy_period_model->delete_pregnancy_period_data($IDS);
	    }
	}
	
        public function pregnancyList_pagination(){
            $no_limit=$this->input->post('filter_no');
            if($no_limit!=''){
                $limit=$no_limit;
            }else{
                $limit=10;
            }
            $total_rows=0;
		$config = array();
		$config["base_url"] = base_url()."pregnancy_period/pregnancyList_pagination/";
		$config["total_rows"] =$total_rows= $this->pregnancy_period_model->get_count($is_active='');
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
        $details=$this->pregnancy_period_model->getData($is_active='',$limit, $offset);
        $data['details']=$details;
        $data['limit']=$limit;
        $data['start_of']=$this->pagination->cur_page;
        $data['end_of']=$this->pagination->per_page;
        $data['total_data']=$total_rows;
        $data['MODULEID']=$this->MODULEID;
        $data['mode']="Manage";
        $data['heading']=$this->heading;

        $this->layout('pregnancy_period/pregnancy_period_list',$data);
    }
    
    public function removepregnancy_image(){
            $id=$this->input->post('id');
            $old_img=$this->input->post('old_img');
            if($this->pregnancy_period_model->removepregnancy_image($id,$old_img)){
                $status=1;
            }else{
                $status=0;
            }
            echo json_encode(array("status"=>$status));
            
        }    

	public function getEditorImageLink(){
        $file_name ='filepic';
        $curr_year=date('Y');
        $curr_month=date('m');
        $dest = $this->config->item('ROOT_DATA_DIR')."pregnancy-period-image/".$curr_year."/".$curr_month."/";
        $resultData = uploadImg($file_name,$dest);
        if($resultData!==false){
            $file=$dest.$resultData['upload_data']['file_name'];
            echo $file; die;
            return true;
        }
    }
}
