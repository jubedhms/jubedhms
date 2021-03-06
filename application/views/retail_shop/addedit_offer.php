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
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">Offer List</a>
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

	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
	
	<div class="widget-list">
	<div class="row">
	<div class="<?= ($ID!='')?'col-md-9':'col-md-12'?> widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
		 

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
				<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
					<label for="name" class="">Name *</label>
					<input type="text" class="form-control" id="name" name="name" value="<?= getFieldVal('name',$details);?>" data-rule-required="true" data-msg-required="Please include your Offer Name">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>  
				</div>
			</div>
			<?php if(empty($ID)){?>
			<div class="col-md-6">
				<div class="form-group">
					<label for="first_name" class="">Image *</label>
					<input type="file" class="form-control" id="offer_image" name="offer_image" >
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>  
				</div>
			</div>
			<?php }?>
			<div class="col-md-12">
				<div class="form-group">
					<label for="description" class="">Description</label>
					<textarea name="description" class="form-control" placeholder=""><?=getFieldVal('description',$details)?></textarea>

 				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="start_date" class="">Start Date *</label>
<input id="start_date" name="start_date" class="form-control datepicker" required="required" type="text" 
					value="<?=isset($details->start_date)?date('d-m-Y',strtotime($details->start_date)):date('d-m-Y');?>"
					data-plugin-options='{"autoclose": true,"format": "dd-mm-yyyy"}' 
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
					value="<?=isset($details->end_date)?date('d-m-Y',strtotime($details->end_date)):date('d-m-Y');?>"
					data-plugin-options='{"autoclose": true,"format": "dd-mm-yyyy"}' 
					data-rule-required="true" data-msg-required="Please select Date Of Birth.">
 				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="quantity" class="">Quantity</label>
				<input type="text" class="form-control" id="quantity" name="quantity" value="<?= getFieldVal('quantity',$details);?>" size="10" minlength="1" maxlength="10">
			</div>
		</div>
 
		<div class="col-md-6">
			<div class="form-group">
				<label for="customer_group" class="">Customer Group </label>
				<select class="form-control" id="customer_group" name="customer_group" required="required" data-rule-required="true" data-msg-required="Please select customer group.">
					<option value="">Select</option>
					<?php 
						$customer_group=array('All','Women','Pregnancy','Mom with Kids','Men');
						if($customer_group && count($customer_group)>0){
						foreach($customer_group as $customer_group){
					?>
						<option value="<?=$customer_group;?>" <?=($customer_group==getFieldVal('customer_group',$details))?"selected":"";?>><?=$customer_group;?></option>
					<?php }}?>
				</select>
				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
		</div>
		</div> 

		  
		
		 
		
		 
		 
				
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
					<button type="submit" class="btn btn-success no-print submit">Save</button>
					<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
					<!--<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>-->
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
			<figure id="offer_image">
			<a href="javascript:void(0)" data-toggle="modal" data-target=".bs-modal-changeOfferImage">		
				<img class="img" src="<?=(getFieldVal('image',$details)!='')?base_url().getFieldVal('image',$details):base_url().'assets/img/icon/not-available.jpg';?>" title="Click here for change Image" >
			</a>	
			</figure>
			<header>
				<a href="javascript:void(0)" class="btn btn-primary btn-round" data-toggle="modal" data-target=".bs-modal-changeOfferImage">Change Image  </a> 
			</header>
			<footer class="mr-t-30">
				
			</footer>
		</div>
		<!-- /.blog-post -->
	</div>
	
	
	</div>
	</div>
	</div>
	<?php } ?>
	
	
	
	
	
	
	</div>
	</div>
	</form>
	
	
	
	
	<!--for change offer image Modal -->
	<div class="modal modal-info fade bs-modal-changeOfferImage" id="changeOfferImage" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2"> image</h5>
				</div>
				<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="../change_image">
				<div class="modal-body">
					<!-- Begin offer Image Field -->
					<div class="blog-post blog-post-card text-center">
					<figure>	
					<span id="updateProfileImg" align="center">
						<img class="img" src="<?=(getFieldVal('image',$details)!='')?base_url().getFieldVal('image',$details):base_url().'assets/images/icon/not-available.jpg';?>" />
					</span>
					</figure>
					</div>	
					<input type="hidden" name="model_image" value="<?=rtrim($curr_url,"/")?>">
					<input type="hidden" name="ID" value="<?= ($ID); ?>">
					<input type="hidden" id="file_name" name="file_name" value="offer_image">
					<label for="offer_image">Offer image? * </label>
					<p>Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>
					
					<input id="offer_image" name="offer_image" class="offer_image" required="required" type="file"  data-rule-required="true" data-msg-required="Please select Image." >
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>					
					<!-- End offer Image Field -->	
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-rounded ripple text-left">Change</button>
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