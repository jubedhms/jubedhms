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
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">Manage <?=$heading;?></a>
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
	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
	
	<div class="widget-list">
	<div class="row">
	<div class="col-md-12 widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
		 
        <div class="row">
			<div class="col-md-6 name_b">
    			<div class="form-group">
					<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
    				<label for="name" class="">Location Name *</label>
    				<input type="text" id="name" name="name" class="form-control" value="<?=isset($details->name)?$details->name:'';?>" required="required" data-rule-required="true" data-msg-required="Please select hospital location name.">
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
			</div>
			<div class="col-md-6 name_vi_b" style="display:none;">
    			<div class="form-group">
    				<label for="name_vi" class="">VỊ TRÍ BỆNH VIỆN</label>
    				<input type="text" id="name_vi" name="name_vi" class="form-control" value="<?=isset($details->name_vi)?$details->name_vi:'';?>" required="required" data-rule-required="true" data-msg-required="Please select hospital location name.">
<!--    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>-->
    			</div>
			</div>
			
			<div class="col-md-6">
                <div class="form-group">
				<label for="code" class="code_b">Location Code *</label>
    				<input type="text" id="code" name="code" class="form-control" value="<?=isset($details->code)?$details->code:'';?>" required="required" data-rule-required="true" data-msg-required="Please select hospital location code.">
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
                </div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
					<label for="country_code" class="country_code_b">Country Name *</label>
					<select class="form-control" id="country_code" name="country_code" required="required" data-rule-required="true" data-msg-required="Please select location.">
						<option value="">Select</option>
						<?php foreach($countries as $country){ ?>
							<option value="<?=$country->country_code1; ?>" <?= (getFieldVal('country_code',$details)==$country->country_code1)?"selected":"";?>> <?=$country->name; ?></option>
						<?php } ?>
					</select>
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
                </div>
			</div>
		</div>

<!--        <div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="description" class="">Description</label>
					<textarea name="description" class="form-control" rows="5" placeholder=""><?php //getFieldVal('description',$details)?></textarea>

 				</div>
			</div>
		</div>	-->

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
						<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
						<button type="submit" class="btn btn-success no-print submit">Save</button>	
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
    $(document).on('click', '.language', function () {
        if ($(this).attr('tabval') == 1) {
            
            $('.name_b ').hide();
            $('.name_vi_b ').show();
            
            
            $('.code_b').text('MÃ VỊ TRÍ');
            $('.country_code_b').text('TÊN QUỐC GIA');
        } else {
            
            $('.name_b ').show();
            $('.name_vi_b ').hide();
            
            $('.code_b').text('LOCATION CODE');
            $('.country_code_b').text('COUNTRY NAME ');
        }

    })

</script>