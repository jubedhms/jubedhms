<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="patient_feedback";
    }

    public function getData($is_active=''){
       $this->db->select("F.*,CONCAT(P.title, ' ', P.first_name, ' ', P.middle_name, ' ', P.last_name) AS name,P.contact_number,P.email_id");
        $this->db->from($this->main_table." as F");
        $this->db->join("patient as P", "P.username=F.username", "LEFT");
        if($is_active==1)$this->db->where("F.show_status",1);
        $this->db->where("F.is_deleted",0);
        $this->db->order_by('F.date','DESC');
        $result=$this->db->get()->result();
      
        return $result;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("F.*,CONCAT(P.title, ' ', P.first_name, ' ', P.middle_name, ' ', P.last_name) AS name,P.contact_number,P.email_id");
        $this->db->from($this->main_table." as F");
        $this->db->join("patient as P", "P.username=F.username", "LEFT");
        $this->db->where("MD5(F.ID)",$ID);
        $result=$this->db->get()->row();
        return $result;
    }

    public function delete_feedback_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        echo "Feedback has been deleted successfully.";
        return;
    }


}