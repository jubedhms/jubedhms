<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
	public function __construct($value=''){
		parent::__construct();
        $this->common_model->setSiteConfig();
		$this->load->model('signin_model');
	}
	
	public function index(){
		//check_url_permission(); // helper function	
		$data=array();
		$data['credential']='';
		if(get_cookie('remember_me')!=''){
			$data['credential'] =(object) unserialize(get_cookie('remember_me'));
			//print_r($data['credential']);die;
        }
		if($_POST){
			if($this->signin_model->checkLogin()){
				redirect('dashboard');
				die();
			}
		}

		if(getSession('login_data')){
			redirect('dashboard'); 
			die();
		}
		$this->load->view('signin',$data);
	}
	
	public function forgot_password(){
		$data='';
		if($_POST){ 
			if($this->signin_model->forgotPassword()){
				redirect('/'); 
				die();
			}
		}
		if(getSession('login_data')){
			redirect('dashboard'); 
			die();
		}
		$this->load->view('forgot_password',$data);
		
	}
	
	 public function resetPassword(){	
        $header['bodyClass'] = 'single-bg';
        $header['pageTitle'] = 'Reset Password';
        $expire = $this->config->item('reset_url_duration');
        if(isset($_GET['link'])){
          $linkurl = $_GET['link'];
        }
        else if(isset($_POST['link'])){
           $linkurl = $_POST['link'];
        }
        
        $data['myurl'] = '';
        
	    @$link = base64_decode($linkurl);
	    $link = str_replace("|",",",$link);
	    $linkarr = explode(",",$link);
       //print_r($linkarr);die;
	    if($linkarr[0]!='' && $linkarr[1]!=''){
			$id = $linkarr[0];
			$time = @$linkarr[1]+$expire;
			$presenttime = time();
			if($presenttime>$time){
				echo "Your session has been expired.";
				die();
			}	
		}else{
			echo "You are unauthorized person.";
			die();
		}
		
       if($_POST)
            {
				$this->signin_model->resetPassword($id);
                redirect(base_url('signin'));
            }
           $data['myurl'] = $linkurl;
           $data["title"] = 'Reset Password';
          
          $this->load->view('resetPassword',$data);
        
    }
	
}
