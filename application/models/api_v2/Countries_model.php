<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class countries_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="countries";
    }

    public function getData($country_code=''){
       
        $this ->db->select('ID as country_code,name');
        $this->db->from($this->main_table);
        if($country_code!='')$this->db->where("country_code1",$country_code);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
		$this->db->order_by("name", "ASC");
        $result=$this->db->get()->result();
       
        return $result;
    }


}