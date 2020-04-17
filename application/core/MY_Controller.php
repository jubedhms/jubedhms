<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public $login_data, $LOGINID, $LOGINROLEID, $premissionModule, $TODATE;
	public function __construct()
	{
		parent::__construct();
		$SES_PREFIX = $this->config->item('SESSION_PREFIX');
		$SES_USER_PREFIX = $this->config->item('SESSION_PREFIX_USER');
		$this->login_data = $this->session->userdata($SES_PREFIX . 'login_data');
		$this->user_data = $this->session->userdata($SES_USER_PREFIX . 'user_data');
		//print_r($this->user_data);die;
		if (empty($this->login_data) || empty($this->user_data)) {
			redirect('/');
		} 
		$this->common_model->setSiteConfig();
		$this->WEBSITE_NAME = $this->config->item('WEBSITE_NAME');
		$this->WEBSITE_LOGO = $this->config->item('WEBSITE_LOGO');

		$this->NAME = $this->login_data->name;
		$this->TODATE = date("Y-m-d h:m:i");
		$this->LOGINID = $this->login_data->id;
		$this->LOGINROLEID = $this->login_data->role_id;
		$this->ROLEID = $this->login_data->role_id;

		$this->p_completed = $this->user_data->p_completed;		// user profile is completed value is 1

		$this->premissionModule = $this->common_model->modulePermission();
	}

	protected function layout($page = '', $data = array())
	{
		// if profile is incompleted or website configration is incompleted
		if ($this->p_completed == 0) {
			//$this->incompleteDetailsRedirectModule($page);
		}
		// end        

		$login_data = $this->login_data;
		//print_r($login_data); die;
		$data['BASE_URL'] = base_url();
		$data['LOGIN_DATA'] = $login_data;
		$data['MODULE_LIST'] = $this->common_model->getModules('1');
		//$data['MODULE_PERMISSION']=$this->premissionModule;

		$header_start = $this->load->view('includes/header', $data, TRUE);

		$sidebar = $this->load->view('includes/sidebar', $data, TRUE);

		$top_sidebar = $this->load->view('includes/top_sidebar', $data, TRUE);

		$right_sidebar = $this->load->view('includes/right_sidebar', $data, TRUE);

		$jslinks = $this->load->view('includes/jslinks', $data, TRUE);

		$js_table = $this->load->view('includes/js_table', $data, TRUE);

		$footer = $this->load->view('includes/footer', $data, TRUE);

		$data['header'] = $header_start . $top_sidebar . $right_sidebar . $sidebar;
		$data['footer'] = $jslinks . $js_table . $footer;
		$this->load->view($page, $data); 
		unsetFlashMsg('success_message');
	}

	protected function incompleteDetailsRedirectModule($page)
	{
		$PROFILECOMPLETED = $this->p_completed;

		if ($PROFILECOMPLETED == '0' && $page != 'profile' && $page != 'admin_profile' && $page != 'user_profile' && $page != 'sub_user_profile') {
			setFlashMsg('success_message', "Please complete your profile before using our services.", 'alert-warning');
			redirect('user/user_profile');
			die();
		}
		return;
	}
}	
	
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
