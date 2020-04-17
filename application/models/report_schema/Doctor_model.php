<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
		$this->oracle_db=$this->load->database('oracle',true);//connected with oracle
		$this->db=$this->load->database('default',true);//connected with mysql
	
        $this->main_table="doctor";
    }

	public function addedit_doctor(){
        $total_add=$total_update=0;
		$result=[];
		$LOGINID=1;
        $curr_date=date("Y-m-d H:i:s");
        
		$mcr=(isset($_GET['mcr']))?$_GET['mcr']:'';
		$maker_date=(isset($_GET['maker_date']))?$_GET['maker_date']:'';
		$this->oracle_db->select("*");
		$this->oracle_db->from("NOVA_DOCTOR");
		if($mcr!='')$this->oracle_db->where("MCR_NO",$mcr);
		if($maker_date!='')$this->oracle_db->where("SYNC_DATE",$maker_date);
		$result=$this->oracle_db->get()->result();
		
		if($result){
			foreach($result as $key=>$value){
				//echo "<pre>";print_r($value);
				if($value->MCR_NO==NULL){
					continue;		// not add/edit in database
				}
				
				$mcr= $value->MCR_NO;	
				$title= ($value->TITLE!= NULL)?$value->TITLE:'';
				//$name= ($value->DOCTOR_NAME!= NULL)?$this->split_name($value->DOCTOR_NAME):'';
				$full_name= ($value->DOCTOR_NAME!= NULL)?$value->DOCTOR_NAME:'';
				$short_name= ($value->SHORT_NAME!= NULL)?$value->SHORT_NAME:'';
				$specialty_code= ($value->SPECIALTY_CODE!= NULL)?$value->SPECIALTY_CODE:'';
				$primary= ($value->PRIMARY!= NULL && $value->PRIMARY=='YES')?'1':'0';
				
				$grade= ($value->DOCTOR_GRADE_CODE!= NULL)?$value->DOCTOR_GRADE_CODE:'';
				$hospital_location_id=1;
				$default_room= ($value->DEFAULT_ROOM!= NULL)?$value->DEFAULT_ROOM:'';
				$sync_date= ($value->SYNC_DATE!= NULL)?date("Y-m-d", strtotime($value->SYNC_DATE)):'';
				$address_line1= ($value->HOME_ADDRESS!= NULL)?$value->HOME_ADDRESS:'';
				
				// for check Doctor is belong or not
				$this->db->select("ID,primary_specialty_code,specialty_code");
				$this->db->from($this->main_table);
				$this->db->where('mcr', $mcr);
				//$this->db->where("is_deleted",0);
				$doctor_row=$this->db->get()->row();
				//end
				
				$mainData=[
							'mcr'=> $mcr,	
							'title'=> $title,
							//'first_name'=>$name['first_name'],
							//'middle_name'=>$name['middle_name'],
							//'last_name'=>$name['last_name'],
							'name'=> $full_name,
							'short_name'=> $short_name,
							'primary_specialty_code'=>$specialty_code,
							//'specialty_code'=>$specialty_code,
							'grade'=> $grade,
							//'hospital_location_id'=>$hospital_location_id,
							'default_room'=> $default_room,
							'his_sync_date'	=> $sync_date,
							'updater_id'=>$LOGINID,
							'updater_date'=>$curr_date
						];	
				
				if($doctor_row && isset($doctor_row->ID) && $doctor_row->ID!=''){
					$doctor_id=$doctor_row->ID;	
					$primary_specialty_code=$doctor_row->primary_specialty_code;
					if($primary_specialty_code == $specialty_code){
						$this->db->update($this->main_table,$mainData,array("ID"=>$doctor_id));
						$total_update=$total_update+1;
					}else{
						// HIS have multi enty for same doctor behalf of multi specility then here we combine all specility for same mcr number
						$arr_specialty_code=explode(",",$doctor_row->specialty_code);
						if(!in_array($specialty_code,$arr_specialty_code)){
							if($doctor_row->specialty_code!=''){
								$specialtyData=['specialty_code'=>$doctor_row->specialty_code.",".$specialty_code];
							}else{
								$specialtyData=['specialty_code'=>$specialty_code];
							}
			
							$this->db->update($this->main_table,$specialtyData,array("ID"=>$doctor_id));
							$total_update=$total_update+1;	
						}
						// end
					}
				}else{
					$mainData['maker_id']=$LOGINID;
					$mainData['maker_date']=$curr_date;
					$this->db->insert($this->main_table,$mainData);
					$doctor_id=$this->db->insert_id();
					$total_add=$total_add+1;
				}
		
				$addressData=[
						'doctor_id'=>$doctor_id,
						'address_line1'=>$address_line1,
						'updater_id'=>$LOGINID,
						'updater_date'=>$curr_date
					];
				
				
				if($doctor_row){
					$this->db->update("doctor_address",$addressData,array("doctor_id"=>$doctor_id));
				}else{
					$mainData['maker_id']=$LOGINID;
					$mainData['maker_date']=$curr_date;
					$this->db->insert("doctor_address",$addressData);
				}
				
				$documentData=[
								'doctor_id'=>$doctor_id,
								'updater_id'=>$LOGINID,
								'updater_date'=>$curr_date
							];
							
				if($doctor_row){
					
				}else{
					$mainData['maker_id']=$LOGINID;
					$mainData['maker_date']=$curr_date;
					$this->db->insert("doctor_documents",$documentData);
				}				
			}
		}
		echo "Total Added: ".$total_add;
		echo "<br> Total update: ".$total_update;	
        return $result;
    }


	public	function split_name($name) {
		$parts = array();

		while ( strlen( trim($name)) > 0 ) {
			$name = trim($name);
			$string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
			$parts[] = $string;
			$name = trim( preg_replace('#'.$string.'#', '', $name ) );
		}

		if (empty($parts)) {
			return false;
		}

		$parts = array_reverse($parts);
		$name = array();
		$name['first_name'] = $parts[0];
		$name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
		$name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

		return $name;
	}


}