<link href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css">
<main class=" clearfix">
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5">Doctor Availability (<span class="doctorName"></span>)</h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
	</div>
	<form class="formv" method="post">
	<div class="widget-list">
	<div class="row">
	<div class="col-md-12 widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
            <div class="row">
                <div class=" col-md-2"> 
                 <label for="dob" class="">Select Date :</label>
                </div>
                <div class=" col-md-6"> 
                    <div class="form-group">
                        <input name="date" class="form-control datepicker datefilter" type="text" value="<?php echo date('d-m-Y'); ?>" placeholder="Select date">
                        <input name="doctorid"  type="hidden" value="<?=$Docdata->ID?>">
                        <input name="doctormcr"  type="hidden" value="<?=$Docdata->mcr?>">
                    </div>
                </div>
                <div class=" col-md-3 avalability_add" style="text-align:right;"> 
                    <p onclick="add_avalability_time()" class="add_avalability_time btn btn-primary btn-sm flat" value="1">Add Time</p>
                </div>
            </div>
            <div class='doclocation' style="display: none;">
                    <select name="location" class="form-control">
                        <option value=''>Select</option>
                        <?php 
                            if(isset($Doc_location) && count($Doc_location)>0){
                            $i=0;
                            foreach($Doc_location as $locrow){
                        ?>
                        <option value="<?php echo $locrow->ID; ?>"><?php echo $locrow->name; ?></option>
                        <?php $i++; }}?>	
                    </select>
            </div>
		<div class="row">
                    <p style="color: #696969;"><strong>Note:-</strong> Please pick time in <b>24-hour time format</b>. </p>
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th scope="col">Location</th>
                                      <th scope="col">From Time</th>
                                      <th scope="col">To Time</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="append_row">
                                     <?php   //if(!empty($availability)){ foreach($availability as $avltyrow){  ?> 
                                    <tr id="row0">
                                        <td>
                                            <select name="location" class="select2">
                                                <option value=''>Select</option>
						<?php 
//                                                    if($Doc_location && count($Doc_location)>0){
//                                                    $i=0;
//                                                    foreach($Doc_location as $locrow){
                                                ?>
                                                <option value="<?php //echo $locrow->ID; ?>" <?php //($avltyrow->hospital_location_id==$locrow->ID)?"selected":"";?>><?php //echo $locrow->name; ?></option>
                                                <?php //$i++; }}?>	
                                            </select>
                                        </td>
                                        <td>
                                            <input name="availableid" type="hidden" value="<?php //echo $avltyrow->ID?>">
                                            <input type="text" class="form-control clockpicker" name="from_time"  value="<?php  //echo dateTime($avltyrow->session_starttime,'h:i A'); ?>" >
                                        </td>
                                        <td>
                                            <input type="text" class="form-control clockpicker" name="to_time"  value="<?php //echo dateTime($avltyrow->session_endtime,'h:i A'); ?>" >
                                        </td>
                                        <td>
                                          <?php  //echo isset($avltyrow->session_starttime)?'<a href="javascript:void(0);" class="remove_time">Remove</a>':'<span class="save_time btn btn-primary btn-sm flat" value="1">Save</span>'; ?>
                                        </td>
                                    </tr>
                                     <?php //  } }  ?>
                                  </tbody>
                                </table>
			
		</div>	
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
					<!--<button type="button" class="btn btn-success no-print save_time">Save</button>-->
					<a href="#" class="btn btn-danger no-print" data-dismiss="modal">Cancel</a>
					<!--<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>-->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
<script>
jQuery(document).ready(function(){
  $('.datepicker').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
  }); 
   $('.clockpicker').clockpicker({
            'default': 'now',
            autoclose: true
        });
});
$(function(){
    $('.datefilter').trigger('click');
      $('body').on('hidden.bs.modal', '.modal', function () {
            $('.append_row').html('');
            $('.add_avalability_time').attr('value',0);
    });
   })
</script>
<script>
      $(document).ready(function() {   
        //$(".select2").select2();   
      });      
</script>