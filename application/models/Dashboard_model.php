<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
		$this->main_table=tblprefix("user");
    }


    function getLast30DaysRecord(){
        $this->db->select('count(ID) as patientCount')->from('patient');
        $this->db->where('maker_date >=',date('Y-m-d',strtotime(date('Y-m-d'). '-30 days')));
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCount;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }
    function getTotalInstallatiionRecord(){
        $this->db->select('count(ID) as patientCount')->from('patient');
        //$this->db->where('maker_date >=',date('Y-m-d',strtotime(date('Y-m-d'). '-30 days')));
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCount;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }

    // For App info total active record   
    function getTotalRecord(){
        $this->db->select('count(ID) as patientCount')->from('patient');
        $this->db->where('maker_date >=',date('Y-m-d',strtotime(date('Y-m-d'). '-30 days')));
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCount;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }
    
    // For App info daily active record    
    function getDailyActiveRecord(){
        $this->db->select('count(ID) as patientCount')->from('patient');
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCount;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }

    // For App info weekly active record   
    function getWeeklyActiveRecord(){
        $this->db->select('count(ID) as patientCountWeekly')->from('patient');
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCountWeekly;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }

    // For App info weekly active Android record   
    function getWeeklyActiveRecordAndroid($start,$end){
        $this->db->select('count(ID) as patientCount')->from('patient');
        $this->db->where('maker_date >=',"$start");
        $this->db->where('maker_date <=',"$end");
        $this->db->where('device_type','1');
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCount;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }
    
    // For App info weekly active IOS record   
    function getWeeklyActiveRecordIOS($start,$end){
        $this->db->select('count(ID) as patientCount')->from('patient');
        $this->db->where('maker_date >=',"$start");
        $this->db->where('maker_date <=',"$end");
        $this->db->where('device_type','2');
        $this->db->where('is_deleted','0');
        $patientCount=$this->db->get()->row()->patientCount;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }
    
    function getMindate(){
        $Mdate=$this->db->select('MIN(maker_date) as mindate')->from('patient')->get()->row()->mindate;
        return $Mdate;
    }
    
    // For App info month installation   
    function monthwiseInst($start,$end){
        $this->db->select('count(ID) as patientCountmonthly')->from('patient');
        $this->db->where('is_deleted','0');
        $this->db->where('maker_date >=',$start);
        $this->db->where('maker_date <=',$end);
        $patientCount=$this->db->get()->row()->patientCountmonthly;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }

    // For App info daily installation 
    function dailywiseInst($date){
        $this->db->select('count(ID) as patientCountdaily')->from('patient');
        $this->db->where('is_deleted','0');
        $this->db->where('maker_date',$date);
        $patientCount=$this->db->get()->row()->patientCountdaily;
        if($patientCount>0){
            return $patientCount;
        }else{
            return 0;
        }
    }

    // For Booking Performance Department chart
    function getdepartment(){
        $this->db->select('ID,code,name');
        $this->db->from('hms_doctor_specialization');
        $this->db->where('is_deleted',0);
        $result=$this->db->get()->result();
        return $result;
    }

    function booking_performance($dcode){
        $weekdays=explode('/',$this->input->post('week'));
        $start=$weekdays[0];
        $end=$weekdays[1];
        $this->db->select('count(PA.doctor_speciality_code) as count');
        $this->db->from('doctor_appointment as PA');
        $this->db->where('PA.is_deleted',0);
        $this->db->where('PA.doctor_speciality_code',$dcode);
        $this->db->where('PA.appointment_date >=',$start);
        $this->db->where('PA.appointment_date <=',$end);
        $result=$this->db->get()->row();
        if($result && $result->count>0){
            return $result->count;
        }else{
            return 0;
        }
        
    }
    //end
    
    // For Booking Performance location  chart
    function getlocation_info_ajax($month=''){
        $from_date=date('Y').'-'.$month.'-01';
        $to_date=date('Y').'-'.$month.'-31';
		
        $this ->db->select('HP.ID,HP.name as location_name');
        $this->db->from("hospital_location as HP");
		$this->db->where('is_deleted','0');
        $result=$this->db->get()->result();
		if($result){
			foreach($result as $value){
				$total=0;
				$this->db->from("doctor_appointment PA");
				$this->db->where('PA.hospital_location_id',$value->ID);
				$this ->db->where('PA.appointment_date >=',$from_date);
				$this ->db->where('PA.appointment_date <=',$to_date);
				$this->db->where('PA.is_deleted','0');
				$total_doctor_appointment=$this->db->get()->num_rows();
				
				$this->db->from("vaccine_appointment VA");
				$this->db->where('VA.hospital_location_id',$value->ID);
				$this ->db->where('VA.appointment_date >=',$from_date);
				$this ->db->where('VA.appointment_date <=',$to_date);
				$this->db->where('VA.is_deleted','0');
				$total_vaccine_appointment=$this->db->get()->num_rows();
				
				if($total_doctor_appointment){
					$total=$total+$total_doctor_appointment;
				}
				
				if($total_vaccine_appointment){
					$total=$total+$total_vaccine_appointment;
				}
				
				$value->total_appointment=$total;
			}
		}
        return $result;
    }
    // end

    // for patient info user gender chart
    function patient_profile_info(){
        $query=$this->db->select('gender,count(gender) as gender_count')->from('patient')->where('is_deleted','0')->group_by('gender')->get();
        //print_r($query);die;
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    // for patient info user gender excel
    function patient_profile_infoExcel(){
        $query=$this->db->select('P.prn,P.first_name,P.middle_name,P.last_name,P.username,P.email_id,P.contact_number,P.gender,P.dob,P.marital_status,P.religious,P.weight,P.height,P.emergency_contact,P.patient_group,P.blood_group,P.maker_date,P.default_language,P.glucose,P.heart_rate,P.blood_pressure,PA.address_line1,PA.address_line2,PA.ward,PA.street,C.name as country,PR.name as province,CTY.name as city,D.name as district,PA.district_other')->from('patient as P')->join('patient_address as PA','PA.patient_id=P.ID', 'left')->join('countries as C','PA.country_code=C.ID', 'left')->join('districts as D','PA.district_code=D.ID', 'left')->join('provinces as PR','PA.province_code=PR.ID', 'left')->join('cities as CTY','PA.city_code=CTY.ID', 'left')->where('P.is_deleted','0')->get();
        //print_r($query->result());die;
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    
    // for sub patient info user gender chart
    function subpatient_profile_info(){
        $query=$this->db->select('gender,count(gender) as gender_count')->from('sub_patient')->where('is_deleted','0')->group_by('gender')->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    // for sub patient info user gender excel
    function subpatient_profile_infoExcel(){
        $query=$this->db->select('prn,parent_prn,parent_relation,first_name,middle_name,last_name,username,email_id,contact_number,gender,dob,marital_status,religious,weight,height')->from('sub_patient')->where('is_deleted','0')->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    // for patient info patient categories group chart
    function patient_group_info(){
        $query=$this->db->select('patient_group,count(patient_group) as count_patient_group ')->from('patient')->where('is_deleted','0')->group_by('patient_group')->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    // for patient info patient age group chart
    function user_age_group($age1,$age2){
                $this->db->select('count(dob) as dob')->from('patient');
                $this->db->where("dob BETWEEN '$age2' AND '$age1'");
                $this->db->where('is_deleted','0');
                $dob=$this->db->get()->row()->dob;
                if($dob>0){
                   return $dob;
               }else{
                   return false;
               }
    }
    
    function user_age_group2($age1){
                $this->db->select('count(dob) as dob')->from('patient');
                $this->db->where('dob <=',"$age1");
                $this->db->where('is_deleted','0');
                $dob=$this->db->get()->row()->dob;
                if($dob>0){
                    return $dob;
                }else{
                    return false;
                }
    }

}