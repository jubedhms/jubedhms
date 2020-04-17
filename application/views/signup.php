<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/img/favicon.png')?>">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?= $this->config->item('WEBSITE_NAME'); ?>- signup</title>
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

<body class="body-bg-full profile-page" style="background-image: url(<?=base_url('assets/img/site-bg.jpg')?>)">
    <div id="wrapper" class="row wrapper">
        <div class="col-10 ml-sm-auto col-sm-8 col-md-4 ml-md-auto login-center mx-auto">
            <div class="navbar-header text-center mt-2 mb-4">
                <a href="<?=base_url('signin')?>">
                    <img alt="" src="<?=base_url('assets/img/logo.png')?>">
                </a>
            </div>
            
			<span class="getFlashMsg"><?= getFlashMsg('success_message'); ?></span>
			
			<!-- /.navbar-header -->
            <h5><a href="javascript:void(0);">Sign Up</a></h5>
            <p>Signing up is easy. It only takes a few steps and you'll be up and running in no time.</p>
            <form class="text-center MyForm" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
                <div class="form-group">
					<label for="company_name" class="text-muted">Company Name *</label>
					<input type="text" class="form-control form-control-line company_name" id="company_name" name="company_name" required="required" size="50" minlength="4" maxlength="50" value="" placeholder="" data-rule-required="true" data-msg-required="Please include your company name" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				
				<div class="form-group">
					<label for="user_name" class="text-muted">Email address *</label>
					<input type="email" class="form-control form-control-line user_name checkExistUser" id="user_name" name="user_name" required="required" size="50" minlength="4" maxlength="50" value="" placeholder="" data-rule-required="true" data-msg-required="Please include your Username" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>

				<div class="form-group">
					<label for="password" class="text-muted" >Password *</label>
					<input type="password" class="form-control form-control-line password" id="password" name="password" required="required" size="12" minlength="8" maxlength="12" value="" placeholder="" data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				
               <div class="form-group">
					<label for="confirm_password" class="text-muted" >Confirm password *</label>
					<input type="password" class="form-control form-control-line confirm_password" id="confirm_password" name="confirm_password" required="required" size="12" minlength="8" maxlength="12" value="" placeholder="" data-rule-equalTo="#password" data-rule-required="true"  data-msg-required="Please confirm a valid Password" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				
                <div class="form-group">
                            <input type="checkbox" class="term_agree" id="term_agree" name="term_agree" required="required" data-rule-required="true"  data-msg-required="Please accept terms & Conditions"> 
						<span class="error" style="display: none;">
								<i class="error-log fa fa-exclamation-triangle"></i>
						</span>
						<span class="label-text">I agree to all <a href="#" data-toggle="modal" data-target=".bs-modal-TermsConditions">Terms &amp; Conditions</a></span>
				</div>
	
                <!-- /.form-group -->
                <div class="form-group text-center no-gutters mb-4">
                    <button type="submit" class="btn btn-block btn-lg btn-primary text-uppercase fs-12 fw-600 edit">Sign Up</button>
                </div>
                <!-- /.btn-list -->
            </form>
            <!-- /.form-horzontal -->
            <footer class="col-sm-12 text-center">
                <hr>
                <p>Already have an account? <a href="<?=base_url('signin')?>" class="text-primary m-l-5"><b>Log In</b></a>
                </p>
            </footer>
        </div>
        <!-- /.login-center -->
    </div>
	
	
	
	
	<!--for term and condition Modal -->
	<div class="modal modal-info fade bs-modal-TermsConditions" id="TermsConditions" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Terms &amp; Conditions</h5>
				</div>
				<div class="modal-body">
					<!-- Begin Terms and Conditions -->
					<div class="blog-post blog-post-card text-center">
					<p> </p>
					
					</div>
					<!-- End Terms and Conditions -->	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--end-->
	
    <!-- /.body-container -->
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

<script>
$(document).on('blur', '.confirm_password', function(event) {
var password = $('#password').val();
var confirm_password = $(this).val();

    if (password === confirm_password) {
        $('.UpdatePassword').attr('type','submit');
		$('.password_msg').html('');
		$('.password_msg').css("display","none");
	} else {
		$('.password_msg').css("display","");
		$('.password_msg').html('Please enter the same value again.');
		$('.UpdatePassword').attr('type','button');
		}
});

</script>
</body>

</html>