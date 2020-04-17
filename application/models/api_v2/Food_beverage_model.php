<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_beverage_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="food_beverage";
    }

    public function get_data(){
        extract($_GET);       
        $this ->db->select('ID,item_code,name,image as image_src,currency_code,list_price,discount_percent,discount_amount,sale_price,description');
        $this->db->from($this->main_table);
	    //$this->db->where("quantity > min_quantity");
        $this->db->where("show_status",1);
		$this->db->where("is_deleted",0);
		
		if(isset($name) && $name!=''){
           $this->db->like('name',$name);
        }
		
        if(isset($from_date) && $from_date!=''){
            $this->db->where('updater_date >=', $from_date);
         }
         
         if(isset($to_date) && $to_date!=''){
            $this->db->where('updater_date <=', $to_date);
         }

        if(isset($limit) && $limit!='' && isset($start) && $start!=''){
            $this->db->limit($limit, $start);
        }
        $this->db->order_by("ID", "desc");
        $result=$this->db->get()->result();
        return $result; 
    }
	
	 public function loadDataById($item_code=''){
        $this ->db->select('ID,item_code,name,image as image_src,currency_code,list_price,discount_percent,discount_amount,sale_price,description');
        $this->db->from($this->main_table);
		$this->db->where("item_code",$item_code);
		//$this->db->where("quantity > min_quantity");
        $this->db->where("show_status",1);
		$this->db->where("is_deleted",0);
        $result=$this->db->get()->row();
       
        return $result;
    }
    

}