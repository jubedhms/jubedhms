<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="cities";
    }
    
     function getData($is_active=''){
        $this->db->select("C.*");
        $this->db->from($this->main_table." as C");
        if($is_active==1)$this->db->where("C.show_status",1);
        $this->db->where("C.is_deleted",0);
        $this->db->order_by('C.ID','ASC');
        $result=$this->db->get()->result();
        return $result;
    }
	
	function getDataByProvinceId($province_id){
        $where_in=$province_id;
        $this->db->select("C.*");
        $this->db->from($this->main_table." as C");
        $this->db->where("C.show_status",1);
        $this->db->where_in('province_id',$where_in,false);
        $this->db->where("C.is_deleted",0);
        $this->db->order_by('C.ID','ASC');
        $result=$this->db->get()->result();
        return $result;
    }
}