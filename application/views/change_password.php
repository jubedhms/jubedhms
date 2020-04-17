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
			<li class="breadcrumb-item"><a href="index.html">Home</a>
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
		<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">

		<div class="widget-bg">
		<div class="widget-heading clearfix">
			<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
				<label for="old_password">What's your old password *</label>
				<input id="old_password" name="old_password" class="form-control old_password" required="required" size="12" minlength="8" maxlength="12" type="password"  data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
				<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
				</span> 
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">	
				<label for="password">What's your new password *</label>
				<input id="password" name="password" class="form-control password" required="required" size="12" minlength="8" maxlength="12" type="password"  data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
				<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
				</span> 
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">	
				<label for="confirm_password">What's your confirm password *</label>

				<input id="confirm_password" name="confirm_password" class="form-control confirm_password" required="required" size="12" minlength="8" maxlength="12"  type="password" value="" placeholder="" data-rule-equalTo="#password" data-rule-required="true" data-msg-required="Please enter a valid confirm Password" autocomplete="off">
				<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">	
				<label for="show_password">Show password</label>
				<span style="padding-left:120px;">
				<input id="show_password" name="show_password" class="show_password" type="checkbox">
				</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-success no-print">Submit</button>
					<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
					<!--<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>-->
				</div>
				</div>
			</div>
		</div>	
		</div>
		<!-- /.media-body -->
		</div>
		</form>
	<!-- /.counter-w-info -->
	</div>






</div>
<!-- /.row -->
</div>
<!-- /.widget-list -->
</main>
<!-- /.main-wrappper -->	





<!-- end page-->		

<!--Start footer-->
<?=$footer;?>
<!--End footer-->