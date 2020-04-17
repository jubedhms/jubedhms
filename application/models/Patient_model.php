<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="patient";
    }

    public function getData($is_active='',$select_box=''){
        if($select_box!=''){
			$this->db->select("P.prn,CONCAT(P.first_name,' ',P.middle_name,' ',P.last_name) AS name");
		}else{
			$this->db->select("P.*,CONCAT(P.first_name,' ',P.middle_name,' ',P.last_name) AS name");	
		}
        $this->db->from($this->main_table." as P");
        if($is_active==1)$this->db->where("P.show_status",1);
		if($select_box!='')$this->db->where("P.prn !=","");
        $this->db->where("P.prn","");
        $this->db->where("P.is_deleted",0);
        $this->db->order_by('P.ID','DESC');
        $result1=$this->db->get()->result();
		
		 if($select_box!=''){
			$this->db->select("P.prn,CONCAT(P.first_name,' ',P.middle_name,' ',P.last_name) AS name");
		}else{
			$this->db->select("P.*,CONCAT(P.first_name,' ',P.middle_name,' ',P.last_name) AS name");	
		}
        $this->db->from($this->main_table." as P");
        if($is_active==1)$this->db->where("P.show_status",1);
		if($select_box!='')$this->db->where("P.prn !=","");
         $this->db->where("P.prn !=","");
		$this->db->where("P.is_deleted",0);
        $this->db->order_by('P.ID','DESC');
        $result2=$this->db->get()->result();
		
        //echo $this->db->last_query(); echo "<br/><pre>";print_r($result);;die();
		$result=($result1 && $result2)?array_merge($result1,$result2):(($result2)?$result2:$result1);
        return $result;
    }

    public function add_patient(){
        extract($_POST);

        if($this->checkExistUsername($patient_name)==false){
            $LOGINID=$this->LOGINID;
            $date=date("Y-m-d H:i:s");
            $role_type='Patient';
            $dob=datepikerDateTime($dob,"Y-m-d");
            //print_r($_FILES['shop_image']['name']);
            //echo "<pre>"; print_r($_POST); die;

            $insertData=array('username'=>$username,
                'role_type'=>$role_type,
                'title'=>$title,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'password'=>MD5($password),
                'email_id'=>$username,
                'contact_number'=>$contact_number,
                'alternet_contact_number'=>$alternet_contact_number,
                'gender'=>$gender,
                'blood_group'=>$blood_group,
                'dob'=>$dob,
                'description'=>$description,
                'maker_id'=>$LOGINID,
                'maker_date'=>$date,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date
            );


            $this->db->insert($this->main_table,$insertData);
            $patient_id=$this->db->insert_id();

            if($patient_id){
                //$prn="HANH - ".$patient_id;
               // $updateData= array('prn'=>$prn);
               // $this->db->update($this->main_table,$updateData,array('ID'=>$patient_id));

                $insertAddressData=array('patient_id'=>$patient_id,
                    'address_line1'=>$address_line1,
                    'address_line2'=>$address_line2,
                    'maker_id'=>$LOGINID,
                    'maker_date'=>$date,
                );

                $this->db->insert("patient_address",$insertAddressData);

                $patient_image=$this->upload_image($patient_id, $file_name='patient_image');

                $insertDocumentData=array('patient_id'=>$patient_id,
                    'is_completed'=>'1',
                    'patient_image'=>$patient_profile_pic,
                    'maker_id'=>$LOGINID,
                    'maker_date'=>$date,
                );

                $this->db->insert("patient_documents",$insertDocumentData);
                setFlashMsg('success_message',"Patient has been created successfully.",'alert-success');
                //$userData=array('ID'=>$patient_id,'date'=>date("Y-m-d",strtotime($date)));
                return $patient_id;
            }else{
                setFlashMsg('success_message',"Server down please try after some time.",'alert-info');
            }
        }else{
			 setFlashMsg('success_message',"Patient Username has been registered already.",'alert-success');
		}
        return true;
    }

    public function edit_patient(){
        extract($_POST);
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $LOGINID=$this->LOGINID;
        $LOGINROLEID=$this->LOGINROLEID;
        $date=date("Y-m-d H:i:s");
        $dob=datepikerDateTime($dob,"Y-m-d");
        //echo "<pre>"; print_r($_POST); die;

        $updateData=array(
                'title'=>$title,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'email_id'=>$email_id,
                'contact_number'=>$contact_number,
                'alternet_contact_number'=>$alternet_contact_number,
                'gender'=>$gender,
                'blood_group'=>$blood_group,
                'dob'=>$dob,
                'description'=>$description,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date
        );
       
        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));

        $updateAddressData=array('address_line1'=>$address_line1,
                            'address_line2'=>$address_line2,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );

        $this->db->update("patient_address",$updateAddressData,array('MD5(patient_id)'=>$ID));

        $updateDocumentData=array('is_completed'=>'1',
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$date
                            );

        $this->db->update("patient_documents",$updateDocumentData,array('MD5(patient_id)'=>$ID));

        setFlashMsg('success_message',"Patient has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("P.*,PD.*,PA.*,P.ID as patient_id");
        $this->db->from($this->main_table." as P");
        $this->db->join("patient_documents as PD", "PD.patient_id=P.ID", "LEFT");
        $this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
        $this->db->where("MD5(P.ID)",$ID);
        $this->db->where("P.is_deleted",0);
        $result=$this->db->get()->row();
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image!=''){$result->image=$result->image;}else{$result->image=$NoImage;}
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function loadDataByName($username=''){
        $this->db->select("P.*,PD.*,PA.*,P.ID as patient_id,con.name as country_name,dst.name as district_name");
        $this->db->from($this->main_table." as P");
        $this->db->join("patient_documents as PD", "PD.patient_id=P.ID", "LEFT");
        $this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
        $this->db->join("countries as con", "PA.country_code=con.country_code1", "LEFT");
        $this->db->join("districts as dst", "PA.district_code=dst.id", "LEFT");
        $this->db->where("username",$username);
        $this->db->where("P.is_deleted",0);
        $result=$this->db->get()->row();
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image!=''){$result->image=$result->image;}else{$result->image=$NoImage;}
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function checkExistUsername($username=''){
        $username=($username!='')?$username:(isset($_POST['username'])?$_POST['username']:"");
		if($username!=''){
			$this->db->select("count(ID) as total");
			$this->db->from($this->main_table);
			$this->db->where("username!=",$username);
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
	
    public function checkExistPRN($prn=''){
        $prn=($prn!='')?$prn:(isset($_POST['prn'])?$_POST['prn']:"");
		if($prn!=''){
			$this->db->select("count(ID) as total");
			$this->db->from($this->main_table);
			$this->db->where("prn!=",$prn);
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

    public function change_password_via_admin($ID=''){
        extract($_POST); //print_r($_POST); die;
        if($confirm_password == $password){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $newPassword=md5($password);

            if($password!=''){
                $updateArray = array( 'password'=>$newPassword);
                $this->db->where('MD5(ID)',$ID);
                $this->db->update($this->main_table,$updateArray);

                setFlashMsg('success_message',"Password has been changed successfully.",'alert-success');
                return true;
            } else{
                setFlashMsg('success_message',"Please input new password and confirm Password.",'alert-danger');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Please input a valid confirm Password.",'alert-danger');
            return false;
        }
    }


    public function upload_image($ID='', $file_name=''){
        $oldfile_name='';
        $file_name =($file_name=='')?$this->input->post('file_name'):$file_name;
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $this->db->select($file_name);
            $this->db->from("patient_documents");
            $this->db->where(array('MD5(patient_id)'=>$ID));
            $oldfile_name=$this->db->get()->row()->$file_name;
        }
        
        $curr_year=date('Y');
        $curr_month=date('m');
        $dest = $this->config->item('ROOT_DATA_DIR')."patient-profile-image/".$curr_year."/".$curr_month."/";
       
        $resultData = uploadImg($file_name,$dest);
        if($resultData!==false){
            if($oldfile_name!='')remove_uploaded_file($oldfile_name);
            $newFileName=$dest.$resultData['upload_data']['file_name'];

            $updateArray = array($file_name=>$newFileName);
            $this->db->where('MD5(patient_id)',$ID);
            $successData = $this->db->update("patient_documents",$updateArray);
            setFlashMsg('success_message',"Image has been updated successfully.",'alert-success');
            return $newFileName;
        }else{
            //setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
            return '';
        }
    }
    public function delete_patient_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        // for user document table
        $this->db->select("image");
        $this->db->from("patient_documents");
        $this->db->where_in("MD5(patient_id)", $IDS);
        $result=$this->db->get()->result();
        foreach($result as $value){
            if($value->image!='')remove_uploaded_file($value->image); 
        }

        $this->db->where_in("MD5(patient_id)", $IDS);
        $this->db->update("patient_documents",$updateData);
        //$this->db->delete("patient_documents");
        //end

        // for user address table     
        $this->db->where_in("MD5(patient_id)", $IDS);
        $this->db->update("patient_address",$updateData);
        //$this->db->delete("patient_address");
        //end
		
        echo "User has been deleted successfully.";
        return;
    }

    function checkprnExist($prn){
        $query=$this->db->select("*")->from($this->main_table." as P")->where('P.prn',$prn)->get();
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    function updatePRN(){
        if($this->db->update($this->main_table,array('prn'=>$this->input->post('prn_update')),array('ID'=>$this->input->post('PID')))){
			$subPatientData=['parent_prn'=> $this->input->post('prn_update')];
			$this->db->update("sub_patient",$subPatientData,['parent_id'=>$this->input->post('PID')]);
            return true;
        }else{
            return false;
        }
    }


}