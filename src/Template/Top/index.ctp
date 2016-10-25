<h2>
    <i class="fa fa-dashboard"></i>&nbsp;
    <?php echo __('LABEL_DASHBOARD'); ?> 
    <small>[<?php echo date("Y年m月d日 H時i分") . "&nbsp;" . __('LABEL_UPDATE'); ?>]</small>
</h2>

<a href="javascript:;" target="" class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo number_format($data['count_order_in_month']); ?>&nbsp;<sup>回</sup></h3>
            <p>今月の注文数合計</p>
        </div>
        <div class="icon"><i class="fa fa-shopping-cart"></i></div>
    </div>
</a>

<a href="javascript:;" target="" class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue">
        <div class="inner">
            <h3><?php echo number_format($data['count_price_in_month']); ?>&nbsp;<sup>円</sup></h3>
            <p>今月の売り上げ</p>
        </div>
        <div class="icon"><i class="fa fa-jpy"></i></div>
    </div>
</a>

<a href="javascript:;" target="" class="col-lg-3 col-xs-6">
    <div class="small-box bg-teal">
        <div class="inner">
            <h3><?php echo number_format($data['count_order']); ?>&nbsp;<sup>回</sup></h3>
            <p>累計注文数合計</p>
        </div>
        <div class="icon"><i class="fa fa-shopping-cart"></i></div>
    </div>
</a>

<a href="javascript:;" target="" class="col-lg-3 col-xs-6">
    <div class="small-box bg-maroon">
        <div class="inner">
            <h3><?php echo number_format($data['count_price']); ?>&nbsp;<sup>円</sup></h3>
            <p>全売り上げ</p>
        </div>
        <div class="icon"><i class="fa fa-jpy"></i></div>
    </div>
</a>
