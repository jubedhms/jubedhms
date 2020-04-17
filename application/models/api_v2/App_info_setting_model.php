<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_info_setting_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="app_info_setting";
    }

    public function get_app_version(){
        $this ->db->select('android_version,ios_version');
        $this->db->from($this->main_table);
        $result=$this->db->get()->row();
        return $result; 
    }

    public function get_data($language='en'){
        if($language=='vi'){
            $this ->db->select('name,contact_number,emergency_contact_number,fax_number,email_id,map_api_key,latitude,longitude,address_vi as address,about_us_vi as about_us,terms_of_services_vi as terms_of_services,gmail,facebook,twitter');
        }else{
            $this ->db->select('name,contact_number,emergency_contact_number,fax_number,email_id,map_api_key,latitude,longitude,address,about_us,terms_of_services,gmail,facebook,twitter');
        }
        
        $this->db->from($this->main_table);
        $result=$this->db->get()->row();
        return $result; 
    }

    

}