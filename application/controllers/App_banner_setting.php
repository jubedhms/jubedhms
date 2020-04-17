<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_banner_setting extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('app_banner_setting_model');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='APP Banners';
		$this->mode='Manage';
		$this->MODULEID=37;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}
		
		$details=$this->app_banner_setting_model->getData($is_active='');
		$data['details']=$details;
		$data['MODULEID']=$this->MODULEID;
		$data['mode']=$this->mode;
		$data['heading']=$this->heading;
		$this->layout('settings/app_banner_setting',$data);
	}
	
	public function change_image(){
		$ID=(isset($_POST['ID']))?$_POST['ID']:$this->LOGINID;
		$data='';
		if($_POST){
			if($ID!=''){
				$newFileName=$this->app_banner_setting_model->upload_image($ID);
				redirect($_POST['model_image']);
				die();				
			}
		}
	}
	public function history_image(){
		if($_POST){
                    if($this->app_banner_setting_model->history_image()){
                        $status=1;
                        $msg='Image uploaded successfully';
                    }else{
                        $status=0;
                        $msg='Image upload failed';
                    }
                    echo json_encode(array("status"=>$status,"msg"=>$msg));
                }
	}
        
        public function get_image(){
            $data['image_dir']=$this->input->post('image_dir');
            $recent_img=$this->input->post('recent');
            $data['recent']=isset($recent_img)?$recent_img:0;
            return $this->load->view('settings/image_history',$data);
        }
        
        public function remove_history_image(){
            $image_dir=$this->input->post('image_dir');
            if($image_dir){
                if(unlink($image_dir)){
                        $status=1;
                        $msg='Image removed successfully';
                }else{
                        $status=0;
                        $msg='Image remove failed';
                }
            }else{
                $status=0;
                $msg='No image or path found to remove this image';
            }
            echo json_encode(array("status"=>$status,"msg"=>$msg));
        }

        public function remove_image(){
            $ID=$this->input->post('id');
            $status=0;
            $msg='No record found to remove.';
            if($ID){
                if($this->app_banner_setting_model->remove_image($ID)){
                    $status=1;
                    $msg='removed successfully';
                }else{
                    $status=0;
                    $msg='removed failed';
                }
            }
                echo json_encode(array("status"=>$status,"msg"=>$msg));
        }
        
        public function save_image(){
            $ID=$this->input->post('id');
            $src=$this->input->post('src');
            if($ID){
                if($this->app_banner_setting_model->save_image($ID,$src)){
                    $status=1;
                    $msg='Save successfully';
                }else{
                    $status=0;
                    $msg='Save failed';
                }
            }
                echo json_encode(array("status"=>$status,"msg"=>$msg));
        }
        
        public function change_order(){
		$ID=$this->input->post('id');
		$order=$this->input->post('order');
                $status=0;
                $msg='No record found to change order.';
                if($ID){
                    if($this->app_banner_setting_model->change_order($ID,$order)){
                        $status=1;
                        $msg='Order Changed successfully';
                    }else{
                        $status=0;
                        $msg='Order Changed failed';
                    }
                }
                echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	 
////////////////////////////////////////////////////////
}
