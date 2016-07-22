<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/error.css">
    </head>
    <body>
        <header>
            <div class="container">
                <a href="<?php echo Yii::app()->baseUrl; ?>" title="Swara Ikadi"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/swaraikadi.png"></a>
                <a href="<?php echo Yii::app()->baseUrl; ?>" class="reload" title="Kembali"></a>
            </div>
        </header>
        <div id="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>
