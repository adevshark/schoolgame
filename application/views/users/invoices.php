<div class="container">
    <div class="row" style="padding-top: 50px; ">
        <div class="col-md-12">
            <?php
            if(!empty($_GET['new'])) {
                ?>
            <div class="alert alert-info" >
                 New Invoice <span style="font-weight: bold;">#<?=$_GET['new']?></span> Created!
            </div>
            <?php
            }
            ?>
            <p>
                <a class="btn btn-primary" href="<?php echo site_url('/users/purchase'); ?>">Purchase now!</a>
            </p>
            <table class="table table-striped table-invoice">
                <thead>
                <tr>
                    <th>INVOICE NUMBER</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>DUE DATE</th>
                    <th>STATUS</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($invoices) {
                        foreach( $invoices as $key=>$invoice) {
                        ?>
                        <tr>
                            <td><a href="<?php echo site_url('users/invoice/'.$invoice['id']); ?>"># <?=$invoice['id']?></a></td>
                            <td><?=$invoice['qty']?> Licenses</td>
                            <td>$ <?=$invoice['price']?></td>
                            <td><?=$invoice['due_date']?></td>
                            <td>
                                <?php 
                                if ( $invoice['status']=='pending')
                                    echo "<span class='badge badge-danger label'>".$invoice['status']."</span>";
                                else if ( $invoice['status']=='paid')
                                    echo "<span class='badge badge-success label'>".$invoice['status']."</span>";
                                else                           
                                    echo "<span class='badge badge-default label'>".$invoice['status']."</span>";
                                ?>
                            </td>
                            <td>
                                <?php 
                                if ( $invoice['status']=='paid') {
                                ?>
                                <a href="<?php echo site_url('users/invoice/'.$invoice['id']); ?>" class="btn btn-info btn-sm">View Licenses</a>
                                <?php } else { ?>
                                <a href="<?=site_url('users/cancel_invoice/'.$invoice['id'])?>" class="btn btn-primary btn-sm">Cancel</button>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="6">No invoices yet.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <?php
                my_pagination_helper( site_url('users/invoices'), $total_page, $current_page);
                ?>
            </div>
        </div>
    </div>
</div>