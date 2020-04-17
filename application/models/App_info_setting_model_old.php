<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_info_setting_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="app_info_setting";
    }
	 
    public function getData(){
		$ID='1';
        $this ->db->select('*');
		$this->db->from(tblprefix($this->main_table));
		$this->db->where('ID',$ID);
		$result=$this->db->get()->row();
		return $result;
    }
	
	public function update_appsiteconfig( ){
		 extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $LOGINID=$this->LOGINID;
        $LOGINROLEID=$this->LOGINROLEID;
		$date=date("Y-m-d H:i:s");
         $updateData=array(
                        'name'=>$name,
			'contact_number'=>$contact_number,
			'emergency_contact_number'=>$emergency_contact_number,
			'fax_number'=>$fax_number,
			'email_id'=>$email_id,
 			'latitude'=>$latitude,
			'address'=>$address,
                        'map_api_key'=>$map_api_key,
			'about_us'=>$about_us,
			'terms_of_services'=>$terms_of_services,
			'gmail'=>$gmail,
 			'facebook'=>$facebook,
			'twitter'=>$twitter,
                        'maker_id'=>$LOGINID,
			'maker_date'=>$date,
                        'updater_id'=>$LOGINID,
                        'updater_date'=>$date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        setFlashMsg('success_message',"New App Info Setting has been updated successfully.",'alert-success');
        return true;
	}
	
    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("AS.*");
        $this->db->from($this->main_table." as AS");
        $this->db->where("MD5(AS.ID)",$ID);
        $result=$this->db->get()->row();
        return $result;
    }
    
   
     
}