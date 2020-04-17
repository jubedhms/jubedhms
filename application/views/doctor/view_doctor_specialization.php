<!--Start header-->
<?=$header;?>
<!--End header-->

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
			<li class="breadcrumb-item"><a href="<?= $main_page;?>"></a>
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
					<input type="text" class="form-control" id="name" name="name" value="<?= getFieldVal('name',$details);?>" data-rule-required="true" data-msg-required="Please include your doctor speciality Name">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>  
				</div>
			</div>
			
			<div class="col-md-6">
    			<div class="form-group">
    				<label for="code" class="">Code *</label>
					<input type="text" class="form-control" id="code" name="code" value="<?= getFieldVal('code',$details);?>" data-rule-required="true" data-msg-required="Please include doctor speciality code">
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
					<textarea name="description" class="form-control" rows="5" placeholder=""><?=getFieldVal('description',$details)?></textarea>

 				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
					<div class="mbottom" ></div>
					<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
					<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
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
</script>