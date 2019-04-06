<div class="container">
    <a class="btn btn-default" href="javascript:history.go(-1);"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;Back</a>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-text card-header-primary">
                            <div class="card-text">
                            <h4 class="card-title">Billing Details</h4>
                            </div>
                        </div>
                        <div class="card-body" style="min-height:450px;">
                            <div class="text-center">
                                <i class="fa fa-search-plus pull-left icon"></i>
                                <h2>Invoice for purchase #<?=$invoice_detail['id']?></h2> 
                                <?php 
                                    $cls = "badge-default";
                                    if ($invoice_detail['status'] == 'paid')
                                        $cls="badge-success";
                                    if ($invoice_detail['status'] == 'pending')
                                        $cls="badge-danger";
                                ?>
                                <p  style="font-weight:bold; font-size:24px;" class="badge <?=$cls?>">
                                    <?=strtoupper($invoice_detail['status'])?>
                                </p>
                            </div>

                            <h1 class="text-center text-warning">$ <?=$invoice_detail['price']?></h1>
                            <h3 class="text-center text-default"><?=$invoice_detail['qty']?> license(s)</h3>    

                            <strong><?=$invoice_detail['fullname']?></strong><br>
                            <?=$invoice_detail['email']?><br>
                            <strong><?=$invoice_detail['due_date']?></strong><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-text card-header-success">
                    <div class="card-text">
                    <h4 class="card-title">Licenses</h4>
                    </div>
                </div>
                <div class="card-body" style="min-height:450px;">
                    <?php if ($invoice_detail['status']!='paid'):?>
                        <h2 class="text-danger text-center">To obtain a license,<br/> it must be paid!</h2>
                    <?php else:?>
                        <?php
                        foreach( $licenses as $key=> $license) {
                            echo "<h4>".$license['key']."</h4>";
                        }
                        ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>