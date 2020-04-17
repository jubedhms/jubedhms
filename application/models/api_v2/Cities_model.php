<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities_model extends CI_Model {
   public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="cities";
    }

    public function getData($province_code='',$city_code=''){
       
        $this ->db->select('ID as city_code,province_id as province_code,name');
        $this->db->from($this->main_table);
        if($province_code!='')$this->db->where("province_id",$province_code);
        if($city_code!='')$this->db->where("ID",$city_code);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
		$this->db->order_by("name", "ASC");
        $result=$this->db->get()->result();
       
        return $result;
    }

}