<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccine_dose_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="dose_schedule";
    }
    
    function getData($is_active='', $vaccine_id=''){
        $this->db->select("VD.*");
        $this->db->from($this->main_table." as VD");
		if($vaccine_id!='')$this->db->where("VD.vaccine_id",$vaccine_id);
        if($is_active==1)$this->db->where("VD.show_status",1);
        $this->db->where("VD.is_deleted",0);
        $this->db->order_by('VD.dose_name','ASC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_vaccine_dose(){
        extract($_POST);
        $LOGINID=$this->LOGINID;
        $curr_date=date("Y-m-d H:i:s");
        
        $insertData=array(  
            'vaccine_id'=>$vaccine_id,
            'dose_name'=>$dose_name,
            'from_month'=>$from_month,
            'to_month'=>$to_month,
			'gender'=>$gender,
			'description'=>$description,
            'maker_id'=>$LOGINID,
            'maker_date'=>$curr_date,
            'updater_id'=>$LOGINID,
            'updater_date'=>$curr_date
        );

        $this->db->insert($this->main_table, $insertData);
        setFlashMsg('success_message',"Vaccine dose has been created successfully.",'alert-success');
        return true;
    }

    public function edit_vaccine_dose(){
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
  		
        $updateData=array(  
				'vaccine_id'=>$vaccine_id,
				'dose_name'=>$dose_name,
				'from_month'=>$from_month,
				'to_month'=>$to_month,
				'gender'=>$gender,
				'description'=>$description,
                'updater_id'=>$LOGINID,
                'updater_date'=>$curr_date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        setFlashMsg('success_message',"Vaccine dose has been updated successfully.",'alert-success');
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
	
    public function delete_vaccine_dose_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
 
        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end

        echo "Vaccine dose has been deleted successfully.";
        return;
    }

}