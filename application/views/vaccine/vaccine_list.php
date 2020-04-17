<table class="table table-striped table-responsive table-bordered" id="myTable">
			<thead>
				<tr>
					<th>SR N0.</th>
					<th style="text-align: center;">Vaccine Name</th>
                                        <th style="white-space: pre;text-align: center;">Vaccine Code</th>
					<th style="width:90px;text-align: center;">Origin</th>
					<th style="width:90px;text-align: center;">Status</th>
                    <?php // (checkModulePermission($MODULEID,'status_btn'))?'<th>Active</th>':'';?>
					<th class="th-action" style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$i=1;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
                                    <td style="vertical-align: middle;"><?=$i;?></td>
                                    <td style="vertical-align: middle;"><?=$data->vaccine_name;?></td>
                                    <td style="vertical-align: middle;text-align: center;"><?=$data->vaccine_code;?></td>
                                    <td style="vertical-align: middle;text-align: center;"><?=$data->vaccine_origin;?></td>
                                    <td style="vertical-align: middle;text-align: center;"><?=($data->available_status==1)?'Available':(($data->available_status==2)?'Unavailable':'');?></td>
                                    <?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
<!--                                    <td>
                                        <div class="togglebutton" title="Active/Inactive"><label>
                                        <input type="checkbox" class="status" name="status[]" value="patient.'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
                                        <span class="toggle"></span></label></div>
                                    </td>-->
                                    <?php }?>
                                    <td style="text-align: center;vertical-align: middle;" >
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
                                                <i class="fa fa-ellipsis-v" style="font-size:24px"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left action-dropdown">
                                            <?php  if(checkModulePermission($MODULEID,'view_btn')){ ?>	
                                                    <a  href="vaccine/view_vaccine/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn">View Vaccine</a>
                                            <?php }?>
                                            <?php  if(checkModulePermission($MODULEID,'edit_btn')){ ?>	
                                                    <a  href="vaccine/addedit_vaccine/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success btn-xs btn-block action-btn">Edit Vaccine</a>
                                            <?php } ?>
                                            <?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
                                                    <a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs btn-block action-btn" id="vaccine/deleteData/<?=md5($data->ID);?>">Delete Vaccine</a>
                                            <?php }?>  	
                                            </div>
                                        </div>	
                                    </td>
				</tr>
				<?php $i++;} }?>	
			</tbody>
			</table>

<script>
      $(document).ready(function() { 
        $('#myTable').DataTable({
         "aaSorting": []
        });
      });      
      
</script>
