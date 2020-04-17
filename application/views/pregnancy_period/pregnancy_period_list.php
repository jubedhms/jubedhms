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
.action-dropdown-min {
    width: 90% !important;
    min-width: 17% !important;
}
</style>
<style>
 .pre_css {
  white-space: pre;
 }
</style>
<div class="row">
    
<div class="col-md-12 widget-holder">
<div class="widget-bg">

    <?php $total_of=($start_of>1)?($start_of*$limit)-($limit-1):$start_of; 
                $tilltotal=(($start_of*$limit)>$total_data)?$total_data:($start_of*$limit)
            ?>
<div class="widget-body clearfix" style="padding: 1px 20px;">
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
 <div style="height: 314px;overflow: scroll;">
<table class="table table-striped table-responsive table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
                                        <th style="width:10%;vertical-align: top;" class="pre_css">#</th>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<th class="th-no-sort " data-sortable="false">
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span>
					</th>
					<?php }?>
                                        <th >Type
                                            <select name="type_filter" class="type_filter" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                                <option value=""> Select </option>
                                                <option value="1">Article </option>
                                                <option value="3">Video Clip </option>
                                            </select>
                                        </th>
                                        <th style="text-align: center;vertical-align: top;" class="pre_css">Pregnancy Week</th>
					
                                        <th style="text-align: center;vertical-align: top;"><span style="visibility: hidden;">space</span>Illustration<span style="visibility: hidden;">space</span></th>
					<th style="text-align: center;vertical-align: top;" class="pre_css">English Title</th>
					<th style="text-align: center;vertical-align: top;" class="pre_css">Vietnamese Title</th>
                                        <th style="text-align: center;" style=" border: 1px solid #e4e9f0; color: #999999; ">Author 
                                            <?php $maker_id=array_unique(array_column($details,'maker_id')); // foreach() ?>
                                            <?php $author=array_unique(array_column($details,'author')); $authorarr=array_combine($maker_id,$author); ?>
                                            
                                            <?php $updater_id=array_unique(array_column($details,'updater_id')); // foreach() ?>
                                            <?php $editor=array_unique(array_column($details,'editor')); $editorarr=array_combine($updater_id,$editor); // foreach() ?>
                                        <select name="author" class="author" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                            <option value=""> Select </option>
                                            <?php foreach($authorarr as $key=>$authorrow){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $authorrow; ?> </option>
                                            <?php } ?>
                                        </select>
                                        </th>
					<th style="text-align: center;">Editor
                                            <select name="editor" class="editor" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                            <option value=""> Select </option>
                                            <?php foreach($editorarr as $key=>$editorrow){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $editorrow; ?> </option>
                                            <?php } ?>
                                        </select>
                                        </th>
                                        
					<th style="width: 80px;">Date Posted
                                            <div>
                                                <input style=" border: 1px solid #e4e9f0; color: #999999;width:80px; height: 20px; " name="maker_date" class="datepicker maker_date" type="text" autocomplete="off">
                                            </div>
                                        </th>
					<th style="width: 80px;">Date Edited
                                            <div>
                                                <input style=" border: 1px solid #e4e9f0; color: #999999;width:80px; height: 20px; " name="updater_date" class="datepicker updater_date" type="text" autocomplete="off">
                                            </div>
                                        </th>
                    <?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
                        <th style="text-align: center;vertical-align: top;">Active
                        <select name="active_filter" class="active_filter" style=" border: 1px solid #e4e9f0; color: #999999; ">
                            <option value=""> Select </option>
                            <option value="1">Active </option>
                            <option value="0">Inactive </option>
                        </select>
                        </th>
                    <?php } ?>
					<th style="text-align: center;vertical-align: top;" class="th-action" style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$sr=($total_of==0)?1:$total_of;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
                                    <td style="text-align: center;width:50px;vertical-align: middle;"><?php echo $sr; ?></td>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<td style=" vertical-align: middle;">
					<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					<span class="toggle"></span>
					</td>
					<?php }?>
                                        <td style=" vertical-align: middle;text-align: center;">
                                            <?php echo ($data->file_type==1)?'Article':'Video clip';?>
                                        </td>
					<td style=" vertical-align: middle;text-align: center;"><?php $weeks=explode(',',$data->pregnancy_week);
                                        $count=1;        
                                        foreach($weeks as $rweek){
                                                    echo 'Week'.$rweek;
                                                    if(count($weeks)==$count){
                                                    }else{
                                                        echo ', ';
                                                    }
                                                    $count++;
                                            } ?>
                                        </td>
					
					<td style="text-align: center;vertical-align: middle;">
                                            <?php if($data->pregnancy_period_image){ ($data->pregnancy_period_image)?$imgextention=explode('.',$data->pregnancy_period_image):array(); ?>
                                            <?php if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ ?>
                                            <img width="100" height="60" class="img" src="<?php echo base_url().$data->pregnancy_period_image;?>" >
                                                
                                                <?php }else{
                                                ($data->pregnancy_period_image)?$youtubelink=explode('=',$data->pregnancy_period_image):'';
                                                ?>
                                                <iframe width="100" height="60" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0">
                                                </iframe>
                                            <?php } } ?>
                                            
                                            
					</td>
					<td style=" vertical-align: middle;text-align: center;"><?php echo ($data->name)?$data->name:'';?></td>
					<td style=" vertical-align: middle;text-align: center;"><?php echo ($data->name_vi)?$data->name_vi:'';?></td>
					<td style=" vertical-align: middle;text-align: center;"><?=($data->author!='NA')?$data->author:'';?></td>
					<td style=" vertical-align: middle;text-align: center;"><?=($data->editor!='NA')?$data->editor:'';?></td>
					<td style=" vertical-align: middle;text-align: center;"><?=DateTime($data->maker_date,"Y-m-d");?></td>
					<td style=" vertical-align: middle;text-align: center;"><?=DateTime($data->updater_date,"Y-m-d");?></td>
                                        
 					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td style=" vertical-align: middle; text-align: center; ">
					<div class="togglebutton" title="Active/Inactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?= "pregnancy_period".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td style=" vertical-align: middle; text-align: center; ">
						<div class="dropdown">
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left action-dropdown-min">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('pregnancy_period/view_pregnancy_period');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info btn-xs action-btn min-btn">View</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('pregnancy_period/addedit_pregnancy_period');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success btn-xs action-btn min-btn">Edit</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs action-btn min-btn" id="pregnancy_period/deleteData/<?=md5($data->ID);?>">Delete</a>
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
      $(document).ready(function() {   
        $(".select2").select2();   
      });  
      
    $(function() {
        $('.updater_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.maker_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

    });
    
    $(document).ready(function(){
        $(".filter_no,.type_filter,.author,.editor,.active_filter").change(function(){
            $('.search').trigger('click');
        });
    });
</script>