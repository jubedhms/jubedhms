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
                $tilltotal=(($start_of*$limit)>$total_data)?$total_data:($start_of*$limit)
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
 <div style="height: 314px;overflow: scroll;">
<table class="table table-striped table-responsive table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
                                        <th style="width:10%;vertical-align: top;" class="pre_css">#</th>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
                                    
					<th class="th-no-sort" data-sortable="false">
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span>
					</th>
					<?php } ?>	
					<th style="text-align: center;">Type
                                        <select name="type_filter" class="type_filter" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                            <option value=""> Select </option>
                                            <?php ($this->session->userdata('type_filter'))?$type_filter=$this->session->userdata('type_filter'):$type_filter=''; ?>
                                            <?php  ?>
                                            <option value="1" <?php echo ($type_filter=='1')?'selected':''; ?>>Article </option>
                                            <option value="3" <?php echo ($type_filter=='3')?'selected':''; ?>>Video Clip </option>
                                            <?php  ?>
                                        </select>
                                        </th>
					<th style="text-align: center;vertical-align: top;" class="pre_css">Thumbnail image</th>
					<th style="text-align: center;vertical-align: top;"><span> English Title</span></th>
					<th style="text-align: center;vertical-align: top;" class="pre_css">Vietnamese Title</th>
					<th style="text-align: center;">Audience Segment
                                            <select name="cus_group" class="cus_group" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                                        <option value=""> Select </option>
                                                        <?php ($this->session->userdata('cusgroup'))?$cusgroup=$this->session->userdata('cusgroup'):$cusgroup=''; ?>
                                                        <?php 
                                                            $customer_group=array('Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
                                                            if($customer_group && count($customer_group)>0){
                                                            $i=1;
                                                            foreach($customer_group as $customer_group){
                                                        ?>
                                                            <option value="<?=$i;?>" <?php echo ($cusgroup==$i)?'selected':''; ?>><?=$customer_group; ?></option>
                                                        <?php $i++; } }?>
                                               
                                            </select>
                                        </th>
					<!--<th>Description</th> -->
					<th style="text-align: center;" style=" border: 1px solid #e4e9f0; color: #999999; ">Author 
                                            <?php $maker_id=array_unique(array_column($details,'maker_id')); // foreach() ?>
                                            <?php $author=array_unique(array_column($details,'author')); $authorarr=array_combine($maker_id,$author); ?>
                                            
                                            <?php $updater_id=array_unique(array_column($details,'updater_id')); // foreach() ?>
                                            <?php $editor=array_unique(array_column($details,'editor')); $editorarr=array_combine($updater_id,$editor); // foreach() ?>
                                            <select name="author" class="author" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                            <option value=""> Select </option>
                                            <?php ($this->session->userdata('authorsess'))?$authorsess=$this->session->userdata('authorsess'):$authorsess=''; ?>
                                            <?php foreach($authorarr as $key=>$authorrow){ ?>
                                            <option value="<?php echo $key; ?>" <?php echo ($authorsess==$key)?'selected':''; ?>><?php echo $authorrow; ?> </option>
                                            <?php } ?>
                                        </select>
                                        </th>
					<th style="text-align: center;">Editor
                                            <select name="editor" class="editor" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                            <option value=""> Select </option>
                                            <?php ($this->session->userdata('editorsess'))?$editorsess=$this->session->userdata('editorsess'):$editorsess=''; ?>
                                                <?php foreach($editorarr as $key=>$editorrow){ ?>
                                            <option value="<?php echo $key; ?>" <?php echo ($editorsess==$key)?'selected':''; ?>><?php echo $editorrow; ?> </option>
                                            <?php } ?>
                                        </select>
                                        </th>
					<th style="text-align: center;">Status
                                            <select name="statusAw" class="statusAw" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                            <option value=""> Select </option>
                                            <?php  ?>
                                            <?php ($this->session->userdata('status'))?$status=$this->session->userdata('status'):$status=''; ?>
                                            <option value="1" <?php echo ($status=='1')?'selected':''; ?>>Expired </option>
                                            <option value="2" <?php echo ($status=='2')?'selected':''; ?>>Scheduled </option>
                                            <option value="3" <?php echo ($status=='3')?'selected':''; ?>>Published </option>
                                            <option value="4" <?php echo ($status=='4')?'selected':''; ?>>Draft </option>
                                            <?php  ?>
                                            </select>
                                        </th>
					<th style="text-align: center;">Date Start
                                            <div class="stdate">
                                                <?php  ($this->session->userdata('date_start'))?$date_start=$this->session->userdata('date_start'):$date_start=''; ?>
                                                <input type="text" style="border: 1px solid #e4e9f0; color: #999999;width:80px; height: 20px; " name="start_date1" class="datepicker date_start" value="" autocomplete="off">
                                            </div>
                                        </th>
					<th style="text-align: center;">Date End
                                            <div >
                                                <?php  ($this->session->userdata('end_date2'))?$end_date2=$this->session->userdata('end_date2'):$end_date2=''; ?>
                                                <input style=" border: 1px solid #e4e9f0; color: #999999;width:80px; height: 20px; " name="end_date2" class="datepicker end_date2" type="text" value="" autocomplete="off">
                                            </div>
                                        </th>
					<th style="text-align: center;">Date posted
                                            <div >
                                                <?php  ($this->session->userdata('maker_date'))?$maker_date=$this->session->userdata('maker_date'):$maker_date=''; ?>
                                                <input style=" border: 1px solid #e4e9f0; color: #999999;width:80px; height: 20px; " name="posted_date" class="datepicker maker_date" type="text" value="" autocomplete="off">
                                            </div>
                                        </th>
                     
                                        <?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
                                            <th style="text-align: center;vertical-align: top;">Active
                                            <select name="active_filter" class="active_filter" style=" border: 1px solid #e4e9f0; color: #999999; ">
                                                <option value=""> Select </option>
                                                <?php ($this->session->userdata('filter')!='')?$filter=$this->session->userdata('filter'):$filter=''; ?>
                                                <option value="1" <?php echo ($filter=='1')?'selected':''; ?>>Active </option>
                                                <option value="0" <?php echo ($filter=='0')?'selected':''; ?>>Inactive </option>
                                            </select>
                                            </th>
                                        <?php } ?>
                                        
                                        
                                        <th style="text-align: center;vertical-align: top;" class="th-action" >Action</th>
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
					<!-- <div class="togglebutton" title="Select"><label> -->
					<input type="checkbox" class="checkRow" name="checkRow[]" value="<?= MD5($data->ID);?>" <?php echo (date('Y-m-d')>$data->end_date)?'disabled="disabled"':''; ?> />
					<span class="toggle"></span>
					<!-- </div> -->
					</td>
					<?php }?>
					<td class="pre_css" style=" text-align: center;vertical-align: middle;"><?php echo ($data->file_type==1)?'Article':'Video clip';?></td>
					<td style="text-align: center;">
                                            <?php if($data->awareness_image){ ($data->awareness_image)?$imgextention=explode('.',$data->awareness_image):array(); ?>
                                            <?php if(in_array(end($imgextention),array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'))){ ?>
                                            <img width="100" height="60" class="img" src="<?php echo base_url().$data->awareness_image;?>" >
                                                
                                                <?php }else{
                                                ($data->awareness_image)?$youtubelink=explode('=',$data->awareness_image):'';
                                                ?>
                                                <iframe width="100" height="60" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0">
                                                </iframe>
                                            <?php } } ?>
                                            
                                            
					</td>
					<td style=" vertical-align: middle;text-align: center;"><p style="width:150px;"><?php echo ($data->name)?mb_strimwidth($data->name, 0, 30, "..."):'';?></p></td>
					<td style=" vertical-align: middle;text-align: center;"><p style="width:150px;"><?php echo ($data->name_vi)?mb_strimwidth($data->name_vi, 0, 30, "..."):'';?></p></td>
					<td style=" vertical-align: middle;text-align: center;">
							<?php $customer_group=array('Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
							$i=1;$count=1;
							$cgroup=isset($data->customer_group)?explode(',',$data->customer_group):array();
							foreach($customer_group as $customer_group){
								if(in_array($i,$cgroup)){
									echo $customer_group;
                                                                        if(count($cgroup)==$count){
                                                                }else{
                                                                    echo ', ';
                                                                }
                                                                $count++;
								}
                                                                
                                                                
							 $i++; } 
							 ?>
					</td>
 					<!--<td><?php //echo ($data->description)?substr($data->description, 0, 50):substr($data->description_vi, 0, 50);?></td>-->
					<td class="pre_css" style=" vertical-align: middle;text-align: center;"><?=($data->author!='NA')?$data->author:'';?></td>
					<td class="pre_css" style=" vertical-align: middle;text-align: center;"><?=($data->editor!='NA')?$data->editor:'';?></td>
					<td style=" vertical-align: middle;">
							<?php //status $data->end_date<=date('Y-m-d')
                                                        if($data->end_date<date('Y-m-d')){
                                                            
                                                            if($data->show_status==0){
									echo 'Expired Draft';
								}else{
                                                                    echo 'Expired';
                                                                }
                                                        }else{
								if(date('Y-m-d H:i:s')<$data->start_datetime){
									echo 'Scheduled';
								}elseif(date('Y-m-d H:i:s')>=$data->start_datetime && date('Y-m-d')<=$data->end_date && $data->show_status!=0){
									echo 'Published';
								}elseif($data->show_status==0){
									echo 'Draft';
								}
                                                        }
							?>
					</td>
					<td class="pre_css" style=" vertical-align: middle;text-align: center;"><?=DateTime($data->start_datetime,"Y-m-d");?></td>
					
                                        
                                        <td style="text-align: center; vertical-align: middle;text-align: center;"><?=DateTime($data->end_date,"Y-m-d");?>
                                            <?php if($data->end_date>=date('Y-m-d')){ ?> 
                                            <!--<input type="" style="width: 75px;height: 27px;visibility: hidden;" class="form-control">-->
                                            <?php }elseif(checkModulePermission($MODULEID,'edit_btn')){  ?>
                                                
                                                <a style="width:90px;text-align:center; background:#00adee;border:1px solid #f3f8fd;" href="javascript:void(0)" data-id="<?=$data->ID; ?>" class="btn btn-success btn-xs btn-block date_change">Change Date</a>
                                            <div class="form-group date_change_field" style="display:none;">
                                                <input name="date_end" style="height: 27px;" class="form-control date_end" type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}'>
                                            </div>
                                                
                                            <?php } ?>
                                        </td>
                                        
                                        
					<td class="pre_css" style=" vertical-align: middle;text-align: center;"><?=DateTime($data->maker_date,"Y-m-d");?></td>
                                        
 					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td style=" vertical-align: middle; text-align: center; ">
					<div class="togglebutton" title="<?=($data->end_date<date('Y-m-d'))?"You can not make active/inactive. Awareness date has expired.":"Active/Inactive";?> "><label>
					<input <?=($data->end_date<date('Y-m-d'))?"disabled='disabled'":"";?> type="checkbox" class="status" name="status[]" value="<?= "awareness".'^'.MD5($data->ID);?>" <?=($data->show_status=='1' && $data->end_date>=date('Y-m-d'))?"checked":"";?> />
					<span class="toggle"></span></label>
                                        </div>
					</td>
					<?php }?>
					<td style=" vertical-align: middle; text-align: center; ">
						<div class="dropdown">
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left action-dropdown">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('awareness/view_awareness');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info  btn-xs action-btn min-btn">View</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('awareness/addedit_awareness');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success  btn-xs action-btn min-btn">Edit</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger  btn-xs action-btn min-btn" id="awareness/deleteData/<?=md5($data->ID);?>">Delete</a>
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
        $('.date_start').datepicker({
            //startDate: '-0d',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.maker_date').datepicker({
            //startDate: '-0d',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

    });
    
    $(document).ready(function(){
        $(".filter_no,.type_filter,.cus_group,.author,.editor,.statusAw,.active_filter").change(function(){
            $('.search').trigger('click');
        });
        setTimeout(function(){
            $('.date_start').val('<?php echo $date_start; ?>');
            $('.end_date2').val('<?php echo $end_date2; ?>');
            $('.maker_date').val('<?php echo $maker_date; ?>');
        },1000);
        
    });
</script>