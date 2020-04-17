<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Due_date_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="due_date";
    }

    public function loadDataByWeekData($pregnancy_week='',$language=''){
		if($language=='vi'){
			$this ->db->select('trimester,pregnancy_week,image_src,description_vi as description');
		}else{
			$this ->db->select('trimester,pregnancy_week,image_src,description');
		}
        $this->db->from($this->main_table);
        $this->db->where("pregnancy_week",$pregnancy_week);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $result=$this->db->get()->row();
        return $result;
    }


}