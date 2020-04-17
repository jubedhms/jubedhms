<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="patient_notification_history";
    }
	
	public function get_count($username){
		$this->db->group_start();
		$this->db->where('username',$username);
		$this->db->or_where('parent_username',$username);
		$this->db->group_end();
		$this->db->where("is_read",0);
		$this->db->where("is_deleted",0);
		return $result1 = $this->db->count_all_results($this->main_table);
		
		/*
		$this->db->where("is_read",0);
		$this->db->where("is_deleted",0);
		$result2 = $this->db->count_all_results("notification");
		
		$result=($result1 && $result2)?($result1+$result2):(($result1)?$result1:$result2);
		return $result;
		*/
	}
	
    public function get_data(){
        extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$language=isset($_GET['language'])?$_GET['language']:'en';
		
		// from patient personal notification table
        if((isset($username) && $username!='') || (isset($username) && $username!='')){
			if($language=='vi'){
				$this ->db->select('ID as notification_id,module_name,module_id,title_vi as title,description_vi as description,created_date,created_time');
			}else{
				$this ->db->select('ID as notification_id,module_name,module_id,title,description,created_date,created_time');
			}
		
			$this->db->from($this->main_table);
			$this->db->group_start();
			$this->db->where('username',$username);
			$this->db->or_where('parent_username',$username);
			$this->db->group_end();
			$this->db->where('is_deleted',0);
			$this->db->where('show_status',1);

			if(isset($from_date) && $from_date!=''){
				$this->db->where('created_date >=', $from_date);
			 }
			 
			 if(isset($to_date) && $to_date!=''){
				$this->db->where('created_date <=', $to_date);
			 }

			if(isset($limit) && $limit!='' && isset($start) && $start!=''){
				$this->db->limit($limit, $start);
			}
			$this->db->order_by("ID", "desc");
			$result1=$this->db->get()->result();
		}else{
			$result1=[];
		}	
		//end
		
		// from notification common table 
		if($language=='vi'){
				$this ->db->select('N.ID as notification_id,N.module_name,N.module_id,N.title_vi as title,N.description_vi as description,N.notification_page_start_date as created_date,N.notification_page_start_time as created_time');
			}else{
				$this ->db->select('N.ID as notification_id,N.module_name,N.module_id,N.title,N.description,N.notification_page_start_date as created_date,N.notification_page_start_time as created_time');
			}
		$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from("notification as N");
		$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "LEFT");
		$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
		if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.notification_page","1");
		$this->db->where("CONCAT_WS(' ',N.notification_page_start_date,N.notification_page_start_time) <=",$curr_date." ".$curr_time,"both");
		$this->db->where("CONCAT_WS(' ',N.notification_page_end_date,N.notification_page_end_time) >=",$curr_date." ".$curr_time,"both");
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.notification_page_start_date >=', $from_date);
         }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('N.notification_page_end_date <=', $to_date);
         }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		$this->db->group_by("N.ID");
		$this->db->order_by("N.notification_page_start_date","desc");
		$this->db->order_by("N.notification_page_start_time","desc");
        $result2=$this->db->get()->result();
		if($result2){
			foreach($result2 as $key=>$value){
				if($value->module_name!='notification'){
					if($value->module_name=='awareness'){
						$this ->db->select('ages,relationship,province,city,district,gender');
						$this->db->where('start_date <=',$curr_date);
						$this->db->where('end_date >=',$curr_date);
					}
					
					$this ->db->select('name,description');
					if($value->module_name=='service'){
						$this->db->from('product');
					}else{
						$this->db->from($value->module_name);
					}		
					$this->db->where('ID',$value->module_id);
					$this->db->where('is_deleted',0);
					$this->db->where('show_status',1);
					$res=$this->db->get()->row();
					if($res && isset($value->title) && $value->title!='' && isset($value->description) && $value->description!=''){
						if($value->module_name=='awareness'){
							$demographics=$this->check_demographics($value,$res);
							if($demographics==false){
								continue;
							}
							unset($value->patient_age,$value->patient_gender,$value->patient_relationship,$value->patient_province,$value->patient_city,$value->patient_district); 
						}
					}else{
						unset($result2[$key]);
					}
				}
			}
		}	
		
		//end 
		$result=($result1 && $result2)?array_merge($result1,$result2):(($result1)?$result1:$result2);
		if($result){
			usort($result, function ($a, $b) { return strnatcmp($b->created_date.' '.$b->created_time, $a->created_date.' '.$a->created_time); });
		}
        
		return $result; 
    }
	
	public function check_demographics($value,$res){
		$patient_age_range='';
		
		if($value->patient_age<=18){
			$patient_age_range=1;			
		}else if($value->patient_age >=18 && $value->patient_age <=24){
			$patient_age_range=2;			
		}else if($value->patient_age >=25 && $value->patient_age <=34){
			$patient_age_range=3;			
		}else if($value->patient_age >=35 && $value->patient_age <=44){
			$patient_age_range=4;			
		}else if($value->patient_age >=45){
			$patient_age_range=5;			
		}
		
		$ageRanges=($res->ages!='')?explode(',',$res->ages):[];
		$relationshipRanges=($res->relationship!='')?explode(',',$res->relationship):[];
		$genderRanges=($res->gender!='')?explode(',',$res->gender):[];
		$provinceRanges=($res->province!='')?explode(',',$res->province):[];
		$cityRanges=($res->city!='')?explode(',',$res->city):[];
		$districtRanges=($res->district!='')?explode(',',$res->district):[];
		
		if($ageRanges && !in_array($patient_age_range,$ageRanges)){
			return false;
		}
	
		if($relationshipRanges && !in_array($value->patient_relationship,$relationshipRanges)){
			return false;
		}

		if($genderRanges && !in_array($value->patient_gender,$genderRanges)){
			return false;
		}

		if($provinceRanges && !in_array($value->patient_province,$provinceRanges)){
			return false;
		}
		
		if($cityRanges && !in_array($value->patient_city,$cityRanges)){
			return false;
		}
		
		if($districtRanges && !in_array($value->patient_district,$districtRanges)){
			return false;
		}
		
		return true;	
	}

	public function update_as_read($username=''){
		$updateData=array('is_read'=>1);    
        $this->db->where("username", $username);
		$this->db->or_where("parent_username", $username);
		if(isset($username) && $username!=''){
			$this->db->or_where('username',$username);	
		}
		
        $this->db->update($this->main_table,$updateData);
		return true;
	}
	
	public function loadDataById($notification_id=''){
		return [];
	}
	
}
