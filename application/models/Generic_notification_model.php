<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="generic_notification";
    }
    
    function getData($is_active=''){
        $this->db->select("N.ID, N.title,N.description,N.show_status,N.updater_date,UA.user_name as editor");
        $this->db->from($this->main_table." as N");
		$this->db->join("user as UA",'UA.ID=N.updater_id','LEFT');
		if($is_active==1)$this->db->where("N.show_status",1);
        $this->db->where("N.is_deleted",0);
        $this->db->order_by('N.ID','ASC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function edit_generic_notification(){
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
  		
			$updateData=array(  
				'description'=>$description,
				'description_vi'=>$description_vi,
                'updater_id'=>$LOGINID,
                'updater_date'=>$curr_date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        setFlashMsg('success_message',"Notification has been updated successfully.",'alert-success');
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
}