<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->ID))?$details->ID:""; 
$NoImage='assets/img/icon/not-available.jpg';					
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
/*::-webkit-scrollbar {
    width: 5px;
}*/
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
					<div class="row change_eng">
						<div class=" <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>">
							<div class="form-group">
							<input type="hidden" name="ID" class="ID" value="<?= ($ID!='')?$ID:''; ?>">
								<label for="question" class="">Question *</label>
								<textarea type="text" class="form-control" name="question" autocomplete="off"><?= getFieldVal('question',$details);?></textarea>
								<span class="question_error" style="display: none; color:red;">Please enter the question.</span>
								 
                                                        </div>
						</div>
						<div class="<?php echo ($ID!='')?'col-md-12':'col-md-12' ?>">
                                                    <div class="form-group">
								<label for="answer" class="">Answer *</label>
                                                                <?php if($ID){$answer=getoption($details->ID,'en'); if(!empty($answer)){  if(!empty($answer)){ foreach($answer as $row){ ?>
								<input type="hidden" name="asnwer_id[]" value="<?php echo $row->ID; ?>">
                                                                <textarea type="text" class="form-control" name="answer[]" autocomplete="off"><?=($row->answer)?$row->answer:'';?></textarea>
								<span class="answer_error" style="display: none; color:red;">Please enter the answer.</span>
                                                                <?php } } }else{?>
                                                                <textarea type="text" class="form-control" name="answer" autocomplete="off"></textarea>
								<span class="answer_error" style="display: none; color:red;">Please enter the answer.</span>
                                                                <?php } }else{ ?>
                                                                <textarea type="text" class="form-control" name="answer" autocomplete="off"></textarea>
								<span class="answer_error" style="display: none; color:red;">Please enter the answer.</span>
                                                                <?php } ?>
                                                    </div>
						</div>
						
                                        </div>
					<div class="row change_vit" style="display: none;">
						<div class=" <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>">
							<div class="form-group">
                                                            <label for="question_vi" class="">CÂU HỎI</label>
                                                            <textarea type="text" class="form-control" name="question_vi" autocomplete="off"><?= getFieldVal('question_vi',$details);?></textarea>
                                                            <span class="question_vi_error" style="display: none; color:red;">Please enter the question.</span>
								 
                                                        </div>
						</div>
						<div class=" <?php echo ($ID!='')?'col-md-12':'col-md-12' ?>">
                                                    <div class="form-group">
                                                            <label for="answer" class="">Trả lời</label>
                                                            
                                                            <?php if($ID){ $answer_vi=getoption($details->ID,'vi'); if(!empty($answer_vi)){ if(!empty($answer_vi)){ foreach($answer_vi as $row){ ?>
                                                            <input type="hidden" name="asnwer_vi_id[]" value="<?php echo $row->ID; ?>">
                                                            <textarea type="text" class="form-control" name="answer_vi[]" autocomplete="off"><?=($row->answer_vi)?$row->answer_vi:'';?></textarea>
                                                            <span class="answer_vi_error" style="display: none; color:red;">Please enter the answer.</span>
                                                            <?php } } }else{ ?>
                                                            <textarea type="text" class="form-control" name="answer_vi" autocomplete="off"></textarea>
                                                            <span class="answer_vi_error" style="display: none; color:red;">Please enter the answer.</span>
                                                            <?php } }else{ ?>
                                                            <textarea type="text" class="form-control" name="answer_vi" autocomplete="off"></textarea>
                                                            <span class="answer_vi_error" style="display: none; color:red;">Please enter the answer.</span>
                                                            <?php } ?>
                                                            
                                                    </div>
						</div>
						
                                        </div>
						
						<div class="row save_cancel">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="box-footer text-center">
									<div class="mbottom" ></div>
										<button type="submit" class="btn btn-success no-print publish_click">Save<?php // echo ($ID!='')?'Update':'Save'; ?></button>
										
										<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
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
	</div>
	
	
	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>
<script>
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

	})
</script>