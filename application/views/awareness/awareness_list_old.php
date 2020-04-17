<table class="table table-striped table-responsive table-bordered" id="myTable" style="font-size: 12px;">
			<thead>
				<tr>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
                                    
					<th class="th-no-sort" data-sortable="false">
					<!-- <div class="togglebutton" title="Select all"><label> -->
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span></label>
					<!-- </div> -->
					</th>
					<?php }?>	
					<th>Type(Articles/<br>video clip)</th>
					<th style="width:100px !important;">Type</th>
					<th>Title<br>(English)</th>
					<th>Title<br>(Vietnamese)</th>
					<th>Audience<br> Segment</th>
					<th>Author</th>
					<th>Editor</th>
					<th>Status<br>(Published/<br> Scheduled/<br> Draft)</th>
					<th style="width: 80px;">Date Start</th>
					<th style="width: 80px;">Date End</th>
					<th style="width: 80px;">Date posted</th>
                     <?= (checkModulePermission($MODULEID,'status_btn'))?'<th>Active</th>':'';?>
					<th class="th-action" style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$i=0;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<td>
					<!-- <div class="togglebutton" title="Select"><label> -->
					<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					<span class="toggle"></span></label>
					<!-- </div> -->
					</td>
					<?php }?>
					<td><?php echo ($data->file_type==1)?'Articles':'Video clip';?></td>
					<td style="text-align: center;width: 100px !important;">
                                            <?php if($data->awareness_image){ ($data->awareness_image)?$imgextention=explode('.',$data->awareness_image):array(); ?>
                                            <?php if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ ?>
                                            <img width="100" height="60" class="img" src="<?php echo base_url().$data->awareness_image;?>" >
                                                
                                                <?php }else{
                                                ($data->awareness_image)?$youtubelink=explode('=',$data->awareness_image):'';
                                                ?>
                                                <iframe width="100" height="60" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0">
                                                </iframe>
                                            <?php } } ?>
                                            
                                            
					</td>
					<td><?php echo ($data->name)?$data->name:'';?></td>
					<td><?php echo ($data->name_vi)?$data->name_vi:'';?></td>
					<td>
							<?php $customer_group=array('Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
							$i=0;
							$cgroup=isset($data->customer_group)?explode(',',$data->customer_group):array();
							foreach($customer_group as $customer_group){
								if(in_array($i,$cgroup)){
									echo $customer_group.', ';
								}
							 $i++; } 
							 ?>
					</td>
 					<!--<td><?php //echo ($data->description)?substr($data->description, 0, 50):substr($data->description_vi, 0, 50);?></td>-->
					<td><?=($data->author!='NA')?$data->author:'';?></td>
					<td><?=($data->editor!='NA')?$data->editor:'';?></td>
					<td>
							<?php //status
								if(date('Y-m-d')<$data->start_date){
									echo 'Scheduled';
								}elseif(date('Y-m-d')>=$data->start_date && date('Y-m-d')<=$data->end_date){
									echo 'Published';
								}elseif(date('Y-m-d')>$data->end_date){
									echo 'Draft';
								}
							?>
					</td>
					<td><?=DateTime($data->start_date,"Y-m-d");?></td>
					<td><?=DateTime($data->end_date,"Y-m-d");?></td>
					<td><?=DateTime($data->maker_date,"Y-m-d");?></td>
                                        
 					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td>
					<div class="togglebutton" title="Active/Inactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?= "awareness".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td style="text-align: center;">
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
				<?php $i++;}}?>	
			</tbody>
			</table>

<script>
    var myTable=$('#myTable').DataTable();

    var myTable_report= $('#myTable_report').dataTable( {
        dom: 'Bfrtip',
        lengthMenu: [
            [ -1, 10, 20, 50 ],
            [ 'Show all', '10 rows', '20 rows', '50 rows' ]
        ],
        order : [[ 5, "asc" ]],
        buttons: [
            {
                extend: 'pageLength',
                text: 'Show all',
            },
            {
                extend: 'csvHtml5',
                text: 'Export to CSV',
                filename:'export'
            },
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row:first c', sheet).attr( 's', '42' );
                }
            }
        ]
    } );
</script>