<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->

<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5">Health Awareness<?php //$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>

		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('awareness/addedit_awareness');?>" class="btn btn-info btn-sm">New</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?= base_url('awareness/deleteData');?>" title="Delete selected rows">Delete</a>
			<?php }?>
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
<!--                <div class="col-xm-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="speciality">Category</label>
                        <select class="form-control specialty" id="speciality" name="speciality" data-placeholder="Select" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}' >
                            <option value=""><?php echo 'cat1'; ?></option>    
                            <option value=""><?php echo 'cat2'; ?></option>    
                            <?php 
//                                if($doctor_specialization && count($doctor_specialization)>0){
//                                    foreach($doctor_specialization as $specialty){
                                ?>
                                <option value="<?php //$specialty->code;?>"><?php //$specialty->name;?></option>
                                <?php // } }?>
                        </select>
                    </div>
                </div>-->
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                            <label for="start_date" class="">Start Date</label>
                            <input id="start_date" name="start_date" class="form-control datepicker" required="required" type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' autocomplete="off">
                    </div>
                </div>
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                            <label for="end_date" class="">End Date</label>
                            <input id="end_date" name="end_date" class="form-control datepicker" required="required" type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' autocomplete="off">
                    </div>
                </div>
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                            <label for="category" class="">Category</label>
                            <select class="form-control select2 category" id="select4-id"  name="category">
                               <option value=""> Select </option>
 <?php 
                                    $categories=array('Gynecological health after give birth','Healthy - Beautiful women','Prenatal health','Nutrition for pregnant women','Healthy - Beautiful pregnant','Clever pregnant women','The development of fetus through each stage','Nutrition for children','Diseases prevention and treatment for children','The development of children in each stage');
                                    if($categories && count($categories)>0){
                                    $i=1;
                                    foreach($categories as $catgrow){
                                ?>
                                         <option value="<?=$i;?>"> <?=$catgrow;?> </option>
                                <?php $i++; } } ?>
                            </select>
                    </div>
                </div>
                <div class="col-xm-12 col-sm-12 col-md-2 col-lg-2">
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
                <div class="view_awareness_data" style="background: #fff;">
                </div>
	</div>
	</div>
	</div>

 <div class="modal modal-info fade" id="UpdatePRN" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Update PRN</h5>
				</div>
				<form accept-charset="UTF-8" method="post" id="formp">
				<div class="modal-body">
					<input type="hidden" class="PID" id="PID" name="PID">
					<input   class="prn_update form-control" id="prn_update" name="prn_update" value="">
                                        <span id="error-msg"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success btn-rounded ripple text-left savechange">Update</button>
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</main>
<?=$footer;?>
<!--End footer-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>-->
<script>
//    var confirm_bootD = function (title, message, callback) {
//        //setTimeout(function(){$('.bootbox.modal').addClass('show');},200);
//        bootbox.confirm({
//            title: title,
//            message: message,
//            buttons: {
//                cancel: {
//                    label: '<i class="fa fa-times"></i> Cancel',
//                },
//                confirm: {
//                    label: '<i class="fa fa-check"></i> Confirm',
//                }
//            },
//            callback: function (result) {
//                callback(result);
//            }
//        });
//
//    }
    
    
$(document).on('click','.search',function(){
        var category_id=$('.category').val()?JSON.stringify($('.category').val()):'';
		var active_filter=($('select[name="active_filter"]').val())?$('select[name="active_filter"]').val():'';
        //alert(active_filter);
		//category_id=JSON.stringify(category_id);
        var start_date=($('input[name="start_date"]').val())?$('input[name="start_date"]').val():'';
        var end_date=($('input[name="end_date"]').val())?$('input[name="end_date"]').val():'';
        var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
        var type_filter=($('select[name="type_filter"]').val())?$('select[name="type_filter"]').val():'';
        var cus_group=($('select[name="cus_group"]').val())?$('select[name="cus_group"]').val():'';  
        var author=($('select[name="author"]').val())?$('select[name="author"]').val():'';
        var editor=($('select[name="editor"]').val())?$('select[name="editor"]').val():'';
        var status=($('select[name="statusAw"]').val())?$('select[name="statusAw"]').val():'';
        var date_start=($('.date_start').val())?$('.date_start').val():'';
        var end_date2=($('.end_date2').val())?$('.end_date2').val():'';
        var maker_date=($('.maker_date').val())?$('.maker_date').val():'';
            var filter_no=parseInt(limit);
//         if(!start_date && !end_date){
//         }else{
                $('.view_awareness_data').html('');
                $('.loaderajax').show();
                $.post(BASE_URL+'awareness/awarenessList_pagination',{status:status,type_filter:type_filter,active_filter:active_filter,cus_group:cus_group,author:author,editor:editor,date_start:date_start,end_date2:end_date2,maker_date:maker_date, start_date:start_date,end_date:end_date,category_id:category_id,filter_no:filter_no},function(data){
                if(data){
                    $('.loaderajax').hide();
                    $('.view_awareness_data').html('');
                    $('.view_awareness_data').html(data);
                }
                });
            //}
     })
     
     
     $(document).on('click','.pagination li a',function(e){
            e.preventDefault();
             var category_id=$('.category').val()?JSON.stringify($('.category').val()):'';
            var start_date=($('input[name="start_date"]').val())?$('input[name="start_date"]').val():'';
            var end_date=($('input[name="end_date"]').val())?$('input[name="end_date"]').val():'';
            var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
            var type_filter=($('select[name="type_filter"]').val())?$('select[name="type_filter"]').val():'';
            var cus_group=($('select[name="cus_group"]').val())?$('select[name="cus_group"]').val():'';
            var author=($('select[name="author"]').val())?$('select[name="author"]').val():'';
            var editor=($('select[name="editor"]').val())?$('select[name="editor"]').val():'';
            var filter_no=parseInt(limit);
            
            if(!$(this).attr('data-ci-pagination-page')){
                return false;
            }else{
                $('.view_awareness_data').html('');
                $('.loaderajax').show();
                jQuery.ajax({
                type: "POST",
                url: jQuery(this).attr("href"),
                data:{type_filter:type_filter,cus_group:cus_group,author:author,editor:editor,start_date:start_date,end_date:end_date,category_id:category_id,filter_no:filter_no},
                success: function(data){
                                $('.loaderajax').hide();
                                $('.view_awareness_data').html('');
                                $('.view_awareness_data').html(data);
                }
                });
            }
            return false;
    });
     
	 
     $(function(){
         $('.search').trigger('click');
     })
