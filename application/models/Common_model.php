<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
	public $MESSAGE;
	
	public function getwebsiteconfig($ID='1'){
		$ID=(is_numeric($ID))?md5($ID):$ID;	
		$this ->db->select('*');
		$this->db->from(tblprefix("websitesetting"));
		$this->db->where("MD5(ID)",$ID);
		$result=$this->db->get()->row();
		$NoImage='assets/images/icon/not-available.jpg';
		if($result && $result->logo!=''){$result->logo=$result->logo;}else{$result->logo=$NoImage;}
		return $result;
	}
	
	public function update_websiteconfig($value=''){
		$this->MESSAGE= $this->config->item('MESSAGE');
		$postData=$this->input->post();
		$ID=$postData['ID'];
		$ID=(is_numeric($ID))?md5($ID):$ID;	
	
		$updateData=array('website_name'=>$postData['website_name'],
						  'smtpmail_host'=>$postData['smtpmail_host'],
						  'smtpmail_port'=>$postData['smtpmail_port'],
						  'smtpmail_mail'=>$postData['smtpmail_mail'],
						  'smtpmail_password'=>$postData['smtpmail_password'],
						  'customer_care_no'=>$postData['customer_care_no'],
						  'map_api_key'=>$postData['map_api_key'],
                          'updater_date'=>date("Y-m-d H:i:s"),
						  'updater_id'=>$this->LOGINID,
						  );
						  
		$this->db->where("MD5(ID)",$ID);
		$this->db->update(tblprefix("websitesetting"),$updateData);

		setFlashMsg('success_message','Website setting updated successfully','alert-success');
		$result=$this->setSiteConfig($ID);
		return true;
	}
	
	public function change_image($ID='', $file_name=''){
		$oldfile_name='';
		$ID=(isset($_POST['ID']))?$_POST['ID']:$ID;
		$file_name =($file_name=='')?$this->input->post('file_name'):$file_name;
		
		if($ID!=''){
		$ID=(is_numeric($ID))?md5($ID):$ID;
		$this->db->select($file_name);
		$this->db->from(tblprefix("websitesetting"));
		$this->db->where(array('MD5(ID)'=>$ID));
		$oldfile_name=$this->db->get()->row()->$file_name;
		}
		
		$dest = $this->config->item('ROOT_DATA_DIR').$file_name."/";
		$resultData = uploadImg($file_name,$dest);
		
		if($resultData!==false){
		if($oldfile_name!='')remove_uploaded_file($oldfile_name); 
		$newFileName=$dest.$resultData['upload_data']['file_name'];
		
		$updateArray = array($file_name=>$newFileName);
	 
		$this->db->where('MD5(ID)',$ID);
		$successData = $this->db->update(tblprefix("websitesetting"),$updateArray);
		
		setFlashMsg('success_message',"Logo image Uploaded successfully",'alert-success');
		return $newFileName; 
		}else{
		setFlashMsg('success_message',"Some problem occor please try again later",'alert-info');	
		}	
	}
	
	public function setSiteConfig($ID='1'){
		$result=$this->getwebsiteconfig($ID);
		//print_r($result);die;
		$this->config->set_item('WEBSITE_NAME',$result->website_name);
		$this->config->set_item('CUSTOMER_CARE',$result->customer_care_no);
        $this->config->set_item('WEBSITE_LOGO',$result->logo);
		$this->config->set_item('SMTPEMAIL_HOST',$result->smtpmail_host);
		$this->config->set_item('SMTPEMAIL_PORT',$result->smtpmail_port);
		$this->config->set_item('SMTPEMAIL_EMAIL',$result->smtpmail_mail);
		$this->config->set_item('SMTPEMAIL_USERNAME',$result->smtpmail_username);
		$this->config->set_item('SMTPEMAIL_PASS',$result->smtpmail_password);
}
	
	public function getModules($is_active=''){
		$premissionModule=array();
		$LOGINID=$this->LOGINID;
		$LOGINROLEID=$this->LOGINROLEID;
		$where = '(UM.add_btn="1" or UM.edit_btn="1" or UM.view_btn = "1" or UM.delete_btn = "1" or UM.status_btn = "1" or UM.print_btn = "1" or UM.other_btn = "1")';
		$where_not=array("8","0");
		$this ->db->select('M.ID,M.module_name,M.module_url,M.icon');
		$this->db->from(tblprefix("module").' M');
		$this->db->where_not_in('M.ID',$where_not);			// for not show in sidebar loop
		$this->db->where('M.parent_id','0');
		if($is_active)$this->db->where('M.show_status','1');
		$this->db->where('M.is_deleted','0');
		
		//start
		//$this->db->join(tblprefix("user_module").' UM','UM.module_id=M.ID','LEFT');
		//$this->db->where('UM.role_id',$LOGINROLEID);
		//OR
		$this->db->join(tblprefix("user_module_permission").' UM','UM.module_id=M.ID','LEFT');
		$this->db->where('UM.user_id',$LOGINID);
		//end
		
        $this->db->where('UM.show_status','1');
        $this->db->where('UM.is_deleted','0');
		$this->db->where($where);
		$this->db->order_by('short_by','ASC');
		$result=$this->db->get()->result();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($result);die;
		if($result){
			foreach ($result as  $value) {
			$this ->db->select('M.ID,M.module_name,M.module_url,M.icon');
			$this->db->from(tblprefix("module").' M');
			$this->db->where_not_in('M.ID',$where_not);			// for not show in sidebar loop
			$this->db->where('M.parent_id',$value->ID);
			if($is_active)$this->db->where('M.show_status','1');
			$this->db->where('M.is_deleted','0');
			//start
			//$this->db->join(tblprefix("user_module").' UM','UM.module_id=M.ID','LEFT');
			//$this->db->where('UM.role_id',$LOGINROLEID);
			//OR
			$this->db->join(tblprefix("user_module_permission").' UM','UM.module_id=M.ID','LEFT');
			$this->db->where('UM.user_id',$LOGINID);
			//end
			$this->db->where('UM.show_status','1');
			$this->db->where('UM.is_deleted','0');
			$this->db->where($where);
			$this->db->order_by('short_by','ASC');
			$childlist=$this->db->get()->result();
			foreach($childlist as $child){
				$value->childsurl[]=$child->module_url;
			}
			$value->childtotal=count($childlist);	
			$value->childlist=$childlist;
			}
		}
		//echo "<pre>";print_r($result);die;
		return $result;
	}
	
	public function modulePermission($value=''){ 
		$premissionModule=array();
		$LOGINID=$this->LOGINID;
		$LOGINROLEID=$this->LOGINROLEID;
		$this ->db->select('module_id,add_btn,view_btn,edit_btn,delete_btn,status_btn,print_btn,other_btn');
		//start
		//$this->db->from(tblprefix("user").' U');
		//$this->db->where('U.ID',$LOGINID);
		//$this->db->join(tblprefix("user_documents").' UD','UD.user_id=U.ID','LEFT');
		//$this->db->join(tblprefix("user_module").' UM','UM.role_id=U.role_id','LEFT');
		//or
		$this->db->from(tblprefix("user_module_permission").' UM');
		$this->db->where('UM.user_id',$LOGINID);
		//end
		
		$this->db->where("(add_btn='1' OR edit_btn='1' OR view_btn='1')");
		$this->db->where('UM.show_status',1);
		$result=$this->db->get()->result();
		//echo $this->db->last_query(); die;
		
		//echo "<pre>";print_r($result);die;
		if($result){
			foreach ($result as  $value) {
				$premissionModule[$value->module_id]=$value;
			}
		}
		$this->config->set_item('MODULE_PERMISSION',$premissionModule);	
		return $premissionModule;
	}

	public function changeStatus(){
	 if($_POST){
		$tableName=$_POST['tableName'];
		$date=date("Y-m-d H:i:s");
		$LOGINID=$this->LOGINID;
		
		$ID=$_POST['ID'];	
		$ID=(is_numeric($ID))?md5($ID):$ID;
		$show_status=$_POST['show_status'];
		$updateData=[
				'show_status'=>$show_status,
				'updater_id'=>$LOGINID,
                'updater_date'=>$date
				];
		$this->db->where("MD5(ID)",$ID);
		$this->db->update($tableName,$updateData);
		//echo $this->db->last_query();	
		return true;
	}
	}
	
	
	
}

/* End of file Common_model.php */
/* Location: ./application/models/Common_model.php */