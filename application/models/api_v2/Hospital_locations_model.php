<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital_locations_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="hospital_location";
    }

    public function getData(){
        $this ->db->select('code,name');
        $this->db->from($this->main_table);
        $this->db->where("code !=","");
		$this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $result=$this->db->get()->result();
        return $result;
    }

}