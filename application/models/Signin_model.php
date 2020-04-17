<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin_model extends CI_Model {

    public $MESSAGE;
    public function __construct()
    {
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="user";
    }
	
    public function checkLogin($value=''){
        $postedArr = $this->input->post();
        $username = trim($postedArr['user_name']);
        $password = trim($postedArr['password']);
 		$pass_word=generateHashShaKey($password);	
		$remember_me = (isset($postedArr['rememberme']))?trim($postedArr['rememberme']):'';

        if($username != '' || $username != null){

            $this ->db->select("U.ID, U.role_id, U.user_name, CONCAT(U.first_name,' ', U.middle_name,' ', U.last_name) AS name, U.show_status, UD.is_completed ,UD.image");
            $this->db->from($this->main_table." as U");
            $this->db->join("user_documents as UD",'user_id=U.ID','LEFT');
            $this->db->where('user_name',$username);
            $this->db->where('user_password',$pass_word);
            $row= $this->db->get()->row();

            if($row){
                if($row->show_status == '1') {
                    $login_data=(object)array(
                        'id'=>$row->ID,
                        'username'=>$row->user_name,
                        'name'=>$row->name,
                        'role_id'=>$row->role_id,
                    );
                    $this->session->set_userdata('username',$row->user_name);
                    setSession("login_data",$login_data);

                    $user_data=(object)array('p_completed'=>$row->is_completed,
                        'p_pic'=>$row->image
                    );
                    setSession_user("user_data",$user_data);

                    setSession('p_pic',$row->image);

                    $this->UpdateSigninTime($row->ID);

                    if(!empty($remember_me) && $remember_me == 1)
                    {
                        $expire = $this->config->item('remember_me_duration');
                        $cookie = array(
                            'name'   => 'remember_me',
                            'value'  => serialize(array('user_name'=>$row->user_name,'password'=>$user_password)),
                            'expire' =>$expire  // Two weeks
                        );
                        set_cookie($cookie);
                    }
                    else{
                        delete_cookie('remember_me');
                    }
                    return true;
                    redirect('admin/dashboard'); die;
                }
                else{
                    setFlashMsg('success_message',"Your account is currently deactivated. Please contact to customer care for any support.",'alert-success');
                    return false;
                }
            }
            else{
                setFlashMsg('success_message',"Username or Password incorrect",'alert-danger');
                return false;
            }
        }
    }

    public function UpdateSigninTime($user_id=''){
        if($user_id!=''){
            $id=(is_numeric($user_id))?md5($user_id):$user_id;
            $current_date=date('y-m-d h:m:i');
            $this->db->where(array('MD5(ID)'=>$id));
            $this->db->update($this->main_table,array("last_login"=>$current_date));
			return true;
        }
    }

    public function UpdateSignoutTime($user_id=''){
        if($user_id!=''){
            $id=(is_numeric($user_id))?md5($user_id):$user_id;
            $current_date=date('y-m-d h:m:i');
            $this->db->where(array('MD5(ID)'=>$id));
            $this->db->update($this->main_table,array("last_logout"=>$current_date));
			return true;
        }
    }

    public function forgotPassword($value=''){
        $user_name = $this->input->post('user_name');
        $user_email = $this->input->post('user_name');
        $userData = $this->db->get_where($this->main_table, array('user_name' => $user_name))->row();

        if(!empty($userData)){
            if($userData->email_id!=''){
 				/***for email template load from model***/
				$this->load->model('email_template_model');
                $email_template=$this->email_template_model->loadDataById($ID='1', $is_active='1');
                $from = $email_template->sender;
                $email=$userData->email_id;
                $url =base_url('signin/resetPassword?link='.base64_encode(md5($userData->ID).'|'.time()));
                $subject="Forgot Password";
				$message='<div style="text-align:center;padding-bottom:20px;"><h2>Forgot Password</h2></div><p>Hi, We have received a request to reset your signin password.</p><p>To initiate the process, please click the following link: <a target="_blank" style="color:#00b22c;text-decoration:none" href="'.$url.'">[URL]</a></p> <p>If clicking the link above does not work, copy and paste the URL in a new browser window. The URL will expire in 24 hours for security reasons. If you did not make this request, simply ignore this message.</p> ';
							
                $mail_body=str_ireplace('[WEBSITE_LOGO]',base_url('assets/img/logo.png'),$email_template->mail_body);
                $mail_body=str_ireplace('[WEBSITE_NAME]',$this->config->item('WEBSITE_NAME'),$mail_body);
                $mail_body=str_ireplace('[MSG]',$message,$mail_body);
				$mail_body=str_ireplace('[THANK_IMG_SRC]',base_url('assets/img/thanks.png'),$mail_body);
                if($userData->show_status == '1'){
                    
					$to = $email;
                    $message= $mail_body;

                    send_mail($from,$to,$subject,$message);

                    setFlashMsg('success_message',"Password has been sent on your registered email address successfully.",'alert-success');

                    redirect(base_url('signin'));
                }else{
                    setFlashMsg('success_message',"Your account is currently deactivated. Please contact to customer care for any support.",'alert-danger');
                    redirect(base_url('signin'));
                }
            }else{
                setFlashMsg('success_message',"Email address is not available.",'alert-danger');
                redirect(base_url('signin/forgot_password'));
            }
        }else{
            setFlashMsg('success_message',"Username is not available.",'alert-danger');
            redirect(base_url('signin/forgot_password'));
        }

    }

    public function resetPassword($id=''){
        $password=$this->input->post('password');
 		$password=generateHashShaKey($password);	
        $newpwd = array('user_password'=>$password);
        $this->db->where(array('MD5(ID)'=>$id));
        $this->db->update($this->main_table,$newpwd);
		//echo $this->db->last_query();die;

        setFlashMsg('success_message',"Password has been changed successfully.",'alert-success');
        return true;

    }

}
