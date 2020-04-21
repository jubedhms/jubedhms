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
							<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
							<input type="hidden" class="show_status" name="show_status" value="<?php echo (isset($details->show_status))?$details->show_status:'0';?>">
								<label for="name" class="">Title *</label>
								<input type="text" class="form-control preview" id="name" name="name" value="<?= getFieldVal('name',$details);?>" autocomplete="off">
								<span class="name_error" style="display: none; color:red;">Please enter the title.</span>
								<!--<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span> --> 
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
								<label for="customer_group" class="">Customer Group *</label>
								<select class="form-control select2 customer_group" id="select-id"  name="customer_group[]" required="required" multiple>
								<optgroup label="Select All">
									<?php 
											$customer_group=array('Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
											if($customer_group && count($customer_group)>0){
											$i=0;
											$cgroup=isset($details->customer_group)?explode(',',$details->customer_group):array();
											foreach($customer_group as $customer_group){
									?>
											<option value="<?=$i;?>" <?=(in_array($i,$cgroup))?"selected":"";?> <?php echo (empty($cgroup) && $i==0)?'selected':''; ?>><?=$customer_group; ?></option>
									<?php $i++; }}?>
									</optgroup>
								</select>
								<span class="customer_group_error" style="display: none; color:red;">Please select customer group.</span>
								<!--<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>-->
							</div>
						</div>
					</div>
					
						<div class="row">
							<div class=" <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>  ">
							<div class="form-group">
								<label for="demographics" class="">Demographics</label>
								<select class="form-control select3 demographic" id="select2-id" name="demographics[]"  multiple>                                                                        
								<optgroup label="Select All">	
                                                                    <?php 
                                                                            $demographics=array('Ages','Income','Relationship','Location','Gender','Delivery at HPH');
                                                                            if($demographics && count($demographics)>0){
                                                                            $i=1;
                                                                            $dgraphic=isset($details->demographics)?explode(',',$details->demographics):array();
                                                                            foreach($demographics as $demographc){
                                                                        ?>
                                                                            <option value="<?=$i;?>" <?=(in_array($i,$dgraphic))?"selected":"";?>><?=$demographc; ?></option>
									<?php $i++; } }?>									
								</optgroup>
                                                                </select>
								<span class="demographics_error" style="display: none; color:red;">Please select demographic.</span>
								<!--<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span>-->
							</div>
                                                        </div>
                                                </div>
                                    
						<div class="row">
							<div class="col-md-3 age" style="<?php echo (isset($details->ages) && $details->ages)?'display:block':'display:none'; ?>">
							<div class="form-group">
								<label for="ages" class="">Ages </label>
								<select class="form-control select3 childdemo ages_select" name="ages[]" multiple>
                                                                        <?php 
                                                                                $ages=array('Under 18 years old','18-24 years old','25-34 years old','35-44 years old','Over 45 years old');
                                                                                if($ages && count($ages)>0){
                                                                                $i=1;
                                                                                $agearr=isset($details->ages)?explode(',',$details->ages):array();
                                                                                foreach($ages as $age){
                                                                        ?>
                                                                                <option value="<?=$i;?>" <?=(in_array($i,$agearr))?"selected":"";?>><?=$age; ?></option>
									<?php $i++; } }?>
								</select>
							</div>
                                                        </div>
                                                    
							<div class="col-md-3 income" style="<?php echo (isset($details->income) && $details->income)?'display:block':'display:none'; ?>">
							<div class="form-group">
								<label for="income" class="">Income </label>
								<select class="form-control select2 childdemo income_select" name="income[]" multiple>
                                                                        <?php 
											$incomes=array('< 10 mil/month','10-15 mil/month','16-20 mil/month','21-30 mil/month','31-40 mil/month','41-50 mil/month','> 50 mil/month');
											if($incomes && count($incomes)>0){
											$i=1;
											$incom=isset($details->income)?explode(',',$details->income):array();
											foreach($incomes as $income){
									?>
											<option value="<?=$i;?>" <?=(in_array($i,$incom))?"selected":"";?>><?=$income; ?></option>
									<?php $i++; } } ?>
								</select>
							</div>
                                                        </div>
							<div class="col-md-3 relationship" style="<?php echo (isset($details->relationship) && $details->relationship)?'display:block':'display:none'; ?>">
							<div class="form-group">
								<label for="relationship" class="">Relationship </label>
								<select class="form-control select2 childdemo relationship_select" name="relationship[]" multiple>
                                                                <?php 
                                                                    $relationship=array('Single','Married','Divorced');
                                                                    if($relationship && count($relationship)>0){
                                                                    $i=1;
                                                                    $reltnship=isset($details->relationship)?explode(',',$details->relationship):array();
                                                                    foreach($relationship as $rship){
                                                                ?>
                                                                    <option value="<?=$i;?>" <?=(in_array($i,$reltnship))?"selected":"";?>><?=$rship; ?></option>
                                                                <?php $i++; } } ?>
								</select>
							</div>
							</div>
							
							<!--<div class="col-md-3 location" style="<?php //echo (isset($details->location) && $details->location)?'display:block':'display:none'; ?>">
							<div class="form-group">
							<label for="location" class="">Location </label>
							<select class="form-control select2 childdemo location" name="location[]" multiple>
							<?php 
								//$locations=array('City', 'District', 'Nationwide');
								//$locations=array('City', 'District');
								//if($locations && count($locations)>0){
								//$i=1;
								//                                                                    $locatn=isset($details->location)?explode(',',$details->location):array();
								//foreach($locations as $location){
							?>
								<option value="<?php //$i;?>" <?php //(in_array($i,$locatn))?"selected":"";?>><?php //$location; ?></option>
							<?php //$i++; } } ?>
							</select>
							</div>
							</div>-->

							<div class="col-md-3 city" style="<?php echo (isset($details->province) && $details->province)?'display:block':'display:none'; ?>">
								<div class="form-group">
								<label for="provnce" class="">Province </label>
									<select class="form-control select2 childdemo province_select" name="province[]" multiple>
									<?php 
									if($provinces && count($provinces)>0){
									$aprovince=isset($details->province)?explode(',',$details->province):array();
									foreach($provinces as $province){
									?>
									<option value="<?=$province->ID;?>" <?=(in_array($province->ID,$aprovince))?"selected":"";?>><?=$province->name; ?></option>
									<?php } } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3 city" style="<?php echo (isset($details->city) && $details->city)?'display:block':'display:none'; ?>">
								<div class="form-group">
								<label for="city" class="">City </label>
                                                                <div class="city_select_div">
                                                                <select class="form-control select2 childdemo city_select" name="city[]" multiple>
									<?php 
									if($cities && count($cities)>0){
									$awcity=isset($details->city)?explode(',',$details->city):array();
									foreach($cities as $city){
                                                                            if(in_array($city->ID,$awcity)){
									?>
									<option value="<?php echo $city->ID;?>" <?php echo (in_array($city->ID,$awcity))?"selected":"";?>><?php echo $city->name; ?></option>
                                                                            <?php } } } ?>
                                                                </select>
								</div>
							</div>
							</div>

							<div class="col-md-3 district" style="<?php echo (isset($details->district) && $details->district)?'display:block':'display:none'; ?>">
								<div class="form-group">
								<label for="district" class="">District </label>
									<div class="district_select">
										<select class="form-control select2 childdemo district_select" name="district[]" multiple>
										<?php 
										if(isset($details->district)){
										if($districts && count($districts)>0){
										$awdistrict=isset($details->district)?explode(',',$details->district):array();
										foreach($districts as $district){
                                                                                    if(in_array($district->ID,$awdistrict)){
										?>
										<option value="<?php echo $district->ID;?>" <?php echo (in_array($district->ID,$awdistrict))?"selected":"";?>><?php echo $district->name; ?></option>
                                                                                    <?php } } } } ?>
										</select>
									</div>
							</div>
							</div>
							
							<div class="col-md-3 gender" style="<?php echo (isset($details->gender) && $details->gender)?'display:block':'display:none'; ?>">
							<div class="form-group">
								<label for="gender" class="">Gender </label>
								<select class="form-control select2 childdemo gender_select" name="gender[]" multiple>
                                                                    
                                                                <?php 
                                                                    $genders=array('Male', 'Female', 'Other');
                                                                    if($genders && count($genders)>0){
                                                                    $i=1;
                                                                    $gendr=isset($details->gender)?explode(',',$details->gender):array();
                                                                    foreach($genders as $gender){
                                                                ?>
                                                                    <option value="<?=$i;?>" <?=(in_array($i,$gendr))?"selected":"";?>><?=$gender; ?></option>
                                                                <?php $i++; } } ?>
								</select>
							</div>
                                                        </div>
                                                        <div class="col-md-3 deliveryathph" style="<?php echo (isset($details->deliveryathph) && $details->deliveryathph)?'display:block':'display:none'; ?>">
                                                        <div class="form-group">
                                                                <label for="deliveryathph" class="">Delivery at HPH </label>
                                                                <select class="form-control select2 childdemo deliveryathph_select" name="deliveryathph">
                                                                    <option value="">Select</option>
                                                                    <option value="Yes" <?=(isset($details->deliveryathph) && $details->deliveryathph=='Yes')?"selected":"";?>>Yes</option>
                                                                    <option value="No" <?=(isset($details->deliveryathph) && $details->deliveryathph=='No')?"selected":"";?>>No</option>
                                                                </select>
                                                        </div>
                                                        </div>
                                                </div>
                                    

                   <div class="row">
			<div class="<?php echo ($ID)?'col-md-3':'col-md-6'; ?> startdate">
				<div class="form-group">
					<label for="start_date" class="">Start Date *</label>
					<input id="start_date" name="start_date" class="form-control start_date_title" required="required" type="text" 
					value="<?=isset($details->start_date)?date('Y-m-d',strtotime($details->start_date)):date('Y-m-d');?>"
					data-rule-required="true" data-msg-required="Please select Date Of Birth.">
 
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                        
			<div class="col-md-3 starttime" style="<?php echo ($ID)?'display:block;':'display:none;'; ?>">
				<div class="form-group">
					<label for="schedule_time" class="">Schedule Time *</label>
                                        <input type="text" class="form-control timepicker" id="schedule_time" name="start_time" value="<?php echo isset($details->start_datetime)?date('H:i:s', strtotime($details->start_datetime)):'00:01 AM';?>" aria-invalid="false">
                                        <span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<label for="end_date" class="">End Date *  </label>
				<input id="end_date" name="end_date" class="form-control end_date_title" required="required" type="text" 
					value="<?=isset($details->end_date)?date('Y-m-d',strtotime($details->end_date)):date('Y-m-d');?>"
					data-rule-required="true" data-msg-required="Please select Date Of Birth.">
 				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
			</div>
                        </div>
                        </div>              
<!--                <div class="row">
                        <div class=" <?php //echo ($ID!='')?'col-md-12':'col-md-12' ?>">
                        <div class="form-group">
                            <label for="category" class="">Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="<?php // getFieldVal('category',$details);?>" autocomplete="off">
                            <span class="category_error" style="display: none; color:red;">Please enter the category.</span>
                        </div>
                        </div>
                </div> -->
                                    
                <div class="row">
                                <div class=" <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>  ">
                                <div class="form-group">
                                        <label for="category" class="">Category</label>
                                        <select class="form-control select2 category" id="select4-id"  name="category[]" multiple>
                                                <?php 
                                                               $categories=array('Gynecological health after give birth','Healthy - Beautiful women','Prenatal health','Nutrition for pregnant women','Healthy - Beautiful pregnant','Clever pregnant women','The development of fetus through each stage','Nutrition for children','Diseases prevention and treatment for children','The development of children in each stage');
                                                                if($categories && count($categories)>0){
                                                                $i=1;
                                                                $savedcatg=isset($details->category)?explode(',',$details->category):array();
                                                                foreach($categories as $catgrow){
                                                ?>
                                                                <option value="<?=$i;?>" <?=(in_array($i,$savedcatg))?"selected":"";?>><?=$catgrow; ?></option>
                                                <?php $i++; } }?>
                                        </select>
                                </div>
                                </div>
                </div>                    
                                    
                                    
                                    
                                    



					<img src="#" id="imgwidthcheck" style="display:none;">
					
						<div class="row">
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
                                                            
                                                        <?php ($details->awareness_image)?$imgextention=explode('.',$details->awareness_image):array(); ?>
                                                        <?php //if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){       
                                                            ($details->awareness_image)?$youtubelink=explode('=',$details->awareness_image):''; ?>    
                                                    <label for=""><span class="file_type_text" style="margin-left: 130px;"><?php echo ($details->file_type==3)?'URL Link':'THUMBNAIL IMAGE'; ?></span> *</label>
                                                    <div class="col-md-12" style="width: 180px;border: 1px solid #f0f0f0;margin-bottom: 3px;margin: auto;">
                                                        <div >
                                                            <img style="height: 110px;width: 100%;border:1px solid;" alt="image" class="view_image img imageVideo <?php echo ($details->file_type==1)?'':'hidden'; ?>" src="<?= (getFieldVal('awareness_image', $details) != '') ? base_url(getFieldVal('awareness_image', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                            <div class="iframediv2">
                                                            <iframe class="youtube youtubesrc <?php echo ($details->file_type==3)?'':'hidden'; ?>"  style="width: 100%;height: 100px;" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
                                                            </iframe>
                                                            </div>
<!--                                                            <div class="imageVideo <?php echo ($details->file_type==1)?'':'hidden'; ?>" style="display: flex;margin-top: 3px; ">
                                                            <div style="width: 70px;float: left;<?php echo (getFieldVal('awareness_image', $details) != '')?'':'pointer-events: none;opacity: .3;'; ?>" img="<?php echo $details->awareness_image; ?>" class="remove_awre_image" onclick="remove_awareness_image(this);">
                                                                <span class="btn btn-xs btn-info">Remove</span>
                                                            </div>	
                                                            <div style="width: 110px;float: left;" class="change_awareness_image" onclick="change_awareness_image();">
                                                                <span class="btn btn-xs btn-info">Change Image</span>
                                                            </div>
                                                            </div>-->
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                        <div style="display:none;">
                                                        <input type="file" class="form-control imageVideo <?php echo ($details->file_type==1)?'':'hidden'; ?>" <?php echo ($details->file_type==1)?'':'disabled'; ?> id="awareness_image" name="awareness_image">
                                                         </div>
                                                        <input type="text" class="form-control youtube <?php echo ($details->file_type==3)?'':'hidden'; ?>" <?php echo ($details->file_type==3)?'':'disabled'; ?> id="youtube_link" name="youtube_link" value="<?php echo ($details->file_type==3)?$details->awareness_image:''; ?>">
                                                        <!--<span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>-->
                                                        <span class="error" style="display: none;">
                                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                                        </span>
                                                               
							</div>
                                                    <?php }else{ ?>
                                                                <label for=""><span class="file_type_text" style="margin-left: 130px;">URL Link</span> *</label>
                                                                <div class="col-md-12" style="width: 180px;border: 1px solid #f0f0f0;margin-bottom: 3px;margin: auto;">
                                                                    <div>
                                                                        <img style="height: 110px;width: 100%;border:1px solid;" alt="image" class="view_image img imageVideo hidden" src="<?= (getFieldVal('awareness_image', $details) != '') ? base_url(getFieldVal('awareness_image', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                                        <div class="iframediv2" >
                                                                            <iframe style="width: 100%;height: 100px;" class="youtube youtubesrc" width="200" height="315" src="" frameborder="0" allowfullscreen>
                                                                            </iframe>
                                                                        </div>
                                                                    </div>
<!--                                                                    <div class="imageVideo hidden" style="display: flex;margin-top: 3px; ">
                                                                        <div style="width: 70px;float: left;<?php echo (getFieldVal('awareness_image', $details) != '')?'':'pointer-events: none;opacity: .3;'; ?>" class="remove_awre_image" onclick="remove_awareness_image(this);">
                                                                            <span class="btn btn-xs btn-info">Remove</span>
                                                                        </div>	
                                                                        <div style="width: 110px;float: left;" class="change_awareness_image" onclick="change_awareness_image();">
                                                                            <span class="btn btn-xs btn-info">Change Image</span>
                                                                        </div>	
                                                                    </div>-->
                                                                    
                                                                </div>
                                                                
                                                                <div>
                                                                    <!--<span class="imageVideo hidden" style="color: #8cc63f;font-size: 12px;">Note: Please upload the image of dimension 500X250 only.</span>-->
                                                                </div>
                                                    
                                                                <!--<label for="awareness_image"><span class="file_type_text">URL Link</span> *</label>-->
                                                                <div style="display:none;">
                                                                <input type="file" class="form-control imageVideo hidden" disabled id="awareness_image" name="awareness_image" data-rule-required="true">
                                                                </div>
                                                                <input type="text" class="form-control youtube" id="youtube_link" name="youtube_link" <?php if($ID==''){ ?>  data-rule-required="true" <?php } ?>>
								
								<span class="error" style="display: none;">
									<i class="error-log fa fa-exclamation-triangle"></i>
								</span> 
                                                    <?php } ?>
						</div>
					</div> 
					
					
					<div class="row">
						<div class="change_eng col-md-12">
							<div class="form-group">
								<label for="description" class="">English</label>
                                                                <textarea name="description" class="form-control" onkeydown="previoewapp(this);" data-toggle="wysiwyg"><?=getFieldVal('description',$details)?></textarea>

							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="change_vit col-md-12" style="display:none;"> 
							<div class="form-group">
								<label for="description_vi" class="">Tiếng Việt</label>
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
									<a href="javascript:void(0)" class="btn btn-primary no-print save" is_lang="2">Preview</a>
									<?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
                                        <a href="<?=base_url('awareness/addedit_awareness');?>/<?=MD5($details->ID);?>" class=" btn btn-success action-btn">Edit</a>
									<?php } ?>
										<!-- <button type="submit" class="btn btn-success no-print submit">Edit</button> -->
										<!--<a href="<?php //$main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
										<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
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
					<span><i class="feather feather-menu list-icon fs-20"></i> &nbsp;Health Awareness</span>
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
                                                                    <?php isset($details->awareness_image)?$imgextention=explode('.',$details->awareness_image):array(); ?>
                                                                    <?php if(in_array(end($imgextention),array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF')) || ($details->file_type==1)){ ?>
                                                                    <input type="hidden" class="srcimg" value="<?=base_url().'assets/img/icon/not-available.jpg';?>">
                                                                    <img style="width: 100%;height: 150px;" class="img imageVideo" src="<?=(getFieldVal('awareness_image',$details)!='')?base_url().getFieldVal('awareness_image',$details):base_url().'assets/img/icon/not-available.jpg';?>" >
                                                                        <div class="iframediv">
                                                                        <iframe style="width: 100%;height: 150px;" class="youtube youtubesrc hidden" width="200" height="315" src="" frameborder="0" allowfullscreen>
                                                                        </iframe>
                                                                        </div>
                                                                        <?php }else{
                                                                        isset($details->awareness_image)?$youtubelink=explode('=',$details->awareness_image):'';
                                                                        ?>
                                                                        <input type="hidden" class="srcimg" value="<?=base_url().'assets/img/icon/not-available.jpg';?>">
                                                                        <img style="width: 100%;height: 150px;" class="img imageVideo hidden" style="width: 100%;height: 150px;" src="" title="Click here for change Image" >
                                                                        <?php if($youtubelink){ ?>
                                                                        <div class="iframediv">
                                                                        <iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
                                                                        </iframe>
                                                                        </div>
                                                                        <?php }else{ ?>
                                                                        <div class="iframediv">
                                                                        <iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="javascript:void(0);" frameborder="0" allowfullscreen>
                                                                        </iframe>
                                                                        </div>
                                                                        <?php } ?>
                                                                        
                                                            <?php } }?>
                                                            </a>	
                                                        </figure>
                                                        </div>
                                    
                                                        <!--end picture-->
                                    <div class="app_title" style='padding: 5px 0 0 5px;background-color:#F3A716;width: 100%;max-height: 45px;overflow-y: scroll;font-size: 12px;color: #fff;'><span class="pull-right"><i class="fa fa-share-alt" aria-hidden="true" ></i> &nbsp; <i class="fa fa-bookmark-o" aria-hidden="true"></i></span>
                                        <p></p>&nbsp;
                                    </div>
                                    <div class="app_discriptiion" style='padding: 5px 0 0 5px;width: 100%;height: 230px;overflow-y: scroll;font-size: 12px;color: #000;'>
                                        <p></p>
                                    </div>
                                                        
                                    <div style="width: 100%;">
                                        <img src="<?php echo base_url().'assets/img/footer_app.jpeg'; ?>" style='width:100%'>
                                    </div> 
                                                        
				</div>
                
                
                
                
                
                
                
