<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->
<style>
.action-btn{
    max-width: 13.2em !important;
    margin-left: 0.5em !important;
}

.move {cursor: move;}
.table > tbody > tr > td {vertical-align: middle;}
</style>
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
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('advance_notification/addedit_notification');?>" class="btn btn-info btn-sm">New Notification</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<!--<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?=base_url('advance_notification/deleteData');?>" title="Delete selected rows">Delete Selected</a>-->
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
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
			<div class="overflow">
			<table class="table table-striped table-responsive table-bordered" id="myTable1">
			<thead>
				<tr>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<th class="">#</th>
					<th class="" data-sortable="false">
					<!-- <div class="togglebutton" title="Select all"><label> -->
						<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span></label>
					<!-- </div> -->
					</th>
					<?php }?>
					<th class="text-center align-text-top">Title</th>
					<th class="text-center align-text-top">Team</th>
					<th class="text-center align-text-top">From Date</th>
					<th class="text-center align-text-top">To Date</th>
					<th class="text-center align-text-top">Status</th>
					<th class="text-center align-text-top">Author</th>
					<th class="text-center align-text-top">Date posted</th>
					<?= (checkModulePermission($MODULEID,'status_btn'))?'<th class="text-center align-text-top">Active</th>':'';?>
					<th class="th-action text-center align-text-top">Action</th>
				</tr>
			</thead>
			<tbody class="row_position">
				<?php  
				$i=1;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr class="move" id="<?= ($data->ID);?>">
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<td><?= $i;?></td>
					<td>
					<!-- <div class="togglebutton" title="Select"><label> -->
						<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
						<span class="toggle"></span></label>
					<!-- </div> -->
					</td>
					<?php }?>
					<td><?=$data->name;?></td>
					<td><?=$data->team;?></td>
					<td><?= dateTime($data->start_date,"Y-m-d");?></td>
					<td><?= dateTime($data->end_date,"Y-m-d");?></td>
					<td><?= ($data->action_status=='1')?"Draft":(($data->action_status=='2')?'Published':'Scheduled');?></td>
 					<td><?=$data->author;?></td>
					<td><?= dateTime($data->maker_date,"Y-m-d");?></td>
					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
						<td class="text-center">
							<div class="togglebutton" title="Active/Inactive" style="margin-top: -17px;">
								<label>
									<input type="checkbox" class="status" name="status[]" value="<?= "advance_notification".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
									<span class="toggle"></span>
								</label>
							</div>
						</td>
					<?php }?>
					<td style="text-align: center;"> 
                        <div class="dropdown" >
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
							    <i class="fa fa-ellipsis-v" style="font-size:24px"></i>
						    </a>
							<div class="dropdown-menu  dropdown-menu-left">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('advance_notification/view_notification');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info  btn-xs btn-block action-btn">View Notification</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('advance_notification/addedit_notification');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success btn-xs btn-block action-btn">Edit Notification</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs btn-block action-btn" id="advance_notification/deleteData/<?=md5($data->ID);?>">Delete Notification</a>
								<?php }?>
							</div>
						</div>
					</td>
				</tr>
				<?php $i++;}}?>	
			</tbody>
			</table>
	</div>
	<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	<!-- /.widget-holder -->


	<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	<!-- /.widget-holder -->
</main>
<!-- /.main-wrappper -->	
<!-- end page-->		

<!--Start footer-->
<?=$footer;?>
<!--End footer-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $( function() {
   	 $( ".datepicker" ).datepicker({
		dateFormat: 'yy-mm-dd'
	 });
  	} );
  
	// Setup - add a text input to each footer cell
 
	//$('#myTable1 thead tr').clone(true).appendTo( '#myTable1 thead' );
    $('#myTable1 thead tr:eq(0) th').each( function (i) {
        var title = $(this).text();
		if (title === "Title" || title === "Team" || title === "Author") {	
            $(this).html( $(this).html()+'<br/><input type="text" placeholder="" style="width: 80px;height: 11px;padding: 4px;border-radius: 4px;direction: ltr;" />' );
        } else if (title === "From Date" || title === "To Date" || title === "Date posted") {	
            $(this).html( $(this).html()+'<br/><input type="text" class="datepicker" placeholder="" style="width: 80px;height: 10px;"/>' );
        } else  if(title === "Status"){
			$(this).html( $(this).html()+'<br/><select style="width: 80px;height: 19px; border-radius: 4px;direction: ltr;"><option value="">Select</option><option value="Draft">Draft</option><option value="Published">Published</option><option value="Scheduled">Scheduled</option></select>' );
		}else {
			$(this).html($(this).html());
        }
		
		$( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
		
		$( 'select', this ).on( 'change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
		
    } );
	
    var table = $('#myTable1').DataTable( {
        rowReorder: true,
		"scrollCollapse": false,
		'aoColumnDefs': [{
			'bSortable': false,
			'aTargets': [0,1,2,3,4,5,6,7,8,9,10] /* 1st one, start by the right */
		}]
	});
});

var selectedPage=1;

$(document).on("click",".paginate_button", function(){
	selectedPage=$(this).attr('data-dt-idx');
});

$('#myTable1').on( 'length.dt', function ( e, settings, len ) {
   selectedPage=1;
} );

    $( ".row_position" ).sortable({ 
        delay: 150,
        stop: function() {
            var selectedData= new Array();
            $('.row_position>tr').each(function(index) {
                //selectedData.push($(this).attr("id"));
				var ID=$(this).attr("id");
				selectedData.push({
					ID : ID,
					column_order :  parseInt(index)+(parseInt(selectedPage)*10)
				});
            });
			updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url: BASE_URL+"advance_notification/dragRow",
            type:'post',
            data:{position:data},
            success:function(data){
				//console.log(data);
                alert('your change successfully saved');
            }
        });
    }
</script>