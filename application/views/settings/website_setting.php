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
			<label for="website_name" class="">Website Name *</label>
			<input class="form-control" id="website_name" placeholder="" type="text" name="website_name" value="<?= getFieldVal('website_name',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter your website name.">
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
			<label for="smtpmail_host" class="">SMTP Host *</label>
			<input class="form-control" id="smtpmail_host" placeholder="" name="smtpmail_host" type="text" value="<?= getFieldVal('smtpmail_host',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP host">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="form-group">
			<label for="smtpmail_port" class="">SMTP Port *</label>
			<input class="form-control" id="smtpmail_port" placeholder="" name="smtpmail_port" type="text"  value="<?= getFieldVal('smtpmail_port',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP port">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="smtpmail_mail" class="">SMTP Email *</label>
			<input class="form-control" id="smtpmail_mail" placeholder="" name="smtpmail_mail" type="text"  value="<?= getFieldVal('smtpmail_mail',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP email">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="form-group">
			<label for="smtpmail_password" class="">SMTP Password *</label>
			<input class="form-control" id="smtpmail_password" placeholder="" name="smtpmail_password" type="text"  value="<?= getFieldVal('smtpmail_password',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter SMTP password">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label for="customer_care" class="">Customer Care Number *</label>
			<input class="form-control" id="customer_care_no" placeholder="" name="customer_care_no" type="text"  value="<?= getFieldVal('customer_care_no',$details) ?>" required="required" data-rule-required="true"  data-msg-required="Please enter customer care number">
			<span class="error" style="display: none;">
			<i class="error-log fa fa-exclamation-triangle"></i>
			</span> 
			</div>
		</div>     
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
			<div class="box-footer text-center">
			<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
			<?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
			<button type="submit" class="btn btn-success no-print">Save</button>
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

	<!--
	<div class="widget-holder widget-sm col-md-3 widget-full-height">
	<div class="widget-bg">
	<div class="widget-body">
	<div class="counter-w-info media">
	<div class="media-body">
	<div class="card card-profile">
	<div class="card-img-top">
		<a href="javascript:void(0)" data-toggle="modal" data-target="#changeLogoImage">
			<span id="LogoImage">
			<img class="img" src="<?=base_url().getFieldVal('logo',$details);?>" title="Click here for change logo image" style="max-height:150px;max-width:200px;"/>
			</span>
			<input type="buttom" class="btn btn-info btn-small" value="Change logo">
		</a>
	</div>
	</div>																   
	</div>
	<!-- /.media-body --><!--
	<div class="pull-right align-self-center"><i class="list-icon feather feather-award bg-info"></i>
	</div>
	</div>
	<!-- /.counter-w-info --><!--
	</div>
	<!-- /.widget-body --><!--
	</div>
	<!-- /.widget-bg --><!--
	</div>
	-->
	<!-- /.widget-holder --><!--
	</div>


	<!--for change shop image Modal -->
	<div class="modal fade " id="changeLogoImage" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
		<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="websiteconfig/change_logo_image">
		<div class="modal-header">
			<h4 class="modal-title text-center">Change Log</h4>
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title"></h4>
		</div>
		<div class="modal-body">
			<!-- Begin What's Your shop Image Field -->
			<div class="">
				<span id="updateLogoImg" align="center">
				<img class="img" src="<?=base_url().getFieldVal('logo',$details);?>" style="max-height:250px;max-width:550px;"/>
				<span>
				<label for="logo"  class="">Website Logo <span class="req">*</span>
				<h6>Logo should be in .jpeg format, min size 100 KB and max size 500 KB.</h6>
				</label>
				<input type="hidden" name="model_image" value="websiteconfig">
				<input type="hidden" name="ID" value="<?= MD5($ID); ?>">
				<input type="hidden" id="file_name" name="file_name" value="logo">
				<input type="file" class="logo"  id="logo" name="logo" required="required" data-rule-required="true" data-msg-required="Please select your photo." >

				<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
		<!-- End What's Your shop Image Field -->	
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-info UpdateShopImageBtn" value="Change" />
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</form>
	</div>      
	</div>
	</div>
	<!--end-->
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>