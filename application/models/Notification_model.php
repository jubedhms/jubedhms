<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="notification";
    }
    
    function getData($is_active=''){
        $this->db->select("N.ID, N.title, N.customer_group, N.notification_page_start_date as from_date,N.notification_page_end_date as to_date,N.is_read,N.is_delivered,N.show_status,N.maker_date,N.updater_date,UA.user_name as author,UA.team");
        $this->db->from($this->main_table." as N");
		$this->db->join("user as UA",'UA.ID=N.maker_id','LEFT');
		$this->db->where("N.module_name","notification");
        if($is_active==1)$this->db->where("N.module_nameshow_status",1);
        $this->db->where("N.is_deleted",0);
        $this->db->order_by('N.ID','DESC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_notification(){
        extract($_POST);
        $LOGINID=$this->LOGINID;
        $curr_date=date("Y-m-d H:i:s");
        
        $insertData=array(  
            'module_name'=> 'notification',
            'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
			'title'=>$title,
            'notification_page'=> '1',
			'notification_page_start_date'=>$from_date,
			'notification_page_start_time'=> '00:00:00',
			'notification_page_end_date'=>$to_date,
			'notification_page_end_time'=> '23:59:59',
            'description'=>$description,
            'show_status'=>'0',
            'maker_id'=>$LOGINID,
            'maker_date'=>$curr_date,
            'updater_id'=>$LOGINID,
            'updater_date'=>$curr_date
        );

        $this->db->insert($this->main_table, $insertData);
        setFlashMsg('success_message',"Notification has been created successfully.",'alert-success');
        return true;
    }

    public function edit_notification(){
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
  		
			$updateData=array(  
				'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
				'title'=>$title,
				'notification_page'=> '1',
				'notification_page_start_date'=>$from_date,
				'notification_page_start_time'=> '00:00:00',
				'notification_page_end_date'=>$to_date,
				'notification_page_end_time'=> '23:59:59',
                'description'=>$description,
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
		$this->db->where('module_name','notification');
        $this->db->where("MD5(ID)",$ID);
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }
	
    public function delete_notification_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
 
        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
		$this->db->where('module_name', 'notification');
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end

        echo "Notification has been deleted successfully.";
        return;
    }

}