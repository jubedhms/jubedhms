<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pregnancy_period_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="pregnancy_period";
    }

    public function getData($is_active='',$limit,$start){
        //print_r($_POST);
        $this->db->select("PP.*,U.user_name as editor,U2.user_name as author");
        $this->db->from($this->main_table." as PP");
        $this->db->join("user as U",'U.ID=PP.updater_id','LEFT');
        $this->db->join("user as U2",'U2.ID=PP.maker_id','LEFT');
        if($is_active==1)$this->db->where("PP.show_status",1);
        $this->db->where("PP.is_deleted",0);
        if($this->input->post('type_filter')){
            $this->db->where("PP.file_type",$this->input->post('type_filter'));
        }
        if($this->input->post('active_filter')!=''){
            $this->db->where("PP.show_status",$this->input->post('active_filter'));
        }
        if($this->input->post('author')){
            $author=$this->input->post('author');
            $this->db->where("PP.maker_id",$author);
        }
        if($this->input->post('editor')){
            $editor=$this->input->post('editor');
            $this->db->where("PP.updater_id",$editor);
        }
        if($this->input->post('maker_date')){
            $this->db->where("PP.maker_date",$this->input->post('maker_date'));
        }
        if($this->input->post('from_date')){
            $this->db->where("PP.maker_date>=",$this->input->post('from_date'));
        }
        if($this->input->post('to_date')){
            $this->db->where("PP.maker_date<=",$this->input->post('to_date'));
        }
        if($this->input->post('updater_date')){
            $this->db->where("PP.updater_date",$this->input->post('updater_date'));
        }
        $this->db->order_by('PP.ID','DESC');
        $this->db->limit($limit, $start);
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die;
        return $result;
        
        
    }
    
    
    public function get_count($is_active=''){
        $this->db->select("PP.*,U.user_name as author,AU.user_name as editor");
        $this->db->from($this->main_table." as PP");
        $this->db->join("user as U",'U.ID=PP.maker_id','LEFT');
        $this->db->join("user as AU",'AU.ID=PP.updater_id','LEFT');
        if($is_active==1)$this->db->where("PP.show_status",1);
        if($this->input->post('maker_date')){
            $this->db->where("PP.maker_date",$this->input->post('posted_date'));
        }
        if($this->input->post('updater_date')){
            $this->db->where("PP.updater_date",$this->input->post('updater_date'));
        }
        $this->db->where("PP.is_deleted",0);
        $this->db->order_by('PP.ID','DESC');
        $result=$this->db->get();
         if($result->num_rows()>0){
            return $result->num_rows();
        }else{
            return false;
        }
        //echo $this->db->last_query();die;
        //return $result;
    }
    

    public function add_pregnancy_period(){
        //print_r($_POST);die;
        $extention=array();
        if(isset($_FILES['pregnancy_period_image']['name'])){
            $extention=explode('.',$_FILES['pregnancy_period_image']['name']);
        }
        extract($_POST);
        //echo $this->videofileupload('pregnancy_period_image','pregnancy_period_video');die;
        //if($this->checkExist($name)==true){
            $LOGINID=$this->LOGINID;
			$curr_date=date("Y-m-d H:i:s");
			
			if($fileType==3){
				$pregnancy_period_image=$youtube_link;
			}else{
				$pregnancy_period_image='';
			}
               
            $insertData=array(
                'name'=>isset($name)?$name:'',
                'name_vi'=>isset($name_vi)?$name_vi:'',
                'pregnancy_week'=>isset($pregnancy_week)?implode(',',$pregnancy_week):'0',
//                'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
                //'start_date'=>$start_date,
                //'end_date'=>$end_date,
                'pregnancy_period_image'=>$pregnancy_period_image,
                'file_type'=>$fileType,
                'description'=>isset($description)?$description:'',
                'description_vi'=>isset($description_vi)?$description_vi:'',
                'push_notification'=>isset($push_notification)?$push_notification:'0',
                'maker_id'=>$LOGINID,
                'maker_date'=>$curr_date,
                'updater_id'=>$LOGINID,
                'updater_date'=>$curr_date
            );
//print_r($insertData);die;
            $this->db->insert($this->main_table, $insertData);
            $pregnancy_period_id=$this->db->insert_id();
            
            if($pregnancy_period_id){
                
                if($fileType==1){
                    $pregnancy_period_image=$this->upload_image($pregnancy_period_id, $file_name='pregnancy_period_image');
                }elseif($fileType==2 && in_array(end($extention),array('mp4','3gp','ogg','wmv','webm','flv','avi','mkv'))){
                    if(file_exists("data/pregnancy_period_video/".$_FILES['pregnancy_period_image']['name'])){
                        unlink('./data/pregnancy_period_video/'.$_FILES['pregnancy_period_image']['name']);
                    }
                    $pregnancy_period_image=$this->videofileupload('pregnancy_period_image','pregnancy_period_video');//filename,path
                    $newFileName='data/pregnancy_period_video/'.$pregnancy_period_image;
                    $updateArray = array("pregnancy_period_image"=>$newFileName);
                    $this->db->where('ID',$pregnancy_period_id);
                    $this->db->update($this->main_table,$updateArray);
                    
                }
    			
				$home_banner_start_time=date("H:i:s",strtotime($home_banner_start_time));
				$home_banner_end_time=date("H:i:s",strtotime($home_banner_end_time));
				$home_slider_start_time=date("H:i:s",strtotime($home_slider_start_time));
				$home_slider_end_time=date("H:i:s",strtotime($home_slider_end_time));
				$notification_page_start_time=date("H:i:s",strtotime($notification_page_start_time));
				$notification_page_end_time=date("H:i:s",strtotime($notification_page_end_time));
				$notification_banner_start_time=date("H:i:s",strtotime($notification_banner_start_time));
				$notification_banner_end_time=date("H:i:s",strtotime($notification_banner_end_time));
				
				$insertNotificationData=[
						'module_id'=>$pregnancy_period_id,
						'module_name'=> "pregnancy_period",
						'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
						'title'=>isset($name)?$name:'',
						'description'=>isset($description)?$description:'',
						'title_vi'=>isset($name_vi)?$name_vi:'',
						'description_vi'=>isset($description_vi)?$description_vi:'',
						'home_banner'=>isset($home_banner)?$home_banner:'0',
						'home_banner_start_date'=>$home_banner_start_date,
						'home_banner_start_time'=>$home_banner_start_time,
						'home_banner_end_date'=>$home_banner_end_date,
						'home_banner_end_time'=>$home_banner_end_time,
						'home_slider_banner'=>isset($home_slider_banner)?$home_slider_banner:'0',
						'home_slider_start_date'=>$home_slider_start_date,
						'home_slider_start_time'=>$home_slider_start_time,
						'home_slider_end_date'=>$home_slider_end_date,
						'home_slider_end_time'=>$home_slider_end_time,
						'notification_page'=> isset($notification_page)?$notification_page:'0',
						'notification_page_start_date'=>$notification_page_start_date,
						'notification_page_start_time'=>$notification_page_start_time,
						'notification_page_end_date'=>$notification_page_end_date,
						'notification_page_end_time'=>$notification_page_end_time,
						'notification_banner'=>isset($notification_banner)?$notification_banner:'0',
						'notification_banner_start_date'=>$notification_banner_start_date,
						'notification_banner_start_time'=>$notification_banner_start_time,
						'notification_banner_end_date'=>$notification_banner_end_date,
						'notification_banner_end_time'=>$notification_banner_end_time,
						'maker_id'=> $LOGINID,
						'maker_date'=>$curr_date,	
						'updater_id'=>$LOGINID,
						'updater_date'=>$curr_date
						];
					
				$this->db->insert("notification",$insertNotificationData);
            }
             
            setFlashMsg('success_message',"Pregnancy period has been created successfully.",'alert-success');
            
        //}
        return true;
    }
    
    private function videofileupload($file,$path){
        $video='';
		$config = array(
		'upload_path' => './data/'.$path.'/',
		'allowed_types' => "*",
		//'allowed_types' => "mp4|3gp|ogg|wmv|webm|flv|avi|mkv",
		'overwrite' => false,
		'max_size' => "204800000000", 
		);
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if(!$this->upload->do_upload($file)){
			$data['Error'] =  $this->upload->display_errors();
		}else{
			$videoDetailArray = $this->upload->data();
			$video =  $videoDetailArray['file_name'];
		}
		return $video;
        }

    public function edit_pregnancy_period(){
        //print_r($_POST);die;
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
		
		$pregnancy_period_image='test.jpg';// need to get value from form
		//'pregnancy_period_image'=>$pregnancy_period_image,
        
        $updateData=array(
            'name'=>isset($name)?$name:'',
            'name_vi'=>isset($name_vi)?$name_vi:'',
            'pregnancy_week'=>isset($pregnancy_week)?implode(',',$pregnancy_week):'0',
//            'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
            //'start_date'=>$start_date,
            //'end_date'=>$end_date,
			'description'=>isset($description)?$description:'',
            'description_vi'=>isset($description_vi)?$description_vi:'',
			'push_notification'=>isset($push_notification)?$push_notification:'0',
            'updater_id'=>$LOGINID,
            'updater_date'=>$curr_date
        );
        if($fileType==3 && $youtube_link){
            $updateData['pregnancy_period_image']=$youtube_link;
            $updateData['file_type']=$fileType;
        }elseif($fileType==1 && $_FILES['pregnancy_period_image']['name']){
            $updateData['file_type']=$fileType;
        }
	
        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        
        if($fileType==1 && $ID!='' && $_FILES['pregnancy_period_image']['name']){
            $this->upload_image($ID, $file_name='pregnancy_period_image');
        }elseif($fileType==2 && in_array(end($extention),array('mp4','3gp','ogg','wmv','webm','flv','avi','mkv'))){
            if(file_exists("data/pregnancy_period_video/".$_FILES['pregnancy_period_image']['name'])){
                unlink('./data/pregnancy_period_video/'.$_FILES['pregnancy_period_image']['name']);
            }
            if($fileType==1 && $_FILES['pregnancy_period_image']['name']){
            $pregnancy_period_image=$this->videofileupload('pregnancy_period_image','pregnancy_period_video');//filename,path
            $newFileName='data/pregnancy_period_video/'.$pregnancy_period_image;
            $updateArray = array("pregnancy_period_image"=>$newFileName);
            $this->db->where('ID',$ID);
            $this->db->update($this->main_table,$updateArray);
            }
            
        }

		$home_banner_start_time=date("H:i:s",strtotime($home_banner_start_time));
		$home_banner_end_time=date("H:i:s",strtotime($home_banner_end_time));
		$home_slider_start_time=date("H:i:s",strtotime($home_slider_start_time));
		$home_slider_end_time=date("H:i:s",strtotime($home_slider_end_time));
		$notification_page_start_time=date("H:i:s",strtotime($notification_page_start_time));
		$notification_page_end_time=date("H:i:s",strtotime($notification_page_end_time));
		$notification_banner_start_time=date("H:i:s",strtotime($notification_banner_start_time));
		$notification_banner_end_time=date("H:i:s",strtotime($notification_banner_end_time));

		$updateNotificationData=[
					'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
					'title'=>isset($name)?$name:'',
					'description'=>isset($description)?$description:'',
					'title_vi'=>isset($name_vi)?$name_vi:'',
					'description_vi'=>isset($description_vi)?$description_vi:'',
					'home_banner'=>isset($home_banner)?$home_banner:'0',
					'home_banner_start_date'=>$home_banner_start_date,
					'home_banner_start_time'=>$home_banner_start_time,
					'home_banner_end_date'=>$home_banner_end_date,
					'home_banner_end_time'=>$home_banner_end_time,
					'home_slider_banner'=>isset($home_slider_banner)?$home_slider_banner:'0',
					'home_slider_start_date'=>$home_slider_start_date,
					'home_slider_start_time'=>$home_slider_start_time,
					'home_slider_end_date'=>$home_slider_end_date,
					'home_slider_end_time'=>$home_slider_end_time,
					'notification_page'=> isset($notification_page)?$notification_page:'0',
					'notification_page_start_date'=>$notification_page_start_date,
					'notification_page_start_time'=>$notification_page_start_time,
					'notification_page_end_date'=>$notification_page_end_date,
					'notification_page_end_time'=>$notification_page_end_time,
					'notification_banner'=>isset($notification_banner)?$notification_banner:'0',
					'notification_banner_start_date'=>$notification_banner_start_date,
					'notification_banner_start_time'=>$notification_banner_start_time,
					'notification_banner_end_date'=>$notification_banner_end_date,
					'notification_banner_end_time'=>$notification_banner_end_time,
					'updater_id'=>$LOGINID,
					'updater_date'=>$curr_date
				];
				
			$this->db->update("notification",$updateNotificationData,array('MD5(module_id)'=>$ID,'module_name'=> "pregnancy_period"));	
		
        setFlashMsg('success_message',"Pregnancy period has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("PP.*");
		$this->db->select("N.ID as notification_id ,N.module_id,N.module_name,N.home_banner,N.home_banner_start_date,N.home_banner_start_time,N.home_banner_end_date,N.home_banner_end_time,N.home_slider_banner,N.home_slider_start_date,N.home_slider_start_time,N.home_slider_end_date,N.home_slider_end_time,N.notification_page,N.notification_page_start_date,N.notification_page_start_time,N.notification_page_end_date,N.notification_page_end_time,N.notification_banner,N.notification_banner_start_date,N.notification_banner_start_time,N.notification_banner_end_date,N.notification_banner_end_time");
        $this->db->from($this->main_table." as PP");
        $this->db->join("notification as N",'N.module_id=PP.ID','LEFT');
        $this->db->where("N.module_name","pregnancy_period");
        $this->db->where("MD5(PP.ID)",$ID);
        $this->db->where("PP.is_deleted",0);
        $result=$this->db->get()->row();
       
        $NoImage='assets/img/icon/not-available.jpg';
        if($result){
            if(isset($result->pregnancy_period_image) && $result->pregnancy_period_image!=''){
                $result->pregnancy_period_image=$result->pregnancy_period_image;
            }else{
                $result->pregnancy_period_image=$NoImage;
            }
        }    
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        
		return $result;
    }

    public function checkExist($name){
        //$ID=($ID!='')?$ID:$_POST['ID'];
        $name=($name!='')?$name:$_POST['name'];

        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        //$this->db->where("is_deleted",0);
        if($name!='')$this->db->where("name",$name);
        $result=$this->db->get()->row();
        //echo $this->db->last_query(); print_r($result);die;
        if($result && $result->total>0){
            if($name!='')setFlashMsg('success_message',"This pregnancy_period has been registered already.",'alert-danger');
            return false;
        }
        return true;
    }

    public function upload_image($ID='', $file_name=''){
        //print_r($_POST);
        //print_r($_FILES);die;
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldfile_name='';
            $this->db->select("pregnancy_period_image");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
            if(!$row && !isset($row->pregnancy_period_image)){
                return false;  
            }
            $oldfile_name=$row->pregnancy_period_image;
            if($this->input->post('fileType')==3 && $this->input->post('youtube_link')){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $updateArray = array("pregnancy_period_image"=>$this->input->post('youtube_link'));
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }
            
            
            
            $file_name =($file_name=='')?$this->input->post('file_name'):$file_name;
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."pregnancy-period-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($file_name,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
				$this->resize_file($resultData['upload_data']['file_name']);
                $updateArray = array("pregnancy_period_image"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"pregnancy_period ID is missing.",'alert-info');
            return false;
        }    
    }
	
	function resize_file($file_nm){
        $curr_year=date('Y');
        $curr_month=date('m');
        $file_dir=$this->config->item('ROOT_DATA_DIR')."pregnancy-period-image/".$curr_year."/".$curr_month."/";
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
	
    public function delete_pregnancy_period_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->select("pregnancy_period_image");
        $this->db->from($this->main_table);
        $this->db->where_in("MD5(ID)", $IDS);
        $result=$this->db->get()->result();
        if($result){
            foreach($result as $value){
                if($value->pregnancy_period_image!='')remove_uploaded_file($value->pregnancy_period_image); 
            }
        }
        
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end
        
		$this->db->where_in("MD5(module_id)", $IDS);
		$this->db->where("module_name","pregnancy_period");
		//$this->db->update("retail_shop_notification",$updateData);
        $this->db->delete("notification");
        
        echo "Pregnancy period has been deleted successfully.";
        return;
    }
    
    function removepregnancy_image($id,$old_img){
        if($this->db->update($this->main_table,array("pregnancy_period_image"=>''),array("MD5(ID)"=>$id))){
            if($old_img){
            unlink($old_img);
            }
            return true;
        }else{
            return false;
        }
    }


}