<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="districts";
    }

    public function getData($city_code='',$district_code=''){
       
        $this ->db->select('ID as district_code,city_id as city_code,name');
        $this->db->from($this->main_table);
        $this->db->where("city_id",$city_code);
        if($district_code!='')$this->db->where("ID",$district_code);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
		$this->db->order_by("CAST(name as SIGNED) ASC,name ASC");
        $result=$this->db->get()->result();
		//echo $this->db->last_query();die;
		
        return $result;
    }

}