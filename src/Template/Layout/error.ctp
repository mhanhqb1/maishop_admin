<!DOCTYPE html>
<html>
<head>
    <title>Ameeplus</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link href="<?php echo $BASE_URL ?>/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="<?php echo $BASE_URL ?>/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
    
    <link rel="stylesheet" href="<?php echo $BASE_URL ?>/css/bootstrap.min.css?<?php echo VERSION_DATE ?>"/>
    <link rel="stylesheet" href="<?php echo $BASE_URL ?>/css/style.css?<?php echo VERSION_DATE ?>"/>
</head>
<body>
	<div id="container">
		<?php if ($error->getCode() == 404): ?>
        <div class="error404">
            <div class="error404Number">404</div>
            <div class="error404Text">指定したURLは存在しませんでした。</div>
        </div>
        <?php
        else:
            echo $this->fetch('content');
            if (getenv('FUEL_ENV') != 'production') {
                echo '<pre>';
                debug_print_backtrace();
                echo '</pre>';
            }
        endif;
        ?>
        <div style="display: none">
            <?php
                echo '<pre>';
                debug_print_backtrace();
                echo '</pre>';
            ?>
        </div>
	</div>
</body>
</html>
