<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_availability_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="doctor";
    }

    public function getData($is_active=''){
        $this->db->select("D.*, CONCAT(D.first_name,' ',D.middle_name,' ',D.last_name) AS name, DD.name as department_name");
        $this->db->from($this->main_table." D");
        $this->db->join("department as DD",'DD.code=D.department_code','LEFT');
        if($is_active==1)$this->db->where("D.show_status",1);
        $this->db->where("D.is_deleted",0);
        $this->db->order_by('D.ID','DESC');
        $result=$this->db->get()->result();
        //echo "<br/><pre>";print_r($result);;die();
        return $result;
    }
    function getDoctorById($id){
        $query=$this->db->get_where('doctor',array('MD5(ID)'=>$id));
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return false;
        }
        
    }
    function getdoctorlocation(){
        $query=$this->db->get('hospital_location');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
        
    }
    
    function getavailability($id){
        $query=$this->db->get_where('doctor_availability',array('MD5(doctor_id)'=>$id,'date'=>date('Y-m-d')));
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
        
    }
    
    function getavailabilitybyDocId(){
        $id=$this->input->post('docId');
        $date=$this->input->post('date');
        $query=$this->db->get_where('doctor_availability',array('doctor_id'=>$id,'date'=>date('Y-m-d',strtotime($date))));
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
        
    }
            
    function saveTime(){
        //print_r($_POST);die;
        $data=array('doctor_id'=>$this->input->post('doctorid'),
                    'doctor_mcr'=>$this->input->post('doctormcr'),
                    'hospital_location_id'=>$this->input->post('location'),
                    'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
                    'session_starttime'=>$this->input->post('fromtime'),
                    'session_endtime'=>$this->input->post('totime'),
                    'status'=>'A',
                    'show_status'=>1);
       // print_r($data);die;
        $avlid='';
        if($this->input->post('availid')){
            if($this->db->update('doctor_availability',$data,array('ID'=>$this->input->post('availid')))){
                $avlid=$this->input->post('availid');
                $msg='Updated successfully';
                $status=1;
            }else{
                $avlid=$this->input->post('availid');
                $msg='Update failed';
                $status=0;
        }
        }else{
        if($this->db->insert('doctor_availability',$data)){
                $avlid=$this->db->insert_id();
                $msg='Saved successfully';
                $status=1;
            }else{
                $avlid='';
                $msg='Save failed';
                $status=0;
        }
    }
    echo json_encode(array('status'=>1,'msg'=>$msg,'avlid'=>$avlid));
    }
    
    function removeTime(){
        $id=$this->input->post('avalableid');
        if($this->db->delete('doctor_availability',array('ID'=>$id))){
                $msg='Deleted successfully';
                $status=1;
        }else{
                $msg='Delete failed';
                $status=0;
        }
       echo json_encode(array('status'=>1,'msg'=>$msg));
    }
}


?>