<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Advance_notification extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('advance_notification_model');
        $this->main_page = base_url('' . strtolower(get_class($this)));
        $this->heading = 'Advance Notification';
        $this->mode = 'Add';
        $this->MODULEID = 34;
    }

    public function index() {
        if (!checkModulePermission($this->MODULEID)) {
            redirect('dashboard');
            die();
        }

        if ($_POST) {
            //if($this->advance_notification_model->addedit()){
            //redirect($this->main_page); die;
            //}
        }

        $details = $this->advance_notification_model->getData($is_active = '');
        $data['details'] = $details;
        $data['MODULEID'] = $this->MODULEID;
        $data['mode'] = "Manage";
        $data['heading'] = $this->heading;

        $this->layout('advance_notification/manage_notification', $data);
    }

    public function addedit_notification($ID = '') {
        if (!checkModulePermission($this->MODULEID, 'add_btn') || !checkModulePermission($this->MODULEID, 'edit_btn')) {
            //redirect('dashboard');
            die();
        }

        $details = '';

        if ($_POST) {
            if ($ID != '') {
                $this->advance_notification_model->edit_notification();
            } else {
                $this->advance_notification_model->add_notification();
            }
            redirect('advance_notification');
            die();
        }

        if ($ID != '') {
            $details = $this->advance_notification_model->loadDataById($ID);
            $this->mode = 'Edit';
        }

        $data['details'] = $details;
        $data['main_page'] = $this->main_page;
        $data['MODULEID'] = $this->MODULEID;
        $data['mode'] = $this->mode;
        $data['heading'] = $this->heading;
        $this->main_page = $this->main_page;
        $this->layout('advance_notification/addedit_notification', $data);
    }

    public function view_notification($ID = '') {
        if (!checkModulePermission($this->MODULEID, 'view_btn')) {
            redirect('dashboard');
            die();
        }

        $this->mode = 'View';
        $details = $this->advance_notification_model->loadDataById($ID);
        $data['details'] = $details;
        $data['main_page'] = $this->main_page;
        $data['MODULEID'] = $this->MODULEID;
        $data['mode'] = $this->mode;
        $data['heading'] = $this->heading;
        $this->main_page = $this->main_page;

        $this->layout('advance_notification/view_notification', $data);
    }

    public function change_image() {

        $ID = (isset($_POST['ID'])) ? $_POST['ID'] : $this->LOGINID;
        $data = '';

        if ($_POST) {
            if ($ID != '') {
                $newFileName = $this->advance_notification_model->upload_image($ID);
                redirect($_POST['model_image']);
                die();
            }
        }

        $data['main_page'] = $this->main_page;
        $data['heading'] = ''; //$this->heading;
        $data['mode'] = "Change Image";
    }

     public function dragRow() {
        if (isset($_POST['position'])) {
			$response=$this->advance_notification_model->reorder_data($_POST['position']);
			return $response;
			die;
		}
    }
	
	public function deleteData($IDS = array()) {
        if (isset($_POST['IDS']) || $IDS) {
            $this->advance_notification_model->delete_notification_data($IDS);
        }
    }
	
	public function report(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}
		
		$LOGINROLEID=$this->LOGINROLEID;
		$data['heading']='Advance Notification';
		$data['mode']="";
		$data['notificationList']=$this->advance_notification_model->getSelectboxData();
		
		$this->layout('advance_notification/report_notification',$data);
    }
	
	public function getSelectboxData(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}
		
		$data=$this->advance_notification_model->getSelectboxData();
		echo json_encode($data);die();
    }
	
	public function reportChartData(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard'); die;
		}
		
		$data=$this->advance_notification_model->report_notification();
		echo json_encode($data);die();
    }
}
