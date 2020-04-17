<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awareness_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="awareness";
    }

    public function get_data($language='en'){
        $curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		
		extract($_GET);
        if($language=='vi'){
            $this ->db->select('ID as awareness_id, name_vi as name,customer_group,start_date,end_date,awareness_image as file_src,file_type,description_vi as description');
        }else{
            $this ->db->select('ID as awareness_id, name,customer_group,start_date,end_date,awareness_image as file_src,file_type,description');
        }
        $this->db->from($this->main_table);
		
		//$this->db->where('start_date <=',$curr_date);
		$this->db->where('start_datetime <=',$curr_date.' '.$curr_time);
		$this->db->where('end_date >=',$curr_date);
		
        $this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);
			
        if(isset($awareness_id) && $awareness_id!=''){
            $this->db->where('ID=',$awareness_id);
        } 

        if(isset($file_type) && $file_type!='' && ($file_type=='1' || $file_type=='2' || $file_type=='3')){
            $this->db->where('file_type=',$file_type);
        } 

        if(isset($from_date) && $from_date!=''){
            $this->db->where('updater_date >=', $from_date);
         }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('updater_date <=', $to_date);
         }

        if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
        $this->db->order_by("ID", "desc");
        $result=$this->db->get()->result();
        return $result; 
    }

    

}