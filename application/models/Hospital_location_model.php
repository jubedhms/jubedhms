<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital_location_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="hospital_location";
    }
    
    function getData($is_active=''){
        $this->db->select("HL.*,C.name as country_name");
        $this->db->from($this->main_table." as HL");
        $this->db->join("countries as C",'C.country_code1=HL.country_code','LEFT');
        if($is_active==1)$this->db->where("HL.show_status",1);
        $this->db->where("HL.is_deleted",0);
        $this->db->order_by('HL.name','ASC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_hospital_location(){
        extract($_POST);
        $LOGINID=$this->LOGINID;
        $curr_date=date("Y-m-d H:i:s");
        
        $insertData=array(  
            'name'=>$name,
            'code'=>$code,
            'country_code'=>$country_code,
            'description'=>$description,
            'maker_id'=>$LOGINID,
            'maker_date'=>$curr_date,
            'updater_id'=>$LOGINID,
            'updater_date'=>$curr_date
        );

        $this->db->insert($this->main_table, $insertData);
        setFlashMsg('success_message',"Hospital Location has been created successfully.",'alert-success');
        return true;
    }

    public function edit_hospital_location(){
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
  		
        $updateData=array(  
                'name'=>$name,
                'code'=>$code,
                'country_code'=>$country_code,
                'description'=>$description,
                'updater_id'=>$LOGINID,
                'updater_date'=>$curr_date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
		$this->db->update("hospital_room_location",["hospital_location_code"=>$code],array('MD5(hospital_location_id)'=>$ID));
        
		setFlashMsg('success_message',"Hospital Location has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("*");
        $this->db->from($this->main_table);
        $this->db->where("MD5(ID)",$ID);
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }
	
    public function delete_hospital_location_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
 
        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end

        echo "Hospital Location has been deleted successfully.";
        return;
    }

}