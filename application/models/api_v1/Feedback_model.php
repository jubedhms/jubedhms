<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="patient_feedback";
    }

    // public function add_feedback(){
    //     extract($_POST);
    //     $crr_date=date("Y-m-d H:i:s");

    //     $insertData=array(
    //             'username'=>$username,
    //             'date'=>$crr_date,
    //             'hospital_rate'=>$hospital_rate,
    //             'checkup_rate'=>$checkup_rate,
    //             'description'=>$description,
    //             'maker_id'=> 1,
    //             'maker_date'=>$crr_date,
    //             'updater_id'=>1,
    //             'updater_date'=>$crr_date
    //     );

    //         $this->db->insert($this->main_table,$insertData);
    //         $ID=$this->db->insert_id();
    //     if($ID){    
    //         return $ID;
    //     }else{
    //         return false;  
    //     }
    // }

    public function add_feedback(){
        extract($_POST);
        $crr_date=date("Y-m-d H:i:s");

        $insertData=array(
                'username'=>$username,
                'date'=>$crr_date,
                'waiting_time_hospital'=>$waiting_time_hospital,
                'medical_facility_equipment'=>$medical_facility_equipment,
                'friendiness_privacy'=>$friendiness_privacy,
                'quality_medical_examination'=>$quality_medical_examination,
                'overall_service_exclude_exam'=>$overall_service_exclude_exam,
                'feedback_remark'=>($feedback_remark)?$feedback_remark:'',
                'special_recommend'=>($special_recommend)?$special_recommend:'',
                'maker_id'=> 1,
                'maker_date'=>$crr_date,
                'updater_id'=>1,
                'updater_date'=>$crr_date
        );

            $this->db->insert($this->main_table,$insertData);
            $ID=$this->db->insert_id();
        if($ID){    
            return $ID;
        }else{
            return false;  
        }
    }
    
    public function add_feedback_services(){
        //print_r($_POST);die;
        extract($_POST);
        $crr_date=date("Y-m-d H:i:s");

        $insertData=array(
                'username'=>$username,
                'date'=>$crr_date,
                
                'parking_friendiness'=>isset($_POST['parking_friendiness'])?$parking_friendiness:'0',
                'parking_staff_attitude'=>isset($_POST['parking_staff_attitude'])?$parking_staff_attitude:'0',
                'parking_staff_spacous'=>isset($_POST['parking_staff_spacous'])?$parking_staff_spacous:'0',
            
                'luggage_prompt'=>isset($_POST['luggage_prompt'])?$luggage_prompt:'0',
                'luggage_attitude'=>isset($_POST['luggage_attitude'])?$luggage_attitude:'0',
                'luggage_communication'=>isset($_POST['luggage_communication'])?$luggage_communication:'0',
            
                'resaurant_quality_gfloor'=>isset($_POST['resaurant_quality_gfloor'])?$resaurant_quality_gfloor:'0',
                'resaurant_quality_1stfloor'=>isset($_POST['resaurant_quality_1stfloor'])?$resaurant_quality_1stfloor:'0',
                'resaurant_quality_inpatient'=>isset($_POST['resaurant_quality_inpatient'])?$resaurant_quality_inpatient:'0',
            
                'inpatient_cleaniness'=>isset($_POST['inpatient_cleaniness'])?$inpatient_cleaniness:'0',
                'inpatient_attitude'=>isset($_POST['inpatient_attitude'])?$inpatient_attitude:'0',
                'inpatient_privacy'=>isset($_POST['inpatient_privacy'])?$inpatient_privacy:'0',
                'maker_id'=> 1,
                'maker_date'=>$crr_date,
                'updater_id'=>1,
                'updater_date'=>$crr_date
        );
            $this->db->insert('patient_feedback_services',$insertData);
            $ID=$this->db->insert_id();
        if($ID){    
            return $ID;
        }else{
            return false;  
        }
    }

    public function add_feedback_medical_staff(){
        extract($_POST);
        $crr_date=date("Y-m-d H:i:s");
        $insertData=array(
                'username'=>$username,
                'date'=>$crr_date,
                'doctor_friendiness'=>isset($_POST['doctor_friendiness'])?$doctor_friendiness:'0',
                'doctor_understandable'=>isset($_POST['doctor_understandable'])?$doctor_understandable:'0',
                'doctor_effectiveness'=>isset($_POST['doctor_effectiveness'])?$doctor_effectiveness:'0',
                'doctor_prompt'=>isset($_POST['doctor_prompt'])?$doctor_prompt:'0',
                'nurse_attitude'=>isset($_POST['nurse_attitude'])?$nurse_attitude:'0',
                'nurse_understandable'=>isset($_POST['nurse_understandable'])?$nurse_understandable:'0',
                'nurse_skill'=>isset($_POST['nurse_skill'])?$nurse_skill:'0',
                'nurse_prompt'=>isset($_POST['nurse_prompt'])?$nurse_prompt:'0',
                'cus_service_attitude'=>isset($_POST['cus_service_attitude'])?$cus_service_attitude:'0',
                'cus_service_understandable'=>isset($_POST['cus_service_understandable'])?$cus_service_understandable:'0',
                'cus_service_prompt'=>isset($_POST['cus_service_prompt'])?$cus_service_prompt:'0',
                'call_centre_prompt'=>isset($_POST['call_centre_prompt'])?$call_centre_prompt:'0',
                'call_centre_understandable'=>isset($_POST['call_centre_understandable'])?$call_centre_understandable:'0',
                'call_centre_voice'=>isset($_POST['call_centre_voice'])?$call_centre_voice:'0',
                'pharmacist_attitude'=>isset($_POST['pharmacist_attitude'])?$pharmacist_attitude:'0',
                'pharmacist_understandable'=>isset($_POST['pharmacist_understandable'])?$pharmacist_understandable:'0',
                'pharmacist_prompt'=>isset($_POST['pharmacist_prompt'])?$pharmacist_prompt:'0',
                'maker_id'=> 1,
                'maker_date'=>$crr_date,
                'updater_id'=>1,
                'updater_date'=>$crr_date
        );
        ///print_r($insertData);die;
            $this->db->insert('patient_feedback_medical_staff',$insertData);
            //echo $this->db->last_query();die;
            $ID=$this->db->insert_id();
        if($ID){    
            return $ID;
        }else{
            return false;  
        }
    }
	
	function add_doctor_feedback(){
        extract($_POST);
        $crr_date=date("Y-m-d H:i:s");
        $date=date("Y-m-d");
        $insertData=array(
                'username'=>$username,
                'date'=>$date,
                'name'=>isset($_POST['name'])?$name:'',
                'mobile'=>isset($_POST['mobile'])?$mobile:'',
                'feedback'=>isset($_POST['feedback'])?$feedback:'',
                'doctor_mcr'=>isset($_POST['doctor_mcr'])?$doctor_mcr:'',
                'star_rating'=>isset($_POST['star_rating'])?$star_rating:'1',
                'language'=>isset($_POST['language'])?$language:'1',
                'maker_id'=> 1,
                'maker_date'=>$crr_date,
                'updater_id'=>1,
                'updater_date'=>$crr_date
        );
        //print_r($insertData);die;
            $this->db->insert('doctor_feedbacks',$insertData);
            //echo $this->db->last_query();die;
            $ID=$this->db->insert_id();
        if($ID){    
            return $ID;
        }else{
            return false;  
        }
    }
    
    function get_doctor_feedback($doctor_mcr){
        //$query=$this->db->get_where('doctor_feedbacks',array('doctor_mcr'=>$doctor_mcr));
        //$query=$this->db->select('ID,username,name,mobile,feedback,doctor_mcr,star_rating,date')->from('doctor_feedbacks')->where('doctor_mcr',$doctor_mcr)->get();
        $query=$this->db->select('name,feedback,date')->from('doctor_feedbacks')->where('doctor_mcr',$doctor_mcr)->get();
        if($query->num_rows()>0){    
            return $query->result();
        }else{
            return false;  
        }
    }
        

    
}