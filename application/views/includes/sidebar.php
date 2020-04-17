<?php 
$url1=($this->uri->segment(1)!='')?$this->uri->segment(1):'';
$url2=($this->uri->segment(2)!='')?$this->uri->segment(2):'';
$url3=($this->uri->segment(3)!='')?$this->uri->segment(3):'';
$curr_url=($url2!='')?$url1.'/'.$url2:$url1;
$curr_url=($url3!='')?$curr_url.'/'.$url3:$curr_url;
?>


<div class="content-wrapper">
        <!-- SIDEBAR -->
<aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">
<!-- User Details -->
<div class="side-user d-none">
	<div class="col-sm-12 text-center p-0 clearfix">
		<div class="d-inline-block pos-relative mr-b-10">
			<figure class="thumb-sm mr-b-0 user--online">
				<img src="assets/demo/users/user1.jpg" class="rounded-circle" alt="">
			</figure>
			<a href="page-profile.html" class="text-muted side-user-link">
				<i class="feather feather-settings list-icon"></i>
			</a>
		</div>
		<!-- /.d-inline-block -->
		<div class="lh-14 mr-t-5">
			<a href="page-profile.html" class="hide-menu mt-3 mb-0 side-user-heading fw-500"><!--Satyam--></a>
			<br><small class="hide-menu"><!--Developer--></small>
		</div>
	</div>
	<!-- /.col-sm-12 -->
</div>
<!-- /.side-user -->
<!-- Call to Action -->
<nav class="sidebar-nav">
<ul class="nav in side-menu">

<?php 
if(count($MODULE_LIST)>0){
foreach($MODULE_LIST as $details){
$active=($curr_url==$details->module_url)?'active':'';
$parentActive=(isset($details->childsurl) && in_array($curr_url,$details->childsurl))?'active':'';
?>
<li class="<?=$parentActive;?> <?=$active;?> <?=($details->childtotal >0)?'menu-item-has-children':'';?>">
<a href="<?= ($details->module_url!='')?base_url($details->module_url):'javascript:void(0)';?>">
<i class="<?= $details->icon;?> list-icon"></i> 
<span class="hide-menu">
	<?php 
		echo $details->module_name;
		if($details->childtotal >0){
	?>
		<span class="badge bg-primary">
			<?php //echo $details->childtotal?>
		</span>
	<?php }?>
</span>
</a>
<?php if($details->childtotal >0){?>
<ul class="list-unstyled sub-menu" id="<?=$details->ID;?>">
	<?php if(count($details->childlist)>0){
		foreach($details->childlist as $childdetails){
		$active=($curr_url==$childdetails->module_url)?'active':'';
	?>
	<li class="<?=$active;?>">
		<a class="" href="<?= ($childdetails->module_url!='')?base_url($childdetails->module_url):'javascript:void(0)';?>">
			<i class="<?= $childdetails->icon;?> list-icon"></i>
			<span><?= $childdetails->module_name;?></span>
		</a>
	</li>
	<?php }}?>
</ul>
<?php }?>
</a>
</li> 
<?php }}?>
<!-- /.side-menu -->
</nav>
<!-- /.sidebar-nav -->
</aside>