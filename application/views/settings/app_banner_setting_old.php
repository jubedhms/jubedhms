<!--Start header-->
<?=$header;?>
<!--End header-->
<?php 
$ID= (isset($details->ID))?$details->ID:""; 
$url1=($this->uri->segment(1)!='')?$this->uri->segment(1):''; 
$curr_url=$url1;
//print_r($details);die;
?>
<!-- Start page-->
<style>
.txt  {
    font-weight: bold;
    font-size: 12px;
    line-height: 32px;
}
.modal-content .modal-header {
    background:#17bff0;
}
</style>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
<!-- Page Title Area -->
	
<!-- /.page-title -->
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->
 
			<div class="row page-title clearfix">
		<div class="page-title-left">
			<!--<h6 class="page-title-heading mr-0 mr-r-5"><?php // $mode.' '.$heading; ?></h6>-->
			<h6 class="page-title-heading mr-0 mr-r-5">APP Image Management</h6>
			
		</div>

		<!-- /.page-title-left -->
		<!-- <div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('patient/addedit_patient');?>" class="btn btn-info btn-sm">Add</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?=base_url('patient/deleteData');?>" title="Delete selected rows">Delete All</a>
			<?php }?>
			</span>
		</div> -->
	<!-- /.page-title-right -->
	</div>
	<div class="widget-list txt">
	 <div class="widget-body clearfix">
			<div class="overflow" style="overflow-x:hidden">
			 
