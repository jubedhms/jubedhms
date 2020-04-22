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
<style>
.select2-results__group
{
  cursor:pointer !important;
}
::-webkit-scrollbar {
    width: 5px;
}
</style>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
	<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"> <?php echo $mode.' '.$heading; ?></h6>
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
        <!--start tab-->
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<ul class="nav nav-tabs pull-left">
					<li class="nav-item language" tabval='2' aria-expanded="false">
						<a class="nav-link active" href="javascript:void(0);" data-toggle="tab" aria-expanded="true">English</a>
					</li>
					<li class="nav-item language" tabval='1'>
						<a class="nav-link" href="javascript:void(0);" data-toggle="tab" aria-expanded="false">Vietnamese</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
        <!--end tab-->
	<div class="review">
	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post" autocomplete="off">
	
	<div class="widget-list">
		<div class="row">
		<div class="<?= ($ID!='')?'col-md-9':'col-md-9'?> widget-holder">
			<div class="widget-bg">
				<div class="widget-body clearfix">
					<div class="row">
						<div class="change_eng <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>">
							<div class="form-group">
							<input type="hidden" name="ID" class="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
								<label for="name" class="">Title *</label>
                                                                <input type="text" class="form-control preview" id="name" name="name" value="<?= getFieldVal('name',$details);?>" data-rule-required="true" data-msg-required="The title is required" autocomplete="off">
								<span class="name_error" style="display: none; color:red;">Please enter the title.</span>
<!--								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>  -->
							</div>
						</div>
						<div class="change_vit <?php  echo ($ID!='')?'col-md-12':'col-md-12' ?>" style="display:none;">
							<div class="form-group">
								<label for="name_vi" class="">tiêu đề *</label>
								<input type="text" class="form-control preview" id="name_vi" name="name_vi" value="<?=getFieldVal('name_vi',$details);?>" data-rule-required="true" data-msg-required="The title is required" autocomplete="off">
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>  
							</div>
						</div>
						</div>

						
						<div class="row">
							<div class=" <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>  ">
							<div class="form-group">
									<label for="" class="">Pregnancy Week *</label>
									<select class="form-control select2 pregnancy_week" id="pregnancy_week" placeholder="Select" name="pregnancy_week[]" multiple>
									<!--<option value="">Select pregnancy week</option>-->
									<?php $pweeks=isset($details->pregnancy_week)?explode(',',$details->pregnancy_week):array();
                                                                        for ($r=1; $r<=40; $r++)
										{?> 
										<option value="<?= $r;?>" <?= in_array($r,$pweeks)?"selected":"";?> ><?= $r;?> Week</option>
										<?php } ?>	
									</select>
                                                                        <span class="pregnancy_week_error" style="display: none; color:red;">Please select pregnancy week.</span>
<!--									<span class="error" style="display: none;">
										<i class="error-log fa fa-exclamation-triangle"></i>
									</span>-->
                                                        </div>
                                                        </div>
                                                </div>
                        <?php if(1==2){ ?>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="start_date" class="">Start Date *</label>
					<input id="start_date" name="start_date" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->start_date)?date('Y-m-d',strtotime($details->start_date)):date('Y-m-d');?>"
					data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' 
					data-rule-required="true" data-msg-required="Please select Date Of Birth.">
 
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<label for="end_date" class="">End Date *  </label>
				<input id="end_date" name="end_date" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->end_date)?date('Y-m-d',strtotime($details->end_date)):date('Y-m-d');?>"
					data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' 
					data-rule-required="true" data-msg-required="Please select Date Of Birth.">
 				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
		</div>
		</div>
                                    <?php } ?>



					<img src="#" id="imgwidthcheck" style="display:none;">
					
						<div class="row">
