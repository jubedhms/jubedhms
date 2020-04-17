<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccine_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="vaccines";
    }
    
    function getData($is_active=''){
        //print_r($_POST);
        $this->db->select("V.*");
        $this->db->from($this->main_table." as V");
        if($is_active==1)$this->db->where("V.show_status",1);
        if($this->input->post('status')){
            $status=$this->input->post('status');
            $this->db->where("V.available_status",$status);
        }
        if($this->input->post('vaccine_code')){
            $vaccine_code=$this->input->post('vaccine_code');
            //$this->db->where("V.vaccine_code",$vaccine_code);
            $this->db->like('V.vaccine_code', $vaccine_code);
        }
        if($this->input->post('vaccine_id')){
            $vaccine_id=implode(',',json_decode($this->input->post('vaccine_id')));
            //print_r($vaccine_id);die;
            (!empty($vaccine_id))?$this->db->where_in("V.ID",$vaccine_id,false):'';
        }
        $this->db->where("V.is_deleted",0);
        $this->db->order_by('V.vaccine_name','ASC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die;
        return $result;
    }

    public function add_vaccines(){
        //print_r($_POST);die;
        extract($_POST);
        $LOGINID=$this->LOGINID;
        $curr_date=date("Y-m-d H:i:s");
        $insertDoseData=array();
        $insertData=array(  
            'vaccine_code'=>$vaccine_code,
            'vaccine_name'=>$vaccine_name,
            'vaccine_name_vi'=>isset($vaccine_name_vi)?$vaccine_name_vi:'',
            'vaccine_short_name'=>$vaccine_short_name,
            'vaccine_short_name_vi'=>isset($vaccine_short_name_vi)?$vaccine_short_name_vi:'',
            'disease_name'=>$disease_name,
            'disease_name_vi'=>isset($disease_name_vi)?$disease_name_vi:'',
            'vaccine_origin'=>$vaccine_origin,
            'vaccine_origin_vi'=> isset($vaccine_origin_vi)?$vaccine_origin_vi:'',
            'available_status'=>$available_status,
            //'patient_type'=>$patient_type,
            'is_deleted'=>0,
            'maker_id'=>$LOGINID,
            'maker_date'=>$curr_date,
        );
        $this->db->insert($this->main_table, $insertData);
        $id=$this->db->insert_id();
        if($id!='' && count($dose_name)>0){
            for($i=0;$i<count($dose_name);$i++){
                    $insertDoseData[$i]=array(
                            'vaccine_id'=>$id,
                            'dose_name'=>$dose_name[$i],
                            'dose_name_vi'=> isset($dose_name_vi[$i])?$dose_name_vi[$i]:'',
                            'from_month'=>$from_month[$i],
                            'to_month'=>$to_month[$i],
                            'gender'=>$gender[$i],
                            'is_deleted'=>0,
                            'maker_id'=>$LOGINID,
                            'maker_date'=>$curr_date,
                            );
            }
            $this->db->insert_batch("dose_schedule",$insertDoseData);
        }
        setFlashMsg('success_message',"Vaccine has been created successfully.",'alert-success');
        return true;
    }

    public function edit_vaccines(){
        extract($_POST); 
        $vaccine_id=$ID;
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
        $updateData=array(  
                'vaccine_code'=>$vaccine_code,
                'vaccine_name'=>$vaccine_name,
                'vaccine_name_vi'=>isset($vaccine_name_vi)?$vaccine_name_vi:'',
                'vaccine_short_name'=>$vaccine_short_name,
                'vaccine_short_name_vi'=>isset($vaccine_short_name_vi)?$vaccine_short_name_vi:'',
                'disease_name'=>$disease_name,
                'disease_name_vi'=>isset($disease_name_vi)?$disease_name_vi:'',
                'vaccine_origin'=>$vaccine_origin,
                'vaccine_origin_vi'=> isset($vaccine_origin_vi)?$vaccine_origin_vi:'',
                'available_status'=>$available_status,
                //'patient_type'=>$patient_type,
                'updater_id'=>$LOGINID,
                'updater_date'=>$curr_date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        for($i=0;$i<count($dose_name);$i++){
            if(isset($dose_id[$i])){
                        $updateDoseData=array(
                                            'dose_name'=>$dose_name[$i],
                                            'dose_name_vi'=> isset($dose_name_vi[$i])?$dose_name_vi[$i]:'',
                                            'from_month'=>$from_month[$i],
                                            'to_month'=>$to_month[$i],
                                            'gender'=>$gender[$i],
                                            'is_deleted'=>0,
                                            'updater_id'=>$LOGINID,
                                            'updater_date'=>$curr_date,
                                            );
                   $this->db->update("dose_schedule",$updateDoseData,array("ID"=>$dose_id[$i]));
                    }else{
                        $insertDoseData=array(
                                            'vaccine_id'=>$vaccine_id,
                                            'dose_name'=>$dose_name[$i],
                                            'dose_name_vi'=> isset($dose_name_vi[$i])?$dose_name_vi[$i]:'',
                                            'from_month'=>$from_month[$i],
                                            'to_month'=>$to_month[$i],
                                            'gender'=>$gender[$i],
                                            'is_deleted'=>0,
                                            'maker_id'=>$LOGINID,
                                            'maker_date'=>$curr_date,
                                            );
                        $this->db->insert("dose_schedule",$insertDoseData);
                    }
        }
        setFlashMsg('success_message',"Vaccine has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("V.*");
        $this->db->from($this->main_table .' as V');
        $this->db->where("MD5(V.ID)",$ID);
        $this->db->where("V.is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }
    
    public function loadVaccineDoseDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("DS.ID,DS.vaccine_id,DS.dose_name,DS.dose_name_vi,DS.from_month,DS.to_month,DS.gender");
        $this->db->from('dose_schedule as DS');
        $this->db->where("MD5(DS.vaccine_id)",$ID);
        $this->db->where("DS.is_deleted",0);
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die;
        //print_r($result);die;
        return $result;
    }
	
    public function delete_vaccine_data($IDS=''){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
        if($this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$IDS)) && $this->db->update('dose_schedule',$updateData,array('MD5(vaccine_id)'=>$IDS))){
            
        echo "Vaccine has been deleted successfully.";
        }else{
            echo "Vaccine has not been deleted.";
        }
        return;
    }
    
    public function remove_dose(){
        $id=$this->input->post('id');
        $updateData=array('is_deleted'=>1);
        if($this->db->update('dose_schedule',$updateData,array('ID'=>$id))){
            return true;
        }else{
            return false;
        }
    }

}