<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/img/favicon.png')?>">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?= $this->config->item('WEBSITE_NAME'); ?>- Login</title>
	<!-- CSS -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600%7CRoboto:400" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/vendors/material-icons/material-icons.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/vendors/mono-social-icons/monosocialiconsfont.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/vendors/feather-icons/feather.css')?>" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/css/custom_style.css');?>" rel="stylesheet" type="text/css">
	<!-- Head Libs -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body class="body-bg-full profile-page">
	<div id="wrapper" class="wrapper">
	<div class="row container-min-full-height">
	<div class="col-lg-8 p-3 login-left">
	<div class="text-left">
		<div class="mb-8 text-center">		
			<marquee class="logo-collapse" style="font-size:16px">Customer Care :<?= $this->config->item('CUSTOMER_CARE'); ?></marquee>
		</div>
	</div>
	<span class="getFlashMsg"><?= getFlashMsg('success_message'); ?></span>

	<div class="w-50">

	<h2 class="mb-4 text-center">
		<img src="<?=base_url('assets/img/logo.png')?>"/>
	</h2>
	<form class="text-center MyForm" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
		<div class="form-group">
			<label for="user_name" class="text-muted">What's your username *</label>
			<input type="email" class="form-control form-control-line user_name" id="user_name" name="user_name" required="required" size="50" minlength="4" maxlength="50" value="" placeholder="" data-rule-required="true" data-msg-required="Please include your Username" autocomplete="off">
			<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
			</span>
		</div>
		<div class="form-group">
			<label for="password" class="text-muted">What's your password *</label>
			<input type="password" class="form-control form-control-line password" id="password" name="password" required="required" size="12" minlength="8" maxlength="12" value="" placeholder="" data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
			<span class="error" style="display: none;">
				<i class="error-log fa fa-exclamation-triangle"></i>
			</span>
		</div>
		<div class="form-group no-gutters mb-5 text-center">
			<a href="<?=base_url('signin/forgot_password');?>" id="to-recover" class="text-muted fw-700 text-uppercase heading-font-family fs-12" >Forgot Password?</a>
		</div>
		<!-- /.form-group -->
		<div class="form-group mr-b-20">
			<button class="btn btn-block btn-rounded btn-md btn-primary text-uppercase fw-600 ripple" type="submit">Sign In</button>
		</div>
	</form>
	<!-- /form -->
	<!--
	<button type="button" class="btn btn-block btn-rounded btn-outline-facebook ripple" title="Login with Facebook">Connect using <span class="fw-700">facebook</span>
	</button>
	-->
	</div>
	<!-- /.w-75 -->
	</div>
	<div class="col-lg-4 login-right d-lg-flex d-none pos-fixed pos-right text-inverse container-min-full-height" style="background-image: url(<?=base_url('assets/img/site-bg-small.jpg')?>)">
	<div class="login-content px-3 w-75 text-center">
	<h2 class="mb-4 text-center fw-300" style="color: black !important;">Welcome</h2>
	<p class="heading-font-family fw-300 letter-spacing-minus" style="color: black !important;">Sign in and discover the many great features that our app provides</p>
        <!--
        <a href="<?/*=base_url('signup')*/?>" class="btn btn-rounded btn-md btn-outline-inverse text-uppercase fw-600 ripple pd-lr-60 mr-t-200">Sign Up</a>
        -->
		<!--
		<ul class="list-inline mt-4 heading-font-family text-uppercase fs-13 mr-t-20">
			<li class="list-inline-item"><a href="#">Home</a>
			</li>
			<li class="list-inline-item"><a href="#">About</a>
			</li>
			<li class="list-inline-item"><a href="#">Contact</a>
			</li>
			<li class="list-inline-item"><a href="#">Careers</a>
			</li>
		</ul>
		-->
	</div>
	<!-- /.login-content -->
	</div>
	<!-- /.login-right -->
	</div>
	<!-- /.row -->
	</div>
<!-- /.wrapper -->
<!-- Add aditional js script--> 
<script>
var AJAX_URL="<?=base_url().'ajax/';?>";
var BASE_URL="<?=base_url();?>";
</script> 
<script src="<?=base_url('assets/components/jquery/dist/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/components/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/components/jquery/dist/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/components/jquery.easing-master/jquery.easing.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/customvalidation.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/material-design.js')?>" type="text/javascript"></script>
<!-- End aditional js script-->

</body>

</html>