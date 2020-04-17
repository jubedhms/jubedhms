<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="cart";
    }

    public function get_data(){
         extract($_GET);
		$curr_date=date("Y-m-d");
		$curr_time=date("H:i:s");
		
		$this ->db->select("ID as cart_id,module_name,module_id,quantity");
		$this->db->from($this->main_table);
		$this->db->where("patient_prn",$prn);	
		
		if(isset($from_date) && $from_date!=''){
            $this->db->where('maker_date >=', $from_date);
        }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('maker_date <=', $to_date);
        }

		if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
		
		$this->db->order_by("ID","desc");
		$result=$this->db->get()->result();
		if($result){
			foreach($result as $key=>$value){
				
				if($value->module_name=='special_offer'){
					$this ->db->select('ID,offer_id as code,name,image,description,"1" as in_stock');
				}else if($value->module_name=='product'){
					$this ->db->select('ID,product_id as code,name,image,description,quantity as in_stock');
				}else if($value->module_name=='service'){
					$this ->db->select('ID,service_id as code,name,image,description,"1" as in_stock');
				}else if($value->module_name=='food_beverage'){
					$this ->db->select('ID,item_code as code,name,image,description,"1" as in_stock');
				}
	
				$this->db->from($value->module_name);
				$this->db->where('ID',$value->module_id);
				if(isset($item_name) && $item_name!=''){
					$this->db->like('name',$name);
				}	
				$this->db->where('is_deleted',0);
				$this->db->where('show_status',1);
				$res=$this->db->get()->row();
				
				if($res){
					//$value->item_id=$res->ID;
					$value->item_code=$res->code;
					$value->name=$res->name;
					$value->description=$res->description;
					$value->image_src=$res->image;
					$value->short_by=$key;
					$value->in_stock=($res->in_stock>0)?true:false;	
				}else{
					if($result[$key])unset($result[$key]);
				}
			}
		}	
		
		return $result; 
    }
	
	public function add_item($prn='',$module_name='',$module_id='',$quantity=''){
        $curr_date=date("Y-m-d");
		$insertData=[
					'patient_prn'=>$prn,
					'module_name'=>$module_name,
					'module_id'=>$module_id,
					'quantity'=>$quantity,
					'maker_id'=> '0',
					'maker_date'=>$curr_date,
					'updater_id'=>'0',
					'updater_date'=>$curr_date
				];

            $this->db->insert($this->main_table, $insertData);
            $ID=$this->db->insert_id();
       
        return $ID;
    }
    
	public function remove_item($prn='',$ID=''){
		$this->db->where("patient_prn", $prn);
		$this->db->where("ID", $ID);
        //$this->db->update($this->main_table,$updateData);
        $this->db->delete($this->main_table);
		return;	
	}
	
}
