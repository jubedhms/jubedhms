<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
		$this->main_table="notification";
    }

    public function getData(){
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		
        // from notification common table 
		$this ->db->select('N.ID, N.customer_group, N.module_name,N.module_id,N.title,N.title_vi,N.image_url,N.description,N.description_vi');
		//$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		//$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from($this->main_table." as N");
		//$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "RIGHT");
		//$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "RIGHT");
		//if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.notification_page","1");
		$this->db->where("CONCAT_WS(' ',N.notification_page_start_date,N.notification_page_start_time) <=",$curr_date." ".$curr_time,"both");
		$this->db->where("CONCAT_WS(' ',N.notification_page_end_date,N.notification_page_end_time) >=",$curr_date." ".$curr_time,"both");
		$this->db->where("is_delivered",0);
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
		$this->db->order_by("N.ID", "desc");
        $result=$this->db->get()->result();
		if($result){
			foreach($result as $key=>$value){
				if($value->module_name!='notification'){
					
					if($value->module_name=='awareness'){
						//$this ->db->select('ages,relationship,province,city,district,gender');
						//$this->db->where('start_date <=',$curr_date);
						$this->db->where('start_datetime <=',$curr_date.' '.$curr_time);
						$this->db->where('end_date >=',$curr_date);
					
					}
					/*else if($value->module_name=='special_offer'){
						$this ->db->select('name,description');	
					}else if($value->module_name=='product'){
						$this ->db->select('name,description');
					}else if($value->module_name=='service'){
						$this ->db->select('name,description');	
					}else if($value->module_name=='food_beverage'){
						$this ->db->select('name,description');
					}
					*/
					
					
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
					if($res){
						/*if($value->module_name=='awareness'){
							$demographics=$this->check_demographics($value,$res);
							if($demographics==false){
								continue;
							}
							unset($value->patient_age,$value->patient_gender,$value->patient_relationship,$value->patient_province,$value->patient_city,$value->patient_district); 
						}*/
						
						//$value->title=$res->name;
						//$value->description=$res->description;
					}else{
						if($result[$key])unset($result[$key]);
					}
				}
			}
		}	
		//echo "<pre>";print_r($result);die;
        return $result;
    }
	
	public function check_demographics($value,$res){
		$patient_age_range='';
		
		if($value->patient_age<=17){
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
	
	public function getPatientAppointmentData(){
		/*
		$this ->db->select('"" notification_token,"",username,parent_username,"doctor_appointment" as module_name,ID as module_id,"Doctor Appointment Alert" as title,"" as description');
		$this->db->from("doctor_appointment");
		$this->db->where('is_deleted',0);
		$this->db->where('show_status',1);
		$this->db->order_by("ID", "desc");
		$result=$this->db->get()->result();
		
		echo "<pre>";print_r($result);die;

		if($result){	
			foreach($result as $key=>$value){
				$this ->db->select('ID,username,notification_token');
				$this->db->from("patient");
				if($value->username!='' || $value->parent_username!=''){
					$this->db->where('username !=','');
					$this->db->group_start();
					$this->db->where('username',$value->username);
					$this->db->or_where('username',$value->parent_username);
					$this->db->group_end();
				}else{
					$this->db->where('username',$value->username);		
				}
				
				$this->db->where("is_deleted",0);
				$this->db->where("show_status",1);
				$row=$this->db->get()->row();
				if($row && isset($row->notification_token) && $row->notification_token!=''){
					$value->username=$row->username;
					$value->patient_id=$row->ID;
					$value->notification_token=$row->notification_token;
				}else{
					if($result[$key])unset($result[$key]);
				}	
			}
		return $result;	
		}*/
		return [];	
	}
	
	public function getPatientNotificationData(){
		$this ->db->select('PNH.ID,"" as patient_id,"" notification_token,PNH.username,PNH.username,PNH.parent_username,PNH.module_name,PNH.module_id,PNH.title,PNH.description,PNH.title_vi,PNH.description_vi');
		$this->db->from("patient_notification_history as PNH");
		$this->db->where('PNH.is_deleted',0);
		$this->db->where('PNH.show_status',1);
		$this->db->where("PNH.is_delivered",0);
		$this->db->order_by("PNH.ID", "desc");
		$result=$this->db->get()->result();
		
		if($result){	
			foreach($result as $key=>$value){
				$this ->db->select('ID,username,notification_token,default_language');
				$this->db->from("patient");
				
				if($value->username!='' || $value->parent_username!=''){
					$this->db->where('username !=','');
					$this->db->group_start();
					$this->db->where('username',$value->username);
					$this->db->or_where('username',$value->parent_username);
					$this->db->group_end();
				}else {
					$this->db->where('username',$value->username);		
				}
				
				$this->db->where("is_deleted",0);
				$this->db->where("show_status",1);
				$row=$this->db->get()->row();
				
				if($row && isset($row->notification_token) && $row->notification_token!=''){
					if($row->default_language=='vi'){
						$value->title=$value->title_vi;
						$value->description=$value->description_vi;	
					}
					unset($value->title_vi,$value->description_vi);
					
					$value->username=$row->username;
					$value->patient_id=$row->ID;
					$value->notification_token=$row->notification_token;
				}else{
					if($result[$key])unset($result[$key]);
				}	
			}
		
		return $result;	
		}	
	}
	
	public function update_personal_as_read($ID){
		$curr_date=date("Y-m-d");
		$updateData=array('is_read'=>1,'is_delivered'=>1,'updater_date'=>$curr_date);    
        $this->db->where("ID", $ID);
		$this->db->where("is_delivered",'0');
        $this->db->update("patient_notification_history",$updateData);
		return true;
	}
	
	public function update_as_read($ID){
		$curr_date=date("Y-m-d");
		$updateData=array('is_read'=>1,'is_delivered'=>1,'updater_date'=>$curr_date); 
        $this->db->where("ID", $ID);
		$this->db->where("is_delivered",'0');
        $this->db->update($this->main_table,$updateData);
		return true;
	}

}