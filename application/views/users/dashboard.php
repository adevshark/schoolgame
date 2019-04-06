<div class="container">
    <div class="row" style="padding-top: 50px; ">
        <?php if($this->session->flashdata('log_success')){?>
            <div class="col-md-12">
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('log_success');?>
                </div>
            </div>
        <?php }?>
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <h4>
                    Welcome <b><?php echo $this->session->userdata['fullname']?></b>!
                </h4>
            </div>
            <div class="card-body">
                <?php if ($this->session->userdata['user_role']=="teacher"):?>
                <a href="<?=site_url('users/invoices')?>" class="btn btn-success btn-lg">Get Game Key</a>
                <?php endif;?>
                <div style="text-align: center">
                    <a href="<?php echo base_url().'login/change_password'?>" class="btn btn-link">Change Password</a> |
                    <a href="<?php echo base_url().'login/logout'?>" class="btn btn-link">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>