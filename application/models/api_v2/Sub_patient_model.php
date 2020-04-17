<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_patient_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="sub_patient";
    }

    public function getData($parent_username){ 
        // check parent user is existing or not
        if($this->checkParentExist($parent_username)!=true){
            return false;
        }
        //end    
        
		$this ->db->select('P.*,PD.*,PA.*');
		$this->db->from($this->main_table." as P");
		$this->db->join("sub_patient_documents as PD", "PD.sub_patient_id=P.ID", "LEFT");
		$this->db->join("sub_patient_address as PA", "PA.sub_patient_id=P.ID", "LEFT");
		$this->db->where("parent_username",$parent_username);
		$this->db->where("P.is_deleted",0);
		$rows=$this->db->get()->result();
		$result=[];
		if($rows){
			foreach($rows as $row){
				$result[]=[
					'parent_username'=> $row->parent_username,
					'parent_relation'=> $row->parent_relation,
					"username"=>$row->username,
					"prn"=>$row->prn,
					"title"=>$row->title,
					"first_name"=>$row->first_name,
					"middle_name"=>$row->middle_name,
					"last_name"=>$row->last_name,
					"image"=>$row->image,
					"email_id"=>$row->email_id,
					"contact_number"=>$row->contact_number,
					"gender"=>$row->gender,
					"blood_group"=>$row->blood_group,
					"dob"=>$row->dob,
					"marital_status"=>$row->marital_status,
					"religious"=>$row->religious,
					"country_code"=>$row->country_code,
					"city_code"=>$row->city_code,
					"district_code"=>$row->district_code,
					"postal_code"=>$row->postal_code,
					"address_line1"=>$row->address_line1,
					"address_line2"=>$row->address_line2,
					"profile_completed"=>$row->is_completed,
					"description"=>$row->description
				];    
			}
		}
		
		return $result;
    }

    public function add_sub_patient(){
        extract($_POST);
        // check parent user is existing or not
        if($this->checkParentExist($parent_username)!=true){
            return false;
        }
        //end

        $crr_date=date("Y-m-d H:i:s");
        
        $this ->db->select('P.ID as parent_id,P.username as parent_username,P.email_id,P.contact_number,P.religious,PA.country_code,PA.city_code,PA.district_code,PA.district_other,PA.postal_code,PA.address_line1,PA.address_line2');
        $this->db->from("patient as P");
        $this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
        $this->db->where("username",$parent_username);
        $this->db->where("P.is_deleted",0);
        $row=$this->db->get()->row();
        
        $insertData=array(
                                'parent_id'=> $row->parent_id,
                                'parent_username'=> $parent_username,
								'parent_username'=> $row->parent_username,
                                'parent_relation'=> $parent_relation,
                                'title'=> isset($title)?$title:'',
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'email_id'=>$row->email_id,
                                'contact_number'=>$row->contact_number,
                                'dob'=>$dob,
                                'gender'=>$gender,
                                "marital_status"=>'1',
                                "religious"=>$row->religious,
                                'description'=>$description,
                                'is_completed'=>'1',
                                'maker_date'=>$crr_date,
                                'updater_date'=>$crr_date
                        );

        $this->db->insert($this->main_table,$insertData);
        $sub_patient_id=$this->db->insert_id();

        if($sub_patient_id){
            $username=$first_name.'-'.$row->parent_id.$sub_patient_id;
            $prn="SP-".$row->parent_id.$sub_patient_id;
            $updateData= array(
                                'prn' =>$prn,
                                'username'=>$username,
                                'maker_id'=>$sub_patient_id,
                                'updater_id'=>$sub_patient_id
                            );
            $this->db->update($this->main_table,$updateData,array('ID'=>$sub_patient_id));

            $insertAddressData=array(
                                        'sub_patient_id'=>$sub_patient_id,
                                        "country_code"=>$country_code,
                                        "city_code"=>$row->city_code,
                                        "district_code"=>$row->district_code,
										"district_other"=>$row->district_other,
                                        "postal_code"=>$row->postal_code,
                                        "address_line1"=>$row->address_line1,
                                        "address_line2"=>$row->address_line2,
                                        'maker_id'=>$sub_patient_id,
                                        'maker_date'=>$crr_date,
                                        'updater_id'=>$sub_patient_id,
                                        'updater_date'=>$crr_date
                                    );
            $this->db->insert("sub_patient_address",$insertAddressData);
            
            $insertDocumentData=array(
                                        'sub_patient_id'=>$sub_patient_id,
                                        'maker_id'=>$sub_patient_id,
                                        'maker_date'=>$crr_date,
                                        'updater_id'=>$sub_patient_id,
                                        'updater_date'=>$crr_date
                                    );
            $this->db->insert("sub_patient_documents",$insertDocumentData);
            
            $this->upload_image($parent_username, $username, $file_name='image');
			
			return $username;
        }else{
            return false;  
        }
    }

    public function update_sub_patient(){
        extract($_POST);

         // check parent user is existing or not
         if($this->checkParentExist($parent_username)!=true){
            return false;
        }
        //end
        
        // for security purpose we get ID by username
        $this ->db->select('ID');
        $this->db->from($this->main_table);
        $this->db->where("parent_username",$parent_username);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;  
        }
        $sub_patient_id=$row->ID;
        // end 
        $crr_date=date("Y-m-d H:i:s");

        $updateData=array(
                                'parent_relation'=> $parent_relation,
                                'title'=> isset($title)?$title:'',
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'gender'=>$gender,
                                'dob'=>$dob,
                                'description'=>$description,
                                'updater_id'=>$sub_patient_id,
                                'updater_date'=>$crr_date
                        );
       
        $this->db->update($this->main_table,$updateData,array('ID'=>$sub_patient_id));   
        
         $updateAddressData=[
                                "country_code"=>$country_code,
                                'updater_id'=>$sub_patient_id,
                                'updater_date'=>$crr_date
                            ];
                                    
             $this->db->update("sub_patient_address",$updateAddressData,array('sub_patient_id'=>$sub_patient_id));  
            
        return $username;
    }

    public function sub_patient_health_info($parent_username='',$username=''){
        // check parent user is existing or not
        if($this->checkParentExist($parent_username)!=true){
           return false;
       }
       //end
       
       // check user is existing or not
       if($this->checkExist($username)!=true){
           return false;
       }
       //end
       
        $this ->db->select('blood_group,glucose,heart_rate,blood_pressure,weight,height,bmi,allergies');
        $this->db->from($this->main_table);
        $this->db->where("parent_username",$parent_username);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
        return $result;   
    }  

    public function update_sub_patient_health_info(){
        extract($_POST);
        // for security purpose we get ID by username
        $this ->db->select('ID');
        $this->db->from($this->main_table);
        $this->db->where("parent_username",$parent_username);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;  
        }
        $sub_patient_id=$row->ID;
        // end

        $crr_date=date("Y-m-d H:i:s");
        
        $updateData=[
            'updater_id'=>$sub_patient_id,
            'updater_date'=>$crr_date
        ];

        // for update blood group
        if(isset($blood_group) && $blood_group){
        $updateData['blood_group']=$blood_group;
        }
        //end

        // for update glucose
        if(isset($glucose) && $glucose){
        $updateData['glucose']=$glucose;
        }
        //end

        // for update heart rate
        if(isset($heart_rate) && $heart_rate){
        $updateData['heart_rate']=$heart_rate;
        }
        //end

        // for update blood pressure
        if(isset($blood_pressure) && $blood_pressure){
        $updateData['blood_pressure']=$blood_pressure;
        }
        //end

        // for update weight
        if(isset($weight) && $weight){
        $updateData['weight']=$weight;
        }
        //end

        // for update height
        if(isset($height) && $height){
        $updateData['height']=$height;
        }
        //end

        // for update bmi
        if(isset($bmi) && $bmi){
        $updateData['bmi']=$bmi;
        }
        //end

        // for update allergies
        if(isset($allergies) && $allergies){
        $updateData['allergies']=$allergies;
        }
        //end

        $this->db->update($this->main_table,$updateData,array("ID" =>$sub_patient_id));
        return true;
    }

    public function loadDataById($parent_username='',$username=''){
         // check parent user is existing or not
         if($this->checkParentExist($parent_username)!=true){
            return false;
        }
        //end
        
        // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end
        
       // $ID=(is_numeric($sub_patient_id))?md5($sub_patient_id):$sub_patient_id;
        $this ->db->select('SP.*,SPD.*,SPA.*');
        $this->db->from($this->main_table." as SP");
        $this->db->join("sub_patient_documents as SPD", "SPD.sub_patient_id=SP.ID", "LEFT");
        $this->db->join("sub_patient_address as SPA", "SPA.sub_patient_id=SP.ID", "LEFT");
        $this->db->where("SP.parent_username",$parent_username);
        $this->db->where("SP.username",$username);
        $this->db->where("SP.is_deleted",0);
        $row=$this->db->get()->row();
        $result=[];
        if($row){
            $result=[
                'parent_username'=> $row->parent_username,
                'parent_relation'=> $row->parent_relation,
                "username"=>$row->username,
                "prn"=>$row->prn,
                "title"=>$row->title,
                "first_name"=>$row->first_name,
                "middle_name"=>$row->middle_name,
                "last_name"=>$row->last_name,
                "image"=>$row->image,
                "email_id"=>$row->email_id,
                "contact_number"=>$row->contact_number,
                "gender"=>$row->gender,
                "blood_group"=>$row->blood_group,
                "dob"=>$row->dob,
                "marital_status"=>$row->marital_status,
                "religious"=>$row->religious,
                "country_code"=>$row->country_code,
                "city_code"=>$row->city_code,
                "district_code"=>$row->district_code,
				"district_other"=>$row->district_other,
                "postal_code"=>$row->postal_code,
                "address_line1"=>$row->address_line1,
                "address_line2"=>$row->address_line2,
                "profile_completed"=>$row->is_completed,
                "description"=>$row->description
            ];
        }
        return $result;
    }

    public function checkParentExist($parent_username=''){
        if($parent_username!=''){
            $this->db->select("count(ID) as total");
            $this->db->from("patient");
            $this->db->where("username",$parent_username);
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

    public function checkExist($username=''){
        if($username!=''){
            $this->db->select("count(ID) as total");
            $this->db->from("$this->main_table");
            //$this->db->where("is_deleted",0);
            $this->db->where("username",$username);
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

    public function upload_image($parent_username='',$username='',$file_name=''){
        $this ->db->select('ID');
        $this->db->from($this->main_table);
        $this->db->where("parent_username",$parent_username);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;  
        }
        $ID=$row->ID;
        $oldfile_name='';
        
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("image");
        $this->db->from("sub_patient_documents");
        $this->db->where(array('MD5(sub_patient_id)'=>$ID));
        $row=$this->db->get()->row();
        if(!$row && !isset($row->image)){
            return false;  
        }
        $oldfile_name=$row->image;

        $curr_year=date('Y');
        $curr_month=date('m');
        $dest = $this->config->item('ROOT_DATA_DIR')."sub-patient-profile-image/".$curr_year."/".$curr_month."/";
        $resultData = uploadImg($file_name,$dest);
        
        if($resultData!==false){
            if($oldfile_name!='')remove_uploaded_file($oldfile_name);
            $newFileName=$dest.$resultData['upload_data']['file_name'];

            $updateArray = array("image"=>$newFileName);
            $this->db->where('MD5(sub_patient_id)',$ID);
            $successData = $this->db->update("sub_patient_documents",$updateArray);
            return $newFileName;
        }else{
            return false;
        }
    }

    public function delete_sub_patient($parent_username='',$username=''){
		$crr_date=date("Y-m-d H:i:s");
		
        $this ->db->select('SP.ID,SPD.image');
        $this->db->from($this->main_table." as SP");
        $this->db->join("sub_patient_documents as SPD", "SPD.sub_patient_id=SP.ID", "LEFT");
        $this->db->where("SP.parent_username",$parent_username);
        $this->db->where("SP.username",$username);
        $this->db->where("SP.is_deleted",0);
        $this->db->where("SP.show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;  
        }

        $ID=$row->ID;
        $image=$row->image;
        $updateData=array('is_deleted'=>1);
        if($image!='')remove_uploaded_file($image);
		
        // for user main table    
        $this->db->where("ID", $ID);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end
		
        // for user document table
        $this->db->where("sub_patient_id", $ID);
        //$this->db->update("sub_patient_documents",$updateData);
        $this->db->delete("sub_patient_documents");
        //end

        // for user address table     
        $this->db->where("sub_patient_id", $ID);
        //$this->db->update("sub_patient_address",$updateData);
        $this->db->delete("sub_patient_address");
        //end
        return true;
    }

}