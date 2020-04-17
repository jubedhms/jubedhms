<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
		$this->main_table="user_role";
    }

	public function getData($is_active='',$role_id='',$ignore=array(1)){
        $role_id=(is_numeric($role_id))?md5($role_id):$role_id;
		
		$this->db->select("*");
        $this->db->from($this->main_table);
        if($is_active==1)$this->db->where("show_status",1);
		if($role_id!='')$this->db->where("md5(ID)",$role_id);
        $this->db->where("is_deleted",0);
		if($ignore)$this->db->where_not_in("ID",$ignore);
        $this->db->order_by('ID','ASC');
        $result=$this->db->get()->result();
		//echo $this->db->last_query(); die;
        return $result;
    }

  public function addedit($value=''){
    	extract($_POST); 
		
		if($this->checkExist()){
    	$crr_date=date("Y-m-d H:i:s");
    	$LOGINID=$this->LOGINID;
    	$ROWID=$ID;
    	$main_data=array(
							'name'=>$name,
							'description'=>$description,
							'maker_id'=>$LOGINID,
							'maker_date'=>$crr_date,
							'updater_id'=>$LOGINID,
							'updater_date'=>$crr_date,
					);

		if($ID){
		$ID=(is_numeric($ID))?md5($ID):$ID;
    	$this->db->where("MD5(ID)",$ID);	
		$this->db->update($this->main_table,$main_data);
		$this->db->where("MD5(role_id)",$ID);	
		$this->db->delete("user_module");
		setFlashMsg('success_message','Role has been updated successfully.','alert-success');
		}else{
		$this->db->insert($this->main_table,$main_data);	
		$ROWID=$this->db->insert_id();
    	setFlashMsg('success_message','Role has been created successfully.','alert-success');
	}
		if($module_id && count($module_id)>0){
			foreach($module_id as $key=>$value){
			$sub_data[]=array(
								'role_id'=>$ROWID,
								'module_id'=>$value,
								'all_btn'=>@$all_btn[$key],
								'add_btn'=>@$add_btn[$key],
								'view_btn'=>@$view_btn[$key],
								'edit_btn'=>@$edit_btn[$key],
								'delete_btn'=>@$delete_btn[$key],
								'status_btn'=>@$status_btn[$key],
								'print_btn'=>@$print_btn[$key],
								'other_btn'=>@$other_btn[$key],
						);
			}	
		}
		$this->db->insert_batch("user_module", $sub_data); 
		
		//echo $this->db->last_query();
		//echo "<pre>";print_r($sub_data);die;
		//die;
		return true;
		} 
	}
	
    public function checkExist($value=''){
    	$name=$this->input->post('name');
    	$ID=$this->input->post('ID');
    	$ID=(is_numeric($ID))?md5($ID):$ID;
    	$this->db->select("count(ID) as total");
    	$this->db->from($this->main_table);
    	$this->db->where("name",$name);
    	if($ID)$this->db->where("MD5(ID) !=",$ID);
    	$result=$this->db->get()->row();
    	//echo $this->db->last_query(); die;
    
    	if($result && $result->total>0){
    		 setFlashMsg('success_message','Role is existing already.','alert-danger');
    		return false;
    	}
    	return true;
    }
	
public function loadDataById($ID=''){
		$ID=(is_numeric($ID))?md5($ID):$ID;
		$this->db->select("*");
        $this->db->from($this->main_table);
        $this->db->where("is_deleted",0);
		$this->db->where("md5(ID)",$ID);
        $result=$this->db->get()->row();
		return $result;
    }
	

	public function getModulList($is_active='',$role_id=''){	
		$this ->db->select('M.*');
		$this->db->from("module M");
		if($is_active!='')$this->db->where('M.show_status',1);	
		$this->db->order_by('M.id,M.parent_id','ASC');
		$result=$this->db->get()->result();
		foreach($result as $value){
		$this ->db->select('UM.*,UM.ID as UM_ID');	
		$this->db->where('UM.role_id',$role_id);
		$this->db->where('UM.module_id',$value->ID);
		$this->db->from("user_module UM");
		$result2=$this->db->get()->row();
			$value->all_btn=($result2)?$result2->all_btn:'';
			$value->add_btn=($result2)?$result2->add_btn:'';
			$value->view_btn=($result2)?$result2->view_btn:'';
			$value->edit_btn=($result2)?$result2->edit_btn:'';
			$value->delete_btn=($result2)?$result2->delete_btn:'';
			$value->status_btn=($result2)?$result2->status_btn:'';
			$value->print_btn=($result2)?$result2->print_btn:'';
			$value->other_btn=($result2)?$result2->other_btn:'';
			}	
	
		//echo "<pre>";print_r($result);die;
		return $result;
    }	
	
	
    public function delete_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        //$updateData=array('is_deleted'=>1);
            
        // for delete titles
            $this->db->where_in("MD5(ID)", $IDS); 
            //$this->db->update($this->main_table,$updateData);
			$this->db->delete($this->main_table);
        //end
        
		// for delete authority 
            $this->db->where_in("MD5(role_id)", $IDS); 
            //$this->db->update("user_module", $updateData);
			$this->db->delete("user_module");
        // end  
        echo "User role have been deleted successfully.";
		return;
    } 
	
}