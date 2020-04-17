<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="patient";
    }

	public function get_basic_details($username=''){
		if($username!=''){
			$this ->db->select('P.prn,P.patient_group,P.maker_date as account_creation_date,P.updater_date as account_updation_date');
			$this->db->from($this->main_table." as P");
			$this->db->where("username",$username);
			$this->db->where("P.is_deleted",0);
			$result=$this->db->get()->row();
			if($result && $result->prn!=''){
				$this->db->group_start();
				$this->db->where('username',$username);
				$this->db->or_where('parent_username',$username);
				$this->db->group_end();
				$this->db->where("is_read",0);
				$this->db->where("is_deleted",0);
				$total_notification = $this->db->count_all_results('patient_notification_history');
				
				$result->total_notification=$total_notification;
			}else if($result && $result->prn==''){
				$result->total_notification=0;
			}

			return $result;
		}
		return false;
	}



    public function get_select_box($username=''){
        $this ->db->select('P.prn,CONCAT(P.first_name," ",P.middle_name," ",P.last_name) AS name');
        $this->db->from($this->main_table." as P");
        $this->db->where('P.username',$username);
        $this->db->where('P.is_deleted=',0);
        $this->db->where('P.show_status=',1); 
        $result_patient=$this->db->get()->row();
        if($result_patient){
            $result[]=[
                'prn'=>$result_patient->prn,
                'name'=>$result_patient->name,
                'is_parent'=>'1'
                ];

            $this ->db->select('SP.prn, CONCAT(SP.first_name," ",SP.middle_name," ",SP.last_name) AS name');
            $this->db->from("sub_patient as SP");
            $this->db->where('SP.parent_prn',$result_patient->prn);
            $this->db->where('SP.is_deleted=',0);
            $this->db->where('SP.show_status=',1); 
            $result_sub_patient=$this->db->get()->result();
            if($result_sub_patient){
               foreach($result_sub_patient as $sub_patient_value){
                    $result[]=[
                        'prn'=>$sub_patient_value->prn,
                        'name'=>$sub_patient_value->name,
                        'is_parent'=>'0'
                        ];
               }    
            }
        }else{
            $result=[];
        }

        return $result;
    }

    public function add_patient(){
        extract($_POST);
        if($this->checkExist($username)==true){
            return false;
        }

        $crr_date=date("Y-m-d H:i:s");
		$crr_time=date("H:i:s");
	   
        $insertData=array(
                                'username'=>$username,
                                'first_device_id'=>$device_id,
                                'notification_token'=>$notification_token,   //Firebase Cloud Messaging mobile device token
                                'device_type'=>$device_type,
                                'title'=> isset($title)?$title:'',
								'first_name'=>$first_name,
								'middle_name'=>isset($middle_name)?$middle_name:'',
                                'last_name'=>isset($last_name)?$last_name:'',
                                'password'=> generateHashShaKey($password),
                                'email_id'=>$email_id,
                                'contact_number'=>$contact_number,
                                'maker_date'=>$crr_date,
                                'updater_date'=>$crr_date
                        );
						
		// for signup from social media authontication 
		if(isset($_POST['siginup_social_media']) && $_POST['siginup_social_media']!=''){
			$insertData['siginup_social_media']=$_POST['siginup_social_media'];
		}
		//end

        $this->db->insert($this->main_table,$insertData);
        $patient_id=$this->db->insert_id();

        if($patient_id){
            $insertAddressData=array(
                                        'patient_id'=>$patient_id,
                                        'maker_id'=>$patient_id,
                                        'maker_date'=>$crr_date,
                                        'updater_id'=>$patient_id,
                                        'updater_date'=>$crr_date
                                    );
									
            $this->db->insert("patient_address",$insertAddressData);

            $insertDocumentData=array(
                                        'patient_id'=>$patient_id,
                                        'maker_id'=>$patient_id,
                                        'maker_date'=>$crr_date,
                                        'updater_id'=>$patient_id,
                                        'updater_date'=>$crr_date
                                    );
									
            $this->db->insert("patient_documents",$insertDocumentData);
			
			// save notification for generate PNR number request
			$title="You don't have the Patient Number";
			$description="You don't have the Patient Number of Hanh Phuc Hospital yet. Please contact Customer Service of Hospital by phone number: 19006765 or contact via Chat function for support. Thank you.";
			$title_vi="Bạn chưa có mã số bệnh nhân.";
			$description_vi="Bạn chưa có mã số bệnh nhân của Bệnh Viện Quốc Tế Hạnh Phúc. Vui lòng liên hệ Bộ phận Chăm sóc Khách Hàng qua số : 1900 6765 hoặc liên hệ qua công cụ Chat trong ứng dụng để được hỗ trợ. Xin cám ơn.";
			
			$notficationData1=[
                    'username'=>$username,
                    'module_name'=> 'patient',
                    'module_id'=> $patient_id,
                    'title'=>$title,
                    'description'=>$description,
					'title_vi'=>$title_vi,
                    'description_vi'=>$description_vi,
                    'created_date'=>$crr_date,
                    'created_time'=>$crr_time,
                    'maker_id'=>'0',
                    'maker_date'=>$crr_date,
                    'updater_id'=>'0',
                    'updater_date'=>$crr_date
                ];

            $this->db->insert("patient_notification_history",$notficationData1);
			// end
			
			// save notification for complete profile request
			$title="Please complete your profile.";
			$description="Please complete your profile.";
			$title_vi="Vui lòng điền đầy đủ thông tin.";
			$description_vi="Vui lòng điền đầy đủ thông tin.";
			
			$notficationData2=[
                    'username'=>$username,
                    'module_name'=> 'patient_profile',
                    'module_id'=> $patient_id,
                    'title'=>$title,
                    'description'=>$description,
					'title_vi'=>$title_vi,
                    'description_vi'=>$description_vi,
                    'created_date'=>$crr_date,
                    'created_time'=>$crr_time,
                    'maker_id'=>'0',
                    'maker_date'=>$crr_date,
                    'updater_id'=>'0',
                    'updater_date'=>$crr_date
                ];

            $this->db->insert("patient_notification_history",$notficationData2);
			// end
			
            return $patient_id;
        }else{
            return false;  
        }
    }

    public function update_patient(){
        extract($_POST);
       // for security purpose we get ID by username
        $this ->db->select('ID');
        $this->db->from($this->main_table);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;   // if username not existed 
        }
        $patient_id=$row->ID;
        // end

        $crr_date=date("Y-m-d H:i:s");
        $updateData=array(
                                'title'=> isset($title)?$title:'',
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'email_id'=>$email_id,
                                'contact_number'=>$contact_number,
								'emergency_name'=> isset($emergency_name)?$emergency_name:'',
								'emergency_relationship'=> isset($emergency_relationship)?$emergency_relationship:'',
								'emergency_contact'=> isset($emergency_contact)?$emergency_contact:'',
								'personal_ID_code'=>$personal_ID_code,
                                'gender'=>$gender,
                                'dob'=>$dob,
                                "marital_status"=>$marital_status,
                                "religious"=>isset($religious)?$religious:'',
								//"patient_group"=>$patient_group,
                                "description"=>$description,
								'is_completed'=>'1',
                                "updater_id"=>$patient_id,
                                "updater_date"=>$crr_date
                        );
       
        $this->db->update($this->main_table,$updateData,array('ID'=>$patient_id));

        $updateAddressData=[
                            "country_code"=>$country_code,
                            "city_code"=>$city_code,
                            "district_code"=>isset($district_code)?$district_code:'',
							"district_other"=>isset($district_other)?$district_other:'',
                            "postal_code"=>isset($postal_code)?$postal_code:'',
                            "address_line1"=>$address_line1,
                            "address_line2"=>$address_line2,
                            'updater_id'=>$patient_id,
                            'updater_date'=>$crr_date
                            ];

        $this->db->update("patient_address",$updateAddressData,array('patient_id'=>$patient_id));

        $updateDocumentData=array(
                                    'updater_id'=>$patient_id,
                                    'updater_date'=>$crr_date
                                );

        $this->db->update("patient_documents",$updateDocumentData,array('patient_id'=>$patient_id));
        return true;
    }
	
	 public function update_patient_group(){
        extract($_POST); 
       // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end
		$crr_date=date("Y-m-d H:i:s");
		
        $updateData=['patient_group'=>$patient_group,'updater_date'=>$crr_date];
        $response=$this->db->update($this->main_table,$updateData,array("username" =>$username));
        if($response){
            return true;
        }else{
            return false;
        }
    }
	
    public function update_notification_token(){
        extract($_POST); 
       // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end
		$default_language=(isset($language) && ($language=='vi' || $language=='en'))?$language:'en';
        $updateData=[
						'notification_token'=>$notification_token,
						'default_language'=>$default_language
					];
        $response=$this->db->update($this->main_table,$updateData,array("username" =>$username));
        if($response){
            return true;
        }else{
            return false;
        }
    }

    public function patient_health_info($username=''){
        // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end
        
        $this ->db->select('blood_group,glucose,heart_rate,blood_pressure,weight,height,bmi,allergies');
        $this->db->from($this->main_table);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }

    public function update_patient_health_info(){
        extract($_POST);
        // for security purpose we get ID by username
        $this ->db->select('ID');
        $this->db->from($this->main_table);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;   // if username not existed 
        }
        $patient_id=$row->ID;
        // end

        $crr_date=date("Y-m-d H:i:s");
        $updateData=[
            'updater_id'=>$patient_id,
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
       
        $this->db->update($this->main_table,$updateData,array("ID" =>$patient_id));
        return true;
    }


    public function loadDataById($username=''){
        // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end
        
       // $ID=(is_numeric($patient_id))?md5($patient_id):$patient_id;
        $this ->db->select('P.*,PD.*,PA.*,');
        $this->db->from($this->main_table." as P");
        $this->db->join("patient_documents as PD", "PD.patient_id=P.ID", "LEFT");
        $this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
        $this->db->where("username",$username);
        $this->db->where("P.is_deleted",0);
        $row=$this->db->get()->row();
        $result=[];
        if($row){
            $result=[
                //"patient_id"=>$row->ID,
                "username"=>$row->username,
                "prn"=>$row->prn,
                "title"=>$row->title,
                "first_name"=>$row->first_name,
                "middle_name"=>$row->middle_name,
                "last_name"=>$row->last_name,
                "image"=>$row->image,
				"patient_group"=>$row->patient_group,
                "email_id"=>$row->email_id,
                "contact_number"=>$row->contact_number,
				"emergency_name"=>$row->emergency_name,
				"emergency_relationship"=>$row->emergency_relationship,
				"emergency_contact"=>$row->emergency_contact,
				"personal_ID_code"=>$row->personal_ID_code,
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

	public function getUsernameByPRN($prn=''){
        if($prn!=''){
            $this->db->select("username");
            $this->db->from($this->main_table);
            $this->db->where("is_deleted",0);
            $this->db->where("prn",$prn);
            $result=$this->db->get()->row();
            if($result){
               return $result->username;
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
            $this->db->from($this->main_table);
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
	
	public function checkExistEmail($email_id='',$username=''){
        if($username!=''){
            $this->db->select("count(ID) as total");
            $this->db->from($this->main_table);
            //$this->db->where("is_deleted",0);
			if($username!='')$this->db->where("username !=",$username);
            $this->db->where("email_id",$email_id);
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
	
	public function checkExistContactNumber($contact_number='',$username=''){
        if($username!=''){
            $this->db->select("count(ID) as total");
            $this->db->from($this->main_table);
            //$this->db->where("is_deleted",0);
			if($username!='')$this->db->where("username !=",$username);
            $this->db->where("contact_number",$contact_number);
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
	
    public function reset_password($username,$password){
        extract($_POST);
        // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end
        $updateArray = array( 'password'=>generateHashShaKey($password));
        $this->db->where('username',$username);
        $successData = $this->db->update($this->main_table,$updateArray);
        return true;
    }

    public function update_password($username=''){
        extract($_POST); 
       // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end

        $oldPassword=generateHashShaKey($old_password);
        $newPassword=generateHashShaKey($password);

        $this->db->select("ID,password");
        $this->db->from($this->main_table);
        $this->db->where(array('username'=>$username,'password'=>$oldPassword));
        $result=$this->db->get()->row();
        
        if($result && $result->password == $oldPassword){
            $updateArray = array( 'password'=>$newPassword);
            $this->db->where('username',$username);
            $successData = $this->db->update($this->main_table,$updateArray);
            return $result->ID;
        }
        else{
            return false;
        }
    }

    public function upload_image($username='', $file_name=''){
        $this ->db->select('ID');
        $this->db->from($this->main_table);
        $this->db->where("username",$username);
        $this->db->where("is_deleted",0);
        $this->db->where("show_status",1);
        $row=$this->db->get()->row();
        if(!$row && !isset($row->ID)){
            return false;  
        }
        $ID=$row->ID;

        $oldfile_name='';
        if($ID==''){
            return false;
        }

        //print_r($file_name);die();
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("image");
        $this->db->from("patient_documents");
        $this->db->where(array('MD5(patient_id)'=>$ID));
        $row=$this->db->get()->row();
        if(!$row && !isset($row->image)){
            return false;  
        }
        $oldfile_name=$row->image;
        

        //print_r($oldfile_name);
        $curr_year=date('Y');
        $curr_month=date('m');
        $dest = $this->config->item('ROOT_DATA_DIR')."patient-profile-image/".$curr_year."/".$curr_month."/";
        $resultData = uploadImg($file_name,$dest);
        if($resultData!==false){
            if($oldfile_name!='')remove_uploaded_file($oldfile_name);
            $newFileName=$dest.$resultData['upload_data']['file_name'];

            $updateArray = array("image"=>$newFileName);
            $this->db->where('MD5(ID)',$ID);
            $successData = $this->db->update("patient_documents",$updateArray);
            return $newFileName;
        }else{
            return false;
        }
    }

    public function checkLogin($username, $password, $device_id){
        if($username!= '' && $password != ''){
            $this ->db->select('P.*,P.ID as patient_id,P.is_completed,PD.image');
            $this->db->from($this->main_table." as P");
            $this->db->join("patient_documents as PD",'patient_id=P.ID','LEFT');
            $this->db->group_start();
			$this->db->where('username',$username);
			$this->db->or_where('email_id',$username);
			$this->db->group_end();
            $this->db->where('password',generateHashShaKey($password));
			$row= $this->db->get()->row();
           
            if($row){
                if($row->show_status == '1') {
                    $this->UpdateSigninTime($row->ID, $device_id);
                    $result=[
                        "patient_id"=>$row->patient_id,
                        "username"=>$row->username,
                        "prn"=>$row->prn,
                        "title"=>$row->title,
                        "first_name"=>$row->first_name,
                        "middle_name"=>$row->middle_name,
                        "last_name"=>$row->last_name,
                        "image"=>$row->image,
                        "email_id"=>$row->email_id,
                        "contact_number"=>$row->contact_number,
                        "profile_completed"=>$row->is_completed,
                        "notification_token"=>$row->notification_token,
						"creation_date"=>$row->maker_date,
                        "updation_date"=>$row->updater_date
                    ];

                    $data=["status"=>"1", "message"=>"Successfully login.","data"=>$result];
                    return $data;
                }else{
                    $data=["status"=>"0", "message"=>"Your account has been currently deactivated. Please contact to customer care for any support.","data"=>array()];
                    return $data; 
                }
            }else{
                $data=["status"=>"0", "message"=>"Username or Password has been incorrect.","data"=>array()];
                return $data;
            }
        }
    }

	public function checkLoginSocialMedia($username, $password, $device_id){
        if($username!= '' && $password != '' && $username==$password){
            $this ->db->select('P.*,P.ID as patient_id,P.is_completed,PD.image');
            $this->db->from($this->main_table." as P");
            $this->db->join("patient_documents as PD",'patient_id=P.ID','LEFT');
            $this->db->group_start();
			$this->db->where('username',$username);
			$this->db->or_where('email_id',$username);
			$this->db->group_end();
			$this->db->where('siginup_social_media','1');
            //$this->db->where('password',generateHashShaKey($password));
            $row= $this->db->get()->row();
            
            if($row){
                if($row->show_status == '1') {
                    $this->UpdateSigninTime($row->ID, $device_id);
                    $result=[
                        "patient_id"=>$row->patient_id,
                        "username"=>$row->username,
                        "prn"=>$row->prn,
                        "title"=>$row->title,
                        "first_name"=>$row->first_name,
                        "middle_name"=>$row->middle_name,
                        "last_name"=>$row->last_name,
                        "image"=>$row->image,
                        "email_id"=>$row->email_id,
                        "contact_number"=>$row->contact_number,
                        "profile_completed"=>$row->is_completed,
                        "notification_token"=>$row->notification_token,
						"creation_date"=>$row->maker_date,
                        "updation_date"=>$row->updater_date
                    ];

                    $data=["status"=>"1", "message"=>"Successfully login.","data"=>$result];
                    return $data;
                }else{
                    $data=["status"=>"0", "message"=>"Your account has been currently deactivated. Please contact to customer care for any support.","data"=>array()];
                    return $data; 
                }
            }else{
                $data=["status"=>"0", "message"=>"Username or Password has been incorrect.","data"=>array()];
                return $data;
            }
        }
    }

    public function UpdateSigninTime($patient_id='', $device_id=''){
        if($patient_id!=''){
            $ID=(is_numeric($patient_id))?md5($patient_id):$patient_id;
            $current_date=date('y-m-d h:m:i');
            $this->db->where('MD5(ID)', $ID);
            $this->db->update($this->main_table,array("last_device_id"=> $device_id, "last_login"=>$current_date));
            return true;
        }
    }

    public function checkLogout($username){
        // check user is existing or not
        if($this->checkExist($username)!=true){
            return false;
        }
        //end

        $current_date=date('y-m-d h:m:i');
        $this->db->where('username',$username);
        $this->db->update($this->main_table,array("last_logout"=>$current_date));
        return true;
    }


}
