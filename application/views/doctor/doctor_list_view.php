<style>
    .pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    /*color: #337ab7;*/
    text-decoration: none;
    /*background-color: #fff;*/
    border: 1px solid #ddd;
}
.highlight{
    background-color: #d3d3d3;
    color: #fff !important;
}
</style>
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
<div class="widget-bg">
<div class="widget-heading clearfix" style="margin-bottom: -20px;">
<h5>  </h5>
</div>
    <?php $total_of=($start_of>1)?($start_of*$limit)-($limit-1):$start_of; 
                $tilltotal=(($start_of*$limit)>$total_data)?$total_data:($start_of*$limit)
            ?>
<div class="widget-body clearfix">
    <div class="overflow">
    <div class="">
        <label>Show 
            <select name="filter_no"  class="filter_no" style="height: 25px;width:50px;">
                <option value="10" <?php echo ($limit=='10')?"selected":""; ?>>10</option>
                <option value="25" <?php echo ($limit=='25')?"selected":""; ?>>25</option>
                <option value="50" <?php echo ($limit=='50')?"selected":""; ?>>50</option>
                <option value="100" <?php echo ($limit=='100')?"selected":""; ?>>100</option>
            </select> entries
        </label>
    </div>
        <table class="table table-striped table-responsive table-bordered" id="myTable" style="font-size: 12px; ">
        <thead>
                <tr>
                        <?php //if(checkModulePermission($MODULEID,'delete_btn')){ ?>
                                <!--<th class="th-no-sort" data-sortable="false">
                                        <input type="checkbox" class="checkAllRows"  id="checkAllRows" />
                                        <span class="toggle"></span></label>
                                        
                                </th>-->
                        <?php //}?>
                        <th style="text-align: center;vertical-align: top;">#</th>
                        <th style="text-align: center;vertical-align: top;">MCR</th>
                        <th style="text-align: center;vertical-align: top;">Name</th>
                        <th style="text-align: center;vertical-align: top;">Specialty</th>
                        <th style="text-align: center;vertical-align: top;">Latest update date</th>
                        <th style="text-align: center;vertical-align: top;">Editor</th>
                        <?= (checkModulePermission($MODULEID,'status_btn'))?'<th style="text-align: center;vertical-align: top;">Active</th>':'';?>
                        <th class="th-action" style="text-align: center;">Action</th>
                </tr>
        </thead>
        <tbody>
                <?php  
                $i=$total_of;
                if($details && count($details)>0){
                foreach($details as $data){?>		
                <tr>
                        <?php //if(checkModulePermission($MODULEID,'delete_btn')){ ?>
                        <!--<td>
                                <input type="checkbox" class="checkRow" name="checkRow[]"  value="<?php // MD5($data->ID);?>" />
                                <span class="toggle"></span></label>
                        </td>-->
                        <?php //}?>
                        <td style="text-align: center;vertical-align: middle;"><?=$i;?></td>
                        <td style="text-align: center;vertical-align: middle;"><?=$data->mcr;?></td>
                        <td style="text-align: center;vertical-align: middle;" class="doctor_name"><?=$data->name;?></td>
                        <td style="text-align: center;vertical-align: middle;"><?=$data->primary_specialty_name;?></td>
                        <td style="text-align: center;vertical-align: middle;"><?=($data->updater_date!='NA')?$data->updater_date:'';?></td>
                        <td style="text-align: center;vertical-align: middle;"><?=($data->editor!='NA')?$data->editor:'';?></td>
                        <?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
                                <td style="text-align: center;vertical-align: middle;">
                                        <div class="togglebutton" title="Active/Inactive"><label>
		<input type="checkbox" class="status" name="status[]" value="<?="doctor".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
                                                <span class="toggle"></span>
                                        </label></div>
                                </td>
                        <?php }?>
                        <td style="text-align: center;vertical-align: middle;">
                                <div class="dropdown">
                                    <a href="" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" aria-expanded="false" style="width: 33px;height: 33px;">
                                                <i class="fa fa-ellipsis-v" style="font-size:24px"></i>
                                        </a>
                                       <div class="dropdown-menu dropdown-menu-left action-dropdown">
                                                <?php if(checkModulePermission("37",'view_btn') && $data->mcr!=''){ ?>
														<!-- <a href="doctor_appointment?mcr=<?= MD5($data->mcr);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn min-btn">View Doctor Appointment</a> -->
													<?php } if(checkModulePermission("38",'view_btn') && $data->mcr!=''){ ?>
														<!-- <a href="vaccine_appointment?mcr=<?= MD5($data->mcr);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn min-btn">View Vaccine Appointment</a>	 -->
                                                        <a href="doctor/view_doctor/<?= MD5($data->ID);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn min-btn" style="text-align: center;">View</a>	
                                                <?php }if(checkModulePermission($MODULEID,'edit_btn')){?>	
                                                        <a href="doctor/addedit_doctor/<?=MD5($data->ID);?>"  class="dropdown-item btn btn-success  btn-xs btn-block action-btn min-btn" style="text-align: center;">Edit</a>												
                                                <?php }if(checkModulePermission($MODULEID,'edit_btn')){?>
                                                        <!--<a href="javascript:void(0)"  class="open_popup_avalability dropdown-item btn btn-orange btn-xs btn-block action-btn min-btn" data-url="<?php //base_url(); ?>doctor/addedit_avalability/<?php //MD5($data->ID);?>">Availability</a>-->	
                                                <?php }if(checkModulePermission($MODULEID,'delete_btn')){?>
                                                        <!-- <a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs btn-block action-btn min-btn" id="doctor/deleteData/<?=md5($data->ID);?>">Delete Doctor</a> -->
                                                <?php }?>  											
                                        </div>
                                </div>
                        </td>
                </tr>
                <?php $i++;}}?>	
        </tbody>
        </table>
			<div class="border-bottom" style="margin-bottom: 10px;"></div>
            
            <?php if($total_data>$limit){ ?>
            <ul class="pull-left" style="left: -41px;position: relative;"><?php echo "Showing ".$total_of." to ".$tilltotal." of ".$total_data." total entries"; ?></ul>
            <?php } ?>
            <ul class="pagination pull-right"><?php echo "<li>". $links."</li>"; ?></ul>
</div>
</div>
</div>
</div>
	</div>

<script>
    // var myTable=$('#myTable').DataTable();

    // var myTable_report= $('#myTable_report').dataTable( {
        // dom: 'Bfrtip',
        // lengthMenu: [
            // [ -1, 10, 20, 50 ],
            // [ 'Show all', '10 rows', '20 rows', '50 rows' ]
        // ],
        // order : [[ 5, "asc" ]],
        // buttons: [
            // {
                // extend: 'pageLength',
                // text: 'Show all',
            // },
            // {
                // extend: 'csvHtml5',
                // text: 'Export to CSV',
                // filename:'export'
            // },
            // {
                // extend: 'excelHtml5',
                // text: 'Export to Excel',
                // customize: function( xlsx ) {
                    // var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    // $('row:first c', sheet).attr( 's', '42' );
                // }
            // }
        // ]
    // } );
</script>
<script>
    $(document).ready(function(){
        $(".gridviewSearchbtn").click(function(){
            var searchDoctor=$('.gridviewSearch').val();
            //if(searchDoctor){
            $('select[name="view_type"]').trigger('change');
            //}
    });
    });
</script>
<script>
    $(document).ready(function(){
        $(".filter_no").change(function(){
            $('select[name="view_type"]').trigger('change');
    });
    });
</script>