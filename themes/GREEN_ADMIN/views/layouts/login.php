<!DOCTYPE html>
<html>
<head>
    <?php
    Yii::app()->clientScript->registerCoreScript("jquery");
    ?>
    <script type="text/javascript">
        var baseUrl = '<?php echo Yii::app()->baseUrl;?>'
    </script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Maverick">
    <meta name="author" content="Spotky Team">

    <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/rtq_favicon.png">

    <!-- prochtml:remove:dist -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/less/styles.css" rel="stylesheet" media="all"> 
    <!-- /prochtml -->

    <?php /*
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
     */ ?>

    <!-- bower:css -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/font-awesome/css/font-awesome.css" />
    <link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->theme->baseUrl; ?>/fonts/glyphicons/css/glyphicons.min.css' /> 
    <!-- build:css({.tmp,app}) assets/css/main.css -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css">
    <!-- endbuild -->

    <!-- prochtml:remove:dist -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="<?php // echo Yii::app()->theme->baseUrl; ?>/plugins/misc/less.js"></script>-->
    <!-- /prochtml -->

</head>
<body class="focusedform login">
    <div id="wrapper">
        <div id="layout-static">
            <div class="static-content-wrapper">
                <div class="verticalcenter" ng-controller="SignupPageController">
                    <a href="#/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo_tahfidzqu_big.png" alt="Logo" class="brand" /></a>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="text-center" style="margin-bottom: 25px;">LOGIN</h4>
                            <?php echo $content; ?>
                        </div>
<!--                        <div class="panel-footer">
                            <?php // echo CHtml::link("Forgotten password", array('class' => "pull-left btn btn-link", )); ?>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>