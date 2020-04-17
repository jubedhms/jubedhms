<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Vaccination extends  REST_Controller {
	/**
     * Get All Data from this method.
     *
     * @return Response
	*/
	
    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('api_v1/vaccine_model');
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

        
        public function get_vaccine_list_get(){
            $permission=false;
            $response=array();
            $token= isset($_GET['token']) ?($_GET['token']) : "";
			$language= isset($_GET['language']) ?($_GET['language']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true){
            $response=$this->vaccine_model->getVaccine($language);
            $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        public function get_dose_list_get(){
            $permission=false;
            $response=array();
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            $vaccine_id= isset($_GET['vaccine_id']) ?($_GET['vaccine_id']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true){
            $response=$this->vaccine_model->getDoseByVaccineId($vaccine_id);
            
            if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        
        public function vaccine_search_get(){
            $permission=false;
            $response=array();
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            $prn= isset($_GET['prn']) ?($_GET['prn']) : "";
            $parent_prn= isset($_GET['parent_prn']) ?($_GET['parent_prn']) : "";
            $limit= isset($_GET['limit']) ?($_GET['limit']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true){
                $patientdosedoneId='';
                $json=array();
                $data=array();
                if($prn!='' && $parent_prn!=''){
                    $patientdob=$this->vaccine_model->getsub_patientDOB($prn,$parent_prn);
                    $months=$this->getmonth($patientdob);
                    $patientdosedoneId=$this->vaccine_model->getcompletedSubPatientVaccine($prn,$parent_prn);
                }elseif($prn!=''){
                    $patientdob=$this->vaccine_model->getpatientDOB($prn);
                    $months=$this->getmonth($patientdob);
                    $patientdosedoneId=$this->vaccine_model->getcompletedPatientVaccine($prn);
                }
                if($patientdosedoneId){
                    $patientVacciveData=$this->vaccine_model->getRemaningDose($months,$limit);
                }else{
                    $patientVacciveData=$this->vaccine_model->getRemaningDose($months,$limit);
                }
                if(!empty($patientVacciveData)){
                    $i=0;
                    foreach($patientVacciveData as $row){
                        $data[$i]['id']=$row->ID;
                        $data[$i]['prn']=$prn;
                        $data[$i]['vaccine_name']=$row->vaccine_name;
                        $data[$i]['from_month']=$row->from_month;
                        $data[$i]['to_month']=$row->to_month;
                        $data[$i]['dose_id']=$row->dose_id;
                        $data[$i]['dose_name']=$row->dose_name;
                        if(in_array($row->dose_id,explode(',',$patientdosedoneId))){
                            $data[$i]['is_completed']=1;
                        }else{
                            $data[$i]['is_completed']=0;
                        }
                        $i++;
                    }
                    
                }
                $response=$data;
                if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
            
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        public function vaccine_searchPRN_get(){
            $permission=false;
            $response=array();
            $parentdetails=array();
            $subparentdetails=array();
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            $prn= isset($_GET['prn']) ?($_GET['prn']) : "";
            $is_parent= isset($_GET['is_parent']) ?($_GET['is_parent']) : "";
            $limit= isset($_GET['limit']) ?($_GET['limit']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true){
                $patientdosedoneId='';
                $json=array();
                if($prn!='' && $is_parent!=''){
                    $patientdata=$this->vaccine_model->getpatient($prn);
                    if(!empty($patientdata)){
                        $response['parentdata']=$patientdata;
                    
                    $patientdosedoneId=$this->vaccine_model->getcompletedPatientVaccine($prn);
                    $months=$this->getmonth($patientdata->dob);
                    $parentresponse=$this->vaccine_model->getRemaningDosePRN($patientdosedoneId,$months,$limit);
                    
                    if($parentresponse){
                        $response['parent_vaccine']=$parentresponse;
                    }else{
                        $response['parent_vaccine']='';
                    }
                    if(!empty($parentresponse)){
                    $i=0;
                    foreach($parentresponse as $row){
                        $parent[$i]['id']=$row->ID;
                        $parent[$i]['prn']=$prn;
                        $parent[$i]['vaccine_name']=$row->vaccine_name;
                        $parent[$i]['from_month']=$row->from_month;
                        $parent[$i]['to_month']=$row->to_month;
                        $parent[$i]['dose_id']=$row->dose_id;
                        $parent[$i]['dose_name']=$row->dose_name;
                        if(in_array($row->dose_id,explode(',',$patientdosedoneId))){
                            $parent[$i]['is_completed']=1;
                        }else{
                            $parent[$i]['is_completed']=0;
                        }
                        $i++;
                    }
                    $response['parent_vaccine']=$parent;
                }else{
                    $response['parent_vaccine']='';
                }
                    $subpatientdob=$this->vaccine_model->getsubpatient($patientdata->ID);
                    if(!empty($subpatientdob)){
                       foreach($subpatientdob as $row){
                            
                            $subpatientdosedoneId=$this->vaccine_model->getcompletedPatientVaccine($row->prn);
                            
                            $subpmonths=$this->getmonth($row->dob);
                            $subparentresponse=$this->vaccine_model->getRemaningDosePRN($subpatientdosedoneId,$subpmonths,$limit);
                            
                            if($subparentresponse){
                                $j=0;
                                foreach($subparentresponse as $row2){
                                $subparentdetails[$j]['prn']=$row->prn;
                                $subparentdetails[$j]['first_name']=$row->first_name;
                                $subparentdetails[$j]['middle_name']=$row->middle_name;
                                $subparentdetails[$j]['last_name']=$row->last_name;
                                $subparentdetails[$j]['gender']=$row->gender;
                                $subparentdetails[$j]['image']=$row->image;
                                $subparentdetails[$j]['vaccine_name']=$row2->vaccine_name;
                                $subparentdetails[$j]['from_month']=$row2->from_month;
                                $subparentdetails[$j]['to_month']=$row2->to_month;
                                $subparentdetails[$j]['dose_id']=$row2->dose_id;
                                $subparentdetails[$j]['dose_name']=$row2->dose_name;
                                if(in_array($row2->dose_id,explode(',',$subpatientdosedoneId))){
                                    $subparentdetails[$j]['is_completed']=1;
                                }else{
                                    $subparentdetails[$j]['is_completed']=0;
                                }
                                $j++;
                                 }
                                
                                //$subparentdetails[$i]['subparent_vaccine']=$subparentresponse;
                            }else{
//                                $subparentdetails[$i]['prn']=$row->prn;
//                                $subparentdetails[$i]['first_name']=$row->first_name;
//                                $subparentdetails[$i]['middle_name']=$row->middle_name;
//                                $subparentdetails[$i]['last_name']=$row->last_name;
//                                $subparentdetails[$i]['gender']=$row->gender;
//                                $subparentdetails[$i]['image']=$row->image;
                            }
                       } 
                       //print_r($subparentdetails);die;
                       $response['subparentdetails']=$subparentdetails;
                    }
                    }
                    
                }elseif($prn!=''){
                      $patientdata=$this->vaccine_model->getpatient($prn);
                    if(!empty($patientdata)){
                        $response['parentdata']=$patientdata;
                    }
                    $patientdosedoneId=$this->vaccine_model->getcompletedPatientVaccine($prn);
                    $months=$this->getmonth($patientdata->dob);
                    $parentresponse=$this->vaccine_model->getRemaningDosePRN($patientdosedoneId,$months,$limit);
                    
                    if($parentresponse){
                        $response['parent_vaccine']=$parentresponse;
                    }else{
                        $response['parent_vaccine']='';
                    }
            }
                if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
            
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        private function getmonth($dob=''){
            $permission=false;
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true){
                $start = date_create($dob);
                $current=date_create(date('Y-m-d'));
                $diff=date_diff($current,$start);
                return ($diff->m + ($diff->y*12));
        }
        }
        }
        
        public function duedays_post($dob=''){
            $permission=false;
            $token= isset($_POST['token']) ?($_POST['token']) : "";
            $date= isset($_POST['date']) ?($_POST['date']) : "";
            $method= isset($_POST['method']) ?($_POST['method']) : "";
            $mperiod= isset($_POST['mperiod']) ?($_POST['mperiod']) : "";
            $username= isset($_POST['username']) ?($_POST['username']) : "";
            $nomaldays=280;
            $conceptiondays=266;
            $nomalMperiod=28;
            $totaldays=280;
            if($_SERVER['REQUEST_METHOD'] == "POST"){
            $permission=$this->matchAppToken($token);
            if($permission==true && $date && $method && $mperiod && $username){
                switch($method){
                    case 1: //First day of the last period
                        if($mperiod==$nomalMperiod){
                            $daycount=0;
                            $totaldays=$nomaldays+$daycount;
                        }elseif($mperiod>$nomalMperiod){
                            $daycount=$mperiod-$nomalMperiod;
                            $totaldays=$nomaldays+$daycount;
                        }elseif($mperiod<$nomalMperiod){
                            $daycount=$nomalMperiod-$mperiod;
                            $totaldays=$nomaldays-$daycount;
                        }
                        //echo $totaldays."<br>";
                        $duedate= date('Y-m-d',strtotime($date .$totaldays.' days'));
                        $data=["duedate"=>$duedate,"totaldays"=>$totaldays];
                        break;
                    case 2: //Conception Date
                        $duedate= date('Y-m-d',strtotime($date .$conceptiondays.' days'));
                        $data=["duedate"=>$duedate];
                        break;
                    case 3: //IVF Transfer Date
                        $duedate= date('Y-m-d',strtotime($date .$conceptiondays.' days'));
                        $data=["duedate"=>$duedate];
                        break;
                    default :
                        break;
                    
                }
                $data['date']=$date;
                $dataarray=array("username"=>$username,"method"=>$method,"mperiod"=>$mperiod,"last_mperiad_date"=>$date,"due_date"=>$duedate,"due_days"=>$totaldays,"maker_date"=>date('Y-m-d'),"updater_date"=>'',"is_deleted"=>0,"status"=>1);
                $this->vaccine_model->save_duedate($dataarray,$username);
                $response=$data;
                if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }

        public function user_duedays_get(){
            $permission=false;
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            $username= isset($_GET['username']) ?($_GET['username']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true && $username){
                $response=$this->vaccine_model->getUserDueDatedetails($username);
                if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }

        public function user_saveStartkick_post($dob=''){
            $permission=false;
            $data=array();
            $token= isset($_POST['token']) ?($_POST['token']) : "";
            $prn= isset($_POST['prn']) ?($_POST['prn']) : "";
            $week= isset($_POST['week']) ?($_POST['week']) : "";
			$kick_count= isset($_POST['kick_count']) ?($_POST['kick_count']) : "0";
            if($_SERVER['REQUEST_METHOD'] == "POST"){
            $permission=$this->matchAppToken($token);
            if($permission==true && $prn && $week){
                if($this->vaccine_model->savekick($prn,$week,$kick_count)){
                   $data=$this->vaccine_model->getkickData($prn);
                $response=$data;
                } else {
                    $response=false;
                }
                if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        public function user_saveStopkick_post($dob=''){
            $permission=false;
            $data=array();
            $token= isset($_POST['token']) ?($_POST['token']) : "";
            $prn= isset($_POST['prn']) ?($_POST['prn']) : "";
            $kick_count= isset($_POST['kick_count']) ?($_POST['kick_count']) : "0";
            if($_SERVER['REQUEST_METHOD'] == "POST"){
            $permission=$this->matchAppToken($token);
            if($permission==true && $prn){
                if($this->vaccine_model->Updatekick($prn,$kick_count)){
                   $data=$this->vaccine_model->getkickData($prn);
                $response=$data;
                } else {
                    $response=false;
                }
                if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
            }else{
                $json= array("status" => 0, "message" => "Request method not accepted.");
            }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        public function user_getkickData_get(){
            $permission=false;
            $response=array();
            $alldates=array();
            $allKickedDate=array();
            $dateWiseKickData=array();
            $hour=$minute=$second=$kissum=0;
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            $prn= isset($_GET['prn']) ?($_GET['prn']) : "";
            $week= isset($_GET['week']) ?($_GET['week']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
            $permission=$this->matchAppToken($token);
            if($permission==true && $prn && $week){
            $allKickedDate=$this->vaccine_model->allKickedDate($prn,$week);
            if($allKickedDate){
            $alldates=array_column($allKickedDate,'date');
                for($i=0;$i<count($alldates);$i++){
                    $response=array();
                    $hour=$minute=$second=0;
                    $totalduration='00:00:00';
                    $response=$this->vaccine_model->getkickDataBydatePRN($prn,$alldates[$i],$week);
                    for($j=0;$j<count($response);$j++){
                        $startDateTime=$response[$j]->date.''.$response[$j]->start_time;
                        $endDateTime=$response[$j]->date.''.$response[$j]->end_time;
                        $duration=$this->gettimeDifference($startDateTime,$endDateTime);
                        $hour=$hour+$duration->h;
                        $minute=$minute+$duration->i;
                        $second=$second+$duration->s;
						$kissum=$kissum+$response[$j]->kick_count;
                    }
                    $totalduration=$hour.':'.$minute.':'.$second;
                    $dateWiseKickData[$i]['ID']=$response[0]->ID;
                    $dateWiseKickData[$i]['date']=$response[0]->date;
                    $dateWiseKickData[$i]['prn']=$response[0]->prn;
                    $dateWiseKickData[$i]['week']=$response[0]->week;
                    //$dateWiseKickData[$i]['kickcount']=count($response);
                    $dateWiseKickData[$i]['kickcount']=$kissum;
                    $dateWiseKickData[$i]['duration']=$totalduration;
                }
            }
            $response=$dateWiseKickData;
            if($response){
                        $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                }else{
                        $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }
        
        private function gettimeDifference($start_time,$end_time){
            $permission=false;
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
                $permission=$this->matchAppToken($token);
                if($permission==true){
                    $start = date_create($start_time);
                    $end=date_create($end_time);
                    $diff=date_diff($end,$start);
                    return $diff;
                }
            }
        }
        
        public function user_Todaykickdata_get($dob=''){
            $permission=false;
            $data=array();
            $token= isset($_GET['token']) ?($_GET['token']) : "";
            $prn= isset($_GET['prn']) ?($_GET['prn']) : "";
            if($_SERVER['REQUEST_METHOD'] == "GET"){
                $permission=$this->matchAppToken($token);
                if($permission==true && $prn){
                    if($data=$this->vaccine_model->getkickData($prn)){
                    $response=$data;
                    } else {
                        $response=false;
                    }
                    if($response){
                            $json= array("status" => 1, "message" => 'Ok',"data"=>$response);
                    }else{
                            $json= array("status" => 0, "message" => 'Please try again later.', "data"=>array());
                    }
                }else{
                    $json= array("status" => 0, "message" => "Request method not accepted.");
                }
        }else{
            $json= array("status" => 0, "message" => "Request method not accepted.");
        }
        $this->response($json, REST_Controller::HTTP_OK);
        }


}
