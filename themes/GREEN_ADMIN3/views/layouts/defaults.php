<!DOCTYPE html PUBLIC "">
<?php
Yii::app()->clientScript->registerCoreScript("jquery");
?>
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<html>
    <head>
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->baseUrl;?>'
        </script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.png" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">
        <meta name="Author" content="Chico">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css">

        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/component.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icon.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/list.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/general.css">
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/style.js"></script>
    </head>
    <!--<body class="left-panel-collapsed">-->
    <body class="">
        <div class="container">
            <?php // awal left-pannel?>
            <div class="left-pannel">
                <div class="logo-pannel">
                    <a href=""><img src="<?php echo Yii::app()->baseUrl;?>/images/resource/swaraikadi_admin_logo.png"></a>
                </div>
                <div class="left-pannel-inner">
                    <!--<h5>Navigation</h5>-->
                    <?php $this->widget("application.components.widgets.MainMenu"); ?>
                </div>
            </div>
            <?php // akhir left-pannel?>
            <?php // awal main-pannel?>
            <div class="main-pannel">
                <div class="header-bar">
                    <?php // awal menu-togle?>
                    <div class="menu-toggle left">
                        <a href="javascript:void(0);"><i class="icon-bars"></i></a>
                    </div>
                    <?php // akhir menu-toogle?>
                    <?php // awal header-rigth?>
                    <div class="header-bar right">
                        <ul>
<!--                            <li>
                                <a href="javascript:void(0);"><i class="icon-user"></i></a>
                                <div class="dropdown-menu">
                                    <h2>2 NEWLY REGISTERED USERS </h2>
                                    <ul class="dropdown-list">
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Draniem Daamul (@draniem)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Zaham Sindilmaca (@zaham)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Weno Carasbong (@wenocar)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>-->
<!--                            <li>
                                <a href="javascript:void(0);"><i class="icon-envelope"></i></a>
                                <div class="dropdown-menu">
                                    <h2>YOU HAVE 1 NEW MESSAGE </h2>
                                    <ul class="dropdown-list">
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Draniem Daamul (@draniem)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Zaham Sindilmaca (@zaham)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Weno Carasbong (@wenocar)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>-->
<!--                            <li>
                                <a href="javascript:void(0);"><i class="icon-globe"></i></a>
                                <div class="dropdown-menu">
                                    <h2>YOU HAVE 1 NEW NOTIFICATIONS </h2>
                                    <ul class="dropdown-list">
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Draniem Daamul (@draniem)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Zaham Sindilmaca (@zaham)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Weno Carasbong (@wenocar)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>-->
                            <li>
                                <a  href="javascript:void(0);"><?php echo Yii::app()->user->full_name;?> <i class="icon-caret-down"></i></a>
                                <div class="dropdown-menu-user">
                                    <ul>
                                        <li><a href="javascript:void(0);"><i class="icon-user"></i><span>My Profile</span></a> </li>
                                        <li><a href="javascript:void(0);"><i class="icon-cog"></i><span>Account Setting</span></a> </li>
                                        <li><a href="javascript:void(0);"><i class="icon-question"></i><span>Help</span></a> </li>
                                        <li><a href="<?php echo Yii::app()->createUrl('adminck/logout')?>"><i class="icon-lock"></i><span>Logout</span></a> </li>
                                    </ul>
                                </div>
                            </li>
<!--                            <li>
                                <a href="javascript:void(0);"><i class="icon-comment"></i></a>
                                <div class="dropdown-menu">
                                    <h2>2 NEWLY REGISTERED USERS </h2>
                                    <ul class="dropdown-list">
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Draniem Daamul (@draniem)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Zaham Sindilmaca (@zaham)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumb">
                                                <a href="javascript:void(0);">
                                                    <img src="" alt="">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <h5>
                                                    <a href="javascript:void(0);">Weno Carasbong (@wenocar)</a>
                                                    <span class="new"></span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>-->
                        </ul>
                    </div>
                    <?php // akhir header-right?>
                    <div class="clear"></div>
                </div>
                <?php // awal page-header?>
                <div class="page-header">
                    <h2><?php echo CHtml::encode($this->pageTitle); ?></h2>
                </div>
                <?php // akhir page-header?>

                <?php // awal content-pannel?>
                <div class="content-pannel">
                    <div class="content">
                        <?php echo $content; ?>
                    </div>
                </div>
                <?php // akhir content-pannel?>
            </div>
            <?php // akhir main-pannel?>
            <?php // awal right-pannel?>
            <div class="right-pannel">
                r
            </div>
            <?php // akhir right-pannel?>
        </div>
    </body>
</html>