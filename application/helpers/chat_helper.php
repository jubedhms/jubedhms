<?php
	$CI =& get_instance();
	$tbl_prefix="";
	
	function getoption($ID,$language){
            global $CI;
            if($language=='en'){
                $query=$CI->db->select('ID,answer')->from('hms_chatbot_answers')->where('find_in_set("'.$ID.'",parent_id) !=',0)->where('is_deleted',0)->get();
            }elseif($language=='vi'){
                $query=$CI->db->select('ID,answer_vi')->from('hms_chatbot_answers')->where('find_in_set("'.$ID.'",parent_id) !=',0)->where('is_deleted',0)->get();
            }
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return false;
            }                
        }
        
?>
