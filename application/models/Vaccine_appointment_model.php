<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccine_appointment_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="vaccine_appointment";
    }

    public function getData($is_active='',$prn='',$doctor_mcr=''){
        $curr_date=date("Y-m-d");
        //get data which is schedule for current date
        //$this->db->select("*");
        $this->db->select("VA.ID,VA.booking_date,VA.booking_time,VA.appointment_date,VA.appointment_time,D.show_status, DS.name as doctor_speciality_name,D.name AS doctor_name,CONCAT(P.first_name,' ',P.middle_name,' ',P.last_name) AS patient_name,CONCAT(SP.first_name,' ',SP.middle_name,' ',SP.last_name) AS sub_patient_name,VA.is_deleted");
        $this->db->from($this->main_table." as VA");
        $this->db->join("doctor_specialization as DS",'DS.code=VA.doctor_speciality_code','LEFT');
        $this->db->join("doctor as D",'D.mcr=VA.doctor_mcr','LEFT');
        $this->db->join("patient as P",'P.prn=VA.prn','LEFT');
        //$this->db->join("patient as PP",'PP.prn=VA.parent_prn','LEFT');
        $this->db->join("sub_patient as SP",'SP.prn=VA.prn','LEFT');
		$this->db->where("VA.appointment_date",$curr_date);
        if($prn!=''){
			$this->db->group_start();
            $this->db->where("MD5(VA.prn)",$prn);
            $this->db->or_where("MD5(VA.parent_prn)",$prn);
			$this->db->group_end();
        }
        if($doctor_mcr!=''){
            $this->db->where("MD5(VA.doctor_mcr)",$doctor_mcr);
        }
        
        //$this->db->where("VA.is_deleted",0);
        $this->db->order_by('VA.appointment_time','ASC');
        $result1=$this->db->get()->result();
        //end

        //get data which is not schedule for current date
        $this->db->select("VA.ID,VA.booking_date,VA.booking_time,VA.appointment_date,VA.appointment_time,D.show_status, DS.name as doctor_speciality_name,D.name AS doctor_name,CONCAT(P.first_name,' ',P.middle_name,' ',P.last_name) AS patient_name,CONCAT(SP.first_name,' ',SP.middle_name,' ',SP.last_name) AS sub_patient_name,VA.is_deleted");
        $this->db->from($this->main_table." as VA");
        $this->db->join("doctor_specialization as DS",'DS.code=VA.doctor_speciality_code','LEFT');
        $this->db->join("doctor as D",'D.mcr=VA.doctor_mcr','LEFT');
        $this->db->join("patient as P",'P.prn=VA.prn','LEFT');
        //$this->db->join("patient as PP",'PP.prn=VA.parent_prn','LEFT');
        $this->db->join("sub_patient as SP",'SP.prn=VA.prn','LEFT');
        $this->db->where("VA.appointment_date !=",$curr_date);
        if($prn!=''){
			$this->db->group_start();
            $this->db->where("MD5(VA.prn)",$prn);
            $this->db->or_where("MD5(VA.parent_prn)",$prn);
			$this->db->group_end();
        }
        if($doctor_mcr!=''){
            $this->db->where("MD5(VA.doctor_mcr)",$doctor_mcr);
        }

        //$this->db->where("VA.is_deleted",0);
        $this->db->order_by('VA.appointment_date','DESC');
        $result2=$this->db->get()->result();
        // end
       
        $result=($result1 && $result2)?array_merge($result1, $result2):(($result1)?$result1:$result2);
		//echo '<pre>';print_r($result);die();
        return $result;
		
		
		
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("VA.*");
        $this->db->from($this->main_table." as VA");
        $this->db->where("MD5(VA.ID)",$ID);
        //$this->db->where("VA.is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }
	
}
