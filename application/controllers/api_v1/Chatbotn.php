<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Chatbotn extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/patient_model');
		$this->load->model('api_v1/chat_modeln');
		$this->load->model('api_v1/doctor_model');
	}
	
	public function index_get()
	{
		$json = array("status" => 0, "message" => "Request URL not accepted");
		$this->response($json, REST_Controller::HTTP_OK); 
	}

	// for match app token
	private function matchAppToken($token=''){
		if($token!=''){
			return true;
		}else{
			return false;
		}
	}
	//end	

	/*
	* Method name: query_from_patient
	* Input: token, username, query
	*/

	public function query_from_patient_post()
	{
            //print_r($_POST);die;
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// POST data
			$permission=false;
			$response=array();
			$token= isset($_POST['token']) ?($_POST['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$date_time=date('Y-m-d H:i:s');
				$datetime_question=$this->input->post('datetime_question');
				$datetime_question=(isset($datetime_question))?$datetime_question:'0';
				$username=isset($_POST['username']) ?($_POST['username']) : "";
				$query=isset($_POST['query']) ?trim($_POST['query']) : "";
				$language=isset($_POST['language']) ?trim($_POST['language']) : "en";
				if($username!='' && $query!=''){
					$is_existed=$this->patient_model->checkExist($username);	
						if($is_existed==true){
                                                    $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
                                                    $question=($this->input->post('question'))?$this->input->post('question'):'';
                                                    $message=$query;
                                                ///
                                                    
                                                $date=date('Y-m-d');
                                                $time=date('H:i:s A');
                                                $data=$this->chat_modeln->UserChats($username);
                                                if($this->chat_modeln->getIsOldPatient($username)){ //get patient type old or new
                                                    $is_old='Yes';
                                                }else{
                                                    $is_old='No';
                                                }
                                                $countsubparent=$this->chat_modeln->countPredefinedQuestion($username,$is_old);        
                                                if(!empty($data)){
                                                    if($question){
                                                    $data=  array(
                                                            "username"=>$username,
                                                            "subparent"=>$subparent,
                                                            "message"=>$question,
                                                            "date"=>$date,
                                                            "time"=>$time,
															"date_time"=>$date_time,
                                                            "is_seen"=>0,
                                                            "is_support"=>1
                                                            );
                                                    $this->chat_modeln->SaveUserChats($data);
                                                    $data=  array(
                                                            "username"=>$username,
                                                            "subparent"=>$subparent,
                                                            "message"=>$message,
															"datetime_question"=>$datetime_question,
                                                            "date"=>$date,
                                                            "time"=>$time,
															"date_time"=>$date_time,
                                                            "is_seen"=>0,
                                                            "is_support"=>0
                                                            );
                                                    $this->chat_modeln->SaveUserChats($data);
                                                    }else{ //here search by user query to answer automatic question from database table.
                                                    $data=  array(
                                                            "username"=>$username,
                                                            "subparent"=>$subparent,
                                                            "message"=>$message,
															"datetime_question"=>$datetime_question,
                                                            "date"=>$date,
                                                            "time"=>$time,
															"date_time"=>$date_time,
                                                            "is_seen"=>0,
                                                            "is_support"=>0
                                                            );
                                                    $this->chat_modeln->SaveUserChats($data);
                                                    if($countsubparent>=6){
                                                        $ifexist=$this->chat_modeln->FindUserQuery($message,$username,$language);
                                                        if($ifexist!=''){
                                                        $data=  array(
                                                            "username"=>$username,
                                                            "subparent"=>$subparent,
                                                            "message"=>$ifexist,
                                                            "date"=>$date,
                                                            "time"=>$time,
															"date_time"=>$date_time,
                                                            "is_seen"=>0,
                                                            "is_support"=>1
                                                            );
                                                        $this->chat_modeln->SaveUserChatsAdmin($data,$message);
                                                        }
                                                    }

                                                    }
                                                }else{
                                                    $data= array(
                                                            "username"=>$username,
                                                            "subparent"=>$subparent,
                                                            "message"=>$message,
                                                            "date"=>$date,
                                                            "time"=>$time,
															"date_time"=>$date_time,
                                                            "is_seen"=>0,
                                                            "is_support"=>0
                                                            );
                                                    $this->chat_modeln->SaveUserChats($data);
                                                }
                                                $response=$this->chat_modeln->updateChattimePatient($username);
             
                                                    ///
							if($response){
								$json= array("status" => 1, "message" => 'Ok');
							}else{
								$json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
							}
						}else{
							$json = array("status" => 0, "message" => "This username has been not registered.");	
						}	
				}else{
					$json= array("status" => 0, "message" => "Mandatory fields have been empty.");
				}
			}else{
				$json= array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json= array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}

	/*
	* Method name: revert_from_user
	* Desc: get chatbat details status(true for accepted, false for denied)
	* Input: token, 
	*/
	public function revert_from_user_get(){  //to get data of the user form table
		if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$permission=false;
			$response=array();
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username=isset($_GET['username']) ?($_GET['username']) : "";
				
				$start=isset($_GET['start']) ?($_GET['start']) : "";
				$limit=isset($_GET['limit']) ?($_GET['limit']) : "";
				
				$from_date=isset($_GET['from_date']) ?($_GET['from_date']) : "";
				$to_date=isset($_GET['to_date']) ?($_GET['to_date']) : "";

				if($username!=''){
					$is_existed=$this->patient_model->checkExist($username);	
						if($is_existed==true){
                                                    $arrdata=$this->chat_modeln->UserChatslimit($username,$start,$limit,$from_date,$to_date);
							if(!empty($arrdata)){
                                                            $data=$arrdata;
							}else{
                                                            $data=array();
                                                        }	
							$response=$data;
							if($response){
								$json= array("status" => 1, "message" => 'Ok', "data"=>$response);
							}else{
								$json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
							}
						}else{
							$json = array("status" => 0, "message" => "This username has been not registered.");	
						}	
				}else{
					$json= array("status" => 0, "message" => "Mandatory fields have been empty.");
				}
			}else{
				$json= array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json= array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
	}
        
        public function openChat_get(){
		//print_r($_GET);die;
            if($_SERVER['REQUEST_METHOD'] == "GET"){
        	// GET data
			$permission=false;
			$response=array();
			$response2=array();
			$token= isset($_GET['token']) ?($_GET['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username=isset($_GET['username']) ?($_GET['username']) : "";
				
				$start=isset($_GET['start']) ?($_GET['start']) : "";
				$limit=isset($_GET['limit']) ?($_GET['limit']) : "";
				
				$from_date=isset($_GET['from_date']) ?($_GET['from_date']) : "";
				$to_date=isset($_GET['to_date']) ?($_GET['to_date']) : "";

            if($username!=''){
                $is_existed=$this->patient_model->checkExist($username);	
                if($is_existed==true){
                    
			$count1a=$count2a=$count3a=$count4a=$count5a=$count6a=0;
            $count1b=$count2b=$count3b=$count4b=$count5b=$count6b=0;
            $subparent='';
			$subparentRepeat='';
            $is_old='';
			$common_option='';
			$advisory_option='';
            $arrdata=$this->chat_modeln->UserChats($username);
			$arrdatalimit=$this->chat_modeln->UserChatslimit($username,$start,$limit,$from_date,$to_date);
			$oldMsgCount=@count($arrdata);
			
            if(!empty($arrdata)){
			$data['msgg']=$arrdatalimit;
                $arrvale=array_column($arrdata,'subparent');
                $count_array_val=array_count_values($arrvale);
                $count_1c=isset($count_array_val['1c'])?$count_array_val['1c']:'';
            $lastchatdata=end($arrdata);
            $lastChatTime=$lastchatdata->date_time;
            $compareTime=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -1 days"));//-1 days -20 minutes
            $arrdata2=($count_1c>=2)?$this->chat_modeln->UserChatsRepeat($username):array();//get the last one process chat.
           //die; if old message count is greater than 6 then new some question will not come like name,DOB,address.
            if($oldMsgCount>10 && $lastChatTime<= $compareTime){
                //echo 'ok';
                //get data to current array. To get the last repeat chat
                $arrdata=array();
                
            }elseif(!empty($arrdata2)){
                //echo 'ok';die;
                $arrdata=$arrdata2;
                //echo '<pre>';
                //print_r($arrdata2);die;
            }
            }
				
			$prn=$this->chat_modeln->getpatientPRN($username);
            if(!empty($arrdata)){
                    $subparent_data=$this->chat_modeln->getSubParent($username);//subparent for algo yes, no question
                    //print_r($subparent_data);die;
                    if(!empty($subparent_data)){
                        if($subparent_data->subparent=='1'){
                            $subparent=0;
                        }else{
                            $subparentRepeat=$subparent=$subparent_data->subparent;
                        }
                    }
                    if($this->chat_modeln->getIsOldPatient($username)){ //get patient type old or new
                        $is_old='Yes';
                    }else{
                        $is_old='No';
                    }
                    $this->chat_modeln->updateSeenMSG($username,1);//seen update
                    //$data['msgg']=$arrdata;
                        if($subparent){
                        //echo "<pre>";
                        //print_r($arrdata);
                    foreach($arrdata as $row){
                        //echo $row->subparent." ";
                        if(!empty($row->hospital_location_code)){
                            $hospital_location=$row->hospital_location_code;
                        }
                        if(!empty($row->specialty_code)){
                            $specialty_code=$row->specialty_code;
                        }
                        if(!empty($row->common_option)){
                            $common_option=$row->common_option;
                        }
                        if($row->datetime_question!='0'){
                            $datetime_question=$row->message;
                        }
                        if($row->advisory_option){
                            $advisory_option=$row->advisory_option;
                        }
                        
                        if($row->is_support==1){
                            //echo $row->subparent.' ';
                            if($oldMsgCount>10 && $count_1c>3){
                            switch($row->subparent){ //count question by type
                               case '1c':
                                   if($oldMsgCount>10 && $count_1c>3 && $row->common_option!='A'){
                                       if($is_old=='Yes'){
                                        $count1b=3;
                                         $subparent='1b';
                                       }else{
                                           $count1a=3;
                                            $subparent='1a';
                                       }
                                   }
                                   break;
                              
                               case '2a':
                                   $subparent=$subparentRepeat;
                                   $count2a++;
                                   break;
                               case '3a':
                                   $subparent=$subparentRepeat;
                                   $count3a++;
                                   break;
                               case '4a':
                                   $subparent=$subparentRepeat;
                                   $count4a++;
                                   break;
                               case '5a':
                                   $subparent=$subparentRepeat;
                                   $count5a++;
                                   break;
                               case '6a':
                                   $subparent=$subparentRepeat;
                                   $count6a++;
                                   break;
                               
                               
                               case '2b':
                                    $subparent=$subparentRepeat;
                                   $count2b++;
                                   break;
                               case '3b':
                                   $subparent=$subparentRepeat;
                                   $count3b++;
                                   break;
                               case '4b':
                                   $subparent=$subparentRepeat;
                                   $count4b++;
                                   break;
                               case '5b':
                                   $subparent=$subparentRepeat;
                                   $count5b++;
                                   break;
                               case '6b':
                                   $subparent=$subparentRepeat;
                                   $count6b++;
                                   break;
                               default :
                                   break;
                               
                           }
                        }else{
                            //echo 'ok';
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
                           
                        }
                    }  //get question by type
//echo $subparent.' '.$count3b;die;
                if($is_old=='No'){ //case Of No
                    switch($subparent){
								case '1c':
                                    //first question to ask about name.
                                    if($common_option=='A'){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1adv',1,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }else{
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1a',1,1);
                                    }
                                    break;
                                case '1adv':
                                    
                                    //first question to ask about name.
                                    if($common_option=='A'){
                                        if($advisory_option=='VC'){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('3adv',1,1);
                                        }else{
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('2adv',1,1);
                                        //$data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                        }
                                        
                                        }
                                    break;
                                case '1a':
                                    if($count1a==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count1a+1,1);
                                    }elseif($count1a==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1a',3,1);
                                    }elseif($count1a==3){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('2a',1,1);
                                        //$data['question2']=$this->chat_modeln->getquestionBytypeadmin('2a',2,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '2a':
                                    if($count2a==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('3a',1,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '3a':
                                    if($count3a==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count3a+1,1);
                                    }elseif($count3a==2){
                                        if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count3a+1,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }
                                    break;
                                case '4a':
                                    if($count4a==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4a,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count4a==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4a,1);
                                    }elseif($count4a==3){
                                        if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4a,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }elseif($count4a==4){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4a,1);
                                    }
                                    break;
                                case '5a':
                                    if($count5a==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5a,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count5a==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5a,1);
                                    }elseif($count5a==3){
                                        if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5a,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }elseif($count5a==4){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5a,1);
                                    }
                                    break;
                                case '6a':
                                    if($count6a==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6a,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count6a==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6a,1);
                                    }elseif($count6a==3){
                                        if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6a,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }elseif($count6a==4){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6a,1);
                                    }
                                    break;
                                default :
                                    break;
                    }
					
                    $msg=end($arrdata);
                    $countsubparent=$this->chat_modeln->countPredefinedQuestion($username,$is_old);
                    //if($msg->date<date('Y-m-d') && count($arrdata)>=14){
                        $timeMinus_10min=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -2 minutes"));
                        if($msg->date_time<$timeMinus_10min && $countsubparent>=6){
                        //$data['question']=$this->chat_modeln->default_questionadmin();
                        if(date('H:i:s')>='00:00:00' && date('H:i:s')<'12:00:00'){//morning
                            $subparentn='helpm';
                            $level=1;
                            $parent=0;
                            $parent_id=37;
                        }
                        if(date('H:i:s')>='12:00:00' && date('H:i:s')<'17:00:00'){//afternoon
                            $subparentn='helpa';
                            $level=2;
                            $parent=0;
                            $parent_id=38;
                        }
                        if(date('H:i:s')>='17:00:00' && date('H:i:s')<'24:00:00'){//evening
                            $subparentn='helpe';
                            $level=3;
                            $parent=0;
                            $parent_id=39;
                        }
                        $data['question']=$this->chat_modeln->default_questionadmin2($subparentn,$level,$parent);
                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($parent_id,1);
                    }elseif($dataNotAnswered=$this->chat_modeln->notAnsweredChatByAdmin($username)){
                        $last_data=array();
                        $notAnsweredCount=@count($dataNotAnswered);
                        $last_data=end($dataNotAnswered);
                        $timeMinus_5second=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -5 seconds"));
                        if($last_data->date_time<$timeMinus_5second && $notAnsweredCount>2){
                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('thanks','0','0');
                        }
                    }
                    }else{
						//echo '$count1b='.$count1b; echo '$count2b='.$count2b;  echo '$count3b='.$count3b; echo '$count4b='.$count4b; echo '$count5b='.$count5b; echo '$count6b='.$count6b;die;
                        switch($subparent){

								case '1c':
                                    //first question to ask about name.
                                    if($common_option=='A'){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1adv',1,1);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }else{                                    
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1b',1,2);
                                    }
                                    break;
                                case '1adv':
                                    //echo $advisory_option;die;
                                    //first question to ask about name.
                                    if($common_option=='A'){
                                        if($advisory_option=='VC'){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('3adv',1,1);
                                        }else{
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('2adv',1,1);
                                        //$data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                        }
                                        
                                        }
                                    break;
                                case '1b':
                                    if($count1b==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count1b+1,2);
                                    }elseif($count1b==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1b',3,2);
                                    }elseif($count1b==3){
                                        //$data['question']=$this->chat_modeln->getquestionBytypeadmin('2b',1,2);
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('2b',2,2);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '2b':
                                    if($count2b==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('3b',1,2);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }
                                    break;
                                case '3b':
                                    if($count3b==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count3b+1,2);
                                    }elseif($count3b==2){
										if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count3b+1,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
//print_r($data['option']);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
										
                                    }
                                    break;
                                case '4b':
                                    if($count4b==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4b,2);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count4b==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4b,2);
                                    }elseif($count4b==3){
                                        if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4b,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
										
											if(!empty($availabledoc)){
												$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
												$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }elseif($count4b==4){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count4b,2);
                                    }
                                    break;
                                case '5b':
                                    if($count5b==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5b,2);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count5b==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5b,2);
                                    }elseif($count5b==3){
										if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5b,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }elseif($count5b==4){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count5b,2);
                                    }
                                    break;
                                case '6b':
                                    if($count6b==1){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6b,2);
                                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                                    }elseif($count6b==2){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6b,2);
                                    }elseif($count6b==3){
										if($prn!=''){
										$data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6b,2);
										$availabledoc=$this->get_doctor_available_slots($prn,$specialty_code,$hospital_location,$datetime_question);
											if(!empty($availabledoc)){
											$data['option']=json_decode($availabledoc);
											}else{ //if no doctor is available on that date
											$data['question']=$this->chat_modeln->getquestionBytypeadmin('nodoctor',0,0);
											}
										}else{
                                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('nprn',1,1);
                                        }
                                    }elseif($count6b==4){
                                        $data['question']=$this->chat_modeln->getquestionBytypeadmin($subparent,$count6b,2);
                                    }
                                    break;
                                default :
                                    break;
                        }
                        $msg=end($arrdata);
                        $countsubparent=$this->chat_modeln->countPredefinedQuestion($username,$is_old);
                        //if($msg->date<date('Y-m-d') && count($arrdata)>=14){
                        $timeMinus_10min=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -2 minutes"));
                        //echo $msg->date.' '.$msg->time;die;
                        if($msg->date_time<$timeMinus_10min && $countsubparent>=6){
                        //$data['question']=$this->chat_modeln->default_questionadmin();
                        if(date('H:i:s')>='00:00:00' && date('H:i:s')<'12:00:00'){//morning
                            $subparentn='helpm';
                            $level=1;
                            $parent=0;
                            $parent_id=37;
                        }
                        if(date('H:i:s')>='12:00:00' && date('H:i:s')<'17:00:00'){//afternoon
                            $subparentn='helpa';
                            $level=2;
                            $parent=0;
                            $parent_id=38;
                        }
                        if(date('H:i:s')>='17:00:00' && date('H:i:s')<'24:00:00'){//evening
                            $subparentn='helpe';
                            $level=3;
                            $parent=0;
                            $parent_id=39;
                        }
                        $data['question']=$this->chat_modeln->default_questionadmin2($subparentn,$level,$parent);
                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($parent_id,1);
                    }elseif($dataNotAnswered=$this->chat_modeln->notAnsweredChatByAdmin($username)){
                        $last_data=array();
                         $notAnsweredCount=@count($dataNotAnswered);
                        $last_data=end($dataNotAnswered);
                        $timeMinus_5second=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -5 seconds"));
                        if($last_data->date_time<$timeMinus_5second && $notAnsweredCount>2){
                            $data['question']=$this->chat_modeln->getquestionBytypeadmin('thanks','0','0');
                        }
                    }
                    
                    
                    } 
                    }elseif($is_old=='Yes'){ 
                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1c',1,1);
                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                        //$data['question']=$this->chat_modeln->getquestionBytypeadmin('1b',1,2);
                    }elseif($is_old=='No'){
                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1c',1,1);
                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                        
                        //$data['question']=$this->chat_modeln->getquestionBytypeadmin('1a',1,1);
                    }
                }else{
                    if($oldMsgCount>10 && $lastChatTime<= $compareTime){
                        $data['question']=$this->chat_modeln->getquestionBytypeadmin('1c',1,1);
                        $data['option']=$this->chat_modeln->getOptionBytypeadmin($data['question']->ID,1);
                    }else{
                        $data['question']=$this->chat_modeln->get_questionadmin();
                        $data['option']=$this->chat_modeln->getOptionYesNo('1');
                    }
                }   
                            
                            
                            
                            
                            
                            
                $response=$data;
            if($response){
                    $json= array("status" => 1, "message" => 'Ok', "data"=>$response);
            }else{
                    $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
            }
        
            }else{
                $json = array("status" => 0, "message" => "This username has been not registered.");	
            }
            
            }else{
                $json= array("status" => 0, "message" => "Mandatory fields have been empty.");
            }
            }else{
                $json= array("status" => 0, "message" => "Token has been not matched.");
            }
        }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
        }
		
		$this->response($json, REST_Controller::HTTP_OK);
        }
        
        //save the option and question 
        public function chatBotOption_post(){
            //print_r($_POST);
            if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// POST data
			$permission=false;
			$response=array();
			$token= isset($_POST['token']) ?($_POST['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
								$date_time=date('Y-m-d H:i:s');
								$specialty_code='';
								$hospital_code='';
								$common_option='';
								$advisory_option='';
								$username=isset($_POST['username']) ?($_POST['username']) : "";
								$query=isset($_POST['query']) ?($_POST['query']) : "";
//print_r($query);
								$specialty_code='';
								$hospital_code='';
								$messageall=explode('^',$query);
//print_r($messageall);
								$message=$messageall[0];
//echo $message;die;
								$code=(isset($messageall[1]))?$messageall[1]:'';
								if(!empty($code)){
									if(in_array($code,array('HP','HPHS','HPHE'))){//hospital_location_code
											$hospital_code=$code;
									}
									if(in_array($code,array('02','07','01','09'))){ //Specialty_code
											$specialty_code=$code;
									}
									if(in_array($code,array('SAA','CA','A'))){ //common_option
											$common_option=$code;
									}
									if(in_array($code,array('COB','AHCP','VC'))){ //common_option
											$advisory_option=$code;
									}
								}

                        if($username!='' && $message!=''){
                            $is_existed=$this->patient_model->checkExist($username);	
                            if($is_existed==true){

								

                                $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
                                $question=$this->input->post('question');
                                //$message=$query;
                                $date=date('Y-m-d');
                                $time=date('H:i:s A');
                                $data=$this->chat_modeln->UserChats($username);                          
                                                            
                                                            
                                    if(!empty($data)){
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
                                    $data=  array(
                                            "username"=>$username,
											"subparent"=>$subparent,
											"message"=>$question,
											"hospital_location_code"=>$hospital_code,
											"specialty_code"=>$specialty_code,
											"common_option"=>$common_option,
											"advisory_option"=>$advisory_option,
											"date"=>$date,
											"time"=>$time,
											"date_time"=>$date_time,
                                            "is_seen"=>0,
                                            "is_support"=>1
                                            );
                                    $this->chat_modeln->SaveUserChats($data);
                                    if($subparent=='helpm' || $subparent=='helpa' || $subparent=='helpe'){
                                        $date_time=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -1 days"));
                                    }
                                    $data=  array(
                                            "username"=>$username,
                                            "subparent"=>$subparent,
                                            "message"=>$message,
                                            "date"=>$date,
                                            "time"=>$time,
											"date_time"=>$date_time,
                                            "is_seen"=>0,
                                            "is_support"=>0
                                            );
                                    $this->chat_modeln->SaveUserChats($data);
                                    if($subparent=='helpm' || $subparent=='helpa' || $subparent=='helpe'){
									$date_time=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -1 days"));
                                    $message='Okay, you can...';
                                    $data=  array(
                                            "username"=>$username,
                                            "subparent"=>$subparent,
                                            "message"=>$message,
                                            "date"=>$date,
                                            "time"=>$time,
											"date_time"=>$date_time,
                                            "is_seen"=>0,
                                            "is_support"=>1
                                            );
                                    //$this->chat_modeln->SaveUserChats($data);
                                    }
                                }else{
                                    $data=   array(
                                                "username"=>$username,
                                                "subparent"=>$subparent,
                                                "message"=>$question,
                                                "date"=>$date,
                                                "time"=>$time,
												"date_time"=>$date_time,
                                                "is_seen"=>0,
                                                "is_support"=>1
                                                );
                                    $this->chat_modeln->SaveUserChats($data);
                                    $data=   array(
                                                "username"=>$username,
                                                "subparent"=>$subparent,
                                                "message"=>$message,
                                                "date"=>$date,
                                                "time"=>$time,
												"date_time"=>$date_time,
                                                "is_seen"=>0,
                                                "is_support"=>0
                                                );
                                    $this->chat_modeln->SaveUserChats($data);
                                }
                                $response=$this->chat_modeln->updateChattimePatient($username);
                                                            
                                                            
                                                            
                                                            
                                                            
                                    if($response){
                                            $json= array("status" => 1, "message" => 'Ok');
                                    }else{
                                            $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                                    }
                            }else{
                                    $json = array("status" => 0, "message" => "This username has been not registered.");	
                            }	
                            }else{
                                    $json= array("status" => 0, "message" => "Mandatory fields have been empty.");
                            }
			}else{
				$json= array("status" => 0, "message" => "Token has been not matched.");
			}
		}else{
			$json= array("status" => 0, "message" => "Request method not accepted.");
		}
		
		$this->response($json, REST_Controller::HTTP_OK);
            
            
            
            
        }
		
		public function get_doctor_available_slots($patient_prn,$doctor_specialty,$hospital_location_code,$visitdate)
		{ //PRN,deparnment,hospital_location_code,date
			//echo $patient_prn.'<br>';
			//echo $doctor_specialty.'<br>';
			//echo $hospital_location_code.'<br>';
			//echo $visitdate;die;
		
				//$hospital_location_code=isset($_GET['hospital_location_code']) ?($_GET['hospital_location_code']) : "";
				$doctor_mcr=isset($_GET['doctor_mcr']) ?($_GET['doctor_mcr']) : "";
				
				//$doctor_specialty= isset($_GET['doctor_specialty_code']) ?($_GET['doctor_specialty_code']) : "";
				//$doctor_specialty='01';
				//$patient_prn= isset($_GET['patient_prn']) ?($_GET['patient_prn']) : "";
				//$patient_prn='00071057';
				//$start_date=isset($_GET['date']) ?date('d-M-Y',strtotime($_GET['date'])):"";
				//$start_date='2020-04-09';
				//$dt=date('Y-m-d');
				//$start_date=date('d-M-Y',strtotime($dt."+ 1 days"));//die;
				$start_date=date('d-M-Y',strtotime($visitdate));//die;
				// we need minus 5 minutes because API return appointment time pass time + 5 minutes
				$start_time=isset($_GET['time'])?date('H:i',strtotime('-5 minutes',strtotime($_GET['time']))):"";
				$case_type=(isset($_GET['case_type']) && $_GET['case_type']=='2')?"FU":"NC";
				$response=$return=$doctorNames=$doctor_list=$slot_list=[];
				
				if($doctor_specialty!='' && $patient_prn!='' && $start_date!=''){
					$ID='c4ca4238a0b923820dcc509a6f75849b';  
					$this->load->model("api_token_model");	
					$details=$this->api_token_model->loadDataById($ID);
					
					if($details && isset($details->token_number) && $details->token_number!='' && isset($details->company_code) && $details->company_code!=''){
						try {
							
							$wsdl = base_url("WSDL/WebMethodGetNextAvailableSlots.xml");
							$wsdlLocation=$details->url."hpih_uat/web_services/APPOINTMENT/GetNextAvailableSlots.cfc";
							$client=StartSoapClient($wsdl,$wsdlLocation);
							//echo "<pre>";print_r($client);
							
							$params =array(
									'token_number'=>$details->token_number,
									'company_code'=>$details->company_code,
									'prn'=>$patient_prn, 
									'specialty_code'=>$doctor_specialty,
									'mcr'=>$doctor_mcr,
									'start_date'=> $start_date, 
									'start_time'=>$start_time,
									'case_type'=> $case_type,
								);
							$result = $client->getNextAvailableSlots($params);
							//echo "<pre>";print_r($result);	die();			
							
							if($result && isset($result->return)){
								$data=$result->return;
								// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
								$search='<?xml version="1.0" encoding="UTF-8"?>';
								if(strpos($data, $search) !== false){
									$string = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
									
									try{	
										$xml =SimpleXML_Load_String($string, 'SimpleXMLElement', LIBXML_NOCDATA);
										if($xml){
											$array = json_decode(json_encode((array)$xml), TRUE);
											//print_r($array);die;
											$response=$array['Slot'];
										}else{
											//echo "<pre>";print_r($xml);die();
											$json= array("status" => 0, "message" => 'Error', "data"=>$xml);
										}

									}catch(Exception $e) {
										//echo '<br/> Error: ' .$e->getMessage();
										//die();
										$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
									  }
								}else{ 
									// for check return data have <?xml version="1.0" encoding="UTF-8"> this line. If data have this line then remove
									$search='<?xml version="1.0" encoding="UTF-8">';
									if(strpos($data, $search) !== false){
										$data=str_ireplace([$search], '', $data);
										try{
											$xml =  new SimpleXMLElement($data);
											//$xml   = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
											
											$array = json_decode(json_encode((array)$xml), TRUE);
											
											if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00005'){
												$json = array("status" => 0, "message" => "Please try again later.");
												redirect(base_url('api_soap/generate_token'));
												die();
											}else if(isset($array['Error']['ErrorCode']) && $array['Error']['ErrorCode']=='WS-00018'){
												$e="GIVEN DATE IS PAST DATE.";
												$json=["status" => 0, "message" => 'Error', "data"=>$e];
											}else{
												$json=["status" => 0, "message" => 'Error', "data"=>$array];
											}
										}catch(Exception $e) {
											//echo '<br/> Error: ' .$e->getMessage();
											//die();
											$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
										}	
									}	
								}
								//echo "<pre>";
								//print_r($response);die;
								if($response){
									$json= ["status" =>0, "message" => 'Response not received', "data"=>""];
									foreach($response as $key=>$value){
										//echo $value['DoctorName'];
										//echo "<pre>";print_r($value);
										if($value['Date']==$start_date ){
											$roomCode=(isset($value['Room']))?$value['Room']:'';
											$rooms=($hospital_location_code!='')?($this->doctor_model->room_location($hospital_location_code,$roomCode)):['not-set'];
											
											if(!empty($rooms)){
												// get doctor list
												$doctor_name=(isset($value['DoctorName']))?$value['DoctorName']:'';
												($doctor_name!='')?(array_push($doctorNames,$doctor_name)):'';
												// end
												
												// get slots details
												$value['hospital_location_code']=$hospital_location_code;
												$value['Date']=date('Y-m-d',strtotime($value['Date']));
												$value['StartTime']=date('h:i A',strtotime($value['StartTime']));
												$value['EndTime']=date('h:i A',strtotime($value['EndTime']));
												
												$doctorData=$this->doctor_model->get_doctor_data($value['DoctorName']);
												//print_r($doctorData);
												if($doctorData){
													$doctor_list[]=$doctorData;
													$slot_list[]=$value;
												}
												//end
											}	
										}
									}
									//echo "<pre>";
									//print_r($doctor_list);die;
									if($doctor_list && $slot_list){
										
										$return=['doctor_list'=>$doctor_list,'slot_list'=>$slot_list];
										$json= ["status" => 1, "message" => 'Ok', "data"=>$return];	
									}else{
										// may be possible doctor is deactive
										$json= ["status" => 0, "message" => 'Please choose next date.', "data"=>""];	
									}
								}
							}
						}catch(Exception $e) {
							//echo '<br/> Error: ' .$e->getMessage();
							//die();
							$json= array("status" => 0, "message" => 'Error', "data"=>$e->getMessage());
						}
					}
				}
//print_r($doctor_list);die;

				if(!empty($doctor_list)){

					$i=0;

					$doctors=array();
					foreach($doctor_list as $row){
						$doctors[$i]['answer']=$row->name;
						$doctors[$i]['answer_vi']=$row->name;
						$doctors[$i]['doctor_mcr']=$row->doctor_mcr;
						$doctors[$i]['speciality_name']=$row->speciality_name;
						$doctors[$i]['doctor_specialty']=$doctor_specialty;
						$doctors[$i]['hospital_location_code']=$hospital_location_code;
						$doctors[$i]['visitdate']=$visitdate;
						$i++;
					}
					
					return json_encode($doctors);
				}else{
					//echo '1dd';
					return false;
				}
				//print_r($doctor_list);die;
				//return $doctor_list;die;
				// echo "<pre>";
			// print_r($json);die;
		
		
		//$this->response($json, REST_Controller::HTTP_OK);
	}
		


}
