<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="patient_notification_history";
    }
	
	public function get_count(){
		$this->db->where("is_read",0);
		$this->db->where("is_deleted",0);
		$result = $this->db->get($this->main_table)->num_rows();
		return $result;
	}
	
    public function get_data(){
        extract($_GET);
		$curr_date=date("Y-m-d");
		$crr_time=date("H:i:s");
		
        $this ->db->select('ID as notification_id,prn,parent_prn,title,module_name,module_id,description,created_date,created_time');
        $this->db->from($this->main_table);
        $this->db->where('prn=',$prn);
        $this->db->or_where('parent_prn',$prn);
        $this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);

        if(isset($from_date) && $from_date!=''){
            $this->db->where('created_date >=', $from_date);
         }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('created_date <=', $to_date);
         }

        if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
        $this->db->order_by("ID", "desc");
        $result1=$this->db->get()->result();
        foreach($result1 as $value){
            if($value->parent_prn!=''){
                $value->is_parent='0';
            }else{
                $value->is_parent='1';
            }
        }
		
		$this ->db->select('ID as notification_id,"" as prn,"" as parent_prn,title,"" as module_name,"" as module_id,description,from_date as created_date,from_time as created_time,"" as is_parent');
        $this->db->from("notification");
		$this->db->where("from_date <=",$curr_date);
		//$this->db->where("from_time <=",$curr_time);
		$this->db->where("to_date >=",$curr_date);
		//$this->db->where("to_time >=",$curr_time);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('from_time >=', $from_date);
         }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('to_date <=', $to_date);
         }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		$this->db->order_by("ID", "desc");
        $result2=$this->db->get()->result();
		
		$result=($result1 && $result2)?array_merge($result1,$result2):(($result1)?$result1:$result2);
        return $result; 
    }
	
	public function update_as_read($prn){
		$updateData=array('is_read'=>1);    
        $this->db->where("prn", $prn);
		$this->db->or_where("parent_prn", $prn);
        $this->db->update($this->main_table,$updateData);
		return true;
	}
	
    public function loadDataById($notification_id=''){
        $this ->db->select('ID as notification_id,prn,parent_prn,title,module_name,module_id,title,description,created_date,created_time');
        $this->db->from($this->main_table);
        $this->db->where('ID=',$notification_id);
        $this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);
        $result=$this->db->get()->row();
        if($result->parent_prn!=''){
            $result->is_parent='0';
        }else{
            $result->is_parent='1';
        }
        return $result; 
    }
	
}