<div class="row" >

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Tour Guide (default 6 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour1" data-id="<?=md5(1)?>" image_size="1">
<?php if(!empty($details[0]->src)){?>
<img class="img" src="<?=$details[0]->src?>" width="50" height="50x" title="Click here for change Imagedfg" wth="<?php echo isset($details[0]->width)?$details[0]->width:''; ?>" hth="<?php echo isset($details[0]->height)?$details[0]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[0]->width)?$details[0]->width:''; ?>" hth="<?php echo isset($details[0]->height)?$details[0]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour" data-id="<?=md5(2)?>" image_size="1">
<?php if(!empty($details[1]->src)){?>
<img class="img" src="<?=$details[1]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[1]->width)?$details[1]->width:''; ?>" hth="<?php echo isset($details[1]->height)?$details[1]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[1]->width)?$details[1]->width:''; ?>" hth="<?php echo isset($details[1]->height)?$details[1]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour" data-id="<?=md5(3)?>" image_size="1">
<?php if(!empty($details[2]->src)){?>
<img class="img" src="<?=$details[2]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[2]->width)?$details[2]->width:''; ?>" hth="<?php echo isset($details[2]->height)?$details[2]->height:''; ?>"
>
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>"  wth="<?php echo isset($details[2]->width)?$details[2]->width:''; ?>" hth="<?php echo isset($details[2]->height)?$details[2]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour" data-id="<?=md5(4)?>" image_size="1">
<?php if(!empty($details[3]->src)){?>
<img class="img" src="<?=$details[3]->src?>" width="50" height="50x" title="Click here for change Image"  wth="<?php echo isset($details[3]->width)?$details[3]->width:''; ?>" hth="<?php echo isset($details[3]->height)?$details[3]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[3]->width)?$details[3]->width:''; ?>" hth="<?php echo isset($details[3]->height)?$details[3]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour" data-id="<?=md5(5)?>" image_size="1">
<?php if(!empty($details[4]->src)){?>
<img class="img" src="<?=$details[4]->src?>" width="50" height="50x" title="Click here for change Image"   wth="<?php echo isset($details[4]->width)?$details[4]->width:''; ?>" hth="<?php echo isset($details[4]->height)?$details[4]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[4]->width)?$details[4]->width:''; ?>" hth="<?php echo isset($details[4]->height)?$details[4]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour" data-id="<?=md5(6)?>" image_size="1">
<?php if(!empty($details[5]->src)){?>
<img class="img" src="<?=$details[5]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[5]->width)?$details[5]->width:''; ?>" hth="<?php echo isset($details[5]->height)?$details[5]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[5]->width)?$details[5]->width:''; ?>" hth="<?php echo isset($details[5]->height)?$details[5]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img_tour" data-id="<?=md5(49)?>" image_size="1">
<?php if(!empty($details[48]->src)){?>
<img class="img" src="<?=$details[48]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[48]->width)?$details[48]->width:''; ?>" hth="<?php echo isset($details[48]->height)?$details[48]->height:''; ?>">
<?php }else{ ?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[48]->width)?$details[48]->width:''; ?>" hth="<?php echo isset($details[48]->height)?$details[48]->height:''; ?>">
<?php }?>
</a> 
 </div>
</div>
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Login (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(7)?>">
<?php if(!empty($details[6]->src)){?>
<img class="img" src="<?=$details[6]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[6]->width)?$details[6]->width:''; ?>" hth="<?php echo isset($details[6]->height)?$details[6]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[6]->width)?$details[6]->width:''; ?>" hth="<?php echo isset($details[6]->height)?$details[6]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
 <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Registration (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-id="<?=md5(8)?>" image_size="1">
<?php if(!empty($details[7]->src)){?>
<img class="img" src="<?=$details[7]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[7]->width)?$details[7]->width:''; ?>" hth="<?php echo isset($details[7]->height)?$details[7]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[7]->width)?$details[7]->width:''; ?>" hth="<?php echo isset($details[7]->height)?$details[7]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
 <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Send OTP (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(39)?>">
<?php if(!empty($details[38]->src)){?>
<img class="img" src="<?=$details[38]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[38]->width)?$details[38]->width:''; ?>" hth="<?php echo isset($details[38]->height)?$details[38]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[38]->width)?$details[38]->width:''; ?>" hth="<?php echo isset($details[38]->height)?$details[38]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
 <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Match OTP (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-id="<?=md5(40)?>" image_size="1">
<?php if(!empty($details[39]->src)){?>
<img class="img" src="<?=$details[39]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[39]->width)?$details[39]->width:''; ?>" hth="<?php echo isset($details[39]->height)?$details[39]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[39]->width)?$details[39]->width:''; ?>" hth="<?php echo isset($details[39]->height)?$details[39]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Reset Password OTP (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-id="<?=md5(41)?>">
<?php if(!empty($details[40]->src)){?>
<img class="img" src="<?=$details[40]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[40]->width)?$details[40]->width:''; ?>" hth="<?php echo isset($details[40]->height)?$details[40]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[40]->width)?$details[40]->width:''; ?>" hth="<?php echo isset($details[40]->height)?$details[40]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Reset Password Match OTP (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-id="<?=md5(42)?>" image_size="1">
<?php if(!empty($details[41]->src)){?>
<img class="img" src="<?=$details[41]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[41]->width)?$details[41]->width:''; ?>" hth="<?php echo isset($details[41]->height)?$details[41]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[41]->width)?$details[41]->width:''; ?>" hth="<?php echo isset($details[41]->height)?$details[41]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
                            
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Patient Dashboard (default 3 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(32)?>">
<?php if(!empty($details[31]->src)){?>
<img class="img" src="<?=$details[31]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[31]->width)?$details[31]->width:''; ?>" hth="<?php echo isset($details[31]->height)?$details[31]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[31]->width)?$details[31]->width:''; ?>" hth="<?php echo isset($details[31]->height)?$details[31]->height:''; ?>">
<?php }?>
</a> 
 </div>

 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(33)?>">
<?php if(!empty($details[32]->src)){?>
<img class="img" src="<?=$details[32]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[32]->width)?$details[32]->width:''; ?>" hth="<?php echo isset($details[32]->height)?$details[32]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[32]->width)?$details[32]->width:''; ?>" hth="<?php echo isset($details[32]->height)?$details[32]->height:''; ?>">
<?php }?>
</a> 
 </div>

 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(34)?>">
<?php if(!empty($details[33]->src)){?>
<img class="img" src="<?=$details[33]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[33]->width)?$details[33]->width:''; ?>" hth="<?php echo isset($details[33]->height)?$details[33]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[33]->width)?$details[33]->width:''; ?>" hth="<?php echo isset($details[33]->height)?$details[33]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
                            
  <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Hospital Map (default 3 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(36)?>">
<?php if(!empty($details[35]->src)){?>
<img class="img" src="<?=$details[35]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[35]->width)?$details[35]->width:''; ?>" hth="<?php echo isset($details[35]->height)?$details[35]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[35]->width)?$details[35]->width:''; ?>" hth="<?php echo isset($details[35]->height)?$details[35]->height:''; ?>">
<?php }?>
</a> 
 </div>

 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(37)?>">
<?php if(!empty($details[36]->src)){?>
<img class="img" src="<?=$details[36]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[36]->width)?$details[36]->width:''; ?>" hth="<?php echo isset($details[36]->height)?$details[36]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[36]->width)?$details[36]->width:''; ?>" hth="<?php echo isset($details[36]->height)?$details[36]->height:''; ?>">
<?php }?>
</a> 
 </div>

 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(38)?>">
<?php if(!empty($details[37]->src)){?>
<img class="img" src="<?=$details[37]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[37]->width)?$details[37]->width:''; ?>" hth="<?php echo isset($details[37]->height)?$details[37]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[37]->width)?$details[37]->width:''; ?>" hth="<?php echo isset($details[37]->height)?$details[37]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>                          
                            
  
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Health Awareness (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(35)?>">
<?php if(!empty($details[34]->src)){?>
<img class="img" src="<?=$details[34]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[34]->width)?$details[34]->width:''; ?>" hth="<?php echo isset($details[34]->height)?$details[34]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[34]->width)?$details[34]->width:''; ?>" hth="<?php echo isset($details[34]->height)?$details[34]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>                         
                            
                            
                            
 <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Due Date (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(9)?>">
<?php if(!empty($details[8]->src)){?>
<img class="img" src="<?=$details[8]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[8]->width)?$details[8]->width:''; ?>" hth="<?php echo isset($details[8]->height)?$details[8]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[8]->width)?$details[8]->width:''; ?>" hth="<?php echo isset($details[8]->height)?$details[8]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
 <div class="row" >

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Home Screen (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(10)?>">
<?php if(!empty($details[9]->src)){?>
<img class="img" src="<?=$details[9]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[9]->width)?$details[9]->width:''; ?>" hth="<?php echo isset($details[9]->height)?$details[9]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[9]->width)?$details[9]->width:''; ?>" hth="<?php echo isset($details[9]->height)?$details[9]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
 <div class="row" >

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Booking Appointment (default 4 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(11)?>">
<?php if(!empty($details[10]->src)){?>
<img class="img" src="<?=$details[10]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[10]->width)?$details[10]->width:''; ?>" hth="<?php echo isset($details[10]->height)?$details[10]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[10]->width)?$details[10]->width:''; ?>" hth="<?php echo isset($details[10]->height)?$details[10]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(12)?>">
<?php if(!empty($details[11]->src)){?>
<img class="img" src="<?=$details[11]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[11]->width)?$details[11]->width:''; ?>" hth="<?php echo isset($details[11]->height)?$details[11]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[11]->width)?$details[11]->width:''; ?>" hth="<?php echo isset($details[11]->height)?$details[11]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(13)?>">
<?php if(!empty($details[12]->src)){?>
<img class="img" src="<?=$details[12]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[12]->width)?$details[12]->width:''; ?>" hth="<?php echo isset($details[12]->height)?$details[12]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[12]->width)?$details[12]->width:''; ?>" hth="<?php echo isset($details[12]->height)?$details[12]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(14)?>">
<?php if(!empty($details[13]->src)){?>
<img class="img" src="<?=$details[13]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[13]->width)?$details[13]->width:''; ?>" hth="<?php echo isset($details[13]->height)?$details[13]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[13]->width)?$details[13]->width:''; ?>" hth="<?php echo isset($details[13]->height)?$details[13]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
                            
                            
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Doctor Profile (default 4 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(15)?>">
<?php if(!empty($details[14]->src)){?>
<img class="img" src="<?=$details[14]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[14]->width)?$details[14]->width:''; ?>" hth="<?php echo isset($details[14]->height)?$details[14]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[14]->width)?$details[14]->width:''; ?>" hth="<?php echo isset($details[14]->height)?$details[14]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(16)?>">
<?php if(!empty($details[15]->src)){?>
<img class="img" src="<?=$details[15]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[15]->width)?$details[15]->width:''; ?>" hth="<?php echo isset($details[15]->height)?$details[15]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[15]->width)?$details[15]->width:''; ?>" hth="<?php echo isset($details[15]->height)?$details[15]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(17)?>">
<?php if(!empty($details[16]->src)){?>
<img class="img" src="<?=$details[16]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[16]->width)?$details[16]->width:''; ?>" hth="<?php echo isset($details[16]->height)?$details[16]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[16]->width)?$details[16]->width:''; ?>" hth="<?php echo isset($details[16]->height)?$details[16]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(18)?>">
<?php if(!empty($details[17]->src)){?>
<img class="img" src="<?=$details[17]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[17]->width)?$details[17]->width:''; ?>" hth="<?php echo isset($details[17]->height)?$details[17]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[17]->width)?$details[17]->width:''; ?>" hth="<?php echo isset($details[17]->height)?$details[17]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
 
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> All Doctors (default 3 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(43)?>">
<?php if(!empty($details[42]->src)){?>
<img class="img" src="<?=$details[42]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[42]->width)?$details[42]->width:''; ?>" hth="<?php echo isset($details[42]->height)?$details[42]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[42]->width)?$details[42]->width:''; ?>" hth="<?php echo isset($details[42]->height)?$details[42]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(44)?>">
<?php if(!empty($details[43]->src)){?>
<img class="img" src="<?=$details[43]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[43]->width)?$details[43]->width:''; ?>" hth="<?php echo isset($details[43]->height)?$details[43]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[43]->width)?$details[43]->width:''; ?>" hth="<?php echo isset($details[43]->height)?$details[43]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(45)?>">
<?php if(!empty($details[44]->src)){?>
<img class="img" src="<?=$details[44]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[44]->width)?$details[44]->width:''; ?>" hth="<?php echo isset($details[44]->height)?$details[44]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[44]->width)?$details[44]->width:''; ?>" hth="<?php echo isset($details[44]->height)?$details[44]->height:''; ?>">
<?php }?>
</a> 
 </div>
</div>                         
  
  <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Doctors Details (default 3 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(46)?>">
<?php if(!empty($details[45]->src)){?>
<img class="img" src="<?=$details[45]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[45]->width)?$details[45]->width:''; ?>" hth="<?php echo isset($details[45]->height)?$details[45]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[45]->width)?$details[45]->width:''; ?>" hth="<?php echo isset($details[45]->height)?$details[45]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(47)?>">
<?php if(!empty($details[46]->src)){?>
<img class="img" src="<?=$details[46]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[46]->width)?$details[46]->width:''; ?>" hth="<?php echo isset($details[46]->height)?$details[46]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[46]->width)?$details[46]->width:''; ?>" hth="<?php echo isset($details[46]->height)?$details[46]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(48)?>">
<?php if(!empty($details[47]->src)){?>
<img class="img" src="<?=$details[47]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[47]->width)?$details[47]->width:''; ?>" hth="<?php echo isset($details[47]->height)?$details[47]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[47]->width)?$details[47]->width:''; ?>" hth="<?php echo isset($details[47]->height)?$details[47]->height:''; ?>">
<?php }?>
</a> 
 </div>
</div>                            
                            
                            
 <div class="row" >

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Vaccination (default 4 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(19)?>">
<?php if(!empty($details[18]->src)){?>
<img class="img" src="<?=$details[18]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[18]->width)?$details[18]->width:''; ?>" hth="<?php echo isset($details[18]->height)?$details[18]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[18]->width)?$details[18]->width:''; ?>" hth="<?php echo isset($details[18]->height)?$details[18]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(20)?>">
<?php if(!empty($details[19]->src)){?>
<img class="img" src="<?=$details[19]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[19]->width)?$details[19]->width:''; ?>" hth="<?php echo isset($details[19]->height)?$details[19]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[19]->width)?$details[19]->width:''; ?>" hth="<?php echo isset($details[19]->height)?$details[19]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(21)?>">
<?php if(!empty($details[20]->src)){?>
<img class="img" src="<?=$details[20]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[20]->width)?$details[20]->width:''; ?>" hth="<?php echo isset($details[20]->height)?$details[20]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[20]->width)?$details[20]->width:''; ?>" hth="<?php echo isset($details[20]->height)?$details[20]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(22)?>">
<?php if(!empty($details[21]->src)){?>
<img class="img" src="<?=$details[21]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[21]->width)?$details[21]->width:''; ?>" hth="<?php echo isset($details[21]->height)?$details[21]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[21]->width)?$details[21]->width:''; ?>" hth="<?php echo isset($details[21]->height)?$details[21]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>
 <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Shop (default 6 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(23)?>">
<?php if(!empty($details[22]->src)){?>
<img class="img" src="<?=$details[22]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[22]->width)?$details[22]->width:''; ?>" hth="<?php echo isset($details[22]->height)?$details[22]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[22]->width)?$details[22]->width:''; ?>" hth="<?php echo isset($details[22]->height)?$details[22]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(24)?>">
<?php if(!empty($details[23]->src)){?>
<img class="img" src="<?=$details[23]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[23]->width)?$details[23]->width:''; ?>" hth="<?php echo isset($details[23]->height)?$details[23]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[23]->width)?$details[23]->width:''; ?>" hth="<?php echo isset($details[23]->height)?$details[23]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(25)?>">
<?php if(!empty($details[24]->src)){?>
<img class="img" src="<?=$details[24]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[24]->width)?$details[24]->width:''; ?>" hth="<?php echo isset($details[24]->height)?$details[24]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[24]->width)?$details[24]->width:''; ?>" hth="<?php echo isset($details[24]->height)?$details[24]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(26)?>">
<?php if(!empty($details[25]->src)){?>
<img class="img" src="<?=$details[25]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[25]->width)?$details[25]->width:''; ?>" hth="<?php echo isset($details[25]->height)?$details[25]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[25]->width)?$details[25]->width:''; ?>" hth="<?php echo isset($details[25]->height)?$details[25]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(27)?>">
<?php if(!empty($details[26]->src)){?>
<img class="img" src="<?=$details[26]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[26]->width)?$details[26]->width:''; ?>" hth="<?php echo isset($details[26]->height)?$details[26]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[26]->width)?$details[26]->width:''; ?>" hth="<?php echo isset($details[26]->height)?$details[26]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(28)?>">
<?php if(!empty($details[27]->src)){?>
<img class="img" src="<?=$details[27]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[27]->width)?$details[27]->width:''; ?>" hth="<?php echo isset($details[27]->height)?$details[27]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[27]->width)?$details[27]->width:''; ?>" hth="<?php echo isset($details[27]->height)?$details[27]->height:''; ?>">
<?php }?>
</a> 
 </div>
</div>
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> About Us (default 3 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(29)?>">
<?php if(!empty($details[28]->src)){?>
<img class="img" src="<?=$details[28]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[28]->width)?$details[28]->width:''; ?>" hth="<?php echo isset($details[28]->height)?$details[28]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[28]->width)?$details[28]->width:''; ?>" hth="<?php echo isset($details[28]->height)?$details[28]->height:''; ?>">
<?php }?>
</a> 
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(30)?>">
<?php if(!empty($details[29]->src)){?>
<img class="img" src="<?=$details[29]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[29]->width)?$details[29]->width:''; ?>" hth="<?php echo isset($details[29]->height)?$details[29]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[29]->width)?$details[29]->width:''; ?>" hth="<?php echo isset($details[29]->height)?$details[29]->height:''; ?>">
<?php }?>
</a>
 </div>
 <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5(31)?>">
<?php if(!empty($details[30]->src)){?>
<img class="img" src="<?=$details[30]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[30]->width)?$details[30]->width:''; ?>" hth="<?php echo isset($details[30]->height)?$details[30]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[30]->width)?$details[30]->width:''; ?>" hth="<?php echo isset($details[30]->height)?$details[30]->height:''; ?>">
<?php }?></a> 
 </div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Pregnancy (default 40 photos)</div>
</div>
<div class="row">
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
	<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
		<div class="row">
		<?php for($i=49;$i<=88;$i++){?>
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				<a href="#" data-toggle="modal" class="upload_img" data-target="#myModal" data-id="<?=md5($i+1)?>">
					<?php if(!empty($details[$i]->src)){?>
					<img class="img" src="<?=$details[$i]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[$i]->width)?$details[$i]->width:''; ?>" hth="<?php echo isset($details[$i]->height)?$details[$i]->height:''; ?>">
					<?php }else{?>
					<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[$i]->width)?$details[$i]->width:''; ?>" hth="<?php echo isset($details[$i]->height)?$details[$i]->height:''; ?>">
					<?php }?>
				</a> 
			</div>	
		<?php }?>
		</div>
	</div>	
</div>
                            
<div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Fertility (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-id="<?=md5(90)?>" image_size="1">
<?php if(!empty($details[89]->src)){?>
<img class="img" src="<?=$details[89]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[89]->width)?$details[89]->width:''; ?>" hth="<?php echo isset($details[89]->height)?$details[89]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[89]->width)?$details[89]->width:''; ?>" hth="<?php echo isset($details[89]->height)?$details[89]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div> 

 <div class="row" >
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Reset Paasword (1 photos)</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">  </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
<a href="#" data-toggle="modal" class="upload_img" data-id="<?=md5(91)?>" image_size="1">
<?php if(!empty($details[90]->src)){?>
<img class="img" src="<?=$details[90]->src?>" width="50" height="50x" title="Click here for change Image" wth="<?php echo isset($details[90]->width)?$details[90]->width:''; ?>" hth="<?php echo isset($details[90]->height)?$details[90]->height:''; ?>">
<?php }else{?>
<img src="<?= base_url('assets/img/icon/upload-picture.png');?>" wth="<?php echo isset($details[90]->width)?$details[90]->width:''; ?>" hth="<?php echo isset($details[90]->height)?$details[90]->height:''; ?>">
<?php }?>
</a> 
 </div>
 </div>                             
<!--image width check-->
<img src="#" id="imgwidthcheck" style="display:none;">
<!--end image width check-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="<?=$curr_url?>/change_image">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Image</h5>
				</div>
            
			<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="<?=$curr_url?>/change_image">
				<div class="modal-body">
					<!-- Begin awarenes Image Field -->
					<div class="blog-post blog-post-card text-center">
					</div>	
					<input type="hidden" name="model_image" value="<?=rtrim($curr_url,"/")?>">
					<input type="hidden"  id="bann_id" name="ID" value=""  >
					<input type="hidden" id="file_name" name="file_name" value="src">
                                        <div>
					<label for="src">banner image? * </label><span id="updateProfileImg" align="center">
                                            <img style="width:85px;float:right;height:60px;border: 1px solid;" class="img" src="#" id="imgpreview" wth='' hth=''>
                                        </span></div><p></p>
					<p class="imagemsg">Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>
					
					<input id="imagesrc" name="src" class="src imagesrc"  type="file"  data-rule-required="true" data-msg-required="Please select Image." >
					<span class="errorfile" style="display: none;color: #f00;">Please select image
                                        </span>					
					<!-- End awarenes Image Field -->	
				</div>
				<div class="modal-footer">
					<span class="btn btn-success btn-rounded ripple text-left submit">Save</span>
					<button type="submit" class="btn btn-success btn-rounded ripple text-left saveimage hidden">Change</button>
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Cancel</button>
				</div>
				</form>
             
        </div>
    </div>
</div>

	</div>
	<!-- /.widget-body -->
	</div>
	<!-- /.widget-holder -->
</main>
<!-- /.main-wrappper -->	
<!-- end page-->		

<!--Start footer-->
<div style="position:relative">
<?=$footer;?>
</div>
  <!--for change awarenes image Modal -->
	<div class="modal modal-info fade bs-modal-changebannerImage" id="changebannerImage" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Image</h5>
				</div>
				<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="<?=$curr_url?>/change_image">
				<div class="modal-body">
					<!-- Begin awarenes Image Field -->
					
					<input type="hidden" name="model_image" value="<?=rtrim($curr_url,"/")?>">
					<input type="text"  id="bannid" name="ID"   >
					<input type="text"  id="bann_id" name="ID" value=""  >
					<input type="hidden" id="file_name" name="file_name" value="src">
					<label for="src">banner image? * </label>
					<p>Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>
					
					<input id="src" name="src" class="src"  type="file"  data-rule-required="true" data-msg-required="Please select Image." >
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>					
					<!-- End awarenes Image Field -->	
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
<!--End footer-->
 <script>
$('#myModal').on('show.bs.modal', function (e) {
    var myRoomNumber = $(e.relatedTarget).attr('data-id');
	$("#bann_id").val(myRoomNumber);
});

$(function(){
    $(".upload_img").click(function(){
        var ths=$(this);
        var wth=(ths.find('img').attr('wth'))?ths.find('img').attr('wth'):'';
        var hth=(ths.find('img').attr('hth'))?ths.find('img').attr('hth'):'';
        $("#imgpreview").attr('src','');
        $("#imgpreview").attr('src',$(this).find('img').attr('src'));
        setTimeout(function(){
            $('#bann_id').val(ths.data('id'));
            $('#imgpreview').attr('wth',wth);
            $('#imgpreview').attr('hth',hth);
        },200);
        $(".imagemsg").text('');
        $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be '+wth+'X'+hth);
        $("#myModal").modal('show');
    })
    //data-msg="Image dimension must be 500X1000."
    //data-msg="Image dimension must be 500X250."
    
})
$(function(){
    $(".upload_img_tour").click(function(){
        var ths=$(this);
        var wth=(ths.find('img').attr('wth'))?ths.find('img').attr('wth'):'';
        var hth=(ths.find('img').attr('hth'))?ths.find('img').attr('hth'):'';
        //alert($(this).find('img').attr('src'));
        $("#imgpreview").attr('src','');
        $("#imgpreview").attr('src',$(this).find('img').attr('src'));
        setTimeout(function(){
            $('#bann_id').val(ths.data('id'));
            $('#imgpreview').attr('wth',wth);
            $('#imgpreview').attr('hth',hth);
        
            },200);
        $(".imagemsg").text('');
        $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be '+wth+'X'+hth);
        $("#myModal").modal('show');
    })
    //data-msg="Image dimension must be 500X1000."
    //data-msg="Image dimension must be 500X250."
    
})
$(function(){
    $(".upload_img_tour1").click(function(){
        var ths=$(this);
        var wth=(ths.find('img').attr('wth'))?ths.find('img').attr('wth'):'';
        var hth=(ths.find('img').attr('hth'))?ths.find('img').attr('hth'):'';
        $("#imgpreview").attr('src','');
        $("#imgpreview").attr('src',$(this).find('img').attr('src'));
        setTimeout(function(){ 
            $('#bann_id').val(ths.data('id'));
            $('#imgpreview').attr('wth',wth);
            $('#imgpreview').attr('hth',hth);
    },500);
        $(".imagemsg").text('');
        $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be '+wth+'X'+hth);
        $("#myModal").modal('show');
    })
    //data-msg="Image dimension must be 500X1000."
    //data-msg="Image dimension must be 500X250."
    
})
$(function(){
       $('.modal').on('hidden.bs.modal', function (){
           $(".imagemsg").text('');
           $(".imagesrc").val('');
           $('.errorfile').css('display','none');
       $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be 500X250.');
    }); 
    })
 </script>
 <script>
      function readURL(input) {
          $("#imgwidthcheck").attr('src', '#');
        if (input.files && input.files[0]) {
            $('.errorfile').css('display','none');
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imgpreview").attr('src', e.target.result);
                //dimention check
                var $imaged=$("#imgwidthcheck").attr('src', e.target.result);
                $imaged.on('load', function() {
                    var ewidth =$("#imgpreview").attr('wth');
                    var eheight=$("#imgpreview").attr('hth');
                    if($imaged.width()==ewidth && $imaged.height()==eheight){
                        
                    }else{
                        $(".imagesrc").val('');
                        alert('Image dimention is not correct. Please upload the exact dimensions('+ewidth+'X'+eheight+') image.');
                    }
                });
                //end
            }
            reader.readAsDataURL(input.files[0]);
            $("#imgpreview").show();
        }
    }

    $(".imagesrc").change(function () {
        readURL(this);
    });
</script>
<script>
    $(function(){
        $('.submit').click(function(){
        if(document.getElementById('imagesrc').files.length!=0){
            $('.saveimage').trigger('click');
        }else{
            $('.errorfile').css('display','block');
        }
    });
    })
</script>