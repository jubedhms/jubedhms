<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccine_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="vaccines";
    }
    
    public function getVaccine(){
        $query=$this->db->select('ID,vaccine_name')->from($this->main_table)->where('is_deleted',0)->get();
        if($query->num_rows()>0){    
            return $query->result_array();
        }else{
            return false;  
        }
    }
    
    public function getDoseByVaccineId($vaccine_id){
        $query=$this->db->select('*')->from('dose_schedule')->where('is_deleted',0)->where('vaccine_id',$vaccine_id)->get();
        if($query->num_rows()>0){    
            return $query->result_array();
        }else{
            return false;  
        }
    }
    
    public function getpatientDOB($prn){
        $query=$this->db->select('dob')->from('patient')->where('is_deleted',0)->where('prn',$prn)->get();
        if($query->num_rows()>0){    
            return $query->row()->dob;
        }else{
            return false;  
        }
    }
    
    public function getsub_patientDOB($prn,$parentprn){
        $query=$this->db->select('dob')->from('sub_patient')->where('is_deleted',0)->where('parent_prn',$parentprn)->where('prn',$prn)->get();
        if($query->num_rows()>0){    
            return $query->row()->dob;
        }else{
            return false;  
        }
    }
    
    public function getcompletedPatientVaccine($prn){
        $query=$this->db->select('GROUP_CONCAT(dose_id) as dose_ids')->from('vaccine_appointment')->where('parent_prn',$prn)->or_where('prn',$prn)->where('is_deleted',0)->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){    
            return $query->row()->dose_ids;
        }else{
            return false;  
        }
    }
    
    public function getcompletedSubPatientVaccine($prn,$parentprn){
        $query=$this->db->select('GROUP_CONCAT(dose_id) as dose_ids')->from('vaccine_appointment')->where('is_deleted',0)->where('parent_prn',$parentprn)->where('prn',$prn)->get();
     
        if($query->num_rows()>0){    
            return $query->row()->dose_ids;
        }else{
            return false;  
        }
    }
    
    public function getRemaningDose($months,$limit){
        if($limit){
            $limit="LIMIT $limit";
        }
        $query=$this->db->query("SELECT V.ID, V.vaccine_name, D.`from_month`,D.`to_month`,D.ID as dose_id, D.dose_name FROM `hms_dose_schedule` as D "
                . "join hms_vaccines as V on V.ID=D.vaccine_id WHERE D.from_month between '$months' and '$months' OR D.to_month between '$months' and '$months' "
                . "and D.is_deleted=0 and V.is_deleted=0 $limit");
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;  
        }
    }
    
    public function getRemaningDosePRN($Ids,$months,$limit){
        if($limit){
            $limit="LIMIT $limit";
        }
        if(!$Ids){
            $Ids=0;
        }
        $query=$this->db->query("SELECT V.ID, V.vaccine_name, D.`from_month`,D.`to_month`,D.ID as dose_id, D.dose_name FROM `hms_dose_schedule` as D "
                . "join hms_vaccines as V on V.ID=D.vaccine_id WHERE (D.from_month between '$months' and '$months' OR D.to_month between '$months' and '$months') "
                . "and D.is_deleted=0 and V.is_deleted=0 $limit");
        //echo $this->db->last_query();die; AND D.ID NOT IN($Ids)
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;  
        }
    }
        
    public function getpatient($prn){
        $query=$this->db->select('P.ID,P.first_name,P.middle_name,P.last_name,P.dob,P.gender,PD.image')->from('patient as P')->join('patient_documents as PD','PD.patient_id=P.ID')->where('P.is_deleted',0)->where('P.prn',$prn)->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){    
            return $query->row();
        }else{
            return false;  
        }
    }
    
    public function getsubpatient($ID){
        $query=$this->db->select('SP.ID,SP.prn,SP.first_name,SP.middle_name,SP.last_name,SP.dob,SP.gender,SPD.image')->from('sub_patient as SP')->join('sub_patient_documents as SPD','SPD.sub_patient_id=SP.ID')->where('SP.is_deleted',0)->where('SP.parent_id',$ID)->get();
        //echo $this->db->last_query();die;
        if($query->num_rows()>0){    
            return $query->result();
        }else{
            return false;  
        }
    }

    //vaccine due days save
    function save_duedate($dataarray,$username){
        $querydata=$this->db->get_where('patient_duedates',array('username'=>$username))->row();
        if(count($querydata)>0){
             $dataupdate=array("method"=>$dataarray['method'],
                            "mperiod"=>$dataarray['mperiod'],
                            "due_date"=>$dataarray['due_date'],
                            "due_days"=>$dataarray['due_days'],
                            "last_mperiad_date"=>$dataarray['last_mperiad_date'],
                            "updater_date"=>date('Y-m-d')
                            );
                if($this->db->update('patient_duedates',$dataupdate,array('username'=>$querydata->username))){
                    return true;
                }else{
                    return false;
                }  
        }else{
                if($this->db->insert('patient_duedates',$dataarray)){
                    return true;
                }else{
                    return false;
                }
        }
    }

    function getUserDueDatedetails($username){
        $querydata=$this->db->get_where('patient_duedates',array('username'=>$username))->row();
        if(count($querydata)>0){
            return $querydata;
        } else {
            return false;    
        }
    }

    function savekick($prn,$week){
        $querydata=$this->db->get_where('patient',array('prn'=>$prn))->row();
        if(count($querydata)>0){
            $start_time=date('H:i:s');
            $end_time=date('H:i:s');
            $data=array(   "prn"=>$prn,
                           "date"=>date('Y-m-d'),
                           "week"=>$week,
                           "start_time"=>$start_time,
                           "end_time"=>$end_time,
                           "is_deleted"=>0
                           );
                if($this->db->insert('kick_counts',$data)){
                    return true;
                }else{
                    return false;
                }  
        }else{
            return false;
        }
    }
    
    function Updatekick($prn){
        $querydata=$this->db->get_where('patient',array('prn'=>$prn))->row();
        if(count($querydata)>0){
            $maxid=$this->db->select('MAX(ID) as maxid')->from('kick_counts')->where(array('date'=>date('Y-m-d'),'prn'=>$prn))->get()->row()->maxid;
            if($maxid){
                    $end_time=date('H:i:s');
                    $data=array( "end_time"=>$end_time);
                        if($this->db->update('kick_counts',$data,array('prn'=>$prn,'ID'=>$maxid))){
                            return true;
                        }else{
                            return false;
                        }
            }else{
             return false;   
            }
        }else{
            return false;
        }
    }
    function getkickData($prn){
        $querydata=$this->db->get_where('patient',array('prn'=>$prn))->row();
        if(count($querydata)>0){
                $data=$this->db->get_where('kick_counts',array('prn'=>$prn,'date'=>date('Y-m-d')))->result();
                    return $data;
                }else{
                    return false;
                }
    }
    
    
    function getkickDataBydatePRN($prn,$date,$week){
        $querydata=$this->db->get_where('patient',array('prn'=>$prn))->row();//If patient exist
        if(count($querydata)>0){
            if($date){
                $search=array(
                    'prn'=>$prn,
                    'date'=>$date,
                    'week'=>$week
                        );
            }else{
                $search=array(
                    'prn'=>$prn,
                    'week'=>$week
                        );
            }
                $data=$this->db->get_where('kick_counts',$search)->result();
                    return $data;
                }else{
                    return false;
                }
    }
    
    function getduedate($prn){
        $username=$this->db->get_where('patient',array('prn'=>$prn))->row()->username;
        $query= $this->db->get_where('patient_duedates',array('username'=>$username));
        if($query->num_rows()>0){
            return $query->row()->due_date;
        }else{
            return false;
        }
    }
    
    function allKickedDate($prn,$week){
        $due_date=$this->getduedate($prn);
        //current pregnancy duration
        $approx_pregnancy_date=date('Y-m-d',strtotime($due_date. '-280 days'));
        $this->db->select('DISTINCT(date)');  
        $this->db->from('kick_counts');  
        $this->db->where('prn',$prn);  
        $this->db->where('week',$week);  
        $this->db->where('date >',$approx_pregnancy_date); 
        $this->db->where('is_deleted',0); 
        $query=$this->db->get(); 
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }
    
}