<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advance_notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="advance_notification";
    }

    public function get_in_app_data(){ 
        extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$file_type=isset($_GET['file_type'])?$_GET['file_type']:'';
		$response=[];
		$language=isset($_GET['language'])?$_GET['language']:'en';
		$currentWeekNumber = date('w');
		$currentDayOfMonth = date('j');
		
        // from notification common table 
		if($language=='vi'){
			$this->db->select("N.ID as notification_id,N.category as module_name,N.in_app_template_type as template_type,N.in_app_title_vi as title,N.in_app_message_vi as description,N.in_app_image_src as image_src,N.in_app_action_btn_text_first_vi as btn_text_first,N.in_app_action_btn_first as btn_action_first,N.in_app_action_btn_url_first as btn_url_first,N.in_app_action_btn_text_second_vi as btn_text_second,N.in_app_action_btn_second as btn_action_second,N.in_app_action_btn_url_second as btn_url_second");
		}else{
			$this->db->select("N.ID as notification_id,N.category as module_name,N.in_app_template_type as template_type,N.in_app_title as title,N.in_app_message as description,N.in_app_image_src as image_src,N.in_app_action_btn_text_first as btn_text_first,N.in_app_action_btn_first as btn_action_first,N.in_app_action_btn_url_first as btn_url_first,N.in_app_action_btn_text_second as btn_text_second,N.in_app_action_btn_second as btn_action_second,N.in_app_action_btn_url_second as btn_url_second");
		}
		$this ->db->select("N.ages,N.relationship,N.province,N.city,N.district,N.gender");
		$this ->db->select("ANS.scheduler_type,ANS.one_time_start_date,ANS.one_time_start_time,ANS.periodical_type,ANS.weekly_day,ANS.monthly_day,ANS.periodical_start_time");
		$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from($this->main_table. " AS N");
		$this->db->join("advance_notification_scheduler as ANS", "ANS.notification_id=N.ID", "LEFT");
		$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "LEFT");
		$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
		if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.start_date <=",$curr_date);
		$this->db->where("N.end_date >=",$curr_date);
		$this->db->where("N.inAppNotificationTemplate",1);
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.start_date >=', $from_date);
        }
         
        if(isset($to_date) && $to_date!=''){
			$this->db->where('N.end_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->group_by("N.ID");
		$this->db->order_by("N.start_date","desc");
		$this->db->order_by("N.end_date","desc");
        $result=$this->db->get()->result();
		//echo "<pre>";print_r($result);die;
		if($result){
			foreach($result as $key=>$value){
				$demographics=$this->check_demographics($value);
				if($demographics==false){
					continue;
				}	
				
				// check condition of scheduler
				if($value->scheduler_type=='1'){
					if($curr_date != $value->one_time_start_date && $curr_time < $value->one_time_start_time){
						continue;
					}
				}else if($value->scheduler_type=='2'){
					if($value->periodical_type=='2' && $value->weekly_day != $currentWeekNumber){
						continue;
					} else if($value->periodical_type=='3' && $value->monthly_day != $currentDayOfMonth){
						continue;
					}
					// match time
					if($value->periodical_start_time > $curr_time){
						continue;
					}
					// end
				}
				// end
				
				$response[]=[
						"notification_id" => $value->notification_id,
						"module_name" => $value->module_name,
						"template_type" => $value->template_type ,
						"title" => $value->title ,
						"description" => $value->description ,
						"image_src" => $value->image_src ,
						"btn_text_first" => $value->btn_text_first ,
						"btn_action_first" => $value->btn_action_first ,
						"btn_url_first" => $value->btn_url_first,
						"btn_text_second" => $value->btn_text_second ,
						"btn_action_second" => $value->btn_action_second ,
						"btn_url_second" => $value->btn_url_second
					];
			}
		}
		
		return $response; 
    }
	
	public function check_demographics($value){
		$patient_age_range='';
		
		if($value->patient_age<18){
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
		
		$ageRanges=($value->ages!='')?explode(',',$value->ages):[];
		$relationshipRanges=($value->relationship!='')?explode(',',$value->relationship):[];
		$genderRanges=($value->gender!='')?explode(',',$value->gender):[];
		$provinceRanges=($value->province!='')?explode(',',$value->province):[];
		$cityRanges=($value->city!='')?explode(',',$value->city):[];
		$districtRanges=($value->district!='')?explode(',',$value->district):[];
		
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
	
	public function send_notification_count(){
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$file_type=isset($_GET['file_type'])?$_GET['file_type']:'';
		$response=[];
		$language=isset($_GET['language'])?$_GET['language']:'en';
		$currentWeekNumber = date('w');
		$currentDayOfMonth = date('j');
		$response=[];
        // from notification common table 
		$this ->db->select("N.ID as notification_id,N.category as module_name,N.in_app_template_type as template_type,N.in_app_title as title,N.in_app_message as description,N.in_app_image_src as image_src,N.in_app_action_btn_text_first_vi as btn_text_first,N.in_app_action_btn_first as btn_action_first,N.in_app_action_btn_url_first as btn_url_first,N.in_app_action_btn_text_second as btn_text_second,N.in_app_action_btn_second as btn_action_second,N.in_app_action_btn_url_second as btn_url_second");
		$this ->db->select("N.customer_group,N.ages,N.gender,N.relationship,N.province,N.city,N.district");
		$this ->db->select("ANS.scheduler_type,ANS.one_time_start_date,ANS.one_time_start_time,ANS.periodical_type,ANS.weekly_day,ANS.monthly_day,ANS.periodical_start_time");
		
		$this->db->from($this->main_table. " AS N");
		$this->db->join("advance_notification_scheduler as ANS", "ANS.notification_id=N.ID", "LEFT");
		
		$this->db->where("N.start_date <=",$curr_date);
		$this->db->where("N.end_date >=",$curr_date);
		$this->db->where("N.inAppNotificationTemplate",1);
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.start_date >=', $from_date);
        }
         
        if(isset($to_date) && $to_date!=''){
			$this->db->where('N.end_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->group_by("N.ID");
		$this->db->order_by("N.start_date","desc");
		$this->db->order_by("N.end_date","desc");
        $result=$this->db->get()->result();
		//echo "<pre>";print_r($result);die;
		if($result){
			foreach($result as $key=>$value){
				// check condition of scheduler
				if($value->scheduler_type=='1'){
					if($curr_date != $value->one_time_start_date && $curr_time < $value->one_time_start_time){
						continue;
					}
				}else if($value->scheduler_type=='2'){
					if($value->periodical_type=='2' && $value->weekly_day != $currentWeekNumber){
						continue;
					} else if($value->periodical_type=='3' && $value->monthly_day != $currentDayOfMonth){
						continue;
					}
					// match time
					if($value->periodical_start_time > $curr_time){
						continue;
					}
					// end
				}
				// end
				
				$notification_id=$value->notification_id;
				$customerGroupRanges=($value->customer_group!='')?explode(',',$value->customer_group):[];
				$ageRanges=($value->ages!='')?explode(',',$value->ages):[];
				$relationshipRanges=($value->relationship!='')?explode(',',$value->relationship):[];
				$genderRanges=($value->gender!='')?explode(',',$value->gender):[];
				$provinceRanges=($value->province!='')?explode(',',$value->province):[];
				$cityRanges=($value->city!='')?explode(',',$value->city):[];
				$districtRanges=($value->district!='')?explode(',',$value->district):[];
		
		
				$this ->db->select("P.ID as patient_id,P.notification_token");
				$this->db->from("patient as P");
				$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
				if($customerGroupRanges){
					$this->db->group_start();
					$this->db->where_in('P.patient_group',$customerGroupRanges);
					if(in_array("1", $customerGroupRanges) && in_array("2", $customerGroupRanges) && in_array("3", $customerGroupRanges) && in_array("4", $customerGroupRanges)){
						$this->db->or_where('P.patient_group',0);	
					}
					$this->db->group_end();
				}
				
				if($ageRanges){
					$this->db->group_start();
					foreach($ageRanges as $range){
						if($range==1){
							$this->db->or_where("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) <=", 17);
						}else if($range==2){
							$this->db->or_where("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) >= 18 AND TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) <= 24");
						}else if($range==3){
							$this->db->or_where("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) >= 25 AND TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) <= 34");
						}else if($range==4){
							$this->db->or_where("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) >= 35 AND TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) <= 44");
						}else if($range==5){
							$this->db->or_where("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) >=", 45);	
						}	
					}
					$this->db->group_end();
				}
				
				if($genderRanges)$this->db->where_in('P.gender',$genderRanges);
				if($relationshipRanges)$this->db->where_in('P.marital_status',$relationshipRanges);
				if($provinceRanges)$this->db->where_in('P.province_code',$provinceRanges);
				if($cityRanges)$this->db->where_in('PA.city_code',$cityRanges);
				if($districtRanges)$this->db->where_in('PA.district_code',$districtRanges);
				
				$result_patient=$this->db->get()->result();
				if($result_patient){
					$countPatient=count($result_patient);
					//echo "<pre>";print_r($value);
					
					$this->db->set('send_count', 'send_count+'.$countPatient, FALSE);
					$this->db->where('ID', $notification_id);
					$this->db->group_start();
					$this->db->where('send_count', '');
					$this->db->or_where('send_count', 0);
					$this->db->group_end();
					$this->db->update($this->main_table);
					
					$count=$this->db->from("advance_notification_count")->where('notification_id', $notification_id)->where('date', $curr_date)->count_all_results();
					
					if($count > 0){
						$this->db->set('send_count',$countPatient, FALSE);
						$this->db->where('notification_id', $notification_id);
						$this->db->update("advance_notification_count");
						
					}else{
						$insertData=[
							'notification_id' => $notification_id,
							'date'=> $curr_date,
							'send_count'=>$countPatient,
							'maker_id'=>'',
							'maker_date'=>$curr_date,
							'updater_id'=>'',
							'updater_date'=>$curr_date
						];
						
						$this->db->insert("advance_notification_count", $insertData);
					}	
					
					foreach($result_patient as $patient){
						if($patient->notification_token!=''){
							$response[]=[
									"notification_token"=> $patient->notification_token,
									"notification_id" => $value->notification_id,
									"module_name" => $value->module_name,
									"template_type" => $value->template_type ,
									"title" => $value->title ,
									"description" => $value->description ,
									"image_src" => $value->image_src ,
									"btn_action_first" => $value->btn_action_first ,
									"btn_url_first" => $value->btn_url_first,
									"btn_text_first" => $value->btn_text_first ,
									"btn_text_second" => $value->btn_text_second ,
									"btn_action_second" => $value->btn_action_second ,
									"btn_url_second" => $value->btn_url_second
								];
						}		
					}
				}		
			}
		}
		//print_r($response);die;
		return $response;
	}
	
	public function seen_notification($notification_id){
		$curr_date=date("Y-m-d");
		
		$this->db->set('seen_count', 'seen_count+1', FALSE);
		$this->db->where('ID', $notification_id);
		$this->db->update($this->main_table);
		
		$count=$this->db->from("advance_notification_count")->where('notification_id', $notification_id)->where('date', $curr_date)->count_all_results();
		
		if($count > 0){
			$this->db->set('seen_count', 'seen_count+1', FALSE);
			$this->db->where('notification_id', $notification_id);
			$this->db->update("advance_notification_count");
		}else{
			$insertData=[
				'notification_id' => $notification_id,
				'date'=> $curr_date,
				'seen_count'=>'1',
				'maker_id'=>'',
				'maker_date'=>$curr_date,
				'updater_id'=>'',
				'updater_date'=>$curr_date
			];
			
			$this->db->insert("advance_notification_count", $insertData);
		}
		
		return true;
	}
	
	public function click_notification($notification_id){
		$curr_date=date("Y-m-d");
		
		if(isset($_POST['interact']) && $_POST['interact']==1){ 
			$this->db->set('interact_count', 'interact_count+1', FALSE);
		}
		$this->db->set('click_count', 'click_count+1', FALSE);
		$this->db->where('ID', $notification_id);
		$this->db->update($this->main_table);
		
		$count=$this->db->from("advance_notification_count")->where('notification_id', $notification_id)->where('date', $curr_date)->count_all_results();
		
		if($count > 0){
			if(isset($_POST['interact']) && $_POST['interact']==1){ 
				$this->db->set('interact_count', 'interact_count+1', FALSE);
			}
			$this->db->set('click_count', 'click_count+1', FALSE);
			$this->db->where('notification_id', $notification_id);
			$this->db->update("advance_notification_count");
		}else{
			$insertData=[
				'notification_id' => $notification_id,
				'date'=> $curr_date,
				'click_count'=>'1',
				'maker_id'=>'',
				'maker_date'=>$curr_date,
				'updater_id'=>'',
				'updater_date'=>$curr_date
			];
			
			if(isset($_POST['interact']) && $_POST['interact']==1){ 
				$insertData['interact_count']= '1';
			}
			
			$this->db->insert("advance_notification_count", $insertData);
		}
		
		return true;
	}
	
	
}
