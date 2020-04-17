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
<style>
 .pre_css {
  white-space: pre;
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
                $tilltotal=(($start_of*$limit)>$total_data)?$total_data:($start_of*$limit);
                        ?>
<div class="widget-body clearfix">
    <div class="">
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
 <div style="">
<table class="table table-striped table-responsive table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
                                        <th style="">#</th>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					
					<?php } ?>
					
                     
					<th style="" class="th-action" >Question English</th>
					<th style="" class="th-action" >Answer English</th>
					<th style="" class="th-action" >Question Vietnamese</th>
					<th style="" class="th-action" >Answer Vietnamese</th>
					<th style="text-align: center;vertical-align: top;" class="th-action" >Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$sr=($total_of==0)?1:$total_of;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
                                        <td style="text-align: center;width:10px;"><?php echo $sr; ?></td>
                                        <td style=""><?php echo $data->question; ?></td>
                                        <td style="">
                                            <?php  $answer=getoption($data->ID,'en');
                                            if(!empty($answer)){ $i=1;
                                                foreach($answer as $row){ ?>
                                                    <p><span style="color: #00b1f3; "><?php echo (isset($row->answer) && @count($answer)>1)?$i++.". ":''; ?></span><?php echo isset($row->answer)?$row->answer:''; ?></p>
                                              <?php } } ?>
                                        </td>
                                        <td style=""><?php echo $data->question_vi; ?></td>
                                        <td style="">
                                            <?php  $answer_vi=getoption($data->ID,'vi');
                                            if(!empty($answer_vi)){ $j=1;
                                                foreach($answer_vi as $row){ ?>
                                            <p><span style="color: #00b1f3; "><?php echo (isset($row->answer_vi) && @count($answer_vi)>1)?$j++.". ":''; ?></span><?php echo isset($row->answer_vi)?$row->answer_vi:''; ?></p>
                                              <?php } } ?>
                                        </td>
					<td style="text-align: center;width:50px;">
						<div class="dropdown" style="">
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left action-dropdown">
								<?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('chat_manage/addedit_question');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success  btn-xs action-btn min-btn">Edit</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger  btn-xs action-btn min-btn" id="chat_manage/deleteData/<?=md5($data->ID);?>">Delete</a>
								<?php }?>
							</div>
						</div>
					</td>
				</tr>
				<?php $sr++;}}?>	
			</tbody>
			</table>
     </div>
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
    $(function() {
    $('.date_end').datepicker({
            startDate: '-0d',
            format: 'yyyy-mm-dd',
            autoclose: true
       });
    });
</script>
<script>
      $(document).ready(function() {   
        $(".select2").select2();   
      });  
      
    $(function() {
        $('.end_date2').datepicker({
            //startDate: '-0d',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>