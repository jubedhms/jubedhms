<!--Start header-->
<?=$header;?>
<!--End header-->

<?php $ID= (isset($details->ID))?$details->ID:""; ?>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
		<div class="page-title-right d-none d-sm-inline-flex">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">User</a>
			</li>
			<li class="breadcrumb-item active"><?= $mode.' '.$heading; ?></li>
			</ol>
		</div>
	</div>
	<form class="MyForm" accept-charset="UTF-8" novalidate="" method="post">
	<div class="widget-list">
	<div class="row">
	<div class="<?= ($ID!='')?'col-md-9':'col-md-9'?> widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="vaccine_name" class="">Vaccine Name *</label>
					<input type="text" class="form-control" id="vaccine_name" name="vaccine_name" value="<?= getFieldVal('vaccine_name',$details);?>" data-rule-required="true" data-msg-required="Please include vaccine name  ">
					
				</div>
			</div>
			<!--<div class="col-md-6">
				<div class="form-group">
                                <label for="patient_type" class="">Patient Type  *</label>
				<select class="form-control" id="patient_type" name="patient_type" required="required" data-rule-required="true" data-msg-required="Please select patient type.">
					<option value="">Select</option>
					<option value="1" <?php //(getFieldVal('patient_type',$details)=='1')?"selected":"";?>>Child</option>
					<option value="2" <?php // (getFieldVal('patient_type',$details)=='2')?"selected":"";?>>Adult</option>
					<option value="3" <?php // (getFieldVal('patient_type',$details)=='3')?"selected":"";?>>Both</option>
				</select>
				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
					</div>
			</div>-->
                </div>
            
            <div class="row">
			<div class="col-md-4">
				<div class="form-group">
                                        <?php if($ID!=''){ ?>
                                        <?php } ?>
					<label for="vaccine_name" class="">Origin *</label>
					<input type="text" class="form-control" id="vaccine_origin" name="vaccine_origin" value="<?= getFieldVal('vaccine_origin',$details);?>" data-rule-required="true" data-msg-required="Please include vaccine origin.">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                        <div class="col-md-2">
                            <div class="form-group">
                            </div>
                        </div>
			<div class="col-md-4">
				<div class="form-group">
                                <label for="patient_type" class="">Status  *</label>
				<select class="form-control" id="available_status" name="available_status" required="required" data-rule-required="true" data-msg-required="Please select available status.">
					<option value="">Select</option>
					<option value="1" <?php echo (getFieldVal('available_status',$details)=='1')?"selected":"";?>>Available</option>
					<option value="2" <?php echo (getFieldVal('available_status',$details)=='2')?"selected":"";?>>Unavailable</option>
				</select>
                                
                                
				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
                                </div>
			</div>
                </div>
            
            <div class="row">
                <table class="table table-striped table-responsive">
			<thead>
				<tr>
					<th>Dose Name</th>
					<th>Gender</th>
					<th>From Month</th>
					<th>To Month</th>
				</tr>
			</thead>
                        <tbody class="add_dose">
                            <?php  if(isset($dose) && !empty($dose)){ $i=0; foreach($dose as $row){ if($i>0) {?>
				<tr>
                                        <td><input type="hidden" name="dose_id[]" value="<?=$row->ID; ?>">
                                        <input type="text" maxlength="5" class="form-control" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1" <?= ($row->gender=='1')?"selected":"";?>>Male</option>
                                                    <option value="2" <?= ($row->gender=='2')?"selected":"";?>>Female</option>
                                                    <option value="3" <?= ($row->gender=='3')?"selected":"";?>>Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="from_month[]"  value="<?php echo isset($row->from_month)?$row->from_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" class="form-control" name="to_month[]"  value="<?php echo isset($row->to_month)?$row->to_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                            <?php }else{ ?>
				<tr>
                                        <td><input type="hidden" name="dose_id[]" value="<?=$details->ID; ?>">
                                        <input type="text" maxlength="5" class="form-control" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1" <?= ($row->gender=='1')?"selected":"";?>>Male</option>
                                                    <option value="2" <?= ($row->gender=='2')?"selected":"";?>>Female</option>
                                                    <option value="3" <?= ($row->gender=='3')?"selected":"";?>>Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="from_month[]"  value="<?php echo isset($row->from_month)?$row->from_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" class="form-control" name="to_month[]"  value="<?php echo isset($row->to_month)?$row->to_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                                <?php } $i++; } } ?> 
                                    <?php if(!isset($dose)){ //add condition ?>
                                <tr>
                                        <td>
                                        <input type="text" maxlength="5" class="form-control" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="from_month[]" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" class="form-control" name="to_month[]" required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                            <?php } ?> 
                                <?php if(empty($dose)){  ?>
                                <tr>
                                        <td>
                                        <input type="text" maxlength="5" class="form-control" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="from_month[]" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" class="form-control" name="to_month[]"  required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                       
                                </tr>
                            <?php }  ?>
			</tbody>
                    </table>
                
                
                </div>

            
            <!--button-->
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
					<!--<a href="<?php // $main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
					<button class="btn btn-primary no-print" onClick="history.back();">Back</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</form>
</main>
<script>
    $(document).ready(function() {
        $('input,select').attr('disabled',true)
    });
</script>