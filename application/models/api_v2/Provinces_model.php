<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinces_model extends CI_Model {
   public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="provinces";
    }

    public function getData($country_code='',$province_code=''){
       
        $this ->db->select('ID as province_code,country_id as country_code,name');
        $this->db->from($this->main_table);
        $this->db->where("country_id",$country_code);
        if($city_code!='')$this->db->where("ID",$province_code);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
		$this->db->order_by("name", "ASC");
        $result=$this->db->get()->result();
       
        return $result;
    }

}