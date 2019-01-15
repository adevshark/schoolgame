<div class="container">
    <div class="row" style="padding-top: 50px; ">
        <a href="<?php echo site_url('/users/purchase'); ?>">Purchase now!</a>
        <table class="table table-striped table-invoice">
        <thead>
        <tr>
            <th>INVOICE NUMBER</th>
            <th>TOTAL</th>
            <th>DUE DATE</th>
            <th>STATUS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><a href="<?php echo site_url('users/invoice/1'); ?>">#2114309</a></td>
            <td>$192.24</td>
            <td>2018-11-19</td>
            <td><span class="label label-default">PAID</span></td>
        </tr>
        <tr>
            <td>#2114309</td>
            <td>$192.24</td>
            <td>2018-11-19</td>
            <td><span class="label label-danger">CANCELLED</span></td>
        </tr>
        <tr>
            <td>#2114309</td>
            <td>$192.24</td>
            <td>2018-11-19</td>
            <td><span class="label label-warning">PENDING</span></td>
        </tr>
        </tbody>
    </table>
    </div>
</div>