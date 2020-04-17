<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advance_notification_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="advance_notification";
    }
    
    function getData($is_active=''){
        $this->db->select("N.ID, N.name, N.customer_group,N.team,start_date,end_date,N.is_delivered,N.action_status,N.show_status,N.maker_date,N.updater_date,UA.user_name as author,N.team");
        $this->db->from($this->main_table." as N");
		$this->db->join("user as UA",'UA.ID=N.maker_id','LEFT');
		if($is_active==1)$this->db->where("N.show_status",1);
        $this->db->where("N.is_deleted",0);
        $this->db->order_by('N.column_order','ASC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_notification(){ 
        extract($_POST);
        $LOGINID=$this->LOGINID;
        $curr_date=date("Y-m-d H:i:s");
        
		
		//Lockscreen Notification//
		$lockscreenNotificationTemplate = isset($lockscreenNotificationTemplate)?$lockscreenNotificationTemplate:'';
		$lockscreen_title = isset($lockscreenNotificationTemplate)?$lockscreen_title:'';
		$lockscreen_message = isset($lockscreenNotificationTemplate)?$lockscreen_message:'';
		$lockscreen_title_vi = isset($lockscreenNotificationTemplate)?$lockscreen_title_vi:'';
		$lockscreen_message_vi = isset($lockscreenNotificationTemplate)?$lockscreen_message_vi:'';
		$lockscreen_image_src = (isset($lockscreenNotificationTemplate) && isset($_FILES['lockscreen_image_src']) && $_FILES['lockscreen_image_src']['name']!='')?'lockscreen_image_src':'';
		$lockscreen_action_first=isset($lockscreenNotificationTemplate)?$lockscreen_action_first:'';
		$lockscreen_action_first_url=(isset($lockscreenNotificationTemplate) && $lockscreen_action_first=='2')?$lockscreen_action_first_url:'';
		//end//
		
		// In App Notification//
		$inAppNotificationTemplate= isset($inAppNotificationTemplate)?$inAppNotificationTemplate:'';
		$in_app_template_type='';	
		$in_app_title= $in_app_message= $in_app_title_vi= $in_app_message_vi=$in_app_image_src ='';
		$in_app_action_btn_text_first=$in_app_action_btn_text_first_vi=$in_app_action_btn_first=$in_app_action_btn_url_first="";
		$in_app_action_btn_text_second=$in_app_action_btn_text_second_vi=$in_app_action_btn_second=$in_app_action_btn_url_second="";
			
		if(isset($inAppNotificationTemplate)){
			if(isset($inAppTextNotification)){
				// text
				$in_app_template_type='1';
				$in_app_title= $in_app_title1;
				$in_app_message= $in_app_message1;
				$in_app_title_vi= $in_app_title_vi1;
				$in_app_message_vi= $in_app_message_vi1;
				//end
			} else if(isset($inAppTextPictureNotification)){
				// text + picture
				$in_app_template_type='2';
				$in_app_title= $in_app_title2;
				$in_app_message= $in_app_message2;
				$in_app_title_vi= $in_app_title_vi2;
				$in_app_message_vi= $in_app_message_vi2;
				
				$in_app_image_src = (isset($_FILES['in_app_image_src2'])  && $_FILES['in_app_image_src2']['name']!='')?'in_app_image_src2':'';
				//end
			} else if(isset($inAppTextPictureOptionNotification)){
				// text + picture + options
				$in_app_template_type='3';
				$in_app_title= $in_app_title3;
				$in_app_message= $in_app_message3;
				$in_app_title_vi= $in_app_title_vi3;
				$in_app_message_vi= $in_app_message_vi3;
				
				$in_app_image_src = (isset($_FILES['in_app_image_src3'])  && $_FILES['in_app_image_src3']['name']!='')?'in_app_image_src3':'';
				
				$in_app_action_btn_text_first=$in_app_action_btn_text_first3;
				$in_app_action_btn_text_first_vi=$in_app_action_btn_text_first_vi3;
				$in_app_action_btn_first=$in_app_action_btn_first3;
				$in_app_action_btn_url_first=$in_app_action_btn_url_first3;
				
				$in_app_action_btn_text_second=$in_app_action_btn_text_second3;
				$in_app_action_btn_text_second_vi=$in_app_action_btn_text_second_vi3;
				$in_app_action_btn_second=$in_app_action_btn_second3;
				$in_app_action_btn_url_second=$in_app_action_btn_url_second3;
				//end
			} else if(isset($inAppTextOptionNotification)){
				// text + options
				$in_app_template_type='4';
				$in_app_title= $in_app_title4;
				$in_app_message= $in_app_message4;
				$in_app_title_vi= $in_app_title_vi4;
				$in_app_message_vi= $in_app_message_vi4;
				
				$in_app_action_btn_text_first=$in_app_action_btn_text_first4;
				$in_app_action_btn_text_first=$in_app_action_btn_text_first4;
				$in_app_action_btn_text_first_vi=$in_app_action_btn_text_first_vi4;
				$in_app_action_btn_first=$in_app_action_btn_first4;
				$in_app_action_btn_url_first=$in_app_action_btn_url_first4;
				
				$in_app_action_btn_text_second=$in_app_action_btn_text_second4;
				$in_app_action_btn_text_second_vi=$in_app_action_btn_text_second_vi4;
				$in_app_action_btn_second=$in_app_action_btn_second4;
				$in_app_action_btn_url_second=$in_app_action_btn_url_second4;
				//end
			} else if(isset($inAppTextAlertNotification)){
				// text + alert
				$in_app_template_type='5';
				$in_app_title= $in_app_title5;
				$in_app_message= $in_app_message5;
				$in_app_title_vi= $in_app_title_vi5;
				$in_app_message_vi= $in_app_message_vi5;
				
				$in_app_action_btn_text_second=$in_app_action_btn_text_second5;
				$in_app_action_btn_text_second_vi=$in_app_action_btn_text_second_vi5;
				$in_app_action_btn_second= '';//$in_app_action_btn_second5;
				$in_app_action_btn_url_second='';//$in_app_action_btn_url_second5;
				//end
			}
			//end//
		}
		// end	
		
		$demoarray=[];
		if(isset($demographics)){
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
		}
		
        $action_status=isset($btn_save_draft)?1:(isset($btn_save)?2:3);
		
		$insertData=[
					'name'=>isset($name)?$name:'',
					'name_vi'=>isset($name_vi)?$name_vi:'',
					'start_date'=>$start_date,
					//'start_datetime'=>isset($start_time)?$start_date.' '.date("H:i:s",strtotime($start_time)):$start_date.' '.$curr_time,
					//'start_time'=>'02:00:00',
					'end_date'=>$end_date,
					'category'=> $category,
					'team'=> $team,
					'lockscreenNotificationTemplate' => $lockscreenNotificationTemplate,
					'lockscreen_title' => $lockscreen_title,
					'lockscreen_message' => $lockscreen_message,
					'lockscreen_title_vi' => $lockscreen_title_vi,
					'lockscreen_message_vi' => $lockscreen_message_vi,
					'lockscreen_action_first' => $lockscreen_action_first,
					'lockscreen_action_first_url' => $lockscreen_action_first_url,
				
					'inAppNotificationTemplate' => $inAppNotificationTemplate,
					'in_app_template_type' => $in_app_template_type,
					'in_app_title' => $in_app_title,
					'in_app_message' => $in_app_message,
					'in_app_title_vi' => $in_app_title_vi,
					'in_app_message_vi' => $in_app_message_vi,
					
					'in_app_action_btn_text_first' => $in_app_action_btn_text_first,
					'in_app_action_btn_text_first_vi'=> $in_app_action_btn_text_first_vi,
					'in_app_action_btn_first'=> $in_app_action_btn_first,
					'in_app_action_btn_url_first'=> $in_app_action_btn_url_first,
					'in_app_action_btn_text_second'=> $in_app_action_btn_text_second,
					'in_app_action_btn_text_second_vi'=> $in_app_action_btn_text_second_vi,
					'in_app_action_btn_second'=> $in_app_action_btn_second,
					'in_app_action_btn_url_second'=> $in_app_action_btn_url_second,
					
					
					
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
					'deliveryathph'=>isset($deliveryathph)?$deliveryathph:'',
					
					'action_status' => isset($action_status)?$action_status:'1',  
					'show_status'=>	'1',//isset($show_status)?$show_status:'0',
					'maker_id'=>$LOGINID,
					'maker_date'=>$curr_date,
					'updater_id'=>$LOGINID,
					'updater_date'=>$curr_date
				];
				//echo "<pre>";print_r($insertData);die;
				
				$this->db->insert($this->main_table, $insertData);
				$ID=$this->db->insert_id();
				if($ID!=''){
					if($lockscreen_image_src!=''){
						$fileInputboxName=$lockscreen_image_src;
						$this->upload_lockscreen_image($ID,$fileInputboxName);
					}
					if($in_app_image_src!=''){
						$fileInputboxName=$in_app_image_src;
						$this->upload_in_app_image($ID,$fileInputboxName);	
					}
			
					// scheduler
					$scheduler_type=($action_status=='3')?(isset($schedule_single_time)?'1':(isset($schedule_periodical_time)?'2':'0')):'0';
					
					$one_time_start_date=($scheduler_type=='1' && isset($schedule_single_time))?$one_time_start_date:'0000-00-00';
					$one_time_start_time=($scheduler_type=='1' && isset($schedule_single_time))?$one_time_start_time:'00:00:00';
					
					$periodical_type = ($scheduler_type=='2' && isset($periodical_type))?$periodical_type:'';	
					$weekly_day = ($scheduler_type=='2' && isset($weekly_day))?$weekly_day:'';
					$monthly_day = ($scheduler_type=='2' && isset($monthly_day))?$monthly_day:'';	
					$periodical_start_time= ($scheduler_type=='2' && isset($periodical_start_time))?date('H:i:s', strtotime($periodical_start_time)):'00:00:00';
						
					$insertScheduleData=[
						'notification_id' =>$ID,
						'scheduler_type'=> $scheduler_type,
						'one_time_start_date'=> $one_time_start_date,
						'one_time_start_time'=> $one_time_start_time,
						'periodical_type'=> $periodical_type,
						'weekly_day'=> $weekly_day,
						'monthly_day'=> $monthly_day,
						'periodical_start_time'=> $periodical_start_time,
						'show_status'=>	'1',//isset($show_status)?$show_status:'0',
						'maker_id'=>$LOGINID,
						'maker_date'=>$curr_date,
						'updater_id'=>$LOGINID,
						'updater_date'=>$curr_date
						];
					
					$this->db->insert("advance_notification_scheduler", $insertScheduleData);		
			
				}
		
			setFlashMsg('success_message',"Notification has been created successfully.",'alert-success');
			return true;
    }

    public function edit_notification(){
        extract($_POST); 
        $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
		$curr_date=date("Y-m-d H:i:s");
  		
		//Lockscreen Notification//
		$lockscreenNotificationTemplate = isset($lockscreenNotificationTemplate)?$lockscreenNotificationTemplate:'';
		$lockscreen_title = isset($lockscreenNotificationTemplate)?$lockscreen_title:'';
		$lockscreen_message = isset($lockscreenNotificationTemplate)?$lockscreen_message:'';
		$lockscreen_title_vi = isset($lockscreenNotificationTemplate)?$lockscreen_title_vi:'';
		$lockscreen_message_vi = isset($lockscreenNotificationTemplate)?$lockscreen_message_vi:'';
		$lockscreen_image_src = (isset($lockscreenNotificationTemplate) && isset($_FILES['lockscreen_image_src'])  && $_FILES['lockscreen_image_src']['name']!='')?'lockscreen_image_src':'';
		$lockscreen_action_first=isset($lockscreenNotificationTemplate)?$lockscreen_action_first:'';
		$lockscreen_action_first_url=(isset($lockscreenNotificationTemplate) && $lockscreen_action_first=='2')?$lockscreen_action_first_url:'';
		//end//
		
		// In App Notification//
		$inAppNotificationTemplate= isset($inAppNotificationTemplate)?$inAppNotificationTemplate:'';
		$in_app_template_type='';	
		$in_app_title= $in_app_message= $in_app_title_vi= $in_app_message_vi=$in_app_image_src ='';
		$in_app_action_btn_text_first=$in_app_action_btn_text_first_vi=$in_app_action_btn_first=$in_app_action_btn_url_first="";
		$in_app_action_btn_text_second=$in_app_action_btn_text_second_vi=$in_app_action_btn_second=$in_app_action_btn_url_second="";
			
		if(isset($inAppNotificationTemplate)){
			if(isset($inAppTextNotification)){
				// text
				$in_app_template_type='1';
				$in_app_title= $in_app_title1;
				$in_app_message= $in_app_message1;
				$in_app_title_vi= $in_app_title_vi1;
				$in_app_message_vi= $in_app_message_vi1;
				//end
			} else if(isset($inAppTextPictureNotification)){
				// text + picture
				$in_app_template_type='2';
				$in_app_title= $in_app_title2;
				$in_app_message= $in_app_message2;
				$in_app_title_vi= $in_app_title_vi2;
				$in_app_message_vi= $in_app_message_vi2;
				
				$in_app_image_src = (isset($_FILES['in_app_image_src2'])  && $_FILES['in_app_image_src2']['name']!='')?'in_app_image_src2':'';
				//end
			} else if(isset($inAppTextPictureOptionNotification)){
				// text + picture + options
				$in_app_template_type='3';
				$in_app_title= $in_app_title3;
				$in_app_message= $in_app_message3;
				$in_app_title_vi= $in_app_title_vi3;
				$in_app_message_vi= $in_app_message_vi3;
				
				$in_app_image_src = (isset($_FILES['in_app_image_src3'])  && $_FILES['in_app_image_src3']['name']!='')?'in_app_image_src3':'';
				
				$in_app_action_btn_text_first=$in_app_action_btn_text_first3;
				$in_app_action_btn_text_first_vi=$in_app_action_btn_text_first_vi3;
				$in_app_action_btn_first=$in_app_action_btn_first3;
				$in_app_action_btn_url_first=$in_app_action_btn_url_first3;
				
				$in_app_action_btn_text_second=$in_app_action_btn_text_second3;
				$in_app_action_btn_text_second_vi=$in_app_action_btn_text_second_vi3;
				$in_app_action_btn_second=$in_app_action_btn_second3;
				$in_app_action_btn_url_second=$in_app_action_btn_url_second3;
				//end
			} else if(isset($inAppTextOptionNotification)){
				// text + options
				$in_app_template_type='4';
				$in_app_title= $in_app_title4;
				$in_app_message= $in_app_message4;
				$in_app_title_vi= $in_app_title_vi4;
				$in_app_message_vi= $in_app_message_vi4;
				
				$in_app_action_btn_text_first=$in_app_action_btn_text_first4;
				$in_app_action_btn_text_first=$in_app_action_btn_text_first4;
				$in_app_action_btn_text_first_vi=$in_app_action_btn_text_first_vi4;
				$in_app_action_btn_first=$in_app_action_btn_first4;
				$in_app_action_btn_url_first=$in_app_action_btn_url_first4;
				
				$in_app_action_btn_text_second=$in_app_action_btn_text_second4;
				$in_app_action_btn_text_second_vi=$in_app_action_btn_text_second_vi4;
				$in_app_action_btn_second=$in_app_action_btn_second4;
				$in_app_action_btn_url_second=$in_app_action_btn_url_second4;
				//end
			} else if(isset($inAppTextAlertNotification)){
				// text + alert
				$in_app_template_type='5';
				$in_app_title= $in_app_title5;
				$in_app_message= $in_app_message5;
				$in_app_title_vi= $in_app_title_vi5;
				$in_app_message_vi= $in_app_message_vi5;
				
				$in_app_action_btn_text_second=$in_app_action_btn_text_second5;
				$in_app_action_btn_text_second_vi=$in_app_action_btn_text_second_vi5;
				$in_app_action_btn_second= '';//$in_app_action_btn_second5;
				$in_app_action_btn_url_second='';//$in_app_action_btn_url_second5;
				//end
			}
			//end//
		}
		// end	
		
		
		$demoarray=[];
		if(isset($demographics)){
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
		}
		
		$action_status=isset($btn_save_draft)?1:(isset($btn_save)?2:3);
          
		$updateData=[
					'name'=>isset($name)?$name:'',
					'name_vi'=>isset($name_vi)?$name_vi:'',
					'start_date'=>$start_date,
					//'start_datetime'=>isset($start_time)?$start_date.' '.date("H:i:s",strtotime($start_time)):$start_date.' '.$curr_time,
					//'start_time'=>'02:00:00',
					'end_date'=>$end_date,
					'category'=> $category,
					'team'=> $team,
					'lockscreenNotificationTemplate' => $lockscreenNotificationTemplate,
					'lockscreen_title' => $lockscreen_title,
					'lockscreen_message' => $lockscreen_message,
					'lockscreen_title_vi' => $lockscreen_title_vi,
					'lockscreen_message_vi' => $lockscreen_message_vi,
					'lockscreen_action_first' => $lockscreen_action_first,
					'lockscreen_action_first_url' => $lockscreen_action_first_url,
					
					'inAppNotificationTemplate' => $inAppNotificationTemplate,
					'in_app_template_type' => $in_app_template_type,
					'in_app_title' => $in_app_title,
					'in_app_message' => $in_app_message,
					'in_app_title_vi' => $in_app_title_vi,
					'in_app_message_vi' => $in_app_message_vi,
					
					'in_app_action_btn_text_first' => $in_app_action_btn_text_first,
					'in_app_action_btn_text_first_vi'=> $in_app_action_btn_text_first_vi,
					'in_app_action_btn_first'=> $in_app_action_btn_first,
					'in_app_action_btn_url_first'=> $in_app_action_btn_url_first,
					'in_app_action_btn_text_second'=> $in_app_action_btn_text_second,
					'in_app_action_btn_text_second_vi'=> $in_app_action_btn_text_second_vi,
					'in_app_action_btn_second'=> $in_app_action_btn_second,
					'in_app_action_btn_url_second'=> $in_app_action_btn_url_second,
					
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
					'deliveryathph'=>isset($deliveryathph)?$deliveryathph:'',
					'action_status' => isset($action_status)?$action_status:'1',  
					'show_status'=>	'1',//isset($show_status)?$show_status:'0',
					'updater_id'=>$LOGINID,
					'updater_date'=>$curr_date
				];
		//echo "<pre>"; print_r($updateData);die;
		$this->db->where("MD5(ID)", $ID);
        $this->db->update($this->main_table,$updateData);
		
		if($lockscreen_image_src!=''){
			$fileInputboxName=$lockscreen_image_src;
			$this->upload_lockscreen_image($ID,$fileInputboxName);
		}
		
		if($in_app_image_src!=''){
			$fileInputboxName=$in_app_image_src;
			$this->upload_in_app_image($ID,$fileInputboxName);	
		}
		
		
		// scheduler
		$scheduler_type=($action_status=='3')?(isset($schedule_single_time)?'1':(isset($schedule_periodical_time)?'2':'0')):'0';
		
		$one_time_start_date=($scheduler_type=='1' && isset($schedule_single_time))?$one_time_start_date:'0000-00-00';
		$one_time_start_time=($scheduler_type=='1' && isset($schedule_single_time))?$one_time_start_time:'00:00:00';
		
		$periodical_type = ($scheduler_type=='2' && isset($periodical_type))?$periodical_type:'';	
		$weekly_day = ($scheduler_type=='2' && isset($weekly_day))?$weekly_day:'';
		$monthly_day = ($scheduler_type=='2' && isset($monthly_day))?$monthly_day:'';	
		$periodical_start_time= ($scheduler_type=='2' && isset($periodical_start_time))?date('H:i:s', strtotime($periodical_start_time)):'00:00:00';
		
		$updateScheduleData=[
			'scheduler_type'=> $scheduler_type,
			'one_time_start_date'=> $one_time_start_date,
			'one_time_start_time'=> $one_time_start_time,
			'periodical_type'=> $periodical_type,
			'weekly_day'=> $weekly_day,
			'monthly_day'=> $monthly_day,
			'periodical_start_time'=> $periodical_start_time,
			'show_status'=>	'1',//isset($show_status)?$show_status:'0',
			'updater_id'=>$LOGINID,
			'updater_date'=>$curr_date
			];
			
		$this->db->update("advance_notification_scheduler",$updateScheduleData,array('MD5(notification_id)'=>$ID));		
		//end
					
        setFlashMsg('success_message',"Notification has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("AN.*,ANS.*");
        $this->db->from($this->main_table." as AN");
		$this->db->join("advance_notification_scheduler as ANS",'ANS.notification_id=AN.ID','LEFT');
        $this->db->where("MD5(AN.ID)",$ID);
        $this->db->where("AN.is_deleted",0);
        $result=$this->db->get()->row();
        return $result;
    }
	
	public function reorder_data($updateData=[]){
		if($updateData){
			//print_r($updateData);
			$this->db->update_batch($this->main_table,$updateData, 'ID');
			return true;	
		}	
	}
	
	function getSelectboxData(){
        $from_date =(isset($_POST['from_date']) && $_POST['from_date']!='')?$_POST['from_date']:"";//date("Y-m-01");
		$to_date =(isset($_POST['to_date']) && $_POST['to_date']!='')?$_POST['to_date']:"";//date("Y-m-t");
		
		$this->db->select("AN.ID, AN.name");
        $this->db->from($this->main_table." as AN");
		if($from_date!='' && $to_date!=''){
			$this->db->where("AN.start_date >=",$from_date);
			$this->db->where("AN.start_date <=",$to_date);
		}else if($from_date!=''){
			$this->db->where("AN.start_date",$from_date);
		}else if($to_date!=''){
			$this->db->where("AN.start_date",$to_date);
		}
		//$this->db->where("AN.show_status",1);
        //$this->db->where("AN.is_deleted",0);
        $this->db->order_by('AN.name','ASC');
        $result=$this->db->get()->result();
        return $result;
    }
	
	public function report_notification(){
        $result=$row=[];
		$ID=(isset($_POST['ID']) && $_POST['ID']!='')?$_POST['ID']:'';
		if($ID==''){
			$row=$this->db->select('ID,start_date,end_date')->from($this->main_table)->limit(1)->order_by('ID','DESC')->get()->row();
			$ID=($row)?MD5($row->ID):'';  	
		}
		
		if($ID!='')$ID=(is_numeric($ID))?md5($ID):$ID;
        
		$curr_date=date("Y-m-d H:i:s");
		//$week_start =(isset($_POST['week_start']) && $_POST['week_start']!='')?$_POST['week_start']:date("Y-m-d", strtotime('monday this week'));
		//$week_end =(isset($_POST['week_end']) && $_POST['week_end']!='')?$_POST['week_end']:date("Y-m-d", strtotime('sunday this week'));
		
		$this->db->select("AN.ID as notification_id,AN.start_date,AN.end_date,SUM(ANS.send_count) as send_count,SUM(ANS.seen_count) as seen_count,SUM(ANS.click_count) as click_count,SUM(ANS.interact_count) as interact_count");
        $this->db->from($this->main_table." as AN");
		$this->db->join("advance_notification_count as ANS",'ANS.notification_id=AN.ID','LEFT');
        $this->db->where("MD5(AN.ID)",$ID);
		//$this->db->where("AN.start_date >=",$week_start);
		//$this->db->where("AN.start_date <=",$week_end);
        $resultTotalCount=$this->db->get()->row();
		
		$this->db->select("AN.ID as notification_id,DATE_FORMAT(ANS.date, '%d %b') as date,SUM(ANS.send_count) as send_count,SUM(ANS.seen_count) as seen_count,SUM(ANS.click_count) as click_count,SUM(ANS.interact_count) as interact_count");
        $this->db->from($this->main_table." as AN");
		$this->db->join("advance_notification_count as ANS",'ANS.notification_id=AN.ID','LEFT');
        $this->db->where("MD5(AN.ID)",$ID);
		//$this->db->where("AN.start_date >=",$week_start);
		//$this->db->where("AN.start_date <=",$week_end);
        $this->db->group_by("ANS.date");
        $chartData=$this->db->get()->result();
		
		if($resultTotalCount->notification_id==null && $row){
			$resultTotalCount->notification_id=$row->ID;
			$resultTotalCount->start_date=$row->start_date;
			$resultTotalCount->end_date=$row->end_date;
		}
		
        $result['TotalCount']=$resultTotalCount;
		$result['chartData']=$chartData;
		
		return $result;
    }
	
	public function upload_in_app_image($ID='', $fileInputboxName=''){
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldfile_name='';
            $this->db->select("in_app_image_src");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
			//echo $this->db->last_query();die;
            if(!$row && !isset($row->in_app_image_src)){
                return false;  
            }
            
            $oldfile_name=$row->in_app_image_src;
            $fileInputboxName =($fileInputboxName!='')?$fileInputboxName:$_POST['fileInputboxName'];
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."advance-notification-image/inApp-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($fileInputboxName,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
    
                $updateArray = array("in_app_image_src"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Notification ID is missing.",'alert-info');
            return false;
        }    
    }
	
	public function upload_lockscreen_image($ID='', $fileInputboxName=''){
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldfile_name='';
            $this->db->select("lockscreen_image_src");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
			//echo $this->db->last_query();die;
            if(!$row && !isset($row->lockscreen_image_src)){
                return false;  
            }
            
            $oldfile_name=$row->lockscreen_image_src;
            $fileInputboxName =($fileInputboxName!='')?$fileInputboxName:$_POST['fileInputboxName'];
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."advance-notification-image/lockscreen-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($fileInputboxName,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
    
                $updateArray = array("lockscreen_image_src"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Notification ID is missing.",'alert-info');
            return false;
        }    
    }
	
    public function delete_notification_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
		
		// Remove Image
		$this->db->select("lockscreen_image_src,in_app_image_src");
        $this->db->from($this->main_table);
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->group_start();
		$this->db->where("lockscreen_image_src !=", '');
		$this->db->or_where("in_app_image_src !=", '');
        $this->db->group_end();
		$result=$this->db->get()->result();
        if($result){
            foreach($result as $value){
                if($value->lockscreen_image_src!='')remove_uploaded_file($value->lockscreen_image_src);
				if($value->in_app_image_src!='')remove_uploaded_file($value->in_app_image_src);	
            }
        }
		//end
		
        // for delete data from main table    
        $this->db->where_in("MD5(ID)", $IDS);
		//$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end
		
		// for delete data from advance_notification_scheduler table    
        $this->db->where_in("MD5(notification_id)", $IDS);
		//$this->db->update("advance_notification_scheduler",$updateData);
        $this->db->delete("advance_notification_scheduler");
        //end
		
        echo "Notification has been deleted successfully.";
        return;
    }

}