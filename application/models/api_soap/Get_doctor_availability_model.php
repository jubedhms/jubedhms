<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_doctor_availability_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="doctor_availability";
    }

    public function get_doctor_data(){
        $this->db->select("mcr");
        $this->db->from("doctor");
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_data($doctor_mcr='',array $response){ 
        $total_added=0;
        $total_updated=0;
        $current_date=date("Y-m-d H:i:s");
		
		// get hospital location ID via Code
		if(isset($hospital_location_code) && $hospital_location_code!=''){
            $this ->db->select('HL.ID');
            $this->db->from("hospital_location as HL");
            $this->db->where('HL.code',$hospital_location_code);
            $this->db->where('HL.is_deleted=',0);
            $this->db->where('HL.show_status=',1); 
            $result_location=$this->db->get()->row();
            if($result_location){
                $location_id=$result_location->ID;
            }else{
                return array();
            }
        }
		//end 
		
        if($doctor_mcr!='' && $response){
			foreach($response as $key=>$value){
				$isMultidimensional =(isset($value['Session']) && isset($value['Session'][0]))?true:false;
				if(!$isMultidimensional){
					$Session=["0"=>$value['Session']];  // make Multidimensional array
				}else{
					$Session=$value['Session'];
				}
				$mainData=[];
				if($Session){
					foreach($Session as $key1=>$value1){ 
						$session_starttime=(isset($value1['StartTime']) && !is_array($value1['StartTime']))?$value1['StartTime']:'';
						$session_endtime=(isset($value1['EndTime']) && !is_array($value1['StartTime']))?$value1['EndTime']:'';
						if($session_starttime!='' && $session_endtime!=''){
							$availability_date=str_replace("date_",'',$key);
							$availability_date=date('Y-m-d',strtotime($availability_date));
							$mainData=[
									'doctor_mcr' => $doctor_mcr,
									//'hospital_location_id' => '1',
									'date'=>$availability_date,
									'session_starttime' => $session_starttime,
									'session_endtime' => $session_endtime,
									'maker_id'=> 1,
									'maker_date'=>$current_date,
									'updater_id'=>1,
									'updater_date'=>$current_date
							];
							
							$this->db->insert($this->main_table, $mainData);
							$availability_id=$this->db->insert_id();
							if($availability_id!=''){
								$total_added=$total_added+1;
							}  			
						}
					}
				}
			 }
        }
		
        $return_data=["doctor_mcr"=>$doctor_mcr,"total_added"=>$total_added];
        return $return_data;
    }
	
	public function delete_doctor_availability_data($doctor_mcr=''){
		$this->db->where("doctor_mcr", $doctor_mcr);
        $this->db->delete($this->main_table);
        return;
    }
	
    public function truncate_table(){
        $this->db->truncate($this->main_table);
        return true;
    }


}