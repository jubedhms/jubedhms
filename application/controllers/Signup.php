<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
public function __construct()
	{
        parent::__construct();
            $this->common_model->setSiteConfig();
            $this->load->model('signup_model');
            $this->main_page=base_url('/'.strtolower(get_class($this)));
            $this->heading='';
            $this->mode='';
	}
	
	public function index(){		
		$data=array();
		if($_POST){
			if($this->signup_model->addedit()){
				redirect('signin'); 
				die();
			}
		}
		$this->load->view('signup',$data);
	}
	
	
	
///////////////////////////////////////////////////////////////////////////	
}
