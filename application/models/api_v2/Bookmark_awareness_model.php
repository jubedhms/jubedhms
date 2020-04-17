<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookmark_awareness_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="patient";
    }

    public function get_data($username="",$language=""){
        extract($_GET);       
        if($language=='vi'){
			$this ->db->select('A.ID as awareness_id,A.name_vi as name');
		}else{
			$this ->db->select('A.ID as awareness_id,A.name');
		}
		
        $this->db->from($this->main_table." AS P");
		$this->db->join("awareness as A", "FIND_IN_SET(A.ID, P.bookmark_awerness_id)", "LEFT");
		$this->db->where("A.show_status",1);
		$this->db->where("A.is_deleted",0);
		$this->db->where("P.username",$username);
	    $this->db->where("P.show_status",1);
		$this->db->where("P.is_deleted",0);
        $this->db->order_by("A.ID", "desc");
        $result=$this->db->get()->result();
		return $result; 
    }
	
	 public function toggle_bookmark($username="",$awareness_id=""){
		// for add value
		$this->db->where("username",$username);
        $this->db->where("show_status",1);
		$this->db->where("is_deleted",0);
		$this->db->where('!FIND_IN_SET("'.$awareness_id.'",bookmark_awerness_id) <>','0');
		$this->db->set('bookmark_awerness_id', 'IF(bookmark_awerness_id ="",'.$awareness_id.', CONCAT(bookmark_awerness_id,\',\',\''.$awareness_id.'\'))', FALSE);
		$this->db->update($this->main_table);
		$afftectedRows=$this->db->affected_rows();
		//end
		
		// for remove value
		if($afftectedRows =='0'){
			$this->db->query("UPDATE hms_patient SET bookmark_awerness_id = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', bookmark_awerness_id,','), ',".$awareness_id.",', ',')) WHERE FIND_IN_SET(".$awareness_id.", bookmark_awerness_id) AND bookmark_awerness_id!='' AND username='".$username."' AND show_status='1' AND is_deleted='0'");	
		}
		//end
        return true;
    }
}