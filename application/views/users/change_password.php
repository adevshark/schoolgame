<div class="container">
    <div class="row" style="padding-top: 50px; ">
        <div class="col-md-4 col-md-offset-4" style="padding-top:30px;background-color:#f9f6f6 ;box-shadow: 5px 5px 5px grey;">
            <?php if(isset($errors)){?>
                <div class="alert alert-danger">
                    <h4>Errors!</h4>
                    <?php print_r($errors);?>
                </div>
            <?php }?>
            <form action="" method="post">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
                    <a href="<?php echo base_url().'Login'?>" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>