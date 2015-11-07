<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <title>.:: Vendorepuestos.com.ve ::.</title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link type="text/css" href="<?php echo sfConfig::get('app_serverhost')?>/cascadas.css" rel="stylesheet">
        <link type="text/css" href="<?php echo sfConfig::get('app_serverhost')?>/pagos/css/bvalidator.css" rel="stylesheet">
        <link type="text/css" href="<?php echo sfConfig::get('app_serverhost')?>/pagos/css/main.css" rel="stylesheet">
            
        <!--[if gte IE 9]><style type="text/css">.gradient {filter: none;}</style><![endif]-->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo sfConfig::get('app_serverhost')?>/pagos/js/jquery.bvalidator-yc.js"></script>
        <?php include_javascripts() ?>
    </head>
    <body>
        <?php include sfConfig::get('sf_lib_dir').'/vrfiles/header.php';?>
        <?php echo $sf_content ?>
        <?php include sfConfig::get('sf_lib_dir').'/vrfiles/footer.php';?>
    </body>
</html>