<!--					<div class="widget-bg">
					<div class="widget-body clearfix">
						<div class="col-md-12 mr-b-30 d-flex">
						<div class="blog-post blog-post-card text-center">
						<figure id="awareness_image">
									<?php  //if($ID==''){ ?>
									<input type="hidden" class="srcimg" value="<?php //base_url().'assets/img/icon/not-available.jpg';?>">
									<img class="img imageVideo hidden" src="<?php //base_url().'assets/img/icon/not-available.jpg';?>" >
									<div class="iframediv">
									<iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="javascript:void(0);" frameborder="0" allowfullscreen>
									</iframe>
									</div>
										<?php  //}else{ ?>
									<a href="javascript:void(0)" style="cursor:auto;">
											<?php //($details->awareness_image)?$imgextention=explode('.',$details->awareness_image):array(); ?>
											<?php //if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ ?>
											<input type="hidden" class="srcimg" value="<?php //base_url().'assets/img/icon/not-available.jpg';?>">
											<img class="img imageVideo" src="<?php //(getFieldVal('awareness_image',$details)!='')?base_url().getFieldVal('awareness_image',$details):base_url().'assets/img/icon/not-available.jpg';?>" >
												<div class="iframediv">
												<iframe class="youtube youtubesrc hidden" style="width: 100%;height: 150px;" src="" frameborder="0" allowfullscreen>
												</iframe>
												</div>
												<?php // }else{
												//($details->awareness_image)?$youtubelink=explode('=',$details->awareness_image):'';
												?>
												<input type="hidden" class="srcimg" value="<?php //base_url().'assets/img/icon/not-available.jpg';?>">
												<img class="img imageVideo hidden" src="" title="Click here for change Image" >
												<div class="iframediv">
												<iframe class="youtube youtubesrc" style="width: 100%;height: 150px;" src="<?php //echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0" allowfullscreen>
												</iframe>
												</div>
									<?php //} }?>
									</a>	
							</figure>
							<header>
								<a href="javascript:void(0)" class="btn btn-primary btn-round" data-toggle="modal" data-target=".bs-modal-changeAwarenessImage">Change Image  </a>
							</header>
							<footer class="mr-t-30">
								
							</footer>
						</div>
						 /.blog-post 
					</div>
					
					
					</div>
					</div>-->
            </div>
	<?php //} ?>
	
		
	</div>
	</div>
	</form>
	</div>
	
