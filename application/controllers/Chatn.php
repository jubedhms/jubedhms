<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatn extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('chat_modeln');
                $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Chat List';
		$this->mode='';
		$this->MODULEID=54;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
		redirect('dashboard'); die;
		}
		$LOGINID=$this->LOGINID;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		$this->layout('chatbotn',$data);
	}
        
	public function getAllPatient(){
            $data['patients']=$this->chat_modeln->getAllPatient();
            $i=0;
            foreach($data['patients'] as $row){
                    if($row->username){
                        $unseenCount=0;
                        $arrdata=$this->chat_modeln->UserChats($row->username);
                        if(!empty($arrdata)){
                        foreach($arrdata as $rowchat){
                            if($rowchat->is_seen==0 && $rowchat->is_support==0){
                                $unseenCount++;
                            }
                        }
                        }
                        $data['patients'][$i]->minute=$this->getTimeDiffMinute($row->last_chat_patient);
                        $data['patients'][$i]->notification=$unseenCount;
                    }else{
                        $data['patients'][$i]->minute=100;
                        $data['patients'][$i]->notification=0;
                    }
                    $i++;
            }
            echo json_encode($data);
        }
        
        private function getTimeDiffMinute($datetime){
            $start = date_create($datetime);
            $current=date_create(date('Y-m-d H:i:s'));
            $start=date_create($datetime);
            $diff=date_diff($current,$start);
            if($diff->y>0){
                return $diff->y*365*24*60;
            }
            if($diff->m>0){
                return $diff->m*30*24*60;
            }
            if($diff->d>0){
                return $diff->d*24*60;
            }
            if($diff->h>0){
                return $diff->h*60;
            }
            if($diff->i>0){
                return $diff->i;
            }
        }
        
	public function openChat(){
            if(!checkModulePermission($this->MODULEID)){ 
            }
            $username=$this->input->post('username');
            $arrdata=$this->chat_modeln->UserChats($username);
            if(!empty($arrdata)) {
                    $this->chat_modeln->updateSeenMSG($username,0);//seen update
                    $data['msgg']=$arrdata;
                }
            $data['question']=$this->chat_modeln->get_question();
            $this->load->view('includes/chatn',$data);
        }
        
	public function revert_from_support(){
            $supportName=$this->session->userdata('username'); //support session name
            $username=$this->input->post('username');//patient name
            $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
            $message=trim($this->input->post('message'));
            $date=date('Y-m-d');
            $time=date('H:i:s A');
			$date_time=date('Y-m-d H:i:s');
            //pick last question
            $exist_message=$this->chat_modeln->getLastQuery($username);
            if($exist_message!=''){
                //check for question answer exist in database table
                $this->chat_modeln->checkQuestionAnswer($exist_message,$message);
            }
                $data= array(
                "username"=>$username,
                "support_name"=>$supportName,
                "subparent"=>$subparent,
                "message"=>$message,
                "is_not_auto_reply"=>1,
                "date"=>$date,
                "time"=>$time,
				"date_time"=>$date_time,
                "is_seen"=>0,
                "is_support"=>1
                );
            $this->chat_modeln->SaveUserChatsAdmin($data,$exist_message);
            $this->chat_modeln->updateChattime($username);
            $data=$this->chat_modeln->UserChats($username);
            if(!empty($data)) {
                $data['msgg']=$data;
            }else{
                 $data['msgg']='';
            }
            $this->load->view('includes/chatn',$data);
        }
		
	
	public function getMessageCount(){
            $data=$this->chat_modeln->getMessageCount();
            if($data){
                echo json_encode($data);
            }else{
                return false;
            }
        }
}
