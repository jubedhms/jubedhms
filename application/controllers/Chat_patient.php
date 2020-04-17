<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_patient extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('chat_model');
                $this->main_page=base_url(''.strtolower(get_class($this)));
		$this->heading='Chat List';
		$this->mode='';
		$this->MODULEID=36;
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
		$details=$this->chat_model->getDataPatient($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']="Manage";
		$data['heading']=$this->heading;
		$this->layout('chatbot_patient',$data);
	}
        
	public function openChat(){
            if(!checkModulePermission($this->MODULEID)){ 
            }
            $count1a=$count2a=$count3a=$count4a=$count5a=$count6a=0;
            $count1b=$count2b=$count3b=$count4b=$count5b=$count6b=0;
            $subparent='';
            $is_old='';
            $file_name=$this->input->post('username');
            $dest= 'data/chat_history/';
            $target_file=$dest.$file_name.'.json';
            if(is_dir($dest)) {
                if(file_exists($target_file)) {
                    $fdata=file_get_contents($target_file);
                    $arrdata=(json_decode($fdata));
                    //print_r($arrdata);die;
                    $i=0; //$j=1;
                    foreach($arrdata as $row){
                        if($row->is_support==0){
                            if($i==1){
                             $is_old=$row->message;
                            }
                            if($row->is_seen==1){
                            $data[]=[
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
                            $data[]=[
                                    "ID"=>$i,
                                    "username"=>$row->username,
                                    "subparent"=>$row->subparent,
                                    "message"=>$row->message,
                                    "date"=>$row->date,
                                    "time"=>$row->time,
                                    "is_seen"=>0,
                                    "is_support"=>$row->is_support
                                    ];
                        }
                        }else{
                            $data[]=[
                                    "ID"=>$i,
                                    "username"=>$row->username,
                                    "subparent"=>$row->subparent,
                                    "message"=>$row->message,
                                    "date"=>$row->date,
                                    "time"=>$row->time,
                                    "is_seen"=>1,
                                    "is_support"=>$row->is_support
                                    ];
                        }

                                $jsonData = json_encode($data);
                                $response=file_put_contents($target_file, $jsonData);
                        $i++;
                        if($row->subparent){
                            $subparent=$row->subparent;
                        }
                    }
                    $data['msgg']=json_decode($fdata);
                    if($subparent){
                    $fdata=file_get_contents($target_file);
                    $arrdata=json_decode($fdata);
                    foreach($arrdata as $row){
                        if($row->is_support==1){
                           switch($row->subparent){ //count question by type
                               case '1a':
                                   $count1a++;
                                   break;
                               case '2a':
                                   $count2a++;
                                   break;
                               case '3a':
                                   $count3a++;
                                   break;
                               case '4a':
                                   $count4a++;
                                   break;
                               case '5a':
                                   $count5a++;
                                   break;
                               case '6a':
                                   $count6a++;
                                   break;
                               
                               case '1b':
                                   $count1b++;
                                   break;
                               case '2b':
                                   $count2b++;
                                   break;
                               case '3b':
                                   $count3b++;
                                   break;
                               case '4b':
                                   $count4b++;
                                   break;
                               case '5b':
                                   $count5b++;
                                   break;
                               case '6b':
                                   $count6b++;
                                   break;
                               default :
                                   break;
                           }
                           
                        }
                    } //get question by type
                if($is_old=='No'){ //case Of No
                    switch($subparent){
                                case '1a':
                                    if($count1a==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count1a+1,1);
                                    }elseif($count1a==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin('2a',1,1);
                                        $data['question2']=$this->chat_model->getquestionBytypeadmin('2a',2,1);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '2a':
                                    if($count2a==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin('3a',1,1);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '3a':
                                    if($count3a==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count3a+1,1);
                                    }elseif($count3a==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count3a+1,1);
                                    }
                                    break;
                                case '4a':
                                    if($count4a==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4a,1);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count4a==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4a,1);
                                    }elseif($count4a==3){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4a,1);
                                    }elseif($count4a==4){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4a,1);
                                    }
                                    break;
                                case '5a':
                                    if($count5a==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5a,1);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count5a==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5a,1);
                                    }elseif($count5a==3){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5a,1);
                                    }elseif($count5a==4){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5a,1);
                                    }
                                    break;
                                case '6a':
                                    if($count6a==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6a,1);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count6a==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6a,1);
                                    }elseif($count6a==3){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6a,1);
                                    }elseif($count6a==4){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6a,1);
                                    }
                                    break;
                                default :
                                    break;
                    }
					
					$msg=end($arrdata);
                    if($msg->date<date('Y-m-d') && count($arrdata)>=14){
                        $data['question']=$this->chat_model->default_questionadmin();
                    }
                    }else{
                        switch($subparent){
                                case '1b':
                                    if($count1b==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count1b+1,2);
                                    }elseif($count1b==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin('2b',1,2);
                                        $data['question2']=$this->chat_model->getquestionBytypeadmin('2b',2,2);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '2b':
                                    if($count2b==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin('3b',1,2);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '3b':
                                    if($count3b==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count3b+1,2);
                                    }elseif($count3b==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count3b+1,2);
                                    }
                                    break;
                                case '4b':
                                    if($count4b==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4b,2);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count4b==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4b,2);
                                    }elseif($count4b==3){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4b,2);
                                    }elseif($count4b==4){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count4b,2);
                                    }
                                    break;
                                case '5b':
                                    if($count5b==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5b,2);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count5b==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5b,2);
                                    }elseif($count5b==3){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5b,2);
                                    }elseif($count5b==4){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count5b,2);
                                    }
                                    break;
                                case '6b':
                                    if($count6b==1){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6b,2);
                                        $data['option']=$this->chat_model->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count6b==2){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6b,2);
                                    }elseif($count6b==3){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6b,2);
                                    }elseif($count6b==4){
                                        $data['question']=$this->chat_model->getquestionBytypeadmin($subparent,$count6b,2);
                                    }
                                    break;
                                default :
                                    break;
                        }
						$msg=end($arrdata);
						if($msg->date<date('Y-m-d') && count($arrdata)>=14){
							$data['question']=$this->chat_model->default_questionadmin();
						}
                    }
                    }elseif($is_old=='Yes'){
                        $data['question']=$this->chat_model->getquestionBytypeadmin('1b',1,2);
                    }elseif($is_old=='No'){
                        $data['question']=$this->chat_model->getquestionBytypeadmin('1a',1,1);
                    }
                }else{
                    $data['question']=$this->chat_model->get_questionadmin();
                }
            }
            $this->load->view('includes/patient_chat',$data);
        }
               
	public function revert_from_patient(){
            $username=$this->input->post('username');//patient name
            $message=$this->input->post('message');
            $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
            $question=($this->input->post('question'))?$this->input->post('question'):'';
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
                if($question){
                $data=  [
                        "ID"=>$ID,
                        "username"=>$username,
                        "subparent"=>$subparent,
                        "message"=>$question,
                        "date"=>$date,
                        "time"=>$time,
                        "is_seen"=>0,
                        "is_support"=>1
                        ];
                array_push($tempArray, $data);
                $jsonData = json_encode($tempArray);
                $response=file_put_contents($target_file, $jsonData);
                $tempArray=array();
                $contents = file_get_contents($target_file);
                $tempArray = json_decode($contents);
                $last = end($tempArray);	
                $ID=($last)?($last->ID+1):'1';
                    
                $data=  [
                        "ID"=>$ID,
                        "username"=>$username,
                        "subparent"=>$subparent,
                        "message"=>$message,
                        "date"=>$date,
                        "time"=>$time,
                        "is_seen"=>0,
                        "is_support"=>0
                        ];
               
                array_push($tempArray, $data);
                }else{
                    
                $data=  [
                        "ID"=>$ID,
                        "username"=>$username,
                        "subparent"=>$subparent,
                        "message"=>$message,
                        "date"=>$date,
                        "time"=>$time,
                        "is_seen"=>0,
                        "is_support"=>0
                        ];
                array_push($tempArray, $data);
                }
                
                $jsonData = json_encode($tempArray);	
            }else{
                $data[]= [
                        "ID"=>1,
                        "username"=>$username,
                        "subparent"=>$subparent,
                        "message"=>$message,
                        "date"=>$date,
                        "time"=>$time,
                        "is_seen"=>0,
                        "is_support"=>0
                        ];
                $jsonData = json_encode($data);
            }
            $response=file_put_contents($target_file, $jsonData);
            $this->chat_model->updateChattimePatient($username);
            if(file_exists($target_file)) {
                $fdata=file_get_contents($target_file);
                $data['msgg']=json_decode($fdata);
            }
            $this->load->view('includes/patient_chat',$data);
        }
        
        
        public function chatBotOption(){
            $username=$this->input->post('username');//patient name
            $message=$this->input->post('message');
            $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
            $question=$this->input->post('question');
            $dest= 'data/chat_history/';
            $file_name=$username;
            $target_file=$dest.$file_name.'.json';
            $date=date('Y-m-d');
            $time=date('H:i:s A');

            if(file_exists($target_file)){
                if($subparent=='2a'){
                    switch(trim($message)){
                        case "Children's examination":
                            $subparent='4a';
                            break;
                        case "Vaccination":
                            $subparent='5a';
                            break;
                        case "Department of infertility":
                            $subparent='6a';
                            break;
                        default :
                            break;
                    }
                }elseif($subparent=='2b'){
                    switch(trim($message)){
                        case "Children's examination":
                                $subparent='4b';
                            break;
                        case "Vaccination":
                            $subparent='5b';
                            break;
                        case "Department of infertility":
                            $subparent='6b';
                            break;
                        default :
                            break;
                    }
                }
                $contents = file_get_contents($target_file);
                $tempArray = json_decode($contents);
                $last = end($tempArray);	
                $ID=($last)?($last->ID+1):'1';
                $data=  [
                        "ID"=>$ID,
                        "username"=>$username,
                        "subparent"=>$subparent,
                        "message"=>$question,
                        "date"=>$date,
                        "time"=>$time,
                        "is_seen"=>0,
                        "is_support"=>1
                        ];

                array_push($tempArray, $data);
                $jsonData = json_encode($tempArray);
                $response=file_put_contents($target_file, $jsonData);
                $tempArray=array();
                $contents = file_get_contents($target_file);
                $tempArray = json_decode($contents);
                $last = end($tempArray);	
                $ID=($last)?($last->ID+1):'1';
                $data=  [
                        "ID"=>$ID,
                        "username"=>$username,
                        "subparent"=>$subparent,
                        "message"=>$message,
                        "date"=>$date,
                        "time"=>$time,
                        "is_seen"=>0,
                        "is_support"=>0
                        ];

                array_push($tempArray, $data);
                $jsonData = json_encode($tempArray);	
            }else{
                $data[0]=   [
                            "ID"=>1,
                            "username"=>$username,
                            "subparent"=>$subparent,
                            "message"=>$question,
                            "date"=>$date,
                            "time"=>$time,
                            "is_seen"=>0,
                            "is_support"=>1
                            ];
                $data[1]=   [
                            "ID"=>1,
                            "username"=>$username,
                            "subparent"=>$subparent,
                            "message"=>$message,
                            "date"=>$date,
                            "time"=>$time,
                            "is_seen"=>0,
                            "is_support"=>0
                            ];
                $jsonData = json_encode($data);
            }
            file_put_contents($target_file, $jsonData);
            $this->chat_model->updateChattimePatient($username);
        }
        
        
}
