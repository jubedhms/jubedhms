<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->

<main class="main-wrapper clearfix">
	<div class="action-message"><?= getFlashMsg('success_message'); ?></div>

	<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard');?>">Dashboard</a>
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

	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" method="post" autocomplete="off">
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
											<?php $ID= (isset($details->user_id))?$details->user_id:""; ?>
											
											<input type="hidden" name="ID" id="ID" value="<?= md5($details->ID); ?>">
											
											<input type="hidden" name="user_id" id="user_id" value="<?= ($ID!='')?$ID:''; ?>">
											
											<label for="user_name" class="">Username *</label>
											<input type="email" class="form-control checkNotExistEmpUsername" name="user_name" id="user_name"  value="<?= getFieldVal('user_name',$details);?>" <?=(getFieldVal('user_name',$details)!='')?"disabled":""?> autocomplete="off" required="required" data-rule-required="true" data-msg-required="Please include your Username">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
									
									
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="team" class="">Team *</label>
											<input class="form-control editOption" style="display:none;" placeholder="Please input team name"></input>
											
											<select class="form-control select-other" id="team" name="team" required="required" data-rule-required="true" data-msg-required="Please Select team">
												<option value="Admin">Admin</option>
											</select>
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="role_id" class="">Employee Role *</label>
											<select class="form-control" id="role_id" name="role_id" required="required" data-rule-required="true" data-msg-required="Please select Employee role." >
												<option value="1">Admin</option>
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
											<label for="title" class="">Title *</label>
											<input class="form-control editOption" style="display:none;" placeholder="Please input Title"></input>
											<select class="form-control select-other" id="title" name="title" value="<?= getFieldVal('title',$details);?>" list="titles" required="required" data-rule-required="true" data-msg-required="Please select Title.">
												<option value="">Select</option>
												<?php 
													$titles=['Mr'=>'Mr','Mrs'=>'Mrs','Miss'=>'Miss','Ms'=>'Ms','Dr'=>'Dr','Prof'=>'Prof','Rev'=>'Rev','editable'=>'Other'];
													if($titles && count($titles)>0){
														if(getFieldVal('title',$details)!='' && !in_array(getFieldVal('title',$details),$titles))$titles[getFieldVal('title',$details)]=getFieldVal('title',$details);
													foreach($titles as $key=>$value){
												?>
													<option value="<?=$key;?>" class="<?= $key; ?>" <?=($key==getFieldVal('title',$details))?"selected":"";?>><?=$value;?></option>
												<?php if($key !=getFieldVal('title',$details) && getFieldVal('title',$details)!=''){
													}}}?>
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
								
							</div>
							
							<!-- Start upload Image-->
							<div class="col-md-3 widget-holder">
								<div class="widget-bg">
									<div class="widget-body---">
										<div class="col-md-12">
											<input type="file" class="form-control choose-image" id="image" name="image" accept=".jpg,.jpeg,.png" data-min-size="10" data-max-size="1000" login-profile-img="1"  table-id="<?=$ID;?>" action="<?=$this->main_page;?>/change_image" show-image-src=".view_image,.login-profile-pic" show-image-href=".image-lightbox" <?=($ID=='')?'data-rule-required="true" data-msg-required="Please select employee profile image"':'';?> style="opacity:0;height:0px;width:0px;">
											<span class="error" style="display:none;margin-left:-237px">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
										<div class="col-md-12">
											<div class="blog-post blog-post-card text-center">
												<figure id="user_image" style="height:185px;">
													<a href="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" class="image-lightbox" id="image-lightbox" title="" data-toggle="lightbox" data-type="image" style="cursor:zoom-in;">	
														<img class="view_image" src="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" style="height:100%;width:100%;object-fit:contain;" title="Click here for zoom image.">
													</a>	
												</figure>
												<header style="padding-left:0.10em !important;">	
													<div class="btn-group" role="group" aria-label="Basic example">
														<a href="javascript:void(0)" class="btn btn-sm btn-outline-primary btn-rounded choose-image-href">Change Image</a>
														<?php if(!empty($ID)){?>
															<a href="javascript:void(0)" class="btn btn-sm btn-outline-primary btn-rounded" data-toggle="modal" data-target=".bs-modal-changePassword">Change Password</a> 
														<?php }?>
													</div>
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
											<label for="middle_name" class="">Middle name</label>
											<input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= getFieldVal('middle_name',$details);?>">
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label for="last_name" class="">Last name</label>
											<input type="text" class="form-control" id="last_name" name="last_name" value="<?= getFieldVal('last_name',$details);?>">
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
									<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
									<?php if(checkModulePermission($MODULEID,'edit_btn')){?>
									<button type="submit" class="btn btn-success no-print">Save</button>
									<?php } ?>
									<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
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
	
	<!--for change password Modal -->
	<div class="modal modal-info fade bs-modal-changePassword" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Change password</h5>
				</div>
				<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="change_password" autocomplete="off">
				<div class="modal-body">
				<!-- Begin Old Password Field -->
				<div class="">
					<label for="old_password">What is your old password? *
					<h6 class="fs-subtitle"></h6>
					</label>
					 <input type="hidden" name="model_password" value="user/user_profile">
					<input type="password" class="form-control old_password" id="old_password" name="old_password" required="required" size="12" minlength="8" maxlength="12" data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<!-- End Old Password Field -->	

				<!-- Begin Password Field -->
				<div class="">
					<label for="password">new password? *
					<h6 class="fs-subtitle"></h6>
					</label>
					<input id="password" name="password" class="form-control password" required="required" size="12" minlength="8" maxlength="12" type="password"  data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<!-- End Password Field -->

				<!-- Begin Confirm Password Field -->
				<div class="">
					<label for="confirm_password">Confirm password? *</label>
					<input id="confirm_password" name="confirm_password" class="form-control confirm_password" required="required" size="12" minlength="8" maxlength="12"  type="password" data-rule-equalTo="#password" data-rule-required="true" data-msg-required="Please enter a valid confirm Password" autocomplete="off">
					<span class="error password_msg" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<!-- End Password Field -->
				<!-- Begin show/hide Password Field -->
				<div class="" style="display:block;text-align: center !important;">
					<label for="show_password">Show password
					<input id="show_password" name="show_password" class="show_password" type="checkbox"></label>
				</div>
				<!-- End show/hide Field -->	
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-rounded ripple text-left UpdatePassword">Change</button>
					
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
				</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--end-->
	
	
	
	
	
	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>

<script>
$(document).on("click",".choose-image-href", function(){
	$('.choose-image').trigger('click');
});

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

<script src="<?= base_url('assets/js/select-other.js')?>" type="text/javascript"></script>