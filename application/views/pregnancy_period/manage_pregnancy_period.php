<?=$header;?>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?=$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('pregnancy_period/addedit_pregnancy_period');?>" class="btn btn-info btn-sm">New</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?= base_url('pregnancy_period/deleteData');?>" title="Delete selected rows">Delete</a>
			<?php }?>
			</span>
		</div>
	</div>
	<div class="widget-list">
	<div class="row">
		<div class="col-md-12 widget-holder hidden">
		<form class="MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
						 
		<div class="widget-bg">
                    <div class="widget-heading clearfix">
                    <h5>  </h5>
                    </div>
                    <div class="widget-body clearfix">
                    </div>
		</div>
		</form>
		</div>
		<div class="col-md-12 widget-holder">
                <div class="row m-0"> 
                    <div class="col-xm-12 col-sm-12 col-md-1 col-lg-3">
                    </div>
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                            <label for="start_date" class="">From Posted Date</label>
                            <input id="start_date" name="from_date" class="form-control datepicker from_date"  type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' autocomplete="off">
                    </div>
                </div>
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                            <label for="to_date" class="">To Posted Date</label>
                            <input id="end_date" name="to_date" class="form-control datepicker to_date" type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' autocomplete="off">
                    </div>
                </div>

                <div class="col-xm-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group" style=" top: 35px; ">
                            <label class=""></label>
                            <button  class="btn btn-xs btn-success search">Search</button>
                    </div>
                </div>
                </div>
                    
                    
                    <div class="widget-bg">
                        
                        <div class="widget-body clearfix">
                            <!--Loader-->
                            <div class="loaderajax" style="text-align: center;display: none;">
                                    <img src="<?php base_url(); ?>assets/img/Ajax-loader.gif" style="width: 150px;">
                            </div>
                            <div class="view_pregnancy_data" style="background: #fff;">
                            </div>
                            
                        </div>
                    </div>
                </div>
	</div>
	</div>
</main>
<?=$footer;?>

<script>
$(document).on('click','.search',function(){
    var type_filter=($('select[name="type_filter"]').val())?$('select[name="type_filter"]').val():'';
    var active_filter=($('select[name="active_filter"]').val())?$('select[name="active_filter"]').val():'';
    var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
    var filter_no=parseInt(limit);
    var author=($('select[name="author"]').val())?$('select[name="author"]').val():'';
    var editor=($('select[name="editor"]').val())?$('select[name="editor"]').val():'';
    var maker_date=($('.maker_date').val())?$('.maker_date').val():'';
    var from_date=($('.from_date').val())?$('.from_date').val():'';
    var to_date=($('.to_date').val())?$('.to_date').val():'';
    var updater_date=($('.updater_date').val())?$('.updater_date').val():'';
        $('.view_pregnancy_data').html('');
        $('.loaderajax').show();
        $.post(BASE_URL+'pregnancy_period/pregnancyList_pagination',{type_filter:type_filter,active_filter:active_filter,filter_no:filter_no,author:author,editor:editor,maker_date:maker_date,updater_date:updater_date,from_date:from_date,to_date:to_date},function(data){
                if(data){
                    $('.loaderajax').hide();
                    $('.view_pregnancy_data').html('');
                    $('.view_pregnancy_data').html(data);
                }
     })
     })
     
     
     $(document).on('click','.pagination li a',function(e){
            e.preventDefault();
            var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
            var type_filter=($('select[name="type_filter"]').val())?$('select[name="type_filter"]').val():'';
            var filter_no=parseInt(limit);
            if(!$(this).attr('data-ci-pagination-page')){
                return false;
            }else{
                $('.view_pregnancy_data').html('');
                $('.loaderajax').show();
                jQuery.ajax({
                type: "POST",
                url: jQuery(this).attr("href"),
                data:{type_filter:type_filter,filter_no:filter_no},
                success: function(data){
                                $('.loaderajax').hide();
                                $('.view_pregnancy_data').html('');
                                $('.view_pregnancy_data').html(data);
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
    $(document).on('change',".date_start",function(e1){
        if($(this).val()!=''){
        setTimeout(function(){$('.search').trigger('click')},500);
        }
        });
    $(document).on('change',".maker_date",function(e1){
        if($(this).val()!=''){
        setTimeout(function(){$('.search').trigger('click')},500);
        }
        });
    $(document).on('change',".updater_date",function(e1){
        if($(this).val()!=''){
        setTimeout(function(){$('.search').trigger('click')},500);
        }
        });
</script>