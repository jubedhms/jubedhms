<style>
.checkbox .label-text:after {
	background: #f6f7f9;	
	border-color: #999;
}

.checkbox.checkbox-primary input[type=checkbox]:checked + span.label-text::after {
    background: #f6f7f9;
    border-color: #999;
    color: #1976d2;
	font-weight: bold;
}
</style>

<table class="table table-striped table-responsive table-bordered text-center">
	<thead>
		<tr>
			<th class="text-center">Module Name</th>
			<th class="text-center">
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkAllRows"  id="checkAllRows" onClick="checkAllRows(this)"/> 
						<span class="label-text"></span>
					</label>
				</div>
			</th>
			<th class="text-center">Add</th>
			<th class="text-center">Edit</th>
			<th class="text-center">View</th>
			<th class="text-center">Delete</th>
			<!--<th class="text-center">Active</th>-->
			<th class="text-center">Download</th>
		</tr>
	</thead>	
	<tbody>
		<?php //echo "<pre>";print_r($getModulList);
		
		if(count($getModulList)>0){
		foreach ($getModulList as  $module) {
		//if($module->module_url=="javascript:void(0)"){	
		?>
		<!--
		<tr style="background:#EEEEEE">
		<td colspan="9">
		<u><b><?php //echo $module->module_name;?><b></u>
		<input type="hidden" name="module_id[<?php //echo $module->ID?>]" id="UMID" value="<?php //echo $module->ID?>">
		</td>
		</tr>
		-->
		<?php //}else{?>
		<tr>
			<td>
				<?=$module->module_name;?>
				<input type="hidden" name="module_id[<?=$module->ID?>]" id="module_id" value="<?=$module->ID?>">
				<input type="hidden" name="UMP_ID[<?=$module->ID?>]" id="UMP_ID" value="<?=$module->UMP_ID;?>">
			</td>
			<td>
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkRows check all_btn"  name="all_btn[<?=$module->ID?>]" id="all_btn<?=$module->ID?>" value="1" <?=($module->all_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>	
			</td>	
			<td>
				<?php $module->ID; if($module->ID!='1' && $module->ID!='2') {?>
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">	
						<input type="checkbox" class="checkRow check add_btn"  name="add_btn[<?=$module->ID?>]" id="add_btn<?=$module->ID?>" value="1" <?=($module->add_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>		
				<?php } ?>
			</td>
			<td>
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkRow check edit_btn"  name="edit_btn[<?=$module->ID?>]" id="edit_btn<?=$module->ID?>" value="1" <?=($module->edit_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>	
			</td>
			<td>
			<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkRow check view_btn"  name="view_btn[<?=$module->ID?>]" id="view_btn<?=$module->ID?>" value="1" <?=($module->view_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>	
			</td>
			<td>
				<?php $module->ID; if($module->ID!='1' && $module->ID!='2') {?>
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkRow check delete_btn"  name="delete_btn[<?=$module->ID?>]" id="delete_btn<?=$module->ID?>" value="1" <?=($module->delete_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>	
				<?php } ?>
			</td>
			<!--<td>
				<?php $module->ID; if($module->ID!='1' && $module->ID!='2') {?>
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkRow check status_btn"  name="status_btn[<?=$module->ID?>]" id="status_btn<?=$module->ID?>" value="1" <?=($module->status_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>	
				<?php } ?>
			</td>-->
			<td>
				<?php if($module->ID=='4' || $module->ID=='15'){ ?>
				<div class="checkbox checkbox-rounded checkbox-primary">
					<label class="checkbox-checked">
						<input type="checkbox" class="checkRow check print_btn"  name="print_btn[<?=$module->ID?>]" id="print_btn<?=$module->ID?>" value="1" <?=($module->print_btn=='1')?"checked":"";?>/>
						<span class="label-text"></span>
					</label>
				</div>	
				<?php } ?>
			</td>
			<?php //}?>
		</tr>
		<?php }}?>
	</tbody>
</table>

<script>
if ($('.check:checked').length == $('.check').length ){
    $("#checkAllRows")[0].checked = true;
}

$(document).on('click', '.checkRows', function(event) { 
var obj = $(this).parent().parent().parent().parent();
obj.find('.checkRow').not(this).prop('checked', this.checked);
});

$(document).on('click', '.checkRow', function(event) { 
var obj = $(this).parent().parent().parent().parent();
 if ((obj.find('.checkRow:checked').length) == (obj.find('.checkRow').length)){
   obj.find('.checkRows').prop('checked', "checked");
}else{
	obj.find('.checkRows').prop('checked', "");
}
});
</script>