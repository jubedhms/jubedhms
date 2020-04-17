<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="doctor";
    } 

    public function getData($is_active=''){
        //echo $this->input->post('speciality');die;
        $this->db->select("D.*,U.user_name as editor, D.name AS name, DS.name as primary_specialty_name");
        $this->db->from($this->main_table." D");
        $this->db->join("doctor_specialization as DS",'DS.code=D.primary_specialty_code','LEFT');
        $this->db->join("user as U",'U.ID=D.updater_id','LEFT');
        if($is_active==1)$this->db->where("D.show_status",1);
        if($this->input->post('speciality'))$this->db->where("D.primary_specialty_code",$this->input->post('speciality'));
        $this->db->where("D.is_deleted",0);
        $this->db->order_by('D.ID','DESC');
        $result=$this->db->get()->result();
        //echo "<br/><pre>";print_r($result);;die();
        return $result;
    }
	
	function getDoctor_banner(){
        $query=$this->db->get_where('app_banner_setting',array("module_name"=>'doctor_profile',"src!="=>''));
        if($query->num_rows()>0){
            return $query->row()->src;
        }else{
            return false;
        }
    }
	
    public function getData_list($is_active='',$limit,$start){
        //echo $this->input->post('speciality');die;
        $this->db->select("D.*,CONCAT(U.first_name,' ',U.middle_name,' ',U.last_name ) as editor, D.name AS name, DS.name as primary_specialty_name");
        $this->db->from($this->main_table." D");
        $this->db->join("doctor_specialization as DS",'DS.code=D.primary_specialty_code','LEFT');
        $this->db->join("user as U",'U.ID=D.updater_id','LEFT');
       if($is_active==1)$this->db->where("D.show_status",1);
        if($this->input->post('speciality'))$this->db->where("D.primary_specialty_code",$this->input->post('speciality'));
        if($this->input->post('searchDoctor')){
            $search=trim($this->input->post('searchDoctor'));
            //$searchquery=; 
//        $this->db->where("(D.first_name like '%$search%' or D.middle_name like '%$search%' or D.last_name like '%$search%' OR D.mcr = '$search')");
        $this->db->where("(D.name like '%$search%' OR D.mcr = '$search')");
        //$this->db->or_where('D.mcr',$search);
        }
        $this->db->where("D.is_deleted",0);
        $this->db->order_by('D.ID','DESC');
        $this->db->limit($limit, $start);
        $result=$this->db->get()->result();
        return $result;
    }
	
    public function getDataGrid($is_active='',$limit,$start){
        //echo $this->input->post('speciality');die;
        $this->db->select("D.*, D.name AS name, DS.name as primary_specialty_name, DA.country_code,CO.name as contry_name");
        $this->db->from($this->main_table." D");
        $this->db->join("doctor_specialization as DS",'DS.code=D.primary_specialty_code','LEFT');
        $this->db->join("doctor_address as DA", "DA.doctor_id=D.ID", "LEFT");
        $this->db->join("countries as CO", "CO.country_code1=DA.country_code", "LEFT");
        if($is_active==1)$this->db->where("D.show_status",1);
        if($this->input->post('speciality'))$this->db->where("D.primary_specialty_code",$this->input->post('speciality'));
        if($this->input->post('searchDoctor')){
            $search=trim($this->input->post('searchDoctor'));
            //$searchquery=; 
//        $this->db->where("(D.first_name like '%$search%' or D.middle_name like '%$search%' or D.last_name like '%$search%' OR D.mcr = '$search')");
        $this->db->where("(D.name like '%$search%' OR D.mcr = '$search')");
        //$this->db->or_where('D.mcr',$search);
        }
        $this->db->where("D.is_deleted",0);
        $this->db->order_by('D.ID','DESC');
        $this->db->limit($limit, $start);
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die;
        //echo "<br/><pre>";print_r($result);;die();
        return $result;
    }
    
    function get_count($is_active=''){
        $this->db->select("D.*, D.name AS name, DS.name as primary_specialty_name");
        $this->db->from($this->main_table." D");
        $this->db->join("doctor_specialization as DS",'DS.code=D.primary_specialty_code','LEFT');
        if($is_active==1)$this->db->where("D.show_status",1);
        if($this->input->post('speciality'))$this->db->where("D.primary_specialty_code",$this->input->post('speciality'));
        if($this->input->post('searchDoctor')){
            $search=trim($this->input->post('searchDoctor'));
//          $this->db->where("(D.first_name like '%$search%' or D.middle_name like '%$search%' or D.last_name like '%$search%' OR D.mcr = '$search')");
        $this->db->where("(D.name like '%$search%' OR D.mcr = '$search')");
        ////$this->db->where($searchquery);
        //$this->db->or_where('D.mcr',$search);
        }
		$this->db->where("D.is_deleted",0);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->num_rows();
        }else{
            return false;
        }
    }

    public function add_doctor(){
        extract($_POST);
        $LOGINID=$this->LOGINID;
        $date=date("Y-m-d H:i:s");
        //$dob=datepikerDateTime($dob,"Y-m-d","Y-m-d");
        
        $insertData=array(
            'title'=>$title,
            'name'=>$name,
            //'first_name'=>$first_name,
            //'middle_name'=>$middle_name,
            //'last_name'=>$last_name,
            //'email_id'=>$email_id,
            //'contact_number'=>$contact_number,
            //'alternet_number'=>$alternet_contact_number,
            //'blood_group'=>$blood_group,
            //'gender'=>$gender,
            //'dob'=>$dob,
            //'password'=>generateHashShaKey($password),
            'primary_specialty_code'=>$primary_specialty_code,
            'specialty_code'=>($specialty_code)?implode(',',$specialty_code):'',
            'description'=>$description,
			'description_vi'=>$description_vi, 
			'professional_exp_year'=>$professional_exp_year, 
            'maker_id'=>$LOGINID,
            'maker_date'=>$date,
            'updater_id'=>$LOGINID,
            'updater_date'=>$date
        );

        //print_r($insertData);die;
        $this->db->insert($this->main_table,$insertData);
        $doctor_id=$this->db->insert_id();


        if($doctor_id){
            $mcr="HANH-".$doctor_id;
            $updateData= array('mcr'=>$mcr);
            $this->db->update($this->main_table,$updateData,array('ID'=>$doctor_id));
             // image upload
            $this->upload_image($doctor_id, $file_name='image');
            // end
            $insertAddressData=array(
                        'doctor_id'=>$doctor_id,
                        //'country_code'=>$country_code,
                        //'postal_code'=>$postal_code,
                        //'district_code'=>$district_code,
                        //'address_line1'=>$address_line1,
                       //'address_line2'=>$address_line2,
                        'maker_id'=>$LOGINID,
						'maker_date'=>$date,
						'updater_id'=>$LOGINID,
						'updater_date'=>$date
            );
            $this->db->insert("doctor_address",$insertAddressData);
            $updateDocumentData=array(
                            'doctor_id'=>$doctor_id,
                            'maker_id'=>$LOGINID,
							'maker_date'=>$date,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
            $this->db->insert("doctor_documents",$updateDocumentData);
			
                    //Education
                    for($i=0;$i<count($education_from);$i++){
                    $doctoreducation[$i]=array(
                            'doctor_id'=>$doctor_id,
                            //'from_year'=>$education_from[$i],
                            //'to_year'=>$education_to[$i],
                            'description'=>$education_description[$i],
                            'maker_id'=>$LOGINID,
                            'maker_date'=>$date,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
                    }
                    $this->db->insert_batch("doctor_education",$doctoreducation);
                    //Experience
                    for($j=0;$j<count($experience_from);$j++){
                        $doctorexperience[$j]=array(
                            'doctor_id'=>$doctor_id,
                            'from_year'=>$experience_from[$j],
                            'to_year'=>$experience_to[$j],
                            'description'=>$experience_description[$j],
                            'maker_id'=>$LOGINID,
                            'maker_date'=>$date,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
                    }
                    //print_r($doctorexperience);die;
                    $this->db->insert_batch("doctor_experience",$doctorexperience);
                    
                    //Awards
                    for($j=0;$j<count($cert_award_year);$j++){
                        $doctor_cert_award_year[$j]=array(
                            'doctor_id'=>$doctor_id,
                            'from_year'=>$cert_award_year[$j],
                            //'to_year'=>$experience_to[$j],
                            'description'=>$cert_award_description[$j],
                            'maker_id'=>$LOGINID,
                            'maker_date'=>$date,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
                    }
                    //print_r($doctorexperience);die;
                    $this->db->insert_batch("doctor_others_certificate_awards",$doctor_cert_award_year);

           setFlashMsg('success_message',"Doctor has been created successfully.",'alert-success');
            return $doctor_id;
        }else{
            setFlashMsg('success_message',"Server down please try after some time.",'alert-info');
        }
       
        return true;
    }
	
	public function edit_doctor(){
        //print_r($_POST);die;
        extract($_POST);
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $LOGINID=$this->LOGINID;
        $date=date("Y-m-d H:i:s");
        //$dob=datepikerDateTime($dob,"Y-m-d","Y-m-d");
        //echo "<pre>"; print_r($_POST); die;

        
        $updateData=array(
            'title'=>$title,
            'title_vi'=>$title_vi,
            'title_other'=>(isset($title_other) && $title=='Other')?$title_other:'',
            'title_other_vi'=>(isset($title_other_vi) && $title_vi=='Other')?$title_other_vi:'',
            'position'=>$position,
            'position_vi'=>$position_vi,
            'position_other'=>(isset($position_other) && $position=='Other')?$position_other:'',
            'position_other_vi'=>(isset($position_other_vi) && $position_vi=='Other')?$position_other_vi:'',
            'name'=>$name,
            'name_vi'=>(isset($name_vi))?$name_vi:'',
			'level'=>isset($level)?$level:'',
			'level_vi'=>isset($level_vi)?$level_vi:'',
            //'first_name'=>$first_name,
            //'middle_name'=>$middle_name,
            //'last_name'=>$last_name,
            //'email_id'=>$email_id,
            //'contact_number'=>$contact_number,
            //'alternet_number'=>$alternet_contact_number,
            //'blood_group'=>$blood_group,
            //'gender'=>$gender,
            //'dob'=>$dob,
            'description'=>$description,
			'description_vi'=>$description_vi, 
            'professional_exp_year'=>$professional_exp_year, 
            'primary_specialty_code'=>$primary_specialty_code,
            //'specialty_code'=>isset($specialty_code)?implode(',',$specialty_code):'',
			//'specialty_code'=>($specialty_code)?$specialty_code:'',
			'profile_specialty'=>(isset($profile_specialty))?$profile_specialty:'',
            'profile_specialty_other'=>(isset($profile_specialty_other))?$profile_specialty_other:'',
            'profile_specialty_vi'=>(isset($profile_specialty_vi))?$profile_specialty_vi:'',
            'profile_specialty_other_vi'=>(isset($profile_specialty_other_vi))?$profile_specialty_other_vi:'',
            'updater_id'=>$LOGINID,
            'updater_date'=>$date
        );
        
        $this->db->update($this->main_table,$updateData,array("MD5(ID)"=>$ID));
        
        $updateAddressData=array(
                            //'country_code'=>$country_code,
                            //'district_code'=>$district_code,
                            //'address_line1'=>$address_line1,
                            //'address_line2'=>$address_line2,
                            //'postal_code'=>$postal_code,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
						
        $this->db->update("doctor_address",$updateAddressData,array("MD5(doctor_id)"=>$ID));

        $updateDocumentData=array(
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$date
                            );
//
      $this->db->update("doctor_documents",$updateDocumentData,array("MD5(doctor_id)"=>$ID));
        //Education
        for($i=0;$i<count($education_description);$i++){
            if(isset($education_id[$i])){
                    $doctoreducation=array(
                            //'from_year'=>$education_from[$i],
                            //'to_year'=>$education_to[$i],
                            'description'=>$education_description[$i],
                            'description_vi'=>$education_description_vi[$i],
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
                   $this->db->update("doctor_education",$doctoreducation,array("ID"=>$education_id[$i]));
                    }else{
                        $doctoreducation2=array(
                                    'doctor_id'=>$doctorID,
                                    //'from_year'=>$education_from[$i],
                                    //'to_year'=>$education_to[$i],
                                    'description'=>$education_description[$i],
                                    'description_vi'=>$education_description_vi[$i],
                                    'maker_id'=>$LOGINID,
                                    'maker_date'=>$date,
                                    'updater_id'=>$LOGINID,
                                    'updater_date'=>$date
                                );
                        $this->db->insert("doctor_education",$doctoreducation2);
                    }
                    
        }
       
       
       //Experience
        for($j=0;$j<count($experience_from);$j++){
            if(isset($experience_id[$j])){
                        $doctorexperience=array(
                            'from_year'=>$experience_from[$j],
                            'to_year'=>$experience_to[$j],
                            'to_year_vi'=>$experience_to_vi[$j],
                            'description'=>$experience_description[$j],
                            'description_vi'=>$experience_description_vi[$j],
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
                        $this->db->update("doctor_experience",$doctorexperience,array("ID"=>$experience_id[$j]));
                    }else{
                        $doctorexperience2=array(
                                'doctor_id'=>$doctorID,
                                'from_year'=>$experience_from[$j],
                                'to_year'=>$experience_to[$j],
                                'to_year_vi'=>$experience_to_vi[$j],
                                'description'=>$experience_description[$j],
                                'description_vi'=>$experience_description_vi[$j],
                                'maker_id'=>$LOGINID,
                                'maker_date'=>$date,
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$date
                            );
                        $this->db->insert("doctor_experience",$doctorexperience2);
                    }
                        
            }
            
       //Certificate Awards
        for($k=0;$k<count($cert_award_year);$k++){
            if(isset($certificate_award_id[$k])){
                        $cert_award_desc=array(
                            'from_year'=>$cert_award_year[$k],
                            'description'=>$cert_award_description[$k],
                            'description_vi'=>$cert_award_description_vi[$k],
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );
                        $this->db->update("doctor_others_certificate_awards",$cert_award_desc,array("ID"=>$certificate_award_id[$k]));
                    }else{
                        $cert_award_desc2=array(
                                'doctor_id'=>$doctorID,
                                'from_year'=>$cert_award_year[$k],
                                'description'=>$cert_award_description[$k],
                                'description_vi'=>$cert_award_description_vi[$k],
                                'maker_id'=>$LOGINID,
                                'maker_date'=>$date,
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$date
                            );
                       
                        $this->db->insert("doctor_others_certificate_awards",$cert_award_desc2);
                    }
                        
            }
        
        setFlashMsg('success_message',"Doctor has been updated successfully.",'alert-success');
        return true;
    }
   
    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("D.*,HL.name as hospital_name,D.name AS name,DA.country_code,DA.district_code,DA.address_line1,DA.address_line2,DA.postal_code");
        $this->db->from($this->main_table." as D");
        //$this->db->join("doctor_documents as DD", "DD.doctor_id=D.ID", "LEFT");
        $this->db->join("doctor_address as DA", "DA.doctor_id=D.ID", "LEFT");
        $this->db->join("hospital_location as HL", "HL.ID=D.hospital_location_id", "LEFT");
        $this->db->where("MD5(D.ID)",$ID);
        $this->db->where("D.is_deleted",0);
        $result=$this->db->get()->row();
        //print_r($result);die;
        //$NoImage='assets/img/icon/not-available.jpg';
        //if($result && $result->image!=''){$result->image=$result->image;}else{$result->image=$NoImage;}

        $this->db->select("*");
        $this->db->from("doctor_experience");
        $this->db->where("MD5(doctor_id)",$ID);
        $this->db->where("is_deleted",0);
        $result_experience=$this->db->get()->result();
        
        $this->db->select("*");
        $this->db->from("doctor_education");
        $this->db->where("MD5(doctor_id)",$ID);
        $this->db->where("is_deleted",0);
        $result_education=$this->db->get()->result();
        
        $this->db->select("*");
        $this->db->from("doctor_others_certificate_awards");
        $this->db->where("MD5(doctor_id)",$ID);
        $this->db->where("is_deleted",0);
        $result_certificate_award=$this->db->get()->result();
        
        $result->educations=$result_education;
        $result->experiences=$result_experience;
        $result->certificate_award=$result_certificate_award;
        return $result;
    }
    
    function removedoctor_education($id){
        if($this->db->update('doctor_education',array("is_deleted"=>1),array("ID"=>$id))){
            return true;
        }else{
            return false;
        }
    }
    function removedoctor_experience($id){
        if($this->db->update('doctor_experience',array("is_deleted"=>1),array("ID"=>$id))){
            return true;
        }else{
            return false;
        }
    }
    function removedoctor_award($id){
        if($this->db->update('doctor_others_certificate_awards',array("is_deleted"=>1),array("ID"=>$id))){
            return true;
        }else{
            return false;
        }
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
	
    public function checkExistMCR($mcr=''){
        $mcr=($mcr!='')?$mcr:(isset($_POST['mcr'])?$_POST['mcr']:"");
		if($mcr!=''){
			$this->db->select("count(ID) as total");
			$this->db->from($this->main_table);
			$this->db->where("mcr!=",$mcr);
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

    public function upload_image($ID='', $fileInputboxName=''){
        if($ID!=''){
			$date=date("Y-m-d H:i:s");
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldfile_name='';
			$this->db->select("image");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
			//echo $this->db->last_query();die;
            if(!$row && !isset($row->image)){
                return false;  
            }
            
            $oldfile_name=$row->image;
            $fileInputboxName =($fileInputboxName!='')?$fileInputboxName:$_POST['fileInputboxName'];
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."doctor-profile-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($fileInputboxName,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
    
				$updateArray = array("image"=>$newFileName,'updater_date'=>$date);
                $this->db->where(array('MD5(ID)'=>$ID));
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Doctor ID is missing.",'alert-info');
            return false;
        }    
    }
    
    public function delete_doctor_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for doctor main table    
        $this->db->select("image");
        $this->db->from($this->main_table);
        $this->db->where_in("MD5(ID)", $IDS);
        $result=$this->db->get()->result();
        foreach($result as $value){
            if($value->image!='')remove_uploaded_file($value->image); 
        }
           
        //$this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        // for doctor document table
       // $this->db->where_in("MD5(doctor_id)", $IDS);
        //$this->db->update("doctor_documents",$updateData);
        //$this->db->delete("doctor_documents");
        //end

        // for doctor address table     
        //$this->db->where_in("MD5(doctor_id)", $IDS);
        //$this->db->update("doctor_address",$updateData);
        //$this->db->delete("doctor_address");
        //end
	
         // for doctor education table     
        $this->db->where_in("MD5(doctor_id)", $IDS);
        //$this->db->update("doctor_education",$updateData);
        $this->db->delete("doctor_education");
        //end
        
         // for doctor experience table     
        $this->db->where_in("MD5(doctor_id)", $IDS);
        //$this->db->update("doctor_experience",$updateData);
        $this->db->delete("doctor_experience");
        //end
        
         // for doctor others certificate awards table     
        $this->db->where_in("MD5(doctor_id)", $IDS);
        //$this->db->update("doctor_others_certificate_awards",$updateData);
        $this->db->delete("doctor_others_certificate_awards");
        //end
        
        echo "Doctor Profile has been deleted successfully.";
        return;
    }
    
    function removedoctor_image($id,$old_img){
        if($this->db->update($this->main_table,array("image"=>''),array("ID"=>$id))){
            unlink($old_img);
            return true;
        }else{
            return false;
        }
    }
    
    function getDoctor_image($id){
        $data=$this->db->get_where($this->main_table,array("ID"=>$id));
        //echo $this->db->last_query();die;
        if($data->num_rows()>0){
             return $data->row()->image;
        }else{
            return false;
        }
    }
	
	function SaveDoctorImage($id,$dataimg){
       if($this->db->update($this->main_table,$dataimg,array("ID"=>$id))){
           return true;
        }else{
            return false;
        }
    }
    
}