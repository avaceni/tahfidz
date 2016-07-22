<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id', array('size' => 11, 'maxlength' => 11)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 31, 'maxlength' => 31)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'full_name'); ?>
        <?php echo $form->textField($model, 'full_name', array('size' => 21, 'maxlength' => 21)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 31, 'maxlength' => 31)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'group_id'); ?>
        <?php echo $form->textField($model, 'group_id', array('size' => 11, 'maxlength' => 11)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'is_active'); ?>
        <?php echo $form->textField($model, 'is_active', array('size' => 1, 'maxlength' => 1)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'active_date'); ?>
        <?php echo $form->textField($model, 'active_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'log'); ?>
        <?php echo $form->textField($model, 'log', array('size' => 1, 'maxlength' => 1)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'log_date'); ?>
        <?php echo $form->textField($model, 'log_date'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->