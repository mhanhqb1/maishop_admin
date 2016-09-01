<!DOCTYPE html>
<html>
    <head>
        <title>Campus</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="icon"/>
        <link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
        
        <meta property="og:title" content="OceanHawks"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content=""/>
        <meta property="og:image"  content=""/>
        <meta property="og:description" content=""/>
        <meta property="og:site_name" content=""/>
        <meta property="og:locales" content="ja_JP"/>
        <meta property="fb:app_id" content=""/>
        
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/bootstrap.min.css?<?php echo VERSION_DATE ?>"/>
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/flickity.min.css?<?php echo VERSION_DATE ?>"/>
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/style.css?<?php echo VERSION_DATE ?>"/>
    </head>
    <body>
        <div id="header">
            <a id="header_logo" href="javascript:;">
                <img src="<?php echo BASE_URL ?>/img/sc_user.png" title="" alt=""/>
            </a>
        </div>
        
        <div id="container" class="container_<?php echo $controller . '_' . $action; ?>">
            <?php echo $this->fetch('content'); ?>
            <?php //echo $this->element('popup/announce'); ?>
        </div>
        
        <div id="nav_bot">
            <div id="nav_bot_back"></div>
            <div id="nav_bot_forward"></div>
            <div id="nav_bot_sepa"></div>
        </div>
        
        <div id="main_loader">
            <div><img src="<?php echo BASE_URL ?>/img/ajax-loader.gif" alt="" title=""/></div>
        </div>
        
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery-migrate-1.4.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/bootstrap.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/modernizr-custom.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.kerning.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/flickity.pkgd.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.textfill.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.dotdotdot.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>/js/common.js?<?php echo VERSION_DATE ?>"></script>
    </body>
</html>
