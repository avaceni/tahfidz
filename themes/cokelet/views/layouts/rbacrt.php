<!DOCTYPE html PUBLIC "">
<?php
$action = Yii::app()->controller->action->id;
Yii::app()->clientScript->registerCoreScript("jquery");
?>
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<html>
    <head>
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->baseUrl; ?>'
        </script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">
        <meta name="Author" content="Rizqi">
        <meta name="Keywords" content="<?php echo CHtml::encode($this->pageTitle); ?>">
        <meta name="Description" content="<?php echo CHtml::encode($this->pageTitle); ?>">
        <?php //if ($action != "admin") {?>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css">
        <?php //} ?>

        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/component.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icon.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/list.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/general.css">
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/style.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/action.js"></script>
    </head>
    <body>
        <div id="header">
            <div class="nav left">
                <div class="logo-cokelet">
<!--                    <a href=<?php //echo Yii::app()->baseUrl."/adminck/index";                ?>>Cokelet Admin</a>-->
                    <i class="icon-plus-circle"></i> <span>Plus</span>
                </div>
            </div>
            <div class="nav right">
                <div class="user-nav">
                    <ul class="link">
                        <li><a href=""><i class="icon-gear"></i> <span>Settings</span></a> </li>
                        <li><a href=""><i class="icon-envelope"></i> <span>Message</span></a> </li>
                        <li><a href="<?php echo Yii::app()->createUrl("user/editprofile"); ?>"> <img alt="" src="<?php echo User::model()->findByPk(Yii::app()->user->id)->getPhotoUrl(); ?>"> <span>Rizqi Bayu Anggara</span></a> </li>
                        <li><a href="<?php echo Yii::app()->createUrl("adminck/logout"); ?>"><i class="icon-mail-forward"></i> <span>Logout</span></a> </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="header_nav">
            <div class="nav ">
                <?php $this->widget("application.components.widgets.MainMenu"); ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php if (count($this->breadcrumbs) > 0) {
            ?>
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                "separator" => ""));
            ?>
            <div class="clear"></div>
        <?php } ?>
        <div class="page-title">
            <div class="fluid">
                <h1>
                    <?php echo CHtml::encode($this->pageTitle); ?>
                </h1>
            </div>
        </div>
        <div id="container">
            <div class="content">
                <?php echo $content; ?>
            </div>
            <div class="clear"></div>
        </div>
        <div id="footer"></div>

        <!--awal dialog ajax-->
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                </div>
            </div>
        </div>    
        <!--akhir dialog ajax-->
    </body>
</html>