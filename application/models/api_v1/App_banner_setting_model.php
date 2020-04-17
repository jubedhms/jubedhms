<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_banner_setting_model extends CI_Model {
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

    public function get_home_banner_data(){
        $curr_date=date("Y-m-d");
        $response=array();
        $this ->db->select('name,awareness_image as src,description as text,short_by,position,is_slider,is_image,module_name');
        $this->db->from("awareness");
        $this->db->order_by("short_by", "asc");
        $result=$this->db->get()->result();
        if($result){
            foreach($result as $data){
                if($curr_date >= $data->start_date && $curr_date<=$data->end_date){
                    $response[]=array(
                        "name"=>$data->name, 
                        "src"=>$data->src, 
                        "text"=>$data->text, 
                        "short_by"=>$data->short_by, 
                        "position"=>$data->position,
                        "is_slider"=>$data->is_slider,
                        "is_image"=>$data->is_image, 
                    );
               }
            }
        }
        return $response; 
    }

}