<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_manage extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('Chat_manage_model');
                $this->load->library('pagination');
                $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Chat';
		$this->mode='Add';
		$this->MODULEID=55;
                $this->load->helper('chat');
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard');
			die();
		}

		if($_POST){
			//if($this->Chat_manage_model->addedit()){
				//redirect($this->main_page); die;
			//}
		}

		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;

		$this->layout('chatbot/manage_questions_answers',$data);
	}
	
	
	
	public function addedit_question($ID=''){	
		if(!checkModulePermission($this->MODULEID,'add_btn') || !checkModulePermission($this->MODULEID,'edit_btn')){ 
			//redirect('dashboard');
			die();
		}
		
		$details='';
		
		if($_POST){
			if($ID!=''){
				$this->Chat_manage_model->edit_question_answer();
			}else {
                                $this->Chat_manage_model->add_question_answer();
			}
			redirect('chat_manage');
			die();
		}
		
		if($ID!=''){
			$details=$this->Chat_manage_model->loadDataById($ID);
			$this->mode='Edit';
		}
		$data['details']=$details;
		$data['main_page']=$this->main_page;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->main_page=$this->main_page;
		$this->layout('chatbot/addedit_question',$data);
	}
	
	public function change_image(){
		
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		
		if($_POST){
			if($ID!=''){
				$newFileName=$this->Chat_manage_model->upload_image($ID);
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
		    $this->Chat_manage_model->delete_chat_data($IDS);
	    }
	}
	
        public function chatList_pagination(){
            $no_limit=$this->input->post('filter_no');
            if($no_limit!=''){
                $limit=$no_limit;
            }else{
                $limit=10;
            }
            $total_rows=0;
		$config = array();
		$config["base_url"] = base_url()."chat_manage/chatList_pagination/";
		$config["total_rows"] =$total_rows= $this->Chat_manage_model->get_count($is_active='');
		$config["per_page"] = $limit;
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
        $details=$this->Chat_manage_model->getData($is_active='',$limit, $offset);
        $data['details']=$details;
        $data['limit']=$limit;
        $data['start_of']=$this->pagination->cur_page;
        $data['end_of']=$this->pagination->per_page;
        $data['total_data']=$total_rows;
        $data['MODULEID']=$this->MODULEID;
        $data['mode']="Manage";
        $data['heading']=$this->heading;

        $this->layout('chatbot/questions_answers_list',$data);
    }
    
    public function updateEndDate(){
        $id=$this->input->post('id');
        $date_end=$this->input->post('date_end');
        if($this->Chat_manage_model->updateEndDate($id,$date_end)){
            $status=1;
            $msg='Date changed successfully.';
        }else{
            $status=0;
            $msg='Date change failed.';
        }
        $arr=array('status'=>$status,'msg'=>$msg);
        echo json_encode($arr);
        
    }
}
