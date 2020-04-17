<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->

<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5">Manage Chat<?php //$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>

		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('chat_manage/addedit_question');?>" class="btn btn-info btn-sm">New</a>
			<?php } ?>
			</span>
		</div>
	<!-- /.page-title-right -->
	</div>
<!-- /.page-title -->
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->

	<div class="widget-list">
	<div class="row">
		<div class="col-md-12 widget-holder hidden">
		<form class="MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
						 
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">

		</div>
		<!-- /.media-body -->
		</div>
		</form>
		<!-- /.counter-w-info -->
		</div>

		<div class="col-md-12 widget-holder">
		<div class="row m-0">
                <div class="col-xm-12 col-sm-12 col-md-1 col-lg-1">
                </div>
                <div class="col-xm-12 col-sm-12 col-md-7 col-lg-7">
                    <div class="form-group">
                            <label for="question" class="">Search By Question</label>
                            <input id="question" name="question" class="form-control" type="text" autocomplete="off">
                    </div>
                </div>
<!--                <div class="col-xm-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group">
                            <label for="start_date" class="">Date</label>
                            <input id="start_date" name="start_date" class="form-control datepicker" type="text" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' autocomplete="off">
                    </div>
                </div>-->
                <div class="col-xm-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group">
                            <label for="question_type" class="">Question Type</label>
                            <select class="form-control" name="question_type">
                                <option value=""> Select </option>
                                <option value="1">Answered</option>
                                <option value="2">Not Answered</option>
                            </select>
                    </div>
                </div>
                <div class="col-xm-12 col-sm-12 col-md-1 col-lg-1">
                    <div class="form-group" style=" top: 35px; ">
                            <label class=""></label>
                            <button  class="btn btn-xs btn-success search">Search</button>
                     </div>
                </div>
            </div>
            <!--Loader-->
            <div class="loaderajax" style="text-align: center;display: none;">
                    <img src="<?php base_url(); ?>assets/img/Ajax-loader.gif" style="width: 150px;">
            </div>
                <div class="view_question_data" style="background: #fff;">
                </div>
	</div>
	</div>
	</div>
</main>
<?=$footer;?>
<script>
        $(document).on('click','.search',function(){
            var start_date=($('input[name="start_date"]').val())?$('input[name="start_date"]').val():'';
            var question=($('input[name="question"]').val())?$('input[name="question"]').val():'';
            var question_type=($('select[name="question_type"]').val())?$('select[name="question_type"]').val():'';
            var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
            var filter_no=parseInt(limit);
            $('.view_question_data').html('');
            $('.loaderajax').show();
            $.post(BASE_URL+'chat_manage/chatList_pagination',{start_date:start_date,question:question,question_type:question_type,filter_no:filter_no},function(data){
            if(data){
                $('.loaderajax').hide();
                $('.view_question_data').html('');
                $('.view_question_data').html(data);
            }
            });
        })
     
     
        $(document).on('click','.pagination li a',function(e){
            e.preventDefault();
            var start_date=($('input[name="start_date"]').val())?$('input[name="start_date"]').val():'';
            var question=($('input[name="question"]').val())?$('input[name="question"]').val():'';
            var question_type=($('select[name="question_type"]').val())?$('select[name="question_type"]').val():'';
            var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
            var filter_no=parseInt(limit);
            
            if(!$(this).attr('data-ci-pagination-page')){
                return false;
            }else{
                $('.view_question_data').html('');
                $('.loaderajax').show();
                jQuery.ajax({
                type: "POST",
                url: jQuery(this).attr("href"),
                data:{start_date:start_date,question:question,question_type:question_type,filter_no:filter_no},
                success: function(data){
                                $('.loaderajax').hide();
                                $('.view_question_data').html('');
                                $('.view_question_data').html(data);
                }
                });
            }
            return false;
        });
     
	 
    $(function(){
         $('.search').trigger('click');
    });
    
    $(document).on('change','.filter_no',function(){
         //$('.filter_no').change(function(){
             $('.search').trigger('click');
         //});
    })
</script>
<script>
      $(document).ready(function() {   
        $(".select2").select2();   
      });      
</script>

