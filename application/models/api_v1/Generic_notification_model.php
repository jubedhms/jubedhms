<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="generic_notification";
    }

     public function get_data($language){
         if($language=='vi'){
            $this ->db->select('ID as notification_id,title,description_vi as description');
		}else{
            $this ->db->select('ID as notification_id,title,description');
		}
		
        $this->db->from($this->main_table);
		$this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);
        $result=$this->db->get()->result();
        return $result; 
    }
	
	public function loadDataByID($ID,$language){
         if($language=='vi'){
            $this ->db->select('title,description_vi as description');
		}else{
            $this ->db->select('title,description');
		}
		
        $this->db->from($this->main_table);
        $this->db->where('ID',$ID);
		$this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);
        $result=$this->db->get()->row();
        return $result; 
    }

    

}