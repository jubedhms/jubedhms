<!--Start header-->
<?=$header;?>
<!--End header-->

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
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard');?>"> Dashboard</a>
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

	<div class="widget-list">
	<div class="row">
	<div class="col-md-12 widget-holder">
	<form class="MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">

	<div class="widget-bg">
	<div class="widget-body clearfix">
	<?php $ID= (isset($details->ID))?$details->ID:""; ?>
	<input type="hidden" name="ID" value="<?= MD5($ID) ?>">	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="name" class="">Name *</label>
			<input class="form-control" id="name" placeholder="" type="text" name="name" value="<?= getFieldVal('name',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter your name.">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>

		<div class="col-sm-6">
			<div class="form-group">
			<label for="contact_number" class="">Contact Number *</label>
			<input class="form-control" id="contact_number" placeholder="" name="contact_number" type="text" value="<?= getFieldVal('contact_number',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP host">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="emergency_contact_number" class="">Emergency Contact Number *</label>
			<input class="form-control" id="emergency_contact_number" placeholder="" name="emergency_contact_number" type="text"  value="<?= getFieldVal('emergency_contact_number',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter emergency contact number">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>	

		<div class="col-sm-6">
			<div class="form-group">
			<label for="fax_number" class="">Fax Number *</label>
			<input class="form-control" id="fax_number" placeholder="" name="fax_number" type="text"  value="<?= getFieldVal('fax_number',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP email">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
			</div>
		</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="email_id" class="">Email Id *</label>
			<input class="form-control" id="email_id" placeholder="" name="email_id" type="text"  value="<?= getFieldVal('email_id',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter email_id">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>

		<div class="col-sm-6">
			<div class="form-group">
			<label for="map_api_key" class="">Google map Api Key *</label>
			<input class="form-control" id="map_api_key" placeholder="" name="map_api_key" type="text"  value="<?= getFieldVal('map_api_key',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP password">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>         
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="longitude" class="">Longitude *</label>
			<input class="form-control" id="longitude" placeholder="" name="longitude" type="text"  value="<?= getFieldVal('longitude',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter longitude">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
                <div class="col-sm-6">
			<div class="form-group">
			<label for="latitude" class="">Latitude *</label>
			<input class="form-control" id="latitude" placeholder="" name="latitude" type="text"  value="<?= getFieldVal('latitude',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter longitude">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>  
		  
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="android_version" class="">Android version *</label>
			<input class="form-control" id="android_version" placeholder="" name="android_version" type="text"  value="<?= getFieldVal('android_version',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter android version">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
                <div class="col-sm-6">
			<div class="form-group">
			<label for="ios_version" class="">IOS Version *</label>
			<input class="form-control" id="ios_version" placeholder="" name="ios_version" type="text"  value="<?= getFieldVal('ios_version',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter ios version">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>  
		  
	</div>
	<div class="row">
            <div class="col-sm-6">
			<div class="form-group">
			<label for="latitude" class="">Facebook *</label>
			<input class="form-control" id="facebook" placeholder="" name="facebook" type="text"  value="<?= getFieldVal('facebook',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter facebook">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>  
		<div class="col-sm-6">
			<div class="form-group">
			<label for="twitter" class="">twitter *</label>
			<input class="form-control" id="twitter" placeholder="" name="twitter" type="text"  value="<?= getFieldVal('twitter',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter twitter">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
		    
	</div>
    
	<div class="row">	        
		<div class="col-sm-6">
			<div class="form-group">
				<label for="gmail" class="">Gmail *</label>
				<input class="form-control" id="gmail" placeholder="" name="gmail" type="text"  value="<?= getFieldVal('gmail',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter gmail">
				<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
				</span> 
			</div>
		</div>	    
		 
	</div>
        
    
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="about_us" class="">About Us (English)</label>
				<textarea name="about_us" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('about_us',$details)?></textarea>

			</div>
		</div>
	</div>
	<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="about_us_vi" class="">About Us (Vietnamese)</label>
					<textarea name="about_us_vi" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('about_us_vi',$details)?></textarea>

 				</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="address" class="">Address (English)</label>
				<textarea name="address" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('address',$details)?></textarea>

			</div>
		</div>
	</div>
        
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="address_vi" class="">Address (Vietnamese)</label>
				<textarea name="address_vi" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('address_vi',$details)?></textarea>

			</div>
		</div>
	</div>
	    
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="terms_of_services" class="">Terms of Services (English)</label>
				<textarea name="terms_of_services" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('terms_of_services',$details)?></textarea>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="terms_of_services_vi" class="">Terms of Services (Vietnamese)</label>
				<textarea name="terms_of_services_vi" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('terms_of_services_vi',$details)?></textarea>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
			<div class="box-footer text-center">
				<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
				<?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
					<button type="submit" class="btn btn-success no-print">Submit</button>
				<?php } ?>
				<!--<a href="<?php // base_url('dashboard');?>" class="btn btn-danger no-print">Cancel</a>-->
			</div>
			</div>
		</div>
	</div>

	</div>
	<!-- /.media-body -->

	</form>
	</div>
	<!-- /.counter-w-info -->
	</div>
	<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	<!-- /.widget-holder -->

</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>