<!--							 <div class="col-md-6">
							<div class="form-group">
								<label for="fileType" class="">Type *</label>
								<select class="form-control" id="fileType" name="fileType" required="required" data-rule-required="true" data-msg-required="Please select file type.">
								<option value="">Select</option>
									<option value="1">Article</option>
									<option value="2">Video</option>
									<option value="3" selected>Video clip</option>
									
								</select>
											<span class="file_error" style="display: none; color:red;">Please select file type to upload.</span>
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							</div>
						</div>-->
                                                    
                                                    
                                                    
                                                    <div class="col-md-6">
							<div class="form-group">
								<label for="fileType" class="">Type * </label>
								<?php if($ID!=''){ ?>
                                                                    <select class="form-control" id="fileType" name="fileType" required="required" data-rule-required="true" data-msg-required="Please select file type.">
                                                                        <option value="">Select</option>
                                                                        <option value="1" <?php echo ($details->file_type==1)?'selected':''; ?>>Article</option>
                                                                        <!--<option value="2">Video</option>-->
                                                                        <option value="3" <?php echo ($details->file_type==3)?'selected':''; ?>>Video Clip</option>
									
								</select>
                                                                <?php }else{ ?>
                                                                    <select class="form-control" id="fileType" name="fileType" required="required" data-rule-required="true" data-msg-required="Please select file type.">
                                                                        <option value="">Select</option>
                                                                        <option value="1">Article</option>
                                                                        <!--<option value="2">Video</option>-->
                                                                        <option value="3" selected>Video Clip</option>

                                                                    </select>
                                                                <?php } ?>
                                                                <span class="file_error" style="display: none; color:red;">Please select file type to upload.</span>
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							</div>
						</div>
                                                    
                                                    
                                                <div class="col-md-6">
                                                    <?php if($ID!=''){ ?>
							<div class="form-group">
                                                            
                                                        <?php ($details->pregnancy_period_image)?$imgextention=explode('.',$details->pregnancy_period_image):array(); ?>
                                                        <?php //if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){       
                                                            ($details->pregnancy_period_image)?$youtubelink=explode('=',$details->pregnancy_period_image):''; ?>    
                                                    <label for=""><span class="file_type_text" style="margin-left: 130px;"><?php echo ($details->file_type==3)?'URL Link':'ILLUSTRATION'; ?></span> *</label>
                                                    <div class="col-md-12" style="width: 180px;border: 1px solid #f0f0f0;margin-bottom: 3px;margin: auto;">
                                                        <div >
                                                            <img style="height: 110px;width: 100%;border:1px solid;" alt="image" class="view_image img imageVideo <?php echo ($details->file_type==1)?'':'hidden'; ?>" src="<?= (getFieldVal('pregnancy_period_image', $details) != '') ? base_url(getFieldVal('pregnancy_period_image', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                            <div class="iframediv2">
                                                            <iframe class="youtube youtubesrc <?php echo ($details->file_type==3)?'':'hidden'; ?>"  style="width: 100%;height: 100px;" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
                                                            </iframe>
                                                            </div>
                                                            <div class="imageVideo <?php echo ($details->file_type==1)?'':'hidden'; ?>" style="display: flex;margin-top: 3px; ">
                                                            <div style="width: 70px;float: left;<?php echo (getFieldVal('pregnancy_period_image', $details) != '')?'':'pointer-events: none;opacity: .3;'; ?>" img="<?php echo $details->pregnancy_period_image; ?>" class="remove_pregnancy_image" onclick="remove_pregnancy_image(this);">
                                                                <span class="btn btn-xs btn-info">Remove</span>
                                                            </div>	
                                                            <div style="width: 110px;float: left;" class="change_pregnancy_period_image" onclick="change_pregnancy_period_image();">
                                                                <span class="btn btn-xs btn-info">Change Image</span>
                                                            </div>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                        <div style="display:none;">
                                                        <input type="file" class="form-control imageVideo <?php echo ($details->file_type==1)?'':'hidden'; ?>" <?php echo ($details->file_type==1)?'':'disabled'; ?> id="pregnancy_period_image" name="pregnancy_period_image">
                                                        </div>
                                                        <input type="text" class="form-control youtube <?php echo ($details->file_type==3)?'':'hidden'; ?>" <?php echo ($details->file_type==3)?'':'disabled'; ?> id="youtube_link" name="youtube_link" value="<?php echo ($details->file_type==3)?$details->pregnancy_period_image:''; ?>">
                                                        <!--<span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>-->
                                                        <span class="error" style="display: none;">
                                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                                        </span>
                                                               
							</div>
                                                    <?php }else{ ?>
                                                                <label for=""><span class="file_type_text" style="margin-left: 130px;">URL Link</span> *</label>
                                                                <div class="col-md-12" style="width: 180px;border: 1px solid #f0f0f0;margin-bottom: 3px;margin: auto;">
                                                                    <div>
                                                                        <img style="height: 110px;width: 100%;border:1px solid;" alt="image" class="view_image img imageVideo hidden" src="<?= (getFieldVal('pregnancy_period_image', $details) != '') ? base_url(getFieldVal('pregnancy_period_image', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                                        <div class="iframediv2" >
                                                                            <iframe style="width: 100%;height: 100px;" class="youtube youtubesrc" width="200" height="315" src="" frameborder="0" allowfullscreen>
                                                                            </iframe>
                                                                        </div>
                                                                    </div>
                                                                    <div class="imageVideo hidden" style="display: flex;margin-top: 3px; ">
                                                                        <div style="width: 70px;float: left;<?php echo (getFieldVal('pregnancy_period_image', $details) != '')?'':'pointer-events: none;opacity: .3;'; ?>" class="remove_pregnancy_image" onclick="remove_pregnancy_image(this);">
                                                                            <span class="btn btn-xs btn-info">Remove</span>
                                                                        </div>	
                                                                        <div style="width: 110px;float: left;" class="change_pregnancy_period_image" onclick="change_pregnancy_period_image();">
                                                                            <span class="btn btn-xs btn-info">Change Image</span>
                                                                        </div>	
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                <div>
                                                                    <!--<span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>-->
                                                                </div>
                                                    
                                                                <!--<label for="pregnancy_period_image"><span class="file_type_text">URL Link</span> *</label>-->
                                                                <div style="display:none;">
                                                                <input type="file" class="form-control imageVideo hidden" disabled id="pregnancy_period_image" name="pregnancy_period_image" data-rule-required="true">
                                                                </div>
                                                                <input type="text" class="form-control youtube" id="youtube_link" name="youtube_link" <?php if($ID==''){ ?>  data-rule-required="true" <?php } ?>>
								
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span> 
                                                    <?php } ?>
						</div>    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
					
