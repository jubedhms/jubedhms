<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_specialization_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="doctor_specialization";
    }

    public function get_data(){
        $this ->db->select('code, name');
        $this->db->from($this->main_table);
        $this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);
        $this->db->order_by("name", "asc");
        $result=$this->db->get()->result();
        return $result; 
    }

    

}