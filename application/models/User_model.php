<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="user";
    }

    public function getData($is_active=''){
        $this->db->select("U.*, UR.name as role_name");
        $this->db->from($this->main_table." U");
        $this->db->join("user_role as UR",'UR.ID=U.role_id','LEFT');
        $this->db->where("U.ID!=",1);
		if($is_active==1)$this->db->where("U.show_status",1);
        $this->db->where("U.is_deleted",0);
		$this->db->where("U.ID!=",$this->LOGINID);
		
		// for super admin
		if($this->ROLEID=='2'){
			 $this->db->group_start();
			 $this->db->where("U.role_id",2);
			 $this->db->or_where("U.maker_id",$this->LOGINID);
			 $this->db->group_end();
		}
		//end
		
        // for manager
		if($this->ROLEID=='3'){
			 $this->db->where("U.maker_id",$this->LOGINID);
		}
		//end 
		
		$this->db->order_by('U.ID','DESC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query(); echo "<br/><pre>";print_r($result);;die();
        return $result;
    }

    public function add_user(){
        extract($_POST);
		//echo "<pre>";print_r($_POST);die;
        if($this->checkExist($user_name)==false){
            $LOGINID=$this->LOGINID;
            $date=date("Y-m-d H:i:s");
            $role_type='Employee';
            //$dob=datepikerDateTime($dob,"Y-m-d","Y-m-d");
 			$pass_word=generateHashShaKey($password);
            $insertData=array('user_name'=>$user_name,
                'team'=>$team,
				'role_type'=>$role_type,
                'role_id'=>$role_id,
                'title'=>$title,
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'user_password'=>$pass_word,
                'email_id'=>$email_id,
                //'contact_number'=>$contact_number,
                //'alternet_contact_number'=>$alternet_contact_number,
                //'gender'=>$gender,
                //'blood_group'=>$blood_group,
                //'dob'=>$dob,
                'description'=>$description,
                'maker_id'=>$LOGINID,
                'maker_date'=>$date,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date,
            );


            $this->db->insert($this->main_table,$insertData);
            $user_id=$this->db->insert_id();

            if($user_id){
                $ern="HANH-".$user_id;
                $updateData= array('ern'=>$ern);
                $this->db->update($this->main_table,$updateData,array('ID'=>$user_id));

                $insertAddressData=array('user_id'=>$user_id,
                    //'country_code'=>$country_code,
                    //'district_code'=>$district_code,
                    //'postal_code'=>$postal_code,
                    //'address_line1'=>$address_line1,
                    //'address_line2'=>$address_line2,
                    'maker_id'=>$LOGINID,
                    'maker_date'=>$date,
                );

                $this->db->insert("user_address",$insertAddressData);
				
                $insertDocumentData=array('user_id'=>$user_id,
                    'is_completed'=>'1',
                    'maker_id'=>$LOGINID,
                    'maker_date'=>$date,
                );

                $this->db->insert("user_documents",$insertDocumentData);
				
				$fileInputboxName='image';
                if(isset($_FILES[$fileInputboxName])){
					$this->upload_image($user_id,$fileInputboxName);
				}
				
				$this->addedit_module_permission($user_id);
				
                setFlashMsg('success_message',"Employee has been created successfully.",'alert-success');
                //$userData=array('ID'=>$user_id,'date'=>date("Y-m-d",strtotime($date)));
                return $user_id;
            }else{
                setFlashMsg('success_message',"Server down please try after some time.",'alert-info');
            }
        }else{
			setFlashMsg('success_message',"This username has been registered already.",'alert-danger');
		}
        return true;
    }
	
    public function edit_user(){
        extract($_POST);
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $LOGINID=$this->LOGINID;
        $LOGINROLEID=$this->LOGINROLEID;
        $date=date("Y-m-d H:i:s");
       // $dob=datepikerDateTime($dob,"Y-m-d","Y-m-d");//die();
        //echo "<pre>"; print_r($_POST); die;

        $updateData=array(
				'team'=>$team,
                'role_id'=>$role_id,
                'title'=>$title,
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'email_id'=>$email_id,
                //'contact_number'=>$contact_number,
                //'alternet_contact_number'=>$alternet_contact_number,
                //'gender'=>$gender,
                //'blood_group'=>$blood_group,
                //'dob'=>$dob,
                'description'=>$description,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date
        );
       
        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));

        $updateAddressData=array(
                           // 'country_code'=>$country_code,
                           // 'district_code'=>$district_code,
                           // 'postal_code'=>$postal_code,
                           // 'address_line1'=>$address_line1,
                           // 'address_line2'=>$address_line2,
                            'updater_id'=>$LOGINID,
                            'updater_date'=>$date
                        );

        $this->db->update("user_address",$updateAddressData,array('MD5(user_id)'=>$ID));

        $updateDocumentData=array('is_completed'=>'1',
                                'updater_id'=>$LOGINID,
                                'updater_date'=>$date
                            );

        $this->db->update("user_documents",$updateDocumentData,array('MD5(user_id)'=>$ID));
		
		if(isset($module_id) && $module_id){
			$this->addedit_module_permission($userID);
		}
		
        setFlashMsg('success_message',"Employee has been updated successfully.",'alert-success');
        return true;
    }
	
	public function addedit_module_permission($user_id=''){ 
    	extract($_POST); 
		
    	$crr_date=date("Y-m-d H:i:s");
    	$LOGINID=$this->LOGINID;
    	$ROWID=$ID;
    	
		if($module_id && count($module_id)>0){
			foreach($module_id as $key=>$value){
			$data=[
					'all_btn'=>isset($all_btn[$key])?$all_btn[$key]:'0',
					'add_btn'=>isset($add_btn[$key])?$add_btn[$key]:'0',
					'view_btn'=>isset($view_btn[$key])?$view_btn[$key]:'0',
					'edit_btn'=>isset($edit_btn[$key])?$edit_btn[$key]:'0',
					'delete_btn'=>isset($delete_btn[$key])?$delete_btn[$key]:'0',
					'status_btn'=>isset($status_btn[$key])?$status_btn[$key]:'0',
					'print_btn'=>isset($print_btn[$key])?$print_btn[$key]:'0',
					'other_btn'=>isset($other_btn[$key])?$other_btn[$key]:'0',
				];
						
			if($UMP_ID[$key]!=''){
				$this->db->update("user_module_permission",$data,array('ID'=>$UMP_ID[$key],'user_id'=>$user_id,'module_id'=>$module_id[$key]));
			}else{
				$data['user_id']=$user_id;
				$data['module_id']=$module_id[$key];
				$this->db->insert("user_module_permission", $data); 
			}			
						
			}	
		}
		return true;
	}
	
	public function getModulList($is_active='',$user_id=''){	
		$this ->db->select('M.*');
		$this->db->from("module M");
		if($is_active!='')$this->db->where('M.show_status',1);	
		$this->db->order_by('M.id,M.parent_id','ASC');
		$result=$this->db->get()->result();
		foreach($result as $key=>$value){
			
			// for check parent authority
			$this ->db->select('UMP.*,UMP.ID as UMP_ID');	
			$this->db->where('UMP.user_id',$this->LOGINID);
			$this->db->where('UMP.module_id',$value->ID);
			$this->db->from("user_module_permission UMP");
			$result2=$this->db->get()->row();
			
			$all_btn=($result2)?$result2->all_btn:0;
			$add_btn=($result2)?$result2->add_btn:0;
			$edit_btn=($result2)?$result2->edit_btn:0;
			$view_btn=($result2)?$result2->view_btn:0;
			$delete_btn=($result2)?$result2->delete_btn:0;
			$status_btn=($result2)?$result2->status_btn:0;
			$print_btn=($result2)?$result2->print_btn:0;
			$other_btn=($result2)?$result2->other_btn:0;
			
			// if parent haven't permission then remove module for child
			if($add_btn!='1' && $edit_btn!='1' && $view_btn!='1' && $delete_btn!='1' && $print_btn!='1'){
				unset($result[$key]);
				continue;
			}
			//end
			
			// for check self authority
			$this ->db->select('UMP.*,UMP.ID as UMP_ID');	
			$this->db->where('UMP.user_id',$user_id);
			$this->db->where('UMP.module_id',$value->ID);
			$this->db->from("user_module_permission UMP");
			$result3=$this->db->get()->row();
			//echo $this->db->last_query();
			//echo "<pre>";print_r($result3);die;
			
			$UMP_ID=($result3)?$result3->UMP_ID:'';
			$all_btn=($result3)?$result3->all_btn:0;
			$add_btn=($result3)?$result3->add_btn:0;
			$edit_btn=($result3)?$result3->edit_btn:0;
			$view_btn=($result3)?$result3->view_btn:0;
			$delete_btn=($result3)?$result3->delete_btn:0;
			$status_btn=($result3)?$result3->status_btn:0;
			$print_btn=($result3)?$result3->print_btn:0;
			$other_btn=($result3)?$result3->other_btn:0;
			
			$value->UMP_ID=$UMP_ID;
			$value->all_btn=$all_btn;
			$value->add_btn=$add_btn;
			$value->view_btn=$view_btn;
			$value->edit_btn=$edit_btn;
			$value->delete_btn=$delete_btn;
			$value->status_btn=$status_btn;
			$value->print_btn=$print_btn;
			$value->other_btn=$other_btn;
			//end
		}	
	
		//echo "<pre>";print_r($result);die;
		return $result;
    }	
	
	
    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("U.*,UD.*,UA.*,U.ID as user_id, UR.name as role_name");
        $this->db->from($this->main_table." as U");
        $this->db->join("user_documents as UD", "UD.user_id=U.ID", "LEFT");
        $this->db->join("user_address as UA", "UA.user_id=U.ID", "LEFT");
        $this->db->join("user_role as UR",'UR.ID=U.role_id','LEFT');
        $this->db->where("MD5(U.ID)",$ID);
        $this->db->where("U.is_deleted",0);
        $result=$this->db->get()->row();
		$result->getModulList=$this->getModulList('1', $result->user_id);
		
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image!=''){
            $result->image=$result->image;
        }else{
            $result->image=$NoImage;
        }
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function checkExist($user_name=''){
		$user_name=($user_name!='')?$user_name:$_POST['user_name'];
		if($user_name!=''){
			$this->db->select("count(ID) as total");
			$this->db->from($this->main_table);
			//$this->db->where("is_deleted",0);
			$this->db->where("user_name",$user_name);
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
            $newPassword=generateHashShaKey($password);
            if($password!=''){
                $updateArray = array( 'user_password'=>$newPassword);
                $this->db->where('MD5(ID)',$ID);
                $this->db->update($this->main_table,$updateArray);
				//echo $this->db->last_query(); die;
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


    public function change_password($ID=''){
        extract($_POST); //print_r($_POST);
        if($confirm_password == $password){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldPassword=generateHashShaKey($old_password);
            $newPassword=generateHashShaKey($password);
 

            $this->db->select("user_password");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID,'user_password'=>$oldPassword));
            $result=$this->db->get()->row();
            $user_password = ($result)?$result->user_password:'';

            if($user_password!='' && $user_password == $oldPassword){
                $updateArray = array( 'user_password'=>$newPassword);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                setFlashMsg('success_message',"Password has been changed successfully.",'alert-success');
                return true;
            }
            else{
                setFlashMsg('success_message',"Please input correct old password.",'alert-danger');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Please input a valid confirm Password.",'alert-danger');
            return false;
        }
    }
    
    public function upload_image($ID='', $fileInputboxName=''){
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldfile_name='';
            $this->db->select("image");
            $this->db->from("user_documents");
            $this->db->where(array('MD5(user_id)'=>$ID));
            $row=$this->db->get()->row();
			//echo $this->db->last_query();die;
            if(!$row && !isset($row->image)){
                return false;  
            }
            
            $oldfile_name=$row->image;
            $fileInputboxName =($fileInputboxName!='')?$fileInputboxName:$_POST['fileInputboxName'];
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."user-profile-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($fileInputboxName,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
    
                $updateArray = array("image"=>$newFileName);
                $this->db->where('MD5(user_id)',$ID);
                $successData = $this->db->update("user_documents",$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Employee ID is missing.",'alert-info');
            return false;
        }    
    }
	
    public function delete_user_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end

        // for user document table
        $this->db->select("image");
        $this->db->from("user_documents");
        $this->db->where_in("MD5(user_id)", $IDS);
        $this->db->where("image !=", '');
        $result=$this->db->get()->result();
        if($result){
            foreach($result as $value){
                if($value->image!='')remove_uploaded_file($value->image); 
            }
        }
        
        $this->db->where_in("MD5(user_id)", $IDS);
        //$this->db->update("user_documents",$updateData);
        $this->db->delete("user_documents");
        //end

        // for user address table     
        $this->db->where_in("MD5(user_id)", $IDS);
        //$this->db->update("user_address",$updateData);
        $this->db->delete("user_address");
        //end
		// for user module permission table     
        $this->db->where_in("MD5(user_id)", $IDS);
        //$this->db->update("user_module_permission",$updateData);
        $this->db->delete("user_module_permission");
        //end
		
        echo "Employee has been deleted successfully.";
        return;
    }


}