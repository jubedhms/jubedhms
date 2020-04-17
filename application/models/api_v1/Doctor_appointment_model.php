<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_appointment_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="doctor_appointment";
    }

    public function get_data($prn){
        extract($_GET);
        if($prn!=''){
            $this ->db->select('PA.prn,PA.parent_prn,PA.ID as appointment_id,PA.his_appointment_number,PA.appointment_type_id');
            $this ->db->select('IF(D.title="Other",D.title_other,D.title) as doctor_title,D.name AS doctor_name,DS.name as doctor_specialization_name');
            $this ->db->select('PA.booking_date,PA.booking_time,PA.appointment_date,PA.appointment_time, PA.description,PA.is_deleted');
            $this->db->from($this->main_table." as PA");
            $this->db->join("doctor as D",'D.mcr=PA.doctor_mcr','LEFT');
            $this->db->join("doctor_specialization as DS",'DS.code=PA.doctor_speciality_code','LEFT');
            
            if(isset($is_parent) && $is_parent==true){ 
				$this->db->group_start();
				$this->db->where('PA.prn',$prn);
                $this->db->or_where('PA.parent_prn',$prn);
				$this->db->group_end();
            }else{
				$this->db->where('PA.prn',$prn);
			}
			
            if(isset($from_date) && $from_date!='')$this->db->where('PA.appointment_date >=',$from_date);
            if(isset($to_date) && $to_date!='')$this->db->where('PA.appointment_date <=',$to_date);
            if(isset($is_deleted) && $is_deleted==false)$this->db->where('PA.is_deleted=',0);

            if(isset($limit) && $limit!='' && isset($start) && $start!=''){
                $this->db->limit($limit, $start);
            }

            $this->db->order_by("PA.appointment_date DESC,PA.appointment_time ASC");
            $result=$this->db->get()->result();
            if($result){
                foreach($result as $value){
                    // get name image src for sub patient
                   if($value->parent_prn!=''){    
                        $this->db->select('CONCAT(SP.first_name," ",SP.middle_name," ",SP.last_name) AS patient_name,SP.gender,SP.dob,SPD.image as patient_image');
                        $this->db->from("sub_patient as SP");
                        $this->db->join("sub_patient_documents as SPD",'SPD.sub_patient_id=SP.ID','LEFT');
                        $this->db->where('SP.prn',$value->prn);
                        $row=$this->db->get()->row();
						//return $this->db->last_query();
                        $patient_name=($row)?$row->patient_name:"";
                        $patient_image=($row)?$row->patient_image:"";
						$gender=($row)?$row->gender:""; 
						$dob=($row)?$row->dob:""; 
                        $is_sub_patient=1;
                    }else{
						$this->db->select('CONCAT(P.first_name," ",P.middle_name," ",P.last_name) AS patient_name,P.gender,P.dob,PD.image as patient_image');
						$this->db->from("patient as P");
						$this->db->join("patient_documents as PD",'PD.patient_id=P.ID','LEFT');
						$this->db->where('P.prn',$value->prn);
						$row=$this->db->get()->row();
						$patient_name=($row)?$row->patient_name:"";
						$patient_image=($row)?$row->patient_image:""; 
						$gender=($row)?$row->gender:""; 
						$dob=($row)?$row->dob:""; 
						$is_sub_patient=0;
					}
                    //end

                    $response[]=[
                        "appointment_id" => $value->appointment_id,
						"his_appointment_number"=>$value->his_appointment_number,
                        "appointment_type_id"=> $value->appointment_type_id,
                        "patient_name"=> $patient_name,
                        "patient_image"=> $patient_image,
						"patient_gender"=> $gender,
						"patient_dob"=> $dob,
                        "doctor_name"=> ($value->doctor_title!='')?$value->doctor_title." ".$value->doctor_name:$value->doctor_name,
                        "doctor_specialization_name"=> $value->doctor_specialization_name,
                        "booking_date"=> $value->booking_date,
                        "booking_time"=> $value->booking_time,
                        "appointment_date"=> $value->appointment_date,
                        "appointment_time"=> $value->appointment_time,
                        "description"=> $value->description,
                        "is_sub_patient" =>$is_sub_patient,
                        "is_canceled"=> $value->is_deleted
                    ];
                 }
            }else{
                $response=array();
            } 
             
            //return $this->db->last_query();
            return $response; 
        }
    }

    public function add_appointment(){
        extract($_POST);
        $crr_datetime=date("Y-m-d H:i:s");
        $crr_date=date("Y-m-d");
        $crr_time=date("H:i:s");

        if(isset($parent_prn) && $parent_prn!=''){
            // check parent user is existing or not
            if($this->checkParentExist($parent_prn)!=true){
                return false;
            }
            //end      
        }else{
            $parent_prn='';
        }
		
		$patient_id=$main_username=$parent_username=$username="";
		
		$this->db->select("ID,username");
		$this->db->from("patient");
		$this->db->group_start();
		$this->db->where("prn",$prn);
		$this->db->or_where("prn",$parent_prn);
		$this->db->group_end();
		$patient_result=$this->db->get()->row();
		if($patient_result){
			$patient_id=$patient_result->ID;
			$main_username=$patient_result->username;
			$username=$main_username;	
		}
		
		$this->db->select("ID,username");
		$this->db->from("sub_patient");
		$this->db->where("prn",$prn);
		$sub_patient_result=$this->db->get()->row();
		if($sub_patient_result){
			//$patient_id=$sub_patient_result->ID;
			$parent_username=$username;
			$username=$sub_patient_result->username;		
		}
		
		$this->db->select("ID");
		$this->db->from("hospital_location");
		$this->db->where("code",$hospital_location_code);
		$hospital_result=$this->db->get()->row();
		if($hospital_result){
			$hospital_location_id=$hospital_result->ID;
		}else{
			return false;
		}

        $insertData=array(
				'his_appointment_number'=>$his_appointment_number,
				'his_slot_number'=>$slot_number,
                'prn'=>$prn,
                'parent_prn'=>$parent_prn,
                'appointment_type_id'=>$appointment_type_id,
                'hospital_location_id'=>$hospital_location_id,
                'doctor_speciality_code'=>$doctor_speciality_code,
                'doctor_mcr'=>$doctor_mcr,
                'booking_date'=>$crr_date,
                'booking_time'=>$crr_time,
                'appointment_date'=>$appointment_date,
                'appointment_time'=>$appointment_time,
                'description'=> $description,
                'maker_id'=> $patient_id,
                'maker_date'=>$crr_date,
                'updater_id'=>$patient_id,
                'updater_date'=>$crr_date
        );

            $this->db->insert($this->main_table,$insertData);
            $appointment_id=$this->db->insert_id();
        
            if($appointment_id){ 
                $title="Appointment confirmation"; 
                $description="Your appointment with the doctor ".$doctor_name." on Appointment Date ".$appointment_date." ". date("h:i:s A", strtotime($appointment_time))." at ".$hospital_location_name." has been confirmed. Please present at hospital before 15 mins for check in purpose.";
				$title_vi="cuộc hẹn xác nhận"; 
                $description_vi="Lịch hẹn khám của bạn với bác sĩ ".$doctor_name." vào ngày ".$appointment_date." ". date("h:i:s A", strtotime($appointment_time))." tại ".$hospital_location_name." đã được xác nhận. Bạn vui lòng có mặt trước 15 phút đẻ chuẩn bị tiêm ngừa.";
				
				$notficationData=[
                    'username'=>$username,
                    'parent_username'=>$parent_username,
                    'module_name'=> 'doctor_appointment',
                    'module_id'=>$appointment_id,
                    'title'=>$title,
                    'description'=>$description,
					'title_vi'=>$title_vi,
                    'description_vi'=>$description_vi,
                    'created_date'=>$crr_date,
                    'created_time'=>$crr_time,
                    'maker_id'=>$patient_id,
                    'maker_date'=>$crr_date,
                    'updater_id'=>$patient_id,
                    'updater_date'=>$crr_date
                ];

                $this->db->insert("patient_notification_history",$notficationData);
				$response=[
							'username'=>$main_username,
							'appointment_id'=>$appointment_id
						];
                return $response;
        }else{
            return false;  
        }
    }

    public function loadDataById($ID=''){
        extract($_GET);
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this ->db->select('PA.ID as appointment_id,PA.his_appointment_number,PA.appointment_type_id,PA.prn as patient_prn,PA.parent_prn,HL.code as hospital_location_code,PA.doctor_speciality_code,PA.doctor_mcr,PA.booking_date,PA.booking_time,PA.appointment_date,PA.appointment_time,PA.description');
        $this->db->join("hospital_location as HL","HL.ID=hospital_location_id","LEFT");
        $this->db->from($this->main_table." as PA");
        $this->db->where("MD5(PA.ID)",$ID);
        $this->db->where("PA.is_deleted",0);
        $result=$this->db->get()->row();
        if($result){
            $result->is_sub_patient=($result->parent_prn!='')?'1':'0';
            unset($result->parent_prn);
        }    
        return $result;
    }

    public function checkParentExist($prn=''){
        if($prn!=''){
            $this->db->select("count(ID) as total");
            $this->db->from("patient");
            $this->db->where("prn",$prn);
            $this->db->where("prn !=","");
            $this->db->where("is_deleted",0);
            $result=$this->db->get()->row();
            if($result && $result->total>0){
               return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

	public function hospitalLocationNameByID($ID){
		$this->db->select("name");
		$this->db->from("hospital_location");
		$this->db->where("ID",$ID);
		$hospital_result=$this->db->get()->row();
		if($hospital_result){
			return $name=$hospital_result->name;
		}else{
			return false;
		}
	}
	
	public function hospitalLocationNameByCode($code){
		$this->db->select("name");
		$this->db->from("hospital_location");
		$this->db->where("code",$code);
		$hospital_result=$this->db->get()->row();
		if($hospital_result){
			return $name=$hospital_result->name;
		}else{
			return false;
		}
	}
	
	public function doctor_speciality_name($code){
		$this->db->select("name");
		$this->db->from("doctor_specialization");
		$this->db->where("code",$code);
		$hospital_result=$this->db->get()->row();
		if($hospital_result){
			return $name=$hospital_result->name;
		}else{
			return false;
		}
	}

	public function doctor_name($doctor_mcr){
		$this ->db->select("IF(title='Other',title_other,title) as title,name AS doctor_name");
		$this->db->from("doctor");
		$this->db->where("mcr",$doctor_mcr);
		$hospital_result=$this->db->get()->row();
		if($hospital_result){
			return $name=($hospital_result->title!='')?$hospital_result->title." ".$hospital_result->doctor_name:$hospital_result->doctor_name;
		}else{
			return false;
		}
	}

    public function delete_appointment($appointment_id=''){
        $crr_date=date("Y-m-d");
        $crr_time=date("H:i:s");

        $ID=(isset($_GET['appointment_id']))?$_GET['appointment_id']:$appointment_id;
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $updateData=array('is_deleted'=>1);

        // for patient main table    
        $this->db->where("MD5(ID)", $ID);
        $this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        $this->db->select("*");
        $this->db->from($this->main_table);
        $this->db->where("MD5(ID)", $ID);
        $result=$this->db->get()->row();
		
        if($result){
			$patient_id=$main_username=$parent_username=$username="";
		
			$this->db->select("ID,username");
			$this->db->from("patient");
			$this->db->where("prn",$result->prn);
			if($result->parent_prn!='')$this->db->or_where("prn",$result->parent_prn);
			$patient_result=$this->db->get()->row();
			if($patient_result){
				$patient_id=$patient_result->ID;
				$username=$patient_result->username;
				$main_username=$username;	
			}
			
			$this->db->select("ID,username");
			$this->db->from("sub_patient");
			$this->db->where("prn",$result->prn);
			$sub_patient_result=$this->db->get()->row();
			if($sub_patient_result){
				//$patient_id=$sub_patient_result->ID;
				$parent_username=$username;
				$username=$sub_patient_result->username;		
			}
			
			
			$hospital_location_name=$this->hospitalLocationNameByID($result->hospital_location_id);
			$doctor_name=$this->doctor_name($result->doctor_mcr);	
			
			$title="Appointment cancellation Confirmation"; 
			$description='Your appointment with the doctor '.$doctor_name.' on Appointment Date'. date("h:i:s A", strtotime ($result->appointment_time)).' '.date("h:i:s A", strtotime ($result->appointment_time)).' at '.$hospital_location_name.' has been canceled. If you wish to rebook again the appointment, please visit our app or contact to our Customer Service: 19006765 for further assistance.';
			
			$title_vi="Xác nhận đã hủy cuộc hẹn"; 
			$description_vi="Lịch hẹn của bạn với bác sĩ ".$doctor_name." vào ngày ".date("h:i:s A", strtotime ($result->appointment_time))." ".date("h:i:s A",strtotime($result->appointment_time))." tại ".$hospital_location_name." đã được hủy. Nếu bạn muốn đặt lịch hẹn lại, vui lòng thao tác trên ứng dụng của bệnh viện hoặc liên hệ Bộ phận Chăm sóc Khách hàng qua số 19006765 để được hỗ trợ.";
			
			$notficationData=[
				'username'=>$username,
                'parent_username'=>$parent_username,
                'module_name'=> 'doctor_appointment',
                'module_id'=>$appointment_id,
                'title'=>$title,
                'description'=>$description,
				'title_vi'=>$title_vi,
                'description_vi'=>$description_vi,
                'created_date'=>$crr_date,
                'created_time'=>$crr_time,
                'maker_id'=>$patient_id,
                'maker_date'=>$crr_date,
                'updater_id'=>$patient_id,
                'updater_date'=>$crr_date
            ];
			
            $this->db->insert("patient_notification_history",$notficationData);
			
			$prn=($result->parent_prn!='')?$result->parent_prn:$result->prn;
			$response=[
					'username'=>$main_username,
					'prn'=>$prn,
					'hospital_location_name'=>$hospital_location_name,
					'doctor_name'=>$doctor_name,
					'appointment_date'=>$result->appointment_date,
					'appointment_time'=>$result->appointment_time
					];
			return $response;
		}
        return false;
    }


}
