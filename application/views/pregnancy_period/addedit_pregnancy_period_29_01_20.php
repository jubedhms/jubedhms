<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->ID))?$details->ID:""; 
					
$url1=($this->uri->segment(1)!='')?$this->uri->segment(1):''; 
$url2=($this->uri->segment(2)!='')?$this->uri->segment(2):''; 
$url3=($this->uri->segment(3)!='')?$this->uri->segment(3):'';
$url4=($this->uri->segment(4)!='')?$this->uri->segment(4):'';
$curr_url=$url1.'/'.$url2.'/'.$url3.'/'.$url4;
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

	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post" autocomplete="off">
	
	<div class="widget-list">
		<div class="row">
			<div class="<?= ($ID!='')?'col-md-9':'col-md-12'?> widget-holder">
				<div class="widget-bg">
					<div class="widget-body clearfix">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
									<input type="hidden" name="customer_group" value="1">
										<label for="name" class="">Title *</label>
										<input type="text" class="form-control" id="name" name="name" value="<?= getFieldVal('name',$details);?>" data-rule-required="true" data-msg-required="Please include your pregnancy period Name">
										<span class="error" style="display: none;">
											<i class="error-log fa fa-exclamation-triangle"></i>
										</span>  
								</div>
							</div>
						
							<div class="col-md-4">
								<div class="form-group">
								<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
								<input type="hidden" name="customer_group" value="1">
									<label for="name_vi" class="">tiêu đề  *</label>
									<input type="text" class="form-control" id="name_vi" name="name_vi" value="<?= getFieldVal('name_vi',$details);?>" data-rule-required="true" data-msg-required="Please include your pregnancy period Name">
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>  
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="pregnancy_week" class="">Pregnancy Week *</label>
									<select class="form-control" id="pregnancy_week" name="pregnancy_week" required="required" data-rule-required="true" data-msg-required="Please select pregnancy week.">
									<option value="">Select pregnancy week</option>
									<?php for ($r=1; $r<=40; $r++)
										{?> 
										<option value="<?= $r;?>" <?= (isset($details->pregnancy_week) && $r==$details->pregnancy_week)?"selected":"";?> ><?= $r;?> Week</option>
										<?php } ?>	
									</select>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						</div>
						
						<img src="#" id="imgwidthcheck" style="display:none;">
						<?php if($ID==''){ ?>
							<div class="row">
								 <div class="col-md-6">
								<div class="form-group">
									<label for="fileType" class="">Type *</label>
									<select class="form-control" id="fileType" name="fileType" required="required" data-rule-required="true" data-msg-required="Please select file type.">
									<option value="">Select</option>
										<option value="1">Image</option>
										<!--<option value="2">Video</option>-->
										<option value="3" selected>YouTube Link</option>
										
									</select>
												<span class="file_error" style="display: none; color:red;">Please select file type to upload.</span>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
													<label for="pregnancy_period_image"><span class="file_type_text">YouTube Link</span> *</label>
													<input type="file" class="form-control imageVideo hidden" disabled id="pregnancy_period_image" name="pregnancy_period_image" data-rule-required="true">
													<input type="text" class="form-control youtube" id="youtube_link" name="youtube_link" data-rule-required="true">
									<span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>  
								</div>
							</div>
						</div> 
						<?php }?>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="description" class="">English</label>
									<textarea name="description" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('description',$details)?></textarea>

								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="description_vi" class="">Vietnamese</label>
									<textarea name="description_vi" class="form-control" data-toggle="wysiwyg"><?=getFieldVal('description_vi',$details)?></textarea>

								</div>
							</div>
						</div>
							
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="awareness_image" class="mleft"></label>
									<div class="togglebutton" title="Select">
											<label class="checkbox-btn-lable">Push Notification
												<input  type="checkbox" class="p_note" name="push_notification" value="1" <?=(getFieldVal('push_notification',$details)=='1')?"checked":"";?> />
												<span class="toggle"></span>
											</label>
									</div>
									
								</div>
							</div>
						</div>
						
						<div class="row <?php if(getFieldVal('push_notification',$details)==0 || getFieldVal('push_notification',$details)==''){ echo 'hidden'; }?>" id="notification_group">
							<div class="row">
								<div class="col-md-4">
								   <div class="form-group">
										<label class="">Show top banner in home page:</label>
										<div class="togglebutton" title="Select">
											<label class="checkbox-btn-lable">
												<input id="home_banner" type="checkbox" name="home_banner" value="1" <?=(getFieldVal('home_banner',$details)=='1')?"checked":"";?> />
												<span class="toggle"></span>
											</label>
										</div>
								   </div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time Start</label> 
										<div class="input-group">		
											<input id="home_banner_start_date" name="home_banner_start_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->home_banner_start_date) && $details->home_banner_start_date!='0000-00-00' && $details->home_banner=='1')?$details->home_banner_start_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control timepicker" type="time" id="home_banner_start_time" name="home_banner_start_time" value="<?=(isset($details->home_banner_start_time) && $details->home_banner=='1')?DateTime($details->home_banner_start_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="home_banner_end_date" name="home_banner_end_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->home_banner_end_date) && $details->home_banner_end_date!='0000-00-00' && $details->home_banner=='1')?$details->home_banner_end_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control timepicker" id="home_banner_end_time" name="home_banner_end_time"  value="<?=(isset($details->home_banner_end_time) && $details->home_banner=='1')?DateTime($details->home_banner_end_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="">Show slide banner in home page:</label>
										<div class="togglebutton" title="Select">
											<label class="checkbox-btn-lable">
												<input id="home_slider_banner" type="checkbox" name="home_slider_banner" value="1" <?=(getFieldVal('home_slider_banner',$details)=='1')?"checked":"";?> />
												<span class="toggle"></span>
											</label>
										</div>
								   </div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time Start</label>
										<div class="input-group">		
											<input id="home_slider_start_date" name="home_slider_start_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->home_slider_start_date) && $details->home_slider_start_date!='0000-00-00' && $details->home_slider_banner=='1')?$details->home_slider_start_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control timepicker" type="time"  id="home_slider_start_time" name="home_slider_start_time" value="<?=(isset($details->home_slider_start_time) && $details->home_slider_banner=='1')?DateTime($details->home_slider_start_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="home_slider_end_date" name="home_slider_end_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->home_slider_end_date) && $details->home_slider_end_date!='0000-00-00' && $details->home_slider_banner=='1')?$details->home_slider_end_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control timepicker" id="home_slider_end_time" name="home_slider_end_time"  value="<?=(isset($details->home_slider_end_time) && $details->home_slider_banner=='1')?DateTime($details->home_slider_end_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="">In app notifcation - top up banner:</label>
										<div class="togglebutton" title="Select">
											<label class="checkbox-btn-lable">
												<input id="notification_banner" type="checkbox" name="notification_banner" value="1" <?=(getFieldVal('notification_banner',$details)=='1')?"checked":"";?> />
												<span class="toggle"></span>
											</label>
										</div>
								   </div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time Start</label> 
										<div class="input-group">		
											<input id="notification_banner_start_date" name="notification_banner_start_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->notification_banner_start_date) && $details->notification_banner_start_date!='0000-00-00' && $details->notification_banner=='1')?$details->notification_banner_start_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control timepicker" type="time"  id="notification_banner_start_time" name="notification_banner_start_time" value="<?=(isset($details->notification_banner_start_time) && $details->notification_banner=='1')?DateTime($details->notification_banner_start_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="notification_banner_end_date" name="notification_banner_end_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->notification_banner_end_date) && $details->notification_banner_end_date!='0000-00-00' && $details->notification_banner=='1')?$details->notification_banner_end_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control timepicker" id="notification_banner_end_time" name="notification_banner_end_time"  value="<?=(isset($details->notification_banner_end_time) && $details->notification_banner=='1')?DateTime($details->notification_banner_end_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="">In app notifcation - top up message:</label>
										<div class="togglebutton" title="Select">
											<label class="checkbox-btn-lable">
												<input id="notification_page" type="checkbox" name="notification_page" value="1" <?=(getFieldVal('notification_page',$details)=='1')?"checked":"";?> />
												<span class="toggle"></span>
											</label>
										</div>
								   </div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time Start</label> 
										<div class="input-group">		
											<input id="notification_page_start_date" name="notification_page_start_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->notification_page_start_date) && $details->notification_page_start_date!='0000-00-00' && $details->notification_page=='1')?$details->notification_page_start_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control timepicker" type="time"  id="notification_page_start_time" name="notification_page_start_time" value="<?=(isset($details->notification_page_start_time) && $details->notification_page=='1')?DateTime($details->notification_page_start_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="notification_page_end_date" name="notification_page_end_date" class="form-control datepicker" required="required" type="text" value="<?= (isset($details->notification_page_end_date) && $details->notification_page_end_date!='0000-00-00' && $details->notification_page=='1')?$details->notification_page_end_date:date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control timepicker" id="notification_page_end_time" name="notification_page_end_time"  value="<?=(isset($details->notification_page_end_time) && $details->notification_page=='1')?DateTime($details->notification_page_end_time,'h:i A'):date('h:i A')?>">
										</div>
									</div>	
								</div>
							</div>

						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="box-footer text-center">
									<div class="mbottom" ></div>
										<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
										<button type="submit" class="btn btn-success no-print submit">Save</button>
										<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
			<?php if($ID!=''){?>
			<div class="col-md-3 widget-holder">
				<div class="widget-bg">
					<div class="widget-body clearfix">
						<div class="col-md-12 mr-b-30 d-flex">
							<div class="blog-post blog-post-card text-center">
								<figure id="pregnancy_period_image">
									<a href="javascript:void(0)" data-toggle="modal" data-target=".bs-modal-changepregnancy_periodImage">
													<?php ($details->pregnancy_period_image)?$imgextention=explode('.',$details->pregnancy_period_image):array(); ?>
													<?php if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ $imagechangetitle='Change Thumbnail Image'; ?>
										<img class="img" src="<?=(getFieldVal('pregnancy_period_image',$details)!='')?base_url().getFieldVal('pregnancy_period_image',$details):base_url().'assets/img/icon/not-available.jpg';?>" title="Click here for change Image" >
													<?php }else{ $imagechangetitle='Change YouTube Link';
														($details->pregnancy_period_image)?$youtubelink=explode('=',$details->pregnancy_period_image):'';
														?>
														<iframe width="200" height="315" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
														</iframe>
													<?php }?>
												</a>	
								</figure>
								<div style="text-align:center;padding: 10px;">
									<a href="javascript:void(0)" class="btn btn-primary btn-round" data-toggle="modal" data-target=".bs-modal-changepregnancy_periodImage" style="font-size: 11px;"><?php echo $imagechangetitle; ?>  </a>
								</div>
								<footer class="mr-t-30">
									
								</footer>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
	
		</div>
	</div>
	</form>
	
	
	
	
	<!--for change pregnancy_period image Modal -->
	<div class="modal modal-info fade bs-modal-changepregnancy_periodImage" id="changepregnancy_periodImage" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Image</h5>
				</div>
				<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="../change_image">
				<div class="modal-body">
					<!-- Begin pregnancy_period Image Field -->
					<div class="blog-post blog-post-card text-center">
					<figure>	
					<span id="updateProfileImg" align="center">
						<?php ($details->pregnancy_period_image)?$imgextention=explode('.',$details->pregnancy_period_image):array(); ?>
                                                <?php if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ ?>
                                                    <img class="img" src="<?=(getFieldVal('pregnancy_period_image',$details)!='')?base_url().getFieldVal('pregnancy_period_image',$details):base_url().'assets/img/icon/not-available.jpg';?>" title="Click here for change Image" >
                                                <?php }else{
                                                    ($details->pregnancy_period_image)?$youtubelink=explode('=',$details->pregnancy_period_image):'';
                                                    ?>
                                                    <iframe width="450" height="315" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
                                                    </iframe>
                                                <?php }?>
					</span>
					</figure>
					</div>	
					<input type="hidden" name="model_image" value="<?=rtrim($curr_url,"/")?>">
					<input type="hidden" name="ID" value="<?= ($ID); ?>">
					<input type="hidden" id="file_name" name="file_name" value="pregnancy_period_image">
					<?php if($ID!=''){ ?>
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
									<label for="fileType" class="">Type *</label>
									<select class="form-control" id="fileType" name="fileType" required>
										<option value="">Select</option>
										<option value="1">Image</option>
										<!--<option value="2">Video</option>-->
										<option value="3" selected>YouTube Link</option>
										
									</select>
												<span class="file_error" style="display: none; color:red;">Please select file type to upload.</span>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
													<label for="pregnancy_period_image"><span class="file_type_text">YouTube Link</span> *</label>
									<input type="file" class="form-control imageVideo hidden" disabled id="pregnancy_period_image" name="pregnancy_period_image" required>
									<input type="text" class="form-control youtube" id="youtube_link" name="youtube_link" required>
									<span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>
									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								</div>
									</div>
						</div> 
					<?php }?>
					<!--<label for="pregnancy_period_image">pregnancy_period image? * </label>
					<p>Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>
					
					<input id="pregnancy_period_image_edit" name="pregnancy_period_image_edit" class="pregnancy_period_image_edit" required="required" type="file"  data-rule-required="true" data-msg-required="Please select Image." >
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>	-->				
					<!-- End pregnancy_period Image Field -->	
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-rounded ripple text-left">Upload</button>
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Cancel</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<script>
$(document).on("click",".p_note", function(){
	if($(this).prop("checked")==true){
		$("#notification_group").removeClass("hidden");
	}else{
		$("#notification_group").addClass("hidden");
		
		$("#home_banner").prop("checked", false);
		$('#home_banner_start_date').val('0000-00-00');
		$('#home_banner_start_time').val('00:00');
		$('#home_banner_end_date').val('0000-00-00');
		$('#home_banner_end_time').val('00:00');
		
		$("#home_slider_banner").prop("checked", false);
		$('#home_slider_start_date').val('0000-00-00');
		$('#home_slider_start_time').val('00:00');
		$('#home_slider_end_date').val('0000-00-00');
		$('#home_slider_end_time').val('00:00');
		
		$("#notification_page").prop("checked", false);
		$('#notification_page_start_date').val('0000-00-00');
		$('#notification_page_start_time').val('00:00');
		$('#notification_page_end_date').val('0000-00-00');
		$('#notification_page_end_time').val('00:00');
		
		$("#notification_banner").prop("checked", false);
		$('#notification_banner_start_date').val('0000-00-00');
		$('#notification_banner_start_time').val('00:00');
		$('#notification_banner_end_date').val('0000-00-00');
		$('#notification_banner_end_time').val('00:00');
	}  
});


