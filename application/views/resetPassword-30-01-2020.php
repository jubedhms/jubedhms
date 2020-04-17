<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/img/favicon.png')?>">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?= $this->config->item('WEBSITE_NAME'); ?>- Forgot Password</title>
	<!-- CSS -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600%7CRoboto:400" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/vendors/material-icons/material-icons.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/vendors/mono-social-icons/monosocialiconsfont.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/vendors/feather-icons/feather.css')?>" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css">
	<!-- Head Libs -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body class="body-bg-full profile-page" style="background-image: url(<?=base_url('assets/img/site-bg.jpg')?>)">
	<div id="wrapper" class="wrapper">
		<div class="row container-min-full-height align-items-center">
		<div class="col-10 ml-sm-auto col-sm-6 col-md-4 ml-md-auto login-center login-center-mini mx-auto">
		<div class="navbar-header text-center mt-2 mb-4">
			<a href="<?=base_url('signin');?>">
				<img alt="" src="<?=base_url('assets/img/logo.png')?>">
			</a>
		</div>
		<!-- /.navbar-header -->
		<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
			<p class="text-center text-muted"></p>
			<div class="form-group no-gutters">
				<label for="password" class="col-md-12 mb-1">What's your new password? *</label>
				<input id="password" name="password" class="form-control form-control-line  password" required="required" size="12" minlength="8" maxlength="12" type="password"  data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
			
			<div class="form-group no-gutters">
				<label for="confirm_password" class="col-md-12 mb-1">Confirm password? *</label>
				<input id="confirm_password" name="confirm_password" class="form-control form-control-line  confirm_password" required="required" size="12" minlength="8" maxlength="12"  type="password" value="" placeholder="" data-rule-equalTo="#password" data-rule-required="true" data-msg-required="Please enter a valid confirm Password" autocomplete="off">
				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
			
			<div class="form-group no-gutters">
				<label for="show_password" class="col-md-12 mb-1">Show password
					<input id="show_password" name="show_password" class="form-control form-control-line  show_password" type="checkbox">
				</label>
			</div>
			
			<div class="form-group mb-5">
				<button class="btn btn-block btn-lg btn-primary text-uppercase fs-12 fw-600 action-button" type="submit" name="change_password">Change</button>
			</div>
		</form>
		<!-- /. -->
		<footer class="col-sm-12 text-center">
		<hr>
		<p>Back to <a href="<?=base_url('signin');?>" class="text-primary m-l-5"><b>Login</b></a>
		</p>
		</footer>
		</div>
		<!-- /.login-right -->
		</div>
	<!-- /.row -->
	</div>
<!-- /.body-container -->

<!-- Add aditional js script--> 
<script src="<?=base_url('assets/components/jquery/dist/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/components/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/components/jquery/dist/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/components/jquery.easing-master/jquery.easing.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/customvalidation.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/material-design.js')?>" type="text/javascript"></script>
<!-- End aditional js script-->

</body>

</html>



















<!-- USER Login FIELD SET --> 
  <fieldset>
    <h2 class="fs-title">Change Password</h2>
    <h3 class="fs-subtitle">We just need some basic information For Login</h3>
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	  <!-- Begin Password Field -->
        <div class="hs_password field hs-form-field">
        
        <label for="password">What's your New Password? *</label>
		 <input id="password" name="password" class="password" required="required" size="12" minlength="8" maxlength="12" type="password"  data-rule-required="true"  data-msg-required="Please enter a valid Password">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
      <!-- End Password Field -->
	  
	<!-- Begin Confirm Password Field -->
        <div class="hs_confirm_password field hs-form-field">
        
          <label for="confirm_password">Confirm Password? *</label>
          <input id="confirm_password" name="confirm_password" class="confirm_password" required="required" size="12" minlength="8" maxlength="12"  type="password" value="" placeholder="" data-rule-equalTo="#password" data-rule-required="true" data-msg-required="Please enter a valid confirm Password">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
      <!-- End Password Field -->
	<!-- Begin show/hide Password Field -->
        <div class="hs_show_password" style="display:block;text-align: center !important;">
          <label for="show_password">Show Password
          <input id="show_password" name="show_password" class="show_password" type="checkbox"></label>
        </div>
      <!-- End show/hide Field -->   
	<input type="submit" name="change_password" class="next action-button" value="Change" />
  </fieldset>