</script>
<script>
      $(document).ready(function() {   
        $(".select2").select2();   
      });      
</script>

<script>
    $(document).on('click','.date_change',function(){
            $(this).hide();
            $(this).parent().find('.date_change_field').show();
    });
    
    $(document).on('change','.date_end',function(){
        var awid=$(this).closest('td').find('.date_change').data('id');
        //alert(awid);
            if($(this).val()!='' && awid){
                //var title = 'Confirm before change this date';
                //var message = 'Are you sure to change this date!';
                //confirm_bootD(title, message, function (result) {
                if (confirm('Are you sure to change this date!')) {
                $.post(BASE_URL+'awareness/updateEndDate', {id:awid,date_end:$(this).val()}, function(data){
                        if(data){
                            var dt=JSON.parse(data);
                            if(dt.status>0){
                                alert(dt.msg);
                                 $('.search').trigger('click');
                            }else{
                                alert(dt.msg);
                            }
                        }
                    });
                    }
                    //});
                    
                    
                    
                    
                }
    });
    
    

    $(document).on('change',".date_start",function(e1){
        if($(this).val()!=''){
        setTimeout(function(){$('.search').trigger('click')},500);
        }
        });
    $(document).on('change',".end_date2",function(e1){
        if($(this).val()!=''){
        setTimeout(function(){$('.search').trigger('click')},500);
        }
        });
    $(document).on('change',".maker_date",function(e1){
        if($(this).val()!=''){
        setTimeout(function(){$('.search').trigger('click')},500);
        }
        });
</script>
