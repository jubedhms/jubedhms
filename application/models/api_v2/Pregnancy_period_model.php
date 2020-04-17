<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pregnancy_period_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="pregnancy_period";
    }

    public function get_data($language='en'){
        extract($_GET);
        if($language=='vi'){
            $this ->db->select('ID as pregnancy_period_id,name_vi as name,pregnancy_week,pregnancy_period_image as file_src,file_type,description_vi as description');
        }else{
            $this ->db->select('ID as pregnancy_period_id,name,pregnancy_period_image as file_src,file_type,description');
        }
        $this->db->from($this->main_table);
        $this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);

        if(isset($week) && $week!=''){
            $this->db->where('pregnancy_week=',$week);
        }
		
		if(isset($pregnancy_period_id) && $pregnancy_period_id!=''){
            $this->db->where('ID=',$pregnancy_period_id);
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