<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="patient";
    }

    public function getData($is_active=''){
        $this->db->select("P.*");
        $this->db->from($this->main_table." as P");
        if($is_active==1)$this->db->where("P.show_status",1);
        $this->db->where("P.is_deleted",0);
        $this->db->order_by('P.ID','DESC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query(); echo "<br/><pre>";print_r($result);;die();
        return $result;
    }

    public function add_patient(){
        extract($_POST);

        if($this->checkExist($patient_name)==true){
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
                $prn="HANH - ".$patient_id;
                $updateData= array('prn'=>$prn);
                $this->db->update($this->main_table,$updateData,array('ID'=>$patient_id));

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
                setFlashMsg('success_message',"Employee has been created successfully.",'alert-success');
                //$userData=array('ID'=>$patient_id,'date'=>date("Y-m-d",strtotime($date)));
                return $patient_id;
            }else{
                setFlashMsg('success_message',"Server down please try after some time.",'alert-info');
            }
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

        setFlashMsg('success_message',"Employee has been updated successfully.",'alert-success');
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
        if($result && $result->patient_profile_pic!=''){$result->patient_profile_pic=$result->patient_profile_pic;}else{$result->patient_profile_pic=$NoImage;}
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function checkExist($patient_name='',$ID='',$email_id=''){
        //$ID=($ID!='')?$ID:$_POST['ID'];
        $patient_name=($patient_name!='')?$patient_name:$_POST['patient_name'];

        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        //$this->db->where("is_deleted",0);
        if($ID)$this->db->where("MD5(ID) !=",$ID);
        if($patient_name)$this->db->where("patient_name",$patient_name);
        if($email_id)$this->db->where("email_id!=",$email_id);
        $result=$this->db->get()->row();
        //echo $this->db->last_query(); print_r($result);die;
        if($result && $result->total>0){
            if($patient_name)setFlashMsg('success_message',"This username has been registered already.",'alert-danger');
            if($email_id)setFlashMsg('success_message',"This email address has been registered already.",'alert-danger');
            return false;
        }
        return true;
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

        $dest = $this->config->item('ROOT_DATA_DIR').$file_name."/";
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


}