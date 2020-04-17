<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_specialization_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="doctor_specialization";
    }

    public function getData($is_active=''){
        $this->db->select("DS.*");
        $this->db->from($this->main_table." as DS");
        if($is_active==1)$this->db->where("DS.show_status",1);
        $this->db->where("DS.is_deleted",0);
        $this->db->order_by('DS.ID','ASC');
        $result=$this->db->get()->result();
        return $result;
    }
	
	public function getProfileSpecializationData($is_active=''){
        $this->db->select("*");
        $this->db->from("doctor_profile_specialization");
        if($is_active==1)$this->db->where("show_status",1);
        $this->db->where("is_deleted",0);
        $this->db->order_by('ID','ASC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_department(){
        extract($_POST);

        if($this->checkExist($name)==true){
            $LOGINID=$this->LOGINID;
            $date=date("Y-m-d H:i:s");
            
            $insertData=array('code'=>$code,
                'name'=>$name,
                'description'=>$description,
                'maker_id'=>$LOGINID,
                'maker_date'=>$date,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date
            );

            $this->db->insert($this->main_table, $insertData);
            $department_id=$this->db->insert_id();
            setFlashMsg('success_message',"New department has been created successfully.",'alert-success');
            return $department_id;
        }
    }

    public function edit_department(){
        extract($_POST); //print_r($_POST);
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $LOGINID=$this->LOGINID;
        $date=date("Y-m-d H:i:s");

        $updateData=array(
            'code'=>$code,
            'name'=>$name,
            'description'=>$description,
            'updater_id'=>$LOGINID,
            'updater_date'=>$date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        setFlashMsg('success_message',"Department has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("DS.*");
        $this->db->from($this->main_table." as DS");
        $this->db->where("MD5(DS.ID)",$ID);
        $this->db->where("DS.is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }


    public function checkExist($code){
        $code=($code!='')?$code:$_POST['code'];
        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        //$this->db->where("is_deleted",0);
        if($code!='')$this->db->where("code",$code);
        $result=$this->db->get()->row();
        if($result && $result->total>0){
            if($code!='')setFlashMsg('success_message',"This department has been registered already.",'alert-danger');
            return false;
        }
        return true;
    }

    public function delete_department_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end

        echo "department has been deleted successfully.";
        return;
    }


}