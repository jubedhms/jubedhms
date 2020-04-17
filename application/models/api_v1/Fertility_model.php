<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fertility_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="fertility";
    }

    public function getData($username='',$start_date='',$end_date=''){
		$this ->db->select('ID as fertility_id, username, start_date, end_date');
		$this->db->from($this->main_table);
        $this->db->where("username",$username);
		if($start_date!='')$this->db->where("start_date",$start_date);
		if($end_date!='')$this->db->where("end_date",$end_date);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $result=$this->db->get()->result();
        return $result;
    }

	public function add_fertility($username='',$start_date='',$end_date=''){
		$crr_date=date("Y-m-d H:i:s");
		$crr_time=date("H:i:s");
		
		$insertData=[
				'username'=>$username,
				'start_date'=> $start_date,
				'end_date'=> $end_date,
				'maker_date'=> $crr_date,
                'updater_date'=> $crr_date
			];
		
		$this->db->insert($this->main_table,$insertData);
		$fertility_id=$this->db->insert_id();
        return $fertility_id;
    }
}