<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('chat_model');
                $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Chat List';
		$this->mode='';
		$this->MODULEID=30;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
		redirect('dashboard'); die;
		}
		$LOGINID=$this->LOGINID;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		if($_POST){
		//if($this->app_model->addedit()){ 
		//redirect($this->main_page); die;
		//}
		}
		//$details=$this->app_model->getData($is_active='');
		//$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		$this->layout('chatbot',$data);
	}
        
	public function getAllPatient(){
            $data['patients']=$this->chat_model->getAllPatient();
            $i=0;
            foreach($data['patients'] as $row){
                if(is_dir("data/chat_history")){ 
                    if(file_exists("data/chat_history/".$row->username.".json")){
                        $fdata=file_get_contents("data/chat_history/".$row->username.".json");
                        $chatData=json_decode($fdata);
                        $unseenCount=0;
                        foreach($chatData as $rowchat){
                            if($rowchat->is_seen==0 && $rowchat->is_support==0){
                                $unseenCount++;
                            }
                        }
                        $data['patients'][$i]->minute=$this->getTimeDiffMinute($row->last_chat_patient);
                        $data['patients'][$i]->notification=$unseenCount;
                    }else{
                        $data['patients'][$i]->minute=100;
                        $data['patients'][$i]->notification=0;
                    }
                    }
                    $i++;
            }
            //print_r($data);die;
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
            $file_name=$this->input->post('username');
            $dest= 'data/chat_history/';
            $target_file=$dest.$file_name.'.json';
            if(is_dir($dest)) {
                if(file_exists($target_file)) {
                    $fdata=file_get_contents($target_file);
                    $arrdata=(json_decode($fdata));
                    $i=0; //$j=1;
                    foreach($arrdata as $row){
                        if($row->is_seen==0 && $row->is_support==0){
                            $data[]= [
                                "ID"=>$i,
                                "username"=>$row->username,
                                "subparent"=>$row->subparent,
                                "message"=>$row->message,
                                "date"=>$row->date,
                                "time"=>$row->time,
                                "is_seen"=>1,
                                "is_support"=>$row->is_support
                                ];
                        }else{
                            $data[]= [
                                "ID"=>$i,
                                "username"=>$row->username,
                                "subparent"=>$row->subparent,
                                "message"=>$row->message,
                                "date"=>$row->date,
                                "time"=>$row->time,
                                "is_seen"=>$row->is_seen,
                                "is_support"=>$row->is_support
                                ];
                        }

                                $jsonData = json_encode($data);
                                $response=file_put_contents($target_file, $jsonData);
                        $i++;
                    }
                    $data['msgg']=json_decode($fdata);
                }
                }
            $data['question']=$this->chat_model->get_question();
            $this->load->view('includes/chat',$data);
        }
        
	public function revert_from_support(){
            $supportName=$this->session->userdata('username'); //support session name
            $username=$this->input->post('username');//patient name
            $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
            $message=$this->input->post('message');
            $dest= 'data/chat_history/';
            $file_name=$username;
            $target_file=$dest.$file_name.'.json';
            $date=date('Y-m-d');
            $time=date('H:i:s A');

            if(file_exists($target_file)){
                $contents = file_get_contents($target_file);
                $tempArray = json_decode($contents);
                $last = end($tempArray);	
                $ID=($last)?($last->ID+1):'1';

                $data= [
                "ID"=>$ID,
                "username"=>$supportName,
                "subparent"=>$subparent,
                "message"=>$message,
                "date"=>$date,
                "time"=>$time,
                "is_seen"=>0,
                "is_support"=>1
                ];

                array_push($tempArray, $data);
                $jsonData = json_encode($tempArray);	
            }else{
                $data[]= [
                "ID"=>1,
                "username"=>$supportName,
                "subparent"=>$subparent,
                "message"=>$message,
                "date"=>$date,
                "time"=>$time,
                "is_seen"=>0,
                "is_support"=>1
                ];
                $jsonData = json_encode($data);
            }
            $response=file_put_contents($target_file, $jsonData);
            $this->chat_model->updateChattime($username);
            if(file_exists($target_file)) {
                $fdata=file_get_contents($target_file);
                $data['msgg']=json_decode($fdata);
            }
            $data['question']=$this->chat_model->get_question();
            $this->load->view('includes/chat',$data);
            
        }
}
