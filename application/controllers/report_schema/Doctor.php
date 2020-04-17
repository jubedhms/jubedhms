<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model("report_schema/doctor_model");
	}
	
	public function index(){ 
		$sync=$this->doctor_model->addedit_doctor();
		echo "<pre>";print_r($sync);die();
	}

}