<!--						<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pregnancy_period_image"><span class="file_type_text">Video clip</span> *</label>
                                                        <input type="file" class="form-control imageVideo hidden" disabled id="pregnancy_period_image" name="pregnancy_period_image" data-rule-required="true">
                                                        <input type="text" class="form-control youtube" id="youtube_link" name="youtube_link" <?php //if($ID==''){ ?>  data-rule-required="true" <?php //} ?>>
                                                        <span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>
                                                        <span class="error" style="display: none;">
                                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                                        </span>  
                                                    </div>
						</div>-->
					</div> 
					
					
					<div class="row">
						<div class="change_eng col-md-12">
							<div class="form-group">
								<label for="description" class="">Content *</label>
                                                                <span class="description_error" style="display: none; color:red;">Please enter content.</span>
								<!--<textarea name="description" id="description" class="form-control" data-toggle="wysiwyg"><?php //getFieldVal('description',$details)?></textarea>-->
                                                                <div class="" style="display:none;">
                                                                        <div class="">
                                                                        <span class="btn btn-xs btn-info" onclick="uploadeditorfilrclick();">Upload file to get link for insert image</span>
                                                                        <input class="urllink form-control" style="display: none;" type="text" name="url link" style="width: 100%;">
                                                                       </div>
                                                                </div>
                                                                <textarea cols="80" name="description" id="editor" rows="10" data-sample-short><?=getFieldVal('description',$details)?></textarea>
                                                                
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="change_vit col-md-12" style="display:none;"> 
							<div class="form-group">
								<label for="description_vi" class="">NỘI DUNG</label>
								<!--<textarea name="description_vi" class="form-control" ><?php //getFieldVal('description_vi',$details)?></textarea>-->
                                                                <div class="">
                                                                        <div class="">
                                                                        <span class="btn btn-xs btn-info" onclick="uploadeditorfilrclick();">Tải lên tập tin để nhận liên kết để chèn hình ảnh</span>
                                                                        <input class="urllink form-control" style="display: none;" type="text" name="url link" style="width: 100%;">
                                                                       </div>
                                                                </div>
                                                                <textarea cols="80" name="description_vi" id="editor_vi" rows="10" data-sample-short><?=getFieldVal('description_vi',$details)?></textarea>
                                                                
                                                                
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="pregnancy_period_image" class="mleft"></label>
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
							
						
						
						
						<div class="row save_cancel">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="box-footer text-center">
									<div class="mbottom" ></div>
									<a href="javascript:void(0)" class="btn btn-primary no-print save" is_lang="2">Preview</a>
										<button type="button" class="btn btn-success no-print submit">Save<?php // echo ($ID!='')?'Update':'Save'; ?></button>
										<button type="submit" class="btn btn-success no-print submit_click hidden">Save<?php // echo ($ID!='')?'Update':'Save'; ?></button>
										
										<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
									</div>
								</div>
							</div>
						</div>

						<div class="row modal_button" style="display: none;pointer-events: auto;">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="box-footer text-center">
									<button type="button" class="btn btn-danger no-print cancel">Cancel</a>
									
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
	</div>
			<?php //if($ID!=''){?>
            <div class="col-md-3 widget-holder">
                <div class="row">
                                <div class="text-inverse col-md-12" style="background: #00b1f3;">
					<span><i class="feather feather-menu list-icon fs-20"></i> &nbsp;Pregnancy Period</span>
					<span><i class="" aria-hidden="true"></i></span>
                                        <div class="pull-right">
                                            <span><i class="fa fa-phone" aria-hidden="true"></i></span> &nbsp;
                                            <span><i class="fa fa-bell-o" aria-hidden="true"></i></span> &nbsp;
                                        </div>
				</div>
                                                    <div style="height: 150px;">
                                                        <!--picture-->
                                                        <figure id="awareness_image">
                                                            <?php if($ID==''){ ?>
                                                            <input type="hidden" class="srcimg" value="<?=base_url().'assets/img/icon/not-available.jpg';?>">
                                                            <img style="width: 100%;height: 150px;" class="img imageVideo hidden" src="<?=base_url().'assets/img/icon/not-available.jpg';?>" >
                                                            <div class="iframediv">
                                                            <iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="javascript:void(0);" frameborder="0" allowfullscreen>
                                                            </iframe>
                                                            </div>
                                                                <?php }else{ ?>
                                                            <a href="javascript:void(0)" style="cursor:auto;">
                                                                    <?php ($details->pregnancy_period_image)?$imgextention=explode('.',$details->pregnancy_period_image):array(); ?>
                                                                    <?php if(in_array(end($imgextention),array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'))){ ?>
                                                                    <input type="hidden" class="srcimg" value="<?=base_url().'assets/img/icon/not-available.jpg';?>">
                                                                    <img style="width: 100%;height: 150px;" class="img imageVideo" src="<?=(getFieldVal('pregnancy_period_image',$details)!='')?base_url().getFieldVal('pregnancy_period_image',$details):base_url().'assets/img/icon/not-available.jpg';?>" >
                                                                        <div class="iframediv">
                                                                        <iframe style="width: 100%;height: 150px;" class="youtube youtubesrc hidden" width="200" height="315" src="" frameborder="0" allowfullscreen>
                                                                        </iframe>
                                                                        </div>
                                                                        <?php }else{
                                                                        ($details->pregnancy_period_image)?$youtubelink=explode('=',$details->pregnancy_period_image):'';
                                                                        ?>
                                                                        <input type="hidden" class="srcimg" value="<?=base_url().'assets/img/icon/not-available.jpg';?>">
                                                                        <img style="width: 100%;height: 150px;" class="img imageVideo hidden" style="width: 100%;height: 150px;" src="" title="Click here for change Image" >
                                                                        <div class="iframediv">
                                                                        <iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
                                                                        </iframe>
                                                                        </div>
                                                            <?php } }?>
                                                            </a>	
                                                        </figure>
                                                        </div>
                                    
                                                        <!--end picture-->
                                    <div class="app_title" style='padding: 5px 0 0 5px;background-color:#F3A716;width: 100%;max-height: 45px;overflow-y: scroll;font-size: 12px;color: #fff;'>&nbsp;<span class="pull-right"><i class="fa fa-share-alt" aria-hidden="true" ></i> &nbsp; <i class="fa fa-bookmark-o" aria-hidden="true"></i></span>
                                        <p></p>&nbsp;
                                    </div>
                                    <div class="app_discriptiion" style='padding: 5px 0 0 5px;width: 100%;height: 230px;overflow-y: scroll;font-size: 12px;color: #000;'>
                                        <p></p>
                                    </div>
                                                        
                                    <div style="width: 100%;">
                                        <img src="<?php echo base_url().'assets/img/footer_app.jpeg'; ?>" style='width:100%'>
                                    </div> 
                                                        
				</div>
                
                
                
                
                
                
					<!--<div class="widget-bg">
					<div class="widget-body clearfix">
						<div class="col-md-12 mr-b-30 d-flex">
						<div class="blog-post blog-post-card text-center">
						<figure id="pregnancy_period_image">
									<?php //if($ID==''){ ?>
									<input type="hidden" class="srcimg" value="<?php //base_url().'assets/img/icon/not-available.jpg';?>">
									<img class="img imageVideo hidden" src="<?php //base_url().'assets/img/icon/not-available.jpg';?>" >
									<div class="iframediv">
									<iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="javascript:void(0);" frameborder="0" allowfullscreen>
									</iframe>
									</div>
										<?php //}else{ ?>
									<a href="javascript:void(0)" style="cursor:auto;">
											<?php //($details->pregnancy_period_image)?$imgextention=explode('.',$details->pregnancy_period_image):array(); ?>
											<?php //if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ ?>
											<input type="hidden" class="srcimg" value="<?php //base_url().'assets/img/icon/not-available.jpg';?>">
											<img class="img imageVideo" src="<?php //(getFieldVal('pregnancy_period_image',$details)!='')?base_url().getFieldVal('pregnancy_period_image',$details):base_url().'assets/img/icon/not-available.jpg';?>" >
												<div class="iframediv">
												<iframe class="youtube youtubesrc hidden" style="width: 100%;height: 150px;" src="<?php //echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
												</iframe>
												</div>
												<?php // }else{
												 //($details->pregnancy_period_image)?$youtubelink=explode('=',$details->pregnancy_period_image):'';
												?>
												<input type="hidden" class="srcimg" value="<?php //base_url().'assets/img/icon/not-available.jpg';?>">
												<img class="img imageVideo hidden" src="<?php //base_url().'assets/img/icon/not-available.jpg';?>" title="Click here for change Image" >
												<div class="iframediv">
												<iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="<?php //echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
												</iframe>
												</div>
									<?php // } }?>
									</a>	
							</figure>
						</div>
						
					</div>
					</div>
					</div>-->
                
                
					</div>
					<?php //} ?>
	
		</div>
			
		</div>
	</form>
	</div>
	
	
	<?php if(1==2){ ?>
	<!--for change awareness image Modal -->
	<div class="modal modal-info fade bs-modal-changeAwarenessImage" id="changeAwarenessImage" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Image</h5>
				</div>
				<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="../change_image">
				<div class="modal-body">
					<!-- Begin awareness Image Field -->
					<div class="blog-post blog-post-card text-center">
					<figure>	
					<span id="updateProfileImg" align="center">
						<?php ($details->pregnancy_period_image)?$imgextention=explode('.',$details->pregnancy_period_image):array(); ?>
                                                <?php if(in_array(end($imgextention),array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'))){ ?>
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
													<label for="pregnancy_period_image"><span class="file_type_text">You Tube Link</span> *</label>
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
					<!--<label for="awarenes_image">awareness image? * </label>
					<p>Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>
					
					<input id="pregnancy_period_image_edit" name="pregnancy_period_image_edit" class="pregnancy_period_image_edit" required="required" type="file"  data-rule-required="true" data-msg-required="Please select Image." >
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>	-->				
					<!-- End awareness Image Field -->	
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
					<?php } ?>
	<!--end-->
	<!--url link to upload the file in text editor-->
        <div>
            <input type="file" name="editorfile" class="editorfilegetlink" style="display: none;">
        </div>
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>

<script>
CKEDITOR.replace('editor', {
  height: 200,
  extraPlugins: 'colorbutton,colordialog'
});
</script>
<script>
CKEDITOR.replace('editor_vi', {
  height: 200,
  extraPlugins: 'colorbutton,colordialog'
});
</script>
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
        $(".youtubesrc").contents().find("body").html('');
        var defaultimgsrc=$('.srcimg').val();
        $('.file_type_text').text('ILLUSTRATION');
        $('.imageVideo').removeAttr('disabled');
        $('.imageVideo').removeClass('hidden');
        $('.imageVideo').attr('src',defaultimgsrc);
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
        var iframeE='<iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="javascript:void(0);" frameborder="0" allowfullscreen></iframe>';
        $('.iframediv').html('');
        $('.iframediv').html(iframeE);
        $('.file_type_text').text('Video clip');
        $('.imageVideo').attr('disabled',true);
        $('.imageVideo').addClass('hidden');
        $('.youtube').removeAttr('disabled');
        $('.youtube').removeClass('hidden');
        $('.youtubesrc').attr('src','javascript:void(0);');
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
            $('select[name="fileType"]').focus();
            $(this).val('');
            $('.file_error').show();
        }
        
    });
});
</script>
<script>
      $(document).ready(function() {   
        $(".select2").select2();   
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
				$(".img").attr('src', e.target.result);
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

$("#pregnancy_period_image").click(function () {
	var defaultimgsrc=$('.srcimg').val();
	//$('.img').attr('src', defaultimgsrc);
});

$(document).on('click','.submit',function(){
setTimeout(function(){$('.select2.select2-container.select2-container--default').css('display','block');},500);
})

$(document).on('blur','#youtube_link',function(){
		if($(this).val()!=''){
        var iframeE='<iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="javascript:void(0);" frameborder="0" allowfullscreen></iframe>';
        $('.iframediv').html('');
        $('.iframediv').html(iframeE);
        $('.file_type_text').text('You Tube Link');
        $('.imageVideo').attr('disabled',true);
        $('.imageVideo').addClass('hidden');
        $('.youtube').removeAttr('disabled');
        $('.youtube').removeClass('hidden');
        var youtubesrc='https://www.youtube.com/embed/';
        var str=$(this).val().split('=');
        if(str[str.length-1]!=''){
            $('.youtubesrc').attr('src',youtubesrc+str[str.length-1]);
        }
}else{

}
    })

        $(document).on('click','.save',function(){
                    preview();
                     $('html, body').animate({
                            scrollTop: $(".language").offset().top
                        }, 2000);
                    return true;
//                    var $orginal = $('.review');
//                    var $cloned = $orginal.clone();
//                    var $originalSelects = $orginal.find('select');
//                    $cloned.find('select').each(function(index, item) {
//                         $(item).val($originalSelects.eq(index).val() );
//
//                    });
//                    var $originalTextareas = $orginal.find('textarea');
//
//                    $cloned.find('textarea').each(function(index, item) {
//                    $(item).val($originalTextareas.eq(index).val());
//                    }); 
//                    //$cloned.appendTo('.modalbody');
//                    $('.modalbody').html($cloned);
                   var title='';
                    var description='';
                    $('.app_title p').text('');
                    $('.app_discriptiion p').text(''); //myContent.replace(/(<([^>]+)>)/ig,"")
                    if($(this).attr('is_lang')==2){
                            title=$('input[name="name"]').val();
                            description=$('textarea[name="description"]').val().replace(/(<([^>]+)>)/ig,"");
                        }else{
                            description=$('textarea[name="description_vi"]').val().replace(/(<([^>]+)>)/ig,"");
                            title=$('input[name="name_vi"]').val();
                        }
                        $('.app_title p').text(title);
                        $('.app_discriptiion p').text(description);
                     
                        $('.reviewmodal').modal('show');
                    //$('textarea').wysihtml5();
                    //$('.save_cancel').css('display','none');
                    //$('.modal_button').css('display','block');
        
        
//        
//		var html=$('.review').clone(true);
//		$('.modalbody').html(html);
//		$('.reviewmodal').modal('show');
//		$('.save_cancel').css('display','none');
//		$('.modal_button').css('display','block');
		
		//$(this).attr('type','submit');
	})
        
        function  preview(){
            var title='';        
            var description='';
            $('.app_discriptiion p').text(''); //myContent.replace(/(<([^>]+)>)/ig,"")
            if($('.save').attr('is_lang')==2){
                title=($('input[name="name"]').val())?$('input[name="name"]').val().toUpperCase():'';
                //description=($('textarea[name="description"]').val())?$('textarea[name="description"]').val():'';
                description=(CKEDITOR.instances['editor'].getData())?CKEDITOR.instances['editor'].getData():'';
            }else{
                title=($('input[name="name_vi"]').val())?$('input[name="name_vi"]').val().toUpperCase():'';
                //description=($('textarea[name="description_vi"]').val())?$('textarea[name="description_vi"]').val():'';
                description=(CKEDITOR.instances['editor_vi'].getData())?CKEDITOR.instances['editor_vi'].getData():'';
            }
                $('.app_title p').text(title);
                $('.app_discriptiion').html(description);
        }

	$(document).on('click','.cancel',function(){
		//$('.save').attr('type','button');
		//var html=$('.review').html();
		//$('.modalbody').html('');
		$('.reviewmodal').modal('hide');
		//$('.save_cancel').css('display','block');
		//$('.modal_button').css('display','none');

	})
	
	$(document).on('click','.language',function(){
		if($(this).attr('tabval')==1){
                        $('.save').attr('is_lang','1');
			$('.change_eng').css('display','none');
                        $('.change_vit').css('display','block');
		}else{
                        $('.save').attr('is_lang','2');
			$('.change_eng').css('display','block');
                        $('.change_vit').css('display','none');
		}
                preview();

	})
        
    $(function(){
//    $('.wysihtml5-sandbox').contents().find('body').on("keyup",function(event) {
//                preview();
//                
//        }); 
        $('.nav-tabs').find('.language').eq(0).trigger('click');
    })
    
$(document).on('click','.submit',function(){
if(validationForm()){
    $('.submit_click').trigger('click');
    }
})

function validationForm(){
    if($('.pregnancy_week').val()==''){
    $('.pregnancy_week_error').show();
    $('.pregnancy_week').focus();
    }else{
        $('.pregnancy_week_error').hide();
    }

if($('#name').val()==''){
    $('.name_error').show();
    $('#name').focus();
    }else{
        $('.name_error').hide();
    }
if($('#description').val()==''){
    $('.description_error').show();
    $('.pregnancy_week').focus();
    }else{
        $('.description_error').hide();
    }
    
if($('#name').val()=='' || $('.pregnancy_week').val()=='' || $('#description').val()==''){
        return false;
    }else{
        return true;
    }
}
$(document).on('change','.pregnancy_week',function(){
    if($('.pregnancy_week').val()==''){
    $('.pregnancy_week_error').show();
    $('.pregnancy_week').focus();
    }else{
        $('.pregnancy_week_error').hide();
    }
});


 function change_pregnancy_period_image(){
        $('.imageVideo').trigger('click');
    }  
    
    function remove_pregnancy_image (){
        var awid = $('.ID').val();
        var old_img = $('.remove_pregnancy_image').attr('img');
        if (awid!='undefined') {
                if (confirm('Are you sure to remove this image')) {
                    $.post('<?= base_url(); ?>pregnancy_period/removepregnancy_image', {id: awid,old_img:old_img}, function (data) {
                        var dt = JSON.parse(data);
                        if (dt.status > 0) {
                            alert('Removed successfully');
                            var defaultimgsrc=$('.srcimg').val();
                            $('.img').attr('src', defaultimgsrc);
                            $('.view_image ').attr('src',BASE_URL+'assets/img/icon/not-available.jpg');
                            $('.remove_pregnancy_image').attr('style','');
                            $('.remove_pregnancy_image').attr('style','width: 70px;float: left;pointer-events: none;opacity: .3;');
                        }
                    })
                }  
        }else{
            var defaultimgsrc=$('.srcimg').val();
            $('.img').attr('src', defaultimgsrc);
            $('.view_image ').attr('src',BASE_URL+'assets/img/icon/not-available.jpg');
            $('.remove_pregnancy_image').attr('style','');
            $('.remove_pregnancy_image').attr('style','width: 70px;float: left;pointer-events: none;opacity: .3;');
            
        }
    }
    function uploadeditorfilrclick(){
    $('.editorfilegetlink').trigger('click');
    }
    $(document).on('change','.editorfilegetlink',function(){
        var formdata=new FormData();
        formdata.append('filepic',$('.editorfilegetlink')[0].files[0]);
        $.ajax({
            type:'post',
            url:BASE_URL+'pregnancy_period/getEditorImageLink',
            data:formdata,
            contentType:false,
            processData:false,
            success:function(data){                                                
                if(data){
                    //alert(data);
                    $(".urllink").val(BASE_URL+data);
                    $(".urllink").css('display','block');
                        alert('Image uploaded successfully');
                        //$('.latest_history ').trigger('click');
                }else{
                    $('.').val('');
                        alert('Image upload Failed');
                }
            }
        });
        
    })
</script>