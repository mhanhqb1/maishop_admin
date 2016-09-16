<!DOCTYPE html>
<html>
    <head>
        <title>Mai Shop Admin</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="icon"/>
        <link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
        
        <meta property="og:title" content="Mai Shop Admin"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content=""/>
        <meta property="og:image"  content=""/>
        <meta property="og:description" content=""/>
        <meta property="og:site_name" content=""/>
        <meta property="og:locales" content="vi_VN"/>
        <meta property="fb:app_id" content=""/>
        
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/bootstrap.min.css?<?php echo VERSION_DATE ?>"/>
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/sb-admin.css?<?php echo VERSION_DATE ?>"/>
        
        <!-- Morris Charts CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/plugins/morris.css?<?php echo VERSION_DATE ?>"/>
        
        <!-- Custom Fonts -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/font-awesome/css/font-awesome.css?<?php echo VERSION_DATE ?>"/>
        
        <!-- Custom Css -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/custom.css?<?php echo VERSION_DATE ?>"/>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">SB Admin</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="message-preview">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="media-body">
                                            <h5 class="media-heading"><strong>John Smith</strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="message-preview">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="media-body">
                                            <h5 class="media-heading"><strong>John Smith</strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="message-preview">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="media-body">
                                            <h5 class="media-heading"><strong>John Smith</strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="message-footer">
                                <a href="#">Read All New Messages</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu alert-dropdown">
                            <li>
                                <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">View All</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <?php echo $this->element('left_menu'); ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            
            <div id="page-wrapper"  class="container_<?php echo $controller . '_' . $action; ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if (!empty($breadcrumb)) : ?>
                            <?php echo $this->Breadcrumb->render($breadcrumb, $breadcrumbTitle); ?>
                        <?php endif ?>
                    </div>
                </div>                
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/bootstrap.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/plugins/morris/raphael.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/plugins/morris/morris.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/plugins/morris/morris-data.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/common.js?<?php echo VERSION_DATE ?>"></script>
    </body>
</html>