$(document).on('change','#fileType',function(){
    if($(this).val()==1){
        $('.file_type_text').text('Image');
        $('.imageVideo').removeAttr('disabled');
        $('.imageVideo').removeClass('hidden');
        $('.youtube').attr('disabled',true);
        $('.youtube').addClass('hidden');
        $('.youtube').val('');
        $('input[name="pregnancy_period_image"]').val('');
    }else if($(this).val()==2){
        $('.file_type_text').text('video');
        $('.imageVideo').removeAttr('disabled');
        $('.imageVideo').removeClass('hidden');
        $('.youtube').attr('disabled',true);
        $('.youtube').addClass('hidden');
        $('.youtube').val('');
        $('input[name="pregnancy_period_image"]').val('');
    }else if($(this).val()==3){
        $('.file_type_text').text('YouTube Link');
        $('.imageVideo').attr('disabled',true);
        $('.imageVideo').addClass('hidden');
        $('.youtube').removeAttr('disabled');
        $('.youtube').removeClass('hidden');
        $('input[name="pregnancy_period_image"]').val('');
    }
    $('.file_error').hide();
})	 	

$(function () {
    $('input[name="pregnancy_period_image"]').change(function () {
        var val = $(this).val().toLowerCase(),
            image = new RegExp("(.*?)\.(jpg|jpeg|png|gif)$"),
            video = new RegExp("(.*?)\.(mp4|3gp|ogg|wmv|webm|flv|avi|mkv)$");
        if($('select[name="fileType"]').val()==1){
            if (!(image.test(val))) {
                $(this).val('');
                bootbox.alert('Please select image file!');
            }
			readURL(this);
        }else if($('select[name="fileType"]').val()==2){
            if (!(video.test(val))) {
                $(this).val('');
                bootbox.alert('Video file upload allowed types are only mp4, 3gp, ogg, wmv, webm, flv, avi and mkv !');
            }
        }else{
            alert('fg');
            $('select[name="fileType"]').focus();
            $(this).val('');
            $('.file_error').show();
        }
        
    });
});
</script>
<script>
      $(document).ready(function() {   
        //$(".select2").select2();   
      });      
</script>


<script>
function RunSelect2(){
  $('#select-id').select2({
      placeholder: "Select",
     allowClear: true,
     closeOnSelect: false,
  }).on('select2:open', function() {  
    setTimeout(function() {
        $(".select2-results__option .select2-results__group").bind( "click", selectAlllickHandler ); 
    }, 0);
  });
}
RunSelect2();
var selectAlllickHandler = function() {
$(".select2-results__option .select2-results__group").unbind( "click", selectAlllickHandler );        
$('#select-id').select2('destroy').find('option').prop('selected', 'selected').end();
  RunSelect2();
};
</script>

<script>
      function readURL(input) {
          $("#imgwidthcheck").attr('src', '#');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var $imaged=$("#imgwidthcheck").attr('src', e.target.result);
                $imaged.on('load', function() {
                    var ewidth ='500';
                    var eheight='250';
                    // if($imaged.width()==ewidth && $imaged.height()==eheight){
                        
                    // }else{
                        // $('input[name="pregnancy_period_image"]').val('');
                        // alert('Image dimention is not correct. Please upload the exact dimensions('+ewidth+'X'+eheight+') image.');
                    // }
                });
                //end
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

//    $(".imagesrc").change(function () {
//        readURL(this);
//    });
</script>