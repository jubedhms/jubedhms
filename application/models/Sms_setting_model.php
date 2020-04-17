<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_setting_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="sms_setting";
    }

    public function getData($is_active=''){
        $this->db->select("*");
        $this->db->from($this->main_table);
        if($is_active==1)$this->db->where("show_status",1);
        $this->db->where("is_deleted",0);
        $this->db->order_by('ID','DESC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_sms_setting(){
        extract($_POST);

        if($this->checkExist($offer_name)!=true){
            $LOGINID=$this->LOGINID;
            $date=date("Y-m-d H:i:s");

            $insertData=array('name'=>$name,
                'description'=>$description,
                'maker_id'=>$LOGINID,
                'maker_date'=>$date,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date
            );

            $this->db->insert($this->main_table, $insertData);

            setFlashMsg('success_message',"SMS setting has been created successfully.",'alert-success');
            return true;
        }
    }

    public function edit_sms_setting(){
        extract($_POST); //print_r($_POST);
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $date=date("Y-m-d H:i:s");

        $updateData=array(
            'name'=>$name,
            'description'=>$description,
            'updater_id'=>$LOGINID,
            'updater_date'=>$date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        setFlashMsg('success_message',"SMS setting has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID='', $is_active=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("*");
        $this->db->from($this->main_table);
        $this->db->where("MD5(ID)",$ID);
        if($is_active==1)$this->db->where("show_status",1);
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }

    public function checkExist($name){
        //$ID=($ID!='')?$ID:$_POST['ID'];
        $name=($name!='')?$name:$_POST['name'];
        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        $this->db->where("is_deleted",0);
        if($name!='')$this->db->where("name",$name);
        $result=$this->db->get()->row();
        //echo $this->db->last_query(); print_r($result);die;
        if($result && $result->total>0){
            if($name!='')setFlashMsg('success_message',"This SMS setting has been created already.",'alert-danger');
            return true;
        }
        return false;
    }

    public function delete_sms_setting_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        echo "SMS setting has been deleted successfully.";
        return;
    }


}