</main>
<?= $footer; ?>


<script>
$('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');

$(document).ready(function() {
	$('.wysihtml5-toolbar').html('');
});
$(function(){
        $('.nav-tabs').find('.language').eq(0).trigger('click');
    })
</script>
<script>
    
    $(document).on('click','.language',function(){
		if($(this).attr('tabval')==1){
			$('.change_eng').css('display','none');
                        $('.change_vit').css('display','block');
		}else{
			$('.change_eng').css('display','block');
                        $('.change_vit').css('display','none');
		}

	})
    
      $(document).ready(function() {   
        $(".select2").select2();  
        $(".category").select2();
        $(".childdemo").select2();   
        $(".demographic").select2(); 
      });    
      
      
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
        
    $(document).on('keyup','.preview',function(){
        preview();
    });
    
        function  preview(){
        var title='';        
        var description='';
        $('.app_discriptiion p').text(''); //myContent.replace(/(<([^>]+)>)/ig,"")
        if($('.save').attr('is_lang')==2){
            title=($('input[name="name"]').val())?$('input[name="name"]').val().toUpperCase():'';
            //description=($('textarea[name="description"]').val())?$('textarea[name="description"]').val().replace(/(<([^>]+)>)/ig,""):'';
            description=($('textarea[name="description"]').val())?$('textarea[name="description"]').val():'';
        }else{
            title=($('input[name="name_vi"]').val())?$('input[name="name_vi"]').val().toUpperCase():'';
            //description=($('textarea[name="description_vi"]').val())?$('textarea[name="description_vi"]').val().replace(/(<([^>]+)>)/ig,""):'';
            description=($('textarea[name="description_vi"]').val())?$('textarea[name="description_vi"]').val():'';
        }
            $('.app_title p').text(title);
            $('.app_discriptiion').html(description);
    }
      
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
</script>