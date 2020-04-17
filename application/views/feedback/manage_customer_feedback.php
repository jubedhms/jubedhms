<?=$header;?>
<style>
.bar-5 { height: 18px; background-color: #5B9BD5;}
.bar-4 { height: 18px; background-color: #FFC000;}
.bar-3 { height: 18px; background-color: #A5A5A5;}
.bar-2 { height: 18px; background-color: #ED7D31;}
.bar-1 { height: 18px; background-color: #4472C4;}

.bar-1s { width: 12px;height: 12px; background-color: #4472C4;}
.bar-2s { width: 12px;height: 12px; background-color: #ED7D31;}
.bar-3s { width: 12px;height: 12px; background-color: #A5A5A5;}
.bar-4s { width: 12px;height: 12px; background-color: #FFC000;}
.bar-5s { width: 12px;height: 12px; background-color: #5B9BD5;}
.boright{
border-right: 1px solid;
height: 18px;
}
.outatar{
 display: flex;font-size: 11px;
}
</style>
<main class="main-wrapper clearfix" style="padding-left: 38px;">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
        <div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
	</div>
        <!--Overall rating-->
        
         <?php 
 //Services
 $parkingRating=$DataRateWise_services->total_parking_feedback+$DataRateWise_services->total_parking_staff_attitude+$DataRateWise_services->total_parking_staff_spacous;
 $luggageRating=$DataRateWise_services->total_luggage_prompt+$DataRateWise_services->total_luggage_attitude+$DataRateWise_services->total_luggage_communication;
 $restaurantRating=$DataRateWise_services->total_resaurant_quality_gfloor+$DataRateWise_services->total_resaurant_quality_1stfloor+$DataRateWise_services->total_resaurant_quality_inpatient;
 $inpatientRating=$DataRateWise_services->total_inpatient_cleaniness+$DataRateWise_services->total_inpatient_attitude+$DataRateWise_services->total_inpatient_privacy;
 
 $total_servicesRating=$parkingRating+$luggageRating+$restaurantRating+$inpatientRating;
 $parkingPer=($total_servicesRating>0)?round(($parkingRating/$total_servicesRating)*100,0):0; 
 $luggagePer=($total_servicesRating>0)?round(($luggageRating/$total_servicesRating)*100,0):0; 
 $restaurantPer=($total_servicesRating>0)?round(($restaurantRating/$total_servicesRating)*100,0):0; 
 $inpatientPer=($total_servicesRating>0)?round(($inpatientRating/$total_servicesRating)*100,0):0; 
 ?>

<?php 
//Medical staff
 $doctorRating=$DataRateWise_mstaff->total_doctor_friendiness+$DataRateWise_mstaff->total_doctor_understandable+$DataRateWise_mstaff->total_doctor_effectiveness+$DataRateWise_mstaff->total_doctor_prompt;
 $nurseRating=$DataRateWise_mstaff->total_nurse_attitude+$DataRateWise_mstaff->total_nurse_understandable+$DataRateWise_mstaff->total_nurse_skill+$DataRateWise_mstaff->total_nurse_prompt;
 $cus_serviceRating=$DataRateWise_mstaff->total_cus_service_attitude+$DataRateWise_mstaff->total_cus_service_understandable+$DataRateWise_mstaff->total_cus_service_prompt;
 $call_centreRating=$DataRateWise_mstaff->total_call_centre_prompt+$DataRateWise_mstaff->total_call_centre_understandable+$DataRateWise_mstaff->total_call_centre_voice;
 $pharmacistRating=$DataRateWise_mstaff->total_pharmacist_attitude+$DataRateWise_mstaff->total_pharmacist_understandable+$DataRateWise_mstaff->total_pharmacist_prompt;
 
 $total_medicalStaffRating=$doctorRating+$nurseRating+$cus_serviceRating+$call_centreRating+$pharmacistRating;
 $doctorPer=($doctorRating>0)?round(($doctorRating/$total_medicalStaffRating)*100,0):0; 
 $nursePer=($nurseRating>0)?round(($nurseRating/$total_medicalStaffRating)*100,0):0; 
 $cus_servicePer=($cus_serviceRating>0)?round(($cus_serviceRating/$total_medicalStaffRating)*100,0):0; 
 $call_centrePer=($call_centreRating>0)?round(($call_centreRating/$total_medicalStaffRating)*100,0):0; 
 $pharmacistPer=($pharmacistRating>0)?round(($pharmacistRating/$total_medicalStaffRating)*100,0):0; 
 
 //Total Rating By
 $totalRating_by=$total_medicalStaffRating+$total_servicesRating;
 ?>
        
  <?php 
 //Services
 $parkingsum=$DataRateWise_services->sum_parking_friendiness+$DataRateWise_services->sum_parking_staff_attitude+$DataRateWise_services->sum_parking_staff_spacous;
 $luggagesum=$DataRateWise_services->sum_luggage_prompt+$DataRateWise_services->sum_luggage_attitude+$DataRateWise_services->sum_luggage_communication;
 $resaurantsum=$DataRateWise_services->sum_resaurant_quality_gfloor+$DataRateWise_services->sum_resaurant_quality_1stfloor+$DataRateWise_services->sum_resaurant_quality_inpatient;
 $inpatientsum=$DataRateWise_services->sum_inpatient_cleaniness+$DataRateWise_services->sum_inpatient_attitude+$DataRateWise_services->sum_inpatient_privacy;
 
 $sumtotal_services=$parkingsum+$luggagesum+$resaurantsum+$inpatientsum;
 
 $doctorsum=$DataRateWise_mstaff->sum_doctor_friendiness+$DataRateWise_mstaff->sum_doctor_understandable+$DataRateWise_mstaff->sum_doctor_effectiveness+$DataRateWise_mstaff->sum_doctor_prompt;
 $nursesum=$DataRateWise_mstaff->sum_nurse_attitude+$DataRateWise_mstaff->sum_nurse_understandable+$DataRateWise_mstaff->sum_nurse_skill+$DataRateWise_mstaff->sum_nurse_prompt;
 $cus_servicesum=$DataRateWise_mstaff->sum_cus_service_attitude+$DataRateWise_mstaff->sum_cus_service_understandable+$DataRateWise_mstaff->sum_cus_service_prompt;
 $call_centresum=$DataRateWise_mstaff->sum_call_centre_prompt+$DataRateWise_mstaff->sum_call_centre_understandable+$DataRateWise_mstaff->sum_call_centre_voice;
 $pharmacistsum=$DataRateWise_mstaff->sum_pharmacist_attitude+$DataRateWise_mstaff->sum_pharmacist_understandable+$DataRateWise_mstaff->sum_pharmacist_prompt;
 
 $sumtotal_medicalStaff=$doctorsum+$nursesum+$cus_servicesum+$call_centresum+$pharmacistsum;
 
 $totalRatingSum=$sumtotal_services+$sumtotal_medicalStaff;
 
 $overAll_RatingAverage=($totalRating_by>0)?round(($totalRatingSum/$totalRating_by),2):0; 
 
 ?>      
<div class="row">
    <div class="col-md-4">
        <div class="btn btn-default" style="background-color: #A1CB8D;border: 1px solid #fff;color: #000;cursor: context-menu;font-size: 20px;">Overall ratings: <?php echo $overAll_RatingAverage; ?> stars
        </div>
    </div>
    <div class="col-md-8"></div>
</div>
<div class="row" style="height:20px;"></div>
<div class="row">
    <div class="col-md-4">
        <div class="btn btn-default" style="background-color: #fff;color: #000;cursor: context-menu;font-weight: 700;">Overall ratings details
        </div>
    </div>
    <div class="col-md-8"></div>
</div>

<div class="row" style="height:20px;"></div>
<!--overall-->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">

	<div style="margin-bottom: 2px;height:20px;">
	</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.Waiting time and check up procedure:

	</div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.Medical facility and equipment:
        </div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The friendliness and privacy protection:
        </div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">4.The quality of medical examination service:
        </div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">5.The quality service (exclude examination service):
        </div>
	

</div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_rate_sum=$DataRateWise->waiting_time_rate1+$DataRateWise->waiting_time_rate2+$DataRateWise->waiting_time_rate3+$DataRateWise->waiting_time_rate4+$DataRateWise->waiting_time_rate5;
        $wrate1=($DataRateWise->waiting_time_rate1 && $DataRateWise->waiting_time_rate1>0)?round(($DataRateWise->waiting_time_rate1/$total_rate_sum)*100,2):0; 
        $wrate2=($DataRateWise->waiting_time_rate2 && $DataRateWise->waiting_time_rate2>0)?round(($DataRateWise->waiting_time_rate2/$total_rate_sum)*100,2):0; 
        $wrate3=($DataRateWise->waiting_time_rate3 && $DataRateWise->waiting_time_rate3>0)?round(($DataRateWise->waiting_time_rate3/$total_rate_sum)*100,2):0; 
        $wrate4=($DataRateWise->waiting_time_rate4 && $DataRateWise->waiting_time_rate4>0)?round(($DataRateWise->waiting_time_rate4/$total_rate_sum)*100,2):0; 
        $wrate5=($DataRateWise->waiting_time_rate5 && $DataRateWise->waiting_time_rate5>0)?round(($DataRateWise->waiting_time_rate5/$total_rate_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $wrate1; ?>%" class="bar-1" style="width: <?php echo $wrate1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $wrate2; ?>%" class="bar-2" style="width: <?php echo $wrate2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $wrate3; ?>%" class="bar-3" style="width: <?php echo $wrate3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $wrate4; ?>%" class="bar-4" style="width: <?php echo $wrate4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $wrate5; ?>%" class="bar-5" style="width: <?php echo $wrate5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $avgwating=($overall->waiting_time_hospital>0)?round(($overall->waiting_time_hospital/$overall->total_feedback),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $avgwating; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $rate_sum_facility=$DataRateWise->medical_facility_rate1+$DataRateWise->medical_facility_rate2+$DataRateWise->medical_facility_rate3+$DataRateWise->medical_facility_rate4+$DataRateWise->medical_facility_rate5;
        $frate1=($DataRateWise->medical_facility_rate1 && $DataRateWise->medical_facility_rate1>0)?round(($DataRateWise->medical_facility_rate1/$rate_sum_facility)*100,2):0; 
        $frate2=($DataRateWise->medical_facility_rate2 && $DataRateWise->medical_facility_rate2>0)?round(($DataRateWise->medical_facility_rate2/$rate_sum_facility)*100,2):0; 
        $frate3=($DataRateWise->medical_facility_rate3 && $DataRateWise->medical_facility_rate3>0)?round(($DataRateWise->medical_facility_rate3/$rate_sum_facility)*100,2):0; 
        $frate4=($DataRateWise->medical_facility_rate4 && $DataRateWise->medical_facility_rate4>0)?round(($DataRateWise->medical_facility_rate4/$rate_sum_facility)*100,2):0; 
        $frate5=($DataRateWise->medical_facility_rate5 && $DataRateWise->medical_facility_rate5>0)?round(($DataRateWise->medical_facility_rate5/$rate_sum_facility)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $frate1; ?>%" class="bar-1" style="width: <?php echo $frate1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frate2; ?>%" class="bar-2" style="width: <?php echo $frate2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frate3; ?>%" class="bar-3" style="width: <?php echo $frate3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frate4; ?>%" class="bar-4" style="width: <?php echo $frate4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frate5; ?>%" class="bar-5" style="width: <?php echo $frate5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $avgfacility=($overall->medical_facility_equipment>0)?round(($overall->medical_facility_equipment/$overall->total_feedback),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $avgfacility; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $rate_sum_friendiness=$DataRateWise->friendiness_privacy_rate1+$DataRateWise->friendiness_privacy_rate2+$DataRateWise->friendiness_privacy_rate3+$DataRateWise->friendiness_privacy_rate4+$DataRateWise->friendiness_privacy_rate5;
        $frndrate1=($DataRateWise->friendiness_privacy_rate1 && $DataRateWise->friendiness_privacy_rate1>0)?round(($DataRateWise->friendiness_privacy_rate1/$rate_sum_friendiness)*100,2):0; 
        $frndrate2=($DataRateWise->friendiness_privacy_rate2 && $DataRateWise->friendiness_privacy_rate2>0)?round(($DataRateWise->friendiness_privacy_rate2/$rate_sum_friendiness)*100,2):0; 
        $frndrate3=($DataRateWise->friendiness_privacy_rate3 && $DataRateWise->friendiness_privacy_rate3>0)?round(($DataRateWise->friendiness_privacy_rate3/$rate_sum_friendiness)*100,2):0; 
        $frndrate4=($DataRateWise->friendiness_privacy_rate4 && $DataRateWise->friendiness_privacy_rate4>0)?round(($DataRateWise->friendiness_privacy_rate4/$rate_sum_friendiness)*100,2):0; 
        $frndrate5=($DataRateWise->friendiness_privacy_rate5 && $DataRateWise->friendiness_privacy_rate5>0)?round(($DataRateWise->friendiness_privacy_rate5/$rate_sum_friendiness)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $frndrate1; ?>%" class="bar-1" style="width: <?php echo $frndrate1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frndrate2; ?>%" class="bar-2" style="width: <?php echo $frndrate2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frndrate3; ?>%" class="bar-3" style="width: <?php echo $frndrate3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frndrate4; ?>%" class="bar-4" style="width: <?php echo $frndrate4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $frndrate5; ?>%" class="bar-5" style="width: <?php echo $frndrate5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $friendiness=($overall->friendiness_privacy>0)?round(($overall->friendiness_privacy/$overall->total_feedback),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $friendiness; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $rate_sum_qualitym=$DataRateWise->quality_medical_examination_rate1+$DataRateWise->quality_medical_examination_rate2+$DataRateWise->quality_medical_examination_rate3+$DataRateWise->quality_medical_examination_rate4+$DataRateWise->quality_medical_examination_rate5;
        $qualtmdrate1=($DataRateWise->quality_medical_examination_rate1 && $DataRateWise->quality_medical_examination_rate1>0)?round(($DataRateWise->quality_medical_examination_rate1/$rate_sum_qualitym)*100,2):0; 
        $qualtmdrate2=($DataRateWise->quality_medical_examination_rate2 && $DataRateWise->quality_medical_examination_rate2>0)?round(($DataRateWise->quality_medical_examination_rate2/$rate_sum_qualitym)*100,2):0; 
        $qualtmdrate3=($DataRateWise->quality_medical_examination_rate3 && $DataRateWise->quality_medical_examination_rate3>0)?round(($DataRateWise->quality_medical_examination_rate3/$rate_sum_qualitym)*100,2):0; 
        $qualtmdrate4=($DataRateWise->quality_medical_examination_rate4 && $DataRateWise->quality_medical_examination_rate4>0)?round(($DataRateWise->quality_medical_examination_rate4/$rate_sum_qualitym)*100,2):0; 
        $qualtmdrate5=($DataRateWise->quality_medical_examination_rate5 && $DataRateWise->quality_medical_examination_rate5>0)?round(($DataRateWise->quality_medical_examination_rate5/$rate_sum_qualitym)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $qualtmdrate1; ?>%" class="bar-1" style="width: <?php echo $qualtmdrate1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $qualtmdrate2; ?>%" class="bar-2" style="width: <?php echo $qualtmdrate2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $qualtmdrate3; ?>%" class="bar-3" style="width: <?php echo $qualtmdrate3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $qualtmdrate4; ?>%" class="bar-4" style="width: <?php echo $qualtmdrate4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $qualtmdrate5; ?>%" class="bar-5" style="width: <?php echo $qualtmdrate5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $quality_medical=($overall->quality_medical_examination>0)?round(($overall->quality_medical_examination/$overall->total_feedback),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $quality_medical; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $rate_sum_qualitym=$DataRateWise->overall_service_exclude_exam_rate1+$DataRateWise->overall_service_exclude_exam_rate2+$DataRateWise->overall_service_exclude_exam_rate3+$DataRateWise->overall_service_exclude_exam_rate4+$DataRateWise->overall_service_exclude_exam_rate5;
        $oversrate1=($DataRateWise->overall_service_exclude_exam_rate1 && $DataRateWise->overall_service_exclude_exam_rate1>0)?round(($DataRateWise->overall_service_exclude_exam_rate1/$rate_sum_qualitym)*100,2):0; 
        $oversrate2=($DataRateWise->overall_service_exclude_exam_rate2 && $DataRateWise->overall_service_exclude_exam_rate2>0)?round(($DataRateWise->overall_service_exclude_exam_rate2/$rate_sum_qualitym)*100,2):0; 
        $oversrate3=($DataRateWise->overall_service_exclude_exam_rate3 && $DataRateWise->overall_service_exclude_exam_rate3>0)?round(($DataRateWise->overall_service_exclude_exam_rate3/$rate_sum_qualitym)*100,2):0; 
        $oversrate4=($DataRateWise->overall_service_exclude_exam_rate4 && $DataRateWise->overall_service_exclude_exam_rate4>0)?round(($DataRateWise->overall_service_exclude_exam_rate4/$rate_sum_qualitym)*100,2):0; 
        $oversrate5=($DataRateWise->overall_service_exclude_exam_rate5 && $DataRateWise->overall_service_exclude_exam_rate5>0)?round(($DataRateWise->overall_service_exclude_exam_rate5/$rate_sum_qualitym)*100,2):0; ?>
    
	<div class="col-md-2 boright"><div title="<?php echo $oversrate1; ?>%" class="bar-1" style="width: <?php echo $oversrate1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $oversrate2; ?>%" class="bar-2" style="width: <?php echo $oversrate2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $oversrate3; ?>%" class="bar-3" style="width: <?php echo $oversrate3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $oversrate4; ?>%" class="bar-4" style="width: <?php echo $oversrate4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $oversrate5; ?>%" class="bar-5" style="width: <?php echo $oversrate5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_service=($overall->overall_service_exclude_exam>0)?round(($overall->overall_service_exclude_exam/$overall->total_feedback),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_service; ?></div> 
	</div>
</div>
	
</div>
</div>         


<!--End overallal-->

<!--Suggestion-->
<div class="row" style="height:20px;"></div>
<div class="row">
    <div class="col-md-4">
        <div class="btn btn-default" style="background-color: #fff;color: #000;cursor: context-menu;font-weight: 700;">Patient comments
        </div>
    </div>
    <div class="col-md-8"></div>
</div>

<div class="row" style="height:20px;"></div>            
<div class="row" style="height:225px;overflow-y: scroll;">  
    <div class="col-md-10">
        <div style="background: #4472C4;color: #fff;margin-bottom: 2px;height: 40px;padding: 5px;font-size: 18px;">Suggestion
        </div>
    </div>  
    <div class="col-md-2">
        <div style="background: #4472C4;color: #fff;margin-bottom: 2px;height: 40px;padding: 5px;font-size: 18px;">Show in app
	</div>
    </div>
    <?php if(isset($remarks) and !empty($remarks)){ $i=0; foreach($remarks as $rrow){ ?>
    <div class="col-md-10">
	<div style="background: <?php echo ($i%2!=0)?'#CDD4EA':'#e9ebf5'; ?>;color: #5f5f5f;margin-bottom: 2px;padding: 5px;font-size: 15px;"><?php echo $rrow->feedback_remark; ?></div>
    </div>     
    <div class="col-md-2">
	<div style="background: <?php echo ($i%2!=0)?'#CDD4EA':'#e9ebf5'; ?>;color: #5f5f5f;margin-bottom: 2px;padding: 5px;font-size: 15px;text-align: center;"><button class="btn btn-xs btn-info hideshow" is_show="<?php echo $rrow->show_status; ?>" idd="<?php echo $rrow->ID; ?>"><?php echo ($rrow->show_status)?'Hide':'Show'; ?> </button> </div>
    </div>
    <?php $i++; } } ?>
</div>
<!--end Suggestion-->

       
        
    <div class="widget-list">
        <div class="row" style="height: 20px;"></div>
        <div class="row">    
            <div class="widget-holder widget-full-height widget-flex col-lg-6">
                <div class="widget-bg">
                    <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">Ratings on services</h5>
                            <!--<h5 class="widget-title" style="color: #fff;">Overall Experience in hospital</h5>-->
                    </div>
                    <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                        <div class="mr-t-10 flex-1">
                            <div>
                                <canvas id="pieChart" height="140"></canvas>
                            </div><p> </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="widget-holder widget-full-height widget-flex col-lg-6">
                <div class="widget-bg">
                    <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">Ratings on Medical staff</h5>
                            <!--<h5 class="widget-title" style="color: #fff;">Overall Quality of check up</h5>-->
                    </div>
                    <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                        <div class="mr-t-10 flex-1">
                            <div>
                                 <canvas id="pieChart2" height="140"></canvas>
                            </div>
							 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<!--Parking area-->            
<div class="clearfix"></div>     
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Parking area:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">The friendliness and prompted support of staff:</div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">The attitude and behavior of staff:</div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">The spacious and advantages of parking area:</div>
      
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $rate_sum_parking=$DataRateWise_services->parking_friendiness_rate1+$DataRateWise_services->parking_friendiness_rate2+$DataRateWise_services->parking_friendiness_rate3+$DataRateWise_services->parking_friendiness_rate4+$DataRateWise_services->parking_friendiness_rate5;
        $parkrate1=($DataRateWise_services->parking_friendiness_rate1 && $DataRateWise_services->parking_friendiness_rate1>0)?round(($DataRateWise_services->parking_friendiness_rate1/$rate_sum_parking)*100,2):0; 
        $parkrate2=($DataRateWise_services->parking_friendiness_rate2 && $DataRateWise_services->parking_friendiness_rate2>0)?round(($DataRateWise_services->parking_friendiness_rate2/$rate_sum_parking)*100,2):0; 
        $parkrate3=($DataRateWise_services->parking_friendiness_rate3 && $DataRateWise_services->parking_friendiness_rate3>0)?round(($DataRateWise_services->parking_friendiness_rate3/$rate_sum_parking)*100,2):0; 
        $parkrate4=($DataRateWise_services->parking_friendiness_rate4 && $DataRateWise_services->parking_friendiness_rate4>0)?round(($DataRateWise_services->parking_friendiness_rate4/$rate_sum_parking)*100,2):0; 
        $parkrate5=($DataRateWise_services->parking_friendiness_rate5 && $DataRateWise_services->parking_friendiness_rate5>0)?round(($DataRateWise_services->parking_friendiness_rate5/$rate_sum_parking)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $parkrate1; ?>%" class="bar-1" style="width: <?php echo $parkrate1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $parkrate2; ?>%" class="bar-2" style="width: <?php echo $parkrate2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $parkrate3; ?>%" class="bar-3" style="width: <?php echo $parkrate3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $parkrate4; ?>%" class="bar-4" style="width: <?php echo $parkrate4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $parkrate5; ?>%" class="bar-5" style="width: <?php echo $parkrate5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_parking_service=($DataRateWise_services->total_parking_feedback>0)?round(($DataRateWise_services->sum_parking_friendiness/$DataRateWise_services->total_parking_feedback),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_parking_service; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $rate_sum_parking_staff=$DataRateWise_services->parking_staff_attitude_rate1+$DataRateWise_services->parking_staff_attitude_rate2+$DataRateWise_services->parking_staff_attitude_rate3+$DataRateWise_services->parking_staff_attitude_rate4+$DataRateWise_services->parking_staff_attitude_rate5;
        $parkrate_staff1=($DataRateWise_services->parking_staff_attitude_rate1 && $DataRateWise_services->parking_staff_attitude_rate1>0)?round(($DataRateWise_services->parking_staff_attitude_rate1/$rate_sum_parking_staff)*100,2):0; 
        $parkrate_staff2=($DataRateWise_services->parking_staff_attitude_rate2 && $DataRateWise_services->parking_staff_attitude_rate2>0)?round(($DataRateWise_services->parking_staff_attitude_rate2/$rate_sum_parking_staff)*100,2):0; 
        $parkrate_staff3=($DataRateWise_services->parking_staff_attitude_rate3 && $DataRateWise_services->parking_staff_attitude_rate3>0)?round(($DataRateWise_services->parking_staff_attitude_rate3/$rate_sum_parking_staff)*100,2):0; 
        $parkrate_staff4=($DataRateWise_services->parking_staff_attitude_rate4 && $DataRateWise_services->parking_staff_attitude_rate4>0)?round(($DataRateWise_services->parking_staff_attitude_rate4/$rate_sum_parking_staff)*100,2):0; 
        $parkrate_staff5=($DataRateWise_services->parking_staff_attitude_rate5 && $DataRateWise_services->parking_staff_attitude_rate5>0)?round(($DataRateWise_services->parking_staff_attitude_rate5/$rate_sum_parking_staff)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff1; ?>%" class="bar-1" style="width: <?php echo $parkrate_staff1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff2; ?>%" class="bar-2" style="width: <?php echo $parkrate_staff2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff3; ?>%" class="bar-3" style="width: <?php echo $parkrate_staff3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff4; ?>%" class="bar-4" style="width: <?php echo $parkrate_staff4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff5; ?>%" class="bar-5" style="width: <?php echo $parkrate_staff5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_parking_staff_spacous=($DataRateWise_services->total_parking_staff_attitude>0)?round(($DataRateWise_services->sum_parking_staff_attitude/$DataRateWise_services->total_parking_staff_attitude),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_parking_staff_spacous; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $rate_sum_parking_staff_spacous=$DataRateWise_services->parking_staff_spacous_rate1+$DataRateWise_services->parking_staff_spacous_rate2+$DataRateWise_services->parking_staff_spacous_rate3+$DataRateWise_services->parking_staff_spacous_rate4+$DataRateWise_services->parking_staff_spacous_rate5;
        $parkrate_staff_spacous1=($DataRateWise_services->parking_staff_spacous_rate1 && $DataRateWise_services->parking_staff_spacous_rate1>0)?round(($DataRateWise_services->parking_staff_spacous_rate1/$rate_sum_parking_staff_spacous)*100,2):0; 
        $parkrate_staff_spacous2=($DataRateWise_services->parking_staff_spacous_rate2 && $DataRateWise_services->parking_staff_spacous_rate2>0)?round(($DataRateWise_services->parking_staff_spacous_rate2/$rate_sum_parking_staff_spacous)*100,2):0; 
        $parkrate_staff_spacous3=($DataRateWise_services->parking_staff_spacous_rate3 && $DataRateWise_services->parking_staff_spacous_rate3>0)?round(($DataRateWise_services->parking_staff_spacous_rate3/$rate_sum_parking_staff_spacous)*100,2):0; 
        $parkrate_staff_spacous4=($DataRateWise_services->parking_staff_spacous_rate4 && $DataRateWise_services->parking_staff_spacous_rate4>0)?round(($DataRateWise_services->parking_staff_spacous_rate4/$rate_sum_parking_staff_spacous)*100,2):0; 
        $parkrate_staff_spacous5=($DataRateWise_services->parking_staff_spacous_rate5 && $DataRateWise_services->parking_staff_spacous_rate5>0)?round(($DataRateWise_services->parking_staff_spacous_rate5/$rate_sum_parking_staff_spacous)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff_spacous1; ?>%" class="bar-1" style="width: <?php echo $parkrate_staff_spacous1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff_spacous2; ?>%" class="bar-2" style="width: <?php echo $parkrate_staff_spacous2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff_spacous3; ?>%" class="bar-3" style="width: <?php echo $parkrate_staff_spacous3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff_spacous4; ?>%" class="bar-4" style="width: <?php echo $parkrate_staff_spacous4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $parkrate_staff_spacous5; ?>%" class="bar-5" style="width: <?php echo $parkrate_staff_spacous5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_parking_staff_spacous=($DataRateWise_services->total_parking_staff_spacous>0)?round(($DataRateWise_services->sum_parking_staff_spacous/$DataRateWise_services->total_parking_staff_spacous),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_parking_staff_spacous; ?></div> 
	</div>
</div>
</div>
</div>           

<!--Luggage support
 -->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Luggage support:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The prompted support:</div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.The attitude and behavior of staff:
        </div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The communication and serving attitude:</div>
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_luggage_prompt_sum=$DataRateWise_services->luggage_prompt_rate1+$DataRateWise_services->luggage_prompt_rate2+$DataRateWise_services->luggage_prompt_rate3+$DataRateWise_services->luggage_prompt_rate4+$DataRateWise_services->luggage_prompt_rate5;
        $luggage_prompt1=($DataRateWise_services->luggage_prompt_rate1 && $DataRateWise_services->luggage_prompt_rate1>0)?round(($DataRateWise_services->luggage_prompt_rate1/$total_luggage_prompt_sum)*100,2):0; 
        $luggage_prompt2=($DataRateWise_services->luggage_prompt_rate2 && $DataRateWise_services->luggage_prompt_rate2>0)?round(($DataRateWise_services->luggage_prompt_rate2/$total_luggage_prompt_sum)*100,2):0; 
        $luggage_prompt3=($DataRateWise_services->luggage_prompt_rate3 && $DataRateWise_services->luggage_prompt_rate2>0)?round(($DataRateWise_services->luggage_prompt_rate3/$total_luggage_prompt_sum)*100,2):0; 
        $luggage_prompt4=($DataRateWise_services->luggage_prompt_rate4 && $DataRateWise_services->luggage_prompt_rate4>0)?round(($DataRateWise_services->luggage_prompt_rate4/$total_luggage_prompt_sum)*100,2):0; 
        $luggage_prompt5=($DataRateWise_services->luggage_prompt_rate5 && $DataRateWise_services->luggage_prompt_rate5>0)?round(($DataRateWise_services->luggage_prompt_rate5/$total_luggage_prompt_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $luggage_prompt1; ?>%" class="bar-1" style="width: <?php echo $luggage_prompt1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $luggage_prompt2; ?>%" class="bar-2" style="width: <?php echo $luggage_prompt2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $luggage_prompt3; ?>%" class="bar-3" style="width: <?php echo $luggage_prompt3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $luggage_prompt4; ?>%" class="bar-4" style="width: <?php echo $luggage_prompt4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $luggage_prompt5; ?>%" class="bar-5" style="width: <?php echo $luggage_prompt5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_luggage_prompt=($DataRateWise_services->total_luggage_prompt>0)?round(($DataRateWise_services->sum_luggage_prompt/$DataRateWise_services->total_luggage_prompt),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_luggage_prompt; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_luggage_attitude_sum=$DataRateWise_services->luggage_attitude_rate1+$DataRateWise_services->luggage_attitude_rate2+$DataRateWise_services->luggage_attitude_rate3+$DataRateWise_services->luggage_attitude_rate4+$DataRateWise_services->luggage_attitude_rate5;
        $luggage_attitude1=($DataRateWise_services->luggage_attitude_rate1 && $DataRateWise_services->luggage_attitude_rate1>0)?round(($DataRateWise_services->luggage_attitude_rate1/$total_luggage_attitude_sum)*100,2):0; 
        $luggage_attitude2=($DataRateWise_services->luggage_attitude_rate2 && $DataRateWise_services->luggage_attitude_rate2>0)?round(($DataRateWise_services->luggage_attitude_rate2/$total_luggage_attitude_sum)*100,2):0; 
        $luggage_attitude3=($DataRateWise_services->luggage_attitude_rate3 && $DataRateWise_services->luggage_attitude_rate3>0)?round(($DataRateWise_services->luggage_attitude_rate3/$total_luggage_attitude_sum)*100,2):0; 
        $luggage_attitude4=($DataRateWise_services->luggage_attitude_rate4 && $DataRateWise_services->luggage_attitude_rate4>0)?round(($DataRateWise_services->luggage_attitude_rate4/$total_luggage_attitude_sum)*100,2):0; 
        $luggage_attitude5=($DataRateWise_services->luggage_attitude_rate5 && $DataRateWise_services->luggage_attitude_rate5>0)?round(($DataRateWise_services->luggage_attitude_rate5/$total_luggage_attitude_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_attitude1; ?>%" class="bar-1" style="width: <?php echo $luggage_attitude1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_attitude2; ?>%" class="bar-2" style="width: <?php echo $luggage_attitude2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_attitude3; ?>%" class="bar-3" style="width: <?php echo $luggage_attitude3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_attitude4; ?>%" class="bar-4" style="width: <?php echo $luggage_attitude4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_attitude5; ?>%" class="bar-5" style="width: <?php echo $luggage_attitude5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_luggage_attitude=($DataRateWise_services->total_luggage_attitude>0)?round(($DataRateWise_services->sum_luggage_attitude/$DataRateWise_services->total_luggage_attitude),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_luggage_attitude; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
     <?php $total_luggage_communication_sum=$DataRateWise_services->luggage_communication_rate1+$DataRateWise_services->luggage_communication_rate2+$DataRateWise_services->luggage_communication_rate3+$DataRateWise_services->luggage_communication_rate4+$DataRateWise_services->luggage_communication_rate5;
        $luggage_communication1=($DataRateWise_services->luggage_communication_rate1 && $DataRateWise_services->luggage_communication_rate1>0)?round(($DataRateWise_services->luggage_communication_rate1/$total_luggage_communication_sum)*100,2):0; 
        $luggage_communication2=($DataRateWise_services->luggage_communication_rate2 && $DataRateWise_services->luggage_communication_rate2>0)?round(($DataRateWise_services->luggage_communication_rate2/$total_luggage_communication_sum)*100,2):0; 
        $luggage_communication3=($DataRateWise_services->luggage_communication_rate3 && $DataRateWise_services->luggage_communication_rate3>0)?round(($DataRateWise_services->luggage_communication_rate3/$total_luggage_communication_sum)*100,2):0; 
        $luggage_communication4=($DataRateWise_services->luggage_communication_rate4 && $DataRateWise_services->luggage_communication_rate4>0)?round(($DataRateWise_services->luggage_communication_rate4/$total_luggage_communication_sum)*100,2):0; 
        $luggage_communication5=($DataRateWise_services->luggage_communication_rate5 && $DataRateWise_services->luggage_communication_rate5>0)?round(($DataRateWise_services->luggage_communication_rate5/$total_luggage_communication_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_communication1; ?>%" class="bar-1" style="width: <?php echo $luggage_communication1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_communication2; ?>%" class="bar-2" style="width: <?php echo $luggage_communication2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_communication3; ?>%" class="bar-3" style="width: <?php echo $luggage_communication3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_communication4; ?>%" class="bar-4" style="width: <?php echo $luggage_communication4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $luggage_communication5; ?>%" class="bar-5" style="width: <?php echo $luggage_communication5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_luggage_communication=($DataRateWise_services->total_luggage_communication>0)?round(($DataRateWise_services->sum_luggage_communication/$DataRateWise_services->total_luggage_communication),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_luggage_communication; ?></div> 
	</div>
</div>

	
</div>
</div>



<!--Restaurant-->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">

	<div style="font-size: 16px;font-weight: 700;color:#000;">Restaurant:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The quality of service at canteen at ground floor:</div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.The quality of service at canteen at 1st floor:</div>
            <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The quality of service of in-patient service:</div>
</div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
                <div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_resaurant_quality_gfloor_sum=$DataRateWise_services->resaurant_quality_gfloor_rate1+$DataRateWise_services->resaurant_quality_gfloor_rate2+$DataRateWise_services->resaurant_quality_gfloor_rate3+$DataRateWise_services->resaurant_quality_gfloor_rate4+$DataRateWise_services->resaurant_quality_gfloor_rate5;
        $resaurant_quality_gfloor1=($DataRateWise_services->resaurant_quality_gfloor_rate1 && $DataRateWise_services->resaurant_quality_gfloor_rate1>0)?round(($DataRateWise_services->resaurant_quality_gfloor_rate1/$total_resaurant_quality_gfloor_sum)*100,2):0; 
        $resaurant_quality_gfloor2=($DataRateWise_services->resaurant_quality_gfloor_rate2 && $DataRateWise_services->resaurant_quality_gfloor_rate2>0)?round(($DataRateWise_services->resaurant_quality_gfloor_rate2/$total_resaurant_quality_gfloor_sum)*100,2):0; 
        $resaurant_quality_gfloor3=($DataRateWise_services->resaurant_quality_gfloor_rate3 && $DataRateWise_services->resaurant_quality_gfloor_rate3>0)?round(($DataRateWise_services->resaurant_quality_gfloor_rate3/$total_resaurant_quality_gfloor_sum)*100,2):0; 
        $resaurant_quality_gfloor4=($DataRateWise_services->resaurant_quality_gfloor_rate4 && $DataRateWise_services->resaurant_quality_gfloor_rate4>0)?round(($DataRateWise_services->resaurant_quality_gfloor_rate4/$total_resaurant_quality_gfloor_sum)*100,2):0; 
        $resaurant_quality_gfloor5=($DataRateWise_services->resaurant_quality_gfloor_rate5 && $DataRateWise_services->resaurant_quality_gfloor_rate5>0)?round(($DataRateWise_services->resaurant_quality_gfloor_rate5/$total_resaurant_quality_gfloor_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_gfloor1; ?>%" class="bar-1" style="width: <?php echo $resaurant_quality_gfloor1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_gfloor2; ?>%" class="bar-2" style="width: <?php echo $resaurant_quality_gfloor2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_gfloor3; ?>%" class="bar-3" style="width: <?php echo $resaurant_quality_gfloor3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_gfloor4; ?>%" class="bar-4" style="width: <?php echo $resaurant_quality_gfloor4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_gfloor5; ?>%" class="bar-5" style="width: <?php echo $resaurant_quality_gfloor5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_resaurant_quality_gfloor=($DataRateWise_services->total_resaurant_quality_gfloor>0)?round(($DataRateWise_services->sum_resaurant_quality_gfloor/$DataRateWise_services->total_resaurant_quality_gfloor),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_resaurant_quality_gfloor; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_resaurant_quality_1stfloor_sum=$DataRateWise_services->resaurant_quality_1stfloor_rate1+$DataRateWise_services->resaurant_quality_1stfloor_rate2+$DataRateWise_services->resaurant_quality_1stfloor_rate3+$DataRateWise_services->resaurant_quality_1stfloor_rate4+$DataRateWise_services->resaurant_quality_1stfloor_rate5;
        $resaurant_quality_1stfloor1=($DataRateWise_services->resaurant_quality_1stfloor_rate1 && $DataRateWise_services->resaurant_quality_1stfloor_rate1>0)?round(($DataRateWise_services->resaurant_quality_1stfloor_rate1/$total_luggage_communication_sum)*100,2):0; 
        $resaurant_quality_1stfloor2=($DataRateWise_services->resaurant_quality_1stfloor_rate2 && $DataRateWise_services->resaurant_quality_1stfloor_rate2>0)?round(($DataRateWise_services->resaurant_quality_1stfloor_rate2/$total_luggage_communication_sum)*100,2):0; 
        $resaurant_quality_1stfloor3=($DataRateWise_services->resaurant_quality_1stfloor_rate3 && $DataRateWise_services->resaurant_quality_1stfloor_rate3>0)?round(($DataRateWise_services->resaurant_quality_1stfloor_rate3/$total_luggage_communication_sum)*100,2):0; 
        $resaurant_quality_1stfloor4=($DataRateWise_services->resaurant_quality_1stfloor_rate2 && $DataRateWise_services->resaurant_quality_1stfloor_rate4>0)?round(($DataRateWise_services->resaurant_quality_1stfloor_rate4/$total_luggage_communication_sum)*100,2):0; 
        $resaurant_quality_1stfloor5=($DataRateWise_services->resaurant_quality_1stfloor_rate5 && $DataRateWise_services->resaurant_quality_1stfloor_rate5>0)?round(($DataRateWise_services->resaurant_quality_1stfloor_rate5/$total_luggage_communication_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_1stfloor1; ?>%" class="bar-1" style="width: <?php echo $resaurant_quality_1stfloor1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_1stfloor2; ?>%" class="bar-2" style="width: <?php echo $resaurant_quality_1stfloor2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_1stfloor3; ?>%" class="bar-3" style="width: <?php echo $resaurant_quality_1stfloor3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_1stfloor4; ?>%" class="bar-4" style="width: <?php echo $resaurant_quality_1stfloor4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_1stfloor5; ?>%" class="bar-5" style="width: <?php echo $resaurant_quality_1stfloor5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_resaurant_quality_1stfloor=($DataRateWise_services->total_resaurant_quality_1stfloor>0)?round(($DataRateWise_services->sum_resaurant_quality_1stfloor/$DataRateWise_services->total_resaurant_quality_1stfloor),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_resaurant_quality_1stfloor; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_resaurant_quality_inpatient_sum=$DataRateWise_services->resaurant_quality_inpatient_rate1+$DataRateWise_services->resaurant_quality_inpatient_rate2+$DataRateWise_services->resaurant_quality_inpatient_rate3+$DataRateWise_services->resaurant_quality_inpatient_rate4+$DataRateWise_services->resaurant_quality_inpatient_rate5;
        $resaurant_quality_inpatient1=($DataRateWise_services->resaurant_quality_inpatient_rate1 && $DataRateWise_services->resaurant_quality_inpatient_rate1>0)?round(($DataRateWise_services->resaurant_quality_inpatient_rate1/$total_resaurant_quality_inpatient_sum)*100,2):0; 
        $resaurant_quality_inpatient2=($DataRateWise_services->resaurant_quality_inpatient_rate2 && $DataRateWise_services->resaurant_quality_inpatient_rate2>0)?round(($DataRateWise_services->resaurant_quality_inpatient_rate2/$total_resaurant_quality_inpatient_sum)*100,2):0; 
        $resaurant_quality_inpatient3=($DataRateWise_services->resaurant_quality_inpatient_rate3 && $DataRateWise_services->resaurant_quality_inpatient_rate3>0)?round(($DataRateWise_services->resaurant_quality_inpatient_rate3/$total_resaurant_quality_inpatient_sum)*100,2):0; 
        $resaurant_quality_inpatient4=($DataRateWise_services->resaurant_quality_inpatient_rate4 && $DataRateWise_services->resaurant_quality_inpatient_rate4>0)?round(($DataRateWise_services->resaurant_quality_inpatient_rate4/$total_resaurant_quality_inpatient_sum)*100,2):0; 
        $resaurant_quality_inpatient5=($DataRateWise_services->resaurant_quality_inpatient_rate5 && $DataRateWise_services->resaurant_quality_inpatient_rate5>0)?round(($DataRateWise_services->resaurant_quality_inpatient_rate5/$total_resaurant_quality_inpatient_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_inpatient1; ?>%" class="bar-1" style="width: <?php echo $resaurant_quality_inpatient1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_inpatient2; ?>%" class="bar-2" style="width: <?php echo $resaurant_quality_inpatient2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_inpatient3; ?>%" class="bar-3" style="width: <?php echo $resaurant_quality_inpatient3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_inpatient4; ?>%" class="bar-4" style="width: <?php echo $resaurant_quality_inpatient4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $resaurant_quality_inpatient5; ?>%" class="bar-5" style="width: <?php echo $resaurant_quality_inpatient5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_resaurant_quality_inpatient=($DataRateWise_services->total_resaurant_quality_inpatient>0)?round(($DataRateWise_services->sum_resaurant_quality_inpatient/$DataRateWise_services->total_resaurant_quality_inpatient),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_resaurant_quality_inpatient; ?></div> 
	</div>
</div>
</div>
</div>


<!--In-patient service-->

<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">In-patient service:	</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The cleaniness, advantages of in-patients room:</div>
	<div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.The friendliness and attitude of cleaner of in-patient:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The privacy and safety:</div>
	</div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_inpatient_cleaniness_sum=$DataRateWise_services->inpatient_cleaniness_rate1+$DataRateWise_services->inpatient_cleaniness_rate2+$DataRateWise_services->inpatient_cleaniness_rate3+$DataRateWise_services->inpatient_cleaniness_rate4+$DataRateWise_services->inpatient_cleaniness_rate5;
        $inpatient_cleaniness1=($DataRateWise_services->inpatient_cleaniness_rate1 && $DataRateWise_services->inpatient_cleaniness_rate1>0)?round(($DataRateWise_services->inpatient_cleaniness_rate1/$total_inpatient_cleaniness_sum)*100,2):0; 
        $inpatient_cleaniness2=($DataRateWise_services->inpatient_cleaniness_rate2 && $DataRateWise_services->inpatient_cleaniness_rate2>0)?round(($DataRateWise_services->inpatient_cleaniness_rate2/$total_inpatient_cleaniness_sum)*100,2):0; 
        $inpatient_cleaniness3=($DataRateWise_services->inpatient_cleaniness_rate3 && $DataRateWise_services->inpatient_cleaniness_rate3>0)?round(($DataRateWise_services->inpatient_cleaniness_rate3/$total_inpatient_cleaniness_sum)*100,2):0; 
        $inpatient_cleaniness4=($DataRateWise_services->inpatient_cleaniness_rate4 && $DataRateWise_services->inpatient_cleaniness_rate4>0)?round(($DataRateWise_services->inpatient_cleaniness_rate4/$total_inpatient_cleaniness_sum)*100,2):0; 
        $inpatient_cleaniness5=($DataRateWise_services->inpatient_cleaniness_rate5 && $DataRateWise_services->inpatient_cleaniness_rate5>0)?round(($DataRateWise_services->inpatient_cleaniness_rate5/$total_inpatient_cleaniness_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $inpatient_cleaniness1; ?>%" class="bar-1" style="width: <?php echo $inpatient_cleaniness1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $inpatient_cleaniness2; ?>%" class="bar-2" style="width: <?php echo $inpatient_cleaniness2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $inpatient_cleaniness3; ?>%" class="bar-3" style="width: <?php echo $inpatient_cleaniness3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $inpatient_cleaniness4; ?>%" class="bar-4" style="width: <?php echo $inpatient_cleaniness4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $inpatient_cleaniness5; ?>%" class="bar-5" style="width: <?php echo $inpatient_cleaniness5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_inpatient_cleaniness=($DataRateWise_services->total_inpatient_cleaniness>0)?round(($DataRateWise_services->sum_inpatient_cleaniness/$DataRateWise_services->total_inpatient_cleaniness),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_inpatient_cleaniness; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_inpatient_attitude_sum=$DataRateWise_services->inpatient_attitude_rate1+$DataRateWise_services->inpatient_attitude_rate2+$DataRateWise_services->inpatient_attitude_rate3+$DataRateWise_services->inpatient_attitude_rate4+$DataRateWise_services->inpatient_attitude_rate5;
        $inpatient_attitude1=($DataRateWise_services->inpatient_attitude_rate1 && $DataRateWise_services->inpatient_attitude_rate1>0)?round(($DataRateWise_services->inpatient_attitude_rate1/$total_inpatient_attitude_sum)*100,2):0; 
        $inpatient_attitude2=($DataRateWise_services->inpatient_attitude_rate2 && $DataRateWise_services->inpatient_attitude_rate2>0)?round(($DataRateWise_services->inpatient_attitude_rate2/$total_inpatient_attitude_sum)*100,2):0; 
        $inpatient_attitude3=($DataRateWise_services->inpatient_attitude_rate3 && $DataRateWise_services->inpatient_attitude_rate3>0)?round(($DataRateWise_services->inpatient_attitude_rate3/$total_inpatient_attitude_sum)*100,2):0; 
        $inpatient_attitude4=($DataRateWise_services->inpatient_attitude_rate4 && $DataRateWise_services->inpatient_attitude_rate4>0)?round(($DataRateWise_services->inpatient_attitude_rate4/$total_inpatient_attitude_sum)*100,2):0; 
        $inpatient_attitude5=($DataRateWise_services->inpatient_attitude_rate5 && $DataRateWise_services->inpatient_attitude_rate5>0)?round(($DataRateWise_services->inpatient_attitude_rate5/$total_inpatient_attitude_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_attitude1; ?>%" class="bar-1" style="width: <?php echo $inpatient_attitude1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_attitude2; ?>%" class="bar-2" style="width: <?php echo $inpatient_attitude2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_attitude3; ?>%" class="bar-3" style="width: <?php echo $inpatient_attitude3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_attitude4; ?>%" class="bar-4" style="width: <?php echo $inpatient_attitude4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_attitude5; ?>%" class="bar-5" style="width: <?php echo $inpatient_attitude5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_inpatient_attitude=($DataRateWise_services->total_inpatient_attitude>0)?round(($DataRateWise_services->sum_inpatient_attitude/$DataRateWise_services->total_inpatient_attitude),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_inpatient_attitude; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_inpatient_privacy_sum=$DataRateWise_services->inpatient_privacy_rate1+$DataRateWise_services->inpatient_privacy_rate2+$DataRateWise_services->inpatient_privacy_rate3+$DataRateWise_services->inpatient_privacy_rate4+$DataRateWise_services->inpatient_privacy_rate5;
        $inpatient_privacy1=($DataRateWise_services->inpatient_privacy_rate1 && $DataRateWise_services->inpatient_privacy_rate1>0)?round(($DataRateWise_services->inpatient_privacy_rate1/$total_inpatient_privacy_sum)*100,2):0; 
        $inpatient_privacy2=($DataRateWise_services->inpatient_privacy_rate2 && $DataRateWise_services->inpatient_privacy_rate2>0)?round(($DataRateWise_services->inpatient_privacy_rate2/$total_inpatient_privacy_sum)*100,2):0; 
        $inpatient_privacy3=($DataRateWise_services->inpatient_privacy_rate3 && $DataRateWise_services->inpatient_privacy_rate3>0)?round(($DataRateWise_services->inpatient_privacy_rate3/$total_inpatient_privacy_sum)*100,2):0; 
        $inpatient_privacy4=($DataRateWise_services->inpatient_privacy_rate4 && $DataRateWise_services->inpatient_privacy_rate4>0)?round(($DataRateWise_services->inpatient_privacy_rate4/$total_inpatient_privacy_sum)*100,2):0; 
        $inpatient_privacy5=($DataRateWise_services->inpatient_privacy_rate5 && $DataRateWise_services->inpatient_privacy_rate5>0)?round(($DataRateWise_services->inpatient_privacy_rate5/$total_inpatient_privacy_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_privacy1; ?>%" class="bar-1" style="width: <?php echo $inpatient_privacy1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_privacy2; ?>%" class="bar-2" style="width: <?php echo $inpatient_privacy2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_privacy3; ?>%" class="bar-3" style="width: <?php echo $inpatient_privacy3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_privacy4; ?>%" class="bar-4" style="width: <?php echo $inpatient_privacy4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $inpatient_privacy5; ?>%" class="bar-5" style="width: <?php echo $inpatient_privacy5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_inpatient_privacy=($DataRateWise_services->total_inpatient_privacy>0)?round(($DataRateWise_services->sum_inpatient_privacy/$DataRateWise_services->total_inpatient_privacy),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_inpatient_privacy; ?></div> 
	</div>
</div>
</div>
</div>
<!--end other rating details-->

<!--Doctor-->

<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Doctor:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The friendliness and careness :</div>
	<div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.Clear and understandable consultant:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The effectiveness of treatment and careness:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">4.The prompt and willingness to support:</div>
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_doctor_friendiness_sum=$DataRateWise_mstaff->doctor_friendiness_rate1+$DataRateWise_mstaff->doctor_friendiness_rate2+$DataRateWise_mstaff->doctor_friendiness_rate3+$DataRateWise_mstaff->doctor_friendiness_rate4+$DataRateWise_mstaff->doctor_friendiness_rate5;
        $doctor_friendiness1=($DataRateWise_mstaff->doctor_friendiness_rate1 && $DataRateWise_mstaff->doctor_friendiness_rate1>0)?round(($DataRateWise_mstaff->doctor_friendiness_rate1/$total_doctor_friendiness_sum)*100,2):0; 
        $doctor_friendiness2=($DataRateWise_mstaff->doctor_friendiness_rate2 && $DataRateWise_mstaff->doctor_friendiness_rate2>0)?round(($DataRateWise_mstaff->doctor_friendiness_rate2/$total_doctor_friendiness_sum)*100,2):0; 
        $doctor_friendiness3=($DataRateWise_mstaff->doctor_friendiness_rate3 && $DataRateWise_mstaff->doctor_friendiness_rate3>0)?round(($DataRateWise_mstaff->doctor_friendiness_rate3/$total_doctor_friendiness_sum)*100,2):0; 
        $doctor_friendiness4=($DataRateWise_mstaff->doctor_friendiness_rate4 && $DataRateWise_mstaff->doctor_friendiness_rate4>0)?round(($DataRateWise_mstaff->doctor_friendiness_rate4/$total_doctor_friendiness_sum)*100,2):0; 
        $doctor_friendiness5=($DataRateWise_mstaff->doctor_friendiness_rate5 && $DataRateWise_mstaff->doctor_friendiness_rate5>0)?round(($DataRateWise_mstaff->doctor_friendiness_rate5/$total_doctor_friendiness_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $doctor_friendiness1; ?>%" class="bar-1" style="width: <?php echo $doctor_friendiness1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $doctor_friendiness2; ?>%" class="bar-2" style="width: <?php echo $doctor_friendiness2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $doctor_friendiness3; ?>%" class="bar-3" style="width: <?php echo $doctor_friendiness3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $doctor_friendiness4; ?>%" class="bar-4" style="width: <?php echo $doctor_friendiness4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $doctor_friendiness5; ?>%" class="bar-5" style="width: <?php echo $doctor_friendiness5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_doctor_friendiness=($DataRateWise_mstaff->total_doctor_friendiness>0)?round(($DataRateWise_mstaff->sum_doctor_friendiness/$DataRateWise_mstaff->total_doctor_friendiness),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_doctor_friendiness; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_doctor_understandable_sum=$DataRateWise_mstaff->doctor_understandable_rate1+$DataRateWise_mstaff->doctor_understandable_rate2+$DataRateWise_mstaff->doctor_understandable_rate3+$DataRateWise_mstaff->doctor_understandable_rate4+$DataRateWise_mstaff->doctor_understandable_rate5;
        $doctor_understandable1=($DataRateWise_mstaff->doctor_understandable_rate1 && $DataRateWise_mstaff->doctor_understandable_rate1>0)?round(($DataRateWise_mstaff->doctor_understandable_rate1/$total_doctor_understandable_sum)*100,2):0; 
        $doctor_understandable2=($DataRateWise_mstaff->doctor_understandable_rate2 && $DataRateWise_mstaff->doctor_understandable_rate2>0)?round(($DataRateWise_mstaff->doctor_understandable_rate2/$total_doctor_understandable_sum)*100,2):0; 
        $doctor_understandable3=($DataRateWise_mstaff->doctor_understandable_rate3 && $DataRateWise_mstaff->doctor_understandable_rate3>0)?round(($DataRateWise_mstaff->doctor_understandable_rate3/$total_doctor_understandable_sum)*100,2):0; 
        $doctor_understandable4=($DataRateWise_mstaff->doctor_understandable_rate4 && $DataRateWise_mstaff->doctor_understandable_rate4>0)?round(($DataRateWise_mstaff->doctor_understandable_rate4/$total_doctor_understandable_sum)*100,2):0; 
        $doctor_understandable5=($DataRateWise_mstaff->doctor_understandable_rate5 && $DataRateWise_mstaff->doctor_understandable_rate5>0)?round(($DataRateWise_mstaff->doctor_understandable_rate5/$total_doctor_understandable_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_understandable1; ?>%" class="bar-1" style="width: <?php echo $doctor_understandable1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_understandable2; ?>%" class="bar-2" style="width: <?php echo $doctor_understandable2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_understandable3; ?>%" class="bar-3" style="width: <?php echo $doctor_understandable3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_understandable4; ?>%" class="bar-4" style="width: <?php echo $doctor_understandable4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_understandable5; ?>%" class="bar-5" style="width: <?php echo $doctor_understandable5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_doctor_understandable=($DataRateWise_mstaff->total_doctor_understandable>0)?round(($DataRateWise_mstaff->sum_doctor_understandable/$DataRateWise_mstaff->total_doctor_understandable),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_doctor_understandable; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_doctor_effectiveness_sum=$DataRateWise_mstaff->doctor_effectiveness_rate1+$DataRateWise_mstaff->doctor_effectiveness_rate2+$DataRateWise_mstaff->doctor_effectiveness_rate3+$DataRateWise_mstaff->doctor_effectiveness_rate4+$DataRateWise_mstaff->doctor_effectiveness_rate5;
        $doctor_effectiveness1=($DataRateWise_mstaff->doctor_effectiveness_rate1 && $DataRateWise_mstaff->doctor_effectiveness_rate1>0)?round(($DataRateWise_mstaff->doctor_effectiveness_rate1/$total_doctor_effectiveness_sum)*100,2):0; 
        $doctor_effectiveness2=($DataRateWise_mstaff->doctor_effectiveness_rate2 && $DataRateWise_mstaff->doctor_effectiveness_rate2>0)?round(($DataRateWise_mstaff->doctor_effectiveness_rate2/$total_doctor_effectiveness_sum)*100,2):0; 
        $doctor_effectiveness3=($DataRateWise_mstaff->doctor_effectiveness_rate3 && $DataRateWise_mstaff->doctor_effectiveness_rate3>0)?round(($DataRateWise_mstaff->doctor_effectiveness_rate3/$total_doctor_effectiveness_sum)*100,2):0; 
        $doctor_effectiveness4=($DataRateWise_mstaff->doctor_effectiveness_rate4 && $DataRateWise_mstaff->doctor_effectiveness_rate4>0)?round(($DataRateWise_mstaff->doctor_effectiveness_rate4/$total_doctor_effectiveness_sum)*100,2):0; 
        $doctor_effectiveness5=($DataRateWise_mstaff->doctor_effectiveness_rate5 && $DataRateWise_mstaff->doctor_effectiveness_rate5>0)?round(($DataRateWise_mstaff->doctor_effectiveness_rate5/$total_doctor_effectiveness_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_effectiveness1; ?>%" class="bar-1" style="width: <?php echo $doctor_effectiveness1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_effectiveness2; ?>%" class="bar-2" style="width: <?php echo $doctor_effectiveness2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_effectiveness3; ?>%" class="bar-3" style="width: <?php echo $doctor_effectiveness3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_effectiveness4; ?>%" class="bar-4" style="width: <?php echo $doctor_effectiveness4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_effectiveness5; ?>%" class="bar-5" style="width: <?php echo $doctor_effectiveness5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_doctor_effectiveness=($DataRateWise_mstaff->total_doctor_effectiveness>0)?round(($DataRateWise_mstaff->sum_doctor_effectiveness/$DataRateWise_mstaff->total_doctor_effectiveness),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_doctor_effectiveness; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_waiting_time_sum=$DataRateWise_mstaff->doctor_friendiness_rate1+$DataRateWise_mstaff->doctor_prompt_rate2+$DataRateWise_mstaff->doctor_prompt_rate3+$DataRateWise_mstaff->doctor_prompt_rate4+$DataRateWise_mstaff->doctor_prompt_rate5;
        $doctor_prompt1=($DataRateWise_mstaff->doctor_prompt_rate1 && $DataRateWise_mstaff->doctor_prompt_rate1>0)?round(($DataRateWise_mstaff->doctor_prompt_rate1/$total_waiting_time_sum)*100,2):0; 
        $doctor_prompt2=($DataRateWise_mstaff->doctor_prompt_rate2 && $DataRateWise_mstaff->doctor_prompt_rate2>0)?round(($DataRateWise_mstaff->doctor_prompt_rate2/$total_waiting_time_sum)*100,2):0; 
        $doctor_prompt3=($DataRateWise_mstaff->doctor_prompt_rate3 && $DataRateWise_mstaff->doctor_prompt_rate3>0)?round(($DataRateWise_mstaff->doctor_prompt_rate3/$total_waiting_time_sum)*100,2):0; 
        $doctor_prompt4=($DataRateWise_mstaff->doctor_prompt_rate4 && $DataRateWise_mstaff->doctor_prompt_rate4>0)?round(($DataRateWise_mstaff->doctor_prompt_rate4/$total_waiting_time_sum)*100,2):0; 
        $doctor_prompt5=($DataRateWise_mstaff->doctor_prompt_rate5 && $DataRateWise_mstaff->doctor_prompt_rate5>0)?round(($DataRateWise_mstaff->doctor_prompt_rate5/$total_waiting_time_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_prompt1; ?>%" class="bar-1" style="width: <?php echo $doctor_prompt1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_prompt2; ?>%" class="bar-2" style="width: <?php echo $doctor_prompt2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_prompt3; ?>%" class="bar-3" style="width: <?php echo $doctor_prompt3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_prompt4; ?>%" class="bar-4" style="width: <?php echo $doctor_prompt4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $doctor_prompt5; ?>%" class="bar-5" style="width: <?php echo $doctor_prompt5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_doctor_prompt=($DataRateWise_mstaff->total_doctor_prompt>0)?round(($DataRateWise_mstaff->sum_doctor_prompt/$DataRateWise_mstaff->total_doctor_prompt),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_doctor_prompt; ?></div> 
	</div>
</div>
</div>
</div>
<!--End Doctor-->

<!--Nurse-->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Nurse:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The attitude and behavior when giving consultancy:</div>
	<div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.Clear and understandable consultant:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The related skill and professionalism:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">4.The prompt and willingness to support:</div>
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_nurse_attitude_sum=$DataRateWise_mstaff->nurse_attitude_rate1+$DataRateWise_mstaff->nurse_attitude_rate2+$DataRateWise_mstaff->nurse_attitude_rate3+$DataRateWise_mstaff->nurse_attitude_rate4+$DataRateWise_mstaff->nurse_attitude_rate5;
        $nurse_attitude1=($DataRateWise_mstaff->nurse_attitude_rate1 && $DataRateWise_mstaff->nurse_attitude_rate1>0)?round(($DataRateWise_mstaff->nurse_attitude_rate1/$total_nurse_attitude_sum)*100,2):0; 
        $nurse_attitude2=($DataRateWise_mstaff->nurse_attitude_rate2 && $DataRateWise_mstaff->nurse_attitude_rate2>0)?round(($DataRateWise_mstaff->nurse_attitude_rate2/$total_nurse_attitude_sum)*100,2):0; 
        $nurse_attitude3=($DataRateWise_mstaff->nurse_attitude_rate3 && $DataRateWise_mstaff->nurse_attitude_rate3>0)?round(($DataRateWise_mstaff->nurse_attitude_rate3/$total_nurse_attitude_sum)*100,2):0; 
        $nurse_attitude4=($DataRateWise_mstaff->nurse_attitude_rate4 && $DataRateWise_mstaff->nurse_attitude_rate4>0)?round(($DataRateWise_mstaff->nurse_attitude_rate4/$total_nurse_attitude_sum)*100,2):0; 
        $nurse_attitude5=($DataRateWise_mstaff->nurse_attitude_rate5 && $DataRateWise_mstaff->nurse_attitude_rate5>0)?round(($DataRateWise_mstaff->nurse_attitude_rate5/$total_nurse_attitude_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $nurse_attitude1; ?>%" class="bar-1" style="width: <?php echo $nurse_attitude1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $nurse_attitude2; ?>%" class="bar-2" style="width: <?php echo $nurse_attitude2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $nurse_attitude3; ?>%" class="bar-3" style="width: <?php echo $nurse_attitude3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $nurse_attitude4; ?>%" class="bar-4" style="width: <?php echo $nurse_attitude4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $nurse_attitude5; ?>%" class="bar-5" style="width: <?php echo $nurse_attitude5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_nurse_attitude=($DataRateWise_mstaff->total_nurse_attitude>0)?round(($DataRateWise_mstaff->sum_nurse_attitude/$DataRateWise_mstaff->total_nurse_attitude),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_nurse_attitude; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_nurse_understandable_sum=$DataRateWise_mstaff->nurse_understandable_rate1+$DataRateWise_mstaff->nurse_understandable_rate2+$DataRateWise_mstaff->nurse_understandable_rate3+$DataRateWise_mstaff->nurse_understandable_rate4+$DataRateWise_mstaff->nurse_understandable_rate5;
        $nurse_understandable1=($DataRateWise_mstaff->nurse_understandable_rate1 && $DataRateWise_mstaff->nurse_understandable_rate1>0)?round(($DataRateWise_mstaff->nurse_understandable_rate1/$total_nurse_understandable_sum)*100,2):0; 
        $nurse_understandable2=($DataRateWise_mstaff->nurse_understandable_rate2 && $DataRateWise_mstaff->nurse_understandable_rate2>0)?round(($DataRateWise_mstaff->nurse_understandable_rate2/$total_nurse_understandable_sum)*100,2):0; 
        $nurse_understandable3=($DataRateWise_mstaff->nurse_understandable_rate3 && $DataRateWise_mstaff->nurse_understandable_rate3>0)?round(($DataRateWise_mstaff->nurse_understandable_rate3/$total_nurse_understandable_sum)*100,2):0; 
        $nurse_understandable4=($DataRateWise_mstaff->nurse_understandable_rate4 && $DataRateWise_mstaff->nurse_understandable_rate4>0)?round(($DataRateWise_mstaff->nurse_understandable_rate4/$total_nurse_understandable_sum)*100,2):0; 
        $nurse_understandable5=($DataRateWise_mstaff->nurse_understandable_rate5 && $DataRateWise_mstaff->nurse_understandable_rate5>0)?round(($DataRateWise_mstaff->nurse_understandable_rate5/$total_nurse_understandable_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_understandable1; ?>%" class="bar-1" style="width: <?php echo $nurse_understandable1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_understandable2; ?>%" class="bar-2" style="width: <?php echo $nurse_understandable2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_understandable3; ?>%" class="bar-3" style="width: <?php echo $nurse_understandable3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_understandable4; ?>%" class="bar-4" style="width: <?php echo $nurse_understandable4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_understandable5; ?>%" class="bar-5" style="width: <?php echo $nurse_understandable5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_nurse_understandable=($DataRateWise_mstaff->total_nurse_understandable>0)?round(($DataRateWise_mstaff->sum_nurse_understandable/$DataRateWise_mstaff->total_nurse_understandable),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_nurse_understandable; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_nurse_skill_sum=$DataRateWise_mstaff->nurse_skill_rate1+$DataRateWise_mstaff->nurse_skill_rate2+$DataRateWise_mstaff->nurse_skill_rate3+$DataRateWise_mstaff->nurse_skill_rate4+$DataRateWise_mstaff->nurse_skill_rate5;
        $nurse_skill1=($DataRateWise_mstaff->nurse_skill_rate1 && $DataRateWise_mstaff->nurse_skill_rate1>0)?round(($DataRateWise_mstaff->nurse_skill_rate1/$total_nurse_skill_sum)*100,2):0; 
        $nurse_skill2=($DataRateWise_mstaff->nurse_skill_rate2 && $DataRateWise_mstaff->nurse_skill_rate2>0)?round(($DataRateWise_mstaff->nurse_skill_rate2/$total_nurse_skill_sum)*100,2):0; 
        $nurse_skill3=($DataRateWise_mstaff->nurse_skill_rate3 && $DataRateWise_mstaff->nurse_skill_rate3>0)?round(($DataRateWise_mstaff->nurse_skill_rate3/$total_nurse_skill_sum)*100,2):0; 
        $nurse_skill4=($DataRateWise_mstaff->nurse_skill_rate4 && $DataRateWise_mstaff->nurse_skill_rate4>0)?round(($DataRateWise_mstaff->nurse_skill_rate4/$total_nurse_skill_sum)*100,2):0; 
        $nurse_skill5=($DataRateWise_mstaff->nurse_skill_rate5 && $DataRateWise_mstaff->nurse_skill_rate5>0)?round(($DataRateWise_mstaff->nurse_skill_rate5/$total_nurse_skill_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_skill1; ?>%" class="bar-1" style="width: <?php echo $nurse_skill1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_skill2; ?>%" class="bar-2" style="width: <?php echo $nurse_skill2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_skill3; ?>%" class="bar-3" style="width: <?php echo $nurse_skill3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_skill4; ?>%" class="bar-4" style="width: <?php echo $nurse_skill4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_skill5; ?>%" class="bar-5" style="width: <?php echo $nurse_skill5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_nurse_skill=($DataRateWise_mstaff->total_nurse_skill>0)?round(($DataRateWise_mstaff->sum_nurse_skill/$DataRateWise_mstaff->total_nurse_skill),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_nurse_skill; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_nurse_prompt_sum=$DataRateWise_mstaff->nurse_prompt_rate1+$DataRateWise_mstaff->nurse_prompt_rate2+$DataRateWise_mstaff->nurse_prompt_rate3+$DataRateWise_mstaff->nurse_prompt_rate4+$DataRateWise_mstaff->nurse_prompt_rate5;
        $nurse_prompt1=($DataRateWise_mstaff->nurse_prompt_rate1 && $DataRateWise_mstaff->nurse_prompt_rate1>0)?round(($DataRateWise_mstaff->nurse_prompt_rate1/$total_nurse_prompt_sum)*100,2):0; 
        $nurse_prompt2=($DataRateWise_mstaff->nurse_prompt_rate2 && $DataRateWise_mstaff->nurse_prompt_rate2>0)?round(($DataRateWise_mstaff->nurse_prompt_rate2/$total_nurse_prompt_sum)*100,2):0; 
        $nurse_prompt3=($DataRateWise_mstaff->nurse_prompt_rate3 && $DataRateWise_mstaff->nurse_prompt_rate3>0)?round(($DataRateWise_mstaff->nurse_prompt_rate3/$total_nurse_prompt_sum)*100,2):0; 
        $nurse_prompt4=($DataRateWise_mstaff->nurse_prompt_rate4 && $DataRateWise_mstaff->nurse_prompt_rate4>0)?round(($DataRateWise_mstaff->nurse_prompt_rate4/$total_nurse_prompt_sum)*100,2):0; 
        $nurse_prompt5=($DataRateWise_mstaff->nurse_prompt_rate5 && $DataRateWise_mstaff->nurse_prompt_rate5>0)?round(($DataRateWise_mstaff->nurse_prompt_rate5/$total_nurse_prompt_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_prompt1; ?>%" class="bar-1" style="width: <?php echo $nurse_prompt1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_prompt2; ?>%" class="bar-2" style="width: <?php echo $nurse_prompt2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_prompt3; ?>%" class="bar-3" style="width: <?php echo $nurse_prompt3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_prompt4; ?>%" class="bar-4" style="width: <?php echo $nurse_prompt4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $nurse_prompt5; ?>%" class="bar-5" style="width: <?php echo $nurse_prompt5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_nurse_prompt=($DataRateWise_mstaff->total_nurse_prompt>0)?round(($DataRateWise_mstaff->sum_nurse_prompt/$DataRateWise_mstaff->total_nurse_prompt),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_nurse_prompt; ?></div> 
	</div>
</div>
</div>
</div>
<!--End Nurse-->
    


<!--Customer service-->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Customer service:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The attitude and behavior to welcome and provide instruction:</div>
	<div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.Clear and understandable consultant:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The prompt and willingness to support:</div>
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_cus_service_attitude_sum=$DataRateWise_mstaff->cus_service_attitude_rate1+$DataRateWise_mstaff->cus_service_attitude_rate2+$DataRateWise_mstaff->cus_service_attitude_rate3+$DataRateWise_mstaff->cus_service_attitude_rate4+$DataRateWise_mstaff->cus_service_attitude_rate5;
        $cus_service_attitude1=($DataRateWise_mstaff->cus_service_attitude_rate1 && $DataRateWise_mstaff->cus_service_attitude_rate1>0)?round(($DataRateWise_mstaff->cus_service_attitude_rate1/$total_cus_service_attitude_sum)*100,2):0; 
        $cus_service_attitude2=($DataRateWise_mstaff->cus_service_attitude_rate2 && $DataRateWise_mstaff->cus_service_attitude_rate2>0)?round(($DataRateWise_mstaff->cus_service_attitude_rate2/$total_cus_service_attitude_sum)*100,2):0; 
        $cus_service_attitude3=($DataRateWise_mstaff->cus_service_attitude_rate3 && $DataRateWise_mstaff->cus_service_attitude_rate3>0)?round(($DataRateWise_mstaff->cus_service_attitude_rate3/$total_cus_service_attitude_sum)*100,2):0; 
        $cus_service_attitude4=($DataRateWise_mstaff->cus_service_attitude_rate4 && $DataRateWise_mstaff->cus_service_attitude_rate4>0)?round(($DataRateWise_mstaff->cus_service_attitude_rate4/$total_cus_service_attitude_sum)*100,2):0; 
        $cus_service_attitude5=($DataRateWise_mstaff->cus_service_attitude_rate5 && $DataRateWise_mstaff->cus_service_attitude_rate5>0)?round(($DataRateWise_mstaff->cus_service_attitude_rate5/$total_cus_service_attitude_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $cus_service_attitude1; ?>%" class="bar-1" style="width: <?php echo $cus_service_attitude1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $cus_service_attitude2; ?>%" class="bar-2" style="width: <?php echo $cus_service_attitude2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $cus_service_attitude3; ?>%" class="bar-3" style="width: <?php echo $cus_service_attitude3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $cus_service_attitude4; ?>%" class="bar-4" style="width: <?php echo $cus_service_attitude4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $cus_service_attitude5; ?>%" class="bar-5" style="width: <?php echo $cus_service_attitude5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_cus_service_attitude=($DataRateWise_mstaff->total_cus_service_attitude>0)?round(($DataRateWise_mstaff->sum_cus_service_attitude/$DataRateWise_mstaff->total_cus_service_attitude),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_cus_service_attitude; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_cus_service_understandable_sum=$DataRateWise_mstaff->cus_service_understandable_rate1+$DataRateWise_mstaff->cus_service_understandable_rate2+$DataRateWise_mstaff->cus_service_understandable_rate3+$DataRateWise_mstaff->cus_service_understandable_rate4+$DataRateWise_mstaff->cus_service_understandable_rate5;
        $cus_service_understandable1=($DataRateWise_mstaff->cus_service_understandable_rate1 && $DataRateWise_mstaff->cus_service_understandable_rate1>0)?round(($DataRateWise_mstaff->cus_service_understandable_rate1/$total_cus_service_understandable_sum)*100,2):0; 
        $cus_service_understandable2=($DataRateWise_mstaff->cus_service_understandable_rate2 && $DataRateWise_mstaff->cus_service_understandable_rate2>0)?round(($DataRateWise_mstaff->cus_service_understandable_rate2/$total_cus_service_understandable_sum)*100,2):0; 
        $cus_service_understandable3=($DataRateWise_mstaff->cus_service_understandable_rate3 && $DataRateWise_mstaff->cus_service_understandable_rate3>0)?round(($DataRateWise_mstaff->cus_service_understandable_rate3/$total_cus_service_understandable_sum)*100,2):0; 
        $cus_service_understandable4=($DataRateWise_mstaff->cus_service_understandable_rate4 && $DataRateWise_mstaff->cus_service_understandable_rate4>0)?round(($DataRateWise_mstaff->cus_service_understandable_rate4/$total_cus_service_understandable_sum)*100,2):0; 
        $cus_service_understandable5=($DataRateWise_mstaff->cus_service_understandable_rate5 && $DataRateWise_mstaff->cus_service_understandable_rate5>0)?round(($DataRateWise_mstaff->cus_service_understandable_rate5/$total_cus_service_understandable_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_understandable1; ?>%" class="bar-1" style="width: <?php echo $cus_service_understandable1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_understandable2; ?>%" class="bar-2" style="width: <?php echo $cus_service_understandable2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_understandable3; ?>%" class="bar-3" style="width: <?php echo $cus_service_understandable3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_understandable4; ?>%" class="bar-4" style="width: <?php echo $cus_service_understandable4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_understandable5; ?>%" class="bar-5" style="width: <?php echo $cus_service_understandable5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_cus_service_understandable=($DataRateWise_mstaff->total_cus_service_understandable>0)?round(($DataRateWise_mstaff->sum_cus_service_understandable/$DataRateWise_mstaff->total_cus_service_understandable),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_cus_service_understandable; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_cus_service_prompt_sum=$DataRateWise_mstaff->cus_service_prompt_rate1+$DataRateWise_mstaff->cus_service_prompt_rate2+$DataRateWise_mstaff->cus_service_prompt_rate3+$DataRateWise_mstaff->cus_service_prompt_rate4+$DataRateWise_mstaff->cus_service_prompt_rate5;
        $cus_service_prompt1=($DataRateWise_mstaff->cus_service_prompt_rate1 && $DataRateWise_mstaff->cus_service_prompt_rate1>0)?round(($DataRateWise_mstaff->cus_service_prompt_rate1/$total_cus_service_prompt_sum)*100,2):0; 
        $cus_service_prompt2=($DataRateWise_mstaff->cus_service_prompt_rate2 && $DataRateWise_mstaff->cus_service_prompt_rate2>0)?round(($DataRateWise_mstaff->cus_service_prompt_rate2/$total_cus_service_prompt_sum)*100,2):0; 
        $cus_service_prompt3=($DataRateWise_mstaff->cus_service_prompt_rate3 && $DataRateWise_mstaff->cus_service_prompt_rate3>0)?round(($DataRateWise_mstaff->cus_service_prompt_rate3/$total_cus_service_prompt_sum)*100,2):0; 
        $cus_service_prompt4=($DataRateWise_mstaff->cus_service_prompt_rate4 && $DataRateWise_mstaff->cus_service_prompt_rate4>0)?round(($DataRateWise_mstaff->cus_service_prompt_rate4/$total_cus_service_prompt_sum)*100,2):0; 
        $cus_service_prompt5=($DataRateWise_mstaff->cus_service_prompt_rate5 && $DataRateWise_mstaff->cus_service_prompt_rate5>0)?round(($DataRateWise_mstaff->cus_service_prompt_rate5/$total_cus_service_prompt_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_prompt1; ?>%" class="bar-1" style="width: <?php echo $cus_service_prompt1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_prompt2; ?>%" class="bar-2" style="width: <?php echo $cus_service_prompt2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_prompt3; ?>%" class="bar-3" style="width: <?php echo $cus_service_prompt3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_prompt4; ?>%" class="bar-4" style="width: <?php echo $cus_service_prompt4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $cus_service_prompt5; ?>%" class="bar-5" style="width: <?php echo $cus_service_prompt5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_cus_service_prompt=($DataRateWise_mstaff->total_cus_service_prompt>0)?round(($DataRateWise_mstaff->sum_cus_service_prompt/$DataRateWise_mstaff->total_cus_service_prompt),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_cus_service_prompt; ?></div> 
	</div>
</div>

</div>
</div>
<!--End Customer service-->


<!--Call Centre-->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Call Centre:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The prompt and willingness to support:</div>
	<div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.Clear and understandable consultant:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The voice and attitude when communicating:</div>
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_call_centre_prompt_sum=$DataRateWise_mstaff->call_centre_prompt_rate1+$DataRateWise_mstaff->call_centre_prompt_rate2+$DataRateWise_mstaff->call_centre_prompt_rate3+$DataRateWise_mstaff->call_centre_prompt_rate4+$DataRateWise_mstaff->call_centre_prompt_rate5;
        $call_centre_prompt1=($DataRateWise_mstaff->call_centre_prompt_rate1 && $DataRateWise_mstaff->call_centre_prompt_rate1>0)?round(($DataRateWise_mstaff->call_centre_prompt_rate1/$total_call_centre_prompt_sum)*100,2):0; 
        $call_centre_prompt2=($DataRateWise_mstaff->call_centre_prompt_rate2 && $DataRateWise_mstaff->call_centre_prompt_rate2>0)?round(($DataRateWise_mstaff->call_centre_prompt_rate2/$total_call_centre_prompt_sum)*100,2):0; 
        $call_centre_prompt3=($DataRateWise_mstaff->call_centre_prompt_rate3 && $DataRateWise_mstaff->call_centre_prompt_rate3>0)?round(($DataRateWise_mstaff->call_centre_prompt_rate3/$total_call_centre_prompt_sum)*100,2):0; 
        $call_centre_prompt4=($DataRateWise_mstaff->call_centre_prompt_rate4 && $DataRateWise_mstaff->call_centre_prompt_rate4>0)?round(($DataRateWise_mstaff->call_centre_prompt_rate4/$total_call_centre_prompt_sum)*100,2):0; 
        $call_centre_prompt5=($DataRateWise_mstaff->call_centre_prompt_rate5 && $DataRateWise_mstaff->call_centre_prompt_rate5>0)?round(($DataRateWise_mstaff->call_centre_prompt_rate5/$total_call_centre_prompt_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $call_centre_prompt1; ?>%" class="bar-1" style="width: <?php echo $call_centre_prompt1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $call_centre_prompt2; ?>%" class="bar-2" style="width: <?php echo $call_centre_prompt2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $call_centre_prompt3; ?>%" class="bar-3" style="width: <?php echo $call_centre_prompt3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $call_centre_prompt4; ?>%" class="bar-4" style="width: <?php echo $call_centre_prompt4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $call_centre_prompt5; ?>%" class="bar-5" style="width: <?php echo $call_centre_prompt5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_call_centre_prompt=($DataRateWise_mstaff->total_call_centre_prompt>0)?round(($DataRateWise_mstaff->sum_call_centre_prompt/$DataRateWise_mstaff->total_call_centre_prompt),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_call_centre_prompt; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_call_centre_understandable_sum=$DataRateWise_mstaff->call_centre_understandable_rate1+$DataRateWise_mstaff->call_centre_understandable_rate2+$DataRateWise_mstaff->call_centre_understandable_rate3+$DataRateWise_mstaff->call_centre_prompt_rate4+$DataRateWise_mstaff->call_centre_prompt_rate5;
        $call_centre_understandable1=($DataRateWise_mstaff->call_centre_understandable_rate1 && $DataRateWise_mstaff->call_centre_understandable_rate1>0)?round(($DataRateWise_mstaff->call_centre_understandable_rate1/$total_call_centre_understandable_sum)*100,2):0; 
        $call_centre_understandable2=($DataRateWise_mstaff->call_centre_understandable_rate2 && $DataRateWise_mstaff->call_centre_understandable_rate2>0)?round(($DataRateWise_mstaff->call_centre_understandable_rate2/$total_call_centre_understandable_sum)*100,2):0; 
        $call_centre_understandable3=($DataRateWise_mstaff->call_centre_understandable_rate3 && $DataRateWise_mstaff->call_centre_understandable_rate3>0)?round(($DataRateWise_mstaff->call_centre_understandable_rate3/$total_call_centre_understandable_sum)*100,2):0; 
        $call_centre_understandable4=($DataRateWise_mstaff->call_centre_understandable_rate4 && $DataRateWise_mstaff->call_centre_understandable_rate4>0)?round(($DataRateWise_mstaff->call_centre_understandable_rate4/$total_call_centre_understandable_sum)*100,2):0; 
        $call_centre_understandable5=($DataRateWise_mstaff->call_centre_understandable_rate5 && $DataRateWise_mstaff->call_centre_understandable_rate5>0)?round(($DataRateWise_mstaff->call_centre_understandable_rate5/$total_call_centre_understandable_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_understandable1; ?>%" class="bar-1" style="width: <?php echo $call_centre_understandable1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_understandable2; ?>%" class="bar-2" style="width: <?php echo $call_centre_understandable2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_understandable3; ?>%" class="bar-3" style="width: <?php echo $call_centre_understandable3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_understandable4; ?>%" class="bar-4" style="width: <?php echo $call_centre_understandable4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_understandable5; ?>%" class="bar-5" style="width: <?php echo $call_centre_understandable5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_call_centre_understandable=($DataRateWise_mstaff->total_call_centre_understandable>0)?round(($DataRateWise_mstaff->sum_call_centre_understandable/$DataRateWise_mstaff->total_call_centre_understandable),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_call_centre_understandable; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_call_centre_voice_sum=$DataRateWise_mstaff->call_centre_voice_rate1+$DataRateWise_mstaff->call_centre_voice_rate2+$DataRateWise_mstaff->call_centre_voice_rate3+$DataRateWise_mstaff->call_centre_voice_rate4+$DataRateWise_mstaff->call_centre_voice_rate5;
        $call_centre_voice1=($DataRateWise_mstaff->call_centre_voice_rate1 && $DataRateWise_mstaff->call_centre_voice_rate1>0)?round(($DataRateWise_mstaff->call_centre_voice_rate1/$total_call_centre_voice_sum)*100,2):0; 
        $call_centre_voice2=($DataRateWise_mstaff->call_centre_voice_rate2 && $DataRateWise_mstaff->call_centre_voice_rate2>0)?round(($DataRateWise_mstaff->call_centre_voice_rate2/$total_call_centre_voice_sum)*100,2):0; 
        $call_centre_voice3=($DataRateWise_mstaff->call_centre_voice_rate3 && $DataRateWise_mstaff->call_centre_voice_rate3>0)?round(($DataRateWise_mstaff->call_centre_voice_rate3/$total_call_centre_voice_sum)*100,2):0; 
        $call_centre_voice4=($DataRateWise_mstaff->call_centre_voice_rate4 && $DataRateWise_mstaff->call_centre_voice_rate4>0)?round(($DataRateWise_mstaff->call_centre_voice_rate4/$total_call_centre_voice_sum)*100,2):0; 
        $call_centre_voice5=($DataRateWise_mstaff->call_centre_voice_rate5 && $DataRateWise_mstaff->call_centre_voice_rate5>0)?round(($DataRateWise_mstaff->call_centre_voice_rate5/$total_call_centre_voice_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_voice1; ?>%" class="bar-1" style="width: <?php echo $call_centre_voice1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_voice2; ?>%" class="bar-2" style="width: <?php echo $call_centre_voice2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_voice3; ?>%" class="bar-3" style="width: <?php echo $call_centre_voice3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_voice4; ?>%" class="bar-4" style="width: <?php echo $call_centre_voice4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $call_centre_voice5; ?>%" class="bar-5" style="width: <?php echo $call_centre_voice5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_call_centre_voice=($DataRateWise_mstaff->total_call_centre_voice>0)?round(($DataRateWise_mstaff->sum_call_centre_voice/$DataRateWise_mstaff->total_call_centre_voice),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_call_centre_voice; ?></div> 
	</div>
</div>

</div>
</div>
<!--End Call Centre-->




<!--Pharmacist-->
<div class="row" style="border: 1px solid #d3d3d3;padding: 6px;">
    <div class="col-md-6">
	<div style="font-size: 16px;font-weight: 700;color:#000;">Pharmacist:</div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">1.The attitude and behavior of staff:</div>
	<div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">2.Clear and understandable consultant:</div>
        <div class="row" style="height:7px;"></div>
	<div style="text-align: left;margin-bottom: 2px;font-size: 15px;color: #000;">3.The prompt and willingness to support:</div>
    </div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12" style="display: flex;">
			<div class="col-md-2 outatar">
				<div class="bar-1s"></div>&nbsp; 1 Star
			</div>
			<div class="col-md-2 outatar">
				<div class="bar-2s"></div>&nbsp; 2 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-3s"></div>&nbsp; 3 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-4s"></div>&nbsp; 4 Stars
			</div>
			<div class="col-md-2 outatar" >
				<div class="bar-5s"></div>&nbsp; 5 Stars
			</div>
			<div class="col-md-2" >
				<div class="" style="margin-left: 3px;text-align: center;background: #4472c4;color: #fff;">Avg:</div> 
			</div>
		</div>
	</div>
</div>
<div class="row" style="background: #ececec;height: 19px;">
        <?php $total_pharmacist_attitude_sum=$DataRateWise_mstaff->pharmacist_attitude_rate1+$DataRateWise_mstaff->pharmacist_attitude_rate2+$DataRateWise_mstaff->pharmacist_attitude_rate3+$DataRateWise_mstaff->pharmacist_attitude_rate4+$DataRateWise_mstaff->pharmacist_attitude_rate5;
        $pharmacist_attitude1=($DataRateWise_mstaff->pharmacist_attitude_rate1 && $DataRateWise_mstaff->pharmacist_attitude_rate1>0)?round(($DataRateWise_mstaff->pharmacist_attitude_rate1/$total_pharmacist_attitude_sum)*100,2):0; 
        $pharmacist_attitude2=($DataRateWise_mstaff->pharmacist_attitude_rate2 && $DataRateWise_mstaff->pharmacist_attitude_rate2>0)?round(($DataRateWise_mstaff->pharmacist_attitude_rate2/$total_pharmacist_attitude_sum)*100,2):0; 
        $pharmacist_attitude3=($DataRateWise_mstaff->pharmacist_attitude_rate3 && $DataRateWise_mstaff->pharmacist_attitude_rate3>0)?round(($DataRateWise_mstaff->pharmacist_attitude_rate3/$total_pharmacist_attitude_sum)*100,2):0; 
        $pharmacist_attitude4=($DataRateWise_mstaff->pharmacist_attitude_rate4 && $DataRateWise_mstaff->pharmacist_attitude_rate4>0)?round(($DataRateWise_mstaff->pharmacist_attitude_rate4/$total_pharmacist_attitude_sum)*100,2):0; 
        $pharmacist_attitude5=($DataRateWise_mstaff->pharmacist_attitude_rate5 && $DataRateWise_mstaff->pharmacist_attitude_rate5>0)?round(($DataRateWise_mstaff->pharmacist_attitude_rate5/$total_pharmacist_attitude_sum)*100,2):0; ?>
    <div class="col-md-2 boright"><div title="<?php echo $pharmacist_attitude1; ?>%" class="bar-1" style="width: <?php echo $pharmacist_attitude1; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $pharmacist_attitude2; ?>%" class="bar-2" style="width: <?php echo $pharmacist_attitude2; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $pharmacist_attitude3; ?>%" class="bar-3" style="width: <?php echo $pharmacist_attitude3; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $pharmacist_attitude4; ?>%" class="bar-4" style="width: <?php echo $pharmacist_attitude4; ?>%;"></div></div>
    <div class="col-md-2 boright"><div title="<?php echo $pharmacist_attitude5; ?>%" class="bar-5" style="width: <?php echo $pharmacist_attitude5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_pharmacist_attitude=($DataRateWise_mstaff->total_pharmacist_attitude>0)?round(($DataRateWise_mstaff->sum_pharmacist_attitude/$DataRateWise_mstaff->total_pharmacist_attitude),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_pharmacist_attitude; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_pharmacist_understandable_sum=$DataRateWise_mstaff->pharmacist_understandable_rate1+$DataRateWise_mstaff->pharmacist_understandable_rate2+$DataRateWise_mstaff->pharmacist_understandable_rate3+$DataRateWise_mstaff->pharmacist_understandable_rate4+$DataRateWise_mstaff->pharmacist_understandable_rate5;
        $pharmacist_understandable1=($DataRateWise_mstaff->pharmacist_understandable_rate1 && $DataRateWise_mstaff->pharmacist_understandable_rate1>0)?round(($DataRateWise_mstaff->pharmacist_understandable_rate1/$total_pharmacist_understandable_sum)*100,2):0; 
        $pharmacist_understandable2=($DataRateWise_mstaff->pharmacist_understandable_rate2 && $DataRateWise_mstaff->pharmacist_understandable_rate2>0)?round(($DataRateWise_mstaff->pharmacist_understandable_rate2/$total_pharmacist_understandable_sum)*100,2):0; 
        $pharmacist_understandable3=($DataRateWise_mstaff->pharmacist_understandable_rate3 && $DataRateWise_mstaff->pharmacist_understandable_rate3>0)?round(($DataRateWise_mstaff->pharmacist_understandable_rate3/$total_pharmacist_understandable_sum)*100,2):0; 
        $pharmacist_understandable4=($DataRateWise_mstaff->pharmacist_understandable_rate4 && $DataRateWise_mstaff->pharmacist_understandable_rate4>0)?round(($DataRateWise_mstaff->pharmacist_understandable_rate4/$total_pharmacist_understandable_sum)*100,2):0; 
        $pharmacist_understandable5=($DataRateWise_mstaff->pharmacist_understandable_rate5 && $DataRateWise_mstaff->pharmacist_understandable_rate5>0)?round(($DataRateWise_mstaff->pharmacist_understandable_rate5/$total_pharmacist_understandable_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_understandable1; ?>%" class="bar-1" style="width: <?php echo $pharmacist_understandable1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_understandable2; ?>%" class="bar-2" style="width: <?php echo $pharmacist_understandable2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_understandable3; ?>%" class="bar-3" style="width: <?php echo $pharmacist_understandable3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_understandable4; ?>%" class="bar-4" style="width: <?php echo $pharmacist_understandable4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_understandable5; ?>%" class="bar-5" style="width: <?php echo $pharmacist_understandable5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_pharmacist_understandable=($DataRateWise_mstaff->total_pharmacist_understandable>0)?round(($DataRateWise_mstaff->sum_pharmacist_understandable/$DataRateWise_mstaff->total_pharmacist_understandable),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #e9ebf5;color: #000;"><?php echo $overall_pharmacist_understandable; ?></div> 
	</div>
</div>
<div class="row" style="height:10px;"></div>
<div class="row" style="background: #ececec;height: 19px;">
    <?php $total_pharmacist_prompt_sum=$DataRateWise_mstaff->pharmacist_prompt_rate1+$DataRateWise_mstaff->pharmacist_prompt_rate2+$DataRateWise_mstaff->pharmacist_prompt_rate3+$DataRateWise_mstaff->pharmacist_prompt_rate4+$DataRateWise_mstaff->pharmacist_prompt_rate5;
        $pharmacist_prompt1=($DataRateWise_mstaff->pharmacist_prompt_rate1 && $DataRateWise_mstaff->pharmacist_prompt_rate1>0)?round(($DataRateWise_mstaff->pharmacist_prompt_rate1/$total_pharmacist_prompt_sum)*100,2):0; 
        $pharmacist_prompt2=($DataRateWise_mstaff->pharmacist_prompt_rate2 && $DataRateWise_mstaff->pharmacist_prompt_rate2>0)?round(($DataRateWise_mstaff->pharmacist_prompt_rate2/$total_pharmacist_prompt_sum)*100,2):0; 
        $pharmacist_prompt3=($DataRateWise_mstaff->pharmacist_prompt_rate3 && $DataRateWise_mstaff->pharmacist_prompt_rate3>0)?round(($DataRateWise_mstaff->pharmacist_prompt_rate3/$total_pharmacist_prompt_sum)*100,2):0; 
        $pharmacist_prompt4=($DataRateWise_mstaff->pharmacist_prompt_rate4 && $DataRateWise_mstaff->pharmacist_prompt_rate4>0)?round(($DataRateWise_mstaff->pharmacist_prompt_rate4/$total_pharmacist_prompt_sum)*100,2):0; 
        $pharmacist_prompt5=($DataRateWise_mstaff->pharmacist_prompt_rate5 && $DataRateWise_mstaff->pharmacist_prompt_rate5>0)?round(($DataRateWise_mstaff->pharmacist_prompt_rate5/$total_pharmacist_prompt_sum)*100,2):0; ?>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_prompt1; ?>%" class="bar-1" style="width: <?php echo $pharmacist_prompt1; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_prompt2; ?>%" class="bar-2" style="width: <?php echo $pharmacist_prompt2; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_prompt3; ?>%" class="bar-3" style="width: <?php echo $pharmacist_prompt3; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_prompt4; ?>%" class="bar-4" style="width: <?php echo $pharmacist_prompt4; ?>%;"></div></div>
	<div class="col-md-2 boright"><div title="<?php echo $pharmacist_prompt5; ?>%" class="bar-5" style="width: <?php echo $pharmacist_prompt5; ?>%;"></div></div>
	<div class="col-md-2" style="background: #f5f7fa;">
            <?php $overall_pharmacist_prompt_prompt=($DataRateWise_mstaff->total_pharmacist_prompt>0)?round(($DataRateWise_mstaff->sum_pharmacist_prompt/$DataRateWise_mstaff->total_pharmacist_prompt),2):0; ?>
		<div class="" style="margin-right: 6px;text-align: center;background: #cfd5ea;color: #000;"><?php echo $overall_pharmacist_prompt_prompt; ?></div> 
	</div>
</div>

</div>
</div>
<!--End Pharmacist-->
</main>
<?php   
        $total_patient=count($details);
        $excellent_totalH=0;
        $verygood_totalH=0;
        $good_totalH=0;
        $fair_totalH=0;
        $poor_totalH=0;

        $excellent_totalC=0;
        $verygood_totalC=0;
        $good_totalC=0;
        $fair_totalC=0;
        $poor_totalC=0;
    $i=0; //print_r($details);die;
    if($details && count($details)>0){
    foreach($details as $data){ 
            switch($data->checkup_rate){
                case 5:
                    $excellent_totalC++;
                    break;
                case 4:
                    $verygood_totalC++;
                    break;
                case 3:
                    $good_totalC++;
                    break;
                case 2:
                    $fair_totalC++;
                    break;
                case 1:
                    $poor_totalC++;
                    break;
                default:
                    break;
            }
            switch($data->hospital_rate){
                case 5:
                    $excellent_totalH++;
                    break;
                case 4:
                    $verygood_totalH++;
                    break;
                case 3:
                    $good_totalH++;
                    break;
                case 2:
                    $fair_totalH++;
                    break;
                case 1:
                    $poor_totalH++;
                    break;
                default:
                    break;
            }
    }
    }
    ?>
<?php 
        //Hospital rate
        $excellentHper=($excellent_totalH>0)?round(($excellent_totalH/$total_patient)*100,0):''; 
        $verygoodHper=($verygood_totalH>0)?round(($verygood_totalH/$total_patient)*100,0):''; 
        $goodHper=($good_totalH>0)?round(($good_totalH/$total_patient)*100,0):''; 
        $fairHper=($fair_totalH>0)?round(($fair_totalH/$total_patient)*100,0):''; 
        $poorHper=($poor_totalH>0)?round(($poor_totalH/$total_patient)*100,0):'';
        //Check up rate
        $excellentCper=($excellent_totalC>0)?round(($excellent_totalC/$total_patient)*100,0):''; 
        $verygoodCper=($verygood_totalC>0)?round(($verygood_totalC/$total_patient)*100,0):''; 
        $goodCper=($good_totalC>0)?round(($good_totalC/$total_patient)*100,0):''; 
        $fairCper=($fair_totalC>0)?round(($fair_totalC/$total_patient)*100,0):''; 
        $poorCper=($poor_totalC>0)?round(($poor_totalC/$total_patient)*100,0):'';

?>
<!--Start footer-->
<div style="position:relative">
<?=$footer;?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
 <script>
              new Chart(document.getElementById("pieChart"),
              {"type":"pie","data":{"labels":["Parking", "Luggage Support", "Restaurent", "In-Patients"],
              "datasets":[{"label":"My First Dataset","data":[<?=$parkingPer?>, <?=$luggagePer?>, <?=$restaurantPer?>, <?=$inpatientPer?>],
              "backgroundColor":["#4472C4","#ED7E33","#A5A5A5","#FFC000"]}]}});

              new Chart(document.getElementById("pieChart2"),
              {"type":"pie","data":{"labels":["Doctor", "Nurse", "Customer Service", "Call center", "Pharmacist"],
              "datasets":[{"label":"My First Dataset","data":[<?=$doctorPer?>, <?=$nursePer?>, <?=$cus_servicePer?>, <?=$call_centrePer?>, <?=$pharmacistPer?>],
              "backgroundColor":["#4472C4","#ED7E33","#A5A5A5","#FFC000","#5B9BD5"]}]}});
</script>
            
<script>
              new Chart(document.getElementById("doughnutChart"),
              {"type":"doughnut","data":{"labels":["Promoter (9+10)", "Neutral(7+8)", "Detractor(0-6)"],
              "datasets":[{"label":"My First Dataset","data":[8,4,1],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)",
              "rgba(77, 175, 124, 1)"]}]}});
</script>
<script>
    $(document).on('click','.hideshow',function(){
        var ths=$(this);
        var is_show=$(this).attr('is_show'); 
        var id=$(this).attr('idd'); 
        var title='Hide / Show confirmation',message='',action='',btnmsg='',hide_show='';
        if(is_show==1){
            action='hide';
            btnmsg='Show';
            hide_show=0;
            message='Do you really want ot hide this suggestion!';
        }else{
            action='show';
            btnmsg='Hide';
            hide_show=1;
            message='Do you really want ot Show this suggestion!';
        }
       confirm_boot(title,message,function(result) {
                if(result){
                    $.post(BASE_URL+"customer_feedback/"+action,{id:id},function(data){
                            if(data){
                            var dt=JSON.parse(data);
                            if(dt.status>0){
                                bootbox.alert({
                                            message: dt.msg,
                                        });
                                ths.text(btnmsg);
                                ths.attr('is_show',hide_show);

                            }else{
                                 bootbox.alert({
                                            message: dt.msg,
                                        });
                            }
                            }
                    });
                }
            });
    })
</script>
<!--End footer-->