<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat_modeln extends CI_Model {
     function __construct(){
        parent::__construct();
        //$this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="chatbot_questions";
    }
    
    function get_question(){
        $query=$this->db->select('ID,question,question_vi,question_type,sub_parent')->from($this->main_table)->where(array('ID'=>1,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
            $data=array($query->row_array());
           return $data;
        }else{
            return false;
        }
        
    }
	function get_questionadmin(){
        $query=$this->db->select('ID,question,question_vi,question_type,sub_parent')->from($this->main_table)->where(array('ID'=>1,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
            $data=$query->row();
           return $data;
        }else{
            return false;
        }
        
    }
    
    function getAllPatient(){
        $query=$this->db->select('P.*,PD.image')->from('patient as P')->join('patient_documents as PD','P.ID=PD.patient_id')
                ->where(array('P.is_deleted'=>0))->order_by('P.last_chat_patient','DESC')->get();
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
        
    }
    
    function updateChattime($username){
        $this->db->update('patient',array("last_chat_support"=>date('Y-m-d H:i:s')),array('username'=>$username));
        return true;
    }
    
    
    
    //Patient chat
    function getDataPatient(){
        $query=$this->db->select('*')->from('patient')->where(array('ID'=>6,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
           return $query->row();
        }else{
            return false;
        }
    }
    
    
    //function for chatbot machine learning
    function updateChattimePatient($username){ 
        $this->db->update('patient',array("last_chat_patient"=>date('Y-m-d H:i:s')),array('username'=>$username));
        return true;
    }
    
    function getquestionBytype($subparent,$level,$parent){
        $query=$this->db->select('*')->from('chat_questions')->where(array('parent'=>$parent,'sub_parent'=>$subparent,'is_deleted'=>0,'level'=>$level))->get();
        if($query->num_rows()>0){
           return array($query->row_array());
        }else{
            return false;
        }
    }
	
    function getquestionBytypeadmin($subparent,$level,$parent){
        $query=$this->db->select('*')->from($this->main_table)->where(array('parent'=>$parent,'sub_parent'=>$subparent,'is_deleted'=>0,'level'=>$level))->get();
        if($query->num_rows()>0){
           return $query->row();
        }else{
            return false;
        }
    }
    
    function getOptionBytype($parent_id,$parent){
        $query=$this->db->select('*')->from('chat_questions')->where(array('parent'=>$parent,'is_deleted'=>0))->where('find_in_set("'.$parent_id.'",parent_id) !=',0)->get();
        if($query->num_rows()>0){
           return $query->result_array();
        }else{
            return false;
        }
    }
	
    function getOptionBytypeadmin($parent_id){
        $dataoption=array();
        $query=$this->db->select('*')->from('chatbot_answers')->where(array('is_deleted'=>0))->where('find_in_set("'.$parent_id.'",parent_id) !=',0)->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){
            $data=$query->result();
            $i=0;$code='';
            foreach($data as $row){
                if(!empty($row->hospital_location_code)){
                    $code=$row->hospital_location_code;
                }
                if(!empty($row->specialty_code)){
                    $code=$row->specialty_code;
                }
				if(!empty($row->common_option)){
                    $code=$row->common_option;
                }
				if(!empty($row->advisory_option)){
                    $code=$row->advisory_option;
                }
                $dataoption[$i]['ID']=$row->ID;
                $dataoption[$i]['answer']=$row->answer;
                $dataoption[$i]['answer_vi']=$row->answer_vi;
                $dataoption[$i]['code']=$code;
                $dataoption[$i]['parent_id']=$row->parent_id;
                $dataoption[$i]['question_type']=$row->question_type;
				$dataoption[$i]['doctor_mcr']='';
				$dataoption[$i]['speciality_name']='';
				$dataoption[$i]['doctor_specialty']='';
				$doctors[$i]['visitdate']='';
				$dataoption[$i]['hospital_location_code']='';
                $i++;$code='';
            }
            $json=json_encode($dataoption);
            $result=json_decode($json);
            //echo "<pre>";
            //print_r($result);die;
           return $result;
        }else{
            return false;
        }
    }


    function getOptionYesNo($parent){
        $query=$this->db->select('*')->from('chatbot_answers')->where(array('parent_id'=>$parent,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
			$options=$query->result();
			$options[0]->code='';
			$options[1]->code='';
           return $options;
        }else{
            return false;
        }
    }
    
    function getOneAQuestion(){
        $query=$this->db->select('*')->from('patient')->where(array('ID'=>6,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
           return $query->row();
        }else{
            return false;
        }
    }
	
    function default_questionadmin(){
        $msg=new stdClass();
        $msg->question='Welcome to Hanh Phuc International Hospital. How can I help you?';
        $msg->sub_parent='';;
        return $msg;
    }
    
    function default_questionadmin2($subparent,$level,$parent){
        $query=$this->db->select('*')->from($this->main_table)->where(array('parent'=>$parent,'sub_parent'=>$subparent,'is_deleted'=>0,'level'=>$level))->get();
        if($query->num_rows()>0){
           return $query->row();
        }else{
            return false;
        }
    }
    
    function default_question(){
        $msg=array();
        $msg['question_english']='Welcome to Hanh Phuc International Hospital. How can I help you?';
        $msg['sub_parent']='';
        return array($msg);
    }
    
    function UserChats($username){
        $query=$this->db->select('*')->from('user_chats')->where(array('username'=>$username))->get();
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
    }

	function UserChatslimit($username,$start='',$limit='',$from_date='',$to_date=''){
        $this->db->select('*')->from('user_chats');
        $this->db->where('username',$username);
        if($from_date!='' && $to_date!=''){
           $this->db->where('date>=',$from_date);
           $this->db->where('date<=',$to_date);
        }
        $this->db->order_by('ID','DESC');
        if($start!='' && $limit!=''){
            $this->db->limit($limit, $start);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
    }

	 function UserChatsRepeat($username){
        //last chat first question id
        $subparent_id=$this->db->select('max(ID) as id')->from('user_chats')->where(array('username'=>$username,"subparent"=>'1c','is_support'=>1))->get()->row()->id;
        //echo $this->db->last_query();die;
//$dttime=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -20 minutes"));
        $query=$this->db->select('*')->from('user_chats')->where(array('username'=>$username,"ID>="=>$subparent_id))->get();
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
    }
    
    function getSubParent($username){
        $query=$this->db->select('*')->from('user_chats')->where(array('username'=>$username,'subparent !='=>''))->order_by('ID','DESC')->get();
        if($query->num_rows()>0){
           return $query->row();
        }else{
            return false;
        }
    }
    
    function getIsOldPatient($username){
        $this->db->select('*')->from('user_chats')->where(array('username'=>$username,'subparent'=>1));
		$this->db->where('message','Yes');
		$this->db->or_where('message','Đúng');
		$query=$this->db->get();
        if($query->num_rows()>0){
           return true;
        }else{
            return false;
        }
    }
    
    function updateSeenMSG($username,$is_support){
        if($this->db->update('user_chats',array('is_seen'=>'1'),array('username'=>$username,'is_seen'=>'0','is_support'=>$is_support))){
           return true;
        }else{
            return false;
        }
    }
    
    function SaveUserChats($data){
        if($this->db->insert('user_chats',$data)){
           return true;
        }else{
            return false;
        }
    }
    
    function SaveUserChatsAdmin($data,$user_query){
        if(!empty($user_query)){//update user query status is answered
            $username=$data['username'];
            $this->db->update('user_chats',array('is_answered_support'=>1),array('username'=>$username,'message'=>$user_query,'support_name'=>''));
        }
        if($this->db->insert('user_chats',$data)){
           return true;
        }else{
            return false;
        }
    }
    
    function countPredefinedQuestion($username,$is_old){
        if($is_old=='No'){
            //$where="subparent like '_a%'";
            $where="subparent !=''";
        }elseif($is_old=='Yes'){
            //$where="subparent like '_b%'";
            $where="subparent !=''";
        }
        $this->db->select('COUNT(ID) as subparent_count')->from('user_chats');
        $this->db->where('username',$username);
        $query=$this->db->where($where)->get();
        if($query->num_rows()>0){
           return $query->row()->subparent_count;
        }else{
            return false;
        }
    }
    
    function FindUserQuery($query,$username,$language){
        
        if($language=='en'){
        $querydt=$this->db->select('*')->from($this->main_table)->where(array('question like '=>"$query%",'is_deleted'=>0))->get();
        if($querydt->num_rows()>0){
            $data=$querydt->row();
            $query2=$this->db->select('*')->from('chatbot_answers')->where(array('is_deleted'=>0))->where('find_in_set("'.$data->ID.'",parent_id) !=',0)->get();
            if($query2->num_rows()>0){
                return $query2->row()->answer;
            }else{
                return false;
            }
        }else{
            $data=array("question"=>$query,"query_by_user"=>$username,"parent"=>0,"sub_parent"=>0,"question_type"=>3,"level"=>0,"is_deleted"=>0,"status"=>1);
            $this->db->insert($this->main_table,$data);
            return false;
        }
        
    }else{
        $querydt=$this->db->select('*')->from($this->main_table)->where(array('question_vi like '=>"$query%",'is_deleted'=>0))->get();
        if($querydt->num_rows()>0){
            $data=$querydt->row();
            $query2=$this->db->select('*')->from('chatbot_answers')->where(array('is_deleted'=>0))->where('find_in_set("'.$data->ID.'",parent_id) !=',0)->get();
            if($query2->num_rows()>0){
                return $query2->row()->answer_vi;
            }else{
                return false;
            }
        }else{
            $data=array("question_vi"=>$query,"query_by_user"=>$username,"parent"=>0,"sub_parent"=>0,"question_type"=>3,"level"=>0,"is_deleted"=>0,"status"=>1);
            $this->db->insert($this->main_table,$data);
            return false;
        }
    }
    }
    
    function checkQuestionAnswer($query,$message){ //check question in database table chatbot question for exist
        $querydt=$this->db->select('*')->from($this->main_table)->where(array('question like '=>"$query%",'is_deleted'=>0))->get();
        if($querydt->num_rows()>0){
            $data=$querydt->row();
            //if exist then check for its answer in chatbot_answer table
            $query2=$this->db->select('*')->from('chatbot_answers')->where(array('is_deleted'=>0))->where('find_in_set("'.$data->ID.'",parent_id) !=',0)->get();
            if($query2->num_rows()>0){
            }else{
                $data=array("answer"=>$message,"parent_id"=>$data->ID);
                $this->db->insert('chatbot_answers',$data);
                return false;
            }
        }
    }
    
    function getLastQuery($username){
        $this->db->select('*')->from('user_chats');
        $this->db->where('username',$username);
        $this->db->where('support_name','');
        $this->db->where('is_answered_support=',0);
        $this->db->where('subparent=','');
        $this->db->where('is_support=',0);
        $query=$this->db->order_by('ID','DESC')->limit(1)->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){
           return $query->row()->message;
        }else{
            return false;
        }
    }
    
	function notAnsweredChatByAdmin($username){
		$dateTimeMinus5Sec=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -60 seconds"));
        $this->db->select('*')->from('user_chats');
        $this->db->where('username',$username);
        $this->db->where('support_name','');
        $this->db->where('subparent','');
        //$this->db->where('date',date('Y-m-d'));
		$this->db->where('date_time>',$dateTimeMinus5Sec);
        $this->db->where('is_answered_support',0);
        $this->db->where('is_support',0);
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
    }
    
    function totalQueryNotAnswered(){
        $ids='';
        $dataids=$this->db->query("SELECT GROUP_CONCAT(parent_id) as ids from `hms_chatbot_answers` where parent_id>39")->row();
        $wheresearch="Q.ID not in($dataids->ids)";
        $ids2=$this->db->query("SELECT GROUP_CONCAT(Q.ID) as ids2 FROM hms_chatbot_questions as Q where $wheresearch and Q.ID>39 and Q.sub_parent='0'")->row();
        if(!empty($ids2)){
            $ids=$ids2->ids2;
        }else{
            $ids='';
        }
        $this->db->select("Q.*");
        $this->db->from($this->main_table." as Q");
        $this->db->where_in('Q.ID',$ids,false);
        $this->db->where("Q.ID>",36);
        $this->db->where("Q.is_deleted",0);
        $this->db->order_by('Q.ID','DESC');
        $result=$this->db->get();
        if($result->num_rows()>0){
            //print_r($result->result());die;
            return $result->result();
        }else{
            return false;
        }
        //echo $this->db->last_query();die;
        
    }
    
    function lastMail(){
        $this->db->select('*,MAX(ID) AS id')->from('mail_sent_details');
        $this->db->where('type','1');
        $query=$this->db->get();
        if($query->num_rows()>0){
            $datetime=$query->row()->date_time;
            $timeMinus_12hour=date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")." -12 hours"));
            if($timeMinus_12hour>$datetime){
                return true;
            }else{
                return false;
            }
           return $query->row();
        }else{
            return false;
        }
    }
	
	function getMessageCount(){
        $query=$this->db->select('count(id) as msgcount')->from('user_chats')->where(array('is_support'=>'0','is_seen'=>'0'))->get();
       //echo $this->db->last_query();die;
        if($query->num_rows()>0){
            return $query->row()->msgcount;
        }else{
            return false;
        }
    }
	
	function getpatientPRN($username){
        $query=$this->db->select('prn')->from('patient')->where(array('username'=>$username,'is_deleted'=>'0'))->get();
       //echo $this->db->last_query();die;
        if($query->num_rows()>0){
            return $query->row()->prn;
        }else{
            return false;
        }
    }
    
}