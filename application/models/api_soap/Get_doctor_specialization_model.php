<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_doctor_specialization_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="doctor";
    }

    public function add_data($response){
        $total_added=0;
        $total_updated=0;
        $current_date=date("Y-m-d H:i:s");
        if($response){

            foreach($response as $key=>$value){ 
				if($value['Code']!='' && $value['Code']!='14' && $value['Code']!='OTH'){
					$mainData=[
						'code'=>$value['Code'],
						'name'=>$value['Description'],
						'updater_id'=>1,
						'updater_date'=>$current_date
					];

					$this->db->select("ID");
					$this->db->from("doctor_specialization");
					$this->db->where("code",$value['Code']);
					$this->db->where("is_deleted",0);
					$result=$this->db->get()->row();
					if($result){
						$this->db->update('doctor_specialization', $mainData,array('ID'=>$result->ID));
						$total_updated=$total_updated+1;
					}else{
						$mainData=[
							'code'=>$value['Code'],
							'name'=>$value['Description'],
							'maker_id'=> 1,
							'maker_date'=>$current_date,
							'updater_id'=>1,
							'updater_date'=>$current_date
						];

						$this->db->insert('doctor_specialization', $mainData);
						$doctor_specialization_id=$this->db->insert_id();
						if($doctor_specialization_id!=''){
							$total_added=$total_added+1;
						} 
					}
				}
			}   
		}		
        $return_response=["total_added"=>$total_added, "total_updated"=>$total_updated];
        return $return_response;
    }





}