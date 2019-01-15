<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url('/assets/css/material-kit.css?v=2.0.5'); ?>" rel="stylesheet" />

    <title><?php echo $title;?></title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo site_url('login/change_profile'); ?>">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('login/change_password'); ?>">Change password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('login/logout'); ?>">Logout</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="row" style="padding-top: 50px; ">
            <?php if($this->session->flashdata('log_success')){?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('log_success');?>
                    </div>
                </div>
            <?php }?>
            <div class="col-md-12 alert alert-success" style="padding-top:30px;;box-shadow: 5px 5px 5px grey;">
                <h3>Welcome <?php echo $this->session->userdata['fullname']?>! to your Dashboard</h3>
                <hr>
                <div style="text-align: center">
                    <a href="<?php echo base_url().'login/change_password'?>" class="btn btn-link">Change Password</a> |
                    <a href="<?php echo base_url().'login/logout'?>" class="btn btn-link">Logout</a>
                </div>

            </div>
        </div>
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

