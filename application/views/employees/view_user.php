<!--Start header-->
<?=$header;?>
<!--End header-->
<?php 
$ID= (isset($details->user_id))?$details->user_id:""; 
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
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">Manage <?= $heading; ?></a>
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
											<input type="hidden" name="ID" id="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
											<input type="hidden" name="user_id" id="user_id" value="<?= ($ID!='')?$ID:''; ?>">
											<label for="user_name" class="">Username *</label>
											<input type="email" class="form-control checkNotExistEmpUsername" name="user_name" id="user_name"  value="<?= getFieldVal('user_name',$details);?>" <?=(getFieldVal('user_name',$details)!='')?"disabled":""?> autocomplete="off" required="required" data-rule-required="true" data-msg-required="Please include your Username">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
									
									<?php if(empty($ID)){?>
									<div class="col-md-6">
										<div class="form-group">
											<label for="password" class="">Password *</label>
											<input type="password" class="form-control" id="password" name="password" value="<?= getFieldVal('password',$details);?>" autocomplete="off" data-rule-required="true" data-msg-required="Please include your password">
											<span class="error" style="display: none;">
											<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
									<?php }?>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="team" class="">Team *</label>
											<input class="form-control editOption" style="display:none;" placeholder="Please input team name"></input>
											
											<select class="form-control select-other" id="team" name="team" required="required" data-rule-required="true" data-msg-required="Please Select team">
												<?php 
													$teams=[''=>'Select','IT'=>'IT','Marketing'=>'Marketing','Operation'=>'Operation','Customer Service'=>'Customer Service','Front office'=>'Front office','Pharmacy'=>'Pharmacy','editable'=>'Other'];
													if($teams && count($teams)>0){
														if(getFieldVal('team',$details)!='' && !in_array(getFieldVal('team',$details),$titles))$teams[getFieldVal('team',$details)]=getFieldVal('team',$details);
													foreach($teams as $key=>$value){
												?>
													<option value="<?=$key;?>" class="<?= $key; ?>" <?= ($key==getFieldVal('team',$details))?"selected":"";?>><?= $value;?></option>
												<?php }}?>
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
												<option value="">Select</option>
												<?php 
													if($role_details && count($role_details)>0){
													foreach($role_details as $role){
													if($loginRoleID=="2" && ($role->ID=='2' || $role->ID=='4')){
														continue;
													}
													if($loginRoleID=="3" && $role->ID!='4'){
														continue;
													}		
												?>
													<option value="<?=$role->ID;?>" <?=($role->ID==getFieldVal('role_id',$details))?"selected":"";?>><?=$role->name;?></option>
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
											<div class="blog-post blog-post-card text-center">
												<figure id="user_image" style="height:185px;">
													<a href="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" class="image-lightbox" id="image-lightbox" title="" data-toggle="lightbox" data-type="image" style="cursor:zoom-in;">	
														<img class="view_image" src="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" style="height:100%;width:100%;object-fit:contain;" title="Click here for zoom image.">
													</a>	
												</figure>
												
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
										
										<a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-module-access">View Access</a>
										
										<!--<a href="<?php //$main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<!--for change Module Access permission Modal -->
	<div class="modal modal-info fade bs-modal-module-access" id="module-access" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Module Access</h5>
				</div>
				<div class="modal-body">
					<?= $assignRole; ?>
				</div>
				<div class="modal-footer">
					<!--<button type="submit" class="btn btn-success btn-rounded ripple text-left" data-dismiss="modal">Assign</button>-->
					
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--end-->
	
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