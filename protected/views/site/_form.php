<?php
/* @var $this SiteController */
/* @var $model Site */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'site-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php //echo $form->errorSummary($model);  ?>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'name'); ?></div>
        <div class="row-input">
            <?php echo $form->textField($model, 'name', array('size' => 21, 'maxlength' => 21)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label">
            <?php echo $form->labelEx($model, 'costum_message'); ?>
        </div>
        <div class="row-input">
            <?php echo $form->textField($model, 'costum_message', array('size' => 31, 'maxlength' => 31)); ?>
            <?php echo $form->error($model, 'costum_message'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label">
            <?php echo $form->labelEx($model, 'offline_message'); ?>
        </div>
        <div class="row-input">
            <?php echo $form->textField($model, 'offline_message', array('size' => 51, 'maxlength' => 51)); ?>
            <?php echo $form->error($model, 'offline_message'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'default_level_access'); ?></div>
        <div class="row-input">
            <?php echo CHtml::activeDropDownList($model, "default_level_access", Group::model()->listGroups()); ?>
            <?php echo $form->error($model, 'default_level_access'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'default_list_limit'); ?></div>
        <div class="row-input">
            <?php echo $form->textField($model, 'default_list_limit', array('size' => 31, 'maxlength' => 31)); ?>
            <?php echo $form->error($model, 'default_list_limit'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label">
            <?php echo $form->labelEx($model, 'default_feed_limit'); ?>
        </div>
        <div class="row-input">
            <?php echo $form->textField($model, 'default_feed_limit', array('size' => 31, 'maxlength' => 31)); ?>
            <?php echo $form->error($model, 'default_feed_limit'); ?>
        </div>

        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'feed_email'); ?></div>
        <div class="row-input">
            <?php echo $form->textField($model, 'feed_email', array('size' => 31, 'maxlength' => 31)); ?>
            <?php echo $form->error($model, 'feed_email'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <?php // offline?>
    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'offline'); ?></div>
        <div class="row-input">
            <?php echo CHtml::activeCheckBox($model, "offline"); ?>
            <?php echo $form->error($model, 'offline'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir offline?>

    <?php // untuk mengaktifkan pengaturan site?>
    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'is_actived'); ?></div>
        <div class="row-input">
            <?php echo CHtml::activeCheckBox($model, 'is_actived'); ?>
            <?php echo $form->error($model, 'is_actived'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir is_actived?>

    <div class="row">
        <div class="row-label"></div>
        <div class="row-input">
            <?php echo CHtml::submitButton($model->isNewRecord ? "create" : "save", array("class" => "button-submit")); ?>
        </div>
        <div class="clear"></div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
