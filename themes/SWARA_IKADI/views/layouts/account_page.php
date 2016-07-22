<!DOCTYPE html>
<?php
$login_user_model = User::model()->findByPk(Yii::app()->user->id);
?>
<html>
    <head>
        <title>Swara Ikadi Ustad</title>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/account.css">
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->baseUrl; ?>';
            var baseTheme = '<?php echo Yii::app()->theme->baseUrl; ?>';
        </script>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="topmenu clearfix boxsizing">
                    <div class="menu-consultation"><a href="javascript:void(0)"><i class="icon-comments"></i></a></div>
                    <div class="logo">
                        <a href=""><img src="<?php echo Yii::app()->baseUrl; ?>/images/resource/swaraikadi_ustad.png"></a>
                    </div>
                    <div class="account">
                        <div class="menu-bar"><a href="javascript:void(0)"><i class="icon-bars"></i></a></div>
                        <div class="main-menu">
                            <ul>
                                <li>
                                    <div class="profile-box">
                                        <div class="account-profile table">
                                            <img src="<?php echo $login_user_model->getPhotoUrl(); ?>" class="column">
                                            <div class="profile-detail column">
                                                <span>Ahlan wa sahlan,</span>
                                                <b><?php echo $login_user_model->getFullName(); ?></b>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="javascript:void(0)" class="setting"><i class="icon-cog"></i>Pengaturan</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl("site/logout") ?>"><i class="icon-sign-out"></i>Keluar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="body">
            <div class="container boxsizing">
                <?php echo $content; ?>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom_account.js"></script>
    </body>
</html>