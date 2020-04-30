<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->helper('excell');
		$this->main_page=base_url('/'.strtolower(get_class($this)));
		$this->heading='Dashboard';
		$this->mode='';
		$this->MODULEID=1;
		$this->MODULEID_APP=2;
		$this->MODULEID_BOOKING=3;
		$this->MODULEID_PATIENT=4;
		$this->MODULEID_REVENUE=7;
	}
	
	public function index(){
		if(!checkModulePermission($this->MODULEID)){ 
			redirect('dashboard/blank_dashboard'); 
			die();
		}
		
        $LOGINROLEID=$this->LOGINROLEID;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		//$this->layout('dashboard/app_performance',$data);
        redirect('dashboard/app_performance','refresh');
	}
	
	public function blank_dashboard(){
		$LOGINROLEID=$this->LOGINROLEID;
		$data['heading']=$this->heading;
		$data['mode']=$this->mode;
		$this->layout('dashboard/dashboard',$data);
	}
	
	public function app_performance(){
		if(!checkModulePermission($this->MODULEID_APP)){ 
			redirect('dashboard'); die;
		}
		
                $LOGINROLEID=$this->LOGINROLEID;
		$data['heading']='App Performance';//$this->heading;
		$data['mode']=$this->mode;
                 $Initialregdate=$this->dashboard_model->getMindate();
                //date difference
                $start=date_create($Initialregdate);
                $current=date_create(date('Y-m-d'));
                $diff=date_diff($start,$current);
                $data['datediff']=$diff->format("%a");
                
                $data['dailyActive']=$this->dashboard_model->getDailyActiveRecord();
                $data['WeeklyActive']=$this->dashboard_model->getWeeklyActiveRecord();
                $data['Last30DaysRecord']=$this->dashboard_model->getLast30DaysRecord();
                $data['TotalInstallation']=$this->dashboard_model->getTotalInstallatiionRecord();
                $weeks=$this->getWeeks(date('m'),date('Y'));
                $dataweek=array();
                $j=0;$w=1;
                foreach ($weeks as $rowweek){
                    $dataweek[$j]['week']='Week'.$w;
                    $dataweek[$j]['weekdataAndroid']=$this->dashboard_model->getWeeklyActiveRecordAndroid($rowweek['start_date'],$rowweek['end_date']);
                    $dataweek[$j]['weekdataIOS']=$this->dashboard_model->getWeeklyActiveRecordIOS($rowweek['start_date'],$rowweek['end_date']);
                    $j++; $w++;
                }
               
                $data['dataweek']=$dataweek;
                
                $months=$this->monthsInCurrentYear();
                //echo date('Y-02-t');die;
                //$m=01;
                //echo date('Y-'.$m.'-01');
                //echo date('Y-'.$m.'-t');die;
                $monthlyInstal=array();
                $k=0; $m=1;
                foreach ($months as $rowmonths){
                    $monthlyInstal[$k]['month']=$rowmonths;
                    $monthlyInstal[$k]['monthdata']=$this->dashboard_model->monthwiseInst(date('Y-'.$m.'-01'),date('Y-'.$m.'-t'));
                    $m++; $k++;
                    
                }
                $data['monthlyInstal']=$monthlyInstal;

               //daily installtion
                // $last30days=date('Y-m-d', strtotime(date('y-m-d') .'-'.'30 days'));die;
                //$l=0; //$m=1;
                //$day=date('d');
                //$d=$day-$totalDayInWeek;
                //$d=$totalDayInWeek;
                //$dailyInstal=array();
                $n=0;$countd=1;
                for ($j=29;$j>=0;$j--){
                    $date=date('Y-m-d', strtotime(date('y-m-d') .'-'.$j.'days'));
                    //echo "<br>";
                    $dailyInstal[$n]['day']=date('d/m/Y', strtotime($date));
                    //$dailyInstal[$n]['date']=date('Y-m-'.$d.'');
                    $dailyInstal[$n]['dailydata']=$this->dashboard_model->dailywiseInst($date);
                    $n++;  $countd++;
                    
                }
               // die;
                //print_r($dailyInstal);die;
                $data['dailyInstal']=$dailyInstal;
                //end daily installtion
                $data['weeks']=$weeks;
                //print_r($monthlyInstal);die;
                //$data['WeekWiseOS']=$this->dashboard_model->getWeekWiseOS();
		$this->layout('dashboard/app_performance',$data);
    }
    
    public function yearly_app_info(){
            
        if(!checkModulePermission($this->MODULEID_BOOKING)){ 
                //redirect('dashboard'); die;
        }
            $year=$this->input->post('year');
            $monthlyInstal=array();
            if($year<=date('Y')){
                $months=$this->monthsInYear($year);
            $k=0; $m=1;
            foreach ($months as $rowmonths){
                $monthlyInstal[$k]['month']=$rowmonths;
                $monthlyInstal[$k]['monthdata']=$this->dashboard_model->monthwiseInst(date($year.'-'.$m.'-01'),date($year.'-'.$m.'-t'));
                $m++; $k++;
                
            }
            }
            $monthlyInstal=$monthlyInstal;
            
            echo json_encode($monthlyInstal);
    }

    public function Dailyweekwise_app_info(){
            
        if(!checkModulePermission($this->MODULEID_BOOKING)){ 
                //redirect('dashboard'); die;
        }
        $days=array();
        $days=explode('/',$this->input->post('week'));
        $start=date('d',strtotime($days[0]));
        $m=date('m',strtotime($days[0]));
        $y=date('Y',strtotime($days[0]));
        $end=date('d',strtotime($days[1]));
            $dailyInstal=array();
            $n=0;$countd=1;
            for ($j=$start;$j<=$end;$j++){
                $dailyInstal[$n]['day']='Day'.$countd;
                $dailyInstal[$n]['dailydata']=$this->dashboard_model->dailywiseInst(date($y.'-'.$m.'-'.$j));
                $n++;$countd++;
            }
            echo json_encode($dailyInstal);
    }
    
    public function MonthwiseWeeklyOS_app_info(){
        if(!checkModulePermission($this->MODULEID_BOOKING)){ 
                //redirect('dashboard'); die;
        }
        $days=array();
        $month=$this->input->post('month');
        $weeks=$this->getWeeks(date($month),date('Y'));
            $dataweek=array();
            $j=0;$w=1;
            foreach ($weeks as $rowweek){
                $dataweek[$j]['week']='Week'.$w;
                $dataweek[$j]['weekdataAndroid']=$this->dashboard_model->getWeeklyActiveRecordAndroid($rowweek['start_date'],$rowweek['end_date']);
                $dataweek[$j]['weekdataIOS']=$this->dashboard_model->getWeeklyActiveRecordIOS($rowweek['start_date'],$rowweek['end_date']);
                $j++; $w++;
            }
            echo json_encode($dataweek);
    }
    
    private function monthsInYear($year=''){
        if($year<date('Y')){
            for ($i = 1; $i <= 12; $i++) 
            {
            $months[]=date("F", mktime(0, 0, 0, $i, 10));
            }
        }else{
            if($year==date('Y')){
                for ($i = 1; $i <= date('m'); $i++) 
                {
                $months[]=date("F", mktime(0, 0, 0, $i, 10));
                }
            }
        }
    return $months;
    
    }


	public function booking_performance(){
		if(!checkModulePermission($this->MODULEID_BOOKING)){ 
			redirect('dashboard'); die;
		}
        
		$LOGINROLEID=$this->LOGINROLEID;
		$data['heading']='Booking Performance';//$this->heading;
		$data['mode']=$this->mode;
        $data['weeks']=$this->getWeeks(date('m'),date('Y'));
		$this->layout('dashboard/booking_performance',$data);
	}
        
	public function booking_location_info(){
		if(!checkModulePermission($this->MODULEID_BOOKING)){ 
			//redirect('dashboard'); die;
		}
        $location=$this->dashboard_model->getlocation_info_ajax($this->input->post('month'));
		echo json_encode($location);
	}
        
	public function booking_department_info(){
		if(!checkModulePermission($this->MODULEID_BOOKING)){ 
			//redirect('dashboard'); die;
		}
        $department=$this->dashboard_model->getdepartment();
		$deptarr=array();
		$i=0;
		$totaldepart=count($department);
		$countpatient=0;
		foreach ($department as $rowdep){
			$deptarr[$i]['code']=$rowdep->code;
			$deptarr[$i]['name']=$rowdep->name;
			$patient=$this->dashboard_model->booking_performance($rowdep->code);
			$countpatient=$countpatient+$patient;
			$deptarr[$i]['persent_in_department']=$patient;
			$i++;
		}
		$data['totalPatient']=$countpatient;
		$data['deptarr']=$deptarr;
		echo json_encode($data);
	}


	public function patient_profile_info(){
		if(!checkModulePermission($this->MODULEID_PATIENT)){ 
			redirect('dashboard'); die;
		}
                $LOGINROLEID=$this->LOGINROLEID;
		$data['heading']='Patient Info';//$this->heading;
        $data['mode']=$this->mode;
        $data['MODULEID']=$this->MODULEID;
                //for patient male female
                $profile_info=$this->dashboard_model->patient_profile_info();
                $male=0;
                $female=0;
                foreach($profile_info as $pinfo){
                    if($pinfo->gender==1){
                        $male=$pinfo->gender_count;
                    }elseif($pinfo->gender==2){
                        $female=$pinfo->gender_count;
                    }
                }
                $countMaleFemale=$male+$female;
                $data['male']=($male>0)?round(($male/$countMaleFemale)*100,0):'';
                $data['female']=($female>0)?round(($female/$countMaleFemale)*100,0):'';
                //for sub patient male female
                $sprofile_info=$this->dashboard_model->subpatient_profile_info();
                $smale=0;
                $sfemale=0;
                foreach($sprofile_info as $spinfo){
                    if($spinfo->gender==1){
                        $smale=$spinfo->gender_count;
                    }elseif($spinfo->gender==2){
                        $sfemale=$spinfo->gender_count;
                    }
                }
                $scountMaleFemale=$smale+$sfemale;
                $data['smale']=($smale>0)?round(($smale/$scountMaleFemale)*100,0):'';
                $data['sfemale']=($sfemale>0)?round(($sfemale/$scountMaleFemale)*100,0):'';
                //for patient group male female
                $patient_group=$this->dashboard_model->patient_group_info();
                $pregnancy=$nonpregnancy=$momFirstKid=$momFirstKidPlus=0;
               
               // 1:Pregnancy , 2:Non-Pregnancy ,3:Mom with first kid,4:Mon with kid+
                foreach($patient_group as $pgroup){
                    switch($pgroup->patient_group){
                        case 1:
                            $pregnancy=$pgroup->count_patient_group;
                            break;
                        case 2:
                            $nonpregnancy=$pgroup->count_patient_group;
                            break;
                        case 3:
                            $momFirstKid=$pgroup->count_patient_group;
                            break;
                        case 4:
                            $momFirstKidPlus=$pgroup->count_patient_group;
                            break;
                    
                    }
                }
                $totalPregNonpre=$pregnancy+$nonpregnancy+$momFirstKid+$momFirstKidPlus;
                $data['pregnancy']=($pregnancy>0)?round(($pregnancy/$totalPregNonpre)*100,0):'';
                $data['nonpregnancy']=($nonpregnancy>0)?round(($nonpregnancy/$totalPregNonpre)*100,0):'';
                $data['momFirstKid']=($momFirstKid>0)?round(($momFirstKid/$totalPregNonpre)*100,0):'';
                $data['momFirstKidPlus']=($momFirstKidPlus>0)?round(($momFirstKidPlus/$totalPregNonpre)*100,0):'';
                
                foreach($profile_info as $pinfo){
                    if($pinfo->gender==1){
                        $male=$pinfo->gender_count;
                    }elseif($pinfo->gender==2){
                        $female=$pinfo->gender_count;
                    }
                }
                //18-25
                $date18=date('Y-m-d',strtotime(date('Y-m-d'). '-18 years'));
                $date25=date('Y-m-d',strtotime(date('Y-m-d'). '-25 years'));
                $data['date18_25']=$this->dashboard_model->user_age_group($date18,$date25);
                //SELECT count(dob) as dob FROM `hms_patient` WHERE `dob` BETWEEN '2001-12-02' AND '1994-12-02' AND `is_deleted` = '0'
                //26-30
                $date26=date('Y-m-d',strtotime(date('Y-m-d'). '-26 years'));
                $date30=date('Y-m-d',strtotime(date('Y-m-d'). '-30 years'));
                $data['date26_30']=$this->dashboard_model->user_age_group($date26,$date30);
                //SELECT count(dob) as dob FROM `hms_patient` WHERE `dob` BETWEEN '1993-12-02' AND '1989-12-02' AND `is_deleted` = '0'
                //31-35
                $date31=date('Y-m-d',strtotime(date('Y-m-d'). '-31 years'));
                $date35=date('Y-m-d',strtotime(date('Y-m-d'). '-35 years'));
                $data['date31_35']=$this->dashboard_model->user_age_group($date31,$date35);
                //SELECT count(dob) as dob FROM `hms_patient` WHERE `dob` BETWEEN '1988-12-02' AND '1984-12-02' AND `is_deleted` = '0'
                //36-40
                $date36=date('Y-m-d',strtotime(date('Y-m-d'). '-36 years'));
                $date40=date('Y-m-d',strtotime(date('Y-m-d'). '-40 years'));
                $data['date36_40']=$this->dashboard_model->user_age_group($date36,$date40);
                //SELECT count(dob) as dob FROM `hms_patient` WHERE `dob` BETWEEN '1983-12-02' AND '1979-12-02' AND `is_deleted` = '0'
                //40+
                $date41=date('Y-m-d',strtotime(date('Y-m-d'). '-41 years'));
                $data['date41']=$this->dashboard_model->user_age_group2($date41);
                
		$this->layout('dashboard/patient_profile_info',$data);
	}


	public function revenue_info(){
		if(!checkModulePermission($this->MODULEID_REVENUE)){ 
			redirect('dashboard'); die;
		}
		
        $LOGINROLEID=$this->LOGINROLEID;
		$data['heading']='Revenue';//$this->heading;
		$data['mode']=$this->mode;
		$this->layout('dashboard/revenue_info',$data);
	}
        
        public function datecheck(){
            //$date=date('Y-m-d');
            echo date('Y-m-d',strtotime(date('Y-m-d'). '-2 years'));
        }
        
        public function getWeeks($month,$year){
	$month = intval($month);				//force month to single integer if '0x'
	$suff = array('st','nd','rd','th','th','th'); 		//week suffixes
	$end = date('t',mktime(0,0,0,$month,1,$year)); 		//last date day of month: 28 - 31
  	$start = date('w',mktime(0,0,0,$month,1,$year)); 	//1st day of month: 0 - 6 (Sun - Sat)
	$last = 7 - $start; 					//get last day date (Sat) of first week
	$noweeks = ceil((($end - ($last + 1))/7) + 1);		//total no. weeks in month
	$output = "";						//initialize string		
	$monthlabel = str_pad($month, 2, '0', STR_PAD_LEFT);
        $weeks=array();
        $i=0;
	for($x=1;$x<$noweeks+1;$x++){	
		if($x == 1){
			$startdate = "$year-$monthlabel-01";
			$day = $last - 6;
		}else{
			$day = $last + 1 + (($x-2)*7);
			$day = str_pad($day, 2, '0', STR_PAD_LEFT);
			$startdate = "$year-$monthlabel-$day";
		}
		if($x == $noweeks){
			$enddate = "$year-$monthlabel-$end";
		}else{
			$dayend = $day + 6;
			$dayend = str_pad($dayend, 2, '0', STR_PAD_LEFT);
			$enddate = "$year-$monthlabel-$dayend";
		}
                $weeks[$i]['start_date']=$startdate;
                $weeks[$i]['end_date']=$enddate;
                $i++;
		//$output .= "{$x}{$suff[$x-1]} week -> Start date=$startdate End date=$enddate <br />";	
	}
	return $weeks;
}

    private function monthsInCurrentYear(){
        for ($i = 1; $i <= date('m'); $i++) 
        {
        $months[]=date("F", mktime(0, 0, 0, $i, 10));
        }
        return $months;
    }
    
    public function gettotalday(){
        echo  date('w', strtotime(date('y-m-d')));
    }
            

    public function patient_export_list() {
        $data = $this->dashboard_model->patient_profile_infoExcel();
        $exdata=array();
        $j=0;
        $i=1;
        foreach ($data as $row) {
                $exdata[$j]['PRN']=$row['prn'];
                $exdata[$j]['First Name']=$row['first_name'];//.' '.$row['middle_name'].' '.$row['last_name'];
                $exdata[$j]['Middle Name']=$row['middle_name'];
                $exdata[$j]['Last Name']=$row['last_name'];
                $exdata[$j]['User Name']=$row['username'];
                $exdata[$j]['Email Id']=$row['email_id'];
                $exdata[$j]['Contact Number']=$row['contact_number'];
                $exdata[$j]['Emergency Contact']=$row['emergency_contact'];
                $exdata[$j]['Gender']=($row['gender']==1)?'Male':($row['gender']==2)?'Female':'Other';
                $exdata[$j]['Date Of Birth']=$row['dob'];
                $exdata[$j]['Marital Status']=($row['marital_status']==1)?'Unmarried':'Married';
                $exdata[$j]['Religion']=$row['religious'];
                $exdata[$j]['Weight']=$row['weight'];
                $exdata[$j]['Height']=$row['height'];
                
                //$exdata[$j]['Patient Group']=$row['patient_group'];
                $exdata[$j]['Blood Group']=$row['blood_group'];
                $exdata[$j]['Glucose']=$row['glucose'];
                $exdata[$j]['Heart Rate']=$row['heart_rate'];
                $exdata[$j]['Blood Pressure']=$row['blood_pressure'];
                $exdata[$j]['Address']=$row['address_line1'];
                $exdata[$j]['Ward']=$row['ward'];
                $exdata[$j]['Street']=$row['street'];
                $exdata[$j]['Nationality']=$row['country'];
                $exdata[$j]['Province']=$row['province'];
                $exdata[$j]['City']=$row['city'];
                $exdata[$j]['District']=$row['district'];
                
                $exdata[$j]['Sign up Date']=$row['maker_date'];
                $exdata[$j]['Default Language']=($row['default_language']=='en')?'English':'Vietnamese';
                $j++;
    }
    generateExcel($exdata);
    }
    
    public function subpatient_export_list() {
        $data = $this->dashboard_model->subpatient_profile_infoExcel();
        $exdata=array();
        $j=0;
        $i=1;
        foreach ($data as $row) {
                $exdata[$j]['PRN']=$row['prn'];
                $exdata[$j]['Parent PRN']=$row['parent_prn'];
                $exdata[$j]['Parent Relation']=$row['parent_relation'];
                $exdata[$j]['First Name']=$row['first_name'];
                $exdata[$j]['Middle Name']=$row['middle_name'];
                $exdata[$j]['Last Name']=$row['last_name'];
                $exdata[$j]['User Name']=$row['username'];
                $exdata[$j]['Email Id']=$row['email_id'];
                $exdata[$j]['Contact Number']=$row['contact_number'];
                $exdata[$j]['Gender']=($row['gender']==1)?'Male':($row['gender']==2)?'Female':'Other';
                $exdata[$j]['Date Of Birth']=$row['dob'];
                $exdata[$j]['Marital Status']=($row['marital_status']==1)?'Unmarried':'Married';
                $exdata[$j]['Religion']=$row['religious'];
                $exdata[$j]['Weight']=$row['weight'];
                $exdata[$j]['Height']=$row['height'];
                $j++;
    }
    generateExcel($exdata);
    }

////////////////////////////////////////////////////////
}
