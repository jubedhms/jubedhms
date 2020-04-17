<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_banner_setting_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="app_banner_setting";
    }

    public function getData($is_active=''){
        $this->db->select("BS.*");
        $this->db->from($this->main_table." as BS");
        if($is_active==1)$this->db->where("BS.show_status",1);
        $this->db->where("BS.is_deleted",0);
		$this->db->order_by("BS.ID", "asc");
        $result=$this->db->get()->result();
        return $result;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("BS.*");
        $this->db->from($this->main_table." as BS");
        $this->db->where("MD5(BS.ID)",$ID);
        $result=$this->db->get()->row();
        return $result;
    }
    
   public function upload_image($ID='', $file_name=''){
       //print_r($_POST);die;
        $width=$this->input->post('width');
        $height=$this->input->post('height');
        $oldfile_name='';
        $file_name =($file_name=='')?$this->input->post('file_name'):$file_name;
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $this->db->select($file_name);
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $oldfile_name=$this->db->get()->row()->$file_name;
            $this->db->select('module_name');
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $module_name=$this->db->get()->row()->module_name;
        }

        $dest = $this->config->item('ROOT_DATA_DIR').'app/'.$module_name.'/';
		/*print_r($dest);
		die();*/
        $resultData = uploadImg($file_name,$dest);
        if($resultData!==false){
            if($oldfile_name!='')remove_uploaded_file($oldfile_name);
            $newFileName=$dest.$resultData['upload_data']['file_name'];
             
            $this->resize_file($resultData['upload_data']['file_name'],$width,$height,$module_name);
            
            $updateArray = array($file_name=>$newFileName);
            $this->db->where('MD5(ID)',$ID);
            $successData = $this->db->update($this->main_table,$updateArray);
            setFlashMsg('success_message',"Image has been updated successfully.",'alert-success');
            return $newFileName;
        }else{
            setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
            return '';
        }
    }
    
    function resize_file($file_nm, $wth='', $hgth='',$module_name=''){
            $file_dir=$this->config->item('ROOT_DATA_DIR')."app/".$module_name.'/';
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            //$config['source_image'] = './public/images/'.$file_nm;
            $config['source_image'] = $file_dir.$file_nm;
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = false;
            $config['width']     = $wth;
            $config['height']   = $hgth;
            
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
           // echo $file_nm;die;
            if($this->image_lib->resize()){
                return true;
            }else{
                 echo $this->image_lib->display_errors(); 
            }
	}
        
        function remove_image($ID){
            $this->db->where('MD5(ID)',$ID);
            if($this->db->update($this->main_table,array('src'=>''))){
                return true;
            }else{
                return false;
            }
        }
        
        function change_order($ID,$order){
			$previour_order=$this->db->select('short_by')->from($this->main_table)->where('MD5(ID)',$ID)->get()->row()->short_by;
			
			$this->db->where('MD5(ID)',$ID);
            if($this->db->update($this->main_table,array('short_by'=>$order))){
			$module_name=$this->db->select('ID,module_name,short_by')->from($this->main_table)->where('MD5(ID)',$ID)->get()->row();			
			$updated_id=$module_name->ID;
			
            $imagedata=$this->db->select('ID,short_by')->from($this->main_table)->where(array('module_name'=>$module_name->module_name,'ID !='=>$updated_id))->order_by('short_by','asc')->get()->result();
			$i=1;
			foreach($imagedata as $rowimgdata){
				 if($order==$i){
					$i++;
					if($previour_order>$order){
					$this->db->where('ID',$rowimgdata->ID);
					$this->db->update($this->main_table,array('short_by'=>$i));
					}
				}else{
					$this->db->where('ID',$rowimgdata->ID);
					$this->db->update($this->main_table,array('short_by'=>$i));
				}
				$i++;
			}
                return true;
            }else{
                return false;
            }
		
        }
     
}