<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  <?php echo $title;?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url('/assets/css/material-kit.css?v=2.0.5'); ?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url('/assets/demo/demo.css'); ?>" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <div class="page-header header-filter" style="background-image: url('<?php echo base_url('/assets/img/bg7.jpg'); ?>'); background-size: cover; background-position: top center;">
    <?php include_once("includes/nav.php")?>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <?php if(!empty($message)){
                  print($message);
                }?>
            </div>
        </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 ml-auto mr-auto">
          <!-- Begin: forgot password card -->
          <div class="card card-forgot">
              <div class="card-header card-header-text card-header-danger">
                <div class="card-text">
                  <h4 class="card-title">Password Recover - Set new password</h4>
                </div>
              </div>
              <div class="card-body">
                <form class="form" action="<?=site_url('/login/forgot_password_recover/'.$token)?>" method="post">
                  <div class="form-group">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Your new password" required/>
                  </div>
                  <div class="form-group">
                    <input id="password_confirm" name="password_confirm" type="password" class="form-control" placeholder="Password Confirm" required/>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>&nbsp;&nbsp;Send</button>
                  </div>
                </form>    
              </div>
          </div>
          <!-- End: forgot password card -->
        </div>
      </div>
    </div>
    <footer class="footer">
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url('/assets/js/core/jquery.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('/assets/js/core/popper.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('/assets/js/core/bootstrap-material-design.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('/assets/js/plugins/moment.min.js'); ?>"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="<?php echo base_url('/assets/js/plugins/bootstrap-datetimepicker.js'); ?>" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url('/assets/js/plugins/nouislider.min.js'); ?>" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url('/assets/js/material-kit.js?v=2.0.5'); ?>" type="text/javascript"></script>
</body>
</html>
