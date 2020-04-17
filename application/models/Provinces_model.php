<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinces_model extends CI_Model {
   public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->main_table="provinces";
    }

    function getData($is_active){
        $this ->db->select('P.*');
        $this->db->from($this->main_table .' as P');
        $this->db->where("P.is_deleted",0);
        if($is_active==1)$this->db->where("P.show_status",1);
        $result=$this->db->get()->result();
       
        return $result;
    }

}