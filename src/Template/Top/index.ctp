<h2>
    <i class="fa fa-dashboard"></i>&nbsp;
    <?php echo __('LABEL_DASHBOARD'); ?> 
    <small>[<?php echo date("Y-m-d H:i") . "&nbsp;" . __('LABEL_UPDATE'); ?>]</small>
</h2>
<div class="row">
    <a href="javascript:;" target="" class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo number_format($data['count_order_in_month']); ?>&nbsp;<sup></sup></h3>
                <p>Orders (<?php echo date('M'); ?>)</p>
            </div>
            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
        </div>
    </a>

    <a href="javascript:;" target="" class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?php echo number_format($data['count_price_in_month']); ?>&nbsp;<sup></sup></h3>
                <p>Sales (<?php echo date('M'); ?>)</p>
            </div>
            <div class="icon"><i class="fa fa-usd"></i></div>
        </div>
    </a>

    <a href="javascript:;" target="" class="col-lg-3 col-xs-6">
        <div class="small-box bg-teal">
            <div class="inner">
                <h3><?php echo number_format($data['count_order']); ?>&nbsp;<sup></sup></h3>
                <p>Orders</p>
            </div>
            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
        </div>
    </a>

    <a href="javascript:;" target="" class="col-lg-3 col-xs-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3><?php echo number_format($data['count_price']); ?>&nbsp;<sup></sup></h3>
                <p>Sales</p>
            </div>
            <div class="icon"><i class="fa fa-usd"></i></div>
        </div>
    </a>
    
    <a href="javascript:;" target="" class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo number_format($data['count_product']); ?>&nbsp;<sup></sup></h3>
                <p>Products</p>
            </div>
            <div class="icon"><i class="fa fa-th-large"></i></div>
        </div>
    </a>
    
    <a href="javascript:;" target="" class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?php echo number_format($data['count_category']); ?>&nbsp;<sup></sup></h3>
                <p>Categories</p>
            </div>
            <div class="icon"><i class="fa fa-sitemap"></i></div>
        </div>
    </a>
</div>
<div class="row">
    <?php if (!empty($data['orders'])): ?>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('LABEL_NEW_ORDERS');?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Popularity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="label label-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="display: block;">
                <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left"><?php echo __('LABEL_ADD_NEW');?></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right"><?php echo __('LABEL_VIEW_ALL');?></a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($data['products'])): ?>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('LABEL_NEW_PRODUCTS');?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['products'] as $p): ?>
                            <tr>
                                <td><a href="<?php echo $BASE_URL . '/products/update/' . $p['id'] ?>"><?php echo $p['id'];?></a></td>
                                <td><?php echo (!empty($p['image'])) ? "<img src='".$p['image']."' width='150px'/>" : 'Not set image';?></td>
                                <td><?php echo $p['name'];?></td>
                                <td><?php echo $p['price'];?></td>
                                <td><?php echo $p['stock'];?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="display: block;">
                <a href="<?php echo $BASE_URL . '/products/update/'; ?>" class="btn btn-sm btn-info btn-flat pull-left"><?php echo __('LABEL_ADD_NEW');?></a>
                <a href="<?php echo $BASE_URL . '/products'; ?>" class="btn btn-sm btn-default btn-flat pull-right"><?php echo __('LABEL_VIEW_ALL');?></a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
    <?php endif; ?>
</div>