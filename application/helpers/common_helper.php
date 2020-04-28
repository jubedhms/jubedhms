<?php
	$CI =& get_instance();
	$tbl_prefix="";
	
	function tblprefix($table=""){
		global $CI,$tbl_prefix;
		if($table!=""){
			return $tbl_prefix.$table;
		}
		return "";
	}
	
	// for check url is authorized from home App or not
	function check_url_permission(){
		$response = array();
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')?"https://":"http://"; 
		//$url="http://";   // for SSL Certificate not verified by third party then https create issues
		
		// for run by developer on localhost- not check any condition
		if($_SERVER['HTTP_HOST']=='localhost'){
			return;
		}
		// end
		
		$explode=explode('.',$_SERVER['HTTP_HOST']);
		if($explode){
			$company_name=$explode[0];
			$app= $explode[1];
			
			// for not open URL direct
			if($app=='com' && $explode[2]==''){
				$link=$url.$_SERVER['HTTP_HOST'];
				redirect($link);
				die();
			}
			// end
			
			$domain_name= $explode[2].'.'.$explode[3];
			if($domain_name!='.'){
				$link = $url.$domain_name."/home/check_url";
				$fields = array(
					"company_name" => $company_name,
					"app_name" => $app,
				);
				$result = callAPI("POST", $link, $fields); 
				$data = json_decode($result, TRUE);
				if($data['status']=='1'){
				   return;  
				} 
			}
		}
		
		redirect($url.$domain_name);
		die();
	}
	// end
	
	function generateRandomString($length = 10) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@&#*', ceil($length/strlen($x)) )),1,$length);
	}
	
	function setSession($variable='',$values=''){
		global $CI;
		$PREFIX=$CI->config->item('SESSION_PREFIX'); 
		if($variable!="" && $values!=""){
			$CI->session->set_userdata($PREFIX.$variable, $values);
		}
		else if(is_array($variable) && count($variable)>0){
			foreach($variable as $key=>$dataval){
				if($key!="" ){
					$CI->session->set_userdata($PREFIX.$key,$dataval);
				}
			}
		}
	}

	function getSession($varialbe=''){
		global $CI;
		if($varialbe!=''){
			$PREFIX=$CI->config->item('SESSION_PREFIX');
			if($CI->session->has_userdata($PREFIX.$varialbe)){		
				return $CI->session->userdata($PREFIX.$varialbe);
			}
			else{ 
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	function unset_Session($varialbe=''){
		global $CI;
		if($varialbe!=''){
			$PREFIX=$CI->config->item('SESSION_PREFIX');
			$CI->session->unset_userdata($PREFIX.$varialbe);
		}
		
	}
	function setSession_user($variable='',$values=''){
		global $CI;
		$PREFIX=$CI->config->item('SESSION_PREFIX_USER');
		if($variable!="" && $values!=""){
			$CI->session->set_userdata($PREFIX.$variable, $values);
		}
		else if(is_array($variable) && count($variable)>0){
			foreach($variable as $key=>$dataval){
				if($key!="" ){
					$CI->session->set_userdata($PREFIX.$key,$dataval);
				}
			}
		}
	}
	function getSession_user($varialbe=''){
		global $CI;
		if($varialbe!=''){
			$PREFIX=$CI->config->item('SESSION_PREFIX_USER');
			if($CI->session->has_userdata($PREFIX.$varialbe)){		
				return $CI->session->userdata($PREFIX.$varialbe);
			}
			else{ 
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}

	function unset_Session_user($varialbe=''){
		global $CI;
		if($varialbe!=''){
			$PREFIX=$CI->config->item('SESSION_PREFIX_USER');
			$CI->session->unset_userdata($PREFIX.$varialbe);
		}
		
	}
	function setFlashMsg($variable='',$values='',$class='',$only_text=0)
	{
		global $CI;
		$message="";
		if($variable!="" && $values!=""){
			if($class=="text-success"){
			$message='<div id="alert_msg" class="col-xs-12 p-8 text-center text-success alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="text-danger"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center text-danger alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="text-warning"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center text-warning alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="text-info"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center text-info alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="text-black"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center text-black alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="text-white"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center text-white alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="alert-success"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center alert alert-success alert-dismissible alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="alert-danger"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center alert alert-danger alert-dismissible alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="alert-warning"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center alert alert-warning alert-dismissible alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($class=="alert-info"){
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center alert alert-info alert-dismissible alert_msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			else if($only_text==1){
				$message=$values;
			}
			else{
				$message='<div id="alert_msg" class="col-xs-12 p-8 text-center alert-dismissible alert_msg'. $class.'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$values.'</div>';
			}
			$CI->session->set_flashdata($variable, $message);
		}
		
		
	}

	function getFlashMsg($variable='')
	{
		global $CI;
		if($variable!=""){
			if($CI->session->flashdata(trim($variable))){
				echo $CI->session->flashdata(trim($variable));
			}
		}
	}
	
	function unsetFlashMsg($variable='')
    {
        global $CI;
        if ($variable != "") {
            $CI->session->set_flashdata($variable, '');
        }
    }

	function full_url()
	{
	    global $CI;
	    $url = $CI->config->site_url($CI->uri->uri_string());
	    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
	}


	function replaceEmpty($variable='',$default='')
	{
		global $CI;
		$val='';
		if($variable!=''){
			if(isset($_REQUEST[$variable])){
				if(!is_array($_REQUEST[$variable])){
					$val=trim($_REQUEST[$variable]);
					$val=htmlentities($val);
				}
				else{
					$valArr=$_REQUEST[$variable];
					if(count($valArr)>0){
						foreach($valArr as $key=>$valArr1){
							if(!is_array($valArr1)){
								$val[$key]=htmlentities(trim($valArr1));
							}
							$val[$key]=$valArr1;
						}
					}
				}
			}
			else{
				$val=$default;
			}
		}
		return $val;
		
	}

	function singleAction($action='active',$action_id_field='',$action_id_field_val='',$message=''){
		global $CI;
		 $url = $CI->config->site_url($CI->uri->uri_string());
		 $callBackUrl=full_url();
		 $action_id_field=($action_id_field=='')?'ID':$action_id_field;
		$actionVal="'".$action."','$action_id_field','$action_id_field_val','".base64_encode($url)."','".base64_encode($callBackUrl)."','".base64_encode($message)."'";
		return $actionVal;

	}

	

	function uploadAllFile($fileName='',$dest=''){
	    global $CI;

	        $config['upload_path']          =  $dest;
	        $config['allowed_types'] = '*';
		    //$config['allowed_types']        = 'gif|jpg|png|ico';
		    //$config['encrypt_name'] = TRUE;
		    $img_name=$_FILES[$fileName]['name'];
			$img_name = (strlen($img_name) > 8) ? substr($img_name, -8): $img_name;	 // for trim image name
			$new_name = date('ymdhhis').'_'.$img_name;
			
		    //$new_name = time().'_'.$_FILES[$fileName]['name'];
	        $config['file_name'] = $new_name;
		    $CI->load->library('upload', $config);
		    $CI->upload->initialize($config);
			
			if (!is_dir( $config['upload_path'])) {
		        mkdir( $config['upload_path'], 0777, TRUE);
		    }
		    if ($CI->upload->do_upload($fileName))
		    {
		      $data = array('upload_data' => $CI->upload->data());
		        return  $data ;
		    }
		    else{ //echo "Here".$CI->upload->display_errors(); die;
		        return  false;
		    }
		        
	}

function uploadImg($imgName='',$dest=''){
	    global $CI;
		$config['upload_path'] =  $dest; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
		//$config['encrypt_name'] = TRUE;
		$img_name=$_FILES[$imgName]['name'];
		$img_name = (strlen($img_name) > 8) ? substr($img_name, -8): $img_name; // for trim image name
	    $new_name = date('ymdhhis').'_'.$img_name;
		
		//$new_name = time().'_'.$_FILES[$imgName]['name'];
		$config['file_name'] = $new_name;

		$CI->load->library('upload', $config);
		$CI->upload->initialize($config);
		
		if (!is_dir( $config['upload_path'])) {
		   mkdir( $config['upload_path'], 0777, TRUE);
		}
	
		if ($CI->upload->do_upload($imgName)){           
			$target_file=$dest.$new_name;
			$path_parts = pathinfo($target_file);
			$extension=$path_parts['extension'];
			$size = getimagesize($target_file);
			
			//determine dimensions
			$width = $size[0];
			$height = $size[1];

		if($width>=900 && $height>=900){
		//determine what the file extension of the source
		//image is

		switch($extension){
				//its a gif
				case 'gif': case 'GIF':
				//create a gif from the source
				$sourceImage = imagecreatefromgif($target_file);
				break;
				case 'jpg': case 'JPG': case 'jpeg':
				//create a jpg from the source
				$sourceImage = imagecreatefromjpeg($target_file);
				break;
				case 'png': case 'PNG':
				//create a png from the source
				$sourceImage = imagecreatefrompng($target_file);
				break;
		}

    	// define new width / height
    	$percentage = 20;
    
    	// define new width / height
    	$newWidth = $width / 100 * $percentage;
    	$newHeight = $height / 100 * $percentage;
    
    	// create a new image
    	$destinationImage = imagecreatetruecolor($newWidth, $newHeight);
    
    	// copy resampled
    	imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    	$dest=$dest.$new_name;
    	imagejpeg($destinationImage,$dest,100);
    	}
    	else{
    	$destinationImage=$target_file; 
    	}
    	if ($extension == "jpg" || $extension == "jpeg"){
    	correctImageOrientation($destinationImage);
    	}
    	$data = array('upload_data' => $CI->upload->data());
    
    	return  $data ;
    	}else{
    	 $error = array('error' => $CI->upload->display_errors());
    	 print_r($error);die;
    	return  false;
    	} 
}

function correctImageOrientation($params){
	if (!is_array($params) || empty($params)) return FALSE;
		
		$filepath = $params['filepath'];
		$exif = @exif_read_data($filepath);
		
		if (empty($exif['Orientation'])) return FALSE;
		
		$CI =& get_instance();
		$CI->load->library('image_lib');
		
		$config['image_library'] = 'gd2';
		$config['source_image']	= $filepath;
		
		$oris = array();
		
		switch($exif['Orientation'])
		{
		        case 1: // no need to perform any changes
		        break;
		
		        case 2: // horizontal flip
				$oris[] = 'hor';
		        break;
		                                
		        case 3: // 180 rotate left
		        	$oris[] = '180';
		        break;
		                    
		        case 4: // vertical flip
		        	$oris[] = 'ver';
		        break;
		                
		        case 5: // vertical flip + 90 rotate right
		        	$oris[] = 'ver';
				$oris[] = '270';
		        break;
		                
		        case 6: // 90 rotate right
		        	$oris[] = '270';
		        break;
		                
		        case 7: // horizontal flip + 90 rotate right
		        	$oris[] = 'hor';
				$oris[] = '270';
		        break;
		                
		        case 8: // 90 rotate left
		        	$oris[] = '90';
		        break;
				
			default: break;
		}
		
		foreach ($oris as $ori) {
			$config['rotation_angle'] = $ori;
			$CI->image_lib->initialize($config); 
			$CI->image_lib->rotate();
		}
	}


	function uploadResizeImg($imgName='',$dest='',$tumb_path='',$thumb_size=array()){
	    global $CI;
	    $config['upload_path'] = $dest;//print_r($thumb_size); die;
		$config['allowed_types'] = 'gif|jpg|png';
		$img_name=$_FILES[$imgName]['name'];
			$img_name = (strlen($img_name) > 8) ? substr($img_name, -8): $img_name;	 // for trim image name
		$new_name = date('ymdhhis').'_'.$img_name;
			
		//$new_name = time().'_'.$_FILES[$imgName]['name'];
	    $config['file_name'] = $new_name;
		$config['overwrite'] = false;
		if (!is_dir( $config['upload_path'])) {
		        mkdir( $config['upload_path'], 0777, TRUE);
		}
		if (!is_dir($tumb_path)) {
		        mkdir($tumb_path, 0777, TRUE);
		}

		 $CI->load->library('upload', $config);
		 if ( $CI->upload->do_upload($imgName))
         {
         	$data =  $CI->upload->data(); //print_r($data); die;
         	 $dataVal = array('upload_data' => $data);
         	 $fileExt=pathinfo($data['file_name'],PATHINFO_EXTENSION);
         	 $fileName=pathinfo($data['file_name'],PATHINFO_FILENAME);
			if(count($thumb_size)>0){
				$CI->load->library('image_lib');
				foreach($thumb_size as $valsize){ 
					$config1['image_library'] = 'gd2';
					$config1['source_image'] = $data['full_path'];
					$config1['new_image'] = $tumb_path;		
					$config1['create_thumb'] = TRUE;
					$config1['thumb_marker'] = '_'.$valsize[0].'X'.$valsize[1];	
					$config1['width']         = $valsize[0];
					$config1['height']       = $valsize[1];
					//print_r($config1);
					
					$CI->image_lib->initialize($config1);
					if ( ! $CI->image_lib->resize())
					{
					        echo $CI->image_lib->display_errors();
					}
					$dataVal['thumbImage'][]=$fileName.$config1['thumb_marker'].'.'.$fileExt;
					
				}
				$CI->image_lib->clear();
			}
			//print_r($dataVal); die;
			return $dataVal;
         }
		  return false;      
	}

	function generateSlag($text='')
	{
	    global $CI;
	    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	    $text = preg_replace('~[^-\w]+~', '', $text);
	    $text = trim($text, '-');
	    $text = preg_replace('~-+~', '-', $text);
	    $text = strtolower($text);
	    return $text;
	}

	function getTemplateData($id='')
        {		
            global $CI;
                    $CI->db->select("*");
                    $CI->db->from(tblprefix("email_template"));
                    $CI->db->where('ID',$id);
                    $result = $CI->db->get()->row();
                    return $result;
        }

	function send_mail($from='',$to='',$subject='',$message='',$from_name='',$cc='',$files=''){
		global $CI;
 		//$fp = fsockopen("adminpanel.hanhphuchospital.com", 80, $errno, $errstr, 30);

		if($to!='' && $message!=''){
			$from=($from!="")?$from:$CI->config->item('SMTPEMAIL_EMAIL');;
			$from_name=($from_name!="")?$from_name:$CI->config->item('WEBSITE_NAME');
			$subject=($subject!="")?$subject:"";

			//$config['useragent']    = $system_name;
			//$config['mailpath']     = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
			$config['protocol']     = "mail"; //use 'mail' instead of 'sendmail or smtp'
			$config['smtp_host'] = $CI->config->item('SMTPEMAIL_HOST');
			$config['smtp_port'] = $CI->config->item('SMTPEMAIL_PORT');
			$config['smtp_user'] = $CI->config->item('SMTPEMAIL_USERNAME');
			$config['smtp_pass'] = $CI->config->item('SMTPEMAIL_PASS');
			$config['smtp_crypto']  = 'ssl';
			$config['smtp_timeout'] = "";
			$config['mailtype']     = "html";
			$config['charset']      = "utf-8";
			$config['newline']      = "\r\n";
			$config['wordwrap']     = TRUE;
			$config['validate']     = FALSE;
			//print_r($config); die;
			$CI->email->initialize($config);			
			$CI->email->from($from,$from_name); // change it to yours
			$CI->email->to($to);

			if(is_array($cc) && count($cc)>0){
				foreach($cc as $ccmail){ if($ccmail!='' && filter_var($ccmail, FILTER_VALIDATE_EMAIL)){
						$CI->email->cc($ccmail);
					}
				}
			}
			elseif($cc!='' && filter_var($cc, FILTER_VALIDATE_EMAIL)){
				$CI->email->cc($cc);
			}


			$CI->email->subject($subject);
			$CI->email->message($message);

			if(is_array($files) && count($files)>0){
				foreach($files as $filesPath){ if($filesPath!='' && file_exists($filesPath)){
						$CI->email->attach($filesPath);
					}
				}
			}
			elseif($files!=''){
				$CI->email->attach($files);
			}

			//$files="http://skyweblab.com/codeigniter-setup/assets/a/images/macbook.png";

			if($CI->email->send())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function send_sms($contact_number,$message){
		$url = 'http://sms3.vht.com.vn/ccsms/Sms/SMSService.svc/ccsms/json';
		$fields3 =[
                    'submission'=>[
						'api_key' => "hanhphucapi",
						'api_secret' => "0JQWjKx7TOWgEuz",
						"sms"=> [[
							 "id"=> MD5($contact_number),
							 "brandname"=>"HanhPhuc",
							 "text"=> $message,
							 "to"=> $contact_number
							 ]] 
                    ]    
                 ];

		$result = callAPI("JSON", $url, $fields3);	
        return $result;
	}
	
	function getfileSize($path='')
	{
		$size='';
		if (file_exists($path)){
            $size= filesize($path);
            if($size>0){
            	if($size>1000000000){
            		$size=(float)($size/1000000000).' GB ';
            	}
            	else if($size>1000000){
            		$size=number_format((float)($size/1000000),3). ' MB ';
            	}
            	else if($size>1024){
            		$size=number_format((float)($size/1024),2). ' KB ';
            	}
            	else{
            		$size =$size.' Bytes';
            	}
            }
        }
        return $size;
	}


	function getFieldVal($varialble='',$details='',$val=0)
	{
		if($varialble!="" && $details && $val!=1){
			$varible_val=(isset($details->$varialble))?$details->$varialble:'';
			return set_value($varialble, $varible_val);
		}
		else if($varialble!="" && $details!="" && $val==1){ 
			return set_value($varialble,$details);
		}
		else if($varialble!=""){
			return set_value($varialble);
		}
	}


function checkModulePermission($module_id=0,$event_name=''){
		global $CI;
		$MODULE_PERMISSION=$CI->config->item('MODULE_PERMISSION');
		//echo "<pre>";print_r($MODULE_PERMISSION); die;	
		if($module_id>0 && $event_name!=''){ 
			if(is_array($MODULE_PERMISSION) && isset($MODULE_PERMISSION[$module_id]) && ($MODULE_PERMISSION[$module_id]->$event_name==1)){
				//echo 1; die;
				return true;
			}
		}else if($module_id>0 && $event_name==''){
			if(is_array($MODULE_PERMISSION) && isset($MODULE_PERMISSION[$module_id])){ 
			//echo "1"; die;
			return true;
			}	
		}
		return false;
	}

	function DateTime($date='',$format="Y-m-d")
	{
		if($date!='0000-00-00 00:00:00' && $date!='0000-00-00'){
		$date_time=strtotime($date);
		return date($format,$date_time);
		}
	}
	
	function datepikerDateTime($date='',$format="Y-m-d",$privious_format="d-m-Y"){
		if($date!='0000-00-00 00:00:00' && $date!='0000-00-00'){
			$date = DateTime::createFromFormat($privious_format,$date);
			return $date->format($format);
		}
	}
	
	function getTimeInterval( $start = '00:00',$end = '23:59', $intervalTime = 30 ) {

	   $output = '';
	   $interval='+'.$intervalTime.' minutes';
	   $current = strtotime( $start );
	   $end = strtotime( $end );

	   while( $current <= $end ) {
	       $time = date( 'H:i', $current );
	       $output []=date( 'h:i A', $current );
	       $current = strtotime( $interval, $current );
	   }

	   return $output;
	}
	function timeFrm($time='H:i'){
		return date( 'H.i', strtotime( $time ));
	}
  
    function remove_uploaded_file($oldfile_name='',$dest='')
	{		
		$paths =$oldfile_name;
		if($oldfile_name!="" && file_exists($paths)){
			$result=unlink($paths);
			//print_r($result);
		}
		return true;
	}
	
	/////////////////////////Start API Connection////////////////////////////////
function callAPI($method, $url, array $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
		 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');	
		 //curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
	case "JSON":
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		 if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));			 					
         break;
	case "POST_XML":
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');	
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Accept: application/xml','Content-Type:application/xml'));
		if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	 					
        break;
	case "PUT_XML":
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');	
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Accept: application/xml','Content-Type:application/xml'));
		if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	 					
        break;		
      default:
         if ($data)
          $url = sprintf('%s?%s', $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   //curl_setopt($curl, CURLOPT_TIMEOUT, 60);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){
		setFlashMsg('success_message','<strong>Invalid credential!</strong> Connection Failure.','alert-warning');
		$result=json_encode(array('status'=>'no'));
	}
   curl_close($curl);
   return $result;
}
	

function StartSoapClient($wsdl='',$location=''){
	if($wsdl!=''){
		try {
			$mode = array (
				'soap_version' => 'SOAP_1_1',  // use soap 1.1 client
				'trace' => true,
				'exceptions' => true,
				'cache_wsdl'=>WSDL_CACHE_NONE,
				'encoding'=>'UTF-8',
				'cache_wsdl' => 0
			);

			$client = new SoapClient($wsdl, $mode);
			if($location!=''){
				$client->__setLocation($location);
			}
			
			$client->function=$client->__getFunctions(); // for getting function name
			return $client;
		}catch(Exception $e) {
			return 'Message: ' .$e->getMessage();
		  }		
	}else{
		return "Message: WSDL file path is empty.";
	}
	
}

///////////////////////////////End API Connection/////////////////////////////

	// Encrypt Function
	function genrate_api_secret_key($data){
		$ID=$data['ID'];                    									//Id acecpt 
		$date=explode('-', $data['date']); 						// explode of date 
		$year=$date[0];                    									// all index address of 
		$month=$date[1];
		$day=$date[2];
		$key=randomNum(3).$month.$year.randomNum(2).$day.randomNum(1).$ID; // make key with random function 
		$encrypt=strtr(base64_encode($key), '+/=', '._-');  //base64_encode(serialize($key));                           // all base encrypt data 
		return $encrypt;
	}
	// end

	// for genrate random number
	function randomNum($length) {
        $min = 1 . str_repeat(0, $length-1);
        $max = str_repeat(9, $length);
        return mt_rand($min, $max);
    }
	// end

	
// Decrypt Function
function id_decrypt($key){
	$key=strtr($key, '._-', '+/=');
    if (IsBase64($key)===true) {
        $data = base64_decode($key);
        $ID = substr($data, 14);      // after 14 digit find value
        $year = substr($data, 5, 4);
        $month = substr($data, 3, 2);
        $day = substr($data, 11, 2);
        $date = $year . '-' . $month . '-' . $day; //format are create date of array value
        $data = array('ID' => $ID, 'date' => $date);
        return $data;
    }
}
	// end


    // check base64 value is vaild or not
     function IsBase64($data) {
        $decoded_data = base64_decode($data, true);
        $encoded_data = base64_encode($decoded_data);
        if ($encoded_data != $data) return false;
        else if (!ctype_print($decoded_data)) return false;

        return true;
    }
	//end


	// generate Hash ShaKey
	function generateHashShaKey($password = '') {
		if($password!=''){
			$salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN'; // random string
			$hash1_sha1_double = sha1(md5($salt.$password)); // sha1 hash with salt & md5 #6
			return $hash1_sha1_double;
		}
}	
	// end