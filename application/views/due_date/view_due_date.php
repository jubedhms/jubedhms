<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->ID))?$details->ID:""; 
?>

<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
	<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"> <?= $mode.' '.$heading; ?></h6>
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
						<div class="change_eng col-md-12">
							<div class="form-group">
								<label for="description" class="">Description</label>
								<textarea name="description" class="form-control description_en" id="description_en"><?=getFieldVal('description',$details)?></textarea>

							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="change_vit col-md-12" style="display:none;"> 
							<div class="form-group">
								<label for="description_vi" class="">MÔ TẢ</label>
								<textarea name="description_vi" class="form-control description_vi" id="description_vi"><?=getFieldVal('description_vi',$details)?></textarea>

							</div>
						</div>
					</div>
					
					<div class="row">
						<!--<div class="col-md-6">
							<div class="form-group">
							<input type="hidden" name="ID" value="<?php //($ID!='')?md5($ID):''; ?>">
								<label for="trimester" class="">Trimester *</label>
                                <select type="text" class="form-control" id="trimester" name="trimester" required="true" data-rule-required="true" data-msg-required="Please select Trimester">
									<option value="">Select</option>
									<option value="1" <?php //(getFieldVal('trimester',$details)=='1')?"selected":"";?>>1st TRIMESTER</option>
									<option value="2" <?php // (getFieldVal('trimester',$details)=='2')?"selected":"";?>>2nd TRIMESTER</option>
									<option value="3" <?php // (getFieldVal('trimester',$details)=='3')?"selected":"";?>>3rd TRIMESTER</option>
								</select> 
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							</div>
						</div>-->
					
						<div class="col-md-6">
							<div class="form-group">
								<label for="pregnancy_week" class="">Pregnancy Week *</label>
								<input type="hidden" name="ID" value="<?=($ID!='')?md5($ID):''; ?>">
								<select class="form-control pregnancy_week" id="pregnancy_week" name="pregnancy_week" required="true" data-rule-required="true" data-msg-required="Please select Pregnancy Week">
								<option value="">Select pregnancy week</option>
								<?php 
									for ($r=1; $r<=40; $r++){
									if(!in_array($r,$PregnancyWeeks)){	
								?> 
									<option value="<?= $r;?>" <?= ($r==getFieldVal('pregnancy_week',$details))?"selected":"";?> ><?= $r;?> Week</option>
									<?php }} ?>	
								</select>
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
<!--							<div class="form-group">
								<label for="image_src">Illustration *</label>
								<input type="file" class="form-control choose-image" id="image_src" name="image_src" accept=".JPG,.JPEG,.jpg,.jpeg,.png,.PNG" data-min-size="1" data-max-size="1000" table-id="<?php //$ID;?>" action="<?=$this->main_page;?>/change_image" show-image-src=".view_image" show-image-href=".image-lightbox" <?=($ID=='')?'data-rule-required="true" data-msg-required="Please select Illustration"':'';?> >
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							</div>-->
                                                    
                                                    <div class="widget-body---">
                                                    <div class="col-md-12">
                                                        <label for="image" class="image_b">Illustration *</label>
                                                        <span class="error" style="display:none;margin-left:-237px">
                                                            <i class="error-log fa fa-exclamation-triangle"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12" style="width: 180px;border: 1px solid #f0f0f0;margin-bottom: 3px;">
                                                        <div style="margin-left: 28px;">
                                                            <img style="height: 110px;width: 100px;border:1px solid;border-radius: 50%;" alt="image" class="view_image img" src="<?= (getFieldVal('image_src', $details) != '') ? base_url(getFieldVal('image_src', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                        </div>
                                                    </div>
<!--                                                    <div class="col-md-12">
                                                        <div style="width: 70px;float: left;<?php echo (getFieldVal('image_src', $details) != '')?'':'pointer-events: none;opacity: .3;'; ?>" img="<?php echo $details->image_src; ?>" class="remove_dueDate_image" onclick="remove_dueDate_image(this);">
                                                            <span class="btn btn-xs btn-info">Remove</span>
                                                        </div>	
                                                        <div style="width: 110px;float: left;">
                                                            <input type="file" name="upload_image" id="upload_image" style="display:none;" />
                                                            <span class="btn btn-xs btn-info" onclick="uploadimg();">Change Image</span>
                                                        </div>	
                                                    </div>-->
                                                </div>
                                                    
                                                    
						</div>
					</div>
					
					
					<div class="row save_cancel">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="box-footer text-center">
									<!--<a href="javascript:void(0)" class="btn btn-primary no-print preview" >Preview</a>-->
									<!--<button type="submit" class="btn btn-success no-print submit_click">Save</button>-->
									<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
			
	<div class="col-md-3 widget-holder">
		<div class="row" style="background: white;">
			<div>
				<img src="<?php echo base_url('assets/img/due_date_header.jpeg'); ?>" style='width:100%'>
			</div> 
			
			<div class="row" style="min-height:100px;margin: 10px 5px 15px 10px;">
				<div class="col-md-3">
					<figure>
						<a href="<?=(getFieldVal('image_src',$details)!='')?base_url(getFieldVal('image_src',$details)):base_url('assets/img/icon/not-available.jpg');?>" class="image-lightbox" id="image-lightbox" title="" data-toggle="lightbox" data-type="image" style="cursor:zoom-in;">	
							<img class="view_image" src="<?=(getFieldVal('image_src',$details)!='')?base_url(getFieldVal('image_src',$details)):base_url('assets/img/icon/not-available.jpg');?>" style="min-height:70px; min-width:70px;" title="Click here for zoom image.">
						</a>	
					</figure>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-8">
					<br/>
					<p class="app_discriptiion" style="color:#8DC63F"></p>
				</div>
				
			</div>
							
			<div>
				<img src="<?php echo base_url('assets/img/due_date_footer.jpeg'); ?>" style='width:100%'>
			</div> 
												
		</div>
	</div>
		</div>
	</div>
	</form>
	</div>
	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>

<script>

$(document).ready(function(){
	$('.app_discriptiion').html($('.description_en').val());
});

$(document).on('click','.language',function(){
	if($(this).attr('tabval')==1){
		$('.change_eng').css('display','none');
		$('.change_vit').css('display','block');
		$('.app_discriptiion').html($('.description_vi').val());
	}else{
		$('.change_eng').css('display','block');
		$('.change_vit').css('display','none');
		$('.app_discriptiion').html($('.description_en').val());
	}
});

</script>
<script>
$('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');

$(document).ready(function() {
	$('.wysihtml5-toolbar').html('');
});

</script>