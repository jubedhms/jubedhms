<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        //$this->main_table=tblprefix("user");
    }

    public function api_usage_report($api_secret_key=''){
        $LOGINID=$this->LOGINID;
		 extract($_POST); //print_r($_POST);

		$from_date=isset($from_date)?datepikerDateTime($from_date):date('Y-m-01');
		$to_date=isset($to_date)?datepikerDateTime($to_date):date('Y-m-d');
		$on_app=isset($on_app)?$on_app:"";
		$type=isset($type)?$type:"";
		
		// get sync id
		if($api_secret_key!=''){
			$this->db->select("ID");
			$this->db->from(tblprefix("api_synchronize"));
			$this->db->where("is_deleted",0);
			$this->db->where("show_status",1);
			$this->db->where("api_secret_key",$api_secret_key);
			$sync_id=$this->db->get()->row()->ID; 
		}
		// end
		
		$this->db->select("ASD.*");
        $this->db->from(tblprefix("api_synchronize_data")." ASD");
		if($from_date!='')$this->db->where("ASD.maker_date>=",$from_date);
		if($to_date!='')$this->db->where("ASD.maker_date<=",$to_date);
		if($api_secret_key!='')$this->db->where("ASD.sync_id",$sync_id);
        if($on_app!='')$this->db->where("ASD.on_app",$on_app);
		if($type!='')$this->db->where("ASD.type",$type);
		
		$this->db->order_by('ASD.maker_date','DESC');
        $this->db->order_by('ASD.old_record','ASC');
        $this->db->order_by('ASD.order_by','ASC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query()."<pre>";print_r($result);die;
        return $result;
    }
	
	public function get_configDetails($ID=''){
		$LOGINID=$this->LOGINID;
		if($LOGINID!=''){
			$ID=(is_numeric($ID))?md5($ID):$ID;
			$this->db->select("api_secret_key, title");
			$this->db->from(tblprefix('api_config'));
			$this->db->where("is_deleted",0);
			$this->db->where("show_status",1);
            if($ID!=''){
                $this->db->where("MD5(user_id)",$ID);
            }else{
                $this->db->where("user_id",$LOGINID);
            }
			$result=$this->db->get()->row();
			return $result;
		}else{
			return false;
		}	
}
	
	
}