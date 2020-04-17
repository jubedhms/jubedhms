<?=$header;?>
<style>
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
			<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
	</div>
	<div class="widget-list">
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
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<div class="widget-body clearfix">
			<div class="overflow">
			<div id="map"></div>
                        </div>
                </div>
                <div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
					<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</main>
<div style="position:relative">
    
    <script>
function initMap() {
  var uluru = {lat: <?=($details->latitude)?$details->latitude:'';?>, lng: <?=($details->longitude)?$details->longitude:'';?>};
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArYeNczYWwlrTikPpnn-zsWZ_9K303f2U&callback=initMap">
    </script>
<?=$footer;?>
</div>

<!--End footer-->