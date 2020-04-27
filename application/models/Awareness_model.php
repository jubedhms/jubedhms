<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awareness_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="awareness";
    }

    // public function getData($is_active=''){
        // $this->db->select("A.*,U.user_name as editor");
        // $this->db->from($this->main_table." as A");
        // $this->db->join("user as U",'U.ID=A.updater_id','LEFT');
        // if($is_active==1)$this->db->where("A.show_status",1);
        // $this->db->where("A.is_deleted",0);
        // $this->db->order_by('A.ID','DESC');
        // $result=$this->db->get()->result();

        // return $result;
    // }
	
	public function getData($is_active='',$limit,$start){
            //print_r($_POST);
        $this->db->select("A.*,U.user_name as author,AU.user_name as editor");
        $this->db->from($this->main_table." as A");
        $this->db->join("user as U",'U.ID=A.maker_id','LEFT');
        $this->db->join("user as AU",'AU.ID=A.updater_id','LEFT');
        if($is_active==1)$this->db->where("A.show_status",1);
        $filter=$this->input->post('active_filter');
        if($filter!=''){ 
            $this->session->set_userdata('filter',$filter);
        }else{
            $this->session->unset_userdata('filter');
        }
        if($filter!='' && $filter=='1'){
            $this->db->where("A.show_status",$filter);
            $this->db->where("A.end_date>",date('Y-m-d'));
        }
        if($filter!='' && $filter=='0'){
            $this->db->where("A.show_status",$filter);
            $this->db->or_where("A.end_date<",date('Y-m-d'));
        }
        
        if($this->input->post('start_date')){
            $this->db->where("A.start_date >=",$this->input->post('start_date'));
        }
        if($this->input->post('category_id')){
            $categories=$this->input->post('category_id');
            (!empty($categories))?$this->db->where("FIND_IN_SET($categories,A.category)!=",'NULL'):'';
        }
        
        if($this->input->post('end_date')){
            $this->db->where("A.end_date <=",$this->input->post('end_date'));
        }
        $type_filter=$this->input->post('type_filter');
        if($type_filter){ 
            $this->session->set_userdata('type_filter',$type_filter);
        }else{
            $this->session->unset_userdata('type_filter');
        }
        if($this->input->post('type_filter')){
            $this->db->where("A.file_type",$this->input->post('type_filter'));
        }
        
        $cusgroup=$this->input->post('cus_group');
        if($cusgroup){ 
            $this->session->set_userdata('cusgroup',$cusgroup);
        }else{
            $this->session->unset_userdata('cusgroup');
        }
        if($cusgroup){
            $this->db->where("FIND_IN_SET($cusgroup,A.customer_group)!=",'NULL');
        }
        
        $authorsess=$this->input->post('author');
        if($authorsess){ 
            $this->session->set_userdata('authorsess',$authorsess);
        }else{
            $this->session->unset_userdata('authorsess');
        }
        if($this->input->post('author')){
            $author=$this->input->post('author');
            $this->db->where("A.maker_id",$author);
        }
        
        $editorsess=$this->input->post('editor');
        if($editorsess){ 
            $this->session->set_userdata('editorsess',$editorsess);
        }else{
            $this->session->unset_userdata('editorsess');
        }
        if($this->input->post('editor')){
            $editor=$this->input->post('editor');
            $this->db->where("A.updater_id",$editor);
        }
        
        $date_start=$this->input->post('date_start');
        if($date_start){ 
            $this->session->set_userdata('date_start',$date_start);
        }else{
            $this->session->unset_userdata('date_start');
        }
        if($this->input->post('date_start')){
            $date_start=$this->input->post('date_start');
            $this->db->where("A.start_date",$date_start);
        }
        
        $end_date2=$this->input->post('end_date2');
        if($end_date2){ 
            $this->session->set_userdata('end_date2',$end_date2);
        }else{
            $this->session->unset_userdata('end_date2');
        }
        if($this->input->post('end_date2')){
            $end_date2=$this->input->post('end_date2');
            $this->db->where("A.end_date",$end_date2);
        }
        
        $maker_date=$this->input->post('maker_date');
        if($maker_date){ 
            $this->session->set_userdata('maker_date',$maker_date);
        }else{
            $this->session->unset_userdata('maker_date');
        }
        if($this->input->post('maker_date')){
            $maker_date=$this->input->post('maker_date');
            $this->db->where("A.maker_date",$maker_date);
        }
        //condition for status Expired,published,draft,scheduled
        
        
        $status=$this->input->post('status');
        if($status){ 
            $this->session->set_userdata('status',$status);
        }else{
            $this->session->unset_userdata('status');
        }
        if($status==1){ //Expired
            $this->db->where("A.end_date<",date('Y-m-d'));
        }
        
        if($status==2){ //Scheduled
            $this->db->where("A.start_datetime>",date('Y-m-d H:i:s'));
            $this->db->where("A.show_status",1);
        }
        if($status==3){ //Published
            $this->db->where("A.start_datetime<=",date('Y-m-d H:i:s'));
            $this->db->where("A.end_date>=",date('Y-m-d'));
            $this->db->where("A.show_status",1);
        }
        if($status==4){ //Draft
            $this->db->where("A.show_status",0);
        }
        $this->db->where("A.is_deleted",0);
        $this->db->order_by('A.ID','DESC');
        $this->db->limit($limit, $start);
        $result=$this->db->get()->result();
        //echo $this->db->last_query();//die;
        
        
        return $result;
    }
    
    public function get_count($is_active=''){
        $this->db->select("A.*,U.user_name as author,AU.user_name as editor");
        $this->db->from($this->main_table." as A");
        $this->db->join("user as U",'U.ID=A.maker_id','LEFT');
        $this->db->join("user as AU",'AU.ID=A.updater_id','LEFT');
        if($is_active==1)$this->db->where("A.show_status",1);
        if($this->input->post('start_date')){
            $this->db->where("A.start_date >=",$this->input->post('start_date'));
        }
        if($this->input->post('category_id')){
            $categories=$this->input->post('category_id');
            (!empty($categories))?$this->db->where("FIND_IN_SET($categories,A.category)!=",'NULL'):'';
        }
        if($this->input->post('end_date')){
            $this->db->where("A.end_date <=",$this->input->post('end_date'));
        }
		$status=$this->input->post('status');
        if($status){ 
            $this->session->set_userdata('status',$status);
        }else{
            $this->session->unset_userdata('status');
        }
        if($status==1){ //Expired
            $this->db->where("A.end_date<",date('Y-m-d'));
        }
        
        if($status==2){ //Scheduled
            $this->db->where("A.start_datetime>",date('Y-m-d H:i:s'));
            $this->db->where("A.show_status",1);
        }
        if($status==3){ //Published
            $this->db->where("A.start_datetime<=",date('Y-m-d H:i:s'));
            $this->db->where("A.end_date>=",date('Y-m-d'));
            $this->db->where("A.show_status",1);
        }
        if($status==4){ //Draft
            $this->db->where("A.show_status",0);
        }
        $this->db->where("A.is_deleted",0);
        $this->db->order_by('A.ID','DESC');
        $result=$this->db->get();
         if($result->num_rows()>0){
            return $result->num_rows();
        }else{
            return false;
        }
        echo $this->db->last_query();die;
        //return $result;
    }

    public function add_awareness(){
        //print_r($_POST);die;
        $extention=array();
        if(isset($_FILES['awareness_image']['name'])){
            $extention=explode('.',$_FILES['awareness_image']['name']);
        }
        extract($_POST);
        //echo $this->videofileupload('awareness_image','awareness_video');die;
        //if($this->checkExist($name)==true){
            $LOGINID=$this->LOGINID;
			$curr_date=date("Y-m-d H:i:s");
			$curr_time=date("H:i:s");
			
			if($fileType==3){
				$awareness_image=$youtube_link;
			}else{
				$awareness_image='';
			}
                        
                        
                        $demoarray=array();
                        foreach($demographics as $demorow){
                            switch($demorow){
                                case 1:
                                    if(!empty($ages)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 2:
                                    if(!empty($income)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 3:
                                    if(!empty($relationship)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 4:
                                    if(!empty($province)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 5:
                                     if(!empty($gender)){
                                    array_push($demoarray, $demorow);
                                     }
                                    break;
                                case 6:
                                    if(!empty($deliveryathph)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                
                            }
                        }
                        
               
            $insertData=array(
						'name'=>isset($name)?$name:'',
						'name_vi'=>isset($name_vi)?$name_vi:'',
						'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
                
                        'demographics'=>isset($demoarray)?implode(',',$demoarray):'',
                        'ages'=>isset($ages)?implode(',',$ages):'',
                        'income'=>isset($income)?implode(',',$income):'',
                        'relationship'=>isset($relationship)?implode(',',$relationship):'',
                        //'location'=>isset($location)?implode(',',$location):'',
                        'province'=>isset($province)?implode(',',$province):'',
                        'city'=>isset($city)?implode(',',$city):'',
                        'district'=>isset($district)?implode(',',$district):'',
                        'gender'=>isset($gender)?implode(',',$gender):'',
                        'category'=>isset($category)?implode(',',$category):'',
						'deliveryathph'=>isset($deliveryathph)?$deliveryathph:'',
						'show_status'=>isset($show_status)?$show_status:'0',
						'start_date'=>$start_date,
						'start_datetime'=>isset($start_time)?$start_date.' '.date("H:i:s",strtotime($start_time)):$start_date.' '.$curr_time,
						//'start_time'=>'02:00:00',
						'end_date'=>$end_date,
						'awareness_image'=>$awareness_image,
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
            $awareness_id=$this->db->insert_id();
            
            if($awareness_id){
                
                if($fileType==1){
                    $awareness_image=$this->upload_image($awareness_id, $file_name='awareness_image');
                }elseif($fileType==2 && in_array(end($extention),array('mp4','3gp','ogg','wmv','webm','flv','avi','mkv'))){
                    if(file_exists("data/awareness_video/".$_FILES['awareness_image']['name'])){
                        unlink('./data/awareness_video/'.$_FILES['awareness_image']['name']);
                    }
                    $awareness_image=$this->videofileupload('awareness_image','awareness_video');//filename,path
                    $newFileName='data/awareness_video/'.$awareness_image;
                    $updateArray = array("awareness_image"=>$newFileName);
                    $this->db->where('ID',$awareness_id);
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
						'module_id'=>$awareness_id,
						'module_name'=> "awareness",
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
             
            setFlashMsg('success_message',"Awareness has been created successfully.",'alert-success');
            
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

    public function edit_awareness(){
        //print_r($_POST);die;
        //print_r($_FILES);die;
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
		
		$awareness_image='test.jpg';// need to get value from form
		//'awareness_image'=>$awareness_image,
                        $demoarray=array();
                        foreach($demographics as $demorow){
                            switch($demorow){
                                case 1:
                                    if(!empty($ages)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 2:
                                    if(!empty($income)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 3:
                                    if(!empty($relationship)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 4:
                                    if(!empty($province)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                case 5:
                                     if(!empty($gender)){
                                    array_push($demoarray, $demorow);
                                     }
                                    break;
                                case 6:
                                    if(!empty($deliveryathph)){
                                    array_push($demoarray, $demorow);
                                    }
                                    break;
                                
                            }
                        }
        
        $updateData=array(
					'name'=>isset($name)?$name:'',
					'name_vi'=>isset($name_vi)?$name_vi:'',
					'customer_group'=>isset($customer_group)?implode(',',$customer_group):'0',
                    'demographics'=>isset($demoarray)?implode(',',$demoarray):'',
                    'ages'=>isset($ages)?implode(',',$ages):'',
                    'income'=>isset($income)?implode(',',$income):'',
                    'relationship'=>isset($relationship)?implode(',',$relationship):'',
                    'province'=>isset($province)?implode(',',$province):'',
                    'city'=>isset($city)?implode(',',$city):'',
                    'district'=>isset($district)?implode(',',$district):'',
                    //'location'=>isset($location)?implode(',',$location):'',
                    'gender'=>isset($gender)?implode(',',$gender):'',
                    'category'=>isset($category)?implode(',',$category):'',
                    'deliveryathph'=>isset($deliveryathph)?$deliveryathph:'',
					'show_status'=>isset($show_status)?$show_status:'0',
					'start_date'=>$start_date,
                                        'start_datetime'=>isset($start_time)?$start_date.' '.date("H:i:s",strtotime($start_time)):$start_date.' '.$curr_time,
                                        //'start_time'=>'00:00:00',
					'end_date'=>$end_date,
					'description'=>isset($description)?$description:'',
					'description_vi'=>isset($description_vi)?$description_vi:'',
					'push_notification'=>isset($push_notification)?$push_notification:'0',
					'updater_id'=>$LOGINID,
					'updater_date'=>$curr_date
				);
        if($fileType==3 && $youtube_link){
            $updateData['awareness_image']=$youtube_link;
            $updateData['file_type']=$fileType;
        }elseif($fileType==1 && $_FILES['awareness_image']['name']){
            $updateData['file_type']=$fileType;
        }
	
        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        
        if($fileType==1 && $ID!='' && $_FILES['awareness_image']['name']){
            $this->upload_image($ID, $file_name='awareness_image');
        }elseif($fileType==2 && in_array(end($extention),array('mp4','3gp','ogg','wmv','webm','flv','avi','mkv'))){
            if(file_exists("data/awareness_video/".$_FILES['awareness_image']['name'])){
                unlink('./data/awareness_video/'.$_FILES['awareness_image']['name']);
            }
            if($fileType==1 && $_FILES['awareness_image']['name']){
            $awareness_image=$this->videofileupload('awareness_image','awareness_video');//filename,path
            $newFileName='data/awareness_video/'.$awareness_image;
            $updateArray = array("awareness_image"=>$newFileName);
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
				
			$this->db->update("notification",$updateNotificationData,array('MD5(module_id)'=>$ID,'module_name'=> "awareness"));	
		
        setFlashMsg('success_message',"Awareness has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("A.*");
		$this->db->select("N.ID as notification_id ,N.module_id,N.module_name,N.home_banner,N.home_banner_start_date,N.home_banner_start_time,N.home_banner_end_date,N.home_banner_end_time,N.home_slider_banner,N.home_slider_start_date,N.home_slider_start_time,N.home_slider_end_date,N.home_slider_end_time,N.notification_page,N.notification_page_start_date,N.notification_page_start_time,N.notification_page_end_date,N.notification_page_end_time,N.notification_banner,N.notification_banner_start_date,N.notification_banner_start_time,N.notification_banner_end_date,N.notification_banner_end_time");
        $this->db->from($this->main_table." as A");
        $this->db->join("notification as N",'N.module_id=A.ID','LEFT');
        $this->db->where("N.module_name","awareness");
        $this->db->where("MD5(A.ID)",$ID);
        $this->db->where("A.is_deleted",0);
        $result=$this->db->get()->row();
       
        //$NoImage='assets/img/icon/not-available.jpg';
//        if($result){
//            if(isset($result->awareness_image) && $result->awareness_image!=''){
//                $result->awareness_image=$result->awareness_image;
//            }else{
//                $result->awareness_image='';
//                //$result->awareness_image=$NoImage;
//            }
//        }    
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
            if($name!='')setFlashMsg('success_message',"This awareness has been registered already.",'alert-danger');
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
            $this->db->select("awareness_image");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
            if(!$row && !isset($row->awareness_image)){
                return false;  
            }
            $oldfile_name=$row->awareness_image;
            if($this->input->post('fileType')==3 && $this->input->post('youtube_link')){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $updateArray = array("awareness_image"=>$this->input->post('youtube_link'));
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }
            
            
            
            $file_name =($file_name=='')?$this->input->post('file_name'):$file_name;
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."awareness-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($file_name,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
				if($imgext[1]=='gif' || $imgext[1]=='GIF'){
                    
                }else{
                    $this->resize_file($resultData['upload_data']['file_name']);
                }
                $updateArray = array("awareness_image"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Awareness ID is missing.",'alert-info');
            return false;
        }    
    }
	function resize_file($file_nm){
        $curr_year=date('Y');
        $curr_month=date('m');
        $file_dir=$this->config->item('ROOT_DATA_DIR')."awareness-image/".$curr_year."/".$curr_month."/";
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
	
    public function delete_awareness_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->select("awareness_image");
        $this->db->from($this->main_table);
        $this->db->where_in("MD5(ID)", $IDS);
        $result=$this->db->get()->result();
        if($result){
            foreach($result as $value){
                if($value->awareness_image!='')remove_uploaded_file($value->awareness_image); 
            }
        }
        
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end
        
		$this->db->where_in("MD5(module_id)", $IDS);
		$this->db->where("module_name","awareness");
		//$this->db->update("retail_shop_notification",$updateData);
        $this->db->delete("notification");
        
        echo "Awareness has been deleted successfully.";
        return;
    }
    
    function getCategoryData(){
        $this->db->select("distinct(A.category) as category");
        $this->db->from($this->main_table." as A");
        $this->db->where("A.is_deleted",0);
        $this->db->order_by('A.ID','ASC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query();die; //echo "<br/><pre>";print_r($result);;die();
        return $result;
    }
    
    function updateEndDate($id,$date_end){
        if($this->db->update($this->main_table,array('end_date'=>$date_end),array('ID'=>$id))){
            return true;
        }else{
            return false;
        }
        
    }
    
    function removeawareness_image($id,$old_img){
        if($this->db->update($this->main_table,array("awareness_image"=>''),array("MD5(ID)"=>$id))){
            if($old_img){
            unlink($old_img);
            }
            return true;
        }else{
            return false;
        }
    }


}