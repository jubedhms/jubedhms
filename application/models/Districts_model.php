<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="districts";
    }
    
     function getData($is_active=''){
        $this->db->select("D.*");
        $this->db->from($this->main_table." as D");
        if($is_active==1)$this->db->where("D.show_status",1);
        $this->db->where("D.is_deleted",0);
        $this->db->order_by('D.ID','ASC');
        $result=$this->db->get()->result();
        return $result;
    }
	
	function get_districtByid($city_id){
        $where_in=implode(',',$city_id);
        $this->db->select("D.*");
        $this->db->from($this->main_table." as D");
        $this->db->where("D.is_deleted",0);
        $this->db->where_in('city_id',$where_in);
        $this->db->order_by('D.ID','ASC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die; //echo "<br/><pre>";print_r($result);;die();
        return $result;
    }
	
	function get_districtByCityId($city_id){
        $where_in=$city_id;
        $this->db->select("D.*");
        $this->db->from($this->main_table." as D");
        $this->db->where("D.is_deleted",0);
        $this->db->where_in('city_id',$where_in,false);
        $this->db->order_by('D.ID','ASC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die; //echo "<br/><pre>";print_r($result);;die();
        return $result;
    }
}