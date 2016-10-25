<header class="main-header">
    <a href="<?php echo $BASE_URL ?>" class="logo">
        <img src="<?php echo $BASE_URL ?>/img/logo.png" alt=""/>
    </a>
    
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">&nbsp;</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $BASE_URL ?>/img/avatar.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo h($AppUI['display_name']) ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo $BASE_URL ?>/img/avatar.png" class="img-circle" alt="User Image">
                            <p>
                                <?php echo h($AppUI['display_name']) ?>
                                <small><?php echo h(sprintf(__('LABEL_MEMBER_FROM'), date('Y-m', $AppUI['created']))) ?></small>
                            </p>
                        </li>
                        
                        <li class="user-footer">
                            <!--div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat"><i class="fa fa-user"></i>&nbsp;<?php echo __('LABEL_PROFILE') ?></a>
                            </div-->
                            <div class="pull-right">
                                <a href="<?php echo $BASE_URL ?>/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i>&nbsp;<?php echo __('LABEL_LOGOUT') ?></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
