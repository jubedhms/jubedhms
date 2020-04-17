<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="offer";
    }

    public function getData($is_active=''){
        $this->db->select("O.*");
        $this->db->from($this->main_table." as O");
        if($is_active==1)$this->db->where("O.show_status",1);
        $this->db->where("O.is_deleted",0);
        $this->db->order_by('O.ID','DESC');
        $result=$this->db->get()->result();
        return $result;
    }

    public function add_offer(){
        extract($_POST);

        if($this->checkExist($name)==true){
            $LOGINID=$this->LOGINID;
            $date=date("Y-m-d H:i:s");
            $start_date=datepikerDateTime($start_date,"Y-m-d");
			$end_date=datepikerDateTime($end_date,"Y-m-d");
			$offer_image='test.jpg';// need to get value from form
			
			//print_r($_FILES['offer_image']['name']);
            //echo "<pre>"; print_r($_POST); die;

            $insertData=array('name'=>$name,
                'description'=>$description,
				'offer_image'=>$offer_image,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'quantity'=>$quantity,
                'customer_group'=>$customer_group,
                'maker_id'=>$LOGINID,
                'maker_date'=>$date,
                'updater_id'=>$LOGINID,
                'updater_date'=>$date
            );

            $this->db->insert($this->main_table, $insertData);
            $offer_id=$this->db->insert_id();
            $offer_image=$this->upload_image( $offer_id, $file_name='offer_image');

            setFlashMsg('success_message',"New Offer has been created successfully.",'alert-success');
            //$userData=array('ID'=>$user_id,'date'=>date("Y-m-d",strtotime($date)));
            return $offer_id;
        }
    }

    public function edit_offer(){
        extract($_POST); 
         $ID=(is_numeric($ID))?md5($ID):$ID;//die();
        $LOGINID=$this->LOGINID;
        $LOGINROLEID=$this->LOGINROLEID;
		$date=date("Y-m-d H:i:s");
  		$start_date=datepikerDateTime($start_date,"Y-m-d");
		$end_date=datepikerDateTime($end_date,"Y-m-d");
		$offer_image='test.jpg';// need to get value from form
		//	'offer_image'=>$offer_image,
        $updateData=array(
            'name'=>$name,
			'customer_group'=>$customer_group,
			'quantity'=>$quantity,
			'start_date'=>$start_date,
			'end_date'=>$end_date,
 			'offer_image'=>$offer_image,
			'description'=>$description,
           'updater_id'=>$LOGINID,
            'updater_date'=>$date
        );

        $this->db->update($this->main_table,$updateData,array('MD5(ID)'=>$ID));
        setFlashMsg('success_message',"New offer has been updated successfully.",'alert-success');
        return true;
    }

    public function loadDataById($ID=''){
        $ID=(is_numeric($ID))?md5($ID):$ID;
        $this->db->select("O.*");
        $this->db->from($this->main_table." as O");
        $this->db->where("MD5(O.ID)",$ID);
        $this->db->where("O.is_deleted",0);
        $result=$this->db->get()->row();
        $NoImage='assets/img/icon/not-available.jpg';
        if($result && $result->image!=''){$result->image=$result->image;}else{$result->image=$NoImage;}
        //echo "<pre>";print_r($result);echo $this->db->last_query();die;
        return $result;
    }

    public function checkExist($name){
        //$ID=($ID!='')?$ID:$_POST['ID'];
        $name=($name!='')?$name:$_POST['name'];

        $this->db->select("count(ID) as total");
        $this->db->from($this->main_table);
        //$this->db->where("is_deleted",0);
        if($name!='')$this->db->where("name",$name);
        $result=$this->db->get()->row();
        //echo $this->db->last_query(); print_r($result);die;
        if($result && $result->total>0){
            if($name!='')setFlashMsg('success_message',"This Offer has been registered already.",'alert-danger');
            return false;
        }
        return true;
    }

    public function upload_image($ID='', $file_name=''){
        if($ID!=''){
            $ID=(is_numeric($ID))?md5($ID):$ID;
            $oldfile_name='';
            $this->db->select("image");
            $this->db->from($this->main_table);
            $this->db->where(array('MD5(ID)'=>$ID));
            $row=$this->db->get()->row();
            if(!$row && !isset($row->image)){
                return false;  
            }
            
            $oldfile_name=$row->image;
            
            
            $file_name =($file_name=='')?$this->input->post('file_name'):$file_name;
            
            $curr_year=date('Y');
            $curr_month=date('m');
            $dest = $this->config->item('ROOT_DATA_DIR')."new-offers-image/".$curr_year."/".$curr_month."/";
            
            $resultData = uploadImg($file_name,$dest);
            if($resultData!==false){
                if($oldfile_name!='')remove_uploaded_file($oldfile_name);
                $newFileName=$dest.$resultData['upload_data']['file_name'];
    
                $updateArray = array("image"=>$newFileName);
                $this->db->where('MD5(ID)',$ID);
                $successData = $this->db->update($this->main_table,$updateArray);
                return $newFileName;
            }else{
                setFlashMsg('success_message',"Some thing went wrong. Please try again later.",'alert-info');
                return false;
            }
        }else{
            setFlashMsg('success_message',"New-offer ID is missing.",'alert-info');
            return false;
        }    
    }
	
    public function delete_offer_data($IDS=array()){
        $IDS=(isset($_POST['IDS']))?$_POST['IDS']:$IDS;
        $updateData=array('is_deleted'=>1);

        // for user main table    
        $this->db->where_in("MD5(ID)", $IDS);
        $this->db->update($this->main_table,$updateData);
        //$this->db->delete($this->main_table);
        //end

        echo "Offer has been deleted successfully.";
        return;
    }


}