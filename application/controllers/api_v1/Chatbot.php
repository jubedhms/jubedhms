<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Chatbot extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/patient_model');
		$this->load->model('chat_model');
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
				$username=isset($_POST['username']) ?($_POST['username']) : "";
				$query=isset($_POST['query']) ?($_POST['query']) : "";
				if($username!='' && $query!=''){
					$is_existed=$this->patient_model->checkExist($username);	
						if($is_existed==true){
                                                    $subparent=($this->input->post('subparent'))?$this->input->post('subparent'):'';
                                                    $question=($this->input->post('question'))?$this->input->post('question'):'';
							$dest= 'data/chat_history/';
							$file_name=$username;
							$target_file=$dest.$file_name.'.json';
							$message=$query;
							$date=date('Y-m-d');
							$time=date('H:i:s A');
							
							////
                                                        
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
                                                        
                                                        
                                                        
                                                        ////
							$response=file_put_contents($target_file, $jsonData);
                                                        $this->db->update('patient',array("last_chat_patient"=>date('Y-m-d H:i:s')),array('username'=>$username));
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
	public function revert_from_user_get()
	{ 
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
							$dest= 'data/chat_history/';
							$file_name=$username;
							$target_file=$dest.$file_name.'.json';
							if(file_exists($target_file)){
								//Load the file
								$data = file_get_contents($target_file);
								$jsonData = ($data!='')?array_reverse(json_decode($data)):array();
								if($jsonData){
									foreach($jsonData as $key=>$json){
										//if($json->date)
										if(isset($limit) && $limit>0 && isset($start) && $start>=0){
											if($key>=$start && count($response)<$limit){
												$response[]=$json;	
											}
										}else if(isset($from_date) && $from_date!='' && isset($to_date) && $to_date!=''){
											if($json->date>=$from_date && $json->date<=$to_date){
												$response[]=$json;	
											}
										}else if(isset($limit) && $limit>0 && isset($start) && $start>=0 && isset($from_date) && $from_date!='' && isset($to_date) && $to_date!=''){
											if($key>=$start && count($response)<$limit){
												if($json->date>=$from_date && $json->date<=$to_date){
													$response[]=$json;	
												}
											}
										}else{
											$response[]=$json;		
										}
									}
								}
							}	
							
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
                            $is_old='';
                            $file_name=$username;
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
                            $datamsg[]=[
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
                            $datamsg[]=[
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
                            $datamsg[]=[
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

                                $jsonData = json_encode($datamsg);
                                $response=file_put_contents($target_file, $jsonData);
                        $i++;
                        if($row->subparent){
                            $subparent=$row->subparent;
                        }
                    }
                    $jsonData=json_decode($fdata);
                    
                    if($jsonData){
                        $jsonData=array_reverse($jsonData);
                            foreach($jsonData as $key=>$json){
                                    if(isset($limit) && $limit>0 && isset($start) && $start>=0){
                                            if($key>=$start && count($response2)<$limit){
                                                    $response2[]=$json;	
                                            }
                                    }else if(isset($from_date) && $from_date!='' && isset($to_date) && $to_date!=''){
                                            if($json->date>=$from_date && $json->date<=$to_date){
                                                    $response2[]=$json;	
                                            }
                                    }else if(isset($limit) && $limit>0 && isset($start) && $start>=0 && isset($from_date) && $from_date!='' && isset($to_date) && $to_date!=''){
                                            if($key>=$start && count($response2)<$limit){
                                                    if($json->date>=$from_date && $json->date<=$to_date){
                                                            $response2[]=$json;	
                                                    }
                                            }
                                    }else{
                                            $response2[]=$json;	
                                    }
                            }
                    }
                    
                    
                    $data['msg']=$response2;
                    
                    
                    
                    
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
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count1a+1,1);
                                    }elseif($count1a==2){
                                        $data['question']=$this->chat_model->getquestionBytype('2a',1,1);
                                        //$data['question'][]=$this->chat_model->getquestionBytype('2a',2,1);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }
                                    break;
                                case '2a':
                                    if($count2a==1){
                                        $data['question']=$this->chat_model->getquestionBytype('3a',1,1);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }
                                    break;
                                case '3a':
                                    if($count3a==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count3a+1,1);
                                        $data['option']=array();
                                        
                                    }elseif($count3a==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count3a+1,1);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                case '4a':
                                    if($count4a==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4a,1);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }elseif($count4a==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4a,1);
                                        $data['option']=array();
                                        
                                    }elseif($count4a==3){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4a,1);
                                        $data['option']=array();
                                        
                                    }elseif($count4a==4){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4a,1);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                case '5a':
                                    if($count5a==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5a,1);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }elseif($count5a==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5a,1);
                                        $data['option']=array();
                                        
                                    }elseif($count5a==3){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5a,1);
                                        $data['option']=array();
                                        
                                    }elseif($count5a==4){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5a,1);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                case '6a':
                                    if($count6a==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6a,1);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }elseif($count6a==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6a,1);
                                        $data['option']=array();
                                        
                                    }elseif($count6a==3){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6a,1);
                                        $data['option']=array();
                                        
                                    }elseif($count6a==4){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6a,1);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                default :
                                $data['question']=array();
                                $data['option']=array();
                                    break;
                    }
					$msg=end($arrdata);
                    if($msg->date<date('Y-m-d') && count($arrdata)>=14){
                        $data['question']=$this->chat_model->default_question();
                    }
                    }else{
                        switch($subparent){
                                case '1b':
                                    if($count1b==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count1b+1,2);
                                        $data['option']=array();
                                        
                                    }elseif($count1b==2){
                                        $data['question']=$this->chat_model->getquestionBytype('2b',1,2);
                                        //$data['question']=$this->chat_model->getquestionBytype('2b',2,2);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }
                                    break;
                                case '2b':
                                    if($count2b==1){
                                        $data['question']=$this->chat_model->getquestionBytype('3b',1,2);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }
                                    break;
                                case '3b':
                                    if($count3b==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count3b+1,2);
                                        $data['option']=array();
                                        
                                    }elseif($count3b==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count3b+1,2);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                case '4b':
                                    if($count4b==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4b,2);
                                        //print_r($data['question']);die;
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }elseif($count4b==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4b,2);
                                        $data['option']=array();
                                        
                                    }elseif($count4b==3){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4b,2);
                                        $data['option']=array();
                                        
                                    }elseif($count4b==4){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count4b,2);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                case '5b':
                                    if($count5b==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5b,2);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }elseif($count5b==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5b,2);
                                        $data['option']=array();
                                        
                                    }elseif($count5b==3){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5b,2);
                                        $data['option']=array();
                                        
                                    }elseif($count5b==4){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count5b,2);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                case '6b':
                                    if($count6b==1){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6b,2);
                                        $data['option']=$this->chat_model->getOptionBytype($data['question'][0]['ID'],1);
                                    }elseif($count6b==2){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6b,2);
                                        $data['option']=array();
                                        
                                    }elseif($count6b==3){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6b,2);
                                        $data['option']=array();
                                        
                                    }elseif($count6b==4){
                                        $data['question']=$this->chat_model->getquestionBytype($subparent,$count6b,2);
                                        $data['option']=array();
                                        
                                    }
                                    break;
                                default :
                                $data['question']=array();
                                $data['option']=array();
                                    break;
                        }
						$msg=end($arrdata);
						if($msg->date<date('Y-m-d') && count($arrdata)>=14){
							$data['question']=$this->chat_model->default_question();
						}
                    }
                    }elseif($is_old=='Yes'){
                        $data['question']=$this->chat_model->getquestionBytype('1b',1,2);
                        $data['option']=array();
                        
                    }elseif($is_old=='No'){
                        $data['question']=$this->chat_model->getquestionBytype('1a',1,1);
                        $data['option']=array();
                        
                    }
                    
                }else{
                    $data['msg']=array();
                    $data['question']=$this->chat_model->get_question();
                    $data['option']=$this->chat_model->getOptionYesNo('3'); //subparent
                    
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
            //print_r($_POST);die;
            if($_SERVER['REQUEST_METHOD'] == "POST"){
        	// POST data
			$permission=false;
			$response=array();
			$token= isset($_POST['token']) ?($_POST['token']) : "";
			$permission=$this->matchAppToken($token);
			if($permission==true){
				$username=isset($_POST['username']) ?($_POST['username']) : "";
				$query=isset($_POST['query']) ?($_POST['query']) : "";
				if($username!='' && $query!=''){
					$is_existed=$this->patient_model->checkExist($username);	
						if($is_existed==true){
							$dest= 'data/chat_history/';
							$file_name=$username;
							$target_file=$dest.$file_name.'.json';
							$message=$query;
							$date=date('Y-m-d');
							$time=date('H:i:s A');
							///
                                                        
                                                            //$username=$this->input->post('username');//patient name
                                                            //$message=$this->input->post('message');
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
                                                                            "ID"=>0,
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
                                                            //print_r($jsonData);die;
                                                            //file_put_contents($target_file, $jsonData);
                                                        
                                                        ////
							

							$response=file_put_contents($target_file, $jsonData);
							 $this->db->update('patient',array("last_chat_patient"=>date('Y-m-d H:i:s')),array('username'=>$username));
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


}
