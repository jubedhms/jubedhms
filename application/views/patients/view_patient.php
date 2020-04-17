<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->patient_id))?$details->patient_id:""; 
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
			<li class="breadcrumb-item"><a href="<?= $main_page;?>"><?= $mode.' '.$heading; ?></a>
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
							<div class="col-md-9 widget-holder">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="hidden" name="ID" id="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
											<label for="user_name" class="">Username *</label>
											<input type="text" class="form-control" name="user_name" id="user_name"  value="<?= getFieldVal('username',$details);?>" <?=(getFieldVal('username',$details)!='')?"disabled":""?> autocomplete="off" required="required" data-rule-required="true" data-msg-required="Please include your Username">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="prn" class="">PRN *</label>
											<input type="text" class="form-control" id="prn" name="prn" value="<?= getFieldVal('prn',$details);?>" data-rule-required="true" data-msg-required="Please include your PRN">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="title" class="">Title *</label>
											<select class="form-control" id="title" name="title" required="required" data-rule-required="true" data-msg-required="Please select Title.">
												<option value="">Select</option>
												<?php 
													$titles=array('Mr','Mrs','Miss','Ms','Dr','Prof','Rev','Other');
													if($titles && count($titles)>0){
													foreach($titles as $title){
												?>
													<option value="<?=$title;?>" <?=($title==getFieldVal('title',$details))?"selected":"";?>><?=$title;?></option>
												<?php }}?>
											</select>
											
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name" class="">First name *</label>
											<input type="text" class="form-control" id="first_name" name="first_name" value="<?= getFieldVal('first_name',$details);?>" data-rule-required="true" data-msg-required="Please include your First Name">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
								</div>
								
								<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label for="middle_name" class="">Middle name</label>
											<input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= getFieldVal('middle_name',$details);?>">
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name" class="">Last name</label>
											<input type="text" class="form-control" id="last_name" name="last_name" value="<?= getFieldVal('last_name',$details);?>">
										</div>
									</div>
								</div>
							
							</div>
							
							<!-- Start upload Image-->
							<div class="col-md-3 widget-holder">
								<div class="widget-bg">
									<div class="widget-body---">
										<div class="col-md-12">
											<div class="blog-post blog-post-card text-center">
												<figure id="user_image" style="height:185px;">
													<a href="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" class="image-lightbox" id="image-lightbox" title="" data-toggle="lightbox" data-type="image" style="cursor:zoom-in;">	
														<img class="view_image" src="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" style="height:100%;width:100%;object-fit:contain;" title="Click here for zoom image.">
													</a>	
												</figure>
												<header style="padding-left:0.5em !important;">	
													
												</header>
											</div>	
										</div>
									</div>
								</div>
							</div>
							<!-- End upload Image-->
						</div>
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="patient_group" class="">Customer Group </label>
									<select class="form-control" id="patient_group" name="patient_group" required="required" data-rule-required="true" data-msg-required="Please select customer group.">
										<option value="">Select</option>
										<?php 
											$patient_group=array('All','Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
											if($patient_group && count($patient_group)>0){
												$i=0;
											foreach($patient_group as $patient_group){
										?>
											<option value="<?=$i;?>" <?=($i==getFieldVal('patient_group',$details))?"selected":"";?>><?=$patient_group; ?></option>
										<?php $i++; }}?>
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="email_id" class="">Email address *</label>
									<input type="email" class="form-control" id="email_id" name="email_id" value="<?= getFieldVal('email_id',$details);?>" autocomplete="off" data-rule-required="true" data-msg-required="Please include your Email address">
									<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="contact_number" class="">Contact number  *</label>
								<input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= getFieldVal('contact_number',$details);?>" size="10" minlength="9" maxlength="10" required="required" autocomplete="off" data-rule-required="true" data-msg-required="Please input contact number.">
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>
									</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="gender" class="">Gender *</label>
									<select class="form-control" id="gender" name="gender" required="required" data-rule-required="true" data-msg-required="Please select gender.">
										<option value="">Select</option>
										<option value="1" <?= (getFieldVal('gender',$details)=='1')?"selected":"";?>>Male</option>
										<option value="2" <?= (getFieldVal('gender',$details)=='2')?"selected":"";?>>Female</option>
										<option value="3" <?= (getFieldVal('gender',$details)=='3')?"selected":"";?>>Other</option>
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div> 	
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="dob" class="">DOB *</label>
									<input id="dob" name="dob" class="form-control datepicker" required="required" type="text" value="<?=(isset($details->dob) && $details->dob!='0000-00-00')?date('Y-m-d',strtotime($details->dob)):'';?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","endDate":"<?=date('Y-m-d');?>"}' data-rule-required="true" data-msg-required="Please select Date Of Birth.">
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span> 
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="blood_group" class="">Blood Group *</label>
									<select class="form-control" id="blood_group" name="blood_group" required="required" data-rule-required="true" data-msg-required="Please select Blood group.">
										<option value="">Select</option>
										<?php 
											$blood_groups=array('A+','AB+','O+','AB','B+','A-','b-','O-');
											if($blood_groups && count($blood_groups)>0){
											foreach($blood_groups as $blood_group){
										?>
											<option value="<?=$blood_group;?>" <?=($blood_group==getFieldVal('blood_group',$details))?"selected":"";?>><?=$blood_group;?></option>
										<?php }}?>
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						</div>  
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="country_code" class="">Country Name *</label>
									<select class="form-control" id="country_code" name="country_code" required="required" data-rule-required="true" data-msg-required="Please select gender.">
										<option value="">Select</option>
										<?php foreach($countries as $rowc){ ?>
											<option value="<?=$rowc->ID; ?>" <?= (getFieldVal('country_code',$details)==$rowc->ID)?"selected":"";?>> <?=$rowc->name; ?></option>
										<?php } ?>
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="city_code" class="">City Name *</label>
									<select class="form-control" id="city_code" name="city_code" required="required" data-rule-required="true" data-msg-required="Please select gender.">
										<option value="">Select</option>
										<?php foreach($cities as $row){ ?>
											<option value="<?=$row->ID; ?>" <?= (getFieldVal('city_code',$details)==$row->ID)?"selected":"";?>> <?=$row->name; ?></option>
										<?php } ?>
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="district_code" class="">District Name *</label>
									<select class="form-control" id="district_code" name="district_code" required="required" data-rule-required="true" data-msg-required="Please select gender.">
										<option value="">Select</option>
										<?php foreach($districts as $row){ ?>
											<option value="<?=$row->ID; ?>" <?= (getFieldVal('district_code',$details)==$row->ID)?"selected":"";?>> <?=$row->name; ?></option>
										<?php } ?>
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									
									<label for="postal_code" class="">Postal code *</label>
									<input type="text" class="form-control" name="postal_code" id="postal_code" maxlength="6"  value="<?= getFieldVal('postal_code',$details);?>" required="required" data-rule-required="true" data-msg-required="Please include your Username">
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="address_line1" class="">Address line 1 *</label>
									<textarea class="form-control" id="address_line1" name="address_line1" data-toggle="wysiwyg"  required="required" data-rule-required="true" data-msg-required="Please include your Address" ><?= getFieldVal('address_line1',$details);?></textarea>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="address_line2" class="">address line 2</label>
									<textarea class="form-control" id="address_line2" name="address_line2" data-toggle="wysiwyg"><?= getFieldVal('address_line2',$details);?></textarea>
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
									<textarea name="description" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('description',$details)?></textarea>
								</div>
							</div>
						</div>
								
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="box-footer text-center">
									<!--<a href="<?php //$main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
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

$(document).ready(function() {
	$('.wysihtml5-toolbar').html('');
});
</script>