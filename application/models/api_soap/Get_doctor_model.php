<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_doctor_model extends CI_Model {
    public $MESSAGE;
    public function __construct(){
        parent::__construct();
        $this->MESSAGE= $this->config->item('MESSAGE');
        $this->main_table="doctor";
    }

    public function add_data($response){
        //echo "<pre>";print_r($response);	die;
        //extract($_POST);
        $doctor_id='';
        $total_added=0;
        $total_updated=0;
        $current_date=date("Y-m-d H:i:s");
        
        foreach($response as $key=>$value){  
            $this->db->select("ID,mcr");
            $this->db->from($this->main_table);
            $this->db->where("mcr",$value['MCR']);
            $result=$this->db->get()->row();
            if($result){
                if($this->edit_data($result->ID,$value)){
                    $total_updated=$total_updated+1;
                }
            }else{
				$name=($value['Name'] && $value['Name']['FirstName']!='')?$value['Name']['FirstName']:'';
				$name=($value['Name'] && $value['Name']['MiddleName']!='')?$name." ".$value['Name']['MiddleName']:'';
				$name=($value['Name'] && $value['Name']['LastName']!='')?$name." ".$value['Name']['LastName']:'';
				
                $mainData=[
                    'mcr'=> $value['MCR'],
                    'title'=> ($value['Name']['Title'])?$value['Name']['Title']:'',
                    //'first_name'=> $value['Name']['FirstName'],
                    //'middle_name'=> ($value['Name']['MiddleName'])?$value['Name']['MiddleName']:'',
                    //'last_name'=> ($value['Name']['LastName'])?$value['Name']['LastName']:'',
					'name'=> $name,
                    'grade'=> $value['Grade'],
                    'dob'=> ($value['DOB'])?(date('Y-m-d',strtotime($value['DOB']))):'',
                    'gender' => (($value['Gender']['Code']=='M')?'1':'2'),
                    'contact_number'=> $value['Contact'],
                    'image'=> ($value['Image']['Base64ImageData'])?$value['Image']['Base64ImageData']:'',
					'hospital_location_id'=>'1',
                    'maker_id'=>'1',
                    'maker_date'=>$current_date,
                    'updater_id'=>'1',
                    'updater_date'=>$current_date
                ];
                
                $this->db->insert($this->main_table, $mainData);
                $doctor_id=$this->db->insert_id();
                
                if($doctor_id!='')
                {
                    $total_added=$total_added+1;

                    $addressData=[
                        'doctor_id'=> $doctor_id,
                        'address_type'=> (($value['Address']['AddressType']=='HOME')?'1':'2'),
                        'address_line1'=>$value['Address']['Address1'],
                        'address_line2'=>($value['Address']['Address2'])?$value['Address']['Address2']:'',
                        'address_line3'=>($value['Address']['Address3'])?$value['Address']['Address3']:'',
                        'address_line4'=>($value['Address']['Address4'])?$value['Address']['Address4']:'',
                        'address_line5'=>($value['Address']['Address5'])?$value['Address']['Address5']:'',
                        'country_code'=> $value['Nationality']['Code'],
                    ];
                    
                    $this->db->insert('doctor_address', $addressData);
                
                    if(isset($value['Document'])){
                        $documents=$value['Document'];
                        if($documents === array_values($documents)){
                            foreach($documents as $document_value){ 
                                $documentData=array(
                                    'doctor_id'=> $doctor_id,
                                    'code' => $document_value['Code'],
                                    'description' => $document_value['Description'],
                                    'value' => $document_value['Value'],
                                    'expiry_date' => ($document_value['ExpiryDate'])?$document_value['ExpiryDate']:'',
                                    'maker_id'=>'1',
                                    'maker_date'=>$current_date,
                                    'updater_id'=>'1',
                                    'updater_date'=>$current_date
                                );
                                
                             $this->db->insert('doctor_documents', $documentData);
                            }
                        }else{
                            $documentData=array(
                                'doctor_id'=> $doctor_id,
                                'code' => $documents['Code'],
                                'description' => $documents['Description'],
                                'value' => $documents['Value'],
                                'expiry_date' => ($documents['ExpiryDate'])?$documents['ExpiryDate']:'',
                                'maker_id'=>'1',
                                'maker_date'=>$current_date,
                                'updater_id'=>'1',
                                'updater_date'=>$current_date
                            );
                            
                            $this->db->insert('doctor_documents', $documentData);
                        }
                        
                    }

                    if(isset($value['Specialty'])){
                        $specialties=$value['Specialty'];
                        if($specialties === array_values($specialties)){
                            foreach($specialties as $specialty_value){ 
                                if($specialty_value['Primary']=='YES'){
                                    $this->db->update($this->main_table,array("primary_specialty_code"=>$specialty_value['Code']),array('primary_specialty_code'=> '','ID'=> $doctor_id)); 
                                }   
                                
                                    $dept_code=$specialty_value['Code'];
                                    $this->db->set('specialty_code', "IF(specialty_code != '', CONCAT(specialty_code,',','".$dept_code."'),'".$dept_code."')", FALSE);
                                    $this->db->where('ID', $doctor_id); 
                                    $this->db->update($this->main_table);
                                }
                        }else{
                            if($specialties['Primary']=='YES'){
                                $this->db->update($this->main_table,array("primary_specialty_code"=>$specialties['Code']),array('ID'=> $doctor_id)); 
                            }

                            $this->db->update($this->main_table,array("specialty_code"=>$specialties['Code']),array('ID'=> $doctor_id)); 
                        }
                    }
                }    
            }
        }

        $return_response=["total_added"=>$total_added, "total_updated"=>$total_updated];
        return $return_response;
    }

    public function edit_data($doctor_id,$value){
        $current_date=date("Y-m-d H:i:s");
        if($doctor_id!='' && $value){
			$name=($value['Name'] && $value['Name']['FirstName']!='')?$value['Name']['FirstName']:'';
			$name=($value['Name'] && $value['Name']['MiddleName']!='')?$name." ".$value['Name']['MiddleName']:'';
			$name=($value['Name'] && $value['Name']['LastName']!='')?$name." ".$value['Name']['LastName']:'';
				
			$mainData=[
				'title'=> ($value['Name']['Title'])?$value['Name']['Title']:'',
				//'first_name'=> $value['Name']['FirstName'],
				//'middle_name'=> ($value['Name']['MiddleName'])?$value['Name']['MiddleName']:'',
				//'last_name'=> ($value['Name']['LastName'])?$value['Name']['LastName']:'',
				'name'=> $name,
				'grade'=> $value['Grade'],
				'dob'=> ($value['DOB'])?(date('Y-m-d',strtotime($value['DOB']))):'',
				'gender' => (($value['Gender']['Code']=='M')?'1':'2'),
				'contact_number'=> $value['Contact'],
				'image'=> ($value['Image']['Base64ImageData'])?$value['Image']['Base64ImageData']:'',
				'hospital_location_id'=>'1',
				'updater_id'=>'1',
				'updater_date'=>$current_date
			];
			
			$this->db->update($this->main_table, $mainData, array('ID'=> $doctor_id));
			
			$addressData=[
				'address_type'=> (($value['Address']['AddressType']=='HOME')?'1':'2'),
				'address_line1'=>$value['Address']['Address1'],
				'address_line2'=>($value['Address']['Address2'])?$value['Address']['Address2']:'',
				'address_line3'=>($value['Address']['Address3'])?$value['Address']['Address3']:'',
				'address_line4'=>($value['Address']['Address4'])?$value['Address']['Address4']:'',
				'address_line5'=>($value['Address']['Address5'])?$value['Address']['Address5']:'',
				'country_code'=> $value['Nationality']['Code'],
			];
			
			$this->db->update('doctor_address', $addressData, array('doctor_id'=> $doctor_id));
			
				if(isset($value['Document'])){
											
					$this->db->where("doctor_id", $doctor_id);
					$this->db->delete('doctor_documents');

					$documents=$value['Document'];
					if($documents === array_values($documents)){
						foreach($documents as $document_value){ 
							$documentData=array(
								'code' => $document_value['Code'],
								'description' => $document_value['Description'],
								'value' => $document_value['Value'],
								'expiry_date' => ($document_value['ExpiryDate'])?$document_value['ExpiryDate']:'',
								'maker_id'=>'1',
								'maker_date'=>$current_date,
								'updater_id'=>'1',
								'updater_date'=>$current_date
							);
							
						$this->db->update('doctor_documents', $documentData, array('doctor_id'=> $doctor_id));
						}
					}else{
						$documentData=array(
							'doctor_id'=> $doctor_id,
							'code' => $documents['Code'],
							'description' => $documents['Description'],
							'value' => $documents['Value'],
							'expiry_date' => ($documents['ExpiryDate'])?$documents['ExpiryDate']:'',
							'maker_id'=>'1',
							'maker_date'=>$current_date,
							'updater_id'=>'1',
							'updater_date'=>$current_date
						);
						
						$this->db->update('doctor_documents', $documentData, array('doctor_id'=> $doctor_id));
					}
					
				}

				if(isset($value['Specialty'])){
					$specialties=$value['Specialty'];
					if($specialties === array_values($specialties)){
						foreach($specialties as $specialty_value){ 
							if($specialty_value['Primary']=='YES'){
								$this->db->update($this->main_table,array("primary_specialty_code"=>$specialty_value['Code']),array('primary_specialty_code'=> '','ID'=> $doctor_id)); 
							}   
								$dept_code=$specialty_value['Code'];
								$this->db->set('specialty_code', "IF(specialty_code != '', CONCAT(specialty_code,',','".$dept_code."'),'".$dept_code."')", FALSE);
								$this->db->where('ID', $doctor_id); 
								$this->db->update($this->main_table); 
							}
					}else{
						if($specialties['Primary']=='YES'){
							$this->db->update($this->main_table,array("primary_specialty_code"=>$specialties['Code']),array('ID'=> $doctor_id)); 
						}

						$this->db->update($this->main_table,array("specialty_code"=>$specialties['Code']),array('ID'=> $doctor_id)); 
					}
				}
            return true;
        }else{
            return false;
        }
    }


}