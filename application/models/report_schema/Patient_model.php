<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
		$this->oracle_db=$this->load->database('oracle',true); //connected with oracle
		$this->db=$this->load->database('default',true); //connected with mysql
        $this->main_table="patient";
    }

	public function update_prn(){
		$total_update=0;
		$result=[];
		$LOGINID=1;
        $curr_date=date("Y-m-d H:i:s");
        $SYNC_DATE=date("d-M-y");
		
		$this->db->select("ID,first_name,middle_name,last_name,username, DATE_FORMAT(dob, '%d-%m-%y') as dob");	
		
        $this->db->from($this->main_table);
        $this->db->where("prn","");
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->result();
		
		foreach($result as $key=>$value){
			//echo "<pre>";print_r($value);
			$first_name=$value->first_name;
			$middle_name=$value->middle_name;
			$last_name=$value->last_name;
			$fullname=$first_name.(($middle_name!='')?' '.$middle_name:'').(($last_name!='')?' '.$last_name:'');
			$dob=$value->dob;
			
			$this->oracle_db->select("*");
			$this->oracle_db->from("NOVA_PATIENT");
			$this->oracle_db->like("PATIENT_NAME",$fullname);
			$this->oracle_db->where("DOB !=","");
			$this->oracle_db->where("DOB",$dob);
			
			if(is_numeric($value->username)){
				//$this->oracle_db->group_start();				// SQL Query not support
				$this->oracle_db->where("MOBILE_PHONE",$value->username);
				$this->oracle_db->or_where("HOME_PHONE",$value->username);
				$this->oracle_db->or_where("HOME_PHONE",'0'.$value->username);
				$this->oracle_db->or_where("HOME_PHONE",'0'.$value->username);
				//$this->oracle_db->group_end();				// SQL Query not support
			}else{
				$this->oracle_db->where("EMAIL",$value->username);
			}
			
			$row=$this->oracle_db->get()->row();
			//echo $this->oracle_db->last_query();
			
			if($row){ 
				//echo "<pre>";print_r($row);die;
				$data['prn']=$row->PRN;
				$this->db->update("patient",$data,["ID"=>$value->ID]);
				$total_update=$total_update+1;
			}
		}
		
		echo "<br> Total update: ".$total_update;	
        return $result;
    }

	public function update_prn_by_username($username=''){
		if($username!=''){
			$this->oracle_db=$this->load->database('oracle',true); //connected with oracle
			
			$LOGINID=1;
			$curr_date=date("Y-m-d H:i:s");
			$SYNC_DATE=date("d-M-y");
			
			$this->db->select("ID,prn,first_name,middle_name,last_name,username, DATE_FORMAT(dob, '%d-%m-%y') as dob");	
			
			$this->db->from($this->main_table);
			$this->db->where("username",$username);
			$this->db->where("is_deleted",0);
			$result=$this->db->get()->row();
			if(!$result)return false;
			if($result->prn!='')return false;
			$first_name=$result->first_name;
			$middle_name=$result->middle_name;
			$last_name=$result->last_name;
			$fullname=$first_name.(($middle_name!='')?' '.$middle_name:'').(($last_name!='')?' '.$last_name:'');
			$dob=$result->dob;
			
			$this->oracle_db->select("*");
			$this->oracle_db->from("NOVA_PATIENT");
			$this->oracle_db->like("PATIENT_NAME",$fullname);
			$this->oracle_db->where("DOB !=","");
			$this->oracle_db->where("DOB",$dob);
			
			if(is_numeric($result->username)){
				//$this->oracle_db->group_start();				// SQL Query not support
				$this->oracle_db->where("MOBILE_PHONE",$result->username);
				$this->oracle_db->or_where("HOME_PHONE",$result->username);
				$this->oracle_db->or_where("HOME_PHONE",'0'.$result->username);
				$this->oracle_db->or_where("HOME_PHONE",'0'.$result->username);
				//$this->oracle_db->group_end();				// SQL Query not support
			}else{
				$this->oracle_db->where("EMAIL",$result->username);
			}
			
			$row=$this->oracle_db->get()->row();
			//echo $this->oracle_db->last_query();
			
			if($row){ 
				$data['prn']=$row->PRN;
				$this->db->update("patient",$data,["ID"=>$result->ID]);
				return $row->PRN;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
}