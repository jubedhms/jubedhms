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
		<!--
		<div class="page-title-right d-none d-sm-inline-flex">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.html">Home</a>
		</li>
		<li class="breadcrumb-item active"><?= $mode.' '.$heading; ?></li>
		</ol>
		</div>
		-->
	<!-- /.page-title-right -->
	</div>
	<!-- /.page-title -->
	<!-- =================================== -->
	<!-- Different data widgets ============ -->
	<!-- =================================== -->
	
	<div class="widget-list">
	<div class="row">
	<div class="col-md-12 widget-holder">
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">	
		
		
		
		</div>
	</div>
	</div>
	</div>
	</div>
	
	
</main>
<!-- /.main-wrappper -->	





<!-- end page-->		

<!--Start footer-->
<?=$footer;?>
<!--End footer-->