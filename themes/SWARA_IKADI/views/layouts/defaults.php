<?php
//$module = strtolower(Yii::app()->controller->module->id);
$controller = strtolower(Yii::app()->controller->id);
$action = strtolower(Yii::app()->controller->action->id);
$currentAction = strtolower(Yii::app()->controller->id . '/' . Yii::app()->controller->action->id);
//$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
//$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.png" />
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->baseUrl; ?>';
            var baseTheme = '<?php echo Yii::app()->theme->baseUrl; ?>';
        </script>
    </head>
    <body>
        <div class="preloader"></div>
        <header>
            <div class="header-box">
                <div class="panel-box">
                    <div class="container table">
                        <div class="column logo"><a href="<?php echo Yii::app()->baseUrl ?>"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/swaraikadi.png"></a></div>
                        <div class="column search">
                            <?php
                            echo CHtml::beginForm($this->createUrl('front/page/search'), 'get');
                            echo CHtml::textField('keyword', '', array('id' => 'text', 'class' => 'sText', 'placeholder' => 'Pencarian'));
                            echo CHtml::submitButton('Cari', array('class' => ''));
                            echo CHtml::endForm();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="mainmenu">
                    <div class="container">
                        <ul>
                            <li class="on-scroll logo mobile"><a href="<?php echo Yii::app()->homeUrl ?>"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/swaraikadi_small.png"></a></li>
                            <li class="off-scroll desktop toggle clone"><a href="<?php echo Yii::app()->homeUrl ?>" <?php echo (($controller == "site") || ($action == "index")) ? 'class="current"' : ''; ?>>Home</a></li>
                            <li class="off-scroll tablet clone"><a href="<?php echo Yii::app()->createUrl("front/page/berita") ?>" <?php echo (($action == "berita") || ($action == "detailberita")) ? 'class="current"' : ''; ?>>Berita</a></li>
                            <li class="off-scroll dropdown tablet clone">
                                <div class="menu-box">
                                    <a href="javascript:void(0);" class="menu-drop">Profile</a>
                                    <ul class="dropdown-box">
                                        <li><a href="<?php echo Yii::app()->createUrl("front/profil/ikadi") ?>">Ikadi</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("front/profil/ormas") ?>">Ormas</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("front/profil/masjid") ?>">Masjid</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("front/profil/dai") ?>">Da'i</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="off-scroll dropdown tablet clone article-menu">
                                <div class="menu-box article">
                                    <a href="javascript:void(0);" class="menu-drop">Artikel</a>
                                    <ul class="dropdown-box">
                                    </ul>
                                </div>
                            </li>
                            <li class="off-scroll tablet article"><a href="<?php echo Yii::app()->createUrl("front/page/sentuhanhikmah") ?>" <?php echo $action == "sentuhanhikmah" ? 'class="current"' : ''; ?>>Sentuhan Hikmah</a></li>
                            <li class="off-scroll tablet article"><a href="<?php echo Yii::app()->createUrl("front/page/mutiaraquran") ?>" <?php echo $action == "mutiaraquran" ? 'class="current"' : ''; ?>>Mutiara Qur'an</a></li>
                            <li class="off-scroll tablet article"><a href="<?php echo Yii::app()->createUrl("front/page/bahasaarab") ?>">Bahasa Arab</a></li>
                            <li class="off-scroll tablet clone"><a href="<?php echo Yii::app()->createUrl("front/page/konsultasi") ?>" <?php echo (($action == "konsultasi") || ($action == "detailkonsultasi")) ? 'class="current"' : ''; ?>>Konsultasi</a></li>
                            <li class="off-scroll tablet clone"><a href="<?php echo Yii::app()->createUrl("front/page/info") ?>" <?php echo $action == "info" ? 'class="current"' : ''; ?>>Info Kajian</a></li>
                            <li class="off-scroll desktop clone"><a href="<?php echo Yii::app()->createUrl("front/page/download") ?>" <?php echo $action == "download" ? 'class="current"' : ''; ?>>Download</a></li>
                            <?php /* <li class="on-scroll download"><a title="Download" href="#"></a></li> */ ?>
                            <li class="on-scroll search tablet"><a title="Search" href="javascript:void(0);"></a></li>
                            <li class="on-scroll more mobile"><a title="Menu" href="javascript:void(0);" class="more-button"></a></li>
                            <li class="on-scroll gotop"><a title="Go to Top" href="javascript:void(0);" class="gotop-button"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebarmenu">
                <ul class="menu-list">
                </ul>
            </div>
        </header>
        <?php echo $content; ?>
        <footer>
            <div class="footer-menu">
                <div class="container clearfix">
                    <ul class="clearfix desktop">
                        <li><a href="<?php echo Yii::app()->createUrl("front/profil/ikadi") ?>">Profil</a></li>
                        <?php /*
                        <li class="clone"><a href="<?php echo Yii::app()->createUrl("front/profil/redaksi") ?>">Redaksi</a></li>
                        <li class="clone"><a href="<?php echo Yii::app()->createUrl("front/profil/program_ikadi") ?>">Program IKADI</a></li>
                        <li class="clone"><a href="<?php echo Yii::app()->createUrl("front/profil/kegiatan_ikadi") ?>">Kegiatan IKADI</a></li>
                        */?>
                        <li class="clone"><a href="<?php echo Yii::app()->createUrl("front/page/link"); ?>">Link Rekanan</a></li>
                    </ul>
                    <ul class="clearfix social">
                        <li><a href="https://www.facebook.com/swaraikadi" class="facebook">Swaraikadi</a></li>
                        <li><a href="https://twitter.com/swaraikadi" class="twitter">@swaraikadi</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-box">
                <div class="container">
                    <div class="panel-wrapper table">
                        <div class="column copyright">
                            <p>Copyright &copy; 2014 Ikatan Da'i Indonesia</p>
                        </div>
                        <!-- <div class="column ikadi">
                                <a href=""><img src="<?php //echo Yii::app()->baseUrl   ?>/images/resource/logo_ikadi.png"></a>
                        </div> -->
                        <div class="column apixe">
                            <a href="http://spotky.com" target="_blank"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/spotky.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div id="fb-root"></div>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.bxslider.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery_fancybox.js"></script>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
    </body>
</html>