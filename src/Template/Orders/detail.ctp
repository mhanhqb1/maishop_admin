<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> MaiShop.
                <small class="pull-right">Date: <?php echo date('Y-m-d');?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            From
            <address>
                <strong>Admin, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: info@almasaeedstudio.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
            To
            <address>
                <strong><?php echo $data['user_name'];?></strong><br>
                <?php echo $data['address']; ?><br>
                <?php echo $data['districts_name']; ?><br>
                <?php echo $data['provinces_name']; ?><br>
                Phone: <?php echo $data['phone'];?><br>
            </address>
        </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['products'])): ?>
                    <?php foreach ($data['products'] as $product): ?>
                    <tr>
                        <td><?php echo $product['qty'];?></td>
                        <td><?php echo $product['product_name'];?></td>
                        <?php if (!empty($product['product_image'])): ?>
                        <td><img src="<?php echo $product['product_image'];?>" width="200px"/></td>
                        <?php else: ?>
                        <td>No image</td>
                        <?php endif; ?>
                        <td><?php echo $product['product_description'];?></td>
                        <td>$<?php echo $product['product_price'] * $product['qty']; ?></td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <img src="../../AdminLTE/dist/img/credit/visa.png" alt="Visa">
            <img src="../../AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="../../AdminLTE/dist/img/credit/american-express.png" alt="American Express">
            <img src="../../AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <p class="lead"><?php echo __('LABEL_ORDER_DETAIL_CREATED') . ': ' . date('Y-m-d', $data['created']);?></p>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                    </tr>
                    <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                    </tr>
                    <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>$<?php echo $data['total_price'];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button>
        </div>
    </div>
</section>