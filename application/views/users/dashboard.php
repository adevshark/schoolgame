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