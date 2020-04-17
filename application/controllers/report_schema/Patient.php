<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('report_schema/patient_model');
	}
	
	public function index(){ 
		$sync=$this->patient_model->update_prn();
		echo "<pre>";print_r($sync);die();
	}

}