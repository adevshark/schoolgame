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
                <?php if(isset($errors)){?>
                    <div class="alert alert-danger">
                        <h4>Errors!</h4>
                        <?php print_r($errors);?>
                    </div>
                <?php }?>
            </div>
        </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card">
            <form class="form" action="" method="post" onsubmit="return checkFinal();">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

              <div class="card-header card-header-success text-center">
                <h4 class="card-title">Register</h4>
                <!--
                <div class="social-line">
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-facebook-square"></i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-twitter"></i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-google-plus"></i>
                  </a>
                </div>
                -->
              </div>
              <!--<p class="description text-center">Or Be Classical</p>-->
              <div class="card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email"/>
                </div>
                <div class="form-group">
                    <label for="fullname">Name (full name)</label>
                    <input type="text" class="form-control" name="fullname"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="form-group">
                    <label for="confirm_password">Password Confirm:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"  oninput="setCustomValidity('')"/>
                </div>

                <div class="form-group">
                    <label for="user_role">Select your function</label>
                    <div class="form-check form-check-radio">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="user_role" id="student" value="student" >
                            Student
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check form-check-radio">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="user_role" id="teacher" value="teacher" checked>
                            Teacher
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="form-group"> 
                    <input type="checkbox" value="" required/> 
                        I agree <a href="javascript:void(0);" class="text-danger">Terms&Services</a>.
                </div>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Register </button>
                    <a href="<?php echo base_url().'login'?>" class="btn btn-danger">Cancel</a>
                </div>                
              </div>
            </form>
          </div>
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
<script type="text/javascript">
function checkFinal() {
    if( $("#password").val()!=$("#confirm_password").val() ) {
      $("#confirm_password")[0].setCustomValidity("Confirm password does not matche!");
      $("#confirm_password")[0].reportValidity();
      return false;
    }
    return true;
}
</script>
