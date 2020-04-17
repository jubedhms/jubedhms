<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="doctor";
		$this->oracle_db=$this->load->database('oracle',true); //connected with oracle
		$this->db=$this->load->database('default',true); //connected with mysql
    }

    public function get_data(){
        extract($_GET);
        $this->db->select("D.mcr as doctor_mcr, D.name, D.primary_specialty_code, DS.name as primary_specialty_name,D.image");
        $this->db->from($this->main_table." as D");
        $this->db->join("doctor_specialization as DS", "DS.code=D.primary_specialty_code", "LEFT");
		if(isset($doctor_name) && $doctor_name!='')$this->db->like("D.name",$doctor_name);
		
		if(isset($speciality_code) && $speciality_code!='')$this->db->where("DS.code",$speciality_code);
        $this->db->where("D.show_status",1);
		$this->db->where("D.is_deleted",0);
		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->order_by("D.updater_date", "DESC");
        $result=$this->db->get()->result();
		
        return $result;
    }

    public function loadDataById($doctor_mcr='',$language='en'){
        //$this->db->select("D.ID as doctor_id,D.mcr as doctor_mcr,IF(D.title='Other',CONCAT(D.title_other,' ',D.name),CONCAT(D.title,' ',D.name)) as name,IF(D.position='Other',D.position_other,D.position) as position,D.image,D.primary_specialty_code,DS.name as primary_specialty_name,D.specialty_code,D.professional_exp_year as professional_experience");
		if($language=='vi'){
			$this->db->select("D.description_vi as profile_description,D.ID as doctor_id,D.mcr as doctor_mcr,IF(D.title_vi='Other',D.title_other_vi,D.title_vi) as title,D.name as name,IF(D.position_vi='Other',D.position_other_vi,D.position_vi) as position,D.image,D.primary_specialty_code,DS.name_vi as primary_specialty_name,D.specialty_code,D.professional_exp_year as professional_experience");
		}else{
			$this->db->select("D.description as profile_description,D.ID as doctor_id,D.mcr as doctor_mcr,IF(D.title='Other',D.title_other,D.title) as title,D.name as name,IF(D.position='Other',D.position_other,D.position) as position,D.image,D.primary_specialty_code,DS.name as primary_specialty_name,D.specialty_code,D.professional_exp_year as professional_experience");
		}
		
        $this->db->select("HL.code as hospital_location_code,HL.name as hospital_location_name");
        $this->db->from($this->main_table." as D");
        $this->db->join("hospital_location as HL", "HL.ID=D.hospital_location_id", "LEFT");
        $this->db->join("doctor_specialization as DS", "DS.code=D.primary_specialty_code", "LEFT");
        $this->db->where("D.mcr",$doctor_mcr);
		$this->db->where("D.show_status",1);
        $this->db->where("D.is_deleted",0);
        $result=$this->db->get()->row();
        $result_education[]=array();
        $result_experience[]=array();
        if($result){
            if($language=='vi'){
				$this->db->select("from_year,to_year,description_vi as description");
			}else{
				$this->db->select("from_year,to_year,description");
			}
            $this->db->from("doctor_experience");
            $this->db->where("doctor_id",$result->doctor_id);
            $this->db->where("is_deleted",0);
            $result_experience=$this->db->get()->result();
            
            if($language=='vi'){
				$this->db->select("from_year,to_year,description_vi as description");
			}else{
				$this->db->select("from_year,to_year,description");
			}
            $this->db->from("doctor_education");
            $this->db->where("doctor_id",$result->doctor_id);
            $this->db->where("is_deleted",0);
            $result_education=$this->db->get()->result();

            if($language=='vi'){
				$this->db->select("from_year,to_year,description_vi as description");
			}else{
				$this->db->select("from_year,to_year,description");
			}
            $this->db->from("doctor_others_certificate_awards");
            $this->db->where("doctor_id",$result->doctor_id);
            $this->db->where("is_deleted",0);
            $result_certificate_awards=$this->db->get()->result();
            
            $result->educations=$result_education;
            $result->experiences=$result_experience;
            $result->certificate_awards=$result_certificate_awards;
            
            unset($result->doctor_id);
        }
        
        return $result;
    }

    public function get_select_box($name=[]){
        extract($_GET);
		
        $this ->db->select('D.mcr as doctor_mcr, D.name');
        $this->db->from($this->main_table." as D");

        if(isset($speciality_code) && $speciality_code!=''){
			$this->db->group_start();
            $this->db->where("FIND_IN_SET('".$speciality_code."', D.specialty_code)");
            $this->db->or_where("D.primary_specialty_code",$speciality_code);
			$this->db->group_end();
        }
		if(!empty($name))$this->db->where_in("IF(D.title!='',IF(D.title='Other',CONCAT(D.title_other,' ',D.name),CONCAT(D.title,' ',D.name)),D.name)",$name);
		$this->db->where('D.show_status=',1);
        $this->db->where('D.is_deleted=',0);
       
        $this->db->group_by("D.mcr");
		$this->db->order_by("D.name", "asc");
        $result=$this->db->get()->result();
		
        return $result; 
    }
    
	public function get_doctor_data($name=''){
		//echo $name; die;
        extract($_GET);
        $this ->db->select('D.mcr as doctor_mcr, D.name, D.image as image_src, DS.name as speciality_name, D.level, "4" as ranking');
		$this->db->from($this->main_table." as D");
		$this->db->join("doctor_specialization as DS", "DS.code=D.primary_specialty_code", "LEFT");
        
        if(isset($speciality_code) && $speciality_code!=''){
			$this->db->group_start();
            $this->db->where("FIND_IN_SET('".$speciality_code."', D.specialty_code)");
            $this->db->or_where("D.primary_specialty_code",$speciality_code);
			$this->db->group_end();
        }
		if($name!='')$this->db->where_in("IF(D.title!='',IF(D.title='Other',CONCAT(D.title_other,' ',D.name),CONCAT(D.title,' ',D.name)),D.name)",$name);
		$this->db->where('D.show_status=',1);
        $this->db->where('D.is_deleted=',0);
       
        $this->db->group_by("D.mcr");
		$this->db->order_by("D.name", "asc");
        $result=$this->db->get()->row();
		//echo "<pre>";print_r($result);die;
        return $result; 
    }
	
	public function room_location($hospital_location_code='',$roomCode=''){
		$this ->db->select('room_code as code,room_name as name');
        $this->db->from("hospital_room_location");
		if($hospital_location_code!='')$this->db->where('hospital_location_code',$hospital_location_code);
		if($roomCode!='')$this->db->where('room_code',$roomCode);
		$this->db->where('show_status',1);
        $this->db->where('is_deleted',0);
       
        $this->db->group_by("room_code");
		$this->db->order_by("room_name", "asc");
        $result=$this->db->get()->result();
        return $result;
	}
	
    public function get_data_time_schedule(){ 
        extract($_GET);
        $doctor_availability=[];
		$crr_date=date("Y-m-d");
        $crr_time=date("H:i:s");
		
		// get hospital location ID via Code
		if(isset($hospital_location_code) && $hospital_location_code!=''){
            $this ->db->select('HL.ID');
            $this->db->from("hospital_location as HL");
            $this->db->where('HL.code',$hospital_location_code);
            $this->db->where('HL.is_deleted=',0);
            $this->db->where('HL.show_status=',1); 
            $result_location=$this->db->get()->row();
            if($result_location){
                $location_id=$result_location->ID;
            }else{
                return array();
            }
        }
		//end 
		
		//echo date('d-M-y',strtotime($date));die;
		// get booked doctor appointment
		$this->oracle_db->select("APPOINTMENT_TIME as appointment_time");
		$this->oracle_db->from("NOVA_PATIENT_APPOINTMENT");
		$this->oracle_db->where("APPOINTMENT_DATE",date('d-M-y',strtotime($date)));
		$this->oracle_db->where('MCR',$doctor_mcr);
		@$resultBookAappointmentHIS=$this->oracle_db->get()->result();	
		
		//echo "<pre>";print_r($resultBookAappointmentHIS);die;
		
		$this ->db->select('appointment_time');
		$this->db->from('doctor_appointment');
		$this->db->where('doctor_mcr',$doctor_mcr);
		$this->db->where('is_deleted=','0');
		$this->db->where('show_status=','1');
		
		if(isset($hospital_location_code) && $hospital_location_code!=''){
			//$this->db->where('hospital_location_id=',$location_id);
		}
		
		if(isset($date) && $date!=''){
			$this->db->where('appointment_date',$date);
		}    
		$this->db->order_by("appointment_date", "asc");
		$resultDoctorAppointment=$this->db->get()->result();
		//end 
		
		// get booked vaccine appointment
		$this ->db->select('appointment_time');
		$this->db->from('vaccine_appointment');
		$this->db->where('doctor_mcr',$doctor_mcr);
		$this->db->where('is_deleted=','0');
		$this->db->where('show_status=','1');
		
		if(isset($hospital_location_code) && $hospital_location_code!=''){
			//$this->db->where('hospital_location_id=',$location_id);
		}
		
		if(isset($date) && $date!=''){
			$this->db->where('appointment_date',$date);
		}    
		$this->db->order_by("appointment_date", "asc");
		$resultVaccineAppointment=$this->db->get()->result();
		// end
		
		// merge HIS booked appointment, HMS doctor booked appointment and vaccine booked appointment
		$resultBookAappointmentHMS=($resultDoctorAppointment && $resultVaccineAppointment)?array_merge($resultDoctorAppointment,$resultVaccineAppointment):(($resultDoctorAppointment)?$resultDoctorAppointment:$resultVaccineAppointment);
		
		$resultBookAappointment=($resultBookAappointmentHIS && $resultBookAappointmentHMS)?array_merge($resultBookAappointmentHIS,$resultBookAappointmentHMS):(($resultBookAappointmentHIS)?$resultBookAappointmentHIS:$resultBookAappointmentHMS);
		//end
		
		
		// get doctor availability time
        if($doctor_mcr!=''){ 
            $this ->db->select('session_starttime,session_endtime');
            $this->db->from('doctor_availability');
            $this->db->where('doctor_mcr',$doctor_mcr);
            $this->db->where('is_deleted=','0');
            $this->db->where('show_status=','1');
            
			if(isset($hospital_location_code) && $hospital_location_code!=''){
				//$this->db->where('hospital_location_id=',$location_id);
			}
			
			if(isset($date) && $date!=''){
                $this->db->where('date',$date);
            }    
            $this->db->order_by("session_starttime", "ASC");
            $result_doctor_session=$this->db->get()->result();
			//echo "<pre>";print_r($result_doctor_session);die;
			
			if($result_doctor_session){
				$key=0;
				foreach($result_doctor_session as $value){
					$start=strtotime($value->session_starttime);
					$end=strtotime($value->session_endtime);
					for ($i=$start;$i<=$end;$i = $i + 5*60)
					{
						// for today if current time is greater then availabe time
						/*if($crr_date<=$date && $i<$crr_time ){
							continue;
						}*/
						//end
						
						$status="available";
						// filter booked time	
						if($resultBookAappointment){
							foreach($resultBookAappointment as $value){
								$appointment_time=strtotime($value->appointment_time);	
								if($appointment_time==$i){
									$status="booked";		
								}		
							}
						}
						//end
						
						$from_time=date('h:i A',$i);
						$to_time=date('h:i A',$i+ 300); // add 5 minutes
						$doctor_availability[$key]=['from_time'=>$from_time,'to_time'=>$to_time,'status'=>$status];
						$key++;
					}		
				}
			}
        }
		//end
		
		return  $doctor_availability;
    }
	
	


}