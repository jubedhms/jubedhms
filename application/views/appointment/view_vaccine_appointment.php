<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->ID))?$details->ID:""; 
?>

<!-- Start page-->

<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
	<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">Manage <?=$heading;?></a>
			</li>
			<li class="breadcrumb-item active"><?= $mode.' '.$heading; ?></li>
			</ol>
		</div>
	<!-- /.page-title-right -->
	</div>
	<!-- /.page-title -->
	<!-- =================================== -->
	<!-- Different data widgets ============ -->
	<!-- =================================== -->

	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
	
	<div class="widget-list">
	<div class="row">
	<div class="col-md-12 widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
					<label for="prn" class="">Patient Name *</label>
    				<select class="form-control" id="prn" name="prn" required="required" data-rule-required="true" data-msg-required="Please select Patient.">
						<option value="">Select</option>
						<?php 
							if(isset($details->parent_prn) && $details->parent_prn!=''){
								if($sub_patients && count($sub_patients)>0){
								foreach($sub_patients as $patient){
						?>
							<option value="<?=$patient->prn;?>" <?=($patient->prn==getFieldVal('prn',$details))?"selected":"";?>><?=$patient->name;?></option>
						<?php	
								}}
							}else{
								if($patients && count($patients)>0){
								foreach($patients as $patient){	
						?>
							<option value="<?=$patient->prn;?>" <?=($patient->prn==getFieldVal('prn',$details))?"selected":"";?>><?=$patient->name;?></option>		
							<?php }}}?>
					</select> 
				</div>
			</div>	
			
			<div class="col-md-6">
				<div class="form-group">
					<label for="parent_prn" class="">Patient Parent Name </label>
    				<select class="form-control" id="parent_prn" name="parent_prn">
						<option value="">Select</option>
						<?php
							if(isset($details->parent_prn) && $details->parent_prn!=''){
								if($patients && count($patients)>0){
								foreach($patients as $patient){
						?>
							<option value="<?=$patient->prn;?>" <?=($patient->prn==getFieldVal('parent_prn',$details))?"selected":"";?>><?=$patient->name;?></option>
							<?php }}}?>
					</select> 
				</div>
			</div>
		</div>						

         
        <div class="row">
			<div class="col-md-6">
    			<div class="form-group">
					<label for="hospital_location_id" class="">Hospital Location *</label>
    				<select class="form-control" id="hospital_location_id" name="hospital_location_id" required="required" data-rule-required="true" data-msg-required="Please select Hospital location.">
					<option value="">Select</option>
						<?php 
							if($hospitalLocations && count($hospitalLocations)>0){
							foreach($hospitalLocations as $location){
						?>
							<option value="<?=$location->ID;?>" <?=($location->ID==getFieldVal('hospital_location_id',$details))?"selected":"";?>><?=$location->name;?></option>
						<?php }}?>
					</select>
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
				<label for="appointment_type_id" class="">Appointment type *</label>
					<select class="form-control" id="appointment_type_id" name="appointment_type_id" required="required" data-rule-required="true" data-msg-required="Please select appointment type.">
						<option value="">Select</option>
						<option value="1" <?= (getFieldVal('appointment_type_id',$details)=='1')?"selected":"";?>>New Checkup</option>
						<option value="2" <?= (getFieldVal('appointment_type_id',$details)=='2')?"selected":"";?>>Revisit Checkup</option>
						<option value="3" <?= (getFieldVal('appointment_type_id',$details)=='3')?"selected":"";?>>Vaccine Checkup</option>
					</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
    			<div class="form-group">
    				<label for="doctor_id" class="">doctor Speciality *</label>
    				<select class="form-control" id="doctor_id" name="doctor_id" required="required" data-rule-required="true" data-msg-required="Please select Doctor Speciality.">
						<option value="">Select</option>
						<?php 
							if($doctorSpecializations && count($doctorSpecializations)>0){
							foreach($doctorSpecializations as $speciality){
						?>
							<option value="<?=$speciality->code;?>" <?=($speciality->code==getFieldVal('doctor_speciality_code',$details))?"selected":"";?>><?=$speciality->name;?></option>
						<?php }}?>
					</select>
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
    		</div>

			<div class="col-md-6">
    			<div class="form-group">
    				<label for="doctor_mcr" class="">Doctor *</label>
    				<select class="form-control" id="doctor_mcr" name="doctor_mcr" required="required" data-rule-required="true" data-msg-required="Please select Doctor.">
						<option value="">Select</option>
						<?php 
							if($doctors && count($doctors)>0){
							foreach($doctors as $doctor){
						?>
							<option value="<?=$doctor->mcr;?>" <?=($doctor->mcr==getFieldVal('doctor_mcr',$details))?"selected":"";?>><?=$doctor->first_name.' '.$doctor->last_name.' '.$doctor->last_name;?></option>
						<?php }}?>
					</select>
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
    		</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
    			<div class="form-group">
    				<label for="vaccine_id" class="">Vaccine Name*</label>
    				<select class="form-control" id="vaccine_id" name="vaccine_id" required="required" data-rule-required="true" data-msg-required="Please select Vaccine.">
						<option value="">Select</option>
						<?php 
							if($vaccinations && count($vaccinations)>0){
							foreach($vaccinations as $vaccination){
						?>
							<option value="<?=$vaccination->ID;?>" <?=($vaccination->ID==getFieldVal('vaccine_id',$details))?"selected":"";?>><?=$vaccination->vaccine_name;?></option>
						<?php }}?>
					</select>
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
    		</div>

			<div class="col-md-6">
    			<div class="form-group">
    				<label for="dose_id" class="">Dose Name*</label>
    				<select class="form-control" id="dose_id" name="dose_id" required="required" data-rule-required="true" data-msg-required="Please select Vaccine Dose.">
						<option value="">Select</option>
						<?php 
							if($vaccie_doses && count($vaccie_doses)>0){
							foreach($vaccie_doses as $vaccie_dose){
						?>
							<option value="<?=$vaccie_dose->ID;?>" <?=($vaccie_dose->ID==getFieldVal('dose_id',$details))?"selected":"";?>><?=$vaccie_dose->dose_name;?></option>
						<?php }}?>
					</select>
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
    		</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="booking_date" class="">Booking Date *</label>
                    <input id="booking_date" name="booking_date" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->booking_date)?date('Y-m-d',strtotime($details->booking_date)):date('Y-m-d');?>"
					data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' 
					data-rule-required="true" data-msg-required="Please select date Of booking.">
 
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="booking_time" class="">Booking Time *</label>
                    <input id="booking_time" name="booking_time" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->booking_time)?date('h:i A',strtotime($details->booking_time)):date('h:i A');?>"
					data-plugin-options='{"autoclose": true,"format": "h:i A"}' 
					data-rule-required="true" data-msg-required="Please select time Of booking.">
 
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="appointment_date" class="">Appointment Date *</label>
                    <input id="appointment_date" name="appointment_date" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->appointment_date)?date('Y-m-d',strtotime($details->appointment_date)):date('Y-m-d');?>"
					data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' 
					data-rule-required="true" data-msg-required="Please input date Of appointment.">
 
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="appointment_time" class="">Appointment Time *</label>
					<input id="appointment_time" name="appointment_time" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->appointment_time)?date('h:i A',strtotime($details->appointment_time)):date('h:i A');?>"
					data-plugin-options='{"autoclose": true,"format": "h:i A"}' 
					data-rule-required="true" data-msg-required="Please select time Of appointment.">
 
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			
		</div>
		
        <div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="description" class="">Description</label>
					<textarea name="description" class="form-control" rows="5" placeholder=""><?=getFieldVal('description',$details)?></textarea>

 				</div>
			</div>
		</div>	    
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
 					<!--<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
					<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
					</div>
				</div>
			</div>
		</div>

		
	</div>
	</div>
	</div>
	
	 
	
	
	
	
	
	
	</div>
	</div>
	</form>
	
	
	
	 
	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>



<script>
$('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');
</script>