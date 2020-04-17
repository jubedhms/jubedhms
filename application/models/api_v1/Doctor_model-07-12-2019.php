<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="doctor";
    }

    public function get_data(){
        extract($_GET);
        $this ->db->select('ID as doctor_id,CONCAT(first_name," ",middle_name," ",last_name) AS name, is_available, department_code');
        $this->db->from($this->main_table);
        $this->db->where('is_deleted=',0);
        $this->db->where('show_status=',1);
        if(isset($department_code))$this->db->where("FIND_IN_SET('".$department_code."', department_code)");
        $this->db->order_by("first_name", "asc");
        $result=$this->db->get()->result();
        return $result; 
    }

    public function get_data_time_schedule(){
        extract($_GET);
        if($doctor_id!=''){
            $doctor_id=(is_numeric($doctor_id))?md5($doctor_id):$doctor_id;
            
            $this ->db->select('DATE_FORMAT(session_starttime, "%h:%i %p") as from_time');
            $this ->db->select('DATE_FORMAT(session_endtime, "%h:%i %p") as to_time');
            $this->db->from('doctor_availability');
            $this->db->where('MD5(doctor_id)',$doctor_id);
            $this->db->where('is_deleted=',0);
            $this->db->where('show_status=',1);
            if(isset($date) && $date!=''){
                $this->db->where('date',$date);
            }    
            $this->db->order_by("session_starttime", "DESC");
            $result_doctor_session=$this->db->get()->result();
            
            $this ->db->select('DATE_FORMAT(appointment_date, "%h:%i %p") as from_time');
            $this ->db->select('DATE_FORMAT(DATE_ADD(appointment_date, INTERVAL 15 MINUTE), "%h:%i %p") as to_time');
            $this->db->from('patient_appointment');
            $this->db->where('MD5(doctor_id)',$doctor_id);
            $this->db->where('is_deleted=',0);
            $this->db->where('show_status=',1);
            if(isset($date) && $date!=''){
                $this->db->where('appointment_date >=',$date.' 00:00:00');
                $this->db->where('appointment_date <=',$date.' 23:59:59');
            }    
            $this->db->order_by("appointment_date", "asc");
            $result_doctor_appointment=$this->db->get()->result();

            $result['doctor_availability']=(isset($result_doctor_session) && !empty($result_doctor_session))?$result_doctor_session:array();
            $result['booked_appointment']=(isset($result_doctor_appointment) && !empty($result_doctor_appointment))?$result_doctor_appointment:array();
        
            return  $result;
        }
    }

}