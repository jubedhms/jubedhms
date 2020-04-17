<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_banner_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="app_banner_setting";
    }

    public function get_data(){
        extract($_GET);
        $this ->db->select('name,src,text,short_by,position,is_slider,is_image,module_name');
        $this->db->from($this->main_table);
        $this->db->where("module_name",$module_name);
        $this->db->order_by("short_by", "asc");
        $result=$this->db->get()->result();
        return $result; 
    }
	
	
	public function get_push_notification_data($type=''){
		$response=[];
		
		if($type=='home_banner'){
			$response=$this->get_home_banner_data();
		}else if($type=='home_slider_banner'){
			$response=$this->get_home_slider_data();
		}else if($type=='notification_banner'){
			$response=$this->get_notification_banner_data();
		}else if($type=='notification_message'){
			$response=$this->get_notification_page_data();
		}
		return $response;
	}
	
    public function get_home_banner_data(){
        extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$file_type=isset($_GET['file_type'])?$_GET['file_type']:'';
		$response=[];
		$language=isset($_GET['language'])?$_GET['language']:'en';
		
        // from notification common table 
		if($language=='vi'){
			$this ->db->select("N.title_vi as name,N.description_vi as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}else{
			$this ->db->select("N.title as name,N.description as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}
		
		$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from("notification as N");
		$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "LEFT");
		$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
		if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.home_banner","1");
		$this->db->where('N.module_name !=','notification');
		
		$this->db->where("CONCAT_WS(' ',N.home_banner_start_date,N.home_banner_start_time) <=",$curr_date." ".$curr_time,"both");
		$this->db->where("CONCAT_WS(' ',N.home_banner_end_date,N.home_banner_end_time) >=",$curr_date." ".$curr_time,"both");
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($module_name) && $module_name!=''){
			if($module_name=='shop'){
				$this->db->group_start();
				$this->db->where('N.module_name','special_offer');
				$this->db->or_where('N.module_name','product');
				$this->db->or_where('N.module_name','service');
				$this->db->or_where('N.module_name','food_beverage');
				$this->db->group_end();
			}else if($module_name=='service'){
				$this->db->where('N.module_name',"product");
			}else{
				$this->db->where('N.module_name',$module_name);
			}
		}	
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.home_banner_start_date >=', $from_date);
        }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('N.home_banner_end_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->group_by("N.ID");
		$this->db->order_by("N.home_banner_start_date","desc");
		$this->db->order_by("N.home_banner_start_time","desc");
        $result=$this->db->get()->result();
		//echo "<pre>";print_r($result);die;
		if($result){
			foreach($result as $key=>$value){
				if($value->module_name!='notification'){
					
					if($value->module_name=='awareness'){
						$this ->db->select('name,awareness_image as image,description,file_type,ages,relationship,province,city,district,gender');
						//$this->db->where('start_date <=',$curr_date);
						$this->db->where('start_datetime <=',$curr_date.' '.$curr_time);
						$this->db->where('end_date >=',$curr_date); 
						if($file_type!='')$this->db->where('file_type',$file_type);		
					}else if($value->module_name=='pregnancy_period'){
						$this ->db->select('name,pregnancy_period_image as image,description,file_type');	
					}else if($value->module_name=='special_offer'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='product'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='service'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='food_beverage'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}
					
					if($value->module_name=='service'){
						$this->db->from("product");
					}else{
						$this->db->from($value->module_name);	
					}
					
					$this->db->where('ID',$value->module_id);
					$this->db->where('is_deleted',0);
					$this->db->where('show_status',1);
					$res=$this->db->get()->row();
					if($res && isset($value->name) && $value->name!='' && isset($value->text) && $value->text!=''){
						if($value->module_name=='awareness'){
							$demographics=$this->check_demographics($value,$res);
							if($demographics==false){
								continue;
							}	
						}
						
						$response[]=[
								'module_id'=>$value->module_id,
								'module_name'=>$value->module_name,
								'name'=>$value->name,
								'text'=>$value->text,
								'src'=>$res->image,
								'file_type'=> $res->file_type,
								'short_by'=>$key,
							];
					}
				}
			}
		}	
		
        return $response; 
    }
	
	
	public function get_home_slider_data(){
         extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$file_type=isset($_GET['file_type'])?$_GET['file_type']:'';
		$response=[];
        $language=isset($_GET['language'])?$_GET['language']:'en';
		
        // from notification common table 
		if($language=='vi'){
			$this ->db->select("N.title_vi as name,N.description_vi as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}else{
			$this ->db->select("N.title as name,N.description as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}
		
		$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from("notification as N");
		$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "LEFT");
		$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
		if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.home_slider_banner","1");
		$this->db->where('N.module_name !=','notification');
		
		$this->db->where("CONCAT_WS(' ',N.home_slider_start_date,N.home_slider_start_time) <=",$curr_date." ".$curr_time,"both");
		$this->db->where("CONCAT_WS(' ',N.home_slider_end_date,N.home_slider_end_time) >=",$curr_date." ".$curr_time,"both");
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($module_name) && $module_name!=''){
			if($module_name=='shop'){
				$this->db->group_start();
				$this->db->where('N.module_name','special_offer');
				$this->db->or_where('N.module_name','product');
				$this->db->or_where('N.module_name','service');
				$this->db->or_where('N.module_name','food_beverage');
				$this->db->group_end();
			}else if($module_name=='service'){
				$this->db->where('N.module_name',"product");
			}else{
				$this->db->where('N.module_name',$module_name);
			}
		}	
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.home_slider_start_date >=', $from_date);
        }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('N.home_slider_end_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->group_by("N.ID");
		$this->db->order_by("N.home_slider_start_date","desc");
		$this->db->order_by("N.home_slider_start_time","desc");
        $result=$this->db->get()->result();
		if($result){
			foreach($result as $key=>$value){
				if($value->module_name!='notification'){
					
					if($value->module_name=='awareness'){
						$this ->db->select('name,awareness_image as image,description,file_type,ages,relationship,province,city,district,gender');
						//$this->db->where('start_date <=',$curr_date);
						$this->db->where('start_datetime <=',$curr_date.' '.$curr_time);
						$this->db->where('end_date >=',$curr_date); 
						if($file_type!='')$this->db->where('file_type',$file_type);	
					}else if($value->module_name=='special_offer'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='product'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='service'){
						$value->module_name='product';
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='food_beverage'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}
					
					$this->db->from($value->module_name);
					$this->db->where('ID',$value->module_id);
					$this->db->where('is_deleted',0);
					$this->db->where('show_status',1);
					$res=$this->db->get()->row();
					if($res && isset($value->name) && $value->name!='' && isset($value->text) && $value->text!=''){
						if($value->module_name=='awareness'){
							$demographics=$this->check_demographics($value,$res);
							if($demographics==false){
								continue;
							}
						}
						
						$response[]=[
								'module_id'=>$value->module_id,
								'module_name'=>$value->module_name,
								'name'=>$value->name,
								'text'=>$value->text,
								'src'=>$res->image,
								'file_type'=> $res->file_type,
								'short_by'=>$key
							];
					}
				}
			}
		}
		
        return $response; 
    }
	
	public function get_notification_banner_data(){
         extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$file_type=isset($_GET['file_type'])?$_GET['file_type']:'';
		$response=[];
        $language=isset($_GET['language'])?$_GET['language']:'en';
		
        // from notification common table 
		if($language=='vi'){
			$this ->db->select("N.title_vi as name,N.description_vi as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}else{
			$this ->db->select("N.title as name,N.description as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}
		
		$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from("notification as N");
		$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "LEFT");
		$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
		if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.notification_banner","1");
		$this->db->where('N.module_name !=','notification');
		
		$this->db->where("CONCAT_WS(' ',N.notification_banner_start_date,N.notification_banner_start_time) <=",$curr_date." ".$curr_time,"both");
		$this->db->where("CONCAT_WS(' ',N.notification_banner_end_date,N.notification_banner_end_time) >=",$curr_date." ".$curr_time,"both");
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($module_name) && $module_name!=''){
			if($module_name=='shop'){
				$this->db->group_start();
				$this->db->where('N.module_name','special_offer');
				$this->db->or_where('N.module_name','product');
				$this->db->or_where('N.module_name','service');
				$this->db->or_where('N.module_name','food_beverage');
				$this->db->group_end();
			}else if($module_name=='service'){
				$this->db->where('N.module_name',"product");
			}else{
				$this->db->where('N.module_name',$module_name);
			}
		}	
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.notification_banner_start_date >=', $from_date);
        }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('N.notification_banner_end_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->group_by("N.ID");
		$this->db->order_by("N.notification_banner_start_date","desc");
		$this->db->order_by("N.notification_banner_start_time","desc");
        $result=$this->db->get()->result();
		if($result){
			foreach($result as $key=>$value){
				if($value->module_name!='notification'){
					
					if($value->module_name=='awareness'){
						$this ->db->select('name,awareness_image as image,description,file_type,ages,relationship,province,city,district,gender');
						//$this->db->where('start_date <=',$curr_date);
						$this->db->where('start_datetime <=',$curr_date.' '.$curr_time);
						$this->db->where('end_date >=',$curr_date); 
						if($file_type!='')$this->db->where('file_type',$file_type);	
					}else if($value->module_name=='pregnancy_period'){
						$this ->db->select('name,pregnancy_period_image as image,description,file_type');	
					}else if($value->module_name=='special_offer'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='product'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='service'){
						$value->module_name='product';
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='food_beverage'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}
					
					$this->db->from($value->module_name);
					$this->db->where('ID',$value->module_id);
					$this->db->where('is_deleted',0);
					$this->db->where('show_status',1);
					$res=$this->db->get()->row();
					if($res && isset($value->name) && $value->name!='' && isset($value->text) && $value->text!=''){
						if($value->module_name=='awareness'){
							$demographics=$this->check_demographics($value,$res);
							if($demographics==false){
								continue;
							}
						}
						
						$response[]=[
								'module_id'=>$value->module_id,
								'module_name'=>$value->module_name,
								'name'=>$res->name,
								'name'=>$value->name,
								'text'=>$value->text,
								'file_type'=> $res->file_type,
								'short_by'=>$key
							];
					}
				}
			}
		}	
        return $response; 
    }
	
	public function get_notification_page_data(){
         extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		$file_type=isset($_GET['file_type'])?$_GET['file_type']:'';
		$response=[];
        $language=isset($_GET['language'])?$_GET['language']:'en';
		
        // from notification common table 
		if($language=='vi'){
			$this ->db->select("N.title_vi as name,N.description_vi as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}else{
			$this ->db->select("N.title as name,N.description as text,'' as image_src,'' as short_by,N.module_name,N.module_id");
		}
		
		$this ->db->select("TIMESTAMPDIFF(YEAR, P.dob, CURDATE()) AS patient_age,P.gender as patient_gender,P.marital_status as patient_relationship");
		$this ->db->select("PA.province_code as patient_province,PA.city_code as patient_city,PA.district_code as patient_district");
		
		$this->db->from("notification as N");
		$this->db->join("patient as P", "FIND_IN_SET(P.patient_group, N.customer_group)", "LEFT");
		$this->db->join("patient_address as PA", "PA.patient_id=P.ID", "LEFT");
		if(isset($username))$this->db->where("P.username",$username);
		
		$this->db->where("N.notification_page","1");
		$this->db->where('N.module_name !=','notification');
		
		$this->db->where("CONCAT_WS(' ',N.notification_page_start_date,N.notification_page_start_time) <=",$curr_date." ".$curr_time,"both");
		$this->db->where("CONCAT_WS(' ',N.notification_page_end_date,N.notification_page_end_time) >=",$curr_date." ".$curr_time,"both");
		$this->db->where("N.is_deleted",0);
        $this->db->where("N.show_status",1);
		
		if(isset($module_name) && $module_name!=''){
			if($module_name=='shop'){
				$this->db->group_start();
				$this->db->where('N.module_name','special_offer');
				$this->db->or_where('N.module_name','product');
				$this->db->or_where('N.module_name','service');
				$this->db->or_where('N.module_name','food_beverage');
				$this->db->group_end();
			}else if($module_name=='service'){
				$this->db->where('N.module_name',"product");
			}else{
				$this->db->where('N.module_name',$module_name);
			}
		}	
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('N.notification_page_start_date >=', $from_date);
        }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('N.notification_page_end_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->group_by("N.ID");
		$this->db->order_by("N.notification_page_start_date","desc");
		$this->db->order_by("N.notification_page_start_time","desc");
        $result=$this->db->get()->result();
		if($result){
			foreach($result as $key=>$value){
				if($value->module_name!='notification'){
					
					if($value->module_name=='awareness'){
						$this ->db->select('name,awareness_image as image,description,file_type,ages,relationship,province,city,district,gender');
						//$this->db->where('start_date <=',$curr_date);
						$this->db->where('start_datetime <=',$curr_date.' '.$curr_time);
						$this->db->where('end_date >=',$curr_date); 
						if($file_type!='')$this->db->where('file_type',$file_type);	
					}else if($value->module_name=='pregnancy_period'){
						$this ->db->select('name,pregnancy_period_image as image,description,file_type');	
					}else if($value->module_name=='special_offer'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='product'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='service'){
						$value->module_name='product';
						$this ->db->select('name,image,description,"1" AS file_type');
					}else if($value->module_name=='food_beverage'){
						$this ->db->select('name,image,description,"1" AS file_type');
					}
					
					$this->db->from($value->module_name);
					$this->db->where('ID',$value->module_id);
					$this->db->where('is_deleted',0);
					$this->db->where('show_status',1);
					$res=$this->db->get()->row();
					if($res && isset($value->name) && $value->name!='' && isset($value->text) && $value->text!=''){
						if($value->module_name=='awareness'){
							$demographics=$this->check_demographics($value,$res);
							if($demographics==false){
								continue;
							}
						}
						
						$response[]=[
								'module_id'=>$value->module_id,
								'module_name'=>$value->module_name,
								'name'=>$value->name,
								'text'=>$value->text,
								'src'=>$res->image,
								'file_type'=>$res->file_type,
								'short_by'=>$key
							];
					}
				}
			}
		}	
        return $response; 
    }
	
	public function check_demographics($value,$res){
		$patient_age_range='';
		
		if($value->patient_age<=18){
			$patient_age_range=1;			
		}else if($value->patient_age >=18 && $value->patient_age <=24){
			$patient_age_range=2;			
		}else if($value->patient_age >=25 && $value->patient_age <=34){
			$patient_age_range=3;			
		}else if($value->patient_age >=35 && $value->patient_age <=44){
			$patient_age_range=4;			
		}else if($value->patient_age >=45){
			$patient_age_range=5;			
		}
		
		$ageRanges=($res->ages!='')?explode(',',$res->ages):[];
		$relationshipRanges=($res->relationship!='')?explode(',',$res->relationship):[];
		$genderRanges=($res->gender!='')?explode(',',$res->gender):[];
		$provinceRanges=($res->province!='')?explode(',',$res->province):[];
		$cityRanges=($res->city!='')?explode(',',$res->city):[];
		$districtRanges=($res->district!='')?explode(',',$res->district):[];
		
		if($ageRanges && !in_array($patient_age_range,$ageRanges)){
			return false;
		}
	
		if($relationshipRanges && !in_array($value->patient_relationship,$relationshipRanges)){
			return false;
		}

		if($genderRanges && !in_array($value->patient_gender,$genderRanges)){
			return false;
		}

		if($provinceRanges && !in_array($value->patient_province,$provinceRanges)){
			return false;
		}
		
		if($cityRanges && !in_array($value->patient_city,$cityRanges)){
			return false;
		}
		
		if($districtRanges && !in_array($value->patient_district,$districtRanges)){
			return false;
		}
		
		return true;	
	}
	
	
}
