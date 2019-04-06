<div class="container">
    <div class="row" style="padding-top: 50px; ">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                    <i class="material-icons">lock</i>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(isset($errors)){?>
                    <div class="alert alert-danger">
                            <h4>Errors!</h4>
                            <?php print_r($errors);?>
                        </div>
                    <?php }?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="old_password"/>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password"/>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="conf_password" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Update </button>
                            <a href="<?php echo base_url().'login'?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>