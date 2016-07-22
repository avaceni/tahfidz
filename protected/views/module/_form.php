<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data'
        )
)); ?>

<!--	<div class="row">
		<?php //echo $form->labelEx($model,'name'); ?>
		<?php //echo $form->textField($model,'name',array('size'=>21,'maxlength'=>21)); ?>
		<?php //echo $form->error($model,'name'); ?>
            <div class="clear"></div>
	</div>-->

	<div class="row">
            <div class="row-label"><?php echo $form->labelEx($model,'path'); ?></div>
            <div class="row-input">
                <?php //echo $form->textField($model,'path',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo CHtml::activeFileField($model, "path"); ?>
		<?php echo $form->error($model,'path'); ?>
            </div>
            <div class="clear"></div>
            <div class="row-desc">File Format (*.zip)</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Upload And Install Module' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
