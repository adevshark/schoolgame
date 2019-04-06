<div class="container">
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card" >
                <div class="card-header card-header-icon card-header-rose">
                    <h4>
                        Your License Key
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (count($keys)):
                    ?>
                        <?php
                        foreach($keys as $k=>$item) {
                            echo "<h4>".$item['key']."</h4>";
                        }
                        ?>
                    <?php else: ?>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="key" placeholder="Input your license key here" 
                                    value="<?=isset($_POST['key'])?$_POST['key']:''?>" requied/>
                        </div>
                        <div class="form-group" align="center">
                            <button type="submit" class="btn btn-primary"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>