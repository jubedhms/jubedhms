<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sub_patient_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="sub_patient";
    }

    public function getData($is_active='',$parent_prn='',$select_box=''){
		if($select_box!=''){
			$this->db->select("SP.prn,CONCAT(SP.first_name,' ',SP.middle_name,' ',SP.last_name) AS name");
		}else{
			$this->db->select("SP.*,CONCAT(SP.first_name,' ',SP.middle_name,' ',SP.last_name) AS name");	
		}
		
        $this->db->from($this->main_table." as SP");
		if($parent_prn!=''){
			$this->db->where("SP.parent_prn",$parent_prn);
			$this->db->where("SP.prn !=","");
		}
        if($is_active==1)$this->db->where("SP.show_status",1);
        $this->db->where("SP.is_deleted",0);
        $this->db->order_by("SP.prn=''", "DESC");
        $this->db->order_by('SP.ID','DESC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_sub_patient(){
        extract($_POST);

        if($this->checkExist($sub_patient_name)==true){
            $LOGINID=$this->LOGINID;
            $date=date("Y-m-d H:i:s");
            $role_type='sub_patient';
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
            $sub_patient_id=$this->db->insert_id();

            if($sub_patient_id){
                $prn="HANH - ".$sub_patient_id;
                $updateData= array('prn'=>$prn);
                $this->db->update($this->main_table,$updateData,array('ID'=>$sub_patient_id));

                $insertAddressData=array('sub_patient_id'=>$sub_patient_id,
                    'address_line1'=>$address_line1,
                    'address_line2'=>$address_line2,
                    'maker_id'=>$LOGINID,
                    'maker_date'=>$date,
                );

                $this->db->insert("sub_patient_address",$insertAddressData);

                $sub_patient_image=$this->upload_image($sub_patient_id, $file_name='sub_patient_image');

                $insertDocumentData=array('sub_patient_id'=>$sub_patient_id,
                    'is_completed'=>'1',
                    'sub_patient_image'=>$sub_patient_profile_pic,
                    'maker_id'=>$LOGINID,
                    'maker_date'=>$date,
                );

                $this->db->insert("sub_patient_documents",$insertDocumentData);
                setFlashMsg('success_message',"Patient has been created successfully.",'alert-success');
                //$userData=array('ID'=>$sub_patient_id,'date'=>date("Y-m-d",strtotime($date)));
                return $sub_patient_id;
            }else{
                setFlashMsg('success_message',"Server down please try after some time.",'alert-info');
            }
        }
        return true;
    }

    public function edit_sub_patient(){
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

        $this->db->update("sub_patient_address",$updateAddressData,array('MD5(sub_patient_id)'=>$ID));

        $updateDocumentData=array('is_completed'=>'1',
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$date
                            );

        $this->db->update("sub_patient_documents",$updateDocumentData,array('MD5(sub_patient_id)'=>$ID));

        setFlashMsg('success_message',"Patient has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("SP.*,PD.*,PA.*,SP.ID as sub_patient_id");
        $this->db->from($this->main_table." as P");
        $this->db->join("sub_patient_documents as PD", "PD.sub_patient_id=SP.ID", "LEFT");
        $this->db->join("sub_patient_address as PA", "PA.sub_patient_id=SP.ID", "LEFT");
        $this->db->where("MD5(SP.ID)",$ID);
        $this->db->where("SP.is_deleted",0);
        $result=$this->db->get()->row();
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image!=''){$result->image=$result->image;}else{$result->image=$NoImage;}
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function loadDataByName($username=''){
        $this->db->select("SP.*,PD.*,PA.*,SP.ID as sub_patient_id,con.name as country_name,dst.name as district_name");
        $this->db->from($this->main_table." as P");
        $this->db->join("sub_patient_documents as PD", "PD.sub_patient_id=SP.ID", "LEFT");
        $this->db->join("sub_patient_address as PA", "PA.sub_patient_id=SP.ID", "LEFT");
        $this->db->join("countries as con", "PA.country_code=con.country_code1", "LEFT");
        $this->db->join("districts as dst", "PA.district_code=dst.id", "LEFT");
        $this->db->where("username",$username);
        $this->db->where("SP.is_deleted",0);
        $result=$this->db->get()->row();
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image!=''){$result->image=$result->image;}else{$result->image=$NoImage;}
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function checkExist($sub_patient_name='',$ID='',$email_id=''){
        //$ID=($ID!='')?$ID:$_POST['ID'];
        $sub_patient_name=($sub_patient_name!='')?$sub_patient_name:$_POST['sub_patient_name'];

        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        //$this->db->where("is_deleted",0);
        if($ID)$this->db->where("MD5(ID) !=",$ID);
        if($sub_patient_name)$this->db->where("sub_patient_name",$sub_patient_name);
        if($email_id)$this->db->where("email_id!=",$email_id);
        $result=$this->db->get()->row();
        //echo $this->db->last_query(); print_r($result);die;
        if($result && $result->total>0){
            if($sub_patient_name)setFlashMsg('success_message',"This username has been registered already.",'alert-danger');
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
            $this->db->from("sub_patient_documents");
            $this->db->where(array('MD5(sub_patient_id)'=>$ID));
            $oldfile_name=$this->db->get()->row()->$file_name;
        }
        
        $curr_year=date('Y');
        $curr_month=date('m');
        $dest = $this->config->item('ROOT_DATA_DIR')."sub_patient-profile-image/".$curr_year."/".$curr_month."/";
       
        $resultData = uploadImg($file_name,$dest);
        if($resultData!==false){
            if($oldfile_name!='')remove_uploaded_file($oldfile_name);
            $newFileName=$dest.$resultData['upload_data']['file_name'];

            $updateArray = array($file_name=>$newFileName);
            $this->db->where('MD5(sub_patient_id)',$ID);
            $successData = $this->db->update("sub_patient_documents",$updateArray);
            setFlashMsg('success_message',"Image has been updated successfully.",'alert-success');
            return $newFileName;
        }else{
            //setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
            return '';
        }
    }
    public function delete_sub_patient_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        // for user document table
        $this->db->select("image");
        $this->db->from("sub_patient_documents");
        $this->db->where_in("MD5(sub_patient_id)", $IDS);
        $result=$this->db->get()->result();
        foreach($result as $value){
            if($value->image!='')remove_uploaded_file($value->image); 
        }

        $this->db->where_in("MD5(sub_patient_id)", $IDS);
        $this->db->update("sub_patient_documents",$updateData);
        //$this->db->delete("sub_patient_documents");
        //end

        // for user address table     
        $this->db->where_in("MD5(sub_patient_id)", $IDS);
        $this->db->update("sub_patient_address",$updateData);
        //$this->db->delete("sub_patient_address");
        //end
		
        echo "Patient has been deleted successfully.";
        return;
    }

    function checkprnExist($prn){
        $query=$this->db->select("*")->from($this->main_table." as P")->where('SP.prn',$prn)->get();
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    function updatePRN(){
        if($this->db->update($this->main_table,array('prn'=>$this->input->post('prn_update')),array('ID'=>$this->input->post('PID')))){
            return true;
        }else{
            return false;
        }
    }


}