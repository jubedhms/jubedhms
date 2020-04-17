<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signout extends MY_Controller {
	public function __construct($value='')
	{
		parent::__construct();
		$this->load->model('signin_model');
		$this->load->helper('cookie');
	}
	
	public function index(){		
	$LOGINID=$this->LOGINID;
	
	$this->signin_model->UpdateSignoutTime($LOGINID);
	unset(
        $_SESSION['login_data'],
        $_SESSION['user_data']
    );
	$this->session->sess_destroy();
	redirect('/');
	}
	
	
	
	
	
}
