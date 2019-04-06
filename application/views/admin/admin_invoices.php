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
            <table class="table table-striped table-invoice">
                <thead>
                <tr>
                    <th>INVOICE NUMBER</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>DUE DATE</th>
                    <th>STATUS</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach( $invoices as $key=>$invoice) {
                    ?>
                    <tr>
                        <td><a href="<?php echo site_url('users/invoice/'.$invoice['id']); ?>"># <?=$invoice['id']?></a></td>
                        <td><?=$invoice['fullname']?></td>
                        <td><?=$invoice['email']?></td>
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
                            <a href="<?php echo site_url('users/invoice/'.$invoice['id']); ?>" class="btn btn-info btn-sm">View</a> &nbsp;
                            <?php if ( $invoice['status']=='pending'):?>
                            <a href="<?php echo site_url('users/invoices_admin_mark_pay/'.$invoice['id']); ?>" class="btn btn-success btn-sm">Mark Paid</a>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <?php
                my_pagination_helper( site_url('users/invoices_admin'), $total_page, $current_page);
                ?>
            </div>
        </div>
    </div>
</div>