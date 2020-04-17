<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends  CI_Controller {
	public function __construct($value='')
	{
            parent::__construct();
            $this->common_model->setSiteConfig();
	}
	
	public function index()
	{
		redirect("signin");
		//$this->load->view('user/home');
	}
	
}
