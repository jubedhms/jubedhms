<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_manage_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="chatbot_questions";
    }
    
    public function getData($is_active='',$limit,$start){
        $ids='';
        if($this->input->post('question_type')){
            $question_type=$this->input->post('question_type');
            $dataids=$this->db->query("SELECT GROUP_CONCAT(parent_id) as ids from `hms_chatbot_answers` where parent_id>39")->row();
            //print_r($dataids);die;
            if($question_type==1){
                $wheresearch="Q.ID in($dataids->ids)";
                //$wheresearch="where (A.`answer`!='' || A.`answer_vi`!='')";
            }elseif($question_type==2){
                $wheresearch="Q.ID not in($dataids->ids)";
                //$wheresearch="where (A.`answer`='' || A.`answer_vi`='')";
            }
            $ids2=$this->db->query("SELECT GROUP_CONCAT(Q.ID) as ids2 FROM hms_chatbot_questions as Q where $wheresearch and Q.ID>39 and Q.ID not in(37,38,39,55,65,66,67,68,69,71,107,108) and Q.sub_parent='0'")->row();
            //echo $this->db->last_query();die;
            //print_r($ids2->ids2);die;
            if(!empty($ids2)){
                $ids=$ids2->ids2;
            }else{
                $ids='';
            }
        }
        
        $this->db->select("Q.*");
        $this->db->from($this->main_table." as Q");
        
        if($this->input->post('start_date')){
            $date=$this->input->post('start_date');
            $this->db->where("Q.date_created",$date);
        }
        //language recognize in php in two language
        if($this->input->post('question')){
            $question=trim($this->input->post('question'));
            //$this->db->where("Q.question",$question);
            $this->db->like("Q.question", $question, 'both');
        }
        if($this->input->post('question')){
            $question=trim($this->input->post('question'));
            //$this->db->where("Q.question",$question);
            $this->db->or_like("Q.question_vi", $question, 'both');
        }
        
        if($this->input->post('question_type')){
            $this->db->where_in('Q.ID',$ids,false);
            //$this->db->or_where_not_in('Q.ID',$ids,false);
        }
        $this->db->where("Q.ID>",36);
        $ignore = array(37,38,39,55,65,66,67,68,69,71,107,108);
        $this->db->where_not_in('Q.ID', $ignore);
        $this->db->where("Q.is_deleted",0);
        $this->db->order_by('Q.ID','DESC');
        $this->db->limit($limit, $start);
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die;
        return $result;
    }
    
    public function get_count($is_active=''){
        $ids='';
        if($this->input->post('question_type')){
            $question_type=$this->input->post('question_type');
            $dataids=$this->db->query("SELECT GROUP_CONCAT(parent_id) as ids from `hms_chatbot_answers` where parent_id>39")->row();
            //print_r($dataids);die;
            if($question_type==1){
                $wheresearch="Q.ID in($dataids->ids)";
                //$wheresearch="where (A.`answer`!='' || A.`answer_vi`!='')";
            }elseif($question_type==2){
                $wheresearch="Q.ID not in($dataids->ids)";
                //$wheresearch="where (A.`answer`='' || A.`answer_vi`='')";
            }
            $ids2=$this->db->query("SELECT GROUP_CONCAT(Q.ID) as ids2 FROM hms_chatbot_questions as Q where $wheresearch and Q.ID>39 and Q.ID not in(37,38,39,55,65,66,67,68,69,71,107,108)")->row();
            //echo $this->db->last_query();die;
            //print_r($ids2->ids2);die;
            if(!empty($ids2)){
                $ids=$ids2->ids2;
            }else{
                $ids='';
            }
        }
        $this->db->select("Q.*");
        $this->db->from($this->main_table." as Q");
        if($this->input->post('question_type')){
            $this->db->where_in('Q.ID',$ids,false);
        }
        $this->db->where("Q.is_deleted",0);
        $this->db->where("Q.ID>",36);
        $ignore = array(37,38,39,65,66,67,68,69,71,107,108);
        $this->db->where_not_in('Q.ID', $ignore);
        $this->db->order_by('Q.ID','DESC');
        $result=$this->db->get();
        if($result->num_rows()>0){
            return $result->num_rows();
        }else{
            return false;
        }
    }

    public function add_question_answer(){
        $extention=array();
        if(isset($_FILES['awareness_image']['name'])){
            $extention=explode('.',$_FILES['awareness_image']['name']);
        }
        extract($_POST);
            $LOGINID=$this->LOGINID;
			$curr_date=date("Y-m-d H:i:s");
			$curr_time=date("H:i:s");
            $insertData=array(
                                'question'=>isset($question)?$question:'',
                                'question_vi'=>isset($question_vi)?$question_vi:'',
                                'maker_id'=>$LOGINID,
                                'maker_date'=>$curr_date,
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$curr_date
                            );
            $this->db->insert($this->main_table, $insertData);
            $ID=$this->db->insert_id();
            $insertData_answer=array(
                            'parent_id'=>$ID,
                            'answer'=>isset($answer)?$answer:'',
                            'answer_vi'=>isset($answer_vi)?$answer_vi:'',
                            'maker_id'=>$LOGINID,
                            'maker_date'=>$curr_date,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$curr_date
                            );
            $this->db->insert('chatbot_answers', $insertData_answer);
            setFlashMsg('success_message',"Chat question and answer has been created successfully.",'alert-success');
        return true;
    }
    
    public function edit_question_answer(){
        //print_r($_POST);die;
        extract($_POST); 
        //print_r($asnwer_id);die;
        //$ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
        $curr_date=date("Y-m-d H:i:s");
        $updateData=array(
                            'question'=>isset($question)?$question:'',
                            'question_vi'=>isset($question_vi)?$question_vi:'',
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$curr_date
                            );
        $this->db->update($this->main_table,$updateData,array('ID'=>$ID));
        $i=0;
        //print_r($answer);die;
        if(@count($asnwer_id)>0){
        foreach($asnwer_id as $rowid){
        $updateData_answer=array(
                            'answer'=>isset($answer)?$answer[$i]:'',
                            'answer_vi'=>isset($answer_vi)?$answer_vi[$i]:'',
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$curr_date
                            );
        //echo "<pre>";
        //print_r($updateData_answer);
        //echo $rowid;
        $this->db->update('chatbot_answers',$updateData_answer,array('ID'=>$rowid));
        $i++;
        }
    }else{
        $insertData_answer=array(
                            'parent_id'=>$ID,
                            'answer'=>isset($answer)?$answer:'',
                            'answer_vi'=>isset($answer_vi)?$answer_vi:'',
                            'maker_id'=>$LOGINID,
                            'maker_date'=>$curr_date,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$curr_date
                            );
            $this->db->insert('chatbot_answers', $insertData_answer);
    }
    
        //die;
        setFlashMsg('success_message',"Chat question and answer has been updated successfully.",'alert-success');
        return true;
    }
    
    function updateEndDate($id,$date_end){
        if($this->db->update($this->main_table,array('end_date'=>$date_end),array('ID'=>$id))){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("Q.*");
        $this->db->from($this->main_table." as Q");
        $this->db->where("MD5(Q.ID)",$ID);
        $this->db->where("Q.is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }
    
    public function delete_chat_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->update($this->main_table,$updateData);
        $this->db->where('find_in_set("'.$IDS.'",MD5(parent_id)) !=',0);
        $this->db->update('chatbot_answers',$updateData);
        echo "chat question answer has been deleted successfully.";
        return;
    }
    
    
}