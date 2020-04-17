<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat_model extends CI_Model {
     function __construct(){
        parent::__construct();
        //$this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="chat_questions";
    }
    
    function get_question(){
        $query=$this->db->select('ID,question_english,question_type,sub_parent')->from($this->main_table)->where(array('ID'=>1,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
            $data=array($query->row_array());
           return $data;
        }else{
            return false;
        }
        
    }
	function get_questionadmin(){
        $query=$this->db->select('ID,question_english,question_type,sub_parent')->from($this->main_table)->where(array('ID'=>1,'is_deleted'=>0))->get();
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
        $query=$this->db->select('*')->from('patient')->where(array('ID'=>2,'is_deleted'=>0))->get();
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
        $query=$this->db->select('*')->from('chat_questions')->where(array('parent'=>$parent,'sub_parent'=>$subparent,'is_deleted'=>0,'level'=>$level))->get();
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
	
	function getOptionBytypeadmin($parent_id,$parent){
        $query=$this->db->select('*')->from('chat_questions')->where(array('parent'=>$parent,'is_deleted'=>0))->where('find_in_set("'.$parent_id.'",parent_id) !=',0)->get();
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
    }

    function getOptionYesNo($parent){
        $query=$this->db->select('*')->from('chat_questions')->where(array('parent'=>$parent,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
           return $query->result();
        }else{
            return false;
        }
    }
    
    function getOneAQuestion(){
        $query=$this->db->select('*')->from('patient')->where(array('ID'=>2,'is_deleted'=>0))->get();
        if($query->num_rows()>0){
           return $query->row();
        }else{
            return false;
        }
    }
	
	function default_questionadmin(){
        $msg=new stdClass();
        $msg->question_english='Welcome to Hanh Phuc International Hospital. How can I help you?';
        $msg->sub_parent='';;
        return $msg;
    }
    
    function default_question(){
        $msg=array();
        $msg['question_english']='Welcome to Hanh Phuc International Hospital. How can I help you?';
        $msg['sub_parent']='';
        return array($msg);
    }
}