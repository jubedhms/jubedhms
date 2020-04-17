<!DOCTYPE html>
<html lang="en">

  <head>
  <meta charset="utf-8" />
  <link rel="icon" sizes="76x76" href="<?=base_url()?>assets/images/icon/logo.png">
  <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/icon/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?= $this->config->item('WEBSITE_NAME'); ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>assets/user/css/half-slider.css" rel="stylesheet">
    
    <!-- Bootstrap core JavaScript -->
<script src="<?=base_url()?>assets/components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/components/bootstrap/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background: linear-gradient(60deg, #ab47bc, #8e24aa);">
      <div class="container">
        <a class="navbar-brand" href="<?=base_url()?>">
    <!--
        <img src="<?=base_url()."/".$this->config->item('WEBSITE_LOGO'); ?>" style="height:50px; width:300px; padding-top: -10px;margin: -117px; margin-top: -123px;padding-right: 10px"></img>
    -->    
        <?= $this->config->item('WEBSITE_NAME'); ?> 
        </a>		
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
		
		<marquee style="color:white;font-size:16px">Customer Care : <?= $this->config->item('CUSTOMER_CARE'); ?></marquee>
		
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
             <li class="nav-item active">
              <a class="nav-link" href="<?=base_url()?>">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?=base_url()?>signin">Login</a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <?= $this->config->item('WEBSITE_NAME'); ?> 2018</p>
      </div>
      <!-- /.container -->
    </footer>


  </body>

</html>
