<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_token_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="api_config";
    }

    public function add_APIconifg(){
        extract($_POST);
        $LOGINID=1;
        $current_date=date("Y-m-d H:i:s");
        $insertData=array(
            'title' =>$title,
            'company_code' =>$company_code,
            'api_key'=>$api_key,
            'account_key'=>$account_key,
            'token_number'=>$token_number,
            'expiry_time'=>$expiry_time,
            'maker_id'=>$LOGINID,
            'maker_date'=>$current_date,
            'updater_id'=>$LOGINID,
            'updater_date'=>$current_date
        );

            $this->db->insert($this->main_table, $insertData);
            $ID=$this->db->insert_id();
            setFlashMsg('success_message',"New Token has been generated successfully.",'alert-success');
            return true;
        }

    public function edit_APIconifg(){
        extract($_POST); 
        if(!is_numeric($ID)){
            $LOGINID=1;
            $current_date=date("Y-m-d H:i:s");
            
            $updateData=array(
                'title' =>$title,
                'company_code' =>$company_code,
                'api_key'=>$api_key,
                'account_key'=>$account_key,
                'token_number'=>$token_number,
                'expiry_time'=>$expiry_time,
                'updater_id'=>$LOGINID,
                'updater_date'=>$current_date
            );

            $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
            setFlashMsg('success_message',"New Token has been generated successfully.",'alert-success');
            return true;
        }else{
            setFlashMsg('success_message',"New Token has been not generated successfully.",'alert-danger');
            return false;
        }
    }

    public function getToken($api_key='',$account_key=''){
        $this->db->select("token_number,expiry_time");
        $this->db->from($this->main_table);
        $this->db->where("api_key",$api_key);
        $this->db->where("account_key",$account_key);
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }

    
    public function loadDataById($ID=''){
        if(!is_numeric($ID)){
            $this->db->select("MD5(ID) as ID, url,title,company_code,api_key,account_key,token_number,expiry_time");
            $this->db->from($this->main_table);
            $this->db->where("MD5(ID)",$ID);
            $this->db->where("is_deleted",0);
            $result=$this->db->get()->row();
            if($result){
                return $result;
            }else{
                return false;    
            }  
        }
        return false;
    }

}