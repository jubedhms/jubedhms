<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_beverage_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="food_beverage";
    }

    public function getData($is_active=''){
        $this->db->select("FB.*,UA.user_name as author,UE.user_name as editor");
        $this->db->from($this->main_table." as FB");
		$this->db->join("user as UE",'UE.ID=FB.updater_id','LEFT');
		$this->db->join("user as UA",'UA.ID=FB.maker_id','LEFT');
	    if($is_active==1)$this->db->where("FB.show_status",1);
        $this->db->where("FB.is_deleted",0);
        $this->db->order_by('FB.ID','DESC');
        $result=$this->db->get()->result();
        //echo $this->db->last_query(); echo "<br/><pre>";print_r($result);;die();
        return $result;
    }

    public function add_food_beverage(){
        extract($_POST);
        if($this->checkExist($item_code)==false){
            $LOGINID=$this->LOGINID;
            $curr_date=date("Y-m-d H:i:s");
			
            $insertData=[
					'item_code'=>$item_code,
					'name'=>$name,
					'currency_code'=> $currency_code,
					'list_price'=>$list_price,
					'discount_percent'=>$discount_percent,
					'discount_amount'=>$discount_amount,
					'sale_price'=>$sale_price,
					'description'=>$description,
					'push_notification'=>isset($push_notification)?$push_notification:'0',
					'maker_id'=> $LOGINID,
					'maker_date'=>$curr_date,
					'updater_id'=>$LOGINID,
					'updater_date'=>$curr_date
				];

            $this->db->insert($this->main_table, $insertData);
            $ID=$this->db->insert_id();
            if($ID){
				$file_name='image';
				if($_FILES[$file_name])$food_beverage_image=$this->upload_image($ID,$file_name);
				
				$home_banner_start_time=date("H:i:s",strtotime($home_banner_start_time));
				$home_banner_end_time=date("H:i:s",strtotime($home_banner_end_time));
				$home_slider_start_time=date("H:i:s",strtotime($home_slider_start_time));
				$home_slider_end_time=date("H:i:s",strtotime($home_slider_end_time));
				$notification_page_start_time=date("H:i:s",strtotime($notification_page_start_time));
				$notification_page_end_time=date("H:i:s",strtotime($notification_page_end_time));
				$notification_banner_start_time=date("H:i:s",strtotime($notification_banner_start_time));
				$notification_banner_end_time=date("H:i:s",strtotime($notification_banner_end_time));
				
				$insertNotificationData=[
							'module_id'=>$ID,
							'module_name'=> "food_beverage",
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
            setFlashMsg('success_message',"New Item has been created successfully.",'alert-success');
             return $item_code;
        }else{
			setFlashMsg('success_message',"This Item ID has been registered already.",'alert-danger');
			return false;
		}
    }

    public function edit_food_beverage(){
        extract($_POST);
			$ID=(is_numeric($ID))?md5($ID):$ID;
			$LOGINID=$this->LOGINID;
			$curr_date=date("Y-m-d H:i:s");
				
			$updateData=[
					'item_code'=>$item_code,
					'name'=>$name,
					'currency_code'=> $currency_code,
					'list_price'=>$list_price,
					'discount_percent'=>$discount_percent,
					'discount_amount'=>$discount_amount,
					'sale_price'=>$sale_price,
					'description'=>$description,
					'push_notification'=>isset($push_notification)?$push_notification:'0',
					'updater_id'=>$LOGINID,
					'updater_date'=>$curr_date
				];

			$this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
			
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
				
			$this->db->update("notification",$updateNotificationData,array('MD5(module_id)'=>$ID,'module_name'=> "food_beverage"));	
			
			setFlashMsg('success_message',"Item has been updated successfully.",'alert-success');
			return true;	
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("FB.*");
       $this->db->select("N.ID as notification_id ,N.module_id,N.module_name,N.home_banner,N.home_banner_start_date,N.home_banner_start_time,N.home_banner_end_date,N.home_banner_end_time,N.home_slider_banner,N.home_slider_start_date,N.home_slider_start_time,N.home_slider_end_date,N.home_slider_end_time,N.notification_page,N.notification_page_start_date,N.notification_page_start_time,N.notification_page_end_date,N.notification_page_end_time,N.notification_banner,N.notification_banner_start_date,N.notification_banner_start_time,N.notification_banner_end_date,N.notification_banner_end_time");
        $this->db->from($this->main_table." as FB");
		$this->db->join("notification as N",'N.module_id=FB.ID','LEFT');
		$this->db->where("N.module_name","food_beverage");
        $this->db->where("MD5(FB.ID)",$ID);
        $this->db->where("FB.is_deleted",0);
        $result=$this->db->get()->row();
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image==''){$result->image=$NoImage;}
        return $result;
    }

    public function checkExist($item_code=''){
        $item_code=($item_code!='')?$item_code:(isset($_POST['item_code'])?$_POST['item_code']:"");
		if($item_code!=''){
			$this->db->select("count(ID) as total");
			$this->db->from($this->main_table);
			$this->db->where("item_code",$item_code);
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
	
	public function checkSecondExist($ID='',$item_code=''){
		$ID=($ID!='')?$ID:(isset($_POST['ID'])?$_POST['ID']:"");
		$item_code=($item_code!='')?$item_code:(isset($_POST['item_code'])?$_POST['item_code']:"");
		if($ID!='' && $item_code!=''){
			$ID=(is_numeric($ID))?md5($ID):$ID;
			$this->db->select("count(ID) as total");
			$this->db->from($this->main_table);
			$this->db->where("MD5(ID) !=",$ID);
			$this->db->where("item_code",$item_code);
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
            $dest = $this->config->item('ROOT_DATA_DIR')."foods-beverages-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($fileInputboxName,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
    
                $updateArray = array("image"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"Item ID is missing.",'alert-info');
            return false;
        }    
    }
    
    public function delete_food_beverage_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);
		
		// for remove images
        $this->db->select("image");
        $this->db->from($this->main_table);
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->where("image !=", '');
        $result=$this->db->get()->result();
        if($result){
            foreach($result as $value){
                if($value->image!='')remove_uploaded_file($value->image); 
            }
        }
		//end
		
        // for food_beverage main table    
        $this->db->where_in("MD5(ID)", $IDS);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
        //end
		
		$this->db->where_in("MD5(module_id)", $IDS);
		$this->db->where("module_name","food_beverage");
		//$this->db->update("notification",$updateData);
        $this->db->delete("notification");
		
        echo "Item has been deleted successfully.";
        return;
    }


}