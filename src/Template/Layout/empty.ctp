<!DOCTYPE html>
<html>
    <head>
        <title>Campus</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="favicon.ico" type="image/x-icon" rel="icon"/>
        <link href="favicon.ico" type="image/x-icon" rel="shortcut icon"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css?<?php echo VERSION_DATE ?>"/>
        <link rel="stylesheet" href="css/style.css?<?php echo VERSION_DATE ?>"/>
    </head>
    <body>
        <div id="container" class="container_<?php echo $controller . '_' . $action; ?>">
            <?php echo $this->fetch('content'); ?>
        </div>
        
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.4.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js?<?php echo VERSION_DATE ?>"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    </body>
</html>
