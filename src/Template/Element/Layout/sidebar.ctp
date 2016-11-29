<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="<?php echo $BASE_URL ?>"><i class="fa fa-dashboard"></i> <span><?php echo __('LABEL_DASHBOARD') ?></span></a>
            </li>
            <li class="treeview <?php if(in_array($controller, array('export'))) echo ' active ' ?>">
                <a href="#">
                    <i class="fa fa-file-excel-o"></i> <span><?php echo __('LABEL_EXPORT') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if(in_array($controller, array('export'))) echo ' active ' ?>">
                        <a href="<?php echo $BASE_URL ?>/export"><i class="fa fa-th-list"></i> <?php echo __('LABEL_EXPORT_ORDER') ?></a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php if(in_array($controller, array('products', 'orders', 'productimages'))) echo ' active ' ?>">
                <a href="#">
                    <i class="fa fa-database"></i> <span><?php echo __('LABEL_MASTER') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if(in_array($controller, array('products', 'productimages'))) echo ' active ' ?>">
                        <a href="#">
                            <i class="fa fa-th-list"></i> <?php echo __('LABEL_PRODUCTS') ?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php if($controller == 'products') echo ' active ' ?>"><a href="<?php echo $BASE_URL ?>/products"><i class="fa fa-clipboard"></i> <?php echo __('LABEL_PRODUCTS_LIST') ?></a></li>
                            <li class="<?php if($controller == 'productimages') echo ' active ' ?>"><a href="<?php echo $BASE_URL ?>/productimages"><i class="fa fa-clipboard"></i> <?php echo __('LABEL_PRODUCTIMAGES_LIST') ?></a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li class="<?php if(in_array($controller, array('orders'))) echo ' active ' ?>">
                        <a href="#">
                            <i class="fa fa-th-list"></i> <?php echo __('LABEL_ORDERS') ?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php if($controller == 'orders') echo ' active ' ?>"><a href="<?php echo $BASE_URL ?>/orders"><i class="fa fa-clipboard"></i> <?php echo __('LABEL_ORDERS_LIST') ?></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php if(in_array($controller, array('admins'))) echo ' active ' ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span><?php echo __('LABEL_SETTING') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($controller == 'admins') echo ' active ' ?>"><a href="<?php echo $BASE_URL ?>/admins"><i class="fa fa-user"></i> <?php echo __('LABEL_ADMIN_LIST') ?></a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
