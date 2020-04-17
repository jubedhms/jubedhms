<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergency_call_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="patient_emergency_calls";
    }

    public function add_emergency_call(){
        extract($_POST);
        $crr_date=date("Y-m-d H:i:s");

        $insertData=array(
                'username'=>$username,
                'date'=>$date,
                'time'=>$time,
                'latitude'=>$latitude,
                'longitude'=>$longitude,
                'maker_id'=> 1,
                'maker_date'=>$crr_date,
                'updater_id'=>1,
                'updater_date'=>$crr_date
        );

            $this->db->insert($this->main_table,$insertData);
            $ID=$this->db->insert_id();
        if($ID){    
            return $ID;
        }else{
            return false;  
        }
    }

}