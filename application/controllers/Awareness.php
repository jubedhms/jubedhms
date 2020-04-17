<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class awareness extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('awareness_model');
		$this->load->model('cities_model');
		$this->load->model('districts_model');
		$this->load->model('provinces_model');
                $this->load->library('pagination');
        $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Article';
		$this->mode='Add';
		$this->MODULEID=14;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->awareness_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		//$details=$this->awareness_model->getData($is_active='');
		//$category=$this->awareness_model->getCategoryData($is_active='');
		//$data['categories']=$category;
		//$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('awareness/manage_awareness',$data);
	}
	
	
	
	public function addedit_awareness($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->awareness_model->edit_awareness();
			}else {
                $this->awareness_model->add_awareness();
			}
			redirect('awareness');
			die();
		}
		
		if($ID!=''){
			$details=$this->awareness_model->loadDataById($ID);
			$this->mode='Edit';
		}
		$data['provinces']=$this->provinces_model->getData($is_active='1');
		$data['cities']=$this->cities_model->getData($is_active='1');
		$data['districts']=$this->districts_model->getData($is_active='1');
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('awareness/addedit_awareness',$data);
	}
	
	public function view_awareness($ID=''){
		if(!checkModulePermission($this->MODULEID,'view_btn')){ 
			redirect('dashboard');
			die();
		}

		$this->mode='View';
		$details=$this->awareness_model->loadDataById($ID);
		$data['provinces']=$this->provinces_model->getData($is_active='1');
		$data['cities']=$this->cities_model->getData($is_active='1');
		$data['districts']=$this->districts_model->getData($is_active='1');
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		
		$this->layout('awareness/view_awareness',$data);
	}
	public function change_image(){
		
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		
		if($_POST){
			if($ID!=''){
				$newFileName=$this->awareness_model->upload_image($ID);
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
		    $this->awareness_model->delete_awareness_data($IDS);
	    }
	}
	
        public function getCity_byProvinceId(){             
            $province_id=$this->input->post('province_id'); 
            if($province_id){
            $data['cities']=$this->cities_model->getDataByProvinceId($province_id);
            if(!empty($data['cities'])){
                echo json_encode($data);
            }else{
                echo false;
            }
            }
        }
        
	public function getDistrict_byCityId(){             
            $city_id=$this->input->post('city_id'); 
            if($city_id){
            $data['districts']=$this->districts_model->get_districtByCityId($city_id);
            if(!empty($data['districts'])){
                echo json_encode($data);
            }else{
                echo false;
            }
            }
        }
        
        public function getListView(){
            $details=$this->awareness_model->getData($is_active='');
            $data['details']=$details;
            $data['MODULEID']=$this->MODULEID;
            $this->layout('awareness/awareness_list',$data);
	}
        
        public function awarenessList_pagination(){
            $no_limit=$this->input->post('filter_no');
            if($no_limit!=''){
                $limit=$no_limit;
            }else{
                $limit=10;
            }
            $total_rows=0;
		$config = array();
		$config["base_url"] = base_url()."awareness/awarenessList_pagination/";
		$config["total_rows"] =$total_rows= $this->awareness_model->get_count($is_active='');
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
        $details=$this->awareness_model->getData($is_active='',$limit, $offset);
        $data['details']=$details;
        $data['limit']=$limit;
        $data['start_of']=$this->pagination->cur_page;
        $data['end_of']=$this->pagination->per_page;
        $data['total_data']=$total_rows;
        $data['MODULEID']=$this->MODULEID;
        $data['mode']="Manage";
        $data['heading']=$this->heading;

        $this->layout('awareness/awareness_list',$data);
    }
    
    public function updateEndDate(){
        $id=$this->input->post('id');
        $date_end=$this->input->post('date_end');
        if($this->awareness_model->updateEndDate($id,$date_end)){
            $status=1;
            $msg='Date changed successfully.';
        }else{
            $status=0;
            $msg='Date change failed.';
        }
        $arr=array('status'=>$status,'msg'=>$msg);
        echo json_encode($arr);
        
    }
    
    public function removeawareness_image(){
            $id=$this->input->post('id');
            $old_img=$this->input->post('old_img');
            if($this->awareness_model->removeawareness_image($id,$old_img)){
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
        $dest = $this->config->item('ROOT_DATA_DIR')."awareness-image/".$curr_year."/".$curr_month."/";
        $resultData = uploadImg($file_name,$dest);
        if($resultData!==false){
            $file=$dest.$resultData['upload_data']['file_name'];
            echo $file; die;
            return true;
        }
    }

	
}
