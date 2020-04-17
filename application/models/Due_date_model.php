<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Due_date_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="due_date";
    }

    public function getData($is_active=''){
        $this->db->select("DD.*,U.user_name as editor,U2.user_name as author");
        $this->db->from($this->main_table." as DD");
        $this->db->join("user as U",'U.ID=DD.updater_id','LEFT');
        $this->db->join("user as U2",'U2.ID=DD.maker_id','LEFT');
        if($is_active==1)$this->db->where("DD.show_status",1);
        $this->db->where("DD.is_deleted",0);
        $this->db->order_by('DD.ID','DESC');
        $result=$this->db->get()->result();

        return $result;
    }

    public function add_due_date(){
        extract($_POST);
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");	
		if($this->checkExistweek($pregnancy_week)==false){    
			$insertData=array(
				//'trimester'=>$trimester,
				'pregnancy_week'=> $pregnancy_week,
				'image_src'=> isset($image_src)?$image_src:'',
				'description'=>isset($description)?$description:'',
				'description_vi'=>isset($description_vi)?$description_vi:'',
				'maker_id'=>$LOGINID,
				'maker_date'=>$curr_date,
				'updater_id'=>$LOGINID,
				'updater_date'=>$curr_date
			);

			$this->db->insert($this->main_table, $insertData);
			//$due_date_id=$this->db->insert_id();
			
//			if($due_date_id){
//				$image_src=$this->upload_image($due_date_id, $file_name='image_src');
//			}
			 
			setFlashMsg('success_message',"Due Date has been created successfully.",'alert-success');

			return true;
		}	
    }
    
    public function edit_due_date(){
        //print_r($_POST);die;
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
		//if($this->checkExistweek($pregnancy_week)==false){  
			$updateData=[
						//'trimester'=>$trimester,
						'pregnancy_week'=>$pregnancy_week,
						'description'=>isset($description)?$description:'',
						'description_vi'=>isset($description_vi)?$description_vi:'',
						'updater_id'=>$LOGINID,
						'updater_date'=>$curr_date
					];
			
//			if($_FILES['image_src']['name']){
//				//$updateData['file_type']=$fileType;
//				$this->upload_image($ID, $file_name='image_src');
//			}
		
			$this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
			
			setFlashMsg('success_message',"Due Date has been updated successfully.",'alert-success');
			return true;
		//}	
    }
	
	public function getPregnancyWeekData($ID=''){
		$response=[];
		$ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("DD.pregnancy_week");
        $this->db->from($this->main_table." as DD");
        $this->db->where("DD.is_deleted",0);
		if($ID!='')$this->db->where("MD5(DD.ID) !=",$ID);
        $result=$this->db->get()->result();
		foreach($result as $value){
			$response[]=$value->pregnancy_week;
		}
        return $response;
	}
	
    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("DD.*");
        $this->db->from($this->main_table." as DD");
        $this->db->where("MD5(DD.ID)",$ID);
        $this->db->where("DD.is_deleted",0);
        $result=$this->db->get()->row();
       
//        $NoImage='assets/img/icon/not-available.jpg';
//        if($result){
//            if(isset($result->image_src) && $result->image_src!=''){
//                $result->image_src=$result->image_src;
//            }else{
//                $result->image_src=$NoImage;
//            }
//        }    
        return $result;
    }

    public function checkExistweek($pregnancy_week=''){
        $pregnancy_week=($pregnancy_week!='')?$pregnancy_week:$_POST['pregnancy_week'];

        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        $this->db->where("pregnancy_week",$pregnancy_week);
        $result=$this->db->get()->row();
        
		if($result && $result->total>0){
          setFlashMsg('success_message',"This Pregnancy Week has been registered already.",'alert-danger');
            return true;
        }
        return false;
    }
	
	public function upload_image($ID='', $fileInputboxName=''){
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $this->db->select("image_src");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
            if(!$row && !isset($row->image_src)){
                return false;  
            }
            $oldfile_name=$row->image_src;
			
            $fileInputboxName =($fileInputboxName!='')?$fileInputboxName:$_POST['fileInputboxName'];
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."due-date-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($fileInputboxName,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
				$this->resize_file($resultData['upload_data']['file_name']);
                $updateArray = array("image_src"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Due Date ID is missing.",'alert-info');
            return false;
        }    
    }
	
	function resize_file($file_nm){
        $curr_year=date('Y');
        $curr_month=date('m');
        $file_dir=$this->config->item('ROOT_DATA_DIR')."due-date-image/".$curr_year."/".$curr_month."/";
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        //$config['source_image'] = './public/images/'.$file_nm;
        $config['source_image'] = $file_dir.$file_nm;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['width']     = 500;
        $config['height']   = 250;

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if($this->image_lib->resize()){
        return true;
        }
	}
	
    public function delete_due_date_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->select("image_src");
        $this->db->from($this->main_table);
        $this->db->where_in("MD5(ID)", $IDS);
        $result=$this->db->get()->result();
        if($result){
            foreach($result as $value){
                if($value->image_src!='')remove_uploaded_file($value->image_src); 
            }
        }
        
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end
        
		echo "Due Date has been deleted successfully.";
        return;
    }
    
    function removedueDate_image($id,$old_img){
        if($this->db->update($this->main_table,array("image_src"=>''),array("MD5(ID)"=>$id))){
            unlink($old_img);
            return true;
        }else{
            return false;
        }
    }
    
    function getdueDate_image($id){
        $data=$this->db->get_where($this->main_table,array("MD5(ID)"=>$id));
        //echo $this->db->last_query();die;
        if($data->num_rows()>0){
             return $data->row()->image_src;
        }else{
            return false;
        }
    }
    
     function SaveDueDateImage($id,$dataimg){
       if($this->db->update($this->main_table,$dataimg,array("MD5(ID)"=>$id))){
           return true;
        }else{
            return false;
        }
    }


}