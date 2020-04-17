<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->ID))?$details->ID:""; 
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
			<div class="col-md-12 widget-holder">
				<div class="widget-bg">
					<div class="widget-body clearfix">
						<div class="row">
							<div class="col-md-9 widget-holder">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<input type="hidden" name="ID" id="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
											<label for="name" class="">Product Name *</label>
											<input type="text" class="form-control" id="name" name="name" value="<?= getFieldVal('name',$details);?>" data-rule-required="true" data-msg-required="Please include your Product Name">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="product_id" class="">Product ID *</label>
											<input type="text" class="form-control" id="product_id" name="product_id" value="<?= getFieldVal('product_id',$details);?>" data-rule-required="true" data-msg-required="Please include your Product ID">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
								</div>
								
								<div class="row hidden">
									<div class="col-md-6">
										<div class="form-group">
											<label for="customer_group" class="">Customer Group </label>
											<select class="form-control" id="customer_group" name="customer_group" required="required" data-rule-required="true" data-msg-required="Please select customer group.">
												<option value="">Select</option>
												<?php 
													$customerGroups=array('0'=>'All','1'=>'Pregnancy','2'=>'Non-Pregnancy','3'=>'Mom with first kid','4'=>'Mon with kid+');
													if($customerGroups && count($customerGroups)>0){
													foreach($customerGroups as $key=>$value){
												?>
													<option value="<?=$key;?>" <?=($details && $key==$details->customer_group)?"selected":"";?>><?=$value;?></option>
												<?php }}?>
											</select>
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
												<label for="image" class=""></label>
																
										</div>
									</div>	
								</div>
									
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="min_quantity" class="">Min Quantity For Alert*</label>
											<input type="number" class="form-control number" id="min_quantity" name="min_quantity" value="<?= (isset($details->min_quantity) && $details->min_quantity!='')?$details->min_quantity:'10';?>" data-rule-required="true" data-msg-required="Please include product min quantity">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="quantity" class="">Quantity *</label>
											<input type="number" class="form-control number" id="quantity" name="quantity" value="<?= (isset($details->quantity) && $details->quantity!='')?$details->quantity:'0';?>" data-rule-required="true" data-msg-required="Please include product quantity">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
								</div>
								
																<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category" class="">Category *</label>
											<select class="form-control" id="category" name="category" required="required" data-rule-required="true" data-msg-required="Please select category.">
												<option value="">Select</option>
												<?php 
													$categoryCodes=['1'=>'Product','2'=>'Service'];
													
													if($categoryCodes && count($categoryCodes)>0){
													foreach($categoryCodes as $key=>$value){
												?>
													<option value="<?=$key;?>" <?=($details && $key==$details->category)?"selected":"";?>><?=$value;?></option>
												<?php }}?>
											</select>
											
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>  
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="currency_code" class="">Currency *</label>
											<select class="form-control" id="currency_code" name="currency_code" required="required" data-rule-required="true" data-msg-required="Please select currency Symbol.">
												<?php 
													$currencyCodes=['&#x24;'=>'USD (&#x24;)','&#8363;'=>'VND (&#8363;)'];
													if($currencyCodes && count($currencyCodes)>0){
													foreach($currencyCodes as $key=>$value){
												?>
													<option value="<?=$key;?>" <?=($details && $key==$details->currency_code)?"selected":"";?>><?=$value;?></option>
												<?php }}?>
											</select>
											
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
												<figure id="product_image" style="height:175px;">
													<a href="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" class="image-lightbox" id="image-lightbox" title="" data-toggle="lightbox" data-type="image" style="cursor:zoom-in;">	
														<img class="view_image" src="<?=(getFieldVal('image',$details)!='')?base_url(getFieldVal('image',$details)):base_url('assets/img/icon/not-available.jpg');?>" style="height:100%;width:100%;object-fit: contain;" title="Click here for zoom image.">
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
								<div class="col-md-3">
									<div class="form-group">
										<label for="list_price" class="">List Price *</label>
										
										<input type="hidden" class="form-control" id="currency_code" name="currency_code" value="<?= (isset($details->currency_code) && $details->currency_code!='')?$details->currency_code:'&#x24;';?>" data-rule-required="true" data-msg-required="Please include currency Symbol">
										
										<input type="number" class="form-control number" id="list_price" name="list_price" value="<?= (isset($details->list_price) && $details->list_price>0)?$details->list_price:'0.00';?>"  step="any" data-rule-required="true" data-msg-required="Please include product original price">
										<span class="error" style="display: none;">
											<i class="error-log fa fa-exclamation-triangle"></i>
										</span>  
									</div>
								</div>
								
								<div class="col-md-3"> 
									<div class="form-group">
										<label for="quantity" class="">Discount (Percentage) *</label>
										<input type="number" class="form-control number" id="discount_percent" name="discount_percent" value="<?= (isset($details->discount_percent) && $details->discount_percent>0)?(fmod($details->discount_percent, 1)?$details->discount_percent:(int)$details->discount_percent):'0';?>" step="number" data-rule-required="true" data-msg-required="Please include product discount percentage">
										<span class="error" style="display: none;">
											<i class="error-log fa fa-exclamation-triangle"></i>
										</span> 
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label for="quantity" class="">Discount (Amount) *</label>
										<input type="number" class="form-control number" id="discount_amount" name="discount_amount" value="<?= (isset($details->discount_amount) && $details->discount_amount>0)?$details->discount_amount:'0.00';?>" step="any" data-rule-required="true" data-msg-required="Please include product discount amount">
										<span class="error" style="display: none;">
											<i class="error-log fa fa-exclamation-triangle"></i>
										</span> 
									</div>
								</div>
							
								<div class="col-md-3">
									<div class="form-group">
										<label for="sale_price" class="">Sale Price *</label>
										<input type="number" class="form-control number" id="sale_price" name="sale_price" value="<?= (isset($details->sale_price) && $details->sale_price>0)?$details->sale_price:'0.00';?>" readonly="readonly" data-rule-required="true" step="any" data-msg-required="Please include product sale price">
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
											<input id="home_banner_start_date" name="home_banner_start_date" class="form-control" required="required" type="text" value="<?= (isset($details->home_banner_start_date) && $details->home_banner_start_date!='0000-00-00' && $details->home_banner=='1')?$details->home_banner_start_date:'';?>" data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control" type="time" id="home_banner_start_time" name="home_banner_start_time" value="<?=(isset($details->home_banner_start_time) && $details->home_banner=='1')?DateTime($details->home_banner_start_time,'h:i A'):'';?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="home_banner_end_date" name="home_banner_end_date" class="form-control" required="required" type="text" value="<?= (isset($details->home_banner_end_date) && $details->home_banner_end_date!='0000-00-00' && $details->home_banner=='1')?$details->home_banner_end_date:'';?>" data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control" id="home_banner_end_time" name="home_banner_end_time"  value="<?=(isset($details->home_banner_end_time) && $details->home_banner=='1')?DateTime($details->home_banner_end_time,'h:i A'):'';?>">
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
											<input id="home_slider_start_date" name="home_slider_start_date" class="form-control" required="required" type="text" value="<?= (isset($details->home_slider_start_date) && $details->home_slider_start_date!='0000-00-00' && $details->home_slider_banner=='1')?$details->home_slider_start_date:'';?>" data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control" type="time"  id="home_slider_start_time" name="home_slider_start_time" value="<?=(isset($details->home_slider_start_time) && $details->home_slider_banner=='1')?DateTime($details->home_slider_start_time,'h:i A'):'';?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="home_slider_end_date" name="home_slider_end_date" class="form-control" required="required" type="text" value="<?= (isset($details->home_slider_end_date) && $details->home_slider_end_date!='0000-00-00' && $details->home_slider_banner=='1')?$details->home_slider_end_date:'';?>" data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control" id="home_slider_end_time" name="home_slider_end_time"  value="<?=(isset($details->home_slider_end_time) && $details->home_slider_banner=='1')?DateTime($details->home_slider_end_time,'h:i A'):'';?>">
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
											<input id="notification_banner_start_date" name="notification_banner_start_date" class="form-control" required="required" type="text" value="<?= (isset($details->notification_banner_start_date) && $details->notification_banner_start_date!='0000-00-00' && $details->notification_banner=='1')?$details->notification_banner_start_date:'';?>" data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control" type="time"  id="notification_banner_start_time" name="notification_banner_start_time" value="<?=(isset($details->notification_banner_start_time) && $details->notification_banner=='1')?DateTime($details->notification_banner_start_time,'h:i A'):'';?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="notification_banner_end_date" name="notification_banner_end_date" class="form-control" required="required" type="text" value="<?= (isset($details->notification_banner_end_date) && $details->notification_banner_end_date!='0000-00-00' && $details->notification_banner=='1')?$details->notification_banner_end_date:'';?>" data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control" id="notification_banner_end_time" name="notification_banner_end_time"  value="<?=(isset($details->notification_banner_end_time) && $details->notification_banner=='1')?DateTime($details->notification_banner_end_time,'h:i A'):'';?>">
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
											<input id="notification_page_start_date" name="notification_page_start_date" class="form-control" required="required" type="text" value="<?= (isset($details->notification_page_start_date) && $details->notification_page_start_date!='0000-00-00' && $details->notification_page=='1')?$details->notification_page_start_date:'';?>" data-rule-required="true" data-msg-required="Please select start date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span> 
									
											<input type="text" class="form-control" type="time"  id="notification_page_start_time" name="notification_page_start_time" value="<?=(isset($details->notification_page_start_time) && $details->notification_page=='1')?DateTime($details->notification_page_start_time,'h:i A'):'';?>">
										</div>
									</div>	
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Time End</label> 
										<div class="input-group">
											<input id="notification_page_end_date" name="notification_page_end_date" class="form-control" required="required" type="text" value="<?= (isset($details->notification_page_end_date) && $details->notification_page_end_date!='0000-00-00' && $details->notification_page=='1')?$details->notification_page_end_date:'';?>" data-rule-required="true" data-msg-required="Please select end date">
											<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>
											
											
											<input type="text" class="form-control" id="notification_page_end_time" name="notification_page_end_time"  value="<?=(isset($details->notification_page_end_time) && $details->notification_page=='1')?DateTime($details->notification_page_end_time,'h:i A'):'';?>">
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
										<!--<a href="<?php // $main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
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
	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>
<script>
$('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');
$(document).ready(function() {
	$('.wysihtml5-toolbar').html('');
});